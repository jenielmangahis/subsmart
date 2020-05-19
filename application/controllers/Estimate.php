<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Estimate extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'My Estimates';
        $this->page_data['page']->menu = 'estimates';
        $this->load->model('Estimate_model', 'estimate_model');

        $this->checkLogin();

        $user_id = getLoggedUserID();

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css'
        ));

        add_footer_js(array(
            'assets/frontend/js/estimate/estimate.js',
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js'
        ));
    }

    public function index($tab = '')
    {
        $role = logged('role');
        if ($role == 2 || $role == 3) {
            $comp_id = logged('comp_id');

            if (!empty($tab)) {
                $this->page_data['tab'] = $tab;
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => $tab), $comp_id);
            } else {

                // search
                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->estimate_model->filterBy(array('search' => get('search')), $comp_id);
                } elseif (!empty(get('order'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->estimate_model->filterBy(array('order' => get('order')), $comp_id);

                } else {
                    $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($comp_id);
                }
            }

            $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount($comp_id);
        }

        if ($role == 4) {

            if (!empty($tab)) {

                $this->page_data['tab'] = $tab;
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => $tab));


            } elseif (!empty(get('order'))) {

                $this->page_data['order'] = get('order');
                $this->page_data['estimates'] = $this->workorder_model->filterBy(array('order' => get('order')), $comp_id);

            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->workorder_model->filterBy(array('search' => get('search')), $comp_id);
                } else {
                    $this->page_data['estimates'] = $this->estimate_model->getAllByUserId();
                }
            }

            $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount();
        }

        $this->load->view('estimate/list', $this->page_data);
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

        $comp_id = logged('comp_id');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['comp_id'=>$comp_id]);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['comp_id' => $comp_id]);

        $this->load->view('estimate/add', $this->page_data);

    }


    public function save()
    {

        postAllowed();

        // echo '<pre>'; print_r($this->input->post()); die;

        $user = (object)$this->session->userdata('logged');

        if (count(post('item')) > 0) {

            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            foreach (post('item') as $key => $val) {

                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $estimate_items = serialize($itemArray);
        } else {

            $estimate_items = '';
        }

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        //echo '<pre>';print_r($data);die;

        $comp_id = logged('comp_id');

        $id = $this->estimate_model->create([

            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'estimate_date' => date('Y-m-d', strtotime(post('estimate_date'))),
            'expiry_date' => date('Y-m-d', strtotime(post('expiry_date'))),
            'purchase_order_number' => post('purchase_order_number'),
            'plan_id' => post('plan_id'),
            'estimate_items' => $estimate_items,
            'estimate_eqpt_cost' => serialize($eqpt_cost),
            'deposit_request' => post('deposit_request'),
            'customer_message' => post('customer_message'),
            'terms_conditions' => post('terms_conditions'),
            'instructions' => post('instructions'),
        ]);

        $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Estimate Created Successfully');

        redirect('estimate');

    }


    public function edit($id)
    {
        $comp_id = logged('comp_id');
        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }


        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['comp_id' => $comp_id]);
        $this->load->view('estimate/edit', $this->page_data);
    }


    public function update($id)
    {

        postAllowed();

        // echo '<pre>'; print_r($this->input->post()); die;

        $user = (object)$this->session->userdata('logged');

        if (count(post('item')) > 0) {

            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            foreach (post('item') as $key => $val) {

                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $estimate_items = serialize($itemArray);
        } else {

            $estimate_items = '';
        }

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        //echo '<pre>';print_r($data);die;

        $comp_id = logged('comp_id');

        $id = $this->estimate_model->update($id, [

            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'estimate_date' => date('Y-m-d', strtotime(post('estimate_date'))),
            'expiry_date' => date('Y-m-d', strtotime(post('expiry_date'))),
            'purchase_order_number' => post('purchase_order_number'),
            'plan_id' => post('plan_id'),
            'estimate_items' => $estimate_items,
            'estimate_eqpt_cost' => serialize($eqpt_cost),
            'deposit_request' => post('deposit_request'),
            'customer_message' => post('customer_message'),
            'terms_conditions' => post('terms_conditions'),
            'instructions' => post('instructions'),
        ]);

        $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Estimate has been Updated Successfully');

        redirect('estimate');
    }


    public function tab($index)
    {

        $this->index($index);
    }
}