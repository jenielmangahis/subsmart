<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$this->CI->load->helper('date');

function validateUserAccessModule($module_id){
	echo 45;exit;
    $ci = &get_instance();
    $ci->load->library('session');

    $is_allowed = false;

    $allowed_modules = $ci->session->userdata('userAccessModules');
    if( in_array($module_id, $allowed_modules) ){
        $is_allowed = true;
    }
    
    return $is_allowed;
}

function createEmployeeCommission($object_id, $object_type)
{
    $CI =& get_instance();
    $CI->load->model('EmployeeCommissionSetting_model');
    $CI->load->model('CommissionSetting_model');
    $CI->load->model('Jobs_model');
    $CI->load->model('EmployeeCommission_model');

    if( $object_type ==  $CI->CommissionSetting_model->isJob() ){
        $job = $CI->Jobs_model->get_specific_job($object_id);
        if( $job ){            
            $job_amount = 0;
            $jobItems   = $CI->Jobs_model->get_specific_job_items($object_id);
            foreach( $jobItems as $item ){
                $job_amount = $job_amount + $item->total;
            }

            //Techs
            $techs = [$job->employee2_id,$job->employee3_id,$job->employee4_id,$job->employee5_id,$job->employee6_id];              
            foreach($techs as $uid){
                if( $uid > 0 ){
                    $com_amount = 0;
                    $employeeCommissionSettings = $CI->EmployeeCommissionSetting_model->getAllByUserId($uid);
                    if( $employeeCommissionSettings ){
                        foreach( $employeeCommissionSettings as $ecs ){
                            if( $ecs->commission_type == $CI->CommissionSetting_model->commissionTypeAmount() ){ //Fixed Amount
                                $com_amount = $ecs->commission_value;
                            }elseif( $ecs->commission_type == $CI->CommissionSetting_model->commissionTypePercentage() ){ //Percentage
                                $com_amount = ($ecs->commission_value / 100) * $job_amount;
                            }
    
                            //Check if exists. Delete if exists
                            $isCommissionExists = $CI->EmployeeCommission_model->getByUserIdAndObjectIdAndObjectType($uid,$job->id, $CI->CommissionSetting_model->isJob());
                            if( $isCommissionExists ){
                                $CI->EmployeeCommission_model->delete($isCommissionExists->id);
                            }
                            
                            $commission_data = [
                                'company_id' => $job->company_id,
                                'user_id' => $uid,
                                'employee_commission_setting_id' => $ecs->id,
                                'object_id' => $job->id,
                                'object_type' => $CI->CommissionSetting_model->isJob(),
                                'commission_amount' => $com_amount,
                                'commission_date' => date("Y-m-d H:i:s"),
                                'is_paid' => 0
    
                            ];
                            
                            $CI->EmployeeCommission_model->create($commission_data);
    
                        }
                    }
                }
            }       
            
        }
    }    
}
?>