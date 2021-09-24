<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //"assets/css/accounting/sidebar.css",
    'assets/textEditor/summernote-bs4.css',
));
?>
<?php include viewPath('includes/header'); ?>

<!-- add css for this page -->
<?php include viewPath('job/css/job_new'); ?>
<style>
    div[wrapper__section] {
        padding: 60px 10px !important;
    }

    .card_plus_sign {
        float: right;
        padding-right: 40px;
        font-size: 20px;
        display: block;
        margin-top: -38px;
    }

    .box_footer_icon {
        font-size: 20px;
    }

    .box_right {
        border-color: #e0e0e0 !important;
        border: 1px solid;
    }

    .card {
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }

    .card-body {
        padding: 0 !important;
    }

    .right-text {
        position: relative;
        float: right;
        right: 0;
        bottom: 10px;
    }

    #map {
        height: 190px;
    }

    .title-border {
        border-bottom: 2px solid rgba(0, 0, 0, .1);
        padding-bottom: 5px;
    }

    .icon_preview {
        font-size: 16px;
        color: #45a73c;
    }

    /* track360 css */

    div#modal-for-start-job-confirmation {
        position: fixed;
        background: #00000073;
        width: 100%;
        height: 100vh;
        z-index: 1;
        top: 0;
    }

    div#modal-for-start-job-confirmation .the-modal-body {
        background: #ffffff;
        width: 500px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 12px;
    }

    div#modal-for-start-job-confirmation .the-modal-body .close-modal {
        position: absolute;
        right: -15px;
        background: #000;
        color: #fff;
        border-radius: 50%;
        padding: 10px 16px 11px 16px;
        top: -15px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
    }

    div#modal-for-start-job-confirmation .the-modal-body .info,
    div#modal-for-start-job-confirmation .the-modal-body .confirm {
        padding: 10px;
    }

    div#modal-for-start-job-confirmation .the-modal-body .confirm .text-confirmation {
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        color: #333;
    }

    div#modal-for-start-job-confirmation .the-modal-body .confirm .confirm-buttons {
        align-items: center;
        justify-content: center;
        display: flex;
    }

    div#modal-for-start-job-confirmation .the-modal-body .confirm .confirm-buttons button {
        padding: 10px;
        margin: 10px;
        border: 0;
        border-radius: .25em;
        color: #fff;
        font-size: 15px;
        width: 130px;
    }

    div#modal-for-start-job-confirmation .the-modal-body .confirm .confirm-buttons button.arrival {
        background-color: rgb(44, 160, 28);
    }

    div#modal-for-start-job-confirmation .the-modal-body .confirm .confirm-buttons button.cancel {
        background-color: rgb(221, 51, 51);
    }

    div#modal-for-start-job-confirmation .the-modal-body .map {
        background-color: #E7EAED;
        height: 300px;
        width: 100%;
        background-image: url("<?=base_url('assets/img/trac360/world-map.png')?>");
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
    }

    table.route-details-table {
        width: 100%;
    }

    #route-details-setion .route-details-table>tbody>tr>td.connected-icon,
    .route-details-setion .route-details-table>tbody>tr>td.connected-icon {
        width: 50px;
        text-align: center;
    }

    #route-details-setion .route-details-table>tbody>tr>td,
    .route-details-setion .route-details-table>tbody>tr>td {
        padding-left: 20px;
        height: 70px;
    }

    #route-details-setion .route-details-table .connected-icon>div,
    .route-details-setion .route-details-table .connected-icon>div {
        color: #ffffff;
        background-color: #2096F3;
        border-radius: 50%;
        padding: 5px;
        position: relative;
    }

    #route-details-setion .route-details-table .first-info .connected-icon>div:after,
    #route-details-setion .route-details-table .middle-info .connected-icon>div:after,
    .route-details-setion .route-details-table .first-info .connected-icon>div:after,
    .route-details-setion .route-details-table .middle-info .connected-icon>div:after {
        content: ' ';
        width: 3px;
        height: 45px;
        background-color: #2096F3;
        position: absolute;
        z-index: 1;
        bottom: -45px;
        left: 45%;
    }

    .route-details-table .address {
        font-size: 12px;
        font-weight: 600;
        color: #565656;
    }

    .route-details-table .date-time {
        font-size: 9px;
        color: #565656;
    }

    .route-details-table tr:hover {
        cursor: pointer;
    }

    .route-details-table tr:hover div.address {
        font-weight: 700;
        cursor: pointer;
        color: #000;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="right-text">
                                        <p class="page-title " style="font-weight: 700;font-size: 16px;"><?=  $jobs_data->job_number;  ?>
                                        </p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <?php if ($company_info->business_image != ""): ?>
                                            <img style="width: 100px" id="attachment-image" alt="Attachment"
                                                src="<?=  '/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image; ?> ">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="right-text">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" width="45%">Job Type :</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right">Job Tags:</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right">Date :</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right">Priority :</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right">Status :</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-4">
                                            <table class="right-text">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" width="65%"><?= $jobs_data->job_type;  ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right"><?= $jobs_data->name;  ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="color: darkred;"><?=  $jobs_data->priority;  ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="font-weight: 600;" class="job-status">
                                                            <?=  $jobs_data->status;  ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="title-border">FROM :</h6>
                                            <b><?= $company_info->business_name; ?></b><br>
                                            <span><?= $company_info->street; ?></span><br>
                                            <span><?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code ; ?></span><br>
                                            <span> Phone: <?= $company_info->business_phone ; ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">TO :</h6>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
                                                    <span><?= $jobs_data->mail_add; ?></span><br>
                                                    <span><?= $jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span>
                                                    <span class="fa fa-copy icon_preview"></span><br>
                                                    <span>Email: <?= $jobs_data->cust_email ; ?></span>
                                                    <a
                                                        href="mailto:<?= $jobs_data->cust_email ; ?>"><span
                                                            class="fa fa-envelope icon_preview"></span></a><br>
                                                    <span>Phone: </span>
                                                    <?php if ($jobs_data->phone_h!="" || $jobs_data->phone_h!=null): ?>
                                                    <?= $jobs_data->phone_h;  ?>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                    <?php else : echo 'N/A';?>
                                                    <?php endif; ?>
                                                    <br>
                                                    <span>Mobile: </span>
                                                    <?php if ($jobs_data->phone_m!="" || $jobs_data->phone_m!=null): ?>
                                                    <?= $jobs_data->phone_h;  ?>
                                                    <?= $jobs_data->phone_m;  ?>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                    <?php else : echo 'N/A';?>
                                                    <?php endif; ?>
                                                    <br>
                                                </div>
                                                <div id="map" class="col-md-3"></div>
                                                <div id="streetViewBody" class="col-md-4"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="title-border">JOB DETAILS :</h6>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Items</td>
                                                        <td>Qty</td>
                                                        <td>Price</td>
                                                        <td>Total</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $subtotal = 0.00;
                                                        foreach ($jobs_data_items as $item):
                                                        $total = $item->price * $item->qty;
                                                    ?>
                                                    <tr>
                                                        <td><?= $item->title; ?>
                                                        </td>
                                                        <td><?= $item->qty; ?>
                                                        </td>
                                                        <td>$<?= $item->price; ?>
                                                        </td>
                                                        <td>$<?= number_format((float)$total, 2, '.', ','); ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $subtotal = $subtotal + $total;
                                                    endforeach;
                                                ?>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <b>Sub Total</b>
                                            <b class="right-text">$<?= number_format((float)$subtotal, 2, '.', ','); ?></b>
                                            <br>
                                            <hr>

                                            <?php if ($jobs_data->tax != null): ?>
                                            <b>Tax </b>
                                            <i class="right-text">$0.00</i>
                                            <br>
                                            <hr>
                                            <?php endif; ?>

                                            <?php if ($jobs_data->discount != null): ?>
                                            <b>Discount </b>
                                            <i class="right-text">$0.00</i>
                                            <br>
                                            <hr>
                                            <?php endif; ?>

                                            <b>Grand Total</b>
                                            <b class="right-text">$<?= number_format((float)$subtotal, 2, '.', ','); ?></b>
                                        </div>
                                        <div class="col-md-12">
                                            <br><br>
                                            <h6 class="title-border">NOTES :</h6>
                                            <span><?=  $jobs_data->message; ?></span>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">ASSIGNED TO :</h6>
                                            <?php
                                                $employee_date = get_employee_name($jobs_data->employee_id);
                                                $shared1 = get_employee_name($jobs_data->employee2_id);
                                                $shared2 = get_employee_name($jobs_data->employee3_id);
                                                $shared3 = get_employee_name($jobs_data->employee4_id);
                                            ?>
                                            <span><?= $employee_date->FName; ?></span>
                                            <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                            <?php if (isset($shared1) && !empty($shared1) && $shared1!=null): ?>
                                            <span><?= $shared1->FName; ?></span>
                                            <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                            <?php endif; ?>
                                            <?php if (isset($shared2) && !empty($shared2) && $shared2!=null): ?>
                                            <span><?= $shared2->FName; ?></span>
                                            <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                            <?php endif; ?>
                                            <?php if (isset($shared3) && !empty($shared3) && $shared3!=null): ?>
                                            <span><?= $shared3->FName; ?></span>
                                            <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">URL LINK :</h6>
                                            <span><a style="color: darkred;" target="_blank"
                                                    href="<?= $jobs_data->link; ?>"><?= $jobs_data->link; ?></a></span>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">SCHEDULE :</h6>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td width="35%">From</td>
                                                        <td width="40%"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?>
                                                        </td>
                                                        <td width="40%"><?= isset($jobs_data) ?  $jobs_data->start_time : '';  ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>To</td>
                                                        <td><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->end_date)) : '';  ?>
                                                        </td>
                                                        <td><?= isset($jobs_data) ?  $jobs_data->end_time : '';  ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12">
                                            <center>
                                                <strong>Our Team will arrive between <?= $jobs_data->start_time. ' and '.$jobs_data->end_time;  ?></strong><br>
                                                <small style="text-align: center;">Thank you for your business, Please
                                                    call <?= $company_info->business_name; ?>
                                                    at <?= $company_info->business_phone; ?>
                                                    for quality customer service.</small>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-for-start-job-confirmation" style="display: none;">
    <div class="the-modal-body">
        <div class="close-modal">x</div>
        <div class="map"></div>
        <div class="info">
            <div id="route-details-setion">
                <table class="route-details-table">
                    <tbody class="tbody">
                        <tr class="last-coords-details first-info" data-i="0">
                            <td class="connected-icon">
                                <div><i class="fa fa-car" aria-hidden="true"></i></div>
                            </td>
                            <td>
                                <div class="address">
                                    <?=$company_info->street?>
                                    <?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code ?>
                                </div>
                                <div class="date-time"><?= isset($jobs_data) ?  date('F d, Y', strtotime($jobs_data->start_date)) : '';  ?>
                                    <?= isset($jobs_data) ?  $jobs_data->start_time : '';  ?>
                                </div>
                            </td>
                        </tr>
                        <tr class="last-coords-details last-info" data-i="3">
                            <td class="connected-icon">
                                <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                            </td>
                            <td>
                                <div class="address">
                                    <?=$jobs_data->mail_add;?>
                                    <?=$jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code?>
                                </div>
                                <div class="date-time">
                                    <?= isset($jobs_data) ?  date('F d, Y', strtotime($jobs_data->end_date)) : '';  ?>
                                    <?= isset($jobs_data) ?  $jobs_data->end_time : '';  ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="confirm">
            <div class="text-confirmation">
                <?php
             if (logged('id') == $jobs_data->employee_id) {
                 echo "Are you now heading to the job distination?";
             } else {
                 echo "Is $employee_date->FName heading now to the job distination?";
             }
             ?>

            </div>
            <div class="confirm-buttons">
                <button type="button" class="cancel">Not yet</button>
                <button type="button" class="arrival"
                    data-job="<?=$jobs_data->id?>">Start Now</button>
            </div>
        </div>
    </div>
