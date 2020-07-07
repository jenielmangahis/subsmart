<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends MY_Controller {

	// public function __construct()
 //    {
 //        parent::__construct();
 //        $this->checkLogin();
 //    }

	/*public function index()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('tools/business_tools', $this->page_data);
	}*/

	public function api_connectors()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('tools/api_connectors', $this->page_data);
	}

	public function business_tools()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('tools/business_tools', $this->page_data);
	}
	
	public function google_contacts()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('tools/google_contacts', $this->page_data);
	}

	public function api_google_contacts(){
        $Google_api_client_id = "";
        $Google_client_secret = "";
        $Google_redirect_url = ""; // redirect url mentioned in aapi console
        $Google_contact_max_result = "" ;// integer value
        $authcode= $_GET['code'];
        $clientid=$Google_api_client_id;
        $clientsecret=$Google_client_secret;
        $redirecturi=$Google_redirect_url ;
        $fields=array(
            'code'=>  urlencode($authcode),
            'client_id'=>  urlencode($clientid),
            'client_secret'=>  urlencode($clientsecret),
            'redirect_uri'=>  urlencode($redirecturi),
            'grant_type'=>  urlencode('authorization_code')
        );
        $fields_string="";
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        $fields_string=rtrim($fields_string,'&');
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
        curl_setopt($ch,CURLOPT_POST,5);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        // Set so curl_exec returns the result instead of outputting it.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //to trust any ssl certificates
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        //extracting access_token from response string
        $response   =  json_decode($result);
        $accesstoken= $response->access_token;
        if( $accesstoken!="")
            $_SESSION['token']= $accesstoken;
        //passing accesstoken to obtain contact details
        $xmlresponse=  file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?&max-results=.$Google_contact_max_result .&oauth_token='.$_SESSION['token']);
        //reading xml using SimpleXML
        $xml=  new SimpleXMLElement($xmlresponse);
        $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2008');
        $result = $xml->xpath('//gd:email');
        $count = 0;
        foreach ( $result as $title )
        {
            $fetched_email = $title->attributes()->address;
            $contact_key[] = $this->contact_model->insert_contact_gmail($fetched_email);
        }
    }
}