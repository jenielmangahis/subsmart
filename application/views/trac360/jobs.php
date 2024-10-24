<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
include viewPath('includes/header');
function get_differenct_of_dates($date_start, $date_end)
{
    $start = new DateTime($date_start);
    $end =  new DateTime($date_end);
    $interval = $start->diff($end);

    $difference = ($interval->days * 24 * 60) * 60;
    $difference += ($interval->h * 60) * 60;
    $difference += ($interval->i) * 60;
    $difference += $interval->s;
    return ($difference / 60) / 60;
}
?>
<style>

</style>
<!-- page wrapper start -->
<!-- <div class="wrapper" role="wrapper"> -->
<!--<div wrapper__section>-->
<div id="main_body" class="container-fluid" style="background-color: #6241A4; margin-bottom: -5px;">
    <div class="row">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 page-title-box align-items-center">
                    <h1 class="page-title text-white">Trac360</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active text-white">Search the globe online</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 trac360_main_sections">
                    <div class="btn-group-vertical" style="width: 100%;">
                        <ul class="trac360-side-bar-menu">
                            <li>
                                <a href="<?= base_url() ?>trac360"
                                    class="btn btn-primary  trac360_side_controls" id=""><span class="fa fa-users fa-2x"
                                        class="text-center"></span><br>People</a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-primary  trac360_side_controls" id="calendar-menu-btn"><span
                                        class="fa fa-calendar-plus-o fa-2x" class="text-center"></span><br>Calendar</a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>trac360/jobs"
                                    class="btn btn-primary  trac360_side_controls current-page" id=""><span
                                        class="fa fa-briefcase fa-2x" class="text-center"></span><br>Jobs</a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>trac360/places"
                                    class="btn btn-primary  trac360_side_controls" id=""><span
                                        class="fa fa-map-marker fa-2x" class="text-center"></span><br>Places</a>
                            </li>
                            <li><a href="<?= base_url() ?>trac360/history"
                                    class="btn btn-primary  trac360_side_controls" id=""><span class="fa fa-map fa-2x"
                                        class="text-center"></span><br>History</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9  trac360_main_sections jobs-list-section" style="background-color: #fff;">
                    <div id="single-job-view-directionsRenderer-panel" class="overflow-auto panel-closed"
                        style="top:0;">
                        <div class="employee-name" style="min-width:439px;">
                            <p><span class="name"><?=$jb->FName .' '.$jb->LName?></span>
                            </p>
                        </div>
                        <div class="close-btn"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                        <div class="panel-content">
                            <div id="job-item-selected-view" class="row no-margin">
                                sapmle
                            </div>
                            <div class="estimated-calculation" style="display: none;">
                                <div class="row no-margin">
                                    <div class="col-md-4">
                                        <div class="est eta">
                                            <span class="title">ETA</span>
                                            <br>
                                            <span class="value">33<br> min</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="est distance">
                                            <span class="title">Distance</span>
                                            <br>
                                            <span class="value">10.89 <br> mi</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="est exp-speed">
                                            <span class="title">Exp Speed</span>
                                            <br>
                                            <span class="value">10.89 <br> mi/hr</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="single-job-view-directionsRenderer-panel-view"></div>
                        </div>
                    </div>
                    <div class="loader" style="display: none;">
                        <center>
                            <img src="<?=base_url('assets/img/trac360/loader1.gif')?>"
                                alt="">
                        </center>
                    </div>
                    <div id="employee-upcoming-jobs" class="overflow-auto" style="height: 100%;">
                        <div class="row no-margin">
                            <div class="col-md-4 no-padding">
                                <a data-toggle="collapse" href="#upcomingjobs-collapse-panel" role="button"
                                    aria-expanded="true" aria-controls="upcomingjobs-collapse-panel">
                                    <div class="upcoming jobs-collapse-btn collapse-active">
                                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        Upcoming Jobs
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 no-padding">
                                <a data-toggle="collapse" href="#previousjobs-collapse-panel" role="button"
                                    aria-expanded="true" aria-controls="collapseExample" class="">
                                    <div class="previous jobs-collapse-btn">
                                        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                        Previous Jobs
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 no-padding">
                                <a data-toggle="collapse" href="#livejobs-collapse-panel" role="button"
                                    aria-expanded="true" aria-controls="collapseExample" class="">
                                    <div class="live jobs-collapse-btn">
                                        <i class="fa fa-bullseye" aria-hidden="true"></i>
                                        Live
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="upcomingjobs-collapse-panel" class="collapse show">
                            <?php
                            if (!empty($upcomingJobs)) { ?>
                            <?php foreach ($upcomingJobs as $jb) {
                                if (logged('role') < 5 || logged('id') == $jb->employee_id) {
                                    ?>
                            <div class="job-item-panel">
                                <div class="employee-name">
                                    <p><span class="name"><?=$jb->FName .' '.$jb->LName?></span>
                                    </p>
                                </div>
                                <div class="row no-margin jobs-list-item"
                                    data-address="<?=$jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code?>"
                                    data-job-title="<?=$jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name?>"
                                    data-office-address="<?=$jb->office_address.', '.$jb->office_city.', '.$jb->office_state.', '.$jb->office_postal_code?>"
                                    data-business-name="<?=$jb->business_name?>"
                                    data-group="upcoming">
                                    <div class="col-md-4 job-sched text-center">
                                        <a href="#">
                                            <time style="font-size: 10px; text-align: left;" datetime="2021-02-09"
                                                class="icon-calendar-live">
                                                <em><?= date('D', strtotime($jb->start_date)) ?></em>
                                                <strong style="background-color: #58c04e;"><?= date('M', strtotime($jb->start_date)) ?></strong>
                                                <span><?= date('d', strtotime($jb->start_date)) ?></span>
                                            </time>
                                        </a>
                                        <div class="job-status text-center mb-2"
                                            style="background:<?= $jb->event_color?>; color:#ffffff;">
                                            <b><?php echo strtoupper($jb->status); ?></b>
                                        </div>
                                        <span class="text-center after-status">ARRIVAL TIME</span><br>
                                        <span class="job-caption text-center">
                                            <?php echo get_format_time($jb->start_time); ?>-<?php echo get_format_time_plus_hours($jb->end_time); ?>
                                        </span>
                                    </div>
                                    <div class="col-md-8 job-details">
                                        <a style="color: #000!important;" href="#">
                                            <h6
                                                style="font-weight:600; margin:0;font-size: 14px;text-transform: uppercase; color:#616161;">
                                                <?php echo $jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name; ?>
                                            </h6>
                                            <b style="color:#45a73c;">
                                                <?= $jb->first_name. ' '. $jb->last_name; ?>
                                            </b><br>
                                            <?php if (!empty($settings['work_order_show_details']) && $settings['work_order_show_details'] == 1): ?>
                                            <small class="text-muted"><?= $jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code; ?></small><br>
                                            <i> <small class="text-muted"><?= $jb->job_description; ?></small></i><br>
                                            <?php endif; ?>
                                            <?php if (!empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1): ?>
                                            <small>Amount : $ <?= $jb->amount!="" ? number_format((float)$jb->amount, 2, '.', ',') : '0.00' ; ?></small>
                                            <br>
                                            <?php endif; ?>
                                            <?php if (!empty($settings['work_order_show_link']) && $settings['work_order_show_link'] == 1): ?>
                                            <a href="<?=$jb->link; ?>"
                                                target=""><small style="color: darkred;"><?=$jb->link; ?></small></a>
                                            <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            } ?>
                            <?php } else { ?>
                            <div class="cue-event-name no-data">No upcoming jobs.</div>
                            <?php } ?>
                        </div>
                        <div id="previousjobs-collapse-panel" class="collapse">
                            <?php
                            if (!empty($previousJobs)) { ?>
                            <?php foreach ($previousJobs as $jb) {
                                if (logged('role') < 5 || logged('id') == $jb->employee_id) {?>

                            <div class="job-item-panel"
                                data-job-id="<?=$jb->id?>">
                                <div class="employee-name">
                                    <p><span class="name"><?=$jb->FName .' '.$jb->LName?></span>
                                    </p>
                                </div>
                                <div class="row no-margin jobs-list-item">
                                    <div class="col-md-4 job-sched text-center">
                                        <a href="#">
                                            <time style="font-size: 10px; text-align: left;" datetime="2021-02-09"
                                                class="icon-calendar-live">
                                                <em><?= date('D', strtotime($jb->start_date)) ?></em>
                                                <strong style="background-color: #58c04e;"><?= date('M', strtotime($jb->start_date)) ?></strong>
                                                <span><?= date('d', strtotime($jb->start_date)) ?></span>
                                            </time>
                                        </a>
                                        <div class="job-status text-center mb-2"
                                            style="background:<?= $jb->event_color?>; color:#ffffff;">
                                            <b><?php echo strtoupper($jb->status); ?></b>
                                        </div>
                                        <span class="text-center after-status">ARRIVAL TIME</span><br>
                                        <span class="job-caption text-center">
                                            <?php echo get_format_time($jb->start_time); ?>-<?php echo get_format_time_plus_hours($jb->end_time); ?>
                                        </span>
                                    </div>
                                    <div class="col-md-8 job-details">
                                        <a style="color: #000!important;" href="#">
                                            <h6
                                                style="font-weight:600; margin:0;font-size: 14px;text-transform: uppercase; color:#616161;">
                                                <?php echo $jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name; ?>
                                            </h6>
                                            <b style="color:#45a73c;">
                                                <?= $jb->first_name. ' '. $jb->last_name; ?>
                                            </b><br>
                                            <?php if (!empty($settings['work_order_show_details']) && $settings['work_order_show_details'] == 1): ?>
                                            <small class="text-muted"><?= $jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code; ?></small><br>
                                            <i> <small class="text-muted"><?= $jb->job_description; ?></small></i><br>
                                            <?php endif; ?>
                                            <?php if (!empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1): ?>
                                            <small>Amount : $ <?= $jb->amount!="" ? number_format((float)$jb->amount, 2, '.', ',') : '0.00' ; ?></small>
                                            <br>
                                            <?php endif; ?>
                                            <?php if (!empty($settings['work_order_show_link']) && $settings['work_order_show_link'] == 1) {?>
                                            <a href="<?=$jb->link; ?>"
                                                target="">
                                                <small style="color: darkred; width:400px; overflow:hidden"><?=$jb->link==''?'':'Click here for the link' ?></small></a>

                                            <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php }
                            } ?>
                            <?php } else { ?>
                            <div class="cue-event-name no-data">No previous jobs.</div>
                            <?php } ?>
                        </div>
                        <div id="livejobs-collapse-panel" class="collapse">
                            <div class="livejobs-filter-section">
                                <form action="#" id="live-jobs-filter-form" data-user-id="14">
                                    <div class="row no-margin">
                                        <div class="col-md-10 no-padding" style="margin-bottom: 12px">
                                            <input type="text" name="job_long_id" id="livejob-long-id"
                                                class="form-control" placeholder="Search a job number">
                                        </div>
                                        <div class="col-md-2" style="margin-bottom: 12px">
                                            <button type="submit"
                                                class="btn btn-success action-btn btn-sm">View</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="loader" style="display: none;">
                                <center>
                                    <img src="<?=base_url('assets/img/trac360/loader1.gif')?>"
                                        alt="">
                                </center>
                            </div>
                            <div class="livejobs-section">
                                <?php
                            if (!empty($liveJobs)) { ?>
                                <?php foreach ($liveJobs as $jb) {
                                if (logged('role') < 5 || logged('id') == $jb->employee_id) {
                                    ?>
                                <div class="job-item-panel"
                                    data-job-id="<?=$jb->id?>"
                                    data-employee-id="<?=$jb->employee_id?>"
                                    data-customer-address="<?= $jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code; ?>"
                                    data-office-address="<?=$jb->office_address.', '.$jb->office_city.', '.$jb->office_state.', '.$jb->office_postal_code?>"
                                    data-customer-name="<?= $jb->first_name. ' '. $jb->last_name; ?>"
                                    data-business-name="<?=$jb->business_name?>">
                                    <div class="employee-name">
                                        <p><span class="name"><?=$jb->FName .' '.$jb->LName?></span>
                                        </p>
                                    </div>
                                    <div class="row no-margin jobs-list-item">
                                        <div class="col-md-4 job-sched text-center">
                                            <a href="#">
                                                <time style="font-size: 10px; text-align: left;" datetime="2021-02-09"
                                                    class="icon-calendar-live">
                                                    <em><?= date('D', strtotime($jb->start_date)) ?></em>
                                                    <strong style="background-color: #58c04e;"><?= date('M', strtotime($jb->start_date)) ?></strong>
                                                    <span><?= date('d', strtotime($jb->start_date)) ?></span>
                                                </time>
                                            </a>
                                            <div class="job-status text-center mb-2"
                                                style="background:<?= $jb->event_color?>; color:#ffffff;">
                                                <b><?php echo strtoupper($jb->status); ?></b>
                                            </div>
                                            <span class="text-center after-status">ARRIVAL TIME</span><br>
                                            <span class="job-caption text-center">
                                                <?php echo get_format_time($jb->start_time); ?>-<?php echo get_format_time_plus_hours($jb->end_time); ?>
                                            </span>
                                        </div>
                                        <div class="col-md-8 job-details">
                                            <a style="color: #000!important;" href="#">
                                                <h6
                                                    style="font-weight:600; margin:0;font-size: 14px;text-transform: uppercase; color:#616161;">
                                                    <?php echo $jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name; ?>
                                                </h6>
                                                <b style="color:#45a73c;">
                                                    <?= $jb->first_name. ' '. $jb->last_name; ?>
                                                </b><br>
                                                <?php if (!empty($settings['work_order_show_details']) && $settings['work_order_show_details'] == 1): ?>
                                                <small class="text-muted"><?= $jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code; ?></small><br>
                                                <i> <small class="text-muted"><?= $jb->job_description; ?></small></i><br>
                                                <?php endif; ?>
                                                <?php if (!empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1): ?>
                                                <small>Amount : $ <?= $jb->amount!="" ? number_format((float)$jb->amount, 2, '.', ',') : '0.00' ; ?></small>
                                                <br>
                                                <?php endif; ?>
                                                <?php if (!empty($settings['work_order_show_link']) && $settings['work_order_show_link'] == 1) {?>
                                                <a href="<?=$jb->link; ?>"
                                                    target="">
                                                    <small style="color: darkred; width:400px; overflow:hidden"><?=$jb->link==''?'':'Click here for the link' ?></small></a>

                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                            }?>
                                <?php } else { ?>
                                <div class="cue-event-name no-data">No live jobs.</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 map-section">
            <div id="map-loader">
                <center>
                    <img
                        src="<?=base_url("assets/img/trac360/loader.gif")?>" />
                </center>
                <h1 class="page-title">Initializing...</h1>
            </div>
            <div id="map-holder" style="display:none;">
                <div class="map-error-message">This is a danger alert—check it out!</div>
                <div id="jobs-map" style="display:none;"></div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('trac360/calendar'); ?>
<?php include viewPath('trac360/jobs_includes/live-jobs-modal'); ?>
<div id="from_external_html">
    <div id="external_upcoming_job">
        <?=$external_job_item_selected_view_html?>
    </div>
</div>
<!--</div>-->
<!-- end container-fluid -->
<!-- </div> -->
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    var jobs_map;
    var jobs_map_marker = [];
    var directionsService;
    var directionsRenderer;
    var infoWindow;

    function initMap() {
        $("#map-loader").hide();
        $("#map-holder").show();
        jobs_map = new google.maps.Map(document.getElementById("jobs-map"), {
            center: {
                lat: 37.0902,
                lng: 95.7129
            },
            zoom: 2,
        });

        $("#jobs-map").show();
        initLiveMap();
    }
    $(document).ready(function() {
        <?php
            if ($external_job_selcted == true) {
                echo 'external_jobs_list_item_clicked('.$external_job_id.', '.$external_employee_id.', "'.$external_employee_name.'", $("#external_upcoming_job").html(), "'.$item_address.'", "'.$item_job_title.'", "'.$item_office_address.'", "'.$item_business_name.'");';
            }
        ?>
    });
</script>
<script
    src="<?="https://maps.googleapis.com/maps/api/js?key=".GOOGLE_MAP_API_KEY."&callback=initMap&libraries=&v=weekly"?>"
    async></script>
<script
    src="<?="https://maps.googleapis.com/maps/api/geocode/json?address=Winnetka&key=".GOOGLE_MAP_API_KEY?>">
</script>