<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dropbox extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
         
        if(!$this->session->dBoxIsAuthenticate):
            $this->session->set_userdata('dBoxIsAuthenticate', false);
        endif;


        add_header_js(array(
            
        ));
    }

    public function index() {
        if(isset($_REQUEST['authCallBack']) || $this->session->dBoxIsAuthenticate):
            $this->page_data['db_isAuthorized'] = True;
            $dropBoxData = array(
                'dBoxAccesssToken' => get('access_token'),
                'dBoxUID'   => get('uid'),
            );
            $this->session->set_userdata(array('dBoxData' => $dropBoxData, 'dBoxIsAuthenticate' => True));
        else:
            $this->page_data['db_isAuthorized'] = False;
        endif;
        $this->load->view('dropbox/default', $this->page_data);
    }

    public function logout() {
        
        $this->session->unset_userdata('rcData');
        
        $this->session->set_userdata('dBoxIsAuthenticate', false);
    }
    

}
