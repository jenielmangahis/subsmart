<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanySubscriptionPayments_model extends MY_Model
{
    public $table = 'company_subscription_payments';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        
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

    public function getCompanyLastPayment($company_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get()->row();
        return $query;
    }

    public function getCompanyFirstPayment($company_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByClientIdAndNsmartUpgradeId($client_id, $upgrade_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('client_id', $client_id);
        $this->db->where('plan_upgrade_id', $upgrade_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByClientId($client_id)
    {
        $this->db->select('subscriber_nsmart_upgrades.*,plan_upgrades.name, plan_upgrades.description, plan_upgrades.service_fee');
        $this->db->from($this->table);
        $this->db->join('plan_upgrades', 'subscriber_nsmart_upgrades.plan_upgrade_id = plan_upgrades.id', 'left');
        $this->db->where('subscriber_nsmart_upgrades.client_id', $client_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteClientPlanUpgradeId($client_id, $plan_upgrade_id){
        $this->db->delete($this->table, array('client_id' => $client_id, 'plan_upgrade_id' => $plan_upgrade_id));
    } 

}

/* End of file CompanySubscriptionPayments_model.php */
/* Location: ./application/models/CompanySubscriptionPayments_model.php */
