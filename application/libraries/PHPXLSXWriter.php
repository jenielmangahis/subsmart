<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/PHP_XLSXWriter/xlsxwriter.class.php';

class PHPXLSXWriter extends XLSXWriter
{
	public function __construct()
	{
		parent::__construct();
	}
}

?>