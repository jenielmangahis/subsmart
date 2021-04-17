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

$route['customer/add_data_sheet'] = 'customer/add_data_sheet';

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
$route['fb'] = 'FB';
$route['fb/add'] = 'FB/add';
$route['fb/thank-you'] = 'FB/thankYou';
$route['fb/edit/(:num)'] = 'FB/edit/$1';
$route['fb/rules/(:num)'] = 'FB/rules/$1';
$route['fb/settings/(:num)'] = 'FB/settings/$1';
$route['fb/share/(:num)'] = 'FB/share/$1';
$route['fb/view/(:num)'] = 'FB/view/$1';
$route['fb/get-by-active-user'] = 'FB/getByActiveUser';
$route['fb/get-form-by-id/(:num)'] = 'FB/getByFormID/$1';
$route['fb/create']['post'] = 'FB/create';
$route['fb/update/(:num)']['post'] = 'FB/update/$1';
$route['fb/generate-from-template/(:num)']['post'] = 'FB/generateFormFromTemplate/$1';
$route['fb/generate-template-from-form/(:num)'] = 'FB/generateTemplateFromForm/$1';

//fb elements
$route['fb/elements/create']['post'] = 'FB/createFormElement';
$route['fb/elements/update-order']['post'] = 'FB/updateOrder';
$route['fb/elements/update/(:num)']['post'] = 'FB/updateElement/$1';
$route['fb/elements/destroy/(:num)']['post'] = 'FB/destroyElement/$1';


//fb folders
$route['fb/folders/get-by-active-user'] = 'FB/getFoldersByActiveUser';
$route['fb/folders/'] = 'FB/foldersIndex';
$route['fb/folders'] = 'FB/foldersIndex';
$route['fb/folders/update/(:num)']['post'] = 'FB/updateFolder/$1';
$route['fb/folders/create']['post'] = 'FB/createFolder';
$route['fb/folders/destroy/(:num)']['post'] = 'FB/destroyFolder/$1';


//fb templates
$route['fb/templates/get-all'] = 'FB/getAllTemplates';
$route['fb/templates/get-by-form-template-id/(:num)'] = 'FB/getByFormTemplateID/$1';

//fb template folders
$route['fb/template-folders/get-all'] = 'FB/getAllTemplateFolders';

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

$route['email_automation/add_email_automation'] = 'Email_Automation/add_email_automation';
$route['email_automation/add_template'] = 'Email_Automation/add_template';
$route['email_automation/save_template'] = 'Email_Automation/save_template';
$route['email_automation/edit_template/(:num)'] = 'Email_Automation/edit_template/$1';
$route['email_automation/update_template'] = 'Email_Automation/update_template';
$route['email_automation/delete_template'] = 'Email_Automation/delete_template';
$route['email_automation/_get_template_message'] = 'Email_Automation/ajax_get_template_message';

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
$route['accounting/generate-pdf'] = "accounting_modals/generatePDF";
$route['accounting/show-pdf'] = "accounting_modals/showPDF";
$route['accounting/download-pdf'] = "accounting_modals/downloadPDF";
$route['accounting/send-email-form']['post'] = "accounting_modals/showEmailModal";

// Accounting tags
$route['accounting/tags'] = 'accounting_controllers/tags/index';
$route['accounting/tags/get-group-tags'] = 'accounting_controllers/tags/get_group_tags';
$route['accounting/tags/load-all-tags']['post'] = "accounting_controllers/tags/load_all_tags";
$route['accounting/tags/delete/(:any)/(:any)']['DELETE'] = "accounting_controllers/tags/delete/$1/$2";
$route['accounting/tags/update/(:any)/(:any)']['POST'] = "accounting_controllers/tags/update/$1/$2";
$route['accounting/tags/add-group-tag']['POST'] = "accounting_controllers/tags/add_group_tag";
$route['accounting/tags/add-tag']['POST'] = "accounting_controllers/tags/add_tag";

