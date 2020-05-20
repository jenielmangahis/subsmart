<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estimate_model extends MY_Model
{

    public $table = 'estimates';

    public function getAllByCompany($comp_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $comp_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0)
    {
        $user_id = getLoggedUserID();

        $this->db->select('*');
        $this->db->from($this->table);

        if (!$uid) {
            $this->db->where('user_id', $user_id);
        } else {
            $this->db->where('user_id', $uid);
        }

        if ($type != '' && $type != 'tt') {

            $this->db->where('customer_type', $type);
        }

        if ($status != '' && $status != 'ss') {

            $this->db->where('workorder_status', $status);
        }

        if ($emp_id) {

            $this->db->where("FIND_IN_SET($emp_id, assign_to)");
        }
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }


    public function getEstimate($estimate_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $estimate_id);

        $query = $this->db->get();
        return $query->row();
    }


    /**
     * @param int $company_id
     * @return mixed
     */
    function getStatusWithCount($company_id = 0)
    {

        $this->db->select('id, status, COUNT(id) as total');
        $this->db->from($this->table);


        if (isset($company_id)) {
            $this->db->where('company_id', $company_id);
        } else {

            $this->db->where('user_id', getLoggedUserID());
        }

        $this->db->group_by('id');

        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        return $query->result();

    }

    /**
     * @param array $filters
     * @param int $company_id
     * @return mixed
     */
    public function filterBy($filters = array(), $company_id = 0)
    {

        $this->db->select('estimates.id, estimates.job_name, estimates.estimate_eqpt_cost, estimates.user_id, estimates.estimate_date, estimates.customer_id, estimates.company_id, estimates.status');

//        $this->db->select("*");
        $this->db->from($this->table);

        if (!empty($filters)) {

            if (isset($filters['status'])) {

                // list of estimate status
                $items = get_config_item('estimate_status');

                // if search successful, use the data position as status
                $this->db->where('status', array_search($filters['status'], array_map('strtolower', $items)));

            } elseif (isset($filters['search'])) {

                $this->db->join('customers', "customers.id = estimates.customer_id");
                $this->db->like('customers.contact_name', $filters['search']);
            } elseif (isset($filters['order'])) {

                switch ($filters['order']) {

                    case 'added-desc':
                        $this->db->order_by('created_at', 'DESC');
                        break;

                    case 'added-asc':
                        $this->db->order_by('created_at');
                        break;

                    case 'date-accepted-desc':
                        $this->db->order_by("(CASE status WHEN '" . ESTIMATE_STATUS_ACCEPTED . "' THEN 0 ELSE 1 END), date_issued DESC");
                        break;

                    case 'date-accepted-asc':
                        $this->db->order_by("(CASE status WHEN '" . ESTIMATE_STATUS_ACCEPTED . "' THEN 1 ELSE 0 END), date_issued ASC");
                        break;
                }
            }
        }

        //
        if (isset($company_id)) {
            $this->db->where('estimates.company_id', $company_id);
        } else {

            $this->db->where('estimates.user_id', getLoggedUserID());
        }

        $query = $this->db->get();
        $results = $query->result();
        $estimate_costs = array();

        if (!empty($filters['order'])) {

            if (($filters['order'] === 'amount-asc') || ($filters['order'] === 'amount-desc')) {

                //
                foreach ($results as $result) {

                    $cost = unserialize($result->estimate_eqpt_cost);

                    array_push($estimate_costs, $cost['eqpt_cost']);
                }


                usort($results, function ($a, $b) use ($estimate_costs, $filters) {

                    $sa = unserialize($a->estimate_eqpt_cost);
                    $sb = unserialize($b->estimate_eqpt_cost);

                    $pos_a = array_search($sa['eqpt_cost'], $estimate_costs);
                    $pos_b = array_search($sb['eqpt_cost'], $estimate_costs);

                    if ($filters['order'] === 'amount-asc') {
                        return $pos_b - $pos_a;
                    } else {
                        return $pos_a - $pos_b;
                    }
                });
            }
        }

        return $results;
    }
}

/* End of file Estimate_model.php */
/* Location: ./application/models/Estimate_model.php */
