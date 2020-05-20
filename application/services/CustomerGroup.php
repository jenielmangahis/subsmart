<?php

class CustomerGroup
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;

        $sub_method = $this->app->uri->segment(3);
        $id = $this->app->uri->segment(4); // parameters
        $this->app->page_data['custom_errors'] = [];
        $this->app->page_data['old_data'] = [];
        $app->load->model('CustomerGroup_model', 'customerGroup_model');

        if (!empty($sub_method)) {

            switch ($sub_method) {

                case 'add':
                    $this->add();
                    break;

                case 'save':
                    $this->save();
                    break;
                
                case 'save_json':
                    $this->save_json();
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
        $this->app->page_data['old_data'] = $post;
        $comp_id = logged('company_id');


        $this->app->db->select('*');
        $this->app->db->from('customer_groups');
        $this->app->db->where('title', $post['title']);
        
        if(!empty($post['id'])) {
            $this->app->db->where_not_in('id', $post['id']);
        }



        $query = $this->app->db->get();
    

        if ($post['title'] != '' && $post['description'] != '' && $query->num_rows() == 0)
        {   
            if (isset($post['id']) && $post['id'] > 0) {

                $job_type_id = $this->app->customerGroup_model->update($post['id'], [

                    'title' => $post['title'],
                    'description' => $post['description']
                ]);
                $this->app->session->set_flashdata('alert', 'New Customer Group Updated Successfully');
            } else {

                $job_type_id = $this->app->customerGroup_model->create([

                    'user_id' => getLoggedUserID(),
                    'company_id' => $comp_id,
                    'title' => $post['title'],
                    'description' => $post['description']
                ]);
                $this->app->session->set_flashdata('alert', 'New Customer Group Created Successfully');
            }

            $this->app->session->set_flashdata('alert-type', 'success');
            

            redirect('customer/group/');
            
        }
        else {
            
            if ($post['title'] == '')
            {
                $this->app->page_data['custom_errors']['title'] = "Title Field is required.";
            }

            if ($query->num_rows() != 0)
            {
                $this->app->page_data['custom_errors']['title'] = "Title already exists.";
            }
            

            if ($post['description'] == '')
            {
                $this->app->page_data['custom_errors']['description'] = "Description Field is required.";
            }

           $this->app->load->view('customer/group/add', $this->app->page_data);
        }
    }


    private function save_json()
    {
        $post = $this->app->input->post();
        $this->app->page_data['old_data'] = $post;
        $comp_id = logged('company_id');


        $this->app->db->select('*');
        $this->app->db->from('customer_groups');
        $this->app->db->where('title', $post['title']);
        
        if(!empty($post['id'])) {
            $this->app->db->where_not_in('id', $post['id']);
        }



        $query = $this->app->db->get();
    

        if ($post['title'] != '' && $query->num_rows() == 0)
        {   
            if (isset($post['id']) && $post['id'] > 0) {

                $job_type_id = $this->app->customerGroup_model->update($post['id'], [

                    'title' => $post['title'],
                    'description' => 'sdf'
                ]);

                die(json_encode(array('status' => 'success','group_id' => $job_type_id,'title' => $post['title'])));
                $this->app->session->set_flashdata('alert', 'New Customer Group Updated Successfully');
            } else {

                $job_type_id = $this->app->customerGroup_model->create([

                    'user_id' => getLoggedUserID(),
                    'company_id' => $comp_id,
                    'title' => $post['title'],
                    'description' => $post['description']
                ]);

                die(json_encode(array('status' => 'success','group_id' => $job_type_id,'title' => $post['title'])));
                $this->app->session->set_flashdata('alert', 'New Customer Group Created Successfully');
            }

            $this->app->session->set_flashdata('alert-type', 'success');
        }
        else {
            
            if ($post['title'] == '')
            {
                $this->app->page_data['custom_errors']['title'] = "Title Field is required.";
            }

            if ($query->num_rows() != 0)
            {
                $this->app->page_data['custom_errors']['title'] = "Title already exists.";
            }

            die(json_encode(array('status' => 'fail', 'errors' => $this->app->page_data['custom_errors'] ,'title' => $post['title'])));
        }
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