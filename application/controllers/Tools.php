<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends MY_Controller {

	 public function __construct()
     {
         parent::__construct();
         $this->checkLogin();
         $this->load->model('ApiGoogleContact_model', 'api_gc');
         $this->load->model('UserDetails_model', 'user_details');
         $this->load->config('api_credentials');
     }

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
        $user_id = getLoggedUserID();
        if($this->user_details->check_if_exist($user_id)){
            $this->page_data['api_enabled'] = true;
        }
        $this->page_data['contacts'] = $this->api_gc->get_all();
	    $this->load->view('tools/google_contacts', $this->page_data);
	}

    public function quickbooks()
    {
        $this->load->library('quickbooksapi');
        $user_id = getLoggedUserID();

        if(isset($_GET['code']) && isset($_GET['state']) && isset($_GET['realmId']) ) {
            if($_SESSION['sessionAccessToken'] == null || $_SESSION['sessionAccessToken'] == ""){
                $this->quickbooksapi->create_session($_SERVER['QUERY_STRING']);
            }else{
                $this->quickbooksapi->create_session($_SERVER['QUERY_STRING']);
                $company_info = $this->quickbooksapi->get_qb_company_info();
                $this->page_data['qb_info'] = $company_info;
                $this->page_data['qb_customers']  = $this->quickbooksapi->get_customers();
            }
        }else{
            $this->page_data['authurl'] = $this->quickbooksapi->initialize_auth();

        }

        $this->load->view('tools/quickbooks', $this->page_data);

    }

    public function nicejob(){
        $this->load->view('tools/nicejob', $this->page_data);
    }
    public function zapier(){
        $this->load->view('tools/zapier', $this->page_data);
    }
    public function mailchimp(){
        $this->load->view('tools/mailchimp', $this->page_data);
    }
    public function active_campaign(){
        $this->load->view('tools/active_campaign', $this->page_data);
    }
    public function api_integration(){



        $this->load->view('tools/api_integration', $this->page_data);
    }

    public function zapier_api_connect(){

    }


    public function google_contact_disable(){
        $input = array();
        $input['api_gc_enable'] = 0 ;
        if($this->user_details->update($input,getLoggedUserID())){
            redirect(base_url('tools/google_contacts'));
        }
    }

    public function api_quickbooks_callback(){
        $this->load->library('quickbooksapi');
        $this->quickbooksapi->create_session($_SERVER['QUERY_STRING']);
        redirect(base_url('tools/quickbooks'));
    }
	public function api_google_contacts(){
        $Google_api_client_id = $this->config->item('google_contact_client_id');
        $Google_client_secret = $this->config->item('google_contact_client_secret');
        $Google_redirect_url =   $this->config->item('google_contact_redirect_url'); // redirect url mentioned in aapi console
        $Google_contact_max_result = "10" ;// integer value
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


        //print_r($response);

        $accesstoken= $response->access_token;
        if( $accesstoken!="")
            $_SESSION['token']= $accesstoken;
        //passing accesstoken to obtain contact details
        $xmlresponse=  file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?&max-results='.$Google_contact_max_result .'.&oauth_token='.urlencode($_SESSION['token']));
        //reading xml using SimpleXML
        $xml=  new SimpleXMLElement($xmlresponse);
        $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2008');
        $result = $xml->xpath('//gd:email');
        $count = 0;

        $input = array();
        foreach ( $result as $title ) {
            if($this->api_gc->check_if_exist($title->attributes()->address)){
                echo $title->attributes()->address.' Exist '.'<br>';
            }else{
                $input['contact_email'] = $title->attributes()->address;
                $input['user_id'] = getLoggedUserID();
                $this->api_gc->add($input);
            }
        }
        redirect(base_url('tools/google_contacts'));
    }
}