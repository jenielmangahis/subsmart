<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Dashboard extends Widgets
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'Dashboard';
        $this->page_data['page']->parent = 'Dashboard';
        $this->load->library('wizardlib');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Users_model', 'user_model');
        $this->load->model('Feeds_model', 'feeds_model');
        $this->load->model('timesheet_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('users_model');
        $this->load->model('jobs_model');
        $this->load->model('event_model');
        $this->load->model('estimate_model');
        $this->load->model('invoice_model');
        $this->load->model('Crud', 'crud');
        $this->load->model('taskhub_status_model');
        $this->load->model('Activity_model', 'activity');
        $this->load->model('General_model', 'general');
        $this->load->model('Accounting_bank_accounts', 'accounting_bank_accounts');
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('Tickets_model', 'tickets_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('vendors_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('expenses_model');
        $this->load->model('Dashboard_model');

        add_css([
           // 'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'assets/css/accounting/accounting.css',
            'assets/css/dashboard.css',
            'assets/barcharts/css/chart.min.css',
            'assets/barcharts/css/chart.min.css',
            'assets/fa-5/css/fontawesome.min.css',
            'assets/plugins/dropzone/dist/dropzone.css',
            'assets/fa-5/css/all.min.css',
        ]);
        add_header_js([
            'assets/barcharts/js/chart.min.js',
            'assets/barcharts/js/utils.js',
            'assets/barcharts/js/chartjs-plugin-labels.js',
            'assets/js/timeago/dist/timeago.min.js',
        ]);
        add_footer_js([
            // 'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/dashboard/main.js',
            'assets/ringcentral/config.js',
            'assets/ringcentral/es6-promise.auto.js',
            'assets/ringcentral/fetch.umd.js',
            'assets/ringcentral/pubnub.4.20.1.js',
            'assets/ringcentral/ringcentral.js',
            'assets/ringcentral/rc_authentication.js',
            'assets/plugins/dropzone/dist/dropzone.js',
            'assets/js/accounting/modal-forms.js',
            'assets/js/accounting/modal-forms1.js',
        ]);
    }

    public function sendTestNotify()
    {
        $this->load->library('notify');
        $this->load->model('users_model');

        $ios_tokens = [];
        // $user_id = logged('id');
        $userDetails = $this->users_model->getUser(62);
        // print_r($userDetails);

        $ios_tokens[] = $userDetails->device_token;
        $result = $this->notify->send_ios_push($ios_tokens, 'Feeds - Test', 'This is a sample test notify');

        print_r($result);
    }

    public function sendFeed()
    {
        $this->load->library('notify');
        $this->load->model('Feeds_model');
        $this->load->model('users_model');

        $subject = post('feed_subject');
        $feedMessage = post('feed_message');
        $company_id = logged('company_id');
        $user_id = logged('id');
        $userDetails = $this->users_model->getUser($user_id);

        $registrationIds[] = $userDetails->device_token;

        $feedDetails = [
            'sender_id' => $user_id,
            'sender_name' => getLoggedName(),
            'title' => $subject,
            'message' => $feedMessage,
            'company_id' => $company_id,
        ];

        if ($this->Feeds_model->saveFeeds($feedDetails)) {
            if ($userDetails->device_token != '') {
                $notifyResult = $this->notify->send_ios_push($registrationIds, 'Feeds - '.$subject, $feedMessage);
            }

            $json_response = ['success' => true, 'msg' => 'Message was successfully sent'];
            array_push($json_response, json_decode($notifyResult));

            echo json_encode($json_response);
        }
    }

    public function sendSMS()
    {
        $this->load->library('Ringcentral');
        $this->ringcentral->sample();
    }

    public function getWidgetList()
    {
        $this->load->model('widgets_model');
        $user_id = logged('id');
        $widgets = $this->widgets_model->getWidgetsList();
        $this->page_data['widgets'] = $widgets;
        $this->load->view('v2/widgets/add_widgets_details', $this->page_data);
    }

    public function getThumbnailsList()
    {
        $this->load->model('widgets_model');
        $companyId = logged('company_id');
        $this->page_data['widgets'] = $this->widgets_model->getThumbnailsList($companyId);
        $this->load->view('v2/widgets/add_thumbnail_details', $this->page_data);
    }

    public function index()
    {        
        // load necessary model and functions
        $this->hasAccessModule(39);
        $this->load->model('AcsProfile_model');
        $this->load->model('Job_tags_model');
        $this->load->model('Users_model');
        $this->load->model('widgets_model');
        $this->load->model('Demo_model');
        $this->load->helper('functions');
        $this->load->helper('functions_helper');
        $this->load->model('widgets_model');
        $this->load->model('Invoice_model');
        $this->load->model('expenses_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('OfferCodes_model');

        add_css([
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/libs/jcanvas/global.css',
            'assets/plugins/timeline_calendar/main.css',
            'assets/css/wokrcalendar/workcalendar.css',
        ]);

        add_footer_js([
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            //'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/js/v2/bootstrap-datetimepicker.v2.min.js',
            'assets/plugins/timeline_calendar/main.js',
            'assets/frontend/js/workcalender/workcalender.js',
            'assets/js/quick_launch.js',
        ]);

        $user_id   = logged('id');
        $companyId = logged('company_id');
        $type      = 0;

        $user_type = logged('user_type');
        $this->page_data['user_type'] = $user_type;

        $this->page_data['activity_list'] = $this->activity->getActivity($user_id, [6, 0], 0);
        $this->page_data['activity_list_count'] = sizeof($this->page_data['activity_list']);
        if ($this->page_data['activity_list_count'] > 5) {
            array_pop($this->page_data['activity_list']);
        }
        $this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6, 0], 1);
        // echo $this->db->last_query();
        $this->page_data['history_activity_list_count'] = sizeof($this->page_data['history_activity_list']);
        if ($this->page_data['history_activity_list_count'] > 5) {
            array_pop($this->page_data['history_activity_list']);
        }
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id', $user_id, 'ac_dashboard_sort');
        if (!$check_if_exist) {
            $input = [];
            $input['fk_user_id'] = $user_id;
            $input['ds_values'] = 'bulletin,open_estimates,upcoming_job,jobs,sales_leaderbord,tech_leaderbord,tags,lead_source,activities,history,today_stats,taskhub_stats,tasks,income,
                                   expenses,bank_accounts,sales,messages,paid_invoices,lead_stats,overdue_invoices,invoicing,task_stats,plan_setup,discover_more,new_leads';
            $this->customer_ad_model->add($input, 'ac_dashboard_sort');
        }

        $status_arr = [];
        $this->page_data['upcomingInvoice'] = $this->event_model->getUnpaidInvoices();
        $this->page_data['upcomingInvoice'] = $this->event_model->getUnpaidInvoices();
        $this->page_data['dueInvoices'] = $this->Invoice_model->getCompanyDueInvoices($companyId);
        $this->page_data['overdueInvoices'] = $this->Invoice_model->getCompanyOverDueInvoices($companyId);
        $this->page_data['subs'] = $this->Customer_advance_model->countTotalSubscriptionsByCompanyId($companyId);
        $subsContent =  $this->Customer_advance_model->countCurrentTotalSubscriptionsByCompanyId($companyId);

        $output = 'Recent Subscription Update <br>';

        if(count($subsContent) > 0 ){
            foreach ($subsContent as $item) {
                $output .= "<br> subscriber : <b>".$item->first_name." ".$item->last_name."</b> <br> amount <b>$".$item->mmr."</b>,";
            }
        }

        $this->page_data['subsContent'] = $output;

        $past_due = $this->widgets_model->getCurrentCompanyOverdueInvoices2();

        $invoices_total_due = 0;
        foreach ($past_due as $total_due) {
            if ($total_due->status != 'paid') {
                $invoices_total_due += $total_due->balance;
            }
        }
        $this->page_data['invoices_count'] = count($past_due);
        $this->page_data['invoices_total_due'] = $invoices_total_due;

        $nsmart_sales_count = $this->widgets_model->getNsmartSales();
        $nsmart_sales_total = $this->widgets_model->getNsmartSalesTotal();

        $this->page_data['nsmart_sales_count'] = count($nsmart_sales_count);
        $this->page_data['nsmart_sales_total'] = $nsmart_sales_total->total;

        $demo_schedule_count = $this->Demo_model->getlist();
        $this->page_data['demo_schedule_count'] = count($demo_schedule_count);

        $used_offer_codes     = $this->OfferCodes_model->getAllUsed();
        $not_used_offer_codes = $this->OfferCodes_model->getAllNotUsed();
        $this->page_data['used_offer_codes'] = $used_offer_codes;
        $this->page_data['not_used_offer_codes'] = $not_used_offer_codes;

        $clients = $this->widgets_model->getClients();
        $this->page_data['nsmart_total_clients'] = count($clients);

        // $this->page_data['leadSources']=$this->event_model->getLeadSourceWithCount(); // fetch Lead Sources

        $latestJobs = $this->event_model->getLatestJobs();

        $jobIds = array_map(function ($job) {
            return $job->id;
        }, $latestJobs);

        $this->page_data['latestJobs'] = $latestJobs; // fetch Sales Rep and customer they are assigned to
        $this->page_data['company_id'] = $companyId; // Company ID of the logged in USER

        $this->page_data['sales'] = $this->event_model->getAllSales();
        $this->page_data['widgets'] = $this->widgets_model->getWidgetsByCompanyId($companyId);
        $this->page_data['main_widgets'] = array_filter($this->page_data['widgets'], function ($widget) {
            return $widget->wu_is_main == true;
        });

        $this->page_data['status_arr'] = $status_arr;

        // fetch open estimates
        $open_estimate_query = [
            'where' => ['company_id' => logged('company_id'), 'view_flag' => '0'],
            'table' => 'estimates',
            'select' => '*',
        ];
        $this->page_data['open_estimates'] = $this->general->get_data_with_param($open_estimate_query);

        // fetch open estimates
        $plans_query = [
            'where' => ['company_id' => logged('company_id'), 'status' => 1],
            'table' => 'plan_type',
            'select' => 'count(*) as totalPlan',
        ];
        $this->page_data['plan_type'] = $this->general->get_data_with_param($plans_query);

        // fetch open estimates
        $estimate_draft_query = [
            'where' => ['company_id' => logged('company_id')],
            'table' => 'estimates',
            'select' => 'id,status',
        ];
        $this->page_data['estimate_draft'] = $this->general->get_data_with_param($estimate_draft_query);

        // fetch open estimates
        $invoice_draft = [
            'where' => ['company_id' => logged('company_id'), 'status' => 'Draft'],
            'table' => 'invoices',
            'select' => 'count(*) as total',
        ];
        $this->page_data['invoice_draft'] = $this->general->get_data_with_param($invoice_draft, false);

        // fetch open estimates
        $invoice_due = [
            'where' => ['company_id' => logged('company_id'), 'status' => 'Due'],
            'table' => 'invoices',
            'select' => 'count(*) as total',
        ];
        $this->page_data['invoice_due'] = $this->general->get_data_with_param($invoice_due, false);

        // $invoice_paid_last_30days = [
        //     'where' => ['company_id' => logged('company_id'), 'status' => 'Paid', 'due_date ' => 'Paid'],
        //     'table' => 'invoices',
        //     'select' => 'count(*) as total',
        // ];
        // $this->page_data['invoice_paid_last_30days'] = $this->general->get_data_with_param($invoice_paid_last_30days, false);

        // fetch open estimates
        $total_invoice_paid = [
            'where' => ['company_id' => logged('company_id'), 'status' => 'Paid'],
            'table' => 'invoices',
            'select' => 'count(*) as total',
        ];
        $this->page_data['total_invoice_paid'] = $this->general->get_data_with_param($total_invoice_paid, false);

        $this->page_data['activeSubscriptions'] = $this->AcsProfile_model->getTotalActiveServicePlans(logged('company_id'));
        $this->page_data['totalAmountActiveSubscriptions'] = $this->AcsProfile_model->getTotalRecurringPayment(logged('company_id'));
        $this->page_data['activeSubscriptionsWillExpireIn30d'] = $this->AcsProfile_model->getCompanyActiveSubscriptionWillExpireIn30Days(logged('company_id'));

        // get customer subscription history
        $feeds_query = [
            'where' => ['company_id' => logged('company_id')],
            'table' => 'feed',
            'select' => '*',
            'order' => ['order_by' => 'id', 'ordering' => 'DESC'],
        ];
        $this->page_data['feeds'] = $this->general->get_data_with_param($feeds_query);
        $this->page_data['total_recurring_payment'] = $this->getTotalRecurringPayment();
        $this->page_data['total_agreements_to_expire_in_30_days'] = $this->getAgreementsToExpireIn30Days();

        $invoices = $this->invoice_model->getOpenInvoices(logged('company_id'));
        $openInvoices = array_filter($invoices, function ($v, $k) {
            return !in_array($v->status, ['Draft', 'Declined', 'Paid']);
        }, ARRAY_FILTER_USE_BOTH);

        $this->page_data['open_invoices'] = $openInvoices;
        $this->page_data['currentOverdueInvoices'] = $this->widgets_model->getCurrentCompanyOverdueInvoices2();

        /**
         * Customer Ledger - Start
         */
        /*$this->load->model('Payment_records_model');
        $cid        = 0;
        $ledger_payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $companyId);
        $ledger_invoices   = $this->invoice_model->getAllByCustomerIdAndCompanyId($cid, $companyId);

        $customer_ledger = [];
        foreach( $ledger_invoices as $ledger_invoice ){
            $date = date("m/d/Y", strtotime($ledger_invoice->date_issued));
            $customer_ledger[$date][] = [
                'id' => $ledger_invoice->id,
                'type' => 'income',                
                'date' => $date,
                'description' => 'Month rent ' . date('M Y', strtotime($ledger_invoice->due_date)),
                'amount' => $ledger_invoice->grand_total,
                'late_fee' => $ledger_invoice->late_fee
            ];

            $ledger_payments = $this->Payment_records_model->getAllByInvoiceId($ledger_invoice->id);            
            foreach( $ledger_payments as $p ){
                $date = date("m/d/Y", strtotime($p->payment_date));
                $customer_ledger[$date][] = [
                    'id' => $p->id,
                    'type' => 'payment',          
                    'date' => $date,      
                    'description' => 'Month rent ' . date('M Y', strtotime($ledger_invoice->due_date)),
                    'amount' => $p->invoice_amount
                ];
            }
        }

        $this->page_data['customerLedgers'] = $customer_ledger;  
        */    
        /**
         * Customer Ledger - End
         */  

        $company_id = logged('company_id');
        // Plaid
        $this->load->model('PlaidAccount_model');
        $plaid_handler_open = 0;
        $plaid_token = '';
        $client_name = '';
        $get = $this->input->get();
        if (isset($get['oauth_state_id'])) {
            $plaid_handler_open = 1;
            $plaid_token = $this->session->userdata('plaid_token');

            $plaidAccount = $this->PlaidAccount_model->getByCompanyId($companyId);
            $client_name = $plaidAccount->client_name;
        }

        $this->page_data['client_name'] = $plaid_token;
        $this->page_data['plaid_token'] = $plaid_token;
        $this->page_data['plaid_handler_open'] = $plaid_handler_open;

        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;

        $this->page_data['redirect_calendar'] = $redirect_calendar;
        $this->page_data['default_user'] = $default_user;
        $this->page_data['default_start_date'] = $default_start_date;
        $this->page_data['default_start_time'] = $default_start_time;

        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['items'] = $this->items_model->getItemlist();
        $type = $this->input->get('type');
        $this->page_data['tags'] = $this->Job_tags_model->getJobTagsByCompany($company_id);
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['serviceType'] = $this->tickets_model->getServiceType($company_id);
        $this->page_data['headers'] = $this->tickets_model->getHeaders($company_id);
        $this->page_data['companyName'] = $this->tickets_model->getCompany(logged('company_id'));
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['estimates'] = $this->estimate_model->getAllOpenEstimatesByCompanyId($companyId);
        $this->page_data['expired_estimates'] = $this->estimate_model->getExpiredEstimatesByCompanyId($companyId);
        $this->page_data['leads'] = count($this->customer_ad_model->get_leads_data());
        $this->page_data['collection'] = $this->invoice_model->getCollection($company_id);

        $esign_query = [
            'where' => ['user_docfile.company_id' => logged('company_id'), 'user_docfile.status !=' => 'Deleted',
                'user_docfile.unique_key <>' => '', 'user_docfile.company_id >' => 0],
            'join' => [
                [
                    'table' => 'acs_profile',
                    'statement' => 'user_docfile.customer_id = acs_profile.prof_id',
                    'join_as' => 'left',
                ],
            ],
            'groupBy' => ['user_docfile.status'],
            'table' => 'user_docfile',
            'select' => 'user_docfile.status AS status, COUNT(user_docfile.status) as status_count',
        ];

        $this->page_data['esign'] = $this->general->get_data_with_param($esign_query);

        $payments = $this->invoice_model->get_company_payments(logged('company_id'));
        // $deposits = 0;
        // foreach ($payments as $payment) {
        //     $deposits += floatval($payment->invoice_amount);
        // }
        $this->page_data['deposits'] = $payments;
        $this->page_data['technician_items'] = $this->Users_model->getCompanyUsersTech($company_id);

        // getThumbnailWidget Options
        $thumbnailWidgetOption = [
            'select' => '*',
            'table' => 'dashboard_thumbnail_widget',
        ];
        $this->page_data['thumbnailWidgetOption'] = $this->general->get_data_with_param($thumbnailWidgetOption);

        // getThumbnailWidget user's preset
        $thumbnailWidgetPreset = [
            'select' => '*',
            'table' => 'dashboard_preference',
            'where' => [
                'company_id' => logged('company_id'),
                'user_id' => logged('id'),
            ],
        ];
        $this->page_data['thumbnailWidgetPreset'] = $this->general->get_data_with_param($thumbnailWidgetPreset);

        // $this->load->view('dashboard', $this->page_data);
        $this->load->view('dashboard_v2', $this->page_data);
    }

    private function category_col($transactionId, $transactionType, $for = 'table')
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        $totalCount = count($categories) + count($items);

        if ($totalCount > 1) {
            $category = [
                'id' => null,
                'name' => '-Split-',
            ];
        } else {
            if ($totalCount === 1) {
                if (count($categories) === 1 && count($items) === 0) {
                    $expenseAcc = $categories[0]->expense_account_id;
                } else {
                    $itemId = $items[0]->item_id;
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($itemId);
                    $expenseAcc = $itemAccDetails->inv_asset_acc_id;
                }

                if ($for === 'table') {
                    $category = [
                        'id' => $expenseAcc,
                        'name' => $this->chart_of_accounts_model->getName($expenseAcc),
                    ];
                } else {
                    $category = $this->chart_of_accounts_model->getName($expenseAcc);
                }
            }
        }

        return $category;
    }

    private function get_transactions($filters, $for = 'table')
    {
        $expenses = $this->expenses_model->get_company_expense_transactions($filters);
        $checks = $this->expenses_model->get_company_check_transactions($filters);
        $purchOrders = $this->expenses_model->get_company_purch_order_transactions($filters);
        $vendorCredits = $this->expenses_model->get_company_vendor_credit_transactions($filters);
        $ccPayments = $this->expenses_model->get_company_cc_payment_transactions($filters);
        $billPayments = $this->expenses_model->get_company_bill_payment_items($filters);
        $creditCardCredits = $this->expenses_model->get_company_cc_credit_transactions($filters);
        $transfers = $this->expenses_model->get_company_transfers($filters);

        $transactions = [];

        if (isset($billPayments) && count($billPayments) > 0) {
            foreach ($billPayments as $billPayment) {
                $transactions[] = [
                    'category' => 'Bill payment',
                    'total' => $billPayment->total_amount,
                ];
            }
        }

        if (isset($checks) && count($checks) > 0) {
            foreach ($checks as $check) {
                $category = $this->category_col($check->id, 'Check', $for);
                $transactions[] = [
                    'category' => $category,
                    'total' => $check->total_amount,
                ];
            }
        }

        if (isset($creditCardCredits) && count($creditCardCredits) > 0) {
            foreach ($creditCardCredits as $creditCardCredit) {
                $category = $this->category_col($creditCardCredit->id, 'Credit Card Credit', $for);
                $transactions[] = [
                    'category' => $category,
                    'total' => $creditCardCredit->total_amount,
                ];
            }
        }

        if (isset($ccPayments) && count($ccPayments) > 0) {
            foreach ($ccPayments as $ccPayment) {
                $transactions[] = [
                    'category' => 'CC payment',
                    'total' => $ccPayment->amount,
                ];
            }
        }

        if (isset($expenses) && count($expenses) > 0) {
            foreach ($expenses as $expense) {
                $category = $this->category_col($expense->id, 'Expense', $for);
                $transactions[] = [
                    'category' => $category,
                    'total' => $expense->total_amount,
                ];
            }
        }

        if (isset($purchOrders) && count($purchOrders) > 0) {
            foreach ($purchOrders as $purchOrder) {
                $category = $this->category_col($purchOrder->id, 'Purchase Order', $for);
                $transactions[] = [
                    'category' => $category,
                    'total' => $purchOrder->total_amount,
                ];
            }
        }

        if (isset($transfers) && count($transfers) > 0) {
            foreach ($transfers as $transfer) {
                $transactions[] = [
                    'category' => 'Transgfer fund',
                    'total' => $transfer->transfer_amount,
                ];
            }
        }

        if (isset($vendorCredits) && count($vendorCredits) > 0) {
            foreach ($vendorCredits as $vendorCredit) {
                $category = $this->category_col($vendorCredit->id, 'Vendor Credit', $for);
                $transactions[] = [
                    'category' => $category,
                    'total' => $vendorCredit->total_amount,
                ];
            }
        }


        $groupedTransactions = [];

        foreach ($transactions as $transaction) {
            $category = is_array($transaction['category']) ? json_encode($transaction['category']) : $transaction['category'];
            $total = $transaction['total'];

            if (!isset($groupedTransactions[$category])) {
                $groupedTransactions[$category] = 0;
            }

            $groupedTransactions[$category] += $total;
        }

        $result = [];
        foreach ($groupedTransactions as $category => $total) {
            $category = is_string($category) ? json_decode($category, true) : $category;
            $result[] = [
                'category' => $category,
                'total' => $total,
            ];
        }

        usort($result, function ($a, $b) {
            return $b['total'] - $a['total'];
        });

        $top5Results = array_slice($result, 0, 5);

        foreach ($top5Results as &$res) {
            // $res['total'] = '$'.number_format($res['total'], 2, '.', ',');
            $res['total'] = $res['total'];
        }

        return $top5Results;
    }

    public function loadFilterData()
    {
        $date_from = post('from_date');
        $date_to = post('to_date');
        $table = post('table');
        $id = post('id');
        $filter = post('filter');

        $this->db->select('w_list_view');
        $this->db->from('widgets');
        $this->db->where('w_id', $id);
        $query = $this->db->get();
        $widgets = $query->row();

        switch ($table) {
            case 'estimates':
                $total_query = [
                    'where' => ['estimates.company_id' => logged('company_id'), 'estimates.status !=' => 'Lost',
                'estimates.status !=' => 'Invoiced', 'estimates.view_flag' => '0', 'estimates.status !=' => 'Declined By Customer',
                'DATE(estimates.created_at)  >=' => date('Y-m-d', strtotime($date_from)),
                 'DATE(estimates.created_at)  <=' => date('Y-m-d', strtotime($date_to))],
                    'table' => 'estimates',
                    'join' => [
                       [
                        'table' => 'acs_profile',
                        'statement' => 'estimates.customer_id = acs_profile.prof_id',
                        'join_as' => 'left',
                       ],
                    ],
                    'select' => 'estimates.*',
                    'order' => ['order_by' => 'id', 'ordering' => 'DESC'],
                ];
                $total = $this->general->get_data_with_param($total_query);
                $expired_query = [
                    'where' => ['estimates.company_id' => logged('company_id'),
                                'estimates.expiry_date <=' => date('Y-m-d', strtotime($date_to)),
                                 'estimates.view_flag' => '0',
                                 'DATE(estimates.created_at)  >=' => date('Y-m-d', strtotime($date_from)),
                                 'DATE(estimates.created_at)  <=' => date('Y-m-d', strtotime($date_to)),
                    ],
                    'table' => 'estimates',
                    'join' => [
                        [
                            'table' => 'acs_profile',
                            'statement' => 'estimates.customer_id = acs_profile.prof_id',
                            'join_as' => 'right',
                        ],
                    ],
                    'select' => 'estimates.*',
                    'order' => ['order_by' => 'id', 'ordering' => 'DESC'],
                ];

                $expired = $this->general->get_data_with_param($expired_query);

                $this->output->set_output(json_encode(['first' => count($total), 'second' => count($expired), 'w_list_view' => $widgets->w_list_view]));
                break;
            case 'acs_billing':
                // $total_query = [
                //     'where' => ['acs_profile.company_id' => logged('company_id'),
                //     'DATE(acs_billing.bill_start_date) >=' => date('Y-m-d', strtotime($date_from)), 
                //     'DATE(acs_billing.bill_end_date) >=' => date('Y-m-d', strtotime($date_to))
                // ],
                //     'where_in' => ['acs_profile.status' => 'Active w/RAR','acs_profile.status' => 'Active w/RQR','acs_profile.status' => 'Active w/RYR','acs_profile.status' => 'Inactive w/RMM','acs_profile.status' => 'Active w/RMR'],
                //     'table' => 'acs_profile',
                //     'join' => [
                //         [
                //             'table' => 'acs_billing',
                //             'statement' => 'acs_billing.fk_prof_id = acs_profile.prof_id',
                //             'join_as' => 'left',
                //         ],
                //     ],
                //     'select' => ['SUM(COALESCE(acs_billing.mmr, 0)) AS TOTAL_MMR','acs_billing.*'],
                // ];
                // $total = $this->general->get_data_with_param($total_query);

                if(  $date_to == '0000-00-00 23:59:59'){
                    $total_query = [
                        'filter'=>$filter,
                        'select'=>' SUM(COALESCE(acs_billing.mmr, 0)) AS total_amount_subscriptions,
                                    COUNT(acs_billing.bill_id) AS total_subscriptions,
                                    COUNT(acs_profile.prof_id) AS total_active_subscription,
                                    
                                    SUM(CASE WHEN DATE(acs_billing.bill_start_date) = CURDATE() THEN COALESCE(acs_billing.mmr, 0) ELSE 0 END) AS total_current_amount_subscriptions,
                                    COUNT(CASE WHEN DATE(acs_billing.bill_start_date) = CURDATE() THEN acs_profile.prof_id END) AS total_current_active_subscription'
                        ];
                }else{
                    // $total_query = [
                    //     'where' => [
                    //     'DATE(acs_billing.bill_start_date) >=' => date('Y-m-d', strtotime($date_from)), 
                    //     'DATE(acs_billing.bill_end_date) >=' => date('Y-m-d', strtotime($date_to)),
                    //     'acs_profile.company_id' => logged('company_id'),
                    //     ],
                    //     'filter'=>$filter,
                    //     'select'=>' SUM(COALESCE(acs_billing.mmr, 0)) AS total_amount_subscriptions, 
                    //                 COALESCE(COUNT(acs_billing.bill_id), 0) AS total_subscriptions, 
                    //                 COUNT(acs_billing.bill_id) AS total_active_subscription, '
                    // ];

                    $total_query = [
                        'where' => [
                        'DATE(acs_billing.bill_start_date) >=' => date('Y-m-d', strtotime($date_from)),                         
                        'acs_profile.company_id' => logged('company_id'),
                        ],
                        'filter'=>$filter,
                        'select'=>' SUM(COALESCE(acs_billing.mmr, 0)) AS total_amount_subscriptions, 
                                    COALESCE(COUNT(acs_billing.bill_id), 0) AS total_subscriptions, 
                                    COUNT(acs_billing.bill_id) AS total_active_subscription, '
                    ];
                }
              
                $total = $this->customer_ad_model->getTotalSubscriptionsFilterDate($total_query);

                $mmr_query = [
                    'where' => [
                        'DATE(acs_billing.bill_start_date) >=' => date('Y-m-d', strtotime($date_from)),                         
                        'acs_profile.company_id' => logged('company_id'),
                        ],
                    'select' => 'acs_billing.*',
                    'filter'=>$filter,
                ];

                // $mmr_query = [
                //     'where' => [
                //         'DATE(acs_billing.bill_start_date) >=' => date('Y-m-d', strtotime($date_from)), 
                //         'DATE(acs_billing.bill_end_date) >=' => date('Y-m-d', strtotime($date_to)),
                //         'acs_profile.company_id' => logged('company_id'),
                //         ],
                //     'select' => 'acs_billing.*',
                //     'filter'=>$filter,
                // ];
                $mmr = $this->customer_ad_model->getTotalSubscriptionsFilterDate($mmr_query);

     

                // $mmr = $this->AcsProfile_model->getSubscriptionFilter(logged('company_id'), $date_from, $date_to);
                $this->output->set_output(json_encode(['first' => '$'.' '.number_format($total[0]->total_amount_subscriptions, 2), 'second' => number_format($total[0]->total_active_subscription, 0),  'mmr' => $mmr]));

                break;

            case 'invoices':

                $company_id = logged('company_id');
                $this->db->from('invoices');
                $this->db->select('
                    invoices.id,
                    invoices.invoice_number,
                    invoices.due_date,
                    invoices.status,
                    acs_profile.email AS customer_email,
                    acs_profile.first_name, 
                    acs_profile.last_name,
                    acs_profile.fk_user_id as user_id,
                    invoices.grand_total,
                    invoices.grand_total as balance
                ');
                $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                $this->db->where('invoices.status !=', "Paid");
                $this->db->where('invoices.status !=', "Draft");
                $this->db->where('invoices.status !=', "");
                $this->db->where('invoices.view_flag =', 0);
                $this->db->where('invoices.due_date <',date('Y-m-d'));
                $this->db->where('invoices.date_created >=',date('Y-m-d H:i:s', strtotime($date_from)));
                $this->db->where('invoices.date_created <',date('Y-m-d H:i:s' , strtotime($date_to)));
                $this->db->where('invoices.company_id', $company_id);
                $this->db->order_by("invoices.invoice_number DESC");
                $query = $this->db->get();
                $past_due = $query->result();
        

                $invoices_total_due = 0;
                foreach ($past_due as $total_due) {
                    if ($total_due->status != 'paid') {
                        $invoices_total_due += $total_due->balance;
                    }
                }

                $mmr = $this->AcsProfile_model->getSubscriptionFilter(logged('company_id'), $date_from, $date_to);
                $this->output->set_output(json_encode(['first' => count($past_due), 'second' => number_format($invoices_total_due, 2, ".", ","),  'mmr' => $mmr, 'past_due' => $past_due]));

                break;
            case 'nsmart_sales':
                $this->db->from('clients');
                $this->db->select('*');
                $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'left');
                if(  $date_to !== '0000-00-00 23:59:59'){
                    $this->db->where('clients.plan_date_registered >=',date('Y-m-d', strtotime($date_from)));
                    $this->db->where('clients.plan_date_registered <=',date('Y-m-d', strtotime($date_to)));
                }
                $query = $this->db->get();

                $nsmart_sales = $query->result();

                $nsmart_sales_total = 0;
                foreach ($nsmart_sales as $total) {
                    $nsmart_sales_total += $total->price - $total->discount;
                }
                $this->output->set_output(json_encode(['first' => count($nsmart_sales), 'second' => number_format($nsmart_sales_total, 2, ".", ","),  'nsmart_sales' => $nsmart_sales]));
                break;
            case 'coupon_codes':                
                $this->db->select('*');
                $this->db->from('offer_codes');
                if( $date_from != '0000-00-00  00:00:00' ){
                    $this->db->where('date_modified >=',date('Y-m-d', strtotime($date_from)));
                    $this->db->where('date_modified <=',date('Y-m-d', strtotime($date_to)));
                }
                $query = $this->db->get();
                $coupons = $query->result();

                $total_used = 0;
                $total_available = 0;
                foreach( $coupons as $c ){
                    if( $c->client_id > 0 ){
                        $total_used++;
                    }else{
                        $total_available++;
                    }
                }

                $this->output->set_output(json_encode(['first' => $total_used, 'second' => $total_available]));
                break;
            case 'nsmart_companies':                    
                    $this->db->select('*');
                    $this->db->from('clients');
                    if( $date_from != '0000-00-00  00:00:00' ){
                        $this->db->where('plan_date_registered >=',date('Y-m-d', strtotime($date_from)));
                        $this->db->where('plan_date_registered <=',date('Y-m-d', strtotime($date_to)));
                    }
                    $query = $this->db->get();
                    $clients = $query->result();
    
                    $this->output->set_output(json_encode(['first' => count($clients)]));
                    break;
            case 'nsmart_sales':
                $this->db->from('clients');
                $this->db->select('*');
                $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'left');
                if(  $date_to !== '0000-00-00 23:59:59'){
                    $this->db->where('clients.plan_date_registered >=',date('Y-m-d', strtotime($date_from)));
                    $this->db->where('clients.plan_date_registered <=',date('Y-m-d', strtotime($date_to)));
                }
                $query = $this->db->get();

                $nsmart_sales = $query->result();

                $nsmart_sales_total = 0;
                foreach ($nsmart_sales as $total) {
                    $nsmart_sales_total += $total->price - $total->discount;
                }
                $this->output->set_output(json_encode(['first' => count($nsmart_sales), 'second' => number_format($nsmart_sales_total, 2, ".", ","),  'nsmart_sales' => $nsmart_sales]));
                break;
            case 'open_invoices':
                $company_id = logged('company_id');
                $this->db->select('*');
                $this->db->from('invoices');
                $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                $this->db->where('invoices.status !=', "Paid");
                $this->db->where('invoices.status !=', "Draft");
                $this->db->where('invoices.status !=', "");
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.date_created >=',date('Y-m-d', strtotime($date_from)));
                $this->db->where('invoices.date_created <',date('Y-m-d' , strtotime($date_to)));
                $this->db->where('invoices.company_id', $company_id);
                $query = $this->db->get();
                $openInvoices = $query->result();

                $this->output->set_output(json_encode(['first' => count($openInvoices), 'second' => null, 'open_invoices' => array_values($openInvoices)]));

                break;
            case 'sales':
                $total_query = [
                    'where' => ['company_id' => logged('company_id'), 'view_flag' => 0,  'date_issued >=' => date('Y-m-d', strtotime($date_from)),
                    'due_date <' => date('Y-m-d', strtotime($date_to))],
                    'table' => 'invoices',
                    'select' => 'SUM(grand_total) AS total_invoice_amount',
                ];
                $resultInvoice = $this->general->get_data_with_param($total_query);

                $total_invoice = 0;
                if ($resultInvoice) {
                    $total_invoice = $resultInvoice[0]->total_invoice_amount;
                }
                $result = number_format($total_invoice, 2, '.', ',');

                $sales_query = [
                    'where' => ['company_id' => logged('company_id'), 'view_flag' => 0,  'date_issued >=' => date('Y-m-d', strtotime($date_from)),
                    'due_date <' => date('Y-m-d', strtotime($date_to))],
                    'table' => 'invoices',
                    'select' => '*',
                ];

                $sales = $this->general->get_data_with_param($sales_query);

                $this->output->set_output(json_encode(['first' => $result, 'second' => null,  'sales' => $sales]));

                break;
            case 'ac_leads':
                $leads_query = [
                    'where' => ['ac_leads.company_id' => logged('company_id'),
                    'DATE(ac_leads.date_created)  >=' => date('Y-m-d', strtotime($date_from)),
                    'DATE(ac_leads.date_created)  <=' => date('Y-m-d', strtotime($date_to)),
                     ],
                    'table' => 'ac_leads',
                    'join' => [
                        [
                            'table' => 'users',
                            'statement' => 'users.id = ac_leads.fk_sr_id',
                            'join_as' => 'left',
                        ],
                        [
                            'table' => 'ac_leadtypes',
                            'statement' => 'ac_leadtypes.lead_id = ac_leads.fk_lead_type_id',
                            'join_as' => 'left',
                        ],
                    ],
                    'groupBy' => 'ac_leadtypes.lead_name',
                    'select' => 'COUNT(ac_leadtypes.lead_name) AS total_leads, ac_leadtypes.lead_name',
                ];
                $total_leads = $this->general->get_data_with_param($leads_query);

                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'total_leads' => $total_leads]));

                break;

            case 'acs_profile':
                $company_id = logged('company_id');
                $dateFrom = date('Y-m-d', strtotime($date_from));
                $dateTo = date('Y-m-d', strtotime($date_to));

                // $acs_profile_query = [
                //     'select' => 'customer_groups.title, COUNT(acs_profile.prof_id) AS total_customer',
                //     'where' => [
                //         'customer_groups.company_id' => logged('company_id'),
                //         'DATE(acs_profile.created_at)  >=' => $dateFrom,
                //         'DATE(acs_profile.created_at)  <=' => $dateTo,
                //     ],
                //     'where_in' => [
                //         'acs_profile.status' => [
                //             'Active w/RAR',
                //             'Active w/RMR',
                //             'Active w/RQR',
                //             'Active w/RYR',
                //             'Inactive w/RMM'
                //         ]
                //     ],
                //     // 'or_where' => ['customer_groups.company_id' => 0],
                //     'groupBy' => ['customer_groups.title'],
                //     'table' => 'customer_groups',
                //     'join' => [
                //         [
                //             'table' => 'acs_profile',
                //             'statement' => 'acs_profile.customer_group_id = customer_groups.id',
                //         ],
                //     ],
                // ];
                // $customer = $this->general->get_data_with_param($acs_profile_query);
                // $this->output->set_output(json_encode(['first' => null, 'second' => null, 'customer' => $customer]));

                $query = $this->db->query("
                    SELECT customer_groups.title, COUNT(acs_profile.prof_id) AS total_customer
                    FROM customer_groups
                    JOIN acs_profile ON acs_profile.customer_group_id = customer_groups.id
                    WHERE 
                        customer_groups.company_id = $company_id
                        AND acs_profile.status IN (
                            'Active w/RAR',
                            'Active w/RMR',
                            'Active w/RQR',
                            'Active w/RYR',
                            'Inactive w/RMM'
                        )
                        AND DATE(acs_profile.created_at) >= '$dateFrom'
                        AND DATE(acs_profile.created_at) <= '$dateTo'
                    GROUP BY 
                        customer_groups.title;

                ");
                $customer = $query->result();
                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'customer' => $customer]));

                // $data = $query->result();



                // $this->db->select('customer_groups.title, COUNT(acs_profile.prof_id) AS total_customer');
                // $this->db->from('customer_groups');
                // $this->db->join('users', 'users.id = customer_groups.user_id', 'left');
                // $this->db->join('acs_profile', 'acs_profile.customer_group_id = customer_groups.id');
                // $this->db->where('customer_groups.company_id', $company_id);
                // $this->db->where_in('acs_profile.status', [
                //     'Active w/RAR',
                //     'Active w/RMR',
                //     'Active w/RQR',
                //     'Active w/RYR',
                //     'Inactive w/RMM'
                // ]);
                // $this->db->group_by('customer_groups.id');

                
                break;
            case 'jobs':
                $this->load->model('Jobs_model');
                $cid = logged('company_id');
                $date_range['from'] = $date_from;
                $date_range['to']   = $date_to;
                $data = $this->Jobs_model->widgetCountJobs($cid,$date_range);
                // $jobs_query = [
                //     'where' => ['jobs.company_id' => logged('company_id'),
                //     'DATE(jobs.date_created)  >=' => date('Y-m-d', strtotime($date_from)),
                //     'DATE(jobs.date_created)  <=' => date('Y-m-d', strtotime($date_to)),
                //      ],
                //     'table' => 'jobs',
                //     'join' => [
                //         [
                //             'table' => 'acs_profile',
                //             'statement' => 'acs_profile.prof_id = jobs.customer_id',
                //         ],
                //         [
                //             'table' => 'job_items',
                //             'statement' => 'job_items.job_id = jobs.id',
                //         ],
                //     ],
                //     'select' => 'jobs.id AS id, jobs.company_id AS company_id, jobs.job_number AS number, jobs.job_type AS type, jobs.job_description AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, jobs.status AS status, jobs.date_created AS date_created, SUM(job_items.cost) AS job_amount',
                // ];

                // echo "<pre>";
                // print_r($jobs_query);
                // $total_jobs = $this->general->get_data_with_param($jobs_query);
                // $this->output->set_output(json_encode(['first' => count($total_jobs), 'second' => null, 'jobs' => $total_jobs]));

                // break;
                $this->output->set_output(json_encode(['first' => count($data), 'second' => null, 'jobs' => $data]));

                break;
            case 'unpaid_invoices':
                
                /*$unpaid_query = [
                    'where' => ['invoices.company_id' => logged('company_id'),  'DATE(invoices.date_created) >=' => date('Y-m-d', strtotime($date_from)),
                    'DATE(invoices.date_created) <=' => date('Y-m-d', strtotime($date_to)), 'invoices.status =' => 'Unpaid'],
                    'table' => 'invoices',
                    'join' => [
                        [
                            'table' => 'payment_records',
                            'statement' => 'payment_records.invoice_id = invoices.id',
                            'join_as' => 'left',
                        ],
                    ],
                    'select' => 'invoices.*', 'payment_records.invoice_amount AS total_amount_paid',
                ];
                $resultInvoice = $this->general->get_data_with_param($unpaid_query);*/

                $company_id = logged('company_id');

                $this->db->from('invoices');
                $this->db->join('payment_records', 'payment_records.invoice_id = invoices.id', 'left');
                $this->db->select('invoices.*', 'payment_records.invoice_amount AS total_amount_paid');
                $this->db->where('invoices.company_id', $company_id);

                if($date_from != '0000-00-00  00:00:00' && $date_to != "") {
                    $this->db->where('invoices.date_created >=', $date_from);
                    $this->db->where('invoices.date_created <=', $date_to);
                }

                $this->db->where('invoices.due_date >=',date('Y-m-d', strtotime('-90 days')));
                $this->db->where('invoices.due_date <',date('Y-m-d'));

                $this->db->where('invoices.status !=', "Paid");
                $this->db->where('invoices.status !=', "Draft");
                $this->db->where('invoices.status !=', "");
                $this->db->where('invoices.view_flag =', 0);
                
                $query = $this->db->get();
                $resultInvoice = $query->result();                

                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'unpaid' => $resultInvoice]));

                break;
            case 'income':
                // $income_query = [
                //     'where' => ['company_id' => logged('company_id'),
                //     'company_id' => logged('company_id'),
                //     'DATE(payment_date)  >=' => date('Y-m-d', strtotime($date_from)),
                //     'DATE(payment_date) <=' => date('Y-m-d', strtotime($date_to))],
                //     'table' => 'payment_records',
                //     'select' => '*',
                // ];
                // $income = $this->general->get_data_with_param($income_query);

                $company_id = logged('company_id');
                $this->db->from('invoices');
                $this->db->select('*');
                $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                $this->db->where('invoices.status', "Paid");
                $this->db->where('invoices.date_created >=',date('Y-m-d', strtotime($date_from)));
                $this->db->where('invoices.date_created <',date('Y-m-d' , strtotime($date_to)));
                $this->db->where('invoices.company_id', $company_id);
                $this->db->order_by("invoices.invoice_number DESC");
                $query = $this->db->get();
                $income = $query->result();



                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'income' => $income]));

                break;
            case 'collection':
                $company_id = logged('company_id');
                if(  $date_to == '0000-00-00 23:59:59'){
                    $this->db->select('*');
                    $this->db->from('invoices');
                    $this->db->where('invoices.status !=', "Paid");
                    $this->db->where('invoices.status !=', "Draft");
                    $this->db->where('invoices.status !=', "");
                    $this->db->where('invoices.company_id', $company_id);
                    $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-90 days')));
                    $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-5 years')));
                    $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                    $data = $this->db->get();
                    $collection = $data->result();
                }else{
                    $this->db->from('invoices');
                    $this->db->select('*');
                    $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                    $this->db->where('invoices.status !=', "Paid");
                    $this->db->where('invoices.status !=', "Draft");
                    $this->db->where('invoices.status !=', "");
                    $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-90 days')));
                    $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-5 years')));
                    $this->db->where('invoices.date_created >=',date('Y-m-d H:i:s', strtotime($date_from)));
                    $this->db->where('invoices.date_created <',date('Y-m-d H:i:s' , strtotime($date_to)));
                    $this->db->where('invoices.company_id', $company_id);
                    $query = $this->db->get();
                    $collection = $query->result();

                }

          

                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'collection' => $collection]));

                break;

            case 'accounting_expense':
                $accounting_expense_filters = [
                    'company_id' => logged('company_id'),
                    'type' => 'all-transactions',
                    'delivery_method' => 'any',
                    'category' => 'all',
                    'start-date' => date('Y-m-d', strtotime($date_from)),
                    'end-date' => date('Y-m-d', strtotime($date_to)),
                ];

                $bills = $this->get_transactions($accounting_expense_filters);

                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'accounting_expense' => $bills]));

                break;
            case 'esign':
                $esign_query = [
                    'where' => ['user_docfile.company_id' => logged('company_id'),
                        'user_docfile.status !=' => 'Deleted',
                        'user_docfile.unique_key <>' => '',
                        'user_docfile.company_id >' => 0,
                        'DATE(user_docfile.created_at)  >=' => date('Y-m-d', strtotime($date_from)),
                        'DATE(user_docfile.created_at)  <=' => date('Y-m-d', strtotime($date_to)), ],

                    'join' => [
                        [
                            'table' => 'acs_profile',
                            'statement' => 'user_docfile.customer_id = acs_profile.prof_id',
                            'join_as' => 'left',
                        ],
                    ],
                    'groupBy' => ['user_docfile.status'],
                    'table' => 'user_docfile',
                 'select' => 'user_docfile.status AS status, COUNT(user_docfile.status) as status_count',
                ];

                $esign = $this->general->get_data_with_param($esign_query);

                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'esign' => $esign]));
                break;
        }
    }

    public function updateListView()
    {
        $id = post('id');
        $val = post('val');
        $this->load->model('widgets_model');

        $query = $this->widgets_model->updateListView($id, $val);
        exit(json_encode(['status' => true]));
    }

    public function apiGetUnpaidInvoices()
    {
        $invoices = $this->event_model->getUnpaidInvoices();
        exit(json_encode(['data' => $invoices]));
    }

    private function getActiveCustomerStatuses()
    {
        return [
            'draft',
            'installed',
            'active',
            'lead',
            'scheduled',
            'service customer',
        ];
    }

    private function getTotalRecurringPayment()
    {
        // SELECT SUM(acs_billing.mmr) AS TOTAL_RECURRING FROM acs_billing JOIN acs_alarm ON acs_billing.fk_prof_id = acs_alarm.fk_prof_id JOIN acs_profile ON acs_profile.prof_id = acs_alarm.fk_prof_id WHERE acs_alarm.acct_type = "IN-HOUSE" AND acs_profile.status = "Active";
        $companyId = logged('company_id');
        $this->db->select('SUM(acs_billing.mmr) AS SUM_RECURRING_PAYMENT');
        $this->db->from('acs_billing');
        $this->db->join('acs_alarm', 'acs_billing.fk_prof_id = acs_alarm.fk_prof_id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = acs_alarm.fk_prof_id', 'left');
        $this->db->where("acs_profile.status = 'Installed'");
        $query = $this->db->get();
        $result = $query->row();

        return $result;
        // return '$' . number_format($result->total, 2);
        // $this->db->select('SUM(billing.transaction_amount + 0) AS total', false);
        // $this->db->from('acs_billing billing');
        // $this->db->join('acs_profile profile', 'profile.prof_id = billing.fk_prof_id', 'left');
        // $this->db->where('profile.company_id', $companyId);
        // $this->db->where_in('LOWER(profile.status)', $this->getActiveCustomerStatuses());
        // $query = $this->db->get();
        // $result = $query->row();
        // return '$' . number_format($result->total, 2);
    }

    private function getAgreementsToExpireIn30Days()
    {
        $companyId = logged('company_id');
        $this->db->select('COUNT(billing.recurring_end_date) AS total', false);
        $this->db->from('acs_billing billing');
        $this->db->join('acs_profile profile', 'profile.prof_id = billing.fk_prof_id', 'left');
        $this->db->where('profile.company_id', $companyId);
        $this->db->where("STR_TO_DATE(billing.recurring_end_date, '%m/%d/%Y') BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)");
        $this->db->where_in('LOWER(profile.status)', $this->getActiveCustomerStatuses());
        $query = $this->db->get();
        $result = $query->row();

        return $result->total;
    }

    public function apiGetRecurringPaymentCustomers()
    {
        $companyId = logged('company_id');
        $this->db->select('profile.prof_id, profile.customer_type, profile.business_name, profile.first_name, profile.last_name, profile.email, billing.transaction_amount AS info, profile.phone_m', false);
        $this->db->from('acs_billing billing');
        $this->db->join('acs_profile profile', 'profile.prof_id = billing.fk_prof_id', 'left');
        $this->db->where('profile.company_id', $companyId);
        $this->db->where_in('LOWER(profile.status)', $this->getActiveCustomerStatuses());
        $query = $this->db->get();
        $results = $query->result();

        foreach ($results as $result) {
            $result->info = '$'.number_format($result->info, 2);
        }

        header('content-type: application/json');
        echo json_encode(['data' => $results]);
    }

    public function apiGetAgreementsToExpireIn30DaysCustomers()
    {
        $companyId = logged('company_id');
        $this->db->select('profile.prof_id, profile.customer_type, profile.business_name, profile.first_name, profile.last_name, profile.email, billing.recurring_end_date AS info, profile.phone_m', false);
        $this->db->from('acs_billing billing');
        $this->db->join('acs_profile profile', 'profile.prof_id = billing.fk_prof_id', 'left');
        $this->db->where('profile.company_id', $companyId);
        $this->db->where("STR_TO_DATE(billing.recurring_end_date, '%m/%d/%Y') BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)");
        $this->db->where_in('LOWER(profile.status)', $this->getActiveCustomerStatuses());
        $query = $this->db->get();
        $results = $query->result();

        foreach ($results as $result) {
            $dateTime = DateTime::createFromFormat('m/d/Y', $result->info);
            $dateTimeStr = $dateTime->format('M d, Y');
            $result->info = $dateTimeStr;
        }

        header('content-type: application/json');
        echo json_encode(['data' => $results]);
    }

    public function apiRenameWidget()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);

            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['id' => $widgetId, 'name' => $widgetName] = $payload;
        $companyId = logged('company_id');

        $this->db->where('company_id', $companyId);
        $this->db->where('widget_id', $widgetId);
        $name = $this->db->get('widget_custom_names')->row();

        if ($name) {
            $this->db->where('id', $name->id);
            $this->db->update('widget_custom_names', [
                'name' => $widgetName,
            ]);
        } else {
            $this->db->insert('widget_custom_names', [
                'company_id' => $companyId,
                'widget_id' => $widgetId,
                'name' => $widgetName,
            ]);
        }

        $this->db->where('id', $name ? $name->id : $this->db->insert_id());
        $name = $this->db->get('widget_custom_names')->row();
        echo json_encode(['data' => $name]);
    }

    public function apiGetWidgetNames()
    {
        $widgets = $this->db->get('widgets')->result();

        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $customNames = $this->db->get('widget_custom_names')->result();

        $customNamesMap = [];
        foreach ($customNames as $customName) {
            $customNamesMap[$customName->widget_id] = $customName;
        }

        foreach ($widgets as $widget) {
            if (array_key_exists($widget->w_id, $customNamesMap)) {
                $widget->custom = $customNamesMap[$widget->w_id];
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $widgets]);
    }

    public function getInbox()
    {
        $this->load->view('dashboard/inbox');
    }

    public function getSMS()
    {
        $this->load->view('dashboard/sms');
    }

    public function getPhoneCalls()
    {
        $this->load->view('dashboard/calls');
    }

    public function ac_dashboard_sort()
    {
        // $user_id = logged('id');
        $input = $this->input->post();
        if ($this->customer_ad_model->update_data($input, 'ac_dashboard_sort', 'acds_id')) {
            echo 'Module Sort Updated!';
        } else {
            echo 'Error';
        }
    }

    public function blank()
    {
        $get = $this->input->get();
        $this->page_data['page_name'] = $get['page'];
        $this->load->view('blank', $this->page_data);
    }

    public function saveFeed()
    {
        postAllowed();

        $comp_id = logged('company_id');

        $id = $this->feeds_model->create([
            'company_id' => $comp_id,
            'customer_id' => post('recipient_id'),
            'subject' => post('feed_subject'),
            'description' => post('feed_description'),
        ]);

        $this->activity_model->add('New Feeds Added Created by User:'.logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Feed Added Successfully');

        redirect('dashboard');
    }

    public function todays_stats()
    {
        $this->load->model('Jobs_model');
        $this->load->model('Tickets_model');
        $this->load->model('Invoice_model');

        $cid = logged('company_id');
        // $date_from = date('Y-m-d', strtotime('last monday'));
        $date_from = '2023-11-10';
        $date_to = date('Y-m-d', strtotime('sunday this week'));

        $payment = $this->event_model->getTodayStats(); // fetch current data sales on jobs , amount is on job_payments.amount
        $paymentInvoices = $this->event_model->getCollected(); // fetch current data sales on jobs , amount is on job_payments.amount
        // $jobsDone = $this->event_model->getAllJobsByCompanyIdAndDateIssued($cid, ['from' => $date_from, 'to' => $date_to]);

        $jobsDone = $this->Jobs_model->getAllCompletedJobsByCompanyIdAndDateRange($cid, ['from' => $date_from, 'to' => $date_to]);
        $ticketsDone = $this->Tickets_model->getAllCompletedTicketsByCompanyIdAndDateRange($cid, ['from' => $date_from, 'to' => $date_to]);
        $total_jobs_done = count($jobsDone) + count($ticketsDone);

        $invoiceDue = $this->Invoice_model->getTotalDueByCompanyIdAndDateRange($cid, ['from' => $date_from, 'to' => $date_to]);
        $total_amount_due = $invoiceDue->total_amount;

        $invoicePaid = $this->Invoice_model->getCompanyTotalAmountPaidInvoices($cid, ['from' => $date_from, 'to' => $date_to]);
        $total_amount_paid = $invoicePaid->total_paid;

        $service_project_income = $this->Invoice_model->gerServiceProjectvieIncome($cid);
        $invoice_amount = $this->Invoice_model->getInvoiceAmount($cid);
        $jobs_completed = $this->Invoice_model->getJobsCompleted($cid);
        // $jobs_completed = 0;
        $new_jobs = $this->Invoice_model->getNewJobs($cid);
        $earned = $this->Invoice_model->getEarned($cid);
        $lost_accounts = $this->Invoice_model->getLostAccounts($cid);

        $collectedAccounts = $this->event_model->getAccountSituation('Collections'); // collection account count, if Collection Date Office Info is set
        $lostAccounts = $this->event_model->getAccountSituation('Cancelled'); // lost account count, if Cancel Date Office Info is set
        $onlineBookingCount = $this->event_model->getLeadSource('Online Booking');
        $data_arr = ['success' => true, 'data' => $payment, 'paymentInvoice' => $paymentInvoices, 'onlineBooking' => $onlineBookingCount, 'jobsCompleted' => $total_jobs_done, 'lostAccount' => $lostAccounts, 'collectedAccounts' => $collectedAccounts, 'invoice_amount_due' => $total_amount_due, 
        'collected_amount' => $total_amount_paid , 'service_project_income'=>$service_project_income, 'invoice_amount'=>number_format($invoice_amount->total, 2, ".", ","), 'jobs_completed'=>number_format($jobs_completed->total, 0, ".", ","),
        'new_jobs'=> number_format($new_jobs->total, 0, ".", ","), 'earned'=>number_format($earned->total, 2, ".", ",") ,'lost_accounts'=>number_format($lost_accounts->total, 0, ".", ",") ];
        exit(json_encode($data_arr));
    }

    public function today()
    {
        $this->load->model('Jobs_model');
        $this->load->model('Tickets_model');
        $this->load->model('Invoice_model');

        $cid = logged('company_id');
        // $date_from = date('Y-m-d', strtotime('last monday'));
        $date_from = '2023-11-10';
        $date_to = date('Y-m-d', strtotime('sunday this week'));

        $sales = $this->event_model->getTodayStatsSales($cid);
        $jobsCreated = $this->event_model->getTodayStatsJobsCreated($cid);
        $jobsDone = $this->event_model->getTodayJobsDone($cid);
        $collected = $this->event_model->getTodayCollected($cid);
        $jobsCanceled = $this->event_model->getTodayStatsJobsCanceled($cid);
        $serviceSceduled = $this->event_model->getTotalServiceScheduled($cid);
    

        
        $data_arr = ['success' => true, 'data' => $payment,
        'sales' =>number_format( $sales->total, 2, ".", ","), 'jobsCreated' => $jobsCreated->total, 'jobsDone' => $jobsDone->total,
        'collected' =>number_format( $collected, 2, ".", ",") , 'jobsCanceled'=>$jobsCanceled->total,'serviceSceduled'=>$serviceSceduled->total];
        exit(json_encode($data_arr));
    }


    public function upcoming_jobs()
    {
        $companyId = logged('company_id');

        if ($companyId == 1) {
            $companies = $this->event_model->getCompanies();
        } else {
            $upcomingJobs = $this->event_model->getRecentCustomer();
        }
        $data_arr = ['success' => true, 'companies' => $companies, 'upcomingJobs' => $upcomingJobs];
        exit(json_encode($data_arr));
    }

    public function ajax_recent_customers()
    {
        $this->load->model('AcsProfile_model');

        $is_success = 1;
        $cid = logged('company_id');

        $recentCustomers = $this->AcsProfile_model->getAllRecentCustomerByCompanyId($cid, 10);
        if (empty($recentCustomers)) {
            $is_success = 0;
        }

        $data_arr = ['success' => $is_success, 'recentCustomers' => $recentCustomers];
        exit(json_encode($data_arr));
    }

    public function get_all_customer()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');

        $cid = logged('company_id');

        $data_arr = ['success' => $is_success, 'customer' => count($customer)];
        exit(json_encode($data_arr));
    }

    public function get_all_customer_group()
    {
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $cid = logged('company_id');

        $customer = $this->customer_ad_model->getCustomerGroupByCompanyId($cid);
        $data_arr = ['success' => $is_success, 'customer' => $customer];
        exit(json_encode($data_arr));
    }

    public function ajax_recent_customers_thubnails()
    {
        $this->load->model('AcsProfile_model');

        $is_success = 1;
        $cid = logged('company_id');

        $recentCustomers = $this->AcsProfile_model->getAllRecentCustomerByCompanyId2($cid, 10);
        if (empty($recentCustomers)) {
            $is_success = 0;
        }

        $data_arr = ['success' => $is_success, 'recentCustomers' => $recentCustomers];
        exit(json_encode($data_arr));
    }

    public function ajax_recent_leads()
    {
        $this->load->model('Customer_advance_model');

        $is_success = 1;
        $cid = logged('company_id');

        $recentLeads = $this->Customer_advance_model->getAllRecentLeadsByCompanyId($cid, 10);
        if (empty($recentLeads)) {
            $is_success = 0;
        }

        $data_arr = ['success' => $is_success, 'recentLeads' => $recentLeads];
        exit(json_encode($data_arr));
    }

    public function customer_status()
    {
        $customerStatus = $this->event_model->getCustomerStatusWithCount(); // fetch Sales Rep and customer they are assigned to
        $data_arr = ['success' => true, 'status' => $customerStatus];
        exit(json_encode($data_arr));
    }

    public function sales_leaderboard()
    {
        if (logged('company_id') != 58) {
            return $this->apiGetSalesLeaderBoard();
        }

        $salesLeaderboard = $this->event_model->getSalesLeaderboards(); // fetch Sales Rep and customer they are assigned to
        $revenue = [];
        foreach ($salesLeaderboard as $sl) {
            if (logged('company_id') == 58) {
                array_push($revenue, $this->event_model->getSalesRepRevenueSolar($sl->id));
            } else {
                array_push($revenue, $this->event_model->getSalesRepRevenue($sl->id));
            }
        }
        $data_arr = ['success' => true, 'salesLeaderboard' => $salesLeaderboard, 'revenue' => $revenue];
        exit(json_encode($data_arr));
    }

    public function apiGetSalesLeaderBoard()
    {
        $companyId = logged('company_id');
        $this->db->select('users.id as employee_id,SUM(job_payments.amount) AS total_revenue,users.LName as lastname,users.FName as firstname, users.id as id, users.profile_img as avatar, COUNT(jobs.customer_id) as total_customers');
        $this->db->join('job_payments', 'job_payments.job_id = jobs.id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->where('jobs.company_id', $companyId);
        $this->db->where('jobs.status', 'Completed');
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = DATE_FORMAT(jobs.start_date, "%Y")');
        $this->db->group_by('users.id');
        $this->db->order_by('total_revenue', 'DESC');
        $query = $this->db->get('jobs');
        $result = $query->result_array();
        $result = array_map(function ($leaderboard) {
            $leaderboard['avatar'] = userProfileImage((int) $leaderboard['id']);

            return $leaderboard;
        }, $result);

        header('content-type: application/json');
        exit(json_encode(['data' => $result, 'is_new' => true]));
    }

    public function tech_leaderboard()
    {
        if (logged('company_id') != 58) {
            return $this->apiGetTechLeaderBoard();
        }

        $techLeaderboards = $this->event_model->getTechLeaderboards(); // fetch Technicians and customer they are assigned to
        $revenue = [];
        $customerCount = [];
        foreach ($techLeaderboards as $tl) {
            $technician = $tl->FName.' '.$tl->LName;
            if (logged('company_id') == 58) {
                array_push($revenue, $this->event_model->getTechRevenueSolar($tl->id));
                array_push($customerCount, $this->event_model->getJobCountPerId($tl->id));
            } else {
                array_push($revenue, $this->event_model->getTechRevenue($tl->id));
                array_push($customerCount, $this->event_model->getJobCountPerId($tl->id));
            }
        }
        $data_arr = ['success' => true, 'techLeaderboard' => $techLeaderboards, 'revenue' => $revenue, 'customerCount' => $customerCount];
        exit(json_encode($data_arr));
    }

    public function apiGetTechLeaderBoard()
    {
        $companyId = logged('company_id');
        $this->db->select('jobs.id,job_payments.amount,jobs.employee2_id,jobs.employee3_id,jobs.employee4_id,jobs.employee5_id,jobs.employee6_id');
        $this->db->join('job_payments', 'job_payments.job_id = jobs.id', 'left');
        $this->db->where('jobs.company_id', $companyId);
        $this->db->where('jobs.status', 'Completed');
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = DATE_FORMAT(jobs.start_date, "%Y")');
        $jobsQuery = $this->db->get('jobs');
        $jobs = $jobsQuery->result_array();

        $employeeFields = [
            'employee2_id',
            'employee3_id',
            'employee4_id',
            'employee5_id',
            'employee6_id',
        ];
        $techIds = [];
        foreach ($jobs as $job) {
            foreach ($employeeFields as $field) {
                $employeeId = $job[$field];
                if ($employeeId && !in_array($employeeId, $techIds)) {
                    array_push($techIds, $employeeId);
                }
            }
        }

        if (empty($techIds)) {
            header('content-type: application/json');
            exit(json_encode(['data' => [], 'is_new' => true]));
        }

        $this->db->select('users.LName as lastname,users.FName as firstname,users.id as id, users.profile_img as avatar');
        $this->db->where_in('users.id', $techIds);
        $employeesQuery = $this->db->get('users');
        $employees = $employeesQuery->result_array();

        $result = [];
        foreach ($employees as $employee) {
            foreach ($jobs as $job) {
                foreach ($employeeFields as $field) {
                    $employeeId = $job[$field];
                    if ($job[$field] != $employee['id']) {
                        continue;
                    }

                    if (!array_key_exists($employee['id'], $result)) {
                        $result[$employee['id']] = array_merge($employee, [
                            'total_revenue' => 0,
                            'total_customers' => 0,
                            'avatar' => userProfileImage((int) $employee['id']),
                            'employee_id' => $employee['id'],
                        ]);
                    }

                    $result[$employee['id']]['total_revenue'] += (float) $job['amount'];
                    ++$result[$employee['id']]['total_customers'];
                    break;
                }
            }
        }

        $result = array_values($result);
        usort($result, function ($itemA, $itemB) {
            return $itemB['total_revenue'] - $itemA['total_revenue'];
        });

        header('content-type: application/json');
        exit(json_encode(['data' => $result, 'is_new' => true]));
    }

    // public function jobs_status()
    // {
    //     //$jobsStatus=$this->event_model->getAllJobsByCompanyId(logged('company_id'));
    //     $jobsStatus=$this->event_model->getJobStatusWithCount(); // fetch Sales Rep and customer they are assigned to\

    //     $data_arr = array("success" => true, "jobsStatus" => $jobsStatus);
    //     die(json_encode($data_arr));
    // }

    public function statusCount()
    {
        $DATE = $this->input->post('DATE');
        $data = $this->event_model->getStatusCount();
        
        if ($DATE == 'MONTH') {
            echo json_encode($data['CURRENT_MONTH_COUNT']);
        } elseif ($DATE == 'YEAR') {
            echo json_encode($data['CURRENT_YEAR_COUNT']);
        } else {
            echo json_encode(['error' => 'Invalid date parameter']);
        }
    }

    public function accounting_sales()
    {
        $mmr = $this->AcsProfile_model->getCustomerMMR(logged('company_id'));
        $data_arr = ['Success' => true, 'mmr' => $mmr];
        exit(json_encode($data_arr));
    }

    public function income_subscription()
    {
        $mmr = $this->AcsProfile_model->getSubscription(logged('company_id'));
        $data_arr = ['Success' => true, 'mmr' => $mmr];
        exit(json_encode($data_arr));
    }

    public function income_subscription_filter_status()
    {
        $status = $this->input->get('status');
        $mmr = $this->AcsProfile_model->getSubscriptionByStatus(logged('company_id'), $status);
        $data_arr = ['Success' => true, 'mmr' => $mmr, 'status' => $status];
        exit(json_encode($data_arr));
    }
    

    public function estimate_thumbnail()
    {
        $companyId = logged('company_id');
        $estimates = $this->estimate_model->getAllOpenEstimatesByCompanyId($companyId);
        $expired_estimates = $this->estimate_model->getExpiredEstimatesByCompanyId($companyId);
        $data_arr = ['Success' => true, 'estimates' => count($estimates), 'expired_estimates' => count($expired_estimates)];
        exit(json_encode($data_arr));
    }

    public function past_due_invoices()
    {
        $this->load->model('widgets_model');
        $past_due = $this->widgets_model->getCurrentCompanyOverdueInvoices2();

        //$past_due = $this->AcsProfile_model->getCurrentCompanyOverdue(logged('company_id'));
        //$past_due = $this->AcsProfile_model->getSubscription(logged('company_id'));
        
        $data_arr = ['Success' => true, 'past_due' => $past_due];
        exit(json_encode($data_arr));
    }

    public function nsmart_sales()
    {
        $this->load->model('widgets_model');
        $nsmart_sales = $this->widgets_model->getNsmartSales();

        $data_arr = ['Success' => true, 'nsmart_sales' => $nsmart_sales];
        exit(json_encode($data_arr));
    }


    public function open_invoices_graph()
    {
        $open_invoices = $this->AcsProfile_model->getCurrentCompanyOpenInvoices(logged('company_id'));

        $data_arr = ['Success' => true, 'open_invoices' => $open_invoices];
        exit(json_encode($data_arr));
    }

    public function jobs_thumbnail_graph()
    {
        $this->load->model('Jobs_model');

        $cid = logged('company_id');
        $jobs = $this->Jobs_model->widgetCountJobs($cid, []);
        $data_arr = ['Success' => true, 'jobs' => $jobs, 'total_jobs' => count($jobs)];
        exit(json_encode($data_arr));
    }

    public function business_snapshot_income_thumbnail_graph()
    {
        $income = $this->invoice_model->get_company_payments_business_snapshot(logged('company_id'));
        $data_arr = ['Success' => true, 'income' => $income];
        exit(json_encode($data_arr));
    }

    public function income_thumbnail_graph()
    {
        $income = $this->invoice_model->get_company_payments_graph(logged('company_id'));
        $data_arr = ['Success' => true, 'income' => $income];
        exit(json_encode($data_arr));
    }

    public function income_thumbnail_comparison_graph()
    {
        $income = $this->invoice_model->get_company_payments_business_snapshot(logged('company_id'));
        $prev_income = $this->invoice_model->get_company_payments_business_snapshot_prev(logged('company_id'));
        $data_arr = ['Success' => true, 'income' => $income, 'prev_income' => $prev_income];
        exit(json_encode($data_arr));
    }

    public function business_snapshot_expense()
    {   
        $data['business_snapshot']= true;
        $income =set_expense_graph_data($data);
        $data_arr = ['Success' => true, 'income' => $income];
        exit(json_encode($data_arr));
    }

    public function unpaid_invoices_graph()
    {
        $CI = &get_instance();
        $CI->load->model('Invoice_model', 'invoice_model');
        $CI->load->model('Payment_records_model');
        $company_id = logged('company_id');
        // $unpaid = $CI->Payment_records_model->getTotalInvoiceAmountByCompanyId($company_id);

        //$unpaid = $CI->invoice_model->getUnpaidInvoicesByCompanyId($company_id);
        $unpaid = $CI->invoice_model->getUnpaidInvoicesByCompanyIdV2($company_id);
        
        $data_arr = ['Success' => true, 'unpaid_invoices' => $unpaid];
        exit(json_encode($data_arr));
    }

    public function collections_graph()
    {
        $CI = &get_instance();
        $CI->load->model('Invoice_model', 'invoice_model');
        $CI->load->model('Payment_records_model');

        $company_id = logged('company_id');
        
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-90 days')));
        $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-5 years')));
        $this->db->where('invoices.company_id', $company_id);

        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $data = $this->db->get();
        $collection = $data->result();


        $data_arr = ['Success' => true, 'collection' => $collection];
        exit(json_encode($data_arr));
    }

    public function sales_graph()
    {
        $CI = &get_instance();
        $CI->load->model('Invoice_model', 'invoice_model');
        $CI->load->model('Payment_records_model');
        $company_id = logged('company_id');

        $resultInvoice = $CI->invoice_model->getTotalInvoiceAmountByCompanyIdSalesGraph($company_id);
        $data_arr = ['Success' => true, 'open_invoices' => $resultInvoice];
        exit(json_encode($data_arr));
    }

    public function leads_graph()
    {
        $leads = $this->customer_ad_model->get_leads_data_graph();
        $data_arr = ['Success' => true, 'leads' => $leads];
        exit(json_encode($data_arr));
    }

    public function accounting_expense()
    {
        $accounting_expense_filters = [
            'company_id' => logged('company_id'),
            'type' => 'all-transactions',
            'delivery_method' => 'any',
            'category' => 'all',
            'start-date' => date('Y-m-d', strtotime(date('m/d/Y').' -365 days')),
            'end-date' => date('Y-m-d'),
        ];

        $bills = $this->get_transactions($accounting_expense_filters);
        $data_arr = ['Success' => true, 'accounting_expense' => $bills];
        exit(json_encode($data_arr));
    }

    public function jobs()
    {
        $jobsDone = $this->event_model->getAllJobs();
        $data_arr = ['success' => true, 'jobsDone' => $jobsDone];
        exit(json_encode($data_arr));
    }

    public function getLeadSource()
    {
        // $this->page_data['leadSources']=$this->event_model->getLeadSourceWithCount(); // fetch Lead Sources
    }

    public function ajax_coupon_codes($type)
    {
        $this->load->model('OfferCodes_model');

        $is_used = 0;
        if( $type == 'used' ){  
            $coupon_codes = $this->OfferCodes_model->getAllUsed();
            $is_used = 1;
        }else{
            $coupon_codes = $this->OfferCodes_model->getAllNotUsed();
        }

        $this->page_data['coupon_codes'] = $coupon_codes;
        $this->page_data['is_used']      = $is_used;
        $this->load->view('v2/pages/offer_codes/ajax_coupon_codes', $this->page_data);
    }

    public function ajax_getting_started()
    {
        $this->load->model('Jobs_model');
        $this->load->model('Taskhub_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('BookingCategory_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('Users_model');

        $cid = logged('company_id');
        $user_id = logged('id');

        $isWithJobs     = $this->Jobs_model->getJob($cid);
        $isWithTaskHub  = $this->Taskhub_model->getAllByCompanyId($cid);
        $totalCustomers = $this->AcsProfile_model->countAllCustomerByCompanyId($cid);

        $args = array('company_id' => logged('company_id'));
		$totalOnlineBooking   = $this->BookingCategory_model->getByWhere($args);
        $isWithOnlinePayments = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($cid);         
        $totalCompanyUsers    = $this->Users_model->countAllCompanyUsers($cid);

        $this->page_data['isWithJobs']     = $isWithJobs;
        $this->page_data['isWithTaskHub']  = $isWithTaskHub;
        $this->page_data['totalCustomers'] = $totalCustomers;
        $this->page_data['totalOnlineBooking'] = $totalOnlineBooking;
        $this->page_data['isWithOnlinePayments'] = $isWithOnlinePayments;
        $this->page_data['totalCompanyUsers'] = $totalCompanyUsers;
        $this->load->view('v2/pages/dashboard/ajax_getting_started', $this->page_data);
    }

    public function ajax_send_download_app_link()
    {
        $is_success = 1;
        $msg = '';

        $post = $this->input->post();

        $body = $this->sendDownloadAppLink($post);
        $mail = email__getInstance();
        $recipient_name = $post['test_email_recipient'];
        $mail->addAddress('bryannrevina@nsmartrac.com', 'bryannrevina@nsmartrac.com');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        if(!$mail->Send()){
            $is_success = 1;
            $msg = 'Cannot process request. Please try again later.';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function sendDownloadAppLink($post)
    {
        $this->page_data['data'] = $post;
        return $this->load->view('v2/pages/dashboard/send_download_link_app_template', $this->page_data, true);
    }

    public function ajax_customer_ledgers_backup($customer_id)
    {
        $this->load->model('Payment_records_model');
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');    
        $this->load->model('Users_model');    
        $this->load->model('Jobs_model');

        $cid               = $customer_id;
        $company_id        = logged('company_id');
        //$ledger_payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $companyId);
        $ledger_invoices   = $this->invoice_model->getAllByCustomerIdAndCompanyId($cid, $companyId);

        $customer_ledger = [];
        
        foreach( $ledger_invoices as $ledger_invoice ){
            $date = date("m/d/y", strtotime($ledger_invoice->date_issued));
            $user = $this->Users_model->getUserByID($ledger_invoice->user_id);

            if( $company_id == 139 || $company_id == 1 ){
                $description =  date('F', strtotime($ledger_invoice->due_date)) . ' rent';
                if( $invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($invoice->job_id, $invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }   
            }else{
                $description = 'Issued invoice number ' . $ledger_invoice->invoice_number;
                if( $invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($invoice->job_id, $invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }
            }

            $customer_ledger[$date][] = [
                'id' => $ledger_invoice->id,
                'user' => $user ? $user->FName . ' ' . $user->LName : '---',
                'payment_method' => '---',      
                'type' => 'income',                
                'date' => $date,
                'description' => $description,
                'amount' => $ledger_invoice->grand_total,
                'late_fee' => $ledger_invoice->late_fee,
                'date_created' => $ledger_invoice->date_created
            ];

            $ledger_payments = $this->Payment_records_model->getAllByInvoiceId($ledger_invoice->id);            
            foreach( $ledger_payments as $p ){
                $date = date("m/d/y", strtotime($p->payment_date));
                $user = $this->Users_model->getUserByID($p->user_id);
                $payment_method = $p->payment_method == 'cc' ? 'Credit Card' : ucwords($p->payment_method); 

                $customer_ledger[$date][] = [
                    'id' => $p->id,
                    'user' => $user ? $user->FName . ' ' . $user->LName : '---',
                    'payment_method' => $payment_method,
                    'type' => 'payment',          
                    'date' => $date,      
                    'description' => $description,                    
                    'amount' => $p->invoice_amount,
                    'date_created' => $p->date_created
                ];
            }
        }

        $this->page_data['ledger'] = $customer_ledger;        
        $this->load->view('v2/widgets/accounting/ajax_ledger_table_list', $this->page_data);
    }    

    public function ajax_customer_ledgers($customer_id)
    {
        $this->load->model('Payment_records_model');
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');    
        $this->load->model('Users_model');    
        $this->load->model('Jobs_model');

        $cid               = $customer_id;
        $company_id        = logged('company_id');
        //$ledger_payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $companyId);
        $ledger_invoices   = $this->invoice_model->getAllByCustomerIdAndCompanyId($cid, $companyId);

        $customer   = $this->AcsProfile_model->getByProfId($cid);
        $customer_address = $customer->mail_add . ' ' . $customer->state . ', ' . $customer->city . ' ' . $customer->zip_code;

        $customer_ledger = [];
        $g_total_payment = 0;
        $g_total_income  = 0;
        foreach( $ledger_invoices as $ledger_invoice ){
            $date = date("m/d/y", strtotime($ledger_invoice->date_issued));
            $user = $this->Users_model->getUserByID($ledger_invoice->user_id);

            if( $company_id == 139 || $company_id == 1 ){
                $description =  date('F', strtotime($ledger_invoice->due_date)) . ' rent';
                if( $ledger_invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($ledger_invoice->job_id, $ledger_invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }   
            }else{
                $description = 'Issued invoice number ' . $ledger_invoice->invoice_number;
                if( $ledger_invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($ledger_invoice->job_id, $ledger_invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }
            }

            $ledger_payments = $this->Payment_records_model->getAllByInvoiceId($ledger_invoice->id);            
            $total_payment = 0;
            $payment_method = '---';
            foreach( $ledger_payments as $p ){
                $total_payment += $p->invoice_amount;
                $payment_method = $p->payment_method == 'cc' ? 'Credit Card' : ucwords($p->payment_method); 
            }

            $g_total_income  += $ledger_invoice->grand_total;
            $g_total_payment += $total_payment;

            $customer_ledger[$date][] = [
                'id' => $ledger_invoice->id,
                'user' => $user ? $user->FName . ' ' . $user->LName : '---',
                'payment_method' => $payment_method,                
                'type' => 'income',                
                'date' => $date,
                'description' => $description,
                'amount' => $ledger_invoice->grand_total,
                'payment' => $total_payment,
                'late_fee' => $ledger_invoice->late_fee,
                'date_created' => $ledger_invoice->date_created
            ];
        }

        $balance = $g_total_income - $g_total_payment;
        $this->page_data['customer_address'] = $customer_address;
        $this->page_data['total_income']     = $g_total_income;
        $this->page_data['total_payment']    = $g_total_payment;
        $this->page_data['balance'] = $balance;        
        $this->page_data['ledger']  = $customer_ledger;        
        $this->load->view('v2/widgets/accounting/ajax_ledger_table_list', $this->page_data);
    }
    
    public function saveDashboardPreference() {
        $postData = $this->input->post();
        $user_id = logged('id');
        $company_id = logged('company_id');
    
        $column = ($postData['type'] === 'thumbnail') ? 'thumbnail' : 'widget';
    
        $existingPref = $this->db->get_where('dashboard_preference', ['user_id' => $user_id, 'company_id' => $company_id])->row_array();
    
        $presetIDs = isset($postData['preset_data']) ? json_encode($postData['preset_data']) : '[]';
    
        $data = [$column => $presetIDs];
    
        if ($existingPref) {
            $this->general->update_with_key_field($data, $company_id, 'dashboard_preference', 'company_id');
        }
        else {
            $insertData = ['user_id' => $user_id, 'company_id' => $company_id, $column => $presetIDs];
            $this->db->insert('dashboard_preference', $insertData);
        }
    }
    
    public function showHideThumbnails() {
        $postData = $this->input->post();
        $user_id = logged('id');
        $company_id = logged('company_id');
    
        $this->saveDashboardPreference();

        $thumbnailWidgetQuery = ['select' => '*', 'table' => 'dashboard_thumbnail_widget', 'where' => ['id' => $postData['id'], 'category' => $postData['category']], ];
        $this->page_data['thumbnailsWidgetCard'] = $this->general->get_data_with_param($thumbnailWidgetQuery) [0];
    
        echo $this->load->view("v2/dashboard/$postData[type]/$postData[category]", $this->page_data, true);
    }

    public function thumbnailWidgetRequest() {
        $user_id = logged('id');
        $company_id = logged('company_id');
        // $postData = $this->input->post();
        // Temp only for testing
        $postData = $this->input->post() ? : $this->input->get();
    
        $data = $this->Dashboard_model->fetchThumbnailWidgetData($postData['category'], $postData['dateFrom'], $postData['dateTo'], $postData['filter3']);
    
        switch ($postData['category']) {
            case 'subscription_revenue':
                $graphData = ['GRAPH' => [], 'TOTAL_SUBSCRIPTION_REVENUE' => 0, 'TOTAL_SUBSCRIBERS' => count($data) ];
    
                $accumulativeValue = 0.0;
                foreach ($data as $datas) {
                    $accumulativeValue += $datas->mmr;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = number_format($accumulativeValue, 2, '.', '');
                }
    
                $graphData['TOTAL_SUBSCRIPTION_REVENUE'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'sales':
                $graphData = ['GRAPH' => [], 'TOTAL_AMOUNT' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0.0;
                foreach ($data as $datas) {
                    $accumulativeValue += $datas->total;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = number_format($accumulativeValue, 2, '.', '');
                }
    
                $graphData['TOTAL_AMOUNT'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'unpaid_invoices':
                $graphData = ['GRAPH' => [], 'TOTAL_AMOUNT' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0.0;
                foreach ($data as $datas) {
                    $accumulativeValue += $datas->total;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = number_format($accumulativeValue, 2, '.', '');
                }
    
                $graphData['TOTAL_AMOUNT'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'past_due_invoices':
                $graphData = ['GRAPH' => [], 'TOTAL_AMOUNT' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0.0;
                foreach ($data as $datas) {
                    $accumulativeValue += $datas->total;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = number_format($accumulativeValue, 2, '.', '');
                }
    
                $graphData['TOTAL_AMOUNT'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'open_invoices':
                $graphData = ['GRAPH' => [], 'TOTAL_AMOUNT' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0.0;
                foreach ($data as $datas) {
                    $accumulativeValue += $datas->total;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = number_format($accumulativeValue, 2, '.', '');
                }
    
                $graphData['TOTAL_AMOUNT'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'job':
                $graphData = ['GRAPH' => [], 'TOTAL_JOBS' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0;
                foreach ($data as $datas) {
                    $accumulativeValue += 1;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = $accumulativeValue;
                }
    
                $graphData['TOTAL_JOBS'] = $accumulativeValue;
                echo json_encode($graphData);
            break;
            case 'income':
                $graphData = ['GRAPH' => [], 'TOTAL_AMOUNT' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0.0;
                foreach ($data as $datas) {
                    $accumulativeValue += $datas->total;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = number_format($accumulativeValue, 2, '.', '');
                }
    
                $graphData['TOTAL_AMOUNT'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'collections':
                $graphData = ['GRAPH' => [], 'TOTAL_AMOUNT' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0.0;
                foreach ($data as $datas) {
                    $accumulativeValue += $datas->total;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = number_format($accumulativeValue, 2, '.', '');
                }
    
                $graphData['TOTAL_AMOUNT'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'estimates':
                $graphData = ['GRAPH' => [], 'TOTAL_COUNT' => count($data) ];
    
                $totalOpen = 0;
                $totalExpired = 0;
    
                foreach ($data as $datas) {
                    if ($datas->expiry_date >= date('Y-m-d')) {
                        $totalOpen++;
                    }
                    else {
                        $totalExpired++;
                    }
                }
    
                $graphData['TOTAL_OPEN'] = $totalOpen;
                $graphData['TOTAL_EXPIRED'] = $totalExpired;
                echo json_encode($graphData);
            break;
            case 'leads':
                $graphData = ['GRAPH' => [], 'TOTAL_LEADS' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0;
                foreach ($data as $datas) {
                    $accumulativeValue += 1;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = $accumulativeValue;
                }
    
                $graphData['TOTAL_LEADS'] = $accumulativeValue;
                echo json_encode($graphData);
            break;
            case 'contact':
                $graphData = ['GRAPH' => [], 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0;
                foreach ($data as $datas) {
                    $accumulativeValue += 1;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = $accumulativeValue;
                }
                echo json_encode($graphData);
            break;
            case 'customer_groups':
                $graphData = ['GRAPH' => [], 'TOTAL_COUNT' => count($data) ];
    
                foreach ($data as $datas) {
                    $title = $datas->title;
                    if (!isset($graphData['GRAPH'][$title])) {
                        $graphData['GRAPH'][$title] = 0;
                    }
                    $graphData['GRAPH'][$title]++;
                }
                echo json_encode($graphData);
            break;
            case 'accounting_expense':
                foreach ($data as $datas) {
                    if ($datas->account_type == "Expenses") {
                        $accountName = $datas->account_name;
                        if ($accountName === 'Payroll Expenses' || $accountName === 'Payrolls Expense') {
                            $accountName = 'Payroll Expense';
                        }
    
                        if (!isset($graphData[$accountName])) {
                            $graphData[$accountName] = 0;
                        }
                        $graphData[$accountName] += $datas->total;
                    }
                }
                echo json_encode($graphData);
            break;
            case 'esign':
                foreach ($data as $datas) {
                    $graphData[$datas->status] = $datas->total;
                }
                echo json_encode($graphData);
            break;
            case 'payment_types':
                foreach ($data as $datas) {
                    if ($datas->payment_method == "cc") {
                        $graphData['Credit Card'] += $datas->total;
                    } else if ($datas->payment_method == "paypal") {
                        $graphData['PayPal'] += $datas->total;
                    } else if ($datas->payment_method == "check") {
                        $graphData['Check'] += $datas->total;
                    } else if ($datas->payment_method == "cash") {
                        $graphData['Cash'] += $datas->total;
                    } else if ($datas->payment_method == "deposit") {
                        $graphData['Direct Deposit'] += $datas->total;
                    } else {
                        $graphData['Other'] += $datas->total;
                    }
                }
                echo json_encode($graphData);
            break;
            case 'service_tickets':
                $graphData = ['GRAPH' => [], 'TOTAL_AMOUNT' => 0, 'TOTAL_COUNT' => count($data)];
            
                $accumulativeValue = 0.0;
                $accumulativeCount = 0;
                $lastMonth = ''; 
                
                foreach ($data as $datas) {
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    
                    if ($month !== $lastMonth) {
                        $accumulativeValue = 0.0; 
                        $accumulativeCount = 0; 
                    }
                    
                    $accumulativeValue += $datas->total;
                    $accumulativeCount += 1;
                    $graphData['GRAPH'][$month] = number_format($accumulativeCount, 2, '.', '');
                    $lastMonth = $month;
                }
            
                $graphData['TOTAL_AMOUNT'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'lead_source':
                foreach ($data as $datas) {
                    $graphData[$datas->lead_source] = $datas->total;
                }
                echo json_encode($graphData);
            break;
            case 'job_status':
                $allStatuses = [
                    'Draft',
                    'Scheduled',
                    'Arrival',
                    'Started',
                    'Approved',
                    'Finished',
                    'Cancelled',
                    'Invoiced',
                    'Completed'
                ];

                $graphData = array_fill_keys($allStatuses, 0);

                foreach ($data as $datas) {
                    if (isset($graphData[$datas->status])) {
                        $graphData[$datas->status] = $datas->total ?? 0;
                    }
                }
                echo json_encode($graphData);
            break;
            case 'customer_status':
                foreach ($data as $datas) {
                    $graphData[$datas->status] = $datas->total;
                }
                echo json_encode($graphData);
            break;
            case 'job_tags':
                foreach ($data as $datas) {
                    $graphData[$datas->tags] = $datas->total;
                }
                echo json_encode($graphData);
            break;
            case 'taskhub':
                foreach ($data as $datas) {
                    $graphData['Activities'] += 1;
                    $graphData['Shared Tasks'] += ($datas->shared_tasks > 1) ? $datas->shared_tasks : 0;
                    $graphData['Flagged'] += ($datas->priority == 'Urgent') ? 1 : 0;
                    $graphData['Done'] += ($datas->status == 'Done') ? 1 : 0;
                    $graphData['My Tasks'] += (in_array($user_id, json_decode($datas->assigned_employees, true))) ? 1 : 0;
                    $graphData['Today`s Tasks'] += (date('Y-m-d', strtotime($datas->date)) === $postData['dateTo']) ? 1 : 0;
                }
                echo json_encode($graphData);
            break;
            case 'activity_logs':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'recent_customers':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'unpaid_invoices_list':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'overdue_invoices_list':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'paid_invoices':
                $graphData = ['GRAPH' => [], 'TOTAL_AMOUNT' => 0, 'TOTAL_COUNT' => count($data) ];
    
                $accumulativeValue = 0.0;
                foreach ($data as $datas) {
                    $accumulativeValue += $datas->total;
                    $month = strtoupper(date('Y M', strtotime($datas->date)));
                    $graphData['GRAPH'][$month] = number_format($accumulativeValue, 2, '.', '');
                }
    
                $graphData['TOTAL_AMOUNT'] = number_format($accumulativeValue, 2, '.', '');
                echo json_encode($graphData);
            break;
            case 'open_invoices_list':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'open_estimates_list':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'job_activities':
                foreach ($data as $datas) {
                    $job_total = '$'.number_format($datas->job_total, 2, ".", ",");
                    $data_created = date('M d Y, g:i A', strtotime($datas->date_created));
                    $data_updated = date('M d Y, g:i A', strtotime($datas->date_updated));
                    $technician = json_decode($datas->technicians, true);

                    $techniciansList = "<ul>";
                    foreach ($technician as $technicians) {
                        $techniciansList .= "<li>$technicians</li>";
                    }
                    $techniciansList .= "</ul>";
                    echo "<tr style='cursor: pointer;' class='tbl-row' data-type='job_activities' data-id='$datas->id'>
                            <td class='p-2 align-middle'>
                                <div class='d-flex position-relative'>
                                    <div class='flex-grow-1 min-width-0'>
                                        <strong>$datas->job_number</strong> <small class='text-muted' data-bs-trigger='hover focus' data-bs-toggle='popover' data-bs-original-title='$datas->job_number' data-bs-content='<strong>Customer:&nbsp;&nbsp;</strong>$datas->customer<br><strong>Address:&nbsp;&nbsp;</strong>$datas->customer_address<br><strong>Job Location:&nbsp;&nbsp;</strong>$datas->job_location<br><strong>Status:&nbsp;&nbsp;</strong>$datas->status<br><strong>Sales Rep:&nbsp;&nbsp;</strong>$datas->sales_rep<br><strong>Tech rep:&nbsp;&nbsp;</strong>$techniciansList<strong>Amount:&nbsp;&nbsp;</strong>$job_total<br><strong>Last Updated:&nbsp;&nbsp;</strong>$data_updated' data-bs-html='true'><i class='fas fa-search'></i></small>
                                        <span class='d-block text-wrap' style='font-size: 13px;'>$datas->status / $job_total</span>
                                    </div>
                                    <small class='text-muted position-absolute' style='top: 0; right: 1px;'>$data_created</small>
                                </div>
                            </td>
                        </tr>";
                }
            break;
            case 'ytd_stats':
                foreach ($data as $datas) {
                    if ($datas->category == "earned") {
                        $graphData["Earned"] = floatval($datas->total); 
                    } else if ($datas->category == "invoice_amount") {
                        $graphData["Invoice Amount"] = floatval($datas->total);
                    } else if ($datas->category == "jobs_completed") {
                        $graphData["Jobs Completed"] = intval($datas->total);
                    } else if ($datas->category == "new_jobs") {
                        $graphData["New Jobs"] = intval($datas->total);
                    } else if ($datas->category == "lost_accounts") {
                        $graphData["Lost Accounts"] = intval($datas->total);
                    } else if ($datas->category == "service_projective_income") {
                        $graphData["Service Projective Income"] = floatval($datas->total);
                    }
                }
                echo json_encode($graphData);
            break;
            case 'today_stats':
                foreach ($data as $datas) {
                    if ($datas->category == "sales") {
                        $graphData["Sales"] = floatval($datas->total); 
                    } else if ($datas->category == "jobs_created") {
                        $graphData["Jobs Created"] = intval($datas->total);
                    } else if ($datas->category == "jobs_done") {
                        $graphData["Jobs Done"] = intval($datas->total);
                    } else if ($datas->category == "collected") {
                        $graphData["Collected"] = floatval($datas->total);
                    } else if ($datas->category == "jobs_cancelled") {
                        $graphData["Jobs Cancelled"] = intval($datas->total);
                    } else if ($datas->category == "service_scheduled") {
                        $graphData["Service Scheduled"] = intval($datas->total);
                    }
                }
                echo json_encode($graphData);
            break;
            case 'earnings':
                foreach ($data as $datas) {
                    if ($datas->category == "open_invoices") {
                        $graphData["Open Invoices"] = intval($datas->total); 
                    } else if ($datas->category == "overdue_invoices") {
                        $graphData["Overdue Invoices"] = intval($datas->total);
                    } else if ($datas->category == "paid_invoices") {
                        $graphData["Paid Invoices"] = floatval($datas->total);
                    } else if ($datas->category == "subscription") {
                        $graphData["Subscription"] = floatval($datas->total);
                    }
                }
                echo json_encode($graphData);
            break;
            case 'recurring_service_plans':
                foreach ($data as $datas) {
                    if ($datas->category == "active_subscribers") {
                        $graphData["Active Subscribers"] = intval($datas->total); 
                    } else if ($datas->category == "agreements_expire_30days") {
                        $graphData["Agreements to Expire in 30 days"] = intval($datas->total);
                    } else if ($datas->category == "total_recurring_payment") {
                        $graphData["Total & Recurring Payments"] = floatval($datas->total);
                    } else if ($datas->category == "weekly_total_recurring_payment") {
                        $graphData["Weekly Total Payments"] = floatval($datas->total);
                    }
                }
                echo json_encode($graphData);
            break;
            case 'customer_list':
                $graphData = $data;
                echo json_encode($graphData);    
            break;
            case 'ledger_lookup':
                $result = array();
                $table_content = "";
                $customer_address = "";
                $total_invoice = 0.0;
                $total_payment = 0.0;
               
                if ($data) {
                    foreach ($data as $datas) {
                        $total_invoice += $datas->invoice_total;
                        $total_payment += $datas->payment_amount;

                        $customer_address = $description = ($datas->customer_address != '') ? $datas->customer_address : 'Not Specified';
                        $description = ($datas->description != '') ? $datas->description : 'Not Specified';
                        $invoice_total = ($datas->invoice_total) ? '$' . number_format($datas->invoice_total, 2, ".", ",") : '$0.00';
                        $payment_amount = ($datas->payment_amount) ? '$' . number_format($datas->payment_amount, 2, ".", ",") : '$0.00';
                        $invoice_date = date("m/d/Y", strtotime($datas->invoice_date));
                        $payment_date = date("m/d/Y", strtotime($datas->payment_date));

                        switch ($datas->payment_method) {
                            case 'cc':
                                $payment_method = "Credit Card";
                                break;
                            case 'paypal':
                                $payment_method = "PayPal";
                                break;
                            case 'check':
                                $payment_method = "Check";
                                break;
                            case 'cash':
                                $payment_method = "Cash";
                                break;
                            case 'deposit':
                                $payment_method = "Direct Deposit";
                                break;
                            case '':
                                $payment_method = "—";
                                $payment_date = "—";
                                break;
                        }

                        $entry_by = ($datas->entry_by != '') ? $datas->entry_by : 'Not Specified';

                        $table_content .= "<tr>";
                            $table_content .= "<td>$invoice_date</td>";
                            $table_content .= "<td>$description</td>";
                            $table_content .= "<td>$invoice_total</td>";
                            $table_content .= "<td>$payment_amount</td>";
                            $table_content .= "<td>$payment_method</td>";
                            $table_content .= "<td>$payment_date</td>";
                            $table_content .= "<td>$entry_by</td>";
                        $table_content .= "</tr>";
                    }

                    $raw_balance = $total_invoice - $total_payment;
                    if ($raw_balance < 0) {
                        $balance = '$0.00';
                    } else {
                        $balance = ($raw_balance < 0 ? '-' : '') . '$' . number_format(abs($raw_balance), 2, '.', ',');
                    }

                    $table_content .= "<tr>";
                        $table_content .= "<td colspan='2'><strong class='float-end'>TOTAL&emsp;</strong></td>";
                        $table_content .= "<td class='fw-bold'>$".number_format($total_invoice, 2, '.', ',')."</td>";
                        $table_content .= "<td class='fw-bold'>$".number_format($total_payment, 2, '.', ',')."</td>";
                        $table_content .= "<td colspan='3'></td>";
                    $table_content .= "</tr>";
                } else {
                    $table_content .= "<tr>";
                        $table_content .= "<td colspan='7'>No Records Found.</td>";
                    $table_content .= "</tr>";
                    $balance = "$0.00";
                }

                $paid_percentage = ($total_invoice > 0) ? round(($total_payment / $total_invoice) * 100, 2) : 0;
                $result['table_content'] = $table_content;
                $result['customer_address'] = $customer_address;
                $result['balance_amount'] = $balance;
                $result['total_paid'] = "$".number_format($total_payment, 2, '.', ',');
                $result['total_paid_percentage'] = round($paid_percentage)."%";

                echo json_encode($result);
            break;
            case 'sales_leaderboard':
                $result = array();
                $table_content = "";
                
                if ($data) {
                    foreach ($data as $datas) {
                        $initials = ($datas->sales_rep != '') ? strtoupper(implode('', array_map(fn($v) => $v[0], explode(' ', $datas->sales_rep)))) : 'NA';
                        $sales_rep = ($datas->sales_rep != '') ? $datas->sales_rep : 'Not Specified';
                        $total_jobs = ($datas->total_jobs != 0) ? $datas->total_jobs : 0;
                        $total_sales = ($datas->total_sales) ? '$' . number_format($datas->total_sales, 2, ".", ",") : '$0.00';

                        $table_content .= "<tr>";
                            $table_content .= "<td>
                                <div style='display: inline-flex; align-items: center; gap: 5px;'>
                                    <div class='nsm-profile'><span>$initials</span></div>
                                    <div>
                                        $sales_rep<br>
                                        <small class='text-muted'>Rep #$datas->id</small>
                                    </div>
                                </div>
                            </td>";
                            $table_content .= "<td>$total_jobs</td>";
                            $table_content .= "<td>$total_sales</td>";
                        $table_content .= "</tr>";
                    }
                } else {
                    $table_content .= "<tr>";
                        $table_content .= "<td colspan='3'>No Records Found.</td>";
                    $table_content .= "</tr>";
                }

                $result['table_content'] = $table_content;

                echo json_encode($result);
            break;
            case 'tech_leaderboard':
                $result = array();
                $table_content = "";
                
                if ($data) {
                    foreach ($data as $datas) {
                        $initials = ($datas->tech_rep_name != '') ? strtoupper(implode('', array_map(fn($v) => $v[0], explode(' ', $datas->tech_rep_name)))) : 'NA';
                        $tech_rep_name = ($datas->tech_rep_name != '') ? $datas->tech_rep_name : 'Not Specified';
                        $job_count = ($datas->job_count != 0) ? $datas->job_count : 0;
                        $ticket_count = ($datas->ticket_count != 0) ? $datas->ticket_count : 0;
                        $ticket_amount = ($datas->ticket_amount) ? '$' . number_format($datas->ticket_amount, 2, ".", ",") : '$0.00';

                        $table_content .= "<tr>";
                            $table_content .= "<td>
                                <div style='display: inline-flex; align-items: center; gap: 5px;'>
                                    <div class='nsm-profile'><span>$initials</span></div>
                                    <div>
                                        $tech_rep_name<br>
                                        <small class='text-muted'>Rep #$datas->tech_rep_id</small>
                                    </div>
                                </div>
                            </td>";
                            $table_content .= "<td>$job_count</td>";
                            $table_content .= "<td>$ticket_count</td>";
                            $table_content .= "<td>$ticket_amount</td>";
                        $table_content .= "</tr>";
                    }
                } else {
                    $table_content .= "<tr>";
                        $table_content .= "<td colspan='4'>No Records Found.</td>";
                    $table_content .= "</tr>";
                }

                $result['table_content'] = $table_content;

                echo json_encode($result);
            break;
            case 'weekly_subscription_amount':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'scorecard_lookup':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'tech_employees':
                $graphData = $data;
                echo json_encode($graphData);
            break;
            case 'user_info':
                $company_id = logged('company_id');
                $user_id = logged('id');
                $user_type = logged('user_type');
                $role_id = logged('role');
                $data = array();

                $data['company_id'] = $company_id;
                $data['user_id'] = $user_id;
                $data['user_type'] = $user_type;
                $data['role_id'] = $role_id;
                echo json_encode($data);
            break;
            default:
                $graphData = ['error' => 'Invalid category'];
            break;
        }

    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */