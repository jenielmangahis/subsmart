<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/timesheet/timesheet_modals'); ?>

<link rel="stylesheet" href="<?= base_url("assets/css/timesheet/calendar/main.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/css/timesheet/timesheet_my_schedule.css") ?>">

    <div class="row page-content g-0">
        <div class="col-12 mb-3">
            <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
        </div>
            <div class="row">
                <div class="col-xl-12">
                    <div id='calendar'></div>
                </div>
            </div>
    </div>

    <?php include viewPath('v2/includes/footer'); ?>