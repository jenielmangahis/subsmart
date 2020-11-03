<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NsmartUpgrades_model extends MY_Model
{
    public $table = 'plan_upgrades';
    public $status_active   = 1;
    public $status_inactive = 0;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllActive($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->where('status', 1);

        $this->db->order_by('id', 'ASC');

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

    public function getUpgradeStatus()
    {
        $status = [
            $this->status_active => 'Active',
            $this->status_inactive => 'Inactive'
        ];

        return $status;
    }

    public function isUpgradeNameExists($name)
    {
        $is_exists = false;

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('name', $name);

        $query = $this->db->get()->row();
        if( $query ){
            $is_exists = true;
        }

        return $is_exists;
    }

    public function updateUpgrade($upgrade_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $upgrade_id);
        $this->db->update();
    }

    public function deleteUpgrade($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function isActive()
    {
        return $this->status_active;
    }

    public function isInactive()
    {
        return $this->status_inactive;
    }

}

/* End of file NsmartUpgrades_model.php */
/* Location: ./application/models/NsmartUpgrades_model.php */
