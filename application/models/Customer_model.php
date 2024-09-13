<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends MY_Model
{

    public $table = 'acs_profile';


    public function getAll()
    {

        
        $role = logged('role');

        if ($role == 2 || $role == 3 || $role == 6) {

            $company_id = logged('company_id');
            
            return $this->getAllByCompany($company_id);

        } else {

            return $this->getAllByUserId();
        }
    }

    public function insert_data($data) {
        // Insert data into the database
        $this->db->insert($this->table, $data);
    
        // Check if the insertion was successful
        return $this->db->affected_rows() > 0;
    }
    public function update_data($prof_id, $updated_data) {
        // Update data in the database
        $this->db->where('prof_id', $prof_id);
        $this->db->update($this->table, $updated_data);
        
        // Check if the update was successful
        return $this->db->affected_rows() > 0;
    }

    public function getAllByCompany($company_id, $filter = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if (!empty($filter)) {

            if (isset($filter['q'])) {

                $this->db->like('first_name', $filter['q'], 'both');
            }
        }

        $query = $this->db->get();
        return $query->result();
    }
    // public function getAllCommercialCustomers($search = null,$company_id,$customer_type,$filter_status = null){
    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     $this->db->where('company_id', $company_id);
    //     $this->db->where('customer_type', $customer_type);

    //     if(!empty($filter_status)){
    //         $this->db->where('status',$filter_status); 
    //     }

    //     if (!empty($search)) {
    //         $this->db->group_start(); // Start grouping the OR conditions
    //         $this->db->or_like('acs_profile.last_name', $search, 'both');
    //         $this->db->or_like('acs_profile.first_name', $search, 'both');
    //         $this->db->or_like('acs_profile.email', $search, 'both');
    //         $this->db->or_like('acs_profile.business_name', $search, 'both');
    //         $this->db->group_end(); // End grouping
    //     }

    //     $this->db->order_by('prof_id', 'desc'); // Add this line to order by descending
    //     $query = $this->db->get();
    //     return $query->result();

    // }

    public function getAllCustomerByCustomerType($search = null, $company_id, $customer_type, $filter_status = null) {
        $this->db->select('*, acs_billing.mmr AS customer_mmr, concat(acs_profile.mail_add, " ", acs_profile.city, " ", acs_profile.state," , ",acs_profile.zip_code) AS customer_address');
        $this->db->from($this->table);
        $this->db->join('acs_billing', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('company_id', $company_id);
        $this->db->where('customer_type', $customer_type);        
            
        if (!empty($filter_status)) {
            if($filter_status =="Active Subscription"){
                $this->db->where_in('status', ['Active w/RAR','Active w/RMR','Active w/RQR','Active w/RYR','Inactive w/RMM']); 
            }else{
                $this->db->where('status', $filter_status); 
            }
            
        }
    
        if (!empty($search)) {
            $this->db->group_start(); // Start grouping the OR conditions
            $this->db->like('acs_profile.last_name', $search, 'both');
            $this->db->or_like('acs_profile.first_name', $search, 'both');
            $this->db->or_like('acs_profile.email', $search, 'both');
            $this->db->or_like('acs_profile.business_name', $search, 'both');
            $this->db->group_end(); // End grouping
        }
    
        // Add additional conditions to exclude records where first_name, last_name, and email are empty
        //$this->db->where("(acs_profile.email != '')");
        $this->db->where("(acs_profile.first_name != '')");
        $this->db->where("(acs_profile.last_name != '')");
    
    
        $this->db->order_by('prof_id', 'desc'); // Add this line to order by descending
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllCommercialCustomers($search = null, $company_id, $customer_type, $filter_status = null) {
        $this->db->select('*, acs_billing.mmr AS customer_mmr, concat(acs_profile.mail_add, " ", acs_profile.city, " ", acs_profile.state," , ",acs_profile.zip_code) AS customer_address');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('customer_type', $customer_type);
        $this->db->join('acs_billing', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
    
        if (!empty($filter_status)) {
            $this->db->where('status', $filter_status); 
        }
    
        if (!empty($search)) {
            $this->db->group_start(); // Start grouping the OR conditions
            $this->db->like('acs_profile.last_name', $search, 'both');
            $this->db->or_like('acs_profile.first_name', $search, 'both');
            $this->db->or_like('acs_profile.email', $search, 'both');
            $this->db->or_like('acs_profile.business_name', $search, 'both');
            $this->db->group_end(); // End grouping
        }
    
        // Add additional conditions to exclude records where first_name, last_name, and email are empty
        //$this->db->where("(acs_profile.email != '')");
        $this->db->where("(acs_profile.first_name != '')");
        $this->db->where("(acs_profile.last_name != '')");
    
    
        $this->db->order_by('prof_id', 'desc'); // Add this line to order by descending
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAllByCompanyWithMobile($company_id, $filter = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('phone_m !=', '');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyWithEmail($company_id, $filter = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('contact_email !=', '');

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0, $filter = array())
    {

        $user_id = getLoggedUserID();

        $this->db->select('*');
        $this->db->from($this->table);

        if (!$uid) {
            $this->db->where('fk_user_id', $user_id);
        } else {
            $this->db->where('fk_user_id', $uid);
        }

        if (!empty($filter)) {

            if (isset($filter['q'])) {

                $this->db->like('first_name', $filter['q'], 'both');
            }
        }

        $this->db->order_by('prof_id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }


    public function getCustomer($customer_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $customer_id);

        $query = $this->db->get();
        return $query->row();
    }


    public function saveServiceAddress($data, $customer_id = 0)
    {

        $old_addresses = $this->getServiceAddress(array('id' => $customer_id));

        // if ( !empty($old_addresses) ) {

        //     array_push($old_addresses, $data);
        // } else {

        //     $old_addresses = array();
        //     array_push($old_addresses, $data);
        // }

        if (isset($data['data_index']) && $data['data_index'] >= 0) {

            $old_addresses[$data['data_index']] = $data;
        } else {

            if (!empty($old_addresses)) {

                array_push($old_addresses, $data);
            } else {

                $old_addresses = array();
                array_push($old_addresses, $data);
            }
        }

        if ($customer_id) {

            $this->db->where('id', $customer_id);

            return $this->db->update($this->table, ['service_address' => serialize($old_addresses)]);
        } else {

            $this->db->insert($this->table, ['service_address' => serialize($old_addresses)]);
        }

        return $this->db->insert_id();
    }


    public function getServiceAddress($params = array(), $index = -1)
    {

        $this->db->select('service_address');
        $this->db->from($this->table);

        if (isset($params['session_customer_id'])) {

            $this->db->where('id', $params['session_customer_id']);
        } elseif (isset($params['id'])) {

            $this->db->where('id', $params['id']);
        }

        $query = $this->db->get();

        if (!empty($query)) {

            $addresses = unserialize($query->row('service_address'));

            if ((!empty($addresses)) && $index >= 0) {

                return $addresses[$index];
            }

            return $addresses;
        }

        return false;
    }


    public function removeServiceAddress($customer_id, $index)
    {

        $addresses = $this->getServiceAddress(['id' => $customer_id]);

        if ($addresses !== false) {

            array_splice($addresses, $index, 1);

            // update the DB
            $this->db->where('id', $customer_id);

            return $this->db->update($this->table, ['service_address' => serialize($addresses)]);
        }

        return false;
    }


    public function getAdditionalContacts($params = array(), $index = -1)
    {

        $this->db->select('additional_contacts');
        $this->db->from($this->table);

        if (isset($params['session_customer_id'])) {

            $this->db->where('id', $params['session_customer_id']);
        } elseif (isset($params['id'])) {

            $this->db->where('id', $params['id']);
        }

        $query = $this->db->get();

        if (!empty($query)) {

            $addresses = unserialize($query->row('additional_contacts'));

            if ((!empty($addresses)) && $index >= 0) {

                return $addresses[$index];
            }

            return $addresses;
        }

        return false;
    }


    public function saveAdditionalContact($data, $customer_id = 0)
    {

        $old_contacts = $this->getAdditionalContacts(array('id' => $customer_id));

        // print_r($old_contacts); die;

        // if edit action perform
        if (isset($data['data_index']) && $data['data_index'] >= 0) {

            $old_contacts[$data['data_index']] = $data;
        } else {

            if (!empty($old_contacts)) {

                array_push($old_contacts, $data);
            } else {

                $old_contacts = array();
                array_push($old_contacts, $data);
            }
        }

        // print_r($customer_id); die;

        if ($customer_id) {

            $this->db->where('id', $customer_id);

            return $this->db->update($this->table, ['additional_contacts' => serialize($old_contacts)]);
        } else {

            // print_r($old_contacts); die;

            $this->db->insert($this->table, ['additional_contacts' => serialize($old_contacts)]);
        }

        return $this->db->insert_id();
    }

    public function removeAdditionalContact($customer_id, $index)
    {

        $addresses = $this->getAdditionalContacts(['id' => $customer_id]);

        if ($addresses !== false) {

            array_splice($addresses, $index, 1);

            // update the DB
            $this->db->where('id', $customer_id);

            return $this->db->update($this->table, ['additional_contacts' => serialize($addresses)]);
        }

        return false;
    }


    function getStatusWithCount($company_id = 0)
    {

        $this->db->select('id, status, COUNT(id) as total');
        $this->db->from($this->table);


        if (isset($company_id)) {
            $this->db->where('company_id', $company_id);
        } else {
            $this->db->where('user_id', getLoggedUserID());
        }

        $this->db->group_by('status');

        $query = $this->db->get();
        return $query->result();

    }

    public function filterBy($filters = array(), $company_id = 0)
    {

        $this->db->select('*');
        $this->db->from($this->table);

        if (!empty($filters)) {

            if (isset($filters['status'])) {

                $this->db->where('status', $filters['status']);
            } elseif (isset($filters['search'])) {
                $this->db->group_start();
                $this->db->or_like('acs_profile.first_name', $filters['search']);
                $this->db->or_like('acs_profile.email', $filters['search']);
                $this->db->or_like('acs_profile.phone_h', $filters['search']);
                $this->db->group_end();
            } elseif (!empty($filters['type'])) {

                $this->db->where('customer_type', $filters['type']);
            }
        }

        //
        if (isset($company_id)) {
            $this->db->where('company_id', $company_id);
        } else {

            $this->db->where('user_id', getLoggedUserID());
        }

        if (!empty($filters['order'])) {

            switch ($filters['order']) {

                case 'name-asc':
                    $this->db->order_by('first_name', 'asc');
                    break;

                case 'name-desc':
                    $this->db->order_by('first_name', 'desc');
                    break;

                case 'last-name-asc':
                    $this->db->order_by("(SUBSTR(first_name, INSTR(first_name, ' ')))", '');
                    break;

                case 'last-name-desc':
                    $this->db->order_by("(SUBSTR(first_name, INSTR(first_name, ' '))) DESC", '');
                    break;

                case 'email-asc':
                    $this->db->order_by('email', 'asc');
                    break;

                case 'email-desc':
                    $this->db->order_by('email', 'desc');
                    break;
            }
        }

        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        return $query->result();
    }

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getRows($params = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }

    public function insert($data = array()) {
        if(!empty($data)){     
            $insert = $this->db->insert($this->table, $data);
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    public function getuserIbiz($id)
    {
        $this->db->select('*');
        $this->db->from('user_ibiz');
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getuserIB($uid)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $uid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getibizDetailsAdd($id)
    {
        $where = array(
            'ibiz_id'       => $id,
            'name'          => 'address'
          );

        $this->db->select('*');
        $this->db->from('user_ibiz_items');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function getibizDetailsPh($id)
    {
        $where = array(
            'ibiz_id'       => $id,
            'name'          => 'phone'
          );

        $this->db->select('*');
        $this->db->from('user_ibiz_items');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function ibizDetailsEmail($id)
    {
        $where = array(
            'ibiz_id'       => $id,
            'name'          => 'email'
          );

        $this->db->select('*');
        $this->db->from('user_ibiz_items');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_ibiz_details($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $query = $this->db->update('user_ibiz_items', array('value' => $value));
        return $query;
    }

    public function recordActivityLogs($data = array()) {
        $INSERT = $this->db->insert('customer_activity_logs', $data);
        if ($INSERT) {
            return true;
        }
    }

    public function deleteCustomer($id)
    {
        $this->db->delete($this->table, array("prof_id" => $id));        
    }

    public function updateCustomerSpecificData($primaryKey, $id, $table, $data, $updateType) 
    {
        $company_id = logged('company_id');
        $this->db->select('acs_profile.prof_id');
        $this->db->from('acs_profile');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $company_id);
        $allEntries = $this->db->get()->result_array();
        
        if ($updateType == "all_rows") {
            $this->db->where_in($primaryKey, json_decode($allEntries, true));
            return $this->db->update($table, $data);
        } else if ($updateType == "ten_rows") {
            $this->db->where_in($primaryKey, json_decode($id, true));
            return $this->db->update($table, $data);
        } else if ($updateType == "specific_update") {
            $this->db->where($primaryKey, $id);
            return $this->db->update($table, $data);
        }
    }

}

/* End of file Customer_model.php */
/* Location: ./application/models/Customer_model.php */
