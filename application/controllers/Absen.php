<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}

        $this->load->model('absen_model');
        $this->load->model('employee_model');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index()
    {
        $data['title'] = 'Absen';

        $name = $this->input->get('name');
        $date = $this->input->get('date');
        
        if(!empty($nama) || !empty($date)){
            $data['absen'] = $this->absen_model->search($name, $date);
        }else{
            $data['absen'] = $this->absen_model->get_all();
        }

        $data['js'] = $this->load->view('include/js.php', NULL, TRUE);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('absen/index');
        $this->load->view('layout/footer');
    }
}