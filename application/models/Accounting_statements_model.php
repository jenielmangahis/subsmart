<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_statements_model extends MY_Model {

    public $table = 'accounting_statements';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
    }

    function insertCustomers($data)
    {
        $this->db->insert_batch('accounting_statement_customers', $data);
	    return $this->db->insert_id();
    }

    function getAllComp($company_id)
    {
        $where = array(
            'accounting_statements.company_id'      => $company_id,
          );

        $this->db->select('*');
        $this->db->from('accounting_statements');
        $this->db->join('accounting_statement_customers', 'accounting_statements.id  = accounting_statement_customers.statement_id');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }
}