<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Business_model extends MY_Model
{



    public $table = 'business_profile';
    public function __construct()
    {
        parent::__construct();
    }

    public function getByUserId($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getById($id)
    {

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    // Balance Sheet Summary 4
    public function update_clients_name($business_name, $clientId)
    {
        $data = [
            'business_name' => strtoupper($business_name)
        ];

        $this->db->where('id', $clientId); 
        return $this->db->update('clients', $data);
    }

    // Balance Sheet 5
    public function update_business_name($business_name)
    {
        $data = [
            'business_name' => strtoupper($business_name)
        ];

        $this->db->where('company_id', logged('company_id'));
        return $this->db->update('business_profile', $data);
    }

    public function getBySlug($slug)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('profile_slug', $slug);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyProfileImage($company_id)
    {
        $this->db->select('id,business_image');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyCoverPhoto($company_id)
    {
        $this->db->select('id,company_id,business_cover_photo');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAll()
    {
        $this->db->select('business_profile.*');
        $this->db->join('clients', 'business_profile.company_id = clients.id', 'left');
        $this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result();
    }

    public function deleteByCompanyId($company_id)
    {
        $this->db->delete($this->table, array('company_id' => $company_id));
    }

    public function getByCompanyFieldsByCompanyId($company_id, $fields)
    {
        $fields = implode(",", $fields);
        $this->db->select($fields);
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateByCompanyId($cid, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('company_id', $cid);
        $this->db->update();
    }
}

/* End of file Business_model.php */

/* Location: ./application/models/Business_model.php */