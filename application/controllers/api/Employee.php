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
        // log_message("error", var_dump ($this->post()));
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


    function user_get() {
        $id = $this->get('id');

        $user = $this->employee_model->user($id);

        if($user){
            $this->response($user, 200);
        }else{
            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
        
    }

    function update_post(){

        $data = array(
            'name' => $this->post('name'),
            'address' => $this->post('address'),
            'phone' => $this->post('phone'),
            'password' => $this->post('password')
        );
        
        $id = $this->post('id');
        $update = $this->employee_model->update($data, $id);

        if($update){
            $this->response($login, 200);
        }else{
            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }

}
?>