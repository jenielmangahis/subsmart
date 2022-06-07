<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

/**
 * This file is for handling Customer Forms page.
 */
class CustomerForms extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->page_data['page']->title = 'Customer Forms';
        $this->load->view('v2/pages/customer/customer_forms.php', $this->page_data);
    }

    public function apiGetLabels()
    {
        $form = strtolower($this->input->get('form', true));
        $defaultNames = $this->getLabels($form);

        if (!is_array($defaultNames)) {
            $this->respond(['data' => [], 'message' => 'invalid form param']);
        }

        $retval = array_map(function ($defaultName, $index) use ($form) {
            $match = $this->findMatch($form, $defaultName);
            return ['index' => $index, 'name' => $defaultName, 'custom' => $match, 'form' => $form];
        }, $defaultNames, array_keys($defaultNames));

        $this->respond(['data' => $retval]);
    }

    private function findMatch($form, $defaultName)
    {
        foreach ($this->getCustomNames($form) as $customName) {
            if ($customName->form === $form && $customName->default_name === $defaultName) {
                return $customName;
            }
        }

        return null;
    }

    private function getCustomNames($form)
    {
        static $customNames = null;
        if (is_array($customNames)) {
            return $customNames;
        }

        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $this->db->where('LOWER(form)', strtolower($form));
        $customNames = $this->db->get('customer_field_custom_names')->result();
        return $customNames;
    }

    private function respond($data)
    {
        header('content-type: application/json');
        exit(json_encode($data));
    }

    private function getLabels($form)
    {
        switch (strtolower($form)) {
            case 'solar_info':
                return $this->getSolarInfoLabels();

            case 'funding_info':
                return $this->getFundingInfoLabels();

            case 'papers':
                return $this->getPapersFormLabels();

            case 'alarm_info':
                return $this->getAlarmInfoLabels();
        }
    }

    private function getFundingInfoLabels()
    {
        return [
            'Pre-Install Survey',
            'Post-Install Survey',
            'Monitoring Waived',
            'Rebate Offered',
            'Rebate Check # 1',
            'Rebate Check # 1 Amount $',
            'Rebate Check # 2',
            'Rebate Check # 2 Amount $',
            'Activation Fee',
            'Commision Scheme Override',
            'Rep Commission',
            'Rep Upfront Pay',
            'Rep Tiered Upront Bonus',
            'Rep Tiered Holdfund Bonus',
            'Rep Deduction Total',
            'Tech Commission',
            'Tech Upfront Pay',
            'Tech Deduction Total',
            'Rep Hold Fund Charge Back',
            'Rep Payroll Charge Back',
            'Points Scheme Override',
            'Points Included',
            'Price Per Point',
            'Purchase Price',
            'Purchase Multiple',
            'Purchase Discount',
            'Equipment Cost',
            'Labor Cost',
            'Job Profit',
            'Customer Shareable Link',
        ];
    }

    private function getSolarInfoLabels()
    {
        return [
            'Project ID',
            'Lender Type',
            'Proposed System Size',
            'Proposed Modules',
            'Proposed Inverter',
            'Proposed Offset',
            'Proposed Solar $',
            'Proposed Utility $',
            'Proposed Payment',
            'Annual Income',
            'Tree Estimate',
            'Roof Estimate',
            'Utility Account #',
            'Utility Login',
            'Utility Password',
            'Meter Number',
            'Insurance Name',
            'Insurance Number',
            'Policy Number',
        ];
    }

    private function getPapersFormLabels()
    {
        return [
            'Rep Paper',
            'Tech Paper',
            'Scanned',
            'Paperwork',
            'Submitted',
            'Rep Paid',
            'Tech Paid',
            'Funded',
            'Charged Back',
        ];
    }

    private function getAlarmInfoLabels()
    {
        return [
            'Monitoring Company',
            'Monitoring ID',
            'Account Type',
            'Online',
            'In Service',
            'Equipment',
            'Abort Code',
            'Installer Code',
            'Monitoring Confirm#',
            'Signal Confirm#',
            'Panel Type',
            'Warranty Type',
            'Dealer',
            'Login',
            'Customer ID',
            'CS Account',
        ];
    }
}
