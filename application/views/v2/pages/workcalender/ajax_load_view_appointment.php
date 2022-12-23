<style>
.font-15{
    font-size: 15px;
}
.appointment-view-header{
    background-color: #6A4A86;
    padding: 10px;
    color: #ffffff;
    font-size: 14px;
}
.appointment-notes{
    display: block;
    min-height: 100px;
    max-height: 300px;
    overflow: auto;
    background-color: #cccccc;
    padding: 10px;
    width: 100%;
}
.location-list{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.location-list li{
    margin-right: 0px;
    vertical-align: top;
    display: inline-block;
}
.small-label{
    text-align: center;
    display: block;
    width: 100%;
    font-weight: bold;
    background-color: #DAD1E0;
    padding: 5px;
    margin-top: 9px;
}
</style>
<?php if ($appointment) { ?>
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
    <div class="col-12 col-md-12">
        <label class="content-subtitle fw-bold d-block mb-2" style="font-size:20px;">
            <?= $appointment->appointment_number; ?>
            <?= $text_tags != '' ? ' - ' . $text_tags : ''; ?>        
        </label>
    </div>
    <?php if( $appointment->appointment_type_id == 4 ){ ?>
        <div class="col-12 col-md-7">
            <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Event</label>
            <label class="content-subtitle fw-bold" style="font-size: 21px;margin-bottom: 23px;"><?= $appointment->event_name; ?></label>
            <label class="content-subtitle d-block mb-2 font-15" style="margin-bottom: 5px;">
                <span class="fw-bold"><i class='bx bxs-calendar'></i></span> 
                <?= date("l, F d, Y", strtotime($appointment->appointment_date)); ?> - <?= date("g:i A", strtotime($appointment->appointment_time_from)); ?> to <?= date("g:i A", strtotime($appointment->appointment_time_to)); ?></label>
            <label class="content-subtitle d-block mb-2 font-15"><span class="fw-bold"><i class='bx bx-link'></i> </span> 
                <?php if( $appointment->url_link != ''){ ?>
                    <a href="<?= $appointment->url_link; ?>" target="_new"><?= $appointment->url_link; ?></a>
                <?php }else{ ?>
                    ---
                <?php } ?>
            </label>
            <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header mt-5">Notes</label>
                <div class="d-flex">
                <span class="appointment-notes"><?= $appointment->notes; ?></span>
            </div>
        </div>
    <?php }else{ ?>
        <div class="col-12 col-md-7">
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
            <br />
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
    <?php } ?>
    
    <div class="col-12 col-md-5">
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Created By</label>
        <div class="d-flex align-items-center">
            <div class="nsm-profile me-3" style="background-image: url('<?= userProfileImage($appointment->user_id); ?>'); width: 40px;"></div>
            <!-- <label class="content-subtitle fw-bold"><?= $appointment->employee_name; ?></label> -->
        </div>
        <?php if( $appointment->sales_agent_id > 0 ){ ?>
            <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header" style="margin-top: 8px;">Sales Agent</label>
            <div class="d-flex align-items-center">
                <div class="nsm-profile me-3" style="background-image: url('<?= userProfileImage($appointment->sales_agent_id); ?>'); width: 40px;"></div>
            </div>
        <?php } ?>

        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header" style="margin-top: 8px;">
            <?= $appointment->appointment_type_id == 4 ? 'Attendees' : 'Technician'; ?>            
        </label>
        <div class="d-flex align-items-center">
            <?php $assigned_technician = json_decode($appointment->assigned_employee_ids); ?>
            <?php foreach($assigned_technician as $aid){ ?>
                <div class="nsm-profile me-3" style="background-image: url('<?= userProfileImage($aid); ?>'); width: 40px;"></div>
            <?php } ?>            
        </div>
        <?php if( $appointment->appointment_type_id == 4 ) { ?>        
            <small class="small-label"><i class='bx bxs-calendar-event'></i> <?= $appointment->priority; ?></small>
        <?php } ?>
    </div>
    <hr />
    <!-- <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Tags</label>
        <div class="d-flex">
            <?php foreach ($a_tags as $tag) { ?>
                <?php
                if ($tag['icon'] != '') {
                    if ($tag['is_marker_icon_default_list'] == 1) {
                        $marker = base_url("uploads/icons/" . $tag['icon']);
                    } else {
                        $marker = base_url("uploads/event_tags/" . $tag['cid'] . "/" . $tag['icon']);
                    }
                } else {
                    $marker = base_url("uploads/event_tags/default_no_image.jpg");
                }
                ?>
                <div class="nsm-profile me-1" style="background-image: url('<?= $marker; ?>'); width: 60px;background-color: #ffffff !important;"></div>
            <?php } ?>
        </div>
    </div> -->
    <?php if( $appointment->appointment_type_id != 4 ){ ?>
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header" style="margin-top:5px;">Notes</label>
        <div class="d-flex">
            <span class="appointment-notes"><?= $appointment->notes; ?></span>
        </div>
    </div>
    <?php } ?>
    <?php if ($appointment->is_paid == 1) { ?>
        <div class="col-12">
            <label class="content-subtitle fw-bold d-block mb-2">Payment Status</label>
            <span class="nsm-badge success">Paid</span>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="col-12">
        <div class="nsm-empty">
            <span>Appointment not found.</span>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {
        <?php if ($appointment->is_paid == 1) { ?>
            $("#btn_checkout_appointment").hide();
            $("#btn_edit_appointment").hide();
            $("#btn_payment_details_appointment").show();
        <?php } else { ?>
            $("#btn_checkout_appointment").show();
            $("#btn_edit_appointment").show();
            $("#btn_payment_details_appointment").hide();
        <?php } ?>
    });
</script>