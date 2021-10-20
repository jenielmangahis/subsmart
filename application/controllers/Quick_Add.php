<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Quick_Add extends MY_Controller {



    public function __construct()
    {
            parent::__construct();

    }

    public function ajax_add_company_customer()
    {
        $this->load->model('Customer_advance_model', 'customer_ad_model');

        $post       = $this->input->post();
        $company_id = logged('company_id');
        $user_id    = logged('id');
        $is_success = false;
        $message    = 'Cannot create customer';

        $customer_data = [
            'company_id' => $company_id, 
            'fk_user_id' => $user_id,
            'customer_type' => 'Business',
            'first_name' => $post['ql_customer_first_name'],
            'middle_name' => $post['ql_customer_middle_name'],
            'last_name' => $post['ql_customer_last_name'],
            'email' => $post['ql_customer_email'],
            'phone_h' => $post['ql_customer_phone_number'],
            'business_name'   => $post['ql_business_name'],
            'contact_name'    => $post['ql_customer_first_name'] . ' ' . $post['ql_customer_last_name']
        ];

        $fk_prod_id = $this->customer_ad_model->add($customer_data,"acs_profile");
        $this->generate_qr_image($fk_prod_id);

        $is_success = true;
        $message    = '';

        $json_data = [
            'is_success' => $is_success,
            'message' => $message
        ];

        echo json_encode($json_data);
    }

    public function generate_qr_image($profile_id)
    {
        $this->load->model('General_model', 'general');
        
        require_once APPPATH . 'libraries/qr_generator/QrCode.php';

        $target_dir = "./uploads/customer_qr/";
        
        if(!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $qr_data  = base_url('/customer/preview/' . $profile_id);
        $ecc      = 'M';                       
        $size     = 3;
        $filename = 'qr'.md5($qr_data.'|'.$ecc.'|'.$size).'.png'; 

        $qrApi = new \Qr\QrCode();  
        $qrApi->setFileName($target_dir . $filename);
        $qrApi->setErrorCorrectionLevel($ecc);
        $qrApi->setMatrixPointSize($size);
        $qrApi->setQrData($qr_data);               
        $qr_data = $qrApi->generateQR();

        $profile_data = ['qr_img' => $filename];
        $this->general->update_with_key_field($profile_data, $profile_id,'acs_profile','prof_id');
    }
}



/* End of file Quick_Add.php */

/* Location: ./application/controllers/Quick_Add.php */