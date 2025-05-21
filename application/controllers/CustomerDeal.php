<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDeal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Customer Deals';
        $this->page_data['page']->menu = 'customers';

    }

    public function index()
    {   
        $this->load->model('CustomerDeal_model');
        $this->load->model('CustomerDealStage_model');
        $this->load->model('CustomerDealLabel_model');
        $this->load->model('CustomerDealActivitySchedule_model');

        $company_id = logged('company_id');
        $customerDealStages  = $this->CustomerDealStage_model->getAllByCompanyId($company_id);
        $customerDealLables  = $this->CustomerDealLabel_model->getAllByCompanyId($company_id);
        $optionSourceChannel = $this->CustomerDeal_model->optionSourceChannel();
        $optionVisibleTo     = $this->CustomerDeal_model->optionVisibleTo();
        $optionActivityTypes = $this->CustomerDealActivitySchedule_model->optionsActivityType();               
        $optionsPriorities   = $this->CustomerDealActivitySchedule_model->optionsPriority();               

        $this->page_data['customerDealStages']  = $customerDealStages;
        $this->page_data['optionSourceChannel'] = $optionSourceChannel;
        $this->page_data['customerDealLables']  = $customerDealLables;
        $this->page_data['optionVisibleTo']     = $optionVisibleTo;
        $this->page_data['optionActivityTypes'] = $optionActivityTypes;
        $this->page_data['optionsPriorities']   = $optionsPriorities;
        $this->load->view('v2/pages/customer_deals/index', $this->page_data);
    }

    public function ajax_deal_stages()
    {
        $this->load->model('CustomerDeal_model');
        $this->load->model('CustomerDealStage_model');
        $this->load->model('CustomerDealActivitySchedule_model');
        
        $company_id = logged('company_id');

        $sort = ['field' => 'name', 'order' => 'ASC'];
        $customerDealStages = $this->CustomerDealStage_model->getAllByCompanyId($company_id, $sort);

        $dataCustomerDeals = [];
        foreach($customerDealStages as $stage){
            $sort = ['field' => 'customer_deals.id', 'order' => 'DESC'];
            $filters[] = ['field' => 'customer_deals.status', 'value' => 'New'];
            $filters[] = ['field' => 'customer_deals.is_archive', 'value' => 'No'];
            $customerDeals = $this->CustomerDeal_model->getAllByCustomerDealStageId($stage->id, $sort, $filters);
            $sumDeals      = $this->CustomerDeal_model->getSumValueByCustomerDealStageId($stage->id);
            
            $total_deals   = 0;
            if( $customerDeals ){ 
                foreach( $customerDeals as $deal ){
                    $is_with_overdue   = 0;
                    $overdueActivities = $this->CustomerDealActivitySchedule_model->getOverdueActivitiesByCustomerDealId($deal->id);
                    if( $overdueActivities ){
                        $is_with_overdue = 1;
                    }     
                    $deal->is_with_overdue = $is_with_overdue;                  
                }     

                $total_deals = count($customerDeals);
                $dataCustomerDeals[$stage->id]['deals'] = $customerDeals;
            }

            $dataCustomerDeals[$stage->id]['total_deals'] = $total_deals;
            $dataCustomerDeals[$stage->id]['total_value'] = $sumDeals->total_value;
        }

        $this->page_data['customerDeals']      = $dataCustomerDeals;
        $this->page_data['customerDealStages'] = $customerDealStages;
        $this->load->view('v2/pages/customer_deals/ajax_deal_stages', $this->page_data);
    }

    public function ajax_create_deal_stage()
    {
        $this->load->model('CustomerDealStage_model');

        $is_success = 1;
        $msg = '';

        $company_id  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['stage_name'] == '' ){
            $is_success = 0;
            $msg = 'Please specify name';
        }

        if( isset($post['is_rotting_days']) && $post['rotting_num_days'] <= 0 ){
            $is_success = 0;
            $msg = 'Please specify rotting number of days';
        }

        $isNameExists = $this->CustomerDealStage_model->getByName($post['stage_name']);
        if( $isNameExists && $isNameExists->company_id == $company_id ){
            $is_success = 0;
            $msg = 'Deal stage name ' . $post['stage_name'] . ' already exits.';
        }

        if( $is_success == 1 ){

            $is_with_rotting_days = 'No';
            $rotting_days = 0;
            if( isset($post['is_rotting_days']) ){
                $is_with_rotting_days = 'Yes';
                $rotting_days = $post['rotting_num_days'];
            }

            $data = [
                'company_id' => $company_id,
                'name' => $post['stage_name'],
                'probability' => $post['stage_probability'],                
                'is_with_rotting_days' => $is_with_rotting_days,
                'rotting_days' => $rotting_days,
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            ];
            
            $this->CustomerDealStage_model->create($data); 

            //Activity Logs
            $activity_name = 'Customer Deals : Created deal stage ' . $post['stage_name']; 
            createActivityLog($activity_name);
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_edit_deal_stage()
    {
        $this->load->model('CustomerDealStage_model');
        
        $post = $this->input->post();
        $company_id = logged('company_id');
        $customerDealStage = $this->CustomerDealStage_model->getById($post['stage_id']);
        if( $customerDealStage && $customerDealStage->company_id == $company_id ){
            $this->page_data['customerDealStage'] = $customerDealStage;
            $this->load->view('v2/pages/customer_deals/ajax_edit_deal_stage', $this->page_data);
        }else{
            echo '<div class="alert alert-danger" role="alert">Data not found.</div>';
        }
    }

    public function ajax_update_deal_stage()
    {
        $this->load->model('CustomerDealStage_model');

        $is_success = 1;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post();
        
        if( $post['stage_name'] == '' ){
            $is_success = 0;
            $msg = 'Please specify name';
        }

        if( isset($post['is_rotting_days']) && $post['rotting_num_days'] <= 0 ){
            $is_success = 0;
            $msg = 'Please specify rotting number of days';
        }

        $isNameExists = $this->CustomerDealStage_model->getByName($post['stage_name']);
        if( $isNameExists && $isNameExists->company_id == $company_id && $isNameExists->id != $post['cdid'] ){
            $is_success = 0;
            $msg = 'Deal stage name ' . $post['stage_name'] . ' already exits.';
        }

        if( $is_success == 1 ){

            $customerDealStage = $this->CustomerDealStage_model->getById($post['cdid']);
            if( $customerDealStage && $customerDealStage->company_id == $company_id ){
                $is_with_rotting_days = 'No';
                $rotting_days = 0;
                if( isset($post['is_rotting_days']) ){
                    $is_with_rotting_days = 'Yes';
                    $rotting_days = $post['rotting_num_days'];
                }

                $data = [
                    'name' => $post['stage_name'],
                    'probability' => $post['stage_probability'],                
                    'is_with_rotting_days' => $is_with_rotting_days,
                    'rotting_days' => $rotting_days,
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                
                $this->CustomerDealStage_model->update($customerDealStage->id, $data); 

                //Activity Logs
                $activity_name = 'Customer Deals : Updated deal stage ' . $post['stage_name']; 
                createActivityLog($activity_name);

            }else{
                $is_success = 0;
                $msg = 'Cannot find data';
            }

        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_deal_stage()
    {
        $this->load->model('CustomerDealStage_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $is_success = 0;
        $msg = 'Cannot find data';

        $customerDealStage = $this->CustomerDealStage_model->getById($post['cdid']);
        if( $customerDealStage && $customerDealStage->company_id == $company_id ){
            $this->CustomerDealStage_model->delete($customerDealStage->id);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Customer Deals : Deleted deal stage ' . $customerDealStage->name; 
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_create_deal_label()
    {
        $this->load->model('CustomerDealLabel_model');

        $is_success = 1;
        $msg    = '';
        $label  = [];

        $company_id  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['label_name'] == '' ){
            $is_success = 0;
            $msg = 'Please specify name';
        }

        $isExists = $this->CustomerDealLabel_model->getByName($post['label_name']);
        if( $isExists && $isExists->company_id == $company_id ){
            $is_success = 0;
            $msg = 'Label name ' . $post['label_name'] . ' already exists';
        }

        if( $is_success == 1 ){

            $data = [
                'company_id' => $company_id,
                'name' => $post['label_name'],
                'color' => $post['label_color'],                
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            ];
            
            $id = $this->CustomerDealLabel_model->create($data); 

            $label = ['id' =>$id, 'name' => $post['label_name'], 'color' => $post['label_color']];

            //Activity Logs
            $activity_name = 'Customer Deals : Created deal label ' . $post['label_name']; 
            createActivityLog($activity_name);
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'label' => $label
        ];

        echo json_encode($return);
    }

    public function ajax_create_deal()
    {
        $this->load->model('CustomerDeal_model');

        $is_success = 1;
        $msg    = '';

        $company_id  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['deal_title'] == '' ){
            $is_success = 0;
            $msg = 'Please deal title';
        }

        if( $post['customer_id'] == '' ){
            $is_success = 0;
            $msg = 'Please select customer';
        }
        
        if( $is_success == 1 ){
            
            $labels = "";
            if( count($post['deal_label']) > 0 ){
                $labels = json_encode($post['deal_label']);
            }
            
            $data   = [
                'company_id' => $company_id,
                'owner_id' => $post['owner_id'],
                'customer_id' => $post['customer_id'],     
                'customer_deal_stage_id' => $post['deal_stage_id'],
                'deal_title' => $post['deal_title'],
                'value' => $post['deal_value'],
                'labels' => $labels,
                'probability' => $post['deal_probability'],
                'expected_close_date' => $post['expected_close_date'],
                'source_channel' => $post['source_channel'],
                'source_channel_id' => $post['source_channel_id'],
                'visible_to' => $post['visible_to'],
                'is_archive' => 'No',
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            ];
            
            $id = $this->CustomerDeal_model->create($data);

            //Activity Logs
            $activity_name = 'Customer Deals : Created deal ' . $post['deal_title']; 
            createActivityLog($activity_name);
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_label()
    {
        $this->load->model('CustomerDealLabel_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $customerDealLabel = $this->CustomerDealLabel_model->getById($post['label_id']);
        if( $customerDealLabel && $customerDealLabel->company_id == $company_id ){
            $this->CustomerDealLabel_model->delete($customerDealLabel->id);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Customer Deals : Deleted customer deal label ' . $customerDealLabel->name; 
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_update_deal_label()
    {
        $this->load->model('CustomerDealLabel_model');

        $is_success = 1;
        $msg    = '';

        $company_id  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['label_name'] == '' ){
            $is_success = 0;
            $msg = 'Please specify name';
        }

        $isExists = $this->CustomerDealLabel_model->getById($post['cdlid']);
        if( $isExists && $isExists->company_id == $company_id && $is_success == 1 ){
            $data = [
                'name' => $post['label_name'],
                'color' => $post['label_color'],   
                'date_modified' => date("Y-m-d H:i:s")
            ];
            
            $this->CustomerDealLabel_model->update($isExists->id, $data); 

            //Activity Logs
            $activity_name = 'Customer Deals : Updated deal label ' . $post['label_name']; 
            createActivityLog($activity_name);
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);
    }

    public function ajax_view_customer_deal()
    {
        $this->load->model('CustomerDeal_model');
        $this->load->model('CustomerDealStage_model');
        $this->load->model('CustomerDealLabel_model');
        $this->load->model('Users_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $customerDeal = $this->CustomerDeal_model->getById($post['customer_deal_id']);
        if( $customerDeal && $customerDeal->company_id == $company_id ){
            $label_ids  = json_decode($customerDeal->labels);
            $dealLabels = [];
            if( $label_ids ){                
                $filters[]  = ['field' => 'id', 'value' => $label_ids];
                $dealLabels = $this->CustomerDealLabel_model->getAllByCompanyId($company_id, $filters);
            }
            
            $owner = $this->Users_model->getUser($customerDeal->owner_id);
            $customerDealStages  = $this->CustomerDealStage_model->getAllByCompanyId($company_id);

            $this->page_data['customerDeal'] = $customerDeal;
            $this->page_data['customerDealStages'] = $customerDealStages;
            $this->page_data['dealLabels']   = $dealLabels; 
            $this->page_data['owner'] = $owner;
            $this->load->view('v2/pages/customer_deals/ajax_view_customer_deal', $this->page_data);
        }else{
            echo '<div class="alert alert-danger" role="alert">Record not found</div>';
        }
    }

    public function ajax_delete_customer_deal()
    {
        $this->load->model('CustomerDeal_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $is_success = 0;
        $msg = 'Cannot find data';

        $customerDeal = $this->CustomerDeal_model->getById($post['customer_deal_id']);
        if( $customerDeal && $customerDeal->company_id == $company_id ){
            //$this->CustomerDeal_model->delete($post['customer_deal_id']);
            $data = ['is_archive' => 'Yes'];
            $this->CustomerDeal_model->update($customerDeal->id, $data);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Customer Deals : Sent to archive customer deal ' . $customerDeal->deal_title; 
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_edit_customer_deal_form()
    {
        $this->load->model('CustomerDeal_model');
        $this->load->model('CustomerDealStage_model');
        $this->load->model('CustomerDealLabel_model');
        $this->load->model('Users_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $customerDeal = $this->CustomerDeal_model->getById($post['customer_deal_id']);
        if( $customerDeal && $customerDeal->company_id == $company_id ){

            $customerDealStages  = $this->CustomerDealStage_model->getAllByCompanyId($company_id);
            $customerDealLables  = $this->CustomerDealLabel_model->getAllByCompanyId($company_id);
            $optionSourceChannel = $this->CustomerDeal_model->optionSourceChannel();
            $optionVisibleTo     = $this->CustomerDeal_model->optionVisibleTo();
            $owner               = $this->Users_model->getUser($customerDeal->owner_id);

            $label_ids  = json_decode($customerDeal->labels);
            $dealLabels = [];
            if( $label_ids ){                
                $filters[]  = ['field' => 'id', 'value' => $label_ids];
                $dealLabels = $this->CustomerDealLabel_model->getAllByCompanyId($company_id, $filters);
            }

            $this->page_data['customerDeal'] = $customerDeal;
            $this->page_data['owner']        = $owner;
            $this->page_data['dealLabels']   = $dealLabels;
            $this->page_data['customerDealStages']  = $customerDealStages;
            $this->page_data['optionSourceChannel'] = $optionSourceChannel;
            $this->page_data['customerDealLables']  = $customerDealLables;
            $this->page_data['optionVisibleTo'] = $optionVisibleTo;
            $this->load->view('v2/pages/customer_deals/ajax_edit_customer_deal_form', $this->page_data);
        }else{
            echo '<div class="alert alert-danger" role="alert">Record not found</div>';
        }
    }

    public function ajax_update_deal()
    {
        $this->load->model('CustomerDeal_model');

        $is_success = 1;
        $msg    = '';

        $company_id  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['deal_title'] == '' ){
            $is_success = 0;
            $msg = 'Please deal title';
        }

        if( $post['customer_id'] == '' ){
            $is_success = 0;
            $msg = 'Please select customer';
        }    
        
        if( $is_success == 1 ){

            $customerDeal = $this->CustomerDeal_model->getById($post['customer_deal_id']);
            if( $customerDeal && $customerDeal->company_id == $company_id ){
                $labels = "";
                if( count($post['deal_label']) > 0 ){
                    $labels = json_encode($post['deal_label']);
                }
                
                $data   = [
                    'owner_id' => $post['owner_id'],
                    'customer_id' => $post['customer_id'],     
                    'customer_deal_stage_id' => $post['deal_stage_id'],
                    'deal_title' => $post['deal_title'],
                    'value' => $post['deal_value'],
                    'labels' => $labels,
                    'probability' => $post['deal_probability'],
                    'expected_close_date' => $post['expected_close_date'],
                    'source_channel' => $post['source_channel'],
                    'source_channel_id' => $post['source_channel_id'],
                    'visible_to' => $post['visible_to'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                
                $this->CustomerDeal_model->update($customerDeal->id, $data); 

                //Activity Logs
                $activity_name = 'Customer Deals : Updated deal ' . $post['deal_title']; 
                createActivityLog($activity_name);
            }else{
                $is_success = 0;
                $msg = 'Cannot find data';
            }
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    // Drag drop update
    public function ajax_update_customer_deal_stage()
    {
        $this->load->model('CustomerDeal_model');

        $is_success = 0;
        $msg = 'Cannot find data';
        $previous_stage_id = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $deal_id  = trim($post['deal_id']);
        $stage_id = trim($post['stage_id']);
        
        if( $deal_id > 0 && $stage_id > 0 ){
            $customerDeal = $this->CustomerDeal_model->getById($deal_id);
            if( $customerDeal && $customerDeal->company_id == $company_id ){
                $previous_stage_id = $customerDeal->customer_deal_stage_id;
                $this->CustomerDeal_model->update($customerDeal->id, ['customer_deal_stage_id' => $stage_id]);

                $is_success = 1;
                $msg = '';
            }
        } 

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'previous_stage_id' => $previous_stage_id
        ];

        echo json_encode($return);
    }

    public function ajax_update_customer_deal_status()
    {
        $this->load->model('CustomerDeal_model');

        $is_success = 0;
        $msg = 'Cannot find data';
        $stage_id = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $deal_id  = trim($post['deal_id']);
        
        if( $deal_id > 0 ){
            $customerDeal = $this->CustomerDeal_model->getById($deal_id);
            if( $customerDeal && $customerDeal->company_id == $company_id ){
                
                $this->CustomerDeal_model->update($customerDeal->id, ['status' => $post['status']]);

                //Activity Logs
                $activity_name = 'Customer Deals : Updated deal ' . $customerDeal->deal_title . ' status to ' . $post['status']; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';
                $stage_id = $customerDeal->customer_deal_stage_id;
            }
        } 

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'stage_id' => $stage_id
        ];

        echo json_encode($return);
    }

    public function ajax_deal_stage_summary()
    {
        $this->load->model('CustomerDeal_model');

        $post = $this->input->post();

        $filters[] = ['field' => 'customer_deals.status', 'value' => 'New'];
        $totalAmountValue = $this->CustomerDeal_model->getSumValueByCustomerDealStageId($post['stage_id'], $filters);
        $customerDeals = $this->CustomerDeal_model->getAllByCustomerDealStageId($post['stage_id'], [], $filters);

        $return = [
            'total_value' => $totalAmountValue->total_value,
            'total_records' => count($customerDeals)
        ];

        echo json_encode($return);
    }

    public function ajax_deal_scheduled_activities()
    {
        $this->load->model('CustomerDeal_model');
        $this->load->model('CustomerDealActivitySchedule_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $customerDeal = $this->CustomerDeal_model->getById($post['customer_deal_id']);
        if( $customerDeal && $customerDeal->company_id == $company_id ){
            $with_overdue = false;
            $sort = ['field' => 'customer_deal_activity_schedules.date_from', 'order' => 'ASC'];
            $filters[] = ['field' => 'customer_deal_activity_schedules.is_done', 'value' => 'No'];
            $activitySchedules = $this->CustomerDealActivitySchedule_model->getAllByCustomerDealId($post['customer_deal_id'], $sort, $filters);
            if( $activitySchedules ){                
                foreach($activitySchedules as $activity){
                    $activity->activity_type_properties = $this->CustomerDealActivitySchedule_model->optionsActivityType($activity->activity_type);
                    $activity->priority_properties      = $this->CustomerDealActivitySchedule_model->optionsPriority($activity->priority);
                }
            }  

            $this->page_data['activitySchedules'] = $activitySchedules;
            $this->load->view('v2/pages/customer_deals/ajax_deal_scheduled_activities', $this->page_data);
        }else{
            echo '<div class="alert alert-danger" role="alert">Record not found</div>';
        }
    }

    public function ajax_create_customer_deal_activity_schedule()
    {
        $this->load->model('CustomerDealActivitySchedule_model');
        $this->load->model('CustomerDeal_model');

        $is_success = 1;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        if( $post['activity_name'] == '' ){
            $is_success = 0;
            $msg = 'Please enter activity name';
        }

        if( $is_success == 1 ){
            $customerDeal         = $this->CustomerDeal_model->getById($post['cdi']);
            $isActivityNameExists = $this->CustomerDealActivitySchedule_model->getByActivityName($post['activity_name']);
            if( $isActivityNameExists && $isActivityNameExists->customer_deal_id == $post['cdi'] ){
                $is_success = 0;
                $msg = 'Activity name ' . $post['activity_name'] . ' already exists';
            }else{

                $is_done = 'No';
                if( $post['is_done'] ){
                    $is_done = 'Yes';
                }

                $data = [
                    'customer_deal_id' => $post['cdi'],
                    'owner_id' => $post['owner_id'],
                    'activity_name' => $post['activity_name'],
                    'activity_type' => $post['activity_type'],
                    'date_from' => date("Y-m-d",strtotime($post['date_from'])),
                    'date_to' => date("Y-m-d",strtotime($post['date_to'])),
                    'time_from' => date("H:i:s",strtotime($post['time_from'])),
                    'time_to' => date("H:i:s",strtotime($post['time_to'])),
                    'priority' => $post['activity_priority'],
                    'location' => $post['activity_location'],
                    'notes' => $post['activity_notes'],
                    'is_done' => $is_done,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s")
                ];

                $this->CustomerDealActivitySchedule_model->create($data);

                //Activity Logs                
                $activity_name = 'Customer Deals : Created activity schedule ' . $post['activity_name'] . ' for customer deal ' . $customerDeal->deal_title; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';

            }
        }        

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);
    }

    public function ajax_activity_is_done()
    {
        $this->load->model('CustomerDealActivitySchedule_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $activityScheduled = $this->CustomerDealActivitySchedule_model->getById($post['activity_id']);
        if( $activityScheduled ){
            $this->CustomerDealActivitySchedule_model->update($activityScheduled->id, ['is_done' => 'Yes']);

            //Activity Logs                
            $activity_name = 'Customer Deals : Changed activity ' . $activityScheduled->activity_name . ' to done'; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);
    }

    public function ajax_edit_activity_schedule_form()
    {
        $this->load->model('CustomerDealActivitySchedule_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        $activitySchedule = $this->CustomerDealActivitySchedule_model->getById($post['activity_id']);
        if( $activitySchedule && $activitySchedule->company_id == $company_id ){
            $optionActivityTypes = $this->CustomerDealActivitySchedule_model->optionsActivityType();               
            $optionsPriorities   = $this->CustomerDealActivitySchedule_model->optionsPriority();               

            $this->page_data['activitySchedule'] = $activitySchedule;
            $this->page_data['optionActivityTypes'] = $optionActivityTypes;
            $this->page_data['optionsPriorities'] = $optionsPriorities;
            $this->load->view('v2/pages/customer_deals/ajax_edit_activity_schedule_form', $this->page_data);
        }else{
            echo '<div class="alert alert-danger" role="alert">Record not found</div>';
        }
    }

    public function ajax_update_customer_deal_activity_schedule()
    {
        $this->load->model('CustomerDealActivitySchedule_model');
        $this->load->model('CustomerDeal_model');

        $is_success = 1;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        if( $post['activity_name'] == '' ){
            $is_success = 0;
            $msg = 'Please enter activity name';
        }

        if( $is_success == 1 ){
            $customerDeal         = $this->CustomerDeal_model->getById($post['cdi']);
            $isActivityNameExists = $this->CustomerDealActivitySchedule_model->getByActivityName($post['activity_name']);
            if( ($isActivityNameExists) && ($isActivityNameExists->customer_deal_id == $post['cdi'] && $isActivityNameExists->id != $post['asid']) ){
                $is_success = 0;
                $msg = 'Activity name ' . $post['activity_name'] . ' already exists';
            }else{
                $activitySchedule = $this->CustomerDealActivitySchedule_model->getById($post['asid']);
                if( $activitySchedule && $activitySchedule->company_id == $company_id ){
                    $is_done = $activitySchedule->is_done;
                    if( $post['is_done'] ){
                        $is_done = 'Yes';
                    }

                    $data = [
                        'owner_id' => $post['owner_id'],
                        'activity_name' => $post['activity_name'],
                        'activity_type' => $post['activity_type'],
                        'date_from' => date("Y-m-d",strtotime($post['date_from'])),
                        'date_to' => date("Y-m-d",strtotime($post['date_to'])),
                        'time_from' => date("H:i:s",strtotime($post['time_from'])),
                        'time_to' => date("H:i:s",strtotime($post['time_to'])),
                        'priority' => $post['activity_priority'],
                        'location' => $post['activity_location'],
                        'notes' => $post['activity_notes'],
                        'is_done' => $is_done,
                        'date_modified' => date("Y-m-d H:i:s")
                    ];

                    $this->CustomerDealActivitySchedule_model->update($activitySchedule->id, $data);

                    //Activity Logs                
                    $activity_name = 'Customer Deals : Updated activity schedule ' . $post['activity_name'] . ' for customer deal ' . $customerDeal->deal_title; 
                    createActivityLog($activity_name);

                    $is_success = 1;
                    $msg = '';
                }else{
                    $is_success = 0;
                    $msg = 'Cannot find data';
                }
            }
        }        

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);
    }

    public function ajax_delete_deal_activity_schedule()
    {
        $this->load->model('CustomerDealActivitySchedule_model');
        $this->load->model('CustomerDeal_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $activitySchedule = $this->CustomerDealActivitySchedule_model->getById($post['activity_id']);
        if( $activitySchedule && $activitySchedule->company_id == $company_id ){
            $this->CustomerDealActivitySchedule_model->delete($activitySchedule->id);

            //Activity Logs                
            $activity_name = 'Customer Deals : Deleted activity schedule <b>'.$activitySchedule->activity_type.'</b> for deal ' . $activitySchedule->deal_title; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);
    }
}
