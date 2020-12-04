<?php
include_once("includes.php");

// get all attendance
$db = new database_handler();
$rows = $db->fetchAll("select * from timesheet_attendance where status = 1 order by id asc");

// iterate
foreach ($rows as $row) {
    // get id, user_id & company_id
    $id             = $row['id'];
    $user_id        = $row['user_id'];
    $company_id     = $row['company_id'];


    // params
    $params['status'] = 0;
    // update to status = 0
    $update = $db->updateQuery($params,'timesheet_attendance', $id,'id');


    // params
    $params['attendance_id']            = $id;
    $params['user_id']                  = $user_id;
    $params['user_location']            = "";
    $params['user_location_address']    = "";
    $params['action']                   = "Check out";
    $params['entry_type']               = "Normal";
    $params['date_created']             = "";
    $params['approved_by']              = 0;
    $params['company_id']               = $company_id;
    $params['workorder_id']             = 0;
    $params['message']                  = "";

    // add clock out log
    $insert = $db->insertQuery($params, "timesheet_logs");
}
?>
