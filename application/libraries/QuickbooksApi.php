<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/quickbooks-phpsdk-v3/src/config.php';

use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\ServiceContext;
use QuickBooksOnline\API\PlatformService\PlatformService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Customer;

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
                'baseUrl' => "development"
            ));

            $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
            $authUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();

            return $authUrl;
        }

        public function create_session($calbback){

            $dataService = DataService::Configure(array(
                'auth_mode' => 'oauth2',
                'ClientID' => $this->CI->config->item('qb_client_id'),
                'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
                'RedirectURI' => $this->CI->config->item('qb_redirect_uri'),
                'scope' => $this->CI->config->item('qb_auth_scope'),
                'baseUrl' => "development"
            ));

            $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
            $qb = new QuickbooksApi();
            $parseUrl = $qb ->parseAuthRedirectUrls($calbback);
            $accessToken =    $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($parseUrl['code'], $parseUrl['realmId']);

             $dataService->updateOAuth2Token($accessToken);
             $_SESSION['sessionAccessToken'] = $accessToken;
             return $_SESSION['sessionAccessToken'];
        }

        public function get_qb_company_info(){
            $dataService = DataService::Configure(array(
                'auth_mode' => 'oauth2',
                'ClientID' => $this->CI->config->item('qb_client_id'),
                'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
                'RedirectURI' => $this->CI->config->item('qb_redirect_uri'),
                'scope' => $this->CI->config->item('qb_auth_scope'),
                'baseUrl' => "development"
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
                'baseUrl' => "development"
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
    }

    ?>


