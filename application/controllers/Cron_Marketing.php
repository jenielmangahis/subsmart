<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron_Marketing extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sms_campaigns()
    {
        $this->load->model('SmsBlast_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('SmsLogs_model');
        $this->load->model('SmsBlastSendTo_model');

        $condition[] = ['field' => 'send_date <=', 'value' => date("Y-m-d")];
        $smsBlast   = $this->SmsBlast_model->getAllIsPaidAndNotSent($condition);
        $total_sent = 0;
        foreach ($smsBlast as $sms) {
            $sms_sent = 0;
            switch ($sms->sending_type) {
                case $this->SmsBlast_model->sendingTypeAll():
                    $condition = array();
                    if ($sms->customer_type == $this->SmsBlast_model->customerTypeResidential()) {
                        $condition[] = ['customer_type' => 'Residential'];
                    } elseif ($sms->customer_type == $this->SmsBlast_model->customerTypeCommercial()) {
                        $condition[] = ['customer_type' => 'Commercial'];
                    }

                    $contacts = $this->AcsProfile_model->getAllByCompanyId($sms->company_id, $condition);
                    
                    foreach ($contacts as $c) {
                        $to_number = $this->cleanMobileNumber($c->phone_m);
                        $result    = $this->sendSms($to_number, $sms->sms_text);
                        if ($result['is_sent']) {
                            $sms_sent++;
                            $total_sent++;
                        }

                        //Log to sms_sent
                        $data_logs = [
                            'user_id' => $sms->user_id,
                            'sms_id' => $sms->id,
                            'sms_type' => 'Campaign',
                            'from_number' => RINGCENTRAL_FROM,
                            'to_number' => $to_number,
                            'sms_message' => $sms->sms_text,
                            'is_sent' => $result['is_sent'],
                            'error_message' => $result['msg'],
                            'date_created' => date("Y-m-d H:i:s")
                        ];

                        $this->SmsLogs_model->create($data_logs);
                    }
                    break;
                case $this->SmsBlast_model->sendingTypeContactGroups():
                    $sendTo = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms->id);
                    foreach ($sendTo as $st) {
                        $condition[] = ['customer_group_id' => $st->customer_group_id];
                        $contact = $this->AcsProfile_model->getAllByCompanyId($sms->company_id, $condition);
                        foreach ($contact as $c) {
                            $to_number = $this->cleanMobileNumber($c->phone_m);
                            $result    = $this->sendSms($to_number, $sms->sms_text);
                            if ($result['is_sent']) {
                                $sms_sent++;
                                $total_sent++;
                            }

                            //Log to sms_sent
                            $data_logs = [
                                'user_id' => $sms->user_id,
                                'sms_id' => $sms->id,
                                'sms_type' => 'Campaign',
                                'from_number' => RINGCENTRAL_FROM,
                                'to_number' => $to_number,
                                'sms_message' => $sms->sms_text,
                                'is_sent' => $result['is_sent'],
                                'error_message' => $result['msg'],
                                'date_created' => date("Y-m-d H:i:s")
                            ];
                            $this->SmsLogs_model->create($data_logs);
                        }
                    }
                    break;

                case $this->SmsBlast_model->sendingTypeCertainContact():
                    $sendTo = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms->id);
                    foreach ($sendTo as $st) {
                        $condition[] = ['phone_m !=' => ''];
                        $contact = $this->AcsProfile_model->getByProfId($st->customer_id, $condition);
                        if ($contact) {
                            $to_number = $this->cleanMobileNumber($contact->phone_m);
                            $result    = $this->sendSms($to_number, $sms->sms_text);
                            if ($result['is_sent']) {
                                $sms_sent++;
                                $total_sent++;
                            }

                            //Log to sms_sent
                            $data_logs = [
                                'user_id' => $sms->user_id,
                                'sms_id' => $sms->id,
                                'sms_type' => 'Campaign',
                                'from_number' => RINGCENTRAL_FROM,
                                'to_number' => $to_number,
                                'sms_message' => $sms->sms_text,
                                'is_sent' => $result['is_sent'],
                                'error_message' => $result['msg'],
                                'date_created' => date("Y-m-d H:i:s")
                            ];
                            $this->SmsLogs_model->create($data_logs);
                        }
                    }

                    break;
                default:
                    break;

                sleep(1);
            }
            exit;
            if ($sms_sent > 0) {
                $sms_data = ['is_sent' => 1, 'date_sent' => date("Y-m-d")];
                $this->SmsBlast_model->updateSmsBlast($sms->id, $sms_data);
            }
        }

        echo "Total sent sms " . $total_sent;
        exit;
    }

    public function sms_automation()
    {
        $this->load->model('SmsAutomation_model');

        $conditions[] = ['field' => 'sms_automation.is_paid', 'value' => 0];
        $smsAutomation = $this->SmsAutomation_model->getAllActive($conditions);
        foreach ($smsAutomation as $sms) {
            switch ($sms->rule_event) {
                case $this->SmsAutomation_model->ruleEstimateSubmitted():
                    
                    break;
                case $this->SmsAutomation_model->ruleInvoicePaid():
                    break;
                case $this->SmsAutomation_model->ruleInvoiceDue():
                    break;
                case $this->SmsAutomation_model->ruleWorkOrderCompleted():
                    break;
                default:
                    break;
            }
        }
    }

    public function email_campaign()
    {
        $this->load->model('EmailBlast_model');
        $this->load->model('EmailBlastSendTo_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Business_model');
        $this->load->model('EmailLogs_model');

        $emailCampaigns = $this->EmailBlast_model->getAllIsPaidAndNotSent(50);
        foreach ($emailCampaigns as $e) {
            $total_sent = 0;
            $company    = $this->Business_model->getByCompanyId($e->company_id);
            switch ($e->sending_type) {
                case $this->EmailBlast_model->sendingTypeAll():
                    $conditions[] = ['field' => 'email !=', 'value' => ''];
                    $contacts = $this->AcsProfile_model->getAllByCompanyId($e->company_id, $conditions);
                    foreach ($contacts as $c) {
                        $result = $this->sendEmail($c->email, $e->email_subject, $e->email_body, $company);
                        if ($result['is_sent'] == 1) {
                            $total_sent++;
                        }

                        $data_logs = [
                            'user_id' => $e->user_id,
                            'to_email' => $c->email,
                            'from_email' => MAIL_FROM,
                            'subject' => $e->subject,
                            'message' => $e->email_body,
                            'is_sent' => $result['is_sent'],
                            'error_message' => $result['err_msg']
                        ];

                        $this->EmailLogs_model->create($data_logs);
                    }
                    break;
                case $this->EmailBlast_model->sedingTypeCustomerGroup():
                    $sendTo = $this->EmailBlastSendTo_model->getAllByEmailBlastId($e->id);
                    foreach ($sendTo as $st) {
                        $condition[] = ['customer_group_id' => $st->customer_group_id];
                        $contact = $this->AcsProfile_model->getAllByCompanyId($e->company_id, $condition);
                        foreach ($contact as $c) {
                            if ($c->email != '') {
                                $result = $this->sendEmail($c->email, $e->email_subject, $e->email_body, $company);
                                if ($result['is_sent'] == 1) {
                                    $total_sent++;
                                }

                                $data_logs = [
                                    'user_id' => $e->user_id,
                                    'to_email' => $c->email,
                                    'from_email' => MAIL_FROM,
                                    'subject' => $e->subject,
                                    'message' => $e->email_body,
                                    'is_sent' => $result['is_sent'],
                                    'error_message' => $result['err_msg']
                                ];

                                $this->EmailLogs_model->create($data_logs);
                            }
                        }
                    }
                    break;
                case $this->EmailBlast_model->sendingTypeCertainCustomer():
                    $sendTo = $this->EmailBlastSendTo_model->getAllByEmailBlastId($e->id);
                    foreach ($sendTo as $s) {
                        $conditions[] = ['field' => 'email !=', 'value' => ''];
                        $contact = $this->AcsProfile_model->getByProfId($s->customer_id, $conditions);
                        if ($contact) {
                            $result = $this->sendEmail($contact->email, $e->email_subject, $e->email_body, $company);
                            if ($result['is_sent'] == 1) {
                                $total_sent++;
                            }

                            $data_logs = [
                                'user_id' => $e->user_id,
                                'to_email' => $contact->email,
                                'from_email' => MAIL_FROM,
                                'subject' => $e->email_subject,
                                'message' => $e->email_body,
                                'is_sent' => $result['is_sent'],
                                'error_message' => $result['err_msg']
                            ];

                            $this->EmailLogs_model->create($data_logs);
                        }
                    }
                    break;
                default:
                    break;
            }

            if ($total_sent > 0) {
                $email_campaign_data = ['is_sent' => 1, 'date_sent' => date("Y-m-d")];
                $this->EmailBlast_model->updateEmailBlast($e->id, $email_campaign_data);
            }
        }

        echo "Done";
    }

    public function sendEmail($to, $subject, $message, $company)
    {

        $this->page_data['company']    = $company;
        $this->page_data['email_body'] = replaceSmartTags($message);
        $msg = $this->load->view('cron_marketing/email_campaign_template', $this->page_data, true);

        $data = [
            'to' => $to, 
            'subject' => $subject, 
            'body' => $msg,
            'cc' => '',
            'bcc' => '',
            'attachment' => ''
        ];

        $isSent = sendEmail($data);
        $return = ['is_sent' => 1, 'err_msg' => ''];

        return $return;
    }

    public function sendSms($to_number, $message)
    {
        include_once APPPATH . 'libraries/ringcentral_lite/src/ringcentrallite.php';

        $message = replaceSmartTags($message);

        $rc = new RingCentralLite(
            RINGCENTRAL_CLIENT_ID, //Client id
            RINGCENTRAL_CLIENT_SECRET, //Client secret
            RINGCENTRAL_DEV_URL //server url
        );
         
        $res = $rc->authorize(
            RINGCENTRAL_USER, //username
            RINGCENTRAL_PASSWORD, //extension
            RINGCENTRAL_EXT
        ); //password

        $params = array(
            'json'     => array(
                'to'   => array( array('phoneNumber' => $to_number) ), //Send to
                'from' => array('phoneNumber' => RINGCENTRAL_USER), //Username
                'text' => $message
            )
        );

        $res = $rc->post('/restapi/v1.0/account/~/extension/~/sms', $params);
        $is_sent = false;
        $msg     = '';

        if (isset($res['errorCode'])) {
            $msg = $res['errorCode'] . " " . $res['message'];
        } else {
            $is_sent = true;
        }

        $return = ['is_sent' => $is_sent, 'msg' => $msg];

        return $return;
    }

    public function cleanMobileNumber($mobile_number)
    {
        $mobile_number = str_replace("-", "", $mobile_number);
        $mobile_number = str_replace(" ", "", $mobile_number);
        $mobile_number = str_replace("(", "", $mobile_number);
        $mobile_number = str_replace(")", "", $mobile_number);

        return $mobile_number;
    }

    public function test_sms()
    {
        $this->load->library('RingCentral');
        $message  = 'Sample Text Message';
        $platform = $this->ringcentral->getPlatform();
        $platform->login('+18504780530', '', 'Ringmybell2021');
        $apiResponse = $platform->post('/account/~/extension/~/sms', array(
            'from' => array('phoneNumber' => '+18504780530'),
            'to' => array(
                array('phoneNumber' => '+18504780530'),
            ),
            'text' => $message,
        ));
        echo "<pre>";
        print_r($apiResponse);
        exit;
    }
    
    public function clockin_clockout_sms()
    {
        $phone_number = $this->input->post("phone_number");
        $message = $this->input->post("message");
        $res=$this->sendSms($phone_number, $message);
        $data = new stdClass();
        $data->phone_number = $phone_number;
        $data->message = $message;
        $data->result = $res;
        echo json_encode($data);
    }

    public function sendBroadcastEmail()
    {
        $this->load->model('EmailBroadcast_model');
        $this->load->model('EmailBroadcastRecipient_model');
        $this->load->model('Business_model');
        $this->load->model('CalendarSettings_model');

        $is_live_mail_credentials = true;

        $total_updated = 0;
        $total_sent    = 0;

        $limit = 5;
        //$conditions[] = ['field' => 'send_date', 'value' => date("Y-m-d")];
        $emailBroadcast = $this->EmailBroadcast_model->getAllOngoingBroadcast($conditions, $limit);

        if( $emailBroadcast ){
            $mail = email__getInstance();
            foreach($emailBroadcast as $eb){

                $default_timezone    = 'America/New_York';
                $settings = $this->CalendarSettings_model->getByCompanyId($eb->company_id);
                if( $settings && $settings->timezone != '' ){
                    $default_timezone = $settings->timezone;
                }
                date_default_timezone_set($default_timezone); 

                if(strtotime($eb->send_date) <= strtotime(date('Y-m-d'))) { 
                    $company = $this->Business_model->getByCompanyId($eb->company_id);

                    $limit = 5;
                    $emailBroadcastrecipients = $this->EmailBroadcastRecipient_model->getAllNotSentByEmailBroadCastId($eb->id, [], $limit);

                    if( $emailBroadcastrecipients ){                    
                        foreach($emailBroadcastrecipients as $r ){
                            if( $r->recipient_email != '' ){

                                $preview_text = '';
                                if( $eb->preview_text != '' ){
                                    $preview_text = '';
                                }
                                
                                $subject = $company->business_name . ':' . $eb->content . $preview_text;
                                $post['broadcast_content'] = $eb->content;

                                if($is_live_mail_credentials) {

                                    $body = $this->emailBroadcastEmailHtml($post);                                                    
                                    $mail->FromName = $eb->sender_name;                            
                                    $mail->addAddress($r->recipient_email, $r->recipient_email);
                                    $mail->isHTML(true);
                                    $mail->Subject = $subject;
                                    $mail->Body = $body;
                                    
                                    if(!$mail->Send()){
                                        $email_broadcast_recipient_data = ['is_sent' => 0, 'is_with_error' => 1, 'error_message' => 'SMTP sending error'];
                                    }else{
                                        $total_sent++;
                                        $email_broadcast_recipient_data = ['is_sent' => 1, 'date_sent' => date("Y-m-d H:i:s"), 'is_with_error' => 0, 'error_message' => ''];
                                    } 
                                    
                                    $total_updated++;
                                    $this->EmailBroadcastRecipient_model->update($r->id, $email_broadcast_recipient_data);                           

                                } else {

                                    $host     = 'smtp.mailtrap.io';
                                    $port     = 2525;
                                    $username = 'd7c92e3b5e901d';
                                    $password = '203aafda110ab7';
                                    $from     = 'noreply@nsmartrac.com';       
                                    
                                    $mail = new PHPMailer;
                                    $mail->isSMTP();
                                    $mail->Host = $host;
                                    $mail->SMTPAuth = true;
                                    $mail->Username = $username;
                                    $mail->Password = $password;
                                    $mail->SMTPSecure = 'tls';
                                    $mail->Port = $port;            
                                                        
                                    $body = $this->emailBroadcastEmailHtml($post);                                                    
                                    $mail->FromName = $eb->sender_name;        
                                    
                                    $mail->setFrom('noreply@nsmartrac.com', 'nSmartrac');

                                    $mail->addAddress($r->recipient_email, $r->recipient_email);
                                    $mail->isHTML(true);
                                    $mail->Subject = $subject;
                                    $mail->Body = $body;
                                    
                                    if(!$mail->Send()){
                                        $email_broadcast_recipient_data = ['is_sent' => 0, 'is_with_error' => 1, 'error_message' => 'SMTP sending error'];
                                    }else{
                                        $total_sent++;
                                        $email_broadcast_recipient_data = ['is_sent' => 1, 'date_sent' => date("Y-m-d H:i:s"), 'is_with_error' => 0, 'error_message' => ''];
                                    } 
                                    
                                    $total_updated++;
                                    $this->EmailBroadcastRecipient_model->update($r->id, $email_broadcast_recipient_data);
                                }                            
                            }
                        }
                    }

                    //Update to complete if all is sent
                    $conditions2[] = ['field' => 'is_with_error', 'value' => 0];
                    $emailBroadcastIsNotSent = $this->EmailBroadcastRecipient_model->getAllNotSentByEmailBroadCastId($eb->id, $conditions2);                
                    if( count($emailBroadcastIsNotSent) == 0 ){
                        $email_broadcast_data = ['status' => $this->EmailBroadcast_model->isCompleted()];
                        $this->EmailBroadcast_model->update($eb->id, $email_broadcast_data);
                    }
                }
                 

            }
        }

        echo "Total Sent {$total_sent} <br /> Total Updated {$total_updated}";
    }

    public function emailBroadcastEmailHtml($post)
    {
        $this->page_data['data'] = $post;
        return $this->load->view('v2/pages/email_broadcasts/email_broadcast_email_template', $this->page_data, true);
    }

    public function cronDealsStealsSendMails()
    {
        $this->load->model('DealsStealsSentMail_model');

        $total_sent = 0;

        $conditions[] = ['field' => 'is_sent', 'value' => '0'];
        $conditions[] = ['field' => 'error_message', 'value' => ''];
        $order_by  = ['field' => 'id', 'ASC'];
        $sendMails = $this->DealsStealsSentMail_model->getAll($conditions,[], $order_by, 200);
        foreach($sendMails as $s){
            $mail = email__getInstance();
            $mail->FromName = 'nSmarTrac';
            $mail->addAddress($s->email, $s->email);
            $mail->isHTML(true);
            $mail->Subject = "nSmartrac: " . $s->subject;
            $mail->Body = $s->message;

            if ($mail->Send()) {
                $err_msg = $mail->ErrorInfo;
                $data = [
                    'date_sent' => date("Y-m-d"),
                    'is_sent' => 1,
                    'error_message' => ''
                ];

                $this->DealsStealsSentMail_model->update($s->id, $data);

                $total_sent++;
            }else{
                $data = ['error_message' => $mail->ErrorInfo];
                $this->DealsStealsSentMail_model->update($s->id, $data);
            }
        }

        echo 'Total sent : ' . $total_sent;
    }

    public function cronExpiredDealsSteals()
    {
        $this->load->model('DealsSteals_model');

        $total_updated = $this->DealsSteals_model->setAllExpired();
        echo 'Total updated ' . $total_updated;
        
    }
}
