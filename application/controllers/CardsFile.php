<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class CardsFile extends MY_Controller {



	public function __construct()
	{
		parent::__construct();

        $this->load->model('CardsFile_model');
        $this->load->model('Users_model');    

        $this->page_data['page']->title = 'Cards File';
        $this->page_data['page']->menu = '';    

        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/plugins/timepicker/bootstrap-timepicker.css',
        ));

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/plugins/timepicker/bootstrap-timepicker.js'
        ));

	}

	public function index()
	{	

		$company_id = logged('company_id');
		$cardsFile  = $this->CardsFile_model->getAllByCompanyId($company_id);

		$this->page_data['cardsFile'] = $cardsFile;
		$this->load->view('cards_file/index', $this->page_data);

	}

	public function add_new_card()
	{	

		$company_id = logged('company_id');

		$this->load->view('cards_file/add_new', $this->page_data);

	}

	public function create_new_card(){
		postAllowed();

        $user_id = logged('id');
        $post    = $this->input->post();

       $data_color_setting = [
			'user_id' => $user_id,
	        'company_id' => logged('company_id'),
			'color_name' => $post['color_name'],
			'color_code' => $post['color_code']
		];

		$colorSetting = $this->ColorSettings_model->create($data_color_setting);
		if( $colorSetting > 0 ){

			$this->session->set_flashdata('message', 'Add new color setting was successful');
			$this->session->set_flashdata('alert_class', 'alert-success');

			redirect('color_settings/index');

		}else{
			$this->session->set_flashdata('message', 'Cannot save data.');
			$this->session->set_flashdata('alert_class', 'alert-danger');

			redirect('color_settings/add_new_color');
		}
	}
}



/* End of file CardsFile.php */

/* Location: ./application/controllers/CardsFile.php */