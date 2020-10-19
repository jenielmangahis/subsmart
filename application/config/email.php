<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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


