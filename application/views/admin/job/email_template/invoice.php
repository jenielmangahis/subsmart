<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/font-awesome/css/font-awesome.min.css">
        <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $url->assets ?>dashboard/css/responsive.css" rel="stylesheet" type="text/css">
    </head>

<!-- add css for this page -->
<?php include viewPath('job/css/job_new'); ?>
<style>
    div[wrapper__section] {
        padding: 60px 10px !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 ) !important;
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
        height: 190px;
    }
    .title-border{
        border-bottom: 2px solid rgba(0,0,0,.1);
        padding-bottom: 5px;
    }
    .icon_preview{
        font-size: 16px;
        color : #45a73c;
    }
    .table td, .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 0 !important;
    }
    hr{
        width: 90% !important;
    }
</style>
<body style="background:white !important;">

<div class="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <div class="card">
                                <br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                            <?php if($company_info->business_logo != ""): ?>
                                                <img style="width: 100px" id="attachment-image" alt="Attachment" src="<?=  base_url().$company_info->business_logo; ?> ">
                                            <?php endif; ?>
                                                <br>
                                                <h1 style="font-size: 28px;">Your invoice from <?=  $company_info->business_name; ?></h1>
                                            </center>
                                            <br>
                                        </div>
                                        <div class="col-md-12" style="margin-left:30px;padding-right:40px !important; ">
                                            <table class="left-text">
                                                <tbody>
                                                <tr>
                                                    <td align="left" width="35%"><b>Job Number: </b></td>
                                                    <td align="left" width="35%"><?= $jobs_data->job_number;  ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" ><b>Date :</b></td>
                                                    <td align="left"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?></td>

                                                </tr>
                                                <tr>
                                                    <td align="left" ><b>Customer Name:</b></td>
                                                    <td align="left"><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" ><b>Service Address: </b></td>
                                                    <td align="left"><?= $jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <br><br>
                                            <h1 style="font-size: 20px;">Services</h1>

                                            <table style="width:95% !important;" class="table table-bordered">
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
                                            <span>Sub Total</span>
                                            <span class="pull-right" style="margin-right:40px; ">$<?= number_format((float)$subtotal,2,'.',','); ?></span>
                                            <br><hr>

                                            <?php if($jobs_data->tax != NULL): ?>
                                                <b>Tax </b>
                                                <i class="pull-right">$0.00</i>
                                                <br><hr>
                                            <?php endif; ?>

                                            <?php if($jobs_data->discount != NULL): ?>
                                                <b>Discount </b>
                                                <i class="pull-right">$0.00</i>
                                                <br><hr>
                                            <?php endif; ?>

                                            <b style="font-size: 20px;">Amount Paid</b>
                                            <b class="pull-right" style="margin-right:40px;font-size: 20px; ">$<?= number_format((float)$subtotal,2,'.',','); ?></b>

                                            <br><br>
                                            <h6>Payment Method :</h6>
                                            <strong><?=  $jobs_data->method; ?></strong><br>
                                            <i><?=  $jobs_data->start_date; ?></i><br>
                                            <i><?=  $jobs_data->end_time; ?></i><br>
                                            <br><br>
                                            <div  style="margin-right:40px;">
                                            <center>
                                                <i>Delinquent Account are subject to Property Liens. Interest will be charged to delinquent accounts at the rate of 1.5% (18% Annum). per month.
                                                    In the event of default, the customer agrees to pay all cost of collection, including attorney's fees, whether suit is brought or not.
                                                </i>
                                                <br>
                                                <small style="text-align: center;">Thank you for your business, Please call <?= $company_info->business_name; ?> at <?= $company_info->business_phone; ?> for quality customer service.</small>
                                            </center>
                                                <br>
                                                <br>
                                            </div>
                                            <br>
                                            <center>
                                                <em>Powered By</em><br>
                                                <img width="200" src="http://nsmartrac/assets/dashboard/images/logo.png" alt="">
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

<?php
add_footer_js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
));
//include viewPath('includes/footer');
?>

</body>
</html>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=&v=weekly"></script>


<script>
    var geocoder;
    function initMap(address=null) {
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
</script>

