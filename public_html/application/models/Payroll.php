<?php

class Payroll extends CI_Model
{
    function payslip_ID_number(){
        do{
            $random_id = rand(1,100000000000);
            $query = $this->db->get_where('payslip',array(
                'id_number' => $random_id
            ));
        }while($query->num_rows() == 1);
        return $random_id;
    }

    function checkExistingPayslip($payroll){
        $get_id = $this->db->get_where('employee_info',array(
            'employee_id' => $payroll['employee_id']
        ));

        $query = $this->db->get_where('payslip',array(
            'employee_id' => $get_id->row()->id
        ));
        $check_payslip = $query->result();
        $create_from = date_create($payroll['date_from']);
        $date_from = date_format($create_from,'Y-m-d');
        $create_to = date_create($payroll['date_to']);
        $date_to = date_format($create_to,'Y-m-d');
        $begin  = new DateTime($date_from);
        $end  = new DateTime($date_to);

        $result = true;
        while ($begin <= $end){
            if ($check_payslip == null){
                return true;
            }else{
                foreach ($check_payslip as $payslip){
                    if ($payslip->date_from <= $begin->format('Y-m-d') && $payslip->date_to >= $begin->format('Y-m-d')){
                        return false;
                    }else{
                        $result = true;
                    }
                }
            }
            $begin->modify('+1 day');
        }
        return $result;
    }

    public function createPayslip($payroll){
        if($payroll['net'] != 0){
            $get_id = $this->db->get_where('employee_info',array(
                'employee_id' => $payroll['employee_id']
            ));
            $check = $this->checkExistingPayslip($payroll);
            $create_from = date_create($payroll['date_from']);
            $date_from = date_format($create_from,'Y-m-d');
            $create_to = date_create($payroll['date_to']);
            $date_to = date_format($create_to,'Y-m-d');

            if ($check == true){
                $data = array(
                    'id_number' => $this->payslip_ID_number(),
                    'employee_id' => $get_id->row()->id,
                    'date_from' => $date_from,
                    'date_to' => $date_to,
                    'worked_days' => $payroll['worked_days'],
                    'holiday' => $payroll['holiday'],
                    'paid_leaves' => $payroll['leaves'],
                    'paid_sick' => $payroll['sick'],
                    'overtime' => $payroll['overtime'],
                    'undertime' => $payroll['undertime'],
                    'gross' => $payroll['gross'],
                    'total_earn' => $payroll['total'],
                    'deduction' => $payroll['deduction'],
                    'net' => $payroll['net'],
                    'logs' => time()
                );
                $this->db->insert('payslip',$data);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getPayslip(){
        $query = $this->db->order_by('logs',"DESC")->get('payslip');
        return $query->result();
    }

    public function payslipUnpaid($id){
        $update = array('status' => 0);
        $query = $this->db->get_where('payslip',array(
            'id' => $id
        ));
        $this->db->where('id',$id);
        $this->db->update('payslip',$update);
        if ($query->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->update('payslip',$update);
            return true;
        }else{
            return false;
        }
    }

    public function payslipPaid($id){
        $update = array('status' => 1);
        $query = $this->db->get_where('payslip',array(
            'id' => $id
        ));
        if ($query->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->update('payslip',$update);
            return true;
        }else{
            return false;
        }

    }

    public function getEmployeePayslip(){
        $query = $this->db->get_where('payslip',array(
            'employee_id' => $this->session->userdata('employee_id')
        ));
        return $query->result();
    }
}