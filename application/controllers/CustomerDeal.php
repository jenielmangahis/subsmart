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

        $company_id = logged('company_id');
        $customerDealStages  = $this->CustomerDealStage_model->getAllByCompanyId($company_id);
        $customerDealLables  = $this->CustomerDealLabel_model->getAllByCompanyId($company_id);
        $optionSourceChannel = $this->CustomerDeal_model->optionSourceChannel();
        $optionVisibleTo     = $this->CustomerDeal_model->optionVisibleTo();
        

        $this->page_data['customerDealStages']  = $customerDealStages;
        $this->page_data['optionSourceChannel'] = $optionSourceChannel;
        $this->page_data['customerDealLables']  = $customerDealLables;
        $this->page_data['optionVisibleTo'] = $optionVisibleTo;
        $this->load->view('v2/pages/customer_deals/index', $this->page_data);
    }

    public function ajax_deal_stages()
    {
        $this->load->model('CustomerDeal_model');
        $this->load->model('CustomerDealStage_model');
        
        $company_id = logged('company_id');

        $sort = ['field' => 'name', 'order' => 'ASC'];
        $customerDealStages = $this->CustomerDealStage_model->getAllByCompanyId($company_id, $sort);

        $dataCustomerDeals = [];
        foreach($customerDealStages as $stage){
            $sort = ['field' => 'customer_deals.id', 'order' => 'DESC'];
            $customerDeals = $this->CustomerDeal_model->getAllByCustomerDealStageId($stage->id, $sort);
            $sumDeals      = $this->CustomerDeal_model->getSumValueByCustomerDealStageId($stage->id);
            
            $total_deals   = 0;
            if( $customerDeals ){                
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
            $this->CustomerDeal_model->delete($post['customer_deal_id']);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Customer Deals : Deleted customer deal ' . $customerDeal->deal_title; 
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

        $company_id = logged('company_id');
        $post = $this->input->post();

        $deal_id  = trim($post['deal_id']);
        $stage_id = trim($post['stage_id']);
        
        if( $deal_id > 0 && $stage_id > 0 ){
            $customerDeal = $this->CustomerDeal_model->getById($deal_id);
            if( $customerDeal && $customerDeal->company_id == $company_id ){
                
                $this->CustomerDeal_model->update($customerDeal->id, ['customer_deal_stage_id' => $stage_id]);

                $is_success = 1;
                $msg = '';
            }
        } 

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_update_customer_deal_status()
    {
        $this->load->model('CustomerDeal_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $deal_id  = trim($post['deal_id']);
        
        if( $deal_id > 0 ){
            $customerDeal = $this->CustomerDeal_model->getById($deal_id);
            if( $customerDeal && $customerDeal->company_id == $company_id ){
                
                $this->CustomerDeal_model->update($customerDeal->id, ['status' => $post['status']]);

                $is_success = 1;
                $msg = '';
            }
        } 

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }
}
