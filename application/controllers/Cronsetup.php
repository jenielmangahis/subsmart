<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Cronsetup extends MY_Controller {



	public function __construct()
	{

		parent::__construct();
		 

		$this->page_data['page']->title = '';
		$this->page_data['page']->menu = 'users';

	}
    public function checkLocation(){
        echo "My Ip : ";
        echo $myip = $this->gtMyIpGlobal();
        echo '<br>-----<br>';
        echo "My Ip : ";
        echo $ipaddress = $this->timesheet_model->gtMyIpGlobal();
       
        $get_location = json_decode(file_get_contents('http://ip-api.com/json/'.$ipaddress)); 
        $lat = $get_location->lat;
        $lng = $get_location->lon;
        echo '<br>-----<br>';
        echo "My Timezone : ";

        echo $utimezone = $get_location->timezone;
    }
    public function cronSetForOvertime(){
        $check_attn = $this->db->get_where('timesheet_attendance',array('status' => 1 ))->result_array();
        
        foreach ($check_attn as $key => $value) { 
            //echo $value['id'];
            $qry = $this->db->get_where("timesheet_logs",array('attendance_id' => $value['id']))->result();
            $start_time = 0;
            $end_time = 0;

            $break_in = 0;
            $break_out = 0;

            $end_time = strtotime(date("Y-m-d H:i:s"));
            //echo '<pre>';print_r($qry);
            foreach ($qry as $time){
                $user_id =  $time->user_id;
                if ($time->action == 'Check in'){
                    $start_time = strtotime($time->date_created);
                }elseif($time->action == 'Check out'){
                    
                }elseif($time->action == 'Break in'){
                    $break_in = strtotime($time->date_created);
                }elseif($time->action == 'Break out'){
                    $break_out = strtotime($time->date_created);
                }

            }

            $break_diff = ($break_out - $break_in)/3600;


            $diff = ($end_time - $start_time)/3600;

            //echo '<br>----------<br>';
            $diff = $diff - $break_diff;

             $diff = round($diff,2); 

            if($diff >= 8.5){
            //if(true ){
                $date = date("Y-m-d");
                
                $users = $this->db->query("SELECT * FROM timesheet_extra_reminder WHERE user_id='".$user_id."' AND date='".$date."' ");
                //if(false ){
                if($users->num_rows() ){
                   
                }else
                {
                    $users = $this->db->query("INSERT INTO timesheet_extra_reminder SET user_id='".$user_id."', date='".$date."' ");
                    //echo $diff;
                    $user_data = $this->users_model->getById($user_id );
                   
                    $this->sendUserEmailreminder($user_data->email,$user_data->FName." ".$user_data->LName);

                    // init array
                    $iOSRegIds = array();
                    $androidRegIds = array();

                    // get admin details from team member
                    $rows = $this->db->query("select tm.*, u.device_token, u.device_type from timesheet_team_members tm, users u where  tm.role = 'Admin' and u.id = tm.user_id and u.id != $user_id")->result_array();
                    // iterate
                    //echo '<pre>';print_r($rows);
                    foreach ($rows as $row) {
                        // get token
                        $token = $row['device_token'];
                        $this->sendAdminEmailreminder($row['email'],$user_data->FName." ".$user_data->LName);
                        // check device_type
                        if ($row['device_type'] == 'iOS') {
                            // add device_token
                            array_push($iOSRegIds, $token);
                        } else {
                            // add device_token
                            array_push($androidRegIds, $token);
                        }
                    }
                    //print_r($iOSRegIds);
                    //print_r($androidRegIds);
                    //exit;
                    // send the push
                    $message = $user_data->FName.' '.$user_data->LName.' Have not clock out yes.';
                    if(!empty($iOSRegIds))
                    {
                        echo '<pre>';
                        print_r($iOSRegIds);
                        echo $message;
                        $ios = $this->send_ios_push($iOSRegIds,  $message, "Time Clock Alert");
                    }

                    if(!empty($androidRegIds))
                    {
                        $android = $this->send_android_push($androidRegIds,  $message,"Time Clock Alert");
                    }
                }
            }
        }
    }
    public function sendAdminEmailreminder($email,$name=''){
        $data = array(
            'name' => $name
        );
        //Load email library
        $this->load->library('email');
        $config = array(
            'smtp_crypto' => 'ssl',
            'protocol' => 'smtp',
            'smtp_host' => 'mail.nsmartrac.com',
            'smtp_port' => 465,
            'smtp_user' => 'no-reply@nsmartrac.com',
            'smtp_pass' => 'g0[05_rEa3?%',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('no-reply@nsmartrac.com','nSmartrac');
        $this->email->to($email);
        $this->email->subject('Timer is still running in system - nSmartrac');
        $message = $this->load->view('users/timesheet_reminder_admin',$data,TRUE);
         
        $this->email->message($message);
        //Send mail
        $this->email->send();
        return true;
    }
    public function sendUserEmailreminder($email,$name=''){
        $data = array(
            'name' => $name
        );
        //Load email library
        $this->load->library('email');
        $config = array(
            'smtp_crypto' => 'ssl',
            'protocol' => 'smtp',
            'smtp_host' => 'mail.nsmartrac.com',
            'smtp_port' => 465,
            'smtp_user' => 'no-reply@nsmartrac.com',
            'smtp_pass' => 'g0[05_rEa3?%',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('no-reply@nsmartrac.com','nSmartrac');
        $this->email->to($email);
        $this->email->subject('Timer is still running in system - nSmartrac');
        $message = $this->load->view('users/timesheet_reminder_user',$data,TRUE);
        //echo $message ;
        //exit;
        $this->email->message($message);
        //Send mail
        $this->email->send();
        return true;
    }


    public function send_android_push($registrationIds, $body, $title) {
        $FIREBASE_API_KEY = "AAAA0yE6SAE:APA91bFQOOZnqWcMbdBY9ZfJfc0TWanlN1l6f95QfjpfMhVLWNfHVd63nlfxP69I_snCkaqaY9yuezx65GLyevUmkflRADYdYAZKPY8e8SS5Q_dyPDqQaxxlstamhhUG1BiFr4bC4ABo";

        $notification = array('body' => $body,
        'title' => $title,
        'sound' => 'default');

        $fields = array('registration_ids' => $registrationIds,
        'data' => $notification);


        $headers = array('Authorization: key=' . $FIREBASE_API_KEY,
        'Content-Type: application/json');


        //send curl
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ));
        $response = curl_exec($ch);
        curl_close($ch);
    }


    public function send_ios_push($registrationIds, $title, $body) {
        $FIREBASE_API_KEY = "AAAA0yE6SAE:APA91bFQOOZnqWcMbdBY9ZfJfc0TWanlN1l6f95QfjpfMhVLWNfHVd63nlfxP69I_snCkaqaY9yuezx65GLyevUmkflRADYdYAZKPY8e8SS5Q_dyPDqQaxxlstamhhUG1BiFr4bC4ABo";

        $notification = array('title' => $title ,
            'body' => $body,
            'sound' => 'default',
            'badge' => '1');

        $payload = array('registration_ids' => $registrationIds,
            'notification' => $notification,
            'priority' => 'high');
        
        $json = json_encode($payload);

        $headers = array('Authorization: key=' . $FIREBASE_API_KEY,
        'Content-Type: application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
    }

}

