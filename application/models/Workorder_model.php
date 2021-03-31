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
		$vendor = $this->db->insert('workorders', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
	}

    public function save_custom_fields($data){
        $custom = $this->db->insert('workorder_custom_fields', $data);
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
}

/* End of file Workorder_model.php */
/* Location: ./application/models/Workorder_model.php */