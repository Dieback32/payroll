<?php


class Dailytimerecord extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
    }
    function is_logged_in(){
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in) || $logged_in == false){
            redirect('login');
        }

    }
    public function index(){
        $page = array(
            'content' => 'employee/employee_page',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer'
        );
        $this->load->view('employee/dailytimerecord_page',$page);
    }

    public function logout(){
        $this->session->unset_userdata('employee_id');
        $this->session->unset_userdata('employee_number');
        $this->session->unset_userdata('authorization');
        $this->session->unset_userdata('logged_in');
        redirect('login');
    }

    public function attendance(){
        $page = array(
            'content' => 'employee/attendance',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer',
        );
        $this->load->view('employee/dailytimerecord_page',$page);
    }

    public function timeIn(){
        $data = $this->employee_attendance->timeIn();
        if ($data == true){
            $this->session->set_flashdata('in','Punch In Successful');
            redirect('dailytimerecord/attendance');
        }else{
            $this->session->set_flashdata('in_failed','Punch In Failed');
            redirect('dailytimerecord/attendance');
        }
    }

    public function timeOut(){
        $note = $this->input->post('note');
        $request = $this->input->post('request');

        $data = $this->employee_attendance->timeOut($note,$request);
        if ($data == true){
            $this->session->set_flashdata('out','Punch Out Successful');
            redirect('dailytimerecord/attendance');
        }else{
            $this->session->set_flashdata('out_failed','Punch Out Failed');
            redirect('dailytimerecord/attendance');
        }
    }

    public function employee_breaks(){
        $page = array(
            'content' => 'employee/employee_breaks',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer',
            'em_breaks' => $this->employee_attendance->getEmployeeBreaks(),
        );
        $this->load->view('employee/dailytimerecord_page',$page);
    }

    public function startBreak(){
        $data = $this->employee_attendance->startBreak();
        if ($data == true){
            $this->session->set_flashdata('start','Your break started ');
            redirect('dailytimerecord/employee_breaks');
        }else{
            redirect('dailytimerecord/employee_breaks');
        }
    }

    public function endBreak(){
        $data = $this->employee_attendance->endBreak();
        if ($data == true){
            $this->session->set_flashdata('end','Your break ended ');
            redirect('dailytimerecord/employee_breaks');
        }else{
            redirect('dailytimerecord/employee_breaks');
        }
    }

    public function requestLeave(){
        $page = array(
            'content' => 'employee/request_leave',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer',
            'request' => $this->employee->getEmployeeLeave(),
        );
        $this->load->view('employee/dailytimerecord_page',$page);
    }
    public function requestingLeaves(){
        $request_date = $this->input->post('request_date');
        $data = $this->employee->requestingLeaves($request_date);
        if ($data == true){
            $this->session->set_flashdata('leaves','Your request sent ');
            redirect('dailytimerecord/requestLeave');
        }else{
            $this->session->set_flashdata('leaves_failed','This function is for Tenured only ');
            redirect('dailytimerecord/requestLeave');
        }
    }

    public function requestSickLeaves(){
        $page = array(
            'content' => 'employee/sick_leaves',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer',
            'sickleaves' => $this->employee->getSickLeaves()
        );
        $this->load->view('employee/dailytimerecord_page',$page);
    }
    public function requestingSickLeaves(){
        $request_date = $this->input->post('request_date');
        $data = $this->employee->requestingSickLeaves($request_date);
        if ($data == true){
            $this->session->set_flashdata('sick','Your request sent ');
            redirect('dailytimerecord/requestSickLeaves');
        }else{
            $this->session->set_flashdata('sick_failed','This function is for Tenured only ');
            redirect('dailytimerecord/requestSickLeaves');
        }
    }

    public function payslip(){
        $page = array(
            'content' => 'employee/employee_payslip',
            'navbar' => 'navbar/navbar',
            'sidebar' => 'sidebar/sidebar',
            'alert' => 'alerts/alert_popup',
            'footer' => 'footer/footer',
            'payslip' => $this->payroll->getEmployeePayslip(),
            'employee_info' => $this->employee->getEmployeeLoggedInfo()
        );
        $this->load->view('employee/dailytimerecord_page',$page);
    }

}