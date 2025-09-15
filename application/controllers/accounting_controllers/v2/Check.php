<?php
class Check extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Serversidetable_model', 'serverside_table');
    }

    private function saveCheckCategories($check_id, $prefix)
    {
        $category_ids = $this->input->post($prefix . 'CategoryOptionsRow');
        $descriptions = $this->input->post($prefix . 'CategoryDescriptionRow');
        $amounts = $this->input->post($prefix . 'CategoryAmountRow');
        $billables = $this->input->post($prefix . 'CategoryBillableRow') ?? [];
        $taxes = $this->input->post($prefix . 'CategoryTaxRow') ?? [];
        $customer_ids = $this->input->post($prefix . 'CategoryCustomerRow');

        if (!is_array($category_ids)) return;

        foreach ($category_ids as $i => $category_id) {
            if (!empty($category_id)) {
                $this->db->insert('accounting_vendor_transaction_categories', [
                    'transaction_type' => 'Check',
                    'transaction_id' => $check_id,
                    'expense_account_id' => $category_id,
                    'description' => $descriptions[$i] ?? '',
                    'amount' => $amounts[$i] ?? 0,
                    'billable' => isset($billables[$i]) ? 1 : 0,
                    'tax' => isset($taxes[$i]) ? 1 : 0,
                    'customer_id' => $customer_ids[$i] ?? null
                ]);
            }
        }
    }

    private function saveCheckItems($check_id, $prefix)
    {
        $item_ids = $this->input->post($prefix . 'ItemOptionsRow');
        $descriptions = $this->input->post($prefix . 'ItemDescriptionRow');
        $quantities = $this->input->post($prefix . 'ItemQtyRow');
        $rates = $this->input->post($prefix . 'ItemRateRow');
        $amounts = $this->input->post($prefix . 'ItemAmountRow');
        $billables = $this->input->post($prefix . 'ItemBillableRow') ?? [];
        $taxes = $this->input->post($prefix . 'ItemTaxRow') ?? [];
        $customer_ids = $this->input->post($prefix . 'ItemCustomerRow');

        if (!is_array($item_ids)) return;

        foreach ($item_ids as $i => $item_id) {
            if (!empty($item_id)) {
                $this->db->insert('accounting_vendor_transaction_items', [
                    'transaction_type' => 'Check',
                    'transaction_id' => $check_id,
                    'item_id' => $item_id,
                    'quantity' => $quantities[$i] ?? 0,
                    'rate' => $rates[$i] ?? 0,
                    'total' => $amounts[$i] ?? 0,
                    'isTax' => isset($taxes[$i]) ? 1 : 0,
                    'isBillable' => isset($billables[$i]) ? 1 : 0,
                    'customer_id' => $customer_ids[$i] ?? null,
                    'description' => $descriptions[$i] ?? ''
                ]);
            }
        }
    }

    private function saveCheckAttachments($check_id, $prefix, $is_update = false)
    {
        $company_id = logged('company_id');
        $upload_dir = 'uploads/accounting/expenses/';
        $file_input = $prefix . 'Attachments';
        
        $result = [
            'success' => [],
            'errors' => []
        ];

        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                $result['errors'][] = 'Failed to create upload directory.';
                return $result;
            }
        }

        if ($is_update) {
            $existing_sql = "
                SELECT aa.id, aa.stored_name 
                FROM accounting_attachments aa
                INNER JOIN accounting_attachment_links aal ON aa.id = aal.attachment_id
                WHERE aal.type = 'Check' AND aal.linked_id = ?
            ";
            
            $existing = $this->db->query($existing_sql, [$check_id])->result();
            
            foreach ($existing as $attachment) {
                $file_path = $upload_dir . $attachment->stored_name;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            $this->db->where('type', 'Check');
            $this->db->where('linked_id', $check_id);
            $this->db->delete('accounting_attachment_links');
            
            foreach ($existing as $attachment) {
                $this->db->where('id', $attachment->id);
                $this->db->delete('accounting_attachments');
            }
        }

        if (!isset($_FILES[$file_input]) || empty($_FILES[$file_input]['name'][0])) {
            return $result;
        }

        $attachments = $_FILES[$file_input];
        $total_files = count($attachments['name']);
        
        for ($i = 0; $i < $total_files; $i++) {
            $error_code = $attachments['error'][$i];
            
            if ($error_code !== UPLOAD_ERR_OK) {
                $error_messages = [
                    UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize directive',
                    UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE directive',
                    UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
                    UPLOAD_ERR_NO_FILE => 'No file was uploaded',
                    UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
                    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                    UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
                ];
                $error_msg = $error_messages[$error_code] ?? 'Unknown upload error';
                $result['errors'][] = "File '{$attachments['name'][$i]}' failed to upload: $error_msg";
                continue;
            }

            $tmp_name = $attachments['tmp_name'][$i];
            $original_name = $attachments['name'][$i];
            $file_size = $attachments['size'][$i];
            $file_extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
            
            $stored_name = "CHECK{$check_id}_" . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8) . '.' . $file_extension;
            $target_path = $upload_dir . $stored_name;

            if (!move_uploaded_file($tmp_name, $target_path)) {
                $result['errors'][] = "Failed to move file '{$original_name}' to target directory.";
                continue;
            }

            $attachment_data = [
                'company_id' => $company_id,
                'type' => 'Check',
                'uploaded_name' => $original_name,
                'stored_name' => $stored_name,
                'file_extension' => $file_extension,
                'size' => $file_size,
                'linked_to_count' => 1,
                'status' => 1
            ];

            if (!$this->db->insert('accounting_attachments', $attachment_data)) {
                $result['errors'][] = "Failed to insert attachment metadata for '{$original_name}' into database.";
                unlink($target_path);
                continue;
            }

            $attachment_id = $this->db->insert_id();

            $link_data = [
                'type' => 'Check',
                'attachment_id' => $attachment_id,
                'linked_id' => $check_id,
                'order_no' => $i + 1
            ];

            if (!$this->db->insert('accounting_attachment_links', $link_data)) {
                $result['errors'][] = "Failed to link attachment '{$original_name}' to check.";
                unlink($target_path);
                $this->db->delete('accounting_attachments', ['id' => $attachment_id]);
                continue;
            }

            $result['success'][] = $original_name;
        }

        return $result;
    }

    public function index()
    {      
        $this->page_data['page']->title = "Check";
        $this->load->view('v2/pages/accounting/check/check', $this->page_data);
    }

    public function getChecksServerside()
    {
        $company_id = logged('company_id');

        $this->serverside_table->initializeTable(
            "accounting_check_view",
            array('payee_name', 'date_created', 'check_no', 'chart_of_account_name', 'memo', 'payment_date', 'total_amount', 'status',),
            array('payee_name', 'date_created', 'check_no', 'chart_of_account_name', 'memo', 'payment_date', 'total_amount', 'status',),
            array('date_created' => 'DESC'),
            array(
                'company_id' => $company_id, 
                'status !=' => 0
            )
        );

        // 'id', 'company_id', 'payee_type', 'payee_id', 'payee_name', 'account_id', 'account_name', 'chart_of_account_id', 'chart_of_account_name', 'mailing_address', 'payment_date', 'check_no', 'to_print_status', 'permit_no', 'tags', 'memo', 'total_amount', 'recurring_status', 'status', 'date_created', 'date_updated'

        $getData = $this->serverside_table->getRows($this->input->post());

        $data = array();
        $i = $this->input->post('start');

        foreach ($getData as $getDatas) {
            $checkboxSelection = "<input class='form-check-input verticalAlign checkEntryCheckbox' data-check_id='$getDatas->id' type='checkbox'>";
            $payee_name = !empty($getDatas->payee_name) ? $getDatas->payee_name : '';
            $date_created = !empty($getDatas->date_created) ? date('m/d/Y', strtotime($getDatas->date_created)) : '<small class="text-muted fst-italic">Not Specified</small>';
            $check_no = !empty($getDatas->check_no) ? $getDatas->check_no : '<small class="text-muted fst-italic">Print Later</small>';

            $chart_of_account_name = "<select class='checkExpenseCategory' data-check_id='$getDatas->id' data-chart_of_account_id='$getDatas->chart_of_account_id' data-status='$getDatas->status'></select>";

            $memo = !empty($getDatas->memo) ? $getDatas->memo : '<small class="text-muted fst-italic">Not Specified</small>';
            $payment_date = !empty($getDatas->payment_date) ? date('m/d/Y', strtotime($getDatas->payment_date)) : '<small class="text-muted fst-italic">Not Specified</small>';
            $total_amount = isset($getDatas->total_amount) ? (($getDatas->total_amount < 0 ? '-$' : '$') . number_format(abs($getDatas->total_amount), 2)) : '<small class="text-muted fst-italic">Not Specified</small>';

            switch ($getDatas->status) {
                case 0:
                    $status = "<span class='badge bg-secondary'>DELETED</span>";
                    $memo .= " <small class='text-muted fst-italic'> &mdash; DELETED</small>";
                    break;
                case 1:
                    $status = "<span class='badge bg-success'>PAID</span>";
                    break;
                case 2:
                    $status = "<span class='badge bg-danger'>VOIDED</span>";
                    $memo .= " <small class='text-muted fst-italic'>&mdash; VOIDED</small>";
                    break;
            }
            
            $attachments = '';
            if (!empty($getDatas->file)) {
                $files = explode(',', $getDatas->file);
                $attachments .= "<div class='text-nowrap'>";
                foreach ($files as $file) {
                    $file_number++;
                    $file = trim($file);
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $url = base_url('uploads/accounting/expenses/') . $file;
                    $attachments .= "
                        <a href='$url' target='_blank' class='text-decoration-none d-inline-block'>
                            <div class='text-center border rounded px-1 py-0 bg-light' style='min-width:37px; display:inline-block;'>
                                <small class='fw-semibold text-dark'>.$ext</small>
                            </div>
                        </a>
                    ";
                }
                $attachments .= "</div>";
            } else {
                $attachments = '<small class="text-nowrap text-muted fst-italic">Not Specified</small>';
            }


            $menuActions = "
                <div class='dropdown'>
                    <button class='btn dropdown-toggle text-muted' type='button' id='checkMenuButton' data-bs-toggle='dropdown' aria-expanded='false'><i class='fas fa-ellipsis-v'></i></button>
                    <ul class='dropdown-menu' aria-labelledby='checkMenuButton'>
                        <li><a class='dropdown-item editCheck' href='javascript:void(0);' data-check_id='$getDatas->id'>Edit</a></li>
                        <li><a class='dropdown-item copyCheck href='javascript:void(0);' data-check_id='$getDatas->id'>Copy</a></li>
                        <li><a class='dropdown-item voidCheck' href='javascript:void(0);' data-check_id='$getDatas->id'>Void</a></li>
                        <li><a class='dropdown-item deleteCheck' href='javascript:void(0);' data-check_id='$getDatas->id'>Delete</a></li>
                    </ul>
                </div>
            ";

            $data[] = array(
                $checkboxSelection,
                $payee_name,
                $date_created,
                $check_no,
                $chart_of_account_name,
                $memo,
                $payment_date,
                $total_amount,
                $status,
                $attachments,
                $menuActions
            );
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getRecentChecksServerside($type)
    {
        $company_id = logged('company_id');
        $recentType = ($type == "recentAddTable") ? "recentAddEntryCheckbox" : "recentEditEntryCheckbox" ;

        $this->serverside_table->initializeTable(
            "accounting_check_view",
            array('check_no', 'payee_name', 'chart_of_account_name', 'total_amount', 'date_created'),
            array('check_no', 'payee_name', 'chart_of_account_name', 'total_amount', 'date_created'),
            array('date_created' => 'DESC'),
            array(
                'company_id' => $company_id, 
                'status =' => 1,
                "YEAR(date_created)" => date('Y')
            )
        );

        $getData = $this->serverside_table->getRows($this->input->post());

        $data = array();
        $i = $this->input->post('start');

        foreach ($getData as $getDatas) {
            $checkboxSelection = "<input class='form-check-input verticalAlign $recentType' data-check_id='$getDatas->id' type='checkbox'>";
            $check_no = !empty($getDatas->check_no) ? $getDatas->check_no : '<small class="text-muted fst-italic">Print Later</small>';
            $payee_name = !empty($getDatas->payee_name) ? $getDatas->payee_name : '';
            $total_amount = isset($getDatas->total_amount) ? (($getDatas->total_amount < 0 ? '-$' : '$') . number_format(abs($getDatas->total_amount), 2)) : '<small class="text-muted fst-italic">Not Specified</small>';
            $date_created = !empty($getDatas->date_created) ? date('m/d/Y', strtotime($getDatas->date_created)) : '<small class="text-muted fst-italic">Not Specified</small>';

            $data[] = array(
                $checkboxSelection,
                $check_no,
                $payee_name,
                $total_amount,
                $date_created,
            );
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getAccountDetails($category)
    {
        $company_id = logged('company_id');

        $this->db->select('
            accounting_chart_of_accounts.id AS id,
            accounting_chart_of_accounts.company_id AS company_id,
            accounting_chart_of_accounts.account_id AS account_id,
            account.account_name AS account_name,
            accounting_chart_of_accounts.name AS chart_of_account_name,
            accounting_chart_of_accounts.balance AS balance,
            accounting_chart_of_accounts.active AS active_status,
            accounting_chart_of_accounts.created_at AS date_created,
            accounting_chart_of_accounts.updated_at AS date_updated
        ');
        $this->db->from('accounting_chart_of_accounts');
        $this->db->join('account', 'account.id = accounting_chart_of_accounts.account_id', 'left');
        $this->db->where('accounting_chart_of_accounts.company_id', $company_id);

        if (strtolower($category) !== 'all') {
            $this->db->where('account.account_name', $category);
        }

        $this->db->order_by('account.account_name', 'ASC');
        $query = $this->db->get();
        $results = $query->result();

        $categoryData = [];

        foreach ($results as $row) {
            $categoryData[] = [
                'value'    => $row->id,
                'text'     => $row->chart_of_account_name,
                'balance'  => $row->balance,
                'optgroup' => $row->account_name ?? 'Uncategorized'
            ];
        }

        echo json_encode($categoryData);
    }

    public function getPayeeDetails($category)
    {
        $company_id = logged('company_id');

        switch ($category) {
            case 'employee':
                $query = $this->db->query("
                    SELECT
                        users.id AS id,
                        users.company_id AS company_id,
                        'employee' AS payee_type,
                        CONCAT(users.FName, ' ', users.LName) AS payee_name,
                        users.address AS payee_street,
                        users.city AS payee_city,
                        users.state AS payee_state,
                        users.postal_code AS payee_zip_code
                    FROM users
                        WHERE users.company_id = {$company_id};
                ");
                break;
            case 'customer':
                $query = $this->db->query("
                    SELECT 
                        acs_profile.prof_id AS id,
                        acs_profile.company_id AS company_id,
                        'customer' AS payee_type,
                        CONCAT(acs_profile.first_name, ' ', acs_profile.last_name) AS payee_name,
                        acs_profile.mail_add AS payee_street,
                        acs_profile.city AS payee_city,
                        acs_profile.state AS payee_state,
                        acs_profile.zip_code AS payee_zip_code
                    FROM acs_profile
                        WHERE acs_profile.company_id = {$company_id};
                ");
                break;
            case 'vendor':
                $query = $this->db->query("
                    SELECT 
                        accounting_vendors.id AS id,
                        accounting_vendors.company_id AS company_id,
                        'vendor' AS payee_type,
                        CONCAT(accounting_vendors.display_name) AS payee_name,
                        accounting_vendors.street AS payee_street,
                        accounting_vendors.city AS payee_city,
                        accounting_vendors.state AS payee_state,
                        accounting_vendors.zip AS payee_zip_code
                    FROM accounting_vendors
                        WHERE accounting_vendors.company_id = {$company_id};
                ");
                break;
            case 'all':
                $query = $this->db->query("
                    SELECT
                        users.id AS id,
                        users.company_id AS company_id,
                        'employee' AS payee_type,
                        CONCAT(users.FName, ' ', users.LName) AS payee_name,
                        users.address AS payee_street,
                        users.city AS payee_city,
                        users.state AS payee_state,
                        users.postal_code AS payee_zip_code
                    FROM users
                        WHERE users.company_id = {$company_id}
                    UNION
                    SELECT 
                        acs_profile.prof_id AS id,
                        acs_profile.company_id AS company_id,
                        'customer' AS payee_type,
                        CONCAT(acs_profile.first_name, ' ', acs_profile.last_name) AS payee_name,
                        acs_profile.mail_add AS payee_street,
                        acs_profile.city AS payee_city,
                        acs_profile.state AS payee_state,
                        acs_profile.zip_code AS payee_zip_code
                    FROM acs_profile
                        WHERE acs_profile.company_id = {$company_id}
                    UNION
                    SELECT 
                        accounting_vendors.id AS id,
                        accounting_vendors.company_id AS company_id,
                        'vendor' AS payee_type,
                        CONCAT(accounting_vendors.display_name) AS payee_name,
                        accounting_vendors.street AS payee_street,
                        accounting_vendors.city AS payee_city,
                        accounting_vendors.state AS payee_state,
                        accounting_vendors.zip AS payee_zip_code
                    FROM accounting_vendors
                        WHERE accounting_vendors.company_id = {$company_id};
                ");
                break;
        }
        
        $data = $query->result();
        echo json_encode($data);
    }

    public function getTagDetails()
    {
        $tags = [
            ['tag' => 'Rent', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Utilities', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Office Supplies', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Travel', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Meals & Entertainment', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Marketing', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Insurance', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Repairs & Maintenance', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Professional Fees', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Bank Charges', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Software Subscription', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Training & Development', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Freight & Shipping', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Fuel & Transportation', 'optgroup' => 'Expense & Payment'],
            ['tag' => 'Legal Fees', 'optgroup' => 'Expense & Payment'],

            ['tag' => 'Vendor Payment', 'optgroup' => 'Payee & Transaction'],
            ['tag' => 'Employee Reimbursement', 'optgroup' => 'Payee & Transaction'],
            ['tag' => 'Contractor Fee', 'optgroup' => 'Payee & Transaction'],
            ['tag' => 'Partner Distribution', 'optgroup' => 'Payee & Transaction'],
            ['tag' => 'Loan Repayment', 'optgroup' => 'Payee & Transaction'],
            ['tag' => 'Customer Refund', 'optgroup' => 'Payee & Transaction'],
            ['tag' => 'Tax Remittance', 'optgroup' => 'Payee & Transaction'],
            ['tag' => 'Government Filing', 'optgroup' => 'Payee & Transaction'],
            ['tag' => 'Intercompany Transfer', 'optgroup' => 'Payee & Transaction'],

            ['tag' => 'January Expenses', 'optgroup' => 'Time & Period'],
            ['tag' => 'Q1 Settlement', 'optgroup' => 'Time & Period'],
            ['tag' => 'Year-End Bonus', 'optgroup' => 'Time & Period'],
            ['tag' => 'Fiscal Adjustment', 'optgroup' => 'Time & Period'],
            ['tag' => 'Deferred Expense', 'optgroup' => 'Time & Period'],
            ['tag' => 'Prepaid Expense', 'optgroup' => 'Time & Period'],
            ['tag' => 'Accrual Entry', 'optgroup' => 'Time & Period'],

            ['tag' => 'Accounts Payable', 'optgroup' => 'Accounting & Ledger'],
            ['tag' => 'Accounts Receivable', 'optgroup' => 'Accounting & Ledger'],
            ['tag' => 'Capital Expenditure', 'optgroup' => 'Accounting & Ledger'],
            ['tag' => 'Operating Expense', 'optgroup' => 'Accounting & Ledger'],
            ['tag' => 'Depreciation', 'optgroup' => 'Accounting & Ledger'],
            ['tag' => 'Asset Purchase', 'optgroup' => 'Accounting & Ledger'],
            ['tag' => 'Liability Settlement', 'optgroup' => 'Accounting & Ledger'],
            ['tag' => 'Equity Distribution', 'optgroup' => 'Accounting & Ledger'],
            ['tag' => 'Journal Adjustment', 'optgroup' => 'Accounting & Ledger'],

            ['tag' => 'HR', 'optgroup' => 'Department & Project'],
            ['tag' => 'Finance', 'optgroup' => 'Department & Project'],
            ['tag' => 'IT', 'optgroup' => 'Department & Project'],
            ['tag' => 'Sales', 'optgroup' => 'Department & Project'],
            ['tag' => 'Admin', 'optgroup' => 'Department & Project'],
            ['tag' => 'R&D', 'optgroup' => 'Department & Project'],
            ['tag' => 'Marketing Campaign A', 'optgroup' => 'Department & Project'],
            ['tag' => 'Project Phoenix', 'optgroup' => 'Department & Project'],
            ['tag' => 'Event Sponsorship', 'optgroup' => 'Department & Project'],

            ['tag' => 'Invoice', 'optgroup' => 'Purpose & Compliance'],
            ['tag' => 'Refund', 'optgroup' => 'Purpose & Compliance'],
            ['tag' => 'Deposit Correction', 'optgroup' => 'Purpose & Compliance'],
            ['tag' => 'Tax Payment', 'optgroup' => 'Purpose & Compliance'],
            ['tag' => 'Equipment Purchase', 'optgroup' => 'Purpose & Compliance'],
            ['tag' => 'Audit Adjustment', 'optgroup' => 'Purpose & Compliance'],
            ['tag' => 'Compliance Filing', 'optgroup' => 'Purpose & Compliance'],
            ['tag' => '990 Tag (for nonprofits)', 'optgroup' => 'Purpose & Compliance'],
            ['tag' => 'Grant Allocation', 'optgroup' => 'Purpose & Compliance']
        ];

        echo json_encode($tags);
    }

    public function getItemDetails($category)
    {
        $company_id = logged('company_id');

        switch (strtolower($category)) {
            case 'product':
                $whereType = "AND LOWER(items.type) = 'product'";
                break;
            case 'service':
                $whereType = "AND LOWER(items.type) = 'service'";
                break;
            case 'product_service':
                $whereType = "AND LOWER(items.type) IN ('product', 'service')";
                break;
            case 'all':
            default:
                $whereType = "";
                break;
        }

        $query = $this->db->query("
            SELECT 
                items.id AS id, 
                items.company_id AS company_id, 
                items.title AS item_name, 
                items.type AS item_type, 
                items.price AS item_price, 
                items_has_storage_loc.qty AS item_quantity, 
                items_has_storage_loc.id AS location_id, 
                items_has_storage_loc.name AS location_name
            FROM items
            LEFT JOIN items_has_storage_loc 
                ON items_has_storage_loc.item_id = items.id
            WHERE items.company_id = {$company_id} {$whereType} AND items.is_active = 1
        ");

        $data = $query->result();

        $normalizedData = array_map(function($item) {
            $item->item_type = ucfirst(strtolower($item->item_type));
            return $item;
        }, $data);

        echo json_encode($normalizedData);
    }

    public function getLastSettings()
    {
        $company_id = logged('company_id');

        $sql = "
            SELECT
                (SELECT bank_account_id
                FROM accounting_check
                WHERE company_id = {$company_id}
                ORDER BY created_at DESC
                LIMIT 1) AS bank_account_id,

                COALESCE(NULLIF(
                    (SELECT check_no
                    FROM accounting_check
                    WHERE company_id = {$company_id} AND check_no != ''
                    ORDER BY created_at DESC
                    LIMIT 1), ''), '1') AS last_check_no,

                COALESCE(NULLIF(
                    (SELECT permit_no
                    FROM accounting_check
                    WHERE company_id = {$company_id} AND permit_no != ''
                    ORDER BY created_at DESC
                    LIMIT 1), ''), '1') AS last_permit_no,

                COALESCE(NULLIF(
                    (SELECT tags
                    FROM accounting_check
                    WHERE company_id = {$company_id} AND tags != ''
                    ORDER BY created_at DESC
                    LIMIT 1), ''), '1') AS tags,

                (SELECT to_print
                FROM accounting_check
                WHERE company_id = {$company_id}
                ORDER BY created_at DESC
                LIMIT 1) AS to_print
        ";
        
        $query = $this->db->query($sql);
        $data = $query->row();

        echo json_encode($data);
    }

    public function getCheckDetails()
    {
        $company_id = logged('company_id');
        $post = $this->input->post();
        $check_id = $post['check_id'];

        if (!$check_id) { 
            return; 
        }

        $sql = "
            SELECT 
                ac.*, 
                (
                    SELECT check_no 
                    FROM accounting_check 
                    WHERE company_id = {$company_id} AND check_no != '' AND check_no != '0' 
                    ORDER BY created_at DESC 
                    LIMIT 1
                ) AS last_check_no,
                (
                    SELECT permit_no 
                    FROM accounting_check 
                    WHERE company_id = {$company_id} AND permit_no != '' AND permit_no != '0' 
                    ORDER BY created_at DESC 
                    LIMIT 1
                ) AS last_permit_no
            FROM accounting_check ac
            WHERE ac.company_id = {$company_id} AND ac.id = {$check_id}
            LIMIT 1
        ";

        $check_data = $this->db->query($sql)->row();

        if (!$check_data) { 
            return; 
        }

        $categories = $this->db
            ->where('transaction_type', 'Check')
            ->where('transaction_id', $check_id)
            ->get('accounting_vendor_transaction_categories')
            ->result();

        $items = $this->db
            ->where('transaction_type', 'Check')
            ->where('transaction_id', $check_id)
            ->get('accounting_vendor_transaction_items')
            ->result();

        $attachments_sql = "
            SELECT 
                aa.id,
                aa.uploaded_name,
                aa.stored_name,
                aa.file_extension,
                aa.size,
                aal.order_no
            FROM accounting_attachments aa
            INNER JOIN accounting_attachment_links aal ON aa.id = aal.attachment_id
            WHERE aal.type = 'Check' 
            AND aal.linked_id = {$check_id}
            AND aa.status = 1
            ORDER BY aal.order_no ASC
        ";
        
        $attachments = $this->db->query($attachments_sql)->result();

        $formatted_attachments = [];
        foreach ($attachments as $attachment) {
            $file_path = 'uploads/accounting/expenses/' . $attachment->stored_name;
            $full_path = FCPATH . $file_path;
            
            $formatted_attachments[] = [
                'id' => $attachment->id,
                'source' => base_url("uploads/accounting/expenses/$attachment->stored_name"),
                'options' => [
                    'type' => 'local',
                    'file' => [
                        'name' => $attachment->uploaded_name,
                        'stored_name' => $attachment->stored_name,
                        'size' => $attachment->size,
                        'type' => file_exists($full_path) ? mime_content_type($full_path) : 'application/octet-stream'
                    ],
                    'metadata' => [
                        'poster' => base_url($file_path)
                    ]
                ]
            ];
        }

        $response = [
            "check"       => $check_data,
            "category"    => $categories,
            "items"       => $items,
            "attachments" => $formatted_attachments
        ];

        echo json_encode($response);
    }

    public function getCheckDetailsForPrint()
    {
        $company_id = logged('company_id');
        $post = $this->input->post();

        if (empty($post['check_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'No check_id provided']);
            return;
        }

        $check_ids = is_array($post['check_id']) ? $post['check_id'] : explode(',', $post['check_id']);
        $check_ids = array_map('intval', $check_ids);
        $check_ids_str = implode(',', $check_ids);

        $sql = "
            SELECT 
                accounting_check_view.id,
                accounting_check_view.payment_date,
                accounting_check_view.total_amount,
                accounting_check_view.payee_name,
                accounting_check_view.chart_of_account_name
            FROM accounting_check_view
            WHERE accounting_check_view.company_id = {$company_id} 
            AND accounting_check_view.id IN ({$check_ids_str})
        ";

        $check_data = $this->db->query($sql)->result_array();

        echo json_encode($check_data);
    }

    public function updateAccountCategory()
    {
        $post = $this->input->post();

        $check_id = $post['check_id'] ?? null;
        $chart_of_account_id = $post['chart_of_account_id'] ?? null;

        if (!$check_id || !$chart_of_account_id) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required data.']);
            return;
        }

        $this->db->where('id', $check_id);
        $updated = $this->db->update('accounting_check', [
            'bank_account_id' => $chart_of_account_id
        ]);

        if ($updated) {
            echo true;
        }
    }

    public function addCheck()
    {
        $company_id = logged('company_id');

        $data = [
            'company_id' => $company_id,
            'payee_id' => $this->input->post('checkAddPayee'),
            'payee_type' => $this->input->post('checkAddPayeeType'),
            'bank_account_id' => $this->input->post('checkAddBankAccount'),
            'mailing_address' => $this->input->post('checkAddMailingAddress'),
            'payment_date' => $this->input->post('checkAddPaymentDate'),
            'check_no' => $this->input->post('checkAddNo'),
            'permit_no' => $this->input->post('checkAddPermitNo'),
            'to_print' => $this->input->post('checkAddPrintLater') ? 1 : 0,
            'tags' => implode(',', array_map('trim', (array) $this->input->post('checkAddTag'))),
            'memo' => $this->input->post('checkAddMemo'),
            'total_amount' => array_sum((array) $this->input->post('checkAddItemAmountRow')) + array_sum((array) $this->input->post('checkAddCategoryAmountRow')),
            'status' => 1
        ];

        if ($this->db->insert('accounting_check', $data)) {
            $check_id = $this->db->insert_id();

            $this->saveCheckCategories($check_id, 'checkAdd');
            $this->saveCheckItems($check_id, 'checkAdd');
            $attachment_result = $this->saveCheckAttachments($check_id, 'checkAdd');

            if (!empty($attachment_result['errors'])) {
                echo json_encode([
                    'status' => 'partial',
                    'message' => 'Check saved successfully, but some attachments failed to upload.',
                    'errors' => $attachment_result['errors'],
                    'successful_attachments' => $attachment_result['success']
                ]);
            } else {
                echo 1;
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to save check.'
            ]);
        }
    }

    public function editCheck()
    {
        $company_id = logged('company_id');
        $check_id = $this->input->post('check_id');

        if (!$check_id) {
            echo json_encode(["status" => "error", "message" => "Missing check ID"]);
            return;
        }

        $tags = $this->input->post('checkEditTag');
        if (is_array($tags)) {
            $tags = implode(',', array_map('trim', $tags));
        } else {
            $tags = $tags ? trim($tags) : '';
        }

        $category_amounts = array_sum((array) $this->input->post('checkEditCategoryAmountRow'));
        $item_amounts = array_sum((array) $this->input->post('checkEditItemAmountRow'));

        $check_data = [
            'payee_id' => $this->input->post('checkEditPayee'),
            'payee_type' => $this->input->post('checkEditPayeeType'),
            'bank_account_id' => $this->input->post('checkEditBankAccount'),
            'mailing_address' => $this->input->post('checkEditMailingAddress'),
            'payment_date' => $this->input->post('checkEditPaymentDate'),
            'check_no' => $this->input->post('checkEditNo'),
            'to_print' => $this->input->post('checkEditPrintLater') ? 1 : 0,
            'permit_no' => $this->input->post('checkEditPermitNo'),
            'tags' => $tags,
            'memo' => $this->input->post('checkEditMemo'),
            'total_amount' => $category_amounts + $item_amounts,
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $this->db->where('company_id', $company_id);
        $this->db->where('id', $check_id);
        if (!$this->db->update('accounting_check', $check_data)) {
            echo json_encode(["status" => "error", "message" => "Failed to update check"]);
            return;
        }

        $this->db->where('transaction_type', 'Check');
        $this->db->where('transaction_id', $check_id);
        $this->db->delete('accounting_vendor_transaction_categories');

        $this->db->where('transaction_type', 'Check');
        $this->db->where('transaction_id', $check_id);
        $this->db->delete('accounting_vendor_transaction_items');

        $this->saveCheckCategories($check_id, 'checkEdit');
        $this->saveCheckItems($check_id, 'checkEdit');
        $attachment_result = $this->saveCheckAttachments($check_id, 'checkEdit', true);

        if (!empty($attachment_result['errors'])) {
            echo json_encode([
                'status' => 'partial',
                'message' => 'Check updated successfully, but some attachments failed.',
                'errors' => $attachment_result['errors']
            ]);
        } else {
            echo 1;
        }
    }

    public function voidCheck()
    {
        $post = $this->input->post();

        $check_id = $post['check_id'] ?? null;

        if (!$check_id) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required data.']);
            return;
        }

        $this->db->where('id', $check_id);
        $updated = $this->db->update('accounting_check', [
            'total_amount' => 0,
            'status' => 2
        ]);

        if ($updated) {
            echo true;
        }
    }

    public function deleteCheck()
    {
        $post = $this->input->post();

        $check_id = $post['check_id'] ?? null;

        if (!$check_id) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required data.']);
            return;
        }

        $this->db->where('id', $check_id);
        $updated = $this->db->update('accounting_check', [
            'status' => 0
        ]);

        if ($updated) {
            echo true;
        }
    }

    public function voidMultipleChecks()
    {
        $post = $this->input->post();
        $check_ids = $post['check_ids'] ?? [];

        if (empty($check_ids)) {
            echo json_encode(['status' => 'error', 'message' => 'No IDs received.']);
            return;
        }

        $this->db->where_in('id', $check_ids);
        $updated = $this->db->update('accounting_check', [
            'total_amount' => 0,
            'status' => 2
        ]);

        if ($updated) {
            echo json_encode(['status' => 'success']);
        }
    }

    public function deleteMultipleChecks()
    {
        $post = $this->input->post();
        $check_ids = $post['check_ids'] ?? [];

        if (empty($check_ids)) {
            echo json_encode(['status' => 'error', 'message' => 'No IDs received.']);
            return;
        }

        $this->db->where_in('id', $check_ids);
        $updated = $this->db->update('accounting_check', [
            'status' => 0
        ]);

        if ($updated) {
            echo json_encode(['status' => 'success']);
        }
    }

    public function checkAddModal()
    {
        $company_id = logged('company_id');
        $post = $this->input->post();
        $check_id = $post['check_id'] ?? null;    

        $this->load->view('v2/pages/accounting/check/checkAddModal', null);
    }

    public function checkEditModal()
    {
        $company_id = logged('company_id');
        $post = $this->input->post();
        $check_id = $post['check_id'] ?? null;
        $this->page_data['check_id'] = $check_id;
        $this->load->view('v2/pages/accounting/check/checkEditModal', $this->page_data);
    }

    public function assignNewCheckNumber()
    {
        $company_id = logged('company_id');
        $post = $this->input->post();

        $check_ids = is_array($post['check_id']) ? $post['check_id'] : explode(',', $post['check_id']);
        $check_ids = array_map('intval', $check_ids);

        if (empty($check_ids)) {
            echo json_encode(false);
            return;
        }

        $sql = "
            SELECT
                COALESCE(NULLIF(
                    (SELECT check_no
                    FROM accounting_check
                    WHERE company_id = {$company_id} AND check_no != ''
                    ORDER BY created_at DESC
                    LIMIT 1), ''), '0') AS last_check_no
        ";

        $query = $this->db->query($sql);
        $row   = $query->row();
        $last_check_no = intval($row->last_check_no);

        $new_check_no = $last_check_no;
        $allUpdated   = true;

        foreach ($check_ids as $id) {
            $new_check_no++;
            $this->db->where('id', $id);
            $this->db->where('company_id', $company_id);
            $update = $this->db->update('accounting_check', [
                'check_no' => $new_check_no,
                'to_print' => 0
            ]);

            if (!$update) {
                $allUpdated = false;
            }
        }

        echo json_encode($allUpdated);
    }

}   