</div>
<?php
add_footer_js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js',
    'assets/textEditor/summernote-bs4.js',
));
include viewPath('includes/footer');
?>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=&v=weekly">
</script>


<script>
    var geocoder;

    function initMap(address = null) {
        if (address == null) {
            address = '6866 Pine Forest Rd Pensacola FL 32526';
        }
        const myLatLng = {
            lat: -25.363,
            lng: 131.044
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            height: 220,
            center: myLatLng,
        });
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello World!",
        });
        geocoder = new google.maps.Geocoder();
        codeAddress(geocoder, map, address);
    }

    function codeAddress(geocoder, map, address) {
        geocoder.geocode({
            'address': address
        }, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                console.log(status);
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
    $(document).on("click", "div#modal-for-start-job-confirmation .the-modal-body .close-modal", function(event) {
        $("div#modal-for-start-job-confirmation").fadeOut();
    });
    $(document).on("click",
        "div#modal-for-start-job-confirmation .the-modal-body .confirm .confirm-buttons button.cancel",
        function(event) {
            $("div#modal-for-start-job-confirmation").fadeOut();
        });
    <?php
    if (date('m/d/Y H:i:s', strtotime($jobs_data->start_date . " ".$jobs_data->start_time)) <= date("m/d/Y H:i:s") && $jobs_data->status == "Scheduled" && (logged('id') == $jobs_data->employee_id || logged("role") < 5)) {
        echo " $('div#modal-for-start-job-confirmation').fadeIn();";
    }
    ?>

    $(document).on("click",
        "div#modal-for-start-job-confirmation .the-modal-body .confirm .confirm-buttons button.arrival",
        function(event) {
            $.ajax({
                type: 'POST',
                url: baseURL + "on-my-way-to-job",
                data: {
                    id: $(this).attr("data-job"),
                    status: "Arrival"
                },
                success: function(data) {
                    if (data == "Success") {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Take care!",
                            html: "Job status has been updated to arrival.",
                            icon: "success",
                        });
                        $("div#modal-for-start-job-confirmation").fadeOut();
                        $('.card-body table td.job-status').html("Arrival");
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Ooops",
                            html: "Please try again later!",
                            icon: "Error",
                        });
                    }
                }
            })
        });
</script>