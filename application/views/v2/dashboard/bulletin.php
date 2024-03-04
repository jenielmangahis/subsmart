<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Timesheet</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url() . "timesheet/attendance"; ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="nsm-widget-table">
            <!-- <div class="widget-header row">
                <div class="col-12 col-md-5 d-flex">
                    <span class="content-subtitle d-block">Employee Name</span>
                </div>
                <div class="col">
                    <span class="content-subtitle d-block">In</span>
                </div>
                <div class="col">
                    <span class="content-subtitle d-block">Out</span>
                </div>
                <div class="col">
                    <span class="content-subtitle d-block">Lunch In</span>
                </div>
                <div class="col">
                    <span class="content-subtitle d-block">Lunch Out</span>
                </div>
            </div> -->
            <div class="row timesheet-header">
                <div class="col-12">
                    <div class="widget-item timesheet-item">
                        <div class="content">
                            <div class="details" style="width:45% !important;">
                                <span class="content-subtitle fw-bold">Employee</span>
                            </div>
                            <div class="controls">
                                <div class="timesheet-group">
                                    <div class="timesheet-time">
                                        <span class="content-subtitle fw-bold d-block">In</span>
                                    </div>
                                    <div class="timesheet-time">
                                        <span class="content-subtitle fw-bold d-block">Out</span>
                                    </div>
                                </div>
                                <div class="timesheet-group">
                                    <div class="timesheet-time">
                                        <span class="content-subtitle fw-bold d-block">Lunch In</span>
                                    </div>
                                    <div class="timesheet-time">
                                        <span class="content-subtitle fw-bold d-block">Lunch Out</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row timesheet-container">

            </div>
            <!-- <div class="nsm-loader">
            <i class='bx bx-loader-alt bx-spin'></i>
        </div> -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadTimesheet();
    });

    function loadTimesheet() {
        // console.log("called");
        $.ajax({
            url: '<?php echo base_url(); ?>widgets/loadV2Timesheet',
            method: 'get',
            data: {},
            success: function(response) {
                $('.timesheet-container').html(response);
                setTimeout(function() {loadTimesheet()}, 2000);
            }

        });
    }
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>