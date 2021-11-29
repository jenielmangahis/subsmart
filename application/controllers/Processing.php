<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processing extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
        $this->load->model('General_model', 'general');
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
        self::addJSONResponseHeader();
        $input = $this->input->post();
        if($input){
            $fields_data = array();
            $fields_data['field1'] = $input['transDate'];
            $fields_data['field2'] = $input['transDesc'];
            $fields_data['field3'] = $input['transMoneyRec'];
            $fields_data['field4'] = $input['transMoneySpent'];

            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                $this->load->library('CSVReader');
                $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                if(!empty($csvData)) {
                    foreach ($csvData as $row) {
                        //echo $row['MonitoringID'];
                        $date_paid = $row[$fields_data['field1']];
                        $description = $row[$fields_data['field2']];
                        $amount = $row[$fields_data['field3']];
                        $payee = $row[$fields_data['field4']];

                        $banking_payments_data = array(
                            'company_id' =>logged('company_id'),
                            'date_paid' => $date_paid,
                            'description' => $description,
                            'amount' => $amount,
                            'payee' => $payee,
                            'assign_to' => '',
                            'is_paid' => 1,
                            'account' => 4,
                        );
                        $jobs_id = $this->general->add_return_id($banking_payments_data, 'banking_payments');
                    }
                    if($jobs_id){
                        $data_arr = array("success" => TRUE,"message" => 'Imported Successfully!');
                    }else{
                        $data_arr = array("success" => FALSE,"message" => "Please check your csv file or csv reader library.");
                    }
                }else{
                    $data_arr = array("success" => FALSE,"message" => "Please check your csv file or csv reader library.");
                }
            }
        }else{
            $data_arr = array("success" => FALSE,"message" => "Form error.");
        }
        die(json_encode($data_arr));
    }
}
