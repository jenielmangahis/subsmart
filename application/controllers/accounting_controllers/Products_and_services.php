<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_and_services extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('accounting_attachments_model');
        $this->load->model('TaxRates_model');
        $this->load->model('vendors_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');

        $this->page_data['page']->title = 'Products and Services';
        $this->page_data['page']->parent = 'Sales';

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
            "assets/plugins/jqueryUI/jquery-ui.min.js",
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
            "assets/js/accounting/sales/products-and-services.js"
        ));

        $products = $this->items_model->getItemsWithFilter(['type' => ['inventory', 'Inventory', 'product', 'Product']]);

        $outOfStock = 0;
        $lowStock = 0;
        foreach($products as $product) {
            $totalQty = $this->items_model->countQty($product->id);
            $reorderPoint = intval($product->re_order_points);

            $outOfStock += $totalQty === 0 ? 1 : 0;
            $lowStock += $totalQty <= $reorderPoint ? 1 : 0;
        }

        $this->page_data['low_stock_count'] = $lowStock;
        $this->page_data['out_of_stock'] = $outOfStock;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Product and Services";
        $this->load->view('accounting/products_and_services', $this->page_data);
    }

    public function load()
    {
        $postData = json_decode(file_get_contents('php://input'), true);
        $column = $postData['order'][0]['column'];
        $order = $postData['order'][0]['dir'];
        $columnName = $postData['columns'][$column]['name'];
        $start = $postData['start'];
        $limit = $postData['length'];
        $search = $postData['columns'][0]['search']['value'];
        $data = [];

        switch($columnName) {
            case 'name' :
                $column = 'title';
            break;
            case 'type' : 
                $column = 'type';
            break;
            case 'sales_desc' :
                $column = 'description';
            break;
            case 'sales_price' :
                $column = 'price';
            break;
            case 'cost' :
                $column = 'cost';
            break;
            case 'reorder_point' :
                $column = 're_order_points';
            break;
            default : 
                $column = 'title';

        }

        if(in_array('0', $postData['category'])) {
            array_unshift($postData['category'], '');
            array_unshift($postData['category'], null);
        }

        $filters = [
            'status' => [
                1
            ],
            'category' => $postData['category']
        ];

        if($postData['status'] === 'inactive') {
            $filters['status'] = [0];
        } else if($postData['status'] === 'all') {
            $filters['status'] = [
                0,
                1
            ];
        }

        if($postData['type'] === 'inventory') {
            $filters['type'] = [
                'product',
                'Product',
                'inventory',
                'Inventory'
            ];
        } else if($postData['type'] === 'non-inventory') {
            $filters['type'] = [
                'material',
                'Material',
                'non-inventory',
                'Non-inventory'
            ];
        } else if($postData['type'] === 'service') {
            $filters['type'] = [
                'service',
                'Service'
            ];
        } else if($postData['type'] === 'bundle') {
            $filters['type'] = [
                'bundle',
                'Bundle'
            ];
        }

        $items = $this->items_model->getItemsWithFilter($filters, $column, $order);

        foreach($items as $item) {
            $qty = $this->items_model->countQty($item->id);
            $accountingDetails = $this->items_model->getItemAccountingDetails($item->id);

            if($item->attached_image !== null && $item->attached_image !== "") {
                $icon = "/uploads/$item->attached_image";
            } else if($accountingDetails->attachment_id !== null && $accountingDetails->attachment_id !== "") {
                $attachment = $this->accounting_attachments_model->getById($accountingDetails->attachment_id);
                $icon = "/uploads/accounting/attachments/$attachment->stored_name";
            } else {
                $icon = "";
            }

            if($search !== "") {
                if(stripos($item->title, $search) !== false) {
                    $data[] = [
                        'id' => $item->id,
                        'name' => $item->title,
                        'category_id' => $item->item_categories_id,
                        'category' => !is_null($this->items_model->getCategory($item->item_categories_id)) ? $this->items_model->getCategory($item->item_categories_id)->name : '',
                        'sku' => !is_null($accountingDetails) ? $accountingDetails->sku : '',
                        'type' => ucfirst($item->type),
                        'rebate' => $item->rebate,
                        'sales_desc' => $item->description,
                        'income_account_id' => !is_null($accountingDetails) ? $accountingDetails->income_account_id : '',
                        'income_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->income_account_id) : '',
                        'expense_account_id' => !is_null($accountingDetails) ? $accountingDetails->expense_account_id : '',
                        'expense_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->expense_account_id) : '',
                        'inventory_account_id' => !is_null($accountingDetails) ? $accountingDetails->inv_asset_acc_id : '',
                        'inventory_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->inv_asset_acc_id) : '',
                        'purch_desc' => !is_null($accountingDetails) ? $accountingDetails->purchase_description : '',
                        'sales_price' => $item->price,
                        'cost' => $item->cost,
                        'taxable' => $accountingDetails->tax_rate_id,
                        'qty_on_hand' => $qty,
                        'qty_po' => !is_null($accountingDetails) ? $accountingDetails->qty_po : '',
                        'reorder_point' => $item->re_order_points,
                        'icon' => $icon,
                        'vendor_id' => $item->vendor_id,
                        'vendor' => !is_null($this->vendors_model->get_vendor_by_id($item->vendor_id)) ? $this->vendors_model->get_vendor_by_id($item->vendor_id)->display_name : '',
                        'sales_tax_cat_id' => !is_null($accountingDetails) ? $accountingDetails->tax_rate_id : '',
                        'sales_tax_cat' => !is_null($this->TaxRates_model->getById($accountingDetails->tax_rate_id)) ? $this->TaxRates_model->getById($accountingDetails->tax_rate_id)->name : $accountingDetails->tax_rate_id === "0" ? "Nontaxable" : '',
                        'locations' => $this->items_model->getLocationByItemId($item->id),
                        'display_on_print' => !is_null($accountingDetails) ? $accountingDetails->display_on_print : '',
                        'status' => $item->is_active
                    ];
                }
            } else {
                $data[] = [
                    'id' => $item->id,
                    'name' => $item->title,
                    'category_id' => $item->item_categories_id,
                    'category' => $this->items_model->getCategory($item->item_categories_id)->name,
                    'sku' => !is_null($accountingDetails) ? $accountingDetails->sku : '',
                    'type' => ucfirst($item->type),
                    'rebate' => $item->rebate,
                    'sales_desc' => $item->description,
                    'income_account_id' => !is_null($accountingDetails) ? $accountingDetails->income_account_id : '',
                    'income_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->income_account_id) : '',
                    'expense_account_id' => !is_null($accountingDetails) ? $accountingDetails->expense_account_id : '',
                    'expense_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->expense_account_id) : '',
                    'inventory_account_id' => !is_null($accountingDetails) ? $accountingDetails->inv_asset_acc_id : '',
                    'inventory_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->inv_asset_acc_id) : '',
                    'purch_desc' => !is_null($accountingDetails) ? $accountingDetails->purchase_description : '',
                    'sales_price' => $item->price,
                    'cost' => $item->cost,
                    'taxable' => $accountingDetails->tax_rate_id,
                    'qty_on_hand' => $qty,
                    'qty_po' => !is_null($accountingDetails) ? $accountingDetails->qty_po : '',
                    'reorder_point' => $item->re_order_points,
                    'icon' => $icon,
                    'vendor_id' => $item->vendor_id,
                    'vendor' => !is_null($this->vendors_model->get_vendor_by_id($item->vendor_id)) ? $this->vendors_model->get_vendor_by_id($item->vendor_id)->display_name : '',
                    'sales_tax_cat_id' => !is_null($accountingDetails) ? $accountingDetails->tax_rate_id : '',
                    'sales_tax_cat' => !is_null($this->TaxRates_model->getById($accountingDetails->tax_rate_id)) ? $this->TaxRates_model->getById($accountingDetails->tax_rate_id)->name : $accountingDetails->tax_rate_id === "0" ? "Nontaxable" : '',
                    'locations' => $this->items_model->getLocationByItemId($item->id),
                    'display_on_print' => !is_null($accountingDetails) ? $accountingDetails->display_on_print : '',
                    'status' => $item->is_active
                ];
            }
        }

        $packages = $this->items_model->get_company_packages(logged('company_id'), $filters);
        foreach($packages as $package) {
            $packageItems = $this->items_model->get_package_items($package->id);

            $bundleItems = [];
            foreach($packageItems as $packageItem) {
                $item = $this->items_model->getItemById($packageItem->item_id)[0];

                $bundleItems[] = [
                    'id' => $packageItem->id,
                    'item_id' => $packageItem->item_id,
                    'quantity' => $packageItem->quantity,
                    'name' => $item->title
                ];
            }

            $accountingDetails = $this->items_model->getPackageAccountingDetails($package->id);

            if($accountingDetails->attachment_id !== null && $accountingDetails->attachment_id !== "") {
                $attachment = $this->accounting_attachments_model->getById($accountingDetails->attachment_id);
                $icon = "/uploads/accounting/attachments/$attachment->stored_name";
            } else {
                $icon = "";
            }

            if($search !== "") {
                if(stripos($package->name, $search) !== false) {
                    $data[] = [
                        'id' => $package->id,
                        'name' => $package->name,
                        'category_id' => null,
                        'category' => '',
                        'sku' => !is_null($accountingDetails) ? $accountingDetails->sku : '',
                        'type' => 'Bundle',
                        'rebate' => null,
                        'sales_desc' => '',
                        'income_account_id' => '',
                        'income_account' => '',
                        'expense_account_id' => '',
                        'expense_account' => '',
                        'inventory_account_id' => '',
                        'inventory_account' => '',
                        'purch_desc' => '',
                        'sales_price' => number_format(floatval($package->total_price), 2, '.', ','),
                        'cost' => '',
                        'taxable' => $accountingDetails->tax_rate_id,
                        'qty_on_hand' => '',
                        'qty_po' => '',
                        'reorder_point' => '',
                        'icon' => $icon,
                        'vendor_id' => '',
                        'vendor' => '',
                        'sales_tax_cat_id' => '',
                        'sales_tax_cat' => '',
                        'display_on_print' => !is_null($accountingDetails) ? $accountingDetails->display_on_print : '',
                        'bundle_items' => $bundleItems,
                        'status' => $package->status
                    ];
                }
            } else {
                $data[] = [
                    'id' => $package->id,
                    'name' => $package->name,
                    'category_id' => null,
                    'category' => '',
                    'sku' => !is_null($accountingDetails) ? $accountingDetails->sku : '',
                    'type' => 'Bundle',
                    'rebate' => null,
                    'sales_desc' => '',
                    'income_account_id' => '',
                    'income_account' => '',
                    'expense_account_id' => '',
                    'expense_account' => '',
                    'inventory_account_id' => '',
                    'inventory_account' => '',
                    'purch_desc' => '',
                    'sales_price' => number_format(floatval($package->total_price), 2, '.', ','),
                    'cost' => '',
                    'taxable' => $accountingDetails->tax_rate_id,
                    'qty_on_hand' => '',
                    'qty_po' => '',
                    'reorder_point' => '',
                    'icon' => $icon,
                    'vendor_id' => '',
                    'vendor' => '',
                    'sales_tax_cat_id' => '',
                    'sales_tax_cat' => '',
                    'display_on_print' => !is_null($accountingDetails) ? $accountingDetails->display_on_print : '',
                    'bundle_items' => $bundleItems,
                    'status' => $package->status
                ];
            }
        }

        if($postData['stock_status'] !== 'all') {
            $data = array_filter($data, function($item) use ($postData) {
                $invArray = [
                    'product',
                    'Product',
                    'inventory',
                    'Inventory'
                ];
                if($postData['stock_status'] === 'low stock') {
                    return $item['qty_on_hand'] <= intval($item['reorder_point']) && in_array($item['type'], $invArray);
                } else {
                    return $item['qty_on_hand'] === 0 && in_array($item['type'], $invArray);
                }
            });
        }

        usort($data, function($a, $b) use ($order, $columnName) {
            switch($columnName) {
                case 'name' :
                    if($order === 'asc') {
                        return strcmp($a['name'], $b['name']);
                    } else {
                        return strcmp($b['name'], $a['name']);
                    }
                break;
                case 'sku' :
                    if($order === 'asc') {
                        return strcmp($a['sku'], $b['sku']);
                    } else {
                        return strcmp($b['sku'], $a['sku']);
                    }
                break;
                case 'type' :
                    if($order === 'asc') {
                        return strcmp($a['type'], $b['type']);
                    } else {
                        return strcmp($b['type'], $a['type']);
                    }
                break;
                case 'sales_desc' :
                    if($order === 'asc') {
                        return strcmp($a['sales_desc'], $b['sales_desc']);
                    } else {
                        return strcmp($b['sales_desc'], $a['sales_desc']);
                    }
                break;
                case 'income_account' :
                    if($order === 'asc') {
                        return strcmp($a['income_account'], $b['income_account']);
                    } else {
                        return strcmp($b['income_account'], $a['income_account']);
                    }
                break;
                case 'expense_account' :
                    if($order === 'asc') {
                        return strcmp($a['expense_account'], $b['expense_account']);
                    } else {
                        return strcmp($b['expense_account'], $a['expense_account']);
                    }
                break;
                case 'inventory_account' :
                    if($order === 'asc') {
                        return strcmp($a['inventory_account'], $b['inventory_account']);
                    } else {
                        return strcmp($b['inventory_account'], $a['inventory_account']);
                    }
                break;
                case 'purch_desc' :
                    if($order === 'asc') {
                        return strcmp($a['purch_desc'], $b['purch_desc']);
                    } else {
                        return strcmp($b['purch_desc'], $a['purch_desc']);
                    }
                break;
                case 'sales_price' :
                    if($order === 'asc') {
                        return floatval($a['sales_price']) > floatval($b['sales_price']);
                    } else {
                        return floatval($a['sales_price']) < floatval($b['sales_price']);
                    }
                break;
                case 'cost' :
                    if($order === 'asc') {
                        return floatval($a['cost']) > floatval($b['cost']);
                    } else {
                        return floatval($a['cost']) < floatval($b['cost']);
                    }
                break;
                case 'qty_on_hand' :
                    if($order === 'asc') {
                        return intval($a['qty_on_hand']) > intval($b['qty_on_hand']);
                    } else {
                        return intval($a['qty_on_hand']) < intval($b['qty_on_hand']);
                    }
                break;
                case 'qty_po' :
                    if($order === 'asc') {
                        return intval($a['qty_po']) > intval($b['qty_po']);
                    } else {
                        return intval($a['qty_po']) < intval($b['qty_po']);
                    }
                break;
                case 'reorder_point' :
                    if($order === 'asc') {
                        return intval($a['reorder_point']) > intval($b['reorder_point']);
                    } else {
                        return intval($a['reorder_point']) < intval($b['reorder_point']);
                    }
                break;
            }
        });

        $recordsFiltered = count($data);

        if($postData['group_by_category'] === "1" || $postData['group_by_category'] === 1) {
            $uncategorized = array_filter($data, function($item) {
                return in_array($item['category_id'], ['0', null, '']);
            });

            $categories = $this->items_model->getItemCategories();

            $categorized = [];
            foreach($categories as $category) {
                $catItems = array_filter($data, function($item) use ($category) {
                    return $item['category_id'] === $category->item_categories_id;
                });

                if(!empty($catItems)) {
                    $categorized[] = [
                        'is_category' => 1,
                        'id' => '',
                        'name' => $category->name,
                        'sku' => '',
                        'type' => '',
                        'sales_desc' => '',
                        'income_account' => '',
                        'expense_account' => '',
                        'inventory_account' => '',
                        'purch_desc' => '',
                        'sales_price' => '',
                        'cost' => '',
                        'taxable' => '',
                        'qty_on_hand' => '',
                        'qty_po' => '',
                        'reorder_point' => '',
                        'item_categories_id' => ''
                    ];
                    foreach($catItems as $value) {
                        $categorized[] = $value;
                    }
                }
            }

            $data = $uncategorized;

            foreach($categorized as $itemWC) {
                $data[] = $itemWC;
            }

            $categoryHeaderCount = count(array_filter($data, function($header) {
                return $header['is_category'] === 1;
            }));

            $recordsFiltered = count($data) - $categoryHeaderCount;
        }

        $result = [
            'draw' => $postData['draw'],
            'recordsTotal' => count($items) + count($packages),
            'recordsFiltered' => $recordsFiltered,
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function get_item_form($type = "")
    {
        if($type) {
            $this->page_data['inventory_asset_accounts'] = $this->chart_of_accounts_model->getByAccAndDetailType(1, 2, 5);
            $this->page_data['income_accounts'] = $this->chart_of_accounts_model->getByAccAndDetailType(1, 11, 86);
            $this->page_data['expense_accounts'] = $this->chart_of_accounts_model->getByAccAndDetailType(1, 13, 98);
            $this->page_data['tax_rates'] = $this->TaxRates_model->getAllByCompanyId(getLoggedCompanyID());
            $this->page_data['vendors'] = $this->vendors_model->getAllByCompany();
            $this->load->view("accounting/products_services_modals/".$type, $this->page_data);
        }
    }

    public function inactive($type, $id)
    {
        if($type === 'bundle') {
            $package = $this->items_model->get_package_by_id($id);
        } else {
            $item = $this->items_model->getItemById($id)[0];
        }

        $attempt = 0;
        do {
            if($type === 'bundle') {
                $name = $attempt > 0 ? "$package->name (deleted - $attempt)" : "$package->name (deleted)";
                $checkName = $this->items_model->check_package_name(logged('company_id'), $name);
            } else {
                $name = $attempt > 0 ? "$item->title (deleted - $attempt)" : "$item->title (deleted)";
                $checkName = $this->items_model->check_name(logged('company_id'), $name);
            }

            $attempt++;
        } while(!is_null($checkName));

        $data = [
            'id' => $id,
            'name' => $name,
            'company_id' => logged('company_id')
        ];

        if($type === 'bundle') {
            $inactive = $this->items_model->inactivePackage($data);
        } else {
            $inactive = $this->items_model->inactiveItem($data);
        }

        if($inactive) {
            $this->session->set_flashdata('success', "Item is now inactive.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function active($type, $id)
    {
        if($type === 'bundle') {
            $package = $this->items_model->get_package_by_id($id);
            $explode = explode(' ', $package->name);
        } else {
            $item = $this->items_model->getItemById($id)[0];
            $explode = explode(' ', $item->title);
        }
        array_pop($explode);
        $newName = implode(' ', $explode);

        $attempt = 0;
        do {
            if($type === 'bundle') {
                $name = $attempt > 0 ? "$newName - $attempt" : $newName;
                $checkName = $this->items_model->check_package_name(logged('company_id'), $name);
            } else {
                $name = $attempt > 0 ? "$newName - $attempt" : $newName;
                $checkName = $this->items_model->check_name(logged('company_id'), $name);
            }

            $attempt++;
        } while(!is_null($checkName));

        $data = [
            'id' => $id,
            'name' => $name,
            'company_id' => logged('company_id')
        ];

        if($type === 'bundle') {
            $active = $this->items_model->activePackage($data);
        } else {
            $active = $this->items_model->activeItem($data);
        }

        if($active) {
            $this->session->set_flashdata('success', "Item is now active.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function create($type)
    {
        $input = $this->input->post();
        $name = $input['name'];

        if($_FILES['icon']['name'] !== "") {
            $files = [
                'name' => [
                    $_FILES['icon']['name']
                ],
                'type' => [
                    $_FILES['icon']['type']
                ],
                'tmp_name' => [
                    $_FILES['icon']['tmp_name']
                ],
                'error' => [
                    $_FILES['icon']['tmp_name']
                ],
                'size' => [
                    $_FILES['icon']['size']
                ]
            ];

            $attachmentId = $this->uploadFile($files);
        }

        $attempt = 0;
        do {
            if($type === 'bundle') {
                $name = $attempt > 0 ? "$name - $attempt" : $name;
                $checkName = $this->items_model->check_package_name(logged('company_id'), $name);
            } else {
                $name = $attempt > 0 ? "$name - $attempt" : $name;
                $checkName = $this->items_model->check_name(logged('company_id'), $name);
            }

            $attempt++;
        } while(!is_null($checkName));

        switch($type) {
            case 'bundle' :
                $amountSet = 0.00;
                foreach($input['item'] as $key => $value) {
                    $item = $this->items_model->getItemById($value)[0];

                    $subTotal = floatval($item->price) * floatval($input['quantity'][$key]);
                    $amountSet = floatval($amountSet) + floatval($subTotal);
                }

                $packageDetails = [
                    'name' => $name,
                    'package_type'  => '1',
                    'total_price' => $input['price'],
                    'amount_set' => number_format(floatval($amountSet), 2, '.', ','),
                    'status' => 1,
                    'created_by' => logged('id'),
                    'company_id' => logged('company_id'),
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $create = $this->workorder_model->addPackage($packageDetails);
            break;
            case 'product' :
                $data = [
                    'company_id' => logged('company_id'),
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    'item_categories_id' => isset($input['category']) ? $input['category'] : 0,
                    're_order_points' => $input['reorder_point'],
                    'description' => $input['description'],
                    'price' => $input['price'],
                    'vendor_id' => isset($input['vendor']) ? $input['vendor'] : 0,
                    'cost' => $input['cost'],
                    'is_active' => 1
                ];
            break;
            default :
                $data = [
                    'company_id' => logged('company_id'),
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    'item_categories_id' => isset($input['category']) ? $input['category'] : 0,
                    'description' => isset($input['selling']) ? $input['description'] : null,
                    'price' => isset($input['selling']) ? $input['price'] : null,
                    'vendor_id' => isset($input['purchasing']) && isset($input['vendor']) ? $input['vendor'] : 0,
                    'cost' => isset($input['purchasing']) ? $input['cost'] : null,
                    'is_active' => 1
                ];
            break;
        }

        if($type !== 'bundle') {
            $create = $this->items_model->create($data);
        }

        if($create) {
            switch($type) {
                case 'bundle' :
                    $accountingDetails = [
                        'package_id' => $create,
                        'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                        'display_on_print' => isset($input['display_on_print']) ? $input['display_on_print'] : null,
                        'sku' => $input['sku']
                    ];
                    $itemAccDetails = $this->items_model->saveItemAccountingDetails($accountingDetails);

                    foreach($input['item'] as $key => $value) {
                        $item = $this->items_model->getItemById($value)[0];

                        $packageItemData = [
                            'item_id' => $value,
                            'package_id' => $create,
                            'package_type' => '1',
                            'price' => number_format(floatval($item->price), 2, '.', ','),
                            'quantity' => $input['quantity'][$key]
                        ];
            
                        $addPackageItem = $this->workorder_model->addItemPackage($packageItemData);
                    }
                break;
                case 'product' :
                    $accountingDetails = [
                        'item_id' => $create,
                        'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                        'sku' => $input['sku'],
                        'as_of_date' => date('Y-m-d', strtotime($input['as_of_date'])),
                        'qty_po' => 0,
                        'inv_asset_acc_id' => $input['inv_asset_account'],
                        'income_account_id' => $input['income_account'],
                        'tax_rate_id' => $input['sales_tax_category'],
                        'purchase_description' => $input['purchase_description'],
                        'expense_account_id' => $input['item_expense_account'],
                    ];
                    $itemAccDetails = $this->items_model->saveItemAccountingDetails($accountingDetails);
    
                    $locations = [];
                    foreach($input['location_name'] as $key => $locName) {
                        if($locName !== "") {
                            $locations[] = [
                                'company_id' => logged('company_id'),
                                'qty' => $input['quantity'][$key],
                                'initial_qty' => $input['quantity'][$key],
                                'name' => $locName,
                                'item_id' => $create,
                                'insert_date' => date('Y-m-d H:i:s')
                            ];
                        }
                    }
                    $addItemLocs = $this->items_model->saveBatchItemLocation($locations);
                break;
                default :
                    $accountingDetails = [
                        'item_id' => $create,
                        'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                        'sku' => $input['sku'],
                        'income_account_id' => isset($input['selling']) ? $input['income_account'] : null,
                        'tax_rate_id' => isset($input['selling']) ? $input['sales_tax_category'] : 0,
                        'purchase_description' => isset($input['purchasing']) ? $input['purchase_description'] : null,
                        'expense_account_id' => isset($input['purchasing']) ? $input['item_expense_account'] : null,
                    ];
                    $itemAccDetails = $this->items_model->saveItemAccountingDetails($accountingDetails);
                break;
            }

            $this->session->set_flashdata('success', "Item $name has been successfully added.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/products-and-services');
    }

    private function uploadFile($files)
    {
        $this->load->helper('string');
        $data = [];
        foreach($files['name'] as $key => $name) {
            $extension = end(explode('.', $name));

            do {
                $randomString = random_string('alnum');
                $fileNameToStore = $randomString . '.' .$extension;
                $exists = file_exists('./uploads/accounting/attachments/'.$fileNameToStore);
            } while ($exists);

            $fileType = explode('/', $files['type'][$key]);
            $uploadedName = str_replace('.'.$extension, '', $name);

            $data[] = [
                'company_id' => getLoggedCompanyID(),
                'type' => $fileType[0] === 'application' ? ucfirst($fileType[1]) : ucfirst($fileType[0]),
                'uploaded_name' => $uploadedName,
                'stored_name' => $fileNameToStore,
                'file_extension' => $extension,
                'size' => $files['size'][$key],
                'notes' => null,
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            move_uploaded_file($files['tmp_name'][$key], './uploads/accounting/attachments/'.$fileNameToStore);
        }

        $insert = $this->accounting_attachments_model->insertBatch($data);

        return $insert;
    }

    public function update($type, $id)
    {
        $input = $this->input->post();
        $name = $input['name'];

        $attempt = 0;
        do {
            if($type === 'bundle') {
                $name = $attempt > 0 ? "$name - $attempt" : $name;
                $checkName = $this->items_model->check_package_name(logged('company_id'), $name);
            } else {
                $name = $attempt > 0 ? "$name - $attempt" : $name;
                $checkName = $this->items_model->check_name(logged('company_id'), $name);
            }

            $attempt++;
        } while(!is_null($checkName));

        switch($type) {
            case 'bundle' :
                $amountSet = 0.00;
                foreach($input['item'] as $key => $value) {
                    $item = $this->items_model->getItemById($value)[0];

                    $subTotal = floatval($item->price) * floatval($input['quantity'][$key]);
                    $amountSet = floatval($amountSet) + floatval($subTotal);
                }

                $packageDetails = [
                    'name' => $name,
                    'total_price' => $input['price'],
                    'amount_set' => number_format(floatval($amountSet), 2, '.', ',')
                ];

                $update = $this->items_model->update_package($id, $packageDetails);
            break;
            case 'product' :
                $data = [
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    'item_categories_id' => $input['category'],
                    're_order_points' => $input['reorder_point'],
                    'description' => $input['description'],
                    'price' => $input['price'],
                    'vendor_id' => $input['vendor'],
                    'cost' => $input['cost'],
                ];
            break;
            default :
                $data = [
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    'item_categories_id' => $input['category'],
                    'description' => isset($input['selling']) ? $input['description'] : null,
                    'price' => isset($input['selling']) ? $input['price'] : null,
                    'vendor_id' => isset($input['purchasing']) ? $input['vendor'] : 0,
                    'cost' => isset($input['purchasing']) ? $input['cost'] : null,
                    're_order_points' => null
                ];
            break;
        }

        if($_FILES['icon']['name'] !== "") {
            $files = [
                'name' => [
                    $_FILES['icon']['name']
                ],
                'type' => [
                    $_FILES['icon']['type']
                ],
                'tmp_name' => [
                    $_FILES['icon']['tmp_name']
                ],
                'error' => [
                    $_FILES['icon']['tmp_name']
                ],
                'size' => [
                    $_FILES['icon']['size']
                ]
            ];

            $attachmentId = $this->uploadFile($files);
        }

        if($type !== 'bundle') {
            $condition = ['id' => $id, 'company_id' => getLoggedCompanyID()];
            $update = $this->items_model->update($data, $condition);
        }

        if($update) {
            switch($type) {
                case 'bundle' :
                    $accountingDetails = [
                        'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                        'display_on_print' => isset($input['display_on_print']) ? $input['display_on_print'] : null,
                        'sku' => $input['sku']
                    ];

                    $this->items_model->deletePackageItems($id);

                    foreach($input['item'] as $key => $value) {
                        $item = $this->items_model->getItemById($value)[0];

                        $packageItemData = [
                            'item_id' => $value,
                            'package_id' => $id,
                            'package_type' => '1',
                            'price' => number_format(floatval($item->price), 2, '.', ','),
                            'quantity' => $input['quantity'][$key]
                        ];

                        $addPackageItem = $this->workorder_model->addItemPackage($packageItemData);
                    }
                break;
                case 'product' :
                    $accountingDetails = [
                        'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                        'sku' => $input['sku'],
                        'inv_asset_acc_id' => $input['inv_asset_account'],
                        'income_account_id' => $input['income_account'],
                        'tax_rate_id' => $input['sales_tax_category'],
                        'purchase_description' => $input['purchase_description'],
                        'expense_account_id' => $input['item_expense_account'],
                    ];
                break;
                default :
                    $accountingDetails = [
                        'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                        'sku' => $input['sku'],
                        'income_account_id' => isset($input['selling']) ? $input['income_account'] : null,
                        'tax_rate_id' => isset($input['selling']) ? $input['sales_tax_category'] : null,
                        'purchase_description' => isset($input['purchasing']) ? $input['purchase_description'] : null,
                        'expense_account_id' => isset($input['purchasing']) ? $input['item_expense_account'] : null,
                    ];
                break;
            }

            if($this->items_model->getItemAccountingDetails($id) === null) {
                if($type === 'bundle') {
                    $accountingDetails['package_id'] = $id;
                } else {
                    $accountingDetails['item_id'] = $id;
                }
                $accountingDetails['as_of_date'] = null;
                $accountingDetails['qty_po'] = 0;
                $itemAccDetails = $this->items_model->saveItemAccountingDetails($accountingDetails, $id);
            } else {
                $updateAccDetails = $this->items_model->updateItemAccountingDetails($accountingDetails, $id);
            }

            $this->session->set_flashdata('success', "Item $name has been successfully updated.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/products-and-services');
    }

    public function assign_category($categoryId)
    {
        $items = json_decode($this->input->post('items'));
        $data = [];

        foreach($items as $item) {
            $data[] = [
                'id' => $item,
                'item_categories_id' => $categoryId
            ];
        }

        $assignCate = $this->items_model->updateMultipleItem($data);

        $categoryName = $categoryId !== "0" ? $this->items_model->getCategory($categoryId)->name : 'Uncategorized';
        if($assignCate > 0) {
            $this->session->set_flashdata('success', "Category $categoryName assigned.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function batch_action($action)
    {
        $items = json_decode($this->input->post('items'));
        $data = [];

        foreach($items as $itemId) {
            if($action === 'make-inactive') {
                $item = $this->items_model->getItemById($itemId)[0];

                $attempt = 0;
                do {
                    $name = $attempt > 0 ? "$item->title (deleted - $attempt)" : "$item->title (deleted)";
                    $checkName = $this->items_model->check_name(logged('company_id'), $name);

                    $attempt++;
                } while(!is_null($checkName));

                $data[] = [
                    'id' => $itemId,
                    'title' => $name,
                    'is_active' => 0
                ];
            } else {
                $data[] = [
                    'id' => $itemId,
                    'type' => str_replace('make-', '', $action)
                ];
            }
        }

        $updateAction = $this->items_model->updateMultipleItem($data);

        if($updateAction > 0) {
            if($action !== 'make-inactive') {
                $action = str_replace('make-', '', $action);
                $previousType = $action === 'service' ? 'non-inventory' : 'service';
                $this->session->set_flashdata('success', "You converted $updateAction $previousType to a $action item.");
            } else {
                $this->session->set_flashdata('success', "You made $updateAction item(s) inactive.");
            }
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function print_table()
    {
        $post = $this->input->post();

        $filters = [];
        $search = $post['search'];
        $category = explode(',', $post['category']);

        if(in_array('0', $category)) {
            array_unshift($category, '');
            array_unshift($category, null);
        }

        $filters['category'] = $category;

        switch($post['status']) {
            case 'active' :
                $filters['status'] = [1];
            break;
            case 'inactive' :
                $filters['status'] = [0];
            break;
            default :
                $filters['status'] = [0, 1];
            break;
        }

        switch($post['type']) {
            case 'inventory' :
                $filters['type'] = [
                    'product',
                    'Product',
                    'inventory',
                    'Inventory'
                ];
            break;
            case 'non-inventory' :
                $filters['type'] = [
                    'material',
                    'Material',
                    'non-inventory',
                    'Non-inventory'
                ];
            break;
            case 'service' :
                $filters['type'] = [
                    'service',
                    'Service'
                ];
            break;
            case 'bundle' :
                $filters['type'] = [
                    'bundle',
                    'Bundle'
                ];
            break;
        }

        $items = $this->items_model->getItemsWithFilter($filters);

        $tableHtml = "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Name</th>";
        $tableHtml .= $post['sku'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>SKU</th>" : "";
        $tableHtml .= $post['type'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>" : "";
        $tableHtml .= $post['sales_desc'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Sales description</th>" : "";
        $tableHtml .= $post['income_account'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Income account</th>" : "";
        $tableHtml .= $post['expense_account'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Expense account</th>" : "";
        $tableHtml .= $post['inventory_account'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Inventory account</th>" : "";
        $tableHtml .= $post['purchase_desc'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Purchase description</th>" : "";
        $tableHtml .= $post['sales_price'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Sales price</th>" : "";
        $tableHtml .= $post['cost'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Cost</th>" : "";
        $tableHtml .= $post['taxable'] === '1' ?  "<th style='border-bottom: 2px solid #BFBFBF'>Taxable</th>" : "";
        $tableHtml .= $post['qty_on_hand'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Qty on hand</th>" : "";
        $tableHtml .= $post['qty_po'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Qty on PO</th>" : "";
        $tableHtml .= $post['reorder_point'] === '1' ? "<th style='border-bottom: 2px solid #BFBFBF'>Reorder point</th>" : "";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";
        foreach($items as $item) {
            $qty = $this->items_model->countQty($item->id);
            $accountingDetails = $this->items_model->getItemAccountingDetails($item->id);
            $type = ucfirst($item->type);
            $sku = !is_null($accountingDetails) ? $accountingDetails->sku : '';
            $incomeAccName = !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->income_account_id) : '';
            $expenseAccName = !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->expense_account_id) : '';
            $inventoryAccName = !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->inv_asset_acc_id) : '';
            $purchDesc = !is_null($accountingDetails) ? $accountingDetails->purchase_description : '';
            $taxable = !is_null($accountingDetails) && $accountingDetails->tax_rate_id ? "&#10003;" : "";
            $qtyOnPO = !is_null($accountingDetails) ? $accountingDetails->qty_po : '';

            if($search !== "") {
                if(stripos($item->title, $search) !== false) {
                    $tableHtml .= "<tr>";
                    $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>$item->title</td>";
                    $tableHtml .= $post['sku'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$sku</td>" : "";
                    $tableHtml .= $post['type'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$type</td>" : "";
                    $tableHtml .= $post['sales_desc'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$item->description</td>" : "";
                    $tableHtml .= $post['income_account'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$incomeAccName</td>" : "";
                    $tableHtml .= $post['expense_account'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$expenseAccName</td>" : "";
                    $tableHtml .= $post['inventory_account'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$inventoryAccName</td>" : "";
                    $tableHtml .= $post['purchase_desc'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$purchDesc</td>" : "";
                    $tableHtml .= $post['sales_price'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$item->price</td>" : "";
                    $tableHtml .= $post['cost'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$item->cost</td>" : "";
                    $tableHtml .= $post['taxable'] === '1' ?  "<td style='border-bottom: 1px dotted #D5CDB5'>$taxable</td>" : "";
                    $tableHtml .= $post['qty_on_hand'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$qty</td>" : "";
                    $tableHtml .= $post['qty_po'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$qtyOnPO</td>" : "";
                    $tableHtml .= $post['reorder_point'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$item->re_order_points</td>" : "";
                    $tableHtml .= "</tr>";
                }
            } else {
                $tableHtml .= "<tr>";
                $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>$item->title</td>";
                $tableHtml .= $post['sku'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$sku</td>" : "";
                $tableHtml .= $post['type'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$type</td>" : "";
                $tableHtml .= $post['sales_desc'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$item->description</td>" : "";
                $tableHtml .= $post['income_account'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$incomeAccName</td>" : "";
                $tableHtml .= $post['expense_account'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$expenseAccName</td>" : "";
                $tableHtml .= $post['inventory_account'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$inventoryAccName</td>" : "";
                $tableHtml .= $post['purchase_desc'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$purchDesc</td>" : "";
                $tableHtml .= $post['sales_price'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$item->price</td>" : "";
                $tableHtml .= $post['cost'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$item->cost</td>" : "";
                $tableHtml .= $post['taxable'] === '1' ?  "<td style='border-bottom: 1px dotted #D5CDB5'>$taxable</td>" : "";
                $tableHtml .= $post['qty_on_hand'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$qty</td>" : "";
                $tableHtml .= $post['qty_po'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$qtyOnPO</td>" : "";
                $tableHtml .= $post['reorder_point'] === '1' ? "<td style='border-bottom: 1px dotted #D5CDB5'>$item->re_order_points</td>" : "";
                $tableHtml .= "</tr>";
            }
        }
        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }

    public function export_table()
    {
        $this->load->library('PHPXLSXWriter');
        $post = $this->input->post();

        $filters = [];
        $search = $post['search'];

        if(in_array('0', $post['category'])) {
            array_unshift($post['category'], '');
            array_unshift($post['category'], null);
        }

        $filters['category'] = $post['category'];

        switch($post['status']) {
            case 'active' :
                $filters['status'] = [1];
            break;
            case 'inactive' :
                $filters['status'] = [0];
            break;
            default :
                $filters['status'] = [0, 1];
            break;
        }

        switch($post['type']) {
            case 'inventory' :
                $filters['type'] = [
                    'product',
                    'Product',
                    'inventory',
                    'Inventory'
                ];
            break;
            case 'non-inventory' :
                $filters['type'] = [
                    'material',
                    'Material',
                    'non-inventory',
                    'Non-inventory'
                ];
            break;
            case 'service' :
                $filters['type'] = [
                    'service',
                    'Service'
                ];
            break;
            case 'bundle' :
                $filters['type'] = [
                    'bundle',
                    'Bundle'
                ];
            break;
        }

        $items = $this->items_model->getItemsWithFilter($filters);

        if($search !== "") {
            $items = array_filter($items, function($item, $key) use ($search) {
                return stripos($item->title, $search) !== false;
            }, ARRAY_FILTER_USE_BOTH);
        }

        $this->load->helper('string');

        $randString = random_string('numeric');
        $filename = 'ProductsServicesList__'.$randString.'_'.date('m').'_'.date('d').'_'.date('Y').'.xlsx';

        $header = [
            "Product/Service Name",
            "Sales Description",
            "SKU",
            "Type",
            "Sales Price",
            "Taxable",
            "Income Account",
            "Purchase Description",
            "Purchase Cost",
            "Expense Account",
            "Quantity On Hand",
            "Reorder Point",
            "Inventory Asset Account",
            "Quantity as-of Date"
        ];

        $writer = new XLSXWriter();
        $writer->writeSheetRow('Sheet1', $header, ['font-style' => 'bold', 'border' => 'bottom']);

        $qtyAsOfDate = date("m/d/Y");
        foreach($items as $item) {
            $qty = $this->items_model->countQty($item->id);
            $accountingDetails = $this->items_model->getItemAccountingDetails($item->id);

            $taxable = "no";

            if(!is_null($accountingDetails) && $accountingDetails->tax_rate_id !== "0" &&
                !is_null($accountingDetails->tax_rate_id) && $accountingDetails->tax_rate_id !== ""
            ) {
                $taxable = "yes";
            }

            $data = [
                $item->title,
                $item->description,
                !is_null($accountingDetails) ? $accountingDetails->sku : '',
                ucfirst($item->type),
                $item->price,
                $taxable,
                !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->income_account_id) : '',
                !is_null($accountingDetails) ? $accountingDetails->purchase_description : '',
                $item->cost,
                !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->expense_account_id) : '',
                $qty,
                $item->re_order_points,
                !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->inv_asset_acc_id) : '',
                $qtyAsOfDate
            ];

            $writer->writeSheetRow('Sheet1', $data);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }
}