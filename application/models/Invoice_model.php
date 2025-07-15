<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends MY_Model
{
    public $table = 'invoices'; 
    public $table_invoice_payment = 'invoice_payments';


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

    public function add_invoice_details($data)
    {
        $vendor = $this->db->insert('invoices_items', $data);
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

    public function update_invoice_data($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('invoices', array(
            'customer_id'               => $customer_id,
            'job_location'              => $job_location, //
            'job_address'               => $job_address, //
            'job_city'                  => $job_city, //
            'job_state'                 => $job_state, //
            'job_zip'                   => $job_zip, //
            'user_id'                   => $user_id,
            'job_name'                  => $job_name,//
            'invoice_type'              => $invoice_type,//
            'purchase_order'            => $purchase_order,//
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
            'monthly_monitoring'        => $monthly_monitoring,
            'installation_cost'         => $installation_cost,
            'program_setup'             => $program_setup,
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

    public function getAllByCompany($cid, $type = '', $search = array())
    {
        $this->db->select('invoices.*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');        
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'LEFT');        
        $this->db->where('invoices.company_id', $cid);
        if( $type != '' ){
            $this->db->where('is_recurring', $type);
        }        

        if( !empty($search) ){
            $this->db->group_start();
            foreach($search as $s){
                $this->db->or_like($s['field'], $s['value'], 'both');
            }
            $this->db->group_end();
        }

        $this->db->order_by('invoices.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllInvoices($filter = array(), $limit = 0)
    {
        $this->db->select('*');        
        $this->db->from($this->table);

        if( !empty($filter) ){
            foreach($filter as $f){         
                $this->db->where($f['field'], $f['value']);
            }
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('invoices.id', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotVoidedByCompanyId($cid, $search = array())
    {
        $this->db->select('invoices.*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');        
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'LEFT');        
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('invoices.voided', 0);
        

        if( !empty($search) ){
            $this->db->group_start();
            foreach($search as $s){
                $this->db->or_like($s['field'], $s['value'], 'both');
            }
            $this->db->group_end();
        }

        $this->db->order_by('invoices.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllActiveByCompanyId($comp_id, $type, $filter = array())
    {
        $this->db->select('invoices.*, jobs.job_number AS jobnumber, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');        
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'LEFT');        
        $this->db->join('jobs', 'invoices.job_id = jobs.id', 'LEFT');        
        $this->db->where('invoices.company_id', $comp_id);
        $this->db->where('invoices.view_flag', 0);

        if (!empty($filter)) {
            if (isset($filter['q'])) {
                $this->db->like('acs_profile.first_name', $filter['q'], 'both');
                $this->db->like('acs_profile.last_name', $filter['q'], 'both');
            }
        }

        $this->db->order_by('invoices.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0, $filter = array())
    {
        $user_id = getLoggedUserID();

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'DESC');

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


        $query = $this->db->get();
        return $query->result();
    }


    public function getinvoice($invoice_id)
    {
        $this->db->select('invoices.*, acs_profile.first_name, acs_profile.last_name, jobs.job_number, tickets.ticket_no');
        $this->db->from($this->table);       
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id'); 
        $this->db->join('jobs', 'invoices.job_id = jobs.id', 'left'); 
        $this->db->join('tickets', 'invoices.ticket_id = tickets.id', 'left'); 
        $this->db->where('invoices.id', $invoice_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByHashId($hash_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->where('hash_id', $hash_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByTicketId($tid)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->where('ticket_id', $tid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getCompanyDueInvoices($cid)
    {
        $current_date = date("Y-m-d");

        $this->db->select('*');        
        $this->db->from($this->table);   
        $this->db->where('company_id', $cid);
        $this->db->where('view_flag', 0);
        $this->db->where('due_date >=', $current_date);
        $this->db->order_by('invoices.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getCompanyUnpaidInvoices($cid, $date_range = array())
    {
        $this->db->select('*');        
        $this->db->from($this->table);   
        $this->db->where('company_id', $cid);
        $this->db->where('view_flag', 0);
        $this->db->where_in('status', ['Draft', 'Submitted', 'Partially Paid', 'Due', 'Overdue', 'Approved', 'Schedule']);

        if( !empty($date_range) ){
            $this->db->where('date_issued >=', $date_range['from']);
            $this->db->where('date_issued <=', $date_range['to']);
        }
        
        $this->db->order_by('invoices.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getCompanyOpenInvoices($cid, $date_range = [])
    {
        $this->db->select('COUNT(*) AS total');        
        $this->db->from('invoices');   
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);
        if (!empty($date_range['from'])) {
            $date_from = $date_range['from'];
            $date_to= $date_range['to'];
            $this->db->where('DATE(invoices.date_issued) >=', date('Y-m-d', strtotime($date_from)));
            $this->db->where('DATE(invoices.date_issued) <=', date('Y-m-d', strtotime($date_to)));
        }

        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');

        $query = $this->db->get();
        return $query->row();
    }

    public function getCompanyPaidInvoices($cid, $date_range = array())
    {
        $this->db->select('invoices.*');        
        $this->db->from($this->table);   
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('invoices.status', "Paid");
        $this->db->where('invoices.view_flag', 0);
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');

        if( !empty($date_range) ){
            $this->db->where('invoices.date_issued >=', $date_range['from']);
            $this->db->where('invoices.date_issued <=', $date_range['to']);
        }
        
        $this->db->order_by('invoices.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getCompanyTotalAmountUnPaidInvoices($cid, $date_range = array())
    {
        $this->db->select('id, COALESCE(SUM(grand_total),0) AS total_amount');       
        $this->db->from($this->table);   
        $this->db->where('company_id', $cid);
        $this->db->where('view_flag', 0);
        $this->db->where_in('status', ['Draft', 'Unpaid', '', 'Submitted', 'Partially Paid', 'Due', 'Overdue', 'Approved', 'Schedule']);

        if( !empty($date_range) ){
            $this->db->where('date_issued >=', $date_range['from']);
            $this->db->where('date_issued <=', $date_range['to']);
        }

        $query = $this->db->get()->row();
        return $query;
    }

    public function getCompanyTotalAmountUnPaidInvoicesV2($cid, $date_range = array())
    {
        $this->db->select('id, COALESCE(SUM(grand_total),0) AS total_amount');       
        $this->db->from($this->table);   
        $this->db->where('company_id', $cid);
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.view_flag =', 0);

        $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-90 days')));
        $this->db->where('invoices.due_date <=', date('Y-m-d'));      
  
        if( !empty($date_range) ){
            //$this->db->where('date_issued >=', $date_range['from']);
            //$this->db->where('date_issued <=', $date_range['to']);
            $this->db->where('invoices.date_created >=', $date_range['from']);
            $this->db->where('invoices.date_created <=', $date_range['to']);
        }

        $query = $this->db->get()->row();
        return $query;
    }

    public function getUnpaidInvoicesByCompanyIdV2($company_id)
    {
        $this->db->select('invoices.*','payment_records.invoice_amount AS total_amount_paid');
        //$this->db->select('invoices.*','COALESCE(SUM(grand_total),0) AS total_amount_paid');
        $this->db->from($this->table);
        $this->db->join('payment_records', 'payment_records.invoice_id = invoices.id','left');
        $this->db->where('invoices.company_id', $company_id);

        $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-90 days')));
        $this->db->where('invoices.due_date <=', date('Y-m-d'));   

        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.view_flag =', 0);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getCompanyTotalAmountPaidInvoices($cid, $date_range = array())
    {
        $this->db->select('id, COALESCE(SUM(total_due),0) AS total_paid');    
        $this->db->from($this->table);   
        $this->db->where('company_id', $cid);
        $this->db->where('view_flag', 0);
        $this->db->where('status', 'Paid');

        if( !empty($date_range) ){
            $this->db->where('date_issued >=', $date_range['from']);
            $this->db->where('date_issued <=', $date_range['to']);
        }

        $query = $this->db->get()->row();
        return $query;
    }

    public function widgetCompanyTotalAmountPaidInvoices($cid, $date_range = array())
    {
        $this->db->select('invoices.id, COALESCE(SUM(invoices.grand_total),0) AS total_paid');    
        $this->db->from($this->table);   
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.status', 'Paid');
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);

        if( !empty($date_range['from']) ){
            $date_from = $date_range['from'];
            $date_to= $date_range['to'];

            $this->db->where('invoices.date_created >=',date('Y-m-d', strtotime($date_from)));
            $this->db->where('invoices.date_created <=', date('Y-m-d' , strtotime($date_to)));
        }

        $query = $this->db->get()->row();
        return $query;
    }

    public function gerServiceProjectvieIncome($cid)
    {
        $this->db->select('jobs.id AS id,jobs.company_id AS company_id,jobs.job_number AS number,jobs.job_type AS type,jobs.job_description AS description,CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer,jobs.status AS status,jobs.date_issued AS date, job_payments.amount AS total');
        $this->db->from('jobs');
        $this->db->where('jobs.job_type', "Service");
        $this->db->where_in('jobs.status', [
            'Finished',
            'Completed',
        ]);
        $this->db->where('jobs.company_id', $cid);
        $this->db->where('DATE(jobs.date_created) =  CURDATE()');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->join('job_payments', 'job_payments.job_id = jobs.id', 'left');

        $query = $this->db->get()->row();
        return $query;
    }

    public function getInvoiceAmount($cid)
    {
        $this->db->select('SUM(invoices.grand_total) AS total');
        $this->db->from('invoices');
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.company_id', $cid);
        // $this->db->where('DATE(invoices.date_created)', date('Y-m-d'));

        $query = $this->db->get()->row();
        return $query;
    }

    public function getJobsCompleted($cid)
    {
        $today = new DateTime();
        $startDate = $today->format('Y-01-01');
        $endDate = $today->format('Y-12-31');

        $this->db->select('count(*) AS total');
        $this->db->from('jobs_completed_view');
        $this->db->where_in('status', [
            'Finished',
            'Completed',
        ]);
        $this->db->where('date >=', $startDate);
        $this->db->where('date <=', $endDate);
        // $this->db->where('DATE(date)', date('Y'));
        $this->db->where('company_id', $cid);

        $query = $this->db->get()->row();
        return $query;
    }
    
    public function getNewJobs($cid)
    {
        $this->db->select('count(*) AS total');
        $this->db->from('jobs');
        $this->db->where('jobs.status', "Scheduled");
        $this->db->where('jobs.company_id', $cid);
        // $this->db->where('DATE(jobs.date_created)', date('Y-m-d'));
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');

        $query = $this->db->get()->row();
        return $query;
    }

    public function getEarned($cid)
    {
        $this->db->select('SUM(invoices.grand_total) AS total');
        $this->db->from('invoices');
        $this->db->where('invoices.status', "Paid");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('YEAR(invoices.date_created)', date('Y'));

        $query = $this->db->get()->row();
        return $query;
    }

    public function getCollection($cid){
        $this->db->select(' SUM(invoices.grand_total) AS total');
        $this->db->from('invoices');
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-90 days')));
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $data = $this->db->get();
        return $data->row();
    }

    public function getLostAccounts($cid)
    {
        $this->db->select('count(*) AS total');
        $this->db->from('acs_profile');
        $this->db->where('acs_profile.status', "Cancelled");
        $this->db->where('acs_profile.company_id', $cid);
        // $this->db->where('DATE(acs_profile.updated_at)', date('Y-m-d'));
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
 
        $query = $this->db->get()->row();
        return $query;
    }

    public function getCompanyTotalAmountInvoices($cid, $date_range = array())
    {
        $this->db->select('id, COALESCE(SUM(grand_total),0) AS total_amount');    
        $this->db->from($this->table);   
        $this->db->where('company_id', $cid);
        $this->db->where('view_flag', 0);

        if( !empty($date_range) ){
            $this->db->where('date_issued >=', $date_range['from']);
            $this->db->where('date_issued <=', $date_range['to']);
        }

        $query = $this->db->get()->row();
        return $query;
    }

    public function getCompanyTotalAmountInvoicesSales($cid, $date_range = array())
    {
        $this->db->select('id, COALESCE(SUM(invoices.grand_total),0) AS total_amount');    
        $this->db->from($this->table);   
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('invoices.status != ', "Draft");
        $this->db->where('invoices.status != ', "");
        $this->db->where('invoices.view_flag', 0);

        if( !empty($date_range) ){
            $date_from = $date_range['from'] . ' 00:00:00';
            $date_to   = $date_range['to'] . ' 23:59:59';

            $this->db->where('DATE(date_created) >=', date('Y-m-d H:i:s', strtotime($date_from)));
            $this->db->where('DATE(date_created) <=',date('Y-m-d H:i:s', strtotime($date_to)));
        }

        $query = $this->db->get()->row();
        return $query;
    }

    public function getCompanyOverDueInvoices($cid, $date_range = array())
    {
        $this->db->select('COUNT(*) AS total');        
        $this->db->from('invoices');   
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-14 days')));

        if (!empty($date_range['from'])) {
            $date_from = $date_range['from'];
            $date_to= $date_range['to'];
            $this->db->where('invoices.date_issued>=', date('Y-m-d', strtotime($date_from)));
            $this->db->where('invoices.date_issued <=', date('Y-m-d', strtotime($date_to)));
        }

        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');

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

    public function getInvoicesItems($company_id)
    {
        $where = array(
            'invoices.company_id'      => $company_id,
            'invoices.status'      => 'Paid',
          );

        $this->db->select('*, invoices_items.cost as costing');
        $this->db->from('invoices_items');
        $this->db->join('items', 'invoices_items.items_id  = items.id');
        $this->db->join('invoices', 'invoices_items.invoice_id  = invoices.id');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function totalcountOverdue($company_id)
    {
        $where = array(
            'status'        => 'Overdue',
            'company_id'    => $company_id
          );

        $this->db->select('COUNT(*) as totalOverdue');
        $this->db->from('invoices');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function overdue($company_id)
    {
        $where = array(
            'status'        => 'Overdue',
            'company_id'    => $company_id
          );

        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function updateOverDueInv($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('invoices', array('due_date' => $due_date, 'grand_total' => $grand_total));
        return true;
    }

    public function get_invoice_by_invoice_number($invoiceNum, $company_id)
    {
        $this->db->where('invoice_number', $invoiceNum);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get('invoices');
        return $query->row();
    }

    public function get_customer_payments($customerId, $companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('customer_id', $customerId);
        $this->db->order_by('payment_date', 'desc');
        $this->db->group_by('invoice_number');
        $query = $this->db->get('payment_records');
        return $query->result();
    }

    public function get_company_payments($company_id)
    {
        $this->db->select('SUM(invoices.grand_total) AS total');
        $this->db->from('invoices');
        $this->db->where('invoices.status', "Paid");
        $this->db->where('invoices.company_id', $company_id);
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $query = $this->db->get('');
        return $query->row();
    }

    public function get_all_company_payments($company_id)
    {
        $this->db->select('SUM(invoices.grand_total) AS total');
        $this->db->from('invoices');
        $this->db->where('invoices.status', "Paid");
        $this->db->where('invoices.company_id', $company_id);
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_company_payments_graph($company_id)
    {
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->where('invoices.status', "Paid");
        $this->db->where('invoices.company_id', $company_id);
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $query = $this->db->get('');
        return $query->result();
    }

    public function get_income_thumbnail($companyID)
    {
        $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, invoices.job_name AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
        $this->db->from('invoices');
        $this->db->where('invoices.status', "Paid");
        $this->db->where('invoices.company_id', $companyID);
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_company_payments_business_snapshot($company_id)
    {
        $currentYear = date('Y');
		$startDate = "$currentYear-01-01";
		$endDate = "$currentYear-12-31";

        $this->db->where('company_id', $company_id);
        $this->db->order_by('payment_date', 'desc');
        $this->db->where('DATE(payment_date) >=', date('Y-m-d', strtotime($startDate)));
		$this->db->where('DATE(payment_date) <=', date('Y-m-d', strtotime($endDate)));
        $query = $this->db->get('payment_records');
        return $query->result();
    }

    public function get_company_payments_business_snapshot_prev($company_id)
    {
        $previousYear = date('Y') - 1;
		$startDate = "$previousYear-01-01";
		$endDate = "$previousYear-12-31";

        $this->db->where('company_id', $company_id);
        // $this->db->group_by('payment_date');
        $this->db->order_by('payment_date', 'desc');
        $this->db->where('DATE(payment_date) >=', date('Y-m-d', strtotime($startDate)));
		$this->db->where('DATE(payment_date) <=', date('Y-m-d', strtotime($endDate)));
        $query = $this->db->get('payment_records');
        return $query->result();
    }

    public function getPaidInv($company_id)
    {
        $where = array(
            'invoices.company_id'    => $company_id,
            'invoices.status'        => 'Paid',
        );

        // $this->db->select('*');
        $this->db->select('invoices.*, payment_records.payment_date AS payment_date, payment_records.id AS payment_id, payment_records.invoice_tip, payment_records.invoice_amount, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, SUM(payment_records.invoice_amount) AS groupAmount');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id');
        $this->db->join('payment_records', 'invoices.invoice_number = payment_records.invoice_number');
        $this->db->group_by('DATE(payment_records.payment_date)');
        $this->db->from('invoices');
        $this->db->order_by('payment_records.id', "DESC");
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

    public function getByJobId($job_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('job_id', $job_id);

        $query = $this->db->get()->row();
        return $query;
    }  

    public function getTotalInvoiceAmountByCompanyIdAndDateRange($company_id, $date_range)
    {
        $this->db->select('SUM(grand_total)AS total_invoice_amount');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('date_created >=', $date_range['from']);
        $this->db->where('date_created <=', $date_range['to']);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function getTotalInvoiceAmountByCompanyId($company_id)
    {
        $this->db->select('SUM(grand_total) AS total_invoice_amount');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('invoices.view_flag', 0);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function getUnpaidInvoicesByCompanyId($company_id)
    {
        $this->db->select('invoices.*','payment_records.invoice_amount AS total_amount_paid');
        $this->db->from($this->table);
        $this->db->join('payment_records', 'payment_records.invoice_id = invoices.id','left');
        $this->db->where('invoices.company_id', $company_id);
        $this->db->where('invoices.status', 'Unpaid');
        $this->db->where('invoices.view_flag', 0);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getTotalInvoiceAmountByCompanyIdSalesGraph($company_id)
    {
        $this->db->select('invoices.*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('invoices.view_flag', 0);
        
        $query = $this->db->get();
        return $query->result();

    }

    public function getAllData($company_id)
    {
        $this->db->select('invoices.*, users.FName, users.LName, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');
        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'LEFT');
        $this->db->join('users', 'invoices.user_id = users.id', 'LEFT');
        $this->db->where('invoices.company_id', $company_id);
        $this->db->where('invoices.view_flag', 0);
        $this->db->order_by('invoices.id', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyIdAndStatus($company_id, $status)
    {
        $this->db->select('invoices.*, users.FName, users.LName, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');
        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'LEFT');
        $this->db->join('users', 'invoices.user_id = users.id', 'LEFT');
        $this->db->where('invoices.company_id', $company_id);
        $this->db->where('invoices.status', $status);
        $this->db->where('invoices.view_flag', 0);
        $this->db->order_by('invoices.id', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyIdAndDateRange($company_id, $date_range = array(), $filter = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('date_created >=', $date_range['from']);
        $this->db->where('date_created <=', $date_range['to']);
        $this->db->where('view_flag', 0);        
        if( !empty($filter) ){
            $this->db->group_start();
                foreach( $filter as $f ){
                    $this->db->or_like($f['field_name'], $f['field_value'], 'both');
                }
            $this->db->group_end();
        }        
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCustomerId($customer_id, $filter = [])
    {
        $where = array(
            'invoices.customer_id'      => $customer_id,
            'invoices.view_flag'                => '0',
        );

        $this->db->select('invoices.*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');
        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id');
        $this->db->where($where);
    
        if( !empty($filter) ){            
            $this->db->group_start();
                foreach( $filter as $f ){
                    $this->db->where($f['field_name'], $f['field_value'], 'both');
                }
            $this->db->group_end();
        }    

        $this->db->order_by('invoices.id', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCustomerIdAndCompanyId($customer_id, $company_id, $filter = [])
    {
        if($customer_id != 0) {
            $where = array(
                'invoices.customer_id' => $customer_id,
                'invoices.view_flag'   => '0',
            );
        } else {
            $where = array(
                'invoices.view_flag' => '0',
            );
        }

        $this->db->select('invoices.*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');
        $this->db->from('invoices');
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id');
        $this->db->where($where);
    
        if( !empty($filter) ){            
            $this->db->group_start();
                foreach( $filter as $f ){
                    $this->db->where($f['field_name'], $f['field_value'], 'both');
                }
            $this->db->group_end();
        }    

        $this->db->order_by('invoices.id', 'DESC');
        
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
        $this->db->select('invoices.*, jobs.id AS jobid, jobs.job_number AS jobnumber');
        $this->db->from($this->table);
        $this->db->join('jobs', 'invoices.job_id = jobs.id', 'LEFT');      
        $this->db->where('invoices.view_flag', 0);

        if($type != '') {
            $this->db->where('invoices.is_recurring', $type);
        }

        if (!empty($filters)) {
            if (isset($filters['status'])) {
                switch ($filters['status']) {
                    case 'paid':
                        $this->db->where('invoices.status', 'Paid');
                        break;                    
                    case 'draft':
                        $this->db->where('invoices.status', 'Draft');
                        break;
                    case 'partially_paid':
                        $today = date("Y-m-d");
                        $this->db->where('invoices.status', 'Partial Paid');
                        break;
                    case 'due':
                        $this->db->where('invoices.status', 'Due');
                        break;
                    case 'overdue':
                        $this->db->where('invoices.status', 'Overdue');
                        break;
                    case 'unpaid':
                        $this->db->where('invoices.status', 'Unpaid');
                        break;
                    default:
                        $this->db->where('invoices.status', $filters['status']);
                    break;
                }
            } elseif (isset($filters['search'])) {
                $this->db->group_start();
                $this->db->or_like('invoices.invoice_number', $filters['search']);
                $this->db->or_like('jobs.job_number', $filters['search']);
                $this->db->or_like('invoices.job_name', $filters['search']);
                $this->db->or_like('invoices.job_location', $filters['search']);
                $this->db->group_end();
            }
        }

        //
        if (isset($company_id)) {
            $this->db->where('invoices.company_id', $company_id);
        } else {
            $this->db->where('invoices.user_id', getLoggedUserID());
        }

        if (!empty($filters['order'])) {
            switch ($filters['order']) {

                case 'date_created-asc':
                    $this->db->order_by('invoices.date_created', 'asc');
                    break;

                case 'date_created-desc':
                    $this->db->order_by('invoices.date_created', 'desc');
                    break;

                case 'invoice_number-asc':                    
                    $this->db->order_by('invoices.invoice_number', 'asc');
                    break;

                case 'invoice_number-desc':
                    $this->db->order_by('invoices.invoice_number', 'desc');
                    break;

                        
                case 'last-created_at-asc':
                    $this->db->order_by("(SUBSTR(invoices.date_created, INSTR(invoices.created_at, ' ')))", '');
                    break;

                case 'last-created_at-desc':
                    $this->db->order_by("(SUBSTR(invoices.date_created, INSTR(invoices.created_at, ' '))) DESC", '');
                    break;

                case 'email-asc':
                    $this->db->order_by('invoices.contact_email', 'asc');
                    break;

                case 'email-desc':
                    $this->db->order_by('invoices.contact_email', 'desc');
                    break;

                case 'grand_total-asc':
                    $this->db->order_by('invoices.grand_total', 'asc');
                    break;

                case 'grand_total-desc':
                    $this->db->order_by('invoices.grand_total', 'desc');
                    break;
            }
        }else{
            $this->db->order_by('invoices.id', 'DESC');
        }
        
        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        return $query->result();
    }

    public function ac_tax_rates()
    {
        $this->db->select('*');
        $this->db->from('accounting_tax_rates');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function add_invoice_items($data)
    {
        $vendor = $this->db->insert('invoices_items', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function get_invoice_statuses($invoice_id)
    {
        $this->db->select('*');
        $this->db->from('invoice_statuses');
        $this->db->where('invoice_id', $invoice_id);
        $query2 = $this->db->get();
        return $query2->result();
    }
    public function get_last_invoice_status($invoice_id)
    {
        $this->db->select('*');
        $this->db->from('invoice_statuses');
        $this->db->where('invoice_id', $invoice_id);
        $this->db->order_by('date_created', "DESC");
        $query2 = $this->db->get();
        return $query2->row();
    }
    public function getInvoiceItems($id)
    {
        $this->db->select('*, invoices_items.cost as iCost, invoices_items.tax as itax, invoices_items.total as iTotal, items.title, items.type as item_type');
        $this->db->from('invoices_items');
        $this->db->join('items', 'invoices_items.items_id  = items.id');
        $this->db->where('invoice_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getPackageItemsById()
    {
        $this->db->select('*');
        $this->db->from('item_package');
        // $this->db->join('package_details', 'item_package.package_id  = package_details.id');
        $this->db->join('items', 'item_package.item_id  = items.id');
        // $this->db->where('package_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
        // $this->db->select('*');
        // $this->db->from('package_details');
        // $this->db->join('item_package', 'package_details.id  = item_package.package_id');
        // $this->db->join('items', 'item_package.item_id  = items.id');
        // $this->db->where('package_details.company_id', $cid);
        // // $this->db->group_by('package_details.id');
        // $query2 = $this->db->get();
        // return $query2->result();
    }

    public function duplicateRecord($primary_key, $comp_id)
    {
        $this->db->where('id', $primary_key);
        $query = $this->db->get($this->table);
        $invoice = $this->getLastRow($comp_id);
        // foreach ($number as $num):
        $next = $invoice->invoice_number;
        $arr = explode("-", $next);
        $date_start = $arr[0];
        $nextNum = $arr[1];
        //    echo $number;
        // endforeach;
        $val = $nextNum + 1;
        $new_invoice_number = 'INV-'. str_pad($val, 9, "0", STR_PAD_LEFT);
        // $new_invoice_number = explode("-", $invoice->invoice_number)[0] . '-' . strval(intval(explode("-", $invoice->invoice_number)[1]) + 1);

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
    public function get_ranged_PaidInv($company_id, $start_date, $end_date)
    {

        // $this->db->select('*');
        $sql="SELECT * FROM invoices WHERE company_id = $company_id AND due_date >= '$start_date' AND due_date <= '$end_date' AND (status = 'Submitted' OR status = 'Approved' OR status = 'Partially Paid' OR status = 'Paid')";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getAllData2($company_id)
    {
        $where = array(
            'company_id'      => $company_id,
          );

        $this->db->select('date_issued,grand_total');
        $this->db->from('invoices');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }
    public function change_due_invoice_status($date, $status)
    {
        $this->db->select("*");
        $this->db->from("invoices");

        if ($status == "Due") {
            $this->db->where('status !=', 'Due');
            $this->db->where('due_date', $date);
        } else {
            $this->db->where('due_date <', $date);
        }
        $this->db->where('status !=', 'Overdue');
        $this->db->where('status !=', 'Paid');
        $this->db->where('status !=', 'Draft');
        $this->db->where('status !=', 'Declined');
        $this->db->where('status !=', 'Schedule');
        $this->db->where('status !=', 'Submitted');
        $result = $this->db->get();
        $affected_rows = $result->result();
        if ($affected_rows != null) {
            foreach ($affected_rows as $row) {
                $this->db->where('id', $row->id);
                $this->db->update('invoices', array("status"=>$status));
                if ($this->db->affected_rows() > 0) {
                    $new_status_data=array(
                        "invoice_id" => $row->id,
                        "status" => $status,
                        "note" => "Auto"
                    );
                    $this->new_invoice_status($new_status_data);
                }
            }
        }
    }
    public function new_invoice_status($data)
    {
        $this->db->insert('invoice_statuses', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function get_last_invoice_number($company_id, $invoicePrefix)
    {
        $this->db->where('company_id', $company_id);
        $this->db->where('is_recurring !=', 1);
        $this->db->where('invoice_number !=', '');
        $this->db->order_by('date_created', 'desc');
        $query = $this->db->get('invoices');
        $last = $query->row();
        return str_replace($invoicePrefix, '', $last->invoice_number);
    }

    public function get_company_invoices($filters = [])
    {
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('is_recurring', 0);
        $this->db->where('view_flag', 0);
        $this->db->where_not_in('status', ['Draft', 'Submitted', 'Approved', 'Declined']);
        $query = $this->db->get('invoices');
        return $query->result();
    }

    public function get_company_archived_invoices($cid)
    {
        $this->db->where('company_id', $cid);
        $this->db->where('view_flag', 1);
        $this->db->order_by('date_updated', 'DESC');
        $query = $this->db->get('invoices');
        return $query->result();
    }

    public function get_all_company_invoice($companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('is_recurring', 0);
        $this->db->where('view_flag', 0);
        $this->db->where('status !=', 'Draft');
        $this->db->where('status !=', 'Paid');
        $this->db->where('status !=', '');
        $query = $this->db->get('invoices');
        return $query->result();
    }

    
    public function getOpenInvoices($companyId)
    {
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $companyId);
        $query = $this->db->get();
        return $query->result();
    }


    public function get_invoice_items($invoiceId)
    {
        $this->db->where('invoice_id', $invoiceId);
        $query = $this->db->get('invoices_items');
        return $query->result();
    }

    public function get_invoice_item_by_id($id, $invoiceId)
    {
        $this->db->where('id', $id);
        $this->db->where('invoice_id', $invoiceId);
        $query = $this->db->get('invoices_items');
        return $query->row();
    }

    public function update_invoice($invoiceId, $data)
    {
        $this->db->where('id', $invoiceId);
        $update = $this->db->update($this->table, $data);
        return $update ? true : false;
    }

    public function update_invoice_item($invoiceItemId, $data)
    {
        $this->db->where('id', $invoiceItemId);
        $update = $this->db->update('invoices_items', $data);
        return $update ? true : false;
    }

    public function delete_invoice($id)
    {
        $this->db->where('invoice_id', $id);
        $delete_child = $this->db->delete('accounting_tax_adjustments');

        $this->db->where('id', $id);
        $delete = $this->db->delete('invoices');
        return $delete;
    }

    public function get_company_open_invoices($companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where_not_in('status', ['Draft', 'Declined', 'Paid']);
        $this->db->where('view_flag', 0);
        $query = $this->db->get('invoices');
        return $query->result();
    }

    public function get_company_overdue_invoices($companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('due_date <=', date("Y-m-d"));
        $this->db->where_not_in('status', ['Draft', 'Declined', 'Paid']);
        $this->db->where('view_flag', 0);
        $query = $this->db->get('invoices');
        return $query->result();
    }

    public function getLastInsertByCompanyId($company_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->row();
    }

    public function cloneData($data){
        unset($data->id);
        $this->db->insert($this->table,$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function getTotalDueByCompanyIdAndDateRange($cid, $date_range = array()){
        $this->db->select('COALESCE(SUM(total_due),0) as total_amount');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('status !=', 'Draft');
        $this->db->where('view_flag', 0);

        if( $date_range ){
            $this->db->where('date_issued >=', $date_range['from']);
            $this->db->where('date_issued <=', $date_range['to']);
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function defaultLateFee(){
        $late_fee = 50;

        return $late_fee;
    }

    public function createInvoicePayment($data)
    {
        $this->db->insert('invoice_payments', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function getInvoicePaymentByInvoiceId($invoice_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_invoice_payment);   
        $this->db->where('invoice_id', $invoice_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function updateInvoiceDataByInvoiceId($invoice_id, $data)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->update($this->table_invoice_payment, $data);
        return true;
    }

    public function restoreInvoice($id)
    {
        $this->db->where('id', $id);      
        $this->db->update($this->table, array("view_flag" => 0, 'date_updated' => date("Y-m-d H:i:s")));        
    }

    public function getInvoiceByFilter($filter = [])
    {
        if($filter['customer_id']) {
            $this->db->where('customer_id', $filter['customer_id']);
        }
        if($filter['invoice_type']) {
            $this->db->where('invoice_type', $filter['invoice_type']);
        }
        if($filter['total_due']) {
            $this->db->where('total_due', $filter['total_due']);
        }

        $month = date('m');
        $year  = date('Y');

        $this->db->where('MONTH(due_date)',$month);
        $this->db->where('YEAR(due_date)',$year);    
        
        if($filter['due_date']) {
            $this->db->orWhere('due_date', $filter['due_date']);
        }
        
        $query = $this->db->get('invoices');
        return $query->row();
    }    

    public function getRecurringInvoiceByCompanyId($cid, $filter = array())
    {           
        $this->db->select('invoices.*, CONCAT(acs_profile.first_name, " ", acs_profile.last_name)AS customer_name');
        $this->db->from('invoices');
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.is_recurring', 1);
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);

        if( $filter ){
            foreach( $filter as $f ){
                $this->db->where($f['field'], $f['value']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getTotalPaidRecurringInvoiceByCompanyIdV2($cid, $filter = array())
    {           
        $this->db->select('SUM(payment_records.invoice_amount) AS total_amount_paid');
        $this->db->from('invoices');
        $this->db->join('payment_records', 'payment_records.invoice_id = invoices.id','left');
        $this->db->where('invoices.is_recurring', 1);
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('invoices.status', 'Paid');

        if( $filter ){
            foreach( $filter as $f ){
                $this->db->where($f['field'], $f['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getTotalPaidRecurringInvoiceByCompanyId($cid, $filter = array())
    {           
        $this->db->select('COALESCE(SUM(invoices.grand_total),0)AS total_amount');
        $this->db->from('invoices');
        $this->db->where('invoices.is_recurring', 1);
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('invoices.status', 'Paid');

        if( $filter ){
            foreach( $filter as $f ){
                $this->db->where($f['field'], $f['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getTotalRecurringInvoiceByCompanyId($cid, $filter = array())
    {           
        $this->db->select('COALESCE(SUM(invoices.grand_total),0)AS total_amount');
        $this->db->from('invoices');
        $this->db->where('invoices.is_recurring', 1);
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);

        if( $filter ){
            foreach( $filter as $f ){
                $this->db->where($f['field'], $f['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getTotalUnpaidRecurringInvoiceByCompanyId($cid, $filter = array())
    {           
        $this->db->select('COALESCE(SUM(invoices.grand_total),0)AS total_amount');
        $this->db->from('invoices');
        $this->db->where('invoices.is_recurring', 1);
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.company_id', $cid);
        $this->db->where('invoices.status', 'Unpaid');

        if( $filter ){
            foreach( $filter as $f ){
                $this->db->where($f['field'], $f['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getAllActiveInvoice($filter = array(), $is_recurring = 0)
    {
        $this->db->select('invoices.*, jobs.job_number AS jobnumber, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');        
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'LEFT');        
        $this->db->join('jobs', 'invoices.job_id = jobs.id', 'LEFT'); 

        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");

        if($is_recurring == 1) {
            $this->db->where('invoices.is_recurring =', 1);
        }

        $this->db->where('invoices.view_flag', 0);

        //Hide this after debugging
        //$this->db->where_in('invoices.id', [456]); //for testing only    

        if (!empty($filter)) {
            if (isset($filter['q'])) {
                $this->db->like('acs_profile.first_name', $filter['q'], 'both');
                $this->db->like('acs_profile.last_name', $filter['q'], 'both');
            }
        }

        $this->db->order_by('invoices.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getActiveInvoiceByInvoiceNumber($filter = array(), $invoice_number = "")
    {
        $this->db->select('invoices.*, jobs.job_number AS jobnumber, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status');        
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'LEFT');        
        $this->db->join('jobs', 'invoices.job_id = jobs.id', 'LEFT'); 

        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");

        $this->db->where('invoices.view_flag', 0);

        if($invoice_number) {
            $this->db->where('invoices.invoice_number =', $invoice_number); //for testing only    
        }
        
        if (!empty($filter)) {
            if (isset($filter['q'])) {
                $this->db->like('acs_profile.first_name', $filter['q'], 'both');
                $this->db->like('acs_profile.last_name', $filter['q'], 'both');
            }
        }

        $this->db->order_by('invoices.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function generateHashId($invoice_id)
    {
        $CI = get_instance();
        $CI->load->helper('hashids_helper');

        $hash_id = hashids_encrypt($invoice_id, '', 15);
        return $hash_id;
    }
}

/* End of file Invoice_model.php */
/* Location: ./application/models/invoice_model.php */
