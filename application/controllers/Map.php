<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('gps_model');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }


    public function index()
    {
        $data['title'] = 'Map';
        $data['gps'] = $this->gps_model->get_all();

        $data['js'] = $this->load->view('include/js.php', NULL, TRUE);
        $data['status'] = $this->uri->segment(3);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('map');
        $this->load->view('layout/footer');
    }

    public function store()
    {
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');

        $id = $this->gps_model->updateGps($lat, $long);
        
        redirect(base_url() . 'map/index/success');
    }
}
