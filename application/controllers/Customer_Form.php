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
}
