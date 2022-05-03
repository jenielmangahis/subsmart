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
            ],
            [
                'text' => 'Submit Service Ticket',
                'url' => base_url('/customer/addTicket?cus_id=:customerid'),
            ],
            [
                'text' => 'Create Estimate',
                'url' => '#new_estimate_modal',
            ],
            [
                'text' => 'Add Credit Industry Item',
                'url' => base_url('/customer/add_dispute_item/:customerid'),
            ],
            [
                'text' => 'Call Customer',
                'url' => base_url('/customer/call/:customerid'),
            ],
            [
                'text' => 'Send Secure Message, Via Client Portal',
                'url' => '',
                'icon_class' => 'bx bx-fw bx-message-rounded-check',
                'is_default' => true,
            ],
            [
                'text' => 'Show Customer Activites',
                'url' => base_url('/customer/activities/:customerid'),
            ],
            [
                'text' => 'Run Dispute Wizard, Create letters/correct errors',
                'url' => base_url('/EsignEditor/wizard?customer_id=:customerid'),
                'icon_class' => 'bx bx-fw bxs-magic-wand',
                'is_default' => true,
            ],
            [
                'text' => '1-Click Import and Audit, Pull reports & Create audit',
                'url' => '',
                'icon_class' => 'bx bx-fw bx-import',
                'is_default' => true,
            ],
            [
                'text' => 'Send Link Reset Password',
                'url' => '',
            ],
            [
                'text' => 'Edit Customer',
                'url' => base_url('/customer/add_advance/:customerid'),
            ],
            [
                'text' => 'Create Invoice',
                'url' => '',
            ],
            [
                'text' => 'Send email',
                'url' => 'mailto::customeremail',
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
        $actions = array_map(function ($action) {
            $action['icon_class'] = $action['icon_class'] ?? null;
            $action['is_default'] = $action['is_default'] ?? null;
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
