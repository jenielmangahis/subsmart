<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class CardsFile extends MY_Controller {



	public function __construct()
	{
		parent::__construct();

        $this->load->model('CardsFile_model');
        $this->load->model('Users_model');    

        $this->page_data['page']->title = 'Cards File';
        $this->page_data['page']->menu = 'cards_file';    

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

        $company_id = logged('company_id');
        $post       = $this->input->post();
        $isValid = $this->check_cc($post['card_number']);
        if( $isValid ){
        	$data = [
				'company_id' => $company_id,
		        'card_owner_name' => $post['card_owner_name'],
				'card_number' => $post['card_number'],
				'expiration_month' => $post['expiration_month'],
				'expiration_year' => $post['expiration_year'],
				'card_cvv' => $post['card_cvv'],
				'is_primary' => 0,
				'cc_type' => $isValid,
				'created' => date("Y-m-d H:i:s"),
				'modified' => date("Y-m-d H:i:s")
			];

			$cardsFile = $this->CardsFile_model->create($data);
			if( $cardsFile > 0 ){

				$this->session->set_flashdata('message', 'Add new credit card was successful');
				$this->session->set_flashdata('alert_class', 'alert-success');

				redirect('cards_file/list');

			}else{
				$this->session->set_flashdata('message', 'Cannot save data.');
				$this->session->set_flashdata('alert_class', 'alert-danger');

				redirect('cards_file/add_new');
			}
        }else{
        	$this->session->set_flashdata('message', 'Invalid credit card number');
			$this->session->set_flashdata('alert_class', 'alert-danger');

			redirect('cards_file/add_new');
        }
	}

	public function check_cc($cc, $extra_check = false){
	    $cards = array(
	        "visa" => "(4\d{12}(?:\d{3})?)",
	        "amex" => "(3[47]\d{13})",
	        "jcb" => "(35[2-8][89]\d\d\d{10})",
	        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
	        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
	        "mastercard" => "(5[1-5]\d{14})",
	        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
	    );
	    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
	    $matches = array();
	    $pattern = "#^(?:".implode("|", $cards).")$#";
	    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
	    if($extra_check && $result > 0){
	        $result = (validatecard($cc))?1:0;
	    }
	    return ($result>0)?$names[sizeof($matches)-2]:false;
	}

	public function update_primary_card(){
		$company_id = logged('company_id');
		$post = $this->input->post();

		$this->CardsFile_model->companyResetAllprimaryCard($company_id);
		$this->CardsFile_model->updateCardsFile($post['id'], ['is_primary' => 1]);
		exit;
	}
}



/* End of file CardsFile.php */

/* Location: ./application/controllers/CardsFile.php */