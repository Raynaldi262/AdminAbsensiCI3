<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMail
{
    public function __construct()
    {
        log_message('debug', 'PHPMailer class loaded');
    }

    public function load()
    {
        require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
        require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
        // $mail = new PHPMailer(true);
        $mail = new PHPMailer;
        return $mail;
    }
}
