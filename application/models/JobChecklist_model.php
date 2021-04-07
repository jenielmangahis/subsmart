<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobChecklist_model extends MY_Model
{
    public $table = 'job_checklists';
    public $items_table = 'job_checklist_items';
    
    public $type_residential = 1;
    public $type_commercial  = 2;
    public $type_both = 3;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllItemsByJobChecklistId($job_checklist_id)
    {

        $this->db->select('*');
        $this->db->from($this->items_table);
        $this->db->where('job_checklist_id', $job_checklist_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByIdAndCompanyId($id, $company_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAttachType()
    {
        $types = [
            $this->type_residential => 'Residential Jobs',
            $this->type_commercial => 'Commercial Jobs',
            $this->type_both => 'Both Residential and Commercial Jobs',
        ];

        return $types;
    }

    public function createJobChecklistItem($data)
    {
        $this->db->insert($this->items_table,$data);
        return $this->db->insert_id(); 
    }

    public function deleteItemById($id){
        $this->db->delete($this->items_table, array('id' => $id));
    }

    public function deleteChecklist($id){
        $this->db->delete($this->table, array('id' => $id));
    }

    public function deleteAllItemsByJobCheklistId($job_checklist_id){
        $this->db->delete($this->items_table, array('job_checklist_id' => $job_checklist_id));
    }

    public function updateChecklistItemById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->items_table, $data);
    }

    public function updateChecklistById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }
}

/* End of file JobChecklist_model.php */
/* Location: ./application/models/JobChecklist_modelO.php */
