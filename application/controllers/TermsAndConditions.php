<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TermsAndConditions extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_builder');
		
		
		$this->page_data['page']->title = 'Terms and Conditions';
		// $this->page_data['page']->menu = 'Builder';
		// $this->load->model('FormsBuilder_model', 'formsbuilder_model');

		add_css(array(
			'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
			'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css',
			'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css',
			'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'
		));

		add_footer_js(array(
			'https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js',
			'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
			'assets/js/formbuilder.js'
		));
    }

    public function view(){
		$this->load->view('terms_and_conditions/view.php', $this->page_data);
    }
    
}
