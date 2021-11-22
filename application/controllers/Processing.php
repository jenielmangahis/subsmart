<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processing extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
	}

	public function addJSONResponseHeader()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type: application/json");
    }

    public function onGetCSVHeaders()
    {
        self::addJSONResponseHeader();
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $this->load->library('CSVReader');
            $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
            $headers = array();
            if(!empty($csvData)) {
                $data_arr = array("success" => TRUE,"data" => $csvData[0],true);
            }else{
                $data_arr = array("success" => FALSE,"message" => 'Please check your csv file or csv reader library.');
            }
        }
        die(json_encode($data_arr));

    }

    public function onPostCSVValue()
    {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $this->load->library('CSVReader');
            $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
            if(!empty($csvData)) {
                foreach ($csvData as $row) {
                   //echo $row['MonitoringID'];
               }
                print_r($csvData);
                echo json_encode($csvData,true);
            }else{
                echo 'error';
            }
        }

    }
}
