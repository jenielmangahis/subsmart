<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
// CSS to add only Customer module
add_css(array(
    'assets/css/jquery.signaturepad.css',
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
    'assets/css/accounting/sales.css',
    'assets/textEditor/summernote-bs4.css',
));
?>
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
    .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
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
                        <div class="card-body" >
                            <div class="row align-items-center pt-3 bg-white">
                                <div class="col-md-12">
                                    <!-- Nav tabs -->
                                    <h3 class="page-title">Customers List</h3>
                                    <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                        <span style="color:black;">
                                            A great process of managing interactions with existing as well as past and potential customers is to have one powerful platform that can provide an immediate response to your customer needs.
                                            Try our quick action icons to create invoices, scheduling, communicating and more with all your customers.
                                        </span>
                                    </div>
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <!--<input type="file" name="file" /> -->
                                            <a href="<?= url('customer/import_customer') ?>">
                                                <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-download"></span> Import</button>
                                            </a>
                                            <a href="<?= url('customer/customer_export') ?>">
                                                <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-upload"></span> Export</button>
                                            </a>
                                            <!--<a class="btn btn-primary btn-md" href="<?php echo base_url('/builder?form_id=28') ?>">
                                                                                <span class="fa fa-pencil"></span> &nbsp; Customize Form
                                                                            </a>-->
                                            <!--<a class="btn btn-primary btn-md" href="<?php echo base_url('customer/print') ?>">
                                                                                    <span class="fa fa-print "></span> Print
                                                                            </a>-->
                                            <a class="btn btn-primary btn-md" href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> Add Lead</a>
                                            <a class="btn btn-primary btn-md" href="<?php echo url('customer/add_advance') ?>">
                                                <span class="fa fa-plus"></span> New Customer
                                            </a>
                                            <?php //endif ?>
                                        </div>
                                    </div>

                                    <div class="banking-tab-container">
                                        <div class="rb-01">
                                            <ul class="nav nav-tabs border-0">
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($cust_tab == 'tab1') {
                                                echo "active";
                                            } ?>" data-toggle="tab" href="#basic">Manager List</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($cust_tab == 'tab2' || $cust_tab == '') {
                                                echo "active";
                                            } ?>" data-toggle="tab" href="#advance">Customer Module Layout</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($cust_tab == 'tab3') {
                                                echo "active";
                                            } ?>" data-toggle="tab" href="#settings">Settings</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane <?php if ($cust_tab == 'tab1') {
                                                echo "active";
                                            } else {
                                                echo "fade";
                                            } ?> standard-accordion" id="basic">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="card card-mobile">
                                                        <div class="card-body">
                                                            <div class="col-sm-6 col-md-12">
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                                                        <div id="status_sorting"  class=""></div>
                                                                        <table class="table"  id="customer_list_table">
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
<?php if (isset($profiles) && !empty($profiles)) : ?>
    <?php foreach ($profiles as $customer) : ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <a href="<?= base_url('/customer/index/tab2/' . $customer->prof_id) . ''; ?>" style="color:#32243d;">
        <?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td><?php echo $customer->city; ?></td>
                                                                                            <td><?php echo $customer->state; ?></td>
                                                                                            <td><?php echo $customer->lead_source; ?></td>
                                                                                            <td><?php echo $customer->email; ?></td>
                                                                                            <td><?php echo $customer->entered_by; ?></td>
                                                                                            <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                                                                                            <td><?php echo $customer->technician; ?></td>
                                                                                            <td><?php echo $customer->system_type; ?></td>
                                                                                            <td><?php echo $customer->mmr; ?></td>
                                                                                            <td><?php echo $customer->phone_h; ?></td>
                                                                                            <td><?php echo $customer->status; ?></td>
                                                                                            <td>
                                                                                                <a href="<?php echo url('/customer/add_advance/' . $customer->prof_id); ?>" style="text-decoration:none;display:inline-block;" title="Edit Customer">
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
                                                                                                <a href="#" style="text-decoration:none; display:inline-block;">
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
                                                                                                <!--<a href="<?php echo url('/customer/index/tab2/' . $customer->prof_id); ?>"  style="text-decoration:none; display:inline-block;">
                                                                                                    <img src="https://app.creditrepaircloud.com/application/images/assign-contact.png" border="0" title="View Profile">
                                                                                                </a>-->
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
                                                </div>
                                            </div>
                                            <style>
                                                .btn{
                                                    font-size: 12px !important;
                                                }
                                            </style>
                                        </div>
                                        <div class="tab-pane <?php if ($cust_tab == 'tab2' || $cust_tab == '') {
                                            echo "active";
                                        } else {
                                            echo "fade";
                                        } ?> standard-accordion" id="advance">
                                            <div class="col-sm-12">
                                                <div class="float-right d-md-block">
                                                    <div class="dropdown">
                                                        <a class="btn btn-primary btn-md" href="#"><span class="fa fa-print"></span> Print</a>
                                                        <!--<a class="btn btn-primary btn-md" href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> New Lead</a>
                                                        <a class="btn btn-primary btn-md" href="<?php echo url('customer/add_advance') ?>"><span class="fa fa-plus"></span> New Customer</a>-->
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                                    <span style="color:black;">
                                                        Our customer dashboard is Visual and Easy-To-Use. Simply add a widget and quickly see the information you need to help better assist and maintain a well organized business.
                                                        Need us to create a customize widget with the table geared around your business.  Send us a request and our support team will be glad to get you a quote.
                                                    </span>
                                                </div>
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
                                                            if($module_sort->ams_values!=""):
                                                                foreach ($modules as $m):
                                                                    $view = $this->wizardlib->getModuleById($m);
                                                                    //echo $view;
                                                                    $data['id'] = $view->ac_id;
                                                                    $this->load->view($view->ac_view_link, $data);
                                                                endforeach;
                                                            endif;
                                                            $datas['module_sort'] = $module_sort;
                                                            $this->load->view('customer/adv_cust_modules/add_module', $datas);
                                                        ?>
                                                        <input type="hidden" id="custom_modules" value="<?= $module_sort->ams_values ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane <?php if ($cust_tab == 'tab3') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="settings">
                                            <div class="banking-tab-container">
                                                <div class="rb-01">
                                                    <ul class="nav nav-tabs border-0">
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt2' || $minitab == '') {
echo "active";
} ?>" data-toggle="tab" href="#widget1">Import/Audit</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt3' || $minitab == 'mt3-cdl') {
echo "active";
} ?>" data-toggle="tab" href="#widget2">Dispute Wizard</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt4' || $minitab == 'mt4-2') {
echo "active";
} ?>" data-toggle="tab" href="#widget3">Dispute Items</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt5') {
echo "active";
} ?>" data-toggle="tab" href="#profle">Profile</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt6') {
echo "active";
} ?>" data-toggle="tab" href="#educate">Educate</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt7') {
                                                        echo "active";
                                                    } ?>" data-toggle="tab" href="#messages">Messages</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt8') {
                                                        echo "active";
                                                    } ?>" data-toggle="tab" href="#notes">Internal Notes</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt9') {
                                                        echo "active";
                                                    } ?>" data-toggle="tab" href="#invoices">Invoices</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt10') {
                                                        echo "active";
                                                    } ?>" data-toggle="tab" href="#activity">Activity</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt11') {
                                                        echo "active";
                                                    } ?>" data-toggle="tab" href="#details">Detail Sheet</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt12') {
                                                                echo "active";
                                                            } ?>" data-toggle="tab" href="#custom">Customizable</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="h6 mb-0 nav-link banking-sub-tab <?php if ($minitab == 'mt13') {
                                                                echo "active";
                                                            } ?>" data-toggle="tab" href="#others">Others</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-content mt-4" >
                                                <div class="tab-pane <?php if ($minitab == 'mt2' || $minitab == '') {
                                                                echo "active";
                                                            } else {
                                                                echo "fade";
                                                            } ?> standard-accordion" id="widget1">
                                                <?php
                                                include viewPath('customer/adv_cust_modules/settings_widget1');
                                                ?>
                                                </div>
                                                <div class="tab-pane <?php if ($minitab == 'mt3' || $minitab == 'mt3-cdl') {
                                                        echo "active";
                                                    } else {
                                                        echo "fade";
                                                    } ?> standard-accordion" id="widget2">
<?php
if ($minitab == 'mt3') {
include viewPath('customer/adv_cust_modules/settings_widget2');
} else if (isset($letter_id) && $letter_id != "") {
include viewPath('customer/adv_cust_modules/settings_widget2-2');
} else {
include viewPath('customer/adv_cust_modules/settings_widget2-1');
}
?>
                                                </div>
                                                <div class="tab-pane <?php if ($minitab == 'mt4' || $minitab == 'mt4-2') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="widget3">
<?php
include viewPath('customer/adv_cust_modules/settings_widget3');
?>
                                                </div>
                                                <div class="tab-pane <?php if ($minitab == 'mt5') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="profle">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
<?php
include viewPath('customer/adv_cust_modules/settings_profile');
?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if ($minitab == 'mt6') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="educate">
<?php
include viewPath('customer/adv_cust_modules/settings_educate');
?>
                                                </div>

                                                <div class="tab-pane <?php if ($minitab == 'mt7') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="messages">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Messages</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if ($minitab == 'mt8') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="notes">
<?php
include viewPath('customer/adv_cust_modules/settings_notes');
?>
                                                </div>

                                                <div class="tab-pane <?php if ($minitab == 'mt9') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="invoices">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Invoices</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if ($minitab == 'mt10') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="activity">
                                                    <div class="card">
                                                        <div class="card-body hid-desk">

                                                            <div class="col-lg-8">
                                                                <!-- <h6>Activity</h6> -->
                                                                <div class="MuiCardContent-root">
                                                                    <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                                                        <table id="customer_info" class="table">
                                                                            <thead>
                                                                                <tr>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="user-img position-relative d-inline-block mr-2">
                                                                                            <span class="round text-white text-center rounded-circle bg-danger msg-count-cus">WH</span>
                                                                                        </div>
                                                                                        Welyelf Hisula
                                                                                    </td>
                                                                                    <td>Job scheduled SMS sent to (970) 691-9018</td>
                                                                                    <td>Thu 1/21/21
                                                                                        6:20pm</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="user-img position-relative d-inline-block mr-2">
                                                                                            <span class="round text-white text-center rounded-circle bg-danger msg-count-cus">WH</span>
                                                                                        </div>
                                                                                        Welyelf Hisula
                                                                                    </td>
                                                                                    <td>Job scheduled SMS sent to (970) 691-9018</td>
                                                                                    <td>Thu 1/21/21
                                                                                        6:20pm</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if ($minitab == 'mt11') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="details">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Detail Sheet</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if ($minitab == 'mt12') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="custom">
                                                    <div class="card">
                                                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                                                            <div class="col-lg-12">
                                                                <h6>Customizable</h6>
                                                            </div>
