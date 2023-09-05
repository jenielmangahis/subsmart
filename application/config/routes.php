<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['translate_uri_dashes'] = false;

$route['customer/tickets/(:any)?'] = 'customer/ticket/$1';
$route['customer/_load_billing_credit_card_details'] = 'customer/ajax_load_company_billing_credit_card_details';
$route['customer/_update_billing_credit_card_details'] = 'customer/ajax_update_billing_credit_card_details';

$route['customer/add_data_sheet'] = 'customer/add_data_sheet';

$route['customer/jobs_list/(:num)'] = 'Customer/jobs_list/$1';
$route['customer/estimates_list/(:num)'] = 'Customer/estimates_list/$1';
$route['customer/workorders_list/(:num)'] = 'Customer/workorders_list/$1';
$route['customer/internal_notes/(:num)'] = 'Customer/internal_notes/$1';
$route['customer/_create_internal_notes'] = 'Customer/ajax_create_internal_notes';
$route['customer/_delete_internal_notes'] = 'Customer/ajax_delete_internal_notes';
$route['customer/_load_edit_internal_note'] = 'Customer/ajax_edit_internal_note';
$route['customer/_update_internal_notes'] = 'Customer/ajax_update_internal_notes';
$route['customer/inventory_list/(:num)'] = 'Customer/inventory_list/$1';
$route['customer/messages_list/(:num)'] = 'Customer/messages_list/$1';
$route['customer/_use_quick_note'] = 'Customer/ajax_use_quick_note';
$route['customer/_send_message'] = 'Customer/ajax_send_message';
$route['customer/_delete_customer_message'] = 'Customer/ajax_delete_customer_message';
$route['customer/credit_industry/(:num)'] = 'Customer/credit_industry/$1';
$route['customer/add_dispute_item/(:num)'] = 'Customer/add_new_dispute_item/$1';
$route['customer/_load_company_reasons'] = 'Customer/ajax_load_company_reason_list';
$route['customer/_create_company_reason'] = 'Customer/ajax_create_company_reason';
$route['customer/_create_dispute_item'] = 'Customer/ajax_create_dispute_item';
$route['customer/_delete_customer_dispute'] = 'Customer/ajax_delete_customer_dispute';
$route['customer/_edit_dispute_item'] = 'Customer/ajax_edit_dispute_item';
$route['customer/activities/(:num)'] = 'Customer/activities/$1';
$route['customer/_load_welcome_email_form'] = 'Customer/ajax_welcome_email_form';
$route['customer/_send_welcome_email'] = 'Customer/ajax_send_welcome_email';
$route['customer/_update_customer_dispute'] = 'Customer/ajax_update_customer_dispute';
$route['customer/_get_messages'] = 'Customer/ajax_get_messages';
$route['customer/_send_message'] = 'Customer/ajax_send_message';
$route['customer/_send_login_details'] = 'Customer/ajax_send_login_details';
$route['customer/_load_customer_address'] = 'Customer/ajax_load_customer_address';
$route['customer/_update_address_mobile'] = 'Customer/ajax_update_address_mobile';

$route['customer/_delete_esign_documents'] = 'Customer/ajax_delete_esign_documents';
$route['customer/_send_email'] = 'Customer/ajax_send_email';
$route['customer/_get_customer_lists'] = 'Customer/ajax_customer_lists';

//Credit Bureau
$route['credit_bureau/list'] = 'Credit_Bureau/index';
$route['credit_bureau/add_new'] = 'Credit_Bureau/add_new';
$route['credit_bureau/_create_credit_bureau'] = 'Credit_Bureau/ajax_create_credit_bureau';
$route['credit_bureau/_delete_credit_bureau'] = 'Credit_Bureau/ajax_delete_credit_bureau';
$route['credit_bureau/edit/(:num)'] = 'Credit_Bureau/edit/$1';
$route['credit_bureau/_update_credit_bureau'] = 'Credit_Bureau/ajax_update_credit_bureau';

//Creditor Furnisher
$route['creditor_furnisher/list'] = 'CreditorFurnisher/index';
$route['creditor_furnisher/add_new'] = 'CreditorFurnisher/add_new';
$route['creditor_furnisher/_create_furnisher'] = 'CreditorFurnisher/ajax_create_furnisher';
$route['creditor_furnisher/_delete_creditor_furnisher'] = 'CreditorFurnisher/ajax_delete_furnisher';
$route['creditor_furnisher/edit/(:num)'] = 'CreditorFurnisher/edit/$1';
$route['creditor_furnisher/_update_creditor_furnisher'] = 'CreditorFurnisher/ajax_update_creditor_furnisher';
$route['creditor_furnisher/_quick_save'] = 'CreditorFurnisher/ajax_quick_save';

//Quick Notes
$route['quick_notes/list'] = 'Quick_Notes/index';
$route['quick_notes/add_new'] = 'Quick_Notes/add_new';
$route['quick_notes/_create_quick_note'] = 'Quick_Notes/ajax_create_quick_note';
$route['quick_notes/_delete_quick_note'] = 'Quick_Notes/ajax_delete_quick_note';
$route['quick_notes/edit/(:num)'] = 'Quick_Notes/edit/$1';
$route['quick_notes/_update_quick_note'] = 'Quick_Notes/ajax_update_quick_note';

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
//$route['survey/(:num)']['GET'] = 'survey/preview/$1';
$route['survey/(:num)']['GET'] = 'pages/front_survey/$1';
$route['survey/edit/(:num)'] = 'survey/edit/$1';
$route['survey/delete/(:num)']['GET'] = 'survey/delete/$1';
$route['survey/preview/(:num)']['GET'] = 'survey/preview/$1';
$route['survey/create'] = 'survey/add';
$route['survey/add'] = 'survey/addSurvey';
$route['survey/upload/custombackgroundimage/(:any)'] = 'survey/uploadCustomBackgroundImage/$1';
$route['survey/home'] = 'survey/index';
$route['survey/question/(:any)/(:num)/(:num)'] = 'survey/addQuestionSettings/$1/$2/$3';
$route['survey/_load_survey_questions'] = 'Survey/ajax_load_survey_questions';
$route['survey/_delete_template_answer'] = 'Survey/ajax_delete_template_answer';
$route['survey/_update_settings'] = 'Survey/ajax_update_settings';
$route['survey/_delete'] = 'Survey/ajax_delete_survey';
$route['survey/_delete_theme'] = 'Survey/ajax_delete_theme';
$route['survey/_load_survey_logic_jump'] = 'Survey/ajax_load_survey_logic_jump';
$route['survey/_logic_add'] = 'Survey/ajax_logic_add';
$route['survey/_update_survey_logic'] = 'Survey/ajax_update_survey_logic';
$route['survey/_question_logic_jump'] = 'Pages/ajax_survey_question_logic_jump'; //Front

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
$route['survey/_load_themes_list'] = 'survey/ajax_load_themes_list';

//question
$route['survey/update/(:num)/(:any)/(:num)'] = 'survey/updateSurvey/$1/$2/$3';
$route['survey/update/question'] = 'survey/updateQuestion';
$route['survey/update/(:any)'] = 'survey/updateSurvey/$1';
//$route['survey/question/upload/(:num)'] = 'survey/addQuestionUpload/$1';
$route['survey/question/upload/(:num)'] = 'pages/surveyAddQuestionUpload/$1';
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
$route['survey/submit_answer/(:num)'] = 'pages/survey_answer/$1';


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
$route['email_automation/_delete_template'] = 'Email_Automation/ajax_delete_template';
$route['email_automation/_get_template_message'] = 'Email_Automation/ajax_get_template_message';
$route['email_automation/create_email_automation'] = 'Email_Automation/ajax_create_email_automation';
$route['email_automation/_generate_preview'] = 'Email_Automation/generate_preview';
$route['email_automation/_load_automation_list'] = 'Email_Automation/ajax_load_automation_list';
$route['email_automation/_update_automation_is_active'] = 'Email_Automation/ajax_update_automation_is_active';
$route['email_automation/_delete_automation'] = 'Email_Automation/ajax_delete_automation';
$route['email_automation/edit_automation'] = 'Email_Automation/edit_automation';
$route['email_automation/edit_automation/(:any)?'] = 'Email_Automation/edit_automation/$1';
$route['email_automation/_update_email_automation'] = 'Email_Automation/ajax_update_email_automation';

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
$route['accounting/tags/delete-tags']['POST'] = "accounting_controllers/tags/delete_tags";
$route['accounting/tags/transactions'] = "accounting_controllers/tags/transactions";
$route['accounting/tags/load-transactions']['post'] = "accounting_controllers/tags/load_transactions";
$route['accounting/tags/print-transactions']['post'] = "accounting_controllers/tags/print_transactions";
$route['accounting/tags/transactions/add-tags']['post'] = "accounting_controllers/tags/add_tags";
$route['accounting/tags/transactions/load-tags-to-remove']['post'] = "accounting_controllers/tags/load_tags_to_remove";
$route['accounting/tags/transactions/remove-tags']['post'] = "accounting_controllers/tags/remove_tags";

