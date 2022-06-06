<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('dashboard');
		$this->load->view('layout/footer');
	}
}
