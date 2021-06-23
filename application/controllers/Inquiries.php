<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/services/CustomerSource.php';

class Inquiries extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'My Customers';
        $this->page_data['page']->menu = 'customers';
        $this->load->model('Inquiry_model', 'inquiry_model');

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
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'assets/frontend/css/invoice/main.css',
            'assets/frontend/css/leads/main.css'
        ));

        // JS to add only Customer module
        add_footer_js(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'https://cdn.jsdelivr.net/npm/spectrum-colorpicker2@2.0.0/dist/spectrum.min.js',
            'assets/frontend/js/creditcard.js',
            'assets/frontend/js/inquiry/add.js',
            'assets/frontend/js/inquiry/lead.js',
            'assets/js/invoice.js'
        ));

    }
	
	public function index($status_index = 0)
    {
        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $company_id = logged('company_id');

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('status' => $status_index), $company_id);
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('search' => get('search')), $company_id);
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id);
                    } else {
                        // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('type' => get('type')), $company_id);
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id);
                    } else {
//                        $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('type' => get('type')), $company_id);
                        // $this->page_data['inquiries'] = $this->inquiry_model->getAllByCompany($company_id);
                    }

//                    $this->page_data['inquiries'] = $this->inquiry_model->getAllByCompany($company_id);
                }
            }

            // $this->page_data['statusCount'] = $this->inquiry_model->getStatusWithCount($company_id);

        }

        if ($role == 4) {

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('status' => $status_index));
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('search' => get('search')));
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')));
                    } else {
                        // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('type' => get('type')));
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        // $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')));
                    } else {
//                        $this->page_data['inquiries'] = $this->inquiry_model->filterBy(array('type' => get('type')));
                        // $this->page_data['inquiries'] = $this->inquiry_model->getAllByUserId();
                    }

//                    $this->page_data['inquiries'] = $this->inquiry_model->getAllByUserId();
                }
            }

            // $this->page_data['statusCount'] = $this->inquiry_model->getStatusWithCount();
        }

