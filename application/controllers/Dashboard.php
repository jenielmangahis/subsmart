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
        $this->page_data['widgets'] = $this->widgets_model->getWidgetsList();
        $this->load->view('v2/widgets/add_widgets_details', $this->page_data);
    }

    public function getThumbnailsList()
    {
        $this->load->model('widgets_model');
        $user_id = logged('id');
        $this->page_data['widgets'] = $this->widgets_model->getThumbnailsList($user_id);
        $this->load->view('v2/widgets/add_thumbnail_details', $this->page_data);
    }

    public function index()
    {
        // load necessary model and functions
        $this->hasAccessModule(39);
        $this->load->model('AcsProfile_model');
        $this->load->model('Job_tags_model');

        $this->load->model('widgets_model');
        $this->load->helper('functions');
        $this->load->helper('functions_helper');
        $this->load->model('widgets_model');
        $this->load->model('Invoice_model');
        $this->load->model('expenses_model');

        add_css([
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/libs/jcanvas/global.css',
            'assets/plugins/timeline_calendar/main.css',
            'assets/css/wokrcalendar/workcalendar.css',
        ]);

        add_footer_js([
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            // 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/js/v2/bootstrap-datetimepicker.v2.min.js',
            'assets/plugins/timeline_calendar/main.js',
            'assets/frontend/js/workcalender/workcalender.js',
            'assets/js/quick_launch.js',
        ]);

        $user_id = logged('id');
        $companyId = logged('company_id');
        $type = 0;

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
        $status_selection = $this->taskhub_status_model->get();
        foreach ($status_selection as $status_selec) {
            $task_status = $this->crud->total_record('tasks', "status_id='".$status_selec->status_id."'");
            $status_arr[] = $status_selec->status_text.'@#@'.$task_status;
        }

        // $this->page_data['events'] = $this->event_model->get_all_events(5);
        // $this->page_data['upcomingEvents'] = $this->event_model->getAllUpComingEventsByCompanyId(logged('company_id'));
        $this->page_data['upcomingInvoice'] = $this->event_model->getUnpaidInvoices();
        $this->page_data['upcomingInvoice'] = $this->event_model->getUnpaidInvoices();
        $this->page_data['dueInvoices'] = $this->Invoice_model->getCompanyDueInvoices($companyId);
        $this->page_data['overdueInvoices'] = $this->Invoice_model->getCompanyOverDueInvoices($companyId);
        $this->page_data['subs'] = $this->event_model->getAllsubsByCompanyId($companyId)
        ;
        $past_due = $this->widgets_model->getCurrentCompanyOverdueInvoices2();
        $invoices_total_due = 0;
        foreach ($past_due as $total_due) {
            if ($total_due->status != 'paid') {
                $invoices_total_due += $total_due->balance;
            }
        }
        $this->page_data['invoices_count'] = count($past_due);
        $this->page_data['invoices_total_due'] = $invoices_total_due;

        // $this->page_data['leadSources']=$this->event_model->getLeadSourceWithCount(); // fetch Lead Sources

        $latestJobs = $this->event_model->getLatestJobs();
        foreach ($latestJobs as $job) {
            $jobPayment = $this->jobs_model->getJobPaymentByJobId($job->id);
            if ($jobPayment) {
                $job->amount = $jobPayment->amount;
            } else {
                $job->payment = 0;
            }
        }
        $this->page_data['latestJobs'] = $latestJobs; // fetch Sales Rep and customer they are assigned to
        $this->page_data['company_id'] = $companyId; // Company ID of the logged in USER

        $this->page_data['sales'] = $this->event_model->getAllSales();
        // $this->page_data['mmr']=$this->AcsProfile_model->getCustomerMMR(logged('company_id'));
        // $mmr = $this->AcsProfile_model->getCustomerMMR(logged('company_id'));
        // $this->page_data['acct_banks']=$this->accounting_bank_accounts->getAllBanks();
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

        $invoice_paid_last_30days = [
            'where' => ['company_id' => logged('company_id'), 'status' => 'Paid', 'due_date ' => 'Paid'],
            'table' => 'invoices',
            'select' => 'count(*) as total',
        ];
        $this->page_data['invoice_paid_last_30days'] = $this->general->get_data_with_param($invoice_paid_last_30days, false);

        // fetch open estimates
        // $total_amount_invoice = [
        //     'where' => ['company_id' => logged('company_id'), 'status' => 'Paid'],
        //     'table' => 'invoices',
        //     'select' => 'SUM(grand_total) as total',
        // ];
        // $this->page_data['total_amount_invoice'] = $this->general->get_data_with_param($total_amount_invoice, false);

        // fetch open estimates
        $total_invoice_paid = [
            'where' => ['company_id' => logged('company_id'), 'status' => 'Paid'],
            'table' => 'invoices',
            'select' => 'count(*) as total',
        ];
        $this->page_data['total_invoice_paid'] = $this->general->get_data_with_param($total_invoice_paid, false);

        $this->page_data['activeSubscriptions'] = $this->AcsProfile_model->getCompanyTotalActiveSubscriptions(logged('company_id'));
        $this->page_data['totalAmountActiveSubscriptions'] = $this->AcsProfile_model->getCompanyTotalAmountActiveRecurringPayment(logged('company_id'));
        $this->page_data['activeSubscriptionsWillExpireIn30d'] = $this->AcsProfile_model->getCompanyActiveSubscriptionWillExpireIn30Days(logged('company_id'));

        // get customer subscription history
        $feeds_query = [
            'where' => ['company_id' => logged('company_id')],
            'table' => 'feed',
            'select' => '*',
            'order' => ['order_by' => 'id', 'ordering' => 'DESC'],
        ];
        $this->page_data['feeds'] = $this->general->get_data_with_param($feeds_query);

        // get customer newsletter
        // $news_query = array(
        //     'where' => array('company_id' => logged('company_id')),
        //     'table' => 'news',
        //     'select' => '*',
        // );
        // $this->page_data['news'] = $this->general->get_data_with_param($news_query);

        $this->page_data['total_recurring_payment'] = $this->getTotalRecurringPayment();
        $this->page_data['total_agreements_to_expire_in_30_days'] = $this->getAgreementsToExpireIn30Days();

        $invoices = $this->invoice_model->get_all_company_invoice(logged('company_id'));
        $openInvoices = array_filter($invoices, function ($v, $k) {
            return !in_array($v->status, ['Draft', 'Declined', 'Paid']);
        }, ARRAY_FILTER_USE_BOTH);

        $this->page_data['open_invoices'] = $openInvoices;
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

        $payments = $this->invoice_model->get_company_payments(logged('company_id'));
        $deposits = 0;
        foreach ($payments as $payment) {
            $deposits += floatval($payment->invoice_amount);
        }
        $this->page_data['deposits'] = $deposits;

        // $this->load->view('dashboard', $this->page_data);
        $this->load->view('dashboard_v2', $this->page_data);
    }

    private function category_col($transactionId, $transactionType, $for = 'table')
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        $totalCount = count($categories) + count($items);

        if ($totalCount > 1) {
            $category = '-Split-';
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
                    'category' => '',
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
                    'category' => '',
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
                    'category' => '',
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
        $date_from = post('from_date').' 00:00:00';
        $date_to = post('to_date').' 23:59:59';
        $table = post('table');
        $id = post('id');

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
                'estimates.estimate_date >=' => date('Y-m-d', strtotime($date_from)), 'estimates.estimate_date <=' => date('Y-m-d', strtotime($date_to))],
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
                $total = $this->general->get_data_with_param($total_query);
                $expired_query = [
                    'where' => ['estimates.company_id' => logged('company_id'), 
                                'estimates.status !=' => 'Submitted',
                                'estimates.status!=' => 'Accepted',
                                'estimates.status!=' => 'Declined By Customer',
                                'estimates.status!=' => 'Draft',
                                'estimates.status!=' => 'Invoiced',
                                'estimates.status!=' => 'Pending',
                                 'estimates.view_flag' => '0',
                                 'estimates.estimate_date >=' => date('Y-m-d', strtotime($date_from)),
                                 'estimates.estimate_date <=' => date('Y-m-d', strtotime($date_to)),
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
                $total_query = [
                    'where' => ['acs_profile.company_id' => logged('company_id'), 'acs_profile.status' => 'Installed', 'STR_TO_DATE(acs_billing.bill_start_date, "%m/%d/%Y") >=' => date('Y-m-d', strtotime($date_from)), 'STR_TO_DATE(acs_billing.bill_end_date, "%m/%d/%Y") >=' => date('Y-m-d', strtotime($date_to))],
                    'table' => 'acs_billing',
                    'join' => [
                        [
                            'table' => 'acs_alarm',
                            'statement' => 'acs_billing.fk_prof_id = acs_alarm.fk_prof_id',
                        ],
                        [
                            'table' => 'acs_profile',
                            'statement' => 'acs_billing.fk_prof_id = acs_profile.prof_id',
                        ],
                    ],
                    'select' => 'SUM(acs_billing.mmr) AS TOTAL_MMR',
                ];
                $total = $this->general->get_data_with_param($total_query);
                $mmr = $this->AcsProfile_model->getSubscriptionFilter(logged('company_id'), $date_from, $date_to);
                $this->output->set_output(json_encode(['first' => number_format($total[0]->TOTAL_MMR, 2), 'second' => null,  'mmr' => $mmr]));

                break;

            case 'invoices':
                $total_query = [
                    'where' => ['invoices.company_id' => logged('company_id'), 'invoices.grand_total >' => 0, 'invoices.due_date !=' => null,
                    'invoices.status !=' => 'Draft', 'invoices.view_flag' => 0,
                    'invoices.date_issued >=' => date('Y-m-d', strtotime($date_from)), 'invoices.due_date <' => date('Y-m-d', strtotime($date_to))],
                    'table' => 'invoices',
                    'join' => [
                        [
                            'table' => 'accounting_receive_payment_invoices',
                            'statement' => 'accounting_receive_payment_invoices.invoice_id = invoices.id',
                            'join_as' => 'left',
                        ],
                        [
                            'table' => 'acs_profile',
                            'statement' => 'acs_profile.prof_id = invoices.customer_id',
                            'join_as' => 'left',
                        ],
                    ],
                    'groupBy' => 'invoices.id',
                    'select' => ' invoices.id,
                    invoices.invoice_number,
                    invoices.due_date,
                    invoices.status,
                    acs_profile.email AS customer_email,
                    acs_profile.first_name, 
                    acs_profile.last_name,
                    acs_profile.fk_user_id as user_id,
                    invoices.grand_total,
                    invoices.grand_total - COALESCE(SUM(accounting_receive_payment_invoices.payment_amount), 0) as balance',
                ];
                $past_due = $this->general->get_data_with_param($total_query);

                $invoices_total_due = 0;
                foreach ($past_due as $total_due) {
                    if ($total_due->status != 'paid') {
                        $invoices_total_due += $total_due->balance;
                    }
                }

                $mmr = $this->AcsProfile_model->getSubscriptionFilter(logged('company_id'), $date_from, $date_to);
                $this->output->set_output(json_encode(['first' => count($past_due), 'second' => number_format($invoices_total_due),  'mmr' => $mmr, 'past_due' => $past_due]));

                break;
            case 'open_invoices':
                $total_query = [
                    'where' => ['company_id' => logged('company_id'),
                    'is_recurring =' => 0, 'view_flag =' => 0,
                    'status !=' => 'Draft', 'status !=' => 'Declined', 'status !=' => 'Paid', 'status !=' => '',
                    'date_issued >=' => date('Y-m-d', strtotime($date_from)),
                     'due_date <' => date('Y-m-d', strtotime($date_to))],
                    'table' => 'invoices',
                    'select' => '*',
                ];
                $invoices = $this->general->get_data_with_param($total_query);
                $openInvoices = array_filter($invoices, function ($v, $k) {
                    return !in_array($v->status, ['Draft', 'Declined', 'Paid']);
                }, ARRAY_FILTER_USE_BOTH);

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
                $acs_profile_query = [
                    'where' => ['customer_groups.company_id' => logged('company_id'),
                    'DATE(acs_profile.created_at)  >=' => date('Y-m-d', strtotime($date_from)),
                    'DATE(acs_profile.created_at)  <' => date('Y-m-d', strtotime($date_to)),
                     ],
                    'or_where' => ['customer_groups.company_id' => 0],
                    'groupBy' => ['customer_groups.title'],
                    'table' => 'customer_groups',
                    'join' => [
                        [
                            'table' => 'acs_profile',
                            'statement' => 'acs_profile.customer_group_id = customer_groups.id',
                        ],
                    ],
                    'select' => 'customer_groups.title, COUNT(acs_profile.prof_id) AS total_customer',
                ];
                $customer = $this->general->get_data_with_param($acs_profile_query);
                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'customer' => $customer]));

                break;
            case 'jobs':
                $jobs_query = [
                    'where' => ['jobs.company_id' => logged('company_id'),
                    'DATE(jobs.date_created)  >=' => date('Y-m-d', strtotime($date_from)),
                    'DATE(jobs.date_created)  <' => date('Y-m-d', strtotime($date_to)),
                     ],
                    'table' => 'jobs',
                    'join' => [
                        [
                            'table' => 'job_payments',
                            'statement' => 'jobs.id = job_payments.job_id',
                        ],
                    ],
                    'select' => 'jobs.*, job_payments.amount',
                ];
                $total_jobs = $this->general->get_data_with_param($jobs_query);
                $this->output->set_output(json_encode(['first' => count($total_jobs), 'second' => null, 'jobs' => $total_jobs]));

                break;
            case 'unpaid_invoices':
                $unpaid_query = [
                    'where' => ['invoices.company_id' => logged('company_id'),  'date_created >=' => date('Y-m-d', strtotime($date_from)),
                    'date_created <=' => date('Y-m-d', strtotime($date_to))],
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
                $resultInvoice = $this->general->get_data_with_param($unpaid_query);

                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'unpaid' => $resultInvoice]));

                break;
            case 'income':
                $income_query = [
                    'where' => ['company_id' => logged('company_id'),  'DATE(payment_date)  >=' => date('Y-m-d', strtotime($date_from)),
                    'DATE(payment_date) <=' => date('Y-m-d', strtotime($date_to))],
                    'table' => 'payment_records',
                    'select' => '*',
                ];
                $income = $this->general->get_data_with_param($income_query);

                $this->output->set_output(json_encode(['first' => null, 'second' => null, 'income' => $income]));

                break;
        }
    }

    public function updateListView()
    {
        $id = post('id');
        $val = post('val');
        $this->load->model('widgets_model');

        $query = $this->widgets_model->updateListView($id, $val);
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

        $collectedAccounts = $this->event_model->getAccountSituation('Collections'); // collection account count, if Collection Date Office Info is set
        $lostAccounts = $this->event_model->getAccountSituation('Cancelled'); // lost account count, if Cancel Date Office Info is set
        $onlineBookingCount = $this->event_model->getLeadSource('Online Booking');
        $data_arr = ['success' => true, 'data' => $payment, 'paymentInvoice' => $paymentInvoices, 'onlineBooking' => $onlineBookingCount, 'jobsCompleted' => $total_jobs_done, 'lostAccount' => $lostAccounts, 'collectedAccounts' => $collectedAccounts, 'invoice_amount_due' => $total_amount_due, 'collected_amount' => $total_amount_paid];
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
        $CURRENT_MONTH_COUNT = $this->event_model->getStatusCount('MONTH');
        $CURRENT_YEAR_COUNT = $this->event_model->getStatusCount('YEAR');
        if ($DATE == 'MONTH') {
            echo json_encode($CURRENT_MONTH_COUNT);
        }
        if ($DATE == 'YEAR') {
            echo json_encode($CURRENT_YEAR_COUNT);
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
        $past_due = $this->AcsProfile_model->getCurrentCompanyOverdue(logged('company_id'));

        // $past_due = $this->AcsProfile_model->getSubscription(logged('company_id'));
        $data_arr = ['Success' => true, 'past_due' => $past_due];
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
        $jobs = $this->event_model->getAllJobs();
        $data_arr = ['Success' => true, 'jobs' => $jobs, 'total_jobs' => count($jobs)];
        exit(json_encode($data_arr));
    }

    public function income_thumbnail_graph()
    {
        $income = $this->invoice_model->get_company_payments(logged('company_id'));
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

        $unpaid = $CI->invoice_model->getUnpaidInvoicesByCompanyId($company_id);
        $data_arr = ['Success' => true, 'unpaid_invoices' => $unpaid];
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
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
