<?php

class Automation_model extends CI_Model
{
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
    public function getAllAutomations()
    {
        $query = $this->db->get('automations');

        // If records exist, return them, otherwise return an empty array
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Return all rows as an array of associative arrays
        } else {
            return []; // No records found
        }
    }

    /**
     * Save a new automation
     *
     * @param array $automationData - Data for the new automation
     * @return bool - True if the save was successful, otherwise false
     */
    public function saveAutomation($automationData)
    {
        $this->db->insert('automations', $automationData);

        // Check if insertion is successful
        return $this->db->affected_rows() > 0;
    }

    public function getAutomationsByParams($params)
    {
        $this->db->where($params);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('automations');

        return $query->result_array();
    }

    public function updateAutomationsByParams($filters, $id)
    {
        $update = $this->db->update('automations', $filters, ['id' => $id]);

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
}
