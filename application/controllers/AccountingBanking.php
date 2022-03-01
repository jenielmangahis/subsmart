<?php
/**
 * Controller for Accounting Banking
 *
 * PHP version 7.2.19
 *
 * @package    nSmarTrac
 * @category   Controller
 * @author     Welyelf Hisula<welyelfhisula@gmail.com>
 * @copyright  2020 nSmarTrac
 */

class AccountingBanking extends MYF_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general_model');
        $this->addJSONResponseHeader();
    }

    /**
     * This method will set the response header to json
     *
     */
    public function addJSONResponseHeader()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type: application/json");
    }

    /**
     * This method will update the transaction payment category and other data
     *
     * @return json array Whether the update process has been successful or not
     */
    public function onUpdatePaymentCategory()
    {
        $input = $this->input->post();
        if($input){
            $id = $input['transaction_id'];
            $input['status'] = 1; // set the status to categorized
            unset($input['transaction_id']);

            if($this->general_model->update_with_key($input, $id, 'banking_payments')){
                $data_arr = array("success" => TRUE,"message" => 'Transaction updated!');
            }else{
                $data_arr = array("success" => FALSE,"message" => 'Unable to update transaction.');
            }
        }
        die(json_encode($data_arr));
    }
}