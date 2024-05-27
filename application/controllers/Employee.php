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

    public function create()
    {
        $data['status'] = $this->uri->segment(3);
        $data['title'] = 'Tambahkan Employee';

        $data['js'] = $this->load->view('include/js.php', NULL, TRUE);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('employee/create');
        $this->load->view('layout/footer');
    }


    public function store()
    {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'required|is_unique[employee.name]'
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
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|is_unique[employee.username]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {
            
            $t=time() . substr($_FILES['avatar']['name'], -4);

            $config['upload_path']          = FCPATH.'/upload/';
            $config['allowed_types']        = 'jpg|jpeg|png';
            $config['file_name']            = $t;
            $config['overwrite']            = true;
            $config['max_size']             = 2048; // 1MB
            $config['max_width']            = 2080;
            $config['max_height']           = 2080;

            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('avatar')) {
                $data['error'] = $this->upload->display_errors();
                redirect(base_url() . 'employee/create/error');
            } else {
                $uploaded_data = $this->upload->data();
            }


            $avatar = $t;
            $id = $this->employee_model->insert($avatar);

            if ($id) {
                $config['image_library'] = 'gd2';
                $config['source_image'] = $config['upload_path'].$t;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 300;
                $config['height']       = 300;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
                redirect(base_url() . 'employee/create/success');
            } else {
                log_message('error', $this->db->error());
                redirect(base_url() . 'employee/create/error');
            }
        } else {
            $this->create();    // klo gak lulus validasi
        }
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
            
            $msg = [];
            $t=""; 

            if(!empty($_FILES['avatar']['name']))
            {
                if(!empty($this->input->post('avatarId')))
                    array_map('unlink', glob(FCPATH.'/upload/'.$this->input->post('avatarId')));
                
                $t=time() . substr($_FILES['avatar']['name'], -4);
                $config['upload_path']          = FCPATH.'/upload/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['file_name']            = $t;
                $config['overwrite']            = true;
                $config['max_size']             = 2048; // 1MB
                $config['max_width']            = 2080;
                $config['max_height']           = 2080;
                
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('avatar')) {
                    $msg = [
                        'error' => [
                            'name' => form_error('name'),
                            'address' => form_error('address'),
                            'errors' => $this->upload->display_errors()
                        ]
                    ];
                } else {
                    $uploaded_data = $this->upload->data();
                }
                $config['image_library'] = 'gd2';
                $config['source_image'] = $config['upload_path'].$t;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 300;
                $config['height']       = 300;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }
            $this->employee_model->update_employee($t);
            
            echo json_encode($msg);
        }
    }

    public function delete(){
        $msg = [];

        if(!empty($this->input->post('avatar')))
            array_map('unlink', glob(FCPATH.'/upload/'.$this->input->post('avatar')));

        $this->employee_model->delete_employee();
        
        echo json_encode($msg);
    }
}
