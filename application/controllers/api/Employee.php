<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/libraries/REST_Controller.php';

// use namespace
// use Restserver\Libraries\REST_Controller;

use chriskacerguis\RestServer\RestController;

class Employee extends RestController {

    function __construct() {
        parent::__construct();
        $this->load->model('employee_model');
    }

    //Menampilkan data kontak
    function login_post() {
        $username = $this->post('username');
        $password = $this->post('password');

        $login = $this->employee_model->login($username, $password);

        if($login){
            $this->response($login, 200);
        }else{
            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
        
    }


    //Masukan function selanjutnya disini
}
?>