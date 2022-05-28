<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsAccess extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(setting('timezone'));

        add_css(array(
           // 'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            "assets/css/accounting/accounting.css",
            'assets/css/dashboard.css',
            'assets/barcharts/css/chart.min.css',
            'assets/barcharts/css/chart.min.css',
            'assets/fa-5/css/fontawesome.min.css',
            'assets/fa-5/css/all.min.css'
        ));
        add_header_js(array(
            'assets/barcharts/js/chart.min.js',
            'assets/barcharts/js/utils.js',
            'assets/barcharts/js/chartjs-plugin-labels.js',
            'assets/js/timeago/dist/timeago.min.js',
            
        ));
        add_footer_js(array(
            //'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/dashboard/main.js',
            'assets/ringcentral/config.js',
            'assets/ringcentral/es6-promise.auto.js',
            'assets/ringcentral/fetch.umd.js',
            'assets/ringcentral/pubnub.4.20.1.js',
            'assets/ringcentral/ringcentral.js',
            'assets/ringcentral/rc_authentication.js'
        ));

        $customer_data   = $this->session->userdata('customer_data');

        $this->customer_id = $customer_data['prof_id'];

        $this->page_data = [
            'url' => assets_url()
        ];

        $this->data = [
            'assets' => assets_url(),
            'body_classes'  => setting('login_theme') == '1' ? 'login-page login-background' : 'login-page-side login-background'
        ];
    }

    public function dashboard()
    {
        $this->page_data['page_title'] = 'Dashboard';
        $this->page_data['page_parent'] = 'Dashboard';
        $this->load->view('customer_access/dashboard', $this->page_data);
    }

    public function messages()
    {
        $this->load->model('CustomerMessages_model');

        $messages   = $this->CustomerMessages_model->getAllByProfId($this->customer_id);

        $this->page_data['page_title'] = 'Messages';
        $this->page_data['page_parent'] = 'Messages';
        $this->page_data['messages'] = $messages;
        $this->load->view('customer_access/messages/list', $this->page_data);
    }

    public function logout()
    {
        $this->session->unset_userdata('customer_data');
        redirect('login/customer','refresh');
    }

    public function ajax_load_messages_list()
    {
        $this->load->model('CustomerMessages_model');
        $this->load->model('CustomerMessageReply_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Users_model');

        $post = $this->input->post();

        $customerMessage = $this->CustomerMessages_model->getById($post['mid']);
        $customerMessageReplies = $this->CustomerMessageReply_model->getAllByCustomerMessageId($customerMessage->id);
        foreach($customerMessageReplies as $r){
            $name = '';
            if( $r->prof_id > 0 ){
                $person = $this->AcsProfile_model->getByProfId($r->prof_id);
                if($person){
                    $name = $person->first_name . ' ' . $person->last_name;
                }
            }else{
                $person = $this->Users_model->getUser($r->user_id);
                if($person){
                    $name = $person->FName . ' ' . $person->LName;
                }
            }

            $r->name = $name;
        }

        $this->page_data['customerMessage'] = $customerMessage;
        $this->page_data['customerMessageReplies'] = $customerMessageReplies;
        $this->load->view('customer_access/messages/ajax_load_messages_list', $this->page_data);
    }

    public function ajax_load_message_thread()
    {
        $this->load->model('CustomerMessageReply_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Users_model');

        $post = $this->input->post();

        $customerMessageReplies = $this->CustomerMessageReply_model->getAllByCustomerMessageId($post['cid']);
        foreach($customerMessageReplies as $r){
            $name = '';
            if( $r->prof_id > 0 ){
                $person = $this->AcsProfile_model->getByProfId($r->prof_id);
                if($person){
                    $name = $person->first_name . ' ' . $person->last_name;
                }
            }else{
                $person = $this->Users_model->getUser($r->user_id);
                if($person){
                    $name = $person->FName . ' ' . $person->LName;
                }
            }

            $r->name = $name;
        }

        $this->page_data['customerMessageReplies'] = $customerMessageReplies;
        $this->load->view('customer_access/messages/ajax_load_message_thread', $this->page_data);
    }

    public function ajax_send_message_reply()
    {
        $this->load->model('CustomerMessages_model');
        $this->load->model('CustomerMessageReply_model');

        $is_success = 0;
        $msg = 'Cannot save message';

        $post = $this->input->post();
        if( $post['message_reply'] != '' && $post['cid'] > 0 ){

            $customer_data   = $this->session->userdata('customer_data');
            $data_reply = [
                'customer_message_id' => $post['cid'],
                'prof_id' => $customer_data['prof_id'],
                'user_id' => 0,
                'message' => $post['message_reply'],
                'date_created' => date("Y-m-d H:i:s")
            ];

            $this->CustomerMessageReply_model->create($data_reply);

            $is_success = 1;
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }
}

/* End of file AcsAccess.php */
/* Location: ./application/controllers/AcsAccess.php */
