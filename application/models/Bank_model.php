<?php
class Bank_model extends CI_Model
{
    public function get_all_bankcode(): array
    {
        $query = $this->db->get('banks');
        return $query->result();
    }

    public function get_bankcode(): array
    {
        $this->db->select('*');
        $this->db->from('banks');
        $this->db->like('initial', strtoupper($this->input->get('q')));
        $query = $this->db->get();
        return $query->result();
    }
}
