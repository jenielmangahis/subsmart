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
    $delete = $db->executeQuery("delete from work_order_types");

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
    $delete = $db->executeQuery("delete from work_order_types where id = $id");

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
    $rows = $db->fetchAll("select * from work_order_types where company_id = $id");

    $data = array();
    $items = array();

    foreach ($rows as $row) {
        // get id
        $type_id = $row['id'];

        // get template
        $template = $db->fetchAll("select *, concat('https://nsmartrac.com/', before_signature) as before_signature, concat('https://nsmartrac.com/', after_signature) as after_signature, concat('https://nsmartrac.com/', owner_signature) as owner_signature, concat('https://nsmartrac.com/', company_representative_signature) as company_representative_signature, concat('https://nsmartrac.com/', primary_account_holder_signature) as primary_account_holder_signature, concat('https://nsmartrac.com/', secondary_account_holder_signature) as secondary_account_holder_signature from work_order_templates where work_order_type_id = $type_id limit 1");

        // check
        if (count($template) == 1) {
            // get employee assigned
            $user_id = $template[0]['employee_id'];
            // check
            if ($user_id > 0) {
                $employee = $db->fetchRow("select * from users where id = $user_id");

                $template[0]['employee_name'] = $employee['FName'] ." ". $employee['LName'];
            }

            // get customer
            $customer_id = $template[0]['customer_id'];
            // check
            if ($customer_id > 0) {
                $customer = $db->fetchRow("select * from customers where id = $customer_id");
                $address = $db->fetchRow("select * from address where customer_id = $customer_id");

                $template[0]['customer_name'] = $customer['contact_name'];
                $template[0]['customer_email'] = $customer['contact_email'];
                $template[0]['customer_phone'] = $customer['phone'];
                $template[0]['customer_mobile'] = $customer['mobile'];
                $template[0]['customer_address'] = $address['address1'] ." ". $address['address2'] ."::". $address['city'] .", ". $address['state'] ." ". $address['postal_code'];
            }

            // get items
            $work_order_id = $row['id'];
            $work_order_items = $db->fetchAll("select * from work_orders_items where work_order_id = $work_order_id");
            // iterate to get real items
            foreach ($work_order_items as $temp) {
                $item_id = $temp['items_id'];
                $item = $db->fetchRow("select * from items where id = $item_id");

                $item['descriptionn']    = $item['description'];
                $item['cost_per']        = $item['cost per'];

                // unset
                unset($item['description']);
                unset($item['cost per']);

                // add to array based on qty
                $qty = $temp['qty'];
                for ($x=0; $x<$qty; $x++) {
                    array_push($items, $item);
                }
            }
            // assign
            $template[0]['items'] = $items;

            // get photos
            $photos = $db->fetchAll("select *, concat('https://nsmartrac.com/', path) as path from work_orders_photo where work_order_id = $work_order_id");
            $template[0]['photos'] = $photos;

            // assign
            $row['template'] = $template[0];
        }

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
    $insert = $db->insertQuery($params, "work_order_types");

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
    $update = $db->updateQuery($params,'work_order_types', $id,'id');

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
