<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Autocomplete extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
    }

    public function company_users()
    {
        $this->load->model('Users_model');

        $search = $this->input->get('q');
        $filter = ['search' => $search];
        $cid    = logged('company_id');
        $users  = $this->Users_model->getCompanyUsers($cid, $filter);  
        foreach($users as $u){
            $default_imp_img = userProfileImage($u->id);
            $u->user_image   = $default_imp_img;
        }
        die(json_encode($users));   
    }

    public function company_customers()
    {
        $this->load->model('AcsProfile_model');

        $search = $this->input->get('q');
        $filter = ['search' => $search];
        $cid    = logged('company_id');
        $customers = $this->AcsProfile_model->getAllByCompanyId($cid, array(), $filter);  
        
        foreach($customers as $c){            
            $c->id   = $c->prof_id;
        }

        die(json_encode($customers));   
    }

    public function company_event_tags()
    {
        $this->load->model('EventTags_model');

        $search = $this->input->get('q');
        $filter = ['search' => $search];
        $cid    = logged('company_id');
        $tags = $this->EventTags_model->getAllByCompanyId($cid, $filter);  
        
        foreach($tags as $tag){        
            if( $tag->marker_icon != '' ){
                if($tag->is_marker_icon_default_list == 1){
                    $marker = base_url("uploads/icons/" . $tag->marker_icon);
                }else{
                    $marker = base_url("uploads/event_tags/" . $tag->company_id . "/" . $tag->marker_icon);
                }
            }else{
                $marker = base_url("uploads/event_tags/default_no_image.jpg");
            }         
            $tag->img_marker   = $marker;
        }

        die(json_encode($tags));   
    }
}


/* End of file Autocomplete.php */

/* Location: ./application/controllers/Autocomplete.php */
