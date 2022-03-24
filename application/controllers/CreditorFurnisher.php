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

        $creditorFurnishers = $this->Furnisher_model->getAllByCompanyId($cid);

        $this->page_data['creditorFurnishers'] = $creditorFurnishers;
        $this->load->view('furnishers/list', $this->page_data);
    }

    public function add_new()
    {

        $this->load->view('furnishers/add', $this->page_data);
    }

    public function ajax_create_furnisher()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

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
            $this->Furnisher_model->deleteById($post['qid']);

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

        $this->Furnisher_model->create($data);   

        $is_success = 1;

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }
}
