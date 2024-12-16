<?php
class VideoBinder extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('AdVideo_model');
        $this->load->model('Serversidetable_model', 'serverside_table');
    }

    public function settings() {
        $company_id = logged('company_id');
        $user_type = logged('user_type');

        // Only allow company id 1 (NSMART LLC) with Admin user account to access this settings 
        if ($company_id == 1 && $user_type == 7) {
            $this->page_data['company_id'] = $company_id;
            $this->page_data['user_type'] = $user_type;
            $this->page_data['page']->title = 'Video Binder Settings';
            $this->load->view('v2/pages/videobinder/videobinder_settings', $this->page_data);
        } else {
            redirect('/dashboard');
        }
    }

    public function viewVideoBinder() 
    {
        $company_id = logged('company_id');

         $initializeTable = $this->serverside_table->initializeTable(
            "videobinder_view", 
            array('title', 'description', 'file'),
            array('title', 'description', 'file'),
            null,  
            array('company_id' => $company_id,),
        );

        $whereCondition = array('company_id' => $company_id);
        $getData = $this->serverside_table->getRows($this->input->post(), $whereCondition);

        $data = $row = array();
        $i = $this->input->post('start');
        
        foreach($getData as $getDatas){
            if ($getDatas->company_id == $company_id) {
                $data[] = array(
                    $getDatas->title,
                    $getDatas->description,
                    "<div class='btn-group' role='group'><button class='nsm-button small text-nowrap viewVideoFileButton' data-id='$getDatas->id' data-filename='$getDatas->file' data-bs-toggle='modal' data-bs-target='.viewVideoFileModal'>View File</button><button class='nsm-button small editVideoButton' data-id='$getDatas->id' data-bs-toggle='modal' data-bs-target='.editPresetModal'>Edit</button><button class='nsm-button small removeVideoButton' data-id='$getDatas->id' data-title='$getDatas->title'>Remove</button></div>",
                );
                $i++;
            }
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );
        
        echo json_encode($output);
    }

    public function getVideoDetails()
    {
        $company_id = logged('company_id');
        $video_id = $this->input->post('id');

        $this->db->where('id', $video_id);
        $this->db->where('company_id', $company_id);
        $video = $this->db->get('videobinder')->row_array();

        if ($video) {
            echo json_encode(['success' => true, 'data' => $video]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Video not found or you lack permission.']);
        }
    }

    public function addVideo() 
    {
        $company_id = logged('company_id');
        $this->load->helper('string');
        $this->load->library('upload');
        $response = ['success' => false, 'message' => ''];

        $upload_path = './uploads/files/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'mp4|avi|mov|wmv';
        $config['max_size'] = 102400;
        $config['remove_spaces'] = true;
        $config['encrypt_name'] = false; 

        $this->upload->initialize($config);

        if (isset($_FILES['video_file']) && $_FILES['video_file']['name'] != '') {
            if ($this->upload->do_upload('video_file')) {
                $uploaded_data = $this->upload->data();
                $file_extension = $uploaded_data['file_ext'];

                $is_video = in_array(strtolower($file_extension), ['.mp4', '.avi', '.mov', '.wmv']);

                $new_filename = $company_id . '_' . md5(random_string('alnum', 16) . time()) . $file_extension;

                rename($uploaded_data['full_path'], $upload_path . $new_filename);

                if ($is_video) {}

                $formData = [
                    'company_id' => $company_id,
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'file' => $new_filename, 
                ];

                if ($this->db->insert('videobinder', $formData)) {
                    $response['success'] = true;
                    $response['message'] = 'Video successfully uploaded and saved.';
                } else {
                    $response['message'] = 'Failed to save video to the database.';
                }
            } else {
                $response['message'] = $this->upload->display_errors('', '');
            }
        } else {
            $response['message'] = 'No file was uploaded.';
        }

        echo json_encode($response);
    }

    public function editVideo()
    {
        $company_id = logged('company_id');
        $this->load->helper('string');
        $this->load->library('upload');
        $response = ['success' => false, 'message' => ''];
    
        $upload_path = './uploads/files/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
    
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'mp4|avi|mov|wmv';
        $config['max_size'] = 102400; // 50MB
        $config['remove_spaces'] = true;
        $config['encrypt_name'] = false;
    
        $this->upload->initialize($config);
    
        $video_id = $this->input->post('id');
        $this->db->where('id', $video_id);
        $this->db->where('company_id', $company_id);
        $video = $this->db->get('videobinder')->row();
    
        if (!$video) {
            $response['message'] = 'Video not found or you do not have permission to edit it.';
            echo json_encode($response);
            return;
        }
    
        $new_filename = $video->file; // Default to the existing file if no new file is uploaded
    
        if (isset($_FILES['video_file']) && $_FILES['video_file']['name'] != '') {
            if ($this->upload->do_upload('video_file')) {
                $uploaded_data = $this->upload->data();
                $file_extension = $uploaded_data['file_ext'];
    
                $is_video = in_array(strtolower($file_extension), ['.mp4', '.avi', '.mov', '.wmv']);
                $new_filename = $company_id . '_' . md5(random_string('alnum', 16) . time()) . $file_extension;
    
                rename($uploaded_data['full_path'], $upload_path . $new_filename);
    
                // Delete the old file
                $old_file_path = $upload_path . $video->file;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            } else {
                $response['message'] = $this->upload->display_errors('', '');
                echo json_encode($response);
                return;
            }
        }
    
        $formData = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'file' => $new_filename, // Update with the new file name or retain the old one
        ];
    
        $this->db->where('id', $video_id);
        $this->db->where('company_id', $company_id);
        if ($this->db->update('videobinder', $formData)) {
            $response['success'] = true;
            $response['message'] = 'Video successfully updated.';
        } else {
            $response['message'] = 'Failed to update video.';
        }
    
        echo json_encode($response);
    }
    
    public function removeVideo()
    {
        $company_id = logged('company_id');
        $this->load->helper('file');
        $video_id = $this->input->post('id');

        $response = ['success' => false, 'message' => ''];

        $this->db->where('id', $video_id);
        $this->db->where('company_id', $company_id);
        $video = $this->db->get('videobinder')->row();

        if ($video) {
            $file_path = './uploads/files/' . $video->file;

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $this->db->where('id', $video_id);
            $this->db->where('company_id', $company_id);
            if ($this->db->delete('videobinder')) {
                $response['success'] = true;
                $response['message'] = 'Video and associated file successfully deleted.';
            } else {
                $response['message'] = 'Failed to delete video entry from the database.';
            }
        } else {
            $response['message'] = 'Video not found or you do not have permission to delete it.';
        }

        echo json_encode($response);
    }

    public function getAllVideos()
    {
        $company_id = logged('company_id');

         $initializeTable = $this->serverside_table->initializeTable(
            "videobinder_view", 
            array('title'),
            array('title'),
            null,  
            array('company_id' => $company_id,),
        );

        $whereCondition = array('company_id' => $company_id);
        $getData = $this->serverside_table->getRows($this->input->post(), $whereCondition);

        $data = $row = array();
        $i = $this->input->post('start');
        
        foreach($getData as $getDatas){
            if ($getDatas->company_id == $company_id) {
                $data[] = array(
                    "<span class='float-start'>$getDatas->title</span><span class='float-end watchClip cursorPointer' data-id='$getDatas->id' data-filename='$getDatas->file'><i class='bx bx-play-circle playCirleSize'></i></span>",
                );
                $i++;
            }
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );
        
        echo json_encode($output);
    }
    
}