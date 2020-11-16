<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WorkorderSettings_model extends MY_Model
{

    public $table = 'work_order_settings';

    public function getByCompanyId($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $id);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file WorkorderSettings_model.php */
/* Location: ./application/models/WorkorderSettings_model.php */