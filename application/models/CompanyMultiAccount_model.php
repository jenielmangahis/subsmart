<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyMultiAccount_model extends MY_Model
{

    public $table = 'company_multi_accounts';

    public function getAllByLinkCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('link_company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByParentCompanyIdAndLinkCompanyId($parent_company_id, $link_company_id)
    {
        $this->db->select('company_multi_accounts.*, users.email AS user_email, business_profile.business_name AS company_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_multi_accounts.link_user_id = users.id','left');     
        $this->db->join('business_profile', 'company_multi_accounts.link_company_id = business_profile.company_id','left');   
        $this->db->where('company_multi_accounts.parent_company_id', $parent_company_id);
        $this->db->where('company_multi_accounts.link_company_id', $link_company_id);
        $this->db->order_by('company_multi_accounts.id', 'DESC');

        $query = $this->db->get()->row();
        return $query;
    }

    public function getById($id)
    {
        $this->db->select('company_multi_accounts.*, users.email AS user_email, business_profile.business_name AS company_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_multi_accounts.link_user_id = users.id','left');     
        $this->db->join('business_profile', 'company_multi_accounts.link_company_id = business_profile.company_id','left');   
        $this->db->where('company_multi_accounts.id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByParentCompanyIdAndHashId($parent_company_id, $hash_id)
    {
        $this->db->select('company_multi_accounts.*, users.email AS user_email, business_profile.business_name AS company_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_multi_accounts.link_user_id = users.id','left');     
        $this->db->join('business_profile', 'company_multi_accounts.link_company_id = business_profile.company_id','left');   
        $this->db->where('company_multi_accounts.parent_company_id', $parent_company_id);
        $this->db->where('company_multi_accounts.hash_id', $hash_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByParentCompanyIdAndLinkUserId($parent_id, $user_id)
    {
        $this->db->select('company_multi_accounts.*, users.email AS user_email, business_profile.business_name AS company_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_multi_accounts.link_user_id = users.id','left');     
        $this->db->join('business_profile', 'company_multi_accounts.link_company_id = business_profile.company_id','left');   
        $this->db->where('company_multi_accounts.parent_company_id', $parent_id);
        $this->db->where('company_multi_accounts.link_user_id', $user_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByIdAndParentCompanyId($id, $company_id)
    {
        $this->db->select('company_multi_accounts.*, users.email AS user_email, business_profile.business_name AS company_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_multi_accounts.link_user_id = users.id','left');     
        $this->db->join('business_profile', 'company_multi_accounts.link_company_id = business_profile.company_id','left');   
        $this->db->where('company_multi_accounts.id', $id);
        $this->db->where('company_multi_accounts.parent_company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByAllByCompanyParentId($company_parent_id, $conditions = array())
    {
        $this->db->select('company_multi_accounts.*, users.email AS user_email, business_profile.business_name AS company_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_multi_accounts.link_user_id = users.id','left');     
        $this->db->join('business_profile', 'company_multi_accounts.link_company_id = business_profile.company_id','left');     
        $this->db->where('company_multi_accounts.parent_company_id', $company_parent_id);

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->order_by('company_multi_accounts.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function apiGetByAllByCompanyParentId($company_parent_id, $conditions = array())
    {
        $this->db->select('company_multi_accounts.*, users.email AS user_email, business_profile_a.business_name AS parent_company_name,  business_profile_b.business_name AS link_company_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_multi_accounts.link_user_id = users.id','left');     
        $this->db->join('business_profile AS business_profile_a', 'company_multi_accounts.parent_company_id = business_profile_a.company_id','left');     
        $this->db->join('business_profile AS business_profile_b', 'company_multi_accounts.link_company_id = business_profile_b.company_id','left');             
        $this->db->where('company_multi_accounts.parent_company_id', $company_parent_id);

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->order_by('company_multi_accounts.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function statusVerified()
    {
        return 'Verified';
    }

    public function statusNotVerified()
    {
        return 'Not Verified';
    }
}

/* End of file CompanyMultiAccount_model.php */
/* Location: ./application/models/CompanyMultiAccount_model.php */
