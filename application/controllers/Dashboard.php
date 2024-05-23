<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
        $this->load->model('employee_model');
        $this->load->model('gps_model');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['rows'] = $this->employee_model->get_rows();
        $data['gps'] = $this->gps_model->get_all();

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('dashboard');
		$this->load->view('layout/footer');
	}
}
