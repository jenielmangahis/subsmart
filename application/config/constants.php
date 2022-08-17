<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', true);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


defined('DB_SETTINGS_TABLE_KEY_SCHEDULE')      or define('DB_SETTINGS_TABLE_KEY_SCHEDULE', 'schedule');
defined('DB_SETTINGS_TABLE_KEY_WORKORDER')      or define('DB_SETTINGS_TABLE_KEY_WORKORDER', 'workorder');
defined('WORKORDER_STATUS_SCHEDULE')      or define('WORKORDER_STATUS_SCHEDULE', 'Sehcdule');
defined('WORKORDER_STATUS_COMPLETE')      or define('WORKORDER_STATUS_COMPLETE', 'Complete');
defined('ESTIMATE_STATUS_SUBMITTED')      or define('ESTIMATE_STATUS_SUBMITTED', 'Submitted');
defined('ESTIMATE_STATUS_ACCEPTED')      or define('ESTIMATE_STATUS_ACCEPTED', 'Accepted');
defined('ESTIMATE_STATUS_INVOICED')      or define('ESTIMATE_STATUS_INVOICED', 'Invoiced');
defined('ESTIMATE_STATUS_DECLINED')      or define('ESTIMATE_STATUS_DECLINED', 'Declined by customer');
defined('ESTIMATE_STATUS_LOST')      or define('ESTIMATE_STATUS_LOST', 'Lost');
defined('ESTIMATE_STATUS_DRAFT')      or define('ESTIMATE_STATUS_DRAFT', 'Draft');

//Converge
//Demo
/*define('CONVERGE_MERCHANTID', '0019127');
define('CONVERGE_MERCHANTUSERID', 'webpage');
define('CONVERGE_MERCHANTPIN', 'IJFZ3DQUK9MPLHGUS618ZJ9KWH7EI3G0QTQ5IGI6NY3701LZ1E5SHMBE1MEMG7UA');*/
//Production
define('CONVERGE_MERCHANTID', '2159250');
define('CONVERGE_MERCHANTUSERID', 'nsmartapi');
define('CONVERGE_MERCHANTPIN', 'UJN5ASLON7DJGDET68VF4JQGJILOZ8SDAWXG7SQRDEON0YY8ARXFXS6E19UA1E2X');

//Demo
//define('CONVERGE_TOKENURL', 'https://api.demo.convergepay.com/hosted-payments/transaction_token');
//define('CONVERGE_HPPURL', 'https://api.demo.convergepay.com/hosted-payments');

//Non Demo
define('CONVERGE_TOKENURL', 'https://api.convergepay.com/hosted-payments/transaction_token');
define('CONVERGE_HPPURL', 'https://api.convergepay.com/hosted-payments');

define('STRIPE_SECRET_KEY', 'sk_test_51IcoTsKPiost1m5gz29sxuGcntYe2NsiBInRphNPMvRQiNN9FQeNmOfG72Lpky3NU5XD0gXCCNZabc2xdsjfZQcM00GzFDajwW');
define('STRIPE_PUBLISH_KEY', 'pk_test_51IcoTsKPiost1m5gilfxDCpqQR0T139pAGFVUv6rSIMEn4N14ARbfQUL8MIWMLSyBloYhEluuY5Dh9N9oZG2Ku1600AgrjHJA6');

//RING CENTRAL
//Sandbox
/*define('RINGCENTRAL_CLIENT_ID', 'yyGrSZo1SUaLHrh5VM-6Pw');
define('RINGCENTRAL_CLIENT_SECRET', 'JMU-sm7HQAKU60lEo6Zq9Qe2GFqhEQRVWXTDItUjqlNA');
define('RINGCENTRAL_DEV_URL', 'https://platform.devtest.ringcentral.com');
define('RINGCENTRAL_USER', '+13233646599');
define('RINGCENTRAL_FROM', '+13233646599');
define('RINGCENTRAL_PASSWORD', 's@634DFhy&*)2bNy');
define('RINGCENTRAL_EXT', '101');*/
//Production
define('RINGCENTRAL_CLIENT_ID', 'nUlEWd9qRE6SmXr-glhWIA');
define('RINGCENTRAL_CLIENT_SECRET', 'LLF8Pl45Suiad2qgQ4nxkQUl31OB7tRBmXkw1U1Rv0sA');
define('RINGCENTRAL_DEV_URL', 'https://platform.ringcentral.com');
define('RINGCENTRAL_DEVTEST_URL', 'https://platform.devtest.ringcentral.com');
define('RINGCENTRAL_USER', '+18504780530');
define('RINGCENTRAL_PASSWORD', 'Ringmybell2022');
define('RINGCENTRAL_FROM', '+18503081341');
define('RINGCENTRAL_EXT', '101');

//2nd account
/*define('RINGCENTRAL_CLIENT_ID', 'nUlEWd9qRE6SmXr-glhWIA');
define('RINGCENTRAL_CLIENT_SECRET', 'LLF8Pl45Suiad2qgQ4nxkQUl31OB7tRBmXkw1U1Rv0sA');
define('RINGCENTRAL_DEV_URL', 'https://platform.ringcentral.com');
define('RINGCENTRAL_USER', '+18509417380');
define('RINGCENTRAL_PASSWORD', 'Ringmybell2022');
define('RINGCENTRAL_FROM', '+18509417380');
define('RINGCENTRAL_EXT', '105');*/

//PHPMAILER
define('MAIL_SERVER', 'mail.nsmartrac.com');
define('MAIL_PORT', 465);
define('MAIL_USERNAME', 'websndr@nsmartrac.com');
define('MAIL_PASSWORD', 'AtWt]&[+t#x.');
define('MAIL_FROM', 'websndr@nsmartrac.com');
define('REGISTRATION_MONTHS_DISCOUNTED', 3);

//TRAC360
define('GOOGLE_MAP_API_KEY', 'AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo');

//NMI
//Test account
define('NMI_TERMINAL_ID', '99954615');
define('NMI_TRANSACTION_KEY', '3DNajYnBtGUSeDyX');
define('NMI_SOFTWARE_NAME', 'NSMART');
define('NMI_SOFTWARE_VERSION', '1.0');
define('NMI_TEST_SERVER_URL', 'https://test.cardeasexml.com/generic.cex');

//Twilio - production nsmartrac@gmail.com
/*define('TWILIO_SID', 'ACf262b7f581f8d1eb2a3d4ddf48f0fdb2');
define('TWILIO_TOKEN', '6b0e320e49625b6c9ce157efa14a4931');
define('TWILIO_NUMBER', '+18506195914');*/

//Twilio - Test Account
/*define('TWILIO_SID', 'AC73198272b9940041ef8a9d9c0b32f2c4');
define('TWILIO_TOKEN', '86f57bbbd4a371ab738205df78113e3e');
define('TWILIO_NUMBER', '+15005550006');*/

//Twilio - production - support@nsmatrac.com
define('TWILIO_SID', 'ACdf812e3cc1aae1e3576046e1d7138296');
define('TWILIO_TOKEN', '503645bbef7fcd46ac6f6b04ce5c0188');
define('TWILIO_NUMBER', '+18509035118');

define('PLAID_API_URL', 'https://sandbox.plaid.com');
//define('PLAID_API_REDIRECT_URL', 'https://nsmartrac.com/');
define('PLAID_API_REDIRECT_URL', 'https://localhost/ci/nsmart_v2/debug/plaid_process_data');
define('PLAID_API_WEBHOOK_URL', 'https://sample-web-hook.com');
define('PLAID_API_ENV', 'sandbox');