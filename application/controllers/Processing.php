<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processing extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
    {
		$this->load->view('about', $this->page_data);
	}

    public function onGetCSVHeaders(){

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $this->load->library('CSVReader');
            $csvData = $this->csvreader->get_header($_FILES['file']['tmp_name']);

            if(!empty($csvData)) {
//                foreach ($csvData as $row) {
//                    //echo $row['MonitoringID'];
//                }
                //print_r($csvData);
                echo json_encode($csvData,true);
            }else{
                echo 'error';
            }
        }

    }
}
