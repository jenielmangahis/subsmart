<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/add_new_job_tag'); ?>'">
        <i class='bx bx-tag'></i>
    </div>
</div>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
<hr>
    <div class="col-12 mt-4">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="right-text">
                                        <span class="page-title " style="font-weight: bold;font-size: 16px; float: right"><?=  $jobs_data->job_number;  ?>
                                        </span>
                                    </div>
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
                                            <table class="right-text float-end">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" width="65%"><strong><?= $jobs_data->job_type;  ?></strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right"><strong><?= $jobs_data->name;  ?></strong>
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
                                            <span> Phone: <?= formatPhoneNumber($company_info->business_phone); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">TO :</h6>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
                                                    <span><?= $jobs_data->mail_add; ?></span><br>
                                                    <span><?= $jobs_data->cust_city.', '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span>
                                                    <span class="fa fa-copy icon_preview"></span><br>
                                                    <span>Email: <?= $jobs_data->cust_email ; ?></span>
                                                    <a
                                                        href="mailto:<?= $jobs_data->cust_email ; ?>"><span
                                                            class="fa fa-envelope icon_preview"></span></a><br>
                                                    <span>Phone: </span>
                                                    <?php if ($jobs_data->phone_h!="" || $jobs_data->phone_h!=null): ?>
                                                    <?= formatPhoneNumber($jobs_data->phone_h);  ?>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                    <?php else : echo 'N/A';?>
                                                    <?php endif; ?>
                                                    <br>
                                                    <span>Mobile: </span>
                                                    <?php if ($jobs_data->phone_m!="" || $jobs_data->phone_m!=null): ?>
                                                    <!-- <?= $jobs_data->phone_h;  ?> -->
                                                    <?= formatPhoneNumber($jobs_data->phone_m);  ?>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                    <?php else : echo 'N/A';?>
                                                    <?php endif; ?>
                                                    <br>
                                                </div>
                                                <div id="map" class="col-md-3 d-none"></div>
                                                <div id="streetViewBody" class="col-md-4 d-none"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 16px;">
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
                                                        $total = $item->cost * $item->qty;
                                                    ?>
                                                    <tr>
                                                        <td><?= $item->title; ?>
                                                        </td>
                                                        <td><?= $item->qty; ?>
                                                        </td>
                                                        <td>$<?= $item->cost; ?>
                                                        </td>
                                                        <td>$<?= number_format((float)$total, 2, '.', ','); ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $subtotal = $subtotal + $total;
                                                    endforeach;
                                                    $GRAND_TOTAL = $subtotal + $jobs_data->tax_rate;
                                                ?>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <b>Sub Total:</b>
                                            <span class="right-text">$<?= number_format((float)$subtotal, 2, '.', ','); ?></span>
                                            <br>
                                            <b>Tax Rate:</b>&nbsp;
                                            <span class="right-text">$<?= number_format((float)$jobs_data->tax_rate, 2, '.', ','); ?></span>
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

                                            <b>Grand Total:</b>
                                            <b class="right-text">$<?= number_format((float)$GRAND_TOTAL, 2, '.', ','); ?></b>
                                        </div>
                                        <div class="col-md-12">
                                            <br><br>
                                            <h6 class="title-border">NOTES :</h6>
                                            <span><?= isset($jobs_data->message) && strlen($jobs_data->message) ? $jobs_data->message : "No notes given."; ?></span>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">ASSIGNED TO :</h6>
                                            <div>
                                                <strong>
                                                    <span><?= $employee_date = get_employee_name($jobs_data->employee_id); ?></span><br>
                                                    <span><?= $shared1 = get_employee_name($jobs_data->employee2_id); ?></span><br>
                                                    <span><?= $shared2 = get_employee_name($jobs_data->employee3_id); ?></span><br>
                                                    <span><?= $shared3 = get_employee_name($jobs_data->employee4_id); ?></span>
                                                </strong>
                                            </div>
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
                        <div class="col-md-2"></div>
                    </div>
                </div>
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

    // Temporarily remove job_preview modal because of no styling
    $("div#modal-for-start-job-confirmation").remove();

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
<?php include viewPath('v2/includes/footer'); ?>