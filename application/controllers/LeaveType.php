<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LeaveType extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'Leave Types';
        $this->page_data['page']->menu  = 'users';
    }

    public function index()
    {
        if(!checkRoleCanAccessModule('timesheet-leave-types', 'read')){
			show403Error();
			return false;
		}

        $this->load->model('LeaveType_model');

        $cid = logged('company_id');        
        $leaveTypes = $this->LeaveType_model->getAllByCompanyId($cid,$conditions);       
        

        $this->page_data['leaveTypes'] = $leaveTypes;
        $this->load->view('v2/pages/leave_types/index', $this->page_data);
    }

    public function ajax_save_leave_type()
    {
        $this->load->model('LeaveType_model');

        $is_success = 1;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();
        
        if( $post['leave_type'] == '' ){
            $is_success = 0;
            $msg = 'Please specify leave type name';
        }

        if( $is_success == 1 ){
            $data = [
                'company_id' => $cid,
                'name' => $post['leave_type']
            ];

            $this->LeaveType_model->create($data);

            //Activity Logs
            $activity_name = 'Leave Type : Created leave type ' . $post['leave_type']; 
            createActivityLog($activity_name);
        }     

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_update_leave_type()
    {
        $this->load->model('LeaveType_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();
        $leaveType =  $this->LeaveType_model->getByIdAndCompanyId($post['lid'], $cid);
        if( $leaveType ){
            $data = ['name' => $post['leave_type']];
            $this->LeaveType_model->update($leaveType->id, $data);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Leave Type : Updated leave type ' . $leaveType->name . ' changed to ' . $post['leave_type']; 
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);

    }

    public function ajax_delete_selected()
    {
        $this->load->model('LeaveType_model');

        $is_success = 0;
        $msg = 'Nothing to delete';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $total_deleted = 0;
        foreach($post['row_selected'] as $bid){
            $leaveType =  $this->LeaveType_model->getByIdAndCompanyId($bid, $cid);
            if( $leaveType ){
                $this->LeaveType_model->delete($leaveType->id);

                //Activity Logs
                $activity_name = 'Leave Type : Deleted leave type ' . $leaveType->name; 
                createActivityLog($activity_name);
            }

            $total_deleted++;
        }

        if( $total_deleted > 0 ){
            $is_success = 1;
            $msg = 'Selected leave types was successfully deleted';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);

    }

    public function ajax_delete_leave_type()
    {
        $this->load->model('LeaveType_model');
        
        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $leaveType =  $this->LeaveType_model->getByIdAndCompanyId($post['lid'],$cid);
        if( $leaveType ){
            $this->LeaveType_model->delete($leaveType->id);
            
            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Leave Type : Deleted leave type ' . $leaveType->name; 
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);

    }
}
