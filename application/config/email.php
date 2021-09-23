<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp', 
    'smtp_host' => '192.168.1.20', 
    'smtp_port' => '587',
    'smtp_user' => 'support@modena.co.id',
    'smtp_pass' => 'sp_328_indomo',
    'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE,
);