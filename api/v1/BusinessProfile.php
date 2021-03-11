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
    $row = $db->fetchRow("select * from business_profile where id = $id");

    // typecast correctly
    $row['is_emergency_support']        = (bool)$row['is_emergency_support'];
    $row['is_subcontract_allowed']      = (bool)$row['is_subcontract_allowed'];
    $row['is_public_phone']             = (bool)$row['is_public_phone'];
    $row['is_public_office_phone']      = (bool)$row['is_public_office_phone'];
    $row['is_business_insured']         = (bool)$row['is_business_insured'];
    $row['is_bonded']                   = (bool)$row['is_bonded'];
    $row['is_licensed']                 = (bool)$row['is_licensed'];
    $row['is_bbb_accredited']           = (bool)$row['is_bbb_accredited'];
    $row['is_phone_verified']           = (bool)$row['is_phone_verified'];
    $row['is_email_verified']           = (bool)$row['is_email_verified'];
    $row['is_facebook_connected']       = (bool)$row['is_facebook_connected'];
    $row['is_google_connected']         = (bool)$row['is_google_connected'];
    $row['nsmart_plans_is_auto_renew']  = (bool)$row['nsmart_plans_is_auto_renew'];

    // get nsmart_plans_id
    $plan_id = $row['nsmart_plans_id'];
    // get plan details
    $row2 = $db->fetchRow("select * from nsmart_plans where nsmart_plans_id = $plan_id");
    $row['nsmart_plans_name']   = $row2['plan_name'];
    $row['nsmart_plans_price']  = $row2['price'];

    // get portfolio
    $portfolio = $db->fetchAll("select *, concat('https://nsmartrac.com/', path) as path from portfolio_pictures where company_id = $company_id");
    $row['portfolio'] = $portfolio;

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $row);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function UPDATE($id) {

    $params = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $update = $db->updateQuery($params,'business_profile', $id,'id');

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
