<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Description of Newsletter
 *
 * @author genru06
 */
class Newsletter extends MY_Controller {
   
    
    public function __construct() {
        parent::__construct();
    }
    
    function saveNewsBulletin()
    {        
        $this->load->library('notify');
        $this->load->model('users_model');
        $this->load->helper('file');
        $this->load->model('feeds_model');

        $is_success = 0;
        $msg        = 'Cannot create newsletter';
        $company_id = logged('company_id');
        $user_id    = logged('id');

        if( post('news_subject') == '' ){
            $msg = 'Newsletter subject is required.';
        }elseif( post('news_content') == '' ){
            $msg = 'Newsletter content is required.';
        }else{
            $file_path = 'uploads/news/'.$company_id.'/';
            $config['upload_path']   = $file_path;
            $config['allowed_types'] = 'gif|jpg|png|pdf|docx';
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if (!is_dir($file_path)) {
                mkdir($file_path, 0777, TRUE);
            }

            $attachment = '';
            if(isset($_FILES['newsletter_file']) && $_FILES['newsletter_file']['tmp_name'] != '') {
                $this->upload->do_upload('newsletter_file');
                $data = $this->upload->data();
                $attachment = $data['file_name'];
            }

            $details = array(
                'title'       => post('news_subject'),
                'message'     => post('news_content'),
                'company_id'  => $company_id,
                'user_id'     => $user_id,
                'file_link'   => $attachment
            );

            if( $this->feeds_model->saveNewsletter($details) ){
                $is_success = 1;
                $msg = 'Newsletter was successfully created';
            }
        }

        $json_return = array('success' => $is_success, 'msg' => $msg, 'data' => $data);
        echo json_encode($json_return);
    }

    public function ajax_company_newsletter()
    {
        $this->load->model('Feeds_model');
        
        $company_id  = logged('company_id');
        $newsLetters = $this->Feeds_model->getAllNewsLetterByCompanyId($company_id);

        $this->page_data['newsLetters'] = $newsLetters;
        $this->load->view('v2/widgets/newsletter_details', $this->page_data);
    }
    
    public function ajax_view_newsletter()
    {
        $this->load->model('Feeds_model');

        $newsLetter = $this->Feeds_model->getNewsById(post('newsid'));

        $this->page_data['newsLetter'] = $newsLetter;
        $this->load->view('v2/widgets/view_newsletter', $this->page_data);
    }
}
