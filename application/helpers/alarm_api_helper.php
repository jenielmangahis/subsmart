<?php
class AlarmApi extends MY_Model
{
    public function generateToken()
    {

        $token = '';
        $error = '';

        $client_id = 'a7fcfa9b-1392-46da-8823-0a200bf5e10f';
        $username  = 'Adialarms.com';
        // $password  = 'cZUj@8Sz3G4#dTk';
        $password  = 'Chasemyles5$$$$$!';
        
        $post = [
            'client_id' => $client_id,
            'username' => $username,
            'password' => $password,
            'grant_type' => 'password',
        ];

        try {
            $url = 'https://alarmadmin.alarm.com/AdminApiAccess/token';
            $ch = curl_init();        
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);            
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
            
            $response = curl_exec($ch);
            $result = json_decode($response);  
            curl_close($ch);

            if (property_exists($result, 'error')){
                $error = $result->error_description;
            }else{
                $token = $result->access_token;
            }
        } catch (Exception $e) {
            $error = 'Cannot generate token.';
        }

        $return = ['token' => $token, 'error' => $error];
        return $return;
    }

    public function getCustomers($token, $page_size = 0, $page_number = 0)
    {
        $customers = [];
        $error = '';
        if( $page_number > 0 && $page_size > 0 ){
            $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers?pageSize='.$page_size.'&pageNumber='.$page_number;
        }else{
            $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers';
        }

        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        $post = [
            'client_id' => $client_id,
            'username' => $username,
            'password' => $password,
            'grant_type' => 'password',
        ];

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_POST, 1);            
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 

            if( is_array($result) ){
                $customers = $result;
            }else{
                if (property_exists($result, 'message')){
                    $error = $result->message;
                }else{
                    $error = 'Cannot connect to api.';
                }
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['customers' => $customers, 'error' => $error];
        return $return;
    }

    public function getCustomerInformation($customer_id, $fields = [], $token)
    {
        $customer = [];
        $error = '';
        if( $fields ){
            $fields_param = implode(",", $fields);
            $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers/'.$customer_id.'?fields='.$fields_param;
        }else{
            $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers/'.$customer_id;
        }
        
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 
            if (property_exists($result, 'message')){
                $error = $result->message;
            }else{
                $customer = $result;
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['customer' => $customer, 'error' => $error];
        return $return;
    }

    public function getCustomerEquipmentList($customer_id, $token)
    {
        $equipments = [];
        $error = '';
        $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers/'.$customer_id.'/equipment';
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 

            if( is_array($result) ){
                $equipments = $result;
            }else{
                if (property_exists($result, 'message')){
                    $error = $result->message;
                }else{
                    $error = 'Cannot connect to api.';
                }
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['data' => $equipments, 'error' => $error];
        return $return;
    }

    public function getReps($token)
    {
        $reps = [];
        $error = '';
        $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/reps';
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 
            if( is_array($result) ){
                $reps = $result;
            }else{
                if (property_exists($result, 'message')){
                    $error = $result->message;
                }else{
                    $error = 'Cannot connect to api.';
                }
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['reps' => $reps, 'error' => $error];
        return $return;
    }

    public function getDealerInformation($dealer_id, $token)
    {
        $dealer = [];
        $error = '';
        $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/dealers/'.$dealer_id;
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 

            if( $result ){
                $dealer = $result;
            }else{
                if (property_exists($result, 'message')){
                    $error = $result->message;
                }else{
                    $error = 'Cannot connect to api.';
                }
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['data' => $dealer, 'error' => $error];
        return $return;
    }

    public function getCustomerTroubleConditions($customer_id, $token)
    {
        $data = [];
        $error = '';
        $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers/'.$customer_id.'/trouble-conditions';
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 
            if( is_array($result) ){
                $data = $result;
            }else{
                if (property_exists($result, 'message')){
                    $error = $result->message;
                }else{
                    $error = 'Cannot connect to api.';
                }
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['data' => $data, 'error' => $error];
        return $return;
    }

    public function getDealerPackages($dealer_id, $token)
    {
        $packages = [];
        $error = '';
        $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/dealers/'.$dealer_id.'/packages';
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 
            if( is_array($result) ){
                $packages = $result;
            }else{
                if (property_exists($result, 'message')){
                    $error = $result->message;
                }else{
                    $error = 'Cannot connect to api.';
                }
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['packages' => $packages, 'error' => $error];
        return $return;
    }

    public function customerSystemCheck($customer_id, $token)
    {
        $data = [];
        $error = '';
        $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers/'.$customer_id.'/system-check';
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 
            if (property_exists($result, 'message')){
                $error = $result->message;
            }else{
                $data = $result;
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['data' => $data, 'error' => $error];
        return $return;
    }

    public function sendCustomerSystemCheck($customer_id, $token)
    {
        $data = [];
        $error = '';
        $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers/'.$customer_id.'/system-check';
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 
            if( is_array($result) ){
                $data = $result;
            }else{
                if (property_exists($result, 'message')){
                    $error = $result->message;
                }else{
                    $error = 'Cannot connect to api.';
                }
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['data' => $data, 'error' => $error];
        return $return;
    }

    public function getCustomerServicePlans($customer_id, $token)
    {
        $data = [];
        $error = '';
        $url = 'https://alarmadmin.alarm.com/PartnerApi/v1/customers/'.$customer_id.'/service-plans/current/price';
        $headers   = [];
        $headers[] = 'Authorization: Bearer '.$token;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $result = json_decode($response); 
            if( $result ){
                $data = $result;
            }else{
                $error = 'No records found.';
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $return = ['data' => $data, 'error' => $error];
        return $return;
    }

    public function optionFeatures()
    {
        $options = array(1 => 'VoiceNotificationsForAlarms', 2 => 'VoiceNotificationsForMonitoring', 3 => 'LightAutomation', 4 => 'UserCodeControl', 5 => 'RemoteArming', 6 => 'ThermostatControl', 7 => 'ArmingSupervision', 8 => 'NormalActivityReports', 9 => 'ArmingReports', 10 => 'ArmingSchedules', 11 => 'Inactivity', 12 => 'FiveNormalActivitySensors', 14 => 'ProVideo', 15 => 'ProVideoPlus', 16 => 'TwoFiftyMBExtraVideoStorage', 17 => 'TwoWayVoice', 20 => 'WeatherToPanel', 21 => 'DigitalInputVideos', 22 => 'MedicationAlerts', 23 => 'ZWaveLights', 24 => 'ZWaveThermostats', 25 => 'ZWaveLocks', 26 => 'EnterpriseNotices', 27 => 'ZWaveEnergy', 28 => 'Reminders', 29 => 'SevereWeatherAlerts', 30 => 'ImageSensorAlarms', 31 => 'ImageSensorPlus', 32 => 'ImageSensorExtraUploads', 35 => 'EnterpriseSecurityConsole', 36 => 'SmartEnergyPlus', 38 => 'Securus', 39 => 'LutronRemoteAccess', 40 => 'Obsolete_LutronLightsAndThermostats', 41 => 'IDProtection', 42 => 'GreenButton', 43 => 'GarageDoors', 44 => 'Wellness', 45 => 'AdvancedEnergy', 46 => 'AdvancedAutomation', 47 => 'LutronIntegration', 48 => 'LiftMasterIntegration', 49 => 'SchneiderIntegration', 50 => 'Video24x7PerSVR', 51 => 'TaggIntegration', 52 => 'WaterManagement', 53 => 'CommercialActivityReports', 54 => 'BeCloseCommunityView', 55 => 'ULCommericial', 56 => 'SolarMonitoring', 57 => 'SolarEdgeIntegration', 58 => 'EnphaseIntegration', 59 => 'NESTIntegration', 60 => 'SMSAlarms', 61 => 'SMSNotificationsMexico', 62 => 'EnterpriseEnergy', 63 => 'EnterpriseWellness', 64 => 'IrrigationControl', 65 => 'RachioIntegration', 66 => 'ConnectedCar', 67 => 'PropaneMonitoring', 68 => 'SMSNotificationsChile', 69 => 'SMSNotificationsColombia', 70 => 'SMSNotificationsNZ', 71 => 'SMSNotificationsAustralia', 72 => 'SMSNotificationsBrazil', 73 => 'SMSNotificationsPanama', 74 => 'CosaIntegration', 75 => 'OSnappIntegration', 76 => 'ConnectedCarPlus', 77 => 'DoorbellCameras', 78 => 'UnexpectedActivityAlerts', 79 => 'AccessControl', 80 => 'ZWaveCO', 81 => 'HourlySupervision', 82 => 'SixHourSupervision', 83 => 'BasicDoorbell', 84 => 'AlarmVisualVerification', 85 => 'PanicButton', 87 => 'AudioIntegration', 88 => 'KonaLabsWaterMetering', 89 => 'VideoDeviceAudio', 90 => 'CancelVerify', 91 => 'SMSNotificationsBelgium', 92 => 'AccessControlDoors', 94 => 'RouterLimits', 97 => 'HomeControllerIntegration', 98 => 'FlexIO', 99 => 'SMSNotificationsSweden', 100 => 'SMSNotificationsNetherlands', 101 => 'ProVideoWithAnalytics', 102 => 'ConnectedCarCalAmp', 103 => 'SMSNotificationsNorway', 104 => 'SMSNotificationsIreland', 105 => 'CarrierCorIntegration', 106 => 'BuilderDoorbell', 107 => 'AccessPlanUserManagement', 108 => 'WaterManagementPlus', 109 => 'SmarterBusinessTemperatureMonitoring', 110 => 'CommercialVideo8', 111 => 'CommercialVideo16', 112 => 'CommercialVideo8Expansion', 113 => 'CommercialVideo16Expansion', 114 => 'LennoxIComfortIntegration', 115 => 'AlarmLink', 116 => 'ImageSensorLimited', 119 => 'SolarIntegration', 120 => 'ZWaveShades', 121 => 'UnattendedShowing', 122 => 'AccessControl16', 123 => 'AccessControl32', 124 => 'AccessControl64', 125 => 'SmartViewForOnboardRecording', 126 => 'OpenEyeCloudConnect', 127 => 'BusinessActivityAnalytics', 128 => 'PremiumVideo', 129 => 'ExtraSmarterBusinessTemperatureMonitoringSensors', 130 => 'SmartViewForOnboardRecordingCV', 131 => 'VideoAnalyticsRuleCreated', 132 => 'ProVideoWithAnalytics1000', 133 => 'AzureActiveDirectoryIntegration', 134 => 'VideoAnalyticsRuleCreated2000', 135 => 'Ambient', 136 => 'UnattendedShowingSolution', 137 => 'SingleDoorbellWithAnalytics', 138 => 'CommercialVideo4', 139 => 'CommercialVideo4Expansion', 140 => 'VideoBasic', 141 => 'VideoBasicWithAnalytics', 142 => 'VideoAwareness', 143 => 'VideoComplete', 144 => 'VideoOneCameraAddOn', 145 => 'BaseCallTime', 146 => 'ImageUploadCount', 147 => 'IOLights', 148 => 'IOLocks', 149 => 'IOGarageDoorsAndGates', 150 => 'NestVideoIntegration', 151 => 'EssenceMPERS', 152 => 'Builder770BasicDoorbell', 153 => 'Builder770PremiumDoorbell', 154 => 'ThirtyMinuteSupervision', 155 => 'NestAwareResale', 156 => 'SmarterAccessControlPlus', 157 => 'AccessControlPlus16', 158 => 'AccessControlPlus32', 159 => 'AccessControlPlus64', 160 => 'AccessControlPlusDoors', 161 => 'MobileCredentials', 162 => 'LiftMasterSurcharge', 163 => 'FreeMobileCredentials', 164 => 'VideoPropertyPanic', 165 => 'SmartArming', 166 => 'CommercialVideo2Basic', 167 => 'CommercialVideo2BasicExpansion', 168 => 'WaterCloudDevices', 169 => 'ElevatedEventsMonitoring', 170 => 'ZWaveNoiseSensors', 171 => 'ThirdPartyCameras', 173 => 'CellRouter', 174 => 'ConnectedFleet', 175 => 'AmbientVoice', 176 => 'WifiAwareness', 177 => 'MobileCredentials2500', 178 => 'MobileCredentials5000', 179 => 'MobileCredentials7500', 180 => 'LocalMalfunctionSignalingAndSecondaryReaderSupport', 181 => 'PropertyActions', 183 => 'GunshotDetectionSDS', 184 => 'GunshotDetectionPlusSDS', 185 => 'MultiLevelEnterpriseSecurityConsole', 186 => 'CameraTwoWayAudioforMonitoringResponse', 187 => 'Noonlight', 188 => 'ProactiveVideoEscalatedEventMonitoring', 189 => 'AccessControlEscalatedEventMonitoring', 192 => 'ContinuousAudioRecordingSvr', 193 => 'ContinuousAudioRecordingOnboard', 194 => 'HazeGuard', 195 => 'HazeGuardAdditionalUnits', 196 => 'SixMinuteSupervision', 198 => 'AIDeterrence', 199 => 'RetentionEngine', 200 => 'SunFlowerLabsDrone', 201 => 'VideoIntercomDirectoryUser', 202 => 'VideoIntercomManagement', 203 => 'FallDetection', 204 => 'ExternalVideoMonitoringSoftwareSupport', 205 => 'MobileCredentials100');

        return $features;
    }

    // Optimized version
    public function generateAlarmToken()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['alarm_token']) && (time() - ($_SESSION['alarm_token_time'] ?? 0) < 0)) {
            return $_SESSION['alarm_token'];
        }

        $credentials = [
            "client_id" => "a7fcfa9b-1392-46da-8823-0a200bf5e10f",
            "grant_type" => "password",
            "username" => "Adialarms.com",
            "password" => "Chasemyles5$$$$$!",
        ];

        try {
            $ch = curl_init('https://alarmadmin.alarm.com/AdminApiAccess/token');
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($credentials),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 10,
            ]);

            $response = curl_exec($ch);
            if ($response === false) {
                throw new Exception('cURL Error: ' . curl_error($ch));
            }

            $result = json_decode($response);
            curl_close($ch);

            if (!empty($result->access_token)) {
                $_SESSION['alarm_token'] = $result->access_token;
                $_SESSION['alarm_token_time'] = time();
                return $result->access_token;
            }

        } catch (Exception $e) {}

        return null;
    }

    public function getAlarmCustomers($token, $param = [])
    {
        $url = "https://alarmadmin.alarm.com/PartnerApi/v1/customers";

        if (!empty($param) && is_array($param)) {
            $url .= '?' . http_build_query($param);
        }

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$token}",
                "Content-Type: application/json",
            ],
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_TCP_FASTOPEN => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);

        return $ch;
    }

    public function getAlarmCustomerDetails($customer_id, $token, $fields = [])
    {
        $url = "https://alarmadmin.alarm.com/PartnerApi/v1/customers/{$customer_id}";

        if (!empty($fields) && is_array($fields)) {
            $url .= '?fields=' . implode(',', $fields);
        }

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$token}",
                "Content-Type: application/json",
            ],
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,         
            CURLOPT_TCP_FASTOPEN => true,  
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);

        return $ch;
    }

    public function getAlarmCustomerEquipmentDetails($customer_id, $token)
    {
        $url = "https://alarmadmin.alarm.com/PartnerApi/v1/customers/{$customer_id}/equipment";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$token}",
                "Content-Type: application/json",
            ],
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_TCP_FASTOPEN => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['error' => $error];
        }

        curl_close($ch);
        return json_decode($response, true); 
    }

    public function getAlarmCustomerInfo($customer_id, $token)
    {
        $url = "https://alarmadmin.alarm.com/PartnerApi/v1/customers/{$customer_id}";
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$token}",
                "Content-Type: application/json",
            ],
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_TCP_FASTOPEN => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['error' => $error];
        }

        curl_close($ch);
        return json_decode($response, true); 
    }

    public function getAlarmServicePlansInfo($customer_id, $token)
    {
        $url = "https://alarmadmin.alarm.com/PartnerApi//v1/customers/{$customer_id}/service-plans/current/price";
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$token}",
                "Content-Type: application/json",
            ],
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_TCP_FASTOPEN => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['error' => $error];
        }

        curl_close($ch);
        return json_decode($response, true); 
    }

    public function searchAlarmCustomer($nameSearch, $fuzzySearch)
    {
        $this->load->database();

        $searchFields = [
            'first_name', 'last_name', 'email', 'phone_no',
            'company_name', 'street1', 'street2', 'city', 'state', 'zip'
        ];

        if (empty($nameSearch) || empty($fuzzySearch)) {
            return ['message' => 'Search keywords required'];
        }

        $normalize = fn($str) => strtolower(preg_replace('/[\s\W]+/', '', $str));
        $normalizedName  = $normalize($nameSearch);
        $normalizedFuzzy = $normalize($fuzzySearch);

        $customers = $this->db->get('alarmcom_customers')->result_array();
        if (empty($customers)) {
            return ['message' => 'No customer records found'];
        }

        foreach ($customers as $customer) {
            $fullName = $normalize(($customer['first_name'] ?? '') . ($customer['last_name'] ?? ''));
            if (strpos($normalizedName, $fullName) !== false || strpos($fullName, $normalizedName) !== false) {
                $customer['match_type'] = 'exact_name';
                $customer['match_score'] = 10;
                return $customer;
            }
        }

        $bestMatch = null;
        $highestScore = -1;

        foreach ($customers as $customer) {
            $score = 0;

            foreach ($searchFields as $field) {
                $value = $normalize($customer[$field] ?? '');

                if (strpos($value, $normalizedFuzzy) !== false) {
                    $score += 2;
                } else {
                    $lev = levenshtein($normalizedFuzzy, $value);
                    $maxLen = max(strlen($normalizedFuzzy), strlen($value));
                    $similarity = $maxLen > 0 ? 1 - ($lev / $maxLen) : 0;
                    $score += $similarity;
                }
            }

            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $customer;
                $bestMatch['match_type'] = 'fuzzy';
                $bestMatch['match_score'] = round($score, 4);
            }
        }

        return $bestMatch ?? ['message' => 'No match found'];
    }

}