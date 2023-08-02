<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActiveCampaignApi
{

    public function __construct() 
    {
        $this->CI =& get_instance();
        $this->CI->config->load('api_credentials');
    }

    public function getContacts($account_url, $token)
    {
        $error_message = '';
        $contacts = array();

        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', $account_url . '/api/3/contacts', [
              'headers' => [
                'accept' => 'application/json',
                'Api-Token' => $token
              ],
            ]);

            $contacts = json_decode($response->getBody());    
        } catch (Exception $e) {
           $error_message = $e->getMessage(); 
        }
        
        $return = ['contacts' => $contacts, 'error_message' => $error_message];
        return $return;
    }

    public function createContact($account_url, $token, $contact)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $account_url . '/api/3/contacts', [
          'body' => json_encode($contact),
          'headers' => [
            'Api-Token' => $token,
            'accept' => 'application/json',            
            'content-type' => 'application/json'
          ]
        ]);

        $data = json_decode($response->getBody());
        return $data;
    }

    public function getLists($account_url, $token)
    {
        $error_message = '';
        $lists = array();

        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', $account_url . '/api/3/lists', [
              'headers' => [
                'accept' => 'application/json',
                'Api-Token' => $token
              ],
            ]);

            $lists = json_decode($response->getBody());    
        } catch (Exception $e) {
           $error_message = $e->getMessage(); 
        }
        
        $return = ['lists' => $lists, 'error_message' => $error_message];
        return $return;
    }

    public function getAutomations($account_url, $token, $automation_id = 0)
    {
        $error_message = '';
        $automations = array();

        try {
            $client = new \GuzzleHttp\Client();
            if( $automation_id > 0 ){
                $response = $client->request('GET', $account_url . '/api/3/automations/'.$automation_id, [
                  'headers' => [
                    'accept' => 'application/json',
                    'Api-Token' => $token
                  ],
                ]);
            }else{
                $response = $client->request('GET', $account_url . '/api/3/automations', [
                  'headers' => [
                    'accept' => 'application/json',
                    'Api-Token' => $token
                  ],
                ]);    
            }
            

            $automations = json_decode($response->getBody());    
        } catch (Exception $e) {
           $error_message = $e->getMessage(); 
        }
        
        $return = ['automations' => $automations, 'error_message' => $error_message];
        return $return;
    }
}

?>


