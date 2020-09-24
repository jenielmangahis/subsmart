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

// form builder pages - Gene
$route['formbuilder'] = 'formbuilder';
$route['formbuilder/create'] = 'formbuilder/create';
$route['form/(:num)'] = 'formbuilder/view/$1';
$route['formbuilder/edit/(:num)'] = 'formbuilder/edit/$1';

// form builder functions - Gene
$route['formbuilder/form/view/(:any)'] = 'formbuilder/getForms/$1';
$route['formbuilder/form/add'] = 'formbuilder/addForm';
$route['formbuilder/form/update/(:any)'] = 'formbuilder/updateForm/$1';
$route['formbuilder/form/element/get/(:any)'] = 'formbuilder/getFormElements/$1';
$route['formbuilder/form/element/get/(:any)/(:any)'] = 'formbuilder/getFormElements/$1/$2';
$route['formbuilder/form/element/add'] = 'formbuilder/addFormElement';
$route['formbuilder/form/element/update/(:any)'] = 'formbuilder/updateFormElement/$1';
$route['formbuilder/form/element/delete/(:any)'] = 'formbuilder/deleteFormElement/$1';
$route['formbuilder/form/element/choices/add'] = 'formbuilder/addElementChoices';
$route['formbuilder/form/element/choices/delete/(:any)'] = 'formbuilder/deleteElementChoices/$1';
$route['formbuilder/form/element/choices/(:any)'] = 'formbuilder/getElementChoices/$1';
$route['formbuilder/form/element/images/add'] = 'formbuilder/addElementImages';
$route['formbuilder/form/element/images/upload'] = 'formbuilder/uploadElementImages';
$route['formbuilder/form/element/images/(:any)'] = 'formbuilder/getElementImages/$1';
$route['form/submit/(:any)'] = 'formbuilder/submitForm/$1';

//survey module
$route['vault/(:num)'] = 'vault/index/$1';
$route['survey/(:num)']['GET'] = 'survey/preview/$1';
$route['survey/edit/(:num)'] = 'survey/edit/$1';
$route['survey/delete/(:num)']['GET'] = 'survey/delete/$1';
$route['survey/preview/(:num)']['GET'] = 'survey/preview/$1';
$route['survey/create'] = 'survey/add';
$route['survey/add'] = 'survey/addSurvey';
$route['survey/upload/custombackgroundimage/(:any)'] = 'survey/uploadCustomBackgroundImage/$1';
$route['survey/home'] = 'survey/index';
$route['survey/question/(:any)/(:num)/(:num)'] = 'survey/addQuestionSettings/$1/$2/$3';

// survey logic
$route['survey/logic/list/(:any)'] = "survey/surveyLogicList/$1";
$route['survey/logic/add'] = "survey/addLogicJump";

// themes
$route['survey/themes'] = 'survey/themeIndex';
$route['survey/themes/create'] = 'survey/themeCreate';
$route['survey/themes/add'] = 'survey/addTheme';
$route['survey/themes/edit/(:num)'] = 'survey/themeEdit/$1';
$route['survey/themes/update/(:num)'] = 'survey/updateTheme/$1';
$route['survey/themes/(:num)'] = 'survey/themeView/$1';
$route['survey/themes/select/(:any)/(:any)'] = 'survey/selectTheme/$1/$2';

//question
$route['survey/update/(:num)/(:any)/(:num)'] = 'survey/updateSurvey/$1/$2/$3';
$route['survey/update/question'] = 'survey/updateQuestion';
$route['survey/update/(:any)'] = 'survey/updateSurvey/$1';
$route['survey/question/upload/(:num)'] = 'survey/addQuestionUpload/$1';
$route['survey/add/questions/choices/(:num)/(:num)'] = 'survey/addAndUpdateQuestionChoices/$1/$2';
$route['survey/add/questions/(:num)/(:num)'] = 'survey/addAndUpdateQuestion/$1/$2';
$route['survey/add/question/(:num)/(:num)'] = 'survey/addQuestion/$1/$2';
$route['survey/delete/question/(:num)']['GET'] = 'survey/deleteQuestion/$1';
$route['survey/add/questions/template/choices/(:num)'] = 'survey/addTemplateChoices/$1'; // new 
$route['survey/order/question']['POST'] = 'survey/orderUpdate/$1';

$route['survey/tribute/(:num)'] = 'survey/getQuestions/$1';

// workspace
$route['survey/workspace/delete/(:num)'] = 'survey/deleteWorkspace/$1';
$route['survey/workspace/edit/(:num)'] = 'survey/editWorkspace/$1';
$route['survey/workspace/add'] = 'survey/addWorkspace';
$route['survey/workspace'] = 'survey/workspaceList';
$route['survey/tribue'] = 'survey/getQuestions';
$route['survey/result/$1'] = 'survey/result/$1';
$route['survey/share/$1'] = 'survey/share/$1';
$route['survey/answer/$1'] = 'survey/answer/$1';


