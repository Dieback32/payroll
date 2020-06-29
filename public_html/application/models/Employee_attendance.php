<?php


class Employee_attendance extends CI_Model
{

    public function timeIn(){
        $query = $this->db->get_where('working_shift',array(
            'employee_id' => $this->session->userdata('employee_id'),
            'time' => time()
        ));
        if ($query->num_rows() == 0){
            $data = array(
                'employee_id' => $this->session->userdata('employee_id'),
                'date' => date('Y-m-d'),
                'punch_type' => 1,
                'time' => time(),
                'shift_details' => 'Punch in at '.date('Y-m-d h:i A')
            );
            $this->db->insert('working_shift',$data);
            // Creating Attendance Data
            $get_id = $this->db->get_where('working_shift',array(
                'employee_id' => $this->session->userdata('employee_id'),
                'time' => time()
            ));
            $attn = array(
                'employee_id' => $this->session->userdata('employee_id'),
                'shift_id' => $get_id->row()->id,
                'date_in' => $get_id->row()->date,
            );
            $this->db->insert('attendance',$attn);

            //Update Logged in
            $user_id = $this->db->get_where('employee_info',array(
                'employee_id' => $this->session->userdata('employee_id')
            ));
            $logged_in = array(
                'logged' => 1
            );
            $this->db->where('user_id',$this->session->userdata('employee_id'));
            $this->db->update('user_login',$logged_in);

            $this->session->set_userdata(array(
                'shift_id' => $get_id->row()->id,
                'shift_status' => 1,
            ));
            return true;
        }

    }

    public function timeOut($note,$request){
        $query = $this->db->get_where('working_shift',array(
            'employee_id' => $this->session->userdata('employee_id'),
            'time' => time()
        ));

        if ($query->num_rows() == 0){
            $data = array(
                'employee_id' => $this->session->userdata('employee_id'),
                'date' => date('Y-m-d'),
                'punch_type' => 'out',
                'time' => time(),
                'shift_details' => 'Punch Out at '.date('Y-m-d h:i A')
            );
            $this->db->insert('working_shift',$data);
            //Check if Employee made a request for Overtime
            if ($request == 1){
                $em_request = array(
                    'employee_id' => $this->session->userdata('employee_id'),
                    'shift_id' => $this->session->userdata('shift_id'),
                    'date' => date('Y-m-d'),
                    'note' => $note,
                    'status' => 0
                );
                $this->db->insert('request_overtime',$em_request);
            }
            //Total break in a shift
            $check_array = array(
                'employee_id' => $this->session->userdata('employee_id'),
                'shift_id' => $this->session->userdata('shift_id')
            );
            $get_breaks = $this->db->select('SUM(break_duration) AS `total`', FALSE)
                ->from('employee_breaks')
                ->where($check_array)
                ->get();

            $total_breaks = $get_breaks->row_array();
            //Get shift duration
            $check = array(
                'employee_id' => $this->session->userdata('employee_id'),
                'punch_type' => 0
            );
            $this->db->select("*");
            $this->db->from("working_shift");
            $this->db->where($check);
            $this->db->limit(1);
            $this->db->order_by('time',"DESC");
            $get_punch_out = $this->db->get();

            $shift_in = $this->db->get_where('working_shift',array(
                'id' => $this->session->userdata('shift_id'),
                'punch_type' => 1
            ));
            $shift_duration = $get_punch_out->row()->time - $shift_in->row()->time;

            $duration = ($shift_duration / 3600) - $total_breaks['total'];

            //Check the total shift if Overtime or Undertime
            $overtime = 0;
            $undertime = 0;
            if ($duration > 8){
                $overtime = $duration - 8;
            }else{
                $undertime = 8 - $duration;
            }
            //Update Attendance tbl
            $punch_out = array(
                'date_out' => date('Y-m-d'),
                'duration' => $duration,
                'overtime' => $overtime,
                'undertime' => $undertime
            );
            $this->db->where('shift_id',$this->session->userdata('shift_id'));
            $this->db->update('attendance',$punch_out);

            //Update Summary tbl
            $check_summary = $this->db->get_where('summary',array(
                'employee_id' => $this->session->userdata('employee_id'),
                'year' => date('Y'),
                'month' => date('m')
            ));

            if ($check_summary->num_rows() == 1){
                $check_attn = array(
                    'employee_id' => $this->session->userdata('employee_id'),
                    "DATE_FORMAT(date_in,'%Y')" => date('Y'),
                    "DATE_FORMAT(date_in,'%m')" => date('m'),
                );
                $total_duration = $this->db->select('SUM(duration) AS `shift`', FALSE)
                    ->from('attendance')
                    ->where($check_attn)
                    ->get();
                $summary_duration = $total_duration->row_array();
                $get_request_ot = $this->db->get_where('request_overtime',array(
                    'employee_id' => $this->session->userdata('employee_id'),
                    'status' => 1
                ));
                $request_ot = $get_request_ot->result();
                $get_attendance = $this->db->get_where('attendance',array(
                    'employee_id' => $this->session->userdata('employee_id'),
                    "DATE_FORMAT(date_in,'%Y')" => date('Y'),
                    "DATE_FORMAT(date_in,'%m')" => date('m'),
                ));
                $attendance = $get_attendance->result();
                $summary_overtime = 0;
                foreach ($request_ot as $ot):
                    foreach ($attendance as $attn):
                        if ($ot->shift_id == $attn->shift_id){
                            $summary_overtime = $summary_overtime + $attn->overtime;
                        }
                    endforeach;
                endforeach;

                $total_undertime = $this->db->select('SUM(undertime) AS `under`', FALSE)
                    ->from('attendance')
                    ->where($check_attn)
                    ->get();
                $summary_undertime = $total_undertime->row_array();

                $update_summary = array(
                    'total_shift' => $summary_duration['shift'],
                    'total_overtime' => $summary_overtime,
                    'total_undertime' => $summary_undertime['under']
                );
                $employee_check = array(
                    'employee_id' => $this->session->userdata('employee_id'),
                    'year' => date('Y'),
                    'month' => date('m')
                );
                $this->db->where($employee_check);
                $this->db->update('summary',$update_summary);
            }
            //Update Logged Out
            $logged_in = array(
                'logged' => 0
            );
            $this->db->where('user_id',$this->session->userdata('employee_id'));
            $this->db->update('user_login',$logged_in);

            $this->session->unset_userdata('shift_id');
            $this->session->unset_userdata('shift_status');
            return true;
        }
    }

