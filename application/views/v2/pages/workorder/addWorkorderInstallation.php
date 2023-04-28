<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>
<?php include viewPath('includes/workorder/sign-modal'); ?>
<style>
@media only screen and (max-width: 480px) {
    /* horizontal scrollbar for tables if mobile screen */
    /* .tablemobile {
        overflow-x: auto;
        display: block;
    } */
    table {
    display: flex;
    flex-flow: column;
    width: 100%;
}

thead {
    flex: 0 0 auto;
}

tbody {
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
}

tr {
    width: 100%;
    display: table;
    table-layout: fixed;
}

.itemTable td:nth-of-type(1) {width:30%;font-size:10px;}
.itemTable  td:nth-of-type(2) {width: 15%;}
.itemTable  td:nth-of-type(3) {width:15%;}
.itemTable  td:nth-of-type(4) {width:20%;}

.itemTable2 td:nth-of-type(1) {max-width:80px;}
.itemTable2  td:nth-of-type(2) {
    white-space:nowrap;
   /* border: 1px solid black; */
   max-width: 100px;
   overflow-y:hidden;
}
.itemTable th:nth-of-type(1) {width:30%;}
.itemTable  th:nth-of-type(2) {width: 15%;}
.itemTable  th:nth-of-type(3) {width: 15%;}
.itemTable  th:nth-of-type(4) {width:20%;}
.itemTable  th:nth-of-type(5) {width:20%;}


.itemTable input[type=text],
    input[type=email],
    input[type=number],
    input[type=url],
    /* input[type=checkbox], */
    input[type=password] {
    width: 100%;
    font-size:9px !important;
}

.itemTable th {
    font-size:9px !important;
}

}
</style>

