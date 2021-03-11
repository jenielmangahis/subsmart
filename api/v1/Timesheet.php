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
        case 'POST':
            INSERT();
            break;
        case 'PUT':
            UPDATE(trim($_GET["id"]));
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

            // update attendance date_created
            //$params['date_created'] = $logs[0]['date_created'];
            //$update = $db->updateQuery($params,'timesheet_attendance', $attendance_id,'id');
            //$item['date_created'] = $logs[0]['date_created'];

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

    // get team
    $team = GET_USER_TIMESHEET($id);

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $team);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function INSERT() {

    $params = json_decode(file_get_contents('php://input'),true);
    $attendance     = $params['attendance'];
    $log            = $params['log'];
    $user_id        = $params['user_id'];
    $message        = $params['message'];
    $company_id     = $params['company_id'];


    // insert attendance
    $db = new database_handler();
    $insert = $db->insertQuery($attendance, "timesheet_attendance");

    if($insert) {
        // log
        $id = $insert['inserted_id'];
        $log['attendance_id'] = $id;
        // insert log
        $insert2 = $db->insertQuery($log, "timesheet_logs");

        // check
        if($insert2) {
            // check if message is not empty
            if (!empty($message)) {

                // init array
                $iOSRegIds = array();
                $androidRegIds = array();

                // get admin details from team member
                $rows = $db->fetchAll("select tm.*, u.device_token, u.device_type from timesheet_team_members tm, users u where tm.company_id = $company_id and tm.role = 'Admin' and u.id = tm.user_id and u.id != $user_id");
                // iterate
                foreach ($rows as $row) {
                    // get token
                    $token = $row['device_token'];

                    // check device_type
                    if ($row['device_type'] == 'iOS') {
                        // add device_token
                        array_push($iOSRegIds,  $token);
                    } else {
                        // add device_token
                        array_push($androidRegIds,  $token);
                    }
                }

                // send the push
                $ios = send_ios_push($iOSRegIds, "Time Clock Alert", $message);
                $android = send_android_push($androidRegIds, "Time Clock Alert", $message);
            }

            // get user timesheet
            $userTimesheet = GET_USER_TIMESHEET($user_id);

            $response = array("Status" => "success", "Code" => 200, "Message" => "Adding data successful.", "Data" => $userTimesheet);
            header("HTTP/1.0 200 OK");
        } else {
            $response = array("Status" => "error", "Code" => 400, "Message" => "There was an unexpected error occur!");
            header("HTTP/1.0 400 Bad Request");
        }
    } else {
        $response = array("Status" => "error", "Code" => 400, "Message" => "Adding data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function UPDATE($id) {

    $params = json_decode(file_get_contents('php://input'),true);
    $attendance     = $params['attendance'];
    $log            = $params['log'];
    $user_id        = $params['user_id'];
    $message        = $params['message'];
    $company_id     = $params['company_id'];

    $db = new database_handler();
    $update = $db->updateQuery($attendance,'timesheet_attendance', $id,'id');

    if($update) {
        // insert log
        $insert = $db->insertQuery($log, "timesheet_logs");

        // check
        if($insert) {
            // check if message is not empty
            if (!empty($message)) {

                // init array
                $iOSRegIds = array();
                $androidRegIds = array();

                // get admin details from team member
                $rows = $db->fetchAll("select tm.*, u.device_token, u.device_type from timesheet_team_members tm, users u where tm.company_id = $company_id and tm.role = 'Admin' and u.id = tm.user_id and u.id != $user_id");
                // iterate
                foreach ($rows as $row) {
                    // get token
                    $token = $row['device_token'];

                    // check device_type
                    if ($row['device_type'] == 'iOS') {
                        // add device_token
                        array_push($iOSRegIds,  $token);
                    } else {
                        // add device_token
                        array_push($androidRegIds,  $token);
                    }
                }

                // send the push
                $ios = send_ios_push($iOSRegIds, "Time Clock Alert", $message);
                $android = send_android_push($androidRegIds, "Time Clock Alert", $message);
            }

            // get user timesheet
            $userTimesheet = GET_USER_TIMESHEET($user_id);

            $response = array("Status" => "success", "Code" => 200, "Message" => "Adding data successful.", "Data" => $userTimesheet);
            header("HTTP/1.0 200 OK");
        } else {
            $response = array("Status" => "error", "Code" => 400, "Message" => "There was an unexpected error occur!");
            header("HTTP/1.0 400 Bad Request");
        }

    } else {
        $response = array("Status" => "error", "Code" => "400", "Message" => "Updating data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function GET_USER_TIMESHEET($id) {
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
            $logs = $db->fetchAll("select * from timesheet_logs where attendance_id = $attendance_id order by id desc");
            $item['logs'] = $logs;

            // update attendance date_created
            //$params['date_created'] = $logs[0]['date_created'];
            //$update = $db->updateQuery($params,'timesheet_attendance', $attendance_id,'id');
            //$item['date_created'] = $logs[0]['date_created'];

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

    return $team;
}



//////////
?>
