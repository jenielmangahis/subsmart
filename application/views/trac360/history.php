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
                                    class="btn btn-primary  trac360_side_controls " id=""><span
                                        class="fa fa-briefcase fa-2x" class="text-center"></span><br>Jobs</a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>trac360/places"
                                    class="btn btn-primary  trac360_side_controls" id=""><span
                                        class="fa fa-map-marker fa-2x" class="text-center"></span><br>Places</a>
                            </li>
                            <li><a href="<?= base_url() ?>trac360/history"
                                    class="btn btn-primary  trac360_side_controls current-page" id=""><span
                                        class="fa fa-map fa-2x" class="text-center"></span><br>History</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9  trac360_main_sections jobs-list-section" style="background-color: #fff;">
                    <div id="employees-view-history-panel" class="overflow-auto panel-closed" style="top:0;">
                        <div class="employee-name" style="min-width:439px;">
                            <p><span class="name">Lou Pinton</span>
                            </p>
                        </div>
                        <div class="close-btn"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                        <div class="panel-content">
                            <div class="filter-panel" class="row no-margin">
                                <form action="#" id="employee-history-filter-form">
                                    <div class="row no-margin">
                                        <div class="col-md-5 no-padding" style="margin-bottom: 12px">
                                            <label for="from_date_logs" class="week-label">From:</label>
                                            <input type="text" name="date_from" id="employe-history-from"
                                                class="form-control date-picker"
                                                value="<?php echo date('m/d/Y', strtotime('monday this week')) ?>">
                                        </div>
                                        <div class="col-md-5 no-padding" style="margin-bottom: 12px">
                                            <label for="to_date_logs" class="week-label">To:</label>
                                            <input type="text" name="date_to" id="employe-history-to"
                                                class="form-control date-picker"
                                                value="<?php echo date('m/d/Y') ?>">
                                        </div>
                                        <div class="col-md-2" style="margin-bottom: 12px">
                                            <div><label for="to_date_logs" class="week-label">&nbsp;</label>
                                            </div>
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
                            <div id="route-details-setion">
                                <table class="route-details-table">
                                    <tbody class="tbody">
                                        <tr class="first-info">
                                            <td class="connected-icon">
                                                <div><i class="fa fa-car" aria-hidden="true"></i></div>
                                            </td>
                                            <td>
                                                <div class="address">Champagne Avenue, Panabo, Davao del Norte,
                                                    Philippines</div>
                                                <div class="date-time">May 1, 2021 1:00 PM GMT+8</div>
                                            </td>
                                        </tr>

                                        <tr class="middle-info">
                                            <td class="connected-icon">
                                                <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                            </td>
                                            <td>
                                                <div class="address">Panabo, Davao del Norte,
                                                    Philippines</div>
                                                <div class="date-time">May 1, 2021 2:00 PM GMT+8</div>
                                            </td>
                                        </tr>

                                        <tr class="middle-info">
                                            <td class="connected-icon">
                                                <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                            </td>
                                            <td>
                                                <div class="address">Southern Davao, Panabo, Davao del Norte,
                                                    Philippines</div>
                                                <div class="date-time">May 1, 2021 2:00 PM GMT+8</div>
                                            </td>
                                        </tr>

                                        <tr class="last-info">
                                            <td class="connected-icon">
                                                <div><i class="fa fa-stop-circle" aria-hidden="true"></i></div>
                                            </td>
                                            <td>
                                                <div class="address">Champagne Avenue, Panabo, Davao del Norte,
                                                    Philippines</div>
                                                <div class="date-time">May 1, 2021 3:00 PM GMT+8</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="employee-upcoming-jobs" class="overflow-auto" style="height: 100%;">
                        <div class="row no-margin">
                            <div class="col-md-6 no-padding">
                                <a data-toggle="collapse" href="#people-collapse-panel" role="button"
                                    aria-expanded="true" aria-controls="collapseExample" class="">
                                    <div class="people collapse-btn collapse-active">People</div>
                                </a>
                            </div>
                            <div class="col-md-6 no-padding">
                                <a data-toggle="collapse" href="#previousjobs-collapse-panel" role="button"
                                    aria-expanded="true" aria-controls="collapseExample" class="">
                                    <div class="previous collapse-btn">Previous Jobs</div>
                                </a>
                            </div>
                        </div>
                        <div id="people-collapse-panel" class="collapse show">

                            <?php
                                $active_html = "";
                                $inactive_html = "";
                                foreach ($user_locations as $user) {
                                    $exploded = explode(",", $user->last_tracked_location);
                                    if ($user->last_tracked_location == "") {
                                        $profile_status = "inactive";
                                        $onclick = "";
                                    } else {
                                        $profile_status = "active";
                                        // $onclick = 'onclick="user_selected( ' . $exploded[0] . ', ' . $exploded[1] . ',' . $user->user_id . ')"';
                                    }

                                    $image = base_url() . '/uploads/users/user-profile/' . $user->profile_img;
                                    if (!@getimagesize($image)) {
                                        $image = base_url('uploads/users/default.png');
                                    }

                                    if ($user_id == $user->user_id) {
                                        $current_view = "current_view";
                                        $current_user_profile_img = $image;
                                        $current_user_name = $user->FName . ' ' . $user->LName;
                                    } else {
                                        $current_view = "";
                                    }
                                    $html = '<div id="sec-2-option-' . $user->user_id . '" class="sec-2-option ' . $current_view . '" ' . $onclick . '>';
                                    $html .= '<div class="row ">
                                            <div class="col-md-3 profile">';
                                    $html .= '<center><img src="' . $image . '" alt="user" class="rounded-circle user-profile ' . $profile_status . '"></center>';
                                    $html .= '<p class="name"> ' . $user->FName . '</p>
                                    </div>
                                    <div class="col-md-9 details">
                                    <p id="last_tract_location_' . $user->user_id . '" class="last_tract_location"><span class="fa fa-map-marker" class="text-center"></span> ';
                                    if ($user->last_tracked_location_address == "") {
                                        $last_loc =  "Lost connection";
                                    } else {
                                        $last_loc = $user->last_tracked_location_address;
                                    }
                                    $html .= $last_loc;
                                    $html .= '<p><span class="fa fa-clock-o" class="text-center"></span> ';
                                    $hours_diff = get_differenct_of_dates($user->last_tracked_location_date, date('Y-m-d H:i:s'));
                                    if ($hours_diff >= 24) {
                                        $time_display = round($hours_diff / 24, 0) . " Days ago";
                                    } elseif ($hours_diff >= 1) {
                                        $time_display = round($hours_diff, 0) . " Hours ago";
                                    } else {
                                        if (round($hours_diff * 60, 2) < 1) {
                                            $time_display = " Few seconds ago";
                                        } else {
                                            $time_display = round($hours_diff * 60, 0) . " Minutes ago";
                                        }
                                    }
                                    $html .= $time_display . '</p>
                                        <div class="people-job-btns">
                                        <button href="#" class="people-job-btn" data-user-id="'.$user->user_id .'" data-name="'.$user->FName.' '.$user->LName.'" data-toggle="tooltip" title="View history">
                                            <i class="fa fa-street-view" aria-hidden="true"></i>
                                        </button>
                                        <button href="#" class="people-job-btn" data-user-id="'.$user->user_id .'" data-name="'.$user->FName.' '.$user->LName.'" data-toggle="tooltip" title="View previous jobs">
                                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                                        </button>
                                        </div>
                                    </div>
                                    </div>
                                </div>';
                                    if ($profile_status == "inactive") {
                                        $inactive_html .= $html;
                                    } else {
                                        $html .= '<div style="display:none;"><div id="map_marker_' . $user->user_id . '" class="popup-map-marker"><img src="' . $image . '" class="popup-map-marker" title="' . $user->FName . ' ' . $user->LName . '" /></div></div>';
                                        $active_html .= $html;
                                    }
                                }
                                echo $active_html . "" . $inactive_html;
                                ?>
                        </div>
                        <div id="previousjobs-collapse-panel" class="collapse">
                            <?php
                            if (!empty($previousJobs)) { ?>
                            <?php foreach ($previousJobs as $jb) { ?>
                            <div class="job-item-panel">
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
                            <?php } ?>
                            <?php } else { ?>
                            <div class="cue-event-name no-data">No previous jobs.</div>
                            <?php } ?>
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
                <div id="history-map" style="display:none;"></div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('trac360/calendar'); ?>

<!--</div>-->
<!-- end container-fluid -->
<!-- </div> -->
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    var date_today = "<?=date('m/d/Y')?>";
    var history_map;
    var history_map_marker = [];
    var antennasCircle_history_map;
    var directionsService;
    var directionsRenderer;
    var infoWindow;

    function initMap() {
        $("#map-loader").hide();
        $("#map-holder").show();
        history_map = new google.maps.Map(document.getElementById("history-map"), {
            center: {
                lat: 37.0902,
                lng: 95.7129
            },
            zoom: 2,
        });
        $("#history-map").show();
    }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initMap&libraries=&v=weekly"
    async></script>
<script
    src="https://maps.googleapis.com/maps/api/geocode/json?address=Winnetka&key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU">
</script>