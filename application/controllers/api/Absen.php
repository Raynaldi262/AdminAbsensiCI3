<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/libraries/REST_Controller.php';

// use namespace
// use Restserver\Libraries\REST_Controller;

use chriskacerguis\RestServer\RestController;

class Absen extends RestController {

    function __construct() {
        parent::__construct(); 
        $this->load->model('absen_model');
        // log_message("error", var_dump ($this->post()));
    }

    function getData_get(){
        $id = $this->get('id');
        $absen = $this->absen_model->get_all_byId($id);
        if($absen){
            $this->response($absen, 200);
        }else{
            $this->response( [
                'status' => false,
                'message' => 'Absensi Gagal'
            ], 404 );
        }
    }

    function absenIn_get(){
        $id = $this->get('id');
        $dateNow = date("Y-m-d");
        
        $absen = $this->absen_model->searchByEmployee($id, $dateNow);
        
        if($absen){
            $absen = $this->absen_model->updateIn($absen->id);
        }else{
            $absen = $this->absen_model->insertAbsenIn($id, $dateNow);
        }


        if($absen){
            $this->response($absen, 200);
        }else{
            $this->response( [
                'status' => false,
                'message' => 'Absensi Gagal'
            ], 404 );
        }
    }

    function absenOut_get(){
        $id = $this->get('id');
        $dateNow = date("Y-m-d");
        $absen = $this->absen_model->searchByEmployee($id, $dateNow);

        if($absen){
            echo "kosong";
            $absen = $this->absen_model->updateOut($absen->id);
        }else{
            echo "isi";
            $absen = $this->absen_model->insertAbsenOut($id, $dateNow);
        }

        if($absen){
            $this->response($absen, 200);
        }else{
            $this->response( [
                'status' => false,
                'message' => 'Absensi berhasil'
            ], 404 );
        }
    }
}