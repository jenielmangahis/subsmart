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
    .card_plus_sign{
        float: right;
        padding-right: 40px;
        font-size: 20px;
        display: block;
        margin-top: -38px;
    }
    .box_footer_icon{
        font-size: 20px;
    }
    .box_right{
        border-color: #e0e0e0 !important;
        border: 1px solid;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
    .card-body {
        padding: 0 !important;
    }
    .right-text{
        position: relative;
        float:right;
        right: 0;
        bottom: 10px;
    }
    #map{
        height: 210px;
    }
    .title-border{
        border-bottom: 2px solid rgba(0,0,0,.1);
        padding-bottom: 5px;
    }
    .icon_preview{
        font-size: 16px;
        color : #45a73c;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/events'); ?>
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
                                    <p class="page-title " style="font-weight: 700;font-size: 16px;"><?=  $jobs_data->event_number; ?> </p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php if($company_info->business_image != "" ): ?>
                                                <img style="width: 100px" id="attachment-image" alt="Attachment" src="<?=  '/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image; ?> ">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="right-text">
                                                <tbody>
                                                    <tr>
                                                        <td align="right">Event Type :</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" >Event Tags :</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" >Date :</td>
                                                     </tr>
                                                    <tr>
                                                        <td align="right" >Status :</td>
                                                     </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="right-text">
                                                <tbody>
                                                <tr>
                                                    <td align="right" ><?= $jobs_data->event_type;  ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="right" ><?= $jobs_data->event_tag;  ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="right" style="font-weight: 600;"><?=  $jobs_data->status;  ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <?php if($jobs_data->event_type == 'Estimate'): ?>
                                        <div class="col-md-12">
                                            <h6 class="title-border">FROM :</h6>
                                            <b><?= $company_info->business_name; ?></b><br>
                                            <span><?= $company_info->street; ?></span><br>
                                            <span><?= $company_info->city.' '.$company_info->state.' '.$company_info->postal_code ; ?></span><br>
                                            <span> Phone: <?= $company_info->business_phone ; ?></span>
                                        </div>

                                        <?php else: $created_by = get_employee_name($jobs_data->created_by); echo  $created_by;?>
                                            <div class="col-md-12">
                                                <br>
                                                <h6 class="title-border">Created By :<i><?= $created_by->FName.' '.$created_by->LName  ?></i> </h6>
                                                <div class="row">
                                                    <div class="col-md-4">

                                                    </div>
                                                    <div id="map" class="col-md-4"></div>
                                                    <div id="streetViewBody" class="col-md-4"></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($jobs_data->event_type == 'Estimate'): ?>
                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">TO :</h6>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
                                                    <span><?= $jobs_data->mail_add; ?></span><br>
                                                    <span><?= $jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span> <span class="fa fa-copy icon_preview"></span><br>
                                                    <span>Email: <?= $jobs_data->cust_email ; ?></span> <span class="fa fa-envelope icon_preview"></span><br>
                                                    <span>Phone: <?= $jobs_data->phone_h ; ?> </span>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                    <br>
                                                    <span>Mobile: <?= $jobs_data->phone_m ; ?></span>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                    <br>
                                                </div>

                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-12">
                                            <h6 class="title-border">Event Details :</h6>
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
                                                        foreach ($event_items as $item):
                                                        $total = $item->price * $item->qty;
                                                    ?>
                                                        <tr>
                                                            <td><?= $item->title; ?></td>
                                                            <td><?= $item->qty; ?></td>
                                                            <td>$<?= $item->price; ?></td>
                                                            <td>$<?= number_format((float)$total,2,'.',','); ?></td>
                                                        </tr>
                                                <?php
                                                    $subtotal = $subtotal + $total;
                                                    endforeach;
                                                ?>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <b>Sub Total</b>
                                            <b class="right-text">$<?= number_format((float)$subtotal,2,'.',','); ?></b>
                                            <br><hr>

                                            <?php if($jobs_data->tax != NULL): ?>
                                                <b>Tax </b>
                                                <i class="right-text">$0.00</i>
                                                <br><hr>
                                            <?php endif; ?>

                                            <?php if($jobs_data->discount != NULL): ?>
                                                <b>Discount </b>
                                                <i class="right-text">$0.00</i>
                                                <br><hr>
                                            <?php endif; ?>

                                            <b>Grand Total</b>
                                            <b class="right-text">$<?= number_format((float)$subtotal,2,'.',','); ?></b>
                                        </div>
                                        <div class="col-md-12">
                                            <br><br>
                                            <h6 class="title-border">Notes :</h6>
                                            <span><?=  $jobs_data->notes; ?></span>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">Assigned To :</h6>
                                            <?php
                                                $employee_date = get_employee_name($jobs_data->employee_id)
                                            ?>
                                            <span><?= $employee_date->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">Url Link :</h6>
                                            <span><a style="color: darkred;" target="_blank" href="<?= $jobs_data->url_link; ?>"><?= $jobs_data->url_link; ?></a></span>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <h6 class="title-border">Schedule :</h6>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td width="35%">From</td>
                                                        <td width="40%"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?></td>
                                                        <td width="40%"><?= isset($jobs_data) ?  $jobs_data->start_time : '';  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td >To</td>
                                                        <td ><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->end_date)) : '';  ?></td>
                                                        <td ><?= isset($jobs_data) ?  $jobs_data->end_time : '';  ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=&v=weekly"></script>

<script>
    var geocoder;
    function initMap(address=null) {
        address = '<?php echo $jobs_data->event_address;  ?>';
        if(address == null){
            address = '6866 Pine Forest Rd Pensacola FL 32526';
        }
        const myLatLng = { lat: -25.363, lng: 131.044 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            height:220,
            center: myLatLng,
        });
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello World!",
        });
        geocoder = new google.maps.Geocoder();
        codeAddress(geocoder, map,address);
        loadStreetView(address);
    }

    function codeAddress(geocoder, map,address) {
        geocoder.geocode({'address': address}, function(results, status) {
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

    function loadStreetView(address)
    {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>job/loadStreetView",
            data: {address : address}, // serializes the form's elements.
            success: function(data)
            {
                $('#streetViewBody').html(data);
            }
        });
    }
</script>