// Modals
$route['accounting/get-other-modals/(:any)'] = "accounting_modals/index/$1";
$route['accounting/apply-for-capital'] = 'accounting/apply_for_capital';
$route['accounting/submit-modal-form']['post'] = 'accounting_modals/action';
$route['accounting/get-job-tags'] = 'accounting_modals/get_job_tags';
$route['accounting/get-account-balance/(:any)'] = 'accounting_modals/getAccountBalance/$1';
$route['accounting/load-job-tags']['post'] = 'accounting_modals/load_job_tags';
$route['accounting/submit-job-tag-form']['post'] = 'accounting_modals/submit_job_tag';
$route['accounting/get-job-tag-modal'] = 'accounting_modals/job_tag_modal';
$route['accounting/get-job-tag-form'] = 'accounting_modals/job_tag_form';
$route['accounting/get-group-tag-form'] = 'accounting_modals/group_job_tag_form';
$route['accounting/edit-group-tag-form'] = 'accounting_modals/edit_group_tag_form';
$route['accounting/get-payroll-form/(:any)'] = 'accounting_modals/get_payroll_form/$1';
$route['accounting/generate-payroll']['post'] = 'accounting_modals/generate_payroll';
$route['accounting/get-customers']['post'] = 'accounting_modals/get_statement_customers';
$route['accounting/get-recurring-form-fields/(:any)'] = 'accounting_modals/get_recurring_modal_fields/$1';
$route['accounting/get-item-details/(:any)'] = 'accounting_modals/getItemDetails/$1';

$route['accounting/lists'] = 'accounting/lists';

// Accounting attachments
$route['accounting/attachments'] = 'accounting_controllers/attachments/index';
$route['accounting/attachments/upload']['post'] = 'accounting_controllers/attachments/upload';
$route['accounting/attachments/load-attachments']['post'] = 'accounting_controllers/attachments/load_attachment_files';
$route['accounting/attachments/download'] = "accounting_controllers/attachments/download";
$route['accounting/attachments/update/(:any)']['post'] = "accounting_controllers/attachments/edit/$1";
$route['accounting/attachments/delete/(:any)']['DELETE'] = "accounting_controllers/attachments/delete/$1";

// Accounting payment methods
$route['accounting/payment-methods'] = 'accounting_controllers/payment_methods/index';
$route['accounting/payment-methods/load-payment-methods']['post'] = 'accounting_controllers/payment_methods/load_payment_methods';
$route['accounting/payment-methods/add']['post'] = 'accounting_controllers/payment_methods/add';
$route['accounting/payment-methods/delete/(:any)']['DELETE'] = "accounting_controllers/payment_methods/inactive/$1";
$route['accounting/payment-methods/activate/(:any)'] = "accounting_controllers/payment_methods/activate/$1";
$route['accounting/payment-methods/update/(:any)']['post'] = "accounting_controllers/payment_methods/update/$1";

// Accounting recurring transactions
$route['accounting/recurring-transactions'] = "accounting_controllers/recurring_transactions/index";
$route['accounting/recurring-transactions/load-recurring-transactions']['post'] = "accounting_controllers/recurring_transactions/load_recurring_transactions";
$route['accounting/recurring-transactions/delete/(:any)']['DELETE'] = "accounting_controllers/recurring_transactions/delete/$1";
$route['accounting/recurring-transactions/get-details/(:any)'] = "accounting_controllers/recurring_transactions/get/$1";
$route['accounting/recurring-transactions/update/(:any)/(:any)']['post'] = "accounting_controllers/recurring_transactions/update/$1/$2";

// Accounting payment terms
$route['accounting/terms'] = "accounting_controllers/payment_terms/index";
$route['accounting/terms/add'] = "accounting_controllers/payment_terms/add";
$route['accounting/terms/load-terms']['post'] = 'accounting_controllers/payment_terms/load_terms';
$route['accounting/terms/delete/(:any)']['DELETE'] = "accounting_controllers/payment_terms/delete/$1";
$route['accounting/terms/activate/(:any)'] = "accounting_controllers/payment_terms/activate/$1";
$route['accounting/terms/update/(:any)']['post'] = "accounting_controllers/payment_terms/update/$1";

$route['accounting/sales-overview'] = 'accounting/salesoverview';
$route['accounting/all-sales'] = 'accounting/allsales';

