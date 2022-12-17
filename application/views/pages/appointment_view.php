<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header_front'); ?>
<?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>    
<?php } ?>
<?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD"></script>
<?php } ?>
<?php include viewPath('job/css/job_new'); ?>
<style>
.body-main {
    background: #ffffff;
    border-bottom: 15px solid #1E1F23;
    border-top: 15px solid #1E1F23;
    margin-top: 30px;
    margin-bottom: 30px;
    padding: 40px 30px !important;
    position: relative ;
    box-shadow: 0 1px 21px #808080;
    font-size:10px;
}

.main thead {
    background: #1E1F23;
    color: #fff;
}
.img{
    height: 100px;
}
h1{
   text-align: center;
}
.rounded-circle {
    border-radius: 50%!important;
}
.img-fluid {
    /*max-width: 100%;*/
    /*height: auto;*/
    height: 88px;
    margin: 7px;
    width: 94px;
    display: inline-block;
}
.appointment-view-header {
    background-color: #6A4A86;
    padding: 10px;
    color: #ffffff;
    font-size: 18px;
}
</style>
<?php
    $c_phone = "---";
    $c_email = "---";

    if ($appointment->cust_phone != '') {
        $c_phone = $appointment->cust_phone;
    }

    if ($appointment->customer_email != '') {
        $c_email = $appointment->customer_email;
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3 body-main">
            <div class="col-md-12">
               <div class="row">
                    <div class="col-md-4">
                        <img class="img" alt="Invoce Template" src="<?= $url->assets . 'frontend/images/calendar-purple-violet.png' ?>" />
                    </div>
                    <div class="col-md-8 text-right">
                        <h4 style="color: #F81D2D;"><strong><?= $appointment->appointment_number; ?></strong></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 col-md-8">
                        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Customer</label>
                        <label class="content-subtitle fw-bold" style="font-size: 21px;margin-bottom: 23px;"><?= $appointment->customer_name; ?></label>
                        <label class="content-subtitle d-block font-15" style="margin-bottom:5px;"><span class="fw-bold"><i class="bx bxs-phone"></i> </span> <?= $c_phone; ?></label>
                        <label class="content-subtitle d-block font-15">
                            <ul class="location-list">
                                <li><span class="fw-bold"><i class='bx bxs-map-pin'></i></span></li>
                                <li>
                                    <span><?= $appointment->mail_add; ?></span>
                                    <span style="margin-top:7px;display: block;"><?= $appointment->cust_city . ', ' . $appointment->cust_state . ', '. $appointment->cust_zip_code; 
                                    ?>
                                    </span>
                                </li>
                            </ul>
                        </label>
                        <label class="content-subtitle d-block font-15" style="margin-bottom:5px;"><span class="fw-bold"><i class="bx bxs-phone"></i> </span> <?= $appointment->notes; ?></label>    
                        <br />
                        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Details</label>
                        <label class="content-subtitle d-block mb-2 font-15" style="margin-bottom: 5px;">
                            <span class="fw-bold"><i class='bx bxs-calendar'></i></span> 
                            <?= date("l, F d, Y", strtotime($appointment->appointment_date)); ?> - <?= date("g:i A", strtotime($appointment->appointment_time_from)); ?> to <?= date("g:i A", strtotime($appointment->appointment_time_to)); ?></label>
                        <?php if( $appointment->appointment_type_id != 4 ) { ?> 
                            <label class="content-subtitle d-block mb-2 font-15" style="margin-bottom: 5px;">
                                <span class="fw-bold"><i class='bx bx-phone-call'></i></span>
                                <?= $appointment->priority; ?>
                            </label>
                        <?php } ?>        
                        <!-- <label class="content-subtitle d-block mb-2 font-15"><span class="fw-bold"><i class='bx bx-list-ul'></i> Appointment Type:</span> <?= $appointment->appointment_type; ?></label> -->
                        <label class="content-subtitle d-block mb-2 font-15"><span class="fw-bold"><i class='bx bx-link'></i> </span> 
                            <?php if( $appointment->url_link != ''){ ?>
                                <a href="<?= $appointment->url_link; ?>" target="_new"><?= $appointment->url_link; ?></a>
                            <?php }else{ ?>
                                ---
                            <?php } ?>
                        </label>
                        <?php if( $appointment->appointment_type_id != 4 ){ ?>
                        <label class="content-subtitle d-block mb-2 font-15">
                            <span class="fw-bold"><i class='bx bx-barcode' ></i> </span> 
                            <?= $appointment->invoice_number . ' - $' . number_format($appointment->cost,2); ?>
                        </label>
                        <?php } ?>
                    </div>
                    <div class="col-md-4">                        
                        <?php if( $appointment->sales_agent_id > 0 ){ ?>
                            <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header" style="margin-top: 8px;">Sales Agent</label>
                            <div class="align-items-center">
                                <img src="<?= userProfileImage($appointment->sales_agent_id); ?>" class="img-fluid rounded-circle" alt="User">
                            </div>
                        <?php } ?>

                        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">
                            <?= $appointment->appointment_type_id == 4 ? 'Attendees' : 'Technician'; ?>            
                        </label>
                        <div class="align-items-center">
                            <?php $assigned_technician = json_decode($appointment->assigned_employee_ids); ?>
                            <?php foreach($assigned_technician as $aid){ ?>
                                <img src="<?= userProfileImage($aid); ?>" class="img-fluid rounded-circle" alt="User">
                            <?php } ?>            
                        </div>
                        <?php if( $appointment->appointment_type_id == 4 ) { ?>        
                            <small class="small-label"><i class='bx bxs-calendar-event'></i> <?= $appointment->priority; ?></small>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
