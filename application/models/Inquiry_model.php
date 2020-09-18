<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inquiry_model extends MY_Model
{

    public $table = 'inquiries';
    public $table_2 = 'online_lead_form';
    public $table_3 = 'customize_lead_forms';


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


    public function getInquiry($inquiry_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $inquiry_id);

        $query = $this->db->get();
        return $query->row();
    }


    public function saveServiceAddress($data, $inquiry_id = 0)
    {

        $old_addresses = $this->getServiceAddress(array('id' => $inquiry_id));

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

        if ($inquiry_id) {

            $this->db->where('id', $inquiry_id);

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

        if (isset($params['session_inquiry_id'])) {

            $this->db->where('id', $params['session_inquiry_id']);
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


    public function removeServiceAddress($inquiry_id, $index)
    {

        $addresses = $this->getServiceAddress(['id' => $inquiry_id]);

        if ($addresses !== false) {

            array_splice($addresses, $index, 1);

            // update the DB
            $this->db->where('id', $inquiry_id);

            return $this->db->update($this->table, ['service_address' => serialize($addresses)]);
        }

        return false;
    }


    public function getAdditionalContacts($params = array(), $index = -1)
    {

        $this->db->select('additional_contacts');
        $this->db->from($this->table);

        if (isset($params['session_inquiry_id'])) {

            $this->db->where('id', $params['session_inquiry_id']);
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


    public function saveAdditionalContact($data, $inquiry_id = 0)
    {

        $old_contacts = $this->getAdditionalContacts(array('id' => $inquiry_id));

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

        // print_r($inquiry_id); die;

        if ($inquiry_id) {

            $this->db->where('id', $inquiry_id);

            return $this->db->update($this->table, ['additional_contacts' => serialize($old_contacts)]);
        } else {

            // print_r($old_contacts); die;

            $this->db->insert($this->table, ['additional_contacts' => serialize($old_contacts)]);
        }

        return $this->db->insert_id();
    }

    public function removeAdditionalContact($inquiry_id, $index)
    {

        $addresses = $this->getAdditionalContacts(['id' => $inquiry_id]);

        if ($addresses !== false) {

            array_splice($addresses, $index, 1);

            // update the DB
            $this->db->where('id', $inquiry_id);

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
                $this->db->or_like('inquiries.contact_name', $filters['search']);
                $this->db->or_like('inquiries.contact_email', $filters['search']);
                $this->db->or_like('inquiries.phone', $filters['search']);
                $this->db->group_end();
            } elseif (!empty($filters['type'])) {

                $this->db->where('inquiry_type', $filters['type']);
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

                case 'created_at-asc':
                    $this->db->order_by('created_at', 'asc');
                    break;

                case 'created_at-desc':
                    $this->db->order_by('created_at', 'desc');
                    break;

                case 'last-created_at-asc':
                    $this->db->order_by("(SUBSTR(created_at, INSTR(created_at, ' ')))", '');
                    break;

                case 'last-created_at-desc':
                    $this->db->order_by("(SUBSTR(created_at, INSTR(created_at, ' '))) DESC", '');
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

    public function getAllLeadFormByCompany($comp_id) {
        $this->db->select('*');
        $this->db->from($this->table_2);
        $this->db->where('company_id', $comp_id);
        $query = $this->db->get();

        return $query->row();
    }
    
    public function getAllCustomizeLeadFormByCompany($comp_id, $type) {
        $array = array('company_id' => $comp_id, 'type' => $type);
        
        $this->db->select('*');
        $this->db->from($this->table_3);
        $this->db->where($array);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllCustomizeLeadFormByDefault() {
        $array = array('company_id' => 0, 'type' => 'default');
        
        $this->db->select('*');
        $this->db->from($this->table_3);
        $this->db->where($array);
        $query = $this->db->get();

        return $query->result();
    }
}

/* End of file Inquiry_model.php */
/* Location: ./application/models/Inquiry_model.php */
