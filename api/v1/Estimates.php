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
            if (isset($_GET['flag']) == "DELETE_ITEMS") {
                UPDATE(trim($_GET["id"]), trim($_GET['flag']));
            } else {
                UPDATE(trim($_GET["id"]));
            }
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
    $delete = $db->executeQuery("delete from estimates");

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
    // get signature
    $rows = $db->fetchAll("select * from estimates where id = $id");
    $path =  "/home4/admintommy/public_html/".$rows[0]['signature'];

    // delete
    $delete = $db->executeQuery("delete from estimates where id = $id");

    if($delete) {
        // delete signature
        unlink($path);

        // delete items
        $delete2 = $db->executeQuery("delete from estimates_items where estimates_id = $id");

        // get photos
        $photos = $db->fetchAll("select * from estimates_photo where estimate_id = $id");
        // iterate
        foreach ($photos as $photo) {
            // get path
            $path = "/home4/admintommy/public_html/".$photo['path'];
            // delete path
            unlink($path);
        }

        // delete photos
        $delete3 = $db->executeQuery("delete from estimates_photo where estimate_id = $id");

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
    $rows = $db->fetchAll("select *, concat('https://nsmartrac.com/', signature) as signature from estimates where company_id = $id");

    if ($flag == "ONE") {
        $rows = $db->fetchAll("select *, concat('https://nsmartrac.com/', signature) as signature from estimates where id = $id");
    }

    // init data array
    $data = array();

    foreach ($rows as $row) {
        // get customer
        $customer_id = $row['customer_id'];
        // check
        if ($customer_id > 0) {
            $customer = $db->fetchRow("select * from customers where id = $customer_id");
            $address = $db->fetchRow("select * from address where customer_id = $customer_id");

            $row['customer_name'] = $customer['contact_name'];
            $row['customer_email'] = $customer['contact_email'];
            $row['customer_phone'] = $customer['phone'];
            $row['customer_mobile'] = $customer['mobile'];
            $row['customer_address'] = $address['address1'] ." ". $address['address2'] ."::". $address['city'] .", ". $address['state'] ." ". $address['postal_code'];
        }

        // init items array
        $items = array();

        // get items
        $estimate_id = $row['id'];
        $estimate_items = $db->fetchAll("select * from estimates_items where estimates_id = $estimate_id");
        // iterate to get real items
        foreach ($estimate_items as $temp) {
            $item_id = $temp['items_id'];
            $item = $db->fetchRow("select * from items where id = $item_id");

            $item['descriptionn']    = $item['description'];
            $item['cost_per']        = $item['cost per'];
            $item['option_message']  = $temp['option_message'];

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
        $row['items']   = $items;

        // get photos
        $photos = $db->fetchAll("select *, concat('https://nsmartrac.com/', path) as path from estimates_photo where estimate_id = $estimate_id");
        $row['photos']  = $photos;

        array_push($data, $row);
    }

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $data);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function INSERT() {

    $params = json_decode(file_get_contents('php://input'), true);

    $db = new database_handler();
    $insert = $db->insertQuery($params, "estimates");


    if($insert) {
        // get company_id
        $company_id = $params['company_id'];
        // get invoice number
        $number = explode("-", $params['estimate_number']);
        // update estimate number
        $estimate_settings['estimate_num_next'] = (int)$number[1] + 1;
        $update = $db->updateQuery($estimate_settings, 'estimate_settings', $company_id,'company_id');


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

function UPDATE($id, $deleteItems = "") {

    $params = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $update = $db->updateQuery($params,'estimates', $id,'id');

    if($update) {
        // check
        if ($deleteItems == "DELETE_ITEMS") {
            // delete estimate_items
            $delete = $db->executeQuery("delete from estimates_items where estimates_id = $id");
        }

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
