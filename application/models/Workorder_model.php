<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workorder_model extends MY_Model
{

    public $table = 'work_orders';

    public function getAllOrderByCompany($company_id, $options = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if (!empty($options)) {

            if (isset($options['assign_to'])) {

                $this->db->where('assign_to', $options['assign_to']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0, $options = array())
    {

        $user_id = getLoggedUserID();

        $this->db->select('*');
        $this->db->from($this->table);

        if (!$uid) {
            $this->db->where('user_id', $user_id);
        } else {
            $this->db->where('user_id', $uid);
        }

        if ($type != '' && $type != 'tt') {

            $this->db->where('customer_type', $type);
        }

        if ($status != '' && $status != 'ss') {

            $this->db->where('workorder_status', $status);
        }

        if ($emp_id) {

            $this->db->where("FIND_IN_SET($emp_id, assign_to)");
        }

        if (!empty($options)) {

            if (isset($options['assign_to'])) {

                $this->db->where('assign_to', $options['assign_to']);
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }


    /**
     * @param int $company_id
     * @return mixed
     */
    function getStatusWithCount($company_id = 0)
    {

        $this->db->select('work_status.id, work_status.title, COUNT(workorders.id) as total');
        $this->db->from($this->table);

        // join the status table
        $this->db->join('work_status', 'work_status.id = workorders.status_id');


        if (isset($company_id)) {
            $this->db->where('workorders.company_id', $company_id);
        } else {

            $this->db->where('workorders.user_id', getLoggedUserID());
        }

        $this->db->group_by('work_status.id, work_status.title');

        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        return $query->result();

    }


    /**
     * @param array $filters
     * @param int $company_id
     * @return mixed
     */
    public function filterBy($filters = array(), $company_id = 0)
    {

        $this->db->select('workorders.id, workorders.user_id, workorders.date_issued, workorders.customer_id, workorders.company_id, workorders.status_id, workorders.priority_id');
        $this->db->from($this->table);

        if (!empty($filters)) {

            if (isset($filters['status'])) {

                $this->db->where('status_id', $filters['status']);
            } elseif (isset($filters['search'])) {

                $this->db->join('customers', "customers.id = workorders.customer_id");
                $this->db->like('customers.contact_name', $filters['search']);
            } elseif (isset($filters['order'])) {

                switch ($filters['order']) {

                    case 'date-issued-desc':
                        $this->db->order_by('date_issued', 'DESC');
                        break;

                    case 'date-issued-asc':
                        $this->db->order_by('date_issued');
                        break;

                    case 'event-date-desc':
                        $this->db->join('work_status', "work_status.id = workorders.status_id", "left");
                        $this->db->order_by("(CASE work_status.title WHEN '" . WORKORDER_STATUS_SCHEDULE . "' THEN 1 ELSE 0 END), date_issued ASC");
                        break;

                    case 'event-date-asc':
                        $this->db->join('work_status', "work_status.id = workorders.status_id", "left");
                        $this->db->order_by("(CASE work_status.title WHEN '" . WORKORDER_STATUS_SCHEDULE . "' THEN 0 ELSE 1 END), date_issued DESC");
                        break;

                    case 'date-completed-desc':
                        $this->db->join('work_status', "work_status.id = workorders.status_id", "left");
                        $this->db->order_by("(CASE work_status.title WHEN '" . WORKORDER_STATUS_COMPLETE . "' THEN 1 ELSE 0 END), date_issued ASC");
                        break;

                    case 'date-completed-asc':
                        $this->db->join('work_status', "work_status.id = workorders.status_id", "left");
                        $this->db->order_by("(CASE work_status.title WHEN '" . WORKORDER_STATUS_COMPLETE . "' THEN 0 ELSE 1 END), date_issued DESC");
                        break;

                    case 'number-desc':
                        $this->db->order_by('created_at', 'DESC');
                        break;

                    case 'number-asc':
                        $this->db->order_by('created_at', 'ASC');
                        break;

                    case 'priority-asc':
                        $this->db->join('priority_list', "priority_list.id = workorders.priority_id", "left");
                        $this->db->order_by("priority_list.title ASC");
                        break;

                    case 'priority-desc':
                        $this->db->join('priority_list', "priority_list.id = workorders.priority_id", "left");
                        $this->db->order_by("priority_list.title DESC");
                        break;
                }
            }
        }

        //
        if (isset($company_id)) {
            $this->db->where('workorders.company_id', $company_id);
        } else {

            $this->db->where('workorders.user_id', getLoggedUserID());
        }

        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        return $query->result();
    }

    public function save_workorder($data){
		$vendor = $this->db->insert('work_orders', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
	}

    public function save_custom_fields($data){
        $custom = $this->db->insert('workorder_custom_fields', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function add_custom_fields($data){
        $custom = $this->db->insert('custom_fields', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function getTerms($comp_id){

        $this->db->select('*');
		$this->db->from('terms_and_conditions');
		$this->db->where('company_id', $comp_id);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsbyID(){
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('terms_and_conditions');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsDefault(){
        $cid = 0;

        $this->db->select('*');
		$this->db->from('terms_and_conditions');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsUse($comp_id){

        $this->db->select('*');
		$this->db->from('terms_of_use');
		$this->db->where('company_id', $comp_id);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsUsebyID(){
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('terms_of_use');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsUseDefault(){
        $cid = 0;

        $this->db->select('*');
		$this->db->from('terms_of_use');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getCustomByID(){
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('custom_fields');
		$this->db->where('company_id', $cid);
		// $query = $this->db->get();
		// return $query->row();
        $query = $this->db->get();
        return $query->result();
    }

    public function getheaderByID()
    {
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('work_order_headers');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
        // $query = $this->db->get();
        // return $query->result();
    }

    public function save_header($data){
        $vendor = $this->db->insert('work_order_headers', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function update_header($data){
        $vendor = $this->db->update('work_order_headers', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function getchecklistByUser($id)
    {
        $this->db->select('checklists.*,checklists.id as check_id,checklist_items.checklist_id,checklist_items.item_name,');
		$this->db->from('checklists');
        $this->db->join('checklist_items', 'checklist_items.checklist_id = checklists.id');
		$this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_custom_field($data)
    {
        extract($data);
        // $vendor = $this->db->update('custom_fields', $data);
        //           $this->db->where('id', $data['id']);
	    // $insert = $this->db->insert_id();
		// return  $insert;
        $this->db->where('id', $id);
        $this->db->update('custom_fields', array('name' => $name));
        return true;
    }

    public function getchecklistdetailsajax($data)
    {

        $this->db->select('*');
        $this->db->from('checklists');
        // $this->db->join('checklist_items', 'checklist_items.checklist_id = checklists.id');
        $this->db->where('id', $data);

        $query = $this->db->get();
        return $query->result();
    }

    public function checklistsitems($id)
    {
        // $test  = '4';
        $this->db->select('*');
        $this->db->from('checklist_items');
        $this->db->where('checklist_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    public function additem_details($data){
	    $vendor = $this->db->insert('custom_fields_lists', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function getjob_types()
    {
        // $test  = '4';
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('job_types');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
        return $query->result();
    }

    public function getlastInsert(){

        $this->db->select('*');
        $this->db->from('work_orders');
        // $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        // $query = $this->db->query("SELECT * FROM date_data ORDER BY id DESC LIMIT 1");
        $result = $this->db->get();
        return $result->result();
    }

    public function getjob_tagsById()
    {
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('job_tags');
		$this->db->where('company_id', $cid);
        $this->db->order_by('name', 'ASC');
		// $query = $this->db->get();
		// return $query->row();
        $query = $this->db->get();
        return $query->result();
    }

    public function getclientsById()
    {
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('clients');
		$this->db->where('id', $cid);
		// $query = $this->db->get();
		// return $query->row();
        $query = $this->db->get();
        return $query->row();
    }

    public function update_tc($data)
    {
        extract($data);

        if($id == NULL){
            $vendor = $this->db->insert('terms_and_conditions', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
        // $vendor = $this->db->update('custom_fields', $data);
        //           $this->db->where('id', $data['id']);
	    // $insert = $this->db->insert_id();
		// return  $insert;
        $this->db->where('id', $id);
        $this->db->update('terms_and_conditions', array('content' => $content));
        return $data;
        }
    }

    public function update_header_f($data)
    {
        extract($data);
        // $vendor = $this->db->update('custom_fields', $data);
        //           $this->db->where('id', $data['id']);
	    // $insert = $this->db->insert_id();
		// return  $insert;
        $this->db->where('id', $id);
        $this->db->update('work_order_headers', array('content' => $content));
        return $data;
    }
    
    public function update_tu($data)
    {
        extract($data);
        if($id == NULL){
            $vendor = $this->db->insert('terms_of_use', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
        // $vendor = $this->db->update('custom_fields', $data);
        //           $this->db->where('id', $data['id']);
	    // $insert = $this->db->insert_id();
		// return  $insert;
        $this->db->where('id', $id);
        $this->db->update('terms_of_use', array('content' => $content));
        return $data;
        }
    }

    public function getworkorderList()
    {
        $company_id = logged('company_id');

        $this->db->select('work_orders.* , acs_profile.first_name,  acs_profile.last_name, acs_profile.middle_name, acs_profile.prof_id');
		// $this->db->from('workorders.* , acs_profile.first_name,  acs_profile.last_name, acs_profile.middle_name, acs_profile.prof_id');
        $this->db->from('work_orders');
        $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');
		$this->db->where('work_orders.company_id', $company_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
		$this->db->from('work_orders');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function checktemplateId($id)
    {
        $this->db->select('*');
		$this->db->from('company_work_order_used');
		$this->db->where('company_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function addTemplate($data)
    {
        $vendor = $this->db->insert('company_work_order_used', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function updateTemplate($data)
    {
        extract($data);
        $this->db->where('company_id', $company_id);
        $this->db->update('company_work_order_used', array('work_order_template_id' => $work_order_template_id));
        return true;
    }

    public function getcompany_work_order_used($company_id)
    {
        $this->db->select('*');
		$this->db->from('company_work_order_used');
		$this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCompanyCompanyId($id)
    {
        $this->db->select('company_id');
		$this->db->from('work_orders');
		$this->db->where('id', $id);
        $query = $this->db->get();
        $comp = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        $this->db->select('*');
		$this->db->from('clients');
		$this->db->where('id', $comp->company_id);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function getcustomerCompanyId($id)
    {
        $this->db->select('customer_id');
		$this->db->from('work_orders');
		$this->db->where('id', $id);
        $query = $this->db->get();
        $cus = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        $this->db->select('*');
		$this->db->from('acs_profile');
		$this->db->where('prof_id', $cus->customer_id);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function getItems($id)
    {
        $this->db->select('*');
		$this->db->from('work_orders');
		$this->db->where('id', $id);
        $query = $this->db->get();
        $cus = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        $where = array(
            'type' => 'Work Order',
            'type_id'   => $cus->id
          );

        $this->db->select('*');
		$this->db->from('item_details');
        // $this->db->where('type', 'Work Order');
		// $this->db->where('type_id', $cus->id);
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function save_payment($data)
    {
        $vendor = $this->db->insert('work_order_payments', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    
}

/* End of file Workorder_model.php */
/* Location: ./application/models/Workorder_model.php */