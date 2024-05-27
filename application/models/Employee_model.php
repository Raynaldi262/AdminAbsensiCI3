<?php
class Employee_model extends CI_Model
{
    public function get_all(): array
    {
        $query = $this->db->get('employee');
        return $query->result();
    }

    public function get_rows(): int
    {
        $query = $this->db->get('employee');
        return $query->num_rows();;
    }

    public function searchByName(): array
    {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->like('name', $this->input->get('cari_nama'));
    
        $query = $this->db->get();
    
        // $str = $this->db->last_query();
        // echo $str;
        // die;
        return $query->result();

    }

    public function get_employee_detail(): array
    {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('id', $this->input->post('id'));
        $query  = $this->db->get();
        return $query->result_array()[0];
    }

    public function update_employee($avatar)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'username' => $this->input->post('username'),
            'isActive' => $this->input->post('status'),
            'avatar' => $avatar,
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('employee', $data);
    }

    public function delete_employee(){
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('employee');
    }

    public function insert($avatar): int
    {
        $data = array(
            'name' =>  $this->input->post('name'),
            'address' =>  $this->input->post('address'),
            'phone' =>  $this->input->post('phone'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'avatar' => $avatar,
        );

        $this->db->insert('employee', $data);
        return $this->db->insert_id();
    }
 
    public function login($usr, $pass){
        $this->db->select('id, address, phone, isFace, name, password');
        $this->db->from('employee');
        $this->db->where('username', $usr);
        $this->db->where('password', $pass);
        $this->db->where('isActive', 1);
        $query  = $this->db->get();

        return $query->row();
    }

    public function user($id){
        $this->db->select('id, address, phone, isFace, name, password,avatar');
        $this->db->from('employee');
        $this->db->where('id', $id);
        $this->db->where('isActive', 1);
        $query  = $this->db->get();
        
        return $query->row();
    }

    public function update($data, $id){
        
        $this->db->where('id', $id);
        return $this->db->update('employee', $data);
    }

    public function updateFace($id){

        $data = array(
            'isFace' =>  1
        );
        
        $this->db->where('id', $id);
        return $this->db->update('employee', $data);
        
    }
}


