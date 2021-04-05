<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Job_Checklists extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Job Checklists';
        $this->page_data['page']->menu = 'job_checklists';

        $this->load->model('JobChecklist_model');
        
    }

    public function index()
    {        
        $company_id = logged('company_id');

        $jobChecklists = $this->JobChecklist_model->getAllByCompanyId($company_id);

        $this->page_data['jobChecklists'] = $jobChecklists;
        $this->load->view('job_checklists/index', $this->page_data);
    }

    public function add_new()
    {
        $checklistAttachType = $this->JobChecklist_model->getAttachType();

        $this->page_data['checklistAttachType'] = $checklistAttachType;
        $this->load->view('job_checklists/add_checklist', $this->page_data);
    }

    public function create_checklist(){

        $user = $this->session->userdata('logged');
        $post = $this->input->post();
        $company_id = logged('company_id');

        $data = [
            'company_id' => $company_id,
            'checklist_name' => $post['checklist_name'],
            'attach_to_job_id' => $post['attach_to_job_order'],
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        ];

        $cid = $this->JobChecklist_model->create($data);


        $this->session->set_flashdata('message', 'Checklist created. Now you can start adding the items.');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('job_checklists/edit_checklist/' . $cid);
    }

    public function edit_checklist($id){

        $checklistAttachType = $this->JobChecklist_model->getAttachType();

        $checklist = $this->JobChecklist_model->getById($id);

        if( $checklist ){
            $this->page_data['checklist'] = $checklist;
            $this->page_data['checklistAttachType'] = $checklistAttachType;
            $this->load->view('job_checklists/edit_checklist', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('job_checklists/list');
        }
    }

    public function ajax_load_checklist_items(){
        $this->load->helper(array('hashids_helper'));
        $post = $this->input->post();
        $checklistItems = $this->JobChecklist_model->getAllItemsByJobChecklistId($post['cid']);

        $this->page_data['checklistItems'] = $checklistItems;
        $this->load->view('job_checklists/_checklist_items', $this->page_data);
    }

    public function ajax_create_checklist_item(){

        $post = $this->input->post();

        $data = [
            'job_checklist_id' => $post['cid'],
            'item_name' => $post['item_name'],
        ];

        $cid = $this->JobChecklist_model->createJobChecklistItem($data);

        $json_data = ['is_success' => true];

        echo json_encode($json_data);

        exit;
    }

    public function ajax_delete_checklist_items(){
        $this->load->helper(array('hashids_helper'));

        $post = $this->input->post();
        $id   = hashids_decrypt($post['eid'], '', 15);
        $this->JobChecklist_model->deleteItemById($id);

        $json_data = ['is_success' => true];

        echo json_encode($json_data);

        exit;
    }
}
