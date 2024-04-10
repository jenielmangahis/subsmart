<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smartzoom_model extends MY_Model 
{   
    private function generateMeetingCode() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $codeLength = 14;
        $hyphenPositions = [4, 9];
        $meetingCode = '';

        for ($i = 0; $i < $codeLength; $i++) {
            if (in_array($i, $hyphenPositions)) {
                $meetingCode .= '-';
            } else {
                $randomIndex = rand(0, strlen($characters) - 1);
                $meetingCode .= $characters[$randomIndex];
            }
        }
        return $meetingCode;
    }
    
    public function addRoom($data)
    {
        $room = $this->generateMeetingCode();
        $this->db->select('COUNT(*) AS room_count');
        $this->db->from('smart_zoom');
        $this->db->where('smart_zoom.room', $room);
        $this->db->where('smart_zoom.company_id', $data['company_id']);
        $countData = $this->db->get();
        $room_count = $countData->result();
        if ($room_count > 0) { 
            $room = $this->generateMeetingCode(); 
        }
        $data['room'] = $room;
        $create_room = $this->db->insert('smart_zoom', $data);
        return $room;
    }

    public function connectRoom($data)
    {
        $this->db->select('smart_zoom.*, CONCAT(TRIM(users.FName), " ", TRIM(users.LName)) AS host_name, (SELECT CONCAT(TRIM(FName), " ", TRIM(LName)) from users WHERE id = '.$data['user'].' ) AS user_name');
        $this->db->from('smart_zoom');
        $this->db->join('users', 'users.id = smart_zoom.host', 'left');
        $this->db->where('smart_zoom.room', $data['room_id']);
        $countData = $this->db->get();
        $result = $countData->result();
        return $result;
    }

    public function removeRoom($data)
    {
        $this->db->where('room', $data['room_id']);
        $this->db->where('host', $data['host']);
        $this->db->delete('smart_zoom');
        $result = $this->db->affected_rows();
        return $result;
    }

    public function roomLookup($data)
    {
        $this->db->select('smart_zoom.*, CONCAT(TRIM(users.FName), " ", TRIM(users.LName)) AS host_name');
        $this->db->from('smart_zoom');
        $this->db->join('users', 'users.id = smart_zoom.host', 'left');
        $this->db->where('smart_zoom.company_id', $data['company_id']);
        $this->db->where('smart_zoom.host', $data['host']);
        $data = $this->db->get();
        $result = $data->result();
        return $result;
    }
}