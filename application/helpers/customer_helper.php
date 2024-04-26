<?php

function createNotification($prof_id, $module, $notification_message)
{   
    $CI =& get_instance();
    $CI->load->model('CustomerNotification_model');

    $data = [
        'prof_id' => $prof_id,
        'module' => $module,
        'notification_message' => $notification_message,
        'status' => $CI->CustomerNotification_model->statusNew(),
        'created' => date('Y-m-d H:i:s')
    ];

    $CI->CustomerNotification_model->create($data);
}

function countCustomerByGroup($group_id)
{   
    $CI =& get_instance();
    $CI->db->select('COUNT(prof_id)AS total_customer');
    $CI->db->from('acs_profile');
    $CI->db->where('customer_group_id', $group_id);
    $customer = $CI->db->get()->row();
    
    $total_customer = 0;
    if ($customer) {
        $total_customer = $customer->total_customer;
    }

    return $total_customer;
}