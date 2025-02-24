<?php
class AlarmApi
{
    public function generateToken()
    {
        $token = '';
        $error = '';

        $client_id = 'a7fcfa9b-1392-46da-8823-0a200bf5e10f';
        $username  = 'Adialarms.com';
        $password  = 'cZUj@8Sz3G4#dTk';
        
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
}