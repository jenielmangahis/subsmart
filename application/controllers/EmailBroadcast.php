<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EmailBroadcast extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'Email Broadcast';
        $this->page_data['page']->menu = 'email_broadcast';
    }

    public function index()
    {
        $this->load->model('EmailBroadcast_model');
        $this->load->model('EmailBroadcastRecipient_model');

        $cid = logged('company_id');
        $default_name = logged('FName') . ' ' . logged('LName');
        $default_date = date("Y-m-d");
        $emailBroadcasts = $this->EmailBroadcast_model->getAllByCompanyId($cid);   
        
        $emailBroadCastSummary = [];
        foreach( $emailBroadcasts as $b ){
            $emailBroadcastSent    = $this->EmailBroadcastRecipient_model->getAllSentByEmailBroadCastId($b->id);
            $emailBroadcastNotSent = $this->EmailBroadcastRecipient_model->getAllNotSentByEmailBroadCastId($b->id, []);
            $emailBroadCastSummary[$b->id] = ['total_sent' => count($emailBroadcastSent), 'total_not_sent' => count($emailBroadcastNotSent)];
        }

        $this->page_data['optionStatus']    = $this->EmailBroadcast_model->optionStatus();
        $this->page_data['emailBroadcasts'] = $emailBroadcasts;
        $this->page_data['emailBroadCastSummary'] = $emailBroadCastSummary;
        $this->page_data['default_name']    = $default_name;
        $this->page_data['default_date']    = $default_date;
        $this->load->view('v2/pages/email_broadcasts/index', $this->page_data);
    }

    public function ajax_customer_list()
    {
        $this->load->model('AcsProfile_model');

        $cid = logged('company_id');
        $customers = $this->AcsProfile_model->getAllByCompanyId($cid);       

        $this->page_data['customers'] = $customers;
        $this->load->view('v2/pages/email_broadcasts/ajax_customer_list', $this->page_data);
    }

    public function ajax_save_email_broadcast()
    {
        $this->load->model('EmailBroadcast_model');
        $this->load->model('EmailBroadcastRecipient_model');

        $is_success = 1;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['broadcast_name'] == '' ){
            $is_success = 0;
            $msg = 'Please specify broadcast name';
        }

        if( $post['broadcast_subject'] == '' ){
            $is_success = 0;
            $msg = 'Subject is required';
        }

        if( $post['broadcast_content'] == '' ){
            $is_success = 0;
            $msg = 'Email content is required';
        }
        
        if( $post['broadcast_to'] == '' ){
            $is_success = 0;
            $msg = 'Please specify recipient(s) of email broadcast';
        }

        if( $is_success == 1 ){
            $data = [
                'company_id' => $cid,
                'broadcast_name' => $post['broadcast_name'],
                'sender_name' => $post['broadcast_sender_name'],                
                'subject' => $post['broadcast_subject'],
                'preview_text' => $post['broadcast_preview_text'],
                'send_date' => date("Y-m-d",strtotime($post['broadcast_send_time'])),
                'content' => $post['broadcast_content'],
                'status' => $post['status'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $email_broadcast_id = $this->EmailBroadcast_model->saveData($data);            

            $recipients = explode(",", $post['broadcast_to']);
            foreach( $recipients as $email ){
                $data = [
                    'email_broadcast_id' => $email_broadcast_id,
                    'recipient_email' => $email,
                    'is_sent' => 0
                ];

                $this->EmailBroadcastRecipient_model->create($data);
            }
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_send_test_email_broadcast()
    {
        $this->load->model('Business_model');

        $is_success = 1;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        if( $post['broadcast_subject'] == '' ){
            $is_success = 0;
            $msg = 'Subject is required';
        }

        if( $post['broadcast_content'] == '' ){
            $is_success = 0;
            $msg = 'Email content is required';
        }

        if( $is_success == 1 ){
            $company = $this->Business_model->getByCompanyId($cid);

            $preview_text = '';
            if( $post['broadcast_preview_text'] != '' ){
                $preview_text = '<!--[if !gte mso 9]><!----><span style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;">' . $post['broadcast_preview_text'] . ' </span><!--<![endif]-->';
            }

            $subject = $company->business_name . ':' . $post['broadcast_subject'] . $preview_text;

            $body = $this->emailBroadcastEmailHtml($post);
            $mail = email__getInstance();
            $mail->FromName = $post['broadcast_name'];
            $recipient_name = $post['test_email_recipient'];
            $mail->addAddress($recipient_name, $recipient_name);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            
            if(!$mail->Send()){
                $is_success = 1;
                $msg = 'Cannot send email. Please try again later.';
            }
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_preview()
    {
        $this->load->model('EmailBroadcast_model');

        $post = $this->input->post();
        $emailBroadcast =  $this->EmailBroadcast_model->getById($post['ebid']);
        $data = ['broadcast_content' => $emailBroadcast->content];

        $this->page_data['data'] = $data;
        $this->load->view('v2/pages/email_broadcasts/email_broadcast_email_template', $this->page_data);
    }

    public function ajax_pause_sending()
    {
        $this->load->model('EmailBroadcast_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $emailBroadcast =  $this->EmailBroadcast_model->getById($post['ebid']);
        if( $emailBroadcast ){
            $data = ['status' => $this->EmailBroadcast_model->isDraft()];
            $this->EmailBroadcast_model->update($emailBroadcast->id, $data);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);

    }

    public function ajax_resume_sending()
    {
        $this->load->model('EmailBroadcast_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $emailBroadcast =  $this->EmailBroadcast_model->getById($post['ebid']);
        if( $emailBroadcast ){
            $data = ['status' => $this->EmailBroadcast_model->isOngoing()];
            $this->EmailBroadcast_model->update($emailBroadcast->id, $data);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);

    }

    public function ajax_delete_broadcast()
    {
        $this->load->model('EmailBroadcast_model');
        $this->load->model('EmailBroadcastRecipient_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $emailBroadcast =  $this->EmailBroadcast_model->getById($post['ebid']);
        if( $emailBroadcast ){
            $this->EmailBroadcastRecipient_model->deleteAllByEmailBroadcastId($emailBroadcast->id);
            $this->EmailBroadcast_model->delete($emailBroadcast->id);
            
            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);

    }

    public function emailBroadcastEmailHtml($post)
    {
        $this->page_data['data'] = $post;
        return $this->load->view('v2/pages/email_broadcasts/email_broadcast_email_template', $this->page_data, true);
    }

    public function ajax_email_template_list()
    {
        $this->load->model('EmailTemplate_model');

        $cid = logged('company_id');
        $emailTemplates = $this->EmailTemplate_model->getAllByCompanyId($cid);       

        $this->page_data['emailTemplates'] = $emailTemplates;
        $this->load->view('v2/pages/email_broadcasts/ajax_email_template_list', $this->page_data);
    }

    public function ajax_get_email_broadcast()
    {
        $this->load->model('EmailBroadcast_model');
        $this->load->model('EmailBroadcastRecipient_model');

        $post = $this->input->post();
        $cid  = logged('company_id');        
        $emailBroadcast =  $this->EmailBroadcast_model->getByIdAndCompanyId($post['ebid'],$cid);   

        $is_valid = 0;
        $data    = [];       

        if( $emailBroadcast ){
            $is_valid = 1;
            $data = [
                'ebid' => $emailBroadcast->id,
                'broadcast_name' => $emailBroadcast->broadcast_name,
                'sender_name' => $emailBroadcast->sender_name,
                'subject' => $emailBroadcast->subject,
                'preview_text' => $emailBroadcast->preview_text,
                'send_date' => $emailBroadcast->send_date,
                'content' => $emailBroadcast->content,
                'status' => $emailBroadcast->status
            ];

            $recipients = [];
            $emailBroadcastSent = $this->EmailBroadcastRecipient_model->getAllByEmailBroadCastId($emailBroadcast->id);
            if( $emailBroadcastSent ){
                foreach($emailBroadcastSent as $r){
                    $recipients[] = $r->recipient_email;
                }
            }
        } 

        $result = ['is_valid' => $is_valid, 'data' => $data, 'recipients' => $recipients];
        echo json_encode($result);
    }

    public function ajax_update_email_broadcast()
    {
        $this->load->model('EmailBroadcast_model');
        $this->load->model('EmailBroadcastRecipient_model');

        $is_success = 1;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['broadcast_name'] == '' ){
            $is_success = 0;
            $msg = 'Please specify broadcast name';
        }

        if( $post['broadcast_subject'] == '' ){
            $is_success = 0;
            $msg = 'Subject is required';
        }

        if( $post['broadcast_content'] == '' ){
            $is_success = 0;
            $msg = 'Email content is required';
        }
        
        if( $post['broadcast_to'] == '' ){
            $is_success = 0;
            $msg = 'Please specify recipient(s) of email broadcast';
        }

        $eBroadcast =  $this->EmailBroadcast_model->getByIdAndCompanyId($post['ebid'],$cid);  
        if( !$eBroadcast ){
            $is_success = 0;
            $msg = 'Cannot find data';
        }

        if( $is_success == 1 ){
            $data = [
                'broadcast_name' => $post['broadcast_name'],
                'sender_name' => $post['broadcast_sender_name'],                
                'subject' => $post['broadcast_subject'],
                'preview_text' => $post['broadcast_preview_text'],
                'send_date' => date("Y-m-d",strtotime($post['broadcast_send_time'])),
                'content' => $post['broadcast_content'],
                'status' => $post['status'],
                'date_updated' => date("Y-m-d H:i:s")
            ];
            $this->EmailBroadcast_model->update($eBroadcast->id, $data);  
            
            $this->EmailBroadcastRecipient_model->deleteAllByEmailBroadcastId($eBroadcast->id);
            $recipients = explode(",", $post['broadcast_to']);
            foreach( $recipients as $email ){
                $data = [
                    'email_broadcast_id' => $eBroadcast->id,
                    'recipient_email' => $email,
                    'is_sent' => 0
                ];

                $this->EmailBroadcastRecipient_model->create($data);
            }
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }
}
