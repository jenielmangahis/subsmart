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
            } else if (isset($_GET['user_id']) == true) {
                GET(trim($_GET["user_id"]), "MINE");
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
    $delete = $db->executeQuery("delete from file_folders");

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
    $delete = $db->executeQuery("delete from file_folders where folder_id = $id");

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
    // get root directory
    $row = $db->fetchRow("select * from business_profile where id = $id");
    $root = $row['folder_name'];

    // get folders
    $rows = $db->fetchAll("select *, concat('/home4/admintommy/public_html/uploads/', '$root', path) as mPath from file_folders where parent_id = 0 and category_id = 0 and company_id = $id");

    if ($flag == "ONE") {
        $rows = $db->fetchAll("select *, concat('/home4/admintommy/public_html/uploads/', '$root', path) as mPath from file_folders where folder_id = $id");
    } else if ($flag == "MINE") {
        $rows = $db->fetchAll("select *, concat('/home4/admintommy/public_html/uploads/', '$root', path) as mPath from file_folders where parent_id = 0 and created_by = $id");
    }

    $data = array();

    // iterate
    foreach ($rows as $row) {
        $row = array_map('utf8_encode', $row);
        // get folder_id
        $folder_id = $row['folder_id'];

        // assign
        $row['descriptionn']    = $row['description'];
        $row['type']            = "Folder";
        $row['subfolder']       = GET_SUBFOLDER($folder_id, $root);
        $row['files']           = GET_FILES($folder_id, $root);

        // unset
        unset($row['description']);

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
    $insert = $db->insertQuery($params, "file_folders");

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

    $params = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $update = $db->updateQuery($params,'file_folders', $id,'folder_id');

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
function GET_SUBFOLDER($parent_id, $root, $user_id = 0) {
    // build query
    $db = new database_handler();
    $rows = $db->fetchAll("select *, concat('/home4/admintommy/public_html/uploads/', '$root', path) as mPath from file_folders where parent_id = $parent_id");

    if ($user_id > 0) {
        $rows = $db->fetchAll("select *, concat('/home4/admintommy/public_html/uploads/', '$root', path) as mPath from file_folders where parent_id = $parent_id and created_by = $user_id");
    }

    $data = array();

    // iterate
    foreach ($rows as $row) {
        $row = array_map('utf8_encode', $row);
        // get folder_id
        $folder_id = $row['folder_id'];

        // assign
        $row['descriptionn']    = $row['description'];
        $row['type']            = "Sub-Folder";
        $row['files']           = GET_FILES($folder_id, $root);

        // unset
        unset($row['description']);

        array_push($data, $row);
    }

    return $data;
}

function GET_FILES($folder_id, $root, $user_id = 0) {
    // build query
    $db = new database_handler();
    $files = $db->fetchAll("select *, concat('https://nsmartrac.com/uploads/', '$root', file_path) as file_path from filevault where folder_id = $folder_id");

    if ($user_id > 0) {
        $files = $db->fetchAll("select *, concat('https://nsmartrac.com/uploads/', '$root', file_path) as file_path from filevault where folder_id = $folder_id and user_id = $user_id");
    }

    return $files;
}
?>
