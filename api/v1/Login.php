<?php
include_once("includes.php");

// init
$response = "";

// get request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'GET':
        $refresh_token = trim($_GET["refresh_token"]);
        get_new_token($refresh_token);
        break;
    case 'POST':
        authenticate_user();
        break;
    default:
        // Unauthorized Request
        header("HTTP/1.0 401 Unauthorized");
        echo json_encode($response);
        break;
}


/***** FUNCTIONS *****/

function get_new_token($refresh_token) {

    if (!empty($refresh_token)) {
        // build curl request to obtain new oauth token
        $command = "curl -u admintom_admin:nSmarTrac1 https://nsmartrac.com/api/v1/token.php -d 'grant_type=refresh_token&refresh_token=$refresh_token'";
        $result = shell_exec($command);

        $response = array("Status" => "success", "Code" => 200, "Message" => "Refresh Token request successful.", "OAuth" => json_decode($result, TRUE));
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => 400, "Message" => "Invalid refresh token!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function authenticate_user() {

    $params = json_decode(file_get_contents('php://input'),true);

    $email      = $params['email'];
    $password   = $params['password'];

    $db = new database_handler();
    $row = $db->fetchRow("select * from users where email = '$email' and password_plain = '$password'");

    if ($row) {
        // build curl request to obtain oauth token
        $command = "curl -u admintom_admin:nSmarTrac1 https://nsmartrac.com/api/v1/token.php -d 'grant_type=password&username=$email&password=$password'";
        $result = shell_exec($command);

        // get user_id
        $user_id = $row['id'];
        // get user_sign
        $userSign = $db->fetchRow("select * from user_sign where user_id = $user_id");
        $userSign['show_identity']          = (bool)$userSign['show_identity'];
        $userSign['display_company_title']  = (bool)$userSign['display_company_title'];
        $userSign['display_address_phone']  = (bool)$userSign['display_address_phone'];
        $userSign['display_usage_history']  = (bool)$userSign['display_usage_history'];

        // get company_id
        $company_id = $row['company_id'];
        // get company
        $company = $db->fetchRow("select *, concat('https://nsmartrac.com/', business_logo) as business_logo, concat('https://nsmartrac.com/', business_image) as business_image from business_profile where id = $company_id");
        // get portfolio
        $portfolio = $db->fetchAll("select *, concat('https://nsmartrac.com/', path) as path from portfolio_pictures where company_id = $company_id");
        $company['portfolio'] = $portfolio;

        // assign
        $row['address']         = $address;
        $row['phone']           = $phone;
        $row['user_sign']       = $userSign;
        $row['company']         = $company;
        $row['notify_email']    = boolval($row['notify_email']);
        $row['notify_sms']      = boolval($row['notify_sms']);
        $row['password']        = $row['password_plain'];
        $row['menus']           = explode(", ", $row['menus']);

        // unset
        //unset($row['password']);
        unset($row['password_plain']);

        $response = array("Status" => "success", "Code" => 200, "Message" => "Login successful.", "OAuth" => json_decode($result, TRUE), "Data" => $row);
        header("HTTP/1.0 200 OK");

    } else {
        $response = array("Status" => "error", "Code" => 400, "Message" => "Login failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
