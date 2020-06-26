<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <?php include viewPath('includes/sidebars/job_settings'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                        <?php if (empty($job_data)) : ?>
                            <?php echo form_open('job/saveJob', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                        <?php else :?>
                            <?php echo form_open('job/updateJob', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                        <?php endif;?>
                            <h2 class="page-title text-left">Sales Prefixes</h2>
                            <div class="row col-md-12 pb-3">
                                <label class="pt-2 pr-4">Estimate Prefix</label>
                                <input type="text" class="form-control col-md-2" id="estimatePrefix" value="EST-">
                            </div>
                            <div class="row col-md-12 pb-3">
                                <label class="pt-2 pr-3">Work Order Prefix</label>
                                <input type="text" class="form-control col-md-2" id="estimatePrefix" value="WO-">
                            </div>
                            <div class="row col-md-12 pb-3">
                                <label class="pt-2 pr-5">Invoice Prefix</label>
                                <input type="text" class="form-control col-md-2" id="estimatePrefix" value="WO-">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="<?php echo $url->assets ?>frontend/js/job_creation/main.js"></script>