<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/api_connectors'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">QuickBooks Payroll</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">

                            </li>
                        </ol>
                    </div>


                    <?php
                        if(isset($qb_info)){
                            ?>
                            <div class="col-sm-12 text-center">
                                <hr>
                                <div class="weight-medium text-md margin-bottom-sec"><b>Quickbooks Connected!</b></div>
                                <span>Company Name :</span> <span class="margin-bottom" style="color:#6a4a86;"> <?= $qb_info->CompanyName; ?> </span>
                                <br>
                                <span>Company Address: </span> <span class="margin-bottom" style="color:#6a4a86;"> <?= $qb_info->CompanyAddr->Line1 . " " . $qb_info->CompanyAddr->City . " " . $qb_info->CompanyAddr->PostalCode;; ?> </span>
                                <br><br>
                                <a class="btn btn-success btn-md text-light" href="<?php if(isset($authurl)){echo $authurl;} ?>">
                                    <span class="fa fa-link text-light"></span> Disconnect To Quickbooks
                                </a>

                                <br><br>
                                <h3>Customers</h3>
                                <table class="table table-bordered qb-customers">
                                    <thead>
                                        <tr>
                                            <th>Contact Name</th>
                                            <th>Contact ID</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($qb_customers as $customers) { ?>
                                            <tr>
                                                <td><?= $customers->DisplayName ?></td>
                                                <td><?= $customers->Id ?></td>
                                                <td><?= $customers->Active ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>


                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="col-sm-12 text-center">
                                <hr>
                                <div class="weight-medium text-md margin-bottom-sec"><b>Export timesheet entries to Quickbooks</b></div>
                                <span>Connect to QuickBooks to link your employees and export timesheet entries.</span>
                                <br><br>
                                <a class="btn btn-success btn-md text-light" href="<?php if(isset($authurl)){echo $authurl;} ?>">
                                    <span class="fa fa-link text-light"></span> Connect To Quickbooks
                                </a>
                            </div>

                            <?php
                        }
                    ?>


                </div>
            </div>
            <!-- end row -->
            <div class="row">

            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>

<script>
    $('.qb-customers').DataTable({
        'searching' : false,
        "lengthChange": false
    });
</script>


