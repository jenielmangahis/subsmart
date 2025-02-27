<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlarmApiPortal extends MY_Controller {

	public function __construct(){

		parent::__construct();
	}


	public function customers()
    {
		$this->load->helper(array('alarm_api_helper'));
        $this->load->model('AcsProfile_model');

        $cid = logged('company_id');

        $alarmApi  = new AlarmApi();
        $token     = $alarmApi->generateToken();
        $customers = $alarmApi->getCustomers($token['token'],5,1);
        $alarmCustomers = [];
        $fields = ['customerId', 'firstName', 'lastName', 'email', 'phoneNumber'];
        foreach( $customers['customers'] as $d ){
            $customer_info = $alarmApi->getCustomerInformation($d->customerId, $fields, $token['token']);

            //Check if already link to customer table
            $isExists = $this->AcsProfile_model->getByAlarmIdAndCompanyId($customer_info['customer']->customerId, $cid);
            if( $isExists ){
                $customer_info['customer']->is_linked = 1;
                $customer_info['customer']->linked_customer = $isExists->prof_id;
            }else{
                $customer_info['customer']->is_linked = 0;
                $customer_info['customer']->linked_customer = 0;
            }

            $alarmCustomers[] = $customer_info['customer'];
        }

        $this->page_data['page']->title = 'Alarm API : Customers';
        $this->page_data['title']       = 'Alarm API : Customers';
		$this->page_data['alarmCustomers'] = $alarmCustomers;
		$this->load->view('v2/pages/alarm_portal/customers', $this->page_data);
	}

    public function ajax_view_customer_information()
    {
        $this->load->helper(array('alarm_api_helper'));

        $post = $this->input->post();

        $alarmApi = new AlarmApi();
        $token    = $alarmApi->generateToken();
        $customer_info = $alarmApi->getCustomerInformation($post['customer_id'], [], $token['token']);
        $customer_equipments = $alarmApi->getCustomerEquipmentList($post['customer_id'], $token['token']);
        $customer_package    = $alarmApi->getCustomerServicePlans($post['customer_id'], $token['token']);
        $this->page_data['customer_info'] = $customer_info['customer'];
        $this->page_data['customer_equipments'] = $customer_equipments['data'];
        $this->page_data['customer_package'] = $customer_package['data'];
        $this->load->view('v2/pages/alarm_portal/ajax_view_customer_information', $this->page_data);
    }

    public function ajax_customer_system_check()
    {
        $this->load->helper(array('alarm_api_helper'));

        $post = $this->input->post();

        $alarmApi = new AlarmApi();
        $token    = $alarmApi->generateToken();
        $customer_info = $alarmApi->getCustomerInformation($post['customer_id'], ['firstName', 'lastName'], $token['token']);
        $system_check  = $alarmApi->customerSystemCheck($post['customer_id'], $token['token']);
        $this->page_data['customer_info'] = $customer_info['customer'];
        $this->page_data['system_check']  = $system_check['data'];
        $this->load->view('v2/pages/alarm_portal/ajax_customer_system_check', $this->page_data);
    }

    public function ajax_import_customers()
    {
        $this->load->helper(array('alarm_api_helper'));
        $this->load->model('AcsProfile_model');

        $cid = logged('company_id');
        $is_success = 0;
        $msg = 'Cannot import data.';
        $customer_list   = '';
        $exist_customers = [];
        
        $alarmApi  = new AlarmApi();
        $token     = $alarmApi->generateToken(); 
        if( $token['token'] != '' ){
            $customers = $alarmApi->getCustomers($token['token'],5,1);  
            $fields    = ['customerId', 'firstName', 'lastName', 'email', 'phoneNumber' , 'installAddress'];
            foreach( $customers['customers'] as $d ){
                $customer_info = $alarmApi->getCustomerInformation($d->customerId, $fields, $token['token']);
                if( $customer_info['customer'] ){
                    $isCustomerNameExists = $this->AcsProfile_model->getByFirstNameAndLastNameAndCompanyId($customer_info['customer']->firstName, $customer_info['customer']->lastName, $cid);
                    if( $isCustomerNameExists ){
                        $this->AcsProfile_model->updateCustomerByProfId($isCustomerNameExists->prof_id, ['alarm_id' => $customer_info['customer']->customerId]);
                        $exist_customers[] = '<li>' . $isCustomerNameExists->first_name . ' ' . $isCustomerNameExists->last_name . '</li>';
                    }else{
                        $import_data[] = [
                            'alarm_id' => $customer_info['customer']->customerId,
                            'company_id' => logged('company_id'),
                            'fk_user_id' => logged('id'),
                            'customer_type' => 'Residential',
                            'status' => 'New',
                            'first_name' => $customer_info['customer']->firstName,
                            'middle_name' => '',
                            'last_name' => $customer_info['customer']->lastName,
                            'email' => $customer_info['customer']->email,
                            'phone_m' => $customer_info['customer']->firstName,
                            'phone_h' => '',
                            'mail_add' => $customer_info['customer']->installAddress->street1,
                            'city' => $customer_info['customer']->installAddress->city,
                            'state' => $customer_info['customer']->installAddress->state,
                            'zip_code' => $customer_info['customer']->installAddress->zip,
                            'cross_street' => $customer_info['customer']->installAddress->street1,
                            'is_archived' => 0,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ];
                    }                
                }
            }  
        }else{
            $msg = 'API error. Cannot create token.';
        }
        

        if( $import_data ){
            $this->AcsProfile_model->batchInsert($import_data);
            
            $is_success = 1;
            $msg = '';
        }

        if( $exist_customers ){
            $is_success = 1;
            
            $customer_list = implode("", $exist_customers);
            $msg = '<br /></br />Following customers already exists in your records and does not need to be created. <br /><ul class="info-list-existing-customer">'.$customer_list.'</ul>';
        }


        $data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
    }

    public function ajax_import_selected_customers()
    {
        $this->load->helper(array('alarm_api_helper'));
        $this->load->model('AcsProfile_model');

        $is_success = 0;
        $msg = 'Cannot import data.';

        $post = $this->input->post();
        $alarmApi  = new AlarmApi();
        $token     = $alarmApi->generateToken();  
        if( $token['token'] != '' ){
            $customers = $alarmApi->getCustomers($token['token'],5,1);  
            $fields = ['customerId', 'firstName', 'lastName', 'email', 'phoneNumber' , 'installAddress'];
            foreach( $post['alarmCustomer'] as $alarm_id ){
                $customer_info = $alarmApi->getCustomerInformation($alarm_id, $fields, $token['token']);
                if( $customer_info['customer'] ){
                    $isCustomerNameExists = $this->AcsProfile_model->getByFirstNameAndLastNameAndCompanyId($customer_info['customer']->firstName, $customer_info['customer']->lastName, $cid);
                    if( $isCustomerNameExists ){
                        $this->AcsProfile_model->updateCustomerByProfId($isCustomerNameExists->prof_id, ['alarm_id' => $customer_info['customer']->customerId]);
                        $exist_customers[] = '<li>' . $isCustomerNameExists->first_name . ' ' . $isCustomerNameExists->last_name . '</li>';
                    }else{
                        $import_data[] = [
                            'alarm_id' => $customer_info['customer']->customerId,
                            'company_id' => logged('company_id'),
                            'fk_user_id' => logged('id'),
                            'customer_type' => 'Residential',
                            'status' => 'New',
                            'first_name' => $customer_info['customer']->firstName,
                            'middle_name' => '',
                            'last_name' => $customer_info['customer']->lastName,
                            'email' => $customer_info['customer']->email,
                            'phone_m' => $customer_info['customer']->firstName,
                            'phone_h' => '',
                            'mail_add' => $customer_info['customer']->installAddress->street1,
                            'city' => $customer_info['customer']->installAddress->city,
                            'state' => $customer_info['customer']->installAddress->state,
                            'zip_code' => $customer_info['customer']->installAddress->zip,
                            'cross_street' => $customer_info['customer']->installAddress->street1,
                            'is_archived' => 0,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ];
                    } 
                }
            }  
        }else{
            $msg = 'API error. Cannot create token.';
        } 

        if( $import_data ){
            $this->AcsProfile_model->batchInsert($import_data);
            
            $is_success = 1;
            $msg = '';
        }

        if( $exist_customers ){
            $is_success = 1;
            
            $customer_list = implode("", $exist_customers);
            $msg = '<br /></br />Following customers already exists in your records and does not need to be created. <br /><ul class="info-list-existing-customer">'.$customer_list.'</ul>';
        }


        $data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
    }
}



/* End of file AlarmApiPortal.php */

/* Location: ./application/controllers/AlarmApiPortal.php */
