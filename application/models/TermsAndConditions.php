<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TermsAndConditions extends MY_Model {

	public $table = 'busniess_terms_and_conditions';
	// public $table = 'busniess_terms_and_conditions';
	
	public function __construct()
	{
		parent::__construct();
    }
    
    public function getAll($companyID) {
        try {
            $this->db->select("*");
            $this->db->where('company_id', $companyID);
            $query =  $this->db->get($this->table);
            $arr = [
                'code'      => 201,
                'data'      =>  $query->result(),
                'message'   => 'Successfuly fetched terms and conditions'
            ];
		} catch (\Exception $e) {
            $arr = [
                'code'      => 500,
                'data'      => [],
                'message'   => 'Error fetching terms and conditions.'
            ];
        }
        return $arr;
    }

    public function add($data) {
        try {
            $this->db->insert($this->table, $data);
            $arr = [
                'code'      => 201,
                'data'      =>  [
                            'id' => $this->db->insert_id()
                        ],
                'message'   => 'Terms and conditions saved successfuly'
            ];
		} catch (\Exception $e) {
            $arr = [
                'code'      => 500,
                'data'      => [],
                'message'   => 'Error saving terms and conditions.'
            ];
        }
        return $arr;
    }

    public function update($id, $data) {
        try {
            $this->db->where('id', $id);
            $this->db->set($data);
            $this->db->update($this->table);
            $arr = [
                'code'      => 201,
                'data'      =>  [],
                'message'   => 'Terms and conditions saved successfuly'
            ];

		} catch (\Exception $e) {
            $arr = [
                'code'      => 500,
                'data'      => [],
                'message'   => 'Error saving terms and conditions.'
            ];
        }
        return $arr;
    }

    public function destroy($id) {
        try {
            $this->db->where('id', $id);
            $this->db->delete($this->table);
            $arr = [
                'code'      => 201,
                'data'      =>  [],
                'message'   => 'Terms and conditions deleted successfuly'
            ];

		} catch (\Exception $e) {
            $arr = [
                'code'      => 500,
                'data'      => [],
                'message'   => 'Error deleting terms and conditions.'
            ];
        }
        return $arr;
    }

    public function getOneByID($id) {
        try {
            $this->db->select("*");
            $this->db->where('id', $id);
            $query =  $this->db->get($this->table);
            $arr = [
                'code'      => 201,
                'data'      =>  $query->row(),
                'message'   => 'Successfuly fetched terms and conditions'
            ];
		} catch (\Exception $e) {
            $arr = [
                'code'      => 500,
                'data'      => [],
                'message'   => 'Error fetching terms and conditions.'
            ];
        }
        return $arr;
    }

}