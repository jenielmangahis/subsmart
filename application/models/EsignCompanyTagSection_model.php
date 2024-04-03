<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EsignCompanyTagSection_model extends MY_Model {
    
    public $table = 'esign_company_tag_sections';

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);                
        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result();

    }

    public function getAllNotDeletedByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);                
        $this->db->where('is_deleted', 0);                
        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result();

    }

    public function getAllDeletedByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);                
        $this->db->where('is_deleted', 1);                
        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result();

    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);         
        $query = $this->db->get()->row();
        return $query;
    }

    public function saveTagSection($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();

        return $last_id;
    }

    public function optionAutoPopulateData()
    {
        $options = [
            'Customer' => 'Customer',
            'Invoice' => 'Invoice',
            'Company' => 'Company',
            'Job' => 'Job'
        ];

        return $options;
    }

    public function optionCustomerFields()
    {
        $options = [
            'Customer Name' => 'Name',
            'Customer Firstname' => 'Firstname',
            'Customer Lastname' => 'Lastname',
            'Customer Email' => 'Email',
            'Customer Mobile' => 'Mobile',
            'Customer Phone' => 'Phone',
            'Customer Address' => 'Address',
            'Customer City' => 'City',
            'Customer State' => 'State',
            'Customer Zip' => 'Zip',
            'Customer SSS' => 'Social Security Number',
            'Customer Date of Birth' => 'Date of Birth'
        ];

        return $options;
    }

    public function optionCustomerFieldsAdi()
    {
        $options = [
            'Customer Name' => 'Name',
            'Customer Firstname' => 'Firstname',
            'Customer Lastname' => 'Lastname',
            'Customer Email' => 'Email',
            'Customer Mobile' => 'Mobile',
            'Customer Phone' => 'Phone',
            'Customer Address' => 'Address',
            'Customer City' => 'City',
            'Customer State' => 'State',
            'Customer Zip' => 'Zip',
            'Customer SSS' => 'Social Security Number',
            'Customer Date of Birth' => 'Date of Birth',
            'Customer Password' => 'Access Password',
            'Customer Abort Code' => 'Abort Code',
            'Customer Panel Type' => 'Panel Type'
        ];

        return $options;
    }

    public function optionCompanyFields()
    {
        $options = [
            'Company Name' => 'Name',
            'Company Address' => 'Address',
            'Company City' => 'City',
            'Company State' => 'State',
            'Company Zip' => 'Zip'
        ];

        return $options;
    }

    public function optionInvoiceFields()
    {
        $options = [
            'Invoice Equipment Cost' => 'Equipment Cost',
            'Invoice Monthly Monitoring Rate' => 'Monthly Monitoring Rate',
            'Invoice One Time Activation' => 'One Time Activation (OTP)',
            'Invoice Installation Cost' => 'Installation Cost',
            'Invoice Total Due' => 'Total Due'
        ];

        return $options;
    }

    public function optionJobFields()
    {
        $options = [
            'Job Account Number' => 'Job Account Number',
            'Job Name' => 'Job Name',
            'Job Number' => 'Job Number',
            'Job Type' => 'Job Type'
        ];

        return $options;
    }
}
