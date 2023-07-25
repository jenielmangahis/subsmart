<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/mailchimp-marketing-php/vendor/autoload.php';

class MailChimpApi
{

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->config->load('api_credentials');
    }

    public function createAccessToken($mailchimp_code)
    {        
        try {
            $context = stream_context_create([
                'http' => [
                  'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                  'method' => 'POST',
                  'content' => http_build_query([
                    'grant_type' => "authorization_code",
                    'client_id' => $this->CI->config->item('mailchimp_client_id'),
                    'client_secret' => $this->CI->config->item('mailchimp_client_secret'),
                    'redirect_uri' => $this->CI->config->item('mailchimp_redirect_uri'),
                    'code' => $mailchimp_code,
                  ]),
                ],
            ]);
            $result = file_get_contents($this->CI->config->item('mailchimp_token_url'), false, $context);
            $decoded = json_decode($result);
            $access_token = $decoded->access_token;    
        } catch (Exception $e) {
            $access_token = '';
        }
        

        return $access_token;
    }

    public function getAccountDetails($access_token)
    {
          $context = stream_context_create([
            'http' => [
              'header' => "Authorization: OAuth $access_token",
            ],
          ]);
          $result = file_get_contents($this->CI->config->item('mailchimp_metadata_url'), false, $context);
          $accountDetails = json_decode($result);

          return $accountDetails;
    }

    public function getAllLists($access_token, $server_prefix)
    {
        $client = new MailchimpMarketing\ApiClient();
        $client->setConfig([
            'accessToken' => $access_token,
            'server' => $server_prefix,
        ]);

        $response = $client->lists->getAllLists();
        return $response;
    }

    public function getListById($list_id, $access_token, $server_prefix)
    {
        $client = new MailchimpMarketing\ApiClient();
        $client->setConfig([
            'accessToken' => $access_token,
            'server' => $server_prefix,
        ]);

        $response = $client->lists->getList($list_id);
        return $response;
    }

    public function addMemberToList($list_id, $member_info = array(), $access_token, $server_prefix)
    {   
        try {                    
            $client = new MailchimpMarketing\ApiClient();
            $client->setConfig([
                'accessToken' => $access_token,
                'server' => $server_prefix,
            ]);

            $response = $client->lists->addListMember($list_id, $member_info, ["skip_merge_validation" => false]);
        } catch (Exception $e) {                        
            $response = ['error' => $e->getMessage()]; 
        }
        
        return $response;
    }
}

?>


