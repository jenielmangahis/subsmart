<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FormBuilder extends MY_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('FormsBuilder_model', 'formsbuilder_model');
		// $this->page_data['page']->title = 'Form Builder';
		// $this->page_data['page']->menu = 'Builder';
		// $user_id = getLoggedUserID();

		// if($user_id != 1) { redirect('/'); }
	}

	public function index()
	{	

		$this->page_data['forms'] = $this->formsbuilder_model->getAllForms();
		$this->page_data['selected_id'] = '0';
		$this->load->view('formbuilder/add', $this->page_data);
	}


	public function forms($id)
	{	
		$this->page_data['selected_id'] = $id;
		$this->page_data['forms'] = $this->formsbuilder_model->getAllForms();
		$this->page_data['selected_data'] = $this->formsbuilder_model->getById($id);
		$this->load->view('formbuilder/add', $this->page_data);
	}


	public function demo()
	{
		$this->page_data['form'] = array(
		    'attr' => array(
		        'action' => 'my/action',
		        'class' => 'form-horizontal'
		    ),
		    'id' => array(
		        'type' => 'hidden',
		        'attr' => array('value' => '123456')
		    ),
		    'firstname' => array(
		        'type' => 'input',
		        'required' => TRUE,
		        'label' => 'First Name',
		        'attr' => array('placeholder' => 'Enter your First Name')
		    ),
		    'password' => array(
		        'type' => 'password',
		        'required' => TRUE,
		        'label' => 'Password',
		        'attr' => array('help_text' => 'This is a quick message to ensure you have all the help you need') //hope this is just a placeholder for user created text, cause this isn't going to be useful. 
		    ),
		    'city' => array(
		        'type' => 'select',
		        'label' => 'City',
		        'attr' => array(
		            'value' => 'NC',
		            'help_text' => 'Choose from the list above',
		            'extra' => 'class="test"'
		        ),
		        'options' => array(
		            'AR' => 'Arizona',
		            'CA' => 'California',
		            'NC' => 'North Carolina',
		            'SC' => 'South Carolina',  
		        )   
		    ),
		    'message' => array(
		        'type' => 'textarea',
		        'required' => TRUE,
		        'label' => 'Message',
		        'attr' => array(
		            'rows' => 5,
		            'cols' => 30
		        )
		    ),
		    'favoriteActor' => array(
		        'type' => 'checkbox',
		        'label' => 'Who is your favorite actor',
		        'attr' => array('help_text' => 'This is helpful!'),
		        'options' => array(
		            'adamSandler' => array('label' => 'Adam Sandler'),
		            'jimCarey' => array('label' => 'Jim Carey'),
		            'michaelBluthe' => array('label' => 'Michael Bluthe')
		        )
		    ),
		    'favoriteActorOnce' => array(
		        'type' => 'radio',
		        'label' => 'Who is your favorite actor (Choose One)',
		        'attr' => array('help_text' => 'This is helpful!'),
		        'options' => array(
		            'adamSandler' => array('label' => 'Adam Sandler'),
		            'jimCarey' => array('label' => 'Jim Carey'),
		            'michaelBluthe' => array('label' => 'Michael Bluthe')
		        )
		    ),
		    'actions' => array(
		        'submit' => 'Submit the Form',
		        'reset' => array(
		            'label' => 'Reset',
		            'class' => 'btn-inverse'
		        )
		    )
		);

		$company_id = logged('company_id');
		$this->db->select('*');
		$this->db->from($this->formsbuilder_model->table_custom);
		$this->db->where('company_id', $company_id);
		$this->db->where('id', 1);
		$query = $this->db->get();

		if(count($query->result()) > 0 )
		{
			$formdata = $query->result();
			$this->page_data['form'] = $formdata[0];
			$this->load->view('formbuilder/demo', $this->page_data);
		}
	}


	public function save()
	{	

		
		$company_id = logged('company_id');
		$this->db->select('*');
		$this->db->from($this->formsbuilder_model->table_custom);
		$this->db->where('company_id', $company_id);
		$this->db->where('id', $this->input->post('id'));

		$query = $this->db->get();
		
		if(count($query->result()) > 0) {

			$data = array(
		        'company_id' => logged('company_id'),
		        'form_type' => 'default',
		        'form_data' => $this->input->post('data'),
		        'id' => $this->input->post('id')
		    );
		    $this->db->update($this->formsbuilder_model->table_custom,$data);

		} else {


		    $data = array(
		        'company_id' => logged('company_id'),
		        'form_type' => 'default',
		        'form_data' => $this->input->post('data'),
		        'id' => $this->input->post('id')
		    );
		    $this->db->insert($this->formsbuilder_model->table_custom,$data);

		}


		return json_encode("true");
		//print_r($this->input->post());
		// $this->page_data['selected_data'] = $this->formsbuilder_model->getById($id);
		// $this->load->view('formbuilder/add', $this->page_data);
	}


}