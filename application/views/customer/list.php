<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #draggable { width: 150px; height: 150px; padding: 0.5em; }
</style>
<style>
    .switch {
        position: relative !important;
        display: inline-block !important;
        width: 50px;
        height: 24px;
        float: right;
        margin-top: 6px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute !important;
        cursor: pointer !important;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute !important;
        content: "";
        height: 24px;
        width: 26px;
        left: 1px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background: linear-gradient(to bottom, #45a73c 0%, #67ce5e 100%) !important;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3 !important;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px) !important;
        -ms-transform: translateX(26px) !important;
        transform: translateX(26px) !important;
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px !important;
    }

    .slider.round:before {
        border-radius: 50% !important;
    }
    .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .required{
        color : red!important;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row align-items-center pt-3 bg-white">
                                <div class="col-md-12">
                                    <!-- Nav tabs -->
                                    <div class="banking-tab-container">
                                        <div class="rb-01">
                                            <ul class="nav nav-tabs border-0">
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab <?php if($cust_tab==0){echo "active";} ?>" data-toggle="tab" href="#basic">Customer Manager</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab <?php if($cust_tab==1){echo "active";} ?>" data-toggle="tab" href="#advance">Customer Module Layout</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-content mt-4" >
                                        <div class="tab-pane <?php if($cust_tab==0){echo "active";}else{echo "fade";} ?> standard-accordion" id="basic">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h3 class="page-title">Customers List</h3>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="float-right d-md-block">
                                                        <div class="dropdown">
                                                            <form action="<?php echo base_url('customer/importItems'); ?>" method="post" enctype="multipart/form-data">
                                                                <input type="file" name="file" />
                                                                <button type="submit" class="btn btn-primary btn-md" name="importSubmit" id="importItemsInventory" ><span class="fa fa-download"></span> Import</button>
                                                                <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-upload"></span> Export</button>
                                                                    <a class="btn btn-primary btn-md" href="<?php echo base_url('/builder?form_id=28') ?>">
                                                                        <span class="fa fa-pencil"></span> &nbsp; Customize Form
                                                                    </a>
                                                            <?php if (isset($customers) && count($customers) > 0) { ?>
                                                                <a class="btn btn-primary btn-md" href="<?php echo base_url('customer/print') ?>">
                                                                    <span class="fa fa-print "></span> Print
                                                                </a>
                                                            <?php } ?>
                                                            <?php //if (hasPermissions('WORKORDER_MASTER')): ?>
                                                                <!-- <a href="<?php echo url('customer/add') ?>" class="btn btn-primary" aria-expanded="false">
                                                    <i class="mdi mdi-settings mr-2"></i> New Customer
                                                </a>    -->     <a class="btn btn-primary btn-md"href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> Add Lead</a>
                                                                <a class="btn btn-primary btn-md"
                                                                href="<?php echo url('customer/add_advance') ?>"><span
                                                                            class="fa fa-plus"></span> New Customer</a>
                                                            <?php //endif ?>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <style>
                                                .btn{
                                                    font-size: 12px !important;
                                                }
                                            </style>



                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                                                        <table class="table table-hover" id="customerListTable">
                                                            <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>City</th>
                                                                <th>Street</th>
                                                                <th>Source</th>
                                                                <th>Email</th>
                                                                <th>Added</th>
                                                                <th>Sales Rep</th>
                                                                <th>Tech</th>
                                                                <th>System Type</th>
                                                                <th>MMR</th>
                                                                <th>Phone</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                            <?php if (isset($customers)) : ?>
                                                                <?php foreach ($customers as $customer) : ?>

                                                                    <tr>
                                                                        <td><?php echo $customer->contact_name; ?></td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td></td>
                                                                        <td><?php echo $customer->contact_email; ?></td>
                                                                        <td>&nbsp;</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><?php echo $customer->phone; ?></td>
                                                                        <td><?php echo $customer->status; ?></td>
                                                                        <td class="text-right">
                                                                            <div class="dropdown dropdown-btn open">
                                                                                <button class="btn btn-default dropdown-toggle" type="button"
                                                                                        id="dropdown-edit" data-toggle="dropdown"
                                                                                        aria-expanded="true">
                                                                                    <span class="btn-label">Manage</span><span
                                                                                            class="caret-holder"><span
                                                                                                class="caret"></span></span>
                                                                                </button>
                                                                                <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                                                    aria-labelledby="dropdown-edit">
                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                               href="#"><span
                                                                                                    class="fa fa-user icon"></span> View</a>
                                                                                    </li>
                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                               href="#"><span
                                                                                                    class="fa fa-pencil-square-o icon"></span>
                                                                                            Edit</a></li>
                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                               href="#"><span
                                                                                                    class="fa fa-pencil-square-o icon"></span>
                                                                                            Create Service Ticket</a></li>
                                                                                    <li role="separator" class="divider"></li>
                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                               href="#"><span
                                                                                                    class="fa fa-calendar icon"></span> Schedule
                                                                                            Appointment</a></li>
                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                               href="#"><span
                                                                                                    class="fa fa-money icon"></span> Create
                                                                                            Invoice</a></li>
                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                               href="#"><span
                                                                                                    class="fa fa-file-text-o icon"></span>
                                                                                            Create Estimate</a></li>
                                                                                    <li role="separator" class="divider"></li>
                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                               data-inactive-modal="open"
                                                                                                               data-customer-id="400604"
                                                                                                               data-customer-info="Agnes Knox, "
                                                                                                               href="#"><span
                                                                                                    class="fa fa-user-times icon"></span> Mark
                                                                                            as inactive</a></li>
                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                               data-delete-modal="open"
                                                                                                               data-customer-id=""
                                                                                                               onclick="return confirm('Do you really want to delete this item ?')"
                                                                                                               data-customer-info="Agnes Knox, "
                                                                                                               href="#"><span
                                                                                                    class="fa fa-trash-o icon"></span> Delete
                                                                                            customer</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            </tbody>

                                                        </table>

                                                </div>
                                            </div>


                                        </div>

                                        <div class="tab-pane <?php if($cust_tab==1){echo "active";}else{echo "fade";} ?> standard-accordion" id="advance">
                                            <div class="col-sm-12">
                                                <h3 class="page-title">Customer List View</h3>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="float-right d-md-block">
                                                    <div class="dropdown">
                                                        <a class="btn btn-primary btn-md" href="#"><span class="fa fa-print"></span> Print</a>
                                                        <a class="btn btn-primary btn-md" href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> New Lead</a>
                                                        <a class="btn btn-primary btn-md" href="<?php echo url('customer/add_advance') ?>"><span class="fa fa-plus"></span> New Customer</a>
                                                    </div>
                                                </div>
                                                <br/><br/><br/>
                                                <div class="col-sm-12">
                                                    <div class="banking-tab-container">
                                                        <div class="rb-01">
                                                            <ul class="nav nav-tabs border-0">
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#dashboard">Client Dashboard</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget1">Widget 1</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget2">Widget 2</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget3">Widget 3</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#profle">Profile</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#educate">Educate</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#messages">Messages</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#notes">Internal Notes</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#invoices">Invoices</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#activity">Activity</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#details">Detail Sheet</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#settings">Settings</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-content mt-4" >
                                                        <div class="tab-pane active standard-accordion" id="dashboard">

                                                            <div class="col-sm-12">
                                                                <div class="col-sm-12 text-right-sm" style="align:right;">
                                                                    <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                                    <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                                                        <label class="onoffswitch-label" for="onoff-customize">
                                                                            <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="indata sortable2" id="sorting">

                                                                <?php
                                                                    $modules = explode(",", $module_sort->ams_values);
                                                                    for($x=0;$x<count($modules);$x++){
                                                                        include viewPath('customer/adv_cust_modules/'.$modules[$x]);
                                                                    }
                                                                ?>
                                                                <!--<div class="contract module ui-state-default" id="contact">
                                                                    <h5>Contact Module</h5>
                                                                    <div class="col-sm-12">
                                                                    </div>
                                                                </div>

                                                                <div class="clients module ui-state-default" id="client">
                                                                    <h5>Client Module</h5>
                                                                    <div class="col-sm-12">
                                                                    </div>
                                                                </div>-->
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade standard-accordion" id="profle">
                                                            <div class="card">
                                                                <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                                    <div class="col-lg-12">
                                                                        <h6>Profile  <i>(John Doe)</i> </h6>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">First name </label><span class="required">*</span><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Last name</label><span class="required">*</span><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Email</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Last 4 of SSN</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Phone (H)</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Phone (M)</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Middle name </label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Suffix</label><span class="required">*</span><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for=""></label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">DOB</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Phone (W)</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Fax</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                    <div class="col-md-8">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Mailing address</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                    </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">City</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Zipcode</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">State</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Country</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="col-md-8">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <input type="checkbox" name="notify_by" value="Email" id="notify_by_email">
                                                                                        <label for="notify_by_email"><span>Previous mailing address (only if at current mailing address for less than 2 years)</span></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Status</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Assigned to</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Start Date</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Referred By</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-8">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <input type="checkbox" name="notify_by" value="Email" id="notify_by_email">
                                                                                        <label for="notify_by_email"><span>Portal Access</span></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="col-md-4">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Client's User ID (Email)</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group" id="customer_type_group">
                                                                                        <label for="">Language</label><br/>
                                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12"><br>
                                                                                <div class="form-group" id="customer_type_group">
                                                                                    <label for=""></label>
                                                                                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade standard-accordion" id="settings">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="alert alert-success" id="alert_box" style="display:none;">
                                                                        <strong>Success!</strong> Data has been added!
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                                    <div class="col-lg-12 table-responsive">
                                                                        <h6>Lead Types</h6>
                                                                        <button data-toggle="modal" data-target="#modal_lead_type" class="btn btn-sm btn-default pull-right"  style="margin-bottom: 10px;">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                        <table id="leadtype" class="table table-bordered table-striped">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Lead Type Name</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody id="leadtype_table_data">
                                                                            </tbody>
                                                                        </table>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                                    <div class="col-lg-12 table-responsive">
                                                                        <h6>Sales Area</h6>
                                                                        <button data-toggle="modal" data-target="#modal_sales_area" class="btn btn-sm btn-default pull-right sa" title="Add Sales Area" style="margin-bottom: 10px;">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                        <table id="salesarea" class="table table-bordered table-striped">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Id</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php foreach ($sales_area as $sa) { ?>
                                                                                <tr>
                                                                                    <td><?= $sa->sa_name; ?></td>
                                                                                    <td>
                                                                                        <a href=""class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!--<div id="draggable" class="ui-widget-content">
                                                                    <p>Drag me around</p>
                                                                </div>
                                                                <ul id="sortable">
                                                                    <li class="ui-state-default">1</li>
                                                                    <li class="ui-state-default">2</li>
                                                                    <li class="ui-state-default">3</li>
                                                                    <li class="ui-state-default">4</li>
                                                                    <li class="ui-state-default">5</li>
                                                                    <li class="ui-state-default">6</li>
                                                                    <li class="ui-state-default">7</li>
                                                                    <li class="ui-state-default">8</li>
                                                                    <li class="ui-state-default">9</li>
                                                                    <li class="ui-state-default">10</li>
                                                                    <li class="ui-state-default">11</li>
                                                                    <li class="ui-state-default">12</li>
                                                                </ul>-->
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                                    <div class="col-lg-12 table-responsive">
                                                                        <h6>Lead Source</h6>
                                                                        <button id="add_ls" class="btn btn-sm btn-default pull-right sa" title="Add Sales Area" style="margin-bottom: 10px;">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                        <table id="leadsource" class="table table-bordered table-striped">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Lead Source</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody id="tb_leadsource">

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="page-title">Quick Action</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover" id="customer_list_quick">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php if (isset($customers)) : ?>
                                    <?php foreach ($customers as $customer) : ?>

                                        <tr>
                                            <td><?php echo $customer->contact_name; ?></td>
                                            <td>
                                                <a href="#" style="text-decoration:none; display:inline-block;" class="js-qwynlraxz">
                                                    <img src="https://app.creditrepaircloud.com/application/images/email-icon.png" border="0" title="Internal Note">
                                                </a>
                                                <a href="#" style="text-decoration:none; display:inline-block;" class="js-qwynlraxz">
                                                    <img src="https://app.creditrepaircloud.com/application/images/comment_edit.png" border="0" title="Internal Note">
                                                </a>
                                                <a href="#"  style="text-decoration:none; display:inline-block;">
                                                    <img src="https://app.creditrepaircloud.com/application/images/assign-contact.png" border="0" title="Team member assigned">
                                                </a>
                                                <a href="#" style="text-decoration:none;display:inline-block;" class="js-qwynlraxz">
                                                    <img src="https://app.creditrepaircloud.com/application/images/pencil.png" width="16px" height="16px" border="0" title="Edit Client">
                                                </a>
                                                <a href="#"  style="text-decoration:none;display:inline-block;" title="Delete client" class="js-qwynlraxz">
                                                    <img src="https://app.creditrepaircloud.com/application/images/cross.png" width="16px" height="16px" border="0">
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>

                            </table>
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

<!-- Lead Type Modal -->
<div class="modal fade" id="modal_lead_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Lead Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="leadTypeForm">
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="form-group" id="customer_type_group">
                        <label for="">Lead Type Name</label><br/>
                        <input type="text" class="form-control" name="lead_name" id="lead_name" required/>
                        <input type="hidden" class="form-control" name="lead_id" id="lead_id" required/>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Sales Area Modal -->
<div class="modal fade" id="modal_sales_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sales_area_header">Add Sales Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="salesAreaForm">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group" id="customer_type_group">
                            <label for="">Sales Area Name</label><br/>
                            <input type="text" class="form-control" name="sa_name" id="sa_name" required/>
                            <input type="hidden" class="form-control" name="sa_id" id="sa_id" required/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Lead Source Modal -->
<div class="modal fade" id="modal_lead_source" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lead_source_header">Add Lead Source</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="leadSourceForm">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group" id="customer_type_group">
                            <label for="">Lead Source</label><br/>
                            <input type="text" class="form-control" name="ls_name" id="ls_name" required/>
                            <input type="hidden" class="form-control" name="ls_id" id="ls_id" required/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/adv_cust/js_list'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 450px; }
    #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 100px; height: 90px; font-size: 4em; text-align: center; }

    .alarm_label, .alarm_answer{
        font-size: 12px !important;
    }
</style>

<script>
    $(document).ready(function() {
        //$(".module").draggable({axis:"y"});
        ///$( ".sortable2" ).sortable("disable");
        $('#onoff-customize').change(function() {
            if(this.checked) {
                $( ".sortable2" ).sortable( "enable" );
            }else{
                $( ".sortable2" ).sortable( "disable" );
            }

        });

        $( ".sortable2" ).sortable({
            start: function(e, ui) {
                // creates a temporary attribute on the element with the old index
                $(this).attr('data-previndex', ui.item.index());
            },
            update: function(e, ui) {
                // gets the new and old index then removes the temporary attribute
                var newIndex = ui.item.index();
                var oldIndex = $(this).attr('data-previndex');
                var element_id = ui.item.attr('id');
                console.log('id of Item moved = '+element_id+' old position = '+oldIndex+' new position = '+newIndex);
                $(this).removeAttr('data-previndex');
                console.log("Module Changed!");

                var idsInOrder = $(".sortable2").sortable("toArray");
                console.log(idsInOrder);

                var new_module_sort = "";
                for(var x=0;x<idsInOrder.length;x++){
                    if(x===0){
                        new_module_sort = new_module_sort + idsInOrder[x];
                    }else{
                        new_module_sort = new_module_sort +","+idsInOrder[x];
                    }
                    console.log(idsInOrder[x]);
                }
                //console.log(new_module_sort);
                $.ajax({
                    type: "POST",
                    url: "/customer/ac_module_sort",
                    data: {ams_values : new_module_sort,ams_id : <?php echo $module_sort->ams_id; ?>}, // serializes the form's elements.
                    success: function(data)
                    {
                        console.log(data);
                    }
                });
            }
        });

        $( ".sortable2" ).sortable( "disable" );


        //-----------------^^^^

    });

</script>
