<?php

class InvoiceCustomer
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;

        $sub_method = $this->app->uri->segment(3);
        $id = $this->app->uri->segment(4); // parameters

        $app->load->model('Customer_model', 'customer_model');

        if (!empty($sub_method)) {

            switch ($sub_method) {

                case 'add':
                    $this->add();
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

                case 'json_list':
                    $this->index($id);
                    break;
            }

            return;
        }


        $this->app->page_data['customer'] = $this->app->customer_model->getAll();
        $this->app->load->view('invoice/customer/list', $this->app->page_data);
    }


    private function index($type = '')
    {
        $customer = $this->app->customer_model->getAll();
//        print_r($customerSources); die;

        die(json_encode($customer));
    }


    private function add()
    {
        $this->app->load->view('invoice/customer/add', $this->app->page_data);
    }


    private function edit($id)
    {
        $this->app->page_data['customer'] = $this->app->customer_model->getById($id);
        $this->app->load->view('invoice/customer/edit', $this->app->page_data);
    }


    private function save($type = '')
    {
        $post = $this->app->input->post();

        $company_id = logged('company_id');

        if (empty($post['id'])) {

            $job_type_id = $this->app->customer_model->create([

                'user_id' => getLoggedUserID(),
                'company_id' => $company_id,
                'title' => $post['title']
            ]);
        } else {

            $job_type_id = $this->app->customer_model->update($post['id'], [

                'title' => $post['title']
            ]);
        }

        if (!empty($type)) {

            if ($type === 'json') {

                die(
                json_encode(
                    array(
                        'status' => 200,
                        'source_id' => $job_type_id,
                        'title' => $post['title']
                    )
                )
                );
            }
        }

        $this->app->session->set_flashdata('alert-type', 'success');
        $this->app->session->set_flashdata('alert', 'New Customer Created Successfully');

        redirect('invoice/customer/');
        exit();

    }


    private function remove($id)
    {
        if ($this->app->customerSource_model->delete($id)) {

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