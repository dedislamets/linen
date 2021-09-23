<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class PHPMailer_Lib
{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load(){
        // Include PHPMailer library files
        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host     = '192.168.1.20';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@modena.co.id';
        $mail->Password = 'sp_328_indomo';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
        $mail->isHTML(true);
        $mail->Mailer="smtp";
        $mail->SMTPOptions=array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('support@modena.co.id', 'Support Modena');
        // $mail->addReplyTo('info@example.com', 'CodexWorld');
        // $mail->addCC('cc@example.com');
        $mail->addBCC('support@modena.co.id');
        $mail->addBCC('dedi.supatman@modena.co.id');
        return $mail;
    }

}