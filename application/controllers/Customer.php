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


        $this->checkLogin();


        $this->load->library('session');


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
        ));


        // JS to add only Customer module

        add_footer_js(array(

            'assets/frontend/js/creditcard.js',

            'assets/frontend/js/customer/add.js',

            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',

            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',

            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',

            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',

            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
        ));

    }


    public function index($status_index = 0)
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

        $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'New Customer Created Successfully');


        // clear sessions

        $this->session->unset_userdata('uid');

        $this->session->unset_userdata('customer_id');


        die(json_encode(

            array(

                'url' => base_url('customer')

            )

        ));

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

        $this->page_data['groups'] = get_customer_groups();


        $this->load->view('customer/add', $this->page_data);

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
}


/* End of file Customer.php */


/* Location: ./application/controllers/Customer.php */

