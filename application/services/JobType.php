<?php

class JobType
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;

        $sub_method = $app->uri->segment(3);
        $id = $app->uri->segment(4); // parameters

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

        $app->load->model('JobType_model', 'jobType_model');
        $app->page_data['jobTypes'] = $app->jobType_model->getJobTypes();
        $app->load->view('workorder/job-type/list', $app->page_data);
    }


    private function add()
    {
        $this->app->load->view('workorder/job-type/add', $this->app->page_data);
    }


    private function edit($id)
    {
        $this->app->load->model('JobType_model', 'jobType_model');
        $this->app->page_data['jobType'] = $this->app->jobType_model->getById($id);
        $this->app->load->view('workorder/job-type/edit', $this->app->page_data);
    }


    private function save()
    {
        $post = $this->app->input->post();

        $company_id = logged('company_id');

        $this->app->load->model('JobType_model', 'jobType_model');

        if (empty($post['id'])) {

            $job_type_id = $this->app->jobType_model->create([

                'user_id' => getLoggedUserID(),
                'company_id' => $company_id,
                'title' => $post['title']
            ]);
        } else {

            $job_type_id = $this->app->jobType_model->update($post['id'], [

                'title' => $post['title']
            ]);
        }

        $this->app->session->set_flashdata('alert-type', 'success');
        $this->app->session->set_flashdata('alert', 'New Job Type Created Successfully');

        redirect('workorder/job_type/');
    }


    private function remove($id)
    {
        $this->app->load->model('JobType_model', 'jobType_model');

        if ($this->app->jobType_model->delete($id)) {

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