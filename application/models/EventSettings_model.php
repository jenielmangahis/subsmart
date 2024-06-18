<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventSettings_model extends MY_Model
{

    public $table = 'event_settings';

    public function getAllJobSettings()
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function optionsCustomerNotifications()
    {
        $options = [
            'PT0M' => 'No Notification',
            'PT5M' => '5 minutes before',
            'PT15M' => '15 minutes before',
            'PT30M' => '30 minutes before',
            'PT1H' => '1 hour before',
            'PT2H' => '2 hours before',
            'PT4H' => '4 hours before',
            'PT6H' => '6 hours before',
            'PT8H' => '8 hours before',
            'PT12H' => '12 hours before',
            'PT16H' => '16 hours before',
            'P1D' => '1 day before',
            'P2D' => '2 days before',
            'PT0M' => 'On date of event'
        ];

        return $options;
    }
}

/* End of file EventSettings_model.php */
/* Location: ./application/models/EventSettings_model.php */
