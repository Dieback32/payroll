<?php


class Employee extends CI_Model
{

    public function randomEmployeeID(){
        do{
            $random_num = rand(1,1000000000);
            $rand_employeeid = '3wc'.$random_num;
            $check_employeeID = $this->db->get_where('employee_info',array(
                'employee_id' => $rand_employeeid
            ));
        }while($check_employeeID->num_rows() == 1);
        return $rand_employeeid;
    }

    public function addingEmployee($employee){
        $query = $this->db->get_where('employee_info',array(
            'employee_id' => $employee['employeeId']
        ));
        //Employee Designation and Department
        $get_designation = $this->db->get_where('designation',array(
            'designation' => $employee['designation']
        ));

        if ($query->num_rows() == 0){
            $create_date = date_create($employee['startdate']);
            $date_started = date_format($create_date,'Y-m-d');
            $data = array(
                'employee_id' => $employee['employeeId'],
                'em_firstname' => $employee['fname'],
                'em_lastname' => $employee['lname'],
                'em_home_address' => $employee['address'],
                'em_phone' => $employee['phone'],
                'em_mobile' => $employee['mobile'],
                'em_email' => $employee['email'],
                'em_skype' => $employee['skype'],
                'startdate' => $date_started,
                'monthly_salary' => $employee['rate'],
                'designation_id' => $get_designation->row()->id,
                'paypal_accnt' => $employee['paypal']
            );
            $this->db->insert('employee_info',$data);

            $get_id = $this->db->get_where('employee_info',array(
                'employee_id' => $employee['employeeId']
            ));
            //Add total employee in Designation
            $this->updateDesignation($get_designation->row()->id);
            //Insert summary tbl
            $summary = array(
              'employee_id' => $get_id->row()->id,
              'year' => date('Y'),
              'month' => date('m')
            );

            $this->db->insert('summary',$summary);
            //Create login account
            $login_info = array(
                'user_id' => $get_id->row()->id,
                'username' => $employee['username'],
                'password' => md5($employee['password']),
                'authorization' => 2
            );
            $check_user = $this->db->get_where('user_login',array(
                'username' => $employee['username']
            ));
            if ($check_user->num_rows() == 0){
                $this->db->insert('user_login',$login_info);
            }
            //Process
            $description = 'New applicant has been added to the company. Possible for Tenuership';
            $status = 1;
            $this->insertProcess($description,$status);
            return true;
        }else{
            return false;
        }
    }

    public function getEmployeeInfo(){
        $query = $this->db->get('employee_info');
        return $query->result();
    }

    public function getEmployeeLoggedInfo(){
        $query = $this->db->get_where('employee_info',array(
            'id' => $this->session->userdata('employee_id')
        ));
        return $query->result();
    }

    public function setSalary($id,$salary){
        $query = $this->db->get_where('employee_info',array(
            'id' => $id
        ));

        if ($query->num_rows() == 1){
            $data = array('monthly_salary' => $salary);
            $this->db->where('id',$id);
            $this->db->update('employee_info',$data);

            return true;
        }else{
            return false;
        }
    }

    public function checkTenureship($id){
        $query = $this->db->get_where('employee_info',array(
            'id' => $id
        ));

        $start=date_create($query->row()->startdate);
        $present=date_create(date('Y-m-d'));
        $diff = date_diff($start,$present);

        if ($diff->format("%m") < 3){
            $tenureship = 0;
        }else{
            $tenureship = 1;
        }
        $data = array(
            'status' => $tenureship
        );
        $this->db->where('id',$id);
        $this->db->update('employee_info',$data);
        $updated = $this->db->get_where('employee_info',array('id' => $id));
        return $updated->row()->status;
    }

