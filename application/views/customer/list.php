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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body" style="padding-bottom:0px;">
                            <div class="row align-items-center pt-3 bg-white">
                                <div class="col-md-12">
                                    <!-- Nav tabs -->
                                    <div class="banking-tab-container">
                                        <div class="rb-01">
                                            <ul class="nav nav-tabs border-0">
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab <?php if($cust_tab=='tab1' || $cust_tab==''){echo "active";} ?>" data-toggle="tab" href="#basic">Customer Manager</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab <?php if($cust_tab=='tab2'){echo "active";} ?>" data-toggle="tab" href="#advance">Customer Module Layout</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab <?php if($cust_tab=='tab3'){echo "active";} ?>" data-toggle="tab" href="#settings">Settings</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-4">
                                        <div class="tab-pane <?php if($cust_tab=='tab1' || $cust_tab==''){echo "active";}else{echo "fade";} ?> standard-accordion" id="basic">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="card card-mobile">
                                                        <div class="card-body">
                                                            <div class="col-sm-12">
                                                                <h6 class="page-title">Customers List</h6>
                                                            </div>
                                                            <div class="col-sm-6 col-md-12">
                                                                <div class="float-right d-md-block">
                                                                    <div class="dropdown">
                                                                        <form action="<?php echo base_url('customer/importItems'); ?>" method="post" enctype="multipart/form-data">
                                                                            <!--<input type="file" name="file" /> -->
                                                                            <button type="submit" class="btn btn-primary btn-md" name="importSubmit" id="importItemsInventory" ><span class="fa fa-download"></span> Import</button>
                                                                            <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-upload"></span> Export</button>
                                                                            <!--<a class="btn btn-primary btn-md" href="<?php echo base_url('/builder?form_id=28') ?>">
                                                                                <span class="fa fa-pencil"></span> &nbsp; Customize Form
                                                                            </a>-->
                                                                            <!--<a class="btn btn-primary btn-md" href="<?php echo base_url('customer/print') ?>">
                                                                                    <span class="fa fa-print "></span> Print
                                                                            </a>-->

                                                                            <a class="btn btn-primary btn-md"href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> Add Lead</a>
                                                                            <a class="btn btn-primary btn-md"
                                                                               href="<?php echo url('customer/add_advance') ?>"><span
                                                                                        class="fa fa-plus"></span> New Customer</a>
                                                                            <?php //endif ?>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <br><br><br>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                                                        <div id="status_sorting"  class=""></div>
                                                                        <table class="table table-hover"  id="customer_list_table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="100px">Name</th>
                                                                                    <th>City</th>
                                                                                    <th>State</th>
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
                                                                                <?php foreach ($profiles as $customer) : ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <a href="<?php echo url('/customer/index/tab3/'.$customer->prof_id).'/mt5'; ?>" style="color:#32243d;">
                                                                                                <?= ($customer) ? $customer->first_name.' '.$customer->last_name : ''; ?>
                                                                                            </a>
                                                                                        </td>
                                                                                        <td><?php echo ($customer) ? $customer->city : ''; ?></td>
                                                                                        <td><?php echo ($customer) ? $customer->state : ''; ?></td>
                                                                                        <td><?php echo $customer->lead_source; ?></td>
                                                                                        <td><?php echo $customer->email; ?></td>
                                                                                        <td><?php echo $customer->entered_by; ?></td>
                                                                                        <td><?php echo ($customer) ? $customer->FName. ' ' .$customer->LName : ''; ?></td>
                                                                                        <td><?php echo $customer->technician; ?></td>
                                                                                        <td><?php echo $customer->system_type; ?></td>
                                                                                        <td><?php echo $customer->mmr; ?></td>
                                                                                        <td><?php echo $customer->phone_h; ?></td>
                                                                                        <td><?php echo $customer->status; ?></td>
                                                                                        <td>
                                                                                            <a href="<?php echo url('/customer/add_advance/'.$customer->prof_id); ?>" style="text-decoration:none;display:inline-block;" title="Edit Customer">
                                                                                                <img src="/assets/img/customer/actions/ac_edit.png" width="16px" height="16px" border="0" title="Edit Customer">
                                                                                            </a>
                                                                                            <!--<a href="#"  style="text-decoration:none;display:inline-block;" id="<?php echo $customer->prof_id; ?>" title="Delete Customer" class="delete_cust">
                                                                                                <img src="https://app.creditrepaircloud.com/application/images/cross.png" width="16px" height="16px" border="0">
                                                                                            </a>-->
                                                                                            <a href="mailto:<?= $customer->email; ?>" style="text-decoration:none; display:inline-block;" >
                                                                                                <img src="/assets/img/customer/actions/ac_email.png" width="16px" height="16px" border="0" title="Email Customer">
                                                                                            </a>
                                                                                            <a href="#" style="text-decoration:none; display:inline-block;" >
                                                                                                <img src="/assets/img/customer/actions/ac_call.png" width="16px" height="16px" border="0" title="Call Customer">
                                                                                            </a>
                                                                                            <a href="#" style="text-decoration:none; display:inline-block;" >
                                                                                                <img src="/assets/img/customer/actions/ac_invoice.png" width="16px" height="16px" border="0" title="Invoice Customer">
                                                                                            </a>
                                                                                            <a href="#" style="text-decoration:none; display:inline-block;" >
                                                                                                <img src="/assets/img/customer/actions/ac_work.png" width="16px" height="16px" border="0" title="Create Work Order">
                                                                                            </a>
                                                                                            <a href="#" style="text-decoration:none; display:inline-block;" >
                                                                                                <img src="/assets/img/customer/actions/ac_ticket.png" width="16px" height="16px" border="0" title="Create Service Ticket">
                                                                                            </a>
                                                                                            <a href="#" style="text-decoration:none; display:inline-block;" >
                                                                                                <img src="/assets/img/customer/actions/ac_sched.png" width="16px" height="16px" border="0" title="Schedule">
                                                                                            </a>
                                                                                            <a href="#" style="text-decoration:none; display:inline-block;" >
                                                                                                <img src="/assets/img/customer/actions/ac_sms.png" width="16px" height="16px" border="0" title="Message Customer">
                                                                                            </a>
                                                                                            <!--<a href="<?php echo url('/customer/index/tab2/'.$customer->prof_id); ?>"  style="text-decoration:none; display:inline-block;">
                                                                                                <img src="https://app.creditrepaircloud.com/application/images/assign-contact.png" border="0" title="View Profile">
                                                                                            </a>-->
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php endforeach; ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <style>
                                                .btn{
                                                    font-size: 12px !important;
                                                }
                                            </style>
                                        </div>
                                        <div class="tab-pane <?php if($cust_tab=='tab2'){echo "active";}else{echo "fade";} ?> standard-accordion" id="advance">
                                            <div class="col-sm-12">
                                                <div class="float-right d-md-block">
                                                    <div class="dropdown">
                                                        <a class="btn btn-primary btn-md" href="#"><span class="fa fa-print"></span> Print</a>
                                                        <!--<a class="btn btn-primary btn-md" href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> New Lead</a>
                                                        <a class="btn btn-primary btn-md" href="<?php echo url('customer/add_advance') ?>"><span class="fa fa-plus"></span> New Customer</a>-->
                                                    </div>
                                                </div>
                                                <br/><br/><br/>
                                                <div class="col-md-12">

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
                                                                    if(!empty($modules[$x])){
                                                                        include viewPath('customer/adv_cust_modules/'.$modules[$x]);
                                                                    }
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
                                            </div>
                                        </div>

                                        <div class="tab-pane <?php if($cust_tab=='tab3'){echo "active";}else{echo "fade";} ?> standard-accordion" id="settings">
                                            <div class="banking-tab-container">
                                                <div class="rb-01">
                                                    <ul class="nav nav-tabs border-0">
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt2' || $minitab=='' ){echo "active";} ?>" data-toggle="tab" href="#widget1">Import/Audit</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt3'){echo "active";} ?>" data-toggle="tab" href="#widget2">Widget 2</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt4'){echo "active";} ?>" data-toggle="tab" href="#widget3">Widget 3</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt5'){echo "active";} ?>" data-toggle="tab" href="#profle">Profile</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt6'){echo "active";} ?>" data-toggle="tab" href="#educate">Educate</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt7'){echo "active";} ?>" data-toggle="tab" href="#messages">Messages</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt8'){echo "active";} ?>" data-toggle="tab" href="#notes">Internal Notes</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt9'){echo "active";} ?>" data-toggle="tab" href="#invoices">Invoices</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt10'){echo "active";} ?>" data-toggle="tab" href="#activity">Activity</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt11'){echo "active";} ?>" data-toggle="tab" href="#details">Detail Sheet</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt12'){echo "active";} ?>" data-toggle="tab" href="#custom">Customizable</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt13'){echo "active";} ?>" data-toggle="tab" href="#others">Others</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="tab-content mt-4" >
                                                <div class="tab-pane <?php if($minitab=='mt2' || $minitab=='' ){ echo "active";}else{echo "fade";} ?> <?php //if($minitab=='mt5'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="widget1">
                                                    <div class="card">
                                                        <div class="tab-pane active standard-accordion" id="widget1A">
                                                            <div class="banking-tab-container">
                                                                <div class="rb-01">
                                                                    <ul class="nav nav-tabs border-0">
                                                                        <li class="nav-item">
                                                                            <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#1">Import Credit Report</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#2">Simple Audit (credit analysis)</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="tab-content mt-4" >
                                                                <div class="tab-pane active standard-accordion" id="1">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="card">
                                                                                <div class="card-body hid-desk" style="padding-bottom:0px;" >
                                                                                    <div class="new-left" style="text-align: center !important;">
                                                                                        <div class="new-title" >Credit Report</div>
                                                                                        <p style="font-size: 14px;">Last imported 9 days ago</p>
                                                                                        <center><img class="new-left-img" src="https://app.creditrepaircloud.com/application/images/credit-report-done-img.png"></center>
                                                                                        <br>
                                                                                        <button class="btn btn-primary btn-md" id="btnsourcecode" value="Import Updated Credit Report" style="margin: 0 0 10px; width: 250px;">Reimport Credit Report</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="card">
                                                                                <div class="card-body hid-desk" style="padding-bottom:0px;" >
                                                                                    <div class="new-left">
                                                                                        <h6 style="display:inline-block;">Import Log</h6>
                                                                                        <div style="float: right; margin-top: 9px; font-size:16px;">Report provider: IdentityIQ</div>
                                                                                        <table id="import_audit" class="table table-bordered table-striped">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td width="50%" align="left" valign="middle" class="gridheader">Date imported </td>
                                                                                                <td width="50%" align="left" valign="middle" class="gridheader">Team member</td>
                                                                                            </tr>
                                                                                            <tr class="gridrow">
                                                                                                <td align="left" valign="middle"> Oct 09 2020 05:09 AM </td>
                                                                                                <td align="left" valign="middle">Tommy</td>
                                                                                            </tr>
                                                                                            <tr class="gridrow1">
                                                                                                <td align="left" valign="middle">Jul 15 2020 04:15 PM</td>
                                                                                                <td align="left" valign="middle">Tommy</td>
                                                                                            </tr>
                                                                                            <tr class="gridrow">
                                                                                                <td align="left" valign="middle">Feb 25 2020 03:42 PM</td>
                                                                                                <td align="left" valign="middle">Tommy</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <h6 class="new-title">Pending Report</h6>
                                                                                     </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-md-12">
                                                            <div id="tab-1" class="tab-content">

                                                                <div class="accordion" style="display: inline-block; width: 100%; margin: 30px 1% 10px;">
                                                                    <div class="accordion-head normaltext1 close">
                                                                        Having trouble with importing? <a href="javascript:void(0);">View importing help.</a><div class="arrow down"></div>
                                                                    </div>
                                                                    <div class="accordion-body" style="font-size: 12px !important; display: none;">
                                                                        <div class="content1">
                                                                            Import Online Credit Reports
                                                                            <span class="clientName"> (Eric Shepard) </span>                        </div>
                                                                        <div class="clear" style="height:10px;">
                                                                        </div>
                                                                        <div style="margin-left:10px; margin-right:10px;">
                                                                            <div align="center" class="normaltext1">
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tbody><tr>
                                                                                        <td width="70%" valign="top" align="left" style="padding-right:15px;">
                                                                                            <div class="chbox normaltext1" style="width:auto;">
                                                                                                Credit Report Import will only work with reports from these 5 providers. Practice it first with your <a href="https://app.creditrepaircloud.com/userdesk/index/MQ==">Sample Client</a> and <a href="https://app.creditrepaircloud.com/samples/samplereport" rel="nofollow" target="_blank">Sample Report</a> and NOT yourself or a live client.
                                                                                                We recommend becoming an <a href="https://app.creditrepaircloud.com/mycompany/credit_monitoring_service">affiliate with IdentityIQ and SmartCredit</a> so you can earn commissions and get  special links for your clients and to set up your client onboarding (<a href="http://support.creditrepaircloud.com/knowledge-base/using-identityiq-in-credit-repair-cloud/" target="_blank">a full guide is here</a>).  To import IdentityIQ, SmartCredit and our Sample Report no special plugins or extensions are required. But for PrivacyGuard and the others, there are extra steps and Chrome extensions to install first so that adds complication. Other providers not listed are NOT compatible and will not import.
                                                                                            </div>
                                                                                            <div class="clear" style="height:10px;">
                                                                                            </div>
                                                                                            <p style="margin-top:0px;"> <strong>Watch this video to learn about Importing from IdentityIQ or SmartCredit (they pay affiliates)</strong></p>
                                                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                <tbody><tr>
                                                                                                    <td width="30%" valign="top">
                                                                                                        <a class="vediopopup imgeffect2" href="https://www.youtube.com/embed/9nhn6aieFtc?wmode=transparent&amp;feature=oembed;autoplay=1;rel=0;autohide=1;">
                                                                                                            <div align="center" style="width:200px;height:119px;">
                                                                                                                <img src="https://app.creditrepaircloud.com/application/images/watch_video2.png" width="100%">
                                                                                                            </div>
                                                                                                        </a>
                                                                                                    </td>
                                                                                                    <td width="70%" valign="top" style="padding: 0 0 0 15px;">
                                                                                                        <p style="margin-top:0px">
                                                                                                            1. Become an affiliate, then follow the steps to set provider for or your CRC and in your client onboarding. <span class="normaltext1"><a href="http://support.creditrepaircloud.com/knowledge-base/using-identityiq-in-credit-repair-cloud/" target="_blank">Click here for all steps</a></span>.<br>
                                                                                                            2. Use Chrome or Firefox. No extensions or plugins are needed.<br>
                                                                                                            3. Open the client's report in the credit monitoring site.<br>
                                                                                                            4. Click the button to download the report.<br>
                                                                                                            5. Open the new report that you just downloaded to your computer<br>
                                                                                                            6. Right-click in that new report and view the source code <br>
                                                                                                            7. Copy and paste that source code into CRC (like in this video). <br>
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody></table>
                                                                                            <!--  <p class="normaltext1">*Remember: We're not affiliated with any report providers, so we cant assist you in their sites. Most of these services give instant 3-bureau reports and scores for a $1 trial. Remember, <u>you are not their customer</u>. These are <u>consumer services</u> and your clients should order their own reports. Most users have the client sign up and provide login details. *Important: Never import more than 1 time per client, <a id="vediopopup" href="https://www.youtube.com/embed/PUyONx6pMH4?wmode=transparent&feature=oembed;autoplay=1;rel=0;autohide=1;" >to update items later click here.</a>. </p>-->
                                                                                            <p style="margin-top:0px;"> <strong>Importing from PrivacyGuard and other providers listed (they do not have affiliates)</strong></p>
                                                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                <tbody><tr>
                                                                                                    <td width="30%" valign="top">
                                                                                                        <a class="vediopopup imgeffect2" href="https://www.youtube.com/embed/L0NK_mdc3zI?wmode=transparent&amp;feature=oembed;autoplay=1;rel=0;autohide=1;">
                                                                                                            <div align="center" style="width:200px;height:119px;">
                                                                                                                <img src="https://app.creditrepaircloud.com/application/images/watch_video.png" width="100%">
                                                                                                            </div>
                                                                                                        </a>
                                                                                                    </td>
                                                                                                    <td width="70%" valign="top" style="padding: 0 0 0 15px;">
                                                                                                        <p style="margin-top:0px">
                                                                                                            1. Use <a href="https://www.google.com/chrome/browser/" target="_blank">Google Chrome</a> and install <a href="https://chrome.google.com/webstore/detail/enable-right-click/hhojmcideegachlhfgfdhailpfhgknjm?hl=en-US" target="_blank">Enable Right Click Extension</a>.<br>
                                                                                                            2. Open the report in Chrome, then click "View Full Report."<br>
                                                                                                            3. Right-click in the middle of the report and choose "View Frame Source." <br>
                                                                                                            4. Highlight all frame source code (on Windows use Control + A). <br>
                                                                                                            5. Copy all frame source code (on Windows use Control + C). <br>
                                                                                                            6. Click "Import Code Now" and paste the code into the field (Control + V).<br>
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody></table>

                                                                                            <p class="chbox-blue normaltext1">
                                                                                                <img src="https://app.creditrepaircloud.com/application/images/blue_icon.png" width="30px" style="vertical-align:middle;margin-right: 5px">
                                                                                                Need to import a credit report from a non-supported provider or a PDF? <a target="_blank" href="https://www.creditrepaircloud.com/support/knowledge-base/importing-vs-manual/">Click here</a>.
                                                                                            </p>
                                                                                            <p style="margin:20px 0 0 0;">
                                                                                                <strong>IMPORTANT: </strong><br>
                                                                                            </p><ul style="padding:0 0 0 17px;line-height: 21px;">
                                                                                                <li>If you want to earn commissions, sign up with IdentityIQ and SmartCredit so you will get your special affiliate links (Visit MY COMPANY&gt;CREDIT MONITORING SERVICE for details and Steps.  And then be sure to and change settings in your MY COMPANY&gt;CLIENT PORTAL&gt;CLIENT ONBOARDING OPTIONS. <span class="normaltext1"><a target="_blank" href="http://support.creditrepaircloud.com/knowledge-base/using-identityiq-in-credit-repair-cloud/">Click here for a full guide.</a></span> </li>
                                                                                                <li> Never learn with a live client or live report. Learn first with your <a href="https://app.creditrepaircloud.com/userdesk/index/MQ==">Sample Client</a> and <a href="https://app.creditrepaircloud.com/samples/samplereport" rel="nofollow" target="_blank">Sample Report</a>. </li>
                                                                                                <li> Most credit monitoring services give 3-bureau reports and scores for a $1 trial. Remember, you are <u>not</u> their
                                                                                                    customer. These are <u>consumer</u> services and your clients should order <u>their own</u> reports. </li>
                                                                                                <li> Most credit repair companies have their client sign up and provide login details. How you handle this is between
                                                                                                    you and your client. We're not affiliated with report providers and we cannot assist you in their sites.</li>
                                                                                                <li> Never import more than <u>once</u> per client, to "update" items later <a class="vediopopup" href="https://www.youtube.com/embed/PUyONx6pMH4?wmode=transparent&amp;feature=oembed;autoplay=1;rel=0;autohide=1;">click here</a>. </li>
                                                                                            </ul>
                                                                                            <p></p>
                                                                                            <p style="margin:0px 0;">
                                                                                                <strong>Troubleshooting (common issues): </strong><br>
                                                                                            </p><ul style="padding:0 0 0 17px;line-height: 21px;">
                                                                                                <li>Not using our 5 listed providers. </li>
                                                                                                <li>Not using <a href="https://www.google.com/chrome/browser/" target="_blank">Google Chrome</a> and the <a href="https://chrome.google.com/webstore/detail/enable-right-click/hhojmcideegachlhfgfdhailpfhgknjm?hl=en-US" target="_blank">Enable Right Click Extension</a>.</li>
                                                                                                <li>Not clicking VIEW FULL REPORT" in the report.</li>
                                                                                                <li>Not copying the correct frame source code.</li>
                                                                                                <li>Not learning first with <a href="https://app.creditrepaircloud.com/userdesk/index/MQ==">Sample Client</a> and <a href="https://app.creditrepaircloud.com/samples/samplereport" rel="nofollow" target="_blank">Sample Report</a>.</li>
                                                                                            </ul>
                                                                                            <p></p>


                                                                                            <div id="auto_report_back_save" title="You have unsaved changes">
                                                                                                <p>Are you sure you want to leave this page without saving your credit report access details? </p>
                                                                                            </div>
                                                                                            <style type="text/css">
                                                                                                .ui-widget-overlay{
                                                                                                    width: 1210px;
                                                                                                    height: 1160px;
                                                                                                    z-index: 1001;
                                                                                                    background: rgb(0, 0, 0);
                                                                                                    opacity: 0.8;
                                                                                                }
                                                                                            </style>
                                                                                        </td>
                                                                                        <td valign="top" align="center" width="30%">
                                                                                            <style type="text/css">
                                                                                                .videolist img { opacity:0.7; width:40px; }
                                                                                                .videolist img:hover { opacity:1; }
                                                                                            </style>
                                                                                            <div style="width:auto; padding:20px 20px; background:#6dcff6; border-radius:5px; margin-top:0px;">
                                                                                                <h2 style="margin:0px;">Credit Import Resources</h2>
                                                                                                <div style="text-align:left;">
                                                                                                    <p><img src="https://app.creditrepaircloud.com/application/images/1_small.png" height="30" alt=" " style="vertical-align:middle;">You <u>must</u> use Google Chrome</p>
                                                                                                    <div style="padding-left:15px;">
                                                                                                        <a href="https://www.google.com/chrome/browser/" class="imgeffect1" target="_blank">
                                                                                                            <img src="https://app.creditrepaircloud.com/application/images/chrome_logo.png" alt=" " style="vertical-align:middle;"> </a>
                                                                                                    </div>
                                                                                                    <p><img src="https://app.creditrepaircloud.com/application/images/2_small.png" height="30" alt=" " style="vertical-align:middle;"> Install "Allow Right Click" Extension</p>
                                                                                                    <div style="padding-left:15px;">
                                                                                                        <a href="https://chrome.google.com/webstore/detail/enable-right-click/hhojmcideegachlhfgfdhailpfhgknjm?hl=en-USThis tool will import online reports from these 6 provide" target="_blank" class="imgeffect1">
                                                                                                            <img src="https://app.creditrepaircloud.com/application/images/add-right-click-sm.png">
                                                                                                        </a>
                                                                                                    </div>
                                                                                                    <p><img src="https://app.creditrepaircloud.com/application/images/3_small.png" height="30" alt=" " style="vertical-align:middle;"> Learn with Sample Client &amp; Report</p>
                                                                                                    <div style="padding-left:15px;">
                                                                                                        <a href="https://app.creditrepaircloud.com/samples/samplereport" rel="nofollow" target="_blank" class="imgeffect1">
                                                                                                            <img src="https://app.creditrepaircloud.com/application/images/sample_report.png" alt=" " style="vertical-align:middle;">
                                                                                                        </a>
                                                                                                    </div>
                                                                                                    <p><img src="https://app.creditrepaircloud.com/application/images/4.png" height="30" alt=" " style="vertical-align:middle;"> Need help? Schedule a session. </p></div><p></p>
                                                                                                <div style="padding-left:15px; text-align:left;">
                                                                                                    <a href="https://app.creditrepaircloud.com/expert" class="imgeffect1" style="background:url(https://app.creditrepaircloud.com/application/images/tifarrah_img_help_hover) no-repeat;"><img src="https://app.creditrepaircloud.com/application/images/issac_help.png" alt=" " style="vertical-align:middle;"></a>
                                                                                                </div>
                                                                                                <p style="text-align:left;margin-top: 30px;">
                                                                                                    <strong>On a Mac?</strong><br>
                                                                                                    Use "Command" instead of "Control".
                                                                                                    Highlight All = Command + A<br>
                                                                                                    Copy = Command + C<br>
                                                                                                    Paste = Command + V<br>
                                                                                                </p>
                                                                                                <p style="text-align:left;margin-top:20px;">
                                                                                                    <strong>Additional Right-Click Extensions:</strong><br>
                                                                                                    <a target="_blank" href="https://chrome.google.com/webstore/detail/enable-right-click/hhojmcideegachlhfgfdhailpfhgknjm">Enable Right Click for Chrome</a><br>
                                                                                                    <a target="_blank" href="https://chrome.google.com/webstore/detail/righttocopy/plmcimdddlobkphnofejmeidjblideca">Right to Copy for Chrome</a>
                                                                                                </p>
                                                                                                <p style="text-align:left;margin-top:20px;">
                                                                                                    <strong>Got a PDF or a different provider?</strong><br>
                                                                                                    <a target="_blank" href="https://www.creditrepaircloud.com/support/knowledge-base/importing-vs-manual/">Click here</a><br>
                                                                                                </p>
                                                                                            </div></td>
                                                                                    </tr>
                                                                                    </tbody></table>
                                                                                <p class="redfont" align="left">*We are not affiliated with any credit monitoring services and we do not provide support for their services. Your client is signing up to receive instant reports and scores, but you or the client must remember to cancel with that company before the end of the free trial if they do not want to be billed for credit monitoring services.
                                                                                </p>
                                                                            </div>
                                                                            <div class="tips" style="width:97%; border:#b4b4b4 solid 1px;">
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td width="5%" valign="top"><img src="https://app.creditrepaircloud.com/application/images/light_bulb.png" alt=" "></td>
                                                                                        <td width="95%" align="left" valign="middle" class="normaltext1">
                                                                                            We recommend that the client sign up for the credit monitoring services and give the login details to you. Then they will be responsible for their own service and
                                                                                            can cancel anytime they like. We recommend credit monitoring as the best way for the client to see the success of your work and monthly changes to the score.
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <br><br>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="rptacsbox" style="height:268px;margin:10px;">

                                                                    <form name="frm_report_access_detail" id="frm_report_access_detail" action="" method="post">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody><tr>
                                                                                <td width="70%" align="left" height="35"><strong>Client's credit report access details:</strong></td>
                                                                                <td align="right" height="40">
                                            <span class="normaltext1">
                                                <a id="edit_all_fields" href="javascript:void(0);" onclick="return edit_save_all_fields('edit');">Edit details</a>
                                            </span>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody></table>
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody><tr>
                                                                                <td width="30%" align="left" height="32">Report Provider:</td>
                                                                                <td width="70%" align="left">
                                                                                    <span class="report_provider_lbl">IdentityIQ</span>
                                                                                    <span class="report_provider_txt" style="display:none;">
                                                <input type="text" value="IdentityIQ" style="width: 187px;" name="report_provider_txt" id="report_provider_txt" class="input">
                                            </span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left" height="32">Username:</td>
                                                                                <td align="left">
                                                                                    <span class="username_lbl">ericshepard0102@gmail.com</span>
                                                                                    <span class="username_txt" style="display:none;">
                                                <input type="text" value="ericshepard0102@gmail.com" style="width: 187px;" name="username_txt" id="username_txt" class="input" onkeyup="checkForScript('username_txt')">
                                            </span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left" height="32">Password:</td>
                                                                                <td align="left">
                                                                                    <span class="password_lbl">Credit@2019</span>
                                                                                    <span class="password_txt" style="display:none;">
                                                <input type="text" value="Credit@2019" style="width: 160px; padding-right: 30px;" name="password_txt" id="password_txt" class="input" onkeyup="checkForScript('password_txt')">
                                                <i class="fa fa-eye" id="password_toggle" style="margin-left: -30px;cursor: pointer;" onclick="showPassword('password_txt','#password_toggle')"></i>
                                            </span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left" height="32">Phone Number: </td>
                                                                                <td align="left">
                                                                                    <span class="phonenumber_lbl">(903) 701-5632</span>
                                                                                    <span class="phonenumber_txt" style="display:none;">
                                                <input type="text" value="(903) 701-5632" name="phonenumber_txt" id="phonenumber_txt" class="input" style="width: 187px;" onkeyup="javascript:backspacerUP(this, event);" onkeydown="javascript:backspacerDOWN(this, event);">
                                            </span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left" height="32">Security Word: </td>
                                                                                <td align="left">
                                            <span class="securitywork_lbl">
                                                                                                                                                <table border="0" cellspacing="0" cellpadding="0" style="font-size:10px;">
                                                    <tbody><tr>
                                                                                                                <td align="center" style="font-size:15px;">&nbsp;5&nbsp;</td>
                                                                                                                <td align="center" style="font-size:15px;">&nbsp;2&nbsp;</td>
                                                                                                                <td align="center" style="font-size:15px;">&nbsp;6&nbsp;</td>
                                                                                                                <td align="center" style="font-size:15px;">&nbsp;3&nbsp;</td>
                                                                                                            </tr>
                                                    <tr>
                                                                                                                    <td align="center" style="background-color:#f6f6f6; border:#ddd solid 1px;">&nbsp;1&nbsp;</td>
                                                                                                                        <td align="center" style="background-color:#FFFFCC; border:#ddd solid 1px;">&nbsp;2&nbsp;</td>
                                                                                                                        <td align="center" style="background-color:#f6f6f6; border:#ddd solid 1px;">&nbsp;3&nbsp;</td>
                                                                                                                        <td align="center" style="background-color:#FFFFCC; border:#ddd solid 1px;">&nbsp;4&nbsp;</td>
                                                                                                                </tr>
                                                </tbody></table>
                                                                                            </span>
                                                                                    <!-- <span class="securitywork_lbl">CREDITREPORTS</span> -->
                                                                                    <span class="securitywork_txt" style="display:none;">
                                                <input type="text" value="5263" name="securitywork_txt" id="securitywork_txt" class="input" maxlength="20" style="width: 187px;">
                                            </span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left" height="32">Notes: </td>
                                                                                <td align="left">
                                                                                    <span class="note_lbl"></span>
                                                                                    <span class="note_txt" style="display:none;">
                                                <input type="text" value="" name="notes_txt" style="width: 187px;" id="notes_txt" class="input">
                                            </span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left" height="35"><strong> </strong></td>
                                                                                <td align="left" height="40">
                                           <span class="normaltext1">
                                       <input type="button" value="Save" id="save_all_fields" class="btnsubmit" href="javascript:void(0);" onclick="return edit_save_all_fields('save');" style="display:none;">
                                       &nbsp; &nbsp;
                                               <a id="cancel_all_fields" href="javascript:void(0);" onclick="return edit_save_all_fields('cancel');" style="display:none;">Cancel</a>
                                           </span>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody></table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="tab-pane <?php //if($minitab=='mt5'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="widget2">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Widget 2</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane <?php //if($minitab=='mt5'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="widget3">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Widget 3</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane <?php if($minitab=='mt5'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="profle">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <?php
                                                                include viewPath('customer/adv_cust_modules/settings_profile');
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if($minitab=='mt6'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="educate">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Educate</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if($minitab=='mt7'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="messages">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Messages</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if($minitab=='mt8'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="notes">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Internal Notes</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if($minitab=='mt9'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="invoices">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Invoices</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if($minitab=='mt10'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="activity">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Activity</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if($minitab=='mt11'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="details">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Detail Sheet</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if($minitab=='mt12'){ echo "active";} else{echo "fade";} ?> standard-accordion" id="custom">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Customizable</h6>
                                                            </div>
                                                            <?php if(isset($profile_info)) : ?>
                                                            <div class="col-md-12">
                                                                <div style="margin-right:15px; padding-top:1px;font-size: 12px !important;" align="left" class="normaltext1">
                                                                    <button type="button" class="btn btn-secondary more_custom" ><span class="fa fa-plus"></span> Add New </button>
                                                                </div>
                                                                <br>
                                                                 <form id="customizable_form">
                                                                    <table class="table table-hover table-bordered" id="custom_table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Field Name</th>
                                                                                <th>Field Value</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                                $custom_fields = json_decode( $profile_info->custom_fields);
                                                                                if (!empty($custom_fields)) {
                                                                                    foreach ($custom_fields as $key => $custom) {
                                                                                        ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <input type="text" class="form-control col-md-12" value="<?= !empty($custom->field_name) ? $custom->field_name : '' ; ?>" name="fieldname[]" id="fieldname" />
                                                                                                </td>
                                                                                                <td>
                                                                                                    <input type="text" class="form-control col-md-12" value="<?= !empty($custom->field_value) ? $custom->field_value : '' ; ?>" name="fieldvalue[]" id="fieldvalue" />
                                                                                                </td>
                                                                                                <td>
                                                                                                    <a href="javascript:void(0);" type="button" class="delete_custom"><span class="fa fa-trash-o"></span></a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                     <div class="modal-footer">
                                                                         <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save / Update</button>
                                                                     </div>
                                                                     <input type="hidden" class="form-control" value="<?php if(isset($profile_info)){ echo $profile_info->prof_id; } ?>" name="prof_id" id="prof_id" />
                                                                 </form>
                                                            </div>
                                                            <?php else :?>
                                                                <span>No customer selected. Go to Customer Manager and select one.</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if($minitab=='mt13'){ echo "active";}else{echo "fade";} ?> standard-accordion" id="others">
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
                                                                                <a href="" class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
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

<!-- Task Modal -->
<div class="modal fade" id="modal_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="task_form">
                <div class="modal-body">
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Task Type</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <select id="task_type" name="task_type" data-customer-source="dropdown" class="form-control" >
                                    <option value="General">General</option>
                                    <option value="Billing">Billing</option>
                                    <option value="Send Invoice">Send Invoice</option>
                                    <option value="Follow Up">Follow Up</option>
                                    <option value="Appointment">Appointment</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Subject</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Due Date</label>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control date_picker" name="due_date" id="due_date" />
                                    </div>
                                    <div class="col-md-6">
                                        <select id="due_time" name="due_time" class="form-control">
                                            <option value="00:00:00" selected="selected"></option>
                                            <option value="00:00:00">12:00 am</option>
                                            <option value="00:30:00">12:30 am</option>
                                            <option value="01:00:00">1:00 am</option>
                                            <option value="01:30:00">1:30 am</option>
                                            <option value="02:00:00">2:00 am</option>
                                            <option value="02:30:00">2:30 am</option>
                                            <option value="03:00:00">3:00 am</option>
                                            <option value="03:30:00">3:30 am</option>
                                            <option value="04:00:00">4:00 am</option>
                                            <option value="04:30:00">4:30 am</option>
                                            <option value="05:00:00">5:00 am</option>
                                            <option value="05:30:00">5:30 am</option>
                                            <option value="06:00:00">6:00 am</option>
                                            <option value="06:30:00">6:30 am</option>
                                            <option value="07:00:00">7:00 am</option>
                                            <option value="07:30:00">7:30 am</option>
                                            <option value="08:00:00">8:00 am</option>
                                            <option value="08:30:00">8:30 am</option>
                                            <option value="09:00:00">9:00 am</option>
                                            <option value="09:30:00">9:30 am</option>
                                            <option value="10:00:00">10:00 am</option>
                                            <option value="10:30:00">10:30 am</option>
                                            <option value="11:00:00">11:00 am</option>
                                            <option value="11:30:00">11:30 am</option>
                                            <option value="12:00:00">12:00 pm</option>
                                            <option value="12:30:00">12:30 pm</option>
                                            <option value="13:00:00">1:00 pm</option>
                                            <option value="13:30:00">1:30 pm</option>
                                            <option value="14:00:00">2:00 pm</option>
                                            <option value="14:30:00">2:30 pm</option>
                                            <option value="15:00:00">3:00 pm</option>
                                            <option value="15:30:00">3:30 pm</option>
                                            <option value="16:00:00">4:00 pm</option>
                                            <option value="16:30:00">4:30 pm</option>
                                            <option value="17:00:00">5:00 pm</option>
                                            <option value="17:30:00">5:30 pm</option>
                                            <option value="18:00:00">6:00 pm</option>
                                            <option value="18:30:00">6:30 pm</option>
                                            <option value="19:00:00">7:00 pm</option>
                                            <option value="19:30:00">7:30 pm</option>
                                            <option value="20:00:00">8:00 pm</option>
                                            <option value="20:30:00">8:30 pm</option>
                                            <option value="21:00:00">9:00 pm</option>
                                            <option value="21:30:00">9:30 pm</option>
                                            <option value="22:00:00">10:00 pm</option>
                                            <option value="22:30:00">10:30 pm</option>
                                            <option value="23:00:00">11:00 pm</option>
                                            <option value="23:30:00">11:30 pm</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Client</label>
                            </div>
                            <div class="col-md-8">
                                <?= isset($profile_info) ? $profile_info->first_name.' '.$profile_info->last_name : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Assign to: <span class="required"> *</span></label>
                            </div>
                            <div class="col-md-8">
                                <select id="assign_to" name="assign_to"  class="form-control" required>
                                    <option value="">Select</option>.l
                                    <?php foreach ($users as $user): ?>
                                        <option <?php if(isset($office_info)){ echo $office_info->assign_to ==  $user->id ? 'selected' : ''; } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Notes: </label>
                            </div>
                            <div class="col-md-8">
                                <textarea type="text" class="form-controls" name="notes" id="notes" cols="40" rows="5"> </textarea>
                        </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="fk_prof_id" id="fk_prof_id" value="<?= isset($profile_info) ? $profile_info->prof_id : '' ?>" />
                <input type="hidden" class="form-control" name="task_id" id="task_id" />
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/adv_cust/js_list'); ?>
<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 450px; }
    #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 100px; height: 90px; font-size: 4em; text-align: center; }

    .alarm_label, .alarm_answer{
        font-size: 12px !important;
    }
</style>

<script>
    $(document).ready(function() {

        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        $('.date_picker').val(new Date().toLocaleDateString());

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


    });




</script>
