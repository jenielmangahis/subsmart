<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Report extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->page_data['page']->title = 'Workorder Report';

		$this->page_data['page']->menu = 'report';	
		$this->load->model('Workorder_model', 'workorder_model');

		$user_id = getLoggedUserID();
	}

	public function workorder()
	{

        $this->getUsers();      
        $this->page_data['workorders'] = $this->workorder_model->getAllByUserId();           
   		$this->load->view('report/workorder/view', $this->page_data);

    }

    public function getUsers() {

        $user_id =  logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();	
        
        if($parent_id->parent_id == 1) { // ****** if user is company ******//

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        
        } else {			
        
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);			
        }       

    }

    public function searchByKeyword($type='', $status='', $emp_id=0) {

        $this->getUsers();

       // echo $this->uri->segment(5);die;
        $this->page_data['workorders'] = $this->workorder_model->getAllByUserId($type, $status, $emp_id);           
        $this->load->view('report/workorder/view', $this->page_data);
    }

    public function workorder_to_csv()
    {
       
       $data = $this->input->post();       
      
        $delimiter = ",";
        $filename = 'workorder';
        $filename = $filename.date('Ymd').time(). ".csv";

        //create a file pointer
        $f = fopen('php://memory', 'w');

        //set column headers->fullname,1);
                        
        $fields = array('Workorder#', 'Custome Name', 'Type', 'WO Status', 'Assigned To', 'Date Issued', 'Total Price', 'Expenses', 'Profit');
        fputcsv($f, $fields, $delimiter);

        //output each row of the data, format line as csv and write to file pointer
        //echo "<pre>";print_r($all);die;
     
        if(!empty($data)){           

            for($i=0; $i<count($data['workorder_id']); $i++) {

                $csvData       = array($data['workorder_id'][$i], $data['contact_name'][$i], $data['customer_type'][$i], $data['workorder_status'][$i], $data['assign_to'][$i], $data['workorder_date'][$i], $data['workorder_price'][$i], '$0.00', '$0.00');
                fputcsv($f, $csvData, $delimiter);
            }
            // foreach($data as $row){              
             
            //     $csvData       = array('WO-00'.$row->workorder_id, $row->workorder_date, $row->contact_name, '$'.$row->contact_name->total_price, '$0.00', '$0.00');
            //     fputcsv($f, $csvData, $delimiter);
            // }
        }
        else
        {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        //set headers to download file rather than displayed
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        //output all remaining data on a file pointer
        fpassthru($f);
    }


}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */