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
$route['formbuilder'] = 'formBuilder';
$route['formbuilder/create'] = 'formBuilder/create';
$route['form/(:num)'] = 'formBuilder/view/$1';
$route['formbuilder/edit/(:num)'] = 'formBuilder/edit/$1';

// form builder functions - Gene
$route['formbuilder/form/view/(:any)'] = 'formBuilder/getForms/$1';
$route['formbuilder/form/add'] = 'formBuilder/addForm';
$route['formbuilder/form/update/(:any)'] = 'formBuilder/updateForm/$1';
$route['formbuilder/form/element/products'] = 'formBuilder/getProducts';
$route['formbuilder/form/element/products/add'] = 'formBuilder/addFormProducts';
$route['formbuilder/form/element/get/(:any)'] = 'formBuilder/getFormElements/$1';
$route['formbuilder/form/element/get/(:any)/(:any)'] = 'formBuilder/getFormElements/$1/$2';
$route['formbuilder/form/element/add'] = 'formBuilder/addFormElement';
$route['formbuilder/form/element/update/(:any)'] = 'formBuilder/updateFormElement/$1';
$route['formbuilder/form/element/delete/(:any)'] = 'formBuilder/deleteFormElement/$1';
$route['formbuilder/form/element/choices/add'] = 'formBuilder/addElementChoices';
$route['formbuilder/form/element/choices/delete/(:any)'] = 'formBuilder/deleteElementChoices/$1';
$route['formbuilder/form/element/choices/(:any)'] = 'formBuilder/getElementChoices/$1';
$route['formbuilder/form/element/images/add'] = 'formBuilder/addElementImages';
$route['formbuilder/form/element/images/upload'] = 'formBuilder/uploadElementImages';
$route['formbuilder/form/element/images/(:any)'] = 'formBuilder/getElementImages/$1';
$route['formbuilder/get-active-company-data'] = 'formBuilder/getActiveCompanyData';
$route['form/submit/(:any)'] = 'formBuilder/submitForm/$1';

// terms and conditions - Gene
$route['terms-and-conditions'] = 'TermsAndConditionsController';
$route['terms-and-conditions/(:num)'] = 'TermsAndConditionsController/view/$1';
$route['terms-and-conditions/edit/(:num)'] = 'TermsAndConditionsController/edit/$1';
$route['terms-and-conditions/add'] = 'TermsAndConditionsController/add';

//gene fb
$route['fb'] = 'fb';
$route['fb/add'] = 'fb/add';
$route['fb/edit/:active_tab'] = 'fb/edit';
$route['fb/view/(:num)'] = 'fb/view/$1';
$route['fb/get-all-by-active-user'] = 'fb/getAllByactiveUser';
$route['fb/get-form-by-id/(:num)'] = 'fb/getByFormID/$1';
$route['fb/create']['post'] = 'fb/create';

//fb elements
$route['fb/elements/create']['post'] = 'fb/createFormElement';
$route['fb/elements/update-order']['post'] = 'fb/updateOrder';
$route['fb/elements/update/(:num)']['post'] = 'fb/updateElement/$1';
$route['fb/elements/destroy/(:num)']['post'] = 'fb/destroyElement/$1';

// api
$route['terms-and-conditions/get-all'] = 'TermsAndConditionsController/getAll';
$route['terms-and-conditions/get-one-by-id/(:num)'] = 'TermsAndConditionsController/getOneByID/$1';
$route['terms-and-conditions/update/(:num)'] = 'TermsAndConditionsController/update/$1';
$route['terms-and-conditions/destroy/(:num)'] = 'TermsAndConditionsController/destroy/$1';
$route['terms-and-conditions/create'] = 'TermsAndConditionsController/create';

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
$route['register/authenticating_registration'] = 'Register/authenticating_registration';
$route['contact'] = 'contact';
$route['sms_automation'] = 'Sms_Automation';
$route['sms_campaigns'] = 'Sms_Campaigns';
$route['voicemail_campaigns'] = 'Voicemail_Campaigns';
$route['email_campaigns'] = 'Email_Campaigns';
$route['email_automation'] = 'Email_Automation';
$route['email_automation/templates'] = 'Email_Automation/templates';
$route['email_automation/create_template'] = 'Email_Automation/save_template';
$route['email_automation/create_email_automation'] = 'Email_Automation/save_email_automation';
$route['email_automation/delete_template'] = 'Email_Automation/delete_template';
$route['email_automation/delete_email_automation'] = 'Email_Automation/delete_email_automation';
$route['email_automation/ajax_edit_template'] = 'Email_Automation/ajax_edit_template';
$route['email_automation/update_template'] = 'Email_Automation/update_template';
$route['email_automation/update_email_automation'] = 'Email_Automation/update_email_automation';
$route['email_automation/ajax_edit_email_template'] = 'Email_Automation/ajax_edit_email_template';
$route['email_automation/ajax_save_visible_status'] = 'Email_Automation/ajax_save_visible_status';
$route['email_automation/ajax_set_default_template'] = 'Email_Automation/ajax_set_default_template';
$route['email_automation/ajax_set_default_template_edit'] = 'Email_Automation/ajax_set_default_template_edit';
$route['email_automation/ajax_set_place_holder'] = 'Email_Automation/ajax_set_place_holder';
$route['email_automation/ajax_set_place_holder_edit'] = 'Email_Automation/ajax_set_place_holder_edit';

