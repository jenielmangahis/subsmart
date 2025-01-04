<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .upcoming-calendar-container {
        margin: 0 20px;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
        /* transform: translateY(-60px); */
        overflow: auto;
        height: unset;
    }

    #dashboard_upcoming_schedules_table .nsm-table-pagination .pagination { 
        gap: 10px;
    }
    #dashboard_upcoming_schedules_table .nsm-table-pagination .pagination li a.prev,#dashboard_upcoming_schedules_table .nsm-table-pagination .pagination li a.next{ 
        border: none;
    }

    #dashboard_upcoming_schedules_table .nsm-table-pagination .pagination li a{
        border-radius: 50%;
    }
    #dashboard_upcoming_schedules_table .nsm-table-pagination .pagination li a.active{
        background: #d9a1a0;
        border: 1px solid #BEAFC2;
    }
</style>
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
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content ">
        <div class="banner">
            <img src="./assets/img/appointments-banner.svg" alt="">
        </div>
        <div class="upcoming-calendar-container">

        </div>
    </div>

</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
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
