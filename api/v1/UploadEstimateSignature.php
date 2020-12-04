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

    //$params             = json_decode(file_get_contents('php://input'),true);
    $id                     = $_POST['estimate_id'];
    $company_id             = $_POST['company_id'];
    $params['signature']    = "uploads/Signatures/" . $company_id . "/" . $_FILES["file"]["name"];
    $params['sign_date']    = date('Y-m-d');

    $target_dir = "/home4/admintommy/public_html/uploads/Signatures/" . $company_id;
    // check
    if(!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_dir = $target_dir . "/" . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir)) {
        // save to db
        $db = new database_handler();
        $update = $db->updateQuery($params,'estimates', $id,'id');

        if($update) {
            $response = array("Status" => "success", "Code" => 200, "Message" => "Adding data successful.");
            header("HTTP/1.0 200 OK");
        } else {
            $response = array("Status" => "error", "Code" => 400, "Message" => "Adding data failed!");
            header("HTTP/1.0 400 Bad Request");
        }
    } else {
        $response = array("Status" => "error", "Code" => 400, "Message" => "Uploading image failed!", "Params" => $params, "File" => $_FILES);
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>
