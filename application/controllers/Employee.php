<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}

        $this->load->model('employee_model');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index()
    {
        $data['title'] = 'Employee';

        $nama = $this->input->get('cari_nama');
		$status = $this->input->get('cari_status');
        
        if(!empty($nama)){
            $data['employee'] = $this->employee_model->searchByName();
        }else{
            $data['employee'] = $this->employee_model->get_all();
        }

        $data['js'] = $this->load->view('include/js.php', NULL, TRUE);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('employee/index');
        $this->load->view('layout/footer');
    }

    public function show()
    {
        if ($this->input->is_ajax_request()) {
            $employee = $this->employee_model->get_employee_detail();
            echo json_encode($employee);
        }
    }

    public function update()
    {
        if ($this->input->is_ajax_request()) {
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'Username',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'address',
                    'label' => 'Address',
                    'rules' => 'required',
                ),
                array(
                    'field' => 'phone',
                    'label' => 'Phone',
                    'rules' => 'required',
                ),
                array(
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'required',
                ),
            );

            $this->form_validation->set_rules($config);

            $msg = [];

            if ($this->form_validation->run() == TRUE) {
                $this->employee_model->update_employee();
            } else {
                $msg = [
                    'error' => [
                        'name' => form_error('name'),
                        'address' => form_error('address')
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function delete(){
        $msg = [];

        $this->employee_model->delete_employee();
        echo json_encode($msg);
    }

}
