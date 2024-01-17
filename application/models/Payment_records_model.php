<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_records_model extends MY_Model
{

    public $table = 'payment_records';


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

    public function getAllByCompany($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function getTotalInvoiceAmountByCompanyIdAndDateRange($company_id, $date_range)
    {
        $this->db->select('SUM(invoice_amount)AS total_amount_paid');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('payment_date >=', $date_range['from']);
        $this->db->where('payment_date <=', $date_range['to']);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function getTotalInvoiceAmountByCompanyId($company_id)
    {
        $this->db->select('SUM(invoice_amount)AS total_amount_paid');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByInvoiceId($invoice_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('invoice_id', $invoice_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
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

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }


    public function getinvoice($invoice_settings_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $invoice_settings_id);

        $query = $this->db->get();
        return $query->row();
    }


    public function filterBy($filters = array(), $company_id = 0)
    {

        $this->db->select('*');
        $this->db->from($this->table);

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
                $this->db->or_like('inquiries.contact_name', $filters['search']);
                $this->db->or_like('inquiries.contact_email', $filters['search']);
                $this->db->or_like('inquiries.phone', $filters['search']);
                $this->db->group_end();
            } elseif (!empty($filters['type'])) {

                $this->db->where('invoice_type', $filters['type']);
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

    public function delete_payment_record($data = [])
    {
        $this->db->where('company_id', $data['company_id']);
        $this->db->where('customer_id', $data['customer_id']);
        $this->db->where('invoice_amount', $data['invoice_amount']);
        $this->db->where('payment_date', $data['payment_date']);
        $this->db->where('payment_method', $data['payment_method']);
        $this->db->where('invoice_number', $data['invoice_number']);
        $delete = $this->db->delete('payment_records');
        return $delete;
    }

    public function get_company_payments($filters)
    {
        $this->db->where('company_id', $filters['company_id']);
        if(isset($filters['start-date'])) {
            $this->db->where('payment_date >=', $filters['start-date']);
        }
        $query = $this->db->get('payment_records');
        return $query->result();
    }
}

/* End of file Invoice_model.php */
/* Location: ./application/models/invoice_model.php */
