<?php
class Bank_model extends CI_Model
{

    public function get_all_bankcode(): array
    {
        $query = $this->db->get('banks');
        return $query->result();
    }
}
