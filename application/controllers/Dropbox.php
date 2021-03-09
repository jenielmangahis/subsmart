<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dropbox extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
         
        if(!$this->session->dBoxIsAuthenticated):
            $this->session->set_userdata('dBoxIsAuthenticated', false);
        endif;


        add_header_js(array(
            
        ));
    }
    
    
    public function index() {
        if(isset($_REQUEST['authCallBack']) || $this->session->dBoxIsAuthenticate):
            $this->page_data['db_isAuthorized'] = True;
            $dropBoxData = array(
                'dBoxAuthCode' => get('access_token'),
                'dBoxUID'   => get('uid'),
            );
            $this->session->set_userdata(array('dBoxData' => $dropBoxData, 'dBoxIsAuthenticated' => True));
        else:
            $this->page_data['db_isAuthorized'] = False;
        endif;
        $this->load->view('dropbox/default', $this->page_data);
    }

//    public function index() {
//        
//        if(!$this->session->dBoxIsAuthenticated):
//            if(get('code')):
//                $dropBoxData = array(
//                    'dBoxAuthCode' => get('code'),
//                );
//                $this->session->set_userdata(array('dBoxData' => $dropBoxData, 'dBoxIsAuthenticated' => True));
//            endif;
//        endif;    
//        $this->load->view('dropbox/default', $this->page_data);
//    }

    public function logout() {
        
        $this->session->unset_userdata('dBoxData');
        
        $this->session->set_userdata('dBoxIsAuthenticated', false);
        
        redirect('dropbox');
    }
    

}
