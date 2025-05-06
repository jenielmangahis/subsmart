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

    public function ajax_customer_create_deal()
    {
        $this->load->model('CustomerDeal_model');

        $is_success = 1;
        $msg    = '';
        $label  = [];

        $company_id  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['label_name'] == '' ){
            $is_success = 0;
            $msg = 'Please specify name';
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
}
