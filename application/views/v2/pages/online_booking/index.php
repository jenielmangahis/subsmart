<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Online booking system is a software solution that allows potential guests to self-book and pay through your website, and other channels, while giving you the best tools to run and scale your operation, all in one place.
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-3">
                        <div class="nsm-counter h-100" role="button" onclick="location.href='<?php echo base_url('/more/addon/booking/products'); ?>'">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-check-circle"></i>
                                </div>
                                <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Total Categories</span>
                                    <h2><?= sprintf("%02d", $total_category); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="nsm-counter success h-100" role="button" onclick="location.href='<?php echo base_url('/more/addon/booking/products'); ?>'">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-check-circle"></i>
                                </div>
                                <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Total Products</span>
                                    <h2><?= sprintf("%02d", $total_products); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="nsm-counter primary h-100" role="button" onclick="location.href='<?php echo base_url('/more/addon/booking/time'); ?>'">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-check-circle"></i>
                                </div>
                                <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Total Time Slots</span>
                                    <h2><?= sprintf("%02d", $total_timeslots); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="nsm-counter secondary h-100" role="button" onclick="location.href='<?php echo base_url('/more/addon/inquiries'); ?>'">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-check-circle"></i>
                                </div>
                                <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Total New Inquiry</span>
                                    <h2><?= sprintf("%02d", $total_new_inquiry); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 g-3">
                    <div class="col-12">
                        <label class="content-title">Place a booking form on your website and collect leads from your customers directly into nSmarTrac.</label>
                    </div>
                    <div class="col-12">
                        <label class="d-block">1. Set your items on services</label>
                        <label class="d-block">2. Define your time slots</label>
                        <label class="d-block">3. Customize the way the form looks and get notifications on new contact inquiries or check the leads online.</label>
                        <label class="d-block">4. Copy/Paste the iframe or javascript code on a page on your website.</label>
                    </div>
                    <div class="col-12 mt-4">
                        <a role="button" class="nsm-button primary ms-0" href="<?php echo base_url('more/addon/booking/products') ?>">Edit Booking</a>
                        <a role="button" class="nsm-button" href="<?php echo base_url('/booking/products/' . $eid); ?>" target="_blank">View Booking Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>