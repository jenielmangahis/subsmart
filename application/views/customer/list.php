<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
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
                                                    <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#basic">Basic Customer</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#advance">Advance Customers</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-content mt-4" >
                                        <div class="tab-pane active standard-accordion" id="basic">
                                            <div class="col-sm-6">
                                                <h3 class="page-title">Basic Customers</h3>
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
                                            </a>    -->
                                                            <a class="btn btn-primary btn-md"
                                                               href="<?php echo url('customer/add') ?>"><span
                                                                        class="fa fa-plus"></span> New Customer</a>
                                                        <?php //endif ?>
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
                                                        <table class="table table-hover table-to-list" data-id="work_orders">
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
                                                            <?php foreach ($customers as $customer) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="table-name">
                                                                            <div class="checkbox checkbox-sm">
                                                                                <input type="checkbox"
                                                                                       name="id[<?php echo $customer->id ?>]"
                                                                                       value="<?php echo $customer->id ?>"
                                                                                       class="select-one"
                                                                                       id="customer_id_<?php echo $customer->id ?>">
                                                                                <label for="customer_id_<?php echo $customer->id ?>"> <a
                                                                                            class="a-default"
                                                                                            href="<?php echo base_url('customer/genview/' . $customer->id) ?>"><?php echo $customer->contact_name ?></a></label>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="table-nowrap">
                                                                            <?php echo $customer->contact_email ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="table-nowrap">
                                                                            <?php if (is_serialized($customer->phone)) { ?>
                                                                                <?php echo unserialize($customer->phone)['number'] ?>
                                                                                (<?php echo unserialize($customer->phone)['type'] ?>)
                                                                            <?php } else { ?>
                                                                                <?php echo $customer->phone; ?>
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
                                                                                                           href="<?php echo base_url('customer/view/' . $customer->id) ?>"><span
                                                                                                class="fa fa-user icon"></span> View</a>
                                                                                </li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('customer/edit/' . $customer->id) ?>"><span
                                                                                                class="fa fa-pencil-square-o icon"></span>
                                                                                        Edit</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('customer/tickets/add?customer_id=' . $customer->id) ?>"><span
                                                                                                class="fa fa-pencil-square-o icon"></span>
                                                                                        Create Service Ticket</a></li>
                                                                                <li role="separator" class="divider"></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('workcalender/?customer_id=' . $customer->id . '&action=open_event_modal') ?>"><span
                                                                                                class="fa fa-calendar icon"></span> Schedule
                                                                                        Appointment</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('invoice') ?>"><span
                                                                                                class="fa fa-money icon"></span> Create
                                                                                        Invoice</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('estimate/add?customer_id=' . $customer->id) ?>"><span
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
                                                                                                           data-customer-id="<?php echo $customer->id ?>"
                                                                                                           onclick="return confirm('Do you really want to delete this item ?')"
                                                                                                           data-customer-info="Agnes Knox, "
                                                                                                           href="<?php echo base_url('customer/delete/' . $customer->id) ?>"><span
                                                                                                class="fa fa-trash-o icon"></span> Delete
                                                                                        customer</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>

                                                            </tbody>

                                                        </table>
                                                    <?php } else { ?>
                                                        <p class="text-center">No customers found.</p>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="tab-pane fade standard-accordion" id="advance">
                                            <div class="col-sm-12">
                                                <h3 class="page-title">Advance Customers</h3>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="float-right d-md-block">
                                                    <div class="dropdown">
                                                        <a class="btn btn-primary btn-md"href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> Add Lead</a>
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
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget1">Widget 2</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget1">Widget 3</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget1">Educate</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget1">Messages</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget1">Internal Notes</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget1">Invoices</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#widget1">Activity</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-content mt-4" >
                                                        <div class="tab-pane active standard-accordion" id="dashboard">
                                                            <div class="indata">
                                                                <div class="client modules">
                                                                    <div class="col-sm-6">
                                                                    <table class="widget_client" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody><tr>
                                                                            <td width="50%" align="left" valign="top">
                                                                                <div class="contacttext">
                                                                                    <h3 style="font-size: 15px; margin-bottom: 10px;">
                                                                                        Kyle Test                            </h3>
                                                                                </div>

                                                                                <div class="contacttext">
                                                                                    <div>
                                                                                        (850) 324-8636                                <a id="email-confirm" href="javascript:void(0);" style="display:block;margin-top: 5px;" title="kylenguyenmailbox@gmail.com" class="js-qwynlraxz">kylenguyenmailbox@gmail.com</a>
                                                                                        <input type="hidden" name="email-confirm-hidden" id="email-confirm-hidden" value="kylenguyenmailbox@gmail.com">

                                                                                    </div>
                                                                                    <div style="margin-top:7px;"><span>---</span>
                                                                                    </div>
                                                                                    <!--Updated by akshay 05-06-2017 s-->
                                                                                    <div style="margin-top:7px;">
                                                                                        Status:
                                                                                        <!--Updated by akshay 05-06-2017 s-->

                                                                                        <span class="active">Client</span>
                                                                                        <!--Added by akshay 05-06-2017 s-->
                                                                                        <select class="dropdown" name="clientstatus" id="clientstatus" onchange="return changestatus_dashboard(this.value,'NTk=','');" style="display:none; width:90px; margin:0px; vertical-align:middle; ">
                                                                                            <option value="2">Lead</option>
                                                                                            <option value="100">Prospect</option>
                                                                                            <option value="3">Lead/Inactive</option>
                                                                                            <option value="1" selected="selected">Client</option>
                                                                                            <option value="4">Inactive</option>
                                                                                            <option value="5">Suspended</option>
                                                                                        </select>
                                                                                        <img src="https://app.creditrepaircloud.com/application/images/cancel_icon.png" id="status_cancel" onclick="$('#clientstatus').hide(); $('#status_cancel').hide(); $('#client_status_link').show();" title="cancel" style="display:none;cursor:pointer; vertical-align:middle;" border="0" width="16" height="16">
                                                                                        <img src="https://app.creditrepaircloud.com/application/images/ajax-loader.gif" id="status_loading" style="display:none; vertical-align:middle;" border="0" width="16" height="16">
                                                                                        <br>
                                                                                        <!--Added by akshay 05-06-2017 e-->
                                                                                    </div>
                                                                                </div>
                                                                                <!--Updated by akshay 05-06-2017 s-->
                                                                                <div style="margin-right:15px; margin-top:6px;" align="left" class="normaltext1">
                                                                                    <a href="https://app.creditrepaircloud.com/userdesk/profile/NTk=" class="js-qwynlraxz">
                                                                                        View/Edit Profile
                                                                                    </a>&nbsp;&nbsp;

                                                                                    <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                                                </div>
                                                                            </td>
                                                                            <td width="50%" valign="middle">
                                                                                <div class="contactrighttab" style="margin-top:1px;" onclick="javascript:location.href = 'https://app.creditrepaircloud.com/importcreditreport/simple_audit/NTk=?from=quick_import'">
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

                                                                                <div class="contactrighttab" onclick="javascript:location.href = 'https://app.creditrepaircloud.com/wizard/index/NTk='">

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
                                                                                <div class="contactrighttab" style="position:relative" onclick="javascript:void(0)" onmouseover="mover('portal_tip')" onmouseout="mout('portal_tip')">
                                                                                    <div class="widget_tab">
                                                                                        <div class="contactrightimg">
                                                                                            <img src="https://app.creditrepaircloud.com/application/images/dashboard2.png" alt="securemailimg" style="height:33px;">
                                                                                        </div>
                                                                                        <div class="contactrighttxt">
                                                                                            <a href="javascript:void(0)" class="js-qwynlraxz">Send Secure Message</a><br>
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
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    </div>
                                                                </div>
                                                                <div class="project modules">
                                                                    <div class="col-sm-12">
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
                                                                        <a href="javascript:void(0)" id="zoombar" style="text-decoration:none;" title="Click here to zoom this chart" class="js-qwynlraxz">
                                                                            <img src="https://app.creditrepaircloud.com/application/images/zoom_in.png">&nbsp;
                                                                        </a>
                                                                    </div>
                                                                    <div class="chart" id="chart_column" style="height:159px; width:124px;">
                                                                        <img src="https://app.creditrepaircloud.com/application/images/nodata-bar-chart.png" style="vertical-align:middle; padding-top: 32px; padding-left: 1px;">
                                                                    </div>
                                                                    <button id="button" style="display:none">View the growth</button>
                                                                    <!--Start Date: 03/09/2020-->
                                                                        <div class="add" style="float:right; padding-right:10px; padding-top:0px; margin-left:36px;" align="right">
                                                                            <a href="javascript:void(0);" class="add-score js-qwynlraxz">
                                                                                Add/Edit Scores
                                                                            </a>
                                                                        </div>

                                                                </div>


                                                                <div style="clear:both; margin-top:10px; height:10px;">&nbsp;</div>
                                                                </div>
                                                                <div class="paperwork">
                                                                    <div>
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody><tr>
                                                                                <td width="100%" align="left" valign="top" class="issued"> <!--Paperwork Issued / Signed--> Issued/Received</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left" valign="top" style="padding-right:10px;">
                                                                                    <div style="overflow:auto; height:90px; width:100%; margin-top:10px; " id="paper_place_load">
                                                                                        <script type="text/javascript">

                                                                                            function populateIframe(id,path,org_name,altername)
                                                                                            {
                                                                                                var ifrm = document.getElementById(id);
                                                                                                ifrm.src = base_url()+"import_pdf/read_files?path="+path+"&org_name="+org_name+"&altername="+altername;
                                                                                            }

                                                                                        </script>
                                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                            <tbody><tr>
                                                                                                <td width="25" align="center" valign="top">
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

                                                                                                            <input type="file" name="upload_document" id="upload_document_1" style="visibility:hidden; width:2px; height:1px;" onchange="submitDocForm('uploadDoc_1')">
                                                                                                        </div>
                                                                                                        <div style="float:right;  width:70px;">
                                                                                                            <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->

                                                                                                            <a href="javascript:void(0);" onclick="javascript:document.getElementById('upload_document_1').click()" title="Choose File" class="js-qwynlraxz"><img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;"></a>

                                                                                                            &nbsp;&nbsp;
                                                                                                            &nbsp;
                                                                                                            <!-- updated on 10-11-2016 end -->
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td width="25" align="center" valign="top">
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

                                                                                                            <input type="file" name="upload_document" id="upload_document_4" style="visibility:hidden; width:2px; height:1px;" onchange="submitDocForm('uploadDoc_4')">
                                                                                                        </div>
                                                                                                        <div style="float:right;  width:70px;">
                                                                                                            <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->

                                                                                                            <a href="javascript:void(0);" onclick="javascript:document.getElementById('upload_document_4').click()" title="Choose File" class="js-qwynlraxz"><img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;"></a>

                                                                                                            &nbsp;&nbsp;
                                                                                                            &nbsp;
                                                                                                            <!-- updated on 10-11-2016 end -->
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td width="25" align="center" valign="top">
                                                                                                    <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->
                                                                                                    <input type="checkbox" class="cb" name="chk_paperwork[]" id="chk_paperwork_5" value="5">
                                                                                                    <!-- updated on 10-11-2016 end -->
                                                                                                </td>
                                                                                                <td align="left" valign="top">
                                                                                                    <iframe id="frame1" style="display:none"></iframe>
                                                                                                    <form name="uploadDoc" id="uploadDoc_5" method="post" enctype="multipart/form-data" action="" style="width:100%;">
                                                                                                        <div style="float:left; width:75%;">
                                                                                                            <input type="hidden" name="paperwork_id" value="5">
                                                                                                            <input type="hidden" name="paperworktxt" value="Utility Bill/Proof of Address">
                                                                                                            <label title="Utility Bill/Proof of Address" for="chk_paperwork_5">Utility Bill/Proof of Address</label>&nbsp;<br>

                                                                                                            <input type="file" name="upload_document" id="upload_document_5" style="visibility:hidden; width:2px; height:1px;" onchange="submitDocForm('uploadDoc_5')">
                                                                                                        </div>
                                                                                                        <div style="float:right;  width:70px;">
                                                                                                            <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->

                                                                                                            <a href="javascript:void(0);" onclick="javascript:document.getElementById('upload_document_5').click()" title="Choose File" class="js-qwynlraxz"><img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;"></a>

                                                                                                            &nbsp;&nbsp;
                                                                                                            &nbsp;
                                                                                                            <!-- updated on 10-11-2016 end -->
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
                                                                                                            <label title="Social Security Card (optional)" for="chk_paperwork_6">Social Security Card (optional)</label>&nbsp;<br>

                                                                                                            <input type="file" name="upload_document" id="upload_document_6" style="visibility:hidden; width:2px; height:1px;" onchange="submitDocForm('uploadDoc_6')">
                                                                                                        </div>
                                                                                                        <div style="float:right;  width:70px;">
                                                                                                            <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->

                                                                                                            <a href="javascript:void(0);" onclick="javascript:document.getElementById('upload_document_6').click()" title="Choose File" class="js-qwynlraxz"><img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;"></a>

                                                                                                            &nbsp;&nbsp;
                                                                                                            &nbsp;
                                                                                                            <!-- updated on 10-11-2016 end -->
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody></table>

                                                                                    </div>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left" valign="top" style="padding-right:10px;">	<div class="normaltext1" style="margin-top:10px;">
                                                                                        <a href="javascript:void(0);" class="paperwork_issued js-qwynlraxz">Customize list<!--Customize this list--></a>

                                                                                    </div></td>
                                                                            </tr>
                                                                            </tbody></table>
                                                                    </div>
                                                                </div>
                                                                <div class="statusbg">
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
                                                                            <a class="btngreen js-qwynlraxz" href="https://app.creditrepaircloud.com/userdesk/disputedetail/NTk=" style="color:#FFFFFF; text-decoration:none; width:87%; display:block; ">

                                                                                View/Update All Dispute Items					</a>
                                                                        </div>
                                                                        <div class="clear" style="height:10px;"></div>
                                                                        <div>
                                                                            <!-- updated by bhavik on 04-09-2015 Start (Display tool-tip to restriction to use import online credit report functionality outside USA) -->


                                                                            <a class="btnsubmit js-qwynlraxz" href="https://app.creditrepaircloud.com/importcreditreport/index/NTk=" style="color:#FFFFFF; text-decoration:none; width:87%; display:block; ">
                                                                                Import Online Credit Reports</a>
                                                                            <!-- updated by bhavik on 04-09-2015 End -->
                                                                        </div>
                                                                    </div>

                                                                    <div class="chart2">
                                                                        <div class="dropall" style="text-align:center;">
                                                                            <select name="bureau_drop_down" id="bureau_drop_down" style="width:100px; margin:5px 0 0 0px;" class="dropdown" onchange="return drawPieChart('Doughnut2D', 'PieChartId', '140', '175', 'chart_div', this.value);">
                                                                                <option value="">All</option>
                                                                                <option value="1">Equifax</option>
                                                                                <option value="2">Experian</option>
                                                                                <option value="3">Transunion</option>

                                                                            </select></div>
                                                                        <!-- google chart S -->
                                                                        <div id="chart_div" style="margin:-15px 0 0 0px; text-align:center;"><img src="https://app.creditrepaircloud.com/application/images/nodata-pie-chart.png" style="vertical-align:middle; padding-left:0px;  padding-top:15px; padding-bottom:0px;"></div>
                                                                        <!-- google chart E -->
                                                                        <div style="text-align:center; margin-top:-18px;"><span class="progressBar" id="pb1"><img id="pb1_pbImage" title=" 0.00%" alt=" 0.00%" src="https://app.creditrepaircloud.com/application/images/progressbar.gif" width="120" style="width: 120px; height: 12px; background-image: url(&quot;https://app.creditrepaircloud.com/application/images/progressbg_green.gif&quot;); background-position: -120px 50%; padding: 0px; margin: 5px 0px;"><span id="pb1_pbText"> 0.00%</span></span></div>
                                                                        <!--<div class="complete">60% Complete</div>-->
                                                                        <div class="breakline"></div>
                                                                        <div class="completetext" style="padding-right:0px; margin-top:1px;text-align:center;margin: 20px 0px;">

                                                                            <a href="https://app.creditrepaircloud.com/userdesk/saved_letters/NTk=" id="my_save_letter_pp" class="js-qwynlraxz">
                                                                                Client's Saved Letters</a>
                                                                            <br>
                                                                            <a href="javascript:void(0);" onclick="return viewImportPDFPopUp()" class="js-qwynlraxz">
                                                                                Document Storage</a>

                                                                            <br>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="reminder">
                                                                    <!--Added by akshay on 05-10-2016 start-->
                                                                    <div class="normaltext1" id="client_reminders_div" style="margin-left: -17px;">
                                                                        <!--Added by akshay on 05-10-2016 end-->
                                                                        <!-- Updated by akshay 05-10-2016 -->

                                                                        <div class="task-tab">
                                                                            <ul class="tab">
                                                                                <li><a href="javascript:void(0)" class="tablinks active js-qwynlraxz" onclick="openCity(event, 'internal')">Team tasks</a></li>
                                                                                <li><a href="javascript:void(0)" class="tablinks js-qwynlraxz" onclick="openCity(event, 'client-portal')">Client's tasks</a></li>
                                                                            </ul>

                                                                            <div id="internal" class="tabcontent" style="display: block; width: 432px;">
                                                                                <div style="width: 100%;; overflow-y: scroll; height: 91px;">

                                                                                    <table class="table_all" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody><tr>
                                                                                            <td height="100" align="center" valign="middle" class="normaltext1"><span style="font-size: 18px;color:#999999;">No internal tasks for this client</span></td>
                                                                                        </tr>

                                                                                        </tbody></table>


                                                                                </div>
                                                                                <div style="padding-top:10px;">
                                                                                    <table width="97%" border="0" cellspacing="0" cellpadding="0">

                                                                                        <tbody><tr>
                                                                                            <td align="left" valign="top" class="normaltext1">

                                                                                                <!-- <a href="" onclick="return showAllReminders()">Show More</a> -->
                                                                                                <a href="" onclick="return showAllReminders();" class="js-qwynlraxz">

                                                                                                    View completed tasks</a>
                                                                                            </td>
                                                                                            <td align="right" valign="top" class="normaltext1">
                                                                                                <a href="" onclick="return reminderPopUpClient();" style="line-height:15px;" class="js-qwynlraxz">

                                                                                                    <img src="https://app.creditrepaircloud.com/application/images/plus-small.png" style="vertical-align:middle;"> &nbsp;Add task</a>
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
                                                                                            <td align="left" valign="top" class="normaltext1">
                                                                                                <a href="javascript:void(0);" onclick="return showcompleteonboarding()" class="js-qwynlraxz">View completed client tasks</a>
                                                                                            </td>
                                                                                            <td align="right" valign="top" class="normaltext1">
                                                                                                <a href="javascript:void(0);" onclick="return addonboardingtask()" class="js-qwynlraxz"><img src="https://app.creditrepaircloud.com/application/images/plus-small.png" style="vertical-align:middle;margin-right: 3px;"> Add task for client</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody></table>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <script>
                                                                            function openCity(evt, cityName) {
                                                                                var i, tabcontent, tablinks;
                                                                                tabcontent = document.getElementsByClassName("tabcontent");
                                                                                for (i = 0; i < tabcontent.length; i++) {
                                                                                    tabcontent[i].style.display = "none";
                                                                                }
                                                                                tablinks = document.getElementsByClassName("tablinks");
                                                                                for (i = 0; i < tablinks.length; i++) {
                                                                                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                                                                                }
                                                                                document.getElementById(cityName).style.display = "block";
                                                                                evt.currentTarget.className += " active";
                                                                            }

                                                                            // Get the element with id="defaultOpen" and click on it
                                                                            document.getElementById("defaultOpen").click();
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                                <div class="memo showAreadblClick">
                                                                    <div id="momo_edit_btn" class="pencil">
                                                                        jhghj			  	<!--<img width="16px" height="16px" src="https://app.creditrepaircloud.com/application/images/pencil.png">-->
                                                                    </div>
                                                                    <div id="memo_input_div" style="display:none;">
                                                                        <div style="background:url(../../images/pencil_big.png) center; width:100%; height:200px;">
                                                                            <textarea name="memo_txt" id="memo_txt" style="width:400px; height:93px;" class="input">jhghj</textarea> &nbsp;
                                                                            <input name="memo_submit" type="button" value="Save Memo" class="btnsubmit" id="memo_submit" style="vertical-align:bottom;">
                                                                            <input name="memo_cancel" type="button" value="Cancel" class="btnsubmit memo_cancel" id="memo_cancel" style="vertical-align:bottom;">
                                                                        </div>
                                                                        <div id="memo_txt_div" style="font-size:12px; padding:3px; height:120px;">jhghj</div>
                                                                        <div align="right" class="normaltext1" style="padding-right:15px;">
                                                                            <a href="javascript:void(0);" id="clear_memo" name="clear_memo" style="" class="js-qwynlraxz">Clear Memo</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="invoice">
                                                                    <div style="display: inline-block;" class="boverdue">Balance</div>
                                                                    <!-- updated on 10-11-2016 start (fixed chargebee permission issue) -->
                                                                    <div onmouseout="mout('pwd-tiptxt')" onmouseover="mover('pwd-tiptxt')" style="position:relative; float: right; margin: 0px 18px 0px 0px;">
                                                                        <div class="normaltext1">
                                                                            <a href="javascript:void(0)" class="js-qwynlraxz">Chargebee Transaction History</a>
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
                                                                    <!-- updated on 10-11-2016 end -->
                                                                    <div class="balance" style="width:97%;">

                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

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
                                                                        <a href="javascript:void(0);" onclick="reminderPopUpClient();
                                                                                        $('#cd_remainder_type').val('Billing');" class="js-qwynlraxz">
                                                                            New Task</a>
                                                                        <!--<a href="javascript:void(0);">Billing Reminders</a><br />-->
                                                                        <!--<a href="javascript:void(0);">Billing Notes</a><br />-->
                                                                        <!--<a href="javascript:void(0);">Reminders</a>-->
                                                                    </div>
                                                                    <!--Updated by akshay 05-06-2017 s-->


                                                                </div>
                                                                <div style="clear:both; height:0px;">&nbsp;</div>
                                                                <div class="assigncontactbg" style="margin-top:0px;">
                                                                    <div class="col-sm-12">
                                                                        <div class="assigncontactlistbox">
                                                                            <div class="assigncontactlist normaltext1">
                                                                                <strong>Admin</strong><br> <br><img src="https://app.creditrepaircloud.com/uploads/61803_cmpny/contacts/1_photo_team_1579652503.png" height="80" width="80" alt="1_photo_team_1579652503.png"><br> <br><strong>Tommy Fico</strong><br>FICO HEROES<br><br><br><a href="mailto:support@ficoheroes.com" class="js-qwynlraxz">Send Email</a><br><a href="https://www.ficoheroes.com" target="_blank" class="js-qwynlraxz">Visit Website</a></div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>


                                                    </div>


                                                     <!--
                                                    <?php //if (!empty($customers)) { ?>
                                                        <table class="table table-hover table-to-list" data-id="work_orders">
                                                            <thead>
                                                            <tr>
                                                                <th> Name</th>
                                                                <th>Added</th>
                                                                <th>Status</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                            <?php foreach ($customers as $customer) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="table-name">
                                                                            <div class="checkbox checkbox-sm">
                                                                                <input type="checkbox"
                                                                                       name="id[<?php echo $customer->id ?>]"
                                                                                       value="<?php echo $customer->id ?>"
                                                                                       class="select-one"
                                                                                       id="customer_id_<?php echo $customer->id ?>">
                                                                                <label for="customer_id_<?php echo $customer->id ?>"> <a
                                                                                            class="a-default"
                                                                                            href="<?php echo base_url('customer/genview/' . $customer->id) ?>"><?php echo $customer->contact_name ?></a></label>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="table-nowrap">
                                                                            <?php echo $customer->contact_email ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="table-nowrap">
                                                                            <?php if (is_serialized($customer->phone)) { ?>
                                                                                <?php echo unserialize($customer->phone)['number'] ?>
                                                                                (<?php echo unserialize($customer->phone)['type'] ?>)
                                                                            <?php } else { ?>
                                                                                <?php echo $customer->phone; ?>
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
                                                                                                           href="<?php echo base_url('customer/view/' . $customer->id) ?>"><span
                                                                                                class="fa fa-user icon"></span> View</a>
                                                                                </li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('customer/edit/' . $customer->id) ?>"><span
                                                                                                class="fa fa-pencil-square-o icon"></span>
                                                                                        Edit</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('customer/tickets/add?customer_id=' . $customer->id) ?>"><span
                                                                                                class="fa fa-pencil-square-o icon"></span>
                                                                                        Create Service Ticket</a></li>
                                                                                <li role="separator" class="divider"></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('workcalender/?customer_id=' . $customer->id . '&action=open_event_modal') ?>"><span
                                                                                                class="fa fa-calendar icon"></span> Schedule
                                                                                        Appointment</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('invoice') ?>"><span
                                                                                                class="fa fa-money icon"></span> Create
                                                                                        Invoice</a></li>
                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                           href="<?php echo base_url('estimate/add?customer_id=' . $customer->id) ?>"><span
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
                                                                                                           data-customer-id="<?php echo $customer->id ?>"
                                                                                                           onclick="return confirm('Do you really want to delete this item ?')"
                                                                                                           data-customer-info="Agnes Knox, "
                                                                                                           href="<?php echo base_url('customer/delete/' . $customer->id) ?>"><span
                                                                                                class="fa fa-trash-o icon"></span> Delete
                                                                                        customer</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>

                                                        </table>
                                                    <?php //} else { ?>
                                                        <p class="text-center">No customers found.</p>
                                                    <?php //} ?>
                                                    -->
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

<style>
    .hid-deskx {
        display: none !important;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial,Helvetica,sans-serif;
        font-weight: 400;
        font-size: 13px;
    }


    .indata {
        border-top-left-radius: 0px!important;
    }
    .indata {
        background-color: #f2f2f2;
        width: 80%;
        float: left;
        margin: -4px 0 0 10px;
        padding-left: 6px;
        padding-right: 6px;
        padding-bottom: 10px;
        border-radius: 10px;
    }


    .client {
        background-image: url('https://app.creditrepaircloud.com/application/images/client_new.png');
        width: 530px;
        float: left;
        margin: 10px 0 0 10px;
        padding: 0 0 0 40px;
    }
    .client, .project {
        height: 185px;
        background-repeat: no-repeat;
    }

    .contactrighttab:hover {
        border: 1px solid #dfdfdf;
        border-radius: 5px;
        box-shadow: 0 0 8px #ddd;
        cursor: pointer;
        color: #0070c8;
    }

    .contactrighttab {
        height: 35px;
        margin-top: 6px;
        padding-top: 3px;
        padding-bottom: 3px;
        float: left;
        border: 1px solid #fff;

    }

    .contactrighttxt {
        width: 207px;
        font-size: 12px;
        line-height: 130%;
    }
    .contactrighttxt a {
        color: #1e5da9;
        text-decoration: none;
    }
    .contactrightimg {
        float: left;
        margin-right: 10px;
        font-size: 10px;
        padding: 2px;
        width: 35px;
    }

    .project {
        background-image: url('https://app.creditrepaircloud.com/application/images/scores_new.png');
        width: 530px;
        float: left;
        margin: 10px 0 0 10px;
        padding: 0 0 0 40px;
    }
    .storescontent {
        float: left;
        width: 279px;
        margin-top: 15px;
        min-height: 121px;
    }
    .chartzoom {
        float: right;
        position: absolute;
        z-index: 990;
        width: 425px;
    }
    .chart {
        width: 139px!important;
        height: 159px;
        margin: 2px 2px 0 0;
        border-top-right-radius: 9px;
        -webkit-border-top-right-radius: 9px;
        -moz-border-top-right-radius: 9px;
        -ms-border-top-right-radius: 9px;
        -o-border-top-right-radius: 9px;
        border-bottom-right-radius: 9px;
        -webkit-border-bottom-right-radius: 9px;
        -moz-border-bottom-right-radius: 9px;
        -ms-border-bottom-right-radius: 9px;
        -o-border-bottom-right-radius: 9px;
    }
    .chart, .chart2 {
        background-color: #d4f6ff;
        float: right;
        padding: 0;
    }
    .add {
        font-size: 13px;
        font-weight: 400;
        margin: 0 0 0 120px;
    }
    .add, .add a {
        color: #1e5da9;
    }
    .clear {
        clear: both;
        height: 10px;
    }


    .paperwork {
        background-image: url('https://app.creditrepaircloud.com/application/images/documents_new.png');
        background-repeat: no-repeat;
        width: 530px;
        height: 165px;
        float: left;
        margin: 10px 0 0 10px;
        padding: 0 0 0 50px;
    }

    .statusbg {
        background-image: url('https://app.creditrepaircloud.com/application/images/status_new.png');
        height: 340px;
        width: 520px;
        float: left;
        margin: 10px 0 0 11px;
        padding: 0;
    }
    .btn, .btn:hover, .details, .statusbg {
        background-repeat: no-repeat;
    }
    .statuscontent {
        float: left;
        width: 274px;
        margin-top: 15px;
        padding-left: 50px;
    }
    .chart2 {
        width: 140px;
        height: 336px;
        margin: 1px 1px 0 0;
        -webkit-border-top-right-radius: 10px;
        -moz-border-top-right-radius: 10px;
        -ms-border-top-right-radius: 10px;
        -o-border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        -webkit-border-bottom-right-radius: 10px;
        -moz-border-bottom-right-radius: 10px;
        -ms-border-bottom-right-radius: 10px;
        -o-border-bottom-right-radius: 10px;
    }
    .chart2, .signin {
        border-top-right-radius: 10px;
    }

    .reminder {
        background-image: url('https://app.creditrepaircloud.com/application/images/reminder_new.png');
        width: 480px;
        margin: -167px 145px 0 10px;
    }
    .invoice, .reminder {
        background-repeat: no-repeat;
        float: left;
        height: 165px;
        padding-left: 50px;
    }
    .task-tab {
        width: 443px;
    }
    .task-tab ul.tab {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #f1f1f1;
        width: 444px;
        border-radius: 0 9px 0 0;
        text-align: center;
    }
    .task-tab .tabcontent {
        display: none;
        padding: 6px 12px;
        border-top: none;
    }
    .task-tab ul.tab li {
        float: left;
        width: 50%;
    }


    .memo {
        background-image: url('https://app.creditrepaircloud.com/application/images/memo1_new.png');
        width: 480px;
    }
    .assigncontactbg, .billing, .memo {
        background-repeat: no-repeat;
        padding-top: 10px;
    }
    .billing, .memo {
        height: 165px;
        margin-left: 10px;
        padding-left: 50px;
        float: left;
    }

    .pencil {
        background: url('https://app.creditrepaircloud.com/application/images/pencil_big.png') center no-repeat;
        width: 400px;
        height: 150px;
        float: left;
        margin-right: 10px;
        cursor: pointer;
        overflow: auto;
        font-size: 13px;
    }

    .invoice {
        background-image: url('https://app.creditrepaircloud.com/application/images/invoice_new.png');
        width: 480px;
        padding-top: 10px;
        float: left;
        margin: 10px 0 0 65px;
    }
    .invoice, .reminder {
        background-repeat: no-repeat;
        float: left;
        height: 165px;
        padding-left: 50px;
    }
    .boverdue {
        font-size: 12px;
        color: #000;
        padding-bottom: 10px;
    }
    .boverdue, .noinvoice, .positive, .removed, .update {
        font-weight: 700;
    }
    .balance {
        font-size: 12px;
        color: #666;
        width: 99%;
        height: 70px;
        overflow: auto;
    }
    .invoicetext {
        font-size: 13px;
        color: #0070c8;
        font-weight: 400;
        margin: 10px 0 0 50px;
        line-height: 27px;
    }

    .assigncontactbg {
        background-image: url('https://app.creditrepaircloud.com/application/images/contacts-bg.png');
        height: 265px;
        width: 1539px;
        margin-left: 12px;
        padding-left: 32px;
    }
    .assigncontactbg, .billing, .memo {
        background-repeat: no-repeat;
        padding-top: 10px;
    }



    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable({

        columnDefs: [{
            orderable: true,
            className: 'select-checkbox',
            targets: 0,
            checkboxes: {
                selectRow: true
            }
        }],
        select: {
            'style': 'multi'
        },
        order: [[1, 'asc']],
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });

    window.updateUserStatus = (id, status) => {
        $.get('<?php echo url('company/change_status') ?>/' + id, {
            status: status
        }, (data, status) => {
            if (data == 'done') {
                // code
            } else {
                alert('Unable to change Status ! Try Again');
            }
        })
    }

</script>