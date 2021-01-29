<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wizard
 *
 * @author genesisrufino
 */
class Wizardlib extends MY_Controller {

    //put your code here
    public function __construct() {
        
    }

    function replace_tags($string, $tags, $force_lower = false) {
        return preg_replace_callback('/\\{\\{([^{}]+)\}\\}/',
                function($matches) use ($force_lower, $tags) {
            $key = $force_lower ? strtolower($matches[1]) : $matches[1];
            return array_key_exists($key, $tags) ? $tags[$key] : ''
            ;
        }
                , $string);
    }
    
    function getAppsByfunction($func_id)
    {
        $CI = &get_instance();
        $CI->load->model('wizard_apps_model','wam');
        $appDetails = $CI->wam->getAppsByfunction($func_id);
        return $appDetails;
    }

    function processWiZAction($appDetails, $details) {
        $CI = &get_instance();
        $action = $appDetails->row();

        $CI->db->join('wizard_app_function', 'wizard_automate.wa_action_app_id = wizard_app_function.wiz_app_func_id', 'left');
        $CI->db->where('wa_action_app_id', $action->wa_action_app_id);
        $q = $CI->db->get('wizard_automate');
        $actionDetails = $q->row();

        switch ($actionDetails->wiz_app_function):
            case 'sendEmail':
                $CI->db->where('id', $actionDetails->wa_config_data);
                $s = $CI->db->get('wizard_gmail_config')->row();


                $userId = getLoggedUserID();
                $template = $s->wgc_body;
                $map = array(
                    'username' => getLoggedFullName($userId),
                    'details' => $details
                );

                $body = $this->replace_tags($template, $map);

                if ($this->sendEmail($s->wgc_from, $s->wgc_to, $s->wgc_subject, $emailType, $body, $s->wgc_from_name, $s->wgc_cc, $s->wgc_cc)):
                    echo 'Email Successfully sent';
                else:
                    echo 'Something is wrong in sending' . $s->wgc_to;
                endif;
                break;
        endswitch;
    }

    function trigWiz($func, $company_id, $details, $returnUrl = NULL, $returnFunction = NULL) {
        $CI = &get_instance();
        $CI->db->join('wizard_app_function', 'wizard_automate.wa_trigger_app_id = wizard_app_function.wiz_app_func_id', 'left');
        $CI->db->where('wa_company_id', $company_id);
        $CI->db->where('wiz_app_function', $func);
        $CI->db->where('wa_is_enabled', 1);
        $q = $CI->db->get('wizard_automate');
        if ($q->num_rows() > 0):
            $this->processWiZAction($q, $details);
        endif;
    }

    function sendEmail($fromEmail, $toEmail, $subject, $emailType, $details, $fromName, $ccEmail = NULL, $bccEmail = NULL) {

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';

        $msg = "<p>$details</p>";

        //Email Sending                       
        $recipient = $toEmail;
        $mail = new PHPMailer;
        $mail->SMTPDebug = 4;
        //$mail->isSMTP();       
        $mail->From = $fromEmail;
        $mail->FromName = $fromName;
        $mail->addAddress($recipient, $recipient);
        if ($ccEmail != 0):
            $mail->addCC($ccEmail);
        endif;
        if ($bccEmail != 0):
            $mail->addBCC($bccEmail);
        endif;


        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $msg;
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

}
