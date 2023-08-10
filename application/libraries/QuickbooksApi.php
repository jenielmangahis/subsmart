<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/quickbooks-phpsdk-v3/src/config.php';

use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\ServiceContext;
use QuickBooksOnline\API\PlatformService\PlatformService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Customer;
use QuickBooksOnline\API\Facades\Employee;
use QuickBooksOnline\API\Facades\TimeActivity;

class QuickbooksApi
{

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->config->load('api_credentials');

    }

    public function parseAuthRedirectUrls($url)
    {
        parse_str($url,$qsArray);
        return array(
            'code' => $qsArray['code'],
            'realmId' => $qsArray['realmId']
        );
    }

    public function initialize_auth(){
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'RedirectURI' => $this->CI->config->item('qb_redirect_uri'),
            'scope' => $this->CI->config->item('qb_auth_scope'),
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $authUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();

        return $authUrl;
    }

    public function login_helper(){
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'RedirectURI' => $this->CI->config->item('qb_redirect_uri'),
            'scope' => $this->CI->config->item('qb_auth_scope'),
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();

        return $OAuth2LoginHelper;
    }

    public function create_session($calbback){

        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'RedirectURI' => $this->CI->config->item('qb_redirect_uri'),
            'scope' => $this->CI->config->item('qb_auth_scope'),
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $qb = new QuickbooksApi();
        $parseUrl = $qb ->parseAuthRedirectUrls($calbback);
        $accessToken =    $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($parseUrl['code'], $parseUrl['realmId']);

         $dataService->updateOAuth2Token($accessToken);
         $_SESSION['sessionAccessToken'] = $accessToken;
         return $_SESSION['sessionAccessToken'];
    }

    public function get_access_token($calbback){

        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'RedirectURI' => $this->CI->config->item('qb_redirect_uri'),
            'scope' => $this->CI->config->item('qb_auth_scope'),
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $qb = new QuickbooksApi();
        $parseUrl = $qb ->parseAuthRedirectUrls($calbback);
        $accessToken =    $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($parseUrl['code'], $parseUrl['realmId']);            
        $dataService->updateOAuth2Token($accessToken);        

        return $accessToken;
    }

    public function get_qb_company_info_v2($access_token, $refresh_token, $realm_id){

        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'accessTokenKey' => $access_token,
            'refreshTokenKey' => $refresh_token,
            'QBORealmID' => $realm_id,                
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        $companyInfo = $dataService->getCompanyInfo();
        return $companyInfo;
    }

    public function refresh_token($refresh_token, $realm_id){

        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),            
            'refreshTokenKey' => $refresh_token,
            'QBORealmId' => $realm_id,
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();        
        try {
            $refreshedAccessTokenObj = $OAuth2LoginHelper->refreshToken();
            $error = $OAuth2LoginHelper->getLastError();
            if($error){
                $refreshedAccessTokenObj = '';
            }else{
                //Refresh Token is called successfully
                $dataService->updateOAuth2Token($refreshedAccessTokenObj);
            }           
        } catch (Exception $e) {
            $refreshedAccessTokenObj = '';
        }
        

        return $refreshedAccessTokenObj;
    }

    public function revoke_token($refresh_token, $realm_id){
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),            
            'refreshTokenKey' => $refresh_token,
            'QBORealmId' => $realm_id,
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $revokeToken = $OAuth2LoginHelper->revokeToken($refresh_token);        
    }

    public function get_qb_company_info($accessToken){
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'RedirectURI' => $this->CI->config->item('qb_redirect_uri'),
            'scope' => $this->CI->config->item('qb_auth_scope'),
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));
        $accessToken = $_SESSION['sessionAccessToken'];
        //$oauth2LoginHelper = $dataService->getOAuth2LoginHelper();
        //$accessTokenObj = $oauth2LoginHelper->refreshAccessTokenWithRefreshToken($_SESSION['sessionAccessToken']);
        //$accessTokenValue = $accessTokenObj->getAccessToken();
       // $refreshTokenValue = $accessTokenObj->getRefreshToken();
        $dataService->updateOAuth2Token($accessToken);
        $companyInfo = $dataService->getCompanyInfo();
        return $companyInfo;
    }

    public function get_customers(){
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'RedirectURI' => $this->CI->config->item('qb_redirect_uri'),
            'scope' => $this->CI->config->item('qb_auth_scope'),
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        $accessToken = $_SESSION['sessionAccessToken'];
        $dataService->updateOAuth2Token($accessToken);

        $i = 0;
        while (1) {
            $allCustomers = $dataService->FindAll('Customer', $i, 500);
            $error = $dataService->getLastError();
            if ($error) {
                echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
                echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
                echo "The Response message is: " . $error->getResponseBody() . "\n";
                exit();
            }
            if (!$allCustomers || (0==count($allCustomers))) {
                break;
            }
            return $allCustomers;
        }

    }

    public function create_employee($user_data, $access_token, $refresh_token, $realm_id){
        $is_imported = false;
        $err_msg = 'Cannot import data';
        $qb_user_id = 0;
        $err_code   = '';

        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'accessTokenKey' => $access_token,
            'refreshTokenKey' => $refresh_token,
            'QBORealmID' => $realm_id,
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));        
        
        $theResourceObj = Employee::create($user_data);

        $resultingObj = $dataService->Add($theResourceObj);
        $error        = $dataService->getLastError();
        if ($error) {
            $err_msg  = $error->getIntuitErrorDetail();
            $err_code = $error->getIntuitErrorCode();
            /*echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";*/
        }
        else {
            $qb_user_id  = $resultingObj->Id;
            $is_imported = true;
            $err_msg = "";            
        }        

        $result = ['is_imported' => $is_imported, 'err_code' => $err_code, 'err_msg' => $err_msg, 'qb_user_id' => $qb_user_id];
        return $result;
    }

    public function create_timesheet($timesheet_data, $access_token, $refresh_token, $realm_id){
        $is_imported = false;
        $err_msg = 'Cannot import data';
        $qb_timesheet_id = 0;
        $err_code   = '';

        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'accessTokenKey' => $access_token,
            'refreshTokenKey' => $refresh_token,
            'QBORealmID' => $realm_id,
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));        
        
        $theResourceObj = TimeActivity::create($timesheet_data);

        $resultingObj = $dataService->Add($theResourceObj);
        $error        = $dataService->getLastError();
        if ($error) {
            $err_msg  = $error->getIntuitErrorDetail();
            $err_code = $error->getIntuitErrorCode();
            /*echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";*/
        }
        else {
            $qb_timesheet_id = $resultingObj->Id;
            $is_imported = true;
            $err_msg = "";            
        }

        $result = ['is_imported' => $is_imported, 'err_msg' => $err_msg, 'err_code' => $err_code, 'qb_timesheet_id' => $qb_timesheet_id];
        return $result;
    }
}

?>


