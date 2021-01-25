<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Credit_Notes extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Credit Notes';
        $this->page_data['page']->menu = 'credit_notes';
        $this->load->model('CreditNote_model');
        $this->load->model('CreditNoteItem_model');

        $this->checkLogin();

        $user_id = getLoggedUserID();

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
			"assets/css/accounting/sidebar.css",
        ));

        add_footer_js(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/estimate/estimate.js',
        ));
    }

    public function index($tab = '')
    {
        
        $status = $this->CreditNote_model->optionStatus();

        $statusSummary = array();
        $company_id    = logged('company_id');
        $role = logged('role');
        $total_all = 0;

        if( $role == 1 || $role == 2 ){  
            foreach($status as $key => $value){
                $total = $this->CreditNote_model->countAllByStatus($key);
                $total_all+= $total;
                $statusSummary[$key] = $total;
            }
            $this->page_data['total_all'] = $total_all;
            $this->page_data['statusSummary'] = $statusSummary;
            if( $tab > 0 ){
                $this->page_data['creditNotes'] = $this->CreditNote_model->getAllByCompanyIdAndStatus($company_id,$tab);
            }else{
                $this->page_data['creditNotes'] = $this->CreditNote_model->getAllByCompanyId($company_id);    
            }
            
        }else{
            foreach($status as $key => $value){
                $total = $this->CreditNote_model->countAllByStatusAndCompanyId($key,$company_id);
                $total_all+= $total;
                $statusSummary[$key] = $this->CreditNote_model->countAllByStatusAndCompanyId($key,$company_id);
            }

            $this->page_data['total_all'] = $total_all;
            $this->page_data['statusSummary'] = $statusSummary;
            if( $tab > 0 ){
                $this->page_data['creditNotes'] = $this->CreditNote_model->getAllByStatus($tab);    
            }else{
                $this->page_data['creditNotes'] = $this->CreditNote_model->getAll();    
            }
        }

        $this->page_data['tab'] = $tab;
        $this->page_data['status'] = $status;
        $this->load->view('credit_notes/list', $this->page_data);
    }

    public function add_new()
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $role = logged('role');
        if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();    
        }
        
        $this->load->view('credit_notes/add', $this->page_data);
    }

    public function save()
    {
        postAllowed();

        $user_id = logged('id');
        $post    = $this->input->post();

        if( $post['customer_id'] > 0 && $post['job_name'] != '' ){
            $data = [
                'user_id' => $user_id,
                'customer_id' => $post['customer_id'],
                'job_name' => $post['job_name'],
                'credit_note_number' => $post['credit_note_number'],
                'date_issued' => date("Y-m-d",strtotime($post['date_issued'])),
                'expiry_date' => date("Y-m-d",strtotime($post['expiry_date'])),
                'adjustment_name' => '',
                'adjustment_amount' => 0,
                'total_discount' => $post['total_discount'],
                'grand_total' => $post['total_due'],
                'note_customer' => $post['customer_message'],
                'terms_condition' => $post['terms_conditions'],
                'status' => $this->CreditNote_model->isDraft(),
                'created' => date("Y-m-d H:i:s"),
                'modified' => date("Y-m-d H:i:s")
            ];

            $credit_note_id = $this->CreditNote_model->saveCreditNote($data);
            if( $credit_note_id > 0 ){
                foreach($post['itemIds'] as $key => $value){
                    $data = [
                        'credit_note_id' => $credit_note_id,
                        'item_id' => $value,
                        'qty' => $post['quantity'][$key],
                        'price' => $post['price'][$key],
                        'discount' => $post['discount'][$key],
                        'tax' => $post['tax'][$key],
                        'total' => $post['itemTotal'][$key]
                    ];

                    $this->CreditNoteItem_model->create($data);
                }
            }else{
                $this->session->set_flashdata('message', 'Cannot save data. Please check your entries.');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

        }else{
            $this->session->set_flashdata('message', 'Cannot save data. Please check your entries.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('credit_notes');
    }
}