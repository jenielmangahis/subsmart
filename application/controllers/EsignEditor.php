<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class EsignEditor extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        add_css([
            'assets/textEditor/summernote-bs4.css',
            'assets/css/esign/esign-editor/esign-editor.css',
        ]);

        add_footer_js([
            'assets/textEditor/summernote-bs4.js',
            'assets/js/esign/esigneditor/create.js',
        ]);

        $this->load->view('esign/esigneditor/create', $this->page_data);
    }

    public function letters()
    {
        add_css([
            'assets/css/esign/esign-editor/esign-editor.css',
            'https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css',
        ]);

        add_footer_js([
            'assets/js/esign/esigneditor/letters.js',
            'https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js',
        ]);

        $this->load->view('esign/esigneditor/letters', $this->page_data);
    }

    public function edit()
    {
        $letterId = $this->input->get('id', true);
        if (is_null($this->getLetter($letterId))) {
            return show_404();
        }

        add_css([
            'assets/textEditor/summernote-bs4.css',
            'assets/css/esign/esign-editor/esign-editor.css',
        ]);

        add_footer_js([
            'assets/textEditor/summernote-bs4.js',
            'assets/js/esign/esigneditor/create.js',
        ]);

        $this->load->view('esign/esigneditor/create', $this->page_data);
    }

    public function apiGetCategories()
    {
        $this->db->where('user_id', logged('id'));
        $this->db->or_group_start();
        $this->db->where('user_id', null);
        $this->db->where('company_id', null);
        $this->db->group_end();
        $categories = $this->db->get('esign_editor_categories')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $categories]);
    }

    public function apiCreateCategory()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->insert('esign_editor_categories', [
            'user_id' => logged('id'),
            'company_id' => logged('company_id'),
            'name' => $payload['name'],
        ]);

        $this->db->where('id', $this->db->insert_id());
        $category = $this->db->get('esign_editor_categories')->row();
        echo json_encode(['data' => $category]);
    }

    public function apiDeleteCategory($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $id);
        $this->db->delete('esign_editor_categories');
        echo json_encode(['data' => $id]);
    }

    public function apiEditCategory($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('id', $id);
        $this->db->update('esign_editor_categories', [
            'name' => $payload['name'],
        ]);

        $this->db->where('id', $id);
        $category = $this->db->get('esign_editor_categories')->row();
        echo json_encode(['data' => $category]);
    }

    public function apiCreateLetter()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->insert('esign_editor_letters', array_merge(
            $payload, ['user_id' => logged('id')]
        ));

        $this->db->where('id', $this->db->insert_id());
        $letter = $this->db->get('esign_editor_letters')->row();
        echo json_encode(['data' => $letter]);
    }

    public function apiGetLetters()
    {
        $userId = logged('id');
        $query = <<<SQL
            SELECT `l`.`id`, `l`.`title`, `l`.`content`, `l`.`is_active`, `c`.`name` FROM `esign_editor_letters` AS `l`
                LEFT JOIN `esign_editor_categories` AS `c` ON `l`.`category_id` = `c`.`id`
            WHERE `l`.`user_id` = {$userId};
SQL;

        $query = $this->db->query($query);
        $letters = $query->result();

        header('content-type: application/json');
        echo json_encode(['data' => $letters]);
    }

    public function apiDeleteLetter($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $id);
        $this->db->delete('esign_editor_letters');
        echo json_encode(['data' => $id]);
    }

    public function apiGetLetter($id)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getLetter($id)]);
    }

    public function apiEditLetter($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->where('id', $id);
        $this->db->update('esign_editor_letters', $payload);

        $this->db->where('id', $id);
        $category = $this->db->get('esign_editor_letters')->row();
        echo json_encode(['data' => $category]);
    }

    private function getLetter($id)
    {
        if (!is_numeric($id)) {
            return null;
        }

        $userId = logged('id');
        $query = <<<SQL
            SELECT `l`.`id`, `l`.`title`, `l`.`content`, `l`.`is_active`, `c`.`name`, `c`.`id` AS category_id FROM `esign_editor_letters` AS `l`
                LEFT JOIN `esign_editor_categories` AS `c` ON `l`.`category_id` = `c`.`id`
            WHERE `l`.`user_id` = {$userId} AND `l`.`id` = {$id};
SQL;

        $query = $this->db->query($query);
        return $query->row();
    }
}
