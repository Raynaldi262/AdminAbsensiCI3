<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bank_model');
        $this->load->model('pic_model');
        $this->load->library('phpmail');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('email');
        $this->load->view('layout/footer');
    }

    public function sendmail()
    {
        if ($this->input->is_ajax_request()) {

            try {

                $mail = $this->phpmail->load();
                $mail->clearAddresses();
                $mail->clearAttachments();
                $mail->isSMTP();                //Sets Mailer to send message using SMTP
                $mail->Host = 'mail.primacom.co.id';    //Sets the SMTP hosts of your Email hosting, this for Godaddy
                $mail->Port = 25;                //Sets the default SMTP server port
                $mail->SMTPAuth = false;              //Sets SMTP authentication. Utilizes the Username and Password variables
                $mail->Username = '';          //Sets SMTP username
                $mail->Password = '';          //Sets SMTP password
                $mail->SMTPSecure = 'tls';              //Sets connection prefix. Options are "", "ssl" or "tls"
                $mail->From = 'tleonardo@rintis.co.id';      //Sets the From email address for the message
                $mail->FromName = "Edooo";          //Sets //Adds a "From" name
                $mail->WordWrap = 5000;              //Sets word wrapping on the body of the message to a given number of characters
                $mail->IsHTML(true);              //Sets message type to HTML
                $mail->addAttachment($_FILES['attachment']['tmp_name'],$_FILES['attachment']['name']);
                $mail->Body = $this->input->post('body') ? $this->input->post('body') : " ";
                $mail->Subject = $this->input->post('subject') ? $this->input->post('subject') : "No Subject";

                
                // $tmp_to = $this->pic_model->get_all_active_pic_email();
                $tmp_cc = $this->pic_model->get_all_active_pic_email2();
                // $tmp_bcc = $this->pic_model->get_all_active_pic_email3();
                // foreach ($tmp_to as $data) {
                //     $mail->AddAddress($data->email, $data->name);
                // }
                $mail->AddAddress('rgsetiawan@rintis.co.id', 'asd');
                $length = count((array)$tmp_cc);
                $temp = ceil($length / 20);
                // var_dump($temp);
                // die;
                // for($i = 0; $i < $temp;$i++){
                // }
                    $i = 0;
                    $c = 1;
                foreach ($tmp_cc as $data) {
                    $mail->AddCC($data->email, $data->name);
                    if($i == 20){
                        $mail->send();
                        $mail->clearCCs();
                        $c++;
                        $i = 0;
                    }
                    if($c == $temp){
                        $mail->send();
                    }
                    $i++;
                }
                // foreach ($tmp_bcc as $data) {
                //     $mail->addBCC($data->email, $data->name);
                // }
                

                $msg = ['sukses'=>"Email Berhasil Terkirim"];
            } catch (Exception $e) {
                $msg = ['error'=>"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"];
            }
            echo json_encode($msg);
        }
    }
}
