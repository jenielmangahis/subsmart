<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class Customer_Form extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function apiGetSalesAreas()
    {
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $retval = $this->customer_ad_model->get_all(false, '', 'ASC', 'ac_salesarea', 'sa_id');

        $search = strtolower($this->input->get('search'));
        if (!empty($search)) {
            $retval = array_filter($retval, function ($item) use ($search) {
                return strpos(strtolower($item->sa_name), $search) !== false;
            });
        }

        header('content-type: application/json');
        echo json_encode(['data' => array_values($retval)]);
    }

    public function apiGetRatePlans()
    {
        $this->load->model('General_model', 'general');
        $retval = $this->general->get_data_with_param([
            'table' => 'ac_rateplan',
            'select' => 'id,amount',
        ]);

        $search = strtolower($this->input->get('search'));
        if (!empty($search)) {
            $retval = array_filter($retval, function ($item) use ($search) {
                return strpos(strtolower($item->amount), $search) !== false;
            });
        }

        usort($retval, function ($item1, $item2) {
            return (float) $item1->amount <=> (float) $item2->amount;
        });

        header('content-type: application/json');
        echo json_encode(['data' => array_values($retval)]);
    }

    public function apiGetActivationFees()
    {
        $this->load->model('General_model', 'general');
        $retval = $this->general->get_data_with_param([
            'table' => 'ac_activationfee',
            'select' => 'id,amount',
        ]);

        $search = strtolower($this->input->get('search'));
        if (!empty($search)) {
            $retval = array_filter($retval, function ($item) use ($search) {
                return strpos(strtolower($item->amount), $search) !== false;
            });
        }

        usort($retval, function ($item1, $item2) {
            return (float) $item1->amount <=> (float) $item2->amount;
        });

        header('content-type: application/json');
        echo json_encode(['data' => array_values($retval)]);
    }

    public function apiGetSystemPackages()
    {
        $this->db->where('company_id', logged('company_id'));
        $retval = $this->db->get('ac_system_package_type')->result();

        $search = strtolower($this->input->get('search'));
        if (!empty($search)) {
            $retval = array_filter($retval, function ($item) use ($search) {
                return strpos(strtolower($item->name), $search) !== false;
            });
        }

        header('content-type: application/json');
        echo json_encode(['data' => array_values($retval)]);
    }

    public function apiCheckDuplicate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['customer_type' => $customerType] = $payload;

        $profile = null;
        $message = null;

        if (strtolower($customerType) === 'business') {
            $this->db->where('company_id', logged('company_id'));
            $this->db->where('LOWER(first_name)', strtolower($payload['first_name']));
            $this->db->where('LOWER(last_name)', strtolower($payload['last_name']));
            $this->db->where('LOWER(middle_name)', strtolower($payload['middle_name']));
            $this->db->where('LOWER(business_name)', strtolower($payload['business_name']));
            $profile = $this->db->get('acs_profile')->row();
            if ($profile) {
                $message = "A customer with the name <strong>{$profile->first_name} {$profile->last_name}</strong> already exists on {$profile->business_name} business.";
            }

        } else {
            $this->db->where('company_id', logged('company_id'));
            $this->db->where('LOWER(first_name)', strtolower($payload['first_name']));
            $this->db->where('LOWER(last_name)', strtolower($payload['last_name']));
            $this->db->where('LOWER(middle_name)', strtolower($payload['middle_name']));
            $this->db->where('LOWER(mail_add)', strtolower($payload['mail_add']));
            $this->db->where('LOWER(city)', strtolower($payload['city']));
            $this->db->where('LOWER(state)', strtolower($payload['state']));
            $this->db->where('LOWER(zip_code)', strtolower($payload['zip_code']));
            $profile = $this->db->get('acs_profile')->row();
            if ($profile) {
                $message = "Customer <strong>{$profile->first_name} {$profile->last_name}</strong> with the given address already exists.";
            }
        }

        if ($profile->prof_id == $payload['prof_id']) {
            $profile = null;
            $message = null;
        }

        header('content-type: application/json');
        echo json_encode(['data' => $profile, 'message' => $message]);
    }
}
