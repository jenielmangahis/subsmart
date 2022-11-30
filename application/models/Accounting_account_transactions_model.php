<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_account_transactions_model extends MY_Model {

	public $table = 'accounting_account_transactions';
	
	public function __construct()
	{
		parent::__construct();
	}
}