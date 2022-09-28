<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Api extends MYF_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function createAdtSalesPortalProjects()
    {
        $this->load->helper('adt_portal_helper');
        $this->load->model('UserPortalAccount_model');

        $userPortalAccounts = $this->UserPortalAccount_model->getAll();
        foreach($userPortalAccounts as $up){
            $projects = portalSyncProjects($up->user_id, $up->company_id, $up->username, $up->password_plain);
            if( $projects['total_projects'] > 0 ){
                $syncResult = portalUpdateIsSyncProjects($projects['project_ids']);
            }
        }
    }

    public function v1CreateAdtSalesPortalProjectsNonAPI()
    {
        $this->load->helper('adt_portal_helper');
        $this->load->model('UserPortalAccount_model');

        $total_updated = 0;
        $portalUsers = $this->UserPortalAccount_model->getAll();        
        foreach( $portalUsers as $pu ){
            $projectResult = portalSyncProjectsNonAPI($pu->user_id, $pu->company_id, $pu->username, $pu->password_plain);            
            if( $projectResult['total_projects'] > 0 ){
                $updateResult  = portalUpdateIsSyncProjectsNonAPI($projectResult['project_ids']);
                $total_updated += $updateResult['total_updated'];
            }
        }

        echo 'Total Sync projects : ' . $total_updated;
        exit;
    }

    public function createAdtSalesPortalProjectsNonAPI()
    {
        $this->load->helper('adt_portal_helper');
        $this->load->model('UserPortalAccount_model');
        $this->load->model('CustomerSettings_model');
        $this->load->model('AdtSalesSyncLogs_model');

        $total_updated = 0;          
        $enabledCompanies  = $this->CustomerSettings_model->getAllEnabledAdtSyncSetting();
        foreach($enabledCompanies as $c){
            $total_per_company = 0;
            $portalUsers = $this->UserPortalAccount_model->getAllByCompanyId($c->company_id);               
            foreach( $portalUsers as $pu ){
                $projectResult = portalSyncProjectsNonAPI($pu->user_id, $pu->company_id, $pu->username, $pu->password_plain);            
                if( $projectResult['total_projects'] > 0 ){
                    $updateResult  = portalUpdateIsSyncProjectsNonAPI($projectResult['project_ids']);
                    $total_updated += $updateResult['total_updated'];
                    $total_per_company += $updateResult['total_updated'];
                }
            }

            $data = [
                'company_id' => $c->company_id,
                'total_sync' => $total_per_company,
                'date_sync' => date("Y-m-d H:i:s")
            ];

            $this->AdtSalesSyncLogs_model->create($data);
        }
        
        echo 'Total Sync projects : ' . $total_updated;
        exit;
    }

    public function syncDataToAdtSalesPortal()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('AdtPortal_model');
        $this->load->model('AdtSalesSyncLogs_model');

        $conditions[] = ['field' => 'adt_sales_project_id >', 'value' => '0'];
        $customers  = $this->AcsProfile_model->getAllByIsSync(0, $conditions);
        $syncData   = array();
        $total_sync_data = 0;
        foreach( $customers as $c ){
            $adtProject = $this->AdtPortal_model->getByProjectByProjectId($c->adt_sales_project_id);
            if( $adtProject ){
                $adt_data = [
                    'street_address' => $c->mail_add,
                    'city' => $c->city,
                    'state' => $c->state,
                    'postal_code' => $c->zip_code,
                    'homeown_first_name' => $c->first_name,
                    'homeown_email' => $c->email,
                    'homeown_phone' => $c->phone_h,
                    'hoa_phone' => $c->phone_m,
                    'homeown_last_name' => $c->last_name
                ];
                $this->AdtPortal_model->updateProjectByProjectId($c->adt_sales_project_id, $adt_data);
                if( isset($syncData[$c->company_id]) ){
                    $syncData[$c->company_id]['total_sync'] += 1;
                }else{
                    $syncData[$c->company_id]['total_sync'] = 1;
                }

                $this->AcsProfile_model->updateByAdtSalesProjectId($c->adt_sales_project_id, ['is_sync' => 1]);

                $total_sync_data++;
            }
        }

        foreach($syncData as $key => $value){
            $sync_data = [
                'company_id' => $key,
                'total_sync' => $value['total_sync']
            ]; 

            $this->AdtSalesSyncLogs_model->create($sync_data);
        }

        echo 'Total Sync Data : ' . $total_sync_data;
    }
}

