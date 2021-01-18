<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .left-sidebar-main .card {
        padding: 0px;
    }
    .left-sidebar-main .card .page-title {
        display: flex;
        align-items: center;    
    }
    .left-sidebar-main .card .page-title svg {
        margin-right: 0px !;
    }
    .form-group-icon {
        position: relative;
    }
    .form-group-icon i {
        position: absolute;
        left: 10px;
        top: 16px;
        color: #222222;
    }
    .form-group-icon input {
        padding: 15px 35px;
    }
    .btn-primary.text-link {
        padding: 6px 8px;
        background: none;
        color: #45a73c; 
    }
    .btn-primary.text-link:hover {
        background-color: #45a73c;
        color: #fff;
    }
    .table-custom table th,
    .table-custom table td {
        border: none;
    }
    .table-custom table {
        border: none;
    }
    .table-custom table td a i {
        color: #45a73c;
        padding-left: 0px;
    }
    .table-custom table td.d-flex {
        padding-top: 23px;
    }
    .table-custom table td a {
        padding-left: 11px;
    }
    .table-hover tbody tr:hover, .table-striped tbody tr:nth-of-type(odd), .thead-default th {
        background-color: #fff;
    }
    .upload input[type=file]:before {
        width: 100%;
        height: 60px;
        font-size: 16px;
        line-height: 32px;
        content: 'Upload Estimate';
        display: inline-block;
        background: #45a73c;
        padding: 5px 10px;
        text-align: center;
        color: #fff;
        border-radius: 0px;
    }
    .upload input[type=file] {
        cursor: pointer;
        width: 100%;
        height: 44px;
        overflow: hidden;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border left-sidebar-main">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;position: relative; top: 1.4px;"><path d="M9 11.75c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zm6 0c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-.29.02-.58.05-.86 2.36-1.05 4.23-2.98 5.21-5.37C11.07 8.33 14.05 10 17.42 10c.78 0 1.53-.09 2.25-.26.21.71.33 1.47.33 2.26 0 4.41-3.59 8-8 8z"></path></svg> &nbsp;Customer</h6>
                            <hr>
                            <div class="form-group form-group-icon">
                               <input type="text" name="search" id="search" class="form-control" placeholder="Name, email, phone, or address">
                               <i class="fa fa-search"></i>
                            </div>
                            <button type="button" class="btn btn-primary pull-right text-link">+ NEW CUSTOMER</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card table-custom">
                        <div class="card-body">
                            <h6 class="page-title">&nbsp;Add line items</h6>
                            <hr>
                            <table class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                 <thead>
                                    <tr>
                                       <th>Services</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td><svg class="MuiSvgIcon-root jss72" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><path d="M20 9H4v2h16V9zM4 15h16v-2H4v2z"></path></svg></td>
                                       <td>
                                          <input type="text" name="check_description[]" class="form-control checkDescription" placeholder="Item name">
                                       </td>
                                       <td><input type="text" name="check_description[]" class="form-control checkDescription" placeholder="Qty"></td>
                                       <td><input type="text" name="check_amount[]" class="form-control checkModelAmount" value="0" placeholder="Unit Price"></td>
                                       <td style="text-align: center" class="d-flex">$00<a href="#" class="remove-check-row"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                                    </tr>
                                    </tr>
                                        <tr>
                                        <td class="upload" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="upload" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="upload" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr>   
                                    
                                 </tbody>
                                 
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>