// Accounting products and services
$route['accounting/products-and-services'] = 'accounting_controllers/products_and_services/index';
$route['accounting/products-and-services/load']['post'] = 'accounting_controllers/products_and_services/load';
$route['accounting/products-and-services/item-form/(:any)'] = 'accounting_controllers/products_and_services/get_item_form/$1';
$route['accounting/products-and-services/items-dropdown'] = 'accounting_controllers/products_and_services/get_item_dropdown';
$route['accounting/products-and-services/inactive/(:any)']['DELETE'] = "accounting_controllers/products_and_services/inactive/$1";
$route['accounting/products-and-services/(:any)/create']['post'] = 'accounting_controllers/products_and_services/create/$1';
$route['accounting/products-and-services/update/(:any)/(:any)']['post'] = 'accounting_controllers/products_and_services/update/$1/$2';
$route['accounting/products-and-services/assign-category/(:any)']['post'] = 'accounting_controllers/products_and_services/assign_category/$1';
$route['accounting/products-and-services/batch-action/(:any)']['post'] = 'accounting_controllers/products_and_services/batch_action/$1';

$route['accounting/adjust-starting-value-form/(:any)'] = 'accounting/adjust_starting_value_form/$1';
$route['accounting/adjust-starting-value/(:any)']['post'] = 'accounting/adjust_starting_value/$1';

// Accounting product categories
$route['accounting/product-categories'] = 'accounting_controllers/product_categories/index';
$route['accounting/product-categories/load']['post'] = 'accounting_controllers/product_categories/load_product_categories';
$route['accounting/product-categories/get'] = 'accounting_controllers/product_categories/get_categories';
$route['accounting/product-categories/create']['post'] = 'accounting_controllers/product_categories/create';
$route['accounting/product-categories/get/(:any)'] = 'accounting_controllers/product_categories/get_category_details/$1';
$route['accounting/product-categories/update/(:any)']['post'] = 'accounting_controllers/product_categories/update/$1';
$route['accounting/product-categories/delete/(:any)']['DELETE'] = "accounting_controllers/product_categories/delete/$1";

$route['accounting/payroll-overview'] = 'accounting/payrolloverview';
$route['accounting/workers-comp'] = 'accounting/workerscomp';

// Accounting chart of accounts
$route['accounting/chart-of-accounts'] = 'accounting_controllers/chart_of_accounts/index';
$route['accounting/chart-of-accounts/load']['post'] = 'accounting_controllers/chart_of_accounts/load_chart_of_accounts';
$route['accounting/chart-of-accounts/create'] = 'accounting_controllers/chart_of_accounts/create';
$route['accounting/chart-of-accounts/fetch-acc-detail'] = 'accounting_controllers/chart_of_accounts/fetch_acc_detail';
$route['accounting/chart-of-accounts/add'] = 'accounting_controllers/chart_of_accounts/add';
$route['accounting/chart-of-accounts/edit/(:any)?'] = 'accounting_controllers/chart_of_accounts/edit/$1';
$route['accounting/chart-of-accounts/update/(:any)'] = 'accounting_controllers/chart_of_accounts/update/$1';
$route['accounting/chart-of-accounts/inactive/(:any)'] = 'accounting_controllers/chart_of_accounts/inactive/$1';
$route['accounting/chart-of-accounts/active/(:any)'] = 'accounting_controllers/chart_of_accounts/make_account_active/$1';
$route['accounting/chart-of-accounts/import'] = 'accounting_controllers/chart_of_accounts/import';
$route['accounting/chart-of-accounts/get-detail-type/(:any)'] = 'accounting_controllers/chart_of_accounts/get_detail_type/$1';
$route['accounting/chart-of-accounts/get-account-type/(:any)'] = 'accounting_controllers/chart_of_accounts/get_account_type/$1';
$route['accounting/chart-of-accounts/get-all-account-types'] = 'accounting_controllers/chart_of_accounts/get_all_account_types';

$route['accounting/reconcile'] = 'accounting_controllers/reconcile/indexmain';
$route['accounting/reconcile/create'] = 'accounting_controllers/reconcile/add';
$route['accounting/reconcile/save'] = 'accounting_controllers/reconcile/addReconcile';
$route['accounting/reconcile/(:any)'] = 'accounting_controllers/reconcile/index/$1';
$route['accounting/reconcile/edit/(:any)'] = 'accounting_controllers/reconcile/edit/$1';
$route['accounting/reconcile/update/(:any)'] = 'accounting_controllers/reconcile/update/$1';
$route['accounting/reconcile/update_pg/(:any)'] = 'accounting_controllers/reconcile/update_pg/$1';
$route['accounting/reconcile/update_pg_sc/(:any)'] = 'accounting_controllers/reconcile/update_pg_sc/$1';
$route['accounting/reconcile/update_pg2/(:any)'] = 'accounting_controllers/reconcile/update_pg2/$1';
$route['accounting/reconcile/do_upload/(:any)'] = 'accounting_controllers/reconcile/do_upload/$1';
$route['accounting/reconcile/delete/reconcile'] = 'accounting_controllers/reconcile/delete';
$route['accounting/reconcile/view/report/(:any)'] = 'accounting_controllers/reconcile/report/$1';
$route['accounting/reconcile/view/summary'] = 'accounting_controllers/reconcile/summary';
$route['accounting/reconcile/view/history-by-account'] = 'accounting_controllers/reconcile/history_by_account';
$route['accounting/reconcile/view/export_csv'] = 'accounting_controllers/reconcile/export_csv';
$route['accounting/reconcile/view/fetch_ending_date'] = 'accounting_controllers/reconcile/fetch_ending_date';
$route['accounting/reconcile/updatesingle/adjustment_date'] = 'accounting_controllers/reconcile/adjustment_date';
$route['accounting/reconcile/view/reportajax/(:any)'] = 'accounting_controllers/reconcile/reportajax/$1';
$route['accounting/reconcile/view/history'] = 'accounting_controllers/reconcile/history';
$route['accounting/reconcile/view/report_print/(:any)'] = 'accounting_controllers/reconcile/report_print/$1';
$route['accounting/reconcile/view/showData'] = 'accounting_controllers/reconcile/showData';
$route['accounting/reconcile/view/download/(:any)'] = 'accounting_controllers/reconcile/download/$1';

$route['accounting/employees'] = 'accounting_controllers/employees/index';
$route['accounting/employees/load']['post'] = 'accounting_controllers/employees/load_employees';
$route['accounting/employees/add'] = 'accounting_controllers/employees/add';
$route['accounting/employees/create']['post'] = 'accounting_controllers/employees/create';
$route['accounting/employees/edit/(:any)'] = 'accounting_controllers/employees/edit/$1';
$route['accounting/employees/update/(:any)']['post'] = 'accounting_controllers/employees/update/$1';
$route['accounting/employees/delete/(:any)'] = 'accounting_controllers/employees/delete/$1';
$route['accounting/employees/set-status/(:any)/(:any)'] = 'accounting_controllers/employees/set_status/$1/$2';
$route['accounting/employees/add-pay-schedule-form'] = 'accounting_controllers/employees/pay_schedule_form';
$route['accounting/employees/add-pay-schedule']['post'] = 'accounting_controllers/employees/add_pay_schedule';
$route['accounting/employees/edit-pay-schedule/(:any)'] = 'accounting_controllers/employees/edit_pay_schedule/$1';
$route['accounting/employees/update-pay-schedule/(:any)']['post'] = 'accounting_controllers/employees/update_pay_schedule/$1';
$route['accounting/employees/get-pay-date/(:any)'] = 'accounting_controllers/employees/get_pay_date/$1';
$route['accounting/employees/commission-only-payroll'] = 'accounting_controllers/employees/commission_only_modal';
$route['accounting/employees/generate-commission-payroll']['post'] = 'accounting_controllers/employees/generate_commission_payroll';
$route['accounting/employees/get-employee-pay-details/(:any)'] = 'accounting_controllers/employees/get_employee_pay_details/$1'; 
$route['accounting/employees/bonus-only-payroll'] = 'accounting_controllers/employees/bonus_only_modal';
$route['accounting/employees/bonus-only-payroll-form/(:any)'] = 'accounting_controllers/employees/bonus_only_form/$1';
$route['accounting/employees/generate-bonus-payroll/(:any)']['post'] = 'accounting_controllers/employees/generate_bonus_payroll/$1';

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
$route['wizard/edit_workspace/(:num)'] = 'wizard/edit_workspace/$1';
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
$route['sms_campaigns/create_send_schedule'] = 'Sms_Campaigns/create_send_schedule';
$route['sms_campaigns/_load_campaigns/(:any)'] = 'Sms_Campaigns/ajax_load_campaigns/$1';
$route['sms_campaigns/_load_sms_campaign_counter'] = 'Sms_Campaigns/ajax_load_sms_campaign_counter';
$route['sms_campaigns/_close_campaign'] = 'Sms_Campaigns/ajax_close_campaign';
$route['sms_campaigns/edit_campaign/(:num)'] = 'Sms_Campaigns/edit_sms_campaign/$1';
$route['sms_campaigns/_clone_campaign'] = 'Sms_Campaigns/ajax_clone_campaign';
$route['sms_campaigns/payment'] = 'Sms_Campaigns/payment';
$route['sms_campaigns/process_payment'] = 'Sms_Campaigns/process_payment';
$route['sms_campaigns/_load_paypal'] = 'Sms_Campaigns/get_paypal';
$route['sms_campaigns/process_paypal_payment'] = 'Sms_Campaigns/process_paypal_payment';
$route['sms_campaigns/process_stripe_payment'] = 'Sms_Campaigns/ajax_process_stripe_payment';

//sms automation
$route['sms_automation/_load_automation_list/(:any)'] = 'Sms_Automation/ajax_load_automation_list/$1';
$route['sms_automation/add_sms_automation'] = 'Sms_Automation/add_sms_automation';
$route['sms_automation/save_draft_automation'] = 'Sms_Automation/create_draft_automation';
$route['sms_automation/build_sms'] = 'Sms_Automation/build_sms';
$route['sms_automation/create_sms_message'] = 'Sms_Automation/create_sms_message';
$route['sms_automation/preview_sms_message'] = 'Sms_Automation/preview_sms_message';
$route['sms_automation/payment'] = 'Sms_Automation/payment';
$route['sms_automation/activate_automation'] = 'Sms_Automation/activate_automation';
$route['sms_automation/edit_automation/(:num)'] = 'Sms_Automation/edit_sms_automation/$1';
$route['sms_automation/_delete_automation'] = 'Sms_Automation/ajax_delete_automation';

//email blast
$route['email_campaigns/add_email_blast'] = 'Email_Campaigns/add_email_blast';
$route['email_campaigns/save_draft_campaign'] = 'Email_Campaigns/create_draft_campaign';
$route['email_campaigns/add_campaign_send_to'] = 'Email_Campaigns/add_campaign_send_to';
$route['email_campaigns/create_campaign_send_to'] = 'Email_Campaigns/create_campaign_send_to';
$route['email_campaigns/build_email'] = 'Email_Campaigns/build_email';
$route['email_campaigns/create_email_message'] = 'Email_Campaigns/create_email_message';
$route['email_campaigns/preview_email_message'] = 'Email_Campaigns/preview_email_message';
$route['email_campaigns/create_send_schedule'] = 'Email_Campaigns/create_send_schedule';
$route['email_campaigns/payment'] = 'Email_Campaigns/payment';
$route['email_campaigns/_generate_preview'] = 'Email_Campaigns/generate_preview';
$route['email_campaigns/activate_automation'] = 'Email_Campaigns/activate_automation';
$route['email_campaigns/_load_campaigns/(:any)'] = 'Email_Campaigns/ajax_load_campaigns/$1';
$route['email_campaigns/_load_email_campaign_counter'] = 'Email_Campaigns/ajax_load_email_campaign_counter';
$route['email_campaigns/edit_campaign/(:num)'] = 'Email_Campaigns/edit_email_campaign/$1';
$route['email_campaigns/_clone_campaign'] = 'Email_Campaigns/ajax_clone_campaign';
$route['email_campaigns/_close_campaign'] = 'Email_Campaigns/ajax_close_campaign';


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
$route['workorder/_load_map_routes'] = 'Workorder/ajax_load_map_routes';

//Addon Upgrades
$route['more/_load_plugin_details'] = 'More/ajax_load_plugin_details';
$route['more/add_plugin'] = 'More/add_plugin';

$route['page/no_access'] = 'page/no_access';

// Offer Code
$route['offer_codes/index'] = 'Offer_Codes/index';
$route['offer_codes/add_new_offer'] = 'Offer_Codes/add_new_offer';
$route['offer_codes/create_offer_code'] = 'Offer_Codes/create_offer_code';
$route['offer_codes/edit_offer/(:num)'] = 'Offer_Codes/edit_offer/$1';
$route['offer_codes/update_edit_offer'] = 'Offer_Codes/update_edit_offer';


//Registration
$route['registration/_use_offer_code'] = 'Register/registration_use_code';

//Public Add Employee
$route['add_company_employee/(:any)'] = 'Pages/front_add_employee/$1';
$route['save_company_employee'] = 'Pages/front_save_company_employee';

