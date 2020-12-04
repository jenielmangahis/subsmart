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
                GET(trim($_GET["company_id"]));
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
    $delete = $db->executeQuery("delete from users");

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
    $delete = $db->executeQuery("delete from users where id = $id");

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
    $rows = $db->fetchAll("select *, concat(FName, ' ', LName) as full_name from users where company_id = $id");

    if ($flag == "ONE") {
        $rows = $db->fetchAll("select *, concat(FName, ' ', LName) as full_name from users where id = $id");
    }

    $data = array();

    foreach ($rows as $row) {
        // get user_id
        $user_id = $row['id'];
        // get user address
        $address = $db->fetchAll("select * from address where user_id = $user_id");
        // get user phones
        $phone = $db->fetchAll("select * from phone where user_id = $user_id");
        // iterate phones
        foreach ($phone as $item) {
            // change data type
            $phone['extensionn'] = $phone['extension'];
            // unset
            unset($phone['extension']);
        }

        // get company_id
        $company_id = $row['company_id'];
        // get company
        $company = $db->fetchRow("select *, concat('https://nsmartrac.com/', business_logo) as business_logo, concat('https://nsmartrac.com/', business_image) as business_image from business_profile where id = $company_id");

        // assign
        $row['address']         = $address;
        $row['phone']           = $phone;
        $row['company']         = $company;
        $row['notify_email']    = boolval($row['notify_email']);
        $row['notify_sms']      = boolval($row['notify_sms']);
        $row['password']        = $row['password_plain'];
        $row['menus']           = explode(", ", $row['menus']);


        // unset
        //unset($row['password']);
        unset($row['password_plain']);

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
    $params['password'] = hash("sha256", $params['password_plain']);

    $db = new database_handler();
    $insert = $db->insertQuery($params, "users");

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
    $update = $db->updateQuery($params,'users', $id,'id');

    if($update) {
        $response = array("Status" => "success", "Code" => "200", "Message" => "Updating data successful.", "Data" => $insert['inserted_id']);
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
