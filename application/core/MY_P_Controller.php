
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_P_Controller extends CI_Controller {

    public function __construct() {
       parent::__construct();

    // $this->setNewtimezone();

    //date_default_timezone_set( setting('timezone') );

    /* if(!is_logged()){
        redirect('login','refresh');
    } */

    $this->page_data['url'] = (object) [
        'assets' => assets_url()
    ];

    $this->page_data['app'] = (object) [
        'site_title' => setting('company_name')
    ];

    $this->page_data['page'] = (object) [
        'title' => 'Dashboard',
        'menu' => 'dashboard',
        'submenu' => '',
    ];

		
    }
}