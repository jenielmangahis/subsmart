<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mycrm extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'My CRM';

        $this->page_data['page']->menu = '';	
        
        add_css(array(
            'assets/frontend/css/mycrm/main.css',
        ));

	}

	public function index()
	{	

		$this->load->view('mycrm/index', $this->page_data);

    }
    
    public function membership()
	{	

		$this->load->view('mycrm/membership', $this->page_data);

    }
        
    public function payment_methods()
	{	

		$this->load->view('mycrm/payment_method', $this->page_data);

    }
    
    public function orders()
	{	

		$this->load->view('mycrm/order', $this->page_data);

    }
    
    public function payment_balance()
	{	

		$this->load->view('mycrm/payment_balance', $this->page_data);

	}
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */