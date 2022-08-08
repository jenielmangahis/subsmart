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