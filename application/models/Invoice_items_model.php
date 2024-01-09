<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_items_model extends MY_Model
{
    public $table = 'invoices_items';

    public function getAllByInvoiceId($invoice_id)
    {        

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('invoice_id', $invoice_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function cloneData($data){
        unset($data->id);
        $this->db->insert($this->table,$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

}

/* End of file Invoice_model.php */
/* Location: ./application/models/invoice_model.php */