$route['survey/add/question/choice/(:num)/(:num)'] = 'survey/addQuestionChoice/$1/$2';
// [AdminLTE]
$route['adminlte/(:any)'] = 'adminlte/main/$1';

// [Invoice]
$route['invoice/recurring/add'] = 'invoice/recurring_add';

$route['reports/main/report/(:any)'] = 'reports/report/$1';


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

$route['offers'] = 'Offers';
$route['campaign_blast'] = 'Campaign_Blast';

$route['register/subscribe'] = 'register/subscribe';

// [Accounting]

$route['accounting/sales-overview'] = 'accounting/salesoverview';
$route['accounting/all-sales'] = 'accounting/allsales';
$route['accounting/products-and-services'] = 'accounting/products_and_services';
$route['accounting/payroll-overview'] = 'accounting/payrolloverview';
$route['accounting/workers-comp'] = 'accounting/workerscomp';

$route['accounting/chart_of_accounts/create'] = 'Accounting/add';
$route['accounting/chart_of_accounts/fetch_acc_detail'] = 'Accounting/fetch_acc_detail';
$route['accounting/chart_of_accounts/add'] = 'Accounting/addChartofaccounts';
$route['accounting/chart_of_accounts/edit/(:any)?'] = 'Accounting/edit/$1';
$route['accounting/chart_of_accounts/update'] = 'Accounting/update';
$route['accounting/chart_of_accounts/update_name'] = 'Accounting/update_name';
$route['accounting/chart_of_accounts/inactive'] = 'Accounting/inactive';
$route['accounting/chart_of_accounts/import'] = 'Accounting/import';
$route['accounting/chart_of_accounts/refresh'] = 'Accounting/refresh';
$route['accounting/reconcile/create'] = 'reconcile/add';
$route['accounting/reconcile/save'] = 'reconcile/addReconcile';
$route['accounting/reconcile/(:any)'] = 'reconcile/index/$1';
$route['accounting/reconcile'] = 'reconcile/indexmain';
$route['accounting/reconcile/edit/(:any)'] = 'reconcile/edit/$1';
$route['accounting/reconcile/update/(:any)'] = 'reconcile/update/$1';
$route['accounting/reconcile/update_pg/(:any)'] = 'reconcile/update_pg/$1';
$route['accounting/reconcile/update_pg2/(:any)'] = 'reconcile/update_pg2/$1';
$route['accounting/reconcile/do_upload/(:any)'] = 'reconcile/do_upload/$1';
$route['accounting/reconcile/delete/reconcile'] = 'reconcile/delete';
$route['accounting/reconcile/view/report/(:any)'] = 'reconcile/report/$1';
$route['accounting/reconcile/view/summary'] = 'reconcile/summary';
$route['accounting/reconcile/view/export_csv'] = 'reconcile/export_csv';
$route['accounting/reconcile/view/fetch_ending_date'] = 'reconcile/fetch_ending_date';
$route['accounting/reconcile/updatesingle/adjustment_date'] = 'reconcile/adjustment_date';
$route['accounting/reconcile/view/reportajax/(:any)'] = 'reconcile/reportajax/$1';
$route['accounting/reconcile/view/history'] = 'reconcile/history';
$route['accounting/reconcile/view/report_print/(:any)'] = 'reconcile/report_print/$1';
$route['accounting/reconcile/view/showData'] = 'reconcile/showData';
$route['accounting/vendor-details/(:any)'] = 'accounting/vendordetails/$1';
$route['accounting/taxes/edit-settings'] = 'taxes/edit_settings';

