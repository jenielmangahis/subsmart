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
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if($minitab=='mt2' || $minitab=='' ){echo "active";} ?>" data-toggle="tab" href="#widget1">Widget 1</a>
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
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Widget 1</h6>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div id="tab-1" class="tab-content">
                                                                <div class="new-left">
                                                                    <div class="new-title">Credit Report</div>
                                                                    <p style="font-size: 14px;">Last imported 9 days ago</p>
                                                                    <img class="new-left-img" src="https://app.creditrepaircloud.com/application/images/credit-report-done-img.png">
                                                                    <button class="btnsubmit" onclick="auto_backbutton();" id="btnsourcecode" value="Import Updated Credit Report" style="margin: 0 0 10px; width: 250px;">Reimport Credit Report</button>
                                                                </div>
                                                                <div class="new-right">
                                                                    <div class="new-title" style="display:inline-block;">Import Log</div>
                                                                    <div style="float: right; margin-top: 9px; font-size:16px;">Report provider: IdentityIQ</div>
                                                                    <div class="gridtable1" style="margin:10px 0 30px">
                                                                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #c6d1d3;">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td width="50%" align="left" valign="middle" class="gridheader">Date imported </td>
                                                                                <td width="50%" align="left" valign="middle" class="gridheader">Team member</td>
                                                                            </tr>
                                                                            <tr class="gridrow">
                                                                                <td align="left" valign="middle">
                                                                                    Oct 09 2020 05:09 AM                                                </td>
                                                                                <td align="left" valign="middle">
                                                                                    Tommy                                                </td>
                                                                            </tr>
                                                                            <tr class="gridrow1">
                                                                                <td align="left" valign="middle">
                                                                                    Jul 15 2020 04:15 PM                                                </td>
                                                                                <td align="left" valign="middle">
                                                                                    Tommy                                                </td>
                                                                            </tr>
                                                                            <tr class="gridrow">
                                                                                <td align="left" valign="middle">
                                                                                    Feb 25 2020 03:42 PM                                                </td>
                                                                                <td align="left" valign="middle">
                                                                                    Tommy                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="new-title">Pending Report</div>


                                                                    <!--                            <input type="button" name="button" id="button" value="Review Pending Report" onclick="window.location='https://app.creditrepaircloud.com/importcreditreport/preview_credit_report_iiq/NTM=/p'" class="btngreen" style="width: 100%;margin-top:10px;">-->

                                                                </div>

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

                                                                                            <script type="text/javascript">
                                                                                                /**
                                                                                                 &nbsp;&nbsp;* @desc   -   this function is used to convert the htmlentities to the html tags or special characters
                                                                                                 &nbsp;&nbsp;* @param  -   input
                                                                                                 &nbsp;&nbsp;* @return -   it passes html tags and special characters
                                                                                                 */
                                                                                                function htmlDecode(input){
                                                                                                    if(input=='')
                                                                                                        return '';
                                                                                                    var e = document.createElement('div');
                                                                                                    e.innerHTML = input;
                                                                                                    return e.childNodes[0].nodeValue;
                                                                                                }
                                                                                                try {
                                                                                                    var imported_report_providerdata=   '';
                                                                                                    var dataforajax                 =   '';
                                                                                                    var flag_check_reportprovider   =   0;
                                                                                                    var flag_for_report_auth        =   0;
                                                                                                    var check_reportproviderdata_changes=0;// flag to check the report provider data done,1-need to update ,0-update done or no changes
                                                                                                    var current_client_id           =   $("#current_client_id").val();
                                                                                                    var old_report_provider_txt     =   "IdentityIQ";
                                                                                                    old_report_provider_txt         =   old_report_provider_txt.replace(/[^a-z\s]/gi, '').replace(/[_\s]/g, '').toLowerCase();
                                                                                                    var old_username_txt            =   htmlDecode("ericshepard0102@gmail.com");
                                                                                                    var old_password_txt            =   htmlDecode("Credit@2019");
                                                                                                    var old_securitywork_txt        =   "5263";
                                                                                                    var old_phonenumber_txt         =   "(903) 701-5632";
                                                                                                    var old_notes_txt               =   htmlDecode("");
                                                                                                    var vcr_securityword_question   =   "";
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc   -   PrivacyGuard auth submission, while importing report if any additional authentication required then the function will help
                                                                                                     &nbsp;&nbsp;* @param  -   clickbuttonid
                                                                                                     &nbsp;&nbsp;* @return -   it will click the user previous choice
                                                                                                     */
                                                                                                    function privacyguradauthclick(clickbuttonid){
                                                                                                        flag_for_report_auth=1;
                                                                                                        document.getElementById(clickbuttonid).click();
                                                                                                    }

                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc   -   for the user understanding purpose we are pulling sample report
                                                                                                     &nbsp;&nbsp;* @param  -   clickedbuttonid,reportaccessdetailflag,dataforajax,sampletryflag
                                                                                                     &nbsp;&nbsp;* @return -   pull the sample report
                                                                                                     */
                                                                                                    function samplereportprocessing(clickedbuttonid=null,reportaccessdetailflag=null,dataforajax=null,sampletryflag=null){
                                                                                                        $('.manualreportimport').hide();
                                                                                                        $('#autoreportimport').hide();
                                                                                                        $('#reportimport').hide();
                                                                                                        $('#auto_import_run').show();
                                                                                                        $('#auto_deatils_found').hide();
                                                                                                        $('#auto_status_icon1').html('<i class="fa fa-spinner fa-pulse fa-2x"></i>');
                                                                                                        $('#auto_status_icon2').html('');
                                                                                                        $('#auto_status_icon3').html('');
                                                                                                        setTimeout(function(){
                                                                                                            $('#auto_status_icon1').html('<i class="fa fa-check fa-2x"></i>');
                                                                                                            $('#auto_status_icon2').html('<i class="fa fa-spinner fa-pulse fa-2x"></i>');
                                                                                                            setTimeout(function(){
                                                                                                                $('#auto_status_icon2').html('<i class="fa fa-check fa-2x"></i>');
                                                                                                                $('#auto_status_icon3').html('<i class="fa fa-spinner fa-pulse fa-2x"></i>');
                                                                                                                setTimeout(function(){
                                                                                                                    $('#auto_status_icon3').html('<i class="fa fa-check fa-2x"></i>');
                                                                                                                    if(sampletryflag!=null){
                                                                                                                        addDatatoSourceText(clickedbuttonid,reportaccessdetailflag,dataforajax);
                                                                                                                    }else{
                                                                                                                        $.ajax({
                                                                                                                            url: base_url()+'samples/sampleframetab',
                                                                                                                            type: 'POST',
                                                                                                                            dataType : 'html',
                                                                                                                            success: function(data) {
                                                                                                                                $('#sourceprovider').val('samplereport');
                                                                                                                                if(document.getElementById("reportprovider_sr"))
                                                                                                                                    document.getElementById("reportprovider_sr").remove();

                                                                                                                                $("textarea#sourcecodearea").val(data);
                                                                                                                                $('#reportprovider_privacyguard').val('Sample Report');
                                                                                                                                $('#reportprovider_privacyguard').attr('id','reportprovider_sr');
                                                                                                                                $("#reportprovider_sr").attr('checked',true);
                                                                                                                                $("#reportprovider_sr").attr('disabled',false);
                                                                                                                                $("#ajax_loader_new").show();
                                                                                                                                if(clickedbuttonid=='auto_btnsubmit_with_pending' || clickedbuttonid=='auto1_btnsubmit_with_pending')
                                                                                                                                {
                                                                                                                                    document.getElementById('btnsubmit_with_pending').click();
                                                                                                                                }else if(clickedbuttonid=='auto_btnsubmit_without_pending' || clickedbuttonid=='auto1_btnsubmit_without_pending')
                                                                                                                                {
                                                                                                                                    document.getElementById('btnsubmit_without_pending').click();
                                                                                                                                }
                                                                                                                            }
                                                                                                                        });
                                                                                                                    }
                                                                                                                }, 3000);
                                                                                                            }, 3000);
                                                                                                        }, 3000);
                                                                                                    }
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc if this dot trigger if there is any change in report then it will save and process with the report submit
                                                                                                     &nbsp;&nbsp;* @param  clickedbuttonid, reportaccessdetailflag,dataforajax,auto_selprovider,sampletryflag
                                                                                                     &nbsp;&nbsp;* @return - submit the report and return the report details
                                                                                                     */
                                                                                                    function addDatatoSourceText(clickedbuttonid,reportaccessdetailflag,dataforajax,sampletryflag){

                                                                                                        // after getting report data this function will trigger
                                                                                                        $("textarea#sourcecodearea").val(imported_report_providerdata);
                                                                                                        if(sampletryflag!=null){
                                                                                                            samplereportprocessing(clickedbuttonid,reportaccessdetailflag,dataforajax,sampletryflag);
                                                                                                            return false;
                                                                                                        }
                                                                                                        if(clickedbuttonid=='auto_btnsubmit_with_pending' || clickedbuttonid=='auto1_btnsubmit_with_pending')
                                                                                                        {
                                                                                                            if($.trim($("textarea#sourcecodearea").val())==''){
                                                                                                                auto_errormsg("Unable to load the Page! Please try again",'','',1);

                                                                                                            }else{
                                                                                                                if(reportaccessdetailflag==1){
                                                                                                                    $.ajax({
                                                                                                                        url: base_url()+'importcreditreport/save_report_access_details',
                                                                                                                        data: dataforajax,
                                                                                                                        type: 'POST',
                                                                                                                        success: function(data) {
                                                                                                                            document.getElementById('btnsubmit_with_pending').click();
                                                                                                                        }
                                                                                                                    });
                                                                                                                }else{
                                                                                                                    document.getElementById('btnsubmit_with_pending').click();
                                                                                                                }
                                                                                                            }
                                                                                                        }else if(clickedbuttonid=='auto_btnsubmit_without_pending' || clickedbuttonid=='auto1_btnsubmit_without_pending')
                                                                                                        {
                                                                                                            if($.trim($("textarea#sourcecodearea").val())==''){
                                                                                                                auto_errormsg("Unable to load the Page! Please try again",'','',1);
                                                                                                            }else{
                                                                                                                if(reportaccessdetailflag== 1){
                                                                                                                    $.ajax({
                                                                                                                        url: base_url()+'importcreditreport/save_report_access_details',
                                                                                                                        data: dataforajax,
                                                                                                                        type: 'POST',
                                                                                                                        success: function(data) {
                                                                                                                            document.getElementById('btnsubmit_without_pending').click();
                                                                                                                        }
                                                                                                                    });
                                                                                                                }else{
                                                                                                                    document.getElementById('btnsubmit_without_pending').click();
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc   - if the user enters the credit report details while the user click back or close button then this function will prompt the user to save the data to leave.
                                                                                                     &nbsp;&nbsp;* @param  - NULL
                                                                                                     &nbsp;&nbsp;* @return - NULL
                                                                                                     */
                                                                                                    function save_dailougebox(){
                                                                                                        $( "#auto_report_back_save" ).dialog({
                                                                                                            resizable: false,
                                                                                                            height: "auto",
                                                                                                            width: 400,
                                                                                                            modal: true,
                                                                                                            buttons: {
                                                                                                                "SAVE MY DATA": function() {
                                                                                                                    old_report_provider_txt =   $.trim($('#auto_selprovider').val());
                                                                                                                    old_username_txt        =   $.trim($('#auto_vcr_username').val());
                                                                                                                    old_password_txt        =   $.trim($('#auto_vcr_password').val());
                                                                                                                    old_securitywork_txt    =   $.trim($('#auto_vcr_securityword').val());
                                                                                                                    old_phonenumber_txt     =   $.trim($('#auto_vcr_phonenumber').val());
                                                                                                                    old_notes_txt           =   $.trim($('#auto_vcr_note').val());
                                                                                                                    if(old_report_provider_txt!='')
                                                                                                                        var auto_selprovider_txt=   document.getElementById("auto_selprovider").options[document.getElementById("auto_selprovider").selectedIndex].text;
                                                                                                                    else
                                                                                                                        var auto_selprovider_txt=  '';
                                                                                                                    $(".report_provider_lbl").html(auto_selprovider_txt);
                                                                                                                    $("#report_provider_txt").val(auto_selprovider_txt);
                                                                                                                    $(".username_lbl").html(old_username_txt);
                                                                                                                    $("#username_txt").val(old_username_txt);
                                                                                                                    $(".password_lbl").html(old_password_txt);
                                                                                                                    $("#password_txt").val(old_password_txt);
                                                                                                                    $(".phonenumber_lbl").html(old_phonenumber_txt);
                                                                                                                    $("#phonenumber_txt").val(old_phonenumber_txt);
                                                                                                                    $(".securitywork_lbl").html(old_securitywork_txt);
                                                                                                                    $("#securitywork_txt").val(old_securitywork_txt);
                                                                                                                    $(".note_lbl").html(old_notes_txt);
                                                                                                                    $("#notes_txt").val(old_notes_txt);
                                                                                                                    var securitywork_html='<table border="0" cellspacing="0" cellpadding="0" style="font-size:10px;"><tbody><tr>';
                                                                                                                    for (var i = 0; i < old_securitywork_txt.length; i++) {
                                                                                                                        securitywork_html+=' <td align="center" style="font-size:15px;">&nbsp;'+old_securitywork_txt.charAt(i)+'&nbsp;</td>   ';
                                                                                                                    }
                                                                                                                    securitywork_html+='</tr><tr>';
                                                                                                                    var count=1;
                                                                                                                    for (var i = 0; i < old_securitywork_txt.length; i++) {
                                                                                                                        if ((i % 2) == 0)
                                                                                                                            securitywork_html+='<td align="center" style="background-color:#f6f6f6; border:#ddd solid 1px;">&nbsp;'+count+'&nbsp;</td> ';
                                                                                                                        else
                                                                                                                            securitywork_html+='<td align="center" style="background-color:#FFFFCC; border:#ddd solid 1px;">&nbsp;'+count+'&nbsp;</td> ';
                                                                                                                        count++;
                                                                                                                    }
                                                                                                                    securitywork_html+='</tr></tbody></table>';
                                                                                                                    $(".securitywork_lbl").html(securitywork_html);
                                                                                                                    dataforajax     =   "report_provider_txt="+auto_selprovider_txt+"&username_txt="+encodeURIComponent(old_username_txt)+"&password_txt="+encodeURIComponent(old_password_txt)+"&securitywork_txt="+encodeURIComponent(old_securitywork_txt)+"&phonenumber_txt="+old_phonenumber_txt+"&notes_txt="+encodeURIComponent(old_notes_txt)+"&current_client_id="+current_client_id;
                                                                                                                    $.ajax({
                                                                                                                        url: base_url()+'importcreditreport/save_report_access_details',
                                                                                                                        data: dataforajax,
                                                                                                                        type: 'POST',
                                                                                                                        success: function(data) {
                                                                                                                            check_reportproviderdata_changes=0;
                                                                                                                            $("#auto_report_back_save").dialog( "close" );
                                                                                                                            auto_backbutton();
                                                                                                                        }
                                                                                                                    });
                                                                                                                },
                                                                                                                "DO NOT SAVE": function() {
                                                                                                                    check_reportproviderdata_changes=0;
                                                                                                                    $( this ).dialog( "close" );
                                                                                                                    auto_backbutton();
                                                                                                                }
                                                                                                            },
                                                                                                            position:['auto', 100],
                                                                                                            open: function() { $(this).closest('.ui-dialog').find('.ui-dialog-buttonpane button:eq(0)').focus();
                                                                                                                $(this).closest('.ui-dialog').find('.ui-dialog-buttonpane button:eq(1)').css('border','1px solid');
                                                                                                                $(this).closest('.ui-dialog').find('.ui-dialog-buttonpane button:eq(0)').css('border','1px solid');
                                                                                                                $("#ui-dialog-title-auto_report_back_save+.ui-dialog-titlebar-close").hide();
                                                                                                            }
                                                                                                        });
                                                                                                    }
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc if the user click the back button then this function trigger ,if the report was already imported then the report provider  is not avaiable in auto report import then it will show the old flow
                                                                                                     &nbsp;&nbsp;* @return - return to the old state as the back button
                                                                                                     */
                                                                                                    function auto_backbutton(){
                                                                                                        if(check_reportproviderdata_changes==1){
                                                                                                            save_dailougebox();
                                                                                                            return true;
                                                                                                        }
                                                                                                        $("#sourcecodebox").css('height','auto');
                                                                                                        $('#auto_error_div').hide();
                                                                                                        $('#auto_error_solve_div').hide();
                                                                                                        if($('#auto_import_run').css('display') == 'block')
                                                                                                        {
                                                                                                            $('#auto_import_run').show();
                                                                                                        }else{
                                                                                                            var get_previous_provider   =   'IdentityIQ';
                                                                                                            if(!(get_previous_provider=='IdentityIQ' || get_previous_provider=='SmartCredit' || get_previous_provider=='IdentityClub'  || get_previous_provider=='MyFreeScoreNow' || get_previous_provider=='PrivacyGuard' || get_previous_provider=='' || get_previous_provider=='Sample Report')){
                                                                                                                //if old report provider not there in automation process then directly load old flow
                                                                                                                $('#imp_crd_rpt .back-btn').hide();
                                                                                                                $('.manualreportimport').show();
                                                                                                                $('#autoreportimport').hide();
                                                                                                                $('#auto_error').hide();
                                                                                                                $('#auto_import_run').hide();
                                                                                                                $('#reportimport').hide();
                                                                                                                $('#auto_deatils_found').hide();
                                                                                                            }else{
                                                                                                                $('.manualreportimport').hide();
                                                                                                                $('#autoreportimport').hide();
                                                                                                                $('#auto_error').hide();
                                                                                                                $('#auto_import_run').hide();
                                                                                                                $('#reportimport').show();
                                                                                                                $('#auto_deatils_found').hide();
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    $(document).ready(function () {
                                                                                                        /**
                                                                                                         &nbsp;&nbsp;* @desc   - if the user Done any changes in the Credit Monitoring Access Details then flag was updated
                                                                                                         &nbsp;&nbsp;* @param  - null
                                                                                                         &nbsp;&nbsp;* @return - null
                                                                                                         */
                                                                                                        $('#auto_selprovider,#auto_vcr_username,#auto_vcr_password,#auto_vcr_securityword,#auto_vcr_phonenumber,#auto_vcr_note').on('change', function() {
                                                                                                            check_reportproviderdata_changes=1;
                                                                                                            var change_id=$(this).attr("id");
                                                                                                            if(change_id="auto_selprovider")
                                                                                                                flag_check_reportprovider=1;
                                                                                                        });
                                                                                                        $('#auto_selprovider').val(old_report_provider_txt);
                                                                                                        $( "#source_file_place" ).before( '<br><div class="back-btn" id="auto_backbuttontext" style="float:left; margin-top:-10px;" onclick="auto_backbutton();"> <a>Back</a></div>' );
                                                                                                    });
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc   - if the user click the "NEW Auto Import button " then this function will check if there is report provider details avaiable if avaiable it will display the "Client Credit Monitoring Details Found" page else it will show "Enter & Confirm Credit Monitoring Access Details" and if the provider name was not found for auto import then it will show then text "Previously noted for this client as"
                                                                                                     &nbsp;&nbsp;* @param  - null
                                                                                                     &nbsp;&nbsp;* @return - null
                                                                                                     */
                                                                                                    function auto_import_fun(){
                                                                                                        var auto_selprovider        =   old_report_provider_txt;
                                                                                                        var get_previous_provider   =   "IdentityIQ";
                                                                                                        if(get_previous_provider!='')
                                                                                                            auto_selprovider        =   get_previous_provider.replace(/[^a-z\s]/gi, '').replace(/[_\s]/g, '').toLowerCase();
                                                                                                        auto_selprovider            =   $('#auto_selprovider').val(auto_selprovider);
                                                                                                        auto_selprovider            =   $('#auto_selprovider').val();
                                                                                                        autoselprovider(auto_selprovider);
                                                                                                        if(auto_selprovider==''  || auto_vcr_username==''  || auto_vcr_password==''){
                                                                                                            // if service provider ,username,password empty
                                                                                                            $('#auto_import_run').hide();
                                                                                                            $('#autoreportimport').show();
                                                                                                            $('#auto_error').hide();
                                                                                                            $('#auto_deatils_found').hide();
                                                                                                            $('#reportimport').hide();
                                                                                                        }else if(auto_vcr_securityword=='' && ( auto_selprovider=='identityiq' ||  auto_selprovider=='privacyguard')){
                                                                                                            $('#auto_import_run').hide();
                                                                                                            $('#autoreportimport').show();
                                                                                                            $('#auto_error').hide();
                                                                                                            $('#auto_deatils_found').hide();
                                                                                                            $('#reportimport').hide();
                                                                                                        }else{
                                                                                                            // if all data are enter then "Client Credit Monitoring Details Found" page will display
                                                                                                            $('#auto_deatils_found').show();
                                                                                                            $('#reportimport').hide();
                                                                                                            $('#auto_error').hide();
                                                                                                            $('#reportimport').hide();
                                                                                                        }
                                                                                                    }
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc   - When user choose manual process this event will trigger
                                                                                                     &nbsp;* @param  - null
                                                                                                     &nbsp;&nbsp;* @return - null
                                                                                                     */
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc   - this function will trigger click event in the back end for the radio button which was old process
                                                                                                     &nbsp;* @param  - report provider name
                                                                                                     &nbsp;&nbsp;* @return - reurn the click
                                                                                                     */
                                                                                                    function autoselprovider(value){


                                                                                                        if(value=='smartcredit')
                                                                                                        {
                                                                                                            $('.provider-url').html('<a class="provider-url" href="https://www.smartcredit.com/login/" target="_blank"> SmartCredit.com</a>');
                                                                                                        }
                                                                                                        if(value=='identityclub')
                                                                                                        {
                                                                                                            $('.provider-url').html('<a class="provider-url" href="https://members.identityclub.com/login/" target="_blank"> IdentityClub.com</a>');
                                                                                                        }
                                                                                                        if(value=='myfreescorenow')
                                                                                                        {
                                                                                                            $('.provider-url').html('<a class="provider-url" href="https://member.myfreescorenow.com/login/" target="_blank"> MyFreeScoreNow.com</a>');
                                                                                                        }
                                                                                                        if(value=='samplereport')
                                                                                                        {
                                                                                                            $('#auto_error_solve_div').hide(); $('#auto_error_div').hide();
                                                                                                        }

                                                                                                        if(value=='privacyguard'){
                                                                                                            $('.provider-url').html('<a class="provider-url" href="https://www.privacyguard.com/secure/Signin.aspx" target="_blank"> PrivacyGuard.com</a>');
                                                                                                            $('#auto_securityword_label').text("Last 4 Digits of Social Security #");
                                                                                                            $('#auto_vcr_securityword').attr("maxlength",'4');
                                                                                                        }else if(value=='identityiq'){
                                                                                                            $('.provider-url').html('<a class="provider-url" href="https://www.identityiq.com/login.aspx" target="_blank"> IdentityIQ.com</a>');
                                                                                                            if($.trim(vcr_securityword_question)!='')
                                                                                                                $('#auto_securityword_label').text(vcr_securityword_question);
                                                                                                            else
                                                                                                                $('#auto_securityword_label').text("Last four digits of SSN");
                                                                                                            $('#auto_vcr_securityword').attr("maxlength",'20');
                                                                                                        }else{
                                                                                                            $('#auto_securityword_label').text("Security Word");
                                                                                                            $('#auto_vcr_securityword').attr("maxlength",'20');
                                                                                                        }
                                                                                                        if(value=='smartcredit' || value=='identityclub' || value=='myfreescorenow'){
                                                                                                            $('#auto_email_label').text("Email");
                                                                                                        }
                                                                                                        else{
                                                                                                            $('#auto_email_label').text("Username");
                                                                                                        }
                                                                                                        if(value=='samplereport'){
                                                                                                            $('#auto_vcr_username').val('Sample Report');
                                                                                                            $('#auto_vcr_password').val('Sample Report');
                                                                                                            $('#auto_vcr_securityword').val('Sample Report');
                                                                                                            $('#auto_vcr_phonenumber').val('Sample Report');
                                                                                                            $('#auto_vcr_note').val('Sample Report');
                                                                                                            $("#auto_vcr_username").attr("disabled", true);
                                                                                                            $('#auto_vcr_password').attr("disabled", true);
                                                                                                            $('#auto_vcr_securityword').attr("disabled", true);
                                                                                                            $('#auto_vcr_phonenumber').attr("disabled", true);
                                                                                                            $('#auto_vcr_note').attr("disabled", true);
                                                                                                            var reportproviderradio= document.getElementsByName('reportprovider');
                                                                                                            var n;
                                                                                                            for (n = 0; n < reportproviderradio.length; n++){
                                                                                                                if ('privacyguard'==reportproviderradio[n].value)
                                                                                                                {
                                                                                                                    $('#previously_note_text').hide();
                                                                                                                    document.getElementById(reportproviderradio[n].id).click();
                                                                                                                }
                                                                                                            }
                                                                                                        }else{
                                                                                                            $('#auto_vcr_username, #auto_vcr_password, #auto_vcr_securityword, #auto_vcr_phonenumber, #auto_vcr_note').val('');

                                                                                                            if(check_reportproviderdata_changes==0){
                                                                                                                $('#auto_vcr_username').val(old_username_txt);
                                                                                                                $('#auto_vcr_password').val(old_password_txt);
                                                                                                                $('#auto_vcr_securityword').val(old_securitywork_txt);
                                                                                                                $('#auto_vcr_phonenumber').val(old_phonenumber_txt);
                                                                                                                $('#auto_vcr_note').val(old_notes_txt);
                                                                                                            }
                                                                                                            $("#auto_vcr_username").attr("disabled", false );
                                                                                                            $('#auto_vcr_password').attr("disabled", false );
                                                                                                            if(value=='myfreescorenow'|| value=='smartcredit')
                                                                                                                $('#auto_vcr_securityword').attr("disabled", true );
                                                                                                            else
                                                                                                                $('#auto_vcr_securityword').attr("disabled", false );
                                                                                                            $('#auto_vcr_phonenumber').attr("disabled", false );
                                                                                                            $('#auto_vcr_note').attr("disabled", false );
                                                                                                            var reportproviderradio= document.getElementsByName('reportprovider');
                                                                                                            var n;
                                                                                                            for (n = 0; n < reportproviderradio.length; n++){
                                                                                                                if (value==reportproviderradio[n].value)
                                                                                                                {
                                                                                                                    $('#previously_note_text').hide();
                                                                                                                    document.getElementById(reportproviderradio[n].id).click();
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc   - To hide and update the video for auto report import
                                                                                                     * @param  - null
                                                                                                     &nbsp;&nbsp;* @return - reurn the click
                                                                                                     */
                                                                                                    function auto_report_videohide() {
                                                                                                        $(".top-video").hide();
                                                                                                        $('.watch-text').show();
                                                                                                        $.ajax({
                                                                                                            url: base_url()+'home/update_cro_controls/auto_report_import_video/1',
                                                                                                            type: 'POST',
                                                                                                        });
                                                                                                    }
                                                                                                }catch(err) {
                                                                                                    auto_errormsg("Something went wrong Please try after some time");
                                                                                                }
                                                                                                /**
                                                                                                 &nbsp;&nbsp;* @desc   - this function will handle the error message in the report import
                                                                                                 * @param  - auto_error_msg-error message which was display in the 1st line ,auto_error_msg-error1 message which was display in the 2st line max of the time it will trigger null and oneClickMsg use for credit monitoring access in show one click solve message show
                                                                                                 &nbsp;&nbsp;* @return - reurn the click
                                                                                                 */
                                                                                                function auto_errormsg(auto_error_msg,auto_error_msg1='',stringWithQuotation='',oneClickMsg=''){
                                                                                                    $('#auto_import_run').hide();
                                                                                                    $('#autoreportimport').show();
                                                                                                    $('#auto_error_div').show();
                                                                                                    $('#auto_deatils_found').hide();

                                                                                                    if(stringWithQuotation==1)
                                                                                                        auto_error_msg='<p style="font-weight: 600;">'+auto_error_msg+'</p>';
                                                                                                    else
                                                                                                        auto_error_msg='<p style="font-weight: 600;">"'+auto_error_msg+'"</p>';
                                                                                                    $('#auto_error_msg').html(auto_error_msg);
                                                                                                    if(auto_error_msg1=='')
                                                                                                        $('#auto_error_msg1').html('<p style="font-weight: 600;">Please review error and try again.</p>');
                                                                                                    else
                                                                                                        $('#auto_error_msg1').html(auto_error_msg1);
                                                                                                    if(oneClickMsg==1)
                                                                                                    {
                                                                                                        $('#auto_error_solve_div').show();
                                                                                                    }
                                                                                                }
                                                                                                function availableCreditReport(clickbuttonid){
                                                                                                    flag_for_report_auth=1;
                                                                                                    document.getElementById(clickbuttonid).click();
                                                                                                }
                                                                                                $(document).ready(function () {
                                                                                                    /**
                                                                                                     &nbsp;&nbsp;* @desc   - To Check the email was valid or not
                                                                                                     * @param  - emailField
                                                                                                     &nbsp;* @return - true or false
                                                                                                     */
                                                                                                    function validateEmail(emailField){
                                                                                                        console.log(emailField);
                                                                                                        const VALIDATE_EMAIL = /^[A-Za-z0-9_\-]+(\.[A-Za-z0-9_\-]+)*\@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,16})$/ ;
                                                                                                        var reg = VALIDATE_EMAIL;
                                                                                                        if (reg.test(emailField) == false)
                                                                                                        {
                                                                                                            auto_errormsg('Please enter email address associated with your account.','','',1);
                                                                                                            return false;
                                                                                                        }
                                                                                                        return true;
                                                                                                    }
                                                                                                    try{
                                                                                                        /**
                                                                                                         &nbsp;&nbsp;* @desc   - if the user click the auto import then this function will trigger and if any error occur this will pass the error and this was encrypting the data and passing to the contoller
                                                                                                         * @param  - report button id
                                                                                                         &nbsp;* @return - status of the report
                                                                                                         */
                                                                                                        $("#auto_btnsubmit_with_pending,#auto_btnsubmit_without_pending,#auto1_btnsubmit_with_pending,#auto1_btnsubmit_without_pending").click(function () {
                                                                                                            var auto_selprovider     =   $.trim($('#auto_selprovider').val());
                                                                                                            var auto_vcr_username    =   $.trim($('#auto_vcr_username').val());
                                                                                                            var auto_vcr_password    =   $.trim($('#auto_vcr_password').val());
                                                                                                            var auto_vcr_securityword=   $.trim($('#auto_vcr_securityword').val());
                                                                                                            var auto_vcr_phonenumber =   $.trim($('#auto_vcr_phonenumber').val());
                                                                                                            var auto_vcr_note        =   $.trim($('#auto_vcr_note').val());
                                                                                                            var reportaccessdetailflag= 0;//To check any change in report provider data 0= no change ,1=changed
                                                                                                            $('#auto_error_solve_div').hide();
                                                                                                            clickedbuttonid=$(this).attr("id");
                                                                                                            if(auto_selprovider=='identityiq')
                                                                                                                $('.reportprovidernameasi').text("IdentityIQ");
                                                                                                            else if(auto_selprovider=='smartcredit')
                                                                                                                $('.reportprovidernameasi').text("SmartCredit");
                                                                                                            else if(auto_selprovider=='identityclub')
                                                                                                                $('.reportprovidernameasi').text("IdentityClub");
                                                                                                            else if(auto_selprovider=='myfreescorenow')
                                                                                                                $('.reportprovidernameasi').text("MyFreeScoreNow");
                                                                                                            else if(auto_selprovider=='privacyguard')
                                                                                                                $('.reportprovidernameasi').text("PrivacyGuard");
                                                                                                            else if(auto_selprovider=='samplereport'){
                                                                                                                $('.reportprovidernameasi').text("Sample Report");
                                                                                                                auto_selprovider=='privacyguard';
                                                                                                                samplereportprocessing(clickedbuttonid,reportaccessdetailflag);
                                                                                                                return true;
                                                                                                            }else
                                                                                                                $('.reportprovidernameasi').text('IdentityIQ');
                                                                                                            $('#repotprovider_name_msg').show();
                                                                                                            if(flag_check_reportprovider==1){
                                                                                                                if(auto_selprovider!=''){
                                                                                                                    var auto_selprovider_txt    =   document.getElementById("auto_selprovider").options[document.getElementById("auto_selprovider").selectedIndex].text;
                                                                                                                }else{
                                                                                                                    var auto_selprovider_txt    =  '';
                                                                                                                }
                                                                                                                dataforajax     =   "report_provider_txt="+auto_selprovider_txt+"&username_txt="+encodeURIComponent(auto_vcr_username)+"&password_txt="+encodeURIComponent(auto_vcr_password)+"&securitywork_txt="+encodeURIComponent(auto_vcr_securityword)+"&phonenumber_txt="+auto_vcr_phonenumber+"&notes_txt="+encodeURIComponent(auto_vcr_note)+"&current_client_id="+current_client_id;
                                                                                                            }else
                                                                                                                dataforajax     =   "report_provider_txt="+auto_selprovider+"&username_txt="+encodeURIComponent(auto_vcr_username)+"&password_txt="+encodeURIComponent(auto_vcr_password)+"&securitywork_txt="+encodeURIComponent(auto_vcr_securityword)+"&phonenumber_txt="+auto_vcr_phonenumber+"&notes_txt="+encodeURIComponent(auto_vcr_note)+"&current_client_id="+current_client_id;
                                                                                                            if(auto_selprovider==''  || auto_vcr_username==''  || auto_vcr_password==''){
                                                                                                                if(auto_selprovider=='')
                                                                                                                {
                                                                                                                    $('#repotprovider_name_msg').hide();
                                                                                                                }

                                                                                                                if(auto_selprovider !='')
                                                                                                                {
                                                                                                                    auto_errormsg('','','',1);
                                                                                                                }
                                                                                                                auto_errormsg("Please check client's credit report access details");

                                                                                                            } else if(auto_vcr_securityword=='' && ( auto_selprovider=='identityiq' ||  auto_selprovider=='privacyguard')){
                                                                                                                auto_errormsg("Please Provide Security Word",'','',1);

                                                                                                            } else{
                                                                                                                if(auto_selprovider!=old_report_provider_txt  || auto_vcr_username!=old_username_txt  || auto_vcr_password!=old_password_txt || auto_vcr_securityword!=old_securitywork_txt  || auto_vcr_phonenumber!=old_phonenumber_txt || auto_vcr_note!=old_notes_txt){
                                                                                                                    reportaccessdetailflag=1;
                                                                                                                }
                                                                                                                if(auto_selprovider=='identityiq'){
                                                                                                                    auto_vcr_username = auto_vcr_username.slice(0, 50);
                                                                                                                    auto_vcr_password = auto_vcr_password.slice(0, 15);
                                                                                                                    if(auto_vcr_password.length < 6 ){
                                                                                                                        auto_errormsg("Your login attempt was not successful, try again.",'','',1);
                                                                                                                        $('#auto_vcr_password').focus();
                                                                                                                        return false;
                                                                                                                    }/*else if(! new RegExp("^[a-zA-Z0-9]*$").test(auto_vcr_password)){
                            auto_errormsg("Invalid Login Details.");
                            $('#auto_vcr_password').focus();
                            return false;
                        }*/
                                                                                                                }else if(auto_selprovider=='privacyguard'){
                                                                                                                    if(document.getElementById("pg_iframe"))
                                                                                                                        document.getElementById("pg_iframe").remove();
                                                                                                                    var iframe = document.createElement('iframe');
                                                                                                                    iframe.id='pg_iframe';
                                                                                                                    iframe.src = '';
                                                                                                                    iframe.src = 'https://app.creditrepaircloud.com/scraping/pg_skeleton.php';
                                                                                                                    iframe.style.cssText = 'display:none';
                                                                                                                    document.body.appendChild(iframe);
                                                                                                                    auto_vcr_username = auto_vcr_username.slice(0, 25);
                                                                                                                    auto_vcr_password = auto_vcr_password.slice(0, 10);
                                                                                                                    auto_vcr_securityword = auto_vcr_securityword.slice(0, 4);
                                                                                                                    if( auto_vcr_username.length <= 3){
                                                                                                                        auto_errormsg("Please enter valid Username.",'','',1);
                                                                                                                        $('#auto_vcr_password').focus();
                                                                                                                        return false;
                                                                                                                    }else if(auto_vcr_password.length <= 5){
                                                                                                                        console.log(auto_vcr_password.length);
                                                                                                                        auto_errormsg("Password must be between 6 and 10 characters.",'','',1);
                                                                                                                        $('#auto_vcr_password').focus();
                                                                                                                        return false;
                                                                                                                    }else if(auto_vcr_securityword.length <= 3){
                                                                                                                        auto_errormsg("Please enter the last four digits of your Social Security number.",'','',1);
                                                                                                                        $('#auto_vcr_securityword').focus();
                                                                                                                        return false;
                                                                                                                    }else if(! new RegExp("^[a-zA-Z0-9]*$").test(auto_vcr_password)){
                                                                                                                        auto_errormsg("Password can only contain numbers and letters.",'','',1);
                                                                                                                        $('#auto_vcr_password').focus();
                                                                                                                        return false;
                                                                                                                    }
                                                                                                                }else if(auto_selprovider=='smartcredit' || auto_selprovider=='identityclub' || auto_selprovider=='myfreescorenow'){
                                                                                                                    if(!validateEmail($('#auto_vcr_username').val()))
                                                                                                                        return false;
                                                                                                                    else if(auto_vcr_password.length < 8 || auto_vcr_password.length > 100){
                                                                                                                        auto_errormsg("Your login attempt was not successful, try again.",'','',1);
                                                                                                                        $('#auto_vcr_password').focus();
                                                                                                                        return false;
                                                                                                                    }else if(! new RegExp("^[a-zA-Z0-9*@_.-]*$").test(auto_vcr_password)){
                                                                                                                        auto_errormsg("Your login attempt was not successful, try again.",'','',1);
                                                                                                                        $('#auto_vcr_password').focus();
                                                                                                                        return false;
                                                                                                                    }
                                                                                                                }
                                                                                                                $('.manualreportimport').hide();
                                                                                                                $('#autoreportimport').hide();
                                                                                                                $('#reportimport').hide();
                                                                                                                $('#auto_import_run').show();
                                                                                                                $('#auto_deatils_found').hide();
                                                                                                                $('#auto_status_icon1').html('<i class="fa fa-spinner fa-pulse fa-2x"></i>');
                                                                                                                $('#auto_status_icon2').html('');
                                                                                                                $('#auto_status_icon3').html('');

                                                                                                                var i=0;
                                                                                                                var flag=0;
                                                                                                                var xhttp  = new XMLHttpRequest();
                                                                                                                xhttp.onreadystatechange = function() {
                                                                                                                    var string = this.responseText;

                                                                                                                    if(string.includes("File_does_not_exist")){

                                                                                                                        flag=1;
                                                                                                                        auto_errormsg("Unable to load the Page! Please try again.",'','',1);
                                                                                                                    }else if(string.includes("Loginpageloaded") && i==0){

                                                                                                                        i=1;
                                                                                                                        $('#auto_status_icon1').html('<i class="fa fa-check fa-2x"></i>');
                                                                                                                        $('#auto_status_icon2').html('<i class="fa fa-spinner fa-pulse fa-2x"></i>');
                                                                                                                    }else if(string.includes('Reportpageopen') && i==1){

                                                                                                                        i=2;
                                                                                                                        $('#auto_status_icon2').html('<i class="fa fa-check fa-2x"></i>');
                                                                                                                        $('#auto_status_icon3').html('<i class="fa fa-spinner fa-pulse fa-2x"></i>');
                                                                                                                    }else if(string.includes('gettingsourcereport') && i==2){

                                                                                                                        i=3;
                                                                                                                    }
                                                                                                                    if (this.readyState == 4 && this.status == 200) {

                                                                                                                        var result = this.responseText;
                                                                                                                        if(string.includes("error_occurred_flag")){

                                                                                                                            auto_errormsg("Unable to load the Page! Please try again.",'','',1);
                                                                                                                        }
                                                                                                                        if(result.includes("SecurityQues_CRC")){

                                                                                                                            var securityword_question_from_IDIQ=result.split("SecurityQues_CRC")[1];
                                                                                                                            if(securityword_question_from_IDIQ.includes("Last four digits of your SSN")) {
                                                                                                                                vcr_securityword_question           =   "Last four digits of SSN";
                                                                                                                                securityword_question_from_IDIQ     =   "Last four digits of SSN";
                                                                                                                            }else{
                                                                                                                                vcr_securityword_question           =   "Security Word";
                                                                                                                            }
                                                                                                                            if($.trim($('#auto_securityword_label').text()) != $.trim(vcr_securityword_question)){
                                                                                                                                $('#auto_securityword_label').text(vcr_securityword_question);
                                                                                                                                $.ajax({
                                                                                                                                    url :   base_url()+'importcreditreport/report_provider_securityquestion_update',
                                                                                                                                    data:   "securityquestion="+vcr_securityword_question+"&iclient_id="+current_client_id,
                                                                                                                                    type:   'POST',
                                                                                                                                    success: function() {
                                                                                                                                    }
                                                                                                                                });
                                                                                                                            }
                                                                                                                        }

                                                                                                                        result = result.split('CRCscrappingstart');
                                                                                                                        imported_report_providerdata=result[1];

                                                                                                                        if(string.includes("We are currently experiencing a system error")){
                                                                                                                            auto_errormsg("We are currently experiencing a system error. <br>Please try again later",'','',1);
                                                                                                                            flag=1;
                                                                                                                        }else if(string.includes("error_occurred_flag")){

                                                                                                                            flag=1;
                                                                                                                            if(string.includes("Account_locked")){
                                                                                                                                auto_errormsg("Account locked! Please contact to IdentityIQ.",'','',1);// it was coming only for identity iq
                                                                                                                            }else if(string.includes("PrivacyGuard_authorization_page")){
                                                                                                                                var report_data = "<p style='font-weight: 600;'><a onclick='privacyguradauthclick(`"+clickedbuttonid+"`);' class='btnsubmit' style='color: white;background: #1e5da9;text-decoration: none;'>Auto-Login To PrivacyGuard To Complete Authorization</a></p>";
                                                                                                                                flag=1;
                                                                                                                                auto_errormsg("PrivacyGuard is requesting additional authorization to pull credit report. Please manually login to PrivacyGuard and order report.",report_data,'',1);
                                                                                                                            }else if(string.includes("securityques_fail_idiq")){
                                                                                                                                auto_errormsg('Security word is incorrect. Please correct and enter <br>"'+securityword_question_from_IDIQ+'"'+' below','',1,1);
                                                                                                                            }else if(string.includes("identityiq_error_msg")){
                                                                                                                                var identityiq_error_msg = string.split('identityiq_error_msg');
                                                                                                                                auto_errormsg($.trim(identityiq_error_msg[1]),'','',1);
                                                                                                                            }else if(string.includes("crc_idiq_page_load_issue")){
                                                                                                                                $('#repotprovider_name_msg').hide();
                                                                                                                                auto_errormsg("Try logging into <a href='www.identityiq.com' target='_blank'>www.identityiq.com </a> manually to see check that the account is active, and if you can see the report. If successful, return here to CRC and try again.",'','',1);
                                                                                                                            }else if(string.includes("Loginfail")){
                                                                                                                                auto_errormsg("Login Failure! Please check access details.",'','',1);
                                                                                                                            }else if(string.includes("subscription_check_page")){
                                                                                                                                auto_errormsg("Please check your subscription.",'','',1);
                                                                                                                            }else if(string.includes("report_text")){
                                                                                                                                var smartcredit_error_msg = string.split('report_text');
                                                                                                                                var sc_message = smartcredit_error_msg[1].replace("»", "");
                                                                                                                                var report_data = "<p><a onclick='availableCreditReport(`"+clickedbuttonid+"`);'>Continue with the available report</a></p>";
                                                                                                                                auto_errormsg($.trim(sc_message), report_data,'',1);
                                                                                                                            }else if(string.includes("crc_pg_page_load_issue")){
                                                                                                                                $('#repotprovider_name_msg').hide();
                                                                                                                                auto_errormsg("Try logging into <a href='www.privacyguard.com' target='_blank'>www.privacyguard.com </a> manually to see check that the account is active, and if you can see the report. If successful, return here to CRC and try again.",'','',1);
                                                                                                                            }else if(string.includes("card_declined_error")){
                                                                                                                                auto_errormsg("The credit/debit card you have on file has declined",'','',1);
                                                                                                                            }else if(string.includes("privacyguard_error_msg")){
                                                                                                                                var privacyguarderror_msg = string.split('privacyguard_error_msg');
                                                                                                                                auto_errormsg($.trim(privacyguarderror_msg[1]),'','',1);
                                                                                                                            }else{
                                                                                                                                auto_errormsg("Unable to load the Page! Please try again.",'','',1);
                                                                                                                            }
                                                                                                                            $("textarea#sourcecodearea").val('');
                                                                                                                        }else if(string.includes("Your credit/debit card you have on file has been declined")){

                                                                                                                            var report_data_imported_date = string.match('<td class="crLightTableBackground" width="25%">(.*)</td>')[1].slice(0, 10);
                                                                                                                            var currentdate = new Date();
                                                                                                                            var reportdate = new Date(report_data_imported_date); // get total seconds between two dates
                                                                                                                            var datediff = Math.abs(currentdate - reportdate) / 1000;
                                                                                                                            datediff = Math.floor(datediff / 86400);
                                                                                                                            report_data_imported_date = "<p style='font-weight: 600;'><a onclick='addDatatoSourceText(`"+clickedbuttonid+"`,`"+reportaccessdetailflag+"`,`"+dataforajax+"`,`1`);'>Import the old report (pulled "+datediff+" days ago)</a></p>";
                                                                                                                            auto_errormsg("The credit/debit card you have on file has declined",report_data_imported_date,'',1);
                                                                                                                            flag=1;
                                                                                                                            $("textarea#sourcecodearea").val('');
                                                                                                                        }
                                                                                                                        if(flag==0){

                                                                                                                            if(auto_selprovider=='privacyguard'){
                                                                                                                                var pgData = imported_report_providerdata.split("scrap_raw_data_crc");
                                                                                                                                pgData = JSON.parse(pgData[1]);
                                                                                                                                iframe.contentWindow.buildAllGadgets(pgData[0].data);
                                                                                                                                setTimeout(function(){
                                                                                                                                    imported_report_providerdata = iframe.contentWindow.document.documentElement.outerHTML;
                                                                                                                                    addDatatoSourceText(clickedbuttonid,reportaccessdetailflag,dataforajax);
                                                                                                                                }, 3000);
                                                                                                                            } else if(auto_selprovider=='smartcredit'){

                                                                                                                                var pgData = imported_report_providerdata.split("ExtraContentEnd");
                                                                                                                                imported_report_providerdata = pgData[1];
                                                                                                                                addDatatoSourceText(clickedbuttonid,reportaccessdetailflag,dataforajax);
                                                                                                                            } else {
                                                                                                                                addDatatoSourceText(clickedbuttonid,reportaccessdetailflag,dataforajax);
                                                                                                                            }
                                                                                                                        }

                                                                                                                    }else if (this.readyState == 4 && this.status == 404){
                                                                                                                        auto_errormsg('Automation is not available for the Report Provider');
                                                                                                                    }
                                                                                                                };

                                                                                                                var scrappingurl='https://app.creditrepaircloud.com/importcreditreport/scraping?scrappingserviceprovider='+btoa(auto_selprovider)+'&username='+btoa(auto_vcr_username)+'&password='+btoa(auto_vcr_password)+'&securityword='+btoa(auto_vcr_securityword)+'&current_client_id='+current_client_id+'&flag='+flag_for_report_auth;
                                                                                                                xhttp.open("GET", scrappingurl, true);
                                                                                                                xhttp.send();
                                                                                                            }
                                                                                                        });
                                                                                                    }catch(err) {
                                                                                                        auto_errormsg("Error while importing report, Please try after some time");
                                                                                                    }
                                                                                                });
                                                                                            </script>

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
