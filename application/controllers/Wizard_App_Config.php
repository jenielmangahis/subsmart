<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_App_Config extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('wizard_model');
        $this->load->model('wizard_apps_model');
        $user_id = getLoggedUserID();

        add_css(array(
            'assets/wizard/css/style.css',
            'assets/wizard/css/responsive.css',
            'assets/wizard/css/slick-theme.min.css',
            'assets/wizard/css/slick.min.css',
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/invoice/add.js',
            'assets/js/invoice.js'
        ));
    }

    public function saveGmailSetup() {
        $details = array(
            'wgc_user_id'   => getLoggedUserID(),
            'wgc_to'        => post('sendTo'),
            'wgc_cc'        => post('cc'),
            'wgc_bcc'       => post('bcc'),
            'wgc_from'      => post('from'),
            'wgc_from_name' => post('fromName'),
            'wgc_subject'   => post('subject'),
            'wgc_body'      => post('emailBody'),
            'appfunc_id'   => 0
        );
        
        $result = json_decode($this->wizard_apps_model->saveGmailSetup($details));
        
        if($result->status):
            $arrayReturn = array('status' => true, 'msg' => 'Gmail Setup Successfully Saved', 'app_func_id' => $result->app_func_id);
        else:
            $arrayReturn = array('status' => false, 'msg' => 'Something went Wrong, Please try again later');
        endif;
        
        echo json_encode($arrayReturn);
    }

}

/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */