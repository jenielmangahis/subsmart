<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MYF_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->checkLogin(1);
		$this->page_data['page']->title = 'nSmart - Contact';
	}

	public function index(){
		$this->load->view('contact', $this->page_data);
	}

	public function support(){
		$this->load->view('support', $this->page_data);
	}

	public function ajax_support_send_email(){
		$is_sent = 0;
		$post    = $this->input->post();

		$subject = 'NsmartTrac : Support';
        $to   = 'bryann.revina03@gmail.com';
        $cc   = '';
        //$to   = 'support@nsmartrac.com';
        //$cc   = 'jpabanil@icloud.com';
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
