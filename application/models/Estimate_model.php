<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estimate_model extends MY_Model
{

    public $table = 'estimates';

    public function getAllByCompany($company_id)
    {
        $where = array(
            'view_flag'     => '0',
            'company_id'    => $company_id
          );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

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
            'updated_at'                => $updated_at,
            
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
            'updated_at'                => $updated_at,
            
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
            'updated_at'                => $updated_at,
            
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
        $query = $this->db->get();
        return $query->result();
    }

    public function add_estimate_items($data)
    {
        $vendor = $this->db->insert('estimates_items', $data);
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

        $this->db->select('estimates.id, estimates.estimate_number, estimates.job_name, estimates.estimate_eqpt_cost, estimates.user_id, estimates.estimate_date, estimates.customer_id, estimates.company_id, estimates.status');

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

                $this->db->join('customers', "customers.id = estimates.customer_id");
                $this->db->like('customers.contact_name', $filters['search']);
            } elseif (isset($filters['order'])) {

                switch ($filters['order']) {

                    case 'added-desc':
                        $this->db->order_by('created_at', 'DESC');
                        break;

                    case 'added-asc':
                        $this->db->order_by('created_at');
                        break;

                    case 'date-accepted-desc':
                        $this->db->order_by("(CASE status WHEN '" . ESTIMATE_STATUS_ACCEPTED . "' THEN 0 ELSE 1 END), date_issued DESC");
                        break;

                    case 'date-accepted-asc':
                        $this->db->order_by("(CASE status WHEN '" . ESTIMATE_STATUS_ACCEPTED . "' THEN 1 ELSE 0 END), date_issued ASC");
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
}

/* End of file Estimate_model.php */
/* Location: ./application/models/Estimate_model.php */
