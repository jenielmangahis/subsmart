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
            return $res = $this->db->insert_id(); 
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Fetch all automations
     *
     * @return array - List of all automations queue
     */
    public function getActiveAutomationQueue($filters = [])
    {
        $this->db->select('automation_queue.*');
        $this->db->from($this->table);

        if( !empty($filters) ){
            foreach($filters as $key => $value){                       
                $this->db->where($key, $value);
            }
        }        

        $this->db->order_by('automation_queue.created_at', 'DESC');

        $query = $this->db->get();
        return $query->result();

    }

    public function updateAutomationQueue($id, $data)
    {
        $this->db->where('id', $id);
        $update = $this->db->update($this->table, $data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

}
