<?php

class CustomerTypes
{
    protected $app;

    public function __construct($app)
    {


        $this->app = $app;

        $sub_method = $this->app->uri->segment(3);
        $id = $this->app->uri->segment(4); // parameters

        $app->load->model('CustomerTypes_model', 'customerTypes_model');
        
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

        $role = logged('role');
        $company_id = logged('company_id');

        if( $role == 1 || $role == 2 ){
            $this->app->page_data['customerTypes'] = $this->app->customerTypes_model->getAllCustomerTypes();
        }else{
            $this->app->page_data['customerTypes'] = $this->app->customerTypes_model->getAllByCompanyId($company_id);
        }
        
        $this->app->load->view('customer/types/list', $this->app->page_data);
    }


    private function index($type = '')
    {
        $customerTypes = $this->app->customerTypes_model->getAll();

        die(json_encode($customerTypes));
    }


    private function add()
    {
        $this->app->load->view('customer/types/add', $this->app->page_data);
    }


    private function edit($id)
    {
        $this->app->page_data['customerTypes'] = $this->app->customerTypes_model->getById($id);
        $this->app->load->view('customer/types/edit', $this->app->page_data);
    }


    private function save($type = '')
    {
        $post = $this->app->input->post();

        $company_id = logged('company_id');

        if (empty($post['id'])) {

            $job_type_id = $this->app->customerTypes_model->create([
                'company_id' => $company_id,
                'title' => $post['title']
            ]);
        } else {

            $job_type_id = $this->app->customerTypes_model->update($post['id'], [

                'title' => $post['title']
            ]);
        }

        if (!empty($type)) {

            if ($type === 'json') {

                die(
                json_encode(
                    array(
                        'status' => 200,
                        'type_id' => $job_type_id,
                        'title' => $post['title']
                    )
                )
                );
            }
        }

        $this->app->session->set_flashdata('alert-type', 'success');
        $this->app->session->set_flashdata('alert', 'New Customer Type Created Successfully');

        redirect('customer/types/');
        exit();

    }


    private function remove($id)
    {
        if ($this->app->customerTypes_model->delete($id)) {

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