<?php if (isset($profile_info)) : ?>
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
$custom_fields = json_decode($profile_info->custom_fields);
if (!empty($custom_fields)) {
    foreach ($custom_fields as $key => $custom) {
        ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input type="text" class="form-control col-md-12" value="<?= !empty($custom->field_name) ? $custom->field_name : ''; ?>" name="fieldname[]" id="fieldname" />
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text" class="form-control col-md-12" value="<?= !empty($custom->field_value) ? $custom->field_value : ''; ?>" name="fieldvalue[]" id="fieldvalue" />
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
                                                                    <input type="hidden" class="form-control" value="<?php if (isset($profile_info)) {
    echo $profile_info->prof_id;
} ?>" name="prof_id" id="prof_id" />
                                                                </form>
                                                            </div>
<?php else : ?>
                                                            <span>No customer selected. Go to Customer Manager and select one.</span>
<?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane <?php if ($minitab == 'mt13') {
echo "active";
} else {
echo "fade";
} ?> standard-accordion" id="others">
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

<!-- Modals -->

<!-- Lead Type Modal -->
<?php include viewPath('customer/adv_modals/modal_lead_type'); ?>

<!-- Sales Area Modal -->
<?php include viewPath('customer/adv_modals/modal_sales_area'); ?>

<!-- Lead Source Modal -->
<?php include viewPath('customer/adv_modals/modal_lead_source'); ?>

<!-- Task Modal -->
<?php include viewPath('customer/adv_modals/modal_task'); ?>

<!-- Impoer Credit Modal -->
<?php include viewPath('customer/adv_modals/modal_import_credit'); ?>

<!-- Fusnishers Modal -->
<?php include viewPath('customer/adv_modals/modal_furnishers'); ?>

<!-- Reasons Modal -->
<?php include viewPath('customer/adv_modals/modal_reasons'); ?>
<!-- End Modals -->


<?php
// JS to add only Customer module
add_footer_js(array(
'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
 'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
 'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
 'assets/textEditor/summernote-bs4.js'
    // 'assets/frontend/js/creditcard.js',
    // 'assets/frontend/js/customer/add.js',
));
?>
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
    .input_select{
        color: #363636;
        box-shadow: none;
        display: inline-block !important;
        background-color: #fff;
        background-clip: padding-box;
    }

    .dispute_link{
        text-decoration: none;
        color: #1e5da9 !important;
        margin-top : 2px !important;
    }
</style>

<script>
    $(document).ready(function () {

        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        $('.date_picker').val(new Date().toLocaleDateString());

        //$(".module").draggable({axis:"y"});
        ///$( ".sortable2" ).sortable("disable");
        $('#onoff-customize').change(function () {
            if (this.checked) {
                $('.module').mouseover(function(){
                   if($(this).attr('id')=='addModuleBody'){
                        $(".sortable2").sortable("disable");
                   }else{
                    $(".sortable2").sortable("enable");
                   }
                });
            } else {
                $(".sortable2").sortable("disable");
            }

        });
        
        

        $(".sortable2").sortable({
            start: function (e, ui) {
                // creates a temporary attribute on the element with the old index
                $(this).attr('data-previndex', ui.item.index());
                $(this).attr('style', 'top:0;cursor: grabbing');

            },
            change(event, ui)
            {
                $(this).attr('style', 'top:0;cursor: grabbing ');
            },
            update: function (e, ui) 
            {
                $(this).attr('style', 'top:0;cursor: pointer');
                var oldOrder = $(this).attr('data-previndex');
                var idsInOrder = $(".sortable2").sortable("toArray",{ attribute: 'data-id' });
                var filteredArray = idsInOrder.filter(function(e){return e});
                
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/customer/ac_module_sort",
                    data: {ams_values: filteredArray.toString(), ams_id: <?php echo $module_sort->ams_id; ?>}, // serializes the form's elements.
                    success: function (data)
                    {
                        console.log(data);
                    }
                });
                
                console.log(filteredArray.toString());
            }
        });

        $(".sortable2").sortable("disable");

        $(".remove_task").on("click", function (event) {
            var ID = this.id;
            //alert(ID);
            $.ajax({
                type: "POST",
                url: "/customer/remove_task",
                data: {id: ID}, // serializes the form's elements.
                success: function (data) {
                    if (data === "Done") {
                        window.location.reload();
                    } else {
                        console.log(data);
                    }
                }
            });
        });




    });




</script>
