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
        $mail = $this->phpmail->load();
        $mail->clearAddresses();
        $mail->clearAttachments();
        $mail->isSMTP();                //Sets Mailer to send message using SMTP
        $mail->Host = 'mail.primacom.co.id';    //Sets the SMTP hosts of your Email hosting, this for Godaddy
        $mail->Port = '25';                //Sets the default SMTP server port
        $mail->SMTPAuth = true;              //Sets SMTP authentication. Utilizes the Username and Password variables
        $mail->Username = '';          //Sets SMTP username
        $mail->Password = '';          //Sets SMTP password
        $mail->SMTPSecure = 'tls';              //Sets connection prefix. Options are "", "ssl" or "tls"
        $mail->From = 'tleonardo@rintis.co.id';      //Sets the From email address for the message
        $mail->FromName = "Edooo";          //Sets //Adds a "To" address
        $mail->WordWrap = 5000;              //Sets word wrapping on the body of the message to a given number of characters
        $mail->IsHTML(true);              //Sets message type to HTML
        $mail->AddAddress('rgsetiawan@rintis.co.id');
        $mail->Subject = "duarr";
        $mail->Body = "mantappp";
        // $string = $ci->load->view('email/orderSucces', $data, true);
        // $mail->Body = $string;
        return $mail->send();
    }
}
