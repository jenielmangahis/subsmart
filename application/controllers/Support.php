<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Support extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {
        $this->load->model('Users_model');

        $user_id = getLoggedUserID();
        $user    = $this->Users_model->getUser($user_id);

        $this->page_data['user'] = $user;
        $this->load->view('support/index', $this->page_data);
    }

    public function ajax_send_email()
    {
        $is_sent = 0;
        $post    = $this->input->post();

        $subject = 'NsmartTrac : Support';
        //$to   = 'bryann.revina03@gmail.com';
        $to   = 'support@nsmartrac.com';    
        $cc   = 'jpabanil@icloud.com';
        $body = 'Someone send a support ticket via our app. Below are the details.';
        $body .= '<table>';
            $body .= '<tr>';
                $body .='<td>Firstname</td><td>'.$post['support_firstname'].'</td>';
            $body .= '</tr>';
            $body .= '<tr>';
                $body .='<td>Lastname</td><td>'.$post['support_lastname'].'</td>';
            $body .= '</tr>';
            $body .= '<tr>';
                $body .='<td>Email</td><td>'.$post['support_email'].'</td>';
            $body .= '</tr>';
            $body .= '<tr>';
                $body .='<td>Subject</td><td>'.$post['support_subject'].'</td>';
            $body .= '</tr>';
            $body .= '<tr>';
                $body .='<td>Message</td><td>'.$post['support_message'].'</td>';
            $body .= '</tr>';
        $body .= '</table>';

        $data = [
            'to' => $to, 
            'subject' => $subject, 
            'body' => $body,
            'cc' => $cc,
            'bcc' => '',
            'attachment' => ''
        ];

        $isSent = sendEmail($data);
        if( $isSent['is_valid'] ){
            $is_sent = 1;
        }

        $json = ['is_sent' => $is_sent];
        echo json_encode($json);
    }
}
