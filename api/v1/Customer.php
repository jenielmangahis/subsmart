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
            if (isset($_GET['flag']) == "DELETE_OTHERS") {
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
    $delete = $db->executeQuery("delete from acs_profile");

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
    $delete = $db->executeQuery("delete from acs_profile where prof_id = $id");

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
    $rows = $db->fetchAll("select *, concat(first_name, ' ', last_name) as contact_name, concat(mail_add, ', ', city, ', ', state, ' ', zip_code) as contact_address from acs_profile where company_id = $id");

    if ($flag == "ONE") {
        $rows = $db->fetchAll("select *, concat(first_name, ' ', last_name) as contact_name, concat(mail_add, ', ', city, ', ', state, ' ', zip_code) as contact_address from acs_profile where prof_id = $id");
    }

    $data = array();

    foreach ($rows as $row) {
        // get id
        $customer_id = $row['prof_id'];
        // get contacts
        $contacts = $db->fetchAll("select * from contacts where customer_id = $customer_id");

        // assign
        $row['contacts']        = $contacts;
        $row['events']          = getAllEvents($customer_id);
        $row['work_orders']     = getAllWorkOrders($customer_id);
        $row['estimates']       = getAllEstimates($customer_id);
        $row['invoices']        = getAllInvoices($customer_id);
        $row['notify_email']    = boolval($row['notify_email']);
        $row['notify_sms']      = boolval($row['notify_sms']);

        array_push($data, $row);
    }

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $data);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function INSERT() {

    $params     = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $insert = $db->insertQuery($params, "acs_profile");

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

function UPDATE($id, $deleteOthers = "") {

    $params     = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $update = $db->updateQuery($params,'acs_profile', $id,'prof_id');

    if($update) {
        // check
        if ($deleteOthers == "DELETE_OTHERS") {
            // delete contacts
            $delete = $db->executeQuery("delete from contacts where customer_id = $id");
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
function getAllEvents($customer_id) {
    $data = array();

    // get all events
    $db = new database_handler();
    $events = $db->fetchAll("select * from events where customer_id = $customer_id");
    // iterate events
    foreach ($events as $event) {
        // get employee assigned
        $user_id = $event['employee_id'];
        // check
        if ($user_id > 0) {
            $employee = $db->fetchRow("select * from users where id = $user_id");

            $event['employee_name'] = $employee['FName'] ." ". $employee['LName'];
        }

        // get customer
        // check
        if ($customer_id > 0) {
            $customer = $db->fetchRow("select * from customers where id = $customer_id");
            $address = $db->fetchRow("select * from address where customer_id = $customer_id");

            $event['customer_name'] = $customer['contact_name'];
            $event['customer_email'] = $customer['contact_email'];
            $event['customer_phone'] = $customer['phone'];
            $event['customer_mobile'] = $customer['mobile'];
            $event['customer_address'] = $address['address1'] ." ". $address['address2'] ."::". $address['city'] .", ". $address['state'] ." ". $address['postal_code'];
        }

        // event type
        $event['event_type'] = ($customer_id > 0) ? "Event" : "Block";

        array_push($data, $event);
    }

    return $data;
}

function getAllWorkOrders($customer_id) {
    $data = array();
    $items = array();

    // get all work orders
    $db = new database_handler();
    $workOrder = $db->fetchAll("select * from work_orders where customer_id = $customer_id");
    // iterate
    foreach ($workOrder as $row) {
        // get employee assigned
        $user_id = $row['employee_id'];
        // check
        if ($user_id > 0) {
            $employee = $db->fetchRow("select * from users where id = $user_id");

            $row['employee_name'] = $employee['FName'] ." ". $employee['LName'];
        }

        // get customer
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

        // get items
        $work_order_id = $row['id'];
        $work_order_items = $db->fetchAll("select * from work_orders_items where work_order_id = $work_order_id");
        // iterate to get real items
        foreach ($work_order_items as $temp) {
            $item_id = $temp['items_id'];
            $item = $db->fetchRow("select * from items where id = $item_id");

            // add to array based on qty
            $qty = $temp['qty'];
            for ($x=0; $x<$qty; $x++) {
                array_push($items, $item);
            }
        }
        // assign
        $row['items'] = $items;

        // get photos
        $photos = $db->fetchAll("select *, concat('https://nsmartrac.com/', path) as path from work_orders_photo where work_order_id = $work_order_id");
        $row['photos'] = $photos;

        array_push($data, $row);
    }

    return $data;
}

function getAllEstimates($customer_id) {
    $data = array();
    $items = array();

    // get all estimates
    $db = new database_handler();
    $estimates = $db->fetchAll("select * from estimates where customer_id = $customer_id");
    // iterate
    foreach ($estimates as $row) {
        // get customer
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

        // get items
        $estimate_id = $row['id'];
        $estimate_items = $db->fetchAll("select * from estimates_items where estimates_id = $estimate_id");
        // iterate to get real items
        foreach ($estimate_items as $temp) {
            $item_id = $temp['items_id'];
            $item = $db->fetchRow("select * from items where id = $item_id");

            // add to array based on qty
            $qty = $temp['qty'];
            for ($x=0; $x<$qty; $x++) {
                array_push($items, $item);
            }
        }
        // assign
        $row['items'] = $items;

        // get photos
        $photos = $db->fetchAll("select *, concat('https://nsmartrac.com/', path) as path from estimates_photo where estimate_id = $estimate_id");
        $row['photos']  = $photos;

        array_push($data, $row);
    }

    return $data;
}

function getAllInvoices($customer_id) {
    $data = array();
    $items = array();

    // get all invoices
    $db = new database_handler();
    $invoices = $db->fetchAll("select * from invoices where customer_id = $customer_id");
    // iterate
    foreach ($invoices as $row) {
        // get customer
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

        // get items
        $invoice_id = $row['id'];
        $invoice_items = $db->fetchAll("select * from invoices_items where invoice_id = $invoice_id");
        // iterate to get real items
        foreach ($invoice_items as $temp) {
            $item_id = $temp['items_id'];
            $item = $db->fetchRow("select * from items where id = $item_id");

            // add to array based on qty
            $qty = $temp['qty'];
            for ($x=0; $x<$qty; $x++) {
                array_push($items, $item);
            }
        }
        // assign
        $row['items'] = $items;

        // get payment schedules
        $payment_schedules = $db->fetchAll("select * from invoices_payment_schedule where invoice_id = $invoice_id");
        $row['payment_schedules'] = $payment_schedules;

        // get photos
        $photos = $db->fetchAll("select *, concat('https://nsmartrac.com/', path) as path from invoices_photo where invoice_id = $invoice_id");
        $row['photos'] = $photos;

        array_push($data, $row);
    }

    return $data;
}
?>
