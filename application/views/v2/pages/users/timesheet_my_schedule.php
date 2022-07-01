<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/timesheet/timesheet_modals'); ?>

<link rel="stylesheet" href="<?= base_url("assets/css/timesheet/calendar/main.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/css/timesheet/timesheet_my_schedule.css") ?>">

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
<script src="<?= base_url("assets/js/timesheet/calendar/main.js") ?>"></script>
<script src="<?= base_url("assets/js/timesheet/timesheet_my_schedule.js") ?>"></script>