$route['campaign_automation'] = 'Campaign_Automation';

$route['terms-and-condition'] = 'pages/terms_and_condition';
$route['privacy-policy'] = 'pages/privacy_policy';
$route['anti-spam-policy'] = 'pages/anti_spam_policy';
$route['find-pros'] = 'pages/find_pros';
$route['find-pros/search'] = 'pages/find_pros_form';
$route['find-pros/send'] = 'pages/ajax_send_find_pros';
$route['before-after/main'] = 'Before_after';
$route['before-after/add_photo'] = 'Before_after/addPhoto';

$route['offers'] = 'Offers';
$route['my_inquires'] = 'My_Inquires';
$route['campaign'] = 'Campaign';

$route['campaign_blast'] = 'Campaign_Blast';
$route['campaign_blast/save_blast'] = 'Campaign_Blast/save_blast';
$route['campaign_blast/delete_blast'] = 'Campaign_Blast/delete_blast';

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
$route['accounting/reconcile/update_pg_sc/(:any)'] = 'reconcile/update_pg_sc/$1';
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
$route['accounting/reconcile/view/download/(:any)'] = 'reconcile/download/$1';
$route['accounting/vendor-details/(:any)'] = 'accounting/vendordetails/$1';
$route['accounting/taxes/edit-settings'] = 'taxes/edit_settings';

$route['accounting/reconcile/add/servicecharge'] = 'reconcile/insert_servicecharge';
$route['accounting/reconcile/change/servicecharge'] = 'reconcile/update_servicecharge';
$route['accounting/reconcile/servicecharge/update_sc'] = 'reconcile/update_sc';
$route['accounting/reconcile/servicecharge/remove_sc'] = 'reconcile/remove_sc';

$route['accounting/reconcile/recurr/save'] = 'reconcile/recurr_save';
$route['accounting/reconcile/addrecurr/servicecharge'] = 'reconcile/insert_recurr_servicecharge';
$route['accounting/reconcile/changerecurr/servicecharge'] = 'reconcile/update_recurr_servicecharge';
$route['accounting/reconcile/servicecharge/remove_sc_recurr'] = 'reconcile/remove_sc_recurr';

$route['accounting/reconcile/check/save'] = 'reconcile/check_save';
$route['accounting/reconcile/addcheck/servicecharge'] = 'reconcile/insert_check_servicecharge';
$route['accounting/reconcile/servicecharge/remove_sc_check'] = 'reconcile/remove_sc_check';


$route['accounting/reconcile/add/interestearned'] = 'reconcile/insert_interestearned';
$route['accounting/reconcile/change/interestearned'] = 'reconcile/update_interestearned';
$route['accounting/reconcile/interestearned/update_it'] = 'reconcile/update_it';
$route['accounting/reconcile/interestearned/remove_it'] = 'reconcile/remove_it';

$route['accounting/reconcile/recurrint/save'] = 'reconcile/recurrint_save';
$route['accounting/reconcile/addrecurr/interestearned'] = 'reconcile/insert_recurr_interestearned';
$route['accounting/reconcile/changerecurr/interestearned'] = 'reconcile/update_recurr_interestearned';
$route['accounting/reconcile/interestearned/remove_it_recurr'] = 'reconcile/remove_it_recurr';

$route['accounting/reconcile/delete/delete_int'] = 'reconcile/delete_int';
$route['accounting/reconcile/delete/delete_sc'] = 'reconcile/delete_sc';

$route['accounting/reconcile/journal-report/(:any)/(:any)'] = 'reconcile/journal_report/$1/$2';
$route['accounting/reconcile/view/reportajax/(:any)'] = 'reconcile/journal_report_ajax/$1';

$route['accounting/reconcile/audit-history/(:any)/(:any)'] = 'reconcile/audit_history/$1/$2';

$route['accounting/reconcile/save/history'] = 'reconcile/addReconcile_history';
$route['accounting/reconcile/add/servicecharge/history'] = 'reconcile/insert_servicecharge_history';
$route['accounting/reconcile/add/interestearned/history'] = 'reconcile/insert_interestearned_history';

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

