<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Appointments</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2 btn-quick-access-calendar-schedule"
                href="javascript:void(0);">
                Calendar
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content upcoming-calendar-container"  style="  height: calc(100% - 120px);"></div>
    <!-- <div class='nsm-card-footer mt-3'>
        <a role="button" class="nsm-button btn-sm m-0 me-2" href="workcalender">
            <i class='bx bx-right-arrow-alt'></i>
        </a>
    </div> -->
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>
<script>
$(function() {
    loadUpcomingCalendar();
});

function loadUpcomingCalendar() {
    $.ajax({
        async: false,
        url: '<?php echo base_url(); ?>widgets/getUpcomingCalendar',
        method: 'get',
        data: {},
        success: function(response) {
            $('.upcoming-calendar-container').html(response);
        }

    });
}
</script>