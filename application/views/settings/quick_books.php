<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.cell-inactive{
    background-color: #d9534f;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">QuickBooks</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">  
                        <?php include viewPath('flash'); ?>
                        <div class="row margin-bottom">
                            <div class="col-sm-12">
                                <div class="status-text">
                                    <b>QuickBooks Status</b><br>
                                    <span class="text-sec">You are connected</span>
                                </div>
                                <a class="btn btn-default status-btn" href="javascript:void(0);" style="position: relative;bottom: 46px;left: 149px;">Disconnect</a>
                            </div>
                        </div>

                        <b>QuickBooks Account</b><br>
                        <div id="quickbooks-info">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Export</th>
                                        <th>Import</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <a class="btn btn-info" href="#">Sync with QuickBooks</a>
                        </div>
                        <br>

                        <hr>

                        <div data-stats="container">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Resource</th>
                                        <th>Total</th>
                                        <th>Synced</th>
                                        <th>Failed</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <a class="btn btn-info" href="#">View Sync Log</a>
                        </div>

                        <div class="bold" style="margin-top: 100px;">Sync History</div>
                        <table class="table"></table>

                        <div class="modal" data-sync-modal="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">Sync with QuickBooks</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form data-sync-modal="form" name="modal-form">
                                            <div class="validation-error hide"></div>
                                            <p>
                                                Would you like to synchronize your customers, invoices, expenses and estimates with QuickBooks?<br><br>
                                                The synchronization process will run in background and you can monitor the progress and get a notification email on completion.
                                            </p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="button" data-sync-modal="submit" data-on-click-label="Sync Now...">Sync Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/settings_modal'); ?>
<?php include viewPath('includes/footer'); ?>