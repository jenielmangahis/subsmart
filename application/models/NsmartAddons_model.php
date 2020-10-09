<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NsmartAddons_model extends MY_Model
{
    public $table = 'plan_addons';
    public $status_active   = 1;
    public $status_inactive = 0;

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

    public function getAddonStatus()
    {
        $status = [
            $this->status_active => 'Active',
            $this->status_inactive => 'Inactive'
        ];

        return $status;
    }

    public function isAddonNameExists($name)
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

    public function updateAddon($addon_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $addon_id);
        $this->db->update();
    }

    public function deleteAddon($id){
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

/* End of file NsmartAddons_model.php */
/* Location: ./application/models/NsmartAddons_model.php */
