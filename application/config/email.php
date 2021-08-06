<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  API Connectors Credentials
| -------------------------------------------------------------------
*/
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'mail.smtp2go.com';
$config['smtp_port'] = '587'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
$config['smtp_crypto'] = 'tls';
$config['smtp_user'] = 'nsmartrac@gmail.com';
$config['smtp_pass'] = 'nSmarTrac2020';
$config['charset'] = 'iso-8859-1';
$config['mailtype'] = 'html';
$config['newline'] = "rn";
$config['wordWrap'] = true;
$config['mailpath'] = '/usr/sbin/sendmail';

///Mailtrap Account => hamita4085@biohorta.com
  $config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => 2525,
    'smtp_user' => '48383e4249a71f',
    'smtp_pass' => 'b01900e0930b3e',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'mailtype' => "html"
  );
