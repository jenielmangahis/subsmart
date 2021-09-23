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
        $company_id = logged('company_id');
        $post       = $this->input->post();
        $isValid = $this->check_cc($post['card_number']);
        if( $isValid ){
        	$data = [
				'company_id' => $company_id,
		        'card_owner_first_name' => $post['card_owner_first_name'],
		        'card_owner_last_name' => $post['card_owner_last_name'],
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

	public function update_card(){
        $company_id = logged('company_id');
        $post       = $this->input->post();
        $company_id = logged('company_id');
		$cardFile = $this->CardsFile_model->getById($post['cid']);
		if( $cardFile->company_id == $company_id ){			
			$isValid = $this->check_cc($post['card_number']);
	        if( $isValid ){
	        	$cc_exp_date = $post['expiration_month'] . date("y",strtotime($post['expiration_year'] . "-01-01"));
	        	$data_cc = [
		            'card_number' => $post['card_number'],
		            'exp_date' => $cc_exp_date,
		            'cvc' => $post['card_cvv'],
		            'ssl_amount' => 0,
		            'ssl_first_name' => $post['card_owner_first_name'],
		            'ssl_last_name' => $post['card_owner_last_name']
		        ];
		        $is_valid = $this->converge_check_cc_details_valid($data_cc);
		        if( $is_valid['is_success'] > 0 ){
		        	$data = [
				        'card_owner_first_name' => $post['card_owner_first_name'],
				        'card_owner_last_name' => $post['card_owner_last_name'],
						'card_number' => $post['card_number'],
						'expiration_month' => $post['expiration_month'],
						'expiration_year' => $post['expiration_year'],
						'card_cvv' => $post['card_cvv'],
						'cc_type' => $isValid,
						'modified' => date("Y-m-d H:i:s")
					];

					$this->CardsFile_model->updateCardsFile($post['cid'], $data);
					$this->session->set_flashdata('message', 'Card details was successfully updated');
					$this->session->set_flashdata('alert_class', 'alert-success');

					redirect('cards_file/list');
		        }else{		        	
		        	$this->session->set_flashdata('message', 'Invalid credit card details');
					$this->session->set_flashdata('alert_class', 'alert-danger');
					redirect('cards_file/edit/' . $post['cid']);
		        }

	        	
	        }else{
	        	$this->session->set_flashdata('message', $is_valid['msg']);
				$this->session->set_flashdata('alert_class', 'alert-danger');
				redirect('cards_file/edit/' . $post['cid']);
	        }	
		}else{
			$this->session->set_flashdata('message', 'Cannot find record.');
			$this->session->set_flashdata('alert_class', 'alert-danger');
			redirect('cards_file/list');
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
	        "diners" =>  "(^3(?:0[0-5]|[68][0-9])[0-9]{4,}$)",
	        "discover" => "(^6(?:011|5[0-9]{2})[0-9]{3,}$)"
	    );
	    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch", "Diners", "Discover");
	    $matches = array();
	    $pattern = "#^(?:".implode("|", $cards).")$#";
	    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
	    if($extra_check && $result > 0){
	        $result = (validatecard($cc))?1:0;
	    }
	    return ($result>0)?$names[sizeof($matches)-2]:false;
	}

	public function validatecard($cardnumber) {
	    $cardnumber=preg_replace("/\D|\s/", "", $cardnumber);  # strip any non-digits
	    $cardlength=strlen($cardnumber);
	    $parity=$cardlength % 2;
	    $sum=0;
	    for ($i=0; $i<$cardlength; $i++) {
	      $digit=$cardnumber[$i];
	      if ($i%2==$parity) $digit=$digit*2;
	      if ($digit>9) $digit=$digit-9;
	      $sum=$sum+$digit;
	    }
	    $valid=($sum%10==0);
	    return $valid;
	}

	public function test_card(){
		$card_number = '6011111111111117';
		$result= $this->check_cc($card_number, false);
		var_dump($result);
		exit;
	}

	public function update_primary_card(){
		$is_success = false;
		$msg = '';

		$company_id = logged('company_id');
		$post = $this->input->post();
		$cardFile = $this->CardsFile_model->getById($post['id']);
		if( $cardFile ){
			if( $cardFile->company_id == $company_id ){
				$today = date("y-m-d");  
                $day   = date("d");                                 
                $expires = date("y-m-d",strtotime($cardFile->expiration_year . "-" . $cardFile->expiration_month . "-" . $day));
                $expired = 'expires';
                if( strtotime($expires) < strtotime($today) ){
                  $msg = "Cannot set as primary card because this payment method is expired.";

                  $this->session->set_flashdata('message', 'Cannot set as primary card because this payment method is expired.');
				  $this->session->set_flashdata('alert_class', 'alert-danger');
                }else{
                	$this->CardsFile_model->companyResetAllprimaryCard($company_id);
					$this->CardsFile_model->updateCardsFile($post['id'], ['is_primary' => $post['primary']]);
					$is_success = true;
                }
			}else{
				$msg = "Invalid action";
				$this->session->set_flashdata('message', 'Cannot find record.');
				$this->session->set_flashdata('alert_class', 'alert-danger');
			}
		}else{
			$this->session->set_flashdata('message', 'Cannot find record.');
			$this->session->set_flashdata('alert_class', 'alert-danger');
		}
		

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
	}

	public function edit_card($id){
		$company_id = logged('company_id');
		$cardFile = $this->CardsFile_model->getById($id);
		if( $cardFile->company_id == $company_id ){
			$this->page_data['cardFile'] = $cardFile;
			$this->load->view('cards_file/edit_card', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find record.');
			$this->session->set_flashdata('alert_class', 'alert-danger');
			redirect('cards_file/list');
		}
	}

	public function delete_card(){
		$is_success = false;
		$msg = 'Cannot find record';

		$post = $this->input->post();
		$company_id = logged('company_id');

		$cardFile = $this->CardsFile_model->getById($post['cid']);
		if( $cardFile ){
			if( $cardFile->company_id == $company_id ){
				$this->CardsFile_model->deleteCard($post['cid']);

				$is_success = true;
				$msg = '';
			} 
		}

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		]; 

		echo json_encode($json_data);
	}

	public function converge_check_cc_details_valid($data){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $msg = '';
        $is_success = 0;

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $verify = $converge->request('ccverify', [
            'ssl_card_number' => $data['card_number'],
            'ssl_exp_date' => $data['exp_date'],
            'ssl_cvv2cvc2' => $data['cvc'],
            'ssl_first_name' => $data['ssl_first_name'],
            'ssl_last_name' => $data['ssl_last_name'],
            'ssl_amount' => $data['ssl_amount']
        ]);
        if( $verify['success'] == 1 ){
            if( $verify['ssl_result_message'] == 'DECLINED' ){
                $is_success = 0;
            }else{
                $is_success = 1;    
            }
            
        }else{
            $msg = $verify['errorMessage'];
        }
        
        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }
}



/* End of file CardsFile.php */

/* Location: ./application/controllers/CardsFile.php */