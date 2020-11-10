<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends MY_Controller
{
    public function index(){
        redirect('login');
    }
    public function confirmation(){
        $ticket = $this->input->get('t');
        if ($this->getLinkCode($ticket) == true && $ticket != null){
            $this->load->view('users/timesheet_team_invite');
        }else{
            redirect('login');
        }
    }
    private function getLinkCode($code){
        $qry = $this->db->get_where('timesheet_invite_link',array('invitation_code' => $code));
        if ($qry->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

}