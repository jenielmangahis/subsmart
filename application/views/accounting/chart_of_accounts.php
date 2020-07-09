<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Chart of Accounts</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Chart of Accounts</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('users_add')): ?>
                                    <!-- <a href="<?php //echo url('users/add') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> New Employee
                                    </a> -->
                                <?php //endif ?>
                                <a href="<?php echo url('/accounting/chart_of_accounts/create') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        Run Report
                                </a>
                                <a href="<?php echo url('/accounting/chart_of_accounts/create') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        Add New
                                        <a href="" class="btn btn-primary"><i class="fa fa-chevron-down"></i></a>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
             <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-11 form-group"></div>
                                 <div class="col-md-1 form-group">
                                     <a href="" ><i class="fa fa-edit"></i></a>
                                     <a href="" ><i class="fa fa-print"></i></a>
                                     <a href="" ><i class="fa fa-cog"></i></a>
                                 </div>
                             </div>
                            <table id="charts_of_account_table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>NAME</th>
                                    <th>TYPE</th>
                                    <th>DETAIL TYPE</th>
                                    <th>NSMARTRAC BALANCE</th>
                                    <th>BANK BALANCE</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>Cash on hand</td>
                                    <td>Bank</td>
                                    <td>Cash on hand</td>
                                    <td>111,111.00</td>
                                    <td></td>
                                    <td><a href="">View Register</a> <a href=""><i class="fa fa-chevron-down"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/chart_of_accounts'); ?>
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    $(document).ready(function() {
        $('#charts_of_account_table').DataTable();
    } );
</script>