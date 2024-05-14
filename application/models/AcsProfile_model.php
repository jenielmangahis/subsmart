<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AcsProfile_model extends MY_Model
{
    public $table = 'acs_profile';
    public $table2 = 'acs_billing';

    public function getAllByCompanyId($company_id, $conditions = [], $filters = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('first_name !=', '');
        $this->db->where('last_name !=', '');

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                if ($c['field'] != '' && $c['value'] != '') {
                    $this->db->where($c['field'], $c['value']);
                }
            }
        }

        if (!empty($filters)) {
            if ($filters['search'] != '') {
                $this->db->group_start();
                $this->db->like('first_name', $filters['search'], 'both');
                $this->db->or_like('last_name', $filters['search'], 'both');
                $this->db->group_end();
            }
        }

        $this->db->order_by('first_name', 'ASC');

        $query = $this->db->get();

        return $query->result();
    }

    public function getByProfId($prof_id, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                $this->db->where($c['field'], $c['value']);
            }
        }

        $query = $this->db->get();

        return $query->row();
    }

    public function getCustByProfId($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);
        $query = $this->db->get();

        return $query->row();
    }

    public function getCustByComp($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getProfile($prof_id = null, $col = null, $cust = null, $stat = null, $type = null)
    {
        if ($col != null) {
            $selectedColumns = str_replace('acs_billing.', '', $col);
            array_push($selectedColumns, 'prof_id');
            $this->db->select($selectedColumns);
        } else {
            $this->db->select('*');
        }

        $this->db->from($this->table);

        if ($cust != null) {
            $this->db->where_in('prof_id', $cust);
        }

        if ($prof_id != null) {
            $this->db->order_by($prof_id, 'DESC');
        }

        $query = $this->db->get();

        //  if($query && $prof_id != null ){
        //      $res = $query->result();
        //      $idArray = Array();
        //      foreach($res as $resId):
        //          if(in_array($resId->prof_id, $prof_id)){
        //             array_push($idArray, $resId->prof_id);
        //          }
        //      endforeach;
        //      if($col != null){
        //      return $this->test($idArray, $col);
        //      }else{
        //         return $this->test($idArray, null);
        //      }

        // }else{
        return $query->result();
        // }
        //     elseif($prof_id != null && $col == null && ($cust == null && $stat == null)){
        //         $this->db->select('*');
        //         $this->db->from($this->table);
        //         $this->db->where_in('prof_id', $prof_id);

        //         $query = $this->db->get();
        //         return $query->result();

        //     }elseif($prof_id == null && $col != null && ($cust == null && $stat == null)){
        //         $this->db->select($col);
        //         $this->db->from($this->table);

        //         $query = $this->db->get();
        //         return $query->result();

        //     }elseif($prof_id == null && $col == null && $cust != null){
        //         $this->db->select('*');
        //         $this->db->from($this->table);
        //         $this->db->where_in('prof_id', $cust);

        //         $query = $this->db->get();
        //         return $query->result();

        //     }elseif($prof_id == null && $col != null && ($cust != null || $stat != null)){
        //              $this->db->select($col);
        //              $this->db->from($this->table);
        //              if($stat != null && $cust == null){
        //                 $this->db->where_in('status', $stat);
        //             }elseif(empty($stat) && !empty($cust)){
        //                 $this->db->where_in('prof_id', $cust);
        //             }
        //             $this->db->join('acs_billing', 'acs_profile.prof_id = acs_billing.fk_prof_id');
        //              $fl = $this->db->get();
        //              return $fl->result();

        //      }elseif($prof_id != null && $col != null && $cust == null){
        //         $this->db->select($col);
        //         $this->db->from($this->table);
        //         $this->db->where_in('acs_profile.prof_id', $prof_id);
        //         $this->db->join('acs_billing', 'acs_profile.prof_id = acs_billing.fk_prof_id');

        //         $fl = $this->db->get();
        //         return $fl->result();

        // }
        //      else{
        //         $this->db->select('*');
        //         $this->db->from($this->table);

        //         $query = $this->db->get();
        //         return $query->result();
        //     }
    }

    public function test($idArray, $col)
    {
        if (!empty($col)) {
            $this->db->select($col);
            $this->db->from($this->table);
            $this->db->where_in('acs_profile.prof_id', $idArray);
            $this->db->join('acs_billing', 'acs_profile.prof_id = acs_billing.fk_prof_id');

            $fl = $this->db->get();

            return $fl->result();
        } else {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where_in('acs_profile.prof_id', $idArray);
            $this->db->join('acs_billing', 'acs_profile.prof_id = acs_billing.fk_prof_id');

            $fl = $this->db->get();

            return $fl->result();
            // return $message;
        }
    }

    // Return acs_profile group by
    public function getProfileGb($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where_in('prof_id', $prof_id);

        $query = $this->db->get();

        return $query->result();
    }
    // Return acs_profile fields

    public function getByProfIdajax($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();

        return $query->row();
    }

    public function getByProfile($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();

        return $query->row();
    }

    public function getAll($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('first_name', 'ASC');

        $query = $this->db->get();
        if ($limit > 0) {
            $this->db->limit($limit);
        }

        return $query->result();
    }

    public function getdataAjax($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();

        return $query->row();
    }

    public function getCustomer()
    {
        $this->db->select('DISTINCT(last_name), first_name, prof_id');
        $this->db->from($this->table);
        // $this->db->group_by('last_name');

        $query = $this->db->get();

        return $query->result();
    }

    public function getCustomerType()
    {
        $this->db->select('DISTINCT(customer_type)');
        $this->db->from($this->table);

        $query = $this->db->get();

        return $query->result();
    }

    public function getStatus()
    {
        $this->db->select('DISTINCT(status)');
        $this->db->from($this->table);

        $query = $this->db->get();

        return $query->result();
    }

    public function getByAdtSalesProjectId($adt_project_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('adt_sales_project_id', $adt_project_id);

        $query = $this->db->get();

        return $query->row();
    }

    // public function getCustomerMMR($id){
    //     $this->db->select('acs_billing.mmr, acs_profile.prof_id, acs_billing.bill_start_date');
    //     $this->db->from('acs_billing');
    //     $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
    //     $this->db->where('acs_profile.company_id', $id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function getCustomerMMR($id)
    {
        $this->db->select('acs_billing.mmr, acs_profile.prof_id, acs_billing.bill_start_date, acs_office.install_date');
        $this->db->from('acs_billing');
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
        $this->db->join('acs_office', 'acs_billing.fk_prof_id = acs_office.fk_prof_id');
        $this->db->where('acs_profile.company_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getSubscription($id)
    {
        $current_date = date('Y-m-d');
        $this->db->select('acs_billing.mmr, acs_profile.prof_id, acs_billing.bill_start_date, acs_billing.bill_end_date');
        $this->db->from('acs_billing');
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
        $this->db->join('acs_alarm', 'acs_billing.fk_prof_id = acs_alarm.fk_prof_id');
        $this->db->where('acs_profile.company_id', $id);
        $this->db->where('acs_profile.status', 'Installed');
        $this->db->where('STR_TO_DATE(acs_billing.bill_end_date, "%m/%d/%Y") >=', date('Y-m-d', strtotime($current_date)));
        $this->db->where('STR_TO_DATE(acs_billing.bill_start_date, "%m/%d/%Y") >=', date('Y-m-d', strtotime('01-01-2000')));
        $query = $this->db->get();

        return $query->result();
    }
    public function getCurrentCompanyOpenInvoices($id){
        $this->db->where('company_id', $id);
        $this->db->where('is_recurring', 0);
        $this->db->where('view_flag', 0);
        $this->db->where('status !=', 'Draft');
        $this->db->where('status !=', 'Paid');
        $this->db->where('status !=', '');
        $query = $this->db->get('invoices');
        return $query->result();
    }

    public function getCurrentCompanyOverdue($id)
    {
        $this->db->from('invoices');
        $this->db->select('
            invoices.id,
            invoices.invoice_number,
            invoices.due_date,
            invoices.status,
            acs_profile.email AS customer_email,
            acs_profile.first_name, 
            acs_profile.last_name,
            acs_profile.fk_user_id as user_id,
            invoices.grand_total,
            invoices.grand_total - COALESCE(SUM(accounting_receive_payment_invoices.payment_amount), 0) as balance
        ');
        $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.company_id', $id);
        $this->db->where('invoices.grand_total >', 0);
        $this->db->where('invoices.status !=', 'Draft');
        $this->db->where('invoices.status !=', 'Paid');
        $this->db->where('invoices.due_date !=', null);
        $current_date = date('Y-m-d');
        $this->db->where('invoices.due_date <', $current_date);
        $this->db->where('invoices.view_flag', 0);
        $this->db->group_by('invoices.id');
        $this->db->order_by("STR_TO_DATE(invoices.due_date, '%Y-%m-%d') ASC");
        $query = $this->db->get();

        return $results = $query->result();
    }

    public function getSubscriptionFilter($id, $date_from, $date_to)
    {
        $this->db->select('acs_billing.mmr, acs_profile.prof_id, acs_billing.bill_start_date, acs_billing.bill_end_date');
        $this->db->from('acs_billing');
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
        $this->db->join('acs_alarm', 'acs_billing.fk_prof_id = acs_alarm.fk_prof_id');
        $this->db->where('acs_profile.status', 'Installed');
        $this->db->where('acs_profile.company_id', $id);
        $this->db->where('STR_TO_DATE(acs_billing.bill_start_date, "%m/%d/%Y") >=', date('Y-m-d', strtotime($date_from)));
        $this->db->where('STR_TO_DATE(acs_billing.bill_end_date, "%m/%d/%Y") >=', date('Y-m-d', strtotime($date_to)));
        $query = $this->db->get();

        return $query->result();
    }

    public function getInstalledDate($id, $table)
    {
        $this->db->select('install_date');
        $this->db->from($table);
        $this->db->where('fk_prof_id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function updateByAdtSalesProjectId($adt_sales_project_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('adt_sales_project_id', $adt_sales_project_id);
        $this->db->update();
    }

    public function updateCustomerByProfId($prof_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('prof_id', $prof_id);
        $this->db->update();
    }

    public function getAllByIsSync($is_sync = 0, $conditions = [], $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_sync', $is_sync);
        $this->db->order_by('first_name', 'ASC');

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                $this->db->where($c['field'], $c['value']);
            }
        }

        $query = $this->db->get();
        if ($limit > 0) {
            $this->db->limit($limit);
        }

        return $query->result();
    }
    // get Acs_profile with paramaeters

    public function getProfileWithParam($params)
    {
        if (array_key_exists('table', $params) && $params['table'] != null) {
            $this->db->from($params['table']);
        } else {
            return false;
        }
        if (array_key_exists('select', $params) && $params['select'] != null) {
            $this->db->select($params['select']);
        } else {
            $this->db->select('*');
        }
        if (array_key_exists('where', $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        if (array_key_exists('join', $params)) {
            foreach ($params['join'] as $key => $val) {
                if ($val != '') {
                    $this->db->join($key, $val, 'left');
                }
            }
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function getCustomerBasicInfoByProfIdAndCompanyId($prof_id, $company_id)
    {
        $this->db->select('prof_id,email,mail_add,city,state,zip_code,phone_m,phone_h,business_name,first_name,middle_name,last_name');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();

        return $query->row();
    }

    public function getCustomerBasicInfoByCompanyId($company_id)
    {
        $this->db->select('prof_id,email,mail_add,city,state,zip_code,phone_m,phone_h,business_name,first_name,middle_name,last_name');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_customers_with_open_estimates($companyId)
    {
        $this->db->select('acs_profile.*');
        $this->db->where('acs_profile.company_id', $companyId);
        $this->db->where_not_in('estimates.status', ['Draft', 'Invoiced', 'Lost', 'Declined By Customer']);
        $this->db->where('estimates.view_flag', 0);
        $this->db->group_by('acs_profile.prof_id');
        $this->db->join('estimates', 'estimates.customer_id = acs_profile.prof_id');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_customers_with_unbilled_activities($companyId)
    {
        $this->db->select('acs_profile.*');
        $this->db->where('acs_profile.company_id', $companyId);
        $this->db->where('accounting_delayed_credit.status', 1);
        $this->db->where('accounting_delayed_credit.remaining_balance >', 0);
        $this->db->where('accounting_delayed_charge.status', 1);
        $this->db->where('accounting_delayed_charge.remaining_balance >', 0);
        $this->db->group_by('acs_profile.prof_id');
        $this->db->join('accounting_delayed_credit', 'accounting_delayed_credit.customer_id = acs_profile.prof_id');
        $this->db->join('accounting_delayed_charge', 'accounting_delayed_charge.customer_id = acs_profile.prof_id');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_customers_with_overdue_invoices($companyId)
    {
        $this->db->where('acs_profile.company_id', $companyId);
        $this->db->where('invoices.due_date <=', date('Y-m-d'));
        $this->db->where_not_in('invoices.status', ['Draft', 'Declined', 'Paid']);
        $this->db->where('invoices.view_flag', 0);
        $this->db->group_by('acs_profile.prof_id');
        $this->db->join('invoices', 'invoices.customer_id = acs_profile.prof_id');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_customers_with_open_invoices($companyId)
    {
        $this->db->where('acs_profile.company_id', $companyId);
        $this->db->where_not_in('invoices.status', ['Draft', 'Declined', 'Paid']);
        $this->db->where('invoices.view_flag', 0);
        $this->db->group_by('acs_profile.prof_id');
        $this->db->join('invoices', 'invoices.customer_id = acs_profile.prof_id');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_customers_with_payments($filters)
    {
        $this->db->where('acs_profile.company_id', $filters['company_id']);
        if (isset($filters['start-date'])) {
            $this->db->where('payment_records.payment_date >=', $filters['start-date']);
        }
        $this->db->group_by('acs_profile.prof_id');
        $this->db->join('payment_records', 'payment_records.customer_id = acs_profile.prof_id');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_last_id()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('prof_id', 'DESC');

        $query = $this->db->get()->row();

        return $query;
    }

    // This method needs is_checked field.
    // Only used in correcting customer records
    public function getAllNotChecked($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_checked', 0);

        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function getAllRecentCustomerByCompanyId($company_id, $limit = 10)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('first_name !=', '');
        $this->db->order_by('prof_id', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();

        return $query->result();
    }

    public function getAllCustomerByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('first_name !=', '');
        $this->db->order_by('prof_id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllRecentCustomerByCompanyId2($company_id, $limit = 10)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('first_name !=', '');
        $this->db->where('WEEK(created_at) = WEEK(CURDATE())');
        $this->db->order_by('prof_id', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();

        return $query->result();
    }

    public function update_customer_status($prof_id)
    {
        $this->db->where('prof_id', $prof_id);
        $this->db->from($this->table);
        $cust = $this->db->update($this->table, ['status' => 'Inactive']);

        return $cust;
    }

    public function getAllBilling($conditions = array(), $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table2);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                $this->db->where($c['field'], $c['value']);
            }
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function updateBillingByBillId($bill_id, $data)
    {
        $this->db->from($this->table2);
        $this->db->set($data);
        $this->db->where('bill_id', $bill_id);
        $this->db->update();
    }

    public function getCompanyTotalSubscriptions($cid, $date_range = [])
    {
        $this->db->select('acs_billing.bill_id, COALESCE(SUM(acs_billing.mmr),0) AS total_subscription');
        $this->db->from($this->table2);
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $cid);

        if (!empty($date_range)) {
            $this->db->where('acs_billing.bill_end_date >=', $date_range['from']);
            $this->db->where('acs_billing.bill_end_date <=', $date_range['to']);
        }

        $query = $this->db->get()->row();

        return $query;
    }

    public function getCompanyTotalActiveSubscriptions($cid, $date_range = [])
    {
        $this->db->select('COUNT(acs_billing.bill_id) AS total_active_subscriptions');
        $this->db->from($this->table2);
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $cid);

        if (!empty($date_range)) {
            $this->db->where('acs_billing.bill_end_date >=', $date_range['from']);
            $this->db->where('acs_billing.bill_end_date <=', $date_range['to']);
        } else {
            $date = date('m/d/Y');
            $this->db->where('acs_billing.bill_end_date <=', $date);
        }

        $query = $this->db->get()->row();

        return $query;
    }

    public function getCompanyTotalAmountActiveRecurringPayment($cid, $date_range = [])
    {
        $this->db->select('COALESCE(SUM(acs_billing.mmr),0)AS total_amount');
        $this->db->from($this->table2);
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $cid);

        if (!empty($date_range)) {
            $this->db->where('acs_billing.bill_end_date >=', $date_range['from']);
            $this->db->where('acs_billing.bill_end_date <=', $date_range['to']);
        } else {
            $date = date('m/d/Y');
            $this->db->where('acs_billing.bill_end_date <=', $date);
        }

        $query = $this->db->get()->row();

        return $query;
    }

    public function getCompanyActiveSubscriptionWillExpireIn30Days($cid)
    {
        $today = date('m/d/Y');
        $_30_days = date('m/d/Y', strtotime('+30 days'));

        $this->db->select('*');
        $this->db->from($this->table2);
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $cid);
        $this->db->where('acs_billing.bill_end_date >=', $today);
        $this->db->where('acs_billing.bill_end_date <=', $_30_days);

        $query = $this->db->get();

        return $query->result();
    }
}

/* End of file AcsProfile_model.php */
/* Location: ./application/models/AcsProfile_model.php */
