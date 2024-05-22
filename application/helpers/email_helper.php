<?php

function email__getInstance($config = [])
{
    $config = array_replace([
        'isHTML' => true,
        'subject' => 'nSmarTrac',
    ], $config);

    $host = 'smtp.gmail.com';
    $port = 465;
    $username = 'sales@nsmartrac.com';
    $password = 'bysebhxwxgheiryb';
    $from = $username;
    $subject = $config['subject'];

    include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->getSMTPInstance()->Timelimit = 5;
    $mail->Host = $host;
    $mail->SMTPAuth = true;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = 'ssl';
    $mail->Timeout = 10; // seconds
    $mail->Port = $port;
    $mail->From = $from;
    if( $config['from_name'] == '' ){
        $mail->FromName = 'nSmarTrac';    
    }else{
        $mail->FromName = $config['from_name'];    
    }

    if( $config['cc'] ){
        foreach($config['cc'] as $email){
            $mail->AddCC($email, $$email);
        }
    }
    
    $mail->Subject = $subject;
    $mail->IsHTML($config['isHTML']);

    if (emai__isLocalhost()) {
        // Send using gmail
        $mail->isSMTP();
        $mail->Host = 'tls://smtp.gmail.com:587';
        $mail->port = 587;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
    }

    return $mail;
}


function emai__isLocalhost(): bool
{
    $whitelist = ['127.0.0.1', '::1'];
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}
