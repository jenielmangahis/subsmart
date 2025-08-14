<?php
class Expenses extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Serversidetable_model', 'serverside_table');
    }

    public function index()
    {      
        $this->page_data['title'] = "Expenses V2";
        $this->load->view('v2/pages/accounting/expenses/expenses/list', $this->page_data);
    }
    
}