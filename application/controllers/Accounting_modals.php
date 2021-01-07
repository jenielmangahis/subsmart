<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_modals extends MY_Controller {

    public function __construct() {
        parent::__construct();

        add_css(array(
            'assets/css/accounting/accounting-modal-forms.css'
        ));

        add_footer_js(array(
            'assets/js/accounting/modal-forms.js'
        ));
    }

    public function index($view ="") {
        if ($view) {
            $this->load->view("accounting/". $view);
        }
    }
}