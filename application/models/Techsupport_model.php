<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Techsupport_model extends MY_Model
{
    protected $table = 'techsupport_schedule';

    public function addSchedule($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function updateSchedule($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function deleteSchedule($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function getSchedule($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    public function getAllSchedules($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->get($this->table)->result();
    }

    public function addMessage($data)
    {
        return $this->db->insert('techsupport_chats', $data);
    }

    public function getChatList()
    {
        $sql = "SELECT tsc.*
                FROM techsupport_chats_view tsc
                LEFT JOIN users AS users0 ON users0.id = tsc.client_id
                LEFT JOIN users AS users1 ON users1.id = tsc.tech_id
                WHERE tsc.id = (
                    SELECT MAX(id) 
                    FROM techsupport_chats 
                    WHERE event = tsc.event
                )
                ORDER BY tsc.id DESC";

        $query = $this->db->query($sql);
        return $query->result(); 
    }

    public function getMessages($client_id)
    {
        $this->db->where('client_id', $client_id);
        return $this->db->get('techsupport_chats_view')->result();
    }

    public function getAllMessages($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->get($this->table)->result();
    }
}