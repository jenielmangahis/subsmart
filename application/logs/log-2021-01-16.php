<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-01-16 05:06:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2021-01-16 05:06:08 --> Config Class Initialized
INFO - 2021-01-16 05:06:08 --> Hooks Class Initialized
DEBUG - 2021-01-16 05:06:09 --> UTF-8 Support Enabled
INFO - 2021-01-16 05:06:09 --> Utf8 Class Initialized
INFO - 2021-01-16 05:06:09 --> URI Class Initialized
INFO - 2021-01-16 05:06:09 --> Router Class Initialized
INFO - 2021-01-16 05:06:09 --> Output Class Initialized
INFO - 2021-01-16 05:06:09 --> Security Class Initialized
DEBUG - 2021-01-16 05:06:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2021-01-16 05:06:09 --> Input Class Initialized
INFO - 2021-01-16 05:06:09 --> Language Class Initialized
INFO - 2021-01-16 05:06:09 --> Loader Class Initialized
INFO - 2021-01-16 05:06:09 --> Helper loaded: basic_helper
INFO - 2021-01-16 05:06:09 --> Helper loaded: url_helper
INFO - 2021-01-16 05:06:09 --> Helper loaded: file_helper
INFO - 2021-01-16 05:06:09 --> Helper loaded: form_helper
INFO - 2021-01-16 05:06:09 --> Helper loaded: cookie_helper
INFO - 2021-01-16 05:06:09 --> Helper loaded: security_helper
INFO - 2021-01-16 05:06:09 --> Helper loaded: directory_helper
INFO - 2021-01-16 05:06:09 --> Helper loaded: download_helper
INFO - 2021-01-16 05:06:09 --> Database Driver Class Initialized
DEBUG - 2021-01-16 05:06:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2021-01-16 05:06:09 --> Session: Class initialized using 'files' driver.
INFO - 2021-01-16 05:06:09 --> Parser Class Initialized
INFO - 2021-01-16 05:06:09 --> Form Validation Class Initialized
INFO - 2021-01-16 05:06:09 --> Upload Class Initialized
INFO - 2021-01-16 05:06:09 --> Email Class Initialized
INFO - 2021-01-16 05:06:09 --> MY_Model class loaded
INFO - 2021-01-16 05:06:09 --> Model "Users_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Company_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Settings_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Role_permissions_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Permissions_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Roles_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Vault_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Activity_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Items_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Workstatus_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Plans_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Business_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Templates_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Folders_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Comments_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Account_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Account_detail_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Accounts_has_account_details_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Account_sub_account_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Accounts_has_sub_account_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Chart_of_accounts_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Wizard_apps_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Wizard_subapps_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Wizard_suboptions_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Reconcile_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "File_folders_categories_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Timesheet_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "AccountingVendors_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "File_folders_permissions_roles_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "File_folders_permissions_users_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Users_geographic_positions_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Users_geographic_positions_categories_model" initialized
INFO - 2021-01-16 05:06:09 --> Model "Addone_model" initialized
INFO - 2021-01-16 05:06:09 --> Controller Class Initialized
INFO - 2021-01-16 12:06:09 --> Model "Customer_advance_model" initialized
INFO - 2021-01-16 12:06:09 --> Model "Users_model" initialized
INFO - 2021-01-16 12:06:09 --> Model "Feeds_model" initialized
INFO - 2021-01-16 12:06:09 --> Model "Jobs_model" initialized
INFO - 2021-01-16 12:06:09 --> Model "Estimate_model" initialized
INFO - 2021-01-16 12:06:09 --> Model "Invoice_model" initialized
INFO - 2021-01-16 12:06:09 --> Model "Crud" initialized
INFO - 2021-01-16 12:06:09 --> Model "Taskhub_status_model" initialized
INFO - 2021-01-16 12:06:09 --> Model "Activity_model" initialized
ERROR - 2021-01-16 12:06:09 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:06:09 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:06:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2021-01-16 05:06:11 --> Config Class Initialized
INFO - 2021-01-16 05:06:11 --> Hooks Class Initialized
DEBUG - 2021-01-16 05:06:11 --> UTF-8 Support Enabled
INFO - 2021-01-16 05:06:11 --> Utf8 Class Initialized
INFO - 2021-01-16 05:06:11 --> URI Class Initialized
INFO - 2021-01-16 05:06:11 --> Router Class Initialized
INFO - 2021-01-16 05:06:11 --> Output Class Initialized
INFO - 2021-01-16 05:06:11 --> Security Class Initialized
DEBUG - 2021-01-16 05:06:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2021-01-16 05:06:11 --> Input Class Initialized
INFO - 2021-01-16 05:06:11 --> Language Class Initialized
INFO - 2021-01-16 05:06:11 --> Loader Class Initialized
INFO - 2021-01-16 05:06:11 --> Helper loaded: basic_helper
INFO - 2021-01-16 05:06:11 --> Helper loaded: url_helper
INFO - 2021-01-16 05:06:11 --> Helper loaded: file_helper
INFO - 2021-01-16 05:06:11 --> Helper loaded: form_helper
INFO - 2021-01-16 05:06:11 --> Helper loaded: cookie_helper
INFO - 2021-01-16 05:06:11 --> Helper loaded: security_helper
INFO - 2021-01-16 05:06:11 --> Helper loaded: directory_helper
INFO - 2021-01-16 05:06:11 --> Helper loaded: download_helper
INFO - 2021-01-16 05:06:11 --> Database Driver Class Initialized
DEBUG - 2021-01-16 05:06:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2021-01-16 05:06:11 --> Session: Class initialized using 'files' driver.
INFO - 2021-01-16 05:06:11 --> Parser Class Initialized
INFO - 2021-01-16 05:06:11 --> Form Validation Class Initialized
INFO - 2021-01-16 05:06:11 --> Upload Class Initialized
INFO - 2021-01-16 05:06:11 --> Email Class Initialized
INFO - 2021-01-16 05:06:11 --> MY_Model class loaded
INFO - 2021-01-16 05:06:11 --> Model "Users_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Company_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Settings_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Role_permissions_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Permissions_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Roles_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Vault_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Activity_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Items_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Workstatus_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Plans_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Business_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Templates_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Folders_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Comments_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Account_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Account_detail_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Accounts_has_account_details_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Account_sub_account_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Accounts_has_sub_account_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Chart_of_accounts_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Wizard_apps_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Wizard_subapps_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Wizard_suboptions_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Reconcile_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "File_folders_categories_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Timesheet_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "AccountingVendors_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "File_folders_permissions_roles_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "File_folders_permissions_users_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Users_geographic_positions_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Users_geographic_positions_categories_model" initialized
INFO - 2021-01-16 05:06:11 --> Model "Addone_model" initialized
INFO - 2021-01-16 05:06:11 --> Controller Class Initialized
INFO - 2021-01-16 12:06:12 --> Model "Customer_advance_model" initialized
INFO - 2021-01-16 12:06:12 --> Model "Users_model" initialized
INFO - 2021-01-16 12:06:12 --> Model "Feeds_model" initialized
INFO - 2021-01-16 12:06:12 --> Model "Jobs_model" initialized
INFO - 2021-01-16 12:06:12 --> Model "Estimate_model" initialized
INFO - 2021-01-16 12:06:12 --> Model "Invoice_model" initialized
INFO - 2021-01-16 12:06:12 --> Model "Crud" initialized
INFO - 2021-01-16 12:06:12 --> Model "Taskhub_status_model" initialized
INFO - 2021-01-16 12:06:12 --> Model "Activity_model" initialized
ERROR - 2021-01-16 12:06:12 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:06:12 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:06:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2021-01-16 12:06:29 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:06:29 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:06:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2021-01-16 12:06:30 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:06:30 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:06:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2021-01-16 12:06:52 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:06:52 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:07:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
DEBUG - 2021-01-16 05:07:10 --> UTF-8 Support Enabled
DEBUG - 2021-01-16 05:07:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2021-01-16 05:07:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2021-01-16 12:07:10 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:07:11 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:07:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
DEBUG - 2021-01-16 05:07:11 --> UTF-8 Support Enabled
DEBUG - 2021-01-16 05:07:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2021-01-16 05:07:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2021-01-16 12:07:11 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:07:11 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:07:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
DEBUG - 2021-01-16 05:07:12 --> UTF-8 Support Enabled
DEBUG - 2021-01-16 05:07:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2021-01-16 05:07:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2021-01-16 05:07:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
DEBUG - 2021-01-16 05:07:12 --> UTF-8 Support Enabled
DEBUG - 2021-01-16 05:07:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2021-01-16 05:07:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2021-01-16 12:07:12 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:07:12 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 12:07:12 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:07:12 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:07:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
DEBUG - 2021-01-16 05:07:16 --> UTF-8 Support Enabled
DEBUG - 2021-01-16 05:07:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2021-01-16 05:07:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2021-01-16 12:07:16 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:07:16 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
ERROR - 2021-01-16 05:07:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
DEBUG - 2021-01-16 05:07:17 --> UTF-8 Support Enabled
DEBUG - 2021-01-16 05:07:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2021-01-16 05:07:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2021-01-16 12:07:17 --> Query error: Unknown column 'createdAt' in 'order clause' - Invalid query: SELECT *
FROM `esign_activity`
WHERE `user_id` = '6'
AND `activityName` NOT IN('User Login', 'User Logout')
ORDER BY `createdAt` DESC
 LIMIT 6
ERROR - 2021-01-16 12:07:17 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\SMARTRAC\nsmartrac\application\models\Activity_model.php 39
