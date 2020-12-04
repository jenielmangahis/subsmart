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
    $delete = $db->executeQuery("delete from user_docfile where id = $id");

    if($delete) {
        // delete recipients
        $delete2 = $db->executeQuery("delete from user_docfile_recipients where docfile_id = $id");
        // delete files
        $delete2 = $db->executeQuery("delete from user_docfile_documents where docfile_id = $id");

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
    // get company_id
    $company_id = $id;

    // curl
    $db = new database_handler();
    $rows = $db->fetchAll("select ud.*, concat(u.FName, ' ', u.LName) as full_name from user_docfile ud, users u where ud.company_id = $id and u.id = ud.user_id order by id desc");

    if ($flag == "ONE") {
        $rows = $db->fetchAll("select ud.*, concat(u.FName, ' ', u.LName) as full_name from user_docfile ud, users u where ud.id = $id and u.id = ud.user_id");
    }

    $data = array();

    // iterate
    foreach ($rows as $row) {
        $row = array_map('utf8_encode', $row);
        // get doc_id and user_id
        $doc_id = $row['id'];
        $user_id = $row['user_id'];
        $company_id = $row['company_id'];

        // assign
        $row['files']       = GET_FILES($doc_id);
        $row['recipients']  = GET_RECIPIENTS($doc_id);

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
    $insert = $db->insertQuery($params, "user_docfile");

    if($insert) {
        $response = array("Status" => "success", "Code" => 200, "Message" => "Adding data successful.", "Data" => $insert['inserted_id']);
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
    $update = $db->updateQuery($params,'user_docfile', $id,'id');

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
function GET_RECIPIENTS($doc_id) {
    // build query
    $db = new database_handler();
    $rows = $db->fetchAll("select * from user_docfile_recipients where docfile_id = $doc_id");

    return $rows;
}

function GET_FILES($doc_id) {
    // build query
    $db = new database_handler();
    $rows = $db->fetchAll("select *, concat('https://nsmartrac.com', path) as path from user_docfile_documents where docfile_id = $doc_id");

    return $rows;
}

?>
