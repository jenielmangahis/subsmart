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

    public function createAdtSalesPortalProjectsNonAPI()
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
}

