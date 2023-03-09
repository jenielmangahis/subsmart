<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends MY_Model
{

    public $table = 'tickets';

    public function save_tickets($data)
    {
        $custom = $this->db->insert($this->table, $data);
        $insert = $this->db->insert_id();
		return  $insert;
    }

    public function get_tickets_data()
    {
        $company_id = logged('company_id');
        
        $where = array(
            'tickets.company_id' => $company_id,
        );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'tickets.customer_id  = acs_profile.prof_id');
		$this->db->where($where);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getHeaders()
    {
        $company_id = logged('company_id');
        
        $where = array(
            'company_id' => $company_id,
        );

        $this->db->select('*');
        $this->db->from('tickets_headers');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    
    public function add_ticket_items($data)
    {
        $vendor = $this->db->insert('tickets_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function saveServiceType($data)
    {
        $data = $this->db->insert('service_type', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function saveHeader($data)
    {

        $data = $this->db->insert('tickets_headers', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function updateHeader($data)
    {
        extract($data);
        $this->db->where('company_id', $company_id);
        $this->db->update('tickets_headers', array(
            'content'   => $content,
        ));

        return true;
    }
    
    public function save_payment($data)
    {
        $vendor = $this->db->insert('tickets_payments', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function get_tickets_data_one($id)
    {
        $company_id = logged('company_id');
        
        $where = array(
            'id' => $id,
        );

        $this->db->select('*, tickets.business_name as business_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'tickets.customer_id  = acs_profile.prof_id');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_tickets_header($company_id)
    {
        $where = array(
            'company_id' => $company_id,
        );

        $this->db->select('*');
        $this->db->from('tickets_headers');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCompany($id)
    {
        $where = array(
            'company_id' => $id,
        );

        $this->db->select('*');
        $this->db->from('business_profile');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_tickets_clients($company_id)
    {
        $where = array(
            'company_id' => $company_id,
        );

        $this->db->select('*');
        $this->db->from('business_profile');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_tickets_items($id)
    {
        
        // $where = array(
        //     'id' => $id,
        // );

        // $this->db->select('*');
        // $this->db->from($this->table);
        // $this->db->join('acs_profile', 'tickets.customer_id  = acs_profile.prof_id');
		// $this->db->where($where);
        // $query = $this->db->get();
        // return $query->result();
    }

    public function  getServiceType($company_id)
    {
        $where = array(
            'company_id' => $company_id,
        );

        $this->db->select('*');
        $this->db->from('service_type');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tickets_company($id)
    {

        $where = array(
            'id' => $id,
        );

        $this->db->select('*');
        $this->db->from('clients');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ticket_representative($ticket_rep)
    {
        $where = array(
            'id' => $ticket_rep,
        );

        $this->db->select('*');
        $this->db->from('users');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getlastInsert($company_id){

        $where = array(
            // 'view_flag'     => '0',
            'company_id'   => $company_id
          );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        // $query = $this->db->query("SELECT * FROM date_data ORDER BY id DESC LIMIT 1");
        $result = $this->db->get();
        return $result->row();
    }

    public function get_ticket_items($id)
    {
        $where = array(
            'ticket_id' => $id,
        );

        $this->db->select('*, tickets_items.cost AS costing');
        $this->db->from('tickets_items');
        $this->db->join('items', 'tickets_items.items_id  = items.id');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_ticket_payments($id)
    {
        $where = array(
            'ticket_id' => $id,
        );

        $this->db->select('*');
        $this->db->from('tickets_payments');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUserDetails($id)
    {
        $where = array(
            'id' => $id,
        );

        $this->db->select('*');
        $this->db->from('users');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_tickets_by_company_id($company_id = 0)
    {
        $this->db->select('tickets.*, acs_profile.first_name,acs_profile.last_name, users.FName, users.LName');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = tickets.customer_id', 'left');        
        $this->db->join('users', 'users.id = tickets.sales_rep', 'left');        
        $this->db->where('tickets.company_id', $company_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_tickets_by_id_and_company_id($id = 0, $company_id = 0)
    {
        $this->db->select('tickets.*, acs_profile.first_name,acs_profile.last_name, acs_profile.phone_m, users.FName, users.LName');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = tickets.customer_id', 'left');        
        $this->db->join('users', 'users.id = tickets.sales_rep', 'left');        
        $this->db->where('tickets.company_id', $company_id);
        $this->db->where('tickets.id', $id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_upcoming_tickets_by_company_id($company_id = 0)
    {
        //$start_date = date('m/d/Y');
        $start_date = date("Y-m-d");

        $this->db->select('tickets.*, acs_profile.first_name,acs_profile.last_name,acs_profile.phone_m,acs_profile.phone_h');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = tickets.customer_id', 'left');        
        $this->db->where('tickets.company_id', $company_id);
        $this->db->where('tickets.ticket_date >=',$start_date);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_utickets_by_company_id_and_date($company_id = 0, $date)
    {
        //$date = date('m/d/Y', strtotime($date));
        $date = date('Y-m-d', strtotime($date));

        $this->db->select('tickets.*, acs_profile.first_name,acs_profile.last_name,acs_profile.phone_m');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = tickets.customer_id', 'left');        
        $this->db->where('tickets.company_id', $company_id);
        $this->db->where('tickets.ticket_date',$date);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function delete_tickets($id)
    {

        $this->db->where('id',$id);
        $this->db->delete('tickets');
        return true;
    }

    public function updateTickets($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('tickets', array(
            'customer_id'           => $customer_id,
            'business_name'         => $business_name,
            'service_location'      => $service_location,
            'acs_city'              => $acs_city,
            'acs_state'             => $acs_state,
            'acs_zip'               => $acs_zip,
            'service_description'   => $service_description,
            'job_tag'               => $job_tag,
            'ticket_no'             => $ticket_no,
            'ticket_date'           => $ticket_date,
            'job_description'       => $job_description,
            'scheduled_time'        => $scheduled_time,
            'scheduled_time_to'     => $scheduled_time_to,
            'technicians'           => $technicians,
            'purchase_order_no'     => $purchase_order_no,
            'ticket_status'         => $ticket_status,
            'panel_type'            => $panel_type,
            'service_type'          => $service_type,
            'warranty_type'         => $warranty_type,
            'customer_phone'        => $customer_phone,
            'employee_id'           => $employee_id,
            'subtotal'              => $subtotal,
            'taxes'                 => $taxes,
            'adjustment'            => $adjustment,
            'adjustment_value'      => $adjustment_value, 
            'markup'                => $markup,
            'grandtotal'            => $grandtotal,
            'payment_method'        => $payment_method,
            'payment_amount'        => $payment_amount,
            'billing_date'          => $billing_date,
            'sales_rep'             => $sales_rep,
            'sales_rep_no'          => $sales_rep_no,
            'tl_mentor'             => $tl_mentor,
            'message'               => $message,
            'terms_conditions'      => $terms_conditions,
            'attachments'           => $attachments,
            'instructions'          => $instructions,
        ));

        return true;
    }

    public function updateTicketsHash_ID($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('tickets', array(
            'hash_id'           => $hash_id,
        ));

        return true;
    }

    public function update_cash($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'is_collected'          => $is_collected,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_check($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'check_number'          => $check_number,
            'routing_number'        => $routing_number,
            'account_number'        => $account_number,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_creditCard($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'credit_number'         => $credit_number,
            'credit_expiry'         => $credit_expiry,
            'credit_cvc'            => $credit_cvc,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_debitCard($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'credit_number'         => $credit_number,
            'credit_expiry'         => $credit_expiry,
            'credit_cvc'            => $credit_cvc,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_ACH($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'routing_number'        => $credit_number,
            'account_number'        => $credit_expiry,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Venmo($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'confirmation'          => $confirmation,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Paypal($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'confirmation'          => $confirmation,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Square($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'confirmation'          => $confirmation,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Warranty($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Home($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Transfer($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Professor($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'credit_number'         => $credit_number,
            'credit_expiry'         => $credit_expiry,
            'credit_cvc'            => $credit_cvc,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Other($data)
    {
        extract($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tickets_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    
    public function delete_items($id)
    {
        $where = array(
            // 'type' => 'Work Order Alarm',
            'ticket_id'   => $id
          );

        $this->db->where($where);
        $this->db->delete('tickets_items');
        return true;
    }
}

?>