<?php
class Pic_model extends CI_Model
{
    public function get_all_pic(): array
    {
        $query = $this->db->get('pics');
        return $query->result();
    }

    public function get_all_active_pic_email(): array
    {
        $this->db->select('name, email');
        $this->db->from('pics');
        $this->db->where('flag', '1');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_pic_limited($limit): array
    {
        $this->db->select('*');
        $this->db->from('pics');
        if ($this->input->get('cari_nama')) {
            $this->db->like(strtoupper('name'), strtoupper($this->input->get('cari_nama')));
        }
        if ($this->input->get('cari_bank')) {
            $this->db->where('bank_code', $this->input->get('cari_bank'));
        }
        if ($this->input->get('cari_status')) {
            $this->db->where('flag', $this->input->get('cari_status'));
        }

        $this->db->order_by("created_at", "asc");
        $this->db->limit($limit);

        $query  = $this->db->get();

        return $query->result();
    }

    public function get_pic_detail(): array
    {
        $this->db->select('*');
        $this->db->from('pics');
        $this->db->where('id', $this->input->post('id'));
        $query  = $this->db->get();
        return $query->result_array()[0];

        // return $query->row(0);
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

    public function update_pic()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'bank_code' => $this->input->post('abbr'),
            'flag' => $this->input->post('status'),
            'modified_at' => $this->input->post('modified_at'),
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('pics', $data);
    }

    public function insert_pic_loop(): int
    {

        for($i=0;$i<100;$i++){

            $data = array(
                'name' =>  "tes $i",
                'email' => "tes$i@mantap.com",
                'bank_code' =>  'BCA',
                'flag' =>  1,
                'created_at' => time(),
                'modified_at' =>  time(),
            );
    
            $this->db->insert('pics', $data);
        }

        return 1;
    }
}
