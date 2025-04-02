<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CreditorFurnisher extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Furnisher_model');

        $this->checkLogin();

        $this->page_data['page']->title = 'Creditors / Furnishers';
        $this->page_data['page']->menu = 'creditors_furnishers';
    }

    public function index()
    {
        $cid  = logged('company_id');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
            show403Error();
            return false;
        }   

        $creditorFurnishers = $this->Furnisher_model->getAllByCompanyId($cid);

        $this->page_data['page']->title = 'Creditors / Furnishers';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['creditorFurnishers'] = $creditorFurnishers;
        
        $this->load->view('v2/pages/furnishers/list', $this->page_data);
    }

    public function add_new()
    {

        $this->load->view('v2/pages/furnishers/add', $this->page_data);
    }

    public function ajax_create_furnisher()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->Furnisher_model->getByNameAndCompanyId($post['f_company_name'], $cid);
        if( !$isExists ){
            $data = [
                'company_id' => $cid,
                'name' => $post['f_company_name'],
                'address' => $post['f_address'],
                'city' => $post['f_city'],
                'state' => $post['f_state'],
                'zip_code' => $post['f_zipcode'],
                'phone' => $post['f_phone'],
                'ext' => $post['f_ext'],
                'account_type' => $post['f_account_type'],
                'note' => $post['f_note'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
            ];
    
            $this->Furnisher_model->create($data);   
    
            $is_success = 1;
    
            //Activity Logs
            $activity_name = 'Credit Industry : Created new credit industry ' . $post['f_company_name']; 
            createActivityLog($activity_name);
        }else{
            $msg = 'Company name already exists.';
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_update_furnisher()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $creditFurnisher = $this->Furnisher_model->getByIdAndCompanyId($post['fid'], $cid);
        if( $creditFurnisher ){
            $isExists = $this->Furnisher_model->getByNameAndCompanyId($post['f_company_name'], $cid);
            if( $isExists && $isExists->id != $post['fid'] ){
                $msg = 'Company name already exists.';
            }else{
                $data = [
                    'name' => trim($post['f_company_name']),
                    'address' => $post['f_address'],
                    'city' => $post['f_city'],
                    'state' => $post['f_state'],
                    'zip_code' => $post['f_zipcode'],
                    'phone' => $post['f_phone'],
                    'ext' => $post['f_ext'],
                    'account_type' => $post['f_account_type'],
                    'note' => $post['f_note'],
                    'date_modified' => date("Y-m-d H:i:s"),
                ];
        
                $this->Furnisher_model->update($creditFurnisher->id, $data);   
        
                $is_success = 1;
        
                //Activity Logs
                $activity_name = 'Credit Industry : Updated credit industry ' . $creditFurnisher->name; 
                createActivityLog($activity_name);
            }
        } 

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_furnisher()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $furnisher = $this->Furnisher_model->getByIdAndCompanyId($post['fid'], $cid);
        if( $furnisher ){
            $this->Furnisher_model->delete($post['fid']);

            //Activity Logs
            $activity_name = 'Credit Industry : Deleted credit industry ' . $furnisher->name; 
            createActivityLog($activity_name);

            $is_success = 1;

        }else{
            $msg = 'Cannot find data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function edit($id)
    {
        $cid  = logged('company_id');
        $furnisher = $this->Furnisher_model->getByIdAndCompanyId($id, $cid);
        if( $furnisher ){

            $this->page_data['furnisher'] = $furnisher;
            $this->load->view('furnishers/edit', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('creditor_furnisher/list');
        }
    }

    public function ajax_update_creditor_furnisher()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $furnisher = $this->Furnisher_model->getByIdAndCompanyId($post['fid'], $cid);

        if( $furnisher ){
            $data = [
                'name' => $post['f_company_name'],
                'address' => $post['f_address'],
                'city' => $post['f_city'],
                'state' => $post['f_state'],
                'zip_code' => $post['f_zipcode'],
                'phone' => $post['f_phone'],
                'ext' => $post['f_ext'],
                'account_type' => $post['f_account_type'],
                'note' => $post['f_note'],
                'date_modified' => date("Y-m-d H:i:s")
            ];

            $this->Furnisher_model->update($furnisher->id, $data);  

            $is_success = 1;

        }else{
            $msg = 'Cannot find data';
        }

        $is_success = 1;

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_quick_save()
    {
        $is_success = 0;
        $msg = 'Cannot save data';

        $cid  = logged('company_id');
        $post = $this->input->post();
        $fid  = 0;
        $name = '';
        
        $isExists = $this->Furnisher_model->getByNameAndCompanyId($post['f_creditor_name'], $cid);
        if( !$isExists ){
            $data = [
                'company_id' => $cid,
                'name' => $post['f_creditor_name'],
                'address' => $post['f_address'] != '' ? $post['f_address'] : '',
                'city' => $post['f_city'] != '' ? $post['f_city'] : '',
                'state' => $post['f_state'] != '' ? $post['f_state'] : '',
                'zip_code' => $post['f_zipcode'] != '' ? $post['f_zipcode'] : '',
                'phone' => $post['f_phone'] != '' ? $post['f_phone'] : '',
                'ext' => $post['f_ext'] != '' ? $post['f_ext'] : '',
                'account_type' => $post['f_account_type'] != '' ? $post['f_account_type'] : '',
                'note' => $post['f_note'] != '' ? $post['note'] : '',
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
            ];
    
            $fid = $this->Furnisher_model->createFurnisher($data);   
            $name = $post['f_creditor_name'];
    
            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Credit Industry : Created new credit industry ' . $post['f_creditor_name']; 
            createActivityLog($activity_name);

        }else{
            $msg = 'Creditor / Furnisher name already exists.';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg, 'name' => $name, 'fid' => $fid];
        echo json_encode($json_data);
    }

    public function ajax_edit_furnisher()
    {
        $post = $this->input->post();
        $cid  = logged('company_id');
        
        $creditorFurnisher = $this->Furnisher_model->getByIdAndCompanyId($post['fid'],$cid);

        $this->page_data['creditorFurnisher'] = $creditorFurnisher;
        $this->load->view('v2/pages/furnishers/ajax_edit_furnisher', $this->page_data);
    }
}
