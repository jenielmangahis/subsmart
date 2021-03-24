<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Business_model extends MY_Model {



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

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

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
}

/* End of file Business_model.php */

/* Location: ./application/models/Business_model.php */