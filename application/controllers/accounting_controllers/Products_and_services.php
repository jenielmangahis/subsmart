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
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js",
        ));

		$this->page_data['menu_name'] =
            array(
                // array("Dashboard",	array()),
                // array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Cash Flow",   array()),
                array("Expenses",   array('Expenses','Vendors')),
                array("Sales",      array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll",    array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",    array()),
                array("Taxes",      array("Sales Tax","Payroll Tax")),
                // array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                // array('/accounting/banking',array()),
                // array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array('/accounting/cashflowplanner',array()),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', '/accounting/jobs')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",   array('/accounting/salesTax','/accounting/payrollTax')),
                // array('#',  array()),
                array("",   array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
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

            $bundleItems = $this->items_model->getBundleContents($item->id);
            $bundItems = [];
            if(!empty($bundleItems)) {
                foreach($bundleItems as $bundItem) {
                    $bundItems[] = [
                        'id' => $bundItem->id,
                        'item_id' => $bundItem->bundle_item_id,
                        'quantity' => $bundItem->quantity,
                        'name' => $this->items_model->getItemById($bundItem->bundle_item_id)[0]->title
                    ];
                }
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
                        'bundle_items' => $bundItems,
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
                    'bundle_items' => $bundItems,
                    'locations' => $this->items_model->getLocationByItemId($item->id),
                    'display_on_print' => !is_null($accountingDetails) ? $accountingDetails->display_on_print : '',
                    'status' => $item->is_active
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

        if($columnName === 'qty_on_hand') {
            $sort = usort($data, function($a, $b) use ($order) {
                if($order === 'asc') {
                    return $a['qty_on_hand'] > $b['qty_on_hand'];
                } else {
                    return $a['qty_on_hand'] < $b['qty_on_hand'];
                }
            });
        } else if(in_array($columnName, ['income_account', 'expense_account', 'inventory_account', 'sku', 'purch_desc'])) {
            $sort = usort($data, function($a, $b) use ($order, $columnName) {
                if($order === 'asc') {
                    return strcmp($a[$columnName], $b[$columnName]);
                } else {
                    return strcmp($b[$columnName], $a[$columnName]);
                }
            });
        }

        $recordsFiltered = count($data);

        if($postData['group_by_category'] === "1" || $postData['group_by_category'] === 1) {
            $uncategorized = array_filter($data, function($item) {
                return $item['category_id'] === "0" || $item['category_id'] === null || $item['category_id'] === "";
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
            'recordsTotal' => count($items),
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

    public function inactive($id)
    {
        $inactive = $this->items_model->inactiveItem($id);

        if($inactive) {
            $this->session->set_flashdata('success', "Item is now inactive.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function active($id)
    {
        $inactive = $this->items_model->activeItem($id);

        if($inactive) {
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
        
        switch($type) {
            case 'bundle' :
                $data = [
                    'company_id' => logged('company_id'),
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    'item_categories_id' => 0,
                    'description' => $input['description'],
                    'is_active' => 1
                ];
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

        $create = $this->items_model->create($data);

        if($create) {
            switch($type) {
                case 'bundle' :
                    $accountingDetails = [
                        'item_id' => $create,
                        'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                        'display_on_print' => isset($input['display_on_print']) ? $input['display_on_print'] : null,
                        'sku' => $input['sku']
                    ];
                    $itemAccDetails = $this->items_model->saveItemAccountingDetails($accountingDetails);

                    $bundleItems = [];
                    foreach($input['item'] as $key => $value) {
                        $bundleItems[] = [
                            'company_id' => logged('company_id'),
                            'item_id' => $create,
                            'bundle_item_id' => $value,
                            'quantity' => $input['quantity'][$key]
                        ];
                    }
                    $addBundleItems = $this->items_model->addBundleItems($bundleItems);
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

        switch($type) {
            case 'bundle' :
                $data = [
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    'description' => $input['description'],
                    're_order_points' => null
                ];
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

        $condition = ['id' => $id, 'company_id' => getLoggedCompanyID()];
        $update = $this->items_model->update($data, $condition);

        if($update) {
            switch($type) {
                case 'bundle' :
                    $accountingDetails = [
                        'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                        'display_on_print' => isset($input['display_on_print']) ? $input['display_on_print'] : null,
                        'sku' => $input['sku']
                    ];

                    $bundleItems = $this->items_model->getBundleContents($id);

                    foreach($bundleItems as $bundleItem) {
                        if(!in_array($bundleItem->id, $input['bundle_item_content_id'])) {
                            $this->items_model->deleteBundleItem($bundleItem->id, $id);
                        }
                    }

                    foreach($input['item'] as $key => $item) {
                        if($input['bundle_item_content_id'][$key] === null) {
                            $itemContent = [
                                [
                                    'company_id' => logged('company_id'),
                                    'item_id' => $id,
                                    'bundle_item_id' => $item,
                                    'quantity' => $input['quantity'][$key]
                                ]
                            ];
    
                            $addBundleItem = $this->items_model->addBundleItems($itemContent);
                        } else {
                            $itemContent = [
                                'bundle_item_id' => $item,
                                'quantity' => $input['quantity'][$key]
                            ];
    
                            $updateBundleItem = $this->items_model->updateBundleItem($itemContent, $input['bundle_item_content_id'][$key]);
                        }
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
                $accountingDetails['item_id'] = $id;
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

        foreach($items as $item) {
            if($action === 'make-inactive') {
                $data[] = [
                    'id' => $item,
                    'is_active' => 0
                ];
            } else {
                $data[] = [
                    'id' => $item,
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
            $taxable = !is_null($accountingDetails) && $accountingDetails->tax_rate_id ? "<i class='fa fa-check'></i>" : "";
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
        $filename = 'ProductsServicesList__'.$randString.'_'.date('m').'_'.date('d').'_'.date('Y').'.csv';
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv;");

        // file creation 
        $file = fopen('php://output', 'w');
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
        fputcsv($file, $header);

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

            fputcsv($file, $data);
        }

        fclose($file); 
        exit; 
    }
}