<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class PlaceholderGetParam
{
    public function __construct(int $customerId, int $companyId)
    {
        $this->customerId = $customerId;
        $this->companyId = $companyId;
    }
}

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

            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.6/purify.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js',
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

    public function wizard()
    {
        $customerId = $this->input->get('customer_id', true);
        if (is_null($this->getCustomer($customerId))) {
            return show_404();
        }

        add_css([
            'assets/textEditor/summernote-bs4.css',
            'assets/css/esign/esign-editor/esign-editor.css',

            'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
        ]);

        add_footer_js([
            'assets/textEditor/summernote-bs4.js',
            'assets/js/esign/esigneditor/wizard.js',

            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.6/purify.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js',

            'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
        ]);

        $this->load->view('esign/esigneditor/wizard', $this->page_data);
    }

    public function wizard2()
    {
        $customerId = $this->input->get('customer_id', true);
        if (is_null($this->getCustomer($customerId))) {
            return show_404();
        }

        add_css([
            'assets/textEditor/summernote-bs4.css',
            'assets/css/esign/esign-editor/esign-editor.css',
            'https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css',

            'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
        ]);

        add_footer_js([
            'assets/textEditor/summernote-bs4.js',

            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.6/purify.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js',

            'assets/js/esign/esigneditor/wizard2/index.js',
            'https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js',
        ]);

        $this->load->view('esign/esigneditor/wizard2', $this->page_data);
    }

    public function customers($id)
    {
        if (is_null($this->getCustomer($id))) {
            return show_404();
        }

        add_css([
            'assets/textEditor/summernote-bs4.css',
            'assets/css/esign/esign-editor/esign-editor.css',
            'https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css',
        ]);

        add_footer_js([
            'assets/textEditor/summernote-bs4.js',
            'assets/js/esign/esigneditor/customer-letters.js',
            'https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',

            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.6/purify.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js',
        ]);

        $this->load->view('esign/esigneditor/customer-letters', $this->page_data);
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
        // Expects datatable.js pagination params
        $limit = (int) $this->input->get('length') ?? 10;
        $offset = (int) $this->input->get('start') ?? 0;
        $draw = (int) $this->input->get('draw');
        $category = (int) $this->input->get('category') ?? -1; // -1 = all
        $status = (int) $this->input->get('status') ?? -1; // -1 = all
        $userId = (int) logged('id');
        $searchQuery = $this->input->get('search[value]');
        $order = $this->input->get('order[0][dir]');

        $this->db->select('l.id, l.title, l.content, l.is_active, l.user_id, c.name AS category, IF(f.id, TRUE, FALSE) as is_favorite', false);
        $this->db->from('esign_editor_letters l');
        $this->db->join('esign_editor_categories c', 'l.category_id = c.id', 'left');
        $this->db->join('esign_editor_favorite_letters f', 'l.id = f.letter_id', 'left');
        $this->db->group_start();
        $this->db->where('l.user_id', $userId);
        $this->db->or_where('l.user_id', null);
        $this->db->group_end();
        $this->db->order_by('l.title', $order);
        $this->db->limit($limit, $offset);
        if (!is_null($searchQuery)) {
            $this->db->like('l.title', $searchQuery);
        }
        if ($category !== -1) {
            $this->db->where('c.id', $category);
        }
        if ($status !== -1) {
            $this->db->where('l.is_active', $status);
        }
        $query = $this->db->get();
        $results = $query->result();

        $this->db->select('l.id');
        $this->db->from('esign_editor_letters l');
        $this->db->join('esign_editor_categories c', 'l.category_id = c.id', 'left');
        $this->db->group_start();
        $this->db->where('l.user_id', $userId);
        $this->db->or_where('l.user_id', null);
        $this->db->group_end();
        if (!is_null($searchQuery)) {
            $this->db->like('title', $searchQuery);
        }
        if ($category !== -1) {
            $this->db->where('c.id', $category);
        }
        if ($status !== -1) {
            $this->db->where('l.is_active', $status);
        }
        $query = $this->db->get();
        $recordsFiltered = $query->num_rows();

        $this->db->select('id');
        $this->db->group_start();
        $this->db->where('user_id', $userId);
        $this->db->or_where('user_id', null);
        $this->db->group_end();
        $recordsTotal = $this->db->get('esign_editor_letters')->num_rows();

        header('content-type: application/json');
        echo json_encode([
            'data' => $results,
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
        ]);
    }

    public function apiDeleteLetter($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $letter = $this->getLetter($id);
        if ($letter->user_id != logged('id')) {
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

        $letter = $this->getLetter($id);
        if ($letter->user_id != logged('id')) {
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
            SELECT `l`.`id`, `l`.`title`, `l`.`content`, `l`.`is_active`, `l`.`user_id`, `c`.`name`, `c`.`id` AS category_id FROM `esign_editor_letters` AS `l`
                LEFT JOIN `esign_editor_categories` AS `c` ON `l`.`category_id` = `c`.`id`
            WHERE (`l`.`user_id` = {$userId} OR `l`.`user_id` IS NULL) AND `l`.`id` = {$id};
SQL;

        $query = $this->db->query($query);
        return $query->row();
    }

    public function getPlaceholders(int $customerId = null, bool $forSeed = false)
    {
        $placeholders = [
            [
                'code' => 'company_logo',
                'description' => 'Company logo',
                'get' => function (PlaceholderGetParam $param) {
                    $this->db->where('company_id', $param->companyId);
                    $this->db->where('business_image is NOT NULL', null, false);
                    $this->db->select('business_image, id');
                    $company = $this->db->get('business_profile')->row();

                    if ($company) {
                        return urlUpload('users/business_profile/' . $company->id . '/' . $company->business_image . '?' . time());
                    }

                    return null;
                },
            ],
            [
                'code' => 'client_suffix',
                'description' => 'Suffix of client',
                'get' => function (PlaceholderGetParam $param) {
                    $customer = $this->getCustomer($param->customerId);
                    return $customer ? $customer->suffix : null;
                },
            ],
            [
                'code' => 'client_first_name',
                'description' => 'First name of client',
                'get' => function (PlaceholderGetParam $param) {
                    $customer = $this->getCustomer($param->customerId);
                    return $customer ? $customer->first_name : null;
                },
            ],
            [
                'code' => 'client_middle_name',
                'description' => 'Middle name of client',
                'get' => function (PlaceholderGetParam $param) {
                    $customer = $this->getCustomer($param->customerId);
                    return $customer ? $customer->middle_name : null;
                },
            ],
            [
                'code' => 'client_last_name',
                'description' => 'Last name of client',
                'get' => function (PlaceholderGetParam $param) {
                    $customer = $this->getCustomer($param->customerId);
                    return $customer ? $customer->last_name : null;
                },
            ],
            [
                'code' => 'client_address',
                'description' => 'Address of client',
                'get' => function (PlaceholderGetParam $param) {
                    return $this->getCustomerAddress($param->customerId);
                },
            ],
            [
                'code' => 'client_previous_address',
                'description' => 'Previous address of client',
            ],
            [
                'code' => 'bdate',
                'description' => 'Birth date of client',
                'get' => function (PlaceholderGetParam $param) {
                    $customer = $this->getCustomer($param->customerId);
                    $dateOfBirth = $customer->date_of_birth;

                    if (is_null($dateOfBirth) || empty($dateOfBirth)) {
                        return null;
                    }

                    try {
                        $date = DateTime::createFromFormat('Y-m-d', $dateOfBirth);
                        return $date->format('m/d/Y');
                    } catch (\Throwable$th) {
                        return $dateOfBirth; // unexpected format
                    }
                },
            ],
            [
                'code' => 'ss_number',
                'description' => 'Last 4 of SSN of client',
                'get' => function (PlaceholderGetParam $param) {
                    $customer = $this->getCustomer($param->customerId);
                    return $customer ? $customer->ssn : null;
                },
            ],
            [
                'code' => 't_no',
                'description' => 'Telephone number of client',
                'get' => function (PlaceholderGetParam $param) {
                    $customer = $this->getCustomer($param->customerId);
                    return $customer ? ($customer->phone_h ?? $customer->phone_m) : null;
                },
            ],
            [
                'code' => 'curr_date',
                'description' => 'Current date',
                'get' => function () {
                    $now = new DateTime();
                    return $now->format('m/d/Y');
                },
            ],
            [
                'code' => 'client_signature',
                'description' => "Client's signature",
                'get' => function (PlaceholderGetParam $param) {
                    $this->db->where('user_id', $param->customerId);
                    $record = $this->db->get('user_signatures')->row();
                    if (is_null($record) || empty($record->signature)) {
                        return null;
                    }

                    return $record->signature;
                },
            ],
            [
                'code' => 'bureau_name',
                'description' => 'Credit bureau name',
            ],
            [
                'code' => 'bureau_address',
                'description' => 'Credit bureau name and address',
                'get' => function (PlaceholderGetParam $param) {
                    if (empty($param->bureau)) {
                        return null;
                    }

                    return $this->getBureauAddressHTML($param->bureau);
                },
            ],
            [
                'code' => 'account_number',
                'description' => 'Account number',
            ],
            [
                'code' => 'dispute_item_and_explanation',
                'description' => 'Dispute items and explanation',
                'get' => function (PlaceholderGetParam $param) {
                    if (empty($param->disputeItemIds)) {
                        return null;
                    }

                    $template = '<li>{reason}<br>{creditor}<br>Account Number: {account_number}<br><div></div></li>';
                    $listItems = array_map(function ($itemId) use ($template) {
                        $this->db->where('id', $itemId);
                        $item = $this->db->get('customer_dispute_items')->row();

                        $this->db->select('instruction, furnisher_id');
                        $this->db->where('id', $item->customer_dispute_id);
                        $dispute = $this->db->get('customer_disputes')->row();
                        if (empty($dispute->instruction)) {
                            $dispute->instruction = 'N/A';
                        }

                        $this->db->select('name');
                        $this->db->where('id', $dispute->furnisher_id);
                        $creditor = $this->db->get('furnishers')->row();

                        $retval = str_replace('{reason}', $dispute->instruction, $template);
                        $retval = str_replace('{creditor}', $creditor->name, $retval);
                        $retval = str_replace('{account_number}', $item->account_number, $retval);
                        return $retval;

                    }, $param->disputeItemIds);

                    return str_replace('{items}', implode('', $listItems), '<ol>{items}</ol>');
                },
            ],
            [
                'code' => 'creditor_name',
                'description' => 'Creditor/Furnisher name',
            ],
            [
                'code' => 'creditor_address',
                'description' => 'Creditor/Furnisher address',
            ],
            [
                'code' => 'creditor_phone',
                'description' => 'Creditor/Furnisher phone number',
            ],
            [
                'code' => 'creditor_city',
                'description' => 'Creditor/Furnisher city',
            ],
            [
                'code' => 'creditor_state',
                'description' => 'Creditor/Furnisher state',
            ],
            [
                'code' => 'creditor_zip',
                'description' => 'Creditor/Furnisher zip',
            ],
            [
                'code' => 'report_number',
                'description' => 'Report number',
            ],
        ];

        if ($forSeed) {
            return $placeholders;
        }

        $this->db->where('user_id', logged('id'));
        $userPlaceholders = $this->db->get('esign_editor_placeholders')->result();

        foreach ($userPlaceholders as $placeholder) {
            array_push($placeholders, [
                'code' => $placeholder->code,
                'description' => $placeholder->description,
                'get' => function () use ($placeholder) {
                    return $placeholder->value;
                },

                'id' => $placeholder->id,
                '_user_defined' => true,
            ]);
        }

        if (is_null($customerId)) {
            return $placeholders;
        }

        $customer = $this->getCustomer($customerId);
        $customFields = [];
        if (!is_null($customer->custom_fields) && !empty($customer->custom_fields)) {
            $customFields = json_decode($customer->custom_fields, true);
        }

        if (!is_array($customFields)) {
            return $placeholders;
        }

        $placeholderCodes = array_column($placeholders, 'code');
        foreach ($customFields as $field) {
            $code = $this->toPlaceholderCode($field['name']);
            $description = $field['name'] . ' (custom field)';
            $key = array_search($code, $placeholderCodes);
            $getter = function () use ($field) {
                return $field['value'];
            };

            if ($key === false) {
                array_push($placeholders, [
                    'code' => $code,
                    'description' => $description,
                    'get' => $getter,
                ]);
            } else {
                $placeholders[$key]['get'] = $getter;
                $placeholders[$key]['description'] = $description;
            }
        }

        return $placeholders;
    }

    public function apiSeedPlaceholders()
    {
        $placeholders = $this->getPlaceholders(null, true);
        $placeholders = array_map(function ($placeholder) {
            return ['code' => $placeholder['code'], 'description' => $placeholder['description']];
        }, $placeholders);
        $this->db->insert_batch('esign_editor_placeholders', $placeholders);
    }

    public function apiGetPlaceholders()
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getPlaceholders()]);
    }

    public function apiGetCustomerPlaceholders($id)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getPlaceholders((int) $id)]);
    }

    private function toPlaceholderCode(string $string)
    {
        return preg_replace('/\s+/', '_', strtolower($string));
    }

    public function apiGetCustomerCustomFields($id)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getCustomerCustomFields($id)]);
    }

    private function getCustomerCustomFields($id)
    {
        $customer = $this->getCustomer($id);
        $customFields = [];
        if (!is_null($customer->custom_fields) && !empty($customer->custom_fields)) {
            $customFields = json_decode($customer->custom_fields);
        }

        return $customFields;
    }

    public function apiSaveCustomerCustomFields($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->where('prof_id', $id);
        $this->db->update('acs_profile', [
            'custom_fields' => json_encode($payload['fields']),
        ]);

        echo json_encode(['data' => $this->getCustomerCustomFields($id)]);
    }

    public function apiCreatePlaceholder()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->insert('esign_editor_placeholders', array_merge(
            $payload, [
                'user_id' => logged('id'),
                'company_id' => logged('company_id'),
            ]
        ));

        $this->db->where('id', $this->db->insert_id());
        $placeholder = $this->db->get('esign_editor_placeholders')->row();
        $placeholder->_user_defined = true;
        echo json_encode(['data' => $placeholder]);
    }

    public function apiGetLetterByCategoryId($categoryId)
    {
        $limit = $this->input->get('limit') ?? 10;
        $offset = $this->input->get('offset') ?? 0;
        $search = $this->input->get('search');

        $ids = null;
        if ($categoryId === 'favorite') {
            // gets favorite letter ids
            $this->db->where('company_id', logged('company_id'));
            $this->db->where('user_id', logged('id'));
            $favorites = $this->db->get('esign_editor_favorite_letters')->result();
            $ids = empty($favorites) ? [-1] : array_column($favorites, 'letter_id');
        }

        if ($categoryId !== 'favorite') {
            $this->db->where('category_id', $categoryId);
        }
        if (!is_null($search)) {
            $this->db->like('title', $search);
        }
        if (is_array($ids)) {
            $this->db->where_in('id', $ids);
        }

        $this->db->order_by('title', 'asc');
        $this->db->limit((int) $limit, (int) $offset);
        $letters = $this->db->get('esign_editor_letters')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $letters, 'is_last' => count($letters) < $limit]);
    }

    public function apiGetCustomer($id)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getCustomer($id)]);
    }

    private function getCustomer($id)
    {
        static $customersMap = [];
        if (!array_key_exists($id, $customersMap)) {
            $this->db->where('prof_id', $id);
            $customersMap[$id] = $this->db->get('acs_profile')->row();
        }

        return $customersMap[$id];
    }

    public function apiExportLetterAsPDF()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $letter = $this->getLetter($payload['letter_id']);
        $letter->customer_id = (int) $payload['customer_id'];
        if (array_key_exists('content', $payload)) {
            $letter->content = $payload['content'];
        }

        echo json_encode(['data' => [
            'content' => $this->generateCustomerLetter($letter),
        ]]);
    }

    private function generateCustomerLetter($customerLetter, array $additionalProps = [])
    {
        $placeholders = $this->getPlaceholders((int) $customerLetter->customer_id);
        $placeholderParam = new PlaceholderGetParam(
            (int) $customerLetter->customer_id,
            (int) logged('company_id')
        );

        foreach ($additionalProps as $key => $value) {
            $placeholderParam->$key = $value;
        }

        $letterContent = $customerLetter->content;
        foreach ($placeholders as $placeholder) {
            if (!array_key_exists('get', $placeholder)) {
                continue;
            }

            ['code' => $code, 'get' => $getter] = $placeholder;

            $callback = function () use ($getter, $placeholderParam) {
                $value = $getter($placeholderParam);
                if (!empty($value) && is_string($value) && $this->isImage($value)) {
                    return str_replace('{source}', $value, '<img src="{source}" width="200" alt="" />');
                }
                return $value;
            };

            $letterContent = preg_replace_callback(
                "|{{$code}}|",
                $callback,
                $letterContent
            );
        }

        return $letterContent;
    }

    public function apiCreateCustomerLetter()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->insert('esign_editor_customer_letters', array_merge(
            $payload, [
                'user_id' => logged('id'),
                'company_id' => logged('company_id'),
            ]
        ));

        $this->db->where('id', $this->db->insert_id());
        $customerLetter = $this->db->get('esign_editor_customer_letters')->result();
        echo json_encode(['data' => $customerLetter]);
    }

    public function apiGetCustomerLetters($customerId)
    {
        $this->db->where('user_id', logged('id'));
        $this->db->where('customer_id', $customerId);
        $letters = $this->db->get('esign_editor_customer_letters')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $letters]);
    }

    public function apiEditCustomerLetter($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('id', $id);
        $this->db->update('esign_editor_customer_letters', [
            'content' => $payload['content'],
        ]);

        $this->db->where('id', $id);
        $letter = $this->db->get('esign_editor_customer_letters')->row();
        echo json_encode(['data' => $letter]);
    }

    public function apiDeleteCustomerLetter($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $id);
        $this->db->delete('esign_editor_customer_letters');
        echo json_encode(['data' => $id]);
    }

    public function apiPrintCustomerLetters()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['ids' => $ids] = $payload;

        $this->db->where_in('id', $ids);
        $letters = $this->db->get('esign_editor_customer_letters')->result();

        $generated = [];
        foreach ($letters as $letter) {
            array_push($generated, $this->generateCustomerLetter($letter));
        }

        echo json_encode(['data' => $generated]);
    }

    public function apiBatchEditCustomerLetters()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['letters' => $letters] = $payload;
        $ids = array_map(function ($letter) {return $letter['id'];}, $letters);

        $this->db->update_batch('esign_editor_customer_letters', $letters, 'id');

        $this->db->where_in('id', $ids);
        $letters = $this->db->get('esign_editor_customer_letters')->result();
        echo json_encode(['data' => $letters]);
    }

    public function apiEmailCustomerLetter()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $storePath = FCPATH . 'uploads/esigneditor/';
        if (!file_exists($storePath)) {
            mkdir($storePath, 0777, true);
        }

        $subject = trim($this->input->post('subject'));
        $message = trim($this->input->post('message'));
        $email = trim($this->input->post('email'));

        $pdfName = md5(uniqid(logged('id'), true));
        $pdfPath = rtrim($storePath, '/') . "/{$pdfName}.pdf";
        move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath);

        include APPPATH . 'controllers/DocuSign.php';
        $mail = getMailInstance();
        $mailTemplate = file_get_contents(VIEWPATH . 'esign/esigneditor/email/customer-letter.html');

        $data = ['%message%' => $message];
        $mailContent = strtr($mailTemplate, $data);

        $mail->Subject = '[nSmarTrac] ' . $subject;
        $mail->MsgHTML($mailContent);
        $mail->addAddress($email);

        $mail->AddAttachment($pdfPath, $pdfName . '.pdf');
        $isSent = $mail->send();
        $mail->ClearAllRecipients();

        if (file_exists($pdfPath)) {
            unlink($pdfPath);
        }

        if (!$this->input->post('ids')) {
            echo json_encode(['data' => null, 'is_sent' => $isSent]);
            return;
        }

        $ids = explode(',', $this->input->post('ids'));
        $letters = array_map(function ($id) {
            return [
                'id' => $id,
                'print_status' => 'Printed/Sent',
                'sent_at' => date('Y-m-d H:i:s'),
            ];
        }, $ids);
        $this->db->update_batch('esign_editor_customer_letters', $letters, 'id');

        $this->db->where_in('id', $ids);
        $letters = $this->db->get('esign_editor_customer_letters')->result();
        echo json_encode(['data' => $letters, 'is_sent' => $isSent]);

    }

    public function apiSeedLetters()
    {
        $jsonPath = FCPATH . './assets/js/esign/esigneditor/creditrepairletters.json';
        $jsonString = file_get_contents($jsonPath);
        $data = json_decode($jsonString, true);

        $categoryName = 'Credit Repair Industry';
        $this->db->where('name', $categoryName);
        $category = $this->db->get('esign_editor_categories')->row();

        if (is_null($category)) {
            $this->db->insert('esign_editor_categories', [
                'name' => $categoryName,
            ]);

            $this->db->where('id', $this->db->insert_id());
            $category = $this->db->get('esign_editor_categories')->row();
        }

        $letters = array_map(function ($letter) use ($category) {
            return [
                'category_id' => $category->id,
                'title' => $letter['title'],
                'content' => $letter['content'],
            ];
        }, $data);

        $this->db->insert_batch('esign_editor_letters', $letters);

        header('content-type: application/json');
        echo json_encode(['data' => $letters]);
    }

    private function isImage(string $source)
    {
        try {
            $validExtensions = ['png', 'jpeg', 'jpg', 'gif', 'svg'];

            if (strpos($source, 'data:image') === 0) {
                list(, $decoded) = explode(';', $source);
                list(, $decoded) = explode(',', $decoded);
                $image = base64_decode($decoded, true);

                if ($image === false) {
                    return false;
                }
            } else {
                $fileInfo = new SplFileInfo($source);
                $fileExtension = $fileInfo->getExtension();

                if (empty($fileInfo->getExtension())) { // no extension
                    return false;
                }

                if (preg_match(sprintf('/^%s/', implode('|', $validExtensions)), $fileExtension) !== 1) { // invalid extension
                    return false;
                }

                $image = file_get_contents($source);
            }

            $tempFile = tempnam(sys_get_temp_dir(), 'esigneditor');
            file_put_contents($tempFile, $image);

            $contentType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $tempFile);
            if (substr($contentType, 0, 5) !== 'image') {
                return false;
            }

            $extension = ltrim($contentType, 'image/');
            if (!in_array(strtolower($extension), $validExtensions)) {
                return false;
            }

            return true;
        } catch (Throwable $th) {
            return 'haha';
        }
    }

    public function apiToggleFavoriteLetter($letterId)
    {
        $userId = logged('id');
        $companyId = logged('company_id');

        $this->db->where('user_id', $userId);
        $this->db->where('company_id', $companyId);
        $this->db->where('letter_id', $letterId);
        $favorite = $this->db->get('esign_editor_favorite_letters')->row();
        $isFavorite = false;

        if (is_null($favorite)) {
            $isFavorite = true;
            $this->db->insert('esign_editor_favorite_letters', [
                'user_id' => $userId,
                'company_id' => $companyId,
                'letter_id' => $letterId,
            ]);
        } else {
            $this->db->where('id', $favorite->id);
            $this->db->delete('esign_editor_favorite_letters');
        }

        $this->db->where('id', $letterId);
        $letter = $this->db->get('esign_editor_letters')->row();
        $letter->is_favorite = $isFavorite;

        header('content-type: application/json');
        echo json_encode(['data' => $letter]);
    }

    public function apiDeletePlaceholder($placeholderId)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('user_id', logged('id'));
        $this->db->where('id', $placeholderId);
        $placeholder = $this->db->get('esign_editor_placeholders')->row();

        if (is_null($placeholder)) {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $placeholder->id);
        $this->db->delete('esign_editor_placeholders');
        echo json_encode(['data' => $placeholder->id]);
    }

    public function apiGetCustomers()
    {
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $customers = $this->customer_ad_model->get_customer_data();

        $customers = array_map(function ($customer) {
            $customer->profile = userProfilePicture($customer->id);
            return $customer;
        }, $customers);

        header('content-type: application/json');
        echo json_encode(['data' => $customers]);
    }

    public function apiDuplicateLetter($letterId)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $letterId);
        $letter = $this->db->get('esign_editor_letters')->row_array();

        $letter['user_id'] = logged('id');
        $letter['_auto_generated'] = 0;
        $letter['title'] = $letter['title'] . ' - Copy';
        unset($letter['id']);
        $this->db->insert('esign_editor_letters', $letter);

        $this->db->where('id', $this->db->insert_id());
        $copy = $this->db->get('esign_editor_letters')->row();
        echo json_encode(['data' => $copy]);
    }

    public function apiGetCustomerDisputeItems($customerId)
    {
        $this->db->where('prof_id', $customerId);
        $disputes = $this->db->get('customer_disputes')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $this->getDisputeData($disputes)]);
    }

    private function getDisputeData(array $disputes)
    {
        $furnishersMap = [];
        $creditBureauMap = [];

        $data = [];
        foreach ($disputes as $dispute) {
            if (!array_key_exists($dispute->furnisher_id, $furnishersMap)) {
                $this->db->where('id', $dispute->furnisher_id);
                $furnishersMap[$dispute->furnisher_id] = $this->db->get('furnishers')->row();
            }

            $currData = [];
            $currData['id'] = (int) $dispute->id;
            $currData['reason'] = $dispute->instruction;
            $currData['creditor'] = $furnishersMap[$dispute->furnisher_id]->name;
            $currData['creditor_id'] = (int) $furnishersMap[$dispute->furnisher_id]->id;
            $currData['is_disputed'] = false;

            $this->db->where('customer_dispute_id', $dispute->id);
            $items = $this->db->get('customer_dispute_items')->result();
            foreach ($items as $item) {
                if (!array_key_exists($item->credit_bureau_id, $creditBureauMap)) {
                    $this->db->where('id', $item->credit_bureau_id);
                    $creditBureauMap[$item->credit_bureau_id] = $this->db->get('credit_bureau')->row();
                }

                $bureau = $creditBureauMap[$item->credit_bureau_id];
                $currData['items'][] = [
                    'id' => (int) $item->id,
                    'bureau' => $bureau->name,
                    'account_number' => $item->account_number,
                    'status' => $item->status,
                ];
            }

            array_push($data, $currData);
        }

        return $data;
    }

    public function apiGenerateBasicDispute()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['customer_id' => $customerId, 'dispute_ids' => $disputeIds] = $payload;

        $this->db->where_in('id', $disputeIds);
        $this->db->where('prof_id', $customerId);
        $disputes = $this->db->get('customer_disputes')->result();
        $disputeData = $this->getDisputeData($disputes);

        $bureauItemIdsMap = [];
        foreach ($disputeData as $data) {
            foreach ($data['items'] as $item) {
                $bureau = $this->underscoreCase($item['bureau']);
                if (!array_key_exists($bureau, $bureauItemIdsMap)) {
                    $bureauItemIdsMap[$bureau] = [];
                }

                $bureauItemIdsMap[$bureau][] = $item['id'];
            }
        }

        $letterName = 'Default Round 1 (Dispute Credit Report Items)';
        $this->db->where('title', $letterName);
        $letter = $this->db->get('esign_editor_letters')->row();
        $letter->customer_id = $customerId;

        $retval = [];
        $bureauAddressMap = [];
        foreach ($bureauItemIdsMap as $key => $ids) {
            $additionalProps = ['bureau' => $key, 'disputeItemIds' => $ids];
            $retval[$key] = $this->generateCustomerLetter($letter, $additionalProps);
            $bureauAddressMap[$key] = $this->getBureauAddressHTML($key);
        }

        $customer = $this->getCustomer($customerId);
        echo json_encode([
            'data' => $retval,
            'letter_id' => $letter->id,
            'bureau_address' => $bureauAddressMap,
            'customer' => [
                'name' => $customer->first_name . ' ' . $customer->last_name,
                'address' => $this->getCustomerAddress($customerId),
            ],
        ]);
    }

    private function underscoreCase(string $string)
    {
        return str_replace(' ', '_', strtolower($string));
    }

    private function getCustomerAddress($customerId)
    {
        $customer = $this->getCustomer($customerId);
        $address = [
            $customer->mail_add,
            $customer->city,
            $customer->state,
            $customer->zip_code,
        ];

        $address = array_filter($address, function ($data) {
            return !is_null($data) && !empty($data);
        });

        return empty($address) ? null : implode(', ', $address);
    }

    private function getBureauAddressHTML(string $bureau)
    {
        if ($this->underscoreCase($bureau) === 'equifax') {
            $retval = '<div>';
            $retval .= '<div>Equifax Information Services LLC</div>';
            $retval .= '<div>P.O. Box 740256</div>';
            $retval .= '<div>Atlanta, GA 30374-0256</div>';
            $retval .= '</div>';
            return $retval;
        }

        if ($this->underscoreCase($bureau) === 'experian') {
            $retval = '<div>';
            $retval .= '<div>Experian</div>';
            $retval .= '<div>P.O. Box 4500</div>';
            $retval .= '<div>Allen, TX 75013</div>';
            $retval .= '</div>';
            return $retval;
        }

        if ($this->underscoreCase($bureau) === 'trans_union') {
            $retval = '<div>';
            $retval .= '<div>TransUnion LLC Consumer Dispute Center</div>';
            $retval .= '<div>PO Box 2000</div>';
            $retval .= '<div>Chester, PA 19016</div>';
            $retval .= '</div>';
            return $retval;
        }
    }
}