// Modals
$route['accounting/get-other-modals/(:any)'] = "accounting_modals/index/$1";
$route['accounting/apply-for-capital'] = 'accounting/apply_for_capital';
$route['accounting/submit-modal-form']['post'] = 'accounting_modals/action';
$route['accounting/get-job-tags'] = 'accounting_modals/get_job_tags';
$route['accounting/get-account-balance/(:any)'] = 'accounting_modals/getAccountBalance/$1';
$route['accounting/load-job-tags'] = 'accounting_modals/load_job_tags';
$route['accounting/submit-job-tag-form']['post'] = 'accounting_modals/submit_job_tag';
$route['accounting/get-job-tag-modal'] = 'accounting_modals/job_tag_modal';
$route['accounting/get-job-tag-form'] = 'accounting_modals/job_tag_form';
$route['accounting/get-group-tag-form'] = 'accounting_modals/group_job_tag_form';
$route['accounting/edit-group-tag-form'] = 'accounting_modals/edit_group_tag_form';
$route['accounting/get-payroll-form/(:any)'] = 'accounting_modals/get_payroll_form/$1';
$route['accounting/get-employee-pay-details']['post'] = 'accounting_modals/get_employee_pay_details';
$route['accounting/generate-payroll']['post'] = 'accounting_modals/generate_payroll';
$route['accounting/get-statement-customers']['post'] = 'accounting_modals/get_statement_customers';
$route['accounting/get-item-details/(:any)'] = 'accounting_modals/getItemDetails/$1';
$route['accounting/get-payable-bills']['post'] = 'accounting_modals/get_payable_bills';
$route['accounting/get-products-list-modal'] = 'accounting_modals/products_list_modal';
$route['accounting/get-items-list-modal'] = 'accounting_modals/items_list_modal';
$route['accounting/get-items-categories-list-modal'] = 'accounting_modals/get_items_categories_list_modal';
$route['accounting/get-package-list-modal'] = 'accounting_modals/get_package_list_modal';
$route['accounting/get-category-items/(:any)'] = 'accounting_modals/get_category_items/$1';
$route['accounting/get-package-details/(:any)'] = 'accounting_modals/get_package_details/$1';
$route['accounting/get-term-details/(:any)'] = 'accounting_modals/get_term_details/$1';
$route['accounting/get-vendor-details/(:any)'] = 'accounting_modals/get_vendor_details/$1';
$route['accounting/get-customer-details/(:any)'] = 'accounting_modals/get_customer_details/$1';
$route['accounting/get-employee-details/(:any)'] = 'accounting_modals/get_employee_details/$1';
$route['accounting/get-linkable-transactions/(:any)/(:any)'] = 'accounting_modals/get_linkable_transactions/$1/$2';
$route['accounting/get-transaction-details/(:any)/(:any)'] = 'accounting_modals/get_transaction_details/$1/$2';
$route['accounting/bill-payment-form/(:any)'] = 'accounting_modals/bill_payment_form/$1';
$route['accounting/get-bill-payment-bills']['post'] = 'accounting_modals/get_bill_payment_bills';
$route['accounting/get-bill-payment-credits']['post'] = 'accounting_modals/get_bill_payment_credits';
$route['accounting/load-checks']['post'] = 'accounting_modals/load_checks';
$route['accounting/get-checks']['post'] = 'accounting_modals/get_checks';
$route['accounting/remove-to-print']['post'] = 'accounting_modals/remove_to_print';
$route['accounting/print-preview-checks']['post'] = 'accounting_modals/print_preview_checks';
$route['accounting/success-print-checks-modal']['post'] = 'accounting_modals/success_print_checks_form';
$route['accounting/success-print-checks']['post'] = 'accounting_modals/success_print_checks';
$route['accounting/update-timesheet-settings/(:any)/(:any)'] = 'accounting_modals/update_timesheet_settings/$1/$2';
$route['accounting/get-last-timesheet/(:any)/(:any)'] = 'accounting_modals/get_last_timesheet/$1/$2';
$route['accounting/get-timesheet/(:any)'] = 'accounting_modals/get_timesheet/$1';
$route['accounting/get-add-payee-modal/(:any)'] = 'accounting_modals/get_add_payee_modal/$1';
$route['accounting/add-new-payee']['post'] = 'accounting_modals/add_new_payee';
$route['accounting/get-dropdown-choices'] = 'accounting_modals/get_dropdown_choices';
$route['accounting/get-add-vendor-details-modal'] = 'accounting_modals/add_vendor_details_modal';
$route['accounting/get-add-customer-details-modal'] = 'accounting_modals/add_customer_details_modal';
$route['accounting/add-full-payee-details']['post'] = 'accounting_modals/add_full_payee_details';
$route['accounting/get-first-detail-type/(:any)'] = 'accounting_modals/first_detail_type/$1';
$route['accounting/ajax-add-account']['post'] = 'accounting_modals/ajax_add_account';
$route['accounting/get-dropdown-modal/(:any)'] = 'accounting_modals/get_dropdown_modal/$1';
$route['accounting/ajax-add-payment-method']['post'] = 'accounting_modals/ajax_add_payment_method';
$route['accounting/ajax-add-term']['post'] = 'accounting_modals/ajax_add_payment_term';
$route['accounting/item-form/(:any)'] = 'accounting_modals/get_item_form/$1';
$route['accounting/ajax-add-item/(:any)']['post'] = 'accounting_modals/ajax_add_item/$1';
$route['accounting/get-account-details/(:any)'] = 'accounting_modals/get_account_details/$1';
$route['accounting/get-item-category-details/(:any)'] = 'accounting_modals/get_item_category_details/$1';
$route['accounting/get-sales-tax-category-details/(:any)'] = 'accounting_modals/get_sales_tax_category_details/$1';
$route['accounting/ajax-add-item-category']['post'] = 'accounting_modals/ajax_add_item_category';
$route['accounting/adjust-starting-value-form/(:any)'] = 'accounting_modals/adjust_starting_value_form/$1';
$route['accounting/adjust-starting-value/(:any)']['post'] = 'accounting_modals/adjust_starting_value/$1';
$route['accounting/get-linked-attachments/(:any)/(:any)'] = 'accounting_modals/get_linked_attachments/$1/$2';
$route['accounting/update-transaction/(:any)/(:any)']['post'] = 'accounting_modals/update_transaction/$1/$2';
$route['accounting/get-attachment-file-path/(:any)'] = 'accounting_modals/get_attachment_file_path/$1';
$route['accounting/view-transaction/(:any)/(:any)'] = 'accounting_modals/view_transaction/$1/$2';
$route['accounting/get-bill-payment-bills/(:any)']['post'] = 'accounting_modals/get_bills_to_pay/$1';
$route['accounting/get-bill-payment-credits/(:any)']['post'] = 'accounting_modals/get_payment_used_credits/$1';
$route['accounting/get-attachment/(:any)'] = 'accounting_modals/get_attachment/$1';
$route['accounting/get-existing-attachments-modal/(:any)'] = 'accounting_modals/get_existing_attachments_modal/$1';
$route['accounting/attach/(:any)/(:any)']['post'] = 'accounting_modals/attach/$1/$2';
$route['accounting/load-recent-transactions'] = 'accounting_modals/load_recent_transactions';
$route['accounting/delete-transaction/(:any)/(:any)']['DELETE'] = 'accounting_modals/delete_transaction/$1/$2';
$route['accounting/void-transaction/(:any)/(:any)'] = 'accounting_modals/void_transaction/$1/$2';
$route['accounting/print-purchase-order-modal/(:any)'] = 'accounting_modals/print_purchase_order_modal/$1';
$route['accounting/download-purchase-order-pdf/(:any)'] = 'accounting_modals/download_purchase_order/$1';
$route['accounting/send-purchase-order-email-modal/(:any)'] = 'accounting_modals/po_send_email_modal/$1';
$route['accounting/send-purchase-order-email/(:any)']['post'] = 'accounting_modals/send_purchase_order_email/$1';
$route['accounting/get-timesheet-activities']['post'] = 'accounting_modals/get_timesheet_activities';
$route['accounting/copy-transaction/(:any)/(:any)'] = 'accounting_modals/copy_transaction/$1/$2';
$route['accounting/get-customer-invoices/(:any)']['post'] = 'accounting_modals/get_customer_invoices/$1';
$route['accounting/get-customer-credits/(:any)']['post'] = 'accounting_modals/get_customer_credits/$1';
$route['accounting/find-customer-by-invoice-no']['post'] = 'accounting_modals/find_customer_by_invoice_no';
$route['accounting/load-payment-invoices/(:any)']['post'] = 'accounting_modals/load_payment_invoices/$1';
$route['accounting/load-payment-credits/(:any)']['post'] = 'accounting_modals/load_payment_credits/$1';
$route['accounting/print-payment-modal/(:any)'] = 'accounting_modals/print_payment/$1';
$route['accounting/download-payment-pdf/(:any)'] = 'accounting_modals/download_payment_pdf/$1';
$route['accounting/add-package']['post'] = 'accounting_modals/add_package';
$route['accounting/get-last-invoice-number'] = 'accounting_modals/get_last_invoice_number';
$route['accounting/print-invoice-modal/(:any)'] = 'accounting_modals/print_invoice/$1';
$route['accounting/download-invoice-pdf/(:any)'] = 'accounting_modals/download_invoice_pdf/$1';
$route['accounting/print-credit-memo-modal/(:any)'] = 'accounting_modals/print_credit_memo/$1';
$route['accounting/download-credit-memo-pdf/(:any)'] = 'accounting_modals/download_credit_memo_pdf/$1';
$route['accounting/print-sales-receipt-modal/(:any)'] = 'accounting_modals/print_sales_receipt/$1';
$route['accounting/download-sales-receipt-pdf/(:any)'] = 'accounting_modals/download_sales_receipt_pdf/$1';
$route['accounting/print-refund-receipt-modal/(:any)'] = 'accounting_modals/print_refund_receipt/$1';
$route['accounting/download-refund-receipt-pdf/(:any)'] = 'accounting_modals/download_refund_receipt_pdf/$1';
$route['accounting/preview-and-print-sample']['post'] = 'accounting_modals/preview_and_print_sample';
$route['accounting/save-print-checks-settings']['post'] = 'accounting_modals/save_print_checks_settings';

$route['accounting/print-sales-transactions']['post'] = 'accounting_modals/print_sales_transactions';
$route['accounting/send-sales-transactions']['post'] = 'accounting_modals/send_sales_transactions';
$route['accounting/send-invoice-reminders']['post'] = 'accounting_modals/send_invoice_reminders';

$route['accounting/lists'] = 'accounting/lists';

// Accounting attachments
$route['accounting/attachments'] = 'accounting_controllers/attachments/index';
$route['accounting/attachments/upload']['post'] = 'accounting_controllers/attachments/upload';
$route['accounting/attachments/load-attachments']['post'] = 'accounting_controllers/attachments/load_attachment_files';
$route['accounting/attachments/download'] = "accounting_controllers/attachments/download";
$route['accounting/attachments/update/(:any)']['post'] = "accounting_controllers/attachments/edit/$1";
$route['accounting/attachments/delete/(:any)']['DELETE'] = "accounting_controllers/attachments/delete/$1";
$route['accounting/attachments/attach']['post'] = 'accounting_controllers/attachments/attach';
$route['accounting/attachments/get-all-attachments-ajax'] = 'accounting_controllers/attachments/get_all_attachments';
$route['accounting/attachments/get-unlinked-attachments-ajax'] = 'accounting_controllers/attachments/get_unlinked_attachments';
$route['accounting/attachments/print-attachments']['post'] = 'accounting_controllers/attachments/print_attachments';
$route['accounting/attachments/export']['post'] = 'accounting_controllers/attachments/export';

// Accounting payment methods
$route['accounting/payment-methods'] = 'accounting_controllers/payment_methods/index';
$route['accounting/payment-methods/load-payment-methods']['post'] = 'accounting_controllers/payment_methods/load_payment_methods';
$route['accounting/payment-methods/add']['post'] = 'accounting_controllers/payment_methods/add';
$route['accounting/payment-methods/edit/(:any)'] = 'accounting_controllers/payment_methods/edit/$1';
$route['accounting/payment-methods/delete/(:any)']['DELETE'] = "accounting_controllers/payment_methods/inactive/$1";
$route['accounting/payment-methods/activate/(:any)'] = "accounting_controllers/payment_methods/activate/$1";
$route['accounting/payment-methods/update/(:any)']['post'] = "accounting_controllers/payment_methods/update/$1";
$route['accounting/payment-methods/print']['post'] = 'accounting_controllers/payment_methods/print';

// Accounting recurring transactions
$route['accounting/recurring-transactions'] = "accounting_controllers/recurring_transactions/index";
$route['accounting/recurring-transactions/load-recurring-transactions']['post'] = "accounting_controllers/recurring_transactions/load_recurring_transactions";
$route['accounting/recurring-transactions/delete/(:any)']['DELETE'] = "accounting_controllers/recurring_transactions/delete/$1";
$route['accounting/recurring-transactions/get-details/(:any)'] = "accounting_controllers/recurring_transactions/get/$1";
$route['accounting/recurring-transactions/update/(:any)/(:any)']['post'] = "accounting_controllers/recurring_transactions/update/$1/$2";
$route['accounting/recurring-transactions/print-recurring-transactions']['post'] = "accounting_controllers/recurring_transactions/print";
$route['accounting/recurring-transactions/skip-next-date/(:any)'] = "accounting_controllers/recurring_transactions/skip_next_date/$1";
$route['accounting/recurring-transactions/pause/(:any)'] = "accounting_controllers/recurring_transactions/pause/$1";
$route['accounting/recurring-transactions/resume/(:any)'] = "accounting_controllers/recurring_transactions/resume/$1";
$route['accounting/recurring-transactions/reminders-list'] = "accounting_controllers/recurring_transactions/reminders_list";
$route['accounting/recurring-transactions/load-reminders-list']['post'] = "accounting_controllers/recurring_transactions/load_reminders_list";
$route['accounting/recurring-transactions/skip-batch']['post'] = "accounting_controllers/recurring_transactions/skip_batch";

// Accounting payment terms
$route['accounting/terms'] = "accounting_controllers/payment_terms/index";
$route['accounting/terms/add'] = "accounting_controllers/payment_terms/add";
$route['accounting/terms/edit/(:any)'] = 'accounting_controllers/payment_terms/edit/$1';
$route['accounting/terms/delete/(:any)']['DELETE'] = "accounting_controllers/payment_terms/delete/$1";
$route['accounting/terms/activate/(:any)'] = "accounting_controllers/payment_terms/activate/$1";
$route['accounting/terms/update/(:any)']['post'] = "accounting_controllers/payment_terms/update/$1";
$route['accounting/terms/ajax-add-term']['post'] = 'accounting_controllers/payment_terms/ajax_add_term';
$route['accounting/terms/print']['post'] = 'accounting_controllers/payment_terms/print';

$route['accounting/customers'] = 'accounting_controllers/customers/index';
$route['accounting/customers/batch-select-customer-type']['post'] = 'accounting_controllers/customers/batch_select_customer_type';
$route['accounting/customers/view/(:any)'] = 'accounting_controllers/customers/view/$1';
$route['accounting/customers/add']['post'] = 'accounting_controllers/customers/add';
$route['accounting/customers/update/(:any)']['post'] = 'accounting_controllers/customers/update/$1';
$route['accounting/customers/export'] = 'accounting_controllers/customers/export';
$route['accounting/customers/add-customer-type']['post'] = 'accounting_controllers/customers/add_customer_type';
$route['accounting/customers/update-customer-type/(:any)']['post'] = 'accounting_controllers/customers/update_customer_type/$1';
$route['accounting/customers/delete-customer-type/(:any)']['DELETE'] = 'accounting_controllers/customers/delete_customer_type/$1';
$route['accounting/customers/update-estimate-status/(:any)']['post'] = 'accounting_controllers/customers/update_estimate_status/$1';
$route['accounting/customers/(:any)/export-transactions']['post'] = 'accounting_controllers/customers/export_transactions/$1';
$route['accounting/customers/create-invoice/(:any)/(:any)'] = 'accounting_controllers/customers/create_invoice/$1/$2';
$route['accounting/customers/print-transaction/(:any)/(:any)'] = 'accounting_controllers/customers/print_transaction/$1/$2';
$route['accounting/customers/send-transaction/(:any)/(:any)']['post'] = 'accounting_controllers/customers/send_transaction/$1/$2';

$route['accounting/deposits'] = 'accounting_controllers/deposits/index';

$route['accounting/all-sales'] = 'accounting_controllers/all_sales/index';
$route['accounting/all-sales/export']['post'] = 'accounting_controllers/all_sales/export';

$route['accounting/credit-notes'] = 'accounting_controllers/credit_notes/index';
$route['accounting/credit-notes/export']['post'] = 'accounting_controllers/credit_notes/export';

$route['accounting/sales-overview'] = 'accounting/salesoverview';
// $route['accounting/all-sales'] = 'accounting/allsales';
$route['accounting/filter/all-sales'] = 'accounting/filter_all_sales';
$route['accounting/filter/invoices-page'] = 'accounting/invoices_page_filter';
$route['invoice-page/get/send-invoice-reminder'] = 'accounting/get_info_for_send_invoice_reminder';
$route['invoice-page/send/send-invoice-reminder'] = 'accounting/send_invoice_reminder';
$route['invoice-page/print-batch'] = 'accounting/invoice_print_batch';
$route['invoice-page/delete-batch'] = 'accounting/invoice_delete_batch';
$route['invoice-page/send-batch'] = 'accounting/invoice_send_batch';
$route['invoice-page/get/receive-payment'] = 'accounting/get_customer_received_payment';
$route['invoice-viewer'] = 'accounting/invoice_viewer';
$route['accounting/customer-reminder/send/by-batch'] = 'accounting/send_customer_reminder_by_batch';
$route['accounting/transaction/send/by-batch'] = 'accounting/send_transaction_by_batch';
$route['cahsflow/chash-balance/chart/updated'] = 'accounting/update_cash_balance_chart';
$route['cahsflow/money-in-out/chart/updated'] = 'accounting/update_money_in_out_chart';
$route['management-report/company_overview/add-preliminary-page'] = 'accounting/management_report_add_prelim_page_html';
$route['management-report/company-overview/add-new-report-section'] = 'accounting/management_report_add_new_report_section_html';
$route['management-report/get-management-report'] = 'accounting/get_management_report';
$route['management-report/update'] = 'accounting/update_management_report';
$route['management-report/preliminary-page/delete'] = 'accounting/managenent_report_delete_preliminary_page';
$route['management-report/delete-report-page'] = 'accounting/managenent_report_delete_report_page';
$route['management-report/cover-page/changed'] = 'accounting/create_cover_page_pdf_template';
$route['management-report/send'] = 'accounting/management_report_send_email';
$route['management-report/export/pdf'] = 'accounting/management_report_generate_pdf';
$route['management-report/export/docx'] = 'accounting/management_report_generate_docx';
$route['management-report/generate/preview'] = 'accounting/management_report_generate_pdf';
$route['import/customer'] = 'accounting/import_customers';


// Accounting products and services
$route['accounting/products-and-services'] = 'accounting_controllers/products_and_services/index';
$route['accounting/products-and-services/inactive/(:any)/(:any)']['DELETE'] = "accounting_controllers/products_and_services/inactive/$1/$2";
$route['accounting/products-and-services/active/(:any)/(:any)'] = "accounting_controllers/products_and_services/active/$1/$2";
$route['accounting/products-and-services/(:any)/create']['post'] = 'accounting_controllers/products_and_services/create/$1';
$route['accounting/products-and-services/update/(:any)/(:any)']['post'] = 'accounting_controllers/products_and_services/update/$1/$2';
$route['accounting/products-and-services/assign-category/(:any)']['post'] = 'accounting_controllers/products_and_services/assign_category/$1';
$route['accounting/products-and-services/batch-action/(:any)']['post'] = 'accounting_controllers/products_and_services/batch_action/$1';
$route['accounting/products-and-services/print-table']['post'] = 'accounting_controllers/products_and_services/print_table';
$route['accounting/products-and-services/export-table']['post'] = 'accounting_controllers/products_and_services/export_table';
$route['accounting/products-and-services/reorder-items']['post'] = 'accounting_controllers/products_and_services/reorder_items';
$route['accounting/products-and-services/get-item-details/(:any)/(:any)'] = 'accounting_controllers/products_and_services/get_item_details/$1/$2';
$route['accounting/products-and-services/get-item-locations/(:any)'] = 'accounting_controllers/products_and_services/get_item_locations/$1';
$route['accounting/products-and-services/get-import-data']['post'] = 'accounting_controllers/products_and_services/get_import_data';
$route['accounting/products-and-services/import-items-data']['post'] = 'accounting_controllers/products_and_services/import_items_data';

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
$route['accounting/chart-of-accounts/print-table']['post'] = 'accounting_controllers/chart_of_accounts/print_table';
$route['accounting/chart-of-accounts/update-accounts-name']['post'] = 'accounting_controllers/chart_of_accounts/update_account_names';
$route['accounting/chart-of-accounts/view-register/(:any)'] = 'accounting_controllers/chart_of_accounts/view_register/$1';
$route['accounting/chart-of-accounts/(:any)/load-registers']['post'] = 'accounting_controllers/chart_of_accounts/load_registers/$1';
$route['accounting/chart-of-accounts/view-register/(:any)/print-transactions']['post'] = 'accounting_controllers/chart_of_accounts/print_transactions/$1';
$route['accounting/chart-of-accounts/view-register/(:any)/export-table']['post'] = 'accounting_controllers/chart_of_accounts/export_transactions/$1';
$route['accounting/chart-of-accounts/(:any)/save-transaction/(:any)']['post'] = 'accounting_controllers/chart_of_accounts/save_transaction/$1/$2';
$route['accounting/chart-of-accounts/add-attachment']['post'] = 'accounting_controllers/chart_of_accounts/add_attachment';
$route['accounting/chart-of-accounts/inactive-batch']['post'] = 'accounting_controllers/chart_of_accounts/inactive_batch';
$route['accounting/chart-of-accounts/get-import-data']['post'] = 'accounting_controllers/chart_of_accounts/get_import_data';
$route['accounting/chart-of-accounts/import-accounts-data']['post'] = 'accounting_controllers/chart_of_accounts/import_accounts_data';

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
$route['accounting/employees/view/(:any)'] = 'accounting_controllers/employees/view/$1';
$route['accounting/employees/create']['post'] = 'accounting_controllers/employees/create';
$route['accounting/employees/update/(:any)/(:any)']['post'] = 'accounting_controllers/employees/update/$1/$2';
$route['accounting/employees/delete/(:any)'] = 'accounting_controllers/employees/delete/$1';
$route['accounting/employees/set-status/(:any)/(:any)'] = 'accounting_controllers/employees/set_status/$1/$2';
$route['accounting/employees/add-pay-schedule-form'] = 'accounting_controllers/employees/pay_schedule_form';
$route['accounting/employees/add-pay-schedule']['post'] = 'accounting_controllers/employees/add_pay_schedule';
$route['accounting/employees/get-pay-schedule/(:any)'] = 'accounting_controllers/employees/get_pay_schedule/$1';
$route['accounting/employees/update-pay-schedule/(:any)']['post'] = 'accounting_controllers/employees/update_pay_schedule/$1';
$route['accounting/employees/get-pay-date/(:any)'] = 'accounting_controllers/employees/get_pay_date/$1';
$route['accounting/employees/generate-commission-payroll']['post'] = 'accounting_controllers/employees/generate_commission_payroll';
$route['accounting/employees/get-employee-pay-details/(:any)'] = 'accounting_controllers/employees/get_employee_pay_details/$1';
$route['accounting/employees/bonus-only-payroll-form/(:any)'] = 'accounting_controllers/employees/bonus_only_form/$1';
$route['accounting/employees/generate-bonus-payroll/(:any)']['post'] = 'accounting_controllers/employees/generate_bonus_payroll/$1';
$route['accounting/employees/paycheck-list'] = 'accounting_controllers/employees/paycheck_list';
$route['accounting/employees/add-work-location'] = 'accounting_controllers/employees/add_work_location';

$route['accounting/contractors'] = 'accounting_controllers/contractors/index';
$route['accounting/contractors/load']['post'] = 'accounting_controllers/contractors/load_contractors';
$route['accounting/contractors/add']['post'] = 'accounting_controllers/contractors/add';
$route['accounting/contractors/view/(:any)'] = 'accounting_controllers/contractors/view/$1';
$route['accounting/contractors/(:any)/update-details']['post'] = 'accounting_controllers/contractors/update_details/$1';
$route['accounting/contractors/set-status/(:any)/(:any)'] = 'accounting_controllers/contractors/set_status/$1/$2';
$route['accounting/contractors/(:any)/load-payments']['post'] = 'accounting_controllers/contractors/load_contractor_payments/$1';
$route['accounting/contractors/(:any)/get-payments-total']['post'] = 'accounting_controllers/contractors/get_payments_total/$1';

$route['accounting/vendors'] = 'accounting_controllers/vendors/index';
$route['accounting/vendors/load']['post'] = 'accounting_controllers/vendors/load_vendors';
$route['accounting/vendors/add']['post'] = 'accounting_controllers/vendors/add';
$route['accounting/vendors/view/(:any)'] = 'accounting_controllers/vendors/view/$1';
$route['accounting/vendors/make-inactive']['post'] = 'accounting_controllers/vendors/make_inactive';
$route['accounting/vendors/make-active']['post'] = 'accounting_controllers/vendors/make_active';
$route['accounting/vendors/print-vendors']['post'] = 'accounting_controllers/vendors/print';
$route['accounting/vendors/export-vendors']['post'] = 'accounting_controllers/vendors/export';
$route['accounting/vendors/(:any)/edit'] = 'accounting_controllers/vendors/edit/$1';
$route['accounting/vendors/(:any)/update']['post'] = 'accounting_controllers/vendors/update/$1';
$route['accounting/vendors/update-attachments/(:any)']['post'] = 'accounting_controllers/vendors/update_attachments/$1';
$route['accounting/vendors/remove-attachment/(:any)']['post'] = 'accounting_controllers/vendors/remove_attachment/$1';
$route['accounting/vendors/(:any)/load-transactions']['post'] = 'accounting_controllers/vendors/load_transactions/$1';
$route['accounting/vendors/(:any)/categorize-transactions/(:any)']['post'] = 'accounting_controllers/vendors/categorize_transactions/$1/$2';
$route['accounting/vendors/(:any)/update-transaction-category']['post'] = 'accounting_controllers/vendors/update_transaction_category/$1';
$route['accounting/vendors/print-transaction/(:any)/(:any)'] = 'accounting_controllers/vendors/print_transaction/$1/$2';
$route['accounting/vendors/print-multiple-transactions']['post'] = 'accounting_controllers/vendors/print_multiple';
$route['accounting/vendors/(:any)/print-transactions']['post'] = 'accounting_controllers/vendors/print_transactions/$1';
$route['accounting/vendors/(:any)/export-transactions']['post'] = 'accounting_controllers/vendors/export_transactions/$1';
$route['accounting/vendors/get-import-data']['post'] = 'accounting_controllers/vendors/get_import_data';
$route['accounting/vendors/import-vendors-data']['post'] = 'accounting_controllers/vendors/import_vendors_data';

$route['accounting/expenses'] = 'accounting_controllers/expenses/index';
$route['accounting/expenses/get-expense-transactions']['post'] = 'accounting_controllers/expenses/get_expense_transactions';
$route['accounting/expenses/categorize-transactions/(:any)']['post'] = 'accounting_controllers/expenses/categorize_transactions/$1';
$route['accounting/expenses/print-multiple-transactions']['post'] = 'accounting_controllers/expenses/print_multiple';
$route['accounting/expenses/print-transaction/(:any)/(:any)'] = 'accounting_controllers/expenses/print_transaction/$1/$2';
$route['accounting/expenses/get-attach-file-modal/(:any)/(:any)'] = 'accounting_controllers/expenses/attach_file_modal/$1/$2';
$route['accounting/expenses/attach-files/(:any)/(:any)']['post'] = 'accounting_controllers/expenses/attach_files/$1/$2';
$route['accounting/expenses/attach/(:any)/(:any)']['post'] = 'accounting_controllers/expenses/attach/$1/$2';
$route['accounting/expenses/print-transactions']['post'] = 'accounting_controllers/expenses/print_transactions';
$route['accounting/expenses/export']['post'] = 'accounting_controllers/expenses/export';
$route['accounting/expenses/update-transaction-category']['post'] = 'accounting_controllers/expenses/update_transaction_category';
$route['accounting/expenses/copy-to-bill/(:any)'] = 'accounting_controllers/expenses/copy_to_bill/$1';

$route['accounting/reports'] = 'accounting_controllers/reports/index';
$route['accounting/reports/add-to-favorites/(:any)'] = 'accounting_controllers/reports/add_to_favorites/$1';
$route['accounting/reports/remove-from-favorites/(:any)'] = 'accounting_controllers/reports/remove_from_favorites/$1';
$route['accounting/reports/custom'] = 'accounting_controllers/reports/custom';
$route['accounting/reports/management'] = 'accounting_controllers/reports/management';
$route['accounting/reports/activities'] = 'accounting_controllers/reports/activities';
$route['accounting/reports/analytics'] = 'accounting_controllers/reports/analytics';
$route['accounting/reports/payscale'] = 'accounting_controllers/reports/payscale';
$route['accounting/reports/audit-log'] = 'accounting_controllers/reports/audit_log';
$route['accounting/reports/ffcra-cares-act-report'] = 'accounting_controllers/reports/ffcra_cares_act_report';
$route['accounting/reports/ffcra-cares-act-report/export'] = 'accounting_controllers/reports/ffcra_cares_act_report_export';
$route['accounting/reports/view-report/(:any)'] = 'accounting_controllers/reports/view_report/$1';
$route['accounting/reports/(:any)/export']['post'] = 'accounting_controllers/reports/export/$1';
$route['accounting/reports/(:any)/update-note']['post'] = 'accounting_controllers/reports/update_note/$1';
$route['accounting/reports/add-custom-report-group']['post'] = 'accounting_controllers/reports/add_custom_report_group';
$route['accounting/reports/save-custom-report']['post'] = 'accounting_controllers/reports/save_custom_report';
$route['accounting/reports/check-custom-report-name']['post'] = 'accounting_controllers/reports/check_name';
$route['accounting/reports/generate-paychecks-pdf']['post'] = 'accounting_controllers/reports/generate_paychecks_pdf';
$route['accounting/reports/(:any)/email']['post'] = 'accounting_controllers/reports/email/$1';

$route['accounting/receipts/reviewed'] = 'accounting/reviewed_receipts';

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
$route['booking/delete_inquiry'] = 'booking/delete_inquiry';
$route['booking/_view_inquiry_details'] = 'booking/ajax_view_inquiry';
//$route['booking/products'] = 'booking/front_items';
//$route['booking/products/(:any)'] = 'booking/front_items/$1';
//$route['booking/products_schedule/(:any)'] = 'booking/front_schedule/$1'; //Moved to pages controller to remove auth function
$route['booking/_product_details'] = 'booking/ajax_get_product_details';
//$route['booking/_add_cart_item'] = 'booking/ajax_update_cart_item'; //Moved to pages controller to remove auth function
//$route['booking/_add_cart_coupon'] = 'booking/ajax_update_cart_coupon'; //Moved to pages controller to remove auth function
$route['booking/_delete_cart_item'] = 'booking/ajax_delete_cart_item';
//$route['booking/_load_week_schedule'] = 'booking/ajax_load_week_schedule'; //Moved to pages controller to remove auth function
//$route['booking/_set_booking_schedule'] = 'booking/ajax_user_set_schedule'; //Moved to pages controller to remove auth function
//$route['booking/product_booking_form/(:any)'] = 'booking/front_booking_form/$1'; //Moved to pages controller to remove auth function
//$route['booking/save_booking_inquiry'] = 'booking/save_product_booking'; //Moved to pages controller to remove auth function
//$route['booking/_delete_coupon'] = 'booking/ajax_delete_coupon'; //Moved to pages controller to remove auth function

$route['nsmart_plans/index'] = 'Nsmart_Plans/index';
$route['nsmart_plans/add_new_plan'] = 'Nsmart_Plans/add_new_plan';
$route['nsmart_plans/create_plan'] = 'Nsmart_Plans/create_plan';
$route['nsmart_plans/edit_plan/(:any)'] = 'Nsmart_Plans/edit_plan/$1';
$route['nsmart_plans/update_plan'] = 'Nsmart_Plans/update_plan';
$route['nsmart_plans/delete_plan'] = 'Nsmart_Plans/delete_plan';

$route['plans/delete'] = 'Plans/delete_plan';

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

$route['notification/_calendar_notification_counter'] = 'Notification_Counter/ajax_calendar_notification_counter';

$route['before-after/save-before-after'] = 'before_after/saveBeforeAfter';
$route['before-after/update-before-after'] = 'before_after/updateBeforeAfter';
$route['before-after/edit/(:num)'] = 'before_after/edit/$1';
$route['before-after/delete/(:num)'] = 'before_after/delete/$1';
$route['before-after/delete_image'] = 'before_after/delete_image';

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
$route['settings/_create_email_template'] = 'Settings/ajax_create_email_template';
$route['settings/_update_email_template'] = 'Settings/ajax_update_email_template';
$route['settings/_create_sms_template'] = 'Settings/ajax_create_sms_template';
$route['settings/edit_sms_template/(:any)'] = 'Settings/edit_sms_template/$1';
$route['settings/_update_sms_template'] = 'Settings/ajax_update_sms_template';
$route['settings/_edit_sms_template'] = 'Settings/ajax_edit_sms_template';

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
$route['sms_campaigns/invoice_pdf/(:any)'] = 'Sms_Campaigns/campaign_invoice_pdf/$1';

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
$route['sms_automation/_view_sms_automation'] = 'Sms_Automation/ajax_view_sms_automation';

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
$route['calendar/_load_upcoming_service_tickets'] = 'Workcalender/ajax_load_upcoming_service_tickets';
$route['calendar/_update_drop_event'] = 'Workcalender/ajax_update_event';
$route['calendar/_update_drop_google_event'] = 'Workcalender/ajax_update_google_event';
$route['calendar/_create_appointment'] = 'Workcalender/ajax_create_appointment';
$route['calendar/_view_appointment'] = 'Workcalender/ajax_view_appointment';
$route['calendar/_edit_appointment'] = 'Workcalender/ajax_edit_appointment';
$route['calendar/_update_appointment'] = 'Workcalender/ajax_update_appointment';
$route['calendar/_delete_appointment'] = 'Workcalender/ajax_delete_appointment';
$route['calendar/_appointment_checkout'] = 'Workcalender/ajax_checkout_appointment';
$route['calendar/_save_checkout_items'] = 'Workcalender/ajax_save_checkout_items';
$route['calendar/_appointment_cash_checkout'] = 'Workcalender/ajax_appointment_cash_checkout';
$route['calendar/_appointment_converge_checkout'] = 'Workcalender/ajax_appointment_converge_checkout';
$route['calendar/_get_main_calendar_resource_users'] = 'Workcalender/main_calendar_resource_users';
$route['calendar/_load_item_list'] = 'Workcalender/ajax_load_checkout_item_list';
$route['calendar/_create_appointment_wait_list'] = 'Workcalender/ajax_create_appointment_wait_list';
$route['calendar/_load_wait_list'] = 'Workcalender/ajax_load_wait_list';
$route['calendar/_load_edit_wait_list'] = 'Workcalender/ajax_load_edit_wait_list';
$route['calendar/_update_appointment_wait_list'] = 'Workcalender/ajax_update_appointment_waitlist';
$route['calendar/_view_appointment_payment_details'] = 'Workcalender/ajax_view_appointment_payment_details';
$route['calendar/_update_calendar_drop_waitlist'] = 'Workcalender/ajax_update_calendar_drop_waitlist';
$route['calendar/_update_employee_filter'] = 'Workcalender/ajax_update_calendar_employee_filter';
$route['calendar/_set_appointment_paid'] = 'Workcalender/ajax_set_appointment_paid';
$route['calendar/_load_upcoming_schedules'] = 'Workcalender/ajax_load_upcoming_schedules';
$route['calendar/_load_upcoming_calendar_by_date'] = 'Workcalender/ajax_load_upcoming_calendar_by_date';
$route['calendar/_add_to_google_calendar'] = 'Workcalender/ajax_add_to_google_calendar';
//TC Off Schedule
$route['calendar/_create_technician_off_schedule'] = 'Workcalender/ajax_create_technician_off_schedule';
$route['calendar/_view_tcoff'] = 'Workcalender/ajax_load_view_tcoff';
$route['calendar/_delete_tcoff'] = 'Workcalender/ajax_delete_tcoff';
$route['calendar/_update_technician_off_schedule'] = 'Workcalender/ajax_update_technician_off_schedule';

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
$route['workorder/_load_count_summary'] = 'Workorder/ajax_load_count_summary';
$route['workorder/_delete_custom_field'] = 'Workorder/ajax_delete_custom_field';
$route['workorder/_create_checklist'] = 'Workorder/ajax_save_checklist';
$route['workorder/_update_checklist'] = 'Workorder/ajax_update_checklist';
$route['workorder/_delete_checklist'] = 'Workorder/ajax_delete_checklist';
$route['workorder/_create_workorder_priority'] = 'Workorder/ajax_create_workorder_priority';
$route['workorder/_update_workorder_priority'] = 'Workorder/ajax_update_workorder_priority';
$route['workorder/_quick_view_details'] = 'Workorder/ajax_quick_view_details';
$route['workorder/_edit/(:num)'] = 'Workorder/redirect_edit/$1';
$route['workorder/_quick_delete_workorder'] = 'Workorder/ajax_quick_delete_workorder';

//workstatus
$route['workstatus/_create_workorder_type'] = 'Workstatus/ajax_save_workorder_type';
$route['workstatus/_update_workorder_type'] = 'Workstatus/ajax_update_workorder_type';

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
$route['registration/_create_registration'] = 'Register/ajax_create_registration';
$route['registration/_converge_request_token'] = 'Register/ajax_converge_token_request';
$route['registration/_pay_subscription'] = 'Register/ajax_converge_payment';

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
$route['users/export_list'] = 'Users/user_export';
$route['users/_delete_user'] = 'Users/ajax_delete_user';
$route['user/_admin_switch'] = 'Users/ajax_admin_switch'; //Switch to admin
$route['user/_load_edit_adt_portal_login_details'] = 'Users/ajax_load_edit_adt_portal_login_details';
$route['user/_update_adt_portal_login_details'] = 'Users/ajax_update_adt_portal_login_details';
$route['user/_update_business_details'] = 'Users/ajax_update_business_details';

