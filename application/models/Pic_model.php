<?php
class Pic_model extends CI_Model
{

    public function get_all_pic(): array
    {
        $query = $this->db->get('pics');
        return $query->result();
    }

    public function insert_pic(): int
    {
        $data = array(
            'name' =>  $this->input->post('name'),
            'email' =>  $this->input->post('email'),
            'bank_code' =>  $this->input->post('abbr'),
            'flag' =>  $this->input->post('flag'),
            'created_at' =>  $this->input->post('created_at'),
            'modified_at' =>  $this->input->post('modified_at'),
        );

        $this->db->insert('pics', $data);
        return $this->db->insert_id();
    }
}
