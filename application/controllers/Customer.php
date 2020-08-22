<?php


defined('BASEPATH') or exit('No direct script access allowed');

// add services
include_once 'application/services/CustomerGroup.php';
include_once 'application/services/CustomerSource.php';
include_once 'application/services/CustomerTypes.php';
include_once 'application/services/CustomerTicket.php';

class Customer extends MY_Controller

{


    public function __construct()

    {

        parent::__construct();


        $this->page_data['page']->title = 'My Customers';

        $this->page_data['page']->menu = 'customers';

        $this->load->model('Customer_model', 'customer_model');
        $this->load->model('CustomerAddress_model', 'customeraddress_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');


        $this->checkLogin();


        $this->load->library('session');
        $this->load->library('form_validation');

        $user_id = getLoggedUserID();


        // concept

        $uid = $this->session->userdata('uid');


        if (empty($uid)) {

            $this->page_data['uid'] = md5(time());

            $this->session->set_userdata(['uid' => $this->page_data['uid']]);

        } else {

            $uid = $this->session->userdata('uid');

            $this->page_data['uid'] = $uid;

        }


        // CSS to add only Customer module

        add_css(array(
            'assets/css/jquery.signaturepad.css',
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'assets/css/accounting/sales.css',
        ));


        // JS to add only Customer module

        add_footer_js(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/creditcard.js',
            'assets/frontend/js/customer/add.js',
        ));

    }


    public function index($status_index = 0)
    {

       //echo  $this->uri->segment(3);
      // echo  $this->uri->segment(4);
        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $company_id = logged('company_id');

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('status' => $status_index), $company_id));
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('search' => get('search')), $company_id));
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id));
                    } else {
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type')), $company_id));
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id));
                    } else {
//                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')), $company_id);
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->getAllByCompany($company_id));
                    }

//                    $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id);
                }
            }

            $this->page_data['statusCount'] = $this->customer_model->getStatusWithCount($company_id);

        }

        if ($role == 4) {

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('status' => $status_index)));
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('search' => get('search'))));
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order'))));
                    } else {
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type'))));
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order'))));
                    } else {
//                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')));
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->getAllByUserId());
                    }

//                    $this->page_data['customers'] = $this->customer_model->getAllByUserId();
                }
            }

            $this->page_data['statusCount'] = $this->customer_model->getStatusWithCount();
        }

        $this->page_data['customers'] = $this->customer_model->getAllByUserId();
        $user_id = logged('id');
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id',$user_id,"ac_module_sort");
        if(!$check_if_exist){
            $input = array();
            $input['fk_user_id'] = $user_id ;
            $input['ams_values'] = "profile,score,tech,access,admin,office,owner,docu,tasks,memo,invoice,assign,cim,billing,alarm,dispute" ;
            $this->customer_ad_model->add($input,"ac_module_sort");
        }
        $this->page_data['module_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id',$user_id,"ac_module_sort");
        $this->page_data['cust_tab'] = $this->uri->segment(3);
        $this->page_data['lead_types'] = $this->customer_ad_model->get_all(FALSE,"","","ac_leadtypes","lead_id");
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","","ac_salesarea","sa_id");
        $this->load->view('customer/list', $this->page_data);
    }
    public function view($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {

            foreach ($customer as $key => $value) {

                if (is_serialized($value)) {

                    $customer->{$key} = unserialize($value);
                }
            }

            $customer->company = get_company_by_user_id();

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/mixedview', $this->page_data);
    }
    /**
     * @param $id
     */
    public function genview($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {

            foreach ($customer as $key => $value) {

                if (is_serialized($value)) {

                    $customer->{$key} = unserialize($value);
                }
            }

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/genview', $this->page_data);
    }
    /**
     * @param $id
     */
    public function mixedview($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {

            foreach ($customer as $key => $value) {

                if (is_serialized($value)) {

                    $customer->{$key} = unserialize($value);
                }
            }

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/mixedview', $this->page_data);
    }

    public function edit($id)
    {
        $company_id = logged('company_id');

        $user_id = logged('id');

        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();


        $this->load->model('Users_model', 'users_model');


        if ($parent_id->parent_id == 1) {

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);

        } else {

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);

        }

        $this->page_data['customer'] = $this->customer_model->getByWhere(['company_id' => $company_id]);

        $this->page_data['customer'] = $this->customer_model->getById($id);

        //$this->page_data['customer']->service_address = unserialize($this->page_data['customer']->service_address);

        $this->page_data['customer']->additional_contacts = unserialize($this->page_data['customer']->additional_contacts);

        $this->page_data['customer']->additional_info = unserialize($this->page_data['customer']->additional_info);

        $this->page_data['customer']->card_info = unserialize($this->page_data['customer']->card_info);

        if (is_serialized($this->page_data['customer']->phone)) {
            $this->page_data['customer']->phone = unserialize($this->page_data['customer']->phone)['number'];
        }
        $this->page_data['customer']->customer_group = unserialize($this->page_data['customer']->customer_group);

        $this->page_data['groups'] = get_customer_groups();


        $this->load->model('Source_model', 'source_model');

        $this->page_data['customer']->service_address = $this->customeraddress_model->getByModelAndType($id,'customer','service_address');

        $this->page_data['customer']->source = $this->source_model->getSource($this->page_data['customer']->source_id);


        $this->load->view('customer/edit', $this->page_data);

    }


    public function save()

    {


        $user = (object)$this->session->userdata('logged');

        $company_id = logged('company_id');



        $data = array(


            'customer_type' => post('customer_type'),

            'contact_name' => post('contact_name'),

            'contact_email' => post('contact_email'),

            'mobile' => post('contact_mobile'),

            'phone' => post('contact_phone'),

            'notification_method' => post('notify_by'),

            'street_address' => post('street_address'),

            'suite_unit' => post('suite_unit'),

            'city	' => post('city'),

            'postal_code' => post('zip'),

            'state' => post('state'),

            'birthday' => post('birthday'),

            'source_id' => post('customer_source_id'),

            'comments' => post('notes'),

            'user_id' => $user->id,

            'additional_info' => (!empty(post('additional'))) ? serialize(post('additional')) : NULL,

            'card_info' => (!empty(post('card'))) ? serialize(post('card')) : NULL,

            'company_id' => $company_id,

            'customer_group' => (!empty(post('customer_group'))) ? serialize(post('customer_group')) : serialize(array()),

        );


        // previously generated customer id

        // this id will be present on session if addition contact or service address has been added

        $cid = $this->session->userdata('customer_id');


        // if no addition contact or service address has been added

        // create() will be called insted of update()

        // if (!empty($cid)) {


        //     $id = $this->customer_model->update($cid, $data);

        // } else {

            $id = $this->customer_model->create($data);

            if(!empty($this->input->post('service_address')))
            {
                foreach($this->input->post('service_address') as $key => $value)
                {
                    $temp_data = $value;
                    $temp_data['customer_id'] = $id;
                    $temp_data['module'] = 'customer';
                    $temp_data['type'] = 'service_address';
                    $this->customeraddress_model->create($temp_data);
                }
            }

        // }

        // $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'New Customer Created Successfully');


        // clear sessions

        $this->session->unset_userdata('uid');

        $this->session->unset_userdata('customer_id');
        redirect('customer');

    }


    public function update($id)

    {

        $user = (object)$this->session->userdata('logged');

        $company_id = logged('company_id');

        $data = array(


            'customer_type' => post('customer_type'),

            'contact_name' => post('contact_name'),

            'contact_email' => post('contact_email'),

            'mobile' => post('contact_mobile'),

            'phone' => post('contact_phone'),

            'notification_method' => post('notify_by'),

            'street_address' => post('street_address'),

            'suite_unit' => post('suite_unit'),

            'city	' => post('city'),

            'postal_code' => post('zip'),

            'state' => post('state'),

            'birthday' => date('Y-m-d', strtotime(post('birthday'))),

            'source_id' => post('customer_source_id'),

            'comments' => post('notes'),

            'user_id' => $user->id,

            'additional_info' => (!empty(post('additional'))) ? serialize(post('additional')) : NULL,

            'card_info' => (!empty(post('card'))) ? serialize(post('card')) : NULL,

            'company_id' => $company_id,

            'customer_group' => (!empty(post('customer_group'))) ? serialize(post('customer_group')) : serialize(array()),

        );


        $id = $this->customer_model->update($id, $data);


        if(!empty($this->input->post('service_address'))>0)
        {
            foreach($this->input->post('service_address') as $key => $value)
            {
                $temp_data = $value;
                unset($temp_data['id']);

                if(isset($value['id']) && $value['id'] != '' && $value['id'] > 0)
                {
                  // $this->customeraddress_model->update($temp_data)->where('id',$value->id);
                   // $this->db->where('id', $id);
                   //  $this->db->update('user', $data);
                   $this->db->where('id', $value['id']);
                    $this->db->update($this->customeraddress_model->table, $temp_data);
                } else {
                    $temp_data['customer_id'] = $id;
                    $temp_data['module'] = 'customer';
                    $temp_data['type'] = 'service_address';
                    $this->customeraddress_model->create($temp_data);
                }
            }
        }


        if($this->input->post('service_address_container_deleted_addresses') !='')
        {
            $delete_list = explode(",", $this->input->post('service_address_container_deleted_addresses'));
            $this->db->from($this->customeraddress_model->table);
            $this->db->where('customer_id ', $id);
            $this->db->where_in('id', $delete_list);
            $this->db->delete();
        }

        $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Customer has been Updated Successfully');


        die(json_encode(

            array(

                'url' => base_url('customer')

            )

        ));

    }


    public function service_address_form()

    {


        $get = $this->input->get();


        if (!empty($get)) {


            $this->page_data['action'] = $get['action'];

            $this->page_data['data_index'] = $get['index'];

            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);

            $this->page_data['service_address'] = $this->customer_model->getServiceAddress(array('id' => $get['customer_id']), $get['index']);

            // print_r($this->page_data['service_address']); die;

        }


        die($this->load->view('customer/service_address_form', $this->page_data, true));

    }


    public function save_service_address()

    {


        $post = $this->input->post();


        // save service address to db

        if (!empty($post['customer_id'])) {

            $cid = $post['customer_id'];

        } else {

            $cid = $this->session->userdata('customer_id');

        }


        if (empty($cid))

            $customer_id = $this->customer_model->saveServiceAddress($post);

        else {

            $this->customer_model->saveServiceAddress($post, $cid);

        }


        if (empty($cid)) {

            $this->session->set_userdata(['customer_id' => $customer_id]);

        } else {

            $customer_id = $cid;

        }


        die(json_encode(

            array(

                'customer_id' => $customer_id

            )

        ));

    }


    public function json_get_address_services()

    {


        $get = $this->input->get();


        if (!empty($get['customer_id'])) {

            $cid = $get['customer_id'];

        } else {

            $cid = $this->session->userdata('customer_id');

        }


        if (!empty($cid)) {


            $this->page_data['customer_id'] = $cid;

            $this->page_data['serviceAddresses'] = $this->customer_model->getServiceAddress(array('id' => $cid));

            // echo '<pre>'; print_r($serviceAddresses); die;

        }


        die($this->load->view('customer/service_address_list', $this->page_data, true));

    }


    public function add()

    {


        $user_id = logged('id');

        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();


        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//

        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);

        // } else {

        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);

        // }


        //


        $company_id = logged('company_id');

       // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);

        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        //$this->page_data['groups'] = get_customer_groups();


        $this->load->view('customer/add', $this->page_data);

    }

    public function leads()
    {
        $user_id = logged('id');
        $this->page_data['plans'] = "";
        $this->load->view('customer/leads', $this->page_data);
    }

    public function ac_module_sort(){
        //$user_id = logged('id');
        $input = $this->input->post();
        if($this->customer_ad_model->update_data($input,"ac_module_sort","ams_id")){
            echo "Module Sort Updated!";
        }else{
            echo "Error";
        }
    }

    public function add_advance()
    {

        $user_id = logged('id');
        $this->page_data['plans'] = "";
        $this->load->view('customer/add_advance', $this->page_data);
    }

    public function add_lead()
    {
        $user_id = logged('id');
        $this->page_data['plans'] = "";
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['lead_types'] = $this->customer_ad_model->get_all(FALSE,"","ASC","ac_leadtypes","lead_id");
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","ASC","ac_salesarea","sa_id");
        $this->load->view('customer/add_lead', $this->page_data);
    }

    // for addling of Lead Type (ac_leadtypes table)
    public function add_leadtype_ajax(){
        $input = $this->input->post();
        // customer_ad_model
        if(empty($input['lead_id'])){
            unset($input['lead_id']);
            if($this->customer_ad_model->add($input,"ac_leadtypes")){
                echo "Success";
            }else{
                echo "Error";
            }
        }else{
            if($this->customer_ad_model->update_data($input,"ac_leadtypes","lead_id")){
                echo "Updated";
            }else{
                echo "Error";
            }
        }
    }

    public function add_salesarea_ajax(){
        $input = $this->input->post();
        // customer_ad_model
        if(empty($input['sa_id'])){
            unset($input['sa_id']);
            if($this->customer_ad_model->add($input,"ac_salesarea")){
                echo "Sales Area Added!";
            }else{
                echo "Error";
            }
        }else{
            if($this->customer_ad_model->update_data($input,"ac_salesarea","sa_id")){
                echo "Updated";
            }else{
                echo "Error";
            }
        }
    }
    public function add_leadsource_ajax(){
        $input = $this->input->post();
        // customer_ad_model
        if(empty($input['ls_id'])){
            unset($input['ls_id']);
            if($this->customer_ad_model->add($input,"ac_leadsource")){
                echo "Lead Source Added!";
            }else{
                echo "Error";
            }
        }else{
            if($this->customer_ad_model->update_data($input,"ac_leadsource","ls_id")){
                echo "Updated";
            }else{
                echo "Error";
            }
        }
    }

    public function fetch_leadtype_data()
    {
        $lead_types = $this->customer_ad_model->get_all(FALSE, "", "DESC", "ac_leadtypes", "lead_id");
        echo json_encode($lead_types);
    }
    public function fetch_leadsource_data(){
        $lead_source = $this->customer_ad_model->get_all(FALSE,"","DESC","ac_leadsource","ls_id");
        echo json_encode($lead_source);
    }
    public function fetch_salesarea_data(){
        $lead_types = $this->customer_ad_model->get_all(FALSE,"","DESC","ac_salesarea","sa_id");
        echo json_encode($lead_types);
    }
    public function delete_data(){
        $tbl = $_POST['table'];
        $input = array();
        switch($tbl){
            case "sa":
                $input['field_name'] = "sa_id";
                $input['id'] = $_POST['id'];
                $input['tablename'] = "ac_salesarea";
                break;
            case "lt":
                $input['field_name'] = "lead_id";
                $input['id'] = $_POST['id'];
                $input['tablename'] = "ac_leadtypes";
                break;
            case "ls":
                $input['field_name'] = "ls_id";
                $input['id'] = $_POST['id'];
                $input['tablename'] = "ac_leadsource";
                break;
            default;
        }

        if ($this->customer_ad_model->delete($input)) {
            echo  "nice";
        }
    }

    public function remove_address_services()

    {


        $post = $this->input->post();


        if ($this->customer_model->removeServiceAddress($post['customer_id'], $post['index'])) {


            die(json_encode(

                array(

                    'status' => 'success'

                )

            ));

        } else {


            die(json_encode(

                array(

                    'status' => 'error'

                )

            ));

        }

    }


    public function additional_contact_form()

    {

        $get = $this->input->get();


        if (!empty($get)) {


            $this->page_data['action'] = $get['action'];

            $this->page_data['data_index'] = $get['index'];

            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);

            $this->page_data['additional_contacts'] = $this->customer_model->getAdditionalContacts(array('id' => $get['customer_id']), $get['index']);

            // print_r($this->page_data['service_address']); die;

        }


        die($this->load->view('customer/additional_contact_form', $this->page_data, true));

    }


    public function json_get_additional_contacts()

    {

        $get = $this->input->get();


        if (!empty($get['customer_id'])) {

            $cid = $get['customer_id'];

        } else {

            $cid = $this->session->userdata('customer_id');

        }


        if (!empty($cid)) {


            $this->page_data['customer_id'] = $cid;

            $this->page_data['additionalContacts'] = $this->customer_model->getAdditionalContacts(array('id' => $cid));

            // echo '<pre>'; print_r($serviceAddresses); die;

        }


        die($this->load->view('customer/additional_contact_list', $this->page_data, true));

    }


    public function save_additional_contact()

    {


        $post = $this->input->post();


        // clear sessions

        // $this->session->unset_userdata('uid');

        // $this->session->unset_userdata('customer_id');


        // save service address to db

        if (!empty($post['customer_id'])) {

            $cid = $post['customer_id'];

        } else {

            $cid = $this->session->userdata('customer_id');

        }


        if (empty($cid))

            $customer_id = $this->customer_model->saveAdditionalContact($post);

        else {

            $this->customer_model->saveAdditionalContact($post, $cid);

        }


        if (empty($cid)) {

            $this->session->set_userdata(['customer_id' => $customer_id]);

        } else {

            $customer_id = $cid;

        }


        die(json_encode(

            array(

                'customer_id' => $customer_id

            )

        ));

    }


    public function remove_additional_contact()

    {


        $post = $this->input->post();


        if ($this->customer_model->removeAdditionalContact($post['customer_id'], $post['index'])) {


            die(json_encode(

                array(

                    'status' => 'success'

                )

            ));

        } else {


            die(json_encode(

                array(

                    'status' => 'error'

                )

            ));

        }

    }


    public function json_dropdown_customer_list()
    {


        $get = $this->input->get();

        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $company_id = logged('company_id');

            $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id, $get);

        }

        if ($role == 4) {

            $this->page_data['customers'] = $this->customer_model->getAllByUserId('', '', 0, 0, $get);

        }


        die(json_encode($this->page_data['customers']));

    }


    public function tab($index)
    {

        $this->index($index);
    }


    /**
     * @param $id
     */
    public function delete($id)

    {

        if ($id !== 1 && $id != logged($id)) {
        } else {

            redirect('/', 'refresh');

            return;
        }


        $id = $this->customer_model->delete($id);


        $this->activity_model->add("Customer #$id Deleted by User:" . logged('name'));


        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Customer has been Deleted Successfully');


        redirect('customer');
    }


    /**
     * used a concept of Service here
     * If we need the Priority module on other controller, we have to write same code
     * like add, edit, delete route on that controller again. If we need a change, we have to do on all controller.
     * Also, it has multiple level of route, so put all together in one controller, code become hard to read.
     * So, to get rid of these issues, the service class every time whenever we need this module.
     *
     */
    public function group()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerGroup = new CustomerGroup($this);
    }


    /**
     *
     */
    public function source()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerSource = new CustomerSource($this);
    }

    public function types()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerTypes = new CustomerTypes($this);
    }

    /**
     *
     */
    public function ticket()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerTicket = new CustomerTicket($this);
    }


    public function group_form()
    {
        $get = $this->input->get();
        if (!empty($get)) {
            $this->page_data['action'] = $get['action'];
            $this->page_data['data_index'] = $get['index'];
            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);
            $this->page_data['group'] = $this->customer_model->getServiceAddress(array('id' => $get['customer_id']), $get['index']);
        }
        die($this->load->view('customer/group_form', $this->page_data, true));
    }


    public function print($status_index = 0)
    {

        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $company_id = logged('company_id');

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                $this->page_data['customers'] = $this->customer_model->filterBy(array('status' => $status_index), $company_id);
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['customers'] = $this->customer_model->filterBy(array('search' => get('search')), $company_id);
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id);
                    } else {
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')), $company_id);
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id);
                    } else {
//                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')), $company_id);
                        $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id);
                    }