//        print_r($this->page_data['statusCount']); die;
        $this->load->view('inquiry/inquiries', $this->page_data);
    }

    public function online_lead() {
        $this->hasAccessModule(68);
        $company_id = logged('company_id');
        $this->page_data['lead_forms'] = $this->inquiry_model->getAllLeadFormByCompany($company_id);
        $this->page_data['customize_lead_forms'] = $this->inquiry_model->getAllCustomizeLeadFormByCompany($company_id, 'lead_form');
        $this->page_data['customize_lead_forms_default'] = $this->inquiry_model->getAllCustomizeLeadFormByDefault();
        $this->load->view('inquiry/online_lead', $this->page_data);
    }

    public function video_estimate() {
        $this->hasAccessModule(76); 
        $this->load->view('inquiry/video_estimate', $this->page_data);
    }

	public function add()
    {
        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) { // ****** if user is company ******//
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }
        //
        $company_id = logged('company_id');
        $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
		
        $this->load->view('inquiry/add', $this->page_data);
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

        $this->page_data['inquiry'] = $this->inquiry_model->getByWhere(['company_id' => $company_id]);

        $this->page_data['inquiry'] = $this->inquiry_model->getById($id);

        $this->page_data['inquiry']->service_address = unserialize($this->page_data['inquiry']->service_address);

        $this->page_data['inquiry']->additional_contacts = unserialize($this->page_data['inquiry']->additional_contacts);

        $this->page_data['inquiry']->additional_info = unserialize($this->page_data['inquiry']->additional_info);

        $this->page_data['inquiry']->card_info = unserialize($this->page_data['inquiry']->card_info);

        if (is_serialized($this->page_data['inquiry']->phone)) {
            $this->page_data['inquiry']->phone = unserialize($this->page_data['inquiry']->phone)['number'];
        }

        $this->load->model('Source_model', 'source_model');

        $this->page_data['inquiry']->source = $this->source_model->getSource($this->page_data['inquiry']->source_id);


        $this->load->view('inquiry/edit', $this->page_data);

    }


    public function save()
    {
        $user = (object)$this->session->userdata('logged');

        $company_id = logged('company_id');


//         echo '<pre>'; print_r($this->input->post()); die;


        $data = array(
            'inquiry_type' => post('inquiry_type'),
            'contact_name' => post('contact_name'),
            'contact_email' => post('contact_email'),
            'phone' => post('contact_phone'),
            'notification_method' => post('notify_by'),
            'street_address' => post('street_address'),
            'suite_unit' => post('suite_unit'),
            'city	' => post('city'),
            'postal_code' => post('zip'),
            'state' => post('state'),
            'source_id' => post('inquiry_source_id'),
            'comments' => post('notes'),
            'user_id' => $user->id,
            'company_id' => $company_id
        );


        // previously generated inquiry id

        // this id will be present on session if addition contact or service address has been added

        $cid = $this->session->userdata('inquiry_id');


        // if no addition contact or service address has been added

        // create() will be called insted of update()

        if (!empty($cid)) {


            $id = $this->inquiry_model->update($cid, $data);

        } else {


            $id = $this->inquiry_model->create($data);

        }


        $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'New inquiry Created Successfully');


        // clear sessions

        $this->session->unset_userdata('uid');

        $this->session->unset_userdata('inquiry_id');


        die(json_encode(

            array(

                'url' => base_url('inquiries')

            )

        ));

    }


    public function update($id)

    {

        $user = (object)$this->session->userdata('logged');

        $company_id = logged('company_id');


        // echo '<pre>'; print_r($this->input->post()); die;


        $data = array(


            'inquiry_type' => post('inquiry_type'),

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

            'source_id' => post('inquiry_source_id'),

            'comments' => post('notes'),

            'user_id' => $user->id,

            'additional_info' => (!empty(post('additional'))) ? serialize(post('additional')) : NULL,

            'card_info' => (!empty(post('card'))) ? serialize(post('card')) : NULL,

            'company_id' => $company_id
        );


        $id = $this->inquiry_model->update($id, $data);


        $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Inquiry has been Updated Successfully');


        die(json_encode(

            array(

                'url' => base_url('inquiry')

            )

        ));

    }


    public function service_address_form()

    {


        $get = $this->input->get();


        if (!empty($get)) {


            $this->page_data['action'] = $get['action'];

            $this->page_data['data_index'] = $get['index'];

            $this->page_data['inquiry'] = $this->inquiry_model->getInquiry($get['inquiry_id']);

            $this->page_data['service_address'] = $this->inquiry_model->getServiceAddress(array('id' => $get['inquiry_id']), $get['index']);

            // print_r($this->page_data['service_address']); die;

        }

    }


    public function save_service_address()

    {


        $post = $this->input->post();


        // save service address to db

        if (!empty($post['inquiry_id'])) {

            $cid = $post['inquiry_id'];

        } else {

            $cid = $this->session->userdata('inquiry_id');

        }


        if (empty($cid))

            $inquiry_id = $this->inquiry_model->saveServiceAddress($post);

        else {

            $this->inquiry_model->saveServiceAddress($post, $cid);

        }


        if (empty($cid)) {

            $this->session->set_userdata(['inquiry_id' => $inquiry_id]);

        } else {

            $inquiry_id = $cid;

        }


        die(json_encode(

            array(

                'inquiry_id' => $inquiry_id

            )

        ));

    }


    public function json_get_address_services()

    {


        $get = $this->input->get();


        if (!empty($get['inquiry_id'])) {

            $cid = $get['inquiry_id'];

        } else {

            $cid = $this->session->userdata('inquiry_id');

        }


        if (!empty($cid)) {


            $this->page_data['inquiry_id'] = $cid;

            $this->page_data['serviceAddresses'] = $this->inquiry_model->getServiceAddress(array('id' => $cid));

            // echo '<pre>'; print_r($serviceAddresses); die;

        }


        die($this->load->view('inquiry/service_address_list', $this->page_data, true));

    }


    public function json_get_additional_contacts()

    {

        $get = $this->input->get();


        if (!empty($get['inquiry_id'])) {

            $cid = $get['inquiry_id'];

        } else {

            $cid = $this->session->userdata('inquiry_id');

        }


        if (!empty($cid)) {


            $this->page_data['inquiry_id'] = $cid;

            $this->page_data['additionalContacts'] = $this->inquiry_model->getAdditionalContacts(array('id' => $cid));

            // echo '<pre>'; print_r($serviceAddresses); die;

        }


        die($this->load->view('inquiry/additional_contact_list', $this->page_data, true));

    }


    public function save_additional_contact()

    {


        $post = $this->input->post();


        // clear sessions

        // $this->session->unset_userdata('uid');

        // $this->session->unset_userdata('inquiry_id');


        // save service address to db

        if (!empty($post['inquiry_id'])) {

            $cid = $post['inquiry_id'];

        } else {

            $cid = $this->session->userdata('inquiry_id');

        }


        if (empty($cid))

            $inquiry_id = $this->inquiry_model->saveAdditionalContact($post);

        else {

            $this->inquiry_model->saveAdditionalContact($post, $cid);

        }


        if (empty($cid)) {

            $this->session->set_userdata(['inquiry_id' => $inquiry_id]);

        } else {

            $inquiry_id = $cid;

        }


        die(json_encode(

            array(

                'inquiry_id' => $inquiry_id

            )

        ));

    }


    public function remove_additional_contact()

    {


        $post = $this->input->post();


        if ($this->inquiry_model->removeAdditionalContact($post['inquiry_id'], $post['index'])) {


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


    public function json_dropdown_inquiry_list()
    {


        $get = $this->input->get();

        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $company_id = logged('company_id');

            $this->page_data['inquiries'] = $this->inquiry_model->getAllByCompany($company_id, $get);

        }

        if ($role == 4) {

            $this->page_data['inquiries'] = $this->inquiry_model->getAllByUserId('', '', 0, 0, $get);

        }


        die(json_encode($this->page_data['inquiries']));

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


        $id = $this->inquiry_model->delete($id);


        $this->activity_model->add("inquiry #$id Deleted by User:" . logged('name'));


        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'inquiry has been Deleted Successfully');


        redirect('inquiries');
    }

        /**
     *
     */
    public function source()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerSource = new CustomerSource($this);
    }

    public function save_online_lead_form()
    {
        $user = (object)$this->session->userdata('logged');

        $company_id = logged('company_id');

        $data = array(
            'type' => post('type'),
            'company_id' => $company_id,
            'iframe_code' => post('iframe_code'),
            'javascript_code' => post('javascript_code'),
            'contact_page_url' => post('contact_page_url'),
            'text_color' => post('text_color'),
            'text_size' => post('text_size'),
            'text_font' => post('text_font'),
            'button_color' => post('button_color'),
            'button_text_color' => post('button_text_color'),
            'app_notification' => post('app_notification'),
            'email_notification' => post('email_notification'),
            'google_analytics_tracking_id' => post('google_analytics_tracking_id'),
            'google_analytics_origin' => post('google_analytics_origin')
        );

        $dataField = array(
            'company_id' => $company_id,
            'field' => '',
            'visible' => 1,
            'required' => 1,
            'type' => post('type')
        );

        $cid = post('ol_id');


        if (!empty($cid)) {
            $id = $this->inquiry_model->table_2->update($cid, $data);
        } else {
            $this->db->insert($this->inquiry_model->table_2, $data);
        }


        $this->activity_model->add("Added Online Lead form");

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Added Online Lead form');

        redirect('online_leads');
    }
}

/* End of file Inquiries.php */
/* Location: ./application/controllers/Inquiries.php */
