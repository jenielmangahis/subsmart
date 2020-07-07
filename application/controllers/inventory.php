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
        $this->load->library('form_validation');
        $this->load->helper('file');

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
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
            $this->page_data['items'] = $this->items_model->filterBy(['category' => $get['category']], $comp_id, ucfirst($type));
        } else {
            $this->page_data['items'] = $this->items_model->getByWhere(['company_id' => $comp_id, 'type' => ucfirst($type)]);
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
            'type' => ucfirst($this->input->post('item_type')),
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

    public function exportItems()
    {
        $items = $this->items_model->getByCompanyId(logged('company_id'));
        $delimiter = ",";
        $filename = getLoggedName()."_items.csv";

        $f = fopen('php://memory', 'w');
  
        $fields = array('Name', 'Price', 'Discount', 'Description', 'Customer Group', 'Item Vendor', 'Item Type', 'Item Cost', 'Link/Url', 'Notes');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {       
            foreach ($items as $item) {
                $csvData = array($item->title, '$'.number_format($item->price,2,".",","), '', $item->description, '', '', $item->type, 0, '', '');
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }

    public function importItems () {
        $data = array();
        $itemData = array();
        
        if ($this->input->post('importSubmit')) {
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->load->library('CSVReader');
                    
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    if (!empty($csvData)) {
                        foreach ($csvData as $row) { 
                            $rowCount++;
                            
                            $price = explode("$",$row['Price']);

                            $itemData = array(
                                'company_id' => logged('company_id'),
                                'title' => $row['Name'],
                                'price' => intval($price[1]),
                                'COGS' => intval($price[1]),
                                'description' => $row['Description'],
                                'type' => $row['Item Type'],
                                'is_active' => 1
                            );
                            
                            $con = array(
                                'where' => array(
                                    'title' => $row['Name']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->items_model->getRows($con);
                            
                            if ($prevCount > 0) {
                                $condition = array('title' => $row['Name']);
                                $update = $this->items_model->update($itemData, $condition);
                                
                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                $insert = $this->items_model->insert($itemData);
                                
                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }
                        
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'inventory imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);

                        $this->activity_model->add($successMsg);
                        $this->session->set_flashdata('alert-type', 'success');
                        $this->session->set_flashdata('alert', $successMsg);
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            } else {
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('inventory');
    }
    
    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
}



/* End of file items.php */

/* Location: ./application/controllers/items.php */
