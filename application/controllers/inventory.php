<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->page_data['page']->title = 'Inventory Management';
        $this->page_data['page']->menu = 'items';
        $this->load->model('Items_model', 'items_model');

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'assets/frontend/css/invoice/main.css',
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/inventory/main.js',
        ));
    }

    public function index()
    {
        $get = $this->input->get();
        $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('company_id');
        $this->page_data['active_category'] = "Show All";
        $type = $this->page_data['type']  = (!empty($get['type'])) ? $get['type'] : "product";


        if (!empty($get['category'])) {
            $this->page_data['category'] = $get['category'];
            $this->page_data['active_category'] = $get['category'];
            $this->page_data['items'] = $this->items_model->filterBy(['category' => $get['category']], $comp_id, $type);
        } else {
            $this->page_data['items'] = $this->items_model->getByWhere(['company_id' => $comp_id, 'type' => $type]);
        }
        
        $comp = array(
            'company_id' => $comp_id
        );
        $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, $comp)->result();
        $this->load->view('inventory/list', $this->page_data);
    }
  
    public function saveItemsCategories()
    {
        postAllowed();
        $comp_id = logged('company_id');
        $data = array(
            'company_id' => $comp_id,
            'name' => $this->input->post('groupName'),
            'description' => $this->input->post('descriptionItemCat'),
            'parent_id' => $comp_id
        );
        $this->db->insert($this->items_model->table_categories, $data);

        $this->activity_model->add("New item Categories #$categories Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New item Created Successfully');

        redirect('job');
    }

    public function saveItems()
    {
        postAllowed();
        $comp_id = logged('company_id');
        $permission = $this->items_model->create([
            'company_id' => $comp_id,
            'title' => $this->input->post('item_name'),
            'type' => $this->input->post('item_type'),
            'model' => $this->input->post('model_number'),
            'COGS' => $this->input->post('cost_of_goods'),
            'price' => $this->input->post('cost'),
            'brand' => $this->input->post('brand'),
            'cost_per' => $this->input->post('cost_per'),
            'description' => $this->input->post('description'),
            'url' => $this->input->post('product_url'),
            'notes' => '',
            'item_categories_id' => $this->input->post('item_category'),
            'is_active' => 1,
            'vendor_id' => $this->input->post('vendor'),
            'units' => $this->input->post('unit'),

        ]);

        $this->activity_model->add("New item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New item Created Successfully');
        
        redirect('inventory');
    }

    public function saveServiceItems() 
    {
        postAllowed();

        $comp_id = logged('company_id');
        $permission = $this->items_model->create([
            'company_id' => $comp_id,
            'title' => $this->input->post('service_name'),
            'type' => $this->input->post('service_item_type'),
            'price' => $this->input->post('service_cost'),
            'description' => $this->input->post('service_description'),
            'frequency' => $this->input->post('service_frequency'),
            'is_active' => 1
        ]);

        $this->activity_model->add("New item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New item Created Successfully');
        
        redirect('inventory?type=service');
    }
    
    public function saveFeeItems()
    {
        postAllowed();

        $comp_id = logged('company_id');
        $permission = $this->items_model->create([
            'company_id' => $comp_id,
            'title' => $this->input->post('fee_name'),
            'type' => $this->input->post('fee_item_type'),
            'price' => $this->input->post('fee_cost'),
            'description' => $this->input->post('fee_desc'),
            'frequency' => $this->input->post('fee_frequency'),
            'is_active' => 1
        ]);

        $this->activity_model->add("New item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New item Created Successfully');
        
        redirect('inventory?type=fees');
    }
}



/* End of file items.php */

/* Location: ./application/controllers/items.php */
