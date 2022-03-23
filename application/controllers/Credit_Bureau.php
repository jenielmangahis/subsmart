<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Credit_Bureau extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('CreditBureau_model');

        $this->checkLogin();

        $this->page_data['page']->title = 'Credit Bureau';
        $this->page_data['page']->menu = 'credit_bureau';
    }

    public function index()
    {
        $cid  = logged('company_id');

        $creditBureaus = $this->CreditBureau_model->getAll();

        $this->page_data['creditBureaus'] = $creditBureaus;
        $this->load->view('credit_bureau/list', $this->page_data);
    }

    public function add_new()
    {

        $this->load->view('credit_bureau/add', $this->page_data);
    }

    public function ajax_create_credit_bureau()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $logo = '';
        if( !empty($_FILES['cb_logo']['name']) ){
            $logo = $this->moveUploadedFile();
        }

        $data = [
            'name' => $post['cb_name'],
            'logo' => $logo,
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
        ];

        $this->CreditBureau_model->create($data);   

        $is_success = 1;

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_credit_bureau()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $creditBureau = $this->CreditBureau_model->getById($post['cbid']);
        if( $creditBureau ){
            $this->CreditBureau_model->deleteById($post['cbid']);

            $is_success = 1;

        }else{
            $msg = 'Cannot find data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function edit($id)
    {
        $cid  = logged('company_id');
        $creditBureau = $this->CreditBureau_model->getById($id);
        if( $creditBureau ){

            $this->page_data['creditBureau'] = $creditBureau;
            $this->load->view('credit_bureau/edit', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('credit_bureau/list');
        }
    }

    public function ajax_update_credit_bureau()
    {
        $is_success = 0;
        $msg = '';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $creditBureau = $this->CreditBureau_model->getById($post['cbid']);

        if( $creditBureau ){

            $logo = $creditBureau->logo;
            if( !empty($_FILES['cb_logo']['name']) ){
                $logo = $this->moveUploadedFile();
            }

            $data = [
                'name' => $post['cb_name'],
                'logo' => $logo,
                'date_modified' => date("Y-m-d H:i:s"),
            ];

            $this->CreditBureau_model->update($creditBureau->id, $data);  

            $is_success = 1;

        }else{
            $msg = 'Cannot find data';
        }

        $is_success = 1;

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function moveUploadedFile() {
        if(isset($_FILES['cb_logo']) && $_FILES['cb_logo']['tmp_name'] != '') {
            $target_dir = "./uploads/credit_bureaus/";
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['cb_logo']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['cb_logo']['name'])));
            $name = basename($_FILES["cb_logo"]["name"]);
            move_uploaded_file($tmp_name, $target_dir . $name);

            return $name;
        }
    }
}
