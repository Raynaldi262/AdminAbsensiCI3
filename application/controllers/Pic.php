<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bank_model');
        $this->load->model('pic_model');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }


    public function index()
    {
        $data['banks'] = $this->bank_model->get_all_bankcode();
        $data['pics'] = $this->pic_model->get_pic_limited(50);

        $data['js'] = $this->load->view('include/js.php', NULL, TRUE);
        $this->load->view('layout/header');
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('pic/index', $data);
        $this->load->view('layout/footer');
    }

    public function insert()
    {
        $data['status'] = $this->uri->segment(3);
        $data['banks'] = $this->bank_model->get_all_bankcode();

        $data['js'] = $this->load->view('include/js.php', NULL, TRUE);
        $this->load->view('layout/header');
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('pic/create', $data);
        $this->load->view('layout/footer');
    }

    public function store()
    {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'required|is_unique[pics.name]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required',
            ),
            array(
                'field' => 'abbr',
                'label' => 'Kode Bank',
                'rules' => 'required',
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {
            $id = $this->pic_model->insert_pic();
            if ($id) {
                redirect(base_url() . 'pic/insert/success');
            } else {
                log_message('error', $this->db->error());
                redirect(base_url() . 'pic/insert/error');
            }
        } else {
            $this->insert();    // klo gak lulus validasi
        }
    }

    public function show()
    {
        if ($this->input->is_ajax_request()) {
            $pic = $this->pic_model->get_pic_detail();
            echo json_encode($pic);
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
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required',
                ),
                array(
                    'field' => 'abbr',
                    'label' => 'Kode Bank',
                    'rules' => 'required',
                ),
            );

            $this->form_validation->set_rules($config);

            $msg = [];

            if ($this->form_validation->run() == TRUE) {
                $this->pic_model->update_pic();
            } else {
                $msg = [
                    'error' => [
                        'name' => form_error('name'),
                        'email' => form_error('email')
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function get_bankcode()
    {
        $banks = $this->bank_model->get_bankcode();
        echo json_encode($banks);
    }
}
