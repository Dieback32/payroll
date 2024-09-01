<?php


class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->expectedShift();
        $this->setNewSummary();
        $this->is_logged_in();
    }

    function is_logged_in(){
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in) || !$logged_in){
            redirect('login');
        }
    }

    public function index(){
        $page = array(
            'content' => 'administrator/homepage',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer'
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    function setNewSummary(){
        $month = date('m');
        $year = date('Y');
        $get_employee = $this->db->get('employee_info');
        $employee = $get_employee->result();
        foreach ($employee as $em){
            $data = array(
                'employee_id' => $em->id,
                'year' => $year,
                'month' => $month
            );
            $check_existence = $this->db->get_where('summary',array(
                'employee_id' => $em->id,
                'year' => $year,
                'month' => $month
            ));
            if ($check_existence->num_rows() == 0){
                $this->db->insert('summary',$data);
            }
        }
    }

    function expectedShift(){
        $month = date('m');
        $year = date('Y');
        $f = 1;
        $month_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $start_day = $year.'-'.$month.'-'.$f;
        $end_day = $year.'-'.$month.'-'.$month_days;
        $begin  = new DateTime($start_day);
        $end    = new DateTime($end_day);
        while ($begin <= $end) {
            $status = 1;
            if($begin->format("D") == "Sun") {
                $status = 0;
            }
            $day = $begin->format("d");
                $data = array(
                    'date' => date('Y-m-'.$day),
                    'year' => $year,
                    'month' => $month,
                    'status' => $status
                );
                $check = $this->db->get_where('expected_shifts',array(
                    'date' => date('Y-m-'.$day)
                ));
                if ($check->num_rows() == 0){
                    $this->db->insert('expected_shifts',$data);
                }



            $begin->modify('+1 day');
        }
    }

    public function logout(){
        $this->session->unset_userdata('employee_number');
        $this->session->unset_userdata('employee_id');
        $this->session->unset_userdata('authorization');
        $this->session->unset_userdata('logged_in');
        redirect('login');
    }

    public function addEmployee_page(){
        $page = array(
            'content' => 'administrator/add_employee',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'footer' => 'footer/footer',
            'alert' => 'alerts/alert_popup',
            'department' => $this->department->getDepartment(),
            'random_id' => $this->employee->randomEmployeeID()
        );
        $this->load->view('administrator/dashboard_view',$page);

    }

    public function addingEmployee(){
        $employee = $this->input->post('employee');
        $data = $this->employee->addingEmployee($employee);
        if ($data == true){
            $this->session->set_flashdata('added','New Employee added');
            redirect('dashboard/addEmployee_page');
        }else{
            $this->session->set_flashdata('failed','Employee ID already exist');
            redirect('dashboard/addEmployee_page');
        }
    }

    public function employeeList_page(){
        $page = array(
            'employee_info' => $this->employee->getEmployeeInfo(),
            'designation' => $this->department->getDesignation(),
            'department' => $this->department->getDepartment(),
            'content' => 'administrator/employee_list',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer'
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function department(){
        $page = array(
            'content' => 'administrator/department',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'footer' => 'footer/footer',
            'alert' => 'alerts/alert_popup',
            'department' => $this->department->getDepartment(),
            'designation' => $this->department->getDesignation()
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function addDepartment(){
        $department = $this->input->post('department');
        $designation = $this->input->post('designation');
        $add_dep = $this->department->addDepartment($department);
        foreach ($designation as $des){
            $add_des = $this->department->addDesignation($department,$des);
        }
        if ($add_dep == true){
            if ($add_des == true){
                $this->session->set_flashdata('added_dep_des','Data saved.');
                redirect('dashboard/department');
            }else{
                $this->session->set_flashdata('added_dep','Department Added.');
                $this->session->set_flashdata('error_des','Designation name already exist.');
                redirect('dashboard/department');
            }
        }else{
            $this->session->set_flashdata('error_dep','Department name already exist.');
            redirect('dashboard/department');
        }
    }

    public function getDepartmentData(){
        if (isset($_POST['id'])){
            $query = $this->db->get_where('department',array(
                'id' => $_POST['id']
            ));
            $std = new stdClass();
            $std->dep_id = $_POST['id'];
            $std->department = $query->row()->department;

            echo json_encode($std);
        }
    }

    public function editDepartment(){
        $department = $this->input->post('department');
        $dep_id = $this->input->post('dep_id');
        $update = $this->department->editDepartment($dep_id,$department);
        $designation = $this->input->post('designation');
        foreach ($designation as $des){
            $this->department->addDesignation($department,$des);
        }
        if ($update == true){
            $this->session->set_flashdata('updated_dep','Data updated.');
            redirect('dashboard/department');
        }else{
            $this->session->set_flashdata('dep_updated_failed','Something is wrong in the process.');
            redirect('dashboard/department');
        }
    }

    public function deleteDepartment(){
        $id = $this->input->post('id');
        $delete = $this->department->deleteDepartment($id);
        if ($delete == true){
            $this->session->set_flashdata('delete_dep','Department deleted.');
            redirect('dashboard/department');
        }else{
            $this->session->set_flashdata('delete_dep_failed','Cannot delete the department');
            redirect('dashboard/department');
        }
    }

    public function getDesignationData(){
        if (isset($_POST['id'])){
            $query = $this->db->get_where('designation',array(
                'id' => $_POST['id']
            ));
            $std = new stdClass();
            $std->des_id = $_POST['id'];
            $std->designation = $query->row()->designation;

            echo json_encode($std);
        }
    }
    public function getDesignation(){
        if (isset($_POST['department'])){
            $output = '';
            $get_id = $this->db->get_where('department',array(
                'department' => $_POST['department']
            ));
            $query = $this->db->get_where('designation',array(
                'department_id' => $get_id->row()->id
            ));
            $designation = $query->result();

            $output .= '<option value="">--Select Designation--</option>';
            foreach ($designation as $des){
                $output .= '<option>'.$des->designation.'</option>';
            }

            echo $output;
        }
    }

    public function editDesignation(){
        $id = $this->input->post('des_id');
        $designation = $this->input->post('designation');
        $update = $this->department->editDesignation($id,$designation);
        if ($update == true){
            $this->session->set_flashdata('update_des','Data updated.');
            redirect('dashboard/department');
        }else{
            $this->session->set_flashdata('update_des_failed','Something is wrong in the process.');
            redirect('dashboard/department');
        }
    }

    public function deleteDesignation(){
        $id = $this->input->post('id');
        $delete = $this->department->deleteDesignation($id);
        if ($delete == true){
            $this->session->set_flashdata('delete_des','Designation deleted.');
            redirect('dashboard/department');
        }else{
            $this->session->set_flashdata('delete_des_failed','Cannot delete the Designation');
            redirect('dashboard/department');
        }
    }

    public function getEmployeeInfo(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $query = $this->db->get_where('employee_info',array(
                'id' => $id
            ));
            $get_designation = $this->db->get_where('designation',array(
                'id' => $query->row()->designation_id
            ));
            $get_allowances = $this->db->get_where('employee_allowance',array(
                'employee_id' => $query->row()->id
            ));
            if ($get_allowances->num_rows() == 0){
                $allowance = 0;
            }else{
                $allowance = $get_allowances->row()->allowance;
            }

            $std = new stdClass();
            $std->id = $id;
            $std->salary = $query->row()->monthly_salary;
            $std->employee_id = $query->row()->employee_id;
            $std->fname = $query->row()->em_firstname;
            $std->lname = $query->row()->em_lastname;
            $std->address = $query->row()->em_home_address;
            $std->phone = $query->row()->em_phone;
            $std->mobile = $query->row()->em_mobile;
            $std->email = $query->row()->em_email;
            $std->skype = $query->row()->em_skype;
            $std->startdate = $query->row()->startdate;
            $std->leaves = $query->row()->leave_credits;
            $std->sick = $query->row()->sick_credits;
            $std->paypal = $query->row()->paypal_accnt;
            $std->designation = $get_designation->row()->designation;
            $std->allowance = $allowance;

            echo json_encode($std);
        }
    }

    public function getOvertime(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];

            $std = new stdClass();
            $std->id = $id;

            echo json_encode($std);
        }
    }

    public function setSalary(){
        $id = $this->input->post('id');
        $salary = $this->input->post('salary');

        $data = $this->employee->setSalary($id,$salary);
        if ($data == true){
            $this->session->set_flashdata('set','Monthly Salary has been set.');
            redirect('dashboard/employeeList_page');
        }else{
            $this->session->set_flashdata('failed_set','Monthly Salary has not been set.');
            redirect('dashboard/employeeList_page');
        }
    }

    public function setLeaves(){
        $id = $this->input->post('id');
        $leaves = $this->input->post('leaves');

        $data = $this->employee->setLeaves($id,$leaves);
        if ($data == true){
            $this->session->set_flashdata('set_leaves','Leave Credits has been set.');
            redirect('dashboard/employeeList_page');
        }else{
            $this->session->set_flashdata('failed_leave','This employee is under the 3 months Probation.');
            redirect('dashboard/employeeList_page');
        }
    }

    public function setSickCredits(){
        $id = $this->input->post('id');
        $sick = $this->input->post('sick');

        $data = $this->employee->setSickCredits($id,$sick);
        if ($data == true){
            $this->session->set_flashdata('set_sick','Sick Credits has been set.');
            redirect('dashboard/employeeList_page');
        }else{
            $this->session->set_flashdata('failed_sick','This employee is under the 3 months Probation.');
            redirect('dashboard/employeeList_page');
        }
    }

    public function setInternetAllowance(){
        $id = $this->input->post('id');
        $allowance = $this->input->post('allowance');
        $data = $this->employee->setInternetAllowance($id,$allowance);
        if ($data == true){
            $this->session->set_flashdata('set_internet','Internet Allowance set.');
            redirect('dashboard/employeeList_page');
        }else{
            $this->session->set_flashdata('internet_failed','This employee is under the 3 months Probation.');
            redirect('dashboard/employeeList_page');
        }
    }

    public function editEmployeeInfo(){
        $employee = $this->input->post('employee');

        $data = $this->employee->editEmployeeInfo($employee);
        if ($data == true){
            $this->session->set_flashdata('updated','Employee Info Saved');
            redirect('dashboard/employeeList_page');
        }else{
            $this->session->set_flashdata('failed_update','Updating Failed');
            redirect('dashboard/employeeList_page');
        }
    }

    public function deleteEmployee(){
        $id = $this->input->post('id');
        $delete = $this->employee->deleteEmployee($id);
        if ($delete == true){
            $this->session->set_flashdata('deleted','Employee has been removed');
            redirect('dashboard/employeeList_page');
        }else{
            $this->session->set_flashdata('failed_delete','Deleting failed.');
            redirect('dashboard/employeeList_page');
        }
    }

    public function breaks_page(){
        $page = array(
            'employee_info' => $this->employee->getEmployeeInfo(),
            'request' => $this->employee->getOvertimeRequest(),
            'content' => 'administrator/breaks_page',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer'
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function employeeLogs(){
        $page = array(
            'employee_info' => $this->employee->getEmployeeInfo(),
            'employee_logged' => $this->employee->getLogged(),
            'em_shifts' => $this->employee->getEmployeeShifts(),
            'status' => $this->employee->checkStatus(),
            'content' => 'administrator/employee_logs',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer'
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function payrollPage(){

        $page = array(
            'employee_info' => $this->employee->getEmployeeInfo(),
            'content' => 'administrator/payroll_page',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer'
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function payslip_page(){
        $page = array(
            'employee_info' => $this->employee->getEmployeeInfo(),
            'payslip' => $this->payroll->getPayslip(),
            'content' => 'administrator/payslip',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer'
        );
        $this->load->view('administrator/dashboard_view',$page);
    }
    public function getPayslipData(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $get_payslip = $this->db->get_where('payslip',array(
                'id' => $id
            ));
            $get_info = $this->db->get_where('employee_info',array(
               'id' => $get_payslip->row()->employee_id
            ));
            $get_designation = $this->db->get_where('designation',array(
                'id' => $get_info->row()->designation_id
            ));
            $get_department = $this->db->get_where('department',array(
                'id' => $get_designation->row()->department_id
            ));
            if ($get_payslip->row()->status == 1){
                $paid = 1;
            }else{
                $paid = 0;
            }

            $create_from = date_create($get_payslip->row()->date_from);
            $date_from = date_format($create_from,'M d, Y');
            $create_to = date_create($get_payslip->row()->date_to);
            $date_to = date_format($create_to,'M d, Y');
            $std = new stdClass();
            $std->employee_id = $get_info->row()->employee_id;
            $std->date_from = $date_from;
            $std->date_to = $date_to;
            $std->name = $get_info->row()->em_firstname.' '.$get_info->row()->em_lastname;
            $std->department = $get_department->row()->department;
            $std->designation = $get_designation->row()->designation;
            $std->worked_days = $get_payslip->row()->worked_days;
            $std->paypal = $get_info->row()->paypal_accnt;
            $std->holiday = $get_payslip->row()->holiday;
            $std->holiday_pay = number_format($get_payslip->row()->holiday * ($get_info->row()->monthly_salary / 26),2);
            $std->joined = $get_info->row()->startdate;
            $std->salary = number_format($get_info->row()->monthly_salary,2);
            $std->paid_leaves = number_format($get_payslip->row()->paid_leaves,2);
            $std->paid_sick = number_format($get_payslip->row()->paid_sick,2);
            $std->overtime = number_format($get_payslip->row()->overtime,2);
            $std->undertime = number_format($get_payslip->row()->undertime,2);
            $std->gross = number_format($get_payslip->row()->gross,2);
            $std->total = number_format($get_payslip->row()->total_earn,2);
            $std->deduction = number_format($get_payslip->row()->deduction,2);
            $std->net =  number_format($get_payslip->row()->net,2);
            $std->status = $paid;

            echo json_encode($std);
        }
    }
    public function payslipUnpaid(){
        $id = $this->input->post('payslip_id');
        $update = $this->payroll->payslipUnpaid($id);
        if ($update == true){
            $this->session->set_flashdata('unpaid_set','Payroll updated.');
            redirect('dashboard/payslip_page');
        }else{
            redirect('dashboard/payslip_page');
        }
    }

    public function payslipPaid(){
        $id = $this->input->post('payslip_id');
        $update = $this->payroll->payslipPaid($id);
        if ($update == true){
            $this->session->set_flashdata('paid_set','Payroll updated.');
            redirect('dashboard/payslip_page');
        }else{
            redirect('dashboard/payslip_page');
        }
    }



    public function overTimeRequest(){
        $page = array(
            'employee_info' => $this->employee->getEmployeeInfo(),
            'request' => $this->employee->getOvertimeRequest(),
            'content' => 'administrator/employee_overtime',
            'footer' => 'footer/footer',
            'navbar' => 'navbar/navbar',
            'alert' => 'alerts/alert_popup',
            'sidebar' => 'sidebar/sidebar',
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function leaveRequest(){
        $page = array(
            'employee_info' => $this->employee->getEmployeeInfo(),
            'request' => $this->employee->getLeaveRequest(),
            'content' => 'administrator/leave_request_page',
            'footer' => 'footer/footer',
            'navbar' => 'navbar/navbar',
            'alert' => 'alerts/alert_popup',
            'sidebar' => 'sidebar/sidebar',
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function requestLeaveApproved(){
        $id = $this->input->post('employee_id');
        $data = $this->employee->requestLeaveApproved($id);
        if ($data == true){
            $this->session->set_flashdata('leave_approved','Employee leave approved');
            redirect('dashboard/leaveRequest');
        }else{
            $this->session->set_flashdata('leave_disapproved','Something is wrong in the process');
            redirect('dashboard/leaveRequest');
        }
    }
    public function sickLeaves(){
        $page = array(
            'employee_info' => $this->employee->getEmployeeInfo(),
            'request' => $this->employee->getSickRequest(),
            'content' => 'administrator/sick_leaves_request',
            'footer' => 'footer/footer',
            'navbar' => 'navbar/navbar',
            'alert' => 'alerts/alert_popup',
            'sidebar' => 'sidebar/sidebar',
        );
        $this->load->view('administrator/dashboard_view',$page);
    }
    public function requestSickApproved(){
        $id = $this->input->post('employee_id');
        $data = $this->employee->requestSickApproved($id);
        if ($data == true){
            $this->session->set_flashdata('sick_approved','Employee leave approved');
            redirect('dashboard/sickLeaves');
        }else{
            $this->session->set_flashdata('sick_disapproved','Something is wrong in the process');
            redirect('dashboard/sickLeaves');
        }
    }


    public function requestOTApproved(){
        $id = $this->input->post('request_id');
        $request = $this->employee->requestOTApproved($id);
        if ($request == true){
            redirect('dashboard/overTimeRequest');
        }else{
            redirect('dashboard/overTimeRequest');
        }
    }

    public function employeeRecordsPage(){
        $page = array(
            'content' => 'administrator/employee_records',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'footer' => 'footer/footer',
            'alert' => 'alerts/alert_popup',
            'employee' => $this->employee->getEmployeeInfo()
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function holidaysPage(){
        $page = array(
            'content' => 'administrator/holidays_page',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'footer' => 'footer/footer',
            'alert' => 'alerts/alert_popup',
            'holidays' => $this->setup->getHolidays()
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function setHolidays(){
        $holiday = $this->input->post('holiday');
        $set = $this->setup->setHolidays($holiday);
        if ($set == true){
            $this->session->set_flashdata('holiday_set','Holiday has been set.');
            redirect('dashboard/holidaysPage');
        }else{
            $this->session->set_flashdata('holiday_failed','Something is wrong on the process');
            redirect('dashboard/holidaysPage');
        }
    }

    public function removeHoliday(){
        $id = $this->input->post('id');
        $remove = $this->setup->removeHoliday($id);
        if ($remove == true){
            $this->session->set_flashdata('remove_holiday','Holiday has been removed.');
            redirect('dashboard/holidaysPage');
        }else{
            $this->session->set_flashdata('remove_failed','Something is wrong on the process.');
            redirect('dashboard/holidaysPage');
        }
    }

    public function calculationPayroll($from,$to,$employee_id){
        //Get Employee information
        $get_employee  = $this->db->get_where('employee_info',array(
            'employee_id' => $employee_id
        ));
        $get_summary = $this->db->get_where('attendance',array(
            'employee_id' => $get_employee->row()->id
        ));
        $attendance = $get_summary->result();
        //Get Holidays
        $get_expected_shift = $this->db->get_where('expected_shifts',array(
            'status' => 2
        ));
        $expected_shift = $get_expected_shift->result();
        //Get approved overtime
        $get_overtime = $this->db->get_where('request_overtime',array(
            'employee_id' => $employee_id,
            'status' => 1
        ));
        $overtime = $get_overtime->result();
        //Get vacation/paid leaves
        $get_paidleaves = $this->db->get_where('request_leave',array(
            'status' => 1,
            'employee_id' => $get_employee->row()->id,
        ));
        $paid_leaves = $get_paidleaves->result();
        //Paid Sick Credits
        $get_sickleaves = $this->db->get_where('request_sickleaves',array(
            'employee_id' => $get_employee->row()->id,
            'status' => 1
        ));
        $sick_leaves = $get_sickleaves->result();
        //Get Summary
        $create_from = date_create($from);
        $date_from = date_format($create_from,'Y-m-d');
        $create_to = date_create($to);
        $date_to = date_format($create_to,'Y-m-d');
        $begin  = new DateTime($date_from);
        $end  = new DateTime($date_to);
        $total_shift = 0;
        $total_overtime = 0;
        $total_undertime = 0;
        $payable_days = 0;
        $payroll['holiday'] = 0;
        $payroll['num_shift'] = 26;
        $payroll['shift_hrs'] = 0;
        $payroll['shift_min'] = 0;
        $payroll['overtime_hrs'] = 0;
        $payroll['overtime_min'] = 0;
        $payroll['undertime_hrs'] = 0;
        $payroll['undertime_min'] = 0;
        $leave = 0;
        $payroll['unpaid_leaves'] = 0;
        $sicks = 0;
        $payroll['unpaid_sickleaves'] = 0;
        $payroll['deduction'] = 0;
        $payroll['net'] = 0;
        while ($begin <= $end){
            foreach ($attendance as $attn){
                if ($attn->date_out == $begin->format('Y-m-d')){
                    $total_shift = $attn->duration + $total_shift;
                    $total_undertime = $attn->undertime + $total_undertime;
                    $payable_days = $payable_days + 1;
                    foreach ($overtime as $ot){
                        if ($ot->date == $attn->date_out){
                            $total_overtime = $attn->overtime + $total_overtime;
                        }
                    }
                }
            }

            //Holidays
            foreach ($expected_shift as $shifts){
                if ($shifts->date == $begin->format('Y-m-d')){
                    $payroll['holiday'] = $payroll['holiday'] + 1;
                }
            }

            //Paid Leaves
            foreach ($paid_leaves as $leaves){
                if ($leaves->request_date == $begin->format('Y-m-d')){
                    $leave = $leave + 1;
                }
            }
            //Paid Sick Leaves
            foreach ($sick_leaves as $sick){
                if ($sick->request_date == $begin->format('Y-m-d')){
                    $sicks = $sicks + 1;
                }

            }
            $begin->modify('+1 day');
        }
        $payroll['cnt_leaves'] = $leave;
        $payroll['cnt_sick'] = $sicks;

        //Convert Total shift to Time format
        $payroll['shift_hrs'] = floor($total_shift);
        $payroll['shift_min'] = round(($total_shift - $payroll['shift_hrs']) * 60);
        //Convert Total Overtime to Time format
        $payroll['overtime_hrs'] = floor($total_overtime);
        $payroll['overtime_min'] = round(($total_overtime - $payroll['overtime_hrs']) * 60);
        //Convert Total Undertime to Time format
        $payroll['undertime_hrs'] = floor($total_undertime);
        $payroll['undertime_min'] = round(($total_undertime - $payroll['undertime_hrs']) * 60);

//        $absents = $payroll['num_shift'] - $payable_days;
        //Unpaid Vacation/leave credit
        $payroll['unpaid_leaves'] = $get_employee->row()->leave_credits;
        //Unpaid Sick Credit
        $payroll['unpaid_sickleaves'] = $get_employee->row()->sick_credits;

        //Deductions & Net Pay
        $rate_hrs = ($get_employee->row()->monthly_salary / $payroll['num_shift']) / 8;
        $rate_day = $get_employee->row()->monthly_salary / $payroll['num_shift'];
        $deduction = $rate_hrs * $total_undertime;
//        $deduction = $deduction + ($absents * $rate_day);
        $payroll['deduction'] = $deduction;
        $total_overtime = $total_overtime * $rate_hrs;
        $holiday = $payroll['holiday'] * $rate_day;
        $payroll['paid_leaves'] = $leave * $rate_day;
        $payroll['sick_leaves'] = $sicks * $rate_day;
        $payroll['overtime'] = $total_overtime;
        $payroll['undertime'] = $total_undertime * $rate_hrs;
        $payroll['worked_days'] = $payable_days;
        $payroll['gross_salary'] = $rate_day * $payable_days;
        $payroll['total'] = $payroll['gross_salary'] + $total_overtime + $holiday + $payroll['sick_leaves'] + $payroll['paid_leaves'];
        $payroll['net'] = $payroll['total'] - $payroll['deduction'] ;

        return $payroll;

    }

    public function payroll(){
        $output = '';

        if (isset($_POST['employee_id']) && isset($_POST['date_from']) && isset($_POST['date_to'])){
            $from = $_POST['date_from'];
            $to = $_POST['date_to'];
            $employee_id = $_POST['employee_id'];

            $payroll = $this->calculationPayroll($from,$to,$employee_id);

            //Get Employee information
            $get_employee  = $this->db->get_where('employee_info',array(
                'employee_id' => $employee_id
            ));

            $output .= '<div class="col-md-1"></div>';
            $output .= '<div class="col-md-5">';
            $output .= '<div class="em-payroll">';
            $output .= '<div class="em-payroll-header">';
            $output .= '<span><i class="far fa-user"></i>&nbsp;Employee</span>';
            $output .= '</div>';
            $output .= '<div class="em-payroll-container">';
            $output .= '<table>';
            $output .= '<tbody>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Name</td>';
            $output .= '<td>'.$get_employee->row()->em_firstname.' '.$get_employee->row()->em_lastname.'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Monthly Rate</td>';
            $output .= '<td>'.$get_employee->row()->monthly_salary.'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Working Hours <br>(HH:MM)</td>';
            $output .= '<td>'.$payroll['shift_hrs'].':'.$payroll['shift_min'].'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Overtime<br>(HH:MM)</td>';
            $output .= '<td>'.$payroll['overtime_hrs'].':'.$payroll['overtime_min'].'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Undertime<br>(HH:MM)</td>';
            $output .= '<td>'.$payroll['undertime_hrs'].':'.$payroll['undertime_min'].'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Worked Days</td>';
            $output .= '<td>'.$payroll['worked_days'].'</td>';
            $output .= '</tr>';
            $output .= '</tbody>';
            $output .= '</table>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="col-md-5">';
            $output .= '<div class="em-payroll">';
            $output .= '<div class="em-payroll-header">';
            $output .= '<span><i class="fas fa-tag"></i>&nbsp;Payroll</span>';
            $output .= '</div>';
            $output .= '<div class="em-payroll-container">';
            $output .= '<table>';
            $output .= '<tbody>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Vacation/Paid Leaves</td>';
            $output .= '<td>'.$payroll['cnt_leaves'].'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Unpaid Leaves</td>';
            $output .= '<td>'.$payroll['unpaid_leaves'].'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Paid Sick Credits</td>';
            $output .= '<td>'.$payroll['cnt_sick'].'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Unpaid Sick Credits</td>';
            $output .= '<td>'.$payroll['unpaid_sickleaves'].'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Gross Salary</td>';
            $output .= '<td>'.round($payroll['gross_salary'],2).'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="color: grey;text-align: right">Deduction</td>';
            $output .= '<td>'.round($payroll['deduction'],2).'</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td style="text-align: right;font-weight: bold">Net Pay</td>';
            $output .= '<td>'.round($payroll['net'],2).'</td>';
            $output .= '</tr>';
            $output .= '</tbody>';
            $output .= '</table>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="col-md-1"></div>';


            echo $output;
        }else{
            $output .= '<div class="alert alert-warning alert-dismissible">';
            $output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            $output .= '<strong>Warning!</strong> Something is wrong in the process. Please try to select again.';
            $output .= '</div>';

            echo $output;
        }

    }

    public function payslipData(){
        if (isset($_POST['employee_id']) && isset($_POST['date_from']) && isset($_POST['date_to'])){
            $from = $_POST['date_from'];
            $to = $_POST['date_to'];
            $employee_id = $_POST['employee_id'];

            $payroll = $this->calculationPayroll($from,$to,$employee_id);

            $std = new stdClass();
            $std->id = $employee_id;
            $std->date_from = $from;
            $std->date_to = $to;
            $std->worked_days = $payroll['worked_days'];
            $std->holiday = $payroll['holiday'];
            $std->overtime = $payroll['overtime'];
            $std->undertime = $payroll['undertime'];
            $std->leaves = $payroll['paid_leaves'];
            $std->sick = $payroll['sick_leaves'];
            $std->gross = $payroll['gross_salary'];
            $std->total = $payroll['total'];
            $std->deduction = $payroll['deduction'];
            $std->net = $payroll['net'];

            echo json_encode($std);
        }
    }

    public function createPayslip(){
        $payroll = $this->input->post('payslip');
        $data = $this->payroll->createPayslip($payroll);
        if ($data == true){
            redirect('dashboard/payslip_page');
        }else{
            $this->session->set_flashdata('payslip_failed','Cannot create payslip.');
            redirect('dashboard/payrollPage');
        }

    }

    public function employeeRecords(){

        $output = '';
        if ($_POST['date_from'] == null || $_POST['date_to'] == null){
           $output .= '<tr>';
           $output .= '<td valign="top" colspan="9" class="dataTables_empty">No data available in table</td>';
           $output .= '</tr>';
           echo $output;
        }else{
            if (isset($_POST['employee_id'])){
                $employee_id = $this->input->post('employee_id');
                $date_to = $this->input->post('date_to');
                $date_from = $this->input->post('date_from');

                //Get Employee Info
                $get_employee = $this->db->get_where('employee_info',array(
                    'employee_id' => $employee_id
                ));
                $expected_shift = $this->db->get('expected_shifts');
                $shifts = $expected_shift->result();
                $get_attendance = $this->db->get_where('attendance',array(
                    'employee_id' => $get_employee->row()->id
                ));
                $attendance = $get_attendance->result();

                $get_employee_shift = $this->db->get_where('working_shift',array(
                    'employee_id' => $get_employee->row()->id
                ));
                $working_shift = $get_employee_shift->result();

                $create_from = date_create($date_from);
                $from = date_format($create_from,'Y-m-d');
                $create_to = date_create($date_to);
                $to = date_format($create_to,'Y-m-d');
                $begin  = new DateTime($from);
                $end  = new DateTime($to);
                while ($begin <= $end){
                    foreach ($shifts as $ex_shifts):
                        if ($ex_shifts->date == $begin->format('Y-m-d')){
                            $create_date = date_create($ex_shifts->date);
                            $weekdays = date_format($create_date,'D');
                            $day = date_format($create_date,'d');
                            $em_shifts = 'No Shift';
                            $background = '';
                            $status = 'Absent';
                            if ($ex_shifts->status == 1){
                                $em_shifts = 'Expected';
                            }elseif ($ex_shifts->status == 2){
                                $em_shifts = 'Holiday';
                                $status = '';
                                $background = 'style = "background-color:yellow"';
                            }else{
                                $status = '';
                                $background = 'style = "background-color:grey"';
                            }

                            if ($begin->format('Y-m-d') > date('Y-m-d')){
                                $status = 'N/A';
                            }
                            $in = null;
                            $out = null;
                            $undertime = null;
                            $overtime = null;
                            $duration = null;
                            //Employee Summary of shift
                            foreach ($attendance as $em_attendance):
                                if ($em_attendance->date_in == $ex_shifts->date){
                                    $status = 'Present';
                                    //Duration
                                    $duration_hours = floor($em_attendance->duration);
                                    $duration_min = round(($em_attendance->duration - $duration_hours) * 60);
                                    $duration = $duration_hours.':'.$duration_min;
                                    //Overtime
                                    $overtime_hours = floor($em_attendance->overtime);
                                    $overtime_min = round(($em_attendance->overtime - $overtime_hours) * 60);
                                    $overtime = $overtime_hours.':'.$overtime_min;
                                    //Undertime
                                    $undertime_hours = floor($em_attendance->undertime);
                                    $undertime_min = round(($em_attendance->undertime - $undertime_hours) * 60);
                                    $undertime = $undertime_hours.':'.$undertime_min;
                                }elseif ($em_attendance->date_out == $ex_shifts->date){
                                    //Duration
                                    $status = 'Present';
                                    $duration_hours = floor($em_attendance->duration);
                                    $duration_min = round(($em_attendance->duration - $duration_hours) * 60);
                                    $duration = $duration_hours.':'.$duration_min;
                                    //Overtime
                                    $overtime_hours = floor($em_attendance->overtime);
                                    $overtime_min = round(($em_attendance->overtime - $overtime_hours) * 60);
                                    $overtime = $overtime_hours.':'.$overtime_min;
                                    //Undertime
                                    $undertime_hours = floor($em_attendance->undertime);
                                    $undertime_min = round(($em_attendance->undertime - $undertime_hours) * 60);
                                    $undertime = $undertime_hours.':'.$undertime_min;
                                }
                            endforeach;
                            //Employee Working shift details
                            foreach ($working_shift as $em_shift):
                                if ($em_shift->date == $ex_shifts->date){
                                    if ($em_shift->punch_type == 1){
                                        $in = date('h:i A',$em_shift->time);
                                    }elseif($em_shift->punch_type == 0){
                                        $out = date('h:i A',$em_shift->time);
                                    }
                                }
                            endforeach;
                            $output .= '<tr '.$background.'>';
                            $output .= '<td>'.$em_shifts.'</td>';
                            $output .= '<td>'.$weekdays.'</td>';
                            $output .= '<td>'.$day.'</td>';
                            $output .= '<td>'.$in.'</td>';
                            $output .= '<td>'.$out.'</td>';
                            $output .= '<td>'.$overtime.'</td>';
                            $output .= '<td>'.$undertime.'</td>';
                            $output .= '<td>'.$duration.'</td>';
                            $output .= '<td>'.$status.'</td>';
                            $output .= '</tr>';
                        }
                    endforeach;
                    $begin->modify('+1 day');
                }
                echo $output;

            }
        }
    }

    public function employeeNameOutput(){
        $output = '';
        if (isset($_POST['employee_id'])){
            $employee_id = $this->input->post('employee_id');
            $query = $this->db->get_where('employee_info',array(
                'employee_id' => $employee_id
            ));
            $output .= '<span style="font-weight: bold;">Name: </span>'.$query->row()->em_firstname.' '.$query->row()->em_lastname;

            echo $output;
        }
    }


    public function processList(){
        $page = array(
            'content' => 'administrator/process_list',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'footer' => 'footer/footer',
            'alert' => 'alerts/alert_popup',
            'process' => $this->setup->getProcess()
        );
        $this->load->view('administrator/dashboard_view',$page);
    }

    public function getProcessList(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $query = $this->db->get_where('process_list',array(
                'id' => $id
            ));

            if ($query->row()->status == 1){
                $status = 'QUEUED';
            }else{
                $status = 'IN PROCESS';
            }

            $std = new stdClass();
            $std->description = $query->row()->description;
            $std->status = $status;

            echo json_encode($std);
        }
    }

    public function editProcess(){
        $process = $this->input->post('process');
        $update = $this->setup->editProcess($process);
        if ($update == true){
            $this->session->set_flashdata('process','Update Saved.');
            redirect('dashboard/processList');
        }else{
            $this->session->set_flashdata('process_f','Something is wrong in the process.');
            redirect('dashboard/processList');
        }
    }

    public function deleteProcess(){
        $id = $this->input->post('id');
        $delete = $this->setup->deleteProcess($id);
        if ($delete == true){
            $this->session->set_flashdata('process_deleted','Process Deleted.');
            redirect('dashboard/processList');
        }else{
            $this->session->set_flashdata('process_del_f','Something is wrong in the process.');
            redirect('dashboard/processList');
        }
    }

}
