<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_element_rules_model extends MY_Model {

	public $table = 'form_element_rules';

    public function __construct()
	{
		parent::__construct();
		$this->load->model('FB_elements_model', 'form_elements');
    }
    
    function create($data) {
        try {
            $this->db->insert($this->table, $data['form_element']);
            $elementRuleId = $this->db->insert_id();
            
            $newData = [ 
				'element_rule_id' => $elementRuleId
            ];
            
            $response = [
				'code' 		=> 200,
				'message' 	=> 'created',
				'data'		=> $newData
			];
        } catch(\Exception $e) {
            $response = [
				'code' 		=> 500,
				'message' 	=> $e->getMessage(),
				'data'		=> []
			];
        }

	    return $response;
    }

    function update($data, $id) {
        try {
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update($this->table);

            $response = [
				'data' 	=> [],
				'code'	=> 200,
				'message'	=> 'Updated'
			];
        } catch(\Exception $e) {
            $response = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error updating form styles. please try again later or contact customer support.'
			];
        }

        return $response;
    }
}