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
        $row = $this->getCard($deckId);
        if (!$row) {
            show_404();
        }

        $this->page_data['page']->deckId = $row->id;
        $this->page_data['page']->title = "Add Cards ($row->title)";
        $this->load->view('v2/pages/university/flashcard/add-cards.php', $this->page_data);
    }

    public function getCard($id)
    {
        $userId = logged('id');
        $companyId = logged('company_id');

        $this->db->select('decks.*', false);
        $this->db->from('university_flashcard_decks decks');

        $this->db->join('users', 'users.id = decks.user_id', 'left');
        $this->db->where('users.company_id', $companyId);

        $this->db->group_start();
        $this->db->where('decks.user_id', $userId);
        $this->db->or_where('decks.is_shared_in_company', 1);
        $this->db->group_end();

        $this->db->where('decks.id', $id);
        return $this->db->get('university_flashcard_decks')->row();
    }

    public function studyCards($deckId)
    {
        $row = $this->getCard($deckId);
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

        $cards = array_map(function ($card) {
            return array_merge($card, [
                'question' => trim($card['question']),
                'answer' => trim($card['answer']),
            ]);
        }, $cards);

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
        $row = $this->getCard($deckId);
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
        $row = $this->getCard($payload['id']);

        $this->db->where('id', $row->id);
        $this->db->update('university_flashcard_decks', [
            'title' => $payload['title'],
            'is_shared_in_company' => $payload['is_shared_in_company'],
        ]);

        $this->db->where('id', $payload['id']);
        $row = $this->db->get('university_flashcard_decks')->row();
        $row = $this->populateData($row);
        $this->respond(['data' => $row]);
    }

    private function populateData($item)
    {
        static $users = [];

        if (!array_key_exists($item->user_id, $users)) {
            $this->db->where('id', $item->user_id);
            $users[$item->user_id] = $this->db->get('users')->row();
        }

        $item->current_user_id = logged('id');

        $user = $users[$item->user_id];
        $item->uploaded_by_firstname = $user->FName;
        $item->uploaded_by_lastname = $user->LName;

        $this->db->where('deck_id', $item->id);
        $item->cards = $this->db->get('university_flashcard_cards')->result();
        return $item;
    }

    public function apiGetDecks()
    {
        $userId = logged('id');
        $companyId = logged('company_id');

        $this->db->select('decks.*, COUNT(cards.id) AS total_cards', false);
        $this->db->from('university_flashcard_decks decks');

        $this->db->join('users', 'users.id = decks.user_id', 'left');
        $this->db->join('university_flashcard_cards cards', 'cards.deck_id = decks.id', 'left');

        $this->db->where('users.company_id', $companyId);

        $this->db->group_start();
        $this->db->where('decks.user_id', $userId);
        $this->db->or_where('decks.is_shared_in_company', 1);
        $this->db->group_end();

        $this->db->group_by('decks.id');
        $this->db->order_by('decks.id', 'ASC');

        $query = $this->db->get();
        $results = $query->result();

        $results = array_map(function ($result) {
            return $this->populateData($result);
        }, $results);

        $this->respond(['data' => $results]);
    }

    private function respond($data)
    {
        header('content-type: application/json');
        exit(json_encode($data));
    }
}