<!-- Script for autosaving form -->
<!-- <script src="<?=base_url("assets/js/workorder/autosave-alarm.js")?>"></script> -->

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <?php echo form_open_multipart('workorder/savenewWorkorderAgreement', ['class' => 'form-validate', 'id' => 'form_new_adi_workorder', 'autocomplete' => 'off']); ?>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">Header</span>
                                    <div class="row">
                                        <div class="col-12 col-md-10">
                                            <label class="nsm-subtitle">
                                                <?php echo $headers->content; ?>
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-2 text-md-end">
                                            <img style="width: 100%; max-width: 100px;" src="<?php echo base_url() . 'assets/img/alarm_logo.jpeg' ?>" />
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $dt = new DateTime();
                                $timestamp = time();
                                ?>
                                <input type="hidden" id="headerID" name="header" value="<?php echo $headers->content; ?>">
                                <input type="hidden" id="current_date" name="current_date" value="<?php echo @date('m-d-Y'); ?>">
                                <input type="hidden" name="wo_id" value="<?php
                                                                            foreach ($ids as $id) {
                                                                                $add = $id->id + 1;
                                                                                echo $add;
                                                                            }
                                                                            ?>">
                                <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                                <input type="hidden" id="current_date" value="<?php echo date('m-d-Y'); ?>">
                                <input type="hidden" id="content_input" class="form-control" name="header2" value="<?php echo $headers->content; ?>">
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-3 d-none">
                                        <label class="content-subtitle fw-bold d-block mb-2">Work Order Number</label>
                                        <input type="text" name="workorder_number" id="workorder_number" class="nsm-field form-control" value="<?php echo "WO-";
                                                                                                                                                foreach ($number as $num) :
                                                                                                                                                    $next = $num->work_order_number;
                                                                                                                                                    $arr = explode("-", $next);
                                                                                                                                                    $date_start = $arr[0];
                                                                                                                                                    $nextNum = $arr[1];
                                                                                                                                                //    echo $number;
                                                                                                                                                endforeach;
                                                                                                                                                $val = $nextNum + 1;
                                                                                                                                                echo str_pad($val, 7, "0", STR_PAD_LEFT);
                                                                                                                                                ?>" readonly required />
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Lead Source</label>
                                        <select class="nsm-field form-select" name="lead_source" id="lead_source">
                                            <option value="0">- none -</option>
                                            <?php foreach ($lead_source as $lead) { ?>
                                                <option value="<?php echo $lead->ls_id; ?>"><?php echo $lead->ls_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Account Type</label>
                                        <select class="nsm-field form-select" name="account_type" id="account_type">
                                            <option value="">- none -</option>
                                            <option value="Residential">Residential</option>
                                            <option value="Commercial">Commercial</option>
                                            <option value="Rental">Rental</option>
                                            <option value="Inhouse">Inhouse</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">Security Data</label>
                                        <select class="nsm-field form-select" name="communication_type" id="communication_type">
                                            <option value="0">- none -</option>
                                            <?php foreach ($system_package_type as $lead) { ?>
                                                <option value="<?php echo $lead->name; ?>"><?php echo $lead->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">Panel Type</label>
                                        <select class="nsm-field form-select" name="panel_type" id="panel_type">
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == '') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="0">- none -</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'AERIONICS') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="AERIONICS">AERIONICS</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'AlarmNet') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="AlarmNet">AlarmNet</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Alarm.com') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Alarm.com">Alarm.com</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Alula') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Alula">Alula</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Bosch') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Bosch">Bosch</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'DSC') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="DSC">DSC</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'ELK') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="ELK">ELK</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'FBI') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="FBI">FBI</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'GRI') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="GRI">GRI</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'GE') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="GE">GE</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Honeywell') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Honeywell">Honeywell</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Honeywell Touch') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Honeywell Touch">Honeywell Touch</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Honeywell 3000') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Honeywell 3000">Honeywell 3000</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Honeywell') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Honeywell Vista">Honeywell Vista</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Honeywell Vista with Sem') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Honeywell Lyric') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Honeywell Lyric">Honeywell Lyric</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'IEI') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="IEI">IEI</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'MIER') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="MIER">MIER</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == '2 GIG') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="2 GIG">2 GIG</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == '2 GIG Go Panel 2') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == '2 GIG Go Panel 3') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Qolsys') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Qolsyx">Qolsys</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Qolsys IQ Panel 2') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Qolsys IQ Panel 2 Plus') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Qolsys IQ Panel 3') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Custom') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Custom">Custom</option>
                                            <option <?php if (isset($alarm_info)) {
                                                        if ($alarm_info->panel_type == 'Other') {
                                                            echo "selected";
                                                        }
                                                    } ?> value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">Jobs Tags</label>
                                        <select class="nsm-field form-select" name="job_tags" id="job_tags">
                                            <option value="0">- none -</option>
                                            <?php foreach ($job_tags as $jb) { ?>
                                                <option value="<?php echo $jb->id; ?>"><?php echo $jb->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">Items</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <!-- <div class="row g-3 mb-3 d-none d-md-flex">
                                    <div class="col-12 col-md-6"><label class="content-title text-muted">Items</label></div>
                                    <div class="col-12 col-md-2"><label class="content-title text-muted">Quantity</label></div>
                                    <div class="col-12 col-md-2"><label class="content-title text-muted">Location</label></div>
                                    <div class="col-12 col-md-2"><label class="content-title text-muted">Price</label></div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="Type of Install">
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-one-field" type="checkbox" name="checkOneOne" id="toi_1" value="New">
                                                    <label class="form-check-label" for="toi_1">New</label>
                                                </div>
                                                <div class="form-check d-inline-block mb-0">
                                                    <input class="form-check-input check-one-field" type="checkbox" name="checkOneOne" id="toi_2" value="Takeover">
                                                    <label class="form-check-label" for="toi_2">Takeover</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="checkedDataOne" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="LTE - Communicator">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Recessed Door Contact">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Surface Contact">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Keyless Remote">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Motion Detector">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Smoke Communicator">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Glass Break Detector">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Carbon Monoxide">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Medical Pendant">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Door Bell Camera">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Z-Thermostat">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Wifi-Card">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Z-Card">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="Z-Lock">
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-two-field" type="checkbox" name="checkOneTwo" id="zlock_1" value="BZ">
                                                    <label class="form-check-label" for="zlock_1">BZ</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-two-field" type="checkbox" name="checkOneTwo" id="zlock_2" value="BS">
                                                    <label class="form-check-label" for="zlock_2">BS</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-two-field" type="checkbox" name="checkOneTwo" id="zlock_3" value="CS">
                                                    <label class="form-check-label" for="zlock_3">CS</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="checkedDataTwo" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="WAP">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="IP-CAM (Indoor)">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="IP-CAM (Outdoor)">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Warranty ePaperwork">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Advertising Kit">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control" name="item[]" value="Certificate of Insurance">
                                        <input type="hidden" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="Translater">
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-three-field" type="checkbox" name="checkOneThree" id="trans_1" value="GE">
                                                    <label class="form-check-label" for="trans_1">GE</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-three-field" type="checkbox" name="checkOneThree" id="trans_2" value="HW">
                                                    <label class="form-check-label" for="trans_2">HW</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-three-field" type="checkbox" name="checkOneThree" id="trans_3" value="DSC">
                                                    <label class="form-check-label" for="trans_3">DSC</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="checkedDataThree" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <?php for ($i = 1; $i <= 2; $i++) { ?>
                                    <div class="row g-3 mt-1">
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="nsm-field form-control" name="item[]">
                                            <input type="hidden" name="dataValue[]">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                        </div>
                                        <div class="col-12 d-md-none">
                                            <hr>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 text-center">
                                        <label class="content-title">ENHANCED SERVICES</label>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="DVR">
                                        <input type="hidden" class="dtrans_check" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="d-flex align-items-center h-100">
                                            <div class="form-check me-2">
                                                <input class="form-check-input check-ctrans" type="checkbox" name="trans_check" id="trans_check_1" value="4ch">
                                                <label class="form-check-label" for="trans_check_1">4ch</label>
                                            </div>
                                            <div class="form-check me-2">
                                                <input class="form-check-input check-ctrans" type="checkbox" name="trans_check" id="trans_check_2" value="8ch">
                                                <label class="form-check-label" for="trans_check_2">8ch</label>
                                            </div>
                                            <div class="form-check me-2">
                                                <input class="form-check-input check-ctrans" type="checkbox" name="trans_check" id="trans_check_3" value="16ch">
                                                <label class="form-check-label" for="trans_check_3">16ch</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input check-ctrans" type="checkbox" name="trans_check" id="trans_check_4" value="32ch">
                                                <label class="form-check-label" for="trans_check_4">32ch</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="DVR">
                                        <input type="hidden" class="dtrans_check" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-12">
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_1" value="2">
                                                    <label class="form-check-label" for="cam_check_1">2</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_2" value="3">
                                                    <label class="form-check-label" for="cam_check_2">3</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_3" value="4">
                                                    <label class="form-check-label" for="cam_check_3">4</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_4" value="5">
                                                    <label class="form-check-label" for="cam_check_4">5</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_5" value="6">
                                                    <label class="form-check-label" for="cam_check_5">6</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_6" value="7">
                                                    <label class="form-check-label" for="cam_check_6">7</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_7" value="8">
                                                    <label class="form-check-label" for="cam_check_7">8</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_8" value="9">
                                                    <label class="form-check-label" for="cam_check_8">9</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-inputcheck-ccam" type="checkbox" name="cam_check" id="cam_check_9" value="10">
                                                    <label class="form-check-label" for="cam_check_9">10</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_10" value="11">
                                                    <label class="form-check-label" for="cam_check_10">11</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_11" value="12">
                                                    <label class="form-check-label" for="cam_check_11">12</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_12" value="13">
                                                    <label class="form-check-label" for="cam_check_12">13</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_13" value="14">
                                                    <label class="form-check-label" for="cam_check_13">14</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_14" value="15">
                                                    <label class="form-check-label" for="cam_check_14">15</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_15" value="16">
                                                    <label class="form-check-label" for="cam_check_15">16</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12 col-md-6">
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="text" class="nsm-field form-control fw-bold" name="item[]">
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-pers" type="checkbox" name="checkPers" id="check_pers_1" value="PERS">
                                                    <label class="form-check-label" for="check_pers_1">PERS</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2 mb-0">
                                                    <input class="form-check-input check-pers" type="checkbox" name="checkPers" id="check_pers_2" value="PERS w/Fall Detect">
                                                    <label class="form-check-label" for="check_pers_2">PERS w/Fall Detect</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="pers_check" name="dataValue[]">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                    </div>
                                    <div class="col-12 d-md-none">
                                        <hr>
                                    </div>
                                </div>
                                <?php for ($i = 1; $i <= 2; $i++) { ?>
                                    <div class="row g-3 mt-1">
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="nsm-field form-control" name="item[]">
                                            <input type="hidden" name="dataValue[]">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text" class="nsm-field form-control" name="qty[]" placeholder="Quantity">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text" class="nsm-field form-control" name="location[]" placeholder="Location">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text" class="nsm-field form-control all-price-field" name="price[]" placeholder="Price">
                                        </div>
                                        <div class="col-12 d-md-none">
                                            <hr>
                                        </div>
                                    </div>
                                <?php } ?> -->

                                <table class="nsm-table_ itemTable">
                                    <thead>
                                        <!-- <tr> -->
                                            <th style="text-align:center;" data-name="Items">Items</th>
                                            <th style="text-align:center;" data-name="Quantity">QTY</th>
                                            <th style="text-align:center;" data-name="Existing">Existing Devices</th>
                                            <th style="text-align:center;" data-name="Location">Location</th>
                                            <th style="text-align:center;" data-name="Price">Price</th>
                                        <!-- </tr> -->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="row g-2">
                                                    <div class="col">
                                                        <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="Type of Install">
                                                    </div>
                                                    <div class="col-auto d-flex align-items-center">
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-one-field" type="checkbox" name="checkOneOne" id="toi_1" value="New">
                                                            <label class="form-check-label" for="toi_1">New</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-one-field" type="checkbox" name="checkOneOne" id="toi_2" value="Takeover">
                                                            <label class="form-check-label" for="toi_2">Takeover</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="checkedDataOne" name="dataValue[]">
                                            </td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="LTE - Communicator">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Recessed Door Contact">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Surface Contact">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Keyless Remote">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Motion Detector">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Smoke Communicator">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Glass Break Detector">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Carbon Monoxide">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Medical Pendant">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Door Bell Camera">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Z-Thermostat">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Wifi-Card">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Z-Card">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row g-2">
                                                    <div class="col">
                                                        <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="Z-Lock">
                                                    </div>
                                                    <div class="col-auto d-flex align-items-center">
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-two-field" type="checkbox" name="checkOneTwo" id="zlock_1" value="BZ">
                                                            <label class="form-check-label" for="zlock_1">BZ</label>
                                                        </div>
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-two-field" type="checkbox" name="checkOneTwo" id="zlock_2" value="BS">
                                                            <label class="form-check-label" for="zlock_2">BS</label>
                                                        </div>
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-two-field" type="checkbox" name="checkOneTwo" id="zlock_3" value="CS">
                                                            <label class="form-check-label" for="zlock_3">CS</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="checkedDataTwo" name="dataValue[]">
                                            </td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="WAP">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="IP-CAM (Indoor)">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="IP-CAM (Outdoor)">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Warranty ePaperwork">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Advertising Kit">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="nsm-field form-control" name="item[]" value="Certificate of Insurance">
                                                <input type="hidden" name="dataValue[]">
                                            </td>
                                            <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row g-2">
                                                    <div class="col">
                                                        <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="Translater">
                                                    </div>
                                                    <div class="col-auto d-flex align-items-center">
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-three-field" type="checkbox" name="checkOneThree" id="trans_1" value="GE">
                                                            <label class="form-check-label" for="trans_1">GE</label>
                                                        </div>
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-three-field" type="checkbox" name="checkOneThree" id="trans_2" value="HW">
                                                            <label class="form-check-label" for="trans_2">HW</label>
                                                        </div>
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-three-field" type="checkbox" name="checkOneThree" id="trans_3" value="DSC">
                                                            <label class="form-check-label" for="trans_3">DSC</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="checkedDataThree" name="dataValue[]">
                                            </td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control" name="location[]"></td>
                                            <td style="vertical-align: top"><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <?php for ($i = 1; $i <= 2; $i++) { ?>
                                            <tr>
                                                <td>
                                                    <input type="text" class="nsm-field form-control" name="item[]">
                                                    <input type="hidden" name="dataValue[]">
                                                </td>
                                                <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                                <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                                <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <table class="nsm-table_ itemTable">
                                        <tr>
                                            <td colspan="5" class="text-center"><label class="content-title">ENHANCED SERVICES</label></td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;width:10%;">
                                                <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="DVR">
                                                <input type="hidden" class="dtrans_check" name="dataValue[]">
                                            </td>
                                            <td colspan="3">
                                                <div class="form-check d-inline-block  mb-0">
                                                    <input class="form-check-input check-ctrans" type="checkbox" name="trans_check" id="trans_check_1" value="4ch">
                                                    <label class="form-check-label" for="trans_check_1">4ch</label>
                                                </div>
                                                <div class="form-check d-inline-block  mb-0">
                                                    <input class="form-check-input check-ctrans" type="checkbox" name="trans_check" id="trans_check_2" value="8ch">
                                                    <label class="form-check-label" for="trans_check_2">8ch</label>
                                                </div>
                                                <div class="form-check d-inline-block  mb-0">
                                                    <input class="form-check-input check-ctrans" type="checkbox" name="trans_check" id="trans_check_3" value="16ch">
                                                    <label class="form-check-label" for="trans_check_3">16ch</label>
                                                </div>
                                                <div class="form-check d-inline-block mb-0">
                                                    <input class="form-check-input check-ctrans" type="checkbox" name="trans_check" id="trans_check_4" value="32ch">
                                                    <label class="form-check-label" for="trans_check_4">32ch</label>
                                                </div>
                                            </td>
                                            <td style="width:10%;"><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td  style="vertical-align: top;width:10%;">
                                                <input type="text" class="nsm-field form-control fw-bold" name="item[]" value="Cameras">
                                                <input type="hidden" class="dcam_check" name="dataValue[]">
                                            </td>
                                            <td colspan="3" style="vertical-align: top">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_1" value="2">
                                                            <label class="form-check-label" for="cam_check_1">2</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_2" value="3">
                                                            <label class="form-check-label" for="cam_check_2">3</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_3" value="4">
                                                            <label class="form-check-label" for="cam_check_3">4</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_4" value="5">
                                                            <label class="form-check-label" for="cam_check_4">5</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_5" value="6">
                                                            <label class="form-check-label" for="cam_check_5">6</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_6" value="7">
                                                            <label class="form-check-label" for="cam_check_6">7</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_7" value="8">
                                                            <label class="form-check-label" for="cam_check_7">8</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_8" value="9">
                                                            <label class="form-check-label" for="cam_check_8">9</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_9" value="10">
                                                            <label class="form-check-label" for="cam_check_9">10</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_10" value="11">
                                                            <label class="form-check-label" for="cam_check_10">11</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_11" value="12">
                                                            <label class="form-check-label" for="cam_check_11">12</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_12" value="13">
                                                            <label class="form-check-label" for="cam_check_12">13</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_13" value="14">
                                                            <label class="form-check-label" for="cam_check_13">14</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_14" value="15">
                                                            <label class="form-check-label" for="cam_check_14">15</label>
                                                        </div>
                                                        <div class="form-check d-inline-block mb-0">
                                                            <input class="form-check-input check-ccam" type="checkbox" name="cam_check" id="cam_check_15" value="16">
                                                            <label class="form-check-label" for="cam_check_15">16</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width:10%;"><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="">
                                                    <!-- <div class="col">
                                                        <input type="text" class="nsm-field form-control fw-bold" name="item[]">
                                                    </div> -->
                                                    <div class="col-auto d-flex align-items-center">
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-pers" type="checkbox" name="checkPers" id="check_pers_1" value="PERS">
                                                            <label class="form-check-label" for="check_pers_1">PERS</label>
                                                        </div>
                                                        <div class="form-check d-inline-block me-2 mb-0">
                                                            <input class="form-check-input check-pers" type="checkbox" name="checkPers" id="check_pers_2" value="PERS w/Fall Detect">
                                                            <label class="form-check-label" for="check_pers_2">PERS w/Fall Detect</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="pers_check" name="dataValue[]">
                                            </td>
                                            <!-- <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                            <td><input type="text" class="nsm-field form-control" name="location[]"></td>-->
                                            <td style="width:10%;"><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td> 
                                        </tr>
                                        <?php for ($i = 1; $i <= 2; $i++) { ?>
                                            <tr>
                                                <td>
                                                    <input type="text" class="nsm-field form-control" name="item[]">
                                                    <input type="hidden" name="dataValue[]">
                                                </td>
                                                <td><input type="text" class="nsm-field form-control" name="qty[]"></td>
                                                <td><input type="text" class="nsm-field form-control" name="existing[]"></td>
                                                <td><input type="text" class="nsm-field form-control" name="location[]"></td>
                                                <td><input type="text" class="nsm-field form-control all-price-field allprices" name="price[]"></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Password <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="password" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">SSN (Optional)</label>
                                                <input type="text" name="ssn" class="nsm-field form-control number-field" placeholder="XXX-XX-XXXX">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="d-block">Please Fill in the Details</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Customer (Optional)</label>
                                                
                                                <a class="link-modal-open" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalNewCustomer" style="color:#02A32C;float:right;"><span class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Customer</a>
                                                <select id="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                    <option selected hidden>Select Customer</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">First name</label>
                                                <input type="text" name="firstname" id="firstname" class="nsm-field form-control name-field">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Last name</label>
                                                <input type="text" name="lastname" id="lastname" class="nsm-field form-control name-field">
                                            </div>
                                            <div class="col-12 d-none" id="commercial_account">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Name</label>
                                                <input type="text" name="businessname" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">First name (Spouse)</label>
                                                <input type="text" name="firstname_spouse" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Last name (Spouse)</label>
                                                <input type="text" name="lastname_spouse" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                                                <input type="text" name="address" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">City</label>
                                                <input type="text" name="city" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">State</label>
                                                <input type="text" name="state" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Postcode</label>
                                                <input type="text" name="postcode" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">County</label>
                                                <input type="text" name="county" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
                                                <input type="text" name="phone" class="nsm-field form-control number-field">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Mobile</label>
                                                <input type="text" name="mobile" class="nsm-field form-control number-field">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                                                <input type="email" name="email" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">1st Emergency Contact Name</label>
                                                <input type="text" name="first_ecn" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
                                                <input type="text" name="first_ecn_no" class="nsm-field form-control number-field">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">2nd Emergency Contact Name</label>
                                                <input type="text" name="second_ecn" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
                                                <input type="text" name="second_ecn_no" class="nsm-field form-control number-field">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">3rd Emergency Contact Name</label>
                                                <input type="text" name="third_ecn" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
                                                <input type="text" name="third_ecn_no" class="nsm-field form-control number-field">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">Equipment Cost</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <label class="content-title">$ <span class="equipment_cost">0.00</span></label>
                                                <input type="hidden" name="equipmentCost" id="equipmentCost" value="0">
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">Sales Tax</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <label class="content-title">$ <span class="sales_tax_total">0.00</span></label>
                                                <input type="hidden" name="salesTax" id="salesTax" value="0">
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">Installation Cost</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" name="installationCost" id="installationCost" class="nsm-field form-control text-end total-price total-price-click" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">One time (Program and Setup)</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" name="otps" id="otps" class="nsm-field form-control text-end total-price total-price-click" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">Monthly Monitoring</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" name="monthlyMonitoring" id="monthlyMonitoring" class="nsm-field form-control text-end total-price total-price-click" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">Total Due</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <label class="content-title">$ <span id="totalDue">0.00</span></label>
                                                <input type="hidden" name="totalDue" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Installation Date</label>
                                        <input type="text" name="installation_date" class="nsm-field form-control datepicker">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Install Time</label>
                                        <select name="intall_time" class="nsm-field form-select">
                                            <option value="8-10">8-10</option>
                                            <option value="10-12">10-12</option>
                                            <option value="12-2">12-2</option>
                                            <option value="2-4">2-4</option>
                                            <option value="4-6">4-6</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="nsm-field form-select">
                                            <option value="">Choose method</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Check">Check</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Debit Card">Debit Card</option>
                                            <option value="ACH">ACH</option>
                                            <option value="Venmo">Venmo</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Square">Square</option>
                                            <option value="Invoicing">Invoicing</option>
                                            <option value="Warranty Work">Warranty Work</option>
                                            <option value="Home Owner Financing">Home Owner Financing</option>
                                            <option value="e-Transfer">e-Transfer</option>
                                            <option value="Other Credit Card Professor">Other Credit Card Professor</option>
                                            <option value="Other Payment Type">Other Payment Type</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Amount ( $ )</label>
                                        <input step=".01" type="number" name="payment_amount" id="payment_amount" class="nsm-field form-control" required />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Billing Date</label>
                                        <select name="billing_date" class="nsm-field form-select">
                                            <option value="">0</option>
                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 d-none" id="invoicing">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="same_as">
                                                    <label class="form-check-label" for="same_as">Same as above Address</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Mail Address</label>
                                                <input type="text" name="mail-address" class="nsm-field form-control" placeholder="Monitored Location" />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">City</label>
                                                <input type="text" name="mail_locality" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">State</label>
                                                <input type="text" name="mail_state" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">ZIP</label>
                                                <input type="text" name="mail_postcode" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">Cross Street</label>
                                                <input type="text" name="mail_cross_street" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="check_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Check Number</label>
                                                <input type="text" name="check_number" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Routing Number</label>
                                                <input type="text" name="routing_number" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Number</label>
                                                <input type="text" name="account_number" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="credit_card">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                <input type="text" name="credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                <input type="text" name="credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                <input type="text" name="credit_cvc" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="debit_card">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                <input type="text" name="debit_credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                <input type="text" name="debit_credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                <input type="text" name="debit_credit_cvc" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="ach_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Routing Number</label>
                                                <input type="text" name="ach_routing_number" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Number</label>
                                                <input type="text" name="ach_account_number" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="venmo_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                <input type="text" name="account_credentials" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                <input type="text" name="account_note" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                <input type="text" name="confirmation" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="paypal_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                <input type="text" name="paypal_account_credentials" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                <input type="text" name="paypal_account_note" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                <input type="text" name="paypal_confirmation" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="square_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                <input type="text" name="square_account_credentials" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                <input type="text" name="square_account_note" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                <input type="text" name="square_confirmation" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="warranty_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                <input type="text" name="warranty_account_credentials" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                <input type="text" name="warranty_account_note" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="home_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                <input type="text" name="home_account_credentials" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                <input type="text" name="home_account_note" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="e_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                <input type="text" name="e_account_credentials" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                <input type="text" name="e_account_note" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="other_credit_card">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                <input type="text" name="other_credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                <input type="text" name="other_credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                <input type="text" name="other_credit_cvc" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="other_payment_area">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                <input type="text" name="other_payment_account_credentials" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                <input type="text" name="other_payment_account_note" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Notes</label>
                                        <textarea name="notes" class="nsm-field form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Sales Rep's Name</label>
                                        <input type="text" name="sales_re_name" class="nsm-field form-control" value="<?php echo logged('FName') . ' ' . logged('LName'); ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Cell Phone</label>
                                        <input type="text" name="sale_rep_phone" class="nsm-field form-control number-field" value="<?php echo logged('mobile'); ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Team Leader / Mentor</label>
                                        <input type="text" name="team_leader" class="nsm-field form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title d-block">
                                            <span class="d-block">Agreement</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <?php echo $terms_conditions->content; ?></p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Company Representative Approval</label>
                                                <select class="nsm-field form-select" name="company_representative_printed_name">
                                                    <option value="0">Select Name</option>
                                                    <?php foreach ($users_lists as $ulist) { ?>
                                                        <option <?php if ($ulist->id == logged('id')) {
                                                                    echo "selected";
                                                                } ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName . ' ' . $ulist->LName; ?></option>
                                                    <?php } ?>
                                                </select>
                                                
                                                <div id="companyrep"></div>
                                                <div id="company_representative_div"></div>
                                                <input type="hidden" id="saveCompanySignatureDB1a" name="company_representative_approval_signature1a">
                                                <div class="d-flex mt-2" id="cra_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 20px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#company-representative-approval-signature">
                                                    <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                                    <!-- <img src="" id="companyrep" class="m-auto d-none"> -->
                                                    <!-- <div id="companyrep"></div> -->
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Primary Account Holder</label>
                                                <input type="text" name="primary_account_holder_name" id="primary_account_holder_name" class="nsm-field form-control" placeholder="Printed Name" />
                                                
                                                <div id="primaryrep"></div>
                                                <div id="primary_representative_div"></div>
                                                <input type="hidden" id="savePrimaryAccountSignatureDB2a" name="primary_account_holder_signature2a">
                                                <div class="d-flex mt-2" id="pah_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 20px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#primary-account-holder-signature">
                                                    <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                                    <!-- <img src="" id="primaryrep" class="m-auto d-none"> -->
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Secondary Account Holder</label>
                                                <input type="text" name="secondery_account_holder_name" class="nsm-field form-control" placeholder="Printed Name" />

                                                <div id="secondaryrep"></div>
                                                <div id="secondary_representative_div"></div>
                                                <input type="hidden" id="saveSecondaryAccountSignatureDB3a" name="secondary_account_holder_signature3a">
                                                <div class="d-flex mt-2" id="sah_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 20px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#secondary-account-holder-signature">
                                                    <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                                    <!-- <img src="" id="secondaryrep" class="m-auto d-none"> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="nsm-button" onclick="location.href='<?php echo url('workorder') ?>'">Cancel</button>
                        <button type="submit" class="nsm-button">Send to Customer</button>
                        <button type="submit" class="nsm-button primary" value="submit">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        

        <!-- Modal New Customer -->
        <div class="modal fade nsm-modal" id="modalNewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bx bx-fw bx-x m-0"></i>

                        </button>
                    </div>
                    <div class="modal-body pt-0 pl-3 pb-3"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary saveCustomer">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>




<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script type="text/javascript">
    
jQuery(function($){

// Replace 'td' with your html tag
$(".nsm-subtitle").html(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).html().replace("{curr_date}", currentDate);  

});
});
    $(document).ready(function() {
        const numInputs = document.querySelectorAll('input[type=number]')

        numInputs.forEach(function(input) {
            input.addEventListener('change', function(e) {
                if (e.target.value == '') {
                e.target.value = 0
                }
            })
        });

        $(".name-field").on("keyup", function() {
            var one = $('#firstname').val();
            var two = $('#lastname').val();
            $('#primary_account_holder_name').val(one + ' ' + two);
        });

        $("#account_type").on("change", function() {
            let _this = $(this);

            if (_this.val() == "Commercial") {
                $("#commercial_account").removeClass("d-none");
            } else {
                $("#commercial_account").addClass("d-none");
            }
        });

        $(".total-price").on("blur", function() {
            getTotalPrice();
        });

        $(document).on('keyup', '.number', function() {
        var a = $(this).val();
        $(this).val(numeral(a).format('0,0[.]00'));
        });

        // $(".total-price-click").on("click", function() {
        //     $(this).val('');
        // });

        // $(".total-price-click").on("blur", function() {
        //     var a = $(this).val();
        //     if (empty(a))
        //     {
        //         $(this).val('0');
        //     }else
        //     {
        //         $(this).val(a);
        //     }
        // });

        $(".all-price-field").on("keyup", function() {
            getTotalPrice();
        });

        $('.check-one-field').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            $('.checkedDataOne').val(this.value);
        });

        $('.check-two-field').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            $('.checkedDataTwo').val(this.value);
        });

        $('.check-three-field').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            $('.checkedDataThree').val(this.value);
        });

        $('.check-ctrans').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            $('.dtrans_check').val(this.value);
        });

        $('.check-pers').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            $('.pers_check').val(this.value);
        });

        $('.check-ccam').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            $('.dcam_check').val(this.value);
        });

        $("#form_new_adi_workorder").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('workorder/savenewWorkorderAgreement'); ?>";
            _this.find("button[type=submit]").html("Submitting");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Workorder has been saved successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Submit");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(".datepicker").datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });

        $('.number-field').keyup(function() {
            var val = this.value.replace(/\D/g, '');
            val = val.replace(/^(\d{3})/, '$1-');
            val = val.replace(/-(\d{3})/, '-$1-');
            val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
            this.value = val;
        });

        $("#payment_method").on("change", function() {
            let paymentMethod = $(this).val();

            hideAllPaymentMethods();
            switch (paymentMethod) {
                case "Cash":
                    $("#cash_area").removeClass("d-none");
                    break;
                case "Invoicing":
                    $("#invoicing").removeClass("d-none");
                    break;
                case "Check":
                    $("#check_area").removeClass("d-none");
                    break;
                case "Credit Card":
                    $("#credit_card").removeClass("d-none");
                    break;
                case "Debit Card":
                    $("#debit_card").removeClass("d-none");
                    break;
                case "ACH":
                    $("#ach_area").removeClass("d-none");
                    break;
                case "Venmo":
                    $("#venmo_area").removeClass("d-none");
                    break;
                case "Paypal":
                    $("#paypal_area").removeClass("d-none");
                    break;
                case "Square":
                    $("#square_area").removeClass("d-none");
                    break;
                case "Warranty Work":
                    $("#warranty_area").removeClass("d-none");
                    break;
                case "Home Owner Financing":
                    $("#home_area").removeClass("d-none");
                    break;
                case "e-Transfer":
                    $("#e_area").removeClass("d-none");
                    break;
                case "Other Credit Card Professor":
                    $("#other_credit_card").removeClass("d-none");
                    break;
                case "Other Payment Type":
                    $("#other_payment_area").removeClass("d-none");
                    break;
            }
        });

        // var signaturePad;
        // jQuery(document).ready(function() {
        //     var signaturePadCanvas = document.querySelector('#canvasb');
        //     signaturePad = new SignaturePad(signaturePadCanvas);
        //     signaturePadCanvas.height = 300;
        //     signaturePadCanvas.width = 680;
        // });

        // $(document).on('click touchstart', '#canvasb', function() {
        //     var canvas_web = document.getElementById("canvasb");
        //     var dataURL = canvas_web.toDataURL("image/png");
        //     $("#saveCompanySignatureDB1a").val(dataURL);
        // });

        // $("#btn_save_cra_signature").on("click", function() {
        //     $("#companyrep").attr("src", $("#saveCompanySignatureDB1a").val());
        //     $("#companyrep").removeClass("d-none");
        //     $("#cra_sign_container").find("span").addClass("d-none");
        //     $("#add_cra_sign_modal").modal("hide");
        // });

        // $('#btn_clear_cra_signature').click(function() {
        //     $('#cra_sign_area').signaturePad().clearCanvas();
        // });

        // var signaturePad;
        // jQuery(document).ready(function() {
        //     var signaturePadCanvas = document.querySelector('#canvas2b');
        //     signaturePad = new SignaturePad(signaturePadCanvas);
        //     signaturePadCanvas.height = 300;
        //     signaturePadCanvas.width = 680;
        // });

        // $(document).on('click touchstart', '#canvas2b', function() {
        //     var canvas_web = document.getElementById("canvas2b");
        //     var dataURL = canvas_web.toDataURL("image/png");
        //     $("#savePrimaryAccountSignatureDB2a").val(dataURL);
        // });

        // $("#btn_save_pah_signature").on("click", function() {
        //     $("#primaryrep").attr("src", $("#savePrimaryAccountSignatureDB2a").val());
        //     $("#primaryrep").removeClass("d-none");
        //     $("#pah_sign_container").find("span").addClass("d-none");
        //     $("#add_pah_sign_modal").modal("hide");
        // });

        // $('#btn_clear_pah_signature').click(function() {
        //     $('#pah_sign_area').signaturePad().clearCanvas();
        // });

        // var signaturePad;
        // jQuery(document).ready(function() {
        //     var signaturePadCanvas = document.querySelector('#canvas3b');
        //     signaturePad = new SignaturePad(signaturePadCanvas);
        //     signaturePadCanvas.height = 300;
        //     signaturePadCanvas.width = 680;
        // });

        // $(document).on('click touchstart', '#canvas3b', function() {
        //     var canvas_web = document.getElementById("canvas3b");
        //     var dataURL = canvas_web.toDataURL("image/png");
        //     $("#saveSecondaryAccountSignatureDB3a").val(dataURL);
        // });

        // $("#btn_save_sah_signature").on("click", function() {
        //     $("#secondaryrep").attr("src", $("#saveSecondaryAccountSignatureDB3a").val());
        //     $("#secondaryrep").removeClass("d-none");
        //     $("#sah_sign_container").find("span").addClass("d-none");
        //     $("#add_sah_sign_modal").modal("hide");
        // });

        // $('#btn_clear_sah_signature').click(function() {
        //     $('#sah_sign_area').signaturePad().clearCanvas();
        // });

        $("#payment_method").on("change", function() {
            let paymentMethod = $(this).val();

            hideAllPaymentMethods();
            switch (paymentMethod) {
                case "Cash":
                    $("#cash_area").removeClass("d-none");
                    break;
                case "Invoicing":
                    $("#invoicing").removeClass("d-none");
                    break;
                case "Check":
                    $("#check_area").removeClass("d-none");
                    break;
                case "Credit Card":
                    $("#credit_card").removeClass("d-none");
                    break;
                case "Debit Card":
                    $("#debit_card").removeClass("d-none");
                    break;
                case "ACH":
                    $("#ach_area").removeClass("d-none");
                    break;
                case "Venmo":
                    $("#venmo_area").removeClass("d-none");
                    break;
                case "Paypal":
                    $("#paypal_area").removeClass("d-none");
                    break;
                case "Square":
                    $("#square_area").removeClass("d-none");
                    break;
                case "Warranty Work":
                    $("#warranty_area").removeClass("d-none");
                    break;
                case "Home Owner Financing":
                    $("#home_area").removeClass("d-none");
                    break;
                case "e-Transfer":
                    $("#e_area").removeClass("d-none");
                    break;
                case "Other Credit Card Professor":
                    $("#other_credit_card").removeClass("d-none");
                    break;
                case "Other Payment Type":
                    $("#other_payment_area").removeClass("d-none");
                    break;
            }
        });
    });

    function hideAllPaymentMethods() {
        $("#cash_area").addClass("d-none");
        $("#invoicing").addClass("d-none");
        $("#check_area").addClass("d-none");
        $("#credit_card").addClass("d-none");
        $("#debit_card").addClass("d-none");
        $("#ach_area").addClass("d-none");
        $("#venmo_area").addClass("d-none");
        $("#paypal_area").addClass("d-none");
        $("#square_area").addClass("d-none");
        $("#warranty_area").addClass("d-none");
        $("#home_area").addClass("d-none");
        $("#e_area").addClass("d-none");
        $("#other_credit_card").addClass("d-none");
        $("#other_payment_area").addClass("d-none");
    }

    function getTotalPrice() {
        // alert('test');
        let val2 = 0;
        $('.allprices').each(function() {

            let a = $(this).val();

            let c = $(this).val(numeral(a).format('0,0[.]00'));
            let am = $(this).val(a.replaceAll(",", ""));
            val2 += (parseFloat(c.val()) || 0);
        });

        let installationCost = $('#installationCost').val();
        let otps = $('#otps').val();
        let monthlyMonitoring = $('#monthlyMonitoring').val();

        let eq = val2;
        $('#equipmentCost').val(eq.toFixed(2));
        $('.equipment_cost').html(eq.toFixed(2));

        let ec = $('#equipmentCost').val();

        let grandtaxes = (parseFloat(ec) * (7.5 / 100));
        $('#salesTax').val(grandtaxes)
        let salesTax = $('#salesTax').val();
        $('.sales_tax_total').html(grandtaxes.toFixed(2));

        let overAllTotal = parseFloat(val2) + parseFloat(salesTax) + parseFloat(installationCost) + parseFloat(otps) + parseFloat(monthlyMonitoring);

        let val3 = overAllTotal;

        let val4 = $('#totalDue').html(val3.toFixed(2));
        console.log(val3);
        $('.totalDue').val(val3.toFixed(2));
        $('#payment_amount').val(val3.toFixed(2));
    }
</script>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#customer_id').select2({
            ajax: {
                url: '<?= base_url('autocomplete/_company_customer') ?>',
                dataType: 'json',
                delay: 250,
                cache: true,
                data: function (params) {
                    return { q: params.term, page: params.page };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return { results: data };
                }
            },
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: (repo) => {
                return "first_name" in repo ? `${repo.first_name} ${repo.last_name}` : repo.text
            }
        });

        function formatRepoCustomer(repo) {
            if (repo.loading) {
                return repo.text;
            }

            return $(
                '<div>'+repo.first_name + ' ' + repo.last_name +'<br><small>'+repo.phone_m+' / '+repo.email+'</small></div>'
            );
        }

        $("#customer_id").on( 'change', function () {
            if(this.value !== ""){
                autoFillCustomer(this.value);
            }
        });

        function autoFillCustomer(customerId){
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/job/get_customer_selected",
                data: { id : customerId },
                success: function(data) {
                    const {data: customer} = JSON.parse(data);
                    $("[name=firstname]").val(customer.first_name);
                    $("[name=lastname]").val(customer.last_name);
                    $("[name=address]").val(customer.mail_add);
                    $("[name=city]").val(customer.city);
                    $("[name=state]").val(customer.state);
                    $("[name=postcode]").val(customer.zip_code);
                    $("[name=country]").val(customer.country);
                    $("[name=phone]").val(customer.phone_h);
                    $("[name=mobile]").val(customer.phone_m);
                    $("[name=email]").val(customer.email);
                    $("[name=state]").val(customer.state);
                }
            });
        }
    });
</script>

<script>
$(document).on('click', '.saveCustomer', function() {

    var first_name      = $('[name="first_name"]').val();
    var middle_name     = $('[name="middle_name"]').val();
    var last_name       = $('[name="last_name"]').val();
    var contact_email   = $('[name="contact_email"]').val();
    var contact_mobile  = $('[name="contact_mobile"]').val();
    var contact_phone   = $('[name="contact_phone"]').val();
    var customer_type   = $('[name="customer_type"]').val();
    var street_address  = $('[name="street_address"]').val();
    var suite_unit      = $('[name="suite_unit"]').val();
    var city            = $('[name="city"]').val();
    var postcode        = $('[name="postcode"]').val();
    var state           = $('[name="state"]').val();

    //new added
    var suffix_name             = $('[name="suffix_name"]').val();
    var date_of_birth           = $('[name="date_of_birth"]').val();
    var social_security_number  = $('[name="social_security_number"]').val();
    var status                  = $('[name="status"]').val();

    // alert(first_name);

                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>estimate/addNewCustomer",
                    data: {
                        first_name: first_name,
                        middle_name: middle_name,
                        last_name: last_name,
                        contact_email: contact_email,
                        contact_mobile: contact_mobile,
                        contact_phone: contact_phone,
                        customer_type: customer_type,
                        street_address: street_address,
                        suite_unit: suite_unit,
                        city: city,
                        postcode: postcode,
                        state: state,
                        suffix_name: suffix_name,
                        date_of_birth: date_of_birth,
                        social_security_number: social_security_number,
                        status: status
                    },
                    dataType: 'json',
                    success: function(response) {
                        // alert('success');
                        location.reload();
                    },
                    error: function(response) {
                        location.reload();

                    }
                });

});
</script>

<script>
// jQuery(document).ready(function () {
//     $(document).on('click','#customer_type',function(){
//         var values = $(this).val();
//         alert(values);
//     });
    $(document).on('click','.customer_type',function(){
        // alert('test');
        if ($('input[name=customer_type]:checked').val() == "Commercial") {
            // alert('test');
            $('#business_name_area').show();

        } else {
            $('#business_name_area').hide();

        }
    });
// });
</script>   
<?php include viewPath('v2/includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/add.js"></script>