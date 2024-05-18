<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/libraries/REST_Controller.php';

// use namespace
// use Restserver\Libraries\REST_Controller;

use chriskacerguis\RestServer\RestController;

class Gps extends RestController {

    function __construct() {
        parent::__construct(); 
        $this->load->model('gps_model');
        // log_message("error", var_dump ($this->post()));
    }

    function index_get(){
        $gps = $this->gps_model->get_all();

        if($gps){
            $this->response($gps, 200);
        }else{
            $this->response( [
                'status' => false,
                'message' => 'Cordinate not found'
            ], 404 );
        }
    }

}