//                    $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id);
                }
            }

            $this->page_data['statusCount'] = $this->customer_model->getStatusWithCount($company_id);

        }

        if ($role == 4) {

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                $this->page_data['customers'] = $this->customer_model->filterBy(array('status' => $status_index));
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['customers'] = $this->customer_model->filterBy(array('search' => get('search')));
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')));
                    } else {
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')));
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')));
                    } else {
//                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')));
                        $this->page_data['customers'] = $this->customer_model->getAllByUserId();
                    }

//                    $this->page_data['customers'] = $this->customer_model->getAllByUserId();
                }
            }

            $this->page_data['statusCount'] = $this->customer_model->getStatusWithCount();
        }

//        print_r($this->page_data['statusCount']); die;

        $this->load->view('customer/print/list', $this->page_data);

    }

    public function categorizeNameAlphabetically($items) {
        $result = array();

        $cat = array(
            '#' => array(),
            'A' => array(),
            'B' => array(),
            'C' => array(),
            'D' => array(),
            'E' => array(),
            'F' => array(),
            'G' => array(),
            'H' => array(),
            'I' => array(),
            'J' => array(),
            'K' => array(),
            'L' => array(),
            'M' => array(),
            'N' => array(),
            'O' => array(),
            'P' => array(),
            'Q' => array(),
            'R' => array(),
            'S' => array(),
            'T' => array(),
            'U' => array(),
            'V' => array(),
            'W' => array(),
            'X' => array(),
            'Y' => array(),
            'Z' => array()
        );

        foreach($items as $item) {
            $letter = ucfirst(substr($item->contact_name,0,1));
            foreach($cat as $key => $c) {
                if ($letter == $key) {
                    array_push($cat[$key], $item);
                } else if (is_numeric($letter)) {
                    if (!in_array($item, $cat["#"]))
                        array_push($cat["#"], $item);
                }
            }
        }

        foreach($cat as $key => $c) {
            if(!empty($c)) {
                $header = array($key, "header", "", "");
                array_push($result,$header);

                foreach($c as $v) {
                    $value = array($v->id, $v->contact_name, $v->contact_email, $v->phone);
                    array_push($result,$value);
                }
            }
        }

        return $result;
    }

    public function exportItems()
    {
        $items = $this->customer_model->getByCompanyId(logged('company_id'));
        $delimiter = ",";
        $filename = getLoggedName()."_customer.csv";

        $f = fopen('php://memory', 'w');

        $fields = array('Customer Type', 'Company Name', 'Contact Name', 'Contact Email', 'Mobile', 'Phone', 'Birthday', 'Suite Unit', 'Street Address', 'City', 'State', 'Postal Code');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {
            foreach ($items as $item) {
                $csvData = array($item->customer_type, $item->company_name, $item->contact_name, $item->contact_email, $item->mobile, $item->phone, $item->birthday, $item->suite_unit, $item->street_address, $item->city, $item->state, $item->postal_code);
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }

    public function importItems () {
        $data = array();
        $itemData = array();

        if ($this->input->post('importSubmit')) {
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');

            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;

                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->load->library('CSVReader');

                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                            $rowCount++;

                            $itemData = array(
                                'company_id' => logged('company_id'),
                                'customer_type' => $row['Customer Type'],
                                'company_name' => $row['Company Name'],
                                'contact_name' => $row['Contact Name'],
                                'contact_email' => $row['Contact Email'],
                                'mobile' => $row['Mobile'],
                                'phone' => $row['Phone'],
                                'birthday' => $row['Birthday'],
                                'suite_unit' => $row['Suite Unit'],
                                'street_address' => $row['Street Address'],
                                'city' => $row['City'],
                                'state' => $row['State'],
                                'postal_code' => $row['Postal Code']
                            );

                            $con = array(
                                'where' => array(
                                    'contact_name' => $row['Contact Name']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->customer_model->getRows($con);

                            if ($prevCount > 0) {
                                $condition = array('contact_name' => $row['Contact Name']);
                                $update = $this->customer_model->update($itemData, $condition);

                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                $insert = $this->customer_model->insert($itemData);

                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }

                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Customer imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);

                        $this->activity_model->add($successMsg);
                        $this->session->set_flashdata('alert-type', 'success');
                        $this->session->set_flashdata('alert', $successMsg);
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            } else {
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('customer');
    }

        /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
}


/* End of file Customer.php */


/* Location: ./application/controllers/Customer.php */

