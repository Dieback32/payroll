<?php

class Setup extends CI_Model
{
    public function setHolidays($holiday){
        $create_date = date_create($holiday);
        $set_holiday = date_format($create_date,'Y-m-d');
        $query = $this->db->get_where('expected_shifts',array(
            'date' => $set_holiday
        ));
        if ($query->num_rows() == 1){
            $set = array('status' => 2);
            $this->db->where('date',$set_holiday);
            $this->db->update('expected_shifts',$set);
            return true;
        }else{
            return false;
        }
    }

    public function getHolidays(){
        $query = $this->db->get_where('expected_shifts',array(
            'status' => 2
        ));
        return $query->result();
    }

    public function removeHoliday($id){
        $remove = array(
            'status' => 1
        );
        $this->db->where('id',$id);
        $this->db->update('expected_shifts',$remove);

        return true;
    }

    public function getProcess(){
        $query = $this->db->get('process_list');
        return $query->result();
    }

    public function editProcess($process){
        $status = '';
       if ($process['status'] == 'QUEUED'){
           $status = 1;
       }elseif ($process['status'] == 'IN PROCESS'){
           $status = 0;
       }
        $data = array(
          'description' => $process['description'],
          'status' => $status
        );
       $this->db->where('id',$process['id']);
       $this->db->update('process_list',$data);
       return true;
    }
    public function deleteProcess($id){
        $this->db->where('id',$id);
        $this->db->delete('process_list');
        return true;
    }
}