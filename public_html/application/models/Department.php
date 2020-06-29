<?php


class Department extends CI_Model
{
    public function addDepartment($department){
        $query = $this->db->get_where('department',array(
            'department' => $department
        ));
        if ($query->num_rows() == 0){
            $data = array(
                'department' => $department
            );
            $this->db->insert('department',$data);
            return true;
        }else{
            return false;
        }
    }

    public function addDesignation($department,$designation){
        if ($designation != null){
            $get_department = $this->db->get_where('department',array('department' => $department));
            $query = $this->db->get_where('designation',array(
                'department_id' => $get_department->row()->id,
                'designation' => $designation
            ));
            if ($query->num_rows() == 0){
                $data = array(
                    'department_id' => $get_department->row()->id,
                    'designation' => $designation
                );
                $this->db->insert('designation',$data);
                return true;
            }else{
                return false;
            }
        }
    }

    public function getDepartment(){
        $query = $this->db->get('department');
        return $query->result();
    }
    public function getDesignation(){
        $query = $this->db->get('designation');
        return $query->result();
    }

    public function editDepartment($dep_id,$department){
        $update = array('department' => $department);
        $this->db->where('id',$dep_id);
        $this->db->update('department',$update);
        return true;
    }

    public function deleteDepartment($id){
        $check_des = $this->db->get_where('designation',array(
            'department_id' => $id,
        ));
        $designation = $check_des->result();
        $delete = null;
        foreach ($designation as $des){
            if ($des->total_employees > 0){
                $delete = false;
            }else{
                $delete = true;
            }
        }
        if ($delete == false){
            return false;
        }else{
            $this->db->where('id',$id);
            $this->db->delete('department');
            $this->db->where('department_id',$id);
            $this->db->delete('designation');
            return true;
        }
    }

    public function editDesignation($id,$designation){
        $update = array('designation' => $designation);
        $this->db->where('id',$id);
        $this->db->update('designation',$update);
        return true;
    }

    public function deleteDesignation($id){
        $this->db->where('total_employees','0');
        $this->db->where('id',$id);
        $check_des = $this->db->get('designation');
        if ($check_des->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->delete('designation');
            return true;
        }else{
            return false;
        }
    }

}