//Onboarding
$route['onboarding/_load_plugin_details'] = 'Onboarding/ajax_load_plugin_details';
$route['onboarding/add_plugin'] = 'Onboarding/add_plugin';
$route['onboarding/_save_business_availability'] = 'Onboarding/ajax_save_business_availability';
$route['onboarding/_complete_onboarding'] = 'Onboarding/ajax_complete_onboarding';

//check
$route['accounting/check'] = 'Check/index';
$route['accounting/check/do_upload'] = 'Check/do_upload';
$route['accounting/check/view/showData'] = 'Check/showData';

//Color Settings
$route['color_settings/index'] = 'Color_Settings/index';
$route['color_settings/add_new_color_setting'] = 'Color_Settings/add_new_color_setting';
$route['color_settings/create_color_setting'] = 'Color_Settings/create_color_setting';
$route['color_settings/edit_color_setting/(:num)'] = 'Color_Settings/edit_color_setting/$1';
$route['color_settings/update_color_setting'] = 'Color_Settings/update_color_setting';
$route['color_settings/delete_color'] = 'Color_Settings/delete_color';
$route['color_settings/add_new'] = 'Color_Settings/add_new';

//Users
$route['users/load_edit_employee'] = 'Users/ajax_edit_employee';
$route['users/_update_employee'] = 'Users/ajaxUpdateEmployee';
$route['users/_update_employee_password'] = 'Users/ajaxUpdateEmployeePassword';
$route['users/_add_payscale'] = 'Users/ajax_add_payscale';
$route['users/_edit_payscale'] = 'Users/ajax_edit_payscale';
$route['users/_update_payscale'] = 'Users/ajax_update_payscale';
$route['users/_delete_payscale'] = 'Users/ajax_delete_payscale';

//Jobs
$route['job/details/(:any)'] = 'job/details/$1';
$route['job/_load_upcoming_jobs'] = 'Job/ajax_load_upcoming_jobs';
$route['job/bird_eye_view'] = 'Workorder/map';

//Estimates
$route['estimate/_send_customer'] = 'Estimate/send_mail_estimate_customer';
$route['estimate_customer_view/(:any)'] = 'Pages/estimate_customer_view/$1';
$route['customer_approve_estimate'] = 'Pages/customer_update_estimate/1';
$route['customer_disapprove_estimate'] = 'Pages/customer_update_estimate/2';
$route['estimate/_load_scheduled_estimates'] = 'Estimate/ajax_load_scheduled_estimates';
$route['estimate/view/(:any)'] = 'Estimate/view/$1';
$route['estimate/view_pdf/(:num)'] = 'Estimate/pdf_estimate/$1';
$route['estimate/print/(:num)'] = 'Estimate/print_estimate/$1';
$route['estimate/settings'] = 'Estimate/estimate_settings';

//Credit Notes
$route['credit_notes'] = 'Credit_Notes/index';
$route['credit_notes/tab/(:any)'] = 'Credit_Notes/index/$1';
$route['credit_notes/add_new'] = 'Credit_Notes/add_new';
$route['credit_notes/save'] = 'Credit_Notes/save';
$route['credit_notes/delete'] = 'Credit_Notes/delete_credit_note';
$route['credit_notes/edit/(:num)'] = 'Credit_Notes/edit/$1';
$route['credit_notes/update'] = 'Credit_Notes/update';
$route['credit_notes/view/(:num)'] = 'Credit_Notes/view/$1';
$route['credit_notes/_send_customer'] = 'Credit_Notes/send_mail_credit_note_customer';
$route['credit_notes/send/(:num)'] = 'Credit_Notes/send_customer/$1';
$route['credit_notes/_send'] = 'Credit_Notes/send_mail';
$route['credit_note_customer_view/(:any)'] = 'Pages/credit_note_customer_view/$1';
$route['credit_notes/view_pdf/(:num)'] = 'credit_notes/pdf_credit_note/$1';
$route['credit_notes/close'] = 'Credit_Notes/close_credit_note';
$route['credit_notes/print/(:num)'] = 'Credit_Notes/print_credit_note/$1';
$route['credit_notes/clone'] = 'Credit_Notes/clone_credit_note';
$route['credit_notes/settings'] = 'Credit_Notes/credit_note_settings';

