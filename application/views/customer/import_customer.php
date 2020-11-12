<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <form action="<?php echo base_url('customer/import_customer_data'); ?>" method="post" enctype="multipart/form-data" style="text-align: center;">
                            <h6 >Import Customer</h6>
                            <label for="file-upload" class="">
                                 Choose file to Import ( .csv , .xlsx)
                            </label>
                            <br>
                            <input id="file-upload" name="file" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                            <br><br>
                            <div class="">
                                <a href="<?= url('customer/') ?>">
                                    <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-remove"></span> Cancel</button>
                                </a>
                                <button type="submit" name="importSubmit" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-download"></span> Import</button>
                            </div>
                        </form>
                    </div>
                    <div class="cards">
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-md-12">

                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- end container-fluid -->

<?php include viewPath('includes/footer'); ?>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>
