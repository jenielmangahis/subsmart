<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['customer/tickets/(:any)?'] = 'customer/ticket/$1';
$route['customer/tickets'] = 'customer/ticket';

$route['equipments/(:any)?/(:any)?'] = 'equipment/$1/$2';
$route['equipments/(:any)?'] = 'equipment/$1';
$route['equipments'] = 'equipment';

$route['get_specific_business'] = 'home/getSpecificBusinessByIndustry';

$route['services/(:any)?/(:any)?'] = 'service/$1/$2';
$route['services/(:any)?'] = 'service/$1';
$route['services'] = 'service';

//survey module
$route['vault/(:num)'] = 'vault/index/$1';
$route['survey/(:num)']['GET'] = 'survey/preview/$1';
$route['survey/edit/(:num)'] = 'survey/edit/$1';
$route['survey/delete/(:num)']['GET'] = 'survey/delete/$1';
$route['survey/preview/(:num)']['GET'] = 'survey/preview/$1';
$route['survey/create'] = 'survey/add';
$route['survey/add'] = 'survey/addSurvey';
$route['survey/home'] = 'survey/index';

$route['survey/question/(:any)/(:num)/(:num)'] = 'survey/addQuestionSettings/$1/$2/$3';
$route['survey/themes'] = 'survey/themeIndex';
$route['survey/themes/create'] = 'survey/themeCreate';
$route['survey/themes/(:num)'] = 'survey/themeView/$1';
$route['survey/themes/select/(:any)/(:any)'] = 'survey/selectTheme/$1/$2';
//question module
$route['survey/update/question'] = 'survey/updateQuestion';
$route['survey/update/(:num)/(:any)/(:num)'] = 'survey/updateSurvey/$1/$2/$3';
$route['survey/update/(:any)'] = 'survey/updateSurvey/$1';
$route['survey/add/questions/choices/(:num)/(:num)'] = 'survey/addAndUpdateQuestionChoices/$1/$2';
$route['survey/add/questions/(:num)/(:num)'] = 'survey/addAndUpdateQuestion/$1/$2';
$route['survey/add/question/(:num)/(:num)'] = 'survey/addQuestion/$1/$2';
$route['survey/delete/question/(:num)']['GET'] = 'survey/deleteQuestion/$1';
$route['survey/order/question']['POST'] = 'survey/orderUpdate/$1';

$route['survey/add/question/choice/(:num)/(:num)'] = 'survey/addQuestionChoice/$1/$2';
// [AdminLTE]
$route['adminlte/(:any)'] = 'adminlte/main/$1';

// [Invoice]
$route['invoice/recurring/add'] = 'invoice/recurring_add';

$route['reports/main/report/(:any)'] = 'reports/report/$1';

$route['survey/tribute/(:num)'] = 'survey/getQuestions/$1';

$route['survey/question/upload/(:num)'] = 'survey/addQuestionUpload/$1';
$route['survey/workspace/delete/(:num)'] = 'survey/deleteWorkspace/$1';
$route['survey/workspace/edit/(:num)'] = 'survey/editWorkspace/$1';
$route['survey/workspace/add'] = 'survey/addWorkspace';
$route['survey/workspace'] = 'survey/workspaceList';
$route['survey/tribue'] = 'survey/getQuestions';
$route['survey/result/$1'] = 'survey/result/$1';
$route['survey/share/$1'] = 'survey/share/$1';
$route['survey/answer/$1'] = 'survey/answer/$1';

$route['features'] = 'features';
$route['pricing'] = 'pricing';
$route['registration'] = 'register';
$route['contact'] = 'contact';
$route['sms_automation'] = 'Sms_Automation';
$route['sms_campaigns'] = 'Sms_Campaigns';
$route['voicemail_campaigns'] = 'Voicemail_Campaigns';
$route['email_campaigns'] = 'Email_Campaigns';
$route['email_automation'] = 'Email_Automation';
$route['terms-and-condition'] = 'pages/terms_and_condition';
$route['privacy-policy'] = 'pages/privacy_policy';
$route['anti-spam-policy'] = 'pages/anti_spam_policy';
$route['find-pros'] = 'pages/find_pros';
$route['find-pros/search'] = 'pages/find_pros_form';
$route['find-pros/send'] = 'pages/ajax_send_find_pros';
$route['before-after/main'] = 'Before_after';
$route['before-after/add_photo'] = 'Before_after/addPhoto';
$route['accounting/sales-overview'] = 'accounting/salesoverview';
$route['accounting/all-sales'] = 'accounting/allsales';

// [Accounting]
$route['accounting/chart_of_accounts/create'] = 'chart_of_accounts/add';
$route['accounting/chart_of_accounts/fetch_acc_detail'] = 'chart_of_accounts/fetch_acc_detail';

