<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estimate_model extends MY_Model
{

    public $table = 'estimates';
    public $table_items = 'job_items';

    public function getAllByCompany($company_id, $sort = '', $filter = array())
    {

        $this->db->select('estimates.*, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer_name,CONCAT(ac_leads.firstname, " ", ac_leads.lastname) AS lead_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', "estimates.customer_id = acs_profile.prof_id", 'left');
        $this->db->join('ac_leads', "estimates.lead_id = ac_leads.leads_id", 'left');
        $this->db->where('estimates.company_id', $company_id);  
        $this->db->where('estimates.view_flag', 0);  
        
        if( !empty($filter) ){
            $this->db->group_start();
            foreach($filter as $f){                
                $this->db->or_like($f['field'], trim($f['value']));
            }
            $this->db->group_end();
        }        

        switch ($sort) {
            case 'added-desc':
                $this->db->order_by('created_at', 'DESC');
                break;

            case 'added-asc':                    
                $this->db->order_by('created_at', 'ASC');
                break;

            case 'date-accepted-desc':
                $this->db->order_by("(CASE estimates.status WHEN '" . ESTIMATE_STATUS_ACCEPTED . "' THEN 0 ELSE 1 END), accepted_date DESC");
                break;

            case 'date-accepted-asc':
                $this->db->order_by("(CASE estimates.status WHEN '" . ESTIMATE_STATUS_ACCEPTED . "' THEN 1 ELSE 0 END), accepted_date ASC");
                break;

            case 'number-asc':
                $this->db->order_by('estimate_number', 'ASC');
                break;

            case 'number-desc':
                $this->db->order_by('estimate_number', 'DESC');
                break;

            case 'amount-asc':
                $this->db->order_by('grand_total', 'ASC');
                break;

            case 'amount-desc':                
                $this->db->order_by('grand_total', 'DESC');
                break;
            default:
                $this->db->order_by('estimates.id', 'DESC');
        }
        

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanynDraft($company_id)
    {
        $where = array(
            'view_flag'     => '0',
            'company_id'    => $company_id,
            // 'status'        => 'Submitted',
            // 'status'        => 'Accepted',
            // 'status'        => 'Invoiced',
            // 'status'        => 'Lost',
            'status !='        => 'Draft',
          );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function mailIsOpen($data)
    {
        // $this->db->where('id', $id);
        // $this->db->update('estimates', array('is_mail_open' => 1));
        // return true;
        extract($data);
        $this->db->where('id', $id);
        $update = $this->db->update('estimates', array('is_mail_open' => $is_mail_open));
        // return $id;
        if($update) return TRUE;
        return FALSE;

        // $this->db->from($this->table);
        // $this->db->set(['is_mail_open' => 1]);
        // $this->db->where('id', $id);
        // $this->db->update();
    }

    public function getlastInsert(){

        $this->db->select('*');
        $this->db->from($this->table);
        // $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        // $query = $this->db->query("SELECT * FROM date_data ORDER BY id DESC LIMIT 1");
        $result = $this->db->get();
        return $result->result();
    }

    public function getPackagelist($id)
    {
        $this->db->select('*');
		$this->db->from('item_categories');
		$this->db->where('company_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getItems($id)
    {
        // $this->db->select('*, estimates_items.cost AS icost, estimates_items.tax AS itax, estimates_items.total AS itotal');
		// $this->db->from('estimates_items');
        // $this->db->join('items', 'estimates_items.estimates_id  = items.id');
		// $this->db->where('estimates_items.estimates_id', $id);
        // $query = $this->db->get();
        // return $query->result();
        $this->db->select('*, estimates_items.cost AS icost, estimates_items.tax AS itax, estimates_items.total AS itotal');
        //$this->db->select('*, estimates_items.cost AS icost, estimates_items.tax AS itax, estimates_items.total AS itotal');
		$this->db->from('estimates_items');
        $this->db->join('items', 'estimates_items.estimates_id  = items.id');
        $this->db->where('estimates_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function deleteEstimate($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('estimates', array('view_flag' => $view_flag));
        return true;
    }

    public function save_update_estimate_status($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('estimates', array('status' => $status));
        return true;
    }

    public function getDataByESTID($id)
    {
        $this->db->select('*');
		$this->db->from('estimates');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function getlastInsertByComp($company_id){

        $where = array(
            'view_flag'     => '0',
            'company_id'   => $company_id
          );

        $this->db->select('*');
        $this->db->from('estimates');
        $this->db->where($where);
        $this->db->order_by('estimate_number', 'DESC');
        $this->db->limit(1);

        // $query = $this->db->query("SELECT * FROM date_data ORDER BY id DESC LIMIT 1");
        $result = $this->db->get();
        return $result->result();
    }

    public function delete_items($id)
    {
        $where = array(
            'estimates_id'   => $id
          );

        $this->db->where($where);
        $this->db->delete('estimates_items');
        return true;
    }

    public function update_estimate($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('estimates', array(
            'customer_id'               => $customer_id,
            'job_location'              => $job_location,
            'job_name'                  => $job_name,
            'attachments'               => $data['attachments'],
            'estimate_number'           => $estimate_number,
            'estimate_date'             => $estimate_date,
            'expiry_date'               => $expiry_date,
            'purchase_order_number'     => $purchase_order_number,
            'status'                    => $status,
            'estimate_type'             => $estimate_type,
            'status'                    => $status,
            'deposit_request'           => $deposit_request,
            'deposit_amount'            => $deposit_amount,
            'customer_message'          => $customer_message,
            'terms_conditions'          => $terms_conditions,
            'instructions'              => $instructions,
            'sub_total'                 => $sub_total,
            'grand_total'               => $grand_total,
            'tax1_total'                => $tax1_total,
            'adjustment_name'           => $adjustment_name,
            'adjustment_value'          => $adjustment_value,
            'markup_type'               => $markup_type,
            'markup_amount'             => $markup_amount,
            
        ));
        return true;
    }

    public  function approveEstimate($id)
    {
        $this->db->where('id', $id);
        $this->db->update('estimates', array(
            'status'  => 'Accepted',
            
        ));
        return true;
    }

    public function update_estimateBundle($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('estimates', array(
            'customer_id'               => $customer_id,
            'job_location'              => $job_location,
            'job_name'                  => $job_name,
            'estimate_date'             => $estimate_date,
            'expiry_date'               => $expiry_date,
            'purchase_order_number'     => $purchase_order_number,
            'status'                    => $status,
            'estimate_type'             => $estimate_type,
            'type'                      => $type,
            'deposit_request'           => $deposit_request,
            'deposit_amount'            => $deposit_amount,
            'customer_message'          => $customer_message,
            'terms_conditions'          => $terms_conditions,
            'instructions'              => $instructions,

            'bundle1_message'           => $bundle1_message,
            'bundle2_message'           => $bundle2_message,
            'bundle_discount'           => $bundle_discount,
            
            'deposit_amount'            => $deposit_amount,
            'bundle1_total'             => $bundle1_total,
            'bundle2_total'             => $bundle2_total,
            'sub_total'                 => $sub_total,
            'sub_total2'                => $sub_total2,
            'tax1_total'                => $tax1_total,
            'tax2_total'                => $tax2_total,

            'grand_total'               => $grand_total,
            'tax1_total'                => $tax1_total,
            'adjustment_name'           => $adjustment_name,
            'adjustment_value'          => $adjustment_value,
            'markup_type'               => $markup_type,
            'markup_amount'             => $markup_amount,
            
        ));
        return true;
    }

    public function update_estimateOptions($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('estimates', array(
            'customer_id'               => $customer_id,
            'job_location'              => $job_location,
            'job_name'                  => $job_name,
            'estimate_date'             => $estimate_date,
            'expiry_date'               => $expiry_date,
            'purchase_order_number'     => $purchase_order_number,
            'status'                    => $status,
            'estimate_type'             => $estimate_type,
            'type'                      => $type,
            'deposit_request'           => $deposit_request,
            'deposit_amount'            => $deposit_amount,
            'customer_message'          => $customer_message,
            'terms_conditions'          => $terms_conditions,
            'instructions'              => $instructions,

            'option_message'            => $option_message,
            'option2_message'           => $option2_message,
            // 'bundle_discount'           => $bundle_discount,
            
            'deposit_amount'            => $deposit_amount,
            'option1_total'             => $option1_total,
            'option2_total'             => $option2_total,
            'sub_total'                 => $sub_total,
            'sub_total2'                => $sub_total2,
            'tax1_total'                => $tax1_total,
            'tax2_total'                => $tax2_total,

            'grand_total'               => $grand_total,
            'tax1_total'                => $tax1_total,
            // 'adjustment_name'           => $adjustment_name,
            // 'adjustment_value'          => $adjustment_value,
            // 'markup_type'               => $markup_type,
            // 'markup_amount'             => $markup_amount,
            
        ));
        return true;
    }

    public function getEstimatesItems($id)
    {
        // $this->db->select('*');
		// $this->db->from('work_orders_items');
		// $this->db->where('work_order_id', $id);
        // $query = $this->db->get();
        // $cus = $query->row();

        // $this->db->select('* , work_orders.email AS w_email, work_orders.status AS w_status');
        // $this->db->from('work_orders');
        // $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');

        $this->db->select('*, estimates_items.cost as iCost, estimates_items.tax as itax, estimates_items.total as iTotal');
		$this->db->from('estimates_items');
        $this->db->join('items', 'estimates_items.items_id  = items.id');
        $this->db->where('estimates_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getAllEstimates()
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('view_flag', '0');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllOpenEstimatesByCompanyId($company_id)
    {
        $this->db->select('estimates.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'estimates.customer_id  = acs_profile.prof_id');
        $this->db->where('estimates.company_id', $company_id);
        $this->db->where('estimates.status !=', 'Lost');
        $this->db->where('estimates.status !=', 'Invoiced');
        $this->db->where('estimates.status !=', 'Declined By Customer');
        $this->db->where('estimates.view_flag', '0');        
        $this->db->order_by('estimates.id', 'DESC');
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_specific_job_items($id)
    {
        $this->db->select('items.id as fk_item_id, items.id, items.title, items.price, items.type, job_items.cost, job_items.qty, items_has_storage_loc.name as location_name, items_has_storage_loc.id as location_id, job_items.points, job_items.tax, job_items.item_name AS job_item_name');
        $this->db->from($this->table_items);
        $this->db->where("job_items.job_id", $id);
        $this->db->join('items', 'items.id = job_items.items_id', 'left');
        $this->db->join('items_has_storage_loc', 'items_has_storage_loc.id = items.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_estimate_items($data)
    {
        $vendor = $this->db->insert('estimates_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function add_estimate_temp_items($data)
    {
        $vendor = $this->db->insert('temp_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function delete_temp_item($id)
    {
        $where = array(
            'id'   => $id
          );

        $this->db->where($where);
        $this->db->delete('temp_items');
        return true;
    }

    public function delete_temp_itemType($id,$type)
    {
        $where = array(
            'id'   => $id,
            'added_from' => $type
          );

        $this->db->where($where);
        $this->db->delete('temp_items');
        return true;
    }

    public function add_new_items($data)
    {
        $vendor = $this->db->insert('items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0)
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
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }


    public function getEstimate($estimate_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $estimate_id);

        $query = $this->db->get();
        return $query->row();
    }


    /**
     * @param int $company_id
     * @return mixed
     */
    function getStatusWithCount($company_id = 0)
    {

        $this->db->select('id, status, COUNT(id) as total');
        $this->db->from($this->table);


        if (isset($company_id)) {
            $this->db->where('company_id', $company_id);
        } else {

            $this->db->where('user_id', getLoggedUserID());
        }

        $this->db->group_by('id');

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
    public function filterBy($filters = array(), $company_id = 0, $role_id = 0)
    {

        $this->db->select('estimates.id, estimates.estimate_number, estimates.job_name, estimates.estimate_eqpt_cost, estimates.user_id, estimates.estimate_date, estimates.customer_id,estimates.estimate_type, estimates.company_id, estimates.status');
        $this->db->join('acs_profile', "estimates.customer_id = acs_profile.prof_id", 'left');

//        $this->db->select("*");
        $this->db->from($this->table);

        if (!empty($filters)) {

            if (isset($filters['status'])) {

                // list of estimate status
                $items = get_config_item('estimate_status');

                // if search successful, use the data position as status
                $this->db->where('estimates.status', $filters['status']);
                //$this->db->where('status', array_search($filters['status'], array_map('strtolower', $items)));

            } elseif (isset($filters['search'])) { 
                $this->db->or_like('acs_profile.first_name', trim($filters['search']));
                $this->db->or_like('acs_profile.last_name', trim($filters['search']));
                $this->db->or_like('estimates.estimate_number', trim($filters['search']));
            } elseif (isset($filters['order'])) {

                switch ($filters['order']) {

                    case 'added-desc':
                        $this->db->order_by('created_at', 'DESC');
                        break;

                    case 'added-asc':                    
                        $this->db->order_by('created_at', 'ASC');
                        break;

                    case 'date-accepted-desc':
                        $this->db->order_by("(CASE estimates.status WHEN '" . ESTIMATE_STATUS_ACCEPTED . "' THEN 0 ELSE 1 END), accepted_date DESC");
                        // $this->db->order_by("(CASE status WHEN 'Accepted' THEN 0 ELSE 1 END), date_issued DESC");
                        break;

                    case 'date-accepted-asc':
                        $this->db->order_by("(CASE estimates.status WHEN '" . ESTIMATE_STATUS_ACCEPTED . "' THEN 1 ELSE 0 END), accepted_date ASC");
                        break;

                    case 'number-asc':
                        $this->db->order_by('estimate_number', 'ASC');
                        break;

                    case 'number-desc':
                        $this->db->order_by('estimate_number', 'DESC');
                        break;

                    case 'amount-asc':
                        $this->db->order_by('grand_total', 'ASC');
                        break;

                    case 'amount-desc':
                        $this->db->order_by('grand_total', 'DESC');
                        break;
                }
            }
        }
        //
        if( $role_id > 2 ){            
            $this->db->where('estimates.company_id', $company_id);
        }

        /*if (isset($company_id)) {
            $this->db->where('estimates.company_id', $company_id);
        } else {

            $this->db->where('estimates.user_id', getLoggedUserID());
        }*/

        $query = $this->db->get();
        $results = $query->result();
        $estimate_costs = array();

        if (!empty($filters['order'])) {            
            if (($filters['order'] === 'amount-asc') || ($filters['order'] === 'amount-desc')) {                
                //
                foreach ($results as $result) {

                    $cost = unserialize($result->estimate_eqpt_cost);

                    array_push($estimate_costs, $cost['eqpt_cost']);
                }


                usort($results, function ($a, $b) use ($estimate_costs, $filters) {

                    $sa = unserialize($a->estimate_eqpt_cost);
                    $sb = unserialize($b->estimate_eqpt_cost);

                    $pos_a = array_search($sa['eqpt_cost'], $estimate_costs);
                    $pos_b = array_search($sb['eqpt_cost'], $estimate_costs);

                    if ($filters['order'] === 'amount-asc') {
                        return $pos_b - $pos_a;
                    } else {
                        return $pos_a - $pos_b;
                    }
                });
            }
        }

        return $results;
    }

    public function getAllPendingEstimatesByUserId($user_id = 0)
    {
        $this->db->select('estimates.id, estimates.estimate_number, estimates.job_name, estimates.estimate_eqpt_cost, estimates.user_id, estimates.estimate_date, estimates.customer_id, estimates.company_id, estimates.status, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name');

        $this->db->from($this->table);
        $this->db->join('acs_profile', 'estimates.customer_id = acs_profile.prof_id');

        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +5 day'));
        
        $this->db->where('estimate_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');
        $this->db->where('estimates.status', 'Submitted');
        $this->db->where('estimates.user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllPendingEstimatesByCompanyId($company_id = 0)
    {
        $this->db->select('estimates.id, estimates.estimate_number, estimates.job_name, estimates.estimate_eqpt_cost, estimates.user_id, estimates.estimate_date, estimates.customer_id, estimates.company_id, estimates.status, estimates.tags, estimates.job_location, estimates.expiry_date, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, acs_profile.phone_m');

        $this->db->from($this->table);
        $this->db->join('acs_profile', 'estimates.customer_id = acs_profile.prof_id');

        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +5 day'));
        
        $this->db->where('estimate_date >=', $start_date);
        $this->db->where('estimates.status', 'Submitted');
        $this->db->where('estimates.company_id', $company_id);
        $this->db->order_by('estimate_date', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllPendingEstimatesByCompanyIdAndDate($company_id = 0, $date)
    {
        $this->db->select('estimates.id, estimates.estimate_number, estimates.job_name, estimates.estimate_eqpt_cost, estimates.user_id, estimates.estimate_date, estimates.customer_id, estimates.company_id, estimates.status, estimates.tags, estimates.job_location, estimates.expiry_date, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, acs_profile.phone_m');

        $this->db->from($this->table);
        $this->db->join('acs_profile', 'estimates.customer_id = acs_profile.prof_id');

        $date = date('Y-m-d', strtotime($date));        
        
        $this->db->where('estimate_date', $date);
        $this->db->where('estimates.status', 'Submitted');
        $this->db->where('estimates.company_id', $company_id);
        $this->db->order_by('estimate_date', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllPendingEstimates()
    {
        $this->db->select('estimates.id, estimates.estimate_number, estimates.job_name, estimates.estimate_eqpt_cost, estimates.user_id, estimates.estimate_date, estimates.customer_id, estimates.company_id, estimates.status, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name');

        $this->db->from($this->table);
        $this->db->join('acs_profile', 'estimates.customer_id = acs_profile.prof_id');

        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +5 day'));
        
        $this->db->where('estimate_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');
        $this->db->where('estimates.status', 'Submitted');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function save_estimate($data){
		$vendor = $this->db->insert('estimates', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
	}

    public function addNewCustomer($data){
		$vendor = $this->db->insert('acs_profile', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
	}

    public function add_estimate_details($data)
    {
        $vendor = $this->db->insert('estimates_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function getname($id)
    {
        $this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save_notification($data)
    {
        $vendor = $this->db->insert('user_notification', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function get_cliets_data($id)
    {
        $this->db->select('*');
		$this->db->from('clients');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_customerData_data($id)
    {
        $this->db->select('*');
		$this->db->from('acs_profile');
		$this->db->where('prof_id ', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function getItemlistByID($id)
    {
        $this->db->select('*, estimates_items.cost as costing');
		$this->db->from('estimates_items');
        $this->db->join('items', 'estimates_items.items_id  = items.id');
        // $this->db->join('package_details', 'estimates_items.package_id  = package_details.id');
        $this->db->where('estimates_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getItemlistByIDOption1($id)
    {
        $where = array(
            'estimates_id'      => $id,
            'estimate_type'     => 'Option',
            'bundle_option_type'=> '1',
          );

        $this->db->select('*, estimates_items.cost as costing');
		$this->db->from('estimates_items');
        $this->db->join('items', 'estimates_items.items_id  = items.id');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getItemOption($id)
    {
        $where = array(
            'estimates_id'      => $id,
          );

        $this->db->select('*');
		$this->db->from('estimates_items');
        $this->db->join('items', 'estimates_items.items_id  = items.id');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getItemlistByIDOption2($id)
    {
        $where = array(
            'estimates_id'      => $id,
            'estimate_type'     => 'Option',
            'bundle_option_type'=> '2',
          );

        $this->db->select('*, estimates_items.cost as costing');
		$this->db->from('estimates_items');
        $this->db->join('items', 'estimates_items.items_id  = items.id');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getItemlistByIDBundle1($id)
    {
        $where = array(
            'estimates_id'      => $id,
            'estimate_type'     => 'Bundle',
            'bundle_option_type'=> '1',
          );

        $this->db->select('*, estimates_items.cost as costing');
		$this->db->from('estimates_items');
        $this->db->join('items', 'estimates_items.items_id  = items.id');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getItemlistByIDBundle2($id)
    {
        $where = array(
            'estimates_id'      => $id,
            'estimate_type'     => 'Bundle',
            'bundle_option_type'=> '2',
          );

        $this->db->select('*, estimates_items.cost as costing');
		$this->db->from('estimates_items');
        $this->db->join('items', 'estimates_items.items_id  = items.id');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getAllEstimatesByCustomerId($customer_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('view_flag', '0');
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*,estimates.id, estimates.estimate_number, estimates.job_name, estimates.estimate_eqpt_cost, estimates.user_id, estimates.estimate_date, estimates.customer_id, estimates.company_id, estimates.status, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'estimates.customer_id = acs_profile.prof_id', 'left');
        $this->db->where("estimates.id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getEstimatesByCustomerWithParam($param){
        if(array_key_exists("table", $param) && $param['table'] != NULL){
            $this->db->from($param['table']);
        }else{
            return FALSE;
        }

        if(array_key_exists("select", $param) && $param['select'] != NULL){
            $this->db->select($param['select']);
        }else{
            $this->db->select('*');
        }
        if(array_key_exists("where_in", $param)){
            foreach($param['where_in'] as $key => $val){
                if($val != ''){
                    $this->db->where_in($key, $val);
                }else{
                    if($val == 0){
                        $this->db->where_in($key, $val);
                    }else{
                        $this->db->where_in($key);
                    }
                }
            }
        }
        if(array_key_exists("where", $param)){
            foreach($param['where'] as $key => $val){
                if($val != ''){
                    $this->db->where($key, $val);
                }else{
                    if($val == 0){
                        $this->db->where($key, $val);
                    }else{
                        $this->db->where($key);
                    }
                }
            }
        }
        if(array_key_exists("where_not_in", $param)){
            foreach($param['where_not_in'] as $key => $val){
                if($val != ''){
                    $this->db->where_not_in($key, $val);
                }else{
                    if($val == 0){
                        $this->db->where_not_in($key, $val);
                    }else{
                        $this->db->where_not_in($key);
                    }
                }
            }
        }
        
        if(array_key_exists("group_by",$param) && $param['group_by'] != NULL ){
            $this->db->group_by($param['group_by']);
        }

        if(array_key_exists("join", $param)){
            foreach($param['join'] as $key => $val){
                if($val != ''){
                    $this->db->join($key, $val);
                }
            }
        }   

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getEstimateCustomerName()
    {
        $this->db->select('acs_profile.first_name, acs_profile.last_name, estimates.customer_id');
        $this->db->from('acs_profile');
        $this->db->join('estimates', 'acs_profile.prof_id == estimates.customer_id');
        $this->db->group_by('estimates.customer_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_company_open_estimates($companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where_not_in('status', ['Draft', 'Invoiced', 'Lost', 'Declined By Customer']);
        $this->db->where('view_flag', 0);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_customer_estimates($customerId, $companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('customer_id', $customerId);
        $this->db->where_not_in('status', ['Draft', 'Invoiced', 'Lost', 'Declined By Customer']);
        $this->db->where('view_flag', 0);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}

/* End of file Estimate_model.php */
/* Location: ./application/models/Estimate_model.php */
