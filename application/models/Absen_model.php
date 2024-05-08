<?php
class Absen_model extends CI_Model
{
    public function get_all(): array
    {
        $this->db->select('*');
        $this->db->from('absen');
        $this->db->join('employee', 'employee.id = absen.employeeId');
        $query = $this->db->get();
        return $query->result();
    }

    public function search($name, $date): array
    {
        $this->db->select('*');
        $this->db->from('absen');
        $this->db->join('employee', 'employee.id = absen.employeeId');

        if(!empty($name) && !empty($date)){
            $this->db->like('name', $name);
            $this->db->where('date', $date);
        }else if(!empty($name)){
            $this->db->like('name', $name);
        }else if(!empty($date)){
            $this->db->where('date', $date);
        }
    
        $query = $this->db->get();
        
        // $str = $this->db->last_query();
        // echo $str;
        // die;

        return $query->result();

    }
}