<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class SlideShare extends MYF_Controller
{
    const ONE_MB = 1048576;
    const MAX_SIZE_IN_MB = 500;

    public function __construct()
    {
        parent::__construct();
    }

    public function v()
    {
        $name = $this->input->get('n', true);
        if (is_null($name)) {
            show_404();
        }

        $query = $this->db->query("SELECT * FROM university_slideshare WHERE `name` LIKE BINARY '{$name}%'");
        $result = $query->row();

        if (is_null($result)) {
            show_404();
        }

        $result->url = $this->getUrl($result);

        $this->db->where('id', $result->user_id);
        $result->user = $this->db->get('users')->row();

        $this->page_data['slideshare'] = $result;
        $this->load->view('v2/pages/university/slideshare/view.php', $this->page_data);
    }

    public function index()
    {
        if (!logged('id')) {
            show_404();
        }

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

    public function apiSave()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['display_name' => $displayName, 'description' => $description, 'name' => $fileName, 'size' => $fileSize] = $payload;
        $userId = logged('id');

        $this->db->insert('university_slideshare', [
            'user_id' => $userId,
            'name' => $fileName,
            'display_name' => $displayName,
            'size' => $fileSize,
            'description' => $description,
        ]);

        $this->db->where('id', $this->db->insert_id());
        $row = $this->db->get('university_slideshare')->row();
        $row->url = $this->getUrl($row);
        $this->respond(['data' => $row]);
    }

    public function apiUpload()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        if ($_FILES['file']['size'] > self::ONE_MB * self::MAX_SIZE_IN_MB) {
            $this->respond([
                'success' => false,
                'reason' => 'File size must be less than ' . self::MAX_SIZE_IN_MB . 'MB',
            ]);
        }

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        @set_time_limit(5 * 60);

        $uploadPath = $this->getUploadPath();
        $userId = logged('id');
        $maxFileAge = 5 * 3600; // hours

        $tempName = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = uniqid($userId) . str_replace('.tmp', '', basename($tempName)) . '.' . $fileExtension;
        $filePath = $uploadPath . DIRECTORY_SEPARATOR . $fileName;

        $chunk = isset($_REQUEST['chunk']) ? intval($_REQUEST['chunk']) : 0;
        $chunks = isset($_REQUEST['chunks']) ? intval($_REQUEST['chunks']) : 0;

        // Remove old temp files
        if (!is_dir($uploadPath) || !$dir = opendir($uploadPath)) {
            $this->respond(['success' => false, 'message' => 'Failed to open temp directory']);
        }
        while (($file = readdir($dir)) !== false) {
            $tmpfilePath = $uploadPath . DIRECTORY_SEPARATOR . $file;

            // If temp file is current file proceed to the next
            if ($tmpfilePath == "{$filePath}.part") {
                continue;
            }

            // Remove temp file if it is older than the max age and is not the current file
            if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                @unlink($tmpfilePath);
            }
        }
        closedir($dir);

        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            $this->respond(['success' => false, 'message' => 'Failed to open output stream']);
        }

        if (!empty($_FILES)) {
            if ($_FILES['file']['error'] || !is_uploaded_file($_FILES['file']['tmp_name'])) {
                $this->respond(['success' => false, 'message' => 'Failed to move uploaded file']);
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES['file']['tmp_name'], 'rb')) {
                $this->respond(['success' => false, 'message' => 'Failed to open input stream']);
            }
        } else {
            if (!$in = @fopen('php://input', 'rb')) {
                $this->respond(['success' => false, 'message' => 'Failed to open input stream']);
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk === $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
        }

        $data = ['name' => $fileName, 'size' => $_FILES['file']['size']];
        $this->respond(['success' => true, 'data' => $data]);
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
