<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->checkLogin();
        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.modal.css?v='rand()'",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css"
        ));

        add_footer_js(array(
            "assets/js/accounting/main.js",
            "assets/plugins/dropzone/dist/dropzone.js"
        ));

        $this->page_data['menu_name'] =
            array(
                array("Dashboard",  array()),
                array("Banking",    array('Link Bank','Rules','Receipts','Tags')),
                array("Expenses",   array('Expenses','Vendors')),
                array("Sales",      array('Overview','All Sales','Invoices','Customers','Deposits','Products and Services')),
                array("Payroll",    array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",    array()),
                array("Taxes",      array("Sales Tax","Payroll Tax")),
                array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts","Reconcile"))
            ); 
        $this->page_data['menu_link'] = 
            array(
                array('/accounting/banking',array()), 
                array("",   array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')), 
                array("",   array('/accounting/expenses','/accounting/vendors')), 
                array("",   array('/accounting/sales-overview','/accounting/all-sales','/accounting/invoices','/accounting/customers','/accounting/deposits','/accounting/products-and-services')), 
                array("",   array('#','#','#','#','#')), 
                array('#',  array()), 
                array("",   array('#','#')), 
                array('#',  array()), 
                array("",   array('/accounting/chart_of_accounts','#')), 
            ); 
        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }
	
	public function index()
	{
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/check',$this->page_data);
	}

    public function do_upload()
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;
            $config['max_width'] = '1024';
            $config['max_height'] = '1024';

            
            $subfix=$this->input->post('subfix');
            $filepath = $config['upload_path'];

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile_'.$subfix))
            {
                    $error = array('error' => $this->upload->display_errors());

                    //$this->load->view('accounting/upload_success', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $success = array('success' => "successfully added");
                    //$this->load->view('accounting/upload_success', $success);
            }
            $upload_data = $this->upload->data(); 
            $filename = $upload_data['file_name'];
            $fileexe = pathinfo($filename, PATHINFO_EXTENSION);
            $filedate = date('Y-d-m');

            $this->addone_model->uploadfile($filename,$filepath,$fileexe,$filedate);

            //$this->index($id);
    }

    public function showData()
    {
        $datas = array();
        
        //get files from database
        $datas['files'] = $this->addone_model->getUploads();
        
        //load the view
        $html = "";
        //print_r($datas);die();
        foreach ($datas['files'] as $data) {

        $html .= "<div class='existing-box'>
                    <h4>".$data['filename']." <span>".$data['filedate']."</span></h4>";
                    if($data['fileexe']=='jpg' || $data['fileexe']=='jpeg' || $data['fileexe']=='png'){
                    $html .="<div class='priview-img'>
                        <img src='". base_url().'uploads/'.$data['filename']."' alt='' style='    max-height: 64px;max-width: 64px;'>
                    </div>";
                    }else{
                    $html .="<div class='priview-img'>
                        <img src='". base_url().'uploads/'.$data['filename']."' alt='' style='    max-height: 64px;max-width: 64px;'>
                    </div>";
                    }
                    $html .="<div class='act-br'>";
                        if($data['fileexe']=='jpg' || $data['fileexe']=='jpeg' || $data['fileexe']=='png'){
                             $html .="<a href='#preview' onClick='show_preview(".$data['id'].")' class='txbtn previewbtn' data-toggle='modal' data-target='#previewModal' data-image='".$data['filename']."' id='previewid_".$data['id']."'>Preview</a>";
                            }else{
                                $html .="<a href='". base_url().'accounting/check/view/download/'.$data['id']."' class='txbtn previewbtn'>Download</a>";
                                }
                                $html .="</div>
                </div>";
        }
        echo $html;

    }

    public function download($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->addone_model->getUploads(array('id' => $id));
            
            //file path
            $file = 'uploads/'.$fileInfo['filename'];
            
            //download file from directory
            force_download($file, NULL);
        }
    }

}