$route['nsmart_addons/index'] = 'Nsmart_Addons/index';
$route['nsmart_addons/add_new_addon'] = 'Nsmart_Addons/add_new_addon';
$route['nsmart_addons/create_addon'] = 'Nsmart_Addons/create_addon';
$route['nsmart_addons/edit_addon/(:any)'] = 'Nsmart_Addons/edit_addon/$1';
$route['nsmart_addons/update_addon'] = 'Nsmart_Addons/update_addon';

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

$route['nsmart_adminmgt/subscribers'] = 'Nsmart_AdminMgt/subscribers';
$route['nsmart_adminmgt/_load_subscriber_details'] = 'Nsmart_AdminMgt/ajax_load_subscriber_details';

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
$route['settings/_update_enabled_google_mini_calendar'] = 'Settings/ajax_update_enabled_google_mini_calendar';
$route['settings/_get_google_enabled_calendars'] = 'Settings/ajax_get_google_enabled_calendars';
$route['settings/calendar_unbind_account'] = 'Settings/calendar_unbind_account';

//leads
$route['online_leads'] = 'Inquiries/online_lead';
$route['video_estimate'] = 'Inquiries/video_estimate';

//paypal
$route['subscription/index'] = 'Subscription/index';

//sms blast
$route['sms_campaigns'] = 'Sms_Campaigns/index';
$route['sms_campaigns/add_sms_blast'] = 'Sms_Campaigns/add_sms_blast';
$route['sms_campaigns/save_draft_campaign'] = 'Sms_Campaigns/create_draft_campaign';
$route['sms_campaigns/add_campaign_send_to'] = 'Sms_Campaigns/add_campaign_send_to';
$route['sms_campaigns/create_campaign_send_to'] = 'Sms_Campaigns/create_campaign_send_to';
$route['sms_campaigns/build_sms'] = 'Sms_Campaigns/build_sms';
$route['sms_campaigns/create_sms_message'] = 'Sms_Campaigns/create_sms_message';
$route['sms_campaigns/preview_sms_message'] = 'Sms_Campaigns/preview_sms_message';

//offers
$route['offers/add_offer'] = 'Offers/add_offer';
$route['offers/save_draft_offer'] = 'Offers/create_draft_offer';
$route['offers/add_offer_send_to'] = 'Offers/add_offer_send_to';
$route['offers/save_offer_send_to_settings'] = 'Offers/save_offer_send_to_settings';
$route['offers/build_email'] = 'Offers/build_email';
$route['offers/save_offer_build_email'] = 'Offers/save_offer_build_email';
$route['offers/email_preview'] = 'Offers/email_preview';
$route['offers/edit_offer/(:num)'] = 'Offers/edit_offer/$1';
$route['offers/update_draft_offer'] = 'Offers/update_draft_offer';

//workcalendar
$route['calendar/_get_main_calendar_events'] = 'Workcalender/main_calendar_events';
$route['calendar/_create_google_event'] = 'Workcalender/ajax_create_google_event';
$route['calendar/_create_google_calendar'] = 'Workcalender/ajax_create_google_calendar';
$route['calendar/_load_upcoming_events'] = 'Workcalender/ajax_load_upcoming_events';

//workorder
$route['workorder/_update_workorder_settings'] = 'Workorder/ajax_update_workoder_settings';
$route['workorder/checklists'] = 'Workorder/checklists';
$route['workorder/add_checklist'] = 'Workorder/add_checklist';
$route['workorder/create_checklist'] = 'Workorder/create_checklist';
$route['workorder/edit_checklist/(:num)'] = 'Workorder/edit_checklist/$1';
$route['workorder/_load_checklist_items'] = 'Workorder/ajax_load_checklist_items';
$route['workorder/_create_checklist_item'] = 'Workorder/ajax_create_checklist_item';
$route['workorder/_delete_checklist_items'] = 'Workorder/ajax_delete_checklist_items';
$route['workorder/_update_checklist_item'] = 'Workorder/ajax_update_checklist_item';
$route['workorder/update_checklist'] = 'Workorder/update_checklist';

//Addon Upgrades
$route['more/_load_plugin_details'] = 'More/ajax_load_plugin_details';
$route['more/add_plugin'] = 'More/add_plugin';

$route['page/no_access'] = 'page/no_access';

// Offer Code
$route['offer_codes/index'] = 'Offer_Codes/index';

//Registration
$route['registration/_use_offer_code'] = 'Register/registration_use_code';

//Public Add Employee
$route['add_company_employee/(:any)'] = 'Pages/front_add_employee/$1';
$route['save_company_employee'] = 'Pages/front_save_company_employee';

//Onboarding
$route['onboarding/_load_plugin_details'] = 'Onboarding/ajax_load_plugin_details';
$route['onboarding/add_plugin'] = 'Onboarding/add_plugin';