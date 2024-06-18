<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Before_after_v2 extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'Before/After';
        $this->page_data['page']->menu = 'before-after';
        $this->load->model('Before_after_model', 'before_after_model');

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'assets/frontend/css/workorder/main.css',
            'assets/css/beforeafter.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/beforeafter/v2/main.js',
        ));
    }

    public function index()
    {
        $this->load->model('Before_after_model', 'before_after_model');

        $cid = logged('company_id');
        $this->page_data['photos'] = $this->before_after_model->getAllByCompanyId($cid);
        $this->page_data['page']->title = 'Before and After Photos';

        add_footer_js(array(
			"assets/js/jquery.fancybox.min.js"
		));

        add_css([
            "assets/css/jquery.fancybox.css",
            'https://nightly.datatables.net/css/jquery.dataTables.css',
        ]);

        $this->page_data['cid'] = $cid;
        $this->load->view('v2/pages/before_after/index', $this->page_data);
    }

    public function addPhoto()
    {
        $this->load->model('AcsProfile_model');

        $comp_id = logged('company_id');
        $group_num_query = $this->db->order_by("id", "desc")->get_where($this->before_after_model->table, $comp_id)->row();
        $this->page_data['group_number'] = 1;
        if ($group_num_query) {
            $this->page_data['group_number'] = intval($this->db->order_by("id", "desc")->get_where($this->before_after_model->table, array('company_id' => $comp_id))->row()->group_number) + 1;
        }

        $this->page_data['page']->title = 'Add Photos';
        $this->load->view('v2/pages/before_after/add_photo', $this->page_data);
    }

    public function saveBeforeAfter()
    {
        //postAllowed();

        $this->uploadBeforeAfter($this->input->post('customer_id'), $this->input->post('group_number'), $this->input->post('note'));

        $this->activity_model->add("New Before/After Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Before/After Created Successfully');

        redirect('vault_v2/beforeafter');
    }

    private function getUploadPath()
    {
        $cid = logged('company_id');
        $filePath = FCPATH . (implode(DIRECTORY_SEPARATOR, ['uploads', 'beforeandafter']) . DIRECTORY_SEPARATOR . $cid . DIRECTORY_SEPARATOR);
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }

        return $filePath;
    }

    public function updateBeforeAfter()
    {
        //postAllowed();
        $post = $this->input->post();
        $beforeAfter = $this->before_after_model->getById($post['id']);
        if ($beforeAfter) {
            $config = array(
                'upload_path' => $this->getUploadPath(),
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => false,
                'encrypt_name' => true,
                'max_size' => "2048000",
                'max_height' => "768",
                'max_width' => "1024",
            );

            $b_image = $beforeAfter->before_image;
            if (!empty($_FILES['b1_img']['name'])) {
                if ($this->upload->do_upload("b1_img")) {
                    $draftlogo = array('upload_data' => $this->upload->data());
                    $b_image = $draftlogo['upload_data']['file_name'];
                }
            }

            $a_image = $beforeAfter->after_image;
            if (!empty($_FILES['a1_img']['name'])) {
                if ($this->upload->do_upload("a1_img")) {
                    $draftlogo = array('upload_data' => $this->upload->data());
                    $a_image = $draftlogo['upload_data']['file_name'];
                }
            }

            $data = [
                'customer_id' => $post['customer_id'],
                'before_image' => $b_image,
                'after_image' => $a_image,
                "note" => $post['note'],
            ];

            $this->before_after_model->update($beforeAfter->id, $data);

            $this->activity_model->add("Before/After Updated by User: #" . logged('id'));
            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Before/After Updated Successfully');
        } else {
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Cannot find data');
        }

        redirect('vault_v2/beforeafter');
    }

    public function uploadBeforeAfter($customer_id, $group_number, $notes)
    {
        $config = array(
            'upload_path' => $this->getUploadPath(),
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => false,
            'encrypt_name' => true,
            'max_size' => "2048000",
            'max_height' => "768",
            'max_width' => "1024",
        );
        $this->load->library('upload', $config);
        $this->upload->upload_path = $config['upload_path'];

        $user_id = logged('id');
        $comp_id = logged('company_id');
        $uploadFields = array("b1_img", "a1_img", "b2_img", "a2_img", "b3_img", "a3_img", "b4_img", "a4_img", "b5_img", "a5_img");

        for ($i = 1; $i < 6; $i++) {
            $b_image = "";
            $a_image = "";

            if ($this->upload->do_upload("b" . $i . "_img")) {
                $draftlogo = array('upload_data' => $this->upload->data());
                $b_image = $draftlogo['upload_data']['file_name'];
            }

            if ($this->upload->do_upload("a" . $i . "_img")) {
                $draftlogo = array('upload_data' => $this->upload->data());
                $a_image = $draftlogo['upload_data']['file_name'];
            }

            if ($b_image != "") {
                $note = '';
                if (isset($notes[$i - 1])) {
                    $note = $notes[$i - 1];
                }
                $data = array(
                    'user_id' => $user_id,
                    'company_id' => $comp_id,
                    'customer_id' => $customer_id,
                    'before_image' => $b_image,
                    'after_image' => $a_image,
                    'group_number' => $group_number,
                    "note" => $note,
                );

                $this->db->insert($this->before_after_model->table, $data);
            }
        }
    }

    public function edit($id)
    {
        $this->load->model('AcsProfile_model');

        $comp_id = logged('company_id');
        $role = logged('role');

        $beforeAfter = $this->before_after_model->getById($id);

        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($comp_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }

        $this->page_data['beforeAfter'] = $beforeAfter;
        $this->page_data['group_number'] = $id;
        $this->page_data['photos'] = $this->before_after_model->getByWhere(['company_id' => $comp_id, 'group_number' => $id]);
        $this->load->view('v2/pages/before_after/edit_photo', $this->page_data);

    }

    public function delete($id)
    {
        $this->before_after_model->deleteBeforeAfter($id);

        redirect('vault_v2/beforeafter');
    }

    public function delete_image()
    {
        $post = $this->input->post();
        $this->before_after_model->deleteBeforeAfter($post['bai']);

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Before/After image was successfully deleted');

        redirect('vault_v2/beforeafter');
    }

    public function ajax_create_photos()
    {
        $this->load->model('AcsProfile_model');

        ini_set('post_max_size', '999M');
        ini_set('upload_max_filesize', '999M');

        $is_success = 1;
		$msg = '';

        $user_id = logged('id');
        $comp_id = logged('company_id');  

        $group_number = $this->input->post('group_number');
        $customer_id  = $this->input->post('customer_id');
        $notes        = $this->input->post('note');
        //$uploadFields = array("b1_img", "a1_img", "b2_img", "a2_img", "b3_img", "a3_img", "b4_img", "a4_img", "b5_img", "a5_img");
        $uploadFields = array("b1_img", "a1_img", "b2_img", "a2_img");
        $attachmentFolderPath = $this->getUploadPath();
        
        for ($i = 1; $i < 6; $i++) {
            $b_image = "";
            $a_image = "";                        
            if(isset($_FILES["b".$i."_img"]) && $_FILES["b".$i."_img"]['tmp_name'] != '') {
                $tmp_name  = $_FILES["b".$i."_img"]['tmp_name'];
                $extension = strtolower(end(explode('.',$_FILES["b".$i."_img"]['name'])));
                $b_image   = "before_".time()."_photo_".basename($_FILES["b".$i."_img"]["name"]);
                move_uploaded_file($tmp_name, $attachmentFolderPath.$b_image);
            }

            if(isset($_FILES["a".$i."_img"]) && $_FILES["a".$i."_img"]['tmp_name'] != '') {
                $tmp_name  = $_FILES["a".$i."_img"]['tmp_name'];
                $extension = strtolower(end(explode('.',$_FILES["a".$i."_img"]['name'])));
                $a_image   = "after_".time()."_photo_".basename($_FILES["a".$i."_img"]["name"]);
                move_uploaded_file($tmp_name, $attachmentFolderPath.$a_image);
            }

            if ($b_image != "" && $a_image != "") {
                $note = '';
                if (isset($notes[$i - 1])) {
                    $note = $notes[$i - 1];
                }
                $data = array(
                    'user_id' => $user_id,
                    'company_id' => $comp_id,
                    'customer_id' => $customer_id,
                    'before_image' => $b_image,
                    'after_image' => $a_image,
                    'group_number' => $group_number,
                    "note" => $note,
                );

                $this->before_after_model->create($data);

                //Activity Logs
                $customer = $this->AcsProfile_model->getByProfId($customer_id);
                $activity_name = 'Created Before and After photos for customer ' . $customer->first_name . ' ' . $customer->last_name; 
                createActivityLog($activity_name);
            }
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_photos()
    {
        $this->load->model('AcsProfile_model');

        $is_success = 0;
		$msg = 'Cannot find data';

        $cid = logged('company_id');
        $post = $this->input->post();

        $beforeAfterPhoto = $this->before_after_model->getById($post['bai']);
        if( $beforeAfterPhoto && $beforeAfterPhoto->company_id == $cid ){
            if( $beforeAfterPhoto->after_image != '' ){
                unlink('./uploads/beforeandafter/'.$cid.'/'.$beforeAfterPhoto->after_image);
            }

            if( $beforeAfterPhoto->before_image != '' ){
                unlink('./uploads/beforeandafter/'.$cid.'/'.$beforeAfterPhoto->before_image);
            }           

            $this->before_after_model->delete($beforeAfterPhoto->id);

            //Activity Logs
            $activity_name = 'Deleted Before and After photos for customer ' . $beforeAfterPhoto->first_name . ' ' . $beforeAfterPhoto->last_name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function editPhoto($id)
    {
        $this->load->model('AcsProfile_model');

        $cid = logged('company_id');
        $beforeAfter = $this->before_after_model->getByIdAndCompanyId($id, $cid);
        if( $beforeAfter ){   
            $this->page_data['beforeAfter'] = $beforeAfter;
            $this->load->view('v2/pages/before_after/edit_photo', $this->page_data);
        }else{
            return redirect ('before_after_photos');
        }
    }

    public function ajax_update_photos()
    {
        $is_success = 0;
		$msg = 'Cannot find data';

        $uid  = logged('id');
        $cid  = logged('company_id');
        $post = $this->input->post(); 
        $beforeAfterPhoto = $this->before_after_model->getByIdAndCompanyId($post['bfid'], $cid);  
        if( $beforeAfterPhoto ){
            $b_image = $beforeAfterPhoto->before_image;
            $a_image = $beforeAfterPhoto->after_image;    
            $customer_id  = $this->input->post('customer_id');
            $note         = $this->input->post('note');         
            $attachmentFolderPath = $this->getUploadPath();

            if(isset($_FILES["b1_img"]) && $_FILES["b1_img"]['tmp_name'] != '') {
                $tmp_name  = $_FILES["b1_img"]['tmp_name'];
                $extension = strtolower(end(explode('.',$_FILES["b1_img"]['name'])));
                $b_image   = "before_".time()."_photo_".basename($_FILES["b1_img"]["name"]);
                move_uploaded_file($tmp_name, $attachmentFolderPath.$b_image);

                if( $beforeAfterPhoto->before_image != '' ){
                    unlink('./uploads/beforeandafter/'.$cid.'/'.$beforeAfterPhoto->before_image);
                }  
                
            }

            if(isset($_FILES["a1_img"]) && $_FILES["a1_img"]['tmp_name'] != '') {
                $tmp_name  = $_FILES["a1_img"]['tmp_name'];
                $extension = strtolower(end(explode('.',$_FILES["a1_img"]['name'])));
                $a_image   = "after_".time()."_photo_".basename($_FILES["a1_img"]["name"]);
                move_uploaded_file($tmp_name, $attachmentFolderPath.$a_image);

                if( $beforeAfterPhoto->after_image != '' ){
                    unlink('./uploads/beforeandafter/'.$cid.'/'.$beforeAfterPhoto->after_image);
                }
            }

            $data = array(
                'user_id' => $uid,
                'customer_id' => $customer_id,
                'before_image' => $b_image,
                'after_image' => $a_image,
                'group_number' => $group_number,
                "note" => $note,
            );

            $this->before_after_model->update($beforeAfterPhoto->id, $data);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }
}
