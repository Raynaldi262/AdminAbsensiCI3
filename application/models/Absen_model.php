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

    public function get_all_byId($id): array
    {
        $this->db->select('*');
        $this->db->from('absen');
        $this->db->where('employeeid', $id);
        $this->db->order_by('id', 'DESC');

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


    public function searchByEmployee($id, $date)
    {
        $this->db->select('a.id');
        $this->db->from('absen a');
        $this->db->join('employee b', 'b.id = a.employeeId');
        $this->db->where('date', $date);
        $this->db->where('employeeid', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insertAbsenIn($id, $date, $loc){
        $data = array(
            'employeeId' =>  $id,
            'date' =>  $date,
            'locIn' =>  $loc,
            'locOut' =>  "",
            'inTime' =>  date("H:i:s"),
            'outTime' => ''
        );

        $this->db->insert('absen', $data);
        return $this->db->insert_id();
    }

    public function insertAbsenOut($id, $date, $loc){
        $data = array(
            'employeeId' =>  $id,
            'date' =>  $date,
            'locIn' =>  "",
            'inTime' => "",
            'locOut' =>  $loc,
            'outTime' =>  date("H:i:s"),
        );

        $this->db->insert('absen', $data);
        $this->db->insert_id();
    }


    public function updateIn($id, $loc){

        $data = array(
            'inTime' =>  date("H:i:s"),
            'locIn' =>  $loc
        );
        
        $this->db->where('id', $id);
        return $this->db->update('absen', $data);
    }

    public function updateOut($id, $loc){

        $data = array(
            'outTime' =>  date("H:i:s"),
            'locOut' =>  $loc
        );
        
        $this->db->where('id', $id);
        return $this->db->update('absen', $data);
    }
}