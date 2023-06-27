<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_model extends MY_Model
{
    public $table = 'jobs';
    public $table_items = 'job_items';
    public $table_job_settings = 'job_settings';
    public $table_jobs_has_address = 'jobs_has_address';
    public $table_jobs_has_customers = 'jobs_has_customers';
    public $table_jobs_has_employees = 'jobs_has_employees';
    public $table_credit_cards = 'credit_cards';
    public $table_estimates = 'estimates';
    public $table_employees = 'employees';
    public $table_customers = 'customers';
    public $table_address = 'address';
    public $table_job_payments = 'job_payments';

    //Status
    public $status_new = 'New';
    public $status_scheduled = 'Scheduled';
    public $status_started = 'Started';
    public $status_paused = 'Paused';
    public $status_invoiced = 'Invoiced';
    public $status_withdrawn = 'Withdrawn';
    public $status_closed = 'Closed';

    /**
     * @return mixed
     */
    public function get_all_jobs($userId = null, $leaderBoardType = null)
    {
        $cid=logged('company_id');
        $this->db->from($this->table);
        $this->db->select('jobs.*,LName,FName,acs_profile.first_name,acs_profile.last_name,job_tags.name,job_payments.amount,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state, acs_profile.zip_code as cust_zipcode');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id', 'left');
        $this->db->where("jobs.company_id", $cid);

        if (in_array($leaderBoardType, ['sales', 'tech'])) {
            if (is_numeric($userId)) {
                if ($leaderBoardType === 'sales') {
                    $this->db->where('jobs.employee_id', $userId);
                } else {
                    $this->db
                        ->group_start()
                        ->where('jobs.employee2_id', $userId)
                        ->or_where('jobs.employee3_id', $userId)
                        ->or_where('jobs.employee4_id', $userId)
                        ->or_where('jobs.employee5_id', $userId)
                        ->or_where('jobs.employee6_id', $userId)
                        ->group_end();
                }
            }
        }

        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function get_all_jobs_by_tag($tag_id, $userId = null, $leaderBoardType = null)
    {
        $cid=logged('company_id');
        $this->db->from($this->table);
        $this->db->select('jobs.*,LName,FName,acs_profile.first_name,acs_profile.last_name,job_tags.name,job_payments.amount,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id', 'left');
        $this->db->where("jobs.company_id", $cid);

        if (in_array($leaderBoardType, ['sales', 'tech'])) {
            if (is_numeric($userId)) {
                if ($leaderBoardType === 'sales') {
                    $this->db->where('jobs.employee_id', $userId);
                } else {
                    $this->db
                        ->group_start()
                        ->where('jobs.employee2_id', $userId)
                        ->or_where('jobs.employee3_id', $userId)
                        ->or_where('jobs.employee4_id', $userId)
                        ->or_where('jobs.employee5_id', $userId)
                        ->or_where('jobs.employee6_id', $userId)
                        ->group_end();
                }
            }
        }

        $this->db->where("jobs.tags", $tag_id);
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function admin_get_all_jobs()
    {
        $this->db->from($this->table);
        $this->db->select('jobs.*,LName,FName,acs_profile.first_name,acs_profile.last_name,job_tags.name,job_payments.amount,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state, clients.business_name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('clients', 'clients.id = jobs.company_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id', 'left');
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function get_specific_job($id)
    {
        //$cid=logged('company_id');
        $this->db->from($this->table);
        $this->db->select('jobs.*,jobs.id as job_unique_id,LName,FName,
        acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email,job_url_links.link,ja.signature_link,ja.authorize_name,ja.datetime_signed,jpd.amount as total_amount,acs_profile.customer_type,acs_profile.business_name as acs_business_name');
        // $this->db->select('jobs.*,jobs.id as job_unique_id,LName,FName,
        // acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        // acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email,
        // job_tags.name,job_url_links.link,ja.signature_link,ja.authorize_name,ja.datetime_signed,jpd.amount as total_amount');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        //$this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('job_url_links', 'job_url_links.job_id = jobs.id', 'left');        
        $this->db->join('jobs_approval as ja', 'jobs.id = ja.jobs_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->where("jobs.id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * @return mixed
     */
    public function get_specific_job_by_hash_id($hash_id)
    {
        $cid=logged('company_id');
        $this->db->from($this->table);
        $this->db->select('jobs.*,jobs.id as job_unique_id,LName,FName,
        acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email,
        job_tags.name,job_url_links.link,ja.signature_link,ja.authorize_name,ja.datetime_signed,jpd.amount as total_amount');
        // $this->db->select('jobs.*,jobs.id as job_unique_id,LName,FName,
        // acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        // acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email,
        // job_tags.name,job_url_links.link,ja.signature_link,ja.authorize_name,ja.datetime_signed,jpd.amount as total_amount');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('job_url_links', 'job_url_links.job_id = jobs.id', 'left');        
        $this->db->join('jobs_approval as ja', 'jobs.id = ja.jobs_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->where("jobs.hash_id", $hash_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_specific_job_items($id)
    {
        $this->db->select('items.id as fk_item_id, items.id, items.title, items.price, items.type, items.retail, job_items.cost, job_items.qty, job_items.commission, job_items.margin, items_has_storage_loc.name as location_name, items_has_storage_loc.id as location_id, job_items.points, job_items.tax, job_items.item_name AS job_item_name');
        $this->db->from($this->table_items);
        $this->db->where("job_items.job_id", $id);
        $this->db->join('items', 'items.id = job_items.items_id', 'left');
        $this->db->join('items_has_storage_loc', 'items_has_storage_loc.id = items.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_job_items()
    {
        $this->db->from($this->table_items);
        $this->db->select('items.id as fk_item_id,items.id,items.title,items.price,items.type,job_items.job_id,job_items.items_id,job_items.cost,job_items.qty,job_items.location,job_items.points,job_items.tax');
        $this->db->join('items', 'items.id = job_items.items_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_specific_workorder_items($id)
    {   
        $this->db->select('work_order_types.name');
        $this->db->from('work_orders');
        $this->db->join('work_order_types', 'work_order_types.id = work_orders.work_order_type_id', 'left');
        $this->db->where('work_orders.id', $id);
        $workorderTypeQuery = $this->db->get();
        $workorderType = $workorderTypeQuery->row();

        if ($workorderType && $workorderType->name == 'Repair') {
            // Repair is saving items on work_orders_agreement_products
            // which is not related on items table. So
            // we have to create a new item entry if it's item (name) doesnt exist.

            $this->db->select('*');
            $this->db->from('work_orders_agreement_products');
            $this->db->where('qty !=', '');
            // $this->db->where('price !=', '');
            $this->db->where('work_order_id', $id);
            $productsQuery = $this->db->get();
            $products = $productsQuery->result();

            $productNames = array_map(function ($product) {
                return $product->item;
            }, $products);

            if (!count($productNames)) {
                return [];
            }

            $this->load->model('Items_model', 'items_model');
            $currentCompanyId = logged('company_id');

            $this->db->select('*');
            $this->db->from('items');
            $this->db->where_in('title', $productNames);
            $this->db->where('company_id', $currentCompanyId);
            $matchedItemsQuery = $this->db->get();
            $matchedItems = $matchedItemsQuery->result();

            $items = [];
            $updatedMatchedItemIds = [];

            foreach ($productNames as $productName) {
                $currentProduct = null;
                foreach ($products as $product) {
                    if ($product->item === $productName) {
                        $currentProduct = $product;
                    }
                }

                if (is_null($currentProduct)) {
                    continue;
                }

                $currentProductMatchedItem = null;
                foreach ($matchedItems as $matchedItem) {
                    if ($matchedItem->title === $currentProduct->item) {
                        $currentProductMatchedItem = $matchedItem;

                        if (!in_array($matchedItem->id, $updatedMatchedItemIds)) {
                            $updatedMatchedItemIds[] = $matchedItem->id;

                            if (is_null($matchedItem->price)) {
                                $price = $currentProduct->price ? $currentProduct->price : 0;
                                $this->db->where('id', $matchedItem->id);
                                $this->db->update('items', ['price' => $price]);
                                $matchedItem->price = $price;
                            }
                        }
                    }
                }

                if (is_null($currentProductMatchedItem)) {
                    // product not found, create new item
                    $itemInput = [
                        'title' => $currentProduct->item,
                        'company_id' => $currentCompanyId,
                        'is_active' => true,
                        'type' => 'Product',
                        'description' => 'Auto-created from work order',
                        'price' => $currentProduct->price ? $currentProduct->price : 0,
                    ];

                    $id = $this->items_model->insert($itemInput);
                    $this->db->select('*');
                    $this->db->from('items');
                    $this->db->where('id', $id);
                    $createdItemQuery = $this->db->get();
                    $currentProductMatchedItem = $createdItemQuery->row();
                }

                if (strtolower(trim($currentProduct->item)) === 'type of install' && $currentProduct->check_data) {
                    $currentProductMatchedItem->title = "$currentProduct->item ($currentProduct->check_data)";

                    // HACK! type of install should be stored in services table
                    $currentProductMatchedItem->type = 'Service';
                }

                $currentProductMatchedItem->price = $currentProduct->price ? $currentProduct->price : 0;
                $currentProductMatchedItem->qty = $currentProduct->qty;
                $items[] = $currentProductMatchedItem;
            }

            return $items;
        }

        $this->db->from('work_orders_items');
        $this->db->select('items.id,items.title,items.price,items.type,work_orders_items.qty');
        $this->db->join('items', 'items.id = work_orders_items.items_id');
        $this->db->where("work_orders_items.work_order_id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_specific_estimate_items($id)
    {
        $this->db->from('estimates_items');
        //$this->db->select('items.id,items.title,items.price,items.type,estimates_items.qty,estimates_items.tax,estimates_items.discount');
        $this->db->select('items.id,items.title,items.price,items.type,estimates_items.qty, estimates_items.cost');
        $this->db->join('items', 'items.id = estimates_items.items_id', 'left');
        $this->db->where("estimates_items.estimates_id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_customer_job_items($id)
    {
        $this->db->from($this->table_items);
        $this->db->select('items.id,items.title,items.price,items.type,job_items.qty,job_items.location,job_items.points');
        $this->db->join('items', 'items.id = job_items.items_id', 'left');
        $this->db->join('jobs', 'jobs.id = job_items.job_id', 'left');
        $this->db->where("jobs.customer_id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getJob($comp_id)
    {
        $this->db->select('jobs.*,job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img');
        $this->db->from($this->table);
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->where('jobs.company_id', $comp_id);
        $this->db->order_by('date_updated', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getAddresses()
    {
        $this->db->select('*');
        $this->db->from('address');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function getJobType()
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('job_settings');
        $this->db->order_by('job_settings_id', 'desc');
        $this->db->where('company_id', $comp_id);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getCustomers()
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('customers.company_id', $comp_id);
        $this->db->join('users', 'users.id = customers.user_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function getItems($params)
    {
        $col = ($params != "material" && $params != "service" && $params != "Fees") ? 'item_categories_id' : 'type';
        $comp_id = logged('company_id');
        $array = array('company_id' => $comp_id, $col => $params);

        $this->db->select('*');
        $this->db->from('items');
        $this->db->where($array);
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function getJobDetails($job_num)
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('jobs');
        $this->db->where('jobs.company_id', $comp_id);
        $this->db->where('jobs.job_number', $job_num);
        $this->db->join($this->table_jobs_has_customers, 'jobs.jobs_id = jobs_has_customers.jobs_id');
        $this->db->join($this->table_jobs_has_address, 'jobs.jobs_id = jobs_has_address.jobs_id');
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * @return mixed
     */
    public function getJobInvoiceItems($job_id)
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('invoice_has_items');
        $this->db->where('invoice_has_items.job_id', $job_id);
        $this->db->join('items', 'items.id = invoice_has_items.item_id');
        $query = $this->db->get();

        return $query->result_array();
    }
    
    /**
     * @return mixed
     */
    public function updateJob($id, $data)
    {
        $this->db->where('jobs_id', $id);
        $this->db->update('jobs', $data);
    }

    /**
     * @return mixed
     */
    public function deleteJob($id)
    {
        $this->db->delete('jobs', array("jobs_id" => $id));
        $this->db->delete($this->table_jobs_has_address, array("jobs_id" => $id));
        $this->db->delete($this->table_jobs_has_customers, array("jobs_id" => $id));
    }

    /**
     * @return mixed
     */
    public function deleteJobItemsByJobId($job_id)
    {
        $this->db->delete('job_items', array("job_id" => $job_id));
    }

    /**
     * @return mixed
     */
    public function deleteJobType($id)
    {
        $this->db->delete($this->table_job_settings, array("job_settings_id" => $id));
    }

    /**
     * @return mixed
     */
    public function deleteEstimate($id)
    {
        $this->db->delete($this->table_estimates, array("id" => $id));
    }

    /**
     * @return mixed
     */
    public function updateJobItemQty($id, $value, $type)
    {
        if ($type == "add") {
            $newVal = intval($value) + 1;
        } else {
            $newVal = intval($value) - 1;
        }

        $data = array(
            "qty" => $newVal
        );

        $this->db->where('ihi_id', $id);
        $this->db->update('invoice_has_items', $data);
    }

    /**
     * @return mixed
     */
    public function getJobSettingByName($name)
    {
        $this->db->select('*');
        $this->db->from($this->table_job_settings);
        $this->db->where('value', $name);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function updateJobType($id, $data)
    {
        $this->db->where('job_settings_id', $id);
        $this->db->update($this->table_job_settings, $data);
    }

    /**
     * @return mixed
     */
    public function getEstimateByJobId($job_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_estimates);
        $this->db->where('job_id', $job_id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getEstimateNumber($jobId, $jobNum)
    {
        $this->db->select("*");
        $this->db->from($this->table_estimates);
        $this->db->where('job_id', $jobId);
        $query = $this->db->get();
        $result = $query->num_rows();

        return $jobNum . "-" . ((intval($result) > 9) ? strval(intval($result) + 1) : "0" . strval(intval($result) + 1));
    }

    public function getAssignEmp($job_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_jobs_has_employees);
        $this->db->where('jobs_id', $job_id);
        $this->db->join("employees", 'jobs_has_employees.employees_id = employees.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getAllUpcomingJobsByCompanyId($company_id = 0)
    {
        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +7 day'));

        $this->db->select('jobs.id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, job_payments.amount AS job_total_amount, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.tax_rate, jobs.priority, cust.prof_id,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.phone_m as cust_phone, cust.phone_h as cust_phone_home, cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName, users.id AS e_employee_id,ea.id AS employee2_employee_id, ea.profile_img AS employee2_img,ea.FName AS employee2_fname,ea.LName AS employee2_lname,eb.id AS employee3_employee_id,eb.profile_img AS employee3_img,eb.FName AS employee3_fname,eb.LName AS employee3_lname,ec.id AS employee4_employee_id, ec.profile_img AS employee4_img,ec.FName AS employee4_fname,ec.LName AS employee4_lname');

        $this->db->from($this->table);
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'jobs.tags = job_tags.id', 'left');
        $this->db->join('acs_profile as cust', 'jobs.customer_id = cust.prof_id', 'left');
        $this->db->join('users', 'jobs.employee_id = users.id', 'left');
        $this->db->join('users ea', 'jobs.employee2_id = ea.id', 'left');
        $this->db->join('users eb', 'jobs.employee3_id = eb.id', 'left');
        $this->db->join('users ec', 'jobs.employee4_id = ec.id', 'left');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id', 'left');
        
        $this->db->where('jobs.company_id', $company_id);
        //$this->db->where('jobs.start_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');
        $this->db->where('jobs.start_date >=', $start_date);
        $this->db->where("jobs.status", 'Scheduled');
        //$this->db->order_by('jobs.id', 'DESC');
        $this->db->order_by('jobs.start_date', 'ASC');
        //$this->db->group_by('jobs.id');
        $query = $this->db->get();
        //print_r($this->db->last_query());  exit;
        return $query->result();
    }

    public function getAllJobsByCompanyIdAndDate($company_id = 0, $date)
    {
        $date = date('Y-m-d', strtotime($date));

        $this->db->select('jobs.id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, job_payments.amount AS job_total_amount, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, cust.prof_id,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.phone_m as cust_phone, cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName, users.id AS e_employee_id,ea.id AS employee2_employee_id, ea.profile_img AS employee2_img,ea.FName AS employee2_fname,ea.LName AS employee2_lname,eb.id AS employee3_employee_id,eb.profile_img AS employee3_img,eb.FName AS employee3_fname,eb.LName AS employee3_lname,ec.id AS employee4_employee_id, ec.profile_img AS employee4_img,ec.FName AS employee4_fname,ec.LName AS employee4_lname');

        $this->db->from($this->table);
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'jobs.tags = job_tags.id', 'left');
        $this->db->join('acs_profile as cust', 'jobs.customer_id = cust.prof_id', 'left');
        $this->db->join('users', 'jobs.employee_id = users.id', 'left');
        $this->db->join('users ea', 'jobs.employee2_id = ea.id', 'left');
        $this->db->join('users eb', 'jobs.employee3_id = eb.id', 'left');
        $this->db->join('users ec', 'jobs.employee4_id = ec.id', 'left');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id', 'left');
        
        $this->db->where('jobs.company_id', $company_id);
        $this->db->where('jobs.start_date', $date);
        $this->db->order_by('jobs.start_date', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllUpcomingJobs()
    {
        $this->db->select('jobs.id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName');

        $this->db->from($this->table);
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $start_date = date('Y-m-d');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');

        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +5 day'));

        //echo $start_date . "/" . $end_date;exit;
        
        $this->db->where('jobs.start_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');
        $this->db->order_by('jobs.id', 'DESC');

        $query = $this->db->get();
        return $query->result();


//        $this->db->select('jobs.*,job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img');
//        $this->db->from($this->table);

//        $this->db->where('jobs.company_id', $comp_id);
//        $this->db->order_by('date_updated', 'DESC');
//        $this->db->limit(5);
//        $query = $this->db->get();
//        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getAllJobsByUserId($user_id, $date_range = array(), $filter = array())
    {
        $cid=logged('company_id');
        $this->db->from($this->table);
        $this->db->select('jobs.*,acs_profile.*');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->where("jobs.employee_id", $user_id);

        if (!empty($date_range)) {
            $start_date = $date_range['date_from'];
            $end_date   = $date_range['date_to'];
            $this->db->where('start_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');
        }

        if (!empty($filter)) {
            foreach ($filter as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllStatus()
    {
        $status = [
            $this->status_new => 'New',
            $this->status_scheduled => 'Scheduled',
            $this->status_started => 'Started',
            $this->status_paused => 'Paused',
            $this->status_invoiced => 'Invoiced',
            $this->status_withdrawn => 'Withdrawn',
            $this->status_closed => 'Closed'
        ];

        return $status;
    }

    public function getJobSettingsByCompanyId($company_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table_job_settings);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateJobSettingsByCompanyId($company_id, $data) {
        $this->db->where('company_id', $company_id);
        $this->db->update($this->table_job_settings, $data);
    }

    public function updateJobItemByJobIdAndItemId($job_id, $item_id, $data) {
        $this->db->where('job_id', $job_id);
        $this->db->where('items_id', $item_id);
        $this->db->update($this->table_items, $data);
    }

    public function getlastInsert($company_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $comp_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->result();
    }

    public function getLastJobNumber() {
    	$this->db->select('job_number');
        $this->db->from($this->table);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->result()[0]->job_number;
    }

    /**
     * @return mixed
     */
    public function getAllJobsByCustomerId($customer_id)
    {
        $cid=logged('company_id');
        $this->db->from($this->table);
        $this->db->select('jobs.*,LName,FName,acs_profile.first_name,acs_profile.last_name,job_tags.name,job_payments.amount,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id', 'left');
        $this->db->where("jobs.customer_id", $customer_id);
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    // START: GET INFO FROM jobs TABLE TO INSERT IN invoices TABLE
    public function GET_JOB_INFO($job_id)
    {
        $this->db->select('jobs.id, jobs.customer_id, jobs.job_location, jobs.job_type, jobs.job_number, jobs.date_issued, jobs.status, jobs.tags, jobs.signature, jobs.date_created, jobs.date_updated, jobs.company_id, job_payments.amount');
        $this->db->from($this->table);
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id', 'left');
        $this->db->where("jobs.id", $job_id);
        $this->db->order_by('jobs.id', "DESC");
        $query = $this->db->get();
        return $query->row();
    }
    // END: GET INFO FROM jobs TABLE TO INSERT IN invoices TABLE

    // START: INSERT DATA FROM jobs TABLE to invoices TABLE ON "SEND INVOICE" COMMAND.
    public function INSERT_JOB_INFO($data)
    {
        $INVOICE = $this->db->insert('invoices', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    // END: INSERT DATA FROM jobs TABLE to invoices TABLE ON "SEND INVOICE" COMMAND.

    public function get_all_company_scheduled_jobs($company_id)
    {
        $this->db->from($this->table);
        $this->db->select('jobs.*,LName,FName,acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state, acs_profile.zip_code as cust_zipcode');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');                
        $this->db->where("jobs.company_id", $company_id);
        $this->db->where("jobs.status", 'Scheduled');
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_job_payments_by_job_id($job_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_job_payments);
        $this->db->where('job_id', $job_id);
        $this->db->order_by('date_created', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_latest_job_payment_by_job_id($job_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_job_payments);
        $this->db->where("job_id", $job_id);
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->row();
    }

    public function getSelectedCustomerInfo($customerID) {
        $this->db->select("acs_office.purchase_price, acs_alarm.pass_thru_cost, acs_profile.prof_id, acs_profile.company_id, acs_profile.fk_user_id, acs_profile.business_name AS ACS_PROFILE_BUSINESS_NAME, acs_profile.fk_sa_id, acs_profile.mail_add, acs_profile.cross_street, acs_profile.city, acs_profile.state, acs_profile.zip_code, acs_profile.country, acs_profile.phone_h, acs_profile.phone_m, acs_profile.email, acs_profile.activated, acs_access.access_password, business_profile.business_name, acs_alarm.monitor_id, acs_office.equipment_cost, acs_billing.mmr, acs_billing.*");
        $this->db->from("acs_profile");
        $this->db->join('acs_access', 'acs_access.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = acs_profile.company_id', 'left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->join('acs_billing', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.prof_id', $customerID);
        $query = $this->db->get();
        return $query->result()[0];
    }

    public function recordTaxRate($type, $data = array()) {
        if ($type == "add") {
		// ===============
        	if ($data['is_default'] == 1) {
        		$removeDefault = [ 'is_default' => 0 ];
       			$this->db->where('company_id', $data['company_id']);
       			$this->db->update('tax_rates', $removeDefault);
        	}
        // ===============
            $INSERT = $this->db->insert('tax_rates', $data);
        // ===============
            return true;
        // ===============
        }

        if ($type == "update") {
        // ===============
        	if ($data['is_default'] == 1) {
        		$removeDefault = [ 'is_default' => 0 ];
       			$this->db->where('company_id', $data['company_id']);
       			$this->db->update('tax_rates', $removeDefault);
        	}
        // ===============
       		$this->db->where('id', $data['id']);
            $UPDATE = $this->db->update('tax_rates', $data);
        // ===============
            return true;
        // ===============
        }
    }

}
/* End of file Jobs_model.php */
/* Location: ./application/models/Jobs_model.php */

