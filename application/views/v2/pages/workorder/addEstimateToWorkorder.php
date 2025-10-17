<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>
<?php include viewPath('includes/workorder/sign-modal'); ?>
<?php include viewPath('v2/includes/customer/quick_add_customer'); ?>
<style>
.signature-container{
    height:300px;
}
.add-signature-button{
    background-color:#6a4a86;
    color:#ffffff;
    border: 1px solid #ced4da; 
    border-radius: 0.25rem; 
    min-height: 20px; 
    padding: 1rem;
}

#tbl-attachments td{
    padding:7px 10px 2px 0px;
}

@media only screen and (max-width: 480px) {
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
        <?php include viewPath('v2/includes/page_navigations/workorder_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <?php echo form_open_multipart('workorder/savenewWorkorderAgreement', ['class' => 'form-validate', 'id' => 'form_new_adi_workorder', 'autocomplete' => 'off']); ?>
                <input type="hidden" id="estimate_id" class="form-control" name="estimate_id" value="<?php echo !empty($estimate->id) ? $estimate->id : 0; ?>">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title d-block">
                                    <span class="d-block">Header</span>
                                </div>
                                <div class="nsm-card-controls">
                                    <button type="button" id="" data-bs-toggle="modal" data-bs-target="#update_header_modal" class="nsm-button primary small text-end"><strong>Edit</strong></button>  
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
                                <div class="row">
                                    <div class="col-12 col-md-10">
                                        <div id="header_text">
                                            <?php echo $headers->content; ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 text-md-end">
                                        <img style="width: 100%; max-width: 130px;" src="<?= businessProfileImage(logged('company_id')); ?>" />
                                    </div>
                                </div>
                                <div class="row g-2 mt-4">
                                    <div class="col-12 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">Lead Source</label>
                                        <select class="nsm-field form-select" name="lead_source" id="lead_source">
                                            <option value="0">- none -</option>
                                            <?php foreach ($lead_source as $lead) { ?>
                                                <option value="<?php echo $lead->ls_id; ?>"><?php echo $lead->ls_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
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
                                    <!-- <div class="col-12 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">Business Name (Optional)</label>
                                        <input type="text" name="business_name" id="business_name" class="nsm-field form-control" value="<?php echo $clients->business_name; ?>" />
                                    </div> -->
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
                                <?php 
                                    $default_items            = getWorkOrderStaticItems();
                                    $default_enhance_services = getWorkOrderStaticEnhancedServices();

                                    $default_items_name = [];

                                ?>
                                <table class="nsm-table_ itemTable">
                                    <thead>
                                        <th style="text-align:center;" data-name="Items">Items</th>
                                        <th style="text-align:center;" data-name="Quantity">QTY</th>
                                        <th style="text-align:center;" data-name="Existing">Existing Devices</th>
                                        <th style="text-align:center;" data-name="Location">Location</th>
                                        <th style="text-align:center;" data-name="Price">Price</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($default_items as $default_item_key => $default_item) { ?>
                                                <?php 
                                                    $default_items_name[] = $default_item['name'];
                                                    $default_item_data = [];
                                                    foreach($items_data as $item) {
                                                        if(strtolower($item->title) == strtolower($default_item['name'])) {
                                                            $default_item_data['qty']   = $item->qty;
                                                            $default_item_data['price'] = $item->price;
                                                        }
                                                    }
                                                ?>
                                                <?php if($default_item['sub']) {  ?>
                                                    <tr>
                                                        <td style="width: 35%">
                                                            <input type="text" class="nsm-field form-control" name="item[]" value="<?php echo $default_item['name']; ?>">
                                                            <input type="hidden" name="dataValue[]">                                                       
                                                        </td>
                                                        <td style="width: 10%"><input style="text-align:center;" type="text" class="nsm-field form-control allQty" name="qty[]" value="<?php echo !empty($default_item_data['qty']) ? $default_item_data['qty'] : 0; ?>"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="existing[]"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="location[]"></td>
                                                        <td style="width: 15%"><input style="text-align:center;" type="text" class="nsm-field form-control all-price-field allprices" name="price[]" value="<?php echo !empty($default_item_data['price']) ? number_format($default_item_data['price'],2) : number_format(0,2); ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="padding: 4px;">
                                                            <?php if($default_item['sub']) {  ?>
                                                                <div class="row g-2">
                                                                    <div class="col-auto d-flex align-items-center">
                                                                        <?php foreach($default_item['sub'] as $sub_key => $sub_item) { ?>
                                                                            <div class="form-check d-inline-block me-2 mb-0">
                                                                                <input class="form-check-input check-one-field" type="checkbox" name="checkOneOne" id="sub<?php echo $default_item['name']; ?>_<?php echo $sub_key; ?>" value="<?php echo $sub_item; ?>">
                                                                                <label class="form-check-label" for="toi_1"><?php echo $sub_item; ?></label>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>                                                            
                                                                </div>                                                        
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td style="width: 35%">
                                                            <input type="text" class="nsm-field form-control" name="item[]" value="<?php echo $default_item['name']; ?>">
                                                            <input type="hidden" name="dataValue[]">                                                        
                                                        </td>
                                                        <td style="width: 10%"><input style="text-align:center;" type="text" class="nsm-field form-control allQty" value="<?php echo !empty($default_item_data['qty']) ? $default_item_data['qty'] : 0; ?>"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="existing[]"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="location[]"></td>
                                                        <td style="width: 15%"><input style="text-align:center;" type="text" class="nsm-field form-control all-price-field allprices" name="price[]" value="<?php echo !empty($default_item_data['price']) ? number_format($default_item_data['price'],2) : number_format(0,2); ?>"></td>
                                                    </tr>
                                                <?php } ?>
                                        <?php } ?>
                                            <?php foreach($items_data as $item) { ?>
                                            <?php 
                                                $to_show = false;
                                                foreach($default_items as $default_item) {
                                                    if (!in_array($item->title, $default_items_name)) {
                                                        $to_show = true;
                                                    }
                                                }                                            
                                            ?>        
                                                <?php if($to_show) { ?>                                        
                                                    <tr>
                                                        <td style="width: 35%">
                                                            <input type="text" class="nsm-field form-control" name="item[]" value="<?php echo $item->title; ?>">
                                                            <input type="hidden" name="dataValue[]">                                                        
                                                        </td>
                                                        <td style="width: 10%"><input style="text-align:center;" type="text" class="nsm-field form-control allQty" name="qty[]" value="<?php echo !empty($item->qty) ? $item->qty : 0; ?>"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="existing[]"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="location[]"></td>
                                                        <td style="width: 15%"><input style="text-align:center;" type="text" class="nsm-field form-control all-price-field allprices" name="price[]" value="<?php echo !empty($item->price) ? number_format($item->price,2) : number_format(0,2); ?>"></td>
                                                    </tr> 
                                                <?php } ?>
                                            <?php } ?>                                  
                                        <tr>
                                            <td colspan="5" style="padding: 5px; text-align: center">
                                                <strong>ENHANCED SERVICES</strong>
                                            </td>
                                        </tr>
                                        <?php foreach($default_enhance_services as $default_enhance_service) { ?>

                                                <?php 
                                                    $default_es_data = [];
                                                    foreach($items_data as $item) {
                                                        if(strtolower($item->title) == strtolower($default_enhance_service['name'])) {
                                                            $default_es_data['qty']   = $item->qty;
                                                            $default_es_data['price'] = $item->price;
                                                        }
                                                    }
                                                ?>                                            

                                                <?php if($default_enhance_service['sub']) {  ?>
                                                    <tr>
                                                        <td style="width: 35%">
                                                            <input type="text" class="nsm-field form-control" name="item[]" value="<?php echo $default_enhance_service['name']; ?>">
                                                            <input type="hidden" name="dataValue[]">                                                        
                                                        </td>
                                                        <td style="width: 10%"><input style="text-align:center;" type="text" class="nsm-field form-control allQty" name="qty[]" value="<?php echo !empty($default_es_data['qty']) ? $default_es_data['qty'] : 0; ?>"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="existing[]"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="location[]"></td>
                                                        <td style="width: 15%"><input style="text-align:center;" type="text" class="nsm-field form-control all-price-field allprices" name="price[]" value="<?php echo !empty($default_es_data['price']) ? $default_es_data['price'] : number_format(0,2); ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="padding: 4px;">
                                                            <?php if($default_enhance_service['sub']) {  ?>
                                                                <div class="row g-2">
                                                                    <div class="col-auto d-flex align-items-center">
                                                                        <?php foreach($default_enhance_service['sub'] as $sub_key => $sub_item) { ?>
                                                                            <div class="form-check d-inline-block me-2 mb-0">
                                                                                <input class="form-check-input check-one-field" type="checkbox" name="checkOneOne" id="sub<?php echo $default_item['name']; ?>_<?php echo $sub_key; ?>" value="<?php echo $sub_item; ?>">
                                                                                <label class="form-check-label" for="toi_1"><?php echo $sub_item; ?></label>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>                                                            
                                                                </div>                                                        
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td style="width: 35%">
                                                            <input type="text" class="nsm-field form-control" name="item[]" value="<?php echo $default_enhance_service['name']; ?>">
                                                            <input type="hidden" name="dataValue[]">                                                        
                                                        </td>
                                                        <td style="width: 10%"><input style="text-align:center;" type="text" class="nsm-field form-control allQty" name="qty[]" value="<?php echo !empty($default_es_data['qty']) ? $default_es_data['qty'] : 0; ?>"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="existing[]"></td>
                                                        <td style="width: 20%"><input style="text-align:center;" type="text" class="nsm-field form-control" name="location[]"></td>
                                                        <td style="width: 15%"><input style="text-align:center;" type="text" class="nsm-field form-control all-price-field allprices" name="price[]" value="<?php echo !empty($default_es_data['price']) ? $default_es_data['price'] : number_format(0,2); ?>"></td>
                                                    </tr>
                                                <?php } ?>                                            

                                        <?php } ?>

                                        <?php foreach($items_data as $item) { ?>
                                            <?php 
                                                //$i_total_amount = $item->price * $item->qty;
                                            ?>
                                            <!-- <tr>
                                                <td>
                                                    <input type="text" class="nsm-field form-control" name="item[]" value="<?php //echo $item->title; ?>">
                                                    <input type="hidden" name="dataValue[]">
                                                </td>
                                                <td><input style="text-align:center;" type="text" class="nsm-field form-control" name="qty[]" value="<?php //echo $item->qty; ?>"></td>
                                                <td><input style="text-align:center;" type="text" class="nsm-field form-control" name="existing[]"></td>
                                                <td><input style="text-align:center;" type="text" class="nsm-field form-control" name="location[]"></td>
                                                <td><input style="text-align:center;" type="text" class="nsm-field form-control all-price-field allprices" name="price[]" value="<?php //echo number_format($i_total_amount,2); ?>"></td>
                                            </tr> -->
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php 
                        $customer_id = 0;
                        $customer_firstname = "";
                        $customer_lastname = "";
                        $business_name = "";

                        $cust_lead_name = '';
                        $cust_lead_id   = '';
                        $ssn            = '';
                        $job_location   = '';
                        $email          = '';
                        $phone_m        = '';
                        $phone_h        = '';
                        $password       = '';
                        $cust_lead      = '';

                        $c_city     = "";
                        $c_state    = "";
                        $c_postcode = "";
                        $c_county   = "";                        

                        if($customer) {
                            $customer_id = $customer->prof_id;
                            $customer_firstname = $customer->first_name;
                            $customer_lastname = $customer->last_name;
                        }

                        if( $estimate->customer_id > 0 ){
                            $cust_lead_name = $customer->first_name . ' ' . $customer->last_name;
                            $cust_lead_id = $estimate->customer_id;
                            $ssn = $customer->ssn;
                            $business_name = $customer->business_name;
                            $email = $customer->email;
                            $phone_m = $customer->phone_m;
                            $phone_h = $customer->phone_h;
                            $password = $acsAccess ? $acsAccess->access_password : '';

                            $job_location = $customer->mail_add . ', ' . $customer->city . ', ' . $customer->state . ' ' . $customer->zip_code;
                            $c_city = $customer->city;
                            $c_state = $customer->state;
                            $c_postcode = $customer->zip_code;
                            $c_county = $customer->county;

                            $cust_lead = 'Customer';
                        }elseif( $estimate->lead_id > 0 ){
                            $cust_lead_name = $lead->firstname . ' ' . $lead->lastname;
                            $cust_lead_id = $estimate->lead_id;
                            $ssn = $lead->ssn_num;
                            $email = $lead->email_add;
                            $phone_m = $lead->phone_cell;
                            $phone_h = $lead->phone_home;

                            $job_location = $lead->address . ', ' . $lead->city . ', ' . $lead->state . ' ' . $custleadomer->zip;
                            $c_city = $lead->city;
                            $c_state = $lead->state;
                            $c_postcode = $lead->zip;
                            $c_county = $lead->county;                            

                            $cust_lead = 'Lead';
                        }                        
                    ?>                    

                    <div class="col-12 col-md-6">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Password <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="password" class="nsm-field form-control" value="<?php echo $password; ?>" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">SSN (Optional)</label>
                                                <input type="text" name="ssn" class="nsm-field form-control number-field_two" value="<?php echo $ssn; ?>" placeholder="XXX-XX-XXXX">
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
                                                <label class="content-subtitle fw-bold d-block mb-2" style="float:left;">Customer</label>
                                                <a class="nsm-button btn-small" style="float:right;" id="btn-add-new-customer" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#quick-add-customer">
                                                    <strong>Add New Customer</strong>
                                                </a>
                                                <select id="customer_id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                                    <?php if( $customer->prof_id > 0){ ?>
                                                        <option selected="" value="<?= $customer->prof_id; ?>"><?= $customer_firstname . ' ' . $customer_lastname; ?></option>
                                                    <?php } ?>                                                     
                                                </select>
                                            </div>                                         

                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">First name</label>
                                                <input type="text" name="firstname" id="firstname" value="<?php echo $customer_firstname; ?>" class="nsm-field form-control name-field">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Last name</label>
                                                <input type="text" name="lastname" id="lastname" value="<?php echo $customer_lastname; ?>" class="nsm-field form-control name-field">
                                            </div>
                                            <div class="col-12 col-md-12" id="commercial_account">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Name</label>
                                                <input type="text" name="businessname" value="<?php echo $business_name; ?>" id="businessname" class="nsm-field form-control">
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
                                                <input type="text" name="city_form" value="<?php echo $c_city; ?>" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">State</label>
                                                <input type="text" name="state_form" value="<?php echo $c_state; ?>" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Postcode</label>
                                                <input type="text" name="postcode_form" value="<?php echo $c_postcode; ?>" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">County</label>
                                                <input type="text" name="county" value="<?php echo $c_county; ?>" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
                                                <input type="text" name="phone" value="<?php echo $phone_h; ?>" class="nsm-field form-control number-field">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Mobile</label>
                                                <input type="text" name="mobile" value="<?php echo $phone_m; ?>" class="nsm-field form-control number-field">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                                                <input type="email" name="email" value="<?php echo $email; ?>" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Emergency Contact</label>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">1st Emergency Contact</label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                                                <input type="text" name="first_ecn_first" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                                                <input type="text" name="first_ecn_last" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
                                                <input type="text" name="first_ecn_no" class="nsm-field form-control number-field">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">2nd Emergency Contact</label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                                                <input type="text" name="second_ecn_first" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                                                <input type="text" name="second_ecn_last" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
                                                <input type="text" name="second_ecn_no" class="nsm-field form-control number-field">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">3rd Emergency Contact</label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                                                <input type="text" name="third_ecn_first" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                                                <input type="text" name="third_ecn_last" class="nsm-field form-control">
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
                                                    <input type="number" step="any" name="installationCost" id="installationCost" class="nsm-field form-control text-end total-price total-price-click" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">One time (Program and Setup)</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" step="any" name="otps" id="otps" class="nsm-field form-control text-end total-price total-price-click" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">Monthly Monitoring</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" step="any" name="monthlyMonitoring" id="monthlyMonitoring" class="nsm-field form-control text-end total-price total-price-click" value="0.00">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <label class="content-title fw-normal">Total Due</label>
                                            </div>
                                            <div class="col-12 col-md-3 text-end">
                                                <label class="content-title">$ <span id="totalDue">0.00</span></label>
                                                <input type="hidden" name="totalDue" id="payment_amount_grand" value="0">
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
                                        <select name="payment_method" id="payment_method" class="nsm-field form-select" required>
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
                    <div class="col-12 col-md-6">
                        
                        <div class="nsm-card" style="height:auto;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title d-block">
                                    <span class="d-block">Attachments</span>
                                </div>
                            </div>
                            <div class="nsm-card-header mt-2">
                                <div class="nsm-card-title d-block">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <i class='bx bx-id-card' style="font-size:17px;position:relative;top:3px;"></i> <small><strong>ID</strong></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-11">
                                         <input class="form-control" type="file" name="attachment_id" accept="image/*" />
                                    </div>                                    
                                </div>
                            </div>
                            <hr />
                            <div class="nsm-card-header mt-2">
                                <div class="nsm-card-title d-block">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <i class='bx bx-file' style="font-size:17px;position:relative;top:3px;"></i> <small><strong>Documents</strong></small>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <a class="nsm-button btn-small" style="float:right;" id="btn-add-attachment" href="javascript:void(0);"><strong>+ Add File</strong></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                         <table class="table table-borderless" id="tbl-attachments">
                                            <tbody>
                                            <tr>
                                                <td><input class="form-control" type="file" name="attachments[]" accept="image/*" /></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            </tbody>
                                        </table>
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
                                        <div class="nsm-card-controls">
                                            <button type="button" id="" data-bs-toggle="modal" data-bs-target="#update_termscon_modal" class="nsm-button primary small text-end"><strong>Edit</strong></button>  
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <input type="hidden" class="form-control" name="terms_conditions" id="terms_conditions" value="<?php echo $terms_conditions->content; ?>" />
                                        <div class="row g-3">
                                            <div class="col-12" id="terms_and_condition_text">
                                                <?php echo $terms_conditions->content; ?>
                                            </div>                                            
                                        </div>
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
                                                
                                                <div id="companyrep" class="signature-container"></div>
                                                <div id="company_representative_div"></div>
                                                <input type="hidden" id="saveCompanySignatureDB1a" name="company_representative_approval_signature1a">
                                                <div class="d-flex mt-2 add-signature-button" id="cra_sign_container" role="button" data-bs-toggle="modal" data-bs-target="#company-representative-approval-signature">
                                                    <span class="m-auto">Click to add signature</span>
                                                    <!-- <img src="" id="companyrep" class="m-auto d-none"> -->
                                                    <!-- <div id="companyrep"></div> -->
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Primary Account Holder</label>
                                                <input type="text" name="primary_account_holder_name" id="primary_account_holder_name" class="nsm-field form-control" placeholder="Printed Name" />
                                                
                                                <div id="primaryrep" class="signature-container"></div>
                                                <div id="primary_representative_div"></div>
                                                <input type="hidden" id="savePrimaryAccountSignatureDB2a" name="primary_account_holder_signature2a">
                                                <div class="d-flex mt-2 add-signature-button" id="pah_sign_container" role="button" data-bs-toggle="modal" data-bs-target="#primary-account-holder-signature">
                                                    <span class="m-auto">Click to add signature</span>
                                                    <!-- <img src="" id="primaryrep" class="m-auto d-none"> -->
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Secondary Account Holder</label>
                                                <input type="text" name="secondery_account_holder_name" class="nsm-field form-control" placeholder="Printed Name" />

                                                <div id="secondaryrep" class="signature-container"></div>
                                                <div id="secondary_representative_div"></div>
                                                <input type="hidden" id="saveSecondaryAccountSignatureDB3a" name="secondary_account_holder_signature3a">
                                                <div class="d-flex mt-2 add-signature-button" id="sah_sign_container" role="button" data-bs-toggle="modal" data-bs-target="#secondary-account-holder-signature">
                                                    <span class="m-auto">Click to add signature</span>
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
                        <button type="submit" class="nsm-button primary">Save</button>
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
                        <button type="button" class="btn btn-primary saveCustomerEst">Save changes</button>
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
    getTotalPrice();

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

    $('#btn-add-new-customer').on('click', function(){
        $('#target-id-dropdown').val('customer_id');
    });

    //$('#customer_id').val(27714);
    $('#customer_id').select2({
        ajax: {
            url: '<?= base_url('autocomplete/_company_customer') ?>',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                q: params.term, // search term
                page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                results: data
                };
            },
            cache: true
            },
            placeholder: 'Select Customer',
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
    });

    function formatRepoCustomerSelection(repo) {
        if( repo.first_name != null ){
            return repo.first_name + ' ' + repo.last_name;      
        }else{
            return repo.text;
        }
    }

    function formatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }
        var $container = $(
            '<div class="contact-info"><i class="bx bx-user-pin"></i> '+repo.first_name + ' ' + repo.last_name+'<br><small><i class="bx bx-mobile"></i> '+repo.phone_m+' / <i class="bx bx-envelope"></i> '+repo.email+'</div>'
        );
        return $container;
    }

    $(document).on('keyup', '.number', function() {
        var a = $(this).val();
        $(this).val(numeral(a).format('0,0[.]00'));
    });

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

        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);          

        var url          = base_url+"workorder/_save_estimate_convert_to_workorder";
        let total_amount = $('#payment_amount_grand').val();       
        
        if( parseFloat(total_amount) <= 0 ){
            form_err_msg = 'Cannot accept 0 total amount due';
            Swal.fire({
            icon: 'error',
                title: 'Error!',
                html: form_err_msg
            });    
            _this.find("button[type=submit]").html("Submit");
            _this.find("button[type=submit]").prop("disabled", false);               
        }        
        
        var post_data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: url,
            data: post_data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(result) {
                Swal.fire({
                    title: 'Convert Estimate to Workorder',
                    html: result.msg,
                    icon: result.is_success == 1 ? 'success' : 'error',
                    showCloseButton: false,
                    showCancelButton: false,
                    confirmButtonColor: '#2ca01c',
                    confirmButtonText: 'Okay'
                }).then((res) => {
                    if(res.isConfirmed) {
                        if(result.is_success == 1) {
                            _this.trigger("reset");
                            window.location = base_url + "workorder";                        
                        } else {
                            _this.find("button[type=submit]").html("Submit");
                            _this.find("button[type=submit]").prop("disabled", false);                             
                        }
                    }
                });
            },
        });        
    });

    $("#form_new_adi_workorderOld").on("submit", function(e) {            
        e.preventDefault();
        var url = "<?php echo base_url('workorder/savenewWorkorderAgreement'); ?>";            

        let _this        = $(this);
        let form_valid   = 1;
        let form_err_msg = '';
        let total_amount = $('#payment_amount_grand').val();
        let customer_id  = $('#customer_id').val();

        if( parseFloat(total_amount) <= 0 ){
            form_valid = 0;
            form_err_msg = 'Cannot accept 0 total amount due';
        }

        /*if( parseFloat(customer_id) <= 0 ){
            form_valid = 0;
            form_err_msg = 'Please select customer';
        }*/

        if( form_valid == 1 ){
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
                        //if (result.value) {
                            location.reload();
                        //}
                    });

                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Submit");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        }else{
            Swal.fire({
            icon: 'error',
                title: 'Error!',
                html: form_err_msg
            });
        }
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

    $('.number-field_two').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{2})/, '-$1-');
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

    //Header
    $("#form_update_header").on("submit", function(e) {
        e.preventDefault();

        var url = "<?php echo base_url('workorder/save_update_header'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id: $("#update_h_id").val(),
                content: CKEDITOR.instances['editor3'].getData()
            },
            success: function(result) {
                // Swal.fire({
                //     //title: 'Save Successful!',
                //     text: "Header has been updated successfully.",
                //     icon: 'success',
                //     showCancelButton: false,
                //     confirmButtonText: 'Okay'
                // });

                $("#update_header_modal").modal('hide');
                $("#header_text").html(CKEDITOR.instances['editor3'].getData());
                $('.save_update_header').html("Save");
            },
            beforeSend:function(){
                $('.save_update_header').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    //Terms and condition
    $("#form_update_termscon").on("submit", function(e) {
        e.preventDefault();

        var url = "<?php echo base_url('workorder/save_update_tc'); ?>";
        var newContent = CKEDITOR.instances['editor-update-termscon'].getData();

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id: $("#update_tc_id").val(),
                content: newContent
            },
            success: function(result) {

                // Swal.fire({
                //     //title: 'Save Successful!',
                //     text: "Terms and Condition has been updated successfully.",
                //     icon: 'success',
                //     showCancelButton: false,
                //     confirmButtonText: 'Okay'
                // });

                $("#update_termscon_modal").modal('hide');
                $("#terms_and_condition_text").html(newContent);
                $('#btn-update-termscon').html("Save");
            },
            beforeSend:function(){
                $('#btn-update-termscon').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
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
    let val2 = 0;
    $('.allprices').each(function(key, index) {
        const qtyFields = document.querySelectorAll('.allQty');
        let qtyItem = qtyFields[key].value;
        let a  = $(this).val();
        let c  = $(this).val(numeral(a).format('0,0[.]00'));
        let am = $(this).val(a.replaceAll(",", ""));
        val2   += (parseFloat(c.val() * qtyItem) || 0);
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
    if( isNaN(val3) ){
        val3 = 0;
    }

    let val4 = $('#totalDue').html(val3.toFixed(2));

    $('.totalDue').val(val3.toFixed(2));
    $('#payment_amount_grand').val(val3.toFixed(2));
    $('#payment_amount').val(val3.toFixed(2));
}

window.addEventListener('DOMContentLoaded', (event) => {
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
                $("[name=city_form]").val(customer.city);
                $("[name=state_form]").val(customer.state);
                $("[name=postcode_form]").val(customer.zip_code);
                $("[name=county]").val(customer.country);
                $("[name=phone]").val(customer.phone_h);
                $("[name=mobile]").val(customer.phone_m);
                $("[name=email]").val(customer.email);
                $("[name=state_form]").val(customer.state);
                $("[name=businessname]").val(customer.business_name);
            }
        });
    }
});

$(document).on('click', '.saveCustomerEst', function() {

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

    if(first_name === '')
    {
        // alert('First Name is required.');
        $('[name="first_name"]').attr('required', 'required');
        $('[name="first_name"]').css('border-color', 'red');
    }
    else if(last_name === '')
    {
        // alert('Last Name is required.');
        $('[name="last_name"]').attr('required', 'required');
        $('[name="last_name"]').css('border-color', 'red');
        $('[name="first_name"]').css('border-color', '#ced4da');
    }
    else if(contact_email === '')
    {
        // alert('Email is required.');
        $('[name="contact_email"]').attr('required', 'required');
        $('[name="contact_email"]').css('border-color', 'red');
        $('[name="last_name"]').css('border-color', '#ced4da');
    }
    else if(contact_mobile === '')
    {
        // alert('Mobile is required.');
        $('[name="contact_mobile"]').attr('required', 'required');
        $('[name="contact_mobile"]').css('border-color', 'red');
        $('[name="contact_email"]').css('border-color', '#ced4da');
    }
    else{
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
    }

});

$(document).on('click','.customer_type',function(){
    // alert('test');
    if ($('input[name=customer_type]:checked').val() == "Commercial") {
        // alert('test');
        $('#business_name_area').show();

    } else {
        $('#business_name_area').hide();

    }
});

$(document).ready(function() {
    var options = {
    urlGetAll: base_url + "invoice/customer/json_list",
    urlGetAllJob: base_url + "invoice/job/json_list",
    urlAdd: base_url + "invoice/source/save/json",
    urlServiceAddressForm: base_url + "invoice/service_address_form",
    urlSaveServiceAddress: base_url + "invoice/save_service_address",
    urlGetServiceAddress: base_url + "invoice/json_get_address_services",
    urlRemoveServiceAddress: base_url + "invoice/remove_address_services",
    urlAdditionalContactForm: base_url + "invoice/new_customer_form",
    urlRecordPaymentForm: base_url + "invoice/record_payment_form",
    urlPayNowForm: base_url + "invoice/pay_now_form",
    urlSaveAdditionalContact: base_url + "invoice/save_new_customer",
    urlGetAdditionalContacts: base_url + "invoice/json_get_new_customers",
    urlRemoveInvoice: base_url + "invoice/delete",
    urlCloneInvoice: base_url + "invoice/clone",
    urlMarkAsSentInvoice: base_url + "invoice/mark_as_sent",
    urlSavePaymentRecord: base_url + "invoice/save_payment_record",
    urlPayNow: base_url + "invoice/stripePost",
    };


  // open additional contact form
  $("#modalNewCustomer").on("shown.bs.modal", function (e) {
    var element = $(this);
    $(element).find(".modal-body").html("loading...");

    var service_address_index = $(e.relatedTarget).attr("data-id");
    var inquiry_id = $(e.relatedTarget).attr("data-inquiry-id");

    if (service_address_index && inquiry_id) {
      $.ajax({
        url: options.urlAdditionalContactForm,
        type: "GET",
        data: {
          index: service_address_index,
          inquiry_id: inquiry_id,
          action: "edit",
        },
        success: function (response) {
          // console.log(response);

          $(element).find(".modal-body").html(response);
        },
      });
    } else {
      $.ajax({
        url: options.urlAdditionalContactForm,
        type: "GET",
        success: function (response) {
          $(element).find(".modal-body").html(response);
        },
      });
    }
  });

    $(".dob_customer_form").datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true
    });

    $(document).on('click', '.btn-remove-row-attachment', function(){
        $(this).closest('tr').remove();
    });

    $('#btn-add-attachment').on('click', function(){
        var tableBody = $("#tbl-attachments tbody");
        let rowCount = $('#tbl-attachments > tbody > tr').length + 1;
        if( rowCount < 10 ){
            let html = `
            <tr>
                <td><input class="form-control" type="file" name="attachments[]" /></td>
                <td><a href="javascript:void(0);" data-id="${rowCount}" class="btn-remove-row-attachment nsm-button danger" style="line-height:35px;"><i class='bx bx-trash'></i></a></td>
            </tr>`;

            tableBody.append(html);
        }else{
            Swal.fire({
            icon: 'error',
                title: 'Error!',
                html: 'Can only accept max 10 attachments'
            });
        }
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>