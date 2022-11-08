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
        <label class="content-subtitle fw-bold d-block mb-2" style="font-size:20px;"><?= $appointment->appointment_number; ?></label>
    </div>
    <div class="col-12 col-md-8">
        <label class="content-subtitle fw-bold d-block mb-2">Customer</label>
        <label class="content-subtitle fw-bold" style="font-size: 16px;margin-bottom: 12px;"><?= $appointment->customer_name; ?></label>
        <label class="content-subtitle d-block" style="margin-bottom:5px;"><span class="fw-bold"><i class="bx bxs-map-pin"></i> Phone:</span> <?= $c_phone; ?></label>
        <label class="content-subtitle d-block"><span class="fw-bold"><i class="bx bxs-phone"></i> Address:</span> <?= $appointment->mail_add . ' ' . $appointment->cust_city . ' ' . $appointment->cust_state . ' '. $appointment->cust_zip_code; ?></label>
        <br />
        <label class="content-subtitle d-block" style="margin-bottom: 5px;"><span class="fw-bold"><i class='bx bxs-calendar'></i> Schedule:</span> <?= date("l, F d, Y", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time)); ?> - <?= date("g:i A", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time)); ?></label>
        <label class="content-subtitle d-block"><span class="fw-bold"><i class='bx bx-list-ul'></i> Appointment Type:</span> <?= $appointment->appointment_type; ?></label>
    </div>
    <div class="col-12 col-md-4">
        <label class="content-subtitle fw-bold d-block mb-2">Employee</label>
        <div class="d-flex align-items-center">
            <div class="nsm-profile me-3" style="background-image: url('<?= userProfileImage($appointment->user_id); ?>'); width: 40px;"></div>
            <label class="content-subtitle fw-bold"><?= $appointment->employee_name; ?></label>
        </div>
    </div>
    <hr />
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
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
                <div class="nsm-profile me-1" style="background-image: url('<?= $marker; ?>'); width: 40px;"></div>
            <?php } ?>
        </div>
    </div>
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