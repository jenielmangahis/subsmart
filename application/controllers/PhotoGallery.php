<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PhotoGallery extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();

        $this->load->model('PhotoGallery_model');

        $this->page_data['page']->title = 'Photo Gallery';
        $this->page_data['page']->menu = 'photo-gallery';
    }

    public function index()
    {        

        $cid = logged('company_id');
        $photoGallery = $this->PhotoGallery_model->getAllByCompanyId($cid);

        $this->page_data['photoGallery'] = $photoGallery;
        $this->load->view('v2/pages/photo_gallery/index', $this->page_data);
    }

    public function ajax_upload_images()
    {
        $is_success = 0;
        $msg = 'Cannot save data';

        $post = $this->input->post();
        $company_id = logged('company_id');
        
        $filePath = FCPATH . (implode(DIRECTORY_SEPARATOR, ['uploads', 'photo_gallery', $company_id]) . DIRECTORY_SEPARATOR);
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }

        $images = $_FILES['photos'];   
        $total_uploaded = 0;
        foreach ($images['name'] as $key => $image) {
            if( $images['size'][$key] > 0 ){
                $tempName = $images['tmp_name'][$key];
                $fileName = $images['name'][$key];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $fileName = uniqid($company_id) . str_replace('.tmp', '', basename($tempName)) . '.' . $fileExtension;
                $data = [
                    'company_id' => $company_id,
                    'image' => $fileName,
                    'caption' => '',
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $this->PhotoGallery_model->create($data);

                move_uploaded_file($tempName, $filePath . $fileName);

                $total_uploaded++;
            }
        }

        if( $total_uploaded > 0 ){
            $is_success = 1;
            $msg = '';

            //Activity Logs
            if( $total_uploaded > 1 ){
                $activity_name = 'Photo Gallery : Uploaded ' . $total_uploaded . ' photos';  
            }else{
                $activity_name = 'Photo Gallery : Uploaded ' . $total_uploaded . ' photo';  
            }
            
            createActivityLog($activity_name);

        }else{
            $msg = 'Nothing to upload';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'total_uploaded' => $total_uploaded
        ];

        echo json_encode($return);
    }

    public function ajax_update_caption()
    {
        $is_success = 0;
        $msg = 'Cannot save data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $photoGallery = $this->PhotoGallery_model->getById($post['photo_id']);
        if( $photoGallery && $photoGallery->company_id == $company_id ){
            $data = ['caption' => $post['photo_caption']];
            $this->PhotoGallery_model->update($photoGallery->id, $data);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Photo Gallery : Added photo caption ' . $post['photo_caption'];  
            createActivityLog($activity_name);
        }
        

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'total_uploaded' => $total_uploaded
        ];

        echo json_encode($return);
    }

    public function ajax_delete_photo()
    {
        $is_success = 0;
        $msg = 'Cannot save data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $photoGallery = $this->PhotoGallery_model->getById($post['photo_id']);
        if( $photoGallery && $photoGallery->company_id == $company_id ){
            $this->PhotoGallery_model->delete($photoGallery->id);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Photo Gallery : Deleted 1 photo';  
            createActivityLog($activity_name);
        }
        

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'total_uploaded' => $total_uploaded
        ];

        echo json_encode($return);
    }
}