    function format_duration($duration,$format = ''){
        $hours = floor($duration / 3600);
        $minutes = floor(($duration / 60) % 60);
        $seconds = $duration % 60;

        $h = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $m = str_pad($minutes, 2, '0', STR_PAD_LEFT);
        $s = str_pad($seconds, 2, '0', STR_PAD_LEFT);

        $res = $h . ":" . $m;
        switch ($format):
            case "m":
                $res = str_pad(floor($duration / 60),2,'0',STR_PAD_LEFT);
                break;
            case "m:s":
                $res = $m . ":".$s;
                break;
            case "h:m:s":
                $res = $h .":". $m . ":".$s;
                break;
            default:
                break;
        endswitch;
        $total = 0;
        $get_minute = substr($res, -2);
        $shift_minutes = intval($get_minute);
        $total_shift = $total + $shift_minutes;
        $sum = round($total_shift / 60,2);

        return $sum;
    }


    public function startBreak(){
        $break = array(
            'employee_id' => $this->session->userdata('employee_id'),
            'date' => date('Y-m-d'),
            'punch_type' => 2,
            'time' => time(),
            'shift_details' => 'Break started at '.date('Y-m-d h:i A')
        );
        $this->db->insert('working_shift',$break);
        //Update logged
        $update = array('logged' => 2);
        $this->db->where('user_id',$this->session->userdata('employee_id'));
        $this->db->update('user_login',$update);
        $this->session->set_userdata(array('break' => true));
        return true;

    }

    public function endBreak(){
        $return = array(
            'employee_id' => $this->session->userdata('employee_id'),
            'date' => date('Y-m-d'),
            'punch_type' => 3,
            'time' => time(),
            'shift_details' => 'Break ended at '.date('Y-m-d h:i A')
        );
        $this->db->insert('working_shift',$return);
        $this->session->unset_userdata('break');
        //Update logged
        $update = array('logged' => 1);
        $this->db->where('user_id',$this->session->userdata('employee_id'));
        $this->db->update('user_login',$update);
        //Insert the Break duration
        $break_duration = array(
            'employee_id' => $this->session->userdata('employee_id'),
            'shift_id' => $this->session->userdata('shift_id'),
            'break_duration' => $this->breaksDuration()
        );
        $this->db->insert('employee_breaks',$break_duration);


        return true;

    }

    function breaksDuration(){
        $check = array(
            'employee_id' => $this->session->userdata('employee_id'),
            'punch_type' => 2
        );
        $this->db->select("*");
        $this->db->from("working_shift");
        $this->db->where($check);
        $this->db->limit(1);
        $this->db->order_by('time',"DESC");
        $get_break = $this->db->get();
        $duration = time() - $get_break->row()->time;
        $break_duration = $this->format_duration($duration);

        return $break_duration;
    }


    public function getEmployeeBreaks(){
        $id = $this->session->userdata('employee_id');
//        $this->db->where($check_user);
//        $this->db->or_where_in('punch_type',3);
//        $this->db->order_by('time',"DESC");
        $sql = 'SELECT * FROM `working_shift` WHERE `employee_id` = '.$id.' AND `punch_type` = 2 OR `employee_id` = '.$id.' AND `punch_type` = 3 ORDER BY `time` DESC LIMIT 10' ;
        $query = $this->db->query($sql);
//        $query = $this->db->get();
        return $query->result();
    }

    public function getStatus(){
        $query2 = $this->db->get_where('user_login',array(
            'user_id' => $this->session->userdata('employee_id')
        ));
        return $query2->row()->logged;
    }

}