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

    // Optimized version
    public function import_alarmcom_customers()
    {
        $this->load->helper(['alarm_api_helper']);
        $this->load->helper(['alarm_dictionary_helper']);
        $this->load->database();
        $alarmApi = new AlarmApi();
        $token = $alarmApi->generateAlarmToken();

        $pageNumber = 1;
        $pageSize = 100;
        $fields = ['customerId', 'loginName', 'firstName', 'lastName', 'email', 'phoneNumber', 'companyName', 'installAddress', 'panelVersion', 'modemInfo', 'joinDate', 'servicePlanInfo'];

        $this->db->truncate('alarmcom_customers');

        while (true) {
            $params = ['pageNumber' => $pageNumber, 'pageSize' => $pageSize];
            $getCustomerRequest = $alarmApi->getAlarmCustomers($token, $params);
            $response = curl_exec($getCustomerRequest);
            curl_close($getCustomerRequest);
            $customers = json_decode($response, true);

            if (empty($customers)) {
                break;
            }

            $multiHandle = curl_multi_init();
            $curlHandles = [];

            foreach ($customers as $index => $customer) {
                $ch = $alarmApi->getAlarmCustomerDetails($customer["customerId"], $token, $fields);
                curl_multi_add_handle($multiHandle, $ch);
                $curlHandles[$index] = $ch;
            }

            $running = null;
            do {
                curl_multi_exec($multiHandle, $running);
                curl_multi_select($multiHandle);
            } while ($running > 0);

            $sample = [];
            foreach ($curlHandles as $ch) {
                $response = curl_multi_getcontent($ch);
                $sample[] = json_decode($response, true);
                curl_multi_remove_handle($multiHandle, $ch);
                curl_close($ch);
            }

            curl_multi_close($multiHandle);

            foreach ($sample as $entry) {
                $address = $entry['installAddress'] ?? [];
                $modem_info = $entry['modemInfo'] ?? [];
                $service_plan_info = $entry['servicePlanInfo'] ?? [];

                $data = [
                    "customer_id" => $entry["customerId"],
                    "login_name" => $entry["loginName"],
                    "first_name" => $entry["firstName"],
                    "last_name" => $entry["lastName"],
                    "company_name" => $entry["companyName"] ?? null,
                    "email" => $entry["email"] ?? null,
                    "phone_no" => $entry["phoneNumber"] ?? null,
                    "street1" => $address["street1"] ?? null,
                    "street2" => $address["street2"] ?? null,
                    "city" => $address["city"] ?? null,
                    "state" => $address["state"] ?? null,
                    "zip" => $address["zip"] ?? null,
                    "panel_version" => getPanelDetails($entry["panelVersion"]) ?? null,
                    "modeminfo_network" => getNetworkDetails($modem_info["radioNetworkType"]) ?? null,
                    "modeminfo_imei" => $modem_info["imei"] ?? null,
                    "join_date" => $entry["joinDate"] ?? null,
                    "package_description" => $service_plan_info["packageDescription"] ?? null,
                    "package_total_price" => $service_plan_info["totalServicePrice"] ?? null,
                ];

                $this->db->insert('alarmcom_customers', $data);
            }

            $pageNumber++;
        }

        echo '<pre>';
        echo "Import complete.\n";
        echo "Last page reached: " . ($pageNumber - 1) . "\n";
        echo '</pre>';
    }

    // public function search_alarmcom_customers()
    // {
    //     $nameKeyword = $this->input->get('name_keyword');
    //     $fuzzyKeyword = $this->input->get('fuzzy_keyword');
    
    //     $search_scope = [
    //         'first_name', 
    //         'last_name', 
    //         'email', 
    //         'phone_no', 
    //         'company_name', 
    //         'street1', 
    //         'street2', 
    //         'city', 
    //         'state', 
    //         'zip'
    //     ];
    
    //     if (empty($nameKeyword) || empty($fuzzyKeyword)) {
    //         // echo json_encode(['message' => 'Missing name_keyword or fuzzy_keyword']);
    //         echo json_encode(['message' => 'Not available']);
    //         return;
    //     }
    
    //     $normalizedName = strtolower(preg_replace('/[\s\W]+/', '', $nameKeyword));
    //     $normalizedFuzzy = strtolower(preg_replace('/[\s\W]+/', '', $fuzzyKeyword));

    //     $query = $this->db->get('alarmcom_customers');
    //     $raw_results = $query->result_array();
    
    //     $name_match_found = false;
    //     foreach ($raw_results as $row) {
    //         $full_name = strtolower(preg_replace('/[\s\W]+/', '', ($row['first_name'] ?? '') . ($row['last_name'] ?? '')));
    //         if (strpos($normalizedName, $full_name) !== false || strpos($full_name, $normalizedName) !== false) {
    //             $name_match_found = true;
    //             break;
    //         }
    //     }
    
    //     if (!$name_match_found) {
    //         echo json_encode(['message' => 'Not available']);
    //         return;
    //     }
    
    //     $best_match = null;
    //     $highest_score = -1;
    
    //     foreach ($raw_results as $row) {
    //         $score = 0;
    
    //         foreach ($search_scope as $field) {
    //             $value = strtolower(preg_replace('/[\s\W]+/', '', $row[$field] ?? ''));
    
    //             if (strpos($value, $normalizedFuzzy) !== false) {
    //                 $score += 2;
    //             } else {
    //                 $lev = levenshtein($normalizedFuzzy, $value);
    //                 $maxLen = max(strlen($normalizedFuzzy), strlen($value));
    //                 $similarity = $maxLen > 0 ? 1 - ($lev / $maxLen) : 0;
    //                 $score += $similarity;
    //             }
    //         }
    
    //         if ($score > $highest_score) {
    //             $highest_score = $score;
    //             $best_match = $row;
    //             $best_match['match_score'] = round($score, 4);
    //         }
    //     }
    
    //     echo json_encode($best_match);
    // }

    public function searchAlarmEquipment()
    {
        $this->load->helper(['alarm_api_helper']);
        $this->load->helper(['alarm_dictionary_helper']);
        $alarmApi = new AlarmApi();
        $token = $alarmApi->generateAlarmToken();
        $customer_id = $this->input->post('customer_id');

        $equipmentDetails = $alarmApi->getAlarmCustomerEquipmentDetails($customer_id, $token);

        $sensor_device       = [1,2,3,4,5,6,7,8,9,19,25,26,27,30,41,44,45,50,52,53,54,57,60,61,62,63,64,65,66,67,113,114,117,124,128,129];
        $peripheral_device   = [38,39,47,48,49,55,58,75,76,86,87,93,101,123,132];
        $video_device        = [11,30,68,91,93,126];
        $access_point_device = [82];
        $zwave_device        = [20,21,22,23,28,29,92];
        $liftmaster_device   = [36,37];
        $geo_device          = [13,42];
        $voice_device        = [56,78,79,88];
        $panel_device        = [127];

        $groupedDevices = [
            'sensor'        => [],
            'peripheral'    => [],
            'video'         => [],
            'access_point'  => [],
            'zwave'         => [],
            'liftmaster'    => [],
            'geo'           => [],
            'voice'         => [],
            'panel'         => [],
            'unknown'       => [],
        ];

        foreach ($equipmentDetails as $device) {
            $id = $device['deviceType'];
            $device['deviceName'] = getDeviceDetails($id);

            switch (true) {
                case in_array($id, $sensor_device):
                    $groupedDevices['sensor'][] = $device;
                    break;
                case in_array($id, $peripheral_device):
                    $groupedDevices['peripheral'][] = $device;
                    break;
                case in_array($id, $video_device):
                    $groupedDevices['video'][] = $device;
                    break;
                case in_array($id, $access_point_device):
                    $groupedDevices['access_point'][] = $device;
                    break;
                case in_array($id, $zwave_device):
                    $groupedDevices['zwave'][] = $device;
                    break;
                case in_array($id, $liftmaster_device):
                    $groupedDevices['liftmaster'][] = $device;
                    break;
                case in_array($id, $geo_device):
                    $groupedDevices['geo'][] = $device;
                    break;
                case in_array($id, $voice_device):
                    $groupedDevices['voice'][] = $device;
                    break;
                case in_array($device['deviceId'], $panel_device):
                    $groupedDevices['panel'][] = $device;
                    break;
                default:
                    $groupedDevices['unknown'][] = $device;
            }
        }

        echo json_encode($groupedDevices);
    }

    public function searchAlarmServicePlansInfo()
    {
        $this->load->helper(['alarm_api_helper']);
        $alarmApi = new AlarmApi();
        $token = $alarmApi->generateAlarmToken();
        $customer_id = $this->input->post('customer_id');

        $servicePlansDetails = $alarmApi->getAlarmServicePlansInfo($customer_id, $token);

        echo json_encode($servicePlansDetails);
    }

    public function searchAlarmCustomer()
    {
        $this->load->helper(['alarm_api_helper']);
        $alarmApi = new AlarmApi();
        $token = $alarmApi->generateAlarmToken();
        $customer_id = $this->input->post('customer_id');

        $customerDetails = $alarmApi->getAlarmCustomerInfo($customer_id, $token);

        echo '<pre>';
        print_r($customerDetails);
        echo '</pre>';
    }

    public function searchApiData($searchCategory)
    {
        $this->load->helper(['alarm_dictionary_helper']);
        $customer_id = $this->input->post('customer_id');
        $alarmcom_customer_id = $this->input->post('alarmcom_customer_id');

        switch ($searchCategory) {
            case 'getEquipment':
                $sensor_device       = [1,2,3,4,5,6,7,8,9,19,25,26,27,30,41,44,45,50,52,53,54,57,60,61,62,63,64,65,66,67,113,114,117,124,128,129];
                $peripheral_device   = [38,39,47,48,49,55,58,75,76,86,87,93,101,123,132];
                $video_device        = [11,30,68,91,93,126];
                $access_point_device = [82];
                $zwave_device        = [20,21,22,23,28,29,92];
                $liftmaster_device   = [36,37];
                $geo_device          = [13,42];
                $voice_device        = [56,78,79,88];
                $panel_device        = [127];

                $groupedDevices = [
                    'sensor'        => [],
                    'peripheral'    => [],
                    'video'         => [],
                    'access_point'  => [],
                    'zwave'         => [],
                    'liftmaster'    => [],
                    'geo'           => [],
                    'voice'         => [],
                    'panel'         => [],
                    'other'         => [],
                ];

                $query = $this->db->query("
                    SELECT 
                        `id`,
                        `customer_id`,
                        `deviceId`,
                        `webSiteDeviceName`,
                        `group`,
                        `partition`,
                        `monitoredForNormalActivity`,
                        `status`,
                        `deviceType`,
                        `nonReportingFlag`,
                        `manufacturerSpecificInfo`,
                        `isSecondaryLoop`,
                        `isExistingEquipment`,
                        `zwaveManufacturer`,
                        `mac`,
                        `videoDeviceModel`,
                        `installDate`,
                        `maintainDate`,
                        `statusDate`,
                        `date_updated`
                    FROM alarmcom_equipments
                    ORDER BY installDate ASC
                ");

                $equipmentDetails = $query->result();

                $filtered = array_filter($equipmentDetails, function ($device) use ($alarmcom_customer_id) {
                    return $device->customer_id == $alarmcom_customer_id;
                });

                foreach ($filtered as $device) {
                    $id = (int)$device->deviceType;
                    $device->deviceName = getDeviceDetails($id);

                    switch (true) {
                        case in_array($id, $sensor_device):
                            $groupedDevices['sensor'][] = $device;
                            break;
                        case in_array($id, $peripheral_device):
                            $groupedDevices['peripheral'][] = $device;
                            break;
                        case in_array($id, $video_device):
                            $groupedDevices['video'][] = $device;
                            break;
                        case in_array($id, $access_point_device):
                            $groupedDevices['access_point'][] = $device;
                            break;
                        case in_array($id, $zwave_device):
                            $groupedDevices['zwave'][] = $device;
                            break;
                        case in_array($id, $liftmaster_device):
                            $groupedDevices['liftmaster'][] = $device;
                            break;
                        case in_array($id, $geo_device):
                            $groupedDevices['geo'][] = $device;
                            break;
                        case in_array($id, $voice_device):
                            $groupedDevices['voice'][] = $device;
                            break;
                        case in_array($id, $panel_device):
                            $groupedDevices['panel'][] = $device;
                            break;
                        default:
                            $groupedDevices['other'][] = $device;
                    }
                }

                echo json_encode($groupedDevices);
            break;
            case 'getRemoteUtilityInfo':
                if ($alarmcom_customer_id) {
                    $alarmcomData = "
                        SELECT 
                            CAST(alarmcom_customers.customer_id AS CHAR CHARACTER SET utf8) AS data,
                            'customer_info' AS category
                        FROM alarmcom_customers
                        WHERE alarmcom_customers.customer_id = {$alarmcom_customer_id}
                        UNION
                        SELECT 
                            CAST(alarmcom_customers.panel_version AS CHAR CHARACTER SET utf8) AS data,
                            'panel_version' AS category
                        FROM alarmcom_customers
                        WHERE alarmcom_customers.customer_id = {$alarmcom_customer_id}
                        UNION
                        SELECT 
                            CAST(alarmcom_customers.login_name AS CHAR CHARACTER SET utf8) AS data,
                            'login_name' AS category
                        FROM alarmcom_customers
                        WHERE alarmcom_customers.customer_id = {$alarmcom_customer_id}
                        UNION
                        SELECT 
                            CAST(alarmcom_customers.package_description AS CHAR CHARACTER SET utf8) AS data,
                            'package_description' AS category
                        FROM alarmcom_customers
                        WHERE alarmcom_customers.customer_id = {$alarmcom_customer_id}
                        UNION
                        SELECT 
                            CAST('Always' AS CHAR CHARACTER SET utf8) AS data,
                            'monitoring' AS category
                    ";
                } else {
                    $alarmcomData = "
                        SELECT 
                            CAST('0' AS CHAR CHARACTER SET utf8) AS data,
                            'customer_info' AS category
                        UNION
                        SELECT 
                            CAST('None' AS CHAR CHARACTER SET utf8) AS data,
                            'panel_version' AS category
                        UNION
                        SELECT 
                            CAST('None' AS CHAR CHARACTER SET utf8) AS data,
                            'login_name' AS category
                        UNION
                        SELECT 
                            CAST('None' AS CHAR CHARACTER SET utf8) AS data,
                            'package_description' AS category
                        UNION
                        SELECT 
                            CAST('None' AS CHAR CHARACTER SET utf8) AS data,
                            'monitoring' AS category
                    ";
                }
            
                $query = $this->db->query("
                    {$alarmcomData}
                    UNION
                    SELECT 
                        CAST(acs_profile.status AS CHAR CHARACTER SET utf8) AS data,
                        'status' AS category
                    FROM acs_profile
                    WHERE acs_profile.prof_id = {$customer_id}
                    UNION
                    SELECT 
                        CAST(COUNT(acs_customer_documents.id) AS CHAR CHARACTER SET utf8) AS data,
                        'documents' AS category
                    FROM acs_customer_documents
                    WHERE acs_customer_documents.customer_id = {$customer_id}
                    UNION
                    SELECT 
                        CAST(0 AS CHAR CHARACTER SET utf8) AS data,
                        'gallery' AS category
                    UNION
                    SELECT 
                        CAST(ROUND(SUM(data), 2) AS CHAR CHARACTER SET utf8) AS data,
                        'ledger_balance' AS category
                    FROM (
                        SELECT 
                            ROUND(
                                CASE 
                                    WHEN (
                                        CASE 
                                            WHEN invoices.job_id IS NOT NULL AND invoices.job_id != '' THEN 
                                                (SELECT SUM(job_items.total) FROM job_items WHERE job_items.job_id = jobs.id)
                                            ELSE invoices.grand_total
                                        END
                                    ) - COALESCE(SUM(payment_records.invoice_amount), 0) < 0 
                                    THEN 0
                                    ELSE (
                                        CASE 
                                            WHEN invoices.job_id IS NOT NULL AND invoices.job_id != '' THEN 
                                                (SELECT SUM(job_items.total) FROM job_items WHERE job_items.job_id = jobs.id)
                                            ELSE invoices.grand_total
                                        END
                                    ) - COALESCE(SUM(payment_records.invoice_amount), 0)
                                END
                            , 2) AS data
                        FROM invoices
                        LEFT JOIN payment_records ON payment_records.invoice_id = invoices.id
                        LEFT JOIN users ON users.id = invoices.user_id
                        LEFT JOIN jobs ON jobs.id = invoices.job_id
                        LEFT JOIN acs_profile ON acs_profile.prof_id = invoices.customer_id
                        WHERE invoices.company_id = 31
                        AND invoices.customer_id = {$customer_id}
                        AND invoices.view_flag = 0
                        GROUP BY invoices.id
                    ) AS t
                    UNION
                    SELECT 
                        CAST(COUNT(acs_notes.id) AS CHAR CHARACTER SET utf8) AS data,
                        'notes' AS category
                    FROM acs_notes
                    WHERE acs_notes.fk_prof_id = {$customer_id}
                ");
                $data = $query->result();
                echo json_encode($data);
            break;
        }

    }

    public function testOnlyMethod()
    {
        $this->load->helper(['alarm_api_helper']);
        $alarmApi = new AlarmApi();
        $customer_id = $this->input->get('customer_id');

        $customerDetails = $alarmApi->alarmApiRequest("getCustomerById", $customer_id, null, null, null);

        echo '<pre>';
        print_r($customerDetails);
        echo '</pre>';
    }

}



/* End of file AlarmApiPortal.php */

/* Location: ./application/controllers/AlarmApiPortal.php */
