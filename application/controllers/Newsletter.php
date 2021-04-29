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
        
        $this->load->helper('file');
        
        $this->load->model('feeds_model');
        
        
        $file_path = 'uploads/news/';
        $config['upload_path'] = $file_path;
        $config['allowed_types'] = 'gif|jpg|png|pdf|docx';
        
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if (!is_dir($file_path)) {
            mkdir($file_path, 0777, TRUE);

        }
        
        $news = post('news');
        $company_id = logged('company_id');
        
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = $this->upload->data();
            
            $details = array(
                'message'       => $news,
                'company_id'    => $company_id,
                'file_link'     => $file_path.$data['file_name']
            );
            
            if($this->feeds_model->saveNewsletter($details)):
                $json_return = array('success' => true, 'msg' => 'Successfully Sent', 'data' => $data);
            else:
                $json_return = array('success' => false, 'msg' => 'Sorry Something went wrong');
            endif;
            
            echo json_encode($json_return);
        }
    }
}
