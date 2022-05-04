<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class Action
{
    public function __construct($props)
    {
        foreach ($props as $key => $prop) {
            $this->$key = $prop;
        }
    }
}

class CustomerDashboardQuickActions extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    private function getActions($isArray = false)
    {
        $actions = [
            [
                'text' => 'Create Job',
                'url' => base_url('/job/new_job1?cus_id=:customerid'),
                'sub_text' => 'Jobs',
            ],
            [
                'text' => 'Submit Service Ticket',
                'url' => base_url('/customer/addTicket?cus_id=:customerid'),
                'sub_text' => 'Tickets',
            ],
            [
                'text' => 'Create Estimate',
                'url' => '#new_estimate_modal',
                'sub_text' => 'Estimates',
            ],
            [
                'text' => 'Add Credit Industry Item',
                'url' => base_url('/customer/add_dispute_item/:customerid'),
                'sub_text' => 'Credit Industry',
            ],
            [
                'text' => 'Call Customer',
                'url' => base_url('/customer/call/:customerid'),
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Send Secure Message, Via Client Portal',
                'url' => '',
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Show Customer Activites',
                'url' => base_url('/customer/activities/:customerid'),
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Run Dispute Wizard, Create letters/correct errors',
                'url' => base_url('/EsignEditor/wizard?customer_id=:customerid'),
                'sub_text' => 'Esign Editor',
            ],
            [
                'text' => '1-Click Import and Audit, Pull reports & Create audit',
                'url' => '',
            ],
            [
                'text' => 'Send Link Reset Password',
                'url' => '',
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Edit Customer',
                'url' => base_url('/customer/add_advance/:customerid'),
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Create Invoice',
                'url' => base_url('/accounting/banking?action=invoiceModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Receive Payment',
                'url' => base_url('/accounting/banking?action=receivePaymentModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Credit Memo',
                'url' => base_url('/accounting/banking?action=creditMemoModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Sales Receipt',
                'url' => base_url('/accounting/banking?action=salesReceiptModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Refund Receipt',
                'url' => base_url('/accounting/banking?action=refundReceiptModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Delayed Credit',
                'url' => base_url('/accounting/banking?action=delayedCreditModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Delayed Charge',
                'url' => base_url('/accounting/banking?action=delayedChargeModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Send email',
                'url' => 'mailto::customeremail',
                'sub_text' => 'Customers',
            ],
        ];

        if ($isArray) {
            return $actions;
        }

        return array_map(function ($action) {
            return new Action($action);
        }, $actions);
    }

    public function seed()
    {
        $actions = $this->getActions(true);
        $fields = [];

        foreach ($actions as $action) {
            $fields = array_unique(array_merge($fields, array_keys($action)));
        }

        $actions = array_map(function ($action) use ($fields) {
            foreach ($fields as $field) {
                if (!array_key_exists($field, $action)) {
                    $action[$field] = null;
                }
            }

            return $action;
        }, $actions);

        foreach ($actions as $action) {
            $duplicateUpdate = [];
            foreach ($action as $key => $value) {
                $duplicateUpdate[] = is_null($value) ? "{$key}=NULL" : "{$key}='$value'";
            }

            $query = $this->db->insert_string('acs_dashboard_quick_actions', $action) . " ON DUPLICATE KEY UPDATE " . implode(',', $duplicateUpdate);
            $this->db->query($query);
        }

        $this->respond(['data' => 'Successfully seeded']);
    }

    private function getSavedActions()
    {
        $this->db->order_by('sub_text', 'ASC');
        $this->db->order_by('text', 'ASC');
        return $this->db->get('acs_dashboard_quick_actions')->result();
    }

    function list() {
        $this->respond(['data' => $this->getSavedActions()]);
    }

    private function respond($response)
    {
        header('content-type: application/json');
        exit(json_encode($response));
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->db_debug = false;

        if (!@$this->db->insert('acs_customer_dashboard_quick_actions', $payload)) {
            $this->respond(['data' => $this->db->error()]);
        }

        $this->db->where('id', $this->db->insert_id());
        $action = $this->db->get('acs_customer_dashboard_quick_actions')->row();
        $this->respond(['data' => $action]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->where('customer_id', $payload['customer_id']);
        $this->db->where('acs_dashboard_quick_actions_id', $payload['acs_dashboard_quick_actions_id']);
        $this->db->delete('acs_customer_dashboard_quick_actions');
        $this->respond(['data' => null]);
    }

    public function getCustomerActions($customerId)
    {
        $this->db->select('qa.*', false);
        $this->db->from('acs_customer_dashboard_quick_actions dqa');
        $this->db->where('customer_id', $customerId);
        $this->db->join('acs_dashboard_quick_actions qa', 'dqa.acs_dashboard_quick_actions_id = qa.id', 'left');
        $this->db->order_by('dqa.id', 'ASC');
        $query = $this->db->get();
        $actions = $query->result();
        $this->respond(['data' => $actions]);
    }

    public function getCustomerById($customerId)
    {
        $this->db->where('prof_id', $customerId);
        $customer = $this->db->get('acs_profile')->row();
        $this->respond(['data' => $customer]);
    }
}
