<?php

class Automation_model extends CI_Model
{
    // Constructor method to initialize the model
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fetch automation by ID
     * 
     * @param int $id - Automation ID
     * @return array - The automation data
     */
    public function getAutomationById($id)
    {
        $query = $this->db->get_where('automations', ['id' => $id]);

        // If a record is found, return it, otherwise return false
        if ($query->num_rows() > 0) {
            return $query->row_array();  // Return a single row as an associative array
        } else {
            return false;  // No record found
        }
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
            return $query->result_array();  // Return all rows as an array of associative arrays
        } else {
            return [];  // No records found
        }
    }

    /**
     * Fetch automations by user ID
     * 
     * @param int $userId - User ID
     * @return array - List of automations for the specified user
     */
    public function getAutomationsByUserId($userId)
    {
        $query = $this->db->get_where('automations', ['user_id' => $userId]);

        // Return the result
        return $query->result_array();
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
        // Query with multiple where conditions
        $query = $this->db->get_where('automations', $params);

        // Return the result
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
