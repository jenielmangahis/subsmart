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
        ]);

        add_footer_js([
            'assets/textEditor/summernote-bs4.js',
            'assets/js/esign/esigneditor/wizard.js',

            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.6/purify.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js',
        ]);

        $this->load->view('esign/esigneditor/wizard', $this->page_data);
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

    public function getPlaceholders()
    {
        return [
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
                    $this->db->where('prof_id', $param->customerId);
                    $this->db->select('suffix');
                    $customer = $this->db->get('acs_profile')->row();
                    return $customer ? $customer->suffix : null;
                },
            ],
            [
                'code' => 'client_first_name',
                'description' => 'First name of client',
                'get' => function (PlaceholderGetParam $param) {
                    $this->db->where('prof_id', $param->customerId);
                    $this->db->select('first_name');
                    $customer = $this->db->get('acs_profile')->row();
                    return $customer ? $customer->first_name : null;
                },
            ],
            [
                'code' => 'client_middle_name',
                'description' => 'Middle name of client',
                'get' => function (PlaceholderGetParam $param) {
                    $this->db->where('prof_id', $param->customerId);
                    $this->db->select('middle_name');
                    $customer = $this->db->get('acs_profile')->row();
                    return $customer ? $customer->middle_name : null;
                },
            ],
            [
                'code' => 'client_last_name',
                'description' => 'Last name of client',
                'get' => function (PlaceholderGetParam $param) {
                    $this->db->where('prof_id', $param->customerId);
                    $this->db->select('last_name');
                    $customer = $this->db->get('acs_profile')->row();
                    return $customer ? $customer->last_name : null;
                },
            ],
            [
                'code' => 'client_address',
                'description' => 'Address of client',
            ],
            [
                'code' => 'client_previous_address',
                'description' => 'Previous address of client',
            ],
            [
                'code' => 'bdate',
                'description' => 'Birth date of client',
                'get' => function (PlaceholderGetParam $param) {
                    $this->db->where('prof_id', $param->customerId);
                    $this->db->select('date_of_birth');
                    $customer = $this->db->get('acs_profile')->row();
                    return $customer ? $customer->date_of_birth : null;
                },
            ],
            [
                'code' => 'ss_number',
                'description' => 'Last 4 of SSN of client',
                'get' => function (PlaceholderGetParam $param) {
                    $this->db->where('prof_id', $param->customerId);
                    $this->db->select('ssn');
                    $customer = $this->db->get('acs_profile')->row();
                    return $customer ? $customer->ssn : null;
                },
            ],
            [
                'code' => 't_no',
                'description' => 'Telephone number of client',
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
            ],
            [
                'code' => 'bureau_name',
                'description' => 'Credit bureau name',
            ],
            [
                'code' => 'bureau_address',
                'description' => 'Credit bureau name and address',
            ],
            [
                'code' => 'account_number',
                'description' => 'Account number',
            ],
            [
                'code' => 'dispute_item_and_explanation',
                'description' => 'Dispute items and explanation',
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
    }

    public function apiSeedPlaceholders()
    {
        $placeholders = $this->getPlaceholders();
        $placeholders = array_map(function ($placeholder) {
            return ['code' => $placeholder['code'], 'description' => $placeholder['description']];
        }, $placeholders);
        $this->db->insert_batch('esign_editor_placeholders', $placeholders);
    }

    public function apiGetPlaceholders()
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getUserPlaceholders()]);
    }

    private function getUserPlaceholders()
    {
        $this->db->where('user_id', logged('id'));
        $this->db->or_group_start();
        $this->db->where('user_id', null);
        $this->db->where('company_id', null);
        $this->db->group_end();
        return $this->db->get('esign_editor_placeholders')->result();
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
        echo json_encode(['data' => $placeholder]);
    }

    public function apiGetLetterByCategoryId($categoryId)
    {
        $this->db->where('category_id', $categoryId);
        $categories = $this->db->get('esign_editor_letters')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $categories]);
    }

    public function apiGetCustomer($id)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getCustomer($id)]);
    }

    private function getCustomer($id)
    {
        $this->db->where('prof_id', $id);
        return $this->db->get('acs_profile')->row();
    }

    public function apiExportLetterAsPDF()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $letterContent = null;
        if (array_key_exists('content', $payload)) {
            $letterContent = $payload['content'];
        } else {
            $letter = $this->getLetter($payload['letter_id']);
            $letterContent = $letter->content;
        }

        $placeholders = $this->getPlaceholders();
        $placeholderParam = new PlaceholderGetParam(
            (int) $payload['customer_id'],
            (int) logged('company_id')
        );

        foreach ($placeholders as $placeholder) {
            if (!array_key_exists('get', $placeholder)) {
                continue;
            }

            ['code' => $code, 'get' => $getter] = $placeholder;

            $callback = function () use ($getter, $placeholderParam) {
                return $getter($placeholderParam);
            };

            $letterContent = preg_replace_callback(
                "|{{$code}}|",
                $callback,
                $letterContent
            );

        }

        echo json_encode(['data' => [
            'content' => $letterContent,
        ]]);
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
}
