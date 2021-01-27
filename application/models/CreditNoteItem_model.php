<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CreditNoteItem_model extends MY_Model
{

    public $table = 'credit_note_items';


    public function getAllByCreditNoteId($credit_note_id)
    {

        $this->db->select($this->table . '.*,items.id,items.title,items.description');
        $this->db->from($this->table);
        $this->db->join('items', $this->table . '.item_id = items.id', 'LEFT');
        $this->db->where('credit_note_id', $credit_note_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $prof_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function deleteAllByCreditNoteId($credit_note_id)
    {
        $this->db->delete($this->table, array('credit_note_id' => $credit_note_id));
    }
}

/* End of file CreditNoteItem_model.php */
/* Location: ./application/models/CreditNoteItem_model.php */