//Jobs
$route['job/details/(:any)'] = 'job/details/$1';
$route['job/_load_upcoming_jobs'] = 'Job/ajax_load_upcoming_jobs';
$route['job/bird_eye_view'] = 'Workorder/map';
$route['job/_load_job_payments'] = 'Job/ajax_load_job_payments';
$route['job/_create_job_payment'] = 'Job/ajax_create_job_payment';
$route['job/edit_job_item/(:num)'] = 'Job/edit_job_item/$1';

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
$route['credit_notes/_update_credit_note_settings'] = 'Credit_Notes/ajax_update_credit_note_settings';

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

//Customer Login
$route['login/customer'] = 'Login/customer';

//Customer Access
$route['acs_access/dashboard'] = 'AcsAccess/dashboard';
$route['acs_access/messages'] = 'AcsAccess/messages';
$route['acs_access/logout'] = 'AcsAccess/logout';
$route['acs_access/_load_message_replies'] = 'AcsAccess/ajax_load_messages_list';
$route['acs_access/_load_message_thread'] = 'AcsAccess/ajax_load_message_thread';
$route['acs_access/_send_message_reply'] = 'AcsAccess/ajax_send_message_reply';
$route['acs_access/_load_sent_messages'] = 'AcsAccess/ajax_load_sent_messages';
$route['acs_access/_send_message'] = 'AcsAccess/ajax_send_message';
$route['acs_access/_notifications'] = 'AcsAccess/ajax_notifications';
$route['acs_access/_clear_notifications'] = 'AcsAccess/ajax_clear_notifications';
$route['acs_access/notifications'] = 'AcsAccess/notifications';

//Cards File
$route['cards_file/list'] = 'CardsFile/index';
$route['cards_file/add_new'] = 'CardsFile/add_new_card';
$route['cards_file/create_new_card'] = 'CardsFile/create_new_card';
$route['cards_file/_update_primary_card'] = 'CardsFile/update_primary_card';
$route['cards_file/delete_card'] = 'CardsFile/delete_card';
$route['cards_file/test_card'] = 'CardsFile/test_card';
$route['cards_file/edit/(:any)'] = 'CardsFile/edit_card/$1';
$route['cards_file/update_card'] = 'CardsFile/update_card';
$route['cards_file/_create_card_vault'] = 'CardsFile/ajax_create_card_vault';
$route['cards_file/_edit_card_vault'] = 'CardsFile/ajax_edit_card_vault';
$route['cards_file/_update_card_vault'] = 'CardsFile/ajax_update_card_vault';

//Tools
$route['tools/_get_converge_api_credentials'] = 'Tools/ajax_load_company_converge_form';
$route['tools/_activate_company_converge'] = 'Tools/ajax_activate_company_online_payment_account';
$route['tools/_activate_company_stripe'] = 'Tools/ajax_activate_company_online_payment_account';
$route['tools/_activate_company_paypal'] = 'Tools/ajax_activate_company_online_payment_account';
$route['tools/_activate_company_braintree'] = 'Tools/ajax_activate_company_online_payment_account';
$route['tools/_get_stripe_api_credentials'] = 'Tools/ajax_load_company_stripe_form';
$route['tools/_get_paypal_api_credentials'] = 'Tools/ajax_load_company_paypal_form';
$route['tools/_get_nmi_api_credentials'] = 'Tools/ajax_load_company_nmi_form';
$route['tools/_get_braintree_api_credentials'] = 'Tools/ajax_load_company_braintree_form';
$route['tools/_activate_company_nmi'] = 'Tools/ajax_activate_company_online_payment_account';
$route['tools/activate_stripe'] = 'Debug/activateStripe';
$route['tools/_get_ring_central_credentials'] = 'Tools/ajax_load_company_ring_central';
$route['tools/_get_vonage_credentials'] = 'Tools/ajax_load_company_vonage';
$route['tools/_activate_company_ring_central'] = 'Tools/ajax_activate_company_ring_central';
$route['tools/_activate_company_vonage'] = 'Tools/ajax_activate_company_vonage';
$route['tools/_update_company_default_sms_api'] = 'Tools/ajax_update_company_default_sms_api';
$route['tools/_get_twilio_credentials'] = 'Tools/ajax_load_company_twilio';
$route['tools/_activate_company_twilio'] = 'Tools/ajax_activate_company_twilio';
$route['tools/_get_plaid_api_credentials'] = 'Tools/ajax_load_company_plaid_form';
$route['tools/_activate_company_plaid'] = 'Tools/ajax_activate_company_plaid';
$route['tools/_enable_disable_api_confirmation'] = 'Tools/ajax_enable_disable_confirmation_api';
$route['tools/_enable_api'] = 'Tools/ajax_enable_api';
$route['tools/_disable_api'] = 'Tools/ajax_disable_api';
$route['tools/_zapier_regenerate_key'] = 'Tools/ajax_zapier_regenerate_key';
$route['tools/_google_contact_account_bind'] = 'Tools/ajax_google_contact_account_bind';
$route['tools/_import_customer_data_to_google_contacts'] = 'Tools/ajax_import_customer_data_to_google_contacts';
$route['tools/_disconnect_google_contacts'] = 'Tools/ajax_disconnect_google_contacts';
$route['tools/google_contacts_logs'] = 'Tools/google_contacts_logs';
$route['tools/quickbooks_connect'] = 'Tools/quickbooks_connect';
$route['tools/_load_attendance_list'] = 'Tools/ajax_load_attendance_list';
$route['tools/_export_qb_timesheet'] = 'Tools/ajax_export_qb_timesheet';
$route['tools/_disconnect_quickbook_account'] = 'Tools/ajax_disconnect_quickbook_payroll_account';
$route['tools/mailchimp_connect'] = 'Tools/mailchimpConnect';
$route['tools/mailchimp_api_save'] = 'Tools/mailchimpApiSave';
$route['tools/_create_mailchimp_customer_export'] = 'Tools/ajax_create_mailchimp_customer_export';
$route['tools/_disconnect_mailchimp_account'] = 'Tools/ajax_disconnect_mailchimp_account';
$route['tools/_verify_connect_active_campaign'] = 'Tools/ajax_verify_connect_active_campaign';
$route['tools/_create_active_campaign_export_list'] = 'Tools/ajax_create_active_campaign_export_list';
$route['tools/_create_active_campaign_export_automation'] = 'Tools/ajax_create_active_campaign_export_automation';
$route['tools/_disconnect_active_campaign_account'] = 'Tools/ajax_disconnect_active_campaign_account';

//Work Pictures
$route['users/_delete_work_picture'] = 'Users/ajax_delete_company_work_picture';
$route['users/_update_work_image_caption'] = 'Users/ajax_update_company_work_picture_caption';

//Profile Setting
$route['users/update_profile_setting'] = 'Users/update_profile_setting';
$route['users/load_edit_profile'] = 'Users/ajax_edit_profile';
$route['users/_update_profile'] = 'Users/ajax_update_profile';
$route['users/_update_user_signature'] = 'Users/ajax_update_user_signature';

//Job Front View
$route['job_invoice_view/(:any)'] = 'Pages/job_customer_invoice_view/$1';
$route['_converge_request_token'] = 'Pages/converge_token_request';
$route['_update_job_status_paid'] = 'Pages/update_job_status_paid';
$route['_braintree_process_payment'] = 'Pages/ajax_braintree_process_payment';

//Refer Friend
$route['refer_friend'] = 'Pages/front_refer_friend';
$route['_send_refer_email'] = 'Pages/send_refer_email';

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
$route['job_checklists/_create_checklist'] = 'Job_Checklists/ajax_save_checklist';
$route['job_checklists/_update_checklist'] = 'Job_Checklists/ajax_update_checklist';

//Business Profile front
$route['business/(:any)'] = 'Pages/front_company_business_profile/$1';

//Deals Steals
$route['promote/_save_deals_steals'] = 'Promote/ajax_save_deals_steals';
$route['promote/add_send_to'] = 'Promote/add_send_to';
$route['promote/create_send_to'] = 'Promote/create_send_to';
$route['promote/build_email'] = 'Promote/build_email';
$route['promote/create_email_message'] = 'Promote/create_email_message';
$route['promote/preview_email_message'] = 'Promote/preview_email_message';
$route['promote/_generate_preview'] = 'Promote/generate_preview';
$route['promote/update_validity'] = 'Promote/ajax_update_validity';
$route['promote/payment'] = 'Promote/payment';
$route['promote/_activate_deals'] = 'Promote/ajax_activate_deals';
$route['promote/_load_deals_list/(:any)'] = 'Promote/ajax_load_deals_list/$1';
$route['promote/_load_status_counter'] = 'Promote/ajax_load_status_counter';
$route['promote/_close_deal'] = 'Promote/ajax_close_deal';
$route['promote/edit_deals/(:num)'] = 'Promote/edit_deals/$1';
$route['promote/_delete_deal'] = 'Promote/ajax_delete_deal';
$route['promote/_converge_send_payment'] = 'Promote/ajax_send_payment';
$route['promote/payment_details'] = 'Promote/payment_details';
$route['promote/invoice_pdf/(:any)'] = 'Promote/deals_invoice_pdf/$1';
$route['promote/view_deals/(:any)'] = 'Promote/view_deals/$1';
$route['promote/bookings/(:any)'] = 'Promote/bookings/$1';
$route['promote/view_deals_payment/(:any)'] = 'Promote/view_deals_payment/$1';
$route['promote/order_pdf/(:any)'] = 'Promote/deals_order_pdf/$1';
$route['deal/booking/(:num)'] = 'Pages/deals_booking/$1';
$route['deal/(:any)/(:num)']  = 'Pages/deals_view/$1/$2';
$route['deal/save_booking']  = 'Pages/create_deals_booking';

