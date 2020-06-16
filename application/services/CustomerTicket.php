<?php

class CustomerTicket
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;

        $sub_method = $this->app->uri->segment(3);
        $id = $this->app->uri->segment(4); // parameters

        // $app->load->model('CustomerTicket_model', 'customerTicket_model');

        if (!empty($sub_method)) {

            switch ($sub_method) {

                case 'add':
                    $this->add($id);
                    break;

                case 'save':
                    $this->save();
                    break;

                case 'edit':
                    $this->edit($id);
                    break;

                case 'delete':
                    $this->remove($id);
                    break;

                default:
                    $this->index();
            }
        } else {

            $this->index();
        }
    }

    /**
     *
     */
    private function index()
    {
        // $this->app->page_data['customerTickets'] = $this->app->customerTicket_model->getAll();
        $this->app->page_data['customerTickets'] = array();
        $this->app->load->view('customer/ticket/list', $this->app->page_data);
    }


    /**
     *
     */
    private function add()
    {
        $get = $this->app->input->get();
        $this->app->page_data['params'] = $get;

        $this->app->load->model('Plans_model', 'plan_model');
        $company_id = logged('company_id');
        $this->app->page_data['plans'] = $this->app->plans_model->getByWhere(['company_id' => $company_id]);

        // auto generate ticket number
        $this->app->page_data['ticket_number'] = "TKT-" . time();

        // if customer request to add ticket, fetch the customer details
        if (!empty($get['customer_id'])) {
            $customer = get_customer_by_id($get['customer_id']);
            $this->app->page_data['customer'] = serialize_to_array($customer);
        }

        // user company
        $company_id = logged('company_id');
        $company = get_company_by_id($company_id);

        if ( !empty($company) ) {
            $this->app->page_data['company_name'] = $company->b_name;
        }

        // equipments
        $this->app->load->model('Equipment_model', 'equipment_model');
        $this->app->page_data['equipments'] = $this->app->equipment_model->getByWhere(['user_id' => logged('id')]);

        $this->app->load->view('customer/ticket/add', $this->app->page_data);
    }


    /**
     * @param $id
     */
    private function edit($id)
    {
        $this->app->page_data['customerTicket'] = $this->app->customerTicket_model->getById($id);
        $this->app->load->view('customer/ticket/edit', $this->app->page_data);
    }


    /**
     *
     */
    private function save()
    {
        $post = $this->app->input->post();

//        echo '<pre>';
//        print_r($post);
//        die;

        $company_id = logged('company_id');

        //
        if (is_array(post('item'))) {

            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            $itemArray = array();

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

            $additional_services = serialize($itemArray);
        } else {

            $additional_services = '';
        }

//        print_r(post('customer')); die;

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        if (empty($post['id'])) {

            $ticket_id = $this->app->customerTicket_model->create([

                'user_id' => getLoggedUserID(),
                'company_id' => $company_id,
                'customer_id' => post('customer_id'),
                'ticket_number' => post('ticket_number'),
                'tech_info' => serialize(post('tech_info')),
                'ticket_date' => date('Y-m-d', strtotime(post('ticket_date'))),
                'time_scheduled' => date('h:i:s', strtotime(post('time_scheduled'))),
                'arrival_time' => date('h:i:s', strtotime(post('arrival_time'))),
                'warranty' => post('warranty'),
                'plan_type' => post('plan_type'),
                'equipments' => $additional_services,
                'cost_info' => serialize($eqpt_cost),
                'grand_total' => $eqpt_cost['eqpt_cost'],
                'ip_cam' => serialize(post('ip_cameras')),
                'doorlocks' => serialize(post('doorlocks')),
                'dvr' => serialize(post('dvr_nvr')),
                'thermostat' => serialize(post('automation')),
                'zone_info' => serialize(post('zone_info')),
                'notes' => post('notes'),
                'payment_options' => serialize(post('payment_options')),
                'company_representative_approval' => post('company_representative_approval'),
                'primary_account_holder' => post('primary_account_holder'),
                'secondary_account_holder' => post('secondary_account_holder'),
                'company_repres_printed_name' => post('company_repres_printed_name'),
                'primary_acc_printed_name' => post('primary_acc_printed_name'),
                'secondary_acc_printed_name' => post('secondary_acc_printed_name'),
                'additional_inquires' => serialize(post('additional_inquires')),
                'office_use_only' => serialize(post('office_use_only')),
                'extended_out_date' => date('Y-m-d'),
                'post_service_summary' => serialize(post('post_service_summary'))
            ]);
        }

        $this->app->session->set_flashdata('alert-type', 'success');
        $this->app->session->set_flashdata('alert', 'New Ticket Created Successfully');

        redirect('customer');
    }


    /**
     * @param $id
     */
    private function remove($id)
    {
        if ($this->app->customerTicket_model->delete($id)) {

            die(
            json_encode(
                [
                    'status' => 200
                ]
            )
            );
        }

        die(
        json_encode(
            [
                'status' => 'error'
            ]
        )
        );
    }
}