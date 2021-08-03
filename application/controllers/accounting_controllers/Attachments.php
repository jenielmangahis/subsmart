<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attachments extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('accounting_attachments_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css",
            "assets/css/accounting/accounting_includes/receive_payment.css",
            "assets/css/accounting/accounting_includes/customer_sales_receipt_modal.css",
            "assets/css/accounting/accounting_includes/create_charge.css"
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js"
        ));

		$this->page_data['menu_name'] =
            array(
                array("Dashboard",	array()),
                array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Expenses", 	array('Expenses','Vendors')),
                array("Sales", 		array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll", 	array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",	array()),
                array("Taxes",		array("Sales Tax","Payroll Tax")),
                array("Mileage",	array()),
                array("Accounting",	array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                array('/accounting/banking',array()),
                array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', 'credit_notes')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",	array('/accounting/salesTax','/accounting/payrollTax')),
                array('#',	array()),
                array("",	array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/accounting/attachments.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/lists/attachment', $this->page_data);
    }

    public function upload()
    {
        $files = $_FILES['attachments'];

        if(count($files['name']) > 0) {
            $insert = $this->uploadFile($files);

            if(count($insert) > 0) {
                $this->session->set_flashdata('success', "Upload successful!");
            } else {
                $this->session->set_flashdata('error', "Please try again!");
            }
        } else {
            $this->session->set_flashdata('error', "An unexpected error occured!");
        }
    }

    private function uploadFile($files)
    {
        $this->load->helper('string');
        $data = [];
        foreach($files['name'] as $key => $name)
        {
            $extension = end(explode('.', $name));

            do {
                $randomString = random_string('alnum');
                $fileNameToStore = $randomString . '.' .$extension;
                $exists = file_exists('./uploads/accounting/attachments/'.$fileNameToStore);
            } while ($exists);

            $fileType = explode('/', $files['type'][$key]);
            $uploadedName = str_replace('.'.$extension, '', $name);

            $data[] = [
                'company_id' => getLoggedCompanyID(),
                'type' => $fileType[0] === 'application' ? ucfirst($fileType[1]) : ucfirst($fileType[0]),
                'uploaded_name' => $uploadedName,
                'stored_name' => $fileNameToStore,
                'file_extension' => $extension,
                'size' => $files['size'][$key],
                'notes' => null,
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            move_uploaded_file($files['tmp_name'][$key], './uploads/accounting/attachments/'.$fileNameToStore);
        }

        $attachmentIds = [];
        foreach($data as $attachment) {
            $attachmentIds[] = $this->accounting_attachments_model->create($attachment);
        }

        return $attachmentIds;
    }

    public function load_attachment_files()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $start = $post['start'];
        $limit = $post['length'];

        $attachments = $this->accounting_attachments_model->getCompanyAttachments();

        $data = [];

        if(count($attachments) > 0) {
            foreach($attachments as $attachment) {
                $data[] = [
                    'id' => $attachment['id'],
                    'thumbnail' => $attachment['stored_name'],
                    'type' => $attachment['type'],
                    'name' => $attachment['uploaded_name'],
                    'size' => $attachment['size'],
                    'upload_date' => date('m/d/Y', strtotime($attachment['created_at'])),
                    'links' => '',
                    'note' => $attachment['notes']
                ];
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($attachments),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function download()
    {
        $filename = $this->input->get('filename');
        $file = "./uploads/accounting/attachments/$filename";

        if(file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
        }
    }

    public function edit($id)
    {
        $post = $this->input->post();

        $data = [
            'uploaded_name' => $post['file_name'],
            'notes' => $post['notes']
        ];

        $update = $this->accounting_attachments_model->updateAttachment($id, $data);
        $name = $post['file_name'];

        if($update) {
            $this->session->set_flashdata('success', "$name updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/attachments');
    }

    public function delete($id)
    {
        $result = [];

        $attachment = $this->accounting_attachments_model->getById($id);
        if(file_exists("./uploads/accounting/attachments/".$attachment->stored_name)) {
            unlink("./uploads/accounting/attachments/".$attachment->stored_name);
        }
        $name = $attachment->uploaded_name;
        $delete = $this->accounting_attachments_model->delete($id);

        if($delete) {
            $this->session->set_flashdata('success', "$name has been successfully deleted!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function attach()
    {
        $files = $_FILES['file'];

        if(count($files['name']) > 0) {
            $insert = $this->uploadFile($files);

            $return = new stdClass();
            $return->attachment_ids = $insert;
            echo json_encode($return);
        } else {
            echo json_encode('error');
        }
    }

    public function get_all_attachments()
    {
        $attachments = $this->accounting_attachments_model->getCompanyAttachments();

        echo json_encode($attachments);
    }

    public function get_unlinked_attachments()
    {
        $attachments = $this->accounting_attachments_model->get_unlinked_attachments();

        echo json_encode($attachments);
    }
}