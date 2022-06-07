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
        $this->load->view('layout/header');
        $this->load->view('layout/, $datanavbar');
        $this->load->view('layout/sidebar');
        $this->load->view('pic/index');
        $this->load->view('layout/footer');
    }

    public function insert()
    {
        $status = $this->uri->segment(3);
        if (!empty($status) && $status === 'success') {
            $data['status'] = "Data PIC berhasil ditambahkan";
        } else if (!empty($status) && $status === 'error') {
            $data['status'] = "Data tidak dapat ditambahkan (Error)";
        } else {
            $data['status'] = 'normal';
        }

        $data['banks'] = $this->bank_model->get_all_bankcode();

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
                'label' => 'Username',
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
                'rules' => 'required'
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {
            $id = $this->pic_model->insert_pic();
            if ($id) {
                $this->pic_model->insert_pic();
                redirect(base_url() . 'pic/insert/success');
            } else {
                log_message('error', $this->db->error());
                redirect(base_url() . 'pic/insert/error');
            }

            // try {
            //     $this->pic_model->insert_pic();
            //     redirect(base_url() . 'pic/insert/success');
            // } catch (Exception $e) {
            //     log_message('error', $this->db->error());
            //     redirect(base_url() . 'pic/insert/error');
            // }
        } else {
            $this->insert();    // klo gak lulus validasi
        }
    }
}
