<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends MY_Model
{

    public $table = 'customers';


    public function getAll()
    {

        
        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $company_id = logged('company_id');
            
            return $this->getAllByCompany($company_id);

        } else {

            return $this->getAllByUserId();
        }
    }

    public function getAllByCompany($company_id, $filter = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if (!empty($filter)) {

            if (isset($filter['q'])) {

                $this->db->like('contact_name', $filter['q'], 'both');
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyWithMobile($company_id, $filter = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('mobile !=', '');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0, $filter = array())
    {

        $user_id = getLoggedUserID();

        $this->db->select('*');
        $this->db->from($this->table);

        if (!$uid) {
            $this->db->where('user_id', $user_id);
        } else {
            $this->db->where('user_id', $uid);
        }

        if (!empty($filter)) {

            if (isset($filter['q'])) {

                $this->db->like('contact_name', $filter['q'], 'both');
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }


    public function getCustomer($customer_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $customer_id);

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
                $this->db->or_like('customers.contact_name', $filters['search']);
                $this->db->or_like('customers.contact_email', $filters['search']);
                $this->db->or_like('customers.phone', $filters['search']);
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
                    $this->db->order_by('contact_name', 'asc');
                    break;

                case 'name-desc':
                    $this->db->order_by('contact_name', 'desc');
                    break;

                case 'last-name-asc':
                    $this->db->order_by("(SUBSTR(contact_name, INSTR(contact_name, ' ')))", '');
                    break;

                case 'last-name-desc':
                    $this->db->order_by("(SUBSTR(contact_name, INSTR(contact_name, ' '))) DESC", '');
                    break;

                case 'email-asc':
                    $this->db->order_by('contact_email', 'asc');
                    break;

                case 'email-desc':
                    $this->db->order_by('contact_email', 'desc');
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
}

/* End of file Customer_model.php */
/* Location: ./application/models/Customer_model.php */
