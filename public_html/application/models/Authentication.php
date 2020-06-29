<?php


class Authentication extends CI_Model
{
    public function logging_in($user,$pass){
        $query = $this->db->get_where('user_login',array(
            'username' => $user,
            'password' => md5($pass)
        ));
        $get_id = $this->db->get_where('employee_info',array('id' => $query->row()->user_id));
        if ($query->num_rows() == 1){
            $user_login = array(
                'employee_number' => $get_id->row()->employee_id,
                'username' => $user,
                'employee_id' => $get_id->row()->id,
                'authorization' => $query->row()->authorization,
                'logged_in' => true
                );
            $this->session->set_userdata($user_login);
            return true;
        }else{
            return false;
        }
    }
}