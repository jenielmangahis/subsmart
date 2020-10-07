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
                <div class="col-xl-12">
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
                                                <div class="col-sm-6">
                                                    <h3 class="page-title">Customers List</h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="float-right d-md-block">
                                                        <div class="dropdown">
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

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row margin-bottom-ter align-items-center col-sm-12">
                                                <div class="col-auto">
                                                    <p>
                                                        Listing all customers.
                                                    </p>
                                                </div>
                                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                                    <form style="display: inline-flex;" class="form-inline form-search"
                                                          name="form-search"
                                                          action="<?php echo base_url('customer') ?>"
                                                          method="get">
                                                        <div class="form-group" style="margin:0 !important;">
                                                            <span>Search:</span> &nbsp;
                                                            <input style="height:auto !important; font-size: 14px; margin-right:10px;"
                                                                   class="form-control form-control-md"
                                                                   name="search"
                                                                   value="<?php echo (!empty($search)) ? $search : '' ?>"
                                                                   type="text"
                                                                   placeholder="Search...">
                                                            <button class="btn btn-default btn-md" type="submit"><span
                                                                        class="fa fa-search"></span></button>
                                                            <?php if (!empty($search)) { ?>
                                                                <a class="btn btn-default btn-md ml-2"
                                                                   href="<?php echo base_url('customer') ?>"><span
                                                                            class="fa fa-times"></span></a>
                                                            <?php } ?>
                                                        </div>
                                                    </form>

                                                    <span class="margin-left-sec">Filter by:</span> &nbsp;
                                                    <div class="dropdown dropdown-inline margin-right-sec"><a
                                                                class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                                                aria-expanded="true" href="<?php echo base_url('customer') ?>">Type
                                                            <span class="caret"></span></a>
                                                        <ul class="dropdown-menu  btn-block" role="menu">
                                                            <li class="active" role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                      href="<?php echo base_url('customer') ?>">Type</a>
                                                            </li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('customer?type=residential') ?>">Residential</a>
                                                            </li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('customer?type=commercial') ?>">Commercial</a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1"
                                                                   href="<?php echo base_url('customer?type=advance') ?>">Advance</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="dropdown dropdown-inline"><a class="btn btn-default dropdown-toggle"
                                                                                             data-toggle="dropdown" aria-expanded="true"
                                                                                             href="#">Group <span class="caret"></span></a>
                                                        <ul class="dropdown-menu  btn-block" role="menu">
                                                            <li class="active" role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                      href="">Group</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="">Panel</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <span class="margin-left-sec">Sort:</span> &nbsp;
                                                    <div class="dropdown dropdown-inline"><a class="btn btn-default dropdown-toggle"
                                                                                             data-toggle="dropdown"
                                                                                             aria-expanded="false"
                                                                                             href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=name-asc') : base_url('customer?order=name-asc') ?>">
                                                            Name: A to Z
                                                            <span class="caret"></span></a>
                                                        <ul class="dropdown-menu  btn-block" role="menu">
                                                            <li class="active" role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=name-asc') : base_url('?order=name-asc') ?>">
                                                                    Name: A to Z</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=name-desc') : base_url('customer?order=name-desc') ?>">Name:
                                                                    Z to
                                                                    A</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=last-name-asc') : base_url('customer?order=last-name-asc') ?>">Last
                                                                    Name:
                                                                    A to Z</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=last-name-desc') : base_url('customer?order=last-name-desc') ?>">Last
                                                                    Name:
                                                                    Z to A</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=email-asc') : base_url('customer?order=email-asc') ?>">Email:
                                                                    A to
                                                                    Z</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=email-desc') : base_url('customer?order=email-asc') ?>">Email:
                                                                    Z to
                                                                    A</a></li>
                                                        </ul>
                                                    </div>
                                                    <a class="btn btn-default btn-md margin-left-sec" href="" target="_blank"><span
                                                                class="fa fa-download"></span> &nbsp; Export</a>
                                                </div>
                                            </div>
                                            <div class="tabs">
                                                <ul class="clearfix work__order" id="myTab" role="tablist">
                                                    <li <?php echo ((!empty($tab_index)) && $tab_index === 1) ? "class='active'" : "" ?>>
                                                        <a class="nav-link"
                                                           id="profile-tab"
                                                           data-toggle="tab1"
                                                           href="<?php echo base_url('customer') ?>"
                                                           role="tab"
                                                           aria-controls="profile" aria-selected="false">Active
                                                            (<?php echo get_customer_count() ?>)</a>
                                                    </li>
                                                    <li <?php echo ((!empty($tab_index)) && $tab_index === 2) ? "class='active'" : "" ?>>
                                                        <a class="nav-link"
                                                           id="profile-tab"
                                                           data-toggle="tab1"
                                                           href="<?php echo base_url('customer/tab/2') ?>"
                                                           role="tab"
                                                           aria-controls="profile" aria-selected="false">Inactive
                                                            (<?php echo (!empty($statusCount[1])) ? $statusCount[1] : 0 ?>)</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                                                    <?php if (!empty($customers)) { ?>
                                                        <table class="table table-hover" id="customerListTable">
                                                            <thead>
                                                            <tr>
                                                                <th>
                                                                    <div class="table-name">
                                                                        <div class="checkbox checkbox-sm select-all-checkbox">
                                                                            <input type="checkbox" name="id_selector" value="0"
                                                                                   id="select-all"
                                                                                   class="select-all">
                                                                            <label for="select-all">Name</label>
                                                                        </div>

                                                                    </div>
                                                                </th>

                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                            <?php foreach ($customers as $customer) : ?>
                                                                <?php if($customer[1] != "header") : ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="table-name">
                                                                            <div class="checkbox checkbox-sm">
                                                                                <input type="checkbox"
                                                                                       name="id[<?php echo $customer[0] ?>]"
                                                                                       value="<?php echo $customer[0] ?>"
                                                                                       class="select-one"
                                                                                       id="customer_id_<?php echo $customer[0] ?>">
                                                                                <label for="customer_id_<?php echo $customer[0] ?>"> <a
                                                                                            class="a-default"
                                                                                            href="<?php echo base_url('customer/genview/' . $customer[0]) ?>"><?php echo $customer[1] ?></a></label>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="table-nowrap">
                                                                            <?php echo $customer[2]; ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="table-nowrap">
                                                                            <?php if (is_serialized($customer[3])) { ?>
                                                                                <?php echo unserialize($customer[3])['number'] ?>
                                                                                (<?php echo unserialize($customer[3])['type'] ?>)
                                                                            <?php } else { ?>
                                                                                <?php echo $customer[3]; ?>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </td>
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
                                                                                                           href="<?php echo base_url('customer/view/' . $customer[0]) ?>"><span
                                                                                                class="fa fa-user icon"></span> View</a>
                                                                                </li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('customer/edit/' . $customer[0]) ?>"><span
                                                                                                class="fa fa-pencil-square-o icon"></span>
                                                                                        Edit</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('customer/tickets/add?customer_id=' . $customer[0]) ?>"><span
                                                                                                class="fa fa-pencil-square-o icon"></span>
                                                                                        Create Service Ticket</a></li>
                                                                                <li role="separator" class="divider"></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('workcalender/?customer_id=' . $customer[0] . '&action=open_event_modal') ?>"><span
                                                                                                class="fa fa-calendar icon"></span> Schedule
                                                                                        Appointment</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('invoice') ?>"><span
                                                                                                class="fa fa-money icon"></span> Create
                                                                                        Invoice</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('estimate/add?customer_id=' . $customer[0]) ?>"><span
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
                                                                                                           data-customer-id="<?php echo $customer[0] ?>"
                                                                                                           onclick="return confirm('Do you really want to delete this item ?')"
                                                                                                           data-customer-info="Agnes Knox, "
                                                                                                           href="<?php echo base_url('customer/delete/' . $customer[0]) ?>"><span
                                                                                                class="fa fa-trash-o icon"></span> Delete
                                                                                        customer</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php else : ?>
                                                                    <tr style="background-color:#D3D3D3;">
                                                                        <td><span class="pl-5"><?php echo $customer[0]; ?></span></td>
                                                                        <td colspan="2">&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>

                                                            </tbody>

                                                        </table>
                                                    <?php } else { ?>
                                                        <p class="text-center">No customers found.</p>
                                                    <?php } ?>
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
                                                        <a class="btn btn-primary btn-md"href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> New Lead</a>
                                                        <a class="btn btn-primary btn-md"href="<?php echo url('customer/add_advance') ?>"><span class="fa fa-plus"></span> New Customer</a>
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
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#settings">Settings</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-content mt-4" >
                                                        <div class="tab-pane active standard-accordion" id="dashboard">


                                                            <!--<div class="col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                                        <div class="col-lg-12 table-responsive">
                                                                            <h6>Client Lists</h6>
                                                                            <table id="leadtypes" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Client Name</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="">

                                                                                <tr>
                                                                                    <td>Test Client</td>
                                                                                    <td>
                                                                                        <a href="" class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>-->
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

                                                                <div class="profile module ui-state-default client" id="prof_mod">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-6">
                                                                            <table class="widget_client" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td width="50%" align="left" valign="top">
                                                                                        <div class="contacttext">
                                                                                            <h3 style="font-size: 15px; margin-bottom: 10px;">Kyle Test</h3>
                                                                                        </div>

                                                                                        <div class="contacttext">
                                                                                            <div>
                                                                                                (850) 324-8636
                                                                                                <a id="email-confirm" href="#" style="display:block;margin-top: 5px;" title="kylenguyenmailbox@gmail.com" class="js-qwynlraxz">kylenguyenmailbox@gmail.com</a>
                                                                                                <input type="hidden" name="email-confirm-hidden" id="email-confirm-hidden" value="kylenguyenmailbox@gmail.com">

                                                                                            </div>
                                                                                            <div style="margin-top:7px;"><span>---</span>
                                                                                            </div>
                                                                                            <div style="margin-top:7px;">
                                                                                                Status:
                                                                                                <span class="active">Client</span>

                                                                                                <img src="https://app.creditrepaircloud.com/application/images/cancel_icon.png" id="status_cancel"  title="cancel" style="display:none;cursor:pointer; vertical-align:middle;" border="0" width="16" height="16">
                                                                                                <img src="https://app.creditrepaircloud.com/application/images/ajax-loader.gif" id="status_loading" style="display:none; vertical-align:middle;" border="0" width="16" height="16">
                                                                                                <br>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div style="margin-right:15px; margin-top:6px;" align="left" class="normaltext1">
                                                                                            <a href="https://app.creditrepaircloud.com/userdesk/profile/NTk=" class="js-qwynlraxz">
                                                                                                View/Edit Profile
                                                                                            </a>&nbsp;&nbsp;
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="50%" valign="middle">
                                                                                        <div class="contactrighttab" style="margin-top:1px;">
                                                                                            <div class="widget_tab">

                                                                                                <div class="contactrightimg">
                                                                                                    <img src="https://app.creditrepaircloud.com/application/images/dashboard-new.png" alt="1-click-import" width="25" height="35" style="padding-left: 2px;margin-top: -4px;">
                                                                                                </div>
                                                                                                <div class="contactrighttxt">
                                                                                                    <a href="https://app.creditrepaircloud.com/importcreditreport/simple_audit/NTk=?from=quick_import" class="js-qwynlraxz">
                                                                                                        1-Click Import and Audit</a><br>
                                                                                                    Pull reports &amp; create audit
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="contactrighttab" >

                                                                                            <div class="widget_tab">
                                                                                                <div class="contactrightimg">
                                                                                                    <img src="https://app.creditrepaircloud.com/application/images/dashboard1.png" alt="wzardimg">
                                                                                                </div>
                                                                                                <div class="contactrighttxt" >
                                                                                                    <a href="https://app.creditrepaircloud.com/wizard/index/NTk=" class="js-qwynlraxz">
                                                                                                        Run Dispute Wizard</a>
                                                                                                    <br>
                                                                                                    Create letters/correct errors
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="contactrighttab" style="position:relative">
                                                                                            <div class="widget_tab">
                                                                                                <div class="contactrightimg">
                                                                                                    <img src="https://app.creditrepaircloud.com/application/images/dashboard2.png" alt="securemailimg" style="height:33px;">
                                                                                                </div>
                                                                                                <div class="contactrighttxt">
                                                                                                    <a href="#" class="js-qwynlraxz">Send Secure Message</a><br>
                                                                                                    Via Client Portal
                                                                                                </div>
                                                                                            </div>
                                                                                            <div id="portal_tip" class="tooltipbox" style="top: 3em; margin-left: -10px ; width: 225px; line-height: 18px; display: none;">
                                                                                                <p class="normaltext1" style="margin:0px; font-weight:normal;">
                                                                                                    This client doesn't have portal access, so you can't send a message.
                                                                                                </p>
                                                                                                <div id="tail1-bottom"></div>
                                                                                                <div id="tail2-bottom"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="">

                                                                                            <div class="col-sm-12">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-sm-12">
                                                                                                        <div class="checkbox checkbox-sec">
                                                                                                            <input type="checkbox" name="notify_by" value="Email" checked
                                                                                                                   id="notify_by_email">
                                                                                                            <label for="notify_by_email"><span>Notify by SMS</span></label><br>

                                                                                                            <input type="checkbox" name="notify_by" value="Email" checked
                                                                                                                   id="notify_by_email">
                                                                                                            <label for="notify_by_email"><span> Notify by Email</span></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        </div>
                                                                    </div>

                                                                <div class="score module ui-state-default" id="score">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="storescontent" id="storescontent">

                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tbody><tr>
                                                                                        <td width="15%">&nbsp;</td>
                                                                                        <!--code for the dynamic bureaus-->
                                                                                        <td width="21%" align="center" valign="middle"><img alt="" src="https://app.creditrepaircloud.com/application/images/equifax.png" class="" style="height:16px;width: 63px;vertical-align:middle;"></td>
                                                                                        <td width="21%" align="center" valign="middle"><img alt="" src="https://app.creditrepaircloud.com/application/images/experian.png" class="" style="height:16px;width: 63px;vertical-align:middle;"></td>
                                                                                        <td width="21%" align="center" valign="middle"><img alt="" src="https://app.creditrepaircloud.com/application/images/trans_union.png" class="" style="height:16px;width: 63px;vertical-align:middle;"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="5" align="left" valign="top"></td>
                                                                                        <td height="5" align="center" valign="top"></td>
                                                                                        <td height="5" align="center" valign="top"></td>
                                                                                        <td height="5" align="center" valign="top"></td>
                                                                                    </tr>

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="chartzoom" align="right">
                                                                                <a href="#" id="zoombar" style="text-decoration:none;" title="Click here to zoom this chart" class="js-qwynlraxz">
                                                                                    <img src="https://app.creditrepaircloud.com/application/images/zoom_in.png">&nbsp;
                                                                                </a>
                                                                            </div>
                                                                            <div class="chart" id="chart_column" style="height:139px; width:124px;">
                                                                                <img src="https://app.creditrepaircloud.com/application/images/nodata-bar-chart.png" style="vertical-align:middle; padding-top: 1px; padding-left: 1px;">
                                                                            </div>
                                                                            <button id="button" style="display:none">View the growth</button>
                                                                            <!--Start Date: 03/09/2020-->
                                                                            <div style="margin-right:15px; padding-top:0;padding-bottom:25px !important;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">Start Date</a>&nbsp;&nbsp;
                                                                            </div>

                                                                            <div style="margin-left:75px; padding-top:0;padding-bottom:25px !important;" class="widget_tab">
                                                                                <a href="#" class="js-qwynlraxz">
                                                                                <div class="contactrightimg">
                                                                                    <img src="https://app.creditrepaircloud.com/application/images/dashboard-new.png" alt="1-click-import" width="25" height="35" style="padding-left: 2px;margin-top: -4px;">
                                                                                </div>
                                                                                <div class="contactrighttxt">Pull Credit</div>
                                                                                </a>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="tech module ui-state-default" id="tech">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Arrival Time :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Guardian</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Time Given :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1/11/1111</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span>Time Assign :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField1 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField2 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                                                                                    <label>Install Date: <b>Guardian</b></label>-->
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="left" valign="top">
                                                                                                <label class="alarm_label"> <span >Complete Time :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Recuring</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="left" valign="top">
                                                                                                <label class="alarm_label"> <span >Date Given :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="left" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField3 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="left" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField4 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="left" valign="top">
                                                                                                <label class="alarm_label"> <span >Link :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="access module ui-state-default" id="access">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Portal Status :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Guardian</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Login :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1/11/1111</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span>CustomFld1 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Cancel Date :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Cancel Reason :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                                                                                    <label>Install Date: <b>Guardian</b></label>-->
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomFld2 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Recuring</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Collection Date :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Collection Amt :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >SSN :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >DOB :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="admin module ui-state-default" id="admin">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Entered by :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Guardian</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Time Entered :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1/11/1111</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span>Assign To :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Pre Survey :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomFld1 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                                                                                    <label>Install Date: <b>Guardian</b></label>-->
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Language :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Recuring</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Date Enter :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Sales Rep :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Post Survey:</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField2 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Last Login :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> Sept 8th, 2020</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="office module ui-state-default" id="office">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Welcome Kit :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>On</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CSO :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>On</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span>Rep Comm. :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 100</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Rep Pay :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> 100</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Tech Comm. :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 110</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Tech Pay :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 110</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!--<tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >RepHold :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="left" valign="top">
                                                                                                <label class="alarm_answer"><b> 110</b> </label>
                                                                                            </td>
                                                                                        </tr>-->
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                                                                                    <label>Install Date: <b>Guardian</b></label>-->
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Rep Payroll :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>On</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >PSO :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>On</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span>Points :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 100</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Price Point :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> 100</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Purchase $ :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 110</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Purchase X's :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 110</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin-right:15px; padding-bottom:10px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="owner module ui-state-default" id="owner">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >SSN :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Guardian</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Firstname :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1/11/1111</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span>Lastname :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Address :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >City/State/Zip :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Pay History :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                                                                                    <label>Install Date: <b>Guardian</b></label>-->
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <div class="col-auto form-group"><br>
                                                                                        <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                                                                            <input type="checkbox" name="notify_by" value="Email" checked
                                                                                                   id="notify_by_email">
                                                                                            <label for="notify_by_email"><span>Sign Guarantee</span></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">Best Contact</a>&nbsp;&nbsp;
                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

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

                                                                <div class="documents module ui-state-default" id="docu">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td width="100%" align="left" valign="top" class="issued"> <!--Paperwork Issued / Signed--> Issued/Received</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" valign="top" style="padding-right:10px;">
                                                                                        <div  id="paper_place_load">
                                                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td width="" align="center" valign="top">
                                                                                                        <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->
                                                                                                        <input type="checkbox" class="cb" name="chk_paperwork[]" id="chk_paperwork_1" value="1" checked="">
                                                                                                        <!-- updated on 10-11-2016 end -->
                                                                                                    </td>
                                                                                                    <td align="left" valign="top">
                                                                                                        <iframe id="frame1" style="display:none"></iframe>
                                                                                                        <form name="uploadDoc" id="uploadDoc_1" method="post" enctype="multipart/form-data" action="" style="width:100%;">
                                                                                                            <div style="float:left; width:75%;">
                                                                                                                <input type="hidden" name="paperwork_id" value="1">
                                                                                                                <input type="hidden" name="paperworktxt" value="Client Agreement">
                                                                                                                <label title="Client Agreement" for="chk_paperwork_1">Client Agreement</label>&nbsp;<br>

                                                                                                                <input type="file" name="upload_document" id="upload_document_1" style="visibility:hidden; width:2px; height:1px;">
                                                                                                            </div>
                                                                                                            <div style="float:right;  width:70px;">
                                                                                                                <a href="javascript:void(0);" style="text-decoration:none;display:inline-block;"  title="Choose File" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;">
                                                                                                                </a>
                                                                                                                <a href="" style="text-decoration:none;display:inline-block;" title="Download Document" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/download-icon.png">
                                                                                                                </a>
                                                                                                                <a href="" style="text-decoration:none;display:inline-block;" title="Delete Document" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/cross.png">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="" align="center" valign="top">
                                                                                                        <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->
                                                                                                        <input type="checkbox" class="cb" name="chk_paperwork[]" id="chk_paperwork_4" value="4">
                                                                                                        <!-- updated on 10-11-2016 end -->
                                                                                                    </td>
                                                                                                    <td align="left" valign="top">
                                                                                                        <iframe id="frame1" style="display:none"></iframe>
                                                                                                        <form name="uploadDoc" id="uploadDoc_4" method="post" enctype="multipart/form-data" action="" style="width:100%;">
                                                                                                            <div style="float:left; width:75%;">
                                                                                                                <input type="hidden" name="paperwork_id" value="4">
                                                                                                                <input type="hidden" name="paperworktxt" value="Photo ID Copy">
                                                                                                                <label title="Photo ID Copy" for="chk_paperwork_4">Photo ID Copy</label>&nbsp;<br>

                                                                                                                <input type="file" name="upload_document" id="upload_document_4" style="visibility:hidden; width:2px; height:1px;">
                                                                                                            </div>
                                                                                                            <div style="float:right;  width:70px;">
                                                                                                                <a href="javascript:void(0);" style="text-decoration:none;display:inline-block;"  title="Choose File" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;">
                                                                                                                </a>
                                                                                                                <a href="" style="text-decoration:none;display:inline-block;" title="Download Document" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/download-icon.png">
                                                                                                                </a>
                                                                                                                <a href="" style="text-decoration:none;display:inline-block;" title="Delete Document" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/cross.png">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="25" align="center" valign="top">
                                                                                                        <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->
                                                                                                        <input type="checkbox" class="cb" name="chk_paperwork[]" id="chk_paperwork_6" value="6">
                                                                                                        <!-- updated on 10-11-2016 end -->
                                                                                                    </td>
                                                                                                    <td align="left" valign="top">
                                                                                                        <iframe id="frame1" style="display:none"></iframe>
                                                                                                        <form name="uploadDoc" id="uploadDoc_6" method="post" enctype="multipart/form-data" action="" style="width:100%;">
                                                                                                            <div style="float:left; width:75%;">
                                                                                                                <input type="hidden" name="paperwork_id" value="6">
                                                                                                                <input type="hidden" name="paperworktxt" value="Social Security Card (optional)">
                                                                                                                <label title="Social Security Card (optional)" for="chk_paperwork_6">Proof of Residency</label>&nbsp;<br>

                                                                                                                <input type="file" name="upload_document" id="upload_document_6" style="visibility:hidden; width:2px; height:1px;">
                                                                                                            </div>
                                                                                                            <div style="float:right;  width:70px;">
                                                                                                                <a href="javascript:void(0);" style="text-decoration:none;display:inline-block;"  title="Choose File" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;">
                                                                                                                </a>
                                                                                                                <a href="" style="text-decoration:none;display:inline-block;" title="Download Document" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/download-icon.png">
                                                                                                                </a>
                                                                                                                <a href="" style="text-decoration:none;display:inline-block;" title="Delete Document" class="js-qwynlraxz">
                                                                                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/cross.png">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody></table>

                                                                                        </div>

                                                                                    </td>
                                                                                </tr>

                                                                                </tbody></table>
                                                                            <div style="margin-right:15px; padding-top:1px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">Customize list</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="tasks module ui-state-default" id="tasks">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="normaltext1" id="client_reminders_div" style="margin-left: -7px;">
                                                                                <!--Added by akshay on 05-10-2016 end-->
                                                                                <!-- Updated by akshay 05-10-2016 -->
                                                <div class="tab-pane <?php //if($minitab=='mt5'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="custom">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Customizable</h6>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div style="margin-right:15px; padding-top:1px;font-size: 12px !important;" align="left" class="normaltext1">
                                                                    <a href="javascript:void(0);" id="more_custom_fields" class="more_custom_fields" style="color:#58bc4f;"><span class="fa fa-plus"></span> Add New Field </a>&nbsp;&nbsp;
                                                                    <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                </div>

                                                                <span id="write_custom_form"></span>

                                                                <div id="custom_form" class="col-md-12" style="display: none;">
                                                                    <br>
                                                                    <label for="">Field Name</label>
                                                                    <input type="text" class="form-control col-md-2" name="fieldname[]" id="fieldname" />

                                                                    <label for="">Field Value</label>
                                                                    <input type="text" class="form-control col-md-2" name="fieldvalue[]" id="fieldvalue" />
                                                                    <br>
                                                                    <a align="left" style="color:#58bc4f;" href="javascript:void(0);" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" >
                                                                        <span class="fa fa-minus"></span>Remove
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                                                <div class="task-tab">
                                                                                    <ul class="tab">
                                                                                        <li><a href="#" class="tablinks active js-qwynlraxz" >Team tasks</a></li>
                                                                                        <li><a href="#" class="tablinks js-qwynlraxz">Client's tasks</a></li>
                                                                                    </ul>

                                                                                    <div id="internal" class="tabcontent" style="display: block; width: 412px;">
                                                                                        <div style="width: 100%;; overflow-y: scroll; height: 91px;">

                                                                                            <table class="table_all" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                <tbody><tr>
                                                                                                    <td height="100" align="center" valign="middle" class="normaltext1"><span style="font-size: 18px;color:#999999;">No internal tasks for this client</span></td>
                                                                                                </tr>

                                                                                                </tbody></table>


                                                                                        </div>
                                                                                        <div style="padding-top:10px;">
                                                                                            <table width="90%" border="0" cellspacing="0" cellpadding="0">

                                                                                                <tbody><tr>
                                                                                                    <td>
                                                                                                    <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                                                                                        <a href="#" style="color:#58bc4f;">View completed tasks</a>&nbsp;&nbsp;

                                                                                                        <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                                                    </div></td>
                                                                                                    <td align="right" valign="top" class="normaltext1">
                                                                                                        <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                                                                                            <a href="#" style="color:#58bc4f;">Add task</a>&nbsp;&nbsp;

                                                                                                            <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                                                        </div>
                                                                                                      </td>

                                                                                                    <td align="right" valign="top" class="normaltext1">
                                                                                                        <div style="margin-right:15px; padding-top:20px;" align="right" class="normaltext1">
                                                                                                            <a href="#" style="color:#bc1440;">7 tasks</a>&nbsp;&nbsp;

                                                                                                            <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody></table>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div id="client-portal" class="tabcontent" style="display: ;width: 432px;">
                                                                                        <div style=" overflow-y: auto; height: 91px; width: 100%;">
                                                                                            <table class="odd-even-table" width="100%" border="0" cellspacing="0" cellpadding="0">

                                                                                                <tbody><tr style="background-color: transparent !important;">
                                                                                                    <td height="100" align="center" valign="middle" class="normaltext1"><span style="font-size: 18px;color:#999999;">No pending client portal tasks for this client</span></td>
                                                                                                </tr>

                                                                                                </tbody></table>
                                                                                        </div>
                                                                                        <div style="padding-top:10px;">
                                                                                            <table width="97%" border="0" cellspacing="0" cellpadding="0">
                                                                                                <tbody><tr>
                                                                                                    <td align="left" valign="top" class="normaltext1" >
                                                                                                        <a  href="#" class="js-qwynlraxz">View completed client tasks</a>
                                                                                                    </td>
                                                                                                    <td align="right" valign="top" class="normaltext1">
                                                                                                        <a href="#"  class="js-qwynlraxz"><img src="https://app.creditrepaircloud.com/application/images/plus-small.png" style="vertical-align:middle;margin-right: 3px;"> Add task for client</a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody></table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="memos module ui-state-default" id="memo">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div id="momo_edit_btn" class="pencil">
                                                                                jhghj			  	<!--<img width="16px" height="16px" src="https://app.creditrepaircloud.com/application/images/pencil.png">-->
                                                                            </div>
                                                                            <div id="memo_input_div" style="display:none;">
                                                                                <div style=" width:100%; height:200px;">
                                                                                    <textarea name="memo_txt" id="memo_txt" style="width:400px; height:93px;" class="input">jhghj</textarea> &nbsp;
                                                                                    <input name="memo_submit" type="button" value="Save Memo" class="btnsubmit" id="memo_submit" style="vertical-align:bottom;">
                                                                                    <input name="memo_cancel" type="button" value="Cancel" class="btnsubmit memo_cancel" id="memo_cancel" style="vertical-align:bottom;">
                                                                                </div>
                                                                                <div id="memo_txt_div" style="font-size:12px; padding:3px; height:120px;">jhghj</div>
                                                                                <div align="right" class="normaltext1" style="padding-right:15px;">
                                                                                    <a href="#" id="clear_memo" name="clear_memo" style="" class="js-qwynlraxz">Clear Memo</a>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-right:15px; padding-top:1px;" align="right" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;"><span class="fa fa-upload"></span> Upload File</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="invoices module ui-state-default" id="invoice">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                            <div style="position:relative;display: inline-block;float: left;" class="boverdue">Balance</div>
                                                                            <!-- updated on 10-11-2016 start (fixed chargebee permission issue) -->
                                                                            <div style="position:relative; float: right; text-align: right;">
                                                                                <div class="normaltext1">
                                                                                    <a href="#" class="js-qwynlraxz">Chargebee Transaction History</a>
                                                                                </div>
                                                                                <!-- updated on 25-01-2017 start (updated tooltip message for chargebee) -->
                                                                                <div style="line-height: 18px; margin-left: -15px; margin-top: 45px; width: 220px; display: none;" class="tooltipbox" id="pwd-tiptxt">
                                                                                    <p style="font-weight:normal; font-size:13px; margin:0px; left:18px;" class="clientname">
                                                                                        Requires Chargebee (recommended) <span class="normaltext1"><a href="https://app.creditrepaircloud.com/mycompany/chargebee_settings" class="js-qwynlraxz">click here</a></span>
                                                                                    </p>
                                                                                    <div class="tooltiparrow1"></div>
                                                                                    <div class="tooltiparrow2"></div>
                                                                                </div>
                                                                                <!-- updated on 25-01-2017 end -->
                                                                            </div>
                                                                            </div>

                                                                            <!-- updated on 10-11-2016 end -->
                                                                            <div class="balance" style="width:97%;">

                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-bordered">

                                                                                    <tbody><tr>

                                                                                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                                                                                            Total Invoiced
                                                                                        </td>

                                                                                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                                                                                            Received
                                                                                        </td>

                                                                                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                                                                                            Outstanding
                                                                                        </td>
                                                                                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                                                                                            Past Due
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr class="gridrow">
                                                                                        <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                                                                                        <td valign="top" height="15" align="center">
                                                                                            <span id="Total_Invoice">$0</span>
                                                                                        </td>
                                                                                        <td valign="top" height="15" align="center">
                                                                                            <span id="received_total">$0</span>
                                                                                        </td>
                                                                                        <td valign="top" height="15" align="center">
                                                                                            <span id="Total_Outstanding">$0</span>
                                                                                        </td>
                                                                                        <td valign="top" height="15" align="center">
                                                                                            <span id="Past_Due">$0</span>
                                                                                        </td>
                                                                                        <!-- updated on 10-11-2016 end -->
                                                                                    </tr>



                                                                                    </tbody></table>
                                                                            </div>
                                                                            <div>
                                                                            </div>

                                                                            <div class="invoicetext" style="margin-left:0px; margin-top:6px;">
                                                                                <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                                                                                <a href="https://app.creditrepaircloud.com/invoices/add/NTk=" class="js-qwynlraxz">
                                                                                    Create Invoice</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <a href="https://app.creditrepaircloud.com/invoices/client_invoices_history/NTk=/item" class="js-qwynlraxz">
                                                                                    All Invoices</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <a href="https://app.creditrepaircloud.com/invoices/client_invoices_history/NTk=/payment" class="js-qwynlraxz">
                                                                                    Payments</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                                                                                <a href="#" class="js-qwynlraxz">
                                                                                    New Task</a>
                                                                                <!--<a href="javascript:void(0);">Billing Reminders</a><br />-->
                                                                                <!--<a href="javascript:void(0);">Billing Notes</a><br />-->
                                                                                <!--<a href="javascript:void(0);">Reminders</a>-->
                                                                            </div>
                                                                            <!--Updated by akshay 05-06-2017 s-->

                                                                            <div style="margin-right:15px; padding-top:1px;" align="right" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;"><span class="fa fa-envelope"></span> Email Invoice</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="assigned module ui-state-default" id="assign">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="assigncontactlistbox">
                                                                                <div class="assigncontactlist normaltext1">
                                                                                    <strong>Admin</strong><br> <br><img src="https://app.creditrepaircloud.com/uploads/61803_cmpny/contacts/1_photo_team_1579652503.png" height="80" width="80" alt="1_photo_team_1579652503.png">
                                                                                    <strong>Tommy Fico</strong>
                                                                                    <br>FICO HEROES<br>
                                                                                    <a style="color:#58bc4f;" href="mailto:" class="js-qwynlraxz">Send Email</a> |
                                                                                    <a style="color:#58bc4f;" href="#" target="_blank" class="js-qwynlraxz">Visit Website</a>|
                                                                                    <a style="color:#58bc4f;" href="#" target="_blank" class="js-qwynlraxz">Send Reset</a>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="customizable module_med ui-state-default" id="cim">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField1 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField2 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField3 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField4 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField5 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField6 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField7 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField8 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField9 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField10 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField11 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField12 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                                                                                    <label>Install Date: <b>Guardian</b></label>-->
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField13 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField14 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField15 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField16 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField17 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField18 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField19 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField20 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField21 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField22 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField23 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField24 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Custom</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin-right:15px; padding-top:50px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="billings module_med ui-state-default" id="billing">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >MMR Method :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Guardian</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Full Name :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1/11/1111</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span > Address :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span > City/State/Zip :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomFld1 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomFld2 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Account # :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Routing # :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span>CustomFld3 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Credit Card # :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CC Exp :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CCN CCV :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                                                                                    <label>Install Date: <b>Guardian</b></label>-->
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >1-Time Method :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Recuring</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >One Time Amt :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span > Activation :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >MMR :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span > Billing Freq. :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Billing Date :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Contract Term :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Start Date :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >End Date : </span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Ext. Date :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Tot Equip Rev :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField4 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin-right:15px; padding-top:50px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;

                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="alarm module_med ui-state-default" id="alarm">
                                                                    <h5></h5>
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Monitoring Co :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>Guardian</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Install Date :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1/11/1111</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span > Account Type :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Password :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Contact #2 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Contact #3 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Contact #4 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Panel Type :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Plan Type :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span>$ Waived :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >RebateCheck1 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Warranty Type :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="40%" align="right" valign="top">
                                                                                                <label class="alarm_label" style="margin-right: 6px;"> <span >Monitoring Confirmation Number :</span> </label>

                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> <br> <br>AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                                                                                    <label>Install Date: <b>Guardian</b></label>-->
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="contacttext">
                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >ID :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b>1123</b> </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Credit Score :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Acct Info :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> 1123</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span > Installer Code :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Contact #2 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Contact #3 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Contact #4 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >System Type : </span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Rebate Offer :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >Verification :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >RebateCheck2 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label"> <span >CustomField 1 :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_label" style="margin-right: 7px;"> <span >Signal Confirmation Number :</span> </label>
                                                                                            </td>
                                                                                            <td width="50%" align="right" valign="top">
                                                                                                <label class="alarm_answer"><b><br> <br> AC</b> </label>
                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12">

                                                                            </div>

                                                                            <div style="margin-right:15px; padding-top:30px;" align="left" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;
                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>
                                                                            <div style="margin-right:15px; padding-top:30px;" align="right" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">Website Url</a>&nbsp;&nbsp;
                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>
                                                                            <div style="margin-right:15px; padding-top:30px;" align="right" class="normaltext1">
                                                                                <a href="#" style="color:#58bc4f;">Record Sheet</a>&nbsp;&nbsp;
                                                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="dispute module_med ui-state-default" id="dispute_status">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="statuscontent">
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tbody><tr>
                                                                                        <td width="25%">&nbsp;</td>
                                                                                        <td width="22%" align="center" valign="middle">
                                                                                            <img alt="" src="https://app.creditrepaircloud.com/application/images/equifax.png" class="" style="height:16px;width: 63px;vertical-align:middle;">    </td>
                                                                                        <td width="22%" align="center" valign="middle">
                                                                                            <img alt="" src="https://app.creditrepaircloud.com/application/images/experian.png" class="" style="height:16px;width: 63px;vertical-align:middle;">    </td>
                                                                                        <td width="22%" align="center" valign="middle">
                                                                                            <img alt="" src="https://app.creditrepaircloud.com/application/images/trans_union.png" class="" style="height:16px;width: 63px;vertical-align:middle;">    </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="10" align="left" valign="top"></td>
                                                                                        <td height="10" align="center" valign="top"></td>
                                                                                        <td height="10" align="center" valign="top"></td>
                                                                                        <td height="10" align="center" valign="top"></td>

                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td height="20" align="left" valign="top" class="num8">Unspecified</td>
                                                                                        <td align="center" valign="top" class="num8">0</td>
                                                                                        <td align="center" valign="top" class="num8">0</td>
                                                                                        <td align="center" valign="top" class="num8">0</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="20" align="left" valign="top" class="num1">Positive</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="20" align="left" valign="top" class="num1">Deleted</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="20" align="left" valign="top" class="num1">Repaired</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="20" align="left" valign="top" class="num4">In Dispute</td>
                                                                                        <td align="center" valign="top" class="num4">0</td>
                                                                                        <td align="center" valign="top" class="num4">0</td>
                                                                                        <td align="center" valign="top" class="num4">0</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="20" align="left" valign="top" class="num6">Verified</td>
                                                                                        <td align="center" valign="top" class="num6">0</td>
                                                                                        <td align="center" valign="top" class="num6">0</td>
                                                                                        <td align="center" valign="top" class="num6">0</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="20" align="left" valign="top" class="num6">Negative</td>
                                                                                        <td align="center" valign="top" class="num6">0</td>
                                                                                        <td align="center" valign="top" class="num6">0</td>
                                                                                        <td align="center" valign="top" class="num6">0</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="20" align="left" valign="top" class="num1">Updated</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>
                                                                                        <td align="center" valign="top" class="num1">0</td>

                                                                                    </tr>

                                                                                    <tr class="num6" style="white-space: nowrap;">
                                                                                        <td height="30" align="left" valign="top" class="num7">Bureau Letters</td>

                                                                                        <td align="center" valign="top" class="num7">0</td>
                                                                                        <td align="center" valign="top" class="num7">0</td>
                                                                                        <td align="center" valign="top" class="num7">0</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="20" style="border-top:1px solid #ccc;" colspan="4" align="center" valign="bottom" class="num7">Furnisher Letters : 0</td>
                                                                                    </tr>
                                                                                    </tbody></table>
                                                                                <div class="clear" style="height:10px;"></div>
                                                                                <div align="center">
                                                                                    <a class="btngreen js-qwynlraxz" href="#" style="color:#FFFFFF; text-decoration:none; width:87%; display:block; ">

                                                                                        View/Update All Dispute Items					</a>
                                                                                </div>
                                                                                <div class="clear" style="height:10px;"></div>
                                                                                <div>
                                                                                    <!-- updated by bhavik on 04-09-2015 Start (Display tool-tip to restriction to use import online credit report functionality outside USA) -->


                                                                                    <a class="btnsubmit js-qwynlraxz" href="" style="color:#FFFFFF; text-decoration:none; width:87%; display:block; ">
                                                                                        Import Online Credit Reports</a>
                                                                                    <!-- updated by bhavik on 04-09-2015 End -->
                                                                                </div>
                                                                            </div>
                                                                            <!--<div class="chart2">
                                                                                <div class="dropall" style="text-align:center;">
                                                                                    <select name="bureau_drop_down" id="bureau_drop_down" style="width:100px; margin:5px 0 0 0px;" class="dropdown" onchange="return drawPieChart('Doughnut2D', 'PieChartId', '140', '175', 'chart_div', this.value);">
                                                                                        <option value="">All</option>
                                                                                        <option value="1">Equifax</option>
                                                                                        <option value="2">Experian</option>
                                                                                        <option value="3">Transunion</option>

                                                                                    </select></div>

                                                                                <<div style="text-align:center; margin-top:-18px;"><span class="progressBar" id="pb1"><img id="pb1_pbImage" title=" 0.00%" alt=" 0.00%" src="https://app.creditrepaircloud.com/application/images/progressbar.gif" width="120" style="width: 120px; height: 12px; background-image: url(&quot;https://app.creditrepaircloud.com/application/images/progressbg_green.gif&quot;); background-position: -120px 50%; padding: 0px; margin: 5px 0px;"><span id="pb1_pbText"> 0.00%</span></span></div>

                                                                                <div class="breakline"></div>
                                                                                <div class="completetext" style="padding-right:0px; margin-top:1px;text-align:center;margin: 20px 0px;">

                                                                                    <a href="https://app.creditrepaircloud.com/userdesk/saved_letters/NTk=" id="my_save_letter_pp" class="js-qwynlraxz">
                                                                                        Client's Saved Letters</a>
                                                                                    <br>
                                                                                    <a href="javascript:void(0);" onclick="return viewImportPDFPopUp()" class="js-qwynlraxz">
                                                                                        Document Storage</a>

                                                                                    <br>

                                                                                </div>-->
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
                                                                        <button data-toggle="modal" data-target="#modal_lead_source" class="btn btn-sm btn-default pull-right sa" title="Add Sales Area" style="margin-bottom: 10px;">
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
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

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
                            <input type="text" class="form-control" name="lead_name" id="lead_name" required/>
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
            }
        });

        $( ".sortable2" ).sortable( "disable" );

        //var idsInOrder = $(".sortable2").sortable("toArray");
        //-----------------^^^^
        //console.log(idsInOrder);
    });

</script>
