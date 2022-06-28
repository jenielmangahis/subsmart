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

        $this->page_data['page']->deckId = $row->id;
        $this->page_data['page']->title = "Add Cards ($row->title)";
        $this->load->view('v2/pages/university/flashcard/add-cards.php', $this->page_data);
    }

    public function studyCards($deckId)
    {
        $userId = logged('id');
        $this->db->where('id', $deckId);
        $this->db->where('user_id', $userId);
        $row = $this->db->get('university_flashcard_decks')->row();
        if (!$row) {
            show_404();
        }

        $this->page_data['page']->deckId = $row->id;
        $this->page_data['page']->title = "Study Cards ($row->title)";
        $this->load->view('v2/pages/university/flashcard/study-cards.php', $this->page_data);
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

    public function apiSaveCards()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['cards' => $cards, 'deck_id' => $deckId] = $payload;

        $newCards = array_filter($cards, function ($card) {
            return !array_key_exists('id', $card);
        });
        $newCards = array_map(function ($card) use ($deckId) {
            return [
                'deck_id' => $deckId,
                'question' => $card['question'],
                'answer' => $card['answer'],
            ];
        }, $newCards);

        $existingCards = array_filter($cards, function ($card) {
            return array_key_exists('id', $card);
        });

        if (!empty($newCards)) {
            $this->db->insert_batch('university_flashcard_cards', $newCards);
        }

        if (!empty($existingCards)) {
            $this->db->update_batch('university_flashcard_cards', $existingCards, 'id');
        }

        $this->apiGetDeck($deckId);
    }

    public function apiGetDeck($deckId)
    {
        $userId = logged('id');
        $this->db->where('id', $deckId);
        $this->db->where('user_id', $userId);
        $row = $this->db->get('university_flashcard_decks')->row();
        $row = $this->populateData($row);
        $this->respond(['data' => $row]);
    }

    public function apiDeleteCard()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            $this->respond(['success' => false]);
        }

        $id = $this->input->get('id', true);

        $this->db->where('id', $id);
        $row = $this->db->get('university_flashcard_cards')->row();

        $this->db->where('id', $row->id);
        $this->db->delete('university_flashcard_cards');
        $this->respond(['data' => $row]);
    }

    public function apiDeleteDeck()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            $this->respond(['success' => false]);
        }

        $id = $this->input->get('id', true);
        $userId = logged('id');

        $this->db->where('id', $id);
        $this->db->where('user_id', $userId);
        $row = $this->db->get('university_flashcard_decks')->row();

        $this->db->where('id', $row->id);
        $this->db->delete('university_flashcard_decks');
        $this->respond(['data' => $row]);
    }

    public function apiEditDeck()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $userId = logged('id');

        $this->db->where('id', $payload['id']);
        $this->db->where('user_id', $userId);
        $this->db->update('university_flashcard_decks', $payload);

        $this->db->where('id', $payload['id']);
        $row = $this->db->get('university_flashcard_decks')->row();
        $row = $this->populateData($row);
        $this->respond(['data' => $row]);
    }

    private function populateData($item)
    {
        $this->db->where('deck_id', $item->id);
        $item->cards = $this->db->get('university_flashcard_cards')->result();
        return $item;
    }

    public function apiGetDecks()
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
