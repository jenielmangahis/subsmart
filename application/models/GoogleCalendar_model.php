<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GoogleCalendar_model extends MY_Model
{
    public $table = 'google_calendars';
    public $calendar_type_appointment = 'Appointment';
    public $calendar_type_tc_off = 'TC Off';
    public $calendar_type_event = 'Event';


    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyIdAndCalendarType($company_id, $calendar_type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('calendar_type', $calendar_type);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }   

    public function calendarTypeAppointment()
    {
        return $this->calendar_type_appointment;
    }

    public function calendarTypeEvent()
    {
        return $this->calendar_type_event;
    }

    public function calendarTypeTCOff()
    {
        return $this->calendar_type_tc_off;
    }

    public function calendarAppointmentColorID()
    {
        return 24;
    }

    public function calendarEventColorID()
    {
        return 15;
    }

    public function calendarTCOffColorID()
    {
        return 4;
    }
}

/* End of file GoogleCalendar_model.php */
/* Location: ./application/models/GoogleCalendar_model.php */
