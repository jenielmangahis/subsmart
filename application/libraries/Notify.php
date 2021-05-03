<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define("FIREBASE_API_KEY", "AAAA0yE6SAE:APA91bFQOOZnqWcMbdBY9ZfJfc0TWanlN1l6f95QfjpfMhVLWNfHVd63nlfxP69I_snCkaqaY9yuezx65GLyevUmkflRADYdYAZKPY8e8SS5Q_dyPDqQaxxlstamhhUG1BiFr4bC4ABo");

class Notify extends MY_Controller {
    public function __construct() {
        
    }    
    function send_ios_push($registrationIds, $title, $body)
    {

        $notification = array(
            'title'     => $title,
            'body'      => $body,
            'sound'     => 'default',
            'badge'     => '1'
        );

        // registration_ids for multipale tokens array
        $payload = array(
            'registration_ids' => $registrationIds,
            'notification'     => $notification,
            'priority'            => 'high'
        );
        $json = json_encode($payload);


        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }

    
}