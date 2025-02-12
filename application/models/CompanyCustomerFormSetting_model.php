<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyCustomerFormSetting_model extends MY_Model
{
    public $table = 'company_customer_form_settings';

    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyIdAndFieldName($cid, $field_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('field_name', $field_name);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteAllByCompanyId($cid)
    {
        $this->db->delete($this->table, ['company_id' => $cid]);
    }
    
    public function formFields()
    {
        $formFields = [
            'funding-information' => [
                'pre_install_survey' => ['field_name' => 'Pre-Install Survey', 'required' => 'yes', 'is_visible' => 'yes'],
                'post_install_survey' => ['field_name' => 'Post-Install Survey', 'required' => 'yes', 'is_visible' => 'yes'],
                'monitoring_waived' => ['field_name' => 'Monitoring Waived', 'required' => 'yes', 'is_visible' => 'yes'],
                'rebate_offer' => ['field_name' => 'Rebate Offered', 'required' => 'yes', 'is_visible' => 'yes'],
                'rebate_check1' => ['field_name' => 'Rebate Check # 1', 'required' => 'yes', 'is_visible' => 'yes'],
                'rebate_check1_amt' => ['field_name' => 'Rebate Check # 1 Amount $', 'required' => 'yes', 'is_visible' => 'yes'],
                'rebate_check2' => ['field_name' => 'Rebate Check # 2', 'required' => 'yes', 'is_visible' => 'yes'],
                'rebate_check2_amt' => ['field_name' => 'Rebate Check # 2 Amount $', 'required' => 'yes', 'is_visible' => 'yes'],
                'activation_fee' => ['field_name' => 'Activation Fee', 'required' => 'yes', 'is_visible' => 'yes'],               
                'commision_scheme' => ['field_name' => 'Commision Scheme Override', 'required' => 'yes', 'is_visible' => 'yes'],               
                'rep_comm' => ['field_name' => 'Rep Commission', 'required' => 'yes', 'is_visible' => 'yes'],               
                'rep_upfront_pay' => ['field_name' => 'Rep Upfront Pay', 'required' => 'yes', 'is_visible' => 'yes'],               
                'rep_holdfund_bonus' => ['field_name' => 'Rep Tiered Hold Fund Bonus', 'required' => 'yes', 'is_visible' => 'yes'],               
                'rep_tiered_bonus' => ['field_name' => 'Rep Tiered Upront Bonus', 'required' => 'yes', 'is_visible' => 'yes'],               
                'rep_deduction' => ['field_name' => 'Rep Deduction Total', 'required' => 'yes', 'is_visible' => 'yes'],               
                'tech_comm' => ['field_name' => 'Tech Commission', 'required' => 'yes', 'is_visible' => 'yes'],               
                'tech_upfront_pay' => ['field_name' => 'Tech Upfront Pay', 'required' => 'yes', 'is_visible' => 'yes'],               
                'tech_deduction' => ['field_name' => 'Tech Deduction Total', 'required' => 'yes', 'is_visible' => 'yes'],               
                'rep_charge_back' => ['field_name' => 'Rep Hold Fund Charge Back', 'required' => 'yes', 'is_visible' => 'yes'],               
                'rep_payroll_charge_back' => ['field_name' => 'Rep Payroll Charge Back', 'required' => 'yes', 'is_visible' => 'yes'],               
                'pso' => ['field_name' => 'Points Scheme Override', 'required' => 'yes', 'is_visible' => 'yes'],               
                'points_include' => ['field_name' => 'Points Included', 'required' => 'yes', 'is_visible' => 'yes'],               
                'price_per_point' => ['field_name' => 'Price Per Point', 'required' => 'yes', 'is_visible' => 'yes'],               
                'purchase_price' => ['field_name' => 'Purchase Price', 'required' => 'yes', 'is_visible' => 'yes'],               
                'purchase_multiple' => ['field_name' => 'Purchase Multiple', 'required' => 'yes', 'is_visible' => 'yes'],               
                'purchase_discount' => ['field_name' => 'Purchase Discount', 'required' => 'yes', 'is_visible' => 'yes'],               
                'equipment_cost' => ['field_name' => 'Equipment Cost', 'required' => 'yes', 'is_visible' => 'yes'],               
                'labor_cost' => ['field_name' => 'Labor Cost', 'required' => 'yes', 'is_visible' => 'yes'],               
                'job_profit' => ['field_name' => 'Job Profit', 'required' => 'yes', 'is_visible' => 'yes'],               
                'url' => ['field_name' => 'Customer Shareable Link', 'required' => 'yes', 'is_visible' => 'yes'],    
            ],
            'alarm-information' => [
                'monitor_comp' => ['field_name' => 'Monitoring Company', 'required' => 'yes', 'is_visible' => 'yes'],
                'monitor_id' => ['field_name' => 'Monitoring ID', 'required' => 'yes', 'is_visible' => 'yes'],
                'acct_type' => ['field_name' => 'Account Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'online' => ['field_name' => 'Online', 'required' => 'yes', 'is_visible' => 'yes'],
                'in_service' => ['field_name' => 'In Service', 'required' => 'yes', 'is_visible' => 'yes'],
                'equipment' => ['field_name' => 'Equipment ', 'required' => 'yes', 'is_visible' => 'yes'],
                'passcode' => ['field_name' => 'Abort Code / Password', 'required' => 'yes', 'is_visible' => 'yes'],
                'install_code' => ['field_name' => 'Installer Code', 'required' => 'yes', 'is_visible' => 'yes'],
                'mcn' => ['field_name' => 'Monitoring Confirm#', 'required' => 'yes', 'is_visible' => 'yes'],
                'scn' => ['field_name' => 'Signal Confirm#', 'required' => 'yes', 'is_visible' => 'yes'],
                'panel_type' => ['field_name' => 'Panel Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'warranty_type' => ['field_name' => 'Warranty Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'comm_type' => ['field_name' => 'Communication Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'otps' => ['field_name' => 'Program and Setup', 'required' => 'yes', 'is_visible' => 'yes'],
                'equipment_cost_alarm' => ['field_name' => 'Equipment Cost', 'required' => 'yes', 'is_visible' => 'yes'],
                'monthly_monitoring' => ['field_name' => 'Monthly Monitoring Rate', 'required' => 'yes', 'is_visible' => 'yes'],
                'account_cost' => ['field_name' => 'Account Cost', 'required' => 'yes', 'is_visible' => 'yes'],
                'pass_thru_cost' => ['field_name' => 'Pass Thru Cost', 'required' => 'yes', 'is_visible' => 'yes'],
                'dealer' => ['field_name' => 'Dealer', 'required' => 'yes', 'is_visible' => 'yes'],
                'alarm_login' => ['field_name' => 'Login', 'required' => 'yes', 'is_visible' => 'yes'],
                'alarm_customer_id' => ['field_name' => 'Customer ID', 'required' => 'yes', 'is_visible' => 'yes'],
                'alarm_cs_account' => ['field_name' => 'CS Account', 'required' => 'yes', 'is_visible' => 'yes'],                
            ],
            'solar-information' => [
                'project_id' => ['field_name' => 'Project ID', 'required' => 'yes', 'is_visible' => 'yes'],
                'lender_type' => ['field_name' => 'Lender Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'proposed_system_size' => ['field_name' => 'Proposed System Size', 'required' => 'yes', 'is_visible' => 'yes'],
                'proposed_modules' => ['field_name' => 'Proposed Modules', 'required' => 'yes', 'is_visible' => 'yes'],
                'proposed_inverter' => ['field_name' => 'Proposed Inverter', 'required' => 'yes', 'is_visible' => 'yes'],
                'proposed_offset' => ['field_name' => 'Proposed Offset', 'required' => 'yes', 'is_visible' => 'yes'],
                'proposed_solar' => ['field_name' => 'Proposed Solar $', 'required' => 'yes', 'is_visible' => 'yes'],
                'proposed_utility' => ['field_name' => 'Proposed Utility $', 'required' => 'yes', 'is_visible' => 'yes'],
                'proposed_payment' => ['field_name' => 'Proposed Payment', 'required' => 'yes', 'is_visible' => 'yes'],
                'annual_income' => ['field_name' => 'Annual Income', 'required' => 'yes', 'is_visible' => 'yes'],
                'tree_estimate' => ['field_name' => 'Tree Estimate', 'required' => 'yes', 'is_visible' => 'yes'],
                'roof_estimate' => ['field_name' => 'Roof Estimate', 'required' => 'yes', 'is_visible' => 'yes'],
                'utility_account' => ['field_name' => 'Utility Account #', 'required' => 'yes', 'is_visible' => 'yes'],
                'utility_login' => ['field_name' => 'Utility Login #', 'required' => 'yes', 'is_visible' => 'yes'],
                'utility_pass' => ['field_name' => 'Utility Password', 'required' => 'yes', 'is_visible' => 'yes'],
                'meter_number' => ['field_name' => 'Meter Number', 'required' => 'yes', 'is_visible' => 'yes'],
                'insurance_name' => ['field_name' => 'Insurance Name', 'required' => 'yes', 'is_visible' => 'yes'],
                'insurance_number' => ['field_name' => 'Insurance Number', 'required' => 'yes', 'is_visible' => 'yes'],
                'policy_number' => ['field_name' => 'Policy Number', 'required' => 'yes', 'is_visible' => 'yes'],
                'solar_system_size' => ['field_name' => 'Solar System Size', 'required' => 'yes', 'is_visible' => 'yes'],
                'kw_dc' => ['field_name' => 'kW DC', 'required' => 'yes', 'is_visible' => 'yes'],
            ],
            'office-use-information' => [
                'entered_by' => ['field_name' => 'Entered By', 'required' => 'yes', 'is_visible' => 'yes'],
                'time_entered' => ['field_name' => 'Time Entered', 'required' => 'yes', 'is_visible' => 'yes'],
                'sales_date' => ['field_name' => 'Sales Date', 'required' => 'yes', 'is_visible' => 'yes'],
                'credit_score' => ['field_name' => 'Credit Score', 'required' => 'yes', 'is_visible' => 'yes'],
                'pay_history' => ['field_name' => 'Pay History', 'required' => 'yes', 'is_visible' => 'yes'],                
                'fk_sales_rep_office' => ['field_name' => 'Sales Rep', 'required' => 'yes', 'is_visible' => 'yes'],
                'technician' => ['field_name' => 'Technician', 'required' => 'yes', 'is_visible' => 'yes'],
                'install_date' => ['field_name' => 'Install Date', 'required' => 'yes', 'is_visible' => 'yes'],
                'tech_arrive_time' => ['field_name' => 'Tech Arrival Time', 'required' => 'yes', 'is_visible' => 'yes'],
                'tech_depart_time' => ['field_name' => 'Tech Depart Time', 'required' => 'yes', 'is_visible' => 'yes'],
                'lead_source' => ['field_name' => 'Lead Source', 'required' => 'yes', 'is_visible' => 'yes'],
                'verification' => ['field_name' => 'Verification', 'required' => 'yes', 'is_visible' => 'yes'],
                'cancel_date' => ['field_name' => 'Cancel Date', 'required' => 'yes', 'is_visible' => 'yes'],
                'cancel_reason' => ['field_name' => 'Cancel Reason', 'required' => 'yes', 'is_visible' => 'yes'],
                'collections' => ['field_name' => 'Collections', 'required' => 'yes', 'is_visible' => 'yes'],
                'collect_date' => ['field_name' => 'Collection Date', 'required' => 'yes', 'is_visible' => 'yes'],
                'collect_amount' => ['field_name' => 'Collection Amount', 'required' => 'yes', 'is_visible' => 'yes'],
                'language' => ['field_name' => 'Language', 'required' => 'yes', 'is_visible' => 'yes'],
                'system_type' => ['field_name' => 'System Package Type', 'required' => 'yes', 'is_visible' => 'yes'],
            ],
            'customer-property' => [
                'prop_inventory' => ['field_name' => 'Inventory', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_plan_type' => ['field_name' => 'Plan Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_deductible' => ['field_name' => 'Deductible', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_revenue' => ['field_name' => 'Revenue', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_territory' => ['field_name' => 'Territory', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_property_tax' => ['field_name' => 'Property Tax', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_add_on' => ['field_name' => 'Add-on', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_ac_type' => ['field_name' => 'AC Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_payment_history' => ['field_name' => 'Payment History', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_late_fee_collected' => ['field_name' => 'Late fee collected', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_alarm_system' => ['field_name' => 'Alarm System', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_key_code' => ['field_name' => 'Key code', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_source' => ['field_name' => 'Source', 'required' => 'yes', 'is_visible' => 'yes'],
                'prop_ownership' => ['field_name' => 'Ownership', 'required' => 'yes', 'is_visible' => 'yes'],
            ],
            'customer-papers' => [
                'rep_paper_date' => ['field_name' => 'Rep Paper', 'required' => 'yes', 'is_visible' => 'yes'],
                'tech_paper_date' => ['field_name' => 'Tech Paper', 'required' => 'yes', 'is_visible' => 'yes'],
                'scanned_date' => ['field_name' => 'Scanned', 'required' => 'yes', 'is_visible' => 'yes'],
                'paperwork' => ['field_name' => 'Paperwork', 'required' => 'yes', 'is_visible' => 'yes'],
                'submitted' => ['field_name' => 'Submitted', 'required' => 'yes', 'is_visible' => 'yes'],
                'rep_paid' => ['field_name' => 'Rep Paid', 'required' => 'yes', 'is_visible' => 'yes'],
                'tech_paid' => ['field_name' => 'Tech Paid', 'required' => 'yes', 'is_visible' => 'yes'],
                'funded' => ['field_name' => 'Funded', 'required' => 'yes', 'is_visible' => 'yes'],
                'charged_back' => ['field_name' => 'Charged Back', 'required' => 'yes', 'is_visible' => 'yes']
            ],
            'portal-access' => [
                'portal_status' => ['field_name' => 'Enable Portal', 'required' => 'yes', 'is_visible' => 'yes'],
                'access_login' => ['field_name' => 'Login', 'required' => 'yes', 'is_visible' => 'yes'],
                'access_password' => ['field_name' => 'Password', 'required' => 'yes', 'is_visible' => 'yes']
            ],
            /*'Customer Profile' => [
                'status' => ['field_name' => 'Status', 'required' => 'yes', 'is_visible' => 'yes'],
                'customer_type' => ['field_name' => 'Customer Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'customer_group_id' => ['field_name' => 'Customer Group', 'required' => 'yes', 'is_visible' => 'yes'],
                'industry_type_id' => ['field_name' => 'Industry Type', 'required' => 'yes', 'is_visible' => 'yes'],
                'fk_sa_id' => ['field_name' => 'Sales Area', 'required' => 'yes', 'is_visible' => 'yes'],
                'first_name' => ['field_name' => 'First Name', 'required' => 'yes', 'is_visible' => 'yes'],
                'middle_name' => ['field_name' => 'Middle Name', 'required' => 'yes', 'is_visible' => 'yes'],
                'last_name' => ['field_name' => 'Last Name', 'required' => 'yes', 'is_visible' => 'yes'],
                'prefix' => ['field_name' => 'Name Prefix', 'required' => 'no', 'is_visible' => 'yes'],
                'suffix' => ['field_name' => 'Suffix', 'required' => 'no', 'is_visible' => 'yes'],
                'country' => ['field_name' => 'Country', 'required' => 'no', 'is_visible' => 'yes'],
                'address' => ['field_name' => 'Adress', 'required' => 'yes', 'is_visible' => 'yes'],
                'city' => ['field_name' => 'City', 'required' => 'yes', 'is_visible' => 'yes'],
                'country' => ['field_name' => 'County', 'required' => 'no', 'is_visible' => 'yes'],
                'state' => ['field_name' => 'State', 'required' => 'yes', 'is_visible' => 'yes'],
                'zip_code' => ['field_name' => 'Zip Code', 'required' => 'yes', 'is_visible' => 'yes'],
                'cross_street' => ['field_name' => 'Cross Street', 'required' => 'yes', 'is_visible' => 'yes'],
                'subdivision' => ['field_name' => 'Subdivision', 'required' => 'no', 'is_visible' => 'yes'],
                'ssn' => ['field_name' => 'Social Security No.', 'required' => 'yes', 'is_visible' => 'yes'],
                'ssn' => ['field_name' => 'Social Security No.', 'required' => 'yes', 'is_visible' => 'yes'],
                'email' => ['field_name' => 'Email', 'required' => 'yes', 'is_visible' => 'yes'],
                'phone_h' => ['field_name' => 'Phone (H)', 'required' => 'yes', 'is_visible' => 'yes'],
                'phone_m' => ['field_name' => 'Phone (M)', 'required' => 'yes', 'is_visible' => 'yes'],
            ],
            'Billing Information' => [
                'card_fname' => ['field_name' => 'Card First Name', 'required' => 'yes', 'is_visible' => 'yes'],
                'card_lname' => ['field_name' => 'Card Last Name', 'required' => 'yes', 'is_visible' => 'yes'],
                'card_address' => ['field_name' => 'Card Address', 'required' => 'yes', 'is_visible' => 'yes'],
                'city' => ['field_name' => 'City', 'required' => 'yes', 'is_visible' => 'yes'],
                'state' => ['field_name' => 'State', 'required' => 'yes', 'is_visible' => 'yes'],
                'zip' => ['field_name' => 'ZIP', 'required' => 'yes', 'is_visible' => 'yes'],
                'equipment' => ['field_name' => 'Equipment', 'required' => 'yes', 'is_visible' => 'yes'],
                'initial_dep' => ['field_name' => 'Initial Dep', 'required' => 'yes', 'is_visible' => 'yes'],
                'mmr' => ['field_name' => 'Rate Plan', 'required' => 'yes', 'is_visible' => 'yes'],
                'bill_freq' => ['field_name' => 'Billing Frequency', 'required' => 'yes', 'is_visible' => 'yes'],
                'contract_term' => ['field_name' => 'Contract Term', 'required' => 'yes', 'is_visible' => 'yes'],
                'bill_start_date' => ['field_name' => 'Billing Start Date', 'required' => 'yes', 'is_visible' => 'yes'],
                'bill_end_date' => ['field_name' => 'Billing End Date', 'required' => 'yes', 'is_visible' => 'yes'],
                'bill_day' => ['field_name' => 'Billing Day of Month', 'required' => 'yes', 'is_visible' => 'yes'],
                'late_fee' => ['field_name' => 'Late Fee', 'required' => 'yes', 'is_visible' => 'yes'],
                'payment_fee' => ['field_name' => 'Payment Fee', 'required' => 'yes', 'is_visible' => 'yes'],
            ],
            'Payment Details' => [
                'bill_method' => ['field_name' => 'Billing Method', 'required' => 'yes', 'is_visible' => 'yes'],
                'credit_card_num' => ['field_name' => 'Credit Card Number', 'required' => 'yes', 'is_visible' => 'yes'],
                'credit_card_exp' => ['field_name' => 'Credit Card Expiration', 'required' => 'yes', 'is_visible' => 'yes'],
                'credit_card_exp_mm_yyyy' => ['field_name' => 'Credit Card CVC', 'required' => 'yes', 'is_visible' => 'yes'],
                'check_num' => ['field_name' => 'Check Number', 'required' => 'yes', 'is_visible' => 'yes'],
                'bank_name' => ['field_name' => 'Bank Name', 'required' => 'yes', 'is_visible' => 'yes'],
                'routing_num' => ['field_name' => 'Routing Number', 'required' => 'yes', 'is_visible' => 'yes'],
                'acct_num' => ['field_name' => 'Account Number', 'required' => 'yes', 'is_visible' => 'yes'],
            ]*/
        ];  

        return $formFields;
    }

    public function createBatchData($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

}

/* End of file CompanyCustomerFormSetting_model.php */
/* Location: ./application/models/CompanyCustomerFormSetting_model.php */
