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

        case 'DELETE':
			$flag	= trim($_GET["flag"]); // ALL

			if ($flag == "ALL") {
				DELETE_ALL();
			} else {
                DELETE(trim($_GET["id"]));
            }
            break;
        case 'GET':
            if (isset($_GET['id']) == true) {
                GET(trim($_GET["id"]), "ONE");
            } else {
                GET(trim($_GET["user_id"]));
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
function DELETE_ALL() {

    $db = new database_handler();
    $delete = $db->executeQuery("delete from timesheet_logs");

    if($delete) {
        $response = array("Status" => "success", "Code" => "200", "Message" => "Deleting all data successful.");
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => "400", "Message" => "Deleting all data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function DELETE($id) {

    $db = new database_handler();
    $delete = $db->executeQuery("delete from timesheet_logs where id = $id");

    if($delete) {
        $response = array("Status" => "success", "Code" => "200", "Message" => "Deleting data successful.");
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => "400", "Message" => "Deleting data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function GET($id, $flag = "ALL") {
    // curl
    $db = new database_handler();
    $rows = $db->fetchAll("select * from timesheet_logs where user_id = $id order by id asc");

    if ($flag == "ONE") {
        $rows = $db->fetchAll("select * from timesheet_logs where id = $id");
    }

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $rows);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function INSERT() {

    $params = json_decode(file_get_contents('php://input'),true);
    $company_id = $params['company_id'];
    $user_id = $params['user_id'];
    $message = $params['message'];
    unset($params['message']);

    $db = new database_handler();
    $insert = $db->insertQuery($params, "timesheet_logs");

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

        $response = array("Status" => "success", "Code" => 200, "Message" => "Adding data successful.", "iOS Push" => $ios, "Android Push" => $android);
        header("HTTP/1.0 200 OK");
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

    $db = new database_handler();
    $update = $db->updateQuery($params,'timesheet_logs', $id,'id');

    if($update) {
        $response = array("Status" => "success", "Code" => "200", "Message" => "Updating data successful.");
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => "400", "Message" => "Updating data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}



//////////
?>
