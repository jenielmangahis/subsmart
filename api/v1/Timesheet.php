<?php
include_once("includes.php");
require_once __DIR__.'/server.php';

// init
$response = "";

// CHECK AUTHORIZATION
/*if (!$server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
    $server->getResponse()->send();

    header("HTTP/1.0 403 Authorization Failed!");
    $response = array("Status" => "error", "Code" => "403", "Message" => "Authorization Failed!");
    echo json_encode($response);
} else {*/
    // get request method
    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method) {

        case 'GET':
            if (isset($_GET['company_id']) == true) {
                GET(trim($_GET["company_id"]), trim($_GET["start_date"]), trim($_GET["end_date"]));
            } else if (isset($_GET['active_user_id']) == true) {
                GET_CURRENT(trim($_GET["active_user_id"]));
            } else {
                GET(trim($_GET["user_id"]), trim($_GET["start_date"]), trim($_GET["end_date"]), "ONE");
            }
            break;
        default:
            // Unauthorized Request
            header("HTTP/1.0 401 Unauthorized");
            echo json_encode($response);
            break;
    }
//}


/***** FUNCTIONS *****/
function GET($id, $startDate, $endDate, $flag = "ALL") {
    // init array
    $team = array();

    // get all team members
    $db = new database_handler();
    $rows = $db->fetchAll("select * from timesheet_team_members where company_id = $id and status = 1 order by id asc");

    if ($flag == "ONE") {
        $rows = $db->fetchAll("select * from timesheet_team_members where user_id = $id and status = 1");
    }

    // iterate rows
    foreach ($rows as $row) {
        // get user_id
        $user_id = $row['user_id'];

        // get attendance between dates
        //$attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created between CAST('$startDate' AS DATE) AND CAST('$endDate' AS DATE) order by date_created asc");

        // check if startDate = endDate
        if ($startDate == $endDate) {
            // get attendance of specific date
            $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created like '$startDate%' order by date_created asc");
        } else {
            // get attendance between dates
            $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created between CAST('$startDate' AS DATE) AND CAST('$endDate' AS DATE) order by date_created asc");
        }

        // init array
        $data = array();

        // init vars
        $total_hours = 0.0;
        $total_break = 0.0;
        $total_overtime = 0.0;
        $total_pto = 0.0;

        // iterate rows
        foreach ($attendance as $item) {
            // get id
            $attendance_id = $item['id'];

            $total_hours += doubleval($item['shift_duration']);
            $total_break += doubleval($item['break_duration']);
            $total_overtime += doubleval($item['overtime']);

            // get logs
            $logs = $db->fetchAll("select * from timesheet_logs where attendance_id = $attendance_id order by id asc");
            $item['logs'] = $logs;
            array_push($data, $item);
        }
        // attendance
        $row['attendance'] = $data;

        // get leave
        $leave = $db->fetchAll("select tl.*, tld.date, tp.name from timesheet_leave tl, timesheet_leave_date tld, timesheet_pto tp where tl.user_id = $user_id and tp.id = tl.pto_id and tld.date between CAST('$startDate' AS DATE) AND CAST('$endDate' AS DATE)");
        // iterate rows
        foreach ($leave as $item) {
            // get total hours
            $total_pto += doubleval($item['total_hours']);
        }
        $row['leave'] = $leave;

        $row['total_hours']     = $total_hours;
        $row['total_break']     = $total_break;
        $row['total_overtime']  = $total_overtime;
        $row['total_pto']       = $total_pto;

        array_push($team, $row);
    }

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $team);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function GET_CURRENT($id) {
    // init array
    $team = array();

    // get all team members
    $db = new database_handler();
    $rows = $db->fetchAll("select * from timesheet_team_members where user_id = $id and status = 1");

    // iterate rows
    foreach ($rows as $row) {
        // get user_id
        $user_id = $row['user_id'];

        // get attendance between dates
        //$attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created like '$date%'");
        $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and status = 1 order by id desc limit 1");

        // init array
        $data = array();

        // init vars
        $total_hours = 0.0;
        $total_break = 0.0;
        $total_overtime = 0.0;
        $total_pto = 0.0;

        // iterate rows
        foreach ($attendance as $item) {
            // get id
            $attendance_id = $item['id'];

            $total_hours += doubleval($item['shift_duration']);
            $total_break += doubleval($item['break_duration']);
            $total_overtime += doubleval($item['overtime']);

            // get logs
            $logs = $db->fetchAll("select * from timesheet_logs where attendance_id = $attendance_id order by date_created asc");
            $item['logs'] = $logs;
            array_push($data, $item);
        }
        // attendance
        $row['attendance'] = $data;

        // get pto
        $leave = $db->fetchAll("select tl.*, tld.date, tp.name from timesheet_leave tl, timesheet_leave_date tld, timesheet_pto tp where tl.user_id = $user_id and tp.id = tl.pto_id and tld.date = '$date%'");
        // iterate rows
        foreach ($leave as $item) {
            // get total hours
            $total_pto += doubleval($item['total_hours']);
        }
        $row['leave'] = $leave;

        $row['total_hours']     = $total_hours;
        $row['total_break']     = $total_break;
        $row['total_overtime']  = $total_overtime;
        $row['total_pto']       = $total_pto;

        array_push($team, $row);
    }

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $team);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}



//////////
?>
