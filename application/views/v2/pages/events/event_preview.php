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
<?php include viewPath('v2/includes/header'); ?>
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
    #event-map-preview{
        height: 310px;
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
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/add_new_job_tag'); ?>'">
        <i class='bx bx-tag'></i>
    </div>
</div>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/events_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_subtabs'); ?>
    </div>
    <hr />
    <div class="col-12 mt-4">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">                                
                                    <div class="right-text" style="margin-right: 4.5rem;">
                                        <p class="page-title" style="font-weight: 700;font-size: 16px; margin-top: 10%; margin-right: 4px;"><?=  $jobs_data->event_number; ?> </p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-11" style="margin-left: 2rem;">

                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <?php if($company_info->business_image != "" ): ?>
                                                                <img style="width: 100px" id="attachment-image" alt="Attachment" src="<?= businessProfileImage($company_info->id); ?> ">
                                                            <?php endif; ?>                                                            
                                                        </td>
                                                        <td>
                                                            <table class="right-text">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 110px;">Event Type :</td>
                                                                        <td align="right" style="width: 180px;"><?= $jobs_data->event_type;  ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 110px;">Event Tags :</td>
                                                                        <td align="right" style="width: 180px;"><?= $jobs_data->event_tag;  ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 110px;">Date :</td>
                                                                        <td align="right" style="width: 180px;"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 110px;">Status :</td>
                                                                        <td align="right" style="width: 180px;"><strong><?=  $jobs_data->status;  ?></strong></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>                                        
                                            
                                        </div>

                                        <?php if($jobs_data->event_type == 'Estimate'): ?>

                                            <div class="col-md-11" style="margin-left: 2rem;">
                                                <h6 class="title-border">FROM :</h6>
                                                <b><?= $company_info->business_name; ?></b><br>
                                                <span><?= $company_info->street; ?></span><br>
                                                <span><?= $company_info->city.' '.$company_info->state.' '.$company_info->postal_code ; ?></span><br>
                                                <span> Phone: <?= $company_info->business_phone ; ?></span>
                                            </div>

                                        <?php else: $created_by = get_employee_name($jobs_data->created_by);?>
                                            <div class="col-md-11" style="margin-left: 2rem;">
                                                <!-- <h6 class="title-border">Created By :<i><?php //echo $created_by->FName.' '.$created_by->LName  ?></i> </h6> -->
                                                <h6 class="title-border">Created By : <?= $created_by;  ?></h6>
                                                <div class="row">
                                                    <div id="event-map-preview" class="event-map-preview"></div>
                                                    <!-- <div id="map" class="col-md-4"></div> -->
                                                    <!-- <div id="streetViewBody" class="col-md-4"></div> -->
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
                                        <div class="row" style="margin-left: 2rem; margin-top: 1rem;">
                                            <!--     
                                            <div class="col-md-11">
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
                                                            $total = $item->item_price * $item->qty;
                                                        ?>
                                                            <tr>
                                                                <td><?= $item->title; ?></td>
                                                                <td><?= $item->qty; ?></td>
                                                                <td>$<?= $item->item_price; ?></td>
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
                                            -->

                                            <div class="col-md-11">
                                                <br><br>
                                                <h6 class="title-border">Notes :</h6>
                                                <span><?=  $jobs_data->notes; ?></span>
                                            </div>

                                            <!-- <div class="col-md-11">
                                                <br>
                                                <h6 class="title-border">Assigned To :</h6>
                                                <?php
                                                    //$employee_date = get_employee_name($jobs_data->employee_id)
                                                ?>
                                                <span><?php //echo $employee_date->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span>
                                            </div> -->

                                        <div class="col-md-11">
                                            <br>
                                            <h6 class="title-border">Url Link :</h6>
                                            <span><a style="color: darkred;" target="_blank" href="<?= $jobs_data->url_link; ?>"><?= $jobs_data->url_link; ?></a></span>
                                        </div>

                                        <div class="col-md-11">
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

                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
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
?>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<!-- Map files -->
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<!-- End Map files -->

<script>
    /*var geocoder;
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
    }*/

    var myAPIKey       = "<?= GEOAPIKEY ?>";  
    <?php if($default_lat != "" && $default_lon != "") { ?>
            var default_lat    = '<?php echo $default_lat; ?>';
            var default_lon    = '<?php echo $default_lon; ?>';        
            var map_zoom_level = '11';  
    <?php } else { ?>
            var default_lat    = '39.7837304';
            var default_lon    = '-100.445882';   
            var map_zoom_level = '5';    
    <?php } ?>

    var map_style = 'osm-bright';

    var center = {
        lat: default_lat,
        lon: default_lon
    };        

    var geoMap = new maplibregl.Map({
    center: [center.lon, center.lat],
    zoom: map_zoom_level,
    container: 'event-map-preview',
    style: `https://maps.geoapify.com/v1/styles/${map_style}/style.json?apiKey=${myAPIKey}`,
    });
    geoMap.addControl(new maplibregl.NavigationControl()); 
    var currentMarkers=[];
       
</script>

<?php include viewPath('v2/includes/footer'); ?>