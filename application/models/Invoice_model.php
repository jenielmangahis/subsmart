<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends MY_Model
{
    public $table = 'invoices';


    public function getAll()
    {
        $role = logged('role');

        if ($role == 2 || $role == 3) {
            $comp_id = logged('company_id');

            return $this->getAllByCompany($comp_id);
        } else {
            return $this->getAllByUserId();
        }
    }


    public function delete_items($id)
    {
        $where = array(
            'invoice_id'   => $id
          );

        $this->db->where($where);
        $this->db->delete('invoices_items');
        return true;
    }

    public function update_invoice_data($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('invoices', array(
            // 'customer_id'               => $customer_id,
            'job_location'              => $job_location, //
            'job_name'                  => $job_name,//
            'invoice_type'              => $invoice_type,//
            'po_number'                 => $po_number,//
            'date_issued'               => $date_issued,//
            'due_date'                  => $due_date,//
            'status'                    => $status,//
            'customer_email'            => $customer_email,//
            'online_payments'           => $online_payments,
            'billing_address'           => $billing_address,//
            'shipping_to_address'       => $shipping_to_address,
            'ship_via'                  => $ship_via,//
            'shipping_date'             => $shipping_date,
            'tracking_number'           => $tracking_number,//
            'terms'                     => $terms,//
            'location_scale'            => $location_scale,//
            'message_on_invoice'        => $message_on_invoice,
            'message_on_statement'      => $message_on_statement,
            'job_number'                => $job_number, //to add on database
            // 'attachments'            => $this->input->post('attachments'),
            'tags'                      => $tags,//
            // 'total_due'              => $this->input->post('total_due'),
            // 'balance'                => $this->input->post('balance'),
            'deposit_request_type'      => $deposit_request_type,
            'deposit_request'           => $deposit_request,
            'message_to_customer'       => $message_to_customer,
            'terms_and_conditions'      => $terms_and_conditions,
            // 'signature'              => $this->input->post('signature'),
            // 'sign_date'              => $this->input->post('sign_date'),
            // 'is_recurring'           => $this->input->post('is_recurring'),
            // 'invoice_totals'         => $this->input->post('invoice_totals'),
            // 'phone'                     => $this->input->post('phone'),
            'payment_schedule'          => $payment_schedule,
            'sub_total'                 => $subtotal,
            'taxes'                     => $taxes,
            'adjustment_name'           => $adjustment_name,
            'adjustment_value'          => $adjustment_value,
            'grand_total'               => $grand_total,
            'date_updated'              => $date_updated,
            
        ));
        return true;
    }

    public function createInvoice($data)
    {
        $vendor = $this->db->insert('invoices', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function getAllByCompany($comp_id, $type, $filter = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $comp_id);
        $this->db->where('is_recurring', $type);

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


    public function getinvoice($invoice_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $invoice_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getItems($id)
    {
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $cus = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        $where = array(
            'type' => 'Invoice',
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

    public function getItemsInv($id)
    {
        $where = array(
            'invoice_id'      => $id,
          );

        $this->db->select('*, invoices_items.cost as costing');
        $this->db->from('invoices_items');
        $this->db->join('items', 'invoices_items.items_id  = items.id');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getPayments($inv)
    {
        $where = array(
            'invoice_number'      => $inv,
          );

        $this->db->select('*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'payment_records.customer_id = acs_profile.prof_id');
        $this->db->from('payment_records');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function deleteInvoice($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('invoices', array('view_flag' => $view_flag));
        return true;
    }
    public function void_invoice($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('invoices', array('voided' => $voided));
        return true;
    }

    public function getInvoiceCustomer($id)
    {
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $cus = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        $where = array(
            'prof_id '   => $cus->customer_id
          );

        $this->db->select('*');
        $this->db->from('acs_profile');
        // $this->db->where('type', 'Work Order');
        // $this->db->where('type_id', $cus->id);
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function getAllData($company_id)
    {
        $where = array(
            'invoices.company_id'      => $company_id,
            'invoices.view_flag'                => '0',
          );

        // $company_id = getLoggedCompanyID();
        // $vendor = $this->db->get('invoices'->where('company_id', $company_id));

        $this->db->select('*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');

        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id');

        // $this->db->select('*');
        // $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllDataSales($company_id)
    {
        $where = array(
            'invoices.company_id'      => $company_id,
            'invoices.view_flag'       => '0',
            'invoices.invoice_type'    => 'Final Payment',
          );

        // $company_id = getLoggedCompanyID();
        // $vendor = $this->db->get('invoices'->where('company_id', $company_id));

        $this->db->select('*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');

        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id');

        // $this->db->select('*');
        // $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllOpenInvoices($company_id)
    {
        $where = array(
            'invoices.company_id'      => $company_id,
            'invoices.view_flag'       => '0',
            'invoices.status !='       => 'Paid',
          );

        // $company_id = getLoggedCompanyID();
        // $vendor = $this->db->get('invoices'->where('company_id', $company_id));

        $this->db->select('*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');

        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id');

        // $this->db->select('*');
        // $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    public function getclientsData($customer_id)
    {
        $where = array(
            'id '   => $customer_id
          );

        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function getAllInvPaid($company_id)
    {
        $where = array(
            'invoices.company_id'      => $company_id,
            'invoices.view_flag'       => '0',
            'invoices.status'          => 'Paid',
          );

        // $company_id = getLoggedCompanyID();
        // $vendor = $this->db->get('invoices'->where('company_id', $company_id));

        $this->db->select('*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');

        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id');

        // $this->db->select('*');
        // $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    public function InvOverdue($company_id)
    {
        $date_now = date("Y-m-d");

        $where = array(
            'invoices.company_id'      => $company_id,
            'invoices.view_flag'       => '0',
            'invoices.status'          => 'Overdue',
            // 'invoices.due_date >='      => $date_now,
          );

        // $company_id = getLoggedCompanyID();
        // $vendor = $this->db->get('invoices'->where('company_id', $company_id));

        $this->db->select('*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');

        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id');

        // $this->db->select('*');
        // $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    public function saveServiceAddress($data, $invoice_id = 0)
    {
        $old_addresses = $this->getServiceAddress(array('id' => $invoice_id));

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

        if ($invoice_id) {
            $this->db->where('id', $invoice_id);

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

        if (isset($params['session_invoice_id'])) {
            $this->db->where('id', $params['session_invoice_id']);
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


    public function removeServiceAddress($invoice_id, $index)
    {
        $addresses = $this->getServiceAddress(['id' => $invoice_id]);

        if ($addresses !== false) {
            array_splice($addresses, $index, 1);

            // update the DB
            $this->db->where('id', $invoice_id);

            return $this->db->update($this->table, ['service_address' => serialize($addresses)]);
        }

        return false;
    }


    public function getAdditionalContacts($params = array(), $index = -1)
    {
        $this->db->select('additional_contacts');
        $this->db->from($this->table);

        if (isset($params['session_invoice_id'])) {
            $this->db->where('id', $params['session_invoice_id']);
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


    public function saveAdditionalContact($data, $invoice_id = 0)
    {
        $old_contacts = $this->getAdditionalContacts(array('id' => $invoice_id));

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

        // print_r($invoice_id); die;

        if ($invoice_id) {
            $this->db->where('id', $invoice_id);

            return $this->db->update($this->table, ['additional_contacts' => serialize($old_contacts)]);
        } else {

            // print_r($old_contacts); die;

            $this->db->insert($this->table, ['additional_contacts' => serialize($old_contacts)]);
        }

        return $this->db->insert_id();
    }

    public function removeAdditionalContact($invoice_id, $index)
    {
        $addresses = $this->getAdditionalContacts(['id' => $invoice_id]);

        if ($addresses !== false) {
            array_splice($addresses, $index, 1);

            // update the DB
            $this->db->where('id', $invoice_id);

            return $this->db->update($this->table, ['additional_contacts' => serialize($addresses)]);
        }

        return false;
    }


    public function getStatusWithCount($company_id = 0, $type)
    {
        $this->db->select('id, status, COUNT(id) as total');
        $this->db->from($this->table);
        $this->db->where('is_recurring', $type);


        if (isset($company_id)) {
            $this->db->where('company_id', $company_id);
        } else {
            $this->db->where('user_id', getLoggedUserID());
        }

        $this->db->group_by('status');

        $query = $this->db->get();
        return $query->result();
    }

    public function filterBy($filters = array(), $company_id = 0, $type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_recurring', $type);

        if (!empty($filters)) {
            if (isset($filters['status'])) {
                switch ($filters['status']) {
                    case 2:
                        $today = date("Y-m-d");
                        $this->db->where('due_date', $today);
                        break;

                    case 3:
                        $today = date("Y-m-d");
                        $this->db->where('due_date <', $today);
                        break;

                    case 4:
                        $this->db->where('status', 'Partial Paid');
                        break;

                    case 5:
                        $this->db->where('status', 'Paid');
                        break;

                    case 6:
                        $this->db->where('status', 'Draft');
                        break;

                    default:
                    $this->db->where('status', $filters['status']);
                    break;
                }
            } elseif (isset($filters['search'])) {
                $this->db->group_start();
                $this->db->or_like('invoices.invoice_number', $filters['search']);
                $this->db->or_like('invoices.job_name', $filters['search']);
                $this->db->or_like('invoices.job_location', $filters['search']);
                $this->db->group_end();
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

    public function add_invoice_items($data)
    {
        $vendor = $this->db->insert('invoices_items', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function getInvoiceItems($id)
    {
        // $this->db->select('*');
        // $this->db->from('work_orders_items');
        // $this->db->where('work_order_id', $id);
        // $query = $this->db->get();
        // $cus = $query->row();

        // $this->db->select('* , work_orders.email AS w_email, work_orders.status AS w_status');
        // $this->db->from('work_orders');
        // $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');

        $this->db->select('*, invoices_items.cost as iCost, invoices_items.tax as itax, invoices_items.total as iTotal, items.title, items.type as item_type');
        $this->db->from('invoices_items');
        $this->db->join('items', 'invoices_items.items_id  = items.id');
        $this->db->where('invoice_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function duplicateRecord($primary_key, $comp_id)
    {
        $this->db->where('id', $primary_key);
        $query = $this->db->get($this->table);
        $invoice = $this->getLastRow($comp_id);
        $new_invoice_number = explode("-", $invoice->invoice_number)[0] . '-' . strval(intval(explode("-", $invoice->invoice_number)[1]) + 1);

        foreach ($query->result() as $row) {
            foreach ($row as $key=>$val) {
                if ($key != 'id' && $key != 'invoice_number' && $key != 'status' && $key != 'created_at' && $key != 'updated_at') {
                    $this->db->set($key, $val);
                }

                if ($key === 'invoice_number') {
                    $this->db->set($key, $new_invoice_number);
                }

                if ($key === 'status') {
                    $this->db->set($key, "Draft");
                }
            }
        }

        return $this->db->insert($this->table);
    }

    public function markAsSent($id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['status' => 'Due']);
    }

    public function getLastRow($comp_id)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('company_id', $comp_id);
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->row();
    }

    public function getlastInsert()
    {
        $this->db->select('*');
        $this->db->from('invoices');
        // $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        // $query = $this->db->query("SELECT * FROM date_data ORDER BY id DESC LIMIT 1");
        $result = $this->db->get();
        return $result->result();
    }

    public function savenewCustomer($data)
    {
        $custom = $this->db->insert('acs_profile', $data);
        $insert = $this->db->insert_id();
        return  $insert;
    }
}

/* End of file Invoice_model.php */
/* Location: ./application/models/invoice_model.php */
