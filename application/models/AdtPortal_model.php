<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdtPortal_model extends MY_Model
{    
    public $adt_portal_user_table = 'portal_user';
    public $adt_portal_project_table = 'portal_project';

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

    public function updateUserByUserId($user_id, $data)
    {
        $this->adtportalDb->from($this->adt_portal_user_table);
        $this->adtportalDb->set($data);
        $this->adtportalDb->where('user_id', $user_id);
        $this->adtportalDb->update();
    }

    public function getProjectsByUserId($user_id, $filter=array())
    {
        $this->adtportalDb->select('*');
        $this->adtportalDb->from($this->adt_portal_project_table);
        $this->adtportalDb->where('user_id', $user_id);
        
        if ( !empty($filters['search']) ){
            foreach($filters['search'] as $f){
                $this->adtportalDb->where($f['field'], $f['value']);            
            } 
        }

        $this->adtportalDb->order_by('project_id', 'DESC');

        $query = $this->adtportalDb->get();
        return $query->result();

    }

    public function updateProjectByProjectId($project_id, $data)
    {
        $this->adtportalDb->from($this->adt_portal_project_table);
        $this->adtportalDb->set($data);
        $this->adtportalDb->where('project_id', $project_id);
        $this->adtportalDb->update();
    }
}

/* End of file AdtPortal_model.php */
/* Location: ./application/models/AdtPortal_model.php */
