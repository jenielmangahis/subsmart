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
            GET(trim($_GET["company_id"]));
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
    $delete = $db->executeQuery("delete from events");

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
    $delete = $db->executeQuery("delete from events where id = $id");

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

function GET($id) {
    // curl
    $db = new database_handler();
    $rows = $db->fetchAll("select * from events where company_id = $id");

    $data = array();

    foreach ($rows as $row) {
        // get employee assigned
        $user_id = $row['employee_id'];
        // check
        if ($user_id > 0) {
            $employee = $db->fetchRow("select * from users where id = $user_id");

            $row['employee_name'] = $employee['FName'] ." ". $employee['LName'];
        }

        // get customer
        $customer_id = $row['customer_id'];
        // check
        if ($customer_id > 0) {
            $customer = $db->fetchRow("select *, concat(first_name, ' ', last_name) as contact_name, concat(mail_add, '::', city, ', ', state, ' ', zip_code) as contact_address from acs_profile where prof_id = $customer_id");

            $row['customer_name'] = $customer['contact_name'];
            $row['customer_email'] = $customer['email'];
            $row['customer_phone'] = $customer['phone_h'];
            $row['customer_mobile'] = $customer['phone_m'];
            $row['customer_address'] = $customer['contact_address'];
        }

        // get created_by_name
        $created_by = $row['created_by'];
        // check
        if ($created_by > 0) {
            $user = $db->fetchRow("select * from users where id = $created_by");
            $row['created_by_name'] = $user['FName'] ." ". $user['LName'];
        }

        // event type
        $row['event_type'] = ($customer_id > 0) ? "Event" : "Block";

        array_push($data, $row);
    }

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $data);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function INSERT() {

    $params = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $insert = $db->insertQuery($params, "events");

    if($insert) {
        $response = array("Status" => "success", "Code" => 200, "Message" => "Adding data successful.");
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

    $params     = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $update = $db->updateQuery($params,'events', $id,'id');

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
