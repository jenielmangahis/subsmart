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
    $delete = $db->executeQuery("delete from portfolio_pictures");

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

    // get file
    $db = new database_handler();
    $row = $db->fetchRow("select * from portfolio_pictures where id = $id");
    $path = "/home4/admintommy/public_html/".$row['path'];

    // delete
    $delete = $db->executeQuery("delete from portfolio_pictures where id = $id");

    if($delete) {
        // delete file
        unlink($path);

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

function GET($company_id) {
    // curl
    $db = new database_handler();
    $rows = $db->fetchAll("select *, concat('https://nsmartrac.com/', path) as path from portfolio_pictures where company_id = $company_id");

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $rows);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function INSERT() {

    //$params             = json_decode(file_get_contents('php://input'),true);
    $company_id             = $_POST['company_id'];
    $params['path']         = "uploads/PortfolioPictures/" . $company_id . "/" . $_FILES["file"]["name"];
    $params['caption']      = "";
    $params['company_id']   = $company_id;

    $target_dir = "/home4/admintommy/public_html/uploads/PortfolioPictures/" . $company_id;
    // check
    if(!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_dir = $target_dir . "/" . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir)) {
        // save to db
        $db = new database_handler();
        $insert = $db->insertQuery($params, "portfolio_pictures");

        if($insert) {
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

function UPDATE($id) {

    $params = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $update = $db->updateQuery($params,'portfolio_pictures', $id,'id');

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
