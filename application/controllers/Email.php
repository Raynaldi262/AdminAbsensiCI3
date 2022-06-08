<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
{
    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('email');
        $this->load->view('layout/footer');
    }
}