    public function setLeaves($id,$leaves){
        $query = $this->db->get_where('employee_info',array(
            'id' => $id,
        ));
        if ($query->num_rows() == 1){
            $set = array(
                'leave_credits' => $leaves
            );
            $check = $this->checkTenureship($id);
            if ($check == 1){
                $this->db->where('id',$id);
                $this->db->update('employee_info',$set);
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function setSickCredits($id,$sick){
        $query = $this->db->get_where('employee_info',array(
            'id' => $id
        ));

        if ($query->num_rows() == 1){
            $set = array(
                'sick_credits' => $sick
            );
            $check = $this->checkTenureship($id);
            if ($check == 1){
                $this->db->where('id',$id);
                $this->db->update('employee_info',$set);
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function setInternetAllowance($id,$allowance){
        $get_id = $this->db->get_where('employee_info',array(
            'id' => $id
        ));
        $query = $this->db->get_where('employee_allowance',array(
           'allowance_type' => 1,
           'id' => $id
        ));
        $data = array(
            'id' => $id,
            'allowance_type' => 1,
            'allowance' => $allowance
        );
        $check = $this->checkTenureship($get_id->row()->id);
        if ($check != 1){
            return false;
        }else{
            if ($query->num_rows() == 0){

                $this->db->insert('employee_allowance',$data);
                return true;
            }else{
                $this->db->where('id',$id);
                $this->db->update('employee_allowance',$data);
                return true;
            }
        }

    }

    public function editEmployeeInfo($employee){
        $query = $this->db->get_where('employee_info',array('id' => $employee['id']));
        $create_date = date_create($employee['startdate']);
        $date_started = date_format($create_date,'Y-m-d');
        //Employee Designation and Department
        $get_designation = $this->db->get_where('designation',array(
            'designation' => $employee['designation']
        ));
        //Remove previews designation
        $cnt_designation = $this->db->get_where('employee_info',array(
            'designation_id' => $query->row()->designation_id
        ));
        if ($get_designation->id != $cnt_designation->row()->designation_id){
            $update_total = array(
                'total_employees' => $cnt_designation->num_rows() - 1
            );
            $this->db->where('id',$query->row()->designation_id);
            $this->db->update('designation',$update_total);
        }

        if ($query->num_rows() == 1){
            $data = array(
                'em_firstname' => $employee['fname'],
                'em_lastname' => $employee['lname'],
                'em_home_address' => $employee['address'],
                'em_phone' => $employee['phone'],
                'em_mobile' => $employee['mobile'],
                'em_email' => $employee['email'],
                'em_skype' => $employee['skype'],
                'startdate' => $date_started,
                'paypal_accnt' => $employee['paypal'],
                'designation_id' => $get_designation->row()->id
            );
            $this->db->where('id',$employee['id']);
            $this->db->update('employee_info',$data);

            $this->updateDesignation($get_designation->row()->id);
            return true;

        }else{
            return false;
        }
    }

    public function requestOTApproved($id){
        $query = $this->db->get_where('request_overtime',array(
            'id' => $id
        ));

        if ($query->num_rows() == 1){
            $approved = array(
                'status' => 1
            );
            $this->db->where('id',$id);
            $this->db->update('request_overtime',$approved);

            return true;
        }else{
            return false;
        }
    }

    public function deleteEmployee($id){
        $get_id = $this->db->get_where('employee_info',array(
            'id' => $id
        ));
        $check = $this->db->get_where('summary',array(
            'employee_id' => $get_id->row()->employee_id
        ));
        if ($check->row()->total_shift == 0){
            $user = array('employee_id' => $get_id->row()->employee_id);
            $this->db->where('id',$id);
            $this->db->delete('employee_info');
            //Delete summary record
            $this->db->where($user);
            $this->db->delete('summary');
            //Delete user login
            $this->db->where('user_id',$id);
            $this->db->delete('user_login');

            $this->updateDesignation($get_id->row()->designation_id);
            return true;
        }else{
            return false;
        }

    }

    function updateDesignation($id){
        $cnt_designation = $this->db->get_where('employee_info',array(
            'designation_id' => $id
        ));
        $update_total = array(
            'total_employees' => $cnt_designation->num_rows()
        );
        $this->db->where('id',$id);
        $this->db->update('designation',$update_total);
    }

    public function getOvertimeRequest(){
        $query = $this->db->get_where('request_overtime',array(
            'status' => 0
        ));
        return $query->result();
    }

    public function getLeaveRequest(){
        $query = $this->db->get_where('request_leave',array(
            'status' => 0
        ));
        return $query->result();
    }

    public function requestLeaveApproved($id){
        $update = array(
          'status' => 1
        );
        $this->db->where('id',$id);
        $this->db->update('request_leave',$update);
        return true;
    }

    public function getSickRequest(){
        $query = $this->db->get_where('request_sickleaves',array(
           'status' => 0
        ));
        return $query->result();
    }

    public function requestSickApproved($id){
        $request = array('status' => 1);
        $this->db->where('id',$id);
        $this->db->update('request_sickleaves',$request);
        return true;
    }

    public function getEmployeeShifts(){
        $query = $this->db->select("*")->from('working_shift')->order_by("time","desc")->get();
        return $query->result();
    }

    public function checkStatus(){
        $query = $this->db->get('attendance');
        return $query->result();
    }

    public function getSickLeaves(){
        $query = $this->db->get_where('request_sickleaves',array(
            'employee_id' => $this->session->userdata('employee_id')
        ));
        return $query->result();
    }

    public function getEmployeeLeave(){
        $query = $this->db->get_where('request_leave',array(
            'employee_id' => $this->session->userdata('employee_id')
        ));
        return $query->result();
    }

    public function getLogged(){
        $query = $this->db->get('user_login');
        return $query->result();
    }

    public function insertProcess($description,$status){
        $data = array(
          'description' => $description,
          'status' => $status
        );
        $this->db->insert('process_list',$data);
    }
}