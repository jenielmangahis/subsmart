<?php

class Automation_Queue_model extends CI_Model
{
    public $table = 'automation_queue';

    // Constructor method to initialize the model
    public function __construct()
    {
        parent::__construct();
    }

    public function saveAutomationQueue($automationQueueData) {
        try {
            $this->db->insert('automation_queue', $automationQueueData);
            $res = $this->db->insert_id(); 
            return ['data' => $res, 'status' => false, 'code' => 1062, 'message' => 'Inserted successfully.'];
        } catch (Exception $e) {
            return ['error' => true, 'message' => $e->getMessage(), 'code' => 500]; 
        }
    }

    /**
     * Fetch all automations
     *
     * @return array - List of all automations queue
     */
    public function getAutomationQueue()
    {
        /*$company_id = logged('company_id');

        $this->db->select('automations.*');
        $this->db->from($this->table);

        $this->db->join('users', 'automations.user_id = users.id', 'left');
        $this->db->where('users.company_id', $company_id);
        $this->db->order_by('automations.created_at', 'DESC');

        return $this->db->get()->result();*/

    }

}
