<?php

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->destroy_session();
    }

    public function index(){
        $this->load->view('loginpage/login_page');
    }
    public function logging_in(){
        $user = $this->input->post('user_email');
        $pass = $this->input->post('password');
        $check = $this->authentication->logging_in($user,$pass);
        if ($check == true){
            if ($this->session->userdata('authorization') == 1){
                $this->session->set_flashdata('admin_in','Logged in successful');
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('employee_in','Logged in successful');
                redirect('dailytimerecord');
            }
        }else{
            $this->session->set_flashdata('logged_in_f','Incorrect Username or Password');
            redirect('login');
        }
    }
    function destroy_session(){
        $this->session->unset_userdata('employee_number');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('employee_id');
        $this->session->unset_userdata('authorization');
        $this->session->unset_userdata('logged_in');

    }
}