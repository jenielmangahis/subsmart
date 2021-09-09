<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MailSettings_model extends MY_Model
{
    public $table = 'mail_settings';
   
    public function getSetting()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', 1);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateSentCount($data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', 1);
        $this->db->update();
    }
}

/* End of file MailSendTo_model.php */
/* Location: ./application/models/MailSendTo_model.php */
