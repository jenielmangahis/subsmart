<?php
$date_from = date('Y-m-d', strtotime('first day of last month'));
$date_to = date("Y-m-t");
$all_jobs = $this->trac360_model->get_all_jobs($date_from, $date_to, logged('company_id'));

?>

<div class="trac360-calendar-modal" style="">
    <div class="trac360-calendar-modal-body">
        <div class="trac360-close-btn">
            <img
                src="<?=base_url('/assets/img/trac360/close.png')?>" />
        </div>
        <div class="trac360-calendar-content">
            <div class="trac360-calendar">
                <div class="row">
                    <div class="col-xl-12">
                        <div id='trac360-calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var fresh_calendar_run = true;
    var current_date = new Date();

    document.addEventListener('DOMContentLoaded', function() {
        load_calendar();
    });

    function load_calendar() {
        var calendarEl = document.getElementById('trac360-calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialDate: current_date,
            editable: false,
            selectable: true,
            businessHours: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: [
                <?php
                           foreach ($all_jobs as $job) {
                               echo "{
                               title: '".$job->FName .' '.$job->LName.' : '.$job->job_number . ' : ' . $job->job_type. ' - ' . $job->tags_name."',
                               start: '".$job->start_date.'T'.date('H:i:s', $job->start_time)."',
                               end: '".$job->end_date.'T'.date('H:i:s', $job->end_time)."',
                               url: '".$job->job_number . ' : ' . $job->job_type. ' - ' . $job->tags_name."'
                               },";
                           }
                           ?>
            ]
        });
        calendar.render();
        if (fresh_calendar_run) {
            fresh_calendar_run = false;
            $(".trac360-calendar-modal").hide();
        }
    }
</script>