<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Job_Checklists extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        

        $this->load->model('JobChecklist_model');
        $this->load->model('JobChecklistItem_model');
        
    }

    public function index()
    {        
        $this->page_data['page']->title = 'Checklist';
        $this->page_data['page']->menu = 'job_checklists';
        $this->page_data['title'] = 'Checklist';

        $company_id = logged('company_id');

        $jobChecklists = $this->JobChecklist_model->getAllByCompanyId($company_id);

        $this->page_data['jobChecklists'] = $jobChecklists;
        $this->load->view('v2/pages/job_checklists/index', $this->page_data);
    }

    public function add_new()
    {
        $this->page_data['title '] = 'Checklist';
        $this->page_data['page']->title = 'Add New Job Checklist';
        $this->page_data['page']->menu = 'job_checklists';
        $checklistAttachType = $this->JobChecklist_model->getAttachType();

        $this->page_data['checklistAttachType'] = $checklistAttachType;
        $this->load->view('v2/pages/job_checklists/add_checklist', $this->page_data);
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

    public function edit_checklist($id)
    {

        $company_id = logged('company_id');

        $checklistAttachType = $this->JobChecklist_model->getAttachType();
        $checklist = $this->JobChecklist_model->getByIdAndCompanyId($id, $company_id);

        if( $checklist ){
            $checklistItems = $this->JobChecklistItem_model->getAllByJobChecklistId($checklist->id);


            $this->page_data['checklist'] = $checklist;
            $this->page_data['checklistAttachType'] = $checklistAttachType;
            $this->page_data['checklistItems'] = $checklistItems;
            $this->page_data['title '] = 'Checklist';
                $this->page_data['page']->title = 'Edit Job Checklist';
                $this->page_data['page']->menu = 'job_checklists';
            $this->load->view('v2/pages/job_checklists/edit_checklist', $this->page_data);

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

    public function ajax_update_checklist_item(){
        $this->load->helper(array('hashids_helper'));

        $post = $this->input->post();
        $id   = hashids_decrypt($post['edit_cheklist_item'], '', 15);
        $this->JobChecklist_model->updateChecklistItemById($id, array(
            'item_name' => $post['edit_item_name']
        ));

        $json_data = ['is_success' => true];

        echo json_encode($json_data);

        exit;
    }

    public function update_checklist(){
        $this->load->helper(array('hashids_helper'));

        $post = $this->input->post();
        $cid  = $post['cid'];
        $checklist = $this->JobChecklist_model->getById($cid);

        if( $checklist ){
            $this->JobChecklist_model->updateChecklistById($cid, array(
                'checklist_name' => $post['checklist_name'],
                'attach_to_job_id' => $post['attach_to_work_order'],
                'date_modified' => date("Y-m-d H:i:s")
            ));

            $this->session->set_flashdata('message', 'Checklist was successfully updated.');
            $this->session->set_flashdata('alert_class', 'alert-success');
            redirect('job_checklists/list');
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('job_checklists/edit_checklist/'.$cid);
        }
    }

    public function delete_checklist(){
        $post = $this->input->post();
        $cid  = $post['cid'];
        $company_id = logged('company_id');

        $checklist = $this->JobChecklist_model->getByIdAndCompanyId($cid, $company_id);
        if( $checklist ){
            $this->JobChecklist_model->deleteAllItemsByJobCheklistId($cid);
            $this->JobChecklist_model->deleteChecklist($cid);

            $this->session->set_flashdata('message', 'Checklist was successfully deleted.');
            $this->session->set_flashdata('alert_class', 'alert-success');
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('job_checklists/list');
    }

    public function ajax_save_checklist()
    {
        $is_success = 0;
        $msg = '';

        $user = $this->session->userdata('logged');
        $post = $this->input->post();
        $company_id = logged('company_id');

        if( !empty($post['checklistItems']) ){
            $data = [
                'company_id' => $company_id,
                'checklist_name' => $post['checklist_name'],
                'attach_to_job_id' => $post['attach_to_job_order'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            ];

            $cid = $this->JobChecklist_model->create($data);

            if( isset($post['checklistItems']) ){
                foreach( $post['checklistItems'] as $key => $item ){
                    $data = [
                        'job_checklist_id' => $cid,
                        'item_name' => $item
                    ];

                    $this->JobChecklistItem_model->create($data);
                }    
            }

            $is_success = 1;    
        }else{
            $msg = 'Please add checklist item';
        }
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_update_checklist()
    {
        $is_success = 0;
        $msg = '';

        $user = $this->session->userdata('logged');
        $post = $this->input->post();
        $user_id = logged('id');

        $checklist = $this->JobChecklist_model->getById($post['cid']);
        
        if( $checklist ){
            if( !empty($post['checklistItems']) ){
                $data = [
                    'checklist_name' => $post['checklist_name'],
                    'attach_to_job_id' => $post['attach_to_job_id'],
                    'date_modified' => date("m-d-Y H:i:s")
                ];

                $this->JobChecklist_model->update($checklist->id, $data);

                $this->JobChecklistItem_model->deleteAllByJobChecklistId($checklist->id);

                if( isset($post['checklistItems']) ){
                    foreach( $post['checklistItems'] as $key => $item ){
                        $data = [
                            'job_checklist_id' => $checklist->id,
                            'item_name' => $item
                        ];

                        $this->JobChecklistItem_model->create($data);
                    }    
                }

                $is_success = 1;
            }else{
                $msg = 'Please add checklist item';
            }            
        }
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }
}
