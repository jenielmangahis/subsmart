<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Quick_Notes extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Quick Notes';
        $this->page_data['page']->menu = 'quick_notes';

        // load Models        
        $this->load->model('QuickNote_model');

        $this->checkLogin();

        //load library
        $this->load->library('session');
        // load helper
        $this->load->helper('functions');        
    }

    public function index()
    {
        $cid = logged('company_id');
        $quickNotes = $this->QuickNote_model->getAllByCompanyId($cid);        

        $this->page_data['quickNotes'] = $quickNotes;
        $this->load->view('quick_notes/list', $this->page_data);
    }

    public function add_new()
    {

        $this->load->view('quick_notes/add', $this->page_data);
    }

    public function ajax_create_quick_note()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $data = [
            'company_id' => $cid,
            'subject' => $post['q_subject'],
            'message' => $post['q_message'],
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
        ];

        $this->QuickNote_model->create($data);   

        $is_success = 1;

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_quick_note()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $quickNote = $this->QuickNote_model->getById($post['qid']);
        if( $quickNote ){
            $this->QuickNote_model->deleteById($post['qid']);

            $is_success = 1;

        }else{
            $msg = 'Cannot find data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function edit($id)
    {
        $quickNote = $this->QuickNote_model->getById($id);
        if( $quickNote ){

            $this->page_data['quickNote'] = $quickNote;
            $this->load->view('quick_notes/edit', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('quick_notes/list');
        }
    }

    public function ajax_update_quick_note()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $quickNote = $this->QuickNote_model->getByIdAndCompanyId($post['qid'], $cid);

        if( $quickNote ){
            $data = [
                'subject' => $post['q_subject'],
                'message' => $post['q_message'],
                'date_modified' => date("Y-m-d H:i:s"),
            ];

            $this->QuickNote_model->update($quickNote->id, $data);  

            $is_success = 1;

        }else{
            $msg = 'Cannot find data';
        }

        $is_success = 1;

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }
}
