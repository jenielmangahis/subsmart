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
                GET(trim($_GET["id"]), 0, "ONE");
            } else if (isset($_GET['user_id']) == true) {
                GET(trim($_GET["id"]), trim($_GET["user_id"]), "MINE");
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
    $delete = $db->executeQuery("delete from filevault");

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
    $delete = $db->executeQuery("delete from filevault where folder_id = $id");

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

function GET($id, $user_id = 0, $flag = "ALL") {
    // curl
    $db = new database_handler();
    // get root directory
    $row = $db->fetchRow("select * from business_profile where id = $id");
    $root = $row['folder_name'];

    // get files
    $rows = $db->fetchAll("select *, concat('https://nsmartrac.com/uploads/', '$root', file_path) as file_path from filevault where folder_id = $id");

    if ($flag == "ONE") {
        $rows = $db->fetchAll("select *, concat('https://nsmartrac.com/uploads/', '$root', file_path) as file_path from filevault where file_id = $id");
    }  else if ($flag == "MINE") {
        $rows = $db->fetchAll("select *, concat('https://nsmartrac.com/uploads/', '$root', file_path) as file_path from filevault where folder_id = $id and user_id = $user_id");
    }

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $rows);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function INSERT() {
    // get id
    $target_dir = $_POST['target_dir'];
    $path       = $_POST['path'];
    $file       = $_FILES["file"];

    // check
    if(!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_dir = $target_dir . "/" . basename($file["name"]);

    if (move_uploaded_file($file["tmp_name"], $target_dir)) {
        // $params
        $params['title']        = $file["name"];
        $params['file_path']    = $path.$file["name"];
        $params['file_size']    = $file['size'];
        $params['folder_id']    = $_POST['folder_id'];
        $params['user_id']      = $_POST['user_id'];
        $params['company_id']   = $_POST['company_id'];

        // save to db
        $db = new database_handler();
        $insert = $db->insertQuery($params, "filevault");

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

function UPDATE($id) {

    $params = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $update = $db->updateQuery($params,'filevault', $id,'file_id');

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

?>
