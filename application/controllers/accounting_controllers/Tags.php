<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('tags_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('vendors_model');
        $this->load->model('accounting_bank_deposit_model');
        $this->load->model('expenses_model');
        $this->load->model('chart_of_accounts_model');
        $this->load->model('account_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');

        $this->page_data['page']->title = 'Tags';
        $this->page_data['page']->parent = 'Banking';

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css",
            "assets/css/accounting/accounting_includes/receive_payment.css",
            "assets/css/accounting/accounting_includes/customer_sales_receipt_modal.css",
            "assets/css/accounting/accounting_includes/create_charge.css",
            "assets/css/accounting/invoices_page.css",
            "assets/css/accounting/accounting_includes/send_reminder_by_batch_modal.css"
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/js/accounting/modal-forms1.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js",
            "assets/js/accounting/sales/invoices_page.js",
            "assets/js/accounting/sales/customer_includes/send_reminder_by_batch_modal.js"
        ));

		$this->page_data['menu_name'] =
            array(
                // array("Dashboard",	array()),
                // array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Cash Flow", array()),
                array("Expenses", array('Expenses', 'Vendors')),
                array("Sales", array('Overview', 'All Sales', 'Estimates', 'Customers', 'Deposits', 'Work Order', 'Invoice', 'Jobs', 'Products and services')),
                array("Payroll", array('Overview', 'Employees', 'Contractors', "Workers' Comp", 'Benifits')),
                array("Reports", array()),
                array("Taxes", array("Sales Tax", "Payroll Tax")),
                // array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts", "Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                // array('/accounting/banking',array()),
                // array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array('/accounting/cashflowplanner', array()),
                array("", array('/accounting/expenses', '/accounting/vendors')),
                array("", array('/accounting/sales-overview', '/accounting/all-sales', '/accounting/newEstimateList', '/accounting/customers', '/accounting/deposits', '/accounting/listworkOrder', '/accounting/invoices', '/accounting/jobs', '/accounting/products-and-services')),
                array("", array('/accounting/payroll-overview', '/accounting/employees', '/accounting/contractors', '/accounting/workers-comp', '#')),
                array('/accounting/reports', array()),
                array("", array('/accounting/salesTax', '/accounting/payrollTax')),
                // array('#',  array()),
                array("", array('/accounting/chart-of-accounts', '/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-credit-card", "fa-money", "fa-dollar", "fa-bar-chart", "fa-minus-circle", "fa-file", "fa-calculator");
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId(logged('company_id'));
        $this->page_data['invoices'] = $this->invoice_model->getAllData(logged('company_id'));
        $this->page_data['clients'] = $this->invoice_model->getclientsData(logged('company_id'));
        $this->page_data['invoices_sales'] = $this->invoice_model->getAllDataSales(logged('company_id'));
        $this->page_data['OpenInvoices'] = $this->invoice_model->getAllOpenInvoices(logged('company_id'));
        $this->page_data['InvOverdue'] = $this->invoice_model->InvOverdue(logged('company_id'));
        $this->page_data['getAllInvPaid'] = $this->invoice_model->getAllInvPaid(logged('company_id'));
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->workorder_model->getPackagelist(logged('company_id'));
        $this->page_data['estimates'] = $this->estimate_model->getAllByCompanynDraft(logged('company_id'));
        $this->page_data['sales_receipts'] = $this->accounting_sales_receipt_model->getAllByCompany(logged('company_id'));
        $this->page_data['credit_memo'] = $this->accounting_credit_memo_model->getAllByCompany(logged('company_id'));
        $this->page_data['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
        $this->page_data['statements'] = $this->accounting_statements_model->getAllComp(logged('company_id'));
        $this->page_data['rpayments'] = $this->accounting_receive_payment_model->getReceivePaymentsByComp(logged('company_id'));
        $this->page_data['checks'] = $this->vendors_model->get_check_by_comp(logged('company_id'));
        $this->page_data['payment_methods'] = $this->accounting_receive_payment_model->get_payment_methods(logged('company_id'));
        $this->page_data['deposits_to'] = $this->accounting_receive_payment_model->get_deposits_to(logged('company_id'));

        $this->page_data['invoicesItems'] = $this->invoice_model->getInvoicesItems(logged('company_id'));
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/banking/tags/list.js"
            // "assets/js/accounting/banking/tags/tags.js"
        ));

        if(!empty(get('search'))) {
            $search = get('search');
            $this->page_data['search'] = $search;
        }

        $getTags = $this->tags_model->getTags();

        $tags = [];
        foreach($getTags as $key => $tag) {
            if($tag['type'] !== 'group-tag') {
                if(!empty($search)) {
                    if (stripos($tag['name'], $search) !== false) {
                        $tags[] = [
                            'id' => $tag['id'],
                            'name' => $tag['name'],
                            'transactions' => '',
                            'type' => $tag['type'],
                            'parentIndex' => $tag['parentIndex'],
                        ];

                        if($tag['type'] === 'group') {
                            $tags[array_key_last($tags)]['tags'] = $tag['tags'];
                        }
                    } else {
                        if($tag['type'] === 'group') {
                            $groupTags = array_filter($tag['tags'], function($value, $key) use ($search) {
                                return stripos($value['name'], $search) !== false;
                            }, ARRAY_FILTER_USE_BOTH);

                            if(count($groupTags) > 0) {
                                $tags[] = [
                                    'id' => $tag['id'],
                                    'name' => $tag['name'],
                                    'transactions' => '',
                                    'type' => $tag['type'],
                                    'parentIndex' => $tag['parentIndex'],
                                ];

                                $tags[array_key_last($tags)]['tags'] = $groupTags;
                            }
                        }
                    }
                } else {
                    $tags[] = [
                        'id' => $tag['id'],
                        'name' => $tag['name'],
                        'transactions' => '',
                        'type' => $tag['type'],
                        'parentIndex' => $tag['parentIndex'],
                    ];

                    if($tag['type'] === 'group') {
                        $tags[array_key_last($tags)]['tags'] = $tag['tags'];
                    }
                }
            }
        }

        $this->page_data['tags'] = $tags;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // $this->load->view('accounting/tags/index', $this->page_data);
        $this->load->view('v2/pages/accounting/banking/tags/list', $this->page_data);
    }

    public function get_group_tags()
    {
        $groupTags = $this->tags_model->getGroup();

        $return = [];

        foreach($groupTags as $group) {
            $return['results'][] = [
                'id' => $group['id'],
                'text' => $group['name']
            ];
        }

        echo json_encode($return);
    }

    public function load_all_tags()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $search = $post['columns'][0]['search']['value'];
        $getTags = $this->tags_model->getTags();

        $tags = [];
        foreach($getTags as $key => $tag) {
            if ($search !== "") {
                if (stripos($tag['name'], $search) !== false) {
                    if ($tag['type'] === 'group-tag') {
                        $groupIdExists = array_search($getTags[$tag['parentIndex']]['id'], array_column($tags, 'id'));

                        if ($groupIdExists === false || $groupIdExists !== false && $getTags[$groupIdExists]['type'] !== 'group') {
                            $childTags = array_filter($getTags[$tag['parentIndex']]['tags'], function($v, $k) use ($search) {
                                return stripos($v['name'], $search) !== false;
                            }, ARRAY_FILTER_USE_BOTH);

                            $childs = [];
                            foreach($childTags as $childTag) {
                                $childs[] = $childTag;
                            }

                            $tags[] = [
                                'id' => $getTags[$tag['parentIndex']]['id'],
                                'name' => $getTags[$tag['parentIndex']]['name'],
                                'transactions' => '',
                                'type' => $getTags[$tag['parentIndex']]['type'],
                                'parentIndex' => $getTags[$tag['parentIndex']]['parentIndex'],
                                'tags' => $childs
                            ];
                        }

                        $idExists = array_search($tag['id'], array_column($tags, 'id'));

                        if ($idExists === false || $idExists !== false && $getTags[$idExists]['type'] !== 'group-tag') {
                            $groupIndex = array_key_last($tags);
                            $tags[] = [
                                'id' => $tag['id'],
                                'name' => $tag['name'],
                                'transactions' => '',
                                'type' => $tag['type'],
                                'parentIndex' => $tag['parentIndex']
                            ];
                        }
                    } elseif ($tag['type'] === 'group') {
                        $groupIdExists = array_search($getTags[$tag['parentIndex']]['id'], array_column($tags, 'id'));

                        if ($groupIdExists === false || $groupIdExists !== false && $getTags[$groupIdExists]['type'] !== 'group') {
                            $tags[] = [
                                'id' => $tag['id'],
                                'name' => $tag['name'],
                                'transactions' => '',
                                'type' => $tag['type'],
                                'parentIndex' => $tag['parentIndex'],
                                'tags' => $tag['tags']
                            ];

                            $parentIndex = array_key_last($tags);
                            foreach ($tag['tags'] as $groupTag) {
                                $tags[] = [
                                    'id' => $groupTag['id'],
                                    'name' => $groupTag['name'],
                                    'transactions' => '',
                                    'type' => 'group-tag',
                                    'parentIndex' => $parentIndex
                                ];
                            }
                        }
                    } else {
                        $tags[] = [
                            'id' => $tag['id'],
                            'name' => $tag['name'],
                            'transactions' => '',
                            'type' => $tag['type'],
                            'parentIndex' => $tag['parentIndex']
                        ];
                    }
                }
            } else {
                $tags[] = [
                    'id' => $tag['id'],
                    'name' => $tag['name'],
                    'transactions' => '',
                    'type' => $tag['type'],
                    'parentIndex' => $tag['parentIndex'],
                ];

                if($tag['type'] === 'group') {
                    $tags[array_key_last($tags)]['tags'] = $tag['tags'];
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($getTags),
            'recordsFiltered' => count($getTags),
            'data' => array_slice($tags, 0, 50)
        ];

        echo json_encode($result);
    }

    public function delete($id, $type)
    {
        $result = [];

        $delete = $this->tags_model->delete($id, $type);
        $result['success'] = $delete;
        $result['message'] = $delete ? 'Deleted' : 'Failed';

        echo json_encode($result);
        exit;
    }

    public function update($id, $type)
    {
        $result = [];
        $name = $this->input->post('name');

        $update = $this->tags_model->update($id, $name, $type);
        $result['success'] = $update;
        $result['message'] = $update ? 'Updated' : 'Failed';

        echo json_encode($result);
        exit;
    }

    public function add_group_tag()
    {
        $company_id  = getLoggedCompanyID();
        $new_data = array(
            'name' => $this->input->post('tags_group_name'),
            'company_id' => $company_id,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        );

        $tags = $this->tags_model->addtagGroup($new_data);

        $return = [
            'data' => $tags,
            'success' => $tags !== null ? true : false,
            'message' => $tags !== null ? 'Success' : 'Error'
        ];

        echo json_encode($return);
    }

    public function add_tag()
    {
        $company_id  = getLoggedCompanyID();
        $group_id = $this->input->post('group_id');

        $new_data = array(
            'name' => $this->input->post('tag_name'),
            'group_tag_id' => isset($group_id) && $group_id ? $group_id : null,
            'company_id' => $company_id,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        );
        
        // if (isset($group_id) && $group_id) $new_data['group_tag_id'] = $group_id;


        $tags = $this->tags_model->add($new_data);

        $return = [
            'data' => $tags,
            'success' => $tags !== null ? true : false,
            'message' => $tags !== null ? 'Success' : 'Error'
        ];

        echo json_encode($return);
    }

    public function delete_tags()
    {
        $tags = $this->input->post('tags');

        foreach($tags as $tag) {
            $explode = explode('_', $tag);
            $id = $explode[array_key_last($explode)];
            if(stripos($tag, 'tag') !== false) {
                $this->tags_model->delete($id, 'tag');
            } else {
                $this->tags_model->delete($id, 'group');
            }
        }
    }
    
    public function transactions()
    {
        add_footer_js(array(
            "assets/js/v2/accounting/banking/tags/transactions.js"
            // "assets/js/accounting/banking/tags/tags-transactions.js"
        ));

        $groups = [];
        $tagGroups = $this->tags_model->getGroup();

        foreach($tagGroups as $group) {
            $groupTags = $this->tags_model->get_group_tags($group['id']);

            if(count($groupTags) > 0) {
                $group['tags'] = $groupTags;

                $groups[] = $group;
            }
        }

        $tags = $this->tags_model->getCompanyTags();
        $tags = array_column($tags, 'id');

        if(!empty(get('type'))) {
            $this->page_data['type'] = get('type');

            if(get('type') === 'money-in') {
                $this->page_data['moneyIn'] = get('money-in');
            } else {
                $this->page_data['moneyOut'] = get('money-out');
            }
        }

        if(!empty(get('date'))) {
            $this->page_data['date'] = get('date');
            $this->page_data['fromDate'] = get('from');
            $this->page_data['toDate'] = get('to');
        }

        if(!empty(get('contact'))) {
            $this->page_data['contact']->value = '';
            $this->page_data['contact']->name = '';
        }

        $filter = [
            'company_id' => logged('company_id'),
            'untagged' => !empty(get('untagged')),
            'type' => !empty(get('type')) ? get('type') : 'all',
            'tags' => $tags,
            'from' => !empty(get('from')) ? get('from') : date("Y-m-d", strtotime("-1 year")),
            'to' => !empty(get('to')) ? get('to') : date("Y-m-d")
        ];

        $this->page_data['transactions'] = $this->get_transactions($filter);
        $this->page_data['page']->title = 'Transactions by tag';
        $this->page_data['groups'] = $groups;
        $this->page_data['ungrouped'] = $this->tags_model->get_ungrouped();
        $this->page_data['untagged'] = $this->input->get('untagged') === 'true';
        $this->load->view('v2/pages/accounting/banking/tags/transactions', $this->page_data);
        // $this->load->view('accounting/tags/transactions', $this->page_data);
    }

    public function load_transactions()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $order = $post['order'][0]['dir'];
        $column = $post['order'][0]['column'];
        $columnName = $post['columns'][$column]['name'];
        $start = $post['start'];
        $limit = $post['length'];
        $date = $post['date'];
        $from = $post['from'];
        $to = $post['to'];
        $contact = $post['contact'];

        $ungrouped = array_filter($post['ungrouped'], function($v, $k) {
            return $v !== 'all';
        }, ARRAY_FILTER_USE_BOTH);

        $grouped = array_filter($post['groups'], function($v, $k) {
            return count($v) > 0;
        }, ARRAY_FILTER_USE_BOTH);

        $tags = [];
        foreach($grouped as $group) {
            foreach($group as $id) {
                if(stripos($id, "all") === false) {
                    $tags[] = $id;
                }
            }
        }

        foreach($ungrouped as $tagId) {
            $tags[] = $tagId;
        }

        $filter = [
            'company_id' => logged('company_id'),
            'untagged' => $post['untagged'],
            'tags' => $tags,
            'type' => $post['type'],
            'money-in' => $post['money_in'],
            'money-out' => $post['money_out']
        ];

        if($date !== 'all') {
            $filter['from'] = $from === '' ? null : date("Y-m-d", strtotime($from));
            $filter['to'] = $to === '' ? null : date("Y-m-d", strtotime($to));
        }

        if($contact !== '') {
            $cont = explode('-', $contact);
            $filter['contact_type'] = $cont[0];
            $filter['contact_id'] = $cont[1];
        }
        
        $data = $this->get_transactions($filter);

        usort($data, function($a, $b) use ($order, $columnName) {
            switch($columnName) {
                case 'date' :
                    if($order === 'asc') {
                        return strtotime($a['date']) > strtotime($b['date']);
                    } else {
                        return strtotime($a['date']) < strtotime($b['date']);
                    }
                break;
                default :
                    if($order === 'asc') {
                        return strcmp($a[$columnName], $b[$columnName]);
                    } else {
                        return strcmp($b[$columnName], $a[$columnName]);
                    }
                break;
            }
        });

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    private function get_transactions($filter)
    {
        $data = [];
        switch($filter['type']) {
            case 'all' :
                $data = $this->get_cc_credits($data, $filter);
                $data = $this->get_vendor_credits($data, $filter);
                $data = $this->get_deposits($data, $filter);
                $data = $this->get_expenses($data, $filter);
                $data = $this->get_bills($data, $filter);
                $data = $this->get_checks($data, $filter);
                $data = $this->get_cc_expenses($data, $filter);
                $data = $this->get_purchase_orders($data, $filter);
            break;
            case 'money-in' :
                switch($filter['money-in']) {
                    case 'all' :
                        $data = $this->get_cc_credits($data, $filter);
                        $data = $this->get_vendor_credits($data, $filter);
                        $data = $this->get_deposits($data, $filter);
                    break;
                    case 'invoice' :

                    break;
                    case 'sales-receipt' :

                    break;
                    case 'estimate' :

                    break;
                    case 'cc-credit' :
                        $data = $this->get_cc_credits($data, $filter);
                    break;
                    case 'vendor-credit' :
                        $data = $this->get_vendor_credits($data, $filter);
                    break;
                    case 'credit-memo' :

                    break;
                    case 'activity-charge' :

                    break;
                    case 'deposit' :
                        $data = $this->get_deposits($data, $filter);
                    break;
                }
            break;
            case 'money-out' :
                switch($filter['money-out']) {
                    case 'all' :
                        $data = $this->get_expenses($data, $filter);
                        $data = $this->get_bills($data, $filter);
                        $data = $this->get_checks($data, $filter);
                        $data = $this->get_cc_expenses($data, $filter);
                        $data = $this->get_purchase_orders($data, $filter);
                        $data = $this->get_vendor_credits($data, $filter);
                    break;
                    case 'expense' :
                        $data = $this->get_expenses($data, $filter);
                    break;
                    case 'bill' :
                        $data = $this->get_bills($data, $filter);
                    break;
                    case 'credit-memo' :

                    break;
                    case 'refund-receipt' :

                    break;
                    case 'cash-purchase' :

                    break;
                    case 'check' :
                        $data = $this->get_checks($data, $filter);
                    break;
                    case 'cc-expense' :
                        $data = $this->get_cc_expenses($data, $filter);
                    break;
                    case 'purchase-order' :
                        $data = $this->get_purchase_orders($data, $filter);
                    break;
                    case 'vendor-credit' :
                        $data = $this->get_vendor_credits($data, $filter);
                    break;
                    case 'activity-credit' :

                    break;
                }
            break;
        }

        return $data;
    }

    private function get_cc_credits($data = [], $filter)
    {
        $ccCredits = $this->tags_model->get_cc_credits($filter);

        foreach($ccCredits as $ccCredit) {
            switch ($ccCredit->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($ccCredit->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $tags = $this->tags_model->get_transaction_tags('CC Credit', $ccCredit->id);

            foreach($tags as $key => $tag) {
                if($tag->group_tag_id !== "0" && $tag->group_tag_id !== "" && !is_null($tag->group_tag_id)) {
                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                    $tags[$key]->group_name = $group->name;
                }
            }

            $data[] = [
                'id' => $ccCredit->id,
                'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                'from_to' => $payeeName,
                'category' => $this->category_col('Credit Card Credit', $ccCredit->id),
                'memo' => $ccCredit->memo,
                'type' => 'CC Credit',
                'amount' => $ccCredit->total_amount,
                'tags' => $tags
            ];
        }

        return $data;
    }

    private function get_vendor_credits($data = [], $filter)
    {
        $vCredits = $this->tags_model->get_vendor_credits($filter);

        foreach($vCredits as $vCredit) {
            $tags = $this->tags_model->get_transaction_tags('Vendor Credit', $vCredit->id);

            foreach($tags as $key => $tag) {
                if($tag->group_tag_id !== "0" && $tag->group_tag_id !== "" && !is_null($tag->group_tag_id)) {
                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                    $tags[$key]->group_name = $group->name;
                }
            }

            $data[] = [
                'id' => $vCredit->id,
                'date' => date("m/d/Y", strtotime($vCredit->payment_date)),
                'from_to' => $this->vendors_model->get_vendor_by_id($vCredit->vendor_id)->display_name,
                'category' => $this->category_col('Vendor Credit', $vCredit->id),
                'memo' => $vCredit->memo,
                'type' => 'Vendor Credit',
                'amount' => $vCredit->total_amount,
                'tags' => $tags
            ];
        }

        return $data;
    }
    
    private function get_deposits($data = [], $filter)
    {
        $deposits = $this->tags_model->get_deposits($filter);

        foreach($deposits as $deposit) {
            $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);

            $from = '';
            if(count($funds) === 1) {
                $category = $this->chart_of_accounts_model->getName($funds[0]->received_from_account_id);
                switch ($funds[0]->received_from_key) {
                    case 'vendor':
                        $payee = $this->vendors_model->get_vendor_by_id($funds[0]->received_from_id);
                        $from = $payee->display_name;
                    break;
                    case 'customer':
                        $payee = $this->accounting_customers_model->get_by_id($funds[0]->received_from_id);
                        $from = $payee->first_name . ' ' . $payee->last_name;
                    break;
                    case 'employee':
                        $payee = $this->users_model->getUser($funds[0]->received_from_id);
                        $from = $payee->FName . ' ' . $payee->LName;
                    break;
                }
            } else if(count($funds) > 1) {
                $category = '-Split-';

                $flag = true;
                foreach($funds as $fund) {
                    switch ($fund->received_from_key) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($fund->received_from_id);
                            $payee = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($fund->received_from_id);
                            $payee = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($fund->received_from_id);
                            $payee = $payee->FName . ' ' . $payee->LName;
                        break;
                    }
                    if($from === '') {
                        $from = $payee;
                    }

                    if($from !== $payee) {
                        $from = '';
                        break;
                    }
                }
            }

            $tags = $this->tags_model->get_transaction_tags('Deposit', $deposit->id);

            foreach($tags as $key => $tag) {
                if($tag->group_tag_id !== "0" && $tag->group_tag_id !== "" && !is_null($tag->group_tag_id)) {
                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                    $tags[$key]->group_name = $group->name;
                }
            }

            $data[] = [
                'id' => $deposit->id,
                'date' => date("m/d/Y", strtotime($deposit->date)),
                'from_to' => $from,
                'category' => $category,
                'memo' => $deposit->memo,
                'type' => 'Deposit',
                'amount' => $deposit->total_amount,
                'tags' => $tags
            ];
        }

        return $data;
    }

    private function get_expenses($data = [], $filter)
    {
        $accountTypes = $this->account_model->getAccounts();
        foreach($accountTypes as $type) {
            if($type->account_name === 'Credit Card') {
                $filter['not_acc_type'] = $type->id;
            }
        }

        $expenses = $this->tags_model->get_expenses($filter);

        foreach($expenses as $expense) {
            switch ($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $tags = $this->tags_model->get_transaction_tags('Expense', $expense->id);

            foreach($tags as $key => $tag) {
                if($tag->group_tag_id !== "0" && $tag->group_tag_id !== "" && !is_null($tag->group_tag_id)) {
                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                    $tags[$key]->group_name = $group->name;
                }
            }

            $data[] = [
                'id' => $expense->id,
                'date' => date("m/d/Y", strtotime($expense->payment_date)),
                'from_to' => $payeeName,
                'category' => $this->category_col('Expense', $expense->id),
                'memo' => $expense->memo,
                'type' => 'Expense',
                'amount' => $expense->total_amount,
                'tags' => $tags
            ];
        }

        return $data;
    }

    private function get_bills($data = [], $filter)
    {
        $bills = $this->tags_model->get_bills($filter);

        foreach($bills as $bill) {
            $tags = $this->tags_model->get_transaction_tags('Bill', $bill->id);

            foreach($tags as $key => $tag) {
                if($tag->group_tag_id !== "0" && $tag->group_tag_id !== "" && !is_null($tag->group_tag_id)) {
                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                    $tags[$key]->group_name = $group->name;
                }
            }

            $data[] = [
                'id' => $bill->id,
                'date' => date("m/d/Y", strtotime($bill->bill_date)),
                'from_to' => $this->vendors_model->get_vendor_by_id($bill->vendor_id)->display_name,
                'category' => $this->category_col('Bill', $bill->id),
                'memo' => $bill->memo,
                'type' => 'Bill',
                'amount' => $bill->total_amount,
                'tags' => $tags
            ];
        }

        return $data;
    }

    private function get_checks($data = [], $filter)
    {
        $checks = $this->tags_model->get_checks($filter);

        foreach($checks as $check) {
            switch ($check->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($check->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $tags = $this->tags_model->get_transaction_tags('Check', $check->id);

            foreach($tags as $key => $tag) {
                if($tag->group_tag_id !== "0" && $tag->group_tag_id !== "" && !is_null($tag->group_tag_id)) {
                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                    $tags[$key]->group_name = $group->name;
                }
            }

            $data[] = [
                'id' => $check->id,
                'date' => date("m/d/Y", strtotime($check->payment_date)),
                'from_to' => $payeeName,
                'category' => $this->category_col('Check', $check->id),
                'memo' => $check->memo,
                'type' => 'Check',
                'amount' => $check->total_amount,
                'tags' => $tags
            ];
        }

        return $data;
    }

    private function get_cc_expenses($data = [], $filter)
    {
        $accountTypes = $this->account_model->getAccounts();
        foreach($accountTypes as $type) {
            if($type->account_name === 'Credit Card') {
                $filter['acc_type'] = $type->id;
            }
        }

        $ccExpenses = $this->tags_model->get_cc_expenses($filter);

        foreach($ccExpenses as $ccExpense) {
            switch ($ccExpense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($ccExpense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($ccExpense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($ccExpense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $tags = $this->tags_model->get_transaction_tags('Expense', $ccExpense->id);

            foreach($tags as $key => $tag) {
                if($tag->group_tag_id !== "0" && $tag->group_tag_id !== "" && !is_null($tag->group_tag_id)) {
                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                    $tags[$key]->group_name = $group->name;
                }
            }

            $data[] = [
                'id' => $ccExpense->id,
                'date' => date("m/d/Y", strtotime($ccExpense->payment_date)),
                'from_to' => $payeeName,
                'category' => $this->category_col('Expense', $ccExpense->id),
                'memo' => $ccExpense->memo,
                'type' => 'Credit card expense',
                'amount' => $ccExpense->total_amount,
                'tags' => $tags
            ];
        }

        return $data;
    }

    private function get_purchase_orders($data = [], $filter)
    {
        $purchaseOrders = $this->tags_model->get_purchase_orders($filter);

        foreach($purchaseOrders as $purchaseOrder) {
            $tags = $this->tags_model->get_transaction_tags('Purchase Order', $purchaseOrder->id);

            foreach($tags as $key => $tag) {
                if($tag->group_tag_id !== "0" && $tag->group_tag_id !== "" && !is_null($tag->group_tag_id)) {
                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                    $tags[$key]->group_name = $group->name;
                }
            }

            $data[] = [
                'id' => $purchaseOrder->id,
                'date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                'from_to' => $this->vendors_model->get_vendor_by_id($purchaseOrder->vendor_id)->display_name,
                'category' => $this->category_col('Purchase Order', $purchaseOrder->id),
                'memo' => $purchaseOrder->memo,
                'type' => 'Purchase Order',
                'amount' => $purchaseOrder->total_amount,
                'tags' => $tags
            ];
        }

        return $data;
    }

    private function category_col($transactionType, $transactionId)
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);
        
        $category = '';

        if(count($categories) > 1) {
            $category = '-Split-';
        } else if(count($categories) === 1) {
            $category = $this->chart_of_accounts_model->getName($categories[0]->expense_account_id);
        }

        return $category;
    }

    public function print_transactions()
    {
        $post = $this->input->post();
        $order = $post['order'];
        $columnName = $post['column'];

        $tags = [];
        if(!is_null($post['grouped'])) {
            foreach($post['grouped'] as $tagId) {
                $tags[] = $tagId;
            }
        }

        if(!is_null($post['ungrouped'])) {
            foreach($post['ungrouped'] as $tagId) {
                $tags[] = $tagId;
            }
        }

        $filter = [
            'company_id' => logged('company_id'),
            'untagged' => $post['untagged'],
            'tags' => $tags,
            'type' => $post['type'],
            'money-in' => $post['money_in'],
            'money-out' => $post['money_out']
        ];

        if($date !== 'all') {
            $filter['from'] = $post['from'] === '' ? null : date("Y-m-d", strtotime($post['from']));
            $filter['to'] = $post['to'] === '' ? null : date("Y-m-d", strtotime($post['to']));
        }

        if($contact !== '') {
            $cont = explode('-', $contact);
            $filter['contact_type'] = $cont[0];
            $filter['contact_id'] = $cont[1];
        }
        
        $data = $this->get_transactions($filter);

        usort($data, function($a, $b) use ($order, $columnName) {
            switch($columnName) {
                case 'date' :
                    if($order === 'asc') {
                        return strtotime($a['date']) > strtotime($b['date']);
                    } else {
                        return strtotime($a['date']) < strtotime($b['date']);
                    }
                break;
                default :
                    if($order === 'asc') {
                        return strcmp($a[$columnName], $b[$columnName]);
                    } else {
                        return strcmp($b[$columnName], $a[$columnName]);
                    }
                break;
            }
        });

        $tableHtml = "<h3 style='text-align: center;'>Transactions by tag</h3>";
        $tableHtml .= "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Date</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>From/To</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Category</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Memo</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Amount</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Tags</th>";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";
        foreach($data as $transaction) {
            $amount = '$'.$transaction['amount'];
            $amount = str_replace('$-', '-$', $amount);

            $tagCol = '<ul>';
            foreach($transaction['tags'] as $tag) {
                $name = $tag->name;
                if($tag->group_name !== null) {
                    $name = "$tag->group_name: $name";
                }

                $tagCol .= "<li>$name</li>";
            }
            $tagCol .= '</ul>';

            $tableHtml .= "<tr>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['date']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['from_to']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['category']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['memo']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['type']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$amount."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$tagCol."</td>";
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }

    public function add_tags()
    {
        $post = $this->input->post();
        $transactions = $post['transactions'];
        $tags = $post['tags'];

        foreach($transactions as $transaction) {
            $transaction = explode('-', $transaction);
            switch($transaction[0]) {
                case 'deposit' :
                    $transactionType = 'Deposit';
                break;
                case 'expense' :
                    $transactionType = 'Expense';
                break;
                case 'check' :
                    $transactionType = 'Check';
                break;
                case 'bill' :
                    $transactionType = 'Bill';
                break;
                case 'purchase_order' :
                    $transactionType = 'Purchase Order';
                break;
                case 'vendor_credit' :
                    $transactionType = 'Vendor Credit';
                break;
                case 'cc_credit' :
                    $transactionType = 'CC Credit';
                break;
            }

            $tranTags = $this->tags_model->get_transaction_tags($transactionType, $transaction[1]);

            foreach($tranTags as $key => $tag) {
                if(!isset($tags[$key])) {
                    $this->tags_model->unlink_tag(['transaction_type' => $transactionType, 'tag_id' => $tag->id, 'transaction_id' => $transaction[1]]);
                }
            }

            $order = 1;
            foreach($tags as $tagId) {
                $linkTagData = [
                    'transaction_type' => $transactionType,
                    'transaction_id' => $transaction[1],
                    'tag_id' => $tagId,
                    'order_no' => $order
                ];

                if($tranTags[$key] === null) {
                    $linkTagId = $this->tags_model->link_tag($linkTagData);
                } else {
                    $linkTagId = $this->tags_model->update_link($linkTagData);
                }

                $order++;
            }
        }
    }

    public function load_tags_to_remove()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $search = $post['search'];

        $transactions = $post['transactions'];
        $groups = $this->tags_model->getGroup();
        $ungrouped = $this->tags_model->get_ungrouped();

        $existingTags = [];
        foreach($transactions as $transaction) {
            $transaction = explode("-", $transaction);
            switch($transaction[0]) {
                case 'deposit' :
                    $transactionType = 'Deposit';
                break;
                case 'expense' :
                    $transactionType = 'Expense';
                break;
                case 'check' :
                    $transactionType = 'Check';
                break;
                case 'bill' :
                    $transactionType = 'Bill';
                break;
                case 'purchase_order' :
                    $transactionType = 'Purchase Order';
                break;
                case 'vendor_credit' :
                    $transactionType = 'Vendor Credit';
                break;
                case 'cc_credit' :
                    $transactionType = 'CC Credit';
                break;
            }

            $tranTags = $this->tags_model->get_transaction_tags($transactionType, $transaction[1]);
            foreach($tranTags as $tag) {
                $existingTags[] = $tag->id;
            }
        }

        $data = [];
        foreach($groups as $group) {
            $tagsExisted = $this->tags_model->get_tag_by_ids_and_group_id($existingTags, $group['id']);

            $found = [];
            foreach($tagsExisted as $groupTag) {
                if($search !== '') {
                    if(stripos($groupTag->name, $search) !== false) {
                        $found[] = $groupTag;
                    }
                } else {
                    $found[] = $groupTag;
                }
            }

            if(count($found) > 0) {
                $data[] = [
                    'id' => $group['id'],
                    'type' => 'group',
                    'name' => $group['name']
                ];

                foreach($found as $gTag) {
                    $count = array_filter($existingTags, function($v, $k) use ($gTag, $search) {
                        return $gTag->id === $v;
                    }, ARRAY_FILTER_USE_BOTH);

                    $data[] = [
                        'id' => $gTag->id,
                        'type' => 'group-tag',
                        'name' => $gTag->name,
                        'count' => count($count)
                    ];
                }
            }
        }

        $ungroupedExists = $this->tags_model->get_tag_by_ids_and_group_id($existingTags, null);
        $foundUngrouped = [];
        foreach($ungroupedExists as $ungrouped) {
            if($search !== '') {
                if(stripos($ungrouped->name, $search) !== false) {
                    $foundUngrouped[] = $ungrouped;
                }
            } else {
                $foundUngrouped[] = $ungrouped;
            }
        }

        if(count($foundUngrouped) > 0) {
            $data[] = [
                'id' => 'ungrouped',
                'type' => 'ungrouped-group',
                'name' => 'Ungrouped',
            ];

            foreach($foundUngrouped as $ugTag) {
                $count = array_filter($existingTags, function($v, $k) use ($ugTag) {
                    return $ugTag->id === $v;
                }, ARRAY_FILTER_USE_BOTH);

                $data[] = [
                    'id' => $ugTag->id,
                    'type' => 'ungrouped-tag',
                    'name' => $ugTag->name,
                    'count' => count($count)
                ];
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $post['start'], $post['length'])
        ];

        echo json_encode($result);
    }

    public function remove_tags()
    {
        $post = $this->input->post();

        foreach($post['transactions'] as $transaction) {
            $transaction = explode("-", $transaction);
            switch($transaction[0]) {
                case 'deposit' :
                    $transactionType = 'Deposit';
                break;
                case 'expense' :
                    $transactionType = 'Expense';
                break;
                case 'check' :
                    $transactionType = 'Check';
                break;
                case 'bill' :
                    $transactionType = 'Bill';
                break;
                case 'purchase_order' :
                    $transactionType = 'Purchase Order';
                break;
                case 'vendor_credit' :
                    $transactionType = 'Vendor Credit';
                break;
                case 'cc_credit' :
                    $transactionType = 'CC Credit';
                break;
            }

            $unlinkTags = $this->tags_model->unlink_multiple_transaction_tags($transactionType, $transaction[1], $post['tags']);
        }
    }
}