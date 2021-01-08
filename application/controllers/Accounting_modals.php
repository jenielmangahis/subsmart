<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_modals extends MY_Controller {

    private $upload_path = "./uploads/accounting/attachments/";
    public $result = null;

    public function __construct() {
        parent::__construct();
        $this->checkLogin();

        add_css(array(
            'assets/css/accounting/accounting-modal-forms.css'
        ));

        add_footer_js(array(
            'assets/js/accounting/modal-forms.js'
        ));

        $this->load->model('accounting_transfer_funds_model');
		$this->load->library('form_validation');
    }

    public function index($view ="") {
        if ($view) {
            $this->load->view("accounting/". $view);
        }
    }

    public function action() {
        $data = $this->input->post();
        $form = $data['modal_name'];

        if(isset($_FILES['attachments'])) {
            $files = $_FILES['attachments'];
        }

        try {
            switch ($form) {
                case 'transfer':
                    $this->result = $this->transfer_funds($data, $files);
                break;
            }
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }

        echo json_encode($this->result);
        exit;
    }

    private function transfer_funds($data, $files) {
        $this->form_validation->set_rules('transfer_from', 'Transfer From Account', 'required');
        $this->form_validation->set_rules('transfer_to', 'Transfer To Account', 'required');
        $this->form_validation->set_rules('transfer_amount', 'Amount', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required|date');

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            $filenames = $this->move_files($files, 'transfer');

            $insertData = [
                'transfer_from_account' => $data['transfer_from'],
                'transfer_to_account' => $data['transfer_to'],
                'transfer_amount' => $data['transfer_amount'],
                'transfer_date' => $data['date'],
                'transfer_memo' => $data['memo'],
                'transfer_attachments' => json_encode($filenames),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
    
            $transferId = $this->accounting_transfer_funds_model->create($insertData);
    
            $return['data'] = $transferId;
            $return['success'] = $transferId ? true : false;
            $return['message'] = $transferId ? 'Transfer Successfully!' : 'An expected error occured!';
        }

        return $return;
    }

    private function move_files($files, $folder) {
        $filenames = [];
        $path = $this->upload_path . '' . $folder;

        if(count($files) > 0) {
            foreach ($files['name'] as $key => $value) {
                move_uploaded_file($files['tmp_name'][$key], $path . '/' . $value);

                $filenames[] = $value;
            }
        }

        return $filenames;
    }
}