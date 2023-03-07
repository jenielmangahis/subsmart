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

        if( $this->input->get('mobile') ){
            $filter = ['mobile' => 1];
        }

        $users  = $this->Users_model->getCompanyUsers($cid, $filter); 

        $result = array(); 
        foreach($users as $u){
            $default_imp_img = userProfileImage($u->id);
            $result[] = [
                'id' => $u->id,
                'FName' => $u->FName,
                'LName' => $u->LName,
                'email' => $u->email,
                'user_image' => $default_imp_img
            ];            
        }
        die(json_encode($result));   
    }

    public function company_customers()
    {
        $this->load->model('AcsProfile_model');

        $search = $this->input->get('q');
        $filter = ['search' => $search];
        $cid    = logged('company_id');
        $customers = $this->AcsProfile_model->getAllByCompanyId($cid, array(), $filter);  
        
        if (strlen($c->phone_h) == 32) {
            $phone_m = substr($c->phone_h, 0, 12);
        } else if (strlen($c->phone_h) >= 33) {
            $phone_m = substr($c->phone_h, 20, 32);
        }

        $result = array(); 
        foreach($customers as $c){            
            $c->id   = $c->prof_id;
            if( $c->phone_m == '' ){
                $phone_m = $c->phone_h;
                if ($c->phone_h == '') {
                    $phone_m = 'Not Specified';
                } else if (strlen($c->phone_h) <= 31) {
                    $phone_m = $c->phone_h;
                } else if (strlen($c->phone_h) == 32) {
                    $phone_m = substr($c->phone_h, 0, 12);
                } else if (strlen($c->phone_h) >= 33) {
                    $phone_m = substr($c->phone_h, 20, 32);
                }
            }else{
                $phone_m = $c->phone_m;
            }

            if( $c->email == '' ){
                $email = 'Not Specified';
            }else{
                $email = $c->email;
            }

            
            /*if( $c->mail_add != '' ){
                $address = $c->mail_add . " " . $c->city . ' ' . $c->state . ', ' . $c->zip_code;
            }else{
                $address = 'Not Specified';    
            }*/

            if( $c->city != '' || $c->state != '' || $c->zip_code != '' ){
                $address = $c->mail_add . " " . $c->city . ' ' . $c->state . ', ' . $c->zip_code;
            }else{
                $address = 'Not Specified';    
            }


            $result[] = [
                'id' => $c->prof_id,
                'first_name' => $c->first_name,
                'last_name' => $c->last_name,
                'phone_m' => $phone_m,
                'address' => $address,
                'email' => $email
            ]; 
        }

        die(json_encode($result));   
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

    public function company_job_tags()
    {
        $this->load->model('Job_tags_model');

        $search = $this->input->get('q');
        $filter = ['search' => $search];
        $cid    = logged('company_id');
        $tags = $this->Job_tags_model->getJobTagsByCompany($cid, $filter);  
        
        foreach($tags as $tag){        
            if( $tag->marker_icon != '' ){
                if($tag->is_marker_icon_default_list == 1){
                    $marker = base_url("uploads/icons/" . $tag->marker_icon);
                }else{
                    $marker = base_url("uploads/job_tags/" . $tag->company_id . "/" . $tag->marker_icon);
                }
            }else{
                $marker = base_url("uploads/job_tags/default_no_image.jpg");
            }         
            $tag->img_marker   = $marker;
        }

        die(json_encode($tags));   
    }

    public function company_reasons()
    {
        $this->load->model('CompanyReason_model');

        $search = $this->input->get('q');
        $filter = ['search' => $search];
        $cid    = logged('company_id');
        $reasons = $this->CompanyReason_model->getAllDefaultAndByCompanyId($cid, $filter);   
        $obj = array();      
        foreach( $reasons as $r ){
            $obj[] = ['id' => $r->id, 'text' => $r->reason];
        }
        die(json_encode($obj));   
    }

    public function company_furnishers()
    {
        $this->load->model('Furnisher_model');

        $search = $this->input->get('q');
        $filter = ['search' => $search];
        $cid    = logged('company_id');
        $furnishers = $this->Furnisher_model->getAllByCompanyId($cid, $filter);   
        $obj = array();      
        foreach( $furnishers as $f ){
            $obj[] = ['id' => $f->id, 'text' => $f->name, 'address' => $f->address];
        }
        die(json_encode($obj));   
    }

    public function company_instructions()
    {
        $this->load->model('CompanyDisputeInstruction_model');

        $search = $this->input->get('q');
        $filter = ['search' => $search];
        $cid    = logged('company_id');
        $instructions = $this->CompanyDisputeInstruction_model->getAllDefaultAndByCompanyId($cid, $filter);   
        $obj = array();      
        foreach( $instructions as $i ){
            $obj[] = ['id' => $i->id, 'text' => $i->instructions];
        }
        die(json_encode($obj));   
    }
}


/* End of file Autocomplete.php */

/* Location: ./application/controllers/Autocomplete.php */