//Admin login
$route['admin/login'] = 'Admin/login';

// Removes DocuSign in URLs
$route['eSign/templateCreate'] = 'DocuSign/templateCreate';
$route['eSign/templatePrepare'] = 'DocuSign/templatePrepare';
$route['eSign/templateEdit'] = 'DocuSign/templateEdit';
$route['eSign/signing'] = 'DocuSign/signing';
//$route['eSign/manage'] = 'DocuSign/manage';
$route['eSign/manage'] = 'DocuSign_v2/manage';

$route['eSign_v2/templateCreate'] = 'DocuSign_v2/templateCreate';
$route['eSign_v2/templatePrepare'] = 'DocuSign_v2/templatePrepare';
$route['eSign_v2/templateEdit'] = 'DocuSign_v2/templateEdit';
$route['eSign_v2/signing'] = 'DocuSign_v2/signing';
$route['eSign_v2/manage'] = 'DocuSign_v2/manage';
$route['eSign_v2/manager'] = 'DocuSign_v2/manager';

// Cron Payment
$route['cron/acs_billing_method_cc'] = 'Cron_Payment/acs_billing_method_cc';
$route['cron/acs_billing_method_cc_unpaid_amount'] = 'Cron_Payment/acs_billing_method_cc_unpaid_amount';
$route['cron/acs_subscription_method_cc'] = 'Cron_Payment/acs_subscription_method_cc';
$route['cron/company_recurring_nsmart_subscription'] = 'Cron_Payment/company_recurring_nsmart_subscription';
$route['cron/company_recurring_nsmart_subscription_with_payment_errors'] = 'Cron_Payment/company_recurring_nsmart_subscription_with_payment_errors';

//Admin Users
$route['admin/_update_employee'] = 'Admin/ajaxUpdateEmployee';
$route['admin/_update_employee_password'] = 'Admin/ajaxUpdateEmployeePassword';
$route['admin/_delete_employee'] = 'Admin/ajaxUpdateEmployeePassword';
$route['admin/_update_employee_profile_photo'] = 'Admin/ajaxUpdateEmployeeProfilePhoto';
$route['admin/_update_employee_status'] = 'Admin/ajaxUpdateEmployeeStatus';

//Admin nsmart plans
$route['admin/nsmart_plans'] = 'Admin/nsmart_plans';
$route['admin/add_new_nsmart_plan'] = 'Admin/add_new_plan';
$route['admin/create_nsmart_plan'] = 'Admin/create_nsmart_plan';
$route['admin/update_nsmart_plan'] = 'Admin/update_nsmart_plan';
$route['admin/delete_nsmart_plan'] = 'Admin/delete_nsmart_plan';

//Mycrm
$route['mycrm/_update_auto_recurring'] = 'Mycrm/company_update_auto_renewal';
$route['mycrm/_upgrade_subscription'] = 'Mycrm/company_upgrade_subscription';
$route['mycrm/_pay_subscription'] = 'Mycrm/company_pay_subscription';
$route['mycrm/_request_remove_addon'] = 'Mycrm/company_request_remove_addon';
$route['mycrm/_cancel_remove_addon'] = 'Mycrm/company_cancel_remove_addon';
$route['mycrm/_buy_plan_license'] = 'Mycrm/company_buy_plan_license';
$route['mycrm/_get_plan_payment_details'] = 'Mycrm/ajax_load_plan_payment_form';
$route['mycrm/_renew_membership_plan'] = 'Mycrm/ajax_renew_subscription';
$route['mycrm/_get_employee_list'] = 'Mycrm/ajax_load_employee_list';
$route['mycrm/_delete_employee'] = 'Mycrm/ajax_delete_employee';
$route['mycrm/_add_employee'] = 'Mycrm/ajax_add_employee';
$route['mycrm/_add_multi_account'] = 'Mycrm/ajax_add_multi_account';
$route['mycrm/_load_multi_account_list'] = 'Mycrm/ajax_load_multi_account_list';
$route['activate_multi_account/(:any)'] = 'Pages/front_activate_multi_account/$1';
$route['mycrm/_resend_multi_account_activation_email'] = 'Mycrm/ajax_resend_multi_account_activation_email';
$route['mycrm/_delete_multi_account'] = 'Mycrm/ajax_delete_multi_account';
$route['mycrm/_hdr_load_multi_account_list'] = 'Mycrm/ajax_hdr_load_multi_account_list';
$route['mycrm/_login_multi_account'] = 'Mycrm/ajax_login_multi_account';
$route['mycrm/_login_main_multi_account'] = 'Mycrm/ajax_login_main_multi_account';

//Addons
$route['more/_load_addons_list'] = 'More/ajax_load_addons_list';
$route['more/_load_active_addons_list'] = 'More/ajax_load_active_addons_list';

//Acounting Customers

$route['portal/appinv/(:any)/view'] = 'public_view_controller/view_invoice/$1';


// Time Sheet
$route['send-sms/clockin-clockout'] = 'Cron_Marketing/clockin_clockout_sms';

//Cron Send Email
$route['cron_mail/send_mail'] = 'Cron_Mail/send_mail';
$route['cron_mail/send_acs_mail'] = 'Cron_Mail/send_acs_mail';

//Cron Api
$route['cron_api/sync_adt_sales_portal_projects'] = 'Cron_Api/createAdtSalesPortalProjectsNonAPI';
$route['cron_api/google_calendar_sync'] = 'Cron_Api/syncGoogleCalendar';
$route['cron_api/google_contacts_sync'] = 'Cron_Api/syncGoogleContacts';
$route['cron_api/qb_payroll_sync'] = 'Cron_Api/syncQbPayrollTimesheet';
$route['cron_api/qb_employee_sync'] = 'Cron_Api/syncQbPayrollEmployees';
$route['cron_api/qb_payroll_timesheet_sync'] = 'Cron_Api/syncQbPayrollTimesheet';
$route['cron_api/export_customer_mailchimp_list'] = 'Cron_Api/exportCustomerMailChimpList';
$route['cron_api/export_customer_active_campaign_contacts'] = 'Cron_Api/activeCampaignCustomerExport';
$route['cron_api/export_customer_active_campaign_list_automation'] = 'Cron_Api/activeCampaignListAutomationExport';

//Cron Payment
$route['cron_payment/deactivate_unpaid_nsmart_subscription'] = 'Cron_Payment/deactivate_unpaid_nsmart_subscription';
$route['cron_payment/company_recurring_nsmart_subscription_with_payment_errors'] = 'Cron_Payment/company_recurring_nsmart_subscription_with_payment_errors';
$route['cron_payment/company_recurring_nsmart_subscription'] = 'Cron_Payment/company_recurring_nsmart_subscription';

//Customer
$route['customer/subscriptions'] = 'Customer/customer_subscriptions';
$route['customer/_load_active_subscriptions'] = 'Customer/ajax_load_active_subscriptions';
$route['customer/_load_completed_subscriptions'] = 'Customer/ajax_load_completed_subscriptions';
$route['customer/_load_billing_error_subscriptions'] = 'Customer/ajax_load_billing_error_subscriptions';
$route['customer/_load_subscription_list_counter'] = 'Customer/ajax_load_subscription_list_counter';
$route['customer/_load_subscription_payment_history'] = 'Customer/ajax_load_subscription_payment_history';
$route['customer/_load_esign_doc'] = 'Customer/ajax_load_esign_doc';
$route['customer/_check_customer_esign_pdf'] = 'Customer/ajax_check_customer_esign_pdf';
$route['customer/download_esign_doc'] = 'Customer/downloadEsignDoc';
$route['customer/_load_customer_sms_messages'] = 'Customer/ajax_load_customer_sms_messages';

//Trac360
$route['on-my-way-to-job'] = 'Job/update_jobs_status';

//Inventory
$route['inventory/export_list'] = 'inventory/inventory_export';
$route['inventory/add-custom-field']['post'] = 'inventory/add_custom_field';
$route['inventory/update-custom-field/(:any)']['post'] = 'inventory/update_custom_field/$1';

//Inventory Fees
$route['inventory/fees/edit/(:num)'] = 'inventory/edit_fee/$1';
$route['inventory/fees/update'] = 'inventory/update_fees';

//Inventory Vendor
$route['inventory/vendor/add'] = 'inventory/add_vendor';
$route['inventory/_create_vendor'] = 'inventory/ajax_create_vendor';
$route['inventory/vendor/edit/(:num)'] = 'inventory/edit_vendor/$1';
$route['inventory/_update_vendor'] = 'inventory/ajax_update_vendor';
$route['inventory/vendor/delete'] = 'inventory/ajax_delete_vendor';

//Item Category
$route['inventory/_create_item_category'] = 'inventory/ajax_create_item_category';
$route['inventory/item_groups/edit/(:num)'] = 'inventory/edit_item_category/$1';
$route['inventory/_update_item_category'] = 'inventory/ajax_update_item_category';
$route['inventory/item_groups/delete'] = 'inventory/ajax_delete_item_category';

//Sales Overview
$route['sales-overview/income-overtime'] = 'AccountingSales/get_income_overtime';

//Autocomplete
$route['autocomplete/_company_users'] = 'Autocomplete/company_users';
$route['autocomplete/_company_customer'] = 'Autocomplete/company_customers';
$route['autocomplete/_company_event_tags'] = 'Autocomplete/company_event_tags';
$route['autocomplete/_company_reasons'] = 'Autocomplete/company_reasons';
$route['autocomplete/_company_furnishers'] = 'Autocomplete/company_furnishers';
$route['autocomplete/_company_instructions'] = 'Autocomplete/company_instructions';
$route['autocomplete/_company_job_tags'] = 'Autocomplete/company_job_tags';

