<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsOffice_model extends MY_Model
{

    public $table = 'acs_office';

    public function getByProfId($prof_id, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('fk_prof_id', $prof_id);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                $this->db->where($c['field'], $c['value']);
            }
        }

        $query = $this->db->get();

        return $query->row();
    }

    public function updateByProfId($prof_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('fk_prof_id', $prof_id);
        $this->db->update();
    }
}

/* End of file AcsOffice_model.php */
/* Location: ./application/models/AcsOffice_model.php */
