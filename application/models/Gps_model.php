<?php
class Gps_model extends CI_Model
{
    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('gps');
        $query = $this->db->get();
        return $query->row();
    }

    public function updateGps($lat, $long)
    {
        $data = array(
            'lat' => $lat,
            'long' => $long
        );

        $this->db->update('gps', $data);
    }
}