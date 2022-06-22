<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class FlashCard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->page_data['page']->title = 'Flash Card';
        $this->load->view('v2/pages/university/flashcard/index.php', $this->page_data);
    }

    public function addCards($deckId)
    {

        $userId = logged('id');
        $this->db->where('id', $deckId);
        $this->db->where('user_id', $userId);
        $row = $this->db->get('university_flashcard_decks')->row();
        if (!$row) {
            show_404();
        }

        $this->page_data['page']->title = "Add Cards ($row->title)";
        $this->load->view('v2/pages/university/flashcard/add-cards.php', $this->page_data);
    }

    public function apiCreateDeck()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $userId = logged('id');

        $this->db->insert('university_flashcard_decks', array_merge($payload, [
            'user_id' => $userId,
        ]));

        $this->db->where('id', $this->db->insert_id());
        $row = $this->db->get('university_flashcard_decks')->row();
        $this->respond(['data' => $row]);
    }

    public function apiGetDecs()
    {
        $userId = logged('id');
        $this->db->where('user_id', $userId);
        $rows = $this->db->get('university_flashcard_decks')->result();
        $this->respond(['data' => $rows]);
    }

    private function respond($data)
    {
        header('content-type: application/json');
        exit(json_encode($data));
    }
}
