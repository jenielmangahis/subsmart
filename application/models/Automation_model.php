<?php

class Automation_model extends CI_Model
{
    public $table = 'automations';

    // Constructor method to initialize the model
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Fetch all automations
     *
     * @return array - List of all automations
     */
    public function getAutomations()
    {
        $company_id = logged('company_id');

        $this->db->select('automations.*');
        $this->db->from($this->table);

        $this->db->join('users', 'automations.user_id = users.id', 'left');
        $this->db->where('users.company_id', $company_id);
        $this->db->order_by('automations.created_at', 'DESC');

        return $this->db->get()->result();

    }

    /**
     * Save a new automation
     *
     * @param array $automationData - Data for the new automation
     * @return bool - True if the save was successful, otherwise false
     */
    public function saveAutomation($automationData)
    {
        $this->db->insert($this->table, $automationData);

        // Check if insertion is successful
        return $this->db->affected_rows() > 0;
    }

    public function getAutomationsByParams($params)
    {
        $this->db->where($params);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result_array();
    }

    public function updateAutomationsByParams($filters, $id)
    {
        $update = $this->db->update($this->table, $filters, ['id' => $id]);

        if ($update) {
            return true;
        }

        return false;
    }

    public function delete_automation($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('automations');
    }

    public function insertQueue($data)
    {
        $this->db->insert('automation_queue', $data);
    }

    public function markEventTriggered($id)
    {
        $this->db->update('automation_queue', ['is_triggered' => 1], ['id' => $id]);
    }

    public function getPendingActions()
    {
        $this->db->where('is_triggered', 0);
        $this->db->where('trigger_time <=', date('Y-m-d H:i:s'));
        return $this->db->get('automation_queue')->result_array();
    }

    public function getExistingQueue($automationId, $targetId)
    {
        $this->db->select('id')
            ->from('automation_queue')
            ->where('automation_id', $automationId)
            ->where('target_id', $targetId);

        $query = $this->db->get();

        return $query->row();
    }

    public function countAutomationsByStatus($user_id)
    {

        // Retrieve all automations for the given user
        // $this->db->where('user_id', $user_id);
        // $query = $this->db->get('automations');
        // $automations = $query->result_array();

        $statusCounts = [];

        $automations = $this->getAutomations();

        // Count automations by their status
        foreach ($automations as $automation) {
            if (isset($automation->status)) {
                $status = $automation->status;
                if (!isset($statusCounts[$status])) {
                    $statusCounts[$status] = 0; // Initialize the counter for this status
                }
                $statusCounts[$status]++;
            }
        }

        return $statusCounts;
    }
}
