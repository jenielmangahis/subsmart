<?php
function portalValidateLogin($username, $password)
{   
    $CI =& get_instance();
    $CI->load->model('AcsProfile_model');

    $is_valid = 0;
    $msg = 'Invalid account';
    $portal_username = '';

    $post = [
        'portal_username' => $username,
        'portal_password' => $password,
    ];

    $url = 'https://portal.urpowerpro.com/api/v1/user/validate_login';
    $ch = curl_init();        
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, 1);            
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
    
    $response = curl_exec($ch);
    $data     = json_decode($response);

    if( $data->is_success == 1 ){
        $is_valid = 1;
        $portal_username = $data->portal_username;
        $msg = '';
    }

    $result = ['is_valid' => $is_valid, 'msg' => $msg, 'portal_username' => $portal_username];
    return $result;

}

function portalGetUserProjects($user_id, $company_id, $username, $password)
{       
    $CI =& get_instance();
    $CI->load->model('AcsProfile_model');

    $post = [
        'portal_username' => $username,
        'portal_password' => $password,
    ];

    $url = 'https://portal.urpowerpro.com/api/v1/user/get_projects';
    $ch = curl_init();        
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, 1);            
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
    
    $response = curl_exec($ch);
    $data     = json_decode($response);

    $projects = array();

    if( $data['total_records'] > 0 ){
        foreach( $data['projects'] as $prj ){
            //Save data
            if( $prj['project_id'] > 0 ){
                $projects[] = $prj;
            }
        }
    }

    $result = ['total_projects' => $data['total_records'], 'projects' => $projects];
    return $result;
}

function portalSyncProjects($user_id, $company_id, $username, $password)
{       
    $CI =& get_instance();
    $CI->load->model('AcsProfile_model');

    $post = [
        'portal_username' => $username,
        'portal_password' => $password,
    ];

    $url = 'https://portal.urpowerpro.com/api/v1/user/get_projects';
    $ch = curl_init();        
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, 1);            
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
    
    $response = curl_exec($ch);
    $data     = json_decode($response);

    $adt_project_ids = array();

    if( $data['total_records'] > 0 ){
        foreach( $data['projects'] as $prj ){
            //Save data
            if( $prj['project_id'] > 0 ){
                $customer = $CI->AcsProfile_model->getByAdtSalesProjectId($prj['project_id']);
                if( $customer ){
                    $customer_data = [
                        'contact_name' => $prj['hoa_name'],
                        'first_name' => $prj['homeown_first_name'],
                        'last_name' => $prj['homeown_last_name'],
                        'mail_add' => $prj['street_address'],
                        'city' => $prj['city'],
                        'state' => $prj['state'],
                        'zip_code' => $prj['postal_code'],
                        'email' => $prj['homeown_email'],
                        'phone_h' => $prj['homeown_phone'],
                        'phone_m' => $prj['hoa_phone']
                    ];
                    $CI->AcsProfile_model->updateByProfId($customer->prof_id,$customer_data);
                }else{
                    $customer_data = [
                        'company_id' => $company_id,
                        'fk_user_id' => $user_id,
                        'fk_sa_id' => $user_id,
                        'industry_type_id' => 0,
                        'contact_name' => $prj['hoa_name'],
                        'status' => 'NEW',
                        'customer_type' => 'Business',
                        'business_name' => '',
                        'first_name' => $prj['homeown_first_name'],
                        'middle_name' => '',
                        'last_name' => $prj['homeown_last_name'],
                        'mail_add' => $prj['street_address'],
                        'city' => $prj['city'],
                        'state' => $prj['state'],
                        'zip_code' => $prj['postal_code'],
                        'email' => $prj['homeown_email'],
                        'phone_h' => $prj['homeown_phone'],
                        'phone_m' => $prj['hoa_phone'],
                        'adt_sales_project_id' => $prj['project_id']
                    ];

                    $CI->AcsProfile_model->create($customer_data);
                }

                $adt_project_ids[] = $prj['project_id'];
            }
        }
    }

    $result = ['total_projects' => $data['total_records'], 'project_ids' => $adt_project_ids];
    return $result;
}

function portalUpdateIsSyncProjects( $project_ids = array() )
{
    if( !empty($project_ids) ){
        $json_data = 
        $post = ['project_ids' => json_encode($project_ids)];

        $url = 'https://portal.urpowerpro.com/api/v1/user/update_projects';
        $ch = curl_init();        
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);            
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
        
        $response = curl_exec($ch);
        $data     = json_decode($response);
    } 
}

function adtPortalGenerateToken($user_id) {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString . $user_id;
}

function portalSyncProjectsNonAPI($user_id, $company_id, $username, $password)
{       
    $CI =& get_instance();
    $CI->load->model('AcsProfile_model');
    $CI->load->model('AdtPortal_model');

    $adt_project_ids = array();
    $adtPortalUser   = $CI->AdtPortal_model->getByEmail($username);
    if( $adtPortalUser ){   
        $pwCheck = password_verify($password, $adtPortalUser->password);
        if( $pwCheck ){            
            $filter[] = ['field' => 'is_sync', 'value' => 0];
            $portalProjects = $CI->AdtPortal_model->getProjectsByUserId($adtPortalUser->user_id, $filter);
            foreach($portalProjects as $prj){
                $customer = $CI->AcsProfile_model->getByAdtSalesProjectId($prj->project_id);
                if( $customer ){
                    $customer_data = [
                        'contact_name' => $prj->hoa_name,
                        'first_name' => $prj->homeown_first_name,
                        'last_name' => $prj->homeown_last_name,
                        'mail_add' => $prj->street_address,
                        'city' => $prj->city,
                        'state' => $prj->state,
                        'zip_code' => $prj->postal_code,
                        'email' => $prj->homeown_email,
                        'phone_h' => $prj->homeown_phone,
                        'phone_m' => $prj->hoa_phone,
                        'is_sync' => 0
                    ];
                    $CI->AcsProfile_model->updateByAdtSalesProjectId($prj->project_id,$customer_data);
                }else{
                    $customer_data = [
                        'company_id' => $company_id,
                        'fk_user_id' => $user_id,
                        'fk_sa_id' => $user_id,
                        'industry_type_id' => 0,
                        'contact_name' => $prj->hoa_name,
                        'status' => 'NEW',
                        'customer_type' => 'Business',
                        'business_name' => '',
                        'first_name' => $prj->homeown_first_name,
                        'middle_name' => '',
                        'last_name' => $prj->homeown_last_name,
                        'mail_add' => $prj->street_address,
                        'city' => $prj->city,
                        'state' => $prj->state,
                        'zip_code' => $prj->postal_code,
                        'email' => $prj->homeown_email,
                        'phone_h' => $prj->homeown_phone,
                        'phone_m' => $prj->hoa_phone,
                        'adt_sales_project_id' => $prj->project_id,
                        'is_sync' => 0
                    ];

                    $CI->AcsProfile_model->create($customer_data);
                }

                $adt_project_ids[] = $prj->project_id;
            }
        }
    }

    $result = ['total_projects' => count($adt_project_ids), 'project_ids' => $adt_project_ids];
    return $result;
}

function portalUpdateIsSyncProjectsNonAPI( $project_ids = array() )
{
    $CI =& get_instance();
    $CI->load->model('AdtPortal_model');

    $total_updated = 0;
    if( !empty($project_ids) ){

        foreach($project_ids as $key => $prjid){
            $data = ['is_sync' => 1];
            $isUpdated = $CI->AdtPortal_model->updateProjectByProjectId($prjid, $data); 
            $total_updated++;   
        }
    } 

    $result = ['total_updated' => $total_updated];

    return $result;
}

function portalValidateLoginNonApi($username, $password)
{   
    $CI =& get_instance();
    $CI->load->model('AcsProfile_model');

    $is_valid = 0;
    $msg = 'Invalid account';
    $portal_username = '';

    $post = [
        'portal_username' => $username,
        'portal_password' => $password,
    ];

    $url = 'https://portal.urpowerpro.com/api/v1/user/validate_login';
    $ch = curl_init();        
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, 1);            
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
    
    $response = curl_exec($ch);
    $data     = json_decode($response);

    if( $data->is_success == 1 ){
        $is_valid = 1;
        $portal_username = $data->portal_username;
        $msg = '';
    }

    $result = ['is_valid' => $is_valid, 'msg' => $msg, 'portal_username' => $portal_username];
    return $result;

}