<?php

class Priority
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;

        $sub_method = $this->app->uri->segment(3);
        $id = $this->app->uri->segment(4); // parameters

        $app->load->model('PriorityList_model', 'priorityList_model');

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


        $this->app->page_data['priorityList'] = $this->app->priorityList_model->getAll();
        // $this->app->load->view('workorder/priority-list/list', $this->app->page_data);
        $this->app->load->view('v2/pages/workorder/priority-list/list', $this->app->page_data);
    }


    private function add()
    {
        $this->app->load->view('v2/pages/workorder/priority-list/add', $this->app->page_data);
    }


    private function edit($id)
    {
        $this->app->page_data['priority'] = $this->app->priorityList_model->getById($id);
        $this->app->load->view('workorder/priority-list/edit', $this->app->page_data);
    }


    private function save()
    {
        $post = $this->app->input->post();

        $company_id = logged('company_id');

        if (empty($post['id'])) {

            $job_type_id = $this->app->priorityList_model->create([

                'user_id' => getLoggedUserID(),
                'company_id' => $company_id,
                'title' => $post['title']
            ]);
        } else {

            $job_type_id = $this->app->priorityList_model->update($post['id'], [

                'title' => $post['title']
            ]);
        }

        $this->app->session->set_flashdata('alert-type', 'success');
        $this->app->session->set_flashdata('alert', 'New Job Type Created Successfully');

        redirect('workorder/priority/');
    }


    private function remove($id)
    {
        $this->app->load->model('JobType_model', 'jobType_model');

        if ($this->app->priorityList_model->delete($id)) {

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