//Event Types
$route['event_types'] = 'Event_Types/index';
$route['event_types/index'] = 'Event_Types/index';
$route['event_types/add_new'] = 'Event_Types/add_new_event_type';
$route['event_types/save'] = 'Event_Types/create_event_type';
$route['event_types/edit/(:num)'] = 'Event_Types/edit_event_type/$1';
$route['event_types/update'] = 'Event_Types/update_event_type';
$route['event_types/delete'] = 'Event_Types/delete_event_type';

//Esign
$route['esignmain'] = 'Esign_Main/index';

//Job Types
$route['job/add_new_job_type'] = 'Job/add_new_job_type';
$route['job/save_job_type'] = 'Job/create_job_type';
$route['job/edit_job_type/(:num)'] = 'Job/edit_job_type/$1';
$route['job/update_job_type'] = 'Job/update_job_type';
$route['job/delete_job_type'] = 'Job/delete_job_type';

//Event Tags
$route['events/add_new_event_tag'] = 'Events/add_new_event_tag';
$route['events/save_event_tag'] = 'Events/create_new_event_tag';
$route['events/edit_event_tags/(:any)'] = 'Events/edit_event_tags/$1';
$route['events/update_event_tag'] = 'Events/update_event_tag';

//Job Tags
$route['job/add_new_job_tag'] = 'Job/add_new_job_tag';
$route['job/save_job_tag'] = 'Job/create_new_job_tag';
$route['job/edit_job_tag/(:any)'] = 'Job/edit_job_tag/$1';
$route['job/update_job_tag'] = 'Job/update_job_tag';

//Forgot Password
$route['login/_check_user_id_exists'] = 'Login/ajax_check_user_id_exists';
$route['login/_update_user_password'] = 'Login/ajax_update_user_password';

//Cards File
$route['cards_file/list'] = 'CardsFile/index';
$route['cards_file/add_new'] = 'CardsFile/add_new_card';
$route['cards_file/create_new_card'] = 'CardsFile/create_new_card';
$route['cards_file/_update_primary_card'] = 'CardsFile/update_primary_card';
$route['cards_file/delete_card'] = 'CardsFile/delete_card';
$route['cards_file/test_card'] = 'CardsFile/test_card';

//Tools
$route['tools/_get_converge_api_credentials'] = 'Tools/ajax_load_company_converge_form';
$route['tools/_activate_company_converge'] = 'Tools/ajax_activate_company_online_payment_account';
$route['tools/_activate_company_stripe'] = 'Tools/ajax_activate_company_online_payment_account';
$route['tools/_activate_company_paypal'] = 'Tools/ajax_activate_company_online_payment_account';
$route['tools/_get_stripe_api_credentials'] = 'Tools/ajax_load_company_stripe_form';
$route['tools/_get_paypal_api_credentials'] = 'Tools/ajax_load_company_paypal_form';
$route['tools/activate_stripe'] = 'Debug/activateStripe';

//Work Pictures
$route['users/_delete_work_picture'] = 'Users/ajax_delete_company_work_picture';
$route['users/_update_work_image_caption'] = 'Users/ajax_update_company_work_picture_caption';

//Profile Setting
$route['users/update_profile_setting'] = 'Users/update_profile_setting';

//Job Front View
$route['job_invoice_view/(:any)'] = 'Pages/job_customer_invoice_view/$1';
$route['_converge_request_token'] = 'Pages/converge_token_request';

//Job Checklists
$route['job_checklists/list'] = 'Job_Checklists/index';
$route['job_checklists/add_new'] = 'Job_Checklists/add_new';
$route['job_checklists/create_checklist'] = 'Job_Checklists/create_checklist';
$route['job_checklists/edit_checklist/(:num)'] = 'Job_Checklists/edit_checklist/$1';
$route['job_checklists/_load_checklist_items'] = 'Job_Checklists/ajax_load_checklist_items';
$route['job_checklists/_create_checklist_item'] = 'Job_Checklists/ajax_create_checklist_item';
$route['job_checklists/_delete_checklist_items'] = 'Job_Checklists/ajax_delete_checklist_items';
$route['job_checklists/_update_checklist_item'] = 'Job_Checklists/ajax_update_checklist_item';
$route['job_checklists/update_checklist'] = 'Job_Checklists/update_checklist';
$route['job_checklists/delete_checklist'] = 'Job_Checklists/delete_checklist';

//Business Profile front
$route['business/(:any)'] = 'Pages/front_company_business_profile/$1';