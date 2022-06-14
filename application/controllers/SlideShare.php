<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class SlideShare extends MY_Controller
{
    const ONE_MB = 1048576;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->page_data['page']->title = 'Slide Share';
        $this->load->view('v2/pages/university/slideshare/index.php', $this->page_data);
    }

    public function apiGetItems()
    {
        $userId = logged('id');
        $this->db->where('user_id', $userId);
        $results = $this->db->get('university_slideshare')->result();
        $results = array_map(function ($result) {
            $result->url = $this->getUrl($result);
            return $result;
        }, $results);

        $this->respond(['data' => $results]);
    }

    public function apiUpload()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $filePath = $this->getUploadPath();
        $video = $_FILES['video'];

        $maxSizeInMB = 8;
        $fileSize = $video['size'];

        if ($fileSize > self::ONE_MB * $maxSizeInMB) {
            $this->respond([
                'success' => false,
                'reason' => "File size must be less than {$maxSizeInMB}MB",
            ]);
        }

        $userId = logged('id');

        $tempName = $video['tmp_name'];
        $fileName = $video['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = uniqid($userId) . str_replace('.tmp', '', basename($tempName)) . '.' . $fileExtension;

        ['display_name' => $displayName, 'description' => $description] = $this->input->post();
        $this->db->insert('university_slideshare', [
            'user_id' => $userId,
            'name' => $fileName,
            'display_name' => $displayName,
            'size' => $fileSize,
            'description' => $description,
        ]);

        move_uploaded_file($tempName, $filePath . $fileName);

        $this->db->where('id', $this->db->insert_id());
        $row = $this->db->get('university_slideshare')->row();
        $row->url = $this->getUrl($row);
        $this->respond(['data' => $row]);
    }

    public function apiEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $userId = logged('id');

        $this->db->where('id', $payload['id']);
        $this->db->where('user_id', $userId);
        $this->db->update('university_slideshare', $payload);

        $this->db->where('id', $payload['id']);
        $row = $this->db->get('university_slideshare')->row();
        $row->url = $this->getUrl($row);
        $this->respond(['data' => $row]);
    }

    public function apiDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            $this->respond(['success' => false]);
        }

        $id = $this->input->get('id', true);
        $userId = logged('id');

        $this->db->where('id', $id);
        $this->db->where('user_id', $userId);
        $row = $this->db->get('university_slideshare')->row();

        if (is_null($row)) {
            $this->respond(['success' => false, 'message' => 'Not found']);
        }

        $this->db->where('id', $id);
        $this->db->where('user_id', $userId);
        $this->db->delete('university_slideshare');

        $filePath = $this->getUploadPath();
        if ($row->name && file_exists($filePath . $row->name)) {
            unlink($filePath . $row->name);
        }

        $this->respond(['data' => $row]);
    }

    private function getUrl($item)
    {
        $filePath = str_replace(DIRECTORY_SEPARATOR, '/', $this->getUploadPath());
        $filePath = $filePath . $item->name;
        $offset = strpos($filePath, '/uploads/university/');
        return substr($filePath, $offset);
    }

    private function getUploadPath()
    {
        $path = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, 'uploads/university/slideshare/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }

    private function respond($data)
    {
        header('content-type: application/json');
        exit(json_encode($data));
    }
}
