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
        let ye = new Intl.DateTimeFormat('en', {
            year: 'numeric'
        }).format(current_date);
        let mo = new Intl.DateTimeFormat('en', {
            month: '2-digit'
        }).format(current_date);
        let da = new Intl.DateTimeFormat('en', {
            day: '2-digit'
        }).format(current_date);
        var date_viewed = `${ye}-${mo}-${da}`;
        // load_calendar();
        current_date = new Date(date_viewed);
        calendar_changed(date_viewed);
    });
</script>