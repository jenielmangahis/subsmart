<?php

defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
?>

<link rel="stylesheet" href="<?php echo $url->assets; ?>css/automation/automation.css">

<div class="row page-content g-0">
    <!-- TABS -->
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/automation_tabs'); ?>
    </div>

    <!-- CALLOUT -->
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Set automatic reminders for your team or clients.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CARDS -->
    <div class="col-12">
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3 col-lg-2 select-filter-card">
                <div class="nsm-counter primary h-100 mb-2">
                    <div class="row h-100 w-auto">
                        <div class="w-100 col-md-8 text-start d-flex align-items-center justify-content-between">
                            <span><i class="bx bx-receipt"></i> Active</span>
                            <h2 id="total_this_year"><?php echo $automation_status['active'] ? $automation_status['active'] : '0'; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2 select-filter-card">
                <div class="nsm-counter h-100 mb-2">
                    <div class="row h-100 w-auto">
                        <div class="w-100 col-md-8 text-start d-flex align-items-center justify-content-between">
                            <span><i class="bx bx-receipt"></i> Inactive</span>
                            <h2 id="total_this_year"><?php echo $automation_status['inactive'] ? $automation_status['inactive'] : '0'; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEARCH & BUTTONS -->
    <div class="row mb-3">
        <div class="col-sm-12 col-md-6 grid-mb">
            <div class="nsm-field-group search">
                <input type="text" class="nsm-field nsm-search form-control mb-2" id="automation_searchbar" placeholder="Search...">
            </div>
        </div>
        <div class="col-md-6 col-sm-12 grid-mb text-end">
            <button type="button" class="nsm-button primary" id="addAutomationBtn">
                <i class='bx bx-fw bx-plus'></i> Add Automation
            </button>
        </div>
    </div>

 

    <!-- AUTOMATIONS -->
    <div class="row" id="automationResults">
        <?php foreach ($automations as $automation): ?>
        <div class="col-12 mb-3">
            <div class="nsm-card primary" style="overflow: visible !important;">
                <div class="nsm-card-header">
                    <div class="nsm-card-title d-flex justify-content-between">
                        <span><?php echo !empty($automation->title) ? $automation->title : 'No Title'; ?></span>
                        <div class="form-switch">
                            <input
                                class="form-check-input primary toggle-automation"
                                type="checkbox"
                                role="switch"
                                data-id="<?php echo $automation->id; ?>"
                                <?php echo $automation->status === 'active' ? 'checked' : ''; ?>
                            >
                        </div>
                    </div>
                </div>
             
                <div class="nsm-card-content">
                    <h6><?php echo generateAutomationDescription($automation); ?>.</h6>
                    <hr />
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <div class="d-flex gap-3 small">
                                <span>Created on <?php echo date('M d, Y', strtotime($automation->created_at)); ?></span>
                                <span>|</span>
                                <span>Triggered 0 times</span>
                            </div>
                            <div class="nsm-card-controls px-3">
                                <div class="dropup">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" id="actionsDropdown" aria-expanded="false">
                                        <i class='bx bx-fw bx-dots-horizontal-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                                        <li><a class="dropdown-item cursor-pointer preview-automation" data-id="<?php echo $automation->id; ?>">Preview</a></li>
                                        <li><a class="dropdown-item cursor-pointer edit-automation" data-id="<?php echo $automation->id; ?>">Edit</a></li>
                                        <li><a class="dropdown-item cursor-pointer delete-automation" data-id="<?php echo $automation->id; ?>" data-title="<?php echo $automation->title; ?>">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

</div>


<?php include viewPath('v2/includes/automation/add_automation_modal'); ?>
<?php include viewPath('v2/includes/automation/preview_automation_modal'); ?>
<?php include viewPath('v2/includes/automation/preview_sms_modal'); ?>
<?php include viewPath('v2/includes/automation/add_email_modal'); ?>
<?php include viewPath('v2/includes/automation/add_sms_modal'); ?>
<?php include viewPath('v2/includes/automation/add_condition_modal'); ?>
<?php include viewPath('v2/pages/automation/js/automation'); ?>
<?php include viewPath('v2/includes/footer'); ?>