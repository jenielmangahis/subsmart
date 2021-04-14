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

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css"
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js"
        ));

		$this->page_data['menu_name'] =
            array(
                array("Dashboard",	array()),
                array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Expenses", 	array('Expenses','Vendors')),
                array("Sales", 		array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll", 	array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",	array()),
                array("Taxes",		array("Sales Tax","Payroll Tax")),
                array("Mileage",	array()),
                array("Accounting",	array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                array('/accounting/banking',array()),
                array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', 'credit_notes')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",	array('/accounting/salesTax','/accounting/payrollTax')),
                array('#',	array()),
                array("",	array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/accounting/sales/products-and-services.js"
        ));
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
                        'sku' => !is_null($accountingDetails) ? $accountingDetails->sku : '',
                        'type' => ucfirst($item->type),
                        'rebate' => $item->rebate,
                        'sales_desc' => $item->description,
                        'income_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->income_account_id) : '',
                        'expense_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->expense_account_id) : '',
                        'inventory_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->inv_asset_acc_id) : '',
                        'purch_desc' => !is_null($accountingDetails) ? $accountingDetails->purchase_description : '',
                        'sales_price' => $item->price,
                        'cost' => $item->cost,
                        'taxable' => $item->tax_rate_id,
                        'qty_on_hand' => $qty,
                        'qty_po' => !is_null($accountingDetails) ? $accountingDetails->qty_po : '',
                        'reorder_point' => $item->re_order_points,
                        'item_categories_id' => $item->item_categories_id,
                        'icon' => $icon,
                        'vendor_id' => $item->vendor_id,
                        'sales_tax_cat' => $accountingDetails->tax_rate_id,
                        'bundle_items' => $bundItems,
                        'locations' => $this->items_model->getLocationByItemId($item->id),
                        'display_on_print' => !is_null($accountingDetails) ? $accountingDetails->display_on_print : ''
                    ];
                }
            } else {
                $data[] = [
                    'id' => $item->id,
                    'name' => $item->title,
                    'category_id' => $item->item_categories_id,
                    'sku' => !is_null($accountingDetails) ? $accountingDetails->sku : '',
                    'type' => ucfirst($item->type),
                    'rebate' => $item->rebate,
                    'sales_desc' => $item->description,
                    'income_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->income_account_id) : '',
                    'expense_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->expense_account_id) : '',
                    'inventory_account' => !is_null($accountingDetails) ? $this->chart_of_accounts_model->getName($accountingDetails->inv_asset_acc_id) : '',
                    'purch_desc' => !is_null($accountingDetails) ? $accountingDetails->purchase_description : '',
                    'sales_price' => $item->price,
                    'cost' => $item->cost,
                    'taxable' => $item->tax_rate_id,
                    'qty_on_hand' => $qty,
                    'qty_po' => !is_null($accountingDetails) ? $accountingDetails->qty_po : '',
                    'reorder_point' => $item->re_order_points,
                    'item_categories_id' => $item->item_categories_id,
                    'icon' => $icon,
                    'vendor_id' => $item->vendor_id,
                    'sales_tax_cat' => $accountingDetails->tax_rate_id,
                    'bundle_items' => $bundItems,
                    'locations' => $this->items_model->getLocationByItemId($item->id),
                    'display_on_print' => !is_null($accountingDetails) ? $accountingDetails->display_on_print : ''
                ];
            }
        }

        if($postData['stock_status'] !== 'all') {
            $data = array_filter($data, function($item) use ($postData) {
                if($postData['stock_status'] === 'low stock') {
                    return $item['qty_on_hand'] <= $item['reorder_point'] && $item['type'] === 'Inventory';
                } else {
                    return $item['qty_on_hand'] === 0 && $item['type'] === 'Inventory';
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
                return $item['item_categories_id'] === "0" || $item['item_categories_id'] === null || $item['item_categories_id'] === "";
            });

            $categories = $this->items_model->getItemCategories();

            $categorized = [];
            foreach($categories as $category) {
                $catItems = array_filter($data, function($item) use ($category) {
                    return $item['item_categories_id'] === $category->item_categories_id;
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

    public function get_item_dropdown()
    {
        $filters = [
            'status' => [1]
        ];
        $items = $this->items_model->getItemsWithFilter($filters);

        $return = [];

        foreach($items as $item) {
            $name = $item->title;
            if($item->item_categories_id !== null && $item->item_categories_id !== "" && $item->item_categories_id !== "0") {
                $category = $this->items_model->getCategory($item->item_categories_id);
                $name = $category->name.': '.$item->title;
            }
            $return['results'][] = [
                'id' => $item->id,
                'text' => $name
            ];
        }

        echo json_encode($return);
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
                    'description' => $input['description'],
                    // 'attached_image' => $product_image,
                    'is_active' => 1
                ];
            break;
            case 'service' :
                $data = [
                    'company_id' => logged('company_id'),
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    // 'attached_image' => $product_image,
                    'item_categories_id' => $input['category'],
                    'description' => isset($input['selling']) ? $input['description'] : null,
                    'price' => isset($input['selling']) ? $input['price'] : null,
                    'vendor_id' => isset($input['purchasing']) ? $input['vendor_id'] : 0,
                    'cost' => isset($input['purchasing']) ? $input['cost'] : null,
                    'is_active' => 1
                ];
            break;
            case 'non-inventory' :
                $data = [
                    'company_id' => logged('company_id'),
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    // 'attached_image' => $product_image,
                    'item_categories_id' => $input['category'],
                    'description' => isset($input['selling']) ? $input['description'] : null,
                    'price' => isset($input['selling']) ? $input['price'] : null,
                    'vendor_id' => isset($input['purchasing']) ? $input['vendor_id'] : 0,
                    'cost' => isset($input['purchasing']) ? $input['cost'] : null,
                    'is_active' => 1
                ];
            break;
            case 'inventory' :
                $data = [
                    'company_id' => logged('company_id'),
                    'title' => $name,
                    'type' => $type,
                    'rebate' => isset($input['rebate_item']) ? $input['rebate_item'] : 0,
                    // 'attached_image' => $product_image,
                    'item_categories_id' => $input['category'],
                    're_order_points' => $input['reorder_point'],
                    'description' => $input['description'],
                    'price' => $input['price'],
                    'vendor_id' => $input['vendor_id'],
                    'cost' => $input['cost'],
                    'is_active' => 1
                ];
            break;
        }

        $create = $this->items_model->create($data);

        if($create) {
            
            if($type === 'bundle') {
                $accountingDetails = [
                    'item_id' => $create,
                    'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                    'display_on_print' => isset($input['display_on_print']) ? $input['display_on_print'] : null,
                    'sku' => $input['sku']
                ];
                $itemAccDetails = $this->items_model->saveItemAccountingDetails($accountingDetails);

                $bundleItems = [];
                foreach($input['item_id'] as $key => $value) {
                    $bundleItems[] = [
                        'company_id' => logged('company_id'),
                        'item_id' => $create,
                        'bundle_item_id' => $value,
                        'quantity' => $input['quantity'][$key]
                    ];
                }
                $addBundleItems = $this->items_model->addBundleItems($bundleItems);
            } else if($type === 'inventory') {
                $accountingDetails = [
                    'item_id' => $create,
                    'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                    'sku' => $input['sku'],
                    'as_of_date' => date('Y-m-d', strtotime($input['as_of_date'])),
                    'qty_po' => 0,
                    'inv_asset_acc_id' => $input['inv_asset_acc'],
                    'income_account_id' => $input['income_account'],
                    'tax_rate_id' => $input['sales_tax_cat'],
                    'purchase_description' => $input['purchase_description'],
                    'expense_account_id' => $input['expense_account'],
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
            } else {
                $accountingDetails = [
                    'item_id' => $create,
                    'attachment_id' => isset($attachmentId) ? $attachmentId : null,
                    'sku' => $input['sku'],
                    'income_account_id' => isset($input['selling']) ? $input['income_account'] : null,
                    'tax_rate_id' => isset($input['selling']) ? $input['sales_tax_cat'] : 0,
                    'purchase_description' => isset($input['purchasing']) ? $input['purchase_description'] : null,
                    'expense_account_id' => isset($input['purchasing']) ? $input['expense_account'] : null,
                ];
                $itemAccDetails = $this->items_model->saveItemAccountingDetails($accountingDetails);
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

        switch ($type) {
            case 'inventory' : 
                $data = [
                    'title' => $name,
                    'type' => $type,
                    'item_categories_id' => $input['category'],
                    're_order_points' => $input['reorder_point'],
                    'description' => $input['description'],
                    'price' => $input['price'],
                    'vendor_id' => $input['vendor_id'],
                    'cost' => $input['cost'],
                ];
            break;
            case 'bundle' :
                $data = [
                    'title' => $name,
                    'description' => $input['description'],
                    're_order_points' => null
                ];
            break;
            default : 
                $data = [
                    'title' => $name,
                    'type' => $type,
                    'item_categories_id' => $input['category'],
                    'description' => isset($input['selling']) ? $input['description'] : null,
                    'price' => isset($input['selling']) ? $input['price'] : null,
                    'vendor_id' => isset($input['purchasing']) ? $input['vendor_id'] : 0,
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
            if($type === 'inventory') {
                $accountingDetails = [
                    'attachment_id' => $attachmentId,
                    'sku' => $input['sku'],
                    'inv_asset_acc_id' => $input['inv_asset_acc'],
                    'income_account_id' => $input['income_account'],
                    'tax_rate_id' => $input['sales_tax_cat'],
                    'purchase_description' => $input['purchase_description'],
                    'expense_account_id' => $input['expense_account'],
                ];
            } else if($type === 'bundle') {
                $accountingDetails = [
                    'attachment_id' => $attachmentId,
                    'display_on_print' => isset($input['display_on_print']) ? $input['display_on_print'] : null,
                    'sku' => $input['sku']
                ];

                $bundleItems = $this->items_model->getBundleContents($id);

                foreach($bundleItems as $bundleItem) {
                    if(!in_array($bundleItem->id, $input['bundle_item_content_id'])) {
                        $this->items_model->deleteBundleItem($bundleItem->id, $id);
                    }
                }

                foreach($input['item_id'] as $key => $item) {
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
            } else {
                $accountingDetails = [
                    'attachment_id' => $attachmentId,
                    'sku' => $input['sku'],
                    'income_account_id' => isset($input['selling']) ? $input['income_account'] : null,
                    'tax_rate_id' => isset($input['selling']) ? $input['sales_tax_cat'] : 0,
                    'purchase_description' => isset($input['purchasing']) ? $input['purchase_description'] : null,
                    'expense_account_id' => isset($input['purchasing']) ? $input['expense_account'] : null,
                ];
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
}