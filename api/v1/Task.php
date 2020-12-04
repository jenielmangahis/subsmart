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
    $delete = $db->executeQuery("delete from tasks");

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
    $delete = $db->executeQuery("delete from tasks where task_id = $id");

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

function GET($id) {
    // curl
    $db = new database_handler();
    $rows = $db->fetchAll("select t.*, ts.status_text as status_name, ts.status_color from tasks t, tasks_status ts where t.company_id = $id and t.status_id = ts.status_id");

    $data = array();
    $participants = array();

    foreach ($rows as $row) {
        // get task_id
        $task_id = $row['task_id'];

        // get participants
        $rows2 = $db->fetchAll("select tp.*, concat(u.FName, ' ', u.LName) as full_name from tasks_participants tp, users u where tp.task_id = $task_id and u.id = tp.user_id");
        // iterate
        foreach ($rows2 as $item) {
            $item['is_assigned'] = (bool)$item['is_assigned'];

            unset($item['task_id']);

            array_push($participants, $item);
        }

        //assign
        $row['participants']    = $participants;
        $row['descriptionn']    = $row['description'];

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
    $insert = $db->insertQuery($params, "tasks");

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
    $update = $db->updateQuery($params,'tasks', $id,'task_id');

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
