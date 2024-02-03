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

    public function getDataByQuery($access_token, $refresh_token, $realm_id, $entity, $dateFrom, $dateTo, $process, $startPosition, $maxResults) {
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->CI->config->item('qb_client_id'),
            'ClientSecret' =>  $this->CI->config->item('qb_client_secret'),
            'accessTokenKey' => $access_token,
            'refreshTokenKey' => $refresh_token,
            'QBORealmID' => $realm_id,                
            'baseUrl' => $this->CI->config->item('qb_base_url')
        ));

        switch ($entity) {
            case 'Account':
                // $fetchData = $dataService->Query("SELECT * FROM Account");
                break;
            case 'AccountListDetail':
                // $fetchData = $dataService->Query("SELECT * FROM AccountListDetail");
                break;
            case 'APAgingDetail':
                // $fetchData = $dataService->Query("SELECT * FROM APAgingDetail");
                break;
            case 'APAgingSummary':
                // $fetchData = $dataService->Query("SELECT * FROM APAgingSummary");
                break;
            case 'ARAgingDetail':
                // $fetchData = $dataService->Query("SELECT * FROM ARAgingDetail");
                break;
            case 'ARAgingSummary':
                // $fetchData = $dataService->Query("SELECT * FROM ARAgingSummary");
                break;
            case 'BalanceSheet':
                // $fetchData = $dataService->Query("SELECT * FROM BalanceSheet");
                break;
            case 'Bill':
                // $fetchData = $dataService->Query("SELECT * FROM Bill");
                break;
            case 'BillPayment':
                // $fetchData = $dataService->Query("SELECT * FROM BillPayment");
                break;
            case 'CashFlow':
                // $fetchData = $dataService->Query("SELECT * FROM CashFlow");
                break;
            case 'CompanyCurrency':
                // $fetchData = $dataService->Query("SELECT * FROM CompanyCurrency");
                break;
            case 'CompanyInfo':
                // $fetchData = $dataService->Query("SELECT * FROM CompanyInfo");
                break;
            case 'CreditMemo':
                // $fetchData = $dataService->Query("SELECT * FROM CreditMemo");
                break;
            case 'CreditCardPayment':
                // $fetchData = $dataService->Query('SELECT * FROM CreditCardPayment');
                break;
            case 'Customer':
                if ($process == "import") {
                    $fetchData = $dataService->Query("SELECT * FROM Customer WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo' STARTPOSITION $startPosition MAXRESULTS $maxResults");
                    $result = $fetchData;
                }
                if ($process == "read") {
                    $fetchData = $dataService->Query("SELECT COUNT(*) FROM Customer WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo'");
                    $result = $fetchData;
                }
                break;
            case 'CustomerBalance':
                // $fetchData = $dataService->Query("SELECT * FROM CustomerBalance");
                break;
            case 'CustomerBalanceDetail':
                // $fetchData = $dataService->Query("SELECT * FROM CustomerBalanceDetail");
                break;
            case 'CustomerIncome':
                // $fetchData = $dataService->Query("SELECT * FROM CustomerIncome");
                break;
            case 'CustomerType':
                // $fetchData = $dataService->Query("SELECT * FROM CustomerType");
                break;
            case 'Department':
                // $fetchData = $dataService->Query("SELECT * FROM Department");
                break;
            case 'Deposit':
                // $fetchData = $dataService->Query("SELECT * FROM Deposit");
                break;
            case 'Employee':
                if ($process == "import") {
                    $fetchData = $dataService->Query("SELECT * FROM Employee WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo' STARTPOSITION $startPosition MAXRESULTS $maxResults");
                    $result = $fetchData;
                }
                if ($process == "read") {
                    $fetchData = $dataService->Query("SELECT COUNT(*) FROM Employee WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo'");
                    $result = $fetchData;
                }
                break;
            case 'Entitlements':
                // $fetchData = $dataService->Query("SELECT * FROM Entitlements");
                break;
            case 'Estimate':
                if ($process == "import") {
                    $fetchData = $dataService->Query("SELECT * FROM Estimate WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo' STARTPOSITION $startPosition MAXRESULTS $maxResults");
                    $result = $fetchData;
                }
                if ($process == "read") {
                    $fetchData = $dataService->Query("SELECT COUNT(*) FROM Estimate WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo'");
                    $result = $fetchData;
                }
                break;
            case 'Exchangerate':
                // $fetchData = $dataService->Query("SELECT * FROM Exchangerate");
                break;
            case 'GeneralLedger':
                // $fetchData = $dataService->Query("SELECT * FROM GeneralLedger");
                break;
            case 'GeneralLedgerFR':
                // $fetchData = $dataService->Query("SELECT * FROM GeneralLedgerFR");
                break;
            case 'InventoryValuationSummary':
                // $fetchData = $dataService->Query("SELECT * FROM InventoryValuationSummary");
                break;
            case 'Invoice':
                if ($process == "import") {
                    $fetchData = $dataService->Query("SELECT * FROM Invoice WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo' STARTPOSITION $startPosition MAXRESULTS $maxResults");
                    $result = $fetchData;
                }
                if ($process == "read") {
                    $fetchData = $dataService->Query("SELECT COUNT(*) FROM Invoice WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo'");
                    $result = $fetchData;
                }
                break;
            case 'Item':
                if ($process == "import") {
                    $fetchData = $dataService->Query("SELECT * FROM Item WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo' STARTPOSITION $startPosition MAXRESULTS $maxResults");
                    $result = $fetchData;
                }
                if ($process == "read") {
                    $fetchData = $dataService->Query("SELECT COUNT(*) FROM Item WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo'");
                    $result = $fetchData;
                }
                break;
            case 'JournalCode':
                // $fetchData = $dataService->Query("SELECT * FROM JournalCode");
                break;
            case 'JournalEntry':
                // $fetchData = $dataService->Query("SELECT * FROM JournalEntry");
                break;
            case 'JournalReport':
                // $fetchData = $dataService->Query("SELECT * FROM JournalReport");
                break;
            case 'JournalReportFR':
                // $fetchData = $dataService->Query("SELECT * FROM JournalReportFR");
                break;
            case 'Payment':
                if ($process == "import") {
                    // Do something...
                }
                if ($process == "read") {
                    $fetchData = $dataService->Query("SELECT COUNT(*) FROM Payment WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo'");
                    $result = $fetchData;
                }
                break;
            case 'PaymentMethod':
                // $fetchData = $dataService->Query("SELECT * FROM PaymentMethod");
                break;
            case 'Preferences':
                // $fetchData = $dataService->Query("SELECT * FROM Preferences");
                break;
            case 'ProfitAndLoss':
                // $fetchData = $dataService->Query("SELECT * FROM ProfitAndLoss");
                break;
            case 'ProfitAndLossDetail':
                // $fetchData = $dataService->Query("SELECT * FROM ProfitAndLossDetail");
                break;
            case 'Purchase':
                if ($process == "import") {
                    $fetchData = $dataService->Query("SELECT * FROM Purchase WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo' STARTPOSITION $startPosition MAXRESULTS $maxResults");
                    $result = $fetchData;
                }
                if ($process == "read") {
                    $fetchData = $dataService->Query("SELECT COUNT(*) FROM Purchase WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo'");
                    $result = $fetchData;
                }
                break;
            case 'PurchaseOrder':
                // $fetchData = $dataService->Query("SELECT * FROM PurchaseOrder");
                break;
            case 'RecurringTransaction':
                // $fetchData = $dataService->Query("SELECT * FROM RecurringTransaction");
                break;
            case 'RefundReceipt':
                // $fetchData = $dataService->Query("SELECT * FROM RefundReceipt");
                break;
            case 'ReimburseCharge':
                // $fetchData = $dataService->Query("SELECT * FROM ReimburseCharge");
                break;
            case 'SalesByClassSummary':
                // $fetchData = $dataService->Query("SELECT * FROM SalesByClassSummary");
                break;
            case 'SalesByCustomer':
                // $fetchData = $dataService->Query("SELECT * FROM SalesByCustomer");
                break;
            case 'SalesByDepartment':
                // $fetchData = $dataService->Query("SELECT * FROM SalesByDepartment");
                break;
            case 'SalesByProduct':
                // $fetchData = $dataService->Query("SELECT * FROM SalesByProduct");
                break;
            case 'SalesReceipt':
                // $fetchData = $dataService->Query("SELECT * FROM SalesReceipt");
                break;
            case 'TaxClassification':
                // $fetchData = $dataService->Query("SELECT * FROM TaxClassification");
                break;
            case 'TaxCode':
                // $fetchData = $dataService->Query("SELECT * FROM TaxCode");
                break;
            case 'TaxPayment':
                // $fetchData = $dataService->Query("SELECT * FROM TaxPayment");
                break;
            case 'TaxRate':
                // $fetchData = $dataService->Query("SELECT * FROM TaxRate");
                break;
            case 'TaxService':
                // $fetchData = $dataService->Query("SELECT * FROM TaxService");
                break;
            case 'TaxSummary':
                // $fetchData = $dataService->Query("SELECT * FROM TaxSummary");
                break;
            case 'TaxAgency':
                // $fetchData = $dataService->Query("SELECT * FROM TaxAgency");
                break;
            case 'Term':
                // $fetchData = $dataService->Query("SELECT * FROM Term");
                break;
            case 'TimeActivity':
                // $fetchData = $dataService->Query("SELECT * FROM TimeActivity");
                break;
            case 'TransactionList':
                // $fetchData = $dataService->Query("SELECT * FROM TransactionList");
                break;
            case 'TransactionListByVendor':
                // $fetchData = $dataService->Query("SELECT * FROM TransactionListByVendor");
                break;
            case 'TransactionListByCustomer':
                // $fetchData = $dataService->Query("SELECT * FROM TransactionListByCustomer");
                break;
            case 'TransactionListWithSplits':
                // $fetchData = $dataService->Query("SELECT * FROM TransactionListWithSplits");
                break;
            case 'Transfer':
                // $fetchData = $dataService->Query("SELECT * FROM Transfer");
                break;
            case 'Vendor':
                if ($process == "import") {
                    $fetchData = $dataService->Query("SELECT * FROM Vendor WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo' STARTPOSITION $startPosition MAXRESULTS $maxResults");
                    $result = $fetchData;
                }
                if ($process == "read") {
                    $fetchData = $dataService->Query("SELECT COUNT(*) FROM Vendor WHERE MetaData.CreateTime >= '$dateFrom' AND MetaData.CreateTime <= '$dateTo'");
                    $result = $fetchData;
                }
                break;
            case 'VendorBalance':
                // $fetchData = $dataService->Query("SELECT * FROM VendorBalance");
                break;
            case 'VendorBalanceDetail':
                // $fetchData = $dataService->Query("SELECT * FROM VendorBalanceDetail");
                break;
            case 'VendorCredit':
                // $fetchData = $dataService->Query("SELECT * FROM VendorCredit");
                break;
            case 'VendorExpenses':
                // $fetchData = $dataService->Query('SELECT * FROM VendorExpenses');
                break;
            default:
                $fetchData = "";
                $result = $fetchData;
                break;
        }

        return $result;
    }
}
?>