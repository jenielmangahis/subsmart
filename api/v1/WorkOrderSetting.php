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
            GET(trim($_GET["company_id"]));
            break;
        case 'PUT':
            UPDATE(trim($_GET["company_id"]));
            break;
        default:
            // Unauthorized Request
            header("HTTP/1.0 401 Unauthorized");
            echo json_encode($response);
            break;
    }
//}


/***** FUNCTIONS *****/
function GET($id) {
    // curl
    $db = new database_handler();
    $row = $db->fetchRow("select * from work_order_settings where company_id = $id");

    // typecast correctly
    $row['capture_customer_signature'] = (bool)$row['capture_customer_signature'];

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $row);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function UPDATE($id) {

    $params = json_decode(file_get_contents('php://input'),true);

    // check first
    $db = new database_handler();
    $row = $db->fetchRow("select count(*) as count from work_order_settings where company_id = $id");
    //
    if ($row['count'] == 1) {
        // update
        $update = $db->updateQuery($params,'work_order_settings', $id,'company_id');
    } else {
        // insert
        $insert = $db->insertQuery($params, "work_order_settings");
    }


    if($insert || $update) {
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