//Quick Add
$route['quick_add/_add_customer'] = 'Quick_Add/ajax_add_company_customer';

//Appointment Types
$route['appointment_types/index'] = 'Appointment_Types/index';
$route['appointment_types/add_new_type'] = 'Appointment_Types/add_new_type';
$route['appointment_types/create_appointment_type'] = 'Appointment_Types/create_appointment_type';
$route['appointment_types/edit/(:num)'] = 'Appointment_Types/edit_type/$1';
$route['appointment_types/update_appointment_type'] = 'Appointment_Types/update_appointment_type';
$route['appointment_types/delete'] = 'Appointment_Types/delete_appointment_type';
$route['appointment_types/_create_appointment_type'] = 'Appointment_Types/ajax_create_appointment_type';
$route['appointment_types/_update_appointment_type'] = 'Appointment_Types/ajax_update_appointment_type';
$route['appointment_types/_delete_appointment_type'] = 'Appointment_Types/ajax_delete_appointment_type';

$route['items/_get_item_details'] = 'Items/ajax_get_item_details';

//Support
$route['support'] = 'Support/index';
$route['support/_send_email'] = 'Support/ajax_send_email';
$route['contact/_support_send_email'] = 'Contact/ajax_support_send_email';

//Front company booking page
$route['booking/products/(:any)'] = 'Pages/external_booking_page/$1';
$route['booking/_add_cart_item'] = 'Pages/ajax_update_booking_cart';
$route['booking/_add_cart_coupon'] = 'Pages/ajax_update_cart_coupon';
$route['booking/_delete_coupon'] = 'Pages/ajax_delete_coupon';
$route['booking/products_schedule/(:any)'] = 'Pages/external_front_schedule/$1';
$route['booking/_load_week_schedule'] = 'Pages/ajax_load_week_schedule';
$route['booking/_set_booking_schedule'] = 'Pages/ajax_user_set_schedule';
$route['booking/product_booking_form/(:any)'] = 'Pages/front_booking_form/$1';
$route['booking/save_booking_inquiry'] = 'Pages/save_product_booking';

//Taskhub
$route['taskhub/_load_taskhub_list'] = 'Taskhub/ajax_load_company_list';
$route['taskhub/_add_new_task'] = 'Taskhub/ajax_add_new_task';
$route['taskhub/_save_task'] = 'Taskhub/ajax_save_task';
$route['taskhub/_task_mark_completed'] = 'Taskhub/ajax_complete_task';
$route['taskhub/_mark_all_completed'] = 'Taskhub/ajax_company_complete_all_tasks';

//SMS
$route['messages'] = 'Sms/index';
$route['messages/_company_send'] = 'Sms/ajax_company_send_sms';
$route['messages/_company_delete'] = 'Sms/ajax_company_delete_sms';
$route['messages/_company_resend_form'] = 'Sms/ajax_company_resend_form';
$route['messages/_company_resend_form'] = 'Sms/ajax_company_resend_form';
$route['customer/_update_customer_mobile_number'] = 'Customer/ajax_update_customer_mobile_number';
$route['messages/_load_customer_sent_messages'] = 'Sms/ajax_customer_sent_messages';
$route['sms/_use_sms_template'] = 'Sms/ajax_use_sms_template';
$route['customer/_get_phone_number'] = 'Customer/ajax_get_phone_number';
$route['messages/_sms_list'] = 'Sms/ajax_sms_list';


//Calls
$route['calls/_log_start_call'] = 'Calls/ajax_log_start_call';
$route['calls/_log_end_call'] = 'Calls/ajax_log_end_call';
$route['calls/logs'] = 'Calls/logs';


$route['flashcard'] = 'FlashCard/index';
$route['flashcard/add-cards/(:num)'] = 'FlashCard/addCards/$1';
$route['flashcard/study-cards/(:num)'] = 'FlashCard/studyCards/$1';

//Autosms
$route['settings/auto_sms'] = 'Settings/auto_sms';
$route['settings/_load_auto_sms_notification_module_status'] = 'Settings/ajax_load_auto_sms_notification_module_status';
$route['settings/_create_sms_auto_notification'] = 'Settings/ajax_create_sms_auto_notification';
$route['settings/_delete_auto_sms_notification'] = 'Settings/ajax_delete_auto_sms_notification';
$route['settings/_edit_auto_sms_notification'] = 'Settings/ajax_edit_auto_sms_notification';
$route['settings/_update_sms_auto_notification'] = 'Settings/ajax_update_sms_auto_notification';
$route['settings/_load_auto_sms_notification_module_smart_tags'] = 'Settings/ajax_load_auto_sms_notification_module_smart_tags';

//Cron SMS Notification
$route['cron_notification/auto_sms_notification'] = 'Cron_Notification/auto_sms_notification';

//Auth Key
$route['tools/_send_auth_key'] = 'Tools/ajax_send_auth_key';
$route['tools/_validate_auth_key'] = 'Tools/ajax_validate_auth_key';

//Image tracker email
$route['tracker/estimate_image_tracker'] = 'Tracker/estimateImageTracker';

//Dashboard : Bank Plaid
$route['_launch_plaid_accounts'] = 'PlaidAccount/ajax_plaid_api';
$route['_create_plaid_account'] = 'PlaidAccount/ajax_create_plaid_account';
$route['_load_connected_bank_accounts'] = 'PlaidAccount/ajax_load_connected_bank_accounts';

//Plaid Accounts
$route['plaid_accounts'] = 'PlaidAccount/list';
$route['plaid_account/_delete_bank_account'] = 'PlaidAccount/ajax_delete_bank_account';
$route['plaid_account/_bank_account_transactions'] = 'PlaidAccount/ajax_bank_account_transactions';
$route['plaid_account/_bank_account_recurring_transactions'] = 'PlaidAccount/ajax_bank_account_recurring_transactions';

//ADT Portal
$route['user/_loggedin_adt_sales_portal'] = 'Users/ajax_loggedin_adt_sales_portal';

//Customer Sync Setting
$route['customer/_update_adt_sales_sync_setting'] = 'Customer/ajax_update_adt_sales_sync_setting';
$route['customer/_adt_sales_sync_setting'] = 'Customer/ajax_adt_sales_sync_setting';

//API
$route['api/create_auto_sms_notification'] = 'Api/create_auto_sms_notification';
$route['api/create_hash_id'] = 'Api/create_hash_id';
$route['api/create_google_calendar_event'] = 'Api/createGoogleCalendarEvent';
$route['api/get_company_multi_accounts'] = 'Api/fetchCompanyMultiAccountList';
$route['api/send_activation_email'] = 'Api/resendActivationLink';
$route['api/create_multi_account'] = 'Api/createCompanyMultiAccount';
$route['api/delete_multi_account'] = 'Api/deleteCompanyMultiAccount';
$route['api/vonage_inbound_sms'] = 'Api/vonageInboundSms';
$route['api/estimate_send_customer_email'] = 'Api/emailCustomerEstimate';
$route['api/converge_send_sale'] = 'Api/convergeSendSale';
$route['api/send_email'] = 'Api/sendEmail';
$route['api/send_customer_estimate_email'] = 'Api/emailCustomerEstimate';

//Front View Appointment
$route['appointment/(:any)'] = 'Pages/front_appointment_view/$1';

//Modal Quickview
$route['job/_quick_view_details'] = 'Job/ajax_quick_view_details';
$route['ticket/_quick_view_details'] = 'Tickets/ajax_quick_view_details';
$route['calendar/_quick_view_calendar_events'] = 'Workcalender/ajax_quick_view_calendar_events';
$route['calendar/_quick_view_tc_off'] = 'Workcalender/ajax_quick_view_tc_off';
$route['calendar/_appointment_quick_add_form'] = 'Workcalender/ajax_appointment_quick_add_form';
$route['job/_quick_add_job_form'] = 'Job/ajax_quick_add_job_form';
$route['job/_create_job'] = 'Job/ajax_create_job';
$route['ticket/_quick_add_service_ticket_form'] = 'Tickets/ajax_quick_add_service_ticket_form';
$route['job/_create_service_ticket'] = 'Job/ajax_create_service_ticket';
$route['ticket/_create_service_ticket'] = 'Tickets/ajax_create_service_ticket';
$route['ticket/_get_customer_basic_information'] = 'Tickets/ajax_get_customer_basic_info';
$route['calendar/_quick_add_appointment_form'] = 'Workcalender/ajax_quick_add_appointment_form';
$route['calendar/_quick_add_tc_off_form'] = 'Workcalender/ajax_quick_add_tc_off_form';
$route['calendar/_quick_edit_tc_off_form'] = 'Workcalender/ajax_quick_edit_tc_off_form';
$route['job/_quick_delete_job'] = 'Job/ajax_quick_delete_job';
$route['calendar/_quick_delete_tc_off'] = 'Workcalender/ajax_delete_tcoff';
$route['calendar/_quick_delete_appointment'] = 'Workcalender/ajax_delete_appointment';
$route['ticket/_quick_delete_ticket'] = 'Tickets/ajax_quick_delete_ticket';
$route['event/_quick_view_event'] = 'Events/ajax_quick_view_event';
$route['event/_quick_add_event_form'] = 'Events/ajax_quick_add_event_form';
$route['event/_create_event'] = 'Events/ajax_create_event';
$route['event/_quick_delete_event'] = 'Events/ajax_quick_delete_event';

$route['docusign/debugGeneratePDF'] = 'DocuSign/debugGeneratePDF';

