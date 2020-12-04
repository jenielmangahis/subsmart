<?php
/**
 * Created by PhpStorm.
 * User: jonah
 * Date: 21/09/2018
 * Time: 10:11 AM
 */

define("DSN", 'mysql:dbname=admintom_nsmart_companies;host=gator4155.hostgator.com');
define("DB_USERNAME", 'admintom_admin');
define("DB_PASSWORD", 'SmarTrac1$!');
define("CLIENT_ID", 'admintom_admin');
define("CLIENT_SECRET", 'nSmarTrac1');

ini_set('display_errors',1);
error_reporting(E_ERROR | E_PARSE);


require_once('lib/OAuth2/Autoloader.php');
OAuth2\Autoloader::register();

$storage = new OAuth2\Storage\Pdo(array('dsn' => DSN, 'username' => DB_USERNAME, 'password' => DB_PASSWORD));
$server = new OAuth2\Server($storage, array(
    'access_lifetime'           => 1209600,
    'refresh_token_lifetime'    => 2419200
));

// create the grant type to refresh token
$grantTypeR = new OAuth2\GrantType\RefreshToken($storage, array(
    'always_issue_new_refresh_token' => true
));

// add the grant type to your OAuth server
$server->addGrantType($grantTypeR);

$json = shell_exec("curl https://nsmartrac.com/api/v1/get_all_users.php");
$array = json_decode($json, TRUE);
$users = array();
foreach ($array['Data'] as $row) {
	$email      = $row['email'];
    $password   = $row['password_plain'];

    // create some users in memory
    $users[$email] = array('password' => $password);
}

// create a storage object
$storage = new OAuth2\Storage\Memory(array('user_credentials' => $users));

// create the grant type
$grantType = new OAuth2\GrantType\UserCredentials($storage);

// add the grant type to your OAuth server
$server->addGrantType($grantType);
?>
