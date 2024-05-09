<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chatbot_model extends MY_Model
{
    public function fetchPreference($company_id)
    {
        $this->db->select('id, company_id, chatbot_name, color, image, main_menu created_at, updated_at');
        $this->db->from('chatbot_settings');
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function setPreference($data)
    {
        $this->db->select('COUNT(*) AS preference');
        $this->db->from('chatbot_settings');
        $this->db->where('company_id', $data['company_id']);
        $countData = $this->db->get();
        $total = $countData->result();
        if ($total > 0) { 
            $this->db->where('company_id', $data['company_id']);
            $this->db->update('chatbot_settings', $data);
            return $this->db->affected_rows() > 0;
        } else {
            $create_room = $this->db->insert('chatbot_settings', $data);
            return $this->db->insert_id();
        }
    }

    public function fetchAllPreset($data)
    {
        $this->db->select('title, response');
        $this->db->from('chatbot_preset');
        $this->db->where('company_id', $data['company_id']);
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchPreset($data)
    {
        $this->db->select('id, company_id, title, response, created_at, updated_at');
        $this->db->from('chatbot_preset');
        $this->db->where('id', $data['id']);
        $this->db->where('company_id', $data['company_id']);
        $query = $this->db->get();
        return $query->result();
    }

    public function createPreset($data)
    {
        $this->db->insert('chatbot_preset', $data);
        return $this->db->insert_id();
    }

    public function updatePreset($data, $id, $company_id)
    {
        $this->db->where('id', $id);
        $this->db->where('company_id', $company_id);
        $this->db->update('chatbot_preset', $data);
        return $this->db->affected_rows() > 0;
    }

    public function deletePreset($id)
    {   
        $this->db->where('id', $id);
        $this->db->delete('chatbot_preset');
        return $this->db->affected_rows() > 0;
    }
    
}