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

        case 'POST':
            INSERT();
            break;
        default:
            // Unauthorized Request
            header("HTTP/1.0 401 Unauthorized");
            echo json_encode($response);
            break;
    }
//}


/***** FUNCTIONS *****/
function INSERT() {
    // get id
    $id = $_POST['company_id'];
    $file = $_FILES["file"];

    $target_dir = "/home4/admintommy/public_html/uploads/eSign/" . $company_id;
    // check
    if(!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_dir = $target_dir . "/" . basename($file["name"]);

    if (move_uploaded_file($file["tmp_name"], $target_dir)) {
        // $params
        $params['signature_image'] = "uploads/eSign/" . $company_id . "/" . $_FILES["file"]["name"];
        // save to db
        $db = new database_handler();
        $update = $db->updateQuery($params,'user_sign', $id,'id');

        if($insert) {
            $response = array("Status" => "success", "Code" => 200, "Message" => "Adding data successful.");
            header("HTTP/1.0 200 OK");
        } else {
            $response = array("Status" => "error", "Code" => 400, "Message" => "Adding data failed!");
            header("HTTP/1.0 400 Bad Request");
        }
    } else {
        $response = array("Status" => "error", "Code" => 400, "Message" => "Uploading image failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>