// [Addons - Booking]
$route['more/addon/booking'] = 'booking/index';
$route['more/addon/booking/products'] = 'booking/products';
$route['more/addon/booking/time'] = 'booking/time';
$route['more/addon/booking/form'] = 'booking/form';
$route['more/addon/booking/coupons'] = 'booking/coupons';
$route['more/addon/booking/coupons/coupon_tab/(:any)'] = 'booking/coupons/$1';
$route['more/addon/booking/settings'] = 'booking/settings';
$route['more/addon/booking/preview'] = 'booking/preview';
$route['booking/create_coupon'] = 'booking/save_coupon';
$route['booking/create_category'] = 'booking/save_category';
$route['booking/create_service_item'] = 'booking/save_service_item';
//$route['booking/delete_coupon/(:num)']['GET'] = 'booking/delete_coupon/$1';
$route['booking/delete_coupon'] = 'booking/delete_coupon';
$route['booking/delete_service_item'] = 'booking/delete_service_item';
$route['booking/delete_category'] = 'booking/delete_category';
$route['booking/_edit_coupon'] = 'booking/ajax_edit_coupon';
$route['booking/ajax_edit_category'] = 'booking/ajax_edit_category';
$route['booking/ajax_edit_service_item'] = 'booking/ajax_edit_service_item';
$route['booking/update_category'] = 'booking/update_category';
$route['booking/update_coupon'] = 'booking/update_coupon';
$route['booking/update_service_item'] = 'booking/update_service_item';
$route['booking/_save_setting'] = 'booking/ajax_save_setting';
$route['booking/_save_time_slot'] = 'booking/ajax_save_time_slot';
$route['booking/delete_time_slot'] = 'booking/delete_time_slot';
$route['booking/ajax_save_service_item_visible_status'] = 'booking/ajax_save_service_item_visible_status';
$route['more/addon/inquiries'] = 'booking/inquiries';
$route['booking/_inquiry_details'] = 'booking/ajax_get_inquiry_details';
$route['booking/_inquiry_change_status'] = 'booking/ajax_change_inquiry_status';
$route['booking/update_inquiry_status'] = 'booking/update_inquiry_status';
$route['booking/_inquiry_edit_details'] = 'booking/ajax_inquiry_edit_details';
$route['booking/update_inquiry_details'] = 'booking/update_inquiry_details';
//$route['booking/products'] = 'booking/front_items';
$route['booking/products/(:any)'] = 'booking/front_items/$1';
$route['booking/products_schedule/(:any)'] = 'booking/front_schedule/$1';
$route['booking/_product_details'] = 'booking/ajax_get_product_details';
$route['booking/_add_cart_item'] = 'booking/ajax_update_cart_item';
$route['booking/_add_cart_coupon'] = 'booking/ajax_update_cart_coupon';
$route['booking/_delete_cart_item'] = 'booking/ajax_delete_cart_item';
$route['booking/_load_week_schedule'] = 'booking/ajax_load_week_schedule';
$route['booking/_set_booking_schedule'] = 'booking/ajax_user_set_schedule';
$route['booking/product_booking_form/(:any)'] = 'booking/front_booking_form/$1';
$route['booking/save_booking_inquiry'] = 'booking/save_product_booking';
$route['booking/_delete_coupon'] = 'booking/ajax_delete_coupon';

$route['nsmart_plans/index'] = 'Nsmart_Plans/index';
$route['nsmart_plans/add_new_plan'] = 'Nsmart_Plans/add_new_plan';
$route['nsmart_plans/create_plan'] = 'Nsmart_Plans/create_plan';
$route['nsmart_plans/edit_plan/(:any)'] = 'Nsmart_Plans/edit_plan/$1';
$route['nsmart_plans/update_plan'] = 'Nsmart_Plans/update_plan';
$route['nsmart_plans/delete_plan'] = 'Nsmart_Plans/delete_plan';

$route['plan_headings/index'] = 'Plan_Headings/index';
$route['plan_headings/add_new_headings'] = 'Plan_Headings/add_new_headings';
$route['plan_headings/create_plan_headings'] = 'Plan_Headings/create_plan_headings';
$route['plan_headings/edit_plan_headings/(:any)'] = 'Plan_Headings/edit_plan_headings/$1';
$route['plan_headings/update_plan_headings'] = 'Plan_Headings/update_plan_headings';
$route['plan_headings/delete_plan_heading'] = 'Plan_Headings/delete_plan_heading';

$route['nsmart_features/index'] = 'Nsmart_Features/index';
$route['nsmart_features/add_new_feature'] = 'Nsmart_Features/add_new_feature';
$route['nsmart_features/create_feature'] = 'Nsmart_Features/create_feature';
$route['nsmart_features/edit_feature/(:any)'] = 'Nsmart_Features/edit_feature/$1';
$route['nsmart_features/update_feature'] = 'Nsmart_Features/update_feature';

$route['notification/calendar_notification_counter'] = 'Notification_Counter/calendar_notification_counter';

$route['before-after/save-before-after'] = 'before_after/saveBeforeAfter';
$route['before-after/update-before-after'] = 'before_after/updateBeforeAfter';
$route['before-after/edit/(:num)'] = 'before_after/edit/$1';
$route['before-after/delete/(:num)'] = 'before_after/delete/$1';

//wizard
$route['wizard/show_app'] = 'wizard/show_app';
$route['wizard/del_app'] = 'wizard/del_app';
//$route['wizard/getSubOptions'] = 'wizard/getSubOptions';

//Settings
$route['settings/schedule'] = 'Settings/schedule';
$route['settings/notifications'] = 'Settings/notifications';
$route['settings/email_templates'] = 'Settings/email_templates';
$route['settings/sms_templates'] = 'Settings/sms_templates';
$route['settings/email_branding'] = 'Settings/email_branding';
$route['settings/online_payments'] = 'Settings/online_payments';
$route['settings/_update_enabled_google_calendar'] = 'Settings/ajax_update_enabled_google_calendar';
$route['settings/_get_google_enabled_calendars'] = 'Settings/ajax_get_google_enabled_calendars';
$route['settings/calendar_unbind_account'] = 'Settings/calendar_unbind_account';

//leads
$route['online_leads'] = 'Inquiries/online_lead';
$route['video_estimate'] = 'Inquiries/video_estimate';

//paypal
$route['subscription/index'] = 'Subscription/index';
