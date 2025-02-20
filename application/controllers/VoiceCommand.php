<?php
class VoiceCommand extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function uploadVoiceCommand() {
        $company_id = logged('company_id');
        $user_id = logged('id');
    
        $filename = md5($user_id . ' ' . $company_id) . '_voicecommand.webm';
        $upload_path = './uploads/files/';
    
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true); 
        }
    
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded or upload error.']);
            return;
        }
    
        $allowed_types = ['audio/webm', 'audio/wav'];
        $file_type = $_FILES['file']['type'];
        if (!in_array($file_type, $allowed_types)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Only WebM and WAV files are allowed.']);
            return;
        }
    
        $destination = $upload_path . $filename;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
            $file_url = base_url('uploads/files/' . $filename);
            echo json_encode(['status' => 'success', 'file_url' => $file_url]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save the file.']);
        }
    }
}