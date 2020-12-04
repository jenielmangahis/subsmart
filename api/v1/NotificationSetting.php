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
    $row = $db->fetchRow("select * from notification_settings where company_id = $id");

    // typecast correctly
    $row['notify_email']                                        = (bool)$row['notify_email'];
    $row['notify_sms']                                          = (bool)$row['notify_sms'];
    $row['notify_residential_when_scheduling']                  = (bool)$row['notify_residential_when_scheduling'];
    $row['notify_residential_during_rescheduling_cancelling']   = (bool)$row['notify_residential_during_rescheduling_cancelling'];
    $row['set_default_commercial_value_as_residential']         = (bool)$row['set_default_commercial_value_as_residential'];
    $row['notify_commercial_when_scheduling']                   = (bool)$row['notify_commercial_when_scheduling'];
    $row['notify_commercial_during_rescheduling_cancelling']    = (bool)$row['notify_commercial_during_rescheduling_cancelling'];
    $row['copy_when_sending_estimate']                          = (bool)$row['copy_when_sending_estimate'];
    $row['copy_when_sending_invoice']                           = (bool)$row['copy_when_sending_invoice'];
    $row['notify_when_employees_arrive']                        = (bool)$row['notify_when_employees_arrive'];
    $row['notify_tenant_from_service_address']                  = (bool)$row['notify_tenant_from_service_address'];

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
    $row = $db->fetchRow("select count(*) as count from notification_settings where company_id = $id");
    //
    if ($row['count'] == 1) {
        // update
        $update = $db->updateQuery($params,'notification_settings', $id,'company_id');
    } else {
        // insert
        $insert = $db->insertQuery($params, "notification_settings");
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
