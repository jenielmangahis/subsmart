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
    $row = $db->fetchRow("select * from invoice_settings where company_id = $id");

    // typecast correctly
    $row['accept_credit_card']          = (bool)$row['accept_credit_card'];
    $row['accept_check']                = (bool)$row['accept_check'];
    $row['accept_cash']                 = (bool)$row['accept_cash'];
    $row['accept_direct_deposit']       = (bool)$row['accept_direct_deposit'];
    $row['accept_credit']               = (bool)$row['accept_credit'];
    $row['capture_customer_signature']  = (bool)$row['capture_customer_signature'];
    $row['hide_item_price']             = (bool)$row['hide_item_price'];
    $row['hide_item_qty']               = (bool)$row['hide_item_qty'];
    $row['hide_item_tax']               = (bool)$row['hide_item_tax'];
    $row['hide_item_discount']          = (bool)$row['hide_item_discount'];
    $row['hide_item_total']             = (bool)$row['hide_item_total'];
    $row['accept_tip']                  = (bool)$row['accept_tip'];
    $row['auto_convert_completed_work_order']   = (bool)$row['auto_convert_completed_work_order'];

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
    $row = $db->fetchRow("select count(*) as count from invoice_settings where company_id = $id");
    //
    if ($row['count'] == 1) {
        // update
        $update = $db->updateQuery($params,'invoice_settings', $id,'company_id');
    } else {
        // insert
        $insert = $db->insertQuery($params, "invoice_settings");
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
