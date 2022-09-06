<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdtPortal_model extends MY_Model
{    
    public $adt_portal_user_table = 'portal_user';

    function __construct(){
        parent::__construct();
        $this->adtportalDb = $this->load->database('adtportal', TRUE);
    }

    public function getByEmail($email)
    {
        $this->adtportalDb->select('*');
        $this->adtportalDb->from($this->adt_portal_user_table);
        $this->adtportalDb->where('email', $email);
        $this->adtportalDb->order_by('user_id', 'DESC');

        $query = $this->adtportalDb->get()->row();
        return $query;
    }

    public function updateByUserId($user_id, $data)
    {
        $this->adtportalDb->from($this->adt_portal_user_table);
        $this->adtportalDb->set($data);
        $this->adtportalDb->where('user_id', $user_id);
        $this->adtportalDb->update();
    }
}

/* End of file AdtPortal_model.php */
/* Location: ./application/models/AdtPortal_model.php */
