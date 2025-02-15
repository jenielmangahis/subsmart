<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workorder_model extends MY_Model
{

    public $table = 'work_orders';
    public $table_workorder_settings = 'work_order_settings';
    public $table_agreement_products = 'work_orders_agreement_products'; 

    public function getAllOrderByCompany($company_id, $options = array(), $search = array())
    {

        $this->db->select('work_orders.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');
        $this->db->where('work_orders.company_id', $company_id);
        $this->db->where('work_orders.work_order_number !=', '');

        if (!empty($options)) {

            if (isset($options['assign_to'])) {

                $this->db->where('assign_to', $options['assign_to']);
            }
        }

        if( !empty($search) ){
            $this->db->group_start();
            foreach($search as $s){
                $this->db->or_like($s['field'], $s['value'], 'both');
            }
            $this->db->group_end();
        }

        $this->db->order_by('work_orders.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0, $options = array())
    {

        $user_id = getLoggedUserID();

        $this->db->select('*');
        $this->db->from($this->table);

        if (!$uid) {
            $this->db->where('user_id', $user_id);
        } else {
            $this->db->where('user_id', $uid);
        }

        if ($type != '' && $type != 'tt') {

            $this->db->where('customer_type', $type);
        }

        if ($status != '' && $status != 'ss') {

            $this->db->where('workorder_status', $status);
        }

        if ($emp_id) {

            $this->db->where("FIND_IN_SET($emp_id, assign_to)");
        }

        if (!empty($options)) {

            if (isset($options['assign_to'])) {

                $this->db->where('assign_to', $options['assign_to']);
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }


    /**
     * @param int $company_id
     * @return mixed
     */
    function getStatusWithCount($company_id = 0)
    {

        $this->db->select('work_status.id, work_status.title, COUNT(workorders.id) as total');
        $this->db->from($this->table);

        // join the status table
        $this->db->join('work_status', 'work_status.id = workorders.status_id');


        if (isset($company_id)) {
            $this->db->where('workorders.company_id', $company_id);
        } else {

            $this->db->where('workorders.user_id', getLoggedUserID());
        }

        $this->db->group_by('work_status.id, work_status.title');

        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        return $query->result();

    }


    /**
     * @param array $filters
     * @param int $company_id
     * @return mixed
     */
    public function filterBy($filters = array(), $company_id = 0)
    {

        $this->db->select('workorders.id, workorders.user_id, workorders.date_issued, workorders.customer_id, workorders.company_id, workorders.status_id, workorders.priority_id');
        $this->db->from($this->table);

        if (!empty($filters)) {

            if (isset($filters['status'])) {

                $this->db->where('status_id', $filters['status']);
            } elseif (isset($filters['search'])) {

                $this->db->join('customers', "customers.id = workorders.customer_id");
                $this->db->like('customers.contact_name', $filters['search']);
            } elseif (isset($filters['order'])) {

                switch ($filters['order']) {

                    case 'date-issued-desc':
                        $this->db->order_by('date_issued', 'DESC');
                        break;

                    case 'date-issued-asc':
                        $this->db->order_by('date_issued');
                        break;

                    case 'event-date-desc':
                        $this->db->join('work_status', "work_status.id = workorders.status_id", "left");
                        $this->db->order_by("(CASE work_status.title WHEN '" . WORKORDER_STATUS_SCHEDULE . "' THEN 1 ELSE 0 END), date_issued ASC");
                        break;

                    case 'event-date-asc':
                        $this->db->join('work_status', "work_status.id = workorders.status_id", "left");
                        $this->db->order_by("(CASE work_status.title WHEN '" . WORKORDER_STATUS_SCHEDULE . "' THEN 0 ELSE 1 END), date_issued DESC");
                        break;

                    case 'date-completed-desc':
                        $this->db->join('work_status', "work_status.id = workorders.status_id", "left");
                        $this->db->order_by("(CASE work_status.title WHEN '" . WORKORDER_STATUS_COMPLETE . "' THEN 1 ELSE 0 END), date_issued ASC");
                        break;

                    case 'date-completed-asc':
                        $this->db->join('work_status', "work_status.id = workorders.status_id", "left");
                        $this->db->order_by("(CASE work_status.title WHEN '" . WORKORDER_STATUS_COMPLETE . "' THEN 0 ELSE 1 END), date_issued DESC");
                        break;

                    case 'number-desc':
                        $this->db->order_by('created_at', 'DESC');
                        break;

                    case 'number-asc':
                        $this->db->order_by('created_at', 'ASC');
                        break;

                    case 'priority-asc':
                        $this->db->join('priority_list', "priority_list.id = workorders.priority_id", "left");
                        $this->db->order_by("priority_list.title ASC");
                        break;

                    case 'priority-desc':
                        $this->db->join('priority_list', "priority_list.id = workorders.priority_id", "left");
                        $this->db->order_by("priority_list.title DESC");
                        break;
                }
            }
        }

        //
        if (isset($company_id)) {
            $this->db->where('workorders.company_id', $company_id);
        } else {

            $this->db->where('workorders.user_id', getLoggedUserID());
        }

        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        return $query->result();
    }

    public function save_workorder($data){
		$vendor = $this->db->insert('work_orders', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
	}

    public function save_workorder_temp($data){
		$vendor = $this->db->insert('work_orders_temp', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
	}

    public function addPackage($data)
    {
        $vendor = $this->db->insert('package_details', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function addItemPackage($data)
    {
        $vendor = $this->db->insert('item_package', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function getLastInsertByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        $result = $this->db->get();
        return $result->result();
    }

    public function getPackageDetails($id)
    {
        $this->db->select('*, package_details.name AS package_name ');
		$this->db->from('item_package');
        $this->db->join('package_details', 'item_package.package_id  = package_details.id');
        $this->db->join('items', 'item_package.item_id  = items.id');
        $this->db->where('package_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getPackageDetailsByCompany($cid)
    {
        $this->db->select('*');
		$this->db->from('package_details');
        // $this->db->join('item_package', 'package_details.id  = item_package.package_id');
        // $this->db->join('items', 'item_package.item_id  = items.id');
        $this->db->where('company_id', $cid);
        // $this->db->group_by('package_details.id');
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getPackageItemsById()
    {
        $this->db->select('*');
		$this->db->from('item_package');
        // $this->db->join('package_details', 'item_package.package_id  = package_details.id');
        $this->db->join('items', 'item_package.item_id  = items.id');
        // $this->db->where('package_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
        // $this->db->select('*');
		// $this->db->from('package_details');
        // $this->db->join('item_package', 'package_details.id  = item_package.package_id');
        // $this->db->join('items', 'item_package.item_id  = items.id');
        // $this->db->where('package_details.company_id', $cid);
        // // $this->db->group_by('package_details.id');
        // $query2 = $this->db->get();
        // return $query2->result();
    }

    public function getPackageById()
    {
        $this->db->select('*, name AS pname');
		$this->db->from('package_details');
        // $this->db->where('package_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getPackageName($id)
    {
        $this->db->select('*');
		$this->db->from('package_details');
        $this->db->where('id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function update_workorder($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('work_orders', array(
            'security_number'       => $security_number,
            'birthdate'             => $birthdate,
            'phone_number'          => $phone_number,
            'mobile_number'         => $mobile_number,
            'email'                 => $email,
            'job_location'          => $job_location,
            'city'                  => $city,
            'state'                 => $state,
            'zip_code'              => $zip_code,
            'cross_street'          => $cross_street,
            'password'              => $password,
            'offer_code'            => $offer_code,
            'tags'                  => $tags,
            'date_issued'           => $date_issued,
            'job_type'              => $job_type,
            'job_name'              => $job_name,
            'job_description'       => $job_description,
            'payment_method'        => $payment_method,
            'payment_amount'        => $payment_amount,
            'attached_photo'        => $attached_photo,
            'document_links'        => $document_links,
            'terms_and_conditions'  => $terms_and_conditions,
            'status'                => $status,
            'priority'              => $priority,
            'po_number'             => $po_number,
            'terms_of_use'          => $terms_of_use,
            'instructions'          => $instructions,
            'header'                => $header,
            'subtotal'              => $subtotal,
            'taxes'                 => $taxes, 
            'adjustment_name'       => $adjustment_name,
            'adjustment_value'      => $adjustment_value,
            'voucher_value'         => $voucher_value,
            'grand_total'           => $grand_total,
            'lead_source_id'        => $lead_source_id,
            'company_representative_signature'      => $company_representative_signature,
            'company_representative_name'           => $company_representative_name,
            'primary_account_holder_signature'      => $primary_account_holder_signature,
            'primary_account_holder_name'           => $primary_account_holder_name,
            'secondary_account_holder_signature'    => $secondary_account_holder_signature,
            'secondary_account_holder_name'         => $secondary_account_holder_name,
            'checklists' => $checklists,
        ));
        return true;
    }

    public function update_workorder_alarm($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('work_orders', array(
            'security_number'       => $security_number,
            'birthdate'             => $birthdate,
            'phone_number'          => $phone_number,
            'mobile_number'         => $mobile_number,
            'email'                 => $email,
            'job_location'          => $job_location,
            'city'                  => $city,
            'state'                 => $state,
            'zip_code'              => $zip_code,
            'cross_street'          => $cross_street,
            'password'              => $password,
            //additional
            'job_name'              => $job_name,
            'job_description'       => $job_description,
            'instructions'          => $instructions,
            //--end
            // 'offer_code'            => $offer_code,
            'tags'                  => $tags,
            'date_issued'           => $date_issued,
            'job_type'              => $job_type,
            // 'job_name'              => $job_name,
            // 'job_description'       => $job_description,
            'payment_method'        => $payment_method,
            'payment_amount'        => $payment_amount,
            'terms_and_conditions'  => $terms_and_conditions,
            'status'                => $status,
            'priority'              => $priority,
            // 'purchase_order_number' => $purchase_order_number,
            'terms_of_use'          => $terms_of_use,
            // 'instructions'          => $instructions,
            'header'                => $header,
            'subtotal'              => $subtotal,
            'taxes'                 => $taxes, 
            'otp_setup'             => $otp_setup,
            'monthly_monitoring'    => $monthly_monitoring,
            // 'adjustment_name'       => $adjustment_name,
            // 'adjustment_value'      => $adjustment_value,
            // 'voucher_value'         => $voucher_value,
            'grand_total'           => $grand_total,
            'lead_source_id'        => $lead_source_id,
            'company_representative_signature'      => $company_representative_signature,
            'company_representative_name'           => $company_representative_name,
            'primary_account_holder_signature'      => $primary_account_holder_signature,
            'primary_account_holder_name'           => $primary_account_holder_name,
            'secondary_account_holder_signature'    => $secondary_account_holder_signature,
            'secondary_account_holder_name'         => $secondary_account_holder_name,

            'initials'              => $initials,
            'plan_type'             => $plan_type,
            'account_type'          => $account_type,
            'panel_type'            => $panel_type,
            'panel_location'        => $panel_location,
            'panel_communication'   => $panel_communication,

            'billing_date'                  => $billing_date,
            'billing_frequency'             => $billing_frequency,
        ));
        return true;
    }

    public function update_workorder_installation($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('work_orders', array(
            'security_number'       => $security_number,//
            'phone_number'          => $phone_number,//
            'mobile_number'         => $mobile_number,//
            'email'                 => $email,//
            'job_location'          => $job_location,//
            'city'                  => $city,//
            'state'                 => $state,//
            'country'               => $country,//
            'zip_code'              => $zip_code,//
            'comments'              => $comments,//
            'password'              => $password,//
            
            'date_issued'           => $date_issued,//
            'payment_method'        => $payment_method,//
            'payment_amount'        => $payment_amount,//
            'terms_and_conditions'  => $terms_and_conditions,//

            'subtotal'              => $subtotal,//
            'taxes'                 => $taxes, //
            'installation_cost'     => $installation_cost, //
            'otp_setup'             => $otp_setup,//
            'monthly_monitoring'    => $monthly_monitoring,//
            'grand_total'           => $grand_total,//
            'job_tags'              => $job_tags,//

            'lead_source_id'        => $lead_source_id,//

            'status'                => $status, //Added by Bryann Revina
            //'agent_id'              => $agent_id, //Added by Bryann Revina

            'company_representative_signature'      => $company_representative_signature,
            'company_representative_name'           => $company_representative_name,
            'primary_account_holder_signature'      => $primary_account_holder_signature,
            'primary_account_holder_name'           => $primary_account_holder_name,
            'secondary_account_holder_signature'    => $secondary_account_holder_signature,
            'secondary_account_holder_name'         => $secondary_account_holder_name,

            'account_type'          => $account_type,//
            'panel_type'            => $panel_type,//
            'panel_communication'   => $panel_communication,//

            'install_date'          => $install_date,//
            'install_time'          => $install_time,//

            'date_updated'                  => $date_updated,//
        ));
        return true;
    }

    public function update_workorder_solar($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('work_orders', array(
            'phone_number'          => $phone_number,//
            'mobile_number'         => $mobile_number,//
            'email'                 => $email,//
            'job_location'          => $job_location,//
            'city'                  => $city,//
            'state'                 => $state,//
            'country'               => $country,//
            'zip_code'              => $zip_code,//
            'comments'              => $comments,//
            'password'              => $password,//
            
            'date_issued'           => $date_issued,//
            'payment_method'        => $payment_method,//
            'payment_amount'        => $payment_amount,//

            'lead_source_id'        => $lead_source_id,//

            'status'                => $status, //Added Bryann Revina 08152022
            //'agent_id'              => $agent_id, //Added Bryann Revina 08152022

            'company_representative_signature'      => $company_representative_signature,
            'company_representative_name'           => $company_representative_name,
            'primary_account_holder_signature'      => $primary_account_holder_signature,
            'primary_account_holder_name'           => $primary_account_holder_name,
            'secondary_account_holder_signature'    => $secondary_account_holder_signature,
            'secondary_account_holder_name'         => $secondary_account_holder_name,

            'panel_communication'   => $panel_communication,//

            'date_updated'          => $date_updated,//
        ));
        return true;
    }

    public function updateWorkorderAgreement($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('workorder_agreement_items', array(
            'firstname'                 => $firstname,
            'lastname'                  => $lastname,
            'businessname'              => $businessname,
            'firstname_spouse'          => $firstname_spouse,
            'lastname_spouse'           => $lastname_spouse,
            'address'                   => $address,
            'city'                      => $city,
            'state'                     => $state,
            'county'                    => $county,
            'postcode'                  => $postcode,
            'first_ecn'                 => $first_ecn,
            'second_ecn'                => $second_ecn,
            'third_ecn'                 => $third_ecn,
            'first_ecn_no'              => $first_ecn_no,
            'second_ecn_no'             => $second_ecn_no,
            'third_ecn_no'              => $third_ecn_no,
            'installation_date'         => $installation_date,
            'intall_time'               => $intall_time,
            'sales_re_name'             => $sales_re_name,
            'sale_rep_phone'            => $sale_rep_phone,
            'team_leader'               => $team_leader,
            'billing_date'              => $billing_date,
        ));
        return true;
    }

    public function update_acs_alarm($data)
    {
        extract($data);
        $this->db->where('prof_id', $prof_id);
        $this->db->update('acs_profile', array(
            // 'prof_id'                   => $this->input->post('acs_id'),
            'customer_type'             => $customer_type,
            'business_name'             => $business_name, //new
            'install_type'              => $install_type,
            'last_name'                 => $last_name,
            'first_name'                => $first_name,
            'phone_m'                   => $phone_m, //new
            'date_of_birth'             => $date_of_birth, //new
            'ssn'                       => $ssn, //new
            'email'                     => $email, //new
            's_last_name'               => $s_last_name,
            's_first_name'              => $s_first_name,
            's_mobile'                  => $s_mobile,
            's_dob'                     => $s_dob,
            's_ssn'                     => $s_ssn,
            'notification_type'         => $notification_type,
            'first_verification_name'   => $first_verification_name,
            'first_number'              => $first_number,
            'first_number_type'         => $first_number_type,
            'first_relation'            => $first_relation,
            'second_verification_name'  => $second_verification_name,
            'second_number'             => $second_number,
            'second_number_type'        => $second_number_type,
            'second_relation'           => $second_relation,
            'third_verification_name'   => $third_verification_name,
            'third_number'              => $third_number,
            'third_number_type'         => $third_number_type,
            'third_relation'            => $third_relation,
            'fourth_verification_name'  => $fourth_verification_name,
            'fourth_number'             => $fourth_number,
            'fourth_number_type'        => $fourth_number_type,
            'fourth_relation'           => $fourth_relation,

            'mail_add'                  => $mail_add, //new
            'city'                      => $city, //new
            'state'                     => $state, //new
            'zip_code'                  => $zip_code, //new
            'cross_street'              => $cross_street, //new
            // 'plan_type'                 => $this->input->post('plan_type'),
            // 'account_type'              => $this->input->post('account_type'),
            // 'panel_type'                => $this->input->post('panel_type'),
            // 'panel_location'            => $this->input->post('panel_location'),
            // 'panel_communication'       => $this->input->post('panel_communication'),
            // 'job_requested_date'        => $this->input->post('date_issued'),
            // 'initials'                  => $this->input->post('initials'),
            // 'work_order_id'             => $addQuery
            // 'company_id'                => $company_id,
        ));
        return true;
    }

    public function update_acs_solar($data)
    {
        extract($data);
        $this->db->where('prof_id', $prof_id);
        $this->db->update('acs_profile', array(
            'last_name'                 => $last_name,
            'first_name'                => $first_name,
            'phone_m'                   => $phone_m, //new
            'email'                     => $email, //new
            'phone_h'                   => $phone_h,
            'country'                   => $country,

            'mail_add'                  => $mail_add, //new
            'city'                      => $city, //new
            'state'                     => $state, //new
            'zip_code'                  => $zip_code, //new
        ));
        return true;
    }

    public function update_cameras($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('enhanced_services_cameras', array(
            'honeywell_wo'          => $honeywell_wo,
            'honeywell_wi'          => $honeywell_wi,
            'honeywell_doorbellcam' => $honeywell_doorbellcam,
            'alarm_wo'              => $alarm_wo,
            'alarm_wi'              => $alarm_wi,
            'alarm_doorbellcam'     => $alarm_doorbellcam,
            'other_wo'              => $other_wo,
            'other_wi'              => $other_wi,
            'other_doorbellcam'     => $other_doorbellcam,
        ));
        return true;
    }

    public function update_doorlocks($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('enhanced_services_doorlocks', array(
            'deadbolt_brass'        => $deadbolt_brass,
            'deadbolt_nickel'       => $deadbolt_nickel,
            'deadbolt_bronze'       => $deadbolt_bronze,
            'handle_brass'          => $handle_brass,
            'handle_nickel'         => $handle_nickel,
            'handle_bonze'          => $handle_bonze,
        ));
        return true;
    }

    public function update_dvr($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('enhanced_services_dvr', array(
            'honeywell_4ch'         => $honeywell_4ch,
            'honeywell_8ch'         => $honeywell_8ch,
            'honeywell_16ch'        => $honeywell_16ch,
            'alarm_4ch'             => $alarm_4ch,
            'alarm_8ch'             => $alarm_8ch,
            'alarm_16ch'            => $alarm_16ch,
            'other_4ch'             => $other_4ch,
            'other_8ch'             => $other_8ch,
            'other_16ch'            => $other_16ch,
        ));
        return true;
    }

    public function update_pers($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('enhanced_services_pers', array(
            'fall_detection'        => $fall_detection,
            'w_o_fall_protection'   => $w_o_fall_protection,
        ));
        return true;
    }

    public function update_cash($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'is_collected'          => $is_collected,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_check($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'check_number'          => $check_number,
            'routing_number'        => $routing_number,
            'account_number'        => $account_number,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_creditCard($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'credit_number'         => $credit_number,
            'credit_expiry'         => $credit_expiry,
            'credit_cvc'            => $credit_cvc,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_debitCard($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'credit_number'         => $credit_number,
            'credit_expiry'         => $credit_expiry,
            'credit_cvc'            => $credit_cvc,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_ACH($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'routing_number'        => $credit_number,
            'account_number'        => $credit_expiry,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Venmo($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'confirmation'          => $confirmation,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Paypal($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'confirmation'          => $confirmation,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Square($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'confirmation'          => $confirmation,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Warranty($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Home($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Transfer($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Professor($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'credit_number'         => $credit_number,
            'credit_expiry'         => $credit_expiry,
            'credit_cvc'            => $credit_cvc,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function update_Other($data)
    {
        extract($data);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order_payments', array(
            'payment_method'        => $payment_method,
            'amount'                => $amount,
            'account_credentials'   => $account_credentials,
            'account_note'          => $account_note,
            'date_updated'          => $date_updated,
        ));
        return true;
    }

    public function save_contact($data){
        $custom = $this->db->insert('contacts', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function save_contact_new($data){
        $custom = $this->db->insert('contacts', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function save_contact_temp($data){
        $custom = $this->db->insert('contacts_temp', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function get_contacts($customer_id)
    {
        $this->db->select('*');
		$this->db->from('contacts');
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
		return $query->result();
    }

    public function get_solar($id)
    {
        $this->db->select('*');
		$this->db->from('workorder_solar_items');
		$this->db->where('work_order_id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_solar_files($woID)
    {
        $this->db->select('*');
		$this->db->from('workorder_solar_files');
		$this->db->where('work_order_id', $woID);
		$query = $this->db->get();
		return $query->result();
    }

    public function get_agreements($id)
    {
        $this->db->select('*');
		$this->db->from('workorder_agreement_items');
		$this->db->where('work_order_id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_agree_items($id)
    {
        $this->db->select('*');
		$this->db->from('work_orders_agreement_products');
		$this->db->where('work_order_id', $id);
		$query = $this->db->get();
		return $query->result();
    }

    public function get_agree_details($id)
    {
        $this->db->select('*');
		$this->db->from('workorder_agreement_items');
		$this->db->where('work_order_id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_payments_details($id)
    {
        $this->db->select('*');
		$this->db->from('work_order_payments');
		$this->db->where('work_order_id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    function getRows($name){
        $this->db->select('*');
        $this->db->from('workorder_solar_files');
        $this->db->where('solar_image',$name);
        $query = $this->db->get();
		return $query->row();
    }

    public function deleteContacts($customer_id)
    {
        $this->db->where('customer_id',$customer_id);
        $this->db->delete('contacts');
        return true;
    }

    public function getDataByWO($wo_num)
    {
        $this->db->select('*');
		$this->db->from('work_orders');
		$this->db->where('id', $wo_num);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_lead($id)
    {
        $this->db->select('*');
		$this->db->from('ac_leadsource');
		$this->db->where('ls_id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function getpayment($id)
    {
        $this->db->select('*');
		$this->db->from('work_order_payments');
		$this->db->where('work_order_id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_workorder_data($id)
    {
        $this->db->select('*');
		// $this->db->from('work_orders');
		// $this->db->where('id', $id);
        // $this->db->select('*','ls_name','jbname');
		$this->db->from('work_orders');
        // $this->db->join('ac_leadsource', 'work_orders.lead_source_id  = ac_leadsource.ls_id');
        // $this->db->join('job_tags', 'work_orders.job_tags  = job_tags.id');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_job_tags_data($id)
    {
        $this->db->select('*');
		$this->db->from('job_tags');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_source_data($id)
    {
        $this->db->select('*');
		$this->db->from('ac_leadsource');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_cliets_data($id)
    {
        $this->db->select('*');
		$this->db->from('clients');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_customerData_data($id)
    {
        $this->db->select('*');
		$this->db->from('acs_profile');
		$this->db->where('prof_id ', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function save_custom_fields($data){
        $custom = $this->db->insert('workorder_custom_fields', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function add_custom_fields($data){
        $custom = $this->db->insert('custom_fields', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function getTerms($comp_id){

        $this->db->select('*');
		$this->db->from('terms_and_conditions');
		$this->db->where('company_id', $comp_id);
		$query = $this->db->get();
		return $query->row();
    }

    public function getWOTerms($comp_id){

        $this->db->select('*');
		$this->db->from('work_order_terms_conditions');
		$this->db->where('company_id', $comp_id);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsbyID(){
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('terms_and_conditions');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getWOtermsByID()
    {
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('work_order_terms_conditions');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getWOtermsByIDAgree()
    {
        $cid = getLoggedCompanyID();
        $where = array(
            'company_id' => $cid,
            'agreement'   => '1'
        );

        $this->db->select('*');
		$this->db->from('work_order_terms_conditions');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsDefault(){
        $cid = 0;

        $this->db->select('*');
		$this->db->from('terms_and_conditions');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsUse($comp_id){

        $this->db->select('*');
		$this->db->from('terms_of_use');
		$this->db->where('company_id', $comp_id);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsUsebyID(){
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('terms_of_use');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getTermsUseDefault(){
        $cid = 0;

        $this->db->select('*');
		$this->db->from('terms_of_use');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
    }

    public function getCustomByID(){
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('custom_fields');
		$this->db->where('company_id', $cid);
		// $query = $this->db->get();
		// return $query->row();
        $query = $this->db->get();
        return $query->result();
    }

    public function getCustomFieldsByCompanyId($company_id){
        $this->db->select('*');
		$this->db->from('custom_fields');
		$this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getheaderByID()
    {
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('work_order_headers');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
		return $query->row();
        // $query = $this->db->get();
        // return $query->result();
    }

    public function getheaderSolarByID()
    {
        $cid = getLoggedCompanyID();

        $where = array(
            'company_id' => $cid,
            'solar'   => '1'
        );

        $this->db->select('*');
		$this->db->from('work_order_headers');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
    }

    public function getheaderInstallationByID()
    {
        $cid = getLoggedCompanyID();

        $where = array(
            'company_id' => $cid,
            'solar'   => '0',
            'installation' => '1'
        );

        $this->db->select('*');
		$this->db->from('work_order_headers');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
    }

    public function save_header($data){
        $vendor = $this->db->insert('work_order_headers', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function save_terms($data)
    {
        $vendor = $this->db->insert('work_order_headers', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function save_termsCond($data)
    {
        $vendor = $this->db->insert('work_order_terms_conditions', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function updateWOTermsCond($data)
    {
        extract($data);
        $this->db->where('company_id', $company_id);
        $this->db->update('work_order_terms_conditions', array('content' => $content));
        return true;
    }

    public function getWorkOrderSettingTermsConditionByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from('work_order_terms_conditions');
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getWorkOrderSettingHeaderByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from('work_order_headers');
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function update_header($data){
        $vendor = $this->db->update('work_order_headers', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function getchecklistByUser($id)
    {
        $this->db->select('checklists.*,checklists.id as check_id,checklist_items.checklist_id,checklist_items.item_name,');
		$this->db->from('checklists');
        $this->db->join('checklist_items', 'checklists.id = checklist_items.checklist_id');
		$this->db->where('checklists.user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getchecklistHeaderByUser($id)
    {
        $this->db->select('checklists.*');
        $this->db->from('checklists');
        $this->db->where('checklists.user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getchecklistHeaderByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from('checklists');
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getchecklistHeaderItems($checklist_id)
    {
        $this->db->select('checklist_items.*');
        $this->db->from('checklist_items');
        $this->db->where('checklist_items.checklist_id', $checklist_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_custom_field($data)
    {
        extract($data);
        // $vendor = $this->db->update('custom_fields', $data);
        //           $this->db->where('id', $data['id']);
	    // $insert = $this->db->insert_id();
		// return  $insert;
        $this->db->where('id', $id);
        $this->db->update('custom_fields', array('name' => $name));
        return true;
    }

    public function update_custom_field_edit($data)
    {
        extract($data);
        // $vendor = $this->db->update('custom_fields', $data);
        //           $this->db->where('id', $data['id']);
	    // $insert = $this->db->insert_id();
		// return  $insert;
        $this->db->where('id', $id);
        $this->db->update('custom_fields_lists', array('name' => $name));
        return true;
    }

    public function getchecklistdetailsajax($data)
    {

        $this->db->select('*');
        $this->db->from('checklists');
        // $this->db->join('checklist_items', 'checklist_items.checklist_id = checklists.id');
        $this->db->where('id', $data);

        $query = $this->db->get();
        return $query->result();
    }

    public function checklistsitems($id)
    {
        // $test  = '4';
        $this->db->select('*');
        $this->db->from('checklist_items');
        $this->db->where('checklist_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    public function additem_details($data){
	    $vendor = $this->db->insert('custom_fields_lists', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function createWorkOrderTermsConditions($data){
	    $termsCondition = $this->db->insert('work_order_terms_conditions', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function createWorkOrderHeader($data){
	    $termsCondition = $this->db->insert('work_order_headers', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function updateWorkOrderTermsConditionByCompanyId($company_id,$data)
    {
        $this->db->where('company_id', $company_id);
        $result = $this->db->update('work_order_terms_conditions', $data);
        return $result;
    }

    public function updateWorkOrderHeaderCompanyId($company_id,$data)
    {
        $this->db->where('company_id', $company_id);
        $result = $this->db->update('work_order_headers', $data);
        return $result;
    }

    public function getjob_types()
    {
        // $test  = '4';
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('job_types');
		$this->db->where('company_id', $cid);
		$query = $this->db->get();
        return $query->result();
    }

    public function getlastInsert($company_id){

        $where = array(
            //'view_flag'     => '0',
            'company_id'   => $company_id
          );

        $this->db->select('*');
        $this->db->from('work_orders');
        $this->db->where($where);
        $this->db->order_by('work_order_number', 'DESC');
        $this->db->limit(1);

        // $query = $this->db->query("SELECT * FROM date_data ORDER BY id DESC LIMIT 1");
        $result = $this->db->get();
        return $result->result();
    }

    public function getlastInsertMultiple($company_id=array())
    {
        $where = array(
            'view_flag'     => '0',
            // 'company_id'   => $company_id
          );

        $this->db->select('*');
        $this->db->from('work_orders');
        $this->db->where($where);
        $this->db->where_in('company_id',$company_id);
        $this->db->order_by('work_order_number', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->result();
    }

    public function getname($id)
    {
        $this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getleadSource($id)
    {
        $this->db->select('*');
		$this->db->from('ac_leadsource');
		$this->db->where('ls_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save_notification($data)
    {
        $vendor = $this->db->insert('user_notification', $data);
	    $insert = $this->db->insert_id();
		return  $insert;
    }

    public function companyDet($cid)
    {
        $this->db->select('*');
		$this->db->from('clients');
		$this->db->where('id', $cid);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCustomFields($id)
    {
        $this->db->select('*');
        $this->db->from('custom_fields_lists');
        $this->db->where('work_order_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getlastInsertID(){

        $this->db->select('*');
        $this->db->from('work_orders');
        // $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        // $query = $this->db->query("SELECT * FROM date_data ORDER BY id DESC LIMIT 1");
        $result = $this->db->get();
        return $result->result();
    }

    public function getjob_tagsById()
    {
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('job_tags');
		$this->db->where('company_id', $cid);
        $this->db->order_by('name', 'ASC');
		// $query = $this->db->get();
		// return $query->row();
        $query = $this->db->get();
        return $query->result();
    }

    public function getclientsById()
    {
        $cid = getLoggedCompanyID();

        $this->db->select('*');
		$this->db->from('clients');
		$this->db->where('id', $cid);
		// $query = $this->db->get();
		// return $query->row();
        $query = $this->db->get();
        return $query->row();
    }

    public function update_tc($data)
    {
        extract($data);

        if($id == ''){
            $termsCondition = $this->db->insert('work_order_terms_conditions', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            $this->db->where('id', $id);
            $this->db->update('work_order_terms_conditions', array('content' => $content));
            return $data;
        }
    }

    public function update_setting_header($data)
    {
        extract($data);

        if($id == ''){
            $header = $this->db->insert('work_order_headers', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            $this->db->where('id', $id);
            $this->db->update('work_order_headers', array('content' => $content));
            return $data;
        }
    }

    public function update_header_f($data)
    {
        
        extract($data);
        // $vendor = $this->db->update('custom_fields', $data);
        //           $this->db->where('id', $data['id']);
	    // $insert = $this->db->insert_id();
		// return  $insert;
        $this->db->where('id', $id);
        $this->db->update('work_order_headers', array('content' => $content));
        return $data;
    }
    
    public function update_tu($data)
    {
        extract($data);
        if($id == NULL){
            $vendor = $this->db->insert('terms_of_use', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
        // $vendor = $this->db->update('custom_fields', $data);
        //           $this->db->where('id', $data['id']);
	    // $insert = $this->db->insert_id();
		// return  $insert;
        $this->db->where('id', $id);
        $this->db->update('terms_of_use', array('content' => $content));
        return $data;
        }
    }

    public function getworkorderList( $filters = array(), $sort = array() )
    {
        $company_id = logged('company_id');
        
        $where = array(
            'work_orders.company_id' => $company_id,
            'work_orders.view_flag'   => '0'
        );

        // $this->db->select('work_orders.* , acs_profile.first_name,  acs_profile.last_name, acs_profile.middle_name, acs_profile.prof_id, work_order_alarm_details.work_order_id');
		// $this->db->from('workorders.* , acs_profile.first_name,  acs_profile.last_name, acs_profile.middle_name, acs_profile.prof_id');
        $this->db->select('*, work_orders.status AS w_status');
        $this->db->from('work_orders');
        $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');
        // $this->db->join('work_order_alarm_details', 'work_orders.id  = work_order_alarm_details.work_order_id');
		$this->db->where($where);

        if( $filters['status'] != '' && $filters['status'] != 'all' ){
            $this->db->where('work_orders.status', ucwords($filters['status']));
        }

        if( !empty($sort) ){
            $this->db->order_by($sort['field'], strtoupper($sort['order']));
        }else{
            $this->db->order_by('id', 'DESC');    
        }
        
        $query = $this->db->get();
        return $query->result();

        // $this->db->select('*');    
        // $this->db->from('work_orders');
        // $this->db->join('acs_profile', 'work_orders.customer_id = acs_profile.prof_id');
        // $this->db->join('work_order_alarm_details', 'work_orders.id = work_order_alarm_details.work_order_id');
        // $this->db->where('work_orders.company_id', $company_id);
        // $query = $this->db->get();
        // return $query;
    }
    public function getworkorderListMultiple( $company_id = array(), $filters = array(), $sort = array() )
    {
        // $company_id = logged('company_id');
        
        $where = array(
            // 'work_orders.company_id' => $company_id,
            'work_orders.view_flag'   => '0'
        );

        // $this->db->select('work_orders.* , acs_profile.first_name,  acs_profile.last_name, acs_profile.middle_name, acs_profile.prof_id, work_order_alarm_details.work_order_id');
		// $this->db->from('workorders.* , acs_profile.first_name,  acs_profile.last_name, acs_profile.middle_name, acs_profile.prof_id');
        $this->db->select('*, work_orders.status AS w_status');
        $this->db->from('work_orders');
        $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');
        // $this->db->join('work_order_alarm_details', 'work_orders.id  = work_order_alarm_details.work_order_id');
		$this->db->where($where);
        $this->db->where_in('work_orders.company_id',$company_id);

        if( $filters['status'] != '' && $filters['status'] != 'all' ){
            $this->db->where('work_orders.status', ucwords($filters['status']));
        }

        if( !empty($sort) ){
            $this->db->order_by($sort['field'], strtoupper($sort['order']));
        }else{
            $this->db->order_by('id', 'DESC');    
        }
        
        $query = $this->db->get();
        return $query->result();

        // $this->db->select('*');    
        // $this->db->from('work_orders');
        // $this->db->join('acs_profile', 'work_orders.customer_id = acs_profile.prof_id');
        // $this->db->join('work_order_alarm_details', 'work_orders.id = work_order_alarm_details.work_order_id');
        // $this->db->where('work_orders.company_id', $company_id);
        // $query = $this->db->get();
        // return $query;
    }

    public function getFilterworkorderList( $company_id, $filters=array(), $sort = array() )
    {

        $where = array(
            'work_orders.company_id' => $company_id,
            'view_flag'   => '0'
        );

        $this->db->select('*, work_orders.status AS w_status');
        $this->db->from('work_orders');
        $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');
        $this->db->where($where);

        if ( !empty($filters) ) {
            if( $filter['status'] != '' && $filter['status'] != 'all' ){
                $this->db->where('work_orders.status', ucwords($filter['status']));
            }

            if ( $filters['search'] != '' ) {
                $this->db->like('work_order_number', $filters['search'], 'both');
                $this->db->or_like('acs_profile.first_name', $filters['search'], 'both');
                $this->db->or_like('acs_profile.last_name', $filters['search'], 'both');
            }
        }

        if( !empty($sort) ){
            $this->db->order_by($sort['field'], strtoupper($sort['order']));
        }else{
            $this->db->order_by('id', 'DESC');    
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getFilterworkorderListMultiple( $company_id=array() , $filters=array(), $sort = array() )
    {

        $where = array(
            // 'work_orders.company_id' => $company_id,
            'view_flag'   => '0'
        );

        $this->db->select('*, work_orders.status AS w_status');
        $this->db->from('work_orders');
        $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');
        $this->db->where($where);
        $this->db->where_in('work_orders.company_id',$company_id);

        if ( !empty($filters) ) {
            if( $filter['status'] != '' && $filter['status'] != 'all' ){
                $this->db->where('work_orders.status', ucwords($filter['status']));
            }

            if ( $filters['search'] != '' ) {
                $this->db->like('work_order_number', $filters['search'], 'both');
                $this->db->or_like('acs_profile.first_name', $filters['search'], 'both');
                $this->db->or_like('acs_profile.last_name', $filters['search'], 'both');
            }
        }

        if( !empty($sort) ){
            $this->db->order_by($sort['field'], strtoupper($sort['order']));
        }else{
            $this->db->order_by('id', 'DESC');    
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getAlarms($id)
    {
        $this->db->select('*');
		$this->db->from('work_order_alarm_details');
		$this->db->where('work_order_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getenhanced_services_cameras($id)
    {
        $this->db->select('*');
		$this->db->from('enhanced_services_cameras');
		$this->db->where('work_order_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getenhanced_services_doorlocks($id)
    {
        $this->db->select('*');
		$this->db->from('enhanced_services_doorlocks');
		$this->db->where('work_order_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getenhanced_services_dvr($id)
    {
        $this->db->select('*');
		$this->db->from('enhanced_services_dvr');
		$this->db->where('work_order_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getenhanced_services_automation($id)
    {
        $this->db->select('*');
		$this->db->from('enhanced_services_automation');
		$this->db->where('work_order_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getPackagelist($id)
    {
        $this->db->select('*');
		$this->db->from('item_categories');
		$this->db->where('company_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getenhanced_services_pers($id)
    {
        $this->db->select('*');
		$this->db->from('enhanced_services_pers');
		$this->db->where('work_order_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getitemsajax($id)
    {
        $this->db->select('*');
		$this->db->from('items');
		$this->db->where('item_categories_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getitemsWorkOrder($id)
    {
        $where = array(
            'type' => 'Work Order',
            'type_id'   => $id
          );

        // $where = "type_id='".$id."' AND type='Work Order' OR type='Work Order Alarm'";

        $this->db->select('*');
		$this->db->from('item_details');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function getitemsWorkOrderAlarm($id)
    {
        $where = array(
            'type' => 'Work Order Alarm',
            'type_id'   => $id
          );

        // $where = "type_id='".$id."' AND type='Work Order' OR type='Work Order Alarm'";

        $this->db->select('*');
		$this->db->from('item_details');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_custom_fields($id)
    {
        $this->db->where('work_order_id',$id);
        $this->db->delete('custom_fields_lists');
        return true;
    }

    public function delete_custom_fields_by_id($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('custom_fields');
        return true;
    }

    public function delete_items($id)
    {
        $where = array(
            // 'type' => 'Work Order',
            'work_order_id'   => $id
          );

        $this->db->where($where);
        $this->db->delete('work_orders_items');
        return true;
    }

    public function delete_items_alarm($id)
    {
        $where = array(
            // 'type' => 'Work Order Alarm',
            'work_order_id'   => $id
          );

        $this->db->where($where);
        $this->db->delete('work_orders_items');
        return true;
    }

    public function delete_items_installation($id)
    {
        $where = array(
            // 'type' => 'Work Order Alarm',
            'work_order_id'   => $id
          );

        $this->db->where($where);
        $this->db->delete('work_orders_agreement_products');
        return true;
    }

    public function getById($id)
    {        
        $this->db->select('work_orders.*,ls_name, CONCAT(users.LName," ",users.FName)AS agent_name');
		$this->db->from('work_orders');
        $this->db->join('users', 'work_orders.employee_id  = users.id', 'left');
        $this->db->join('ac_leadsource', 'work_orders.lead_source_id  = ac_leadsource.ls_id', 'left');
		$this->db->where('work_orders.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdArray($org_ids = array())
    {
        $this->db->select('*','ls_name');
		$this->db->from('work_orders');
        $this->db->join('ac_leadsource', 'work_orders.lead_source_id  = ac_leadsource.ls_id');
		$this->db->where_in('work_orders.id', $org_ids);
        $query = $this->db->get();
        return $query->result();
    }

    public function getByProfIdComp($prof_id)
    {

        $this->db->select('*');
        $this->db->from('acs_profile');
        $this->db->where('prof_id', $prof_id);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function get_custom_data($id)
    {
        $this->db->select('*');
		$this->db->from('custom_fields_lists');
		$this->db->where('work_order_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getworkorder($id)
    {
        /*$company_id = logged('company_id');        
        $where = array(
            'work_orders.company_id' => $company_id,
            'work_orders.id'   => $id
        );*/

        $this->db->select('work_orders.*, work_orders.email AS w_email, work_orders.status AS w_status, acs_profile.first_name AS acs_first_name, acs_profile.last_name AS acs_last_name, acs_profile.middle_name AS acs_middle_name, acs_profile.mail_add AS acs_mail_add, acs_profile.city AS acs_city, acs_profile.state AS acs_state, acs_profile.zip_code AS acs_zipcode, acs_profile.phone_m AS acs_phone_m, acs_profile.phone_h AS acs_phone_h, CONCAT(users.LName," ",users.FName)AS agent_name');
        $this->db->from('work_orders');
        $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');
        $this->db->join('users', 'work_orders.employee_id  = users.id', 'left');
		$this->db->where('work_orders.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function checktemplateId($id)
    {
        $this->db->select('*');
		$this->db->from('company_work_order_used');
		$this->db->where('company_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function addTemplate($data)
    {
        $vendor = $this->db->insert('company_work_order_used', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_cameras($data)
    {
        $vendor = $this->db->insert('enhanced_services_cameras', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_cameras_temp($data)
    {
        $vendor = $this->db->insert('enhanced_services_cameras_temp', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_doorlocks($data)
    {
        $vendor = $this->db->insert('enhanced_services_doorlocks', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_dvr($data)
    {
        $vendor = $this->db->insert('enhanced_services_dvr', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_automation($data)
    {
        $vendor = $this->db->insert('enhanced_services_automation', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_pers($data)
    {
        $vendor = $this->db->insert('enhanced_services_pers', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function updateTemplate($data)
    {
        extract($data);
        $this->db->where('company_id', $company_id);
        $this->db->update('company_work_order_used', array('work_order_template_id' => $work_order_template_id));
        return true;
    }

    public function deleteWorkorder($data)
    {
        extract($data);
        $this->db->where('id', $id);
        $this->db->update('work_orders', array('view_flag' => $view_flag));
        return true;
    }

    public function  getlead_source()
    {
        $this->db->distinct();
        $this->db->select('*');
		$this->db->from('ac_leadsource');
        $query = $this->db->get();
        return $query->result();
    }

    public function  getLeadSourceByCompanyId($company_id)
    {        
        $this->db->select('*');
		$this->db->from('ac_leadsource');
		$this->db->where('fk_company_id', $company_id);
        $this->db->group_by('ls_name');
        $query = $this->db->get();
        return $query->result();
    }

    public function getcompany_work_order_used($company_id)
    {
        $this->db->select('*');
		$this->db->from('company_work_order_used');
		$this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getcompany_data($id)
    {
        $this->db->select('*');
		$this->db->from('clients');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getjob_tag($id)
    {
        $this->db->select('*');
		$this->db->from('job_tags');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getbusiness($cid)
    {
        $this->db->select('*');
		$this->db->from('business_profile');
		$this->db->where('company_id', $cid);
        $query = $this->db->get();
        return $query->row();
    }

    public function getuserfirst($id)
    {
        $this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function firstNumeric($id)
    {
        $this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getusersecond($id)
    {
        $this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getuserthird($id)
    {
        $this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getSettings($company_id)
    {
        // $company_id = logged('company_id');
        $where = array(
            'company_id' => $company_id,
            'key' => 'timezone',
          );

        $this->db->select('*');
		$this->db->from('settings');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCompanyCompanyId($id)
    {
        $this->db->select('company_id');
		$this->db->from('work_orders');
		$this->db->where('id', $id);
        $query = $this->db->get();
        $comp = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        // $this->db->select('*');
        $this->db->select('*','business_profile.company_id','business_profile.street as b_street','business_profile.city as b_city','business_profile.postal_code as b_postal_code','business_profile.state as b_state','business_profile.license_state as b_license_state','business_profile.office_phone as b_office_phone');
		$this->db->from('clients');
        $this->db->join('business_profile', 'clients.id  = business_profile.company_id');
		$this->db->where('clients.id', $id);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function getcustomerCompanyId($id)
    {
        $this->db->select('customer_id');
		$this->db->from('work_orders');
		$this->db->where('id', $id);
        $query = $this->db->get();
        $cus = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        $this->db->select('*');
		$this->db->from('acs_profile');
		$this->db->where('prof_id', $cus->customer_id);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function getItems($id)
    {
        $this->db->select('*');
		$this->db->from('work_orders');
		$this->db->where('id', $id);
        $query = $this->db->get();
        $cus = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        // $where = "type_id='".$id."' AND type='Work Order' OR type='Work Order Alarm'";
        
        $where = array(
            'type' => 'Work Order',
            // 'type' => 'Work Order Alarm',
            'type_id'   => $cus->id
          );

        $this->db->select('*');
		$this->db->from('item_details');
        // $this->db->where('type', 'Work Order');
		// $this->db->where('type_id', $cus->id);
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function getItemsDetails()
    {
        $cid = getLoggedCompanyID();
        $where = array(
            'company_id' => $cid,
            'title'      => 'Solar panels Powur Full Service'
          );

        $this->db->select('*');
		$this->db->from('items');
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function getworkorderItems($id)
    {
        // $this->db->select('*');
		// $this->db->from('work_orders_items');
		// $this->db->where('work_order_id', $id);
        // $query = $this->db->get();
        // $cus = $query->row();

        // $this->db->select('* , work_orders.email AS w_email, work_orders.status AS w_status');
        // $this->db->from('work_orders');
        // $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');

        // $this->db->select('*, package_details.name AS package_name ');
		// $this->db->from('item_package');
        // $this->db->join('package_details', 'item_package.package_id  = package_details.id');
        // $this->db->join('items', 'item_package.item_id  = items.id');
        // $this->db->where('package_id', $id);

        $this->db->select('*, work_orders_items.cost as costing, work_orders_items.items_id');
		$this->db->from('work_orders_items');
        $this->db->join('items', 'work_orders_items.items_id  = items.id');
        // $this->db->join('package_details', 'work_orders_items.package_id  = package_details.id');
        $this->db->where('work_order_id', $id);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function add_work_order_details($data)
    {
        $vendor = $this->db->insert('work_orders_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function add_workorder_agreement_items($data)
    {
        $vendor = $this->db->insert('work_orders_agreement_products', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function add_workorder_solar_items($data)
    {
        $vendor = $this->db->insert('work_orders_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function add_work_order_details_temp($data)
    {
        $vendor = $this->db->insert('work_orders_items_temp', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function getItemsAlarm($id)
    {
        $this->db->select('*');
		$this->db->from('work_orders');
		$this->db->where('id', $id);
        $query = $this->db->get();
        $cus = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        // $where = "type_id='".$id."' AND type='Work Order' OR type='Work Order Alarm'";
        
        $where = array(
            // 'type' => 'Work Order',
            'type' => 'Work Order Alarm',
            'type_id'   => $cus->id
          );

        $this->db->select('*');
		$this->db->from('item_details');
        // $this->db->where('type', 'Work Order');
		// $this->db->where('type_id', $cus->id);
        $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }

    public function save_payment($data)
    {
        $vendor = $this->db->insert('work_order_payments', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_payment_billing($data)
    {
        $vendor = $this->db->insert('acs_billing', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_office($data)
    {
        $vendor = $this->db->insert('acs_office', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_payment_temp($data)
    {
        $vendor = $this->db->insert('work_order_payments_temp', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_alarm($data)
    {
        $vendor = $this->db->insert('acs_profile', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_alarm_info($data)
    {

        $vendor = $this->db->insert('acs_alarm', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function getTaxRate($company_id)
    {
        $where = array(
            'company_id' => $company_id,
            'is_default'   => 1
          );

        $this->db->select('*');
		$this->db->from('tax_rates');
        $this->db->where($where);
        $query2 = $this->db->get();

        return $query2;
    }

    public function getLast()
    {
        $this->db->select('*');
        $this->db->from('acs_profile');        
        $this->db->order_by('prof_id', 'DESC');
        
        $query = $this->db->get()->row();
        return $query;
    }

    // public function save_contact($data)
    // {
    //     $vendor = $this->db->insert('contacts', $data);
	//     $insert_id = $this->db->insert_id();
	// 	return  $insert_id;
    // }

    public function save_solar_items($data)
    {
        $vendor = $this->db->insert('workorder_solar_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_agreement_items($data)
    {
        $vendor = $this->db->insert('workorder_agreement_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function insertSolarFiles($data)
    {
        $vendor = $this->db->insert('workorder_solar_files', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function save_alarm_alarm($data)
    {
        $vendor = $this->db->insert('acs_profile_temp', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function get_workorder_details($id)
    {
        $this->db->from($this->table);
        $this->db->select('*');
       $this->db->where("id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function countAllByStatusAndCompanyId($status, $company_id)
    {
        $status = ucwords($status);

        $this->db->select('*');
        $this->db->from($this->table);

        if( $status != 'All' ){
            $this->db->where('status', $status);    
        }

        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getAllByCustomerId( $customer_id, $filters = array(), $sort = array() )
    {
        $this->db->select('work_orders.*, work_orders.status AS w_status');
        $this->db->from('work_orders');
        $this->db->join('acs_profile', 'work_orders.customer_id  = acs_profile.prof_id');        
        $this->db->where('work_orders.customer_id', $customer_id);

        if( !empty($sort) ){
            $this->db->order_by($sort['field'], strtoupper($sort['order']));
        }else{
            $this->db->order_by('id', 'DESC');    
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function adminGetById($id)
    {
        $this->db->select('work_orders.*, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, acs_profile.phone_m AS customer_phone, acs_profile.email AS customer_email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = work_orders.customer_id', 'left');
        $this->db->where('work_orders.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_alarm($data)
    {
        extract($data);
        $this->db->where('prof_id', $customer_id);
        $this->db->update('acs_profile', array(
            'last_name'       => $last_name,
            'first_name'      => $first_name,
            'phone_h'         => $phone_h,
            'phone_m'         => $phone_m,
            'email'           => $email,
            'mail_add'        => $mail_add,
            'city'            => $city,
            'country'         => $country,
            'zip_code'        => $zip_code,
            'ssn'             => $ssn,
        ));
        return true;
    }

    public function update_office($data)
    {
        // extract($data);
        // $this->db->where('fk_prof_id', $customer_id);
        // $this->db->update('acs_office', array(
        //     'lead_source'           => $lead_source,
        //     'save_by'               => $save_by,
        //     'equipment_cost'        => $equipment_cost,
        //     'monthly_monitoring'    => $mmr,
        //     'sales_date'            => $sales_date,
        // ));
        // return true;
        extract($data);
        $this->db->select('*');
		$this->db->from('acs_office');
        $this->db->where($fk_prof_id);
        $query2 = $this->db->get();
        $query3 = $query2->result();

        if(empty($query3))
        {
            $vendor = $this->db->insert('acs_office', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;

        }else{
            $this->db->where('fk_prof_id', $fk_prof_id);
            $this->db->update('acs_office', array(
                'lead_source'           => $lead_source,
                'save_by'               => $save_by,
                'fk_sales_rep_office'   => $fk_sales_rep_office,
                'equipment_cost'        => $equipment_cost,
                'monthly_monitoring'    => $monthly_monitoring,
                'sales_date'            => $sales_date,
            ));
            return true;
        }
    }

    public function update_office_job($data)
    {
        // extract($data);
        // $this->db->where('fk_prof_id', $customer_id);
        // $this->db->update('acs_office', array(
        //     'lead_source'           => $lead_source,
        //     'save_by'               => $save_by,
        //     'equipment_cost'        => $equipment_cost,
        //     'monthly_monitoring'    => $mmr,
        //     'sales_date'            => $sales_date,
        // ));
        // return true;
        extract($data);
            $this->db->where('fk_prof_id', $fk_prof_id);
            $this->db->update('acs_office', array(
                'fk_sales_rep_office'   => $fk_sales_rep_office,
                'technician'            => $technician,
            ));
            return true;
    }

    public function update_alarm_adi_job($data)
    {
        extract($data);
        $this->db->where('fk_prof_id', $fk_prof_id);
        $this->db->update('acs_alarm', array(
            'monitor_id'   => $monitor_id,
        ));
        return true;
    }

    public function update_alarm_adi($data)
    {
        // extract($data);
        

        extract($data);
        $this->db->select('*');
		$this->db->from('acs_alarm');
        $this->db->where($fk_prof_id);
        $query2 = $this->db->get();
        $query3 = $query2->result();

        if(empty($query3))
        {
            $vendor = $this->db->insert('acs_alarm', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;

        }else{
            $this->db->where('fk_prof_id', $fk_prof_id);
            $this->db->update('acs_alarm', array(
                'equipment_cost'            => $equipment_cost,
                'monthly_monitoring'        => $monthly_monitoring,
                'panel_type'                => $panel_type,
                'otps'                      => $otps,
                'system_type'               => $system_type,
                'monitor_comp'              => $monitor_comp,
                'acct_type'                 => $acct_type,
                'equipment'                 => $equipment,
                'passcode'                  => $passcode,
                'comm_type'                 => $comm_type,
            ));
            return true;
        }
    }

    public function update_alarm_adi_by_customer_id($fk_prof_id, $data)
    {
        $this->db->select('*');
		$this->db->from('acs_alarm');
        $this->db->where('fk_prof_id', $fk_prof_id);
        $query2 = $this->db->get();
        $query3 = $query2->result();

        if(empty($query3))
        {
            $vendor = $this->db->insert('acs_alarm', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;

        }else{
            $this->db->where('fk_prof_id', $fk_prof_id);
            $this->db->update('acs_alarm', $data);
            return true;
        }
    }

    public function update_notes_adi($data)
    {
        extract($data);
        $this->db->select('*');
		$this->db->from('acs_notes');
        $this->db->where($fk_prof_id);
        $query2 = $this->db->get();
        $query3 = $query2->result();

        if(empty($query3))
        {
            $vendor = $this->db->insert('acs_notes', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;

        }else{
            $this->db->where('fk_prof_id', $fk_prof_id);
            $this->db->update('acs_notes', array(
                'note'            => $note,
            ));
            return true;
        }
    }
    
    public function delete_contact($customer_id){

        $this->db->where('customer_id',$customer_id);
        $this->db->delete('contacts');
        return true;
    }


    public function delete_payment_billing($customer_id)
    {

        $this->db->where('fk_prof_id',$customer_id);
        $this->db->delete('acs_billing');
        return true;
    }

    
    public function getCustByComp($company_id)
    {
        $this->db->select('*');
        $this->db->from('acs_profile');
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getWorkOrderSettingsByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_workorder_settings);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function cloneData($data){
        unset($data->id);
        $this->db->insert('work_orders',$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function getAllWorkorderAgreementProductsByWorkorderId($id)
    {

        $this->db->select('*');
        $this->db->from($this->table_agreement_products);
        $this->db->where('work_order_id', $id);
        $this->db->where('item !=', '');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllIsArchiveByCompanyId($cid)
    {
        $this->db->where('company_id', $cid);
        $this->db->where('view_flag', 1);
        $this->db->order_by('date_updated', 'DESC');
        $query = $this->db->get($this->table);
        
        return $query->result();
    }

    public function restoreWorkorder($id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, array("view_flag" => 0, 'date_updated' => date("Y-m-d H:i:s")));
    }

    public function getAllByCompanyIdAndStatus($cid, $status)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('status', $status);
        $this->db->where('view_flag', 0);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file Workorder_model.php */
/* Location: ./application/models/Workorder_model.php */