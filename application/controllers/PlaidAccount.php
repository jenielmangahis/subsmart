<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlaidAccount extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->checkLogin();
        $this->hasAccessModule(8);

		$this->page_data['page_title'] = 'Plaid Account';
		$this->load->helper(array('plaid_helper'));
		$this->load->library('session');
        
	}

    public function list()
    {
        $this->load->model('PlaidAccount_model');
        $this->load->model('PlaidBankAccount_model');
        $this->load->model('PlaidErrorLogs_model');

        $is_valid = 1;
        $cid = logged('company_id');
        $uid = logged('id');

        $plaidAccounts = $this->PlaidBankAccount_model->getAllByCompanyId($cid);        
        $plaidAccount  = $this->PlaidAccount_model->getDefaultCredentials();

        if( $plaidAccount ){
            foreach($plaidAccounts as $pc){            
                try{
                    $balance = balanceGet($plaidAccount->client_id, $plaidAccount->client_secret, $pc->access_token, $pc->account_id);
                     if( isset($balance->error_code) && $balance->error_code != '' ){
                        $pc->balance_available = 'Cannot connect to your bank account';
                        $pc->balance_current   = 'Cannot connect to your bank account';

                        $err_data = [
                            'user_id' => $uid,
                            'log_date' => date("Y-m-d H:i:s"),
                            'log_msg' => $balance->error_code . ' / ' . $balance->error_message
                        ];

                        $this->PlaidErrorLogs_model->create($err_data);
                    }else{
                        if( !empty($balance->accounts) ){
                            $pc->balance_available = $balance->accounts[0]->balances->available;
                            $pc->balance_current   = $balance->accounts[0]->balances->current;
                        }
                    }
                    
                }catch(Exception $e){
                    $is_valid = 0;
                    $err_data = [
                        'user_id' => $uid,
                        'log_date' => date("Y-m-d H:i:s"),
                        'log_msg' => $e->getMessage()
                    ];

                    $this->PlaidErrorLogs_model->create($err_data);
                }         
            }
        }else{
            $err_data = [
                'user_id' => $uid,
                'log_date' => date("Y-m-d H:i:s"),
                'log_msg' => 'Token Error'
            ];

            $this->PlaidErrorLogs_model->create($err_data);
            $is_valid = 0;
        }

        $plaid_handler_open = 0;
        $plaid_token = '';
        $client_name = '';
        $get = $this->input->get();
        if( isset($get['oauth_state_id']) ){
            $plaid_handler_open = 1;                     
            $plaid_token        = $this->session->userdata('plaid_token');

            $plaidAccount = $this->PlaidAccount_model->getDefaultCredentials();
            $client_name  = $plaidAccount->client_name;
        }
        
        $this->page_data['client_name'] = $plaid_token;
        $this->page_data['plaid_token'] = $plaid_token;
        $this->page_data['plaid_handler_open'] = $plaid_handler_open;
        $this->page_data['page']->title = 'Plaid : Bank Accounts';
        $this->page_data['page']->parent = 'Accounting';
        $this->page_data['is_valid'] = $is_valid;
        $this->page_data['plaidAccounts'] = $plaidAccounts;
        $this->load->view('v2/pages/plaid_account/list', $this->page_data);
    }

    public function ajax_plaid_api()
    {
        $this->load->model('PlaidAccount_model');
        $this->load->model('PlaidErrorLogs_model');

        $is_valid = 0;
        $plaid_token = ''; 
        $msg = 'Cannot connect bank account. Please try again later.';   

        $cid  = logged('company_id');    
        $uid  = logged('id');
        $post = $this->input->post();

        $plaidAccount = $this->PlaidAccount_model->getDefaultCredentials();
        if( $plaidAccount ){
            $plaidToken = linkTokenCreate($plaidAccount->client_id, $plaidAccount->client_secret, $plaidAccount->client_user_id, $plaidAccount->client_name, $post['redirect_url']);
            if( isset($plaidToken['token']) && $plaidToken['token'] != '' ){
                $is_valid = 1;
                $msg      = '';
                $plaid_token = $plaidToken['token'];
                $this->session->set_userdata('plaid_token', $plaidToken['token']);    
            }else{
                $err_data = [
                    'user_id' => $uid,
                    'log_date' => date("Y-m-d H:i:s"),
                    'log_msg' => $plaidToken['err_msg']
                ];

                $this->PlaidErrorLogs_model->create($err_data);
            }
        }else{
            $msg = 'Invalid Account';
        }       
        
        $json = ['client_name' => $client_name, 'plaid_token' => $plaid_token, 'is_valid' => $is_valid, 'msg' => $msg];
        die(json_encode($json));
    }

    public function ajax_create_plaid_account()
    {
        $this->load->model('PlaidAccount_model');
        $this->load->model('PlaidBankAccount_model');
        $this->load->model('PlaidErrorLogs_model');

        $is_success = 0;
        $msg = '';
        $total_created = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');
        $uid  = logged('id');
        $plaidData = json_decode($post['meta_data']);
        $plaidAccount = $this->PlaidAccount_model->getDefaultCredentials();
        $accessToken = exchangeToken($plaidAccount->client_id, $plaidAccount->client_secret, $post['public_token']);
        if( $accessToken->access_token != '' ){
            foreach($plaidData->accounts as $account){
                //Check if account id exists
                $filters['search'][] = ['field' => 'company_id', 'value' => $cid];
                $filters['search'][] = ['field' => 'institution_id', 'value' => $plaidData->institution->institution_id];
                $isExists = $this->PlaidBankAccount_model->getByAccountId($account->id);
                if( !$isExists ){
                    $data = [
                        'company_id' => $cid,
                        'institution_id' => $plaidData->institution->institution_id,                    
                        'account_id' => $account->id,
                        'public_token' => $post['public_token'],
                        'access_token' => $accessToken->access_token,
                        'institution_name' => $plaidData->institution->name,
                        'account_name' => $account->name,
                        'subtype' => $account->subtype,
                        'type' => $account->type,
                        'created' => date("Y-m-d H:i:s"),
                        'modified' => date("Y-m-d H:i:s")
                    ];

                    $this->PlaidBankAccount_model->create($data); 
                }else{
                    $data = [
                        'institution_id' => $plaidData->institution->institution_id,                    
                        'account_id' => $account->id,
                        'public_token' => $post['public_token'],
                        'access_token' => $accessToken->access_token,
                        'institution_name' => $plaidData->institution->name,
                        'account_name' => $account->name,
                        'subtype' => $account->subtype,
                        'type' => $account->type,
                        'modified' => date("Y-m-d H:i:s")
                    ];

                    $this->PlaidBankAccount_model->update($isExists->id, $data); 
                }

                $total_created++;   
            }
        }else{
            $err_data = [
                'user_id' => $uid,
                'log_date' => date("Y-m-d H:i:s"),
                'log_msg' => 'Token Error'
            ];

            $this->PlaidErrorLogs_model->create($err_data);
        }
        

        if( $total_created > 0 ){
            $is_success = 1;
        }else{
            $msg = 'No record(s) found';
        }

        $json = ['is_success' => $is_success, 'msg' => $msg];
        die(json_encode($json));
    }

    public function ajax_load_connected_bank_accounts()
    {
        $this->load->model('PlaidAccount_model');
        $this->load->model('PlaidBankAccount_model');
        $this->load->model('PlaidErrorLogs_model');

        $is_valid = 1;
        $cid = logged('company_id');
        $uid = logged('id');
        $role_id = logged('role');
        $user_type = logged('user_type');
        
        if( $user_type == 7 || $role_id == 3 ){
            $plaidBankAccounts = $this->PlaidBankAccount_model->getAllByCompanyId($cid);        
            $plaidAccount  = $this->PlaidAccount_model->getDefaultCredentials();
            $recentTransactions = array();
            if( $plaidAccount ){
                foreach($plaidBankAccounts as $pc){            
                    try{
                        $start_date = date('Y-m-d', strtotime("-1 week"));
                        $end_date   = date("Y-m-d");

                        $balance = balanceGet($plaidAccount->client_id, $plaidAccount->client_secret, $pc->access_token, $pc->account_id);
                        $plaidTransactions = transactionGet($plaidAccount->client_id, $plaidAccount->client_secret, $pc->access_token, $start_date, $end_date, $pc->account_id, 5);  
                        if( isset($balance->error_code) && $balance->error_code != '' ){
                            $pc->balance_available = 'Cannot fetch bank account balance';
                            $pc->balance_current   = 'Cannot fetch bank account balance';

                            $err_data = [
                                'user_id' => $uid,
                                'log_date' => date("Y-m-d H:i:s"),
                                'log_msg' => $balance->error_code . ' / ' . $balance->error_message
                            ];

                            $this->PlaidErrorLogs_model->create($err_data);
                        }else{
                            if( !empty($balance->accounts) ){
                                $pc->balance_available = $balance->accounts[0]->balances->available;
                                $pc->balance_current   = $balance->accounts[0]->balances->current;
                            }
                        }

                        if( $plaidTransactions && $plaidTransactions->transactions ){
                            $recentTransactions[] = $plaidTransactions->transactions;
                        }
                    }catch(Exception $e){
                        $err = $e->getMessage();

                        $err_data = [
                            'user_id' => $uid,
                            'log_date' => date("Y-m-d H:i:s"),
                            'log_msg' => $err
                        ];

                        $this->PlaidErrorLogs_model->create($err_data);
                    }         
                }
            }else{
                $is_valid = 0;
            }
        }else{
           $plaidBankAccounts = array();
           $recentTransactions = array(); 
        }
        
        
        $this->page_data['is_valid'] = $is_valid;
        $this->page_data['plaidBankAccounts']  = $plaidBankAccounts;
        $this->page_data['recentTransactions'] = $recentTransactions;
        $this->load->view('v2/pages/plaid_account/ajax_load_connected_bank_accounts', $this->page_data);
    }

    public function ajax_load_connected_bank_accounts_thumbnail()
    {
        $this->load->model('PlaidAccount_model');
        $this->load->model('PlaidBankAccount_model');
        $this->load->model('PlaidErrorLogs_model');

        $is_valid = 1;
        $cid = logged('company_id');
        $uid = logged('id');
        $role_id = logged('role');
        $user_type = logged('user_type');
        
        if( $user_type == 7 || $role_id == 3 ){
            $plaidBankAccounts = $this->PlaidBankAccount_model->getAllByCompanyId($cid);        
            $plaidAccount  = $this->PlaidAccount_model->getDefaultCredentials();
            $recentTransactions = array();
            if( $plaidAccount ){
                foreach($plaidBankAccounts as $pc){            
                    try{
                        $start_date = date('Y-m-d', strtotime("-1 week"));
                        $end_date   = date("Y-m-d");

                        $balance = balanceGet($plaidAccount->client_id, $plaidAccount->client_secret, $pc->access_token, $pc->account_id);
                        $plaidTransactions = transactionGet($plaidAccount->client_id, $plaidAccount->client_secret, $pc->access_token, $start_date, $end_date, $pc->account_id, 5);  
                        if( isset($balance->error_code) && $balance->error_code != '' ){
                            $pc->balance_available = 'Cannot fetch bank account balance';
                            $pc->balance_current   = 'Cannot fetch bank account balance';

                            $err_data = [
                                'user_id' => $uid,
                                'log_date' => date("Y-m-d H:i:s"),
                                'log_msg' => $balance->error_code . ' / ' . $balance->error_message
                            ];

                            $this->PlaidErrorLogs_model->create($err_data);
                        }else{
                            if( !empty($balance->accounts) ){
                                $pc->balance_available = $balance->accounts[0]->balances->available;
                                $pc->balance_current   = $balance->accounts[0]->balances->current;
                            }
                        }

                        if( $plaidTransactions && $plaidTransactions->transactions ){
                            $recentTransactions[] = $plaidTransactions->transactions;
                        }
                    }catch(Exception $e){
                        $err = $e->getMessage();

                        $err_data = [
                            'user_id' => $uid,
                            'log_date' => date("Y-m-d H:i:s"),
                            'log_msg' => $err
                        ];

                        $this->PlaidErrorLogs_model->create($err_data);
                    }         
                }
            }else{
                $is_valid = 0;
            }
        }else{
           $plaidBankAccounts = array();
           $recentTransactions = array(); 
        }
        
        
        $this->page_data['is_valid'] = $is_valid;
        $this->page_data['plaidBankAccounts']  = $plaidBankAccounts;
        $this->page_data['recentTransactions'] = $recentTransactions;
        $this->load->view('v2/pages/plaid_account/ajax_load_connected_bank_accounts_thumbnails', $this->page_data);
    }

    public function ajax_delete_bank_account()
    {
        $this->load->model('PlaidBankAccount_model');

        $is_success = 0;
        $msg = "Cannot find data";

        $cid     =  logged('company_id');
        $post    = $this->input->post();   
        $plaidBankAccount = $this->PlaidBankAccount_model->getById($post['pid']);
        if( $plaidBankAccount ){
            if( $plaidBankAccount->company_id == $cid ){
                $this->PlaidBankAccount_model->delete($post['pid']);

                $is_success = 1;
                $msg = '';
            }
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_bank_account_transactions()
    {
        $this->load->model('PlaidAccount_model');
        $this->load->model('PlaidBankAccount_model');
        $this->load->model('PlaidErrorLogs_model');

        $is_valid = 0;
        $msg = 'Cannot connect to Plaid.';  

        $post = $this->input->post();    
        $cid  = logged('company_id');  
        $uid  = logged('id');  

        $apiPlaidTransactions = array();
        $apiPlaidAccount      = array();
        $plaidAccount = $this->PlaidAccount_model->getDefaultCredentials();
        $plaidBankAccount = $this->PlaidBankAccount_model->getById($post['pid']);
        if( $plaidAccount && $plaidBankAccount ){            
            $start_date = '2022-01-01';
            $end_date   = '2022-08-25';
            $apiPlaidTransactions = transactionGet($plaidAccount->client_id, $plaidAccount->client_secret, $plaidBankAccount->access_token, $start_date, $end_date, $plaidBankAccount->account_id);
            $apiPlaidAccount  = authGet($plaidAccount->client_id, $plaidAccount->client_secret, $plaidBankAccount->access_token, $plaidBankAccount->account_id);

            if( isset($apiPlaidAccount->error_code) && $apiPlaidAccount->error_code != '' ){
                $err_data = [
                    'user_id' => $uid,
                    'log_date' => date("Y-m-d H:i:s"),
                    'log_msg' => $apiPlaidAccount->error_code . ' / ' . $apiPlaidAccount->error_message
                ];

                $this->PlaidErrorLogs_model->create($err_data);
            }else{
                $is_valid = 1;    
            }
        }else{
            $msg = 'Invalid Plaid Credentials';
        }       

        $this->page_data['is_valid'] = $is_valid;
        $this->page_data['apiPlaidTransactions'] = $apiPlaidTransactions;
        $this->page_data['apiPlaidAccount'] = $apiPlaidAccount;
        $this->load->view('v2/pages/plaid_account/ajax_bank_account_transactions', $this->page_data);
        
    }

    public function ajax_bank_account_recurring_transactions()
    {
        $this->load->model('PlaidAccount_model');
        $this->load->model('PlaidBankAccount_model');
        $this->load->model('PlaidErrorLogs_model');

        $is_valid = 0;
        $msg = 'Cannot connect to Plaid.';  

        $post = $this->input->post();    
        $cid  = logged('company_id');   
        $uid  = logged('id'); 
        
        $apiPlaidAccount      = array();
        $apiPlaidRecurringTransactions = array();
        $plaidAccount = $this->PlaidAccount_model->getDefaultCredentials();
        $plaidBankAccount = $this->PlaidBankAccount_model->getById($post['pid']);
        if( $plaidAccount && $plaidBankAccount ){                        
            $apiPlaidAccount  = authGet($plaidAccount->client_id, $plaidAccount->client_secret, $plaidBankAccount->access_token, $plaidBankAccount->account_id);
            $apiPlaidRecurringTransactions = recurringTransactionsGet($plaidAccount->client_id, $plaidAccount->client_secret, $plaidBankAccount->access_token, $plaidBankAccount->account_id);

            if( isset($apiPlaidAccount->error_code) && $apiPlaidAccount->error_code != '' ){
                $err_data = [
                    'user_id' => $uid,
                    'log_date' => date("Y-m-d H:i:s"),
                    'log_msg' => $apiPlaidAccount->error_code . ' / ' . $apiPlaidAccount->error_message
                ];

                $this->PlaidErrorLogs_model->create($err_data);
            }else{
                $is_valid = 1;    
            }
        }else{
            $msg = 'Invalid Plaid Credentials';
        }       

        $this->page_data['is_valid'] = $is_valid;
        $this->page_data['apiPlaidAccount'] = $apiPlaidAccount;
        $this->page_data['apiPlaidRecurringTransactions'] = $apiPlaidRecurringTransactions;
        $this->load->view('v2/pages/plaid_account/ajax_bank_account_recurring_transactions', $this->page_data);
    }
}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */
