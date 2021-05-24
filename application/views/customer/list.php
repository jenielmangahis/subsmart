<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

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
    #draggable {
        width: 150px;
        height: 150px;
        padding: 0.5em;
    }
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

    input:checked+.slider {
        background: linear-gradient(to bottom, #45a73c 0%, #67ce5e 100%) !important;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3 !important;
    }

    input:checked+.slider:before {
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

    label {
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }

    hr {
        border: 2px solid #32243d !important;
        width: 100%;
    }

    .form-group {
        margin-bottom: 3px !important;
    }

    .required {
        color: red !important;
    }

    .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 22%) !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-top: 2px !important;
    }

    .select2-container .select2-selection--single {
        height: 30px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: -3px !important;
    }

    .input_select {
        font-size: 11px !important;
        line-height: 150%;
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
                        <div class="card-body hid-desk">
                            <div class="row margin-bottom-ter align-items-center">
                                <!-- Nav tabs -->
                                <div class="col-auto">
                                    <h3 class="box-title" style="position: relative;top: 5px;">Customer Manager List
                                    </h3>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <!--<input type="file" name="file" /> -->
                                            <a
                                                href="<?= url('customer/import_customer') ?>">
                                                <button type="button" class="btn btn-primary btn-md"
                                                    id="exportCustomers"><span class="fa fa-download"></span>
                                                    Import</button>
                                            </a>
                                            <a
                                                href="<?= url('customer/customer_export') ?>">
                                                <button type="button" class="btn btn-primary btn-md"
                                                    id="exportCustomers"><span class="fa fa-upload"></span>
                                                    Export</button>
                                            </a>
                                            <a class="btn btn-primary btn-md"
                                                href="<?php echo url('customer/add_lead') ?>"><span
                                                    class="fa fa-plus"></span> Add Lead</a>
                                            <a class="btn btn-primary btn-md"
                                                href="<?php echo url('customer/add_advance') ?>">
                                                <span class="fa fa-plus"></span> New Customer
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4" role="alert">
                                    <span style="color:black;">
                                        A great process of managing interactions with existing as well as past and
                                        potential customers is to have one powerful platform that can provide an
                                        immediate response to your customer needs.
                                        Try our quick action icons to create invoices, scheduling, communicating and
                                        more with all your customers.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="card <?=  isset($profiles) && !empty($profiles) ? 'collapse' : '' ?>"
                                id="advance_search_wizard">
                                <div class="card-header">
                                    Advance Search
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="col-md-12">
                                                    <label for="">Monitoring ID</label>
                                                    <input type="text" class="form-control" name="monitoring_id"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">First Name</label>
                                                    <input type="text" class="form-control" name="firstname"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Last Name</label>
                                                    <input type="text" class="form-control" name="lastname"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Email</label>
                                                    <input type="text" class="form-control" name="email"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Phone</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        id="acs_custom_field2" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="col-md-12">
                                                    <label for="">Sales Date</label>
                                                    <input type="text" class="form-control" name="sales_date"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Company Name</label>
                                                    <input type="text" class="form-control" name="company_name"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Panel Type</label>
                                                    <select name="panel_type" id="panel_type" class="input_select">
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->panel_type == '') {
        echo "selected";
    }
} ?>
                                                            value="">
                                                        </option>
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->panel_type == 'DIGI') {
        echo "selected";
    }
} ?>
                                                            value="DIGI">Landline
                                                        </option>
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->panel_type == 'DW2W') {
        echo "selected";
    }
} ?>
                                                            value="DW2W">Landline W/ 2-Way
                                                        </option>
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->panel_type == 'DWCB') {
        echo "selected";
    }
} ?>
                                                            value="DWCB">Landline W/ Cell Backup
                                                        </option>
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->panel_type == 'D2CB') {
        echo "selected";
    }
} ?>
                                                            value="D2CB">Landline W/ 2-Way &amp; Cell Backup
                                                        </option>
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->panel_type == 'CPDB') {
        echo "selected";
    }
} ?>
                                                            value="CPDB">Cell Primary
                                                        </option>
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->panel_type == 'CP2W') {
        echo "selected";
    }
} ?>
                                                            value="CP2W">Cell Primary w/2Way
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Account Type</label>
                                                    <select name="acct_type" id="acct_type" class="input_select">
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->acct_type == '') {
        echo "selected";
    }
} ?>
                                                            value="">
                                                        </option>
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->acct_type == 'In-House') {
        echo "selected";
    }
} ?>
                                                            value="In-House">In-House
                                                        </option>
                                                        <option <?php if (isset($alarm_info)) {
    if ($alarm_info->acct_type == 'Purchase') {
        echo "selected";
    }
} ?>
                                                            value="Purchase">Purchase
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Status</label>
                                                    <select id="status" name="status" data-customer-source="dropdown"
                                                        class="input_select">
                                                        <option value=""></option>
                                                        <option <?php if (isset($profile_info)) {
    if ($profile_info->status == 'Assigned') {
        echo 'selected';
    }
} ?>
                                                            value="Assigned">Assigned
                                                        </option>
                                                        <option <?php if (isset($profile_info)) {
    if ($profile_info->status == 'Not Assign') {
        echo 'selected';
    }
} ?>
                                                            value="Not Assign">Not Assign
                                                        </option>
                                                        <option <?php if (isset($profile_info)) {
    if ($profile_info->status == 'Converted') {
        echo 'selected';
    }
} ?>
                                                            value="Converted">Converted
                                                        </option>
                                                        <option <?php if (isset($profile_info)) {
    if ($profile_info->status == 'Not Converted') {
        echo 'selected';
    }
} ?>
                                                            value="Not Converted">Not Converted
                                                        </option>
                                                        <option <?php if (isset($profile_info)) {
    if ($profile_info->status == 'Scheduled') {
        echo 'selected';
    }
} ?>
                                                            value="Scheduled">Scheduled
                                                        </option>
                                                        <option <?php if (isset($profile_info)) {
    if ($profile_info->status == 'Installed') {
        echo 'selected';
    }
} ?>
                                                            value="Installed">Installed
                                                        </option>
                                                        <option <?php if (isset($profile_info)) {
    if ($profile_info->status == 'Completed ') {
        echo 'selected';
    }
} ?>
                                                            value="Completed">Completed
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="col-md-12">
                                                    <label for="">Address</label>
                                                    <input type="text" class="form-control" name="address"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">City</label>
                                                    <input type="text" class="form-control" name="city"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">State</label>
                                                    <select id="state" name="state" data-customer-source="dropdown"
                                                        class="input_select">
                                                        <option value=""></option>
                                                        <option value="AB">AB</option>
                                                        <option value="AL">AL</option>
                                                        <option value="AK">AK</option>
                                                        <option value="AS">AS</option>
                                                        <option value="AZ">AZ</option>
                                                        <option value="AR">AR</option>
                                                        <option value="BC">BC</option>
                                                        <option value="CA">CA</option>
                                                        <option value="CO">CO</option>
                                                        <option value="CT">CT</option>
                                                        <option value="DE">DE</option>
                                                        <option value="DC">DC</option>
                                                        <option value="FM">FM</option>
                                                        <option value="FL">FL</option>
                                                        <option value="GA">GA</option>
                                                        <option value="GU">GU</option>
                                                        <option value="HI">HI</option>
                                                        <option value="ID">ID</option>
                                                        <option value="IL">IL</option>
                                                        <option value="IN">IN</option>
                                                        <option value="IA">IA</option>
                                                        <option value="KS">KS</option>
                                                        <option value="KY">KY</option>
                                                        <option value="LA">LA</option>
                                                        <option value="ME">ME</option>
                                                        <option value="MH">MH</option>
                                                        <option value="MD">MD</option>
                                                        <option value="MA">MA</option>
                                                        <option value="MI">MI</option>
                                                        <option value="MN">MN</option>
                                                        <option value="MS">MS</option>
                                                        <option value="MO">MO</option>
                                                        <option value="MT">MT</option>
                                                        <option value="NE">NE</option>
                                                        <option value="NV">NV</option>
                                                        <option value="NH">NH</option>
                                                        <option value="NJ">NJ</option>
                                                        <option value="NM">NM</option>
                                                        <option value="NY">NY</option>
                                                        <option value="NC">NC</option>
                                                        <option value="ND">ND</option>
                                                        <option value="NL">NL</option>
                                                        <option value="NS">NS</option>
                                                        <option value="NT">NT</option>
                                                        <option value="NU">NU</option>
                                                        <option value="NB">NB</option>
                                                        <option value="MP">MP</option>
                                                        <option value="MB">MB</option>
                                                        <option value="OH">OH</option>
                                                        <option value="OK">OK</option>
                                                        <option value="ON">ON</option>
                                                        <option value="OR">OR</option>
                                                        <option value="PE">PE</option>
                                                        <option value="PW">PW</option>
                                                        <option value="PA">PA</option>
                                                        <option value="PR">PR</option>
                                                        <option value="QC">QC</option>
                                                        <option value="RI">RI</option>
                                                        <option value="SC">SC</option>
                                                        <option value="SD">SD</option>
                                                        <option value="SK">SK</option>
                                                        <option value="TN">TN</option>
                                                        <option value="TX">TX</option>
                                                        <option value="UT">UT</option>
                                                        <option value="VT">VT</option>
                                                        <option value="VI">VI</option>
                                                        <option value="VA">VA</option>
                                                        <option value="WA">WA</option>
                                                        <option value="WV">WV</option>
                                                        <option value="WI">WI</option>
                                                        <option value="WY">WY</option>
                                                        <option value="YT">YT</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Zip</label>
                                                    <input type="text" class="form-control" name="zip"
                                                        id="acs_custom_field2" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Routing Number</label>
                                                    <input type="text" class="form-control" name="routing_number"
                                                        id="acs_custom_field2" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="col-md-12">
                                                    <label for="">Technician</label>
                                                    <select id="technician" name="technician"
                                                        data-customer-source="dropdown" class="input_select">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Company</label>
                                                    <input type="text" class="form-control" name="company"
                                                        id="company" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Monitoring Company</label>
                                                    <input type="text" class="form-control" name="monitor_company"
                                                        id="monitor_company" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Credit Score</label>
                                                    <input type="text" class="form-control" name="credit_score"
                                                        id="credit_score" />
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Contract Term</label>
                                                    <select id="contract_term" name="contract_term"
                                                        data-customer-source="dropdown" class="input_select">
                                                        <option value=""></option>
                                                        <option value="36">36</option>
                                                        <option value="60">60</option>
                                                        <option value="12">12</option>
                                                        <option value="24">24</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <a href="#" style="right: 0;position: absolute;padding-right: 20px;">
                                                <button type="submit" class="btn btn-primary btn-md"><span
                                                        class="fa fa-search-plus"></span> Search</button>
                                            </a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <?php if (isset($profiles) && !empty($profiles)) : ?>
                                <a id="more_detail_furnisher" href="#advance_search_wizard" role="button"
                                    aria-expanded="false" aria-controls="collapseExample" data-toggle="collapse"
                                    style="color:#1E5DA9;right: 0;position: absolute;margin-top: -20px;padding-right: 20px;">
                                    +Show Advance Search
                                </a>

                                <div id="status_sorting" class=""></div>
                                <table class="table" id="customer_list_table">
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
                                                <a href="<?= base_url('/customer/preview/' . $customer->prof_id) . ''; ?>"
                                                    style="color:#32243d;">
                                                    <?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $customer->city; ?>
                                            </td>
                                            <td><?php echo $customer->state; ?>
                                            </td>
                                            <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?>
                                            </td>
                                            <td><?php echo $customer->email; ?>
                                            </td>
                                            <td><?php echo $customer->entered_by; ?>
                                            </td>
                                            <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?>
                                            </td>
                                            <td><?= $customer->technician != null ? $customer->technician : 'Not Assigned'; ?>
                                            </td>
                                            <td><?php echo $customer->system_type; ?>
                                            </td>
                                            <td>$<?= $customer->mmr; ?>
                                            </td>
                                            <td><?php echo $customer->phone_m; ?>
                                            </td>
                                            <td><?= $customer->status != null ? $customer->status : 'Pending'; ?>
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown-btn text-center">
                                                    <button class="btn btn-default" type="button" id="dropdown-edit"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm"
                                                                style="margin-left:10px;"></i></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                        aria-labelledby="dropdown-edit">
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1"
                                                                href="<?php echo base_url('customer/preview/'.$customer->prof_id); ?>"
                                                                class="editItemBtn">
                                                                <span class="fa fa-search-plus icon"></span>
                                                                Preview
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('customer/add_advance/'.$customer->prof_id); ?>"
                                                                class="editItemBtn">
                                                                <span class="fa fa-edit icon"></span>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="mailto:<?= $customer->email; ?>"
                                                                class="editItemBtn">
                                                                <span class="fa fa-envelope icon"></span>
                                                                Email
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"
                                                                id="<?= $customer->phone_m; ?>"
                                                                onclick='call(this.id);return false;'
                                                                class="editItemBtn">
                                                                <span class="fa fa-phone icon"></span>
                                                                Call
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url('invoice/add/'); ?>"
                                                                class="editItemBtn">
                                                                <span class="fa fa-file icon"></span>
                                                                Invoice
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url('customer/module/'.$customer->prof_id); ?>"
                                                                class="editItemBtn">
                                                                <span class="fa fa-dashboard icon"></span>
                                                                Dashboard
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url('job/new_job1/'); ?>"
                                                                class="editItemBtn">
                                                                <span class="fa fa-calendar-check-o icon"></span>
                                                                Schedule
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="editItemBtn">
                                                                <span class="fa fa-file-text icon"></span>
                                                                Message
                                                            </a>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                    </ul>
                                                </div>
                                                <!--<a href="<?php echo url('/customer/add_advance/' . $customer->prof_id); ?>"
                                                style="text-decoration:none;display:inline-block;" title="Edit
                                                Customer">
                                                <img src="/assets/img/customer/actions/ac_edit.png" width="16px"
                                                    height="16px" border="0" title="Edit Customer">
                                                </a>
                                                <a href="#" style="text-decoration:none;display:inline-block;"
                                                    id="<?php echo $customer->prof_id; ?>"
                                                    title="Delete Customer" class="delete_cust">
                                                    <img src="https://app.creditrepaircloud.com/application/images/cross.png"
                                                        width="16px" height="16px" border="0">
                                                </a <a
                                                    href="mailto:<?= $customer->email; ?>"
                                                    style="text-decoration:none; display:inline-block;">
                                                <img src="/assets/img/customer/actions/ac_email.png" width="16px"
                                                    height="16px" border="0" title="Email Customer">
                                                </a>
                                                <a href="#" style="text-decoration:none; display:inline-block;">
                                                    <img src="/assets/img/customer/actions/ac_call.png" width="16px"
                                                        height="16px" border="0" title="Call Customer">
                                                </a>
                                                <a href="#" style="text-decoration:none; display:inline-block;">
                                                    <img src="/assets/img/customer/actions/ac_invoice.png" width="16px"
                                                        height="16px" border="0" title="Invoice Customer">
                                                </a>
                                                <a href="#" style="text-decoration:none; display:inline-block;">
                                                    <img src="/assets/img/customer/actions/ac_work.png" width="16px"
                                                        height="16px" border="0" title="Create Work Order">
                                                </a>
                                                <a href="#" style="text-decoration:none; display:inline-block;">
                                                    <img src="/assets/img/customer/actions/ac_ticket.png" width="16px"
                                                        height="16px" border="0" title="Create Service Ticket">
                                                </a>
                                                <a href="#" style="text-decoration:none; display:inline-block;">
                                                    <img src="/assets/img/customer/actions/ac_sched.png" width="16px"
                                                        height="16px" border="0" title="Schedule">
                                                </a>
                                                <a href="#" style="text-decoration:none; display:inline-block;">
                                                    <img src="/assets/img/customer/actions/ac_sms.png" width="16px"
                                                        height="16px" border="0" title="Message Customer">
                                                </a>
                                                <a href="<?php echo url('/customer/index/tab2/' . $customer->prof_id); ?>"
                                                    style="text-decoration:none; display:inline-block;">
                                                    <img src="https://app.creditrepaircloud.com/application/images/assign-contact.png"
                                                        border="0" title="View Profile">
                                                </a>-->
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/js/js_index'); ?>

<script type="text/javascript">
    function call(data) {
        window.open('tel:' + data);
    }
</script>
<style>
    .btn {
        font-size: 12px !important;
    }

    #sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 450px;
    }

    #sortable li {
        margin: 3px 3px 3px 0;
        padding: 1px;
        float: left;
        width: 100px;
        height: 90px;
        font-size: 4em;
        text-align: center;
    }

    .alarm_label,
    .alarm_answer {
        font-size: 12px !important;
    }

    .input_select {
        color: #363636;
        box-shadow: none;
        display: inline-block !important;
        background-color: #fff;
        background-clip: padding-box;
    }

    .dispute_link {
        text-decoration: none;
        color: #1e5da9 !important;
        margin-top: 2px !important;
    }

    div.dataTables_wrapper div.dataTables_filter {
        display: block !important;
    }

    label>input {
        /* HIDE RADIO */
        visibility: visible !important;
        /* Makes input not-clickable */
        position: inherit !important;
        /* Remove input from document flow */
    }
</style>

<script type="javascript">
    function initMap() {
        var input = document.getElementById('mail_add');
        var autocomplete = new google.maps.places.Autocomplete(input);
        console.log(autocomplete.getPlace());
    }
    $(document).ready(function () {

        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        $('.date_picker').val(new Date().toLocaleDateString());

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