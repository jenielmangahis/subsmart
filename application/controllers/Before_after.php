<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Before_after extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'Before/After';
        $this->page_data['page']->menu = 'before-after';
        $this->load->model('Before_after_model', 'before_after_model');


        add_css(array( 
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'assets/frontend/css/workorder/main.css',
            'assets/css/beforeafter.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/beforeafter/main.js'
        ));
    }

    public function index() {
        $get = $this->input->get();

        $this->page_data['items'] = logged('company_id');
        $comp_id = logged('company_id');

        $comp = array(
            'company_id' => $comp_id
        );

        if (!empty($get['search'])) {
            $this->page_data['search'] = $get['search'];
            $this->page_data['jobs'] = $this->jobs_model->filterBy(['search' => $get['search']], $comp_id);
        }

        $this->load->view('before_after/main', $this->page_data);
    }

    public function addPhoto() {
       $comp_id = logged('company_id');
       $group_num_query = $this->db->order_by("id", "desc")->get_where($this->before_after_model->table, $comp_id)->row();
       $this->page_data['group_number'] = 1;
       if ($group_num_query) {
           $this->page_data['group_number'] = intval($this->db->order_by("id", "desc")->get_where($this->before_after_model->table, array('company_id' => $comp_id))->row()->group_number) + 1;
       }
       $this->load->view('before_after/add_photo', $this->page_data); 
    }

    public function saveBeforeAfter() {
        postAllowed();
        $this->uploadBeforeAfter($this->input->post('customer_id'), $this->input->post('group_number'));

        $this->activity_model->add("New Before/After Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Before/After Created Successfully');
        
        redirect('vault/beforeafter');
    }

    public function updateBeforeAfter() {
        postAllowed();
        $this->uploadBeforeAfter($this->input->post('customer_id'), $this->input->post('group_number'));

        $this->activity_model->add("Before/After Updated by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Before/After Updated Successfully');
        
        redirect('vault/beforeafter');
    }

    public function uploadBeforeAfter($customer_id, $group_number) {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'max_height' => "768",
            'max_width' => "1024"
        );
        $this->load->library('upload', $config);

        $comp_id = logged('company_id');
        $uploadFields = array("b1_img","a1_img","b2_img","a2_img","b3_img","a3_img","b4_img","a4_img","b5_img","a5_img");
        
        for($i=1;$i<6;$i++) {
            $b_image = "";
            $a_image = "";

            if($this->upload->do_upload("b".$i."_img")) {
                $draftlogo = array('upload_data' => $this->upload->data());
                $b_image = $draftlogo['upload_data']['file_name'];
            }

            if($this->upload->do_upload("a".$i."_img")) {
                $draftlogo = array('upload_data' => $this->upload->data());
                $a_image = $draftlogo['upload_data']['file_name'];
            }

            if ($b_image != "") {
                $data = array(
                    'company_id' => $comp_id,
                    'customer_id' => ($customer_id) ? $customer_id : 0,
                    'before_image' => $b_image,
                    'after_image' => $a_image,
                    'group_number' => $group_number,
                    "note" => ""
                );

                $this->db->insert($this->before_after_model->table, $data);
            }
        }
    }

    public function edit($id) {
        $comp_id = logged('company_id');
        $this->page_data['group_number'] = $id;

		$this->page_data['photos'] = $this->before_after_model->getByWhere(['company_id' => $comp_id, 'group_number' => $id]);
		$this->load->view('before_after/add_photo', $this->page_data);

    }

    public function delete($id) {
        $this->before_after_model->deleteBeforeAfter($id);

        redirect('vault/beforeafter');
    }
}

/* End of file Job.php */

/* Location: ./application/controllers/job.php */