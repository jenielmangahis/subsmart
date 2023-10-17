<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  API Connectors Credentials
| -------------------------------------------------------------------
*/

$config['google_contact_client_id']       = '950446991520-9rhd2to0sb00tq9v10vb9ucf9mesisn2.apps.googleusercontent.com';
$config['google_contact_client_secret']   = 'ygHmmO7gZ2lVzsK5ft7-1OnI';
$config['google_contact_redirect_url']    = 'http://nsmartrac.org/tools/api_google_contacts';

/*$config['qb_client_id']       = 'ABKxVifUuZJQlWQicGT4ZoF1vWhDgcjZ7vVFkmgGXOzO9cljn2';
$config['qb_client_secret']       = 'lbQD1t129fyCzeLgPTPlHqtteXA66Jc7xMDcS2xt';*/
//$config['qb_redirect_uri']       = 'https://nsmartrac.org/tools/quickbooks';

//QB Development
/*$config['qb_client_id']     = 'AB8v4ZI2taAp4pMFdPazPReIe2nFvb5NwV5ebgeXkR1tl0DtAY';
$config['qb_client_secret'] = '1q73wP26tjtVxwQIzmTuzBtHwR3In8DsHxd4QMOq';
$config['qb_redirect_uri']  = 'https://nsmartrac.com/tools/quickbooks_connect';
$config['qb_auth_scope']    = 'com.intuit.quickbooks.accounting openid profile email phone address';
$config['qb_base_url']      = 'development';
*/

//QB Production
$config['qb_client_id']     = 'ABxTY4sNiuXKKTPvPsFuUE6dne41fWAu0yoD9zMJIPiTOfPpP2';
$config['qb_client_secret'] = 'OZ9fkgH5iu7qV1RkxcQGqbpE5rl6Zbr5Y1Oo7khJ';
$config['qb_redirect_uri']  = 'https://nsmartrac.com/tools/quickbooks_connect';
$config['qb_auth_scope']    = 'com.intuit.quickbooks.accounting openid profile email phone address';
$config['qb_base_url']      = 'production';

//Mailchimp Development
/*$config['mailchimp_client_id']     = '567134062530';
$config['mailchimp_client_secret'] = 'ded9c4026750c337c60af890acfb6f21f667f691a2c9a43df8';
$config['mailchimp_redirect_uri']  = 'http://127.0.0.1/ci/nsmart_v2/tools/mailchimp_api_save';
$config['mailchimp_token_url']     = 'https://login.mailchimp.com/oauth2/token';
$config['mailchimp_metadata_url']  = 'https://login.mailchimp.com/oauth2/metadata';*/

//Mailchimp Production
$config['mailchimp_client_id']     = '567134062530';
$config['mailchimp_client_secret'] = 'ded9c4026750c337c60af890acfb6f21f667f691a2c9a43df8';
$config['mailchimp_redirect_uri']  = 'https://nsmartrac.com/tools/mailchimp_api_save';
$config['mailchimp_token_url']     = 'https://login.mailchimp.com/oauth2/token';
$config['mailchimp_metadata_url']  = 'https://login.mailchimp.com/oauth2/metadata';

$config['zap_deploy_key']       = '2953c9edb8587c6eaed8025b818e3c85';

//Square Payment
//Sandbox
$config['square_connect_url']   = 'https://connect.squareupsandbox.com';
$config['square_client_id']     = 'sandbox-sq0idb-_QITXE8-SXhp_NdfL99Vdw';
$config['square_client_secret'] = 'sandbox-sq0csb-2epY30G07Fj9xUbB4Ouv2JZGRj7wo-nVnPyad4fZiTE';
$config['square_redirect_uri']  = 'https://nsmartrac.com/tools/square/oauth_redirect';
//Production
//$config['square_connect_url']     = 'https://connect.squareup.com'; 


