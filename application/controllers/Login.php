<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->model('auth_model');

        $username = $this->input->post('username');
		$password = $this->input->post('password');

        if(!empty($username) && !empty($password)){
            if($this->auth_model->login($username, $password)){
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message_login_error', 'Username atau Password salah!');
            }
        }
		

        $this->load->view('login');
    }

    public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect(site_url());
	}
}
