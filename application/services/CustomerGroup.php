<?php

class CustomerGroup
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;

        $sub_method = $this->app->uri->segment(3);
        $id = $this->app->uri->segment(4); // parameters

        $app->load->model('CustomerGroup_model', 'customerGroup_model');

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
            }

            return;
        }


        $this->app->page_data['customerGroups'] = $this->app->customerGroup_model->getAll();
        $this->app->load->view('customer/group/list', $this->app->page_data);
    }


    private function add()
    {
        $this->app->load->view('customer/group/add', $this->app->page_data);
    }


    private function edit($id)
    {
        $this->app->page_data['customerGroup'] = $this->app->customerGroup_model->getById($id);
        $this->app->load->view('customer/group/edit', $this->app->page_data);
    }


    private function save()
    {
        $post = $this->app->input->post();

        $comp_id = logged('comp_id');

        if (empty($post['id'])) {

            $job_type_id = $this->app->customerGroup_model->create([

                'user_id' => getLoggedUserID(),
                'company_id' => $comp_id,
                'title' => $post['title']
            ]);
        } else {

            $job_type_id = $this->app->customerGroup_model->update($post['id'], [

                'title' => $post['title']
            ]);
        }

        $this->app->session->set_flashdata('alert-type', 'success');
        $this->app->session->set_flashdata('alert', 'New Customer Group Created Successfully');

        redirect('customer/group/');
    }


    private function remove($id)
    {
        if ($this->app->customerGroup_model->delete($id)) {

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