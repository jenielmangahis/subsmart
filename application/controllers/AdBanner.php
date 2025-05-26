<?php
class AdBanner extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('AdBanner_model');
        $this->load->model('Serversidetable_model', 'serverside_table');
    }

    public function settings() {
        $company_id = logged('company_id');
        $role = logged('role');

        // Only allow company id 1 (NSMART LLC) with Admin user account to access this settings 
        if ($company_id == 1 && $role == 7) {
            $this->page_data['company_id'] = $company_id;
            $this->page_data['role'] = $role;
            $this->page_data['page']->title = 'Discover More ADS';
            $this->load->view('v2/pages/adbanner/adbanner_settings', $this->page_data);
        } else {
            show403Error();
			return false;
        }
    }

    public function viewBanner() 
    {
        $company_id = logged('company_id');

         $initializeTable = $this->serverside_table->initializeTable(
            "adbanner_view", 
            array('title', 'description', 'link', 'url_alias', 'duration', 'file'),
            array('title', 'description', 'link', 'url_alias', 'duration', 'file'),
            null,  
            array('company_id' => $company_id,),
        );

        $whereCondition = array('company_id' => $company_id);
        $getData = $this->serverside_table->getRows($this->input->post(), $whereCondition);

        $data = $row = array();
        $i = $this->input->post('start');
        
        $duration_alias = [
            "duration_3sec" => "3 seconds",
            "duration_4sec" => "4 seconds",
            "duration_5sec" => "5 seconds",
            "duration_6sec" => "6 seconds",
            "duration_7sec" => "7 seconds",
            "duration_8sec" => "8 seconds",
            "duration_9sec" => "9 seconds",
            "duration_10sec" => "10 seconds"
        ];

        foreach($getData as $getDatas){
            if ($getDatas->company_id == $company_id) {
                
                $duration = isset($duration_alias[$getDatas->duration]) ? $duration_alias[$getDatas->duration] : $getDatas->duration;

                $data[] = array(
                    $getDatas->title,
                    $getDatas->description,
                    "<code>$getDatas->link</code>",
                    $getDatas->url_alias,
                    $duration,
                    "<div class='btn-group' role='group' style='height: 28px;'>
                        <button style='color: #00000085; font-weight: 600; font-size: smaller; border: 1px solid #00000021 !important;' class='text-nowrap viewBannerFileButton' data-id='$getDatas->id' data-filename='$getDatas->file' data-bs-toggle='modal' data-bs-target='.viewBannerFileModal'><i class='fas fa-eye'></i> VIEW</button>
                        <button style='color: #0000ff8c; font-weight: 600; font-size: smaller; border: 1px solid #00000021 !important;' class='text-nowrap editBannerButton' data-id='$getDatas->id' data-bs-toggle='modal' data-bs-target='.editPresetModal'><i class='fas fa-edit'></i> EDIT</button>
                        <button style='color: #ff00008c; font-weight: 600; font-size: smaller; border: 1px solid #00000021 !important;' class='text-nowrap removeBannerButton' data-id='$getDatas->id' data-title='$getDatas->title'><i class='fas fa-trash'></i> REMOVE</button>
                    </div>",
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

    public function getBannerDetails()
    {
        $company_id = logged('company_id');
        $banner_id = $this->input->post('id');

        $this->db->where('id', $banner_id);
        $this->db->where('company_id', $company_id);
        $banner = $this->db->get('adbanner')->row_array();

        if ($banner) {
            echo json_encode(['success' => true, 'data' => $banner]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Banner not found or you lack permission.']);
        }
    }

    public function addBanner() 
    {
        $company_id = logged('company_id');
        $this->load->helper('string');
        $this->load->library('upload');
        $response = ['success' => false, 'message' => ''];

        $upload_path = './uploads/BusinessBanner/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|avi|mov|wmv';
        $config['max_size'] = 51200;
        $config['remove_spaces'] = true;
        $config['encrypt_name'] = false; 

        $this->upload->initialize($config);

        if (isset($_FILES['banner_file']) && $_FILES['banner_file']['name'] != '') {
            if ($this->upload->do_upload('banner_file')) {
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
                    'link' => $this->input->post('link'),
                    'url_alias' => $this->input->post('url_alias'),
                    'duration' => $this->input->post('duration'),
                    'file' => $new_filename, 
                ];

                if ($this->db->insert('adbanner', $formData)) {
                    $response['success'] = true;
                    $response['message'] = 'Banner successfully uploaded and saved.';
                } else {
                    $response['message'] = 'Failed to save banner data to the database.';
                }
            } else {
                $response['message'] = $this->upload->display_errors('', '');
            }
        } else {
            $response['message'] = 'No file was uploaded.';
        }

        echo json_encode($response);
    }

    public function editBanner()
    {
        $company_id = logged('company_id');
        $this->load->helper('string');
        $this->load->library('upload');
        $response = ['success' => false, 'message' => ''];
    
        $upload_path = './uploads/BusinessBanner/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
    
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|avi|mov|wmv';
        $config['max_size'] = 51200; // 50MB
        $config['remove_spaces'] = true;
        $config['encrypt_name'] = false;
    
        $this->upload->initialize($config);
    
        $banner_id = $this->input->post('id');
        $this->db->where('id', $banner_id);
        $this->db->where('company_id', $company_id);
        $banner = $this->db->get('adbanner')->row();
    
        if (!$banner) {
            $response['message'] = 'Banner not found or you do not have permission to edit it.';
            echo json_encode($response);
            return;
        }
    
        $new_filename = $banner->file; // Default to the existing file if no new file is uploaded
    
        if (isset($_FILES['banner_file']) && $_FILES['banner_file']['name'] != '') {
            if ($this->upload->do_upload('banner_file')) {
                $uploaded_data = $this->upload->data();
                $file_extension = $uploaded_data['file_ext'];
    
                $is_video = in_array(strtolower($file_extension), ['.mp4', '.avi', '.mov', '.wmv']);
                $new_filename = $company_id . '_' . md5(random_string('alnum', 16) . time()) . $file_extension;
    
                rename($uploaded_data['full_path'], $upload_path . $new_filename);
    
                // Delete the old file
                $old_file_path = $upload_path . $banner->file;
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
            'link' => $this->input->post('link'),
            'url_alias' => $this->input->post('url_alias'),
            'duration' => $this->input->post('duration'),
            'file' => $new_filename, // Update with the new file name or retain the old one
        ];
    
        $this->db->where('id', $banner_id);
        $this->db->where('company_id', $company_id);
        if ($this->db->update('adbanner', $formData)) {
            $response['success'] = true;
            $response['message'] = 'Banner successfully updated.';
        } else {
            $response['message'] = 'Failed to update banner data.';
        }
    
        echo json_encode($response);
    }
    
    public function removeBanner()
    {
        $company_id = logged('company_id');
        $this->load->helper('file');
        $banner_id = $this->input->post('id');

        $response = ['success' => false, 'message' => ''];

        $this->db->where('id', $banner_id);
        $this->db->where('company_id', $company_id);
        $banner = $this->db->get('adbanner')->row();

        if ($banner) {
            $file_path = './uploads/BusinessBanner/' . $banner->file;

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $this->db->where('id', $banner_id);
            $this->db->where('company_id', $company_id);
            if ($this->db->delete('adbanner')) {
                $response['success'] = true;
                $response['message'] = 'Banner and associated file successfully deleted.';
            } else {
                $response['message'] = 'Failed to delete banner entry from the database.';
            }
        } else {
            $response['message'] = 'Banner not found or you do not have permission to delete it.';
        }

        echo json_encode($response);
    }

    public function getAllBanners()
    {
        $this->db->where('company_id', 1);
        $banners = $this->db->get('adbanner')->result_array();
    
        if (!empty($banners)) {
            echo json_encode($banners);
        } else {
            echo 0;
        }
    }
    
}