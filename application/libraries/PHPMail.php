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

        require_once 'vendor/phpmailer/src/PHPMailer.php';
        require_once 'vendor/phpmailer/src/SMTP.php';
        require_once 'vendor/phpmailer/src/Exception.php';

        $mail = new PHPMail;
        return $mail;
    }
}
