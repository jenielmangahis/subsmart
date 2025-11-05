<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlarmApiPublic extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper(['alarm_api_helper']);
        $this->load->helper(['alarm_dictionary_helper']);
	}

    public function importAlarmcomCustomers()
    {
        $alarmApi = new AlarmApi();
        $token = $alarmApi->generateAlarmToken();

        $pageNumber = 1;
        $pageSize = 100;
        $fields = ['customerId', 'loginName', 'firstName', 'lastName', 'email', 'phoneNumber', 'companyName', 'installAddress', 'panelVersion', 'modemInfo', 'joinDate', 'servicePlanInfo'];

        $this->db->truncate('alarmcom_customers');
        $this->db->query("ALTER TABLE alarmcom_customers AUTO_INCREMENT = 1");

        while (true) {
            $params = ['pageNumber' => $pageNumber, 'pageSize' => $pageSize];
            $getCustomerRequest = $alarmApi->alarmApiRequest("getCustomerIds", null, $token, null, $params);

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
    }

    public function importAlarmcomEquipments()
    {
        $this->load->helper(['alarm_api_helper']);
    
        $alarmApi = new AlarmApi();
        $token = $alarmApi->generateAlarmToken();
    
        if (!$token) {
            return;
        }
    
        $this->db->truncate('alarmcom_equipments');
        $this->db->query("ALTER TABLE alarmcom_equipments AUTO_INCREMENT = 1");
    
        $query = $this->db->query("
            SELECT customer_id 
            FROM alarmcom_customers 
            ORDER BY id ASC
        ");
    
        $customers = $query->result();
        if (empty($customers)) {
            return;
        }
    
        $chunks = array_chunk($customers, 30);
    
        foreach ($chunks as $batch) {
            $mh = curl_multi_init();
            $curlHandles = [];
            $customerMap = [];
    
            foreach ($batch as $customer) {
                $customerId = $customer->customer_id;
                $ch = $alarmApi->alarmApiRequest("getEquipmentsById", $customerId, $token, null, null);
    
                curl_multi_add_handle($mh, $ch);
                $curlHandles[] = $ch;
                $customerMap[(string) $ch] = $customerId;
            }
    
            $running = null;
            do {
                curl_multi_exec($mh, $running);
                curl_multi_select($mh);
            } while ($running > 0);
    
            foreach ($curlHandles as $ch) {
                $response = curl_multi_getcontent($ch);
                $customerId = $customerMap[(string) $ch];
                $equipmentDetails = json_decode($response, true);
    
                if (empty($equipmentDetails) || !is_array($equipmentDetails)) {
                    $retryCh = $alarmApi->alarmApiRequest("getEquipmentsById", $customerId, $token, null, null);
                    $retryResponse = curl_exec($retryCh);
                    curl_close($retryCh);
                    $equipmentDetails = json_decode($retryResponse, true);
                }
    
                if (!empty($equipmentDetails) && is_array($equipmentDetails)) {
                    $batchData = [];
                    foreach ($equipmentDetails as $equipment) {
                        $batchData[] = [
                            'customer_id' => $customerId,
                            'deviceId' => $equipment['deviceId'] ?? null,
                            'webSiteDeviceName' => $equipment['webSiteDeviceName'] ?? null,
                            'group' => $equipment['group'] ?? null,
                            'partition' => $equipment['partition'] ?? null,
                            'monitoredForNormalActivity' => $equipment['monitoredForNormalActivity'] ?? null,
                            'status' => is_array($equipment['status']) ? ($equipment['status'][0] ?? null) : ($equipment['status'] ?? null),
                            'deviceType' => $equipment['deviceType'] ?? null,
                            'nonReportingFlag' => $equipment['nonReportingFlag'] ?? null,
                            'manufacturerSpecificInfo' => $equipment['manufacturerSpecificInfo'] ?? null,
                            'isSecondaryLoop' => $equipment['isSecondaryLoop'] ?? null,
                            'isExistingEquipment' => $equipment['isExistingEquipment'] ?? null,
                            'zwaveManufacturer' => $equipment['zwaveManufacturer'] ?? null,
                            'mac' => $equipment['mac'] ?? null,
                            'videoDeviceModel' => $equipment['videoDeviceModel'] ?? null,
                            'installDate' => $equipment['installDate'] ?? null,
                            'maintainDate' => $equipment['maintainDate'] ?? null,
                            'statusDate' => $equipment['statusDate'] ?? null,
                        ];
                    }
    
                    if (!empty($batchData)) {
                        $this->db->insert_batch('alarmcom_equipments', $batchData);
                    }
                }
    
                curl_multi_remove_handle($mh, $ch);
                curl_close($ch);
            }
    
            curl_multi_close($mh);
        }
    }
}