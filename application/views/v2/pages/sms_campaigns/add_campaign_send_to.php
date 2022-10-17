<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

<style>
    div[wrapper__section] {
        padding: 60px 10px !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
    .tabs-menu {
        margin-bottom: 20px;
        padding: 0;
        margin-top: 20px;
    }
    .tabs-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .md-right {
      float: right;
      width: max-content;
      display: block;
      padding-right: 0px;
    }
    .tabs-menu .active, .tabs-menu .active a {
        color: #2ab363;
    }
    .tabs-menu li {
        float: left;
        margin: 0;
        padding: 0px 83px 0px 0px;
        font-weight: 600;
        font-size: 17px;
    }
    .radio-sec input:checked+label::before {
        padding: 2px 0px 0px 6px;
    }
    .group-list{
        display: flex;
    }
    .group-list li{
        display: list-item;
        margin: 15px;
    }
    .radio-sec {
        display: inline-block;
        padding: 0;
        margin: 12px 8px;
        line-height: 1.2em;
    }
    .group-list{
        display: flex;
        list-style: none;
        margin: 0px;
        padding: 0px;
    }
    .group-list li{
        display: list-item;
        margin: 15px;
    }
    .count-summary{
        font-size: 16px;
        margin-bottom: 10px;
        background-color: #6a4a86;
        width: 30%;
        color: #ffffff;
        padding: 6px;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            <div>Start a new SMS campaign to promote your business.</div>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('sms_campaigns/save_send_to', ['class' => 'form-validate', 'id' => 'create_campaign_send_to', 'autocomplete' => 'off']); ?>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li>1. Edit Campaign</li>
                          <li class="active">2. Select Customers</li>
                          <li>3. Build SMS</li>
                          <li>4. Preview</li>
                          <li>5. Purchase</li>
                        </ul>
                    </div>                    
                    <div class="row">
                        <div class="col-12">
                            <div class="nsm-card">
                                <div class="nsm-card-content">
                                    <div class="col-md-12">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="title"><b>Who are you sending to?</b></label><br /><br />
                                                <?php if($smsCampaign){ ?>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="to_type" value="1" id="to_type_1" <?= $smsCampaign->sending_type == 1 ? 'checked="checked"' : ''; ?> checked="checked">
                                                        <label for="to_type_1">All my customers with phone</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="to_type" value="2" id="to_type_3" <?= $smsCampaign->sending_type == 2 ? 'checked="checked"' : ''; ?>>
                                                        <label for="to_type_3">To a customer group</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="to_type" value="3" id="to_type_2" <?= $smsCampaign->sending_type == 3 ? 'checked="checked"' : ''; ?>>
                                                        <label for="to_type_2">Only to certain customers</label>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="to_type" value="1" id="to_type_1" checked="checked">
                                                        <label for="to_type_1">All my customers with phone</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="to_type" value="2" id="to_type_3">
                                                        <label for="to_type_3">To a customer group</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="to_type" value="3" id="to_type_2">
                                                        <label for="to_type_2">Only to certain customers</label>
                                                    </div>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>

                                        <div class="col-sm-12 sending-option-1 mt-4">
                                            <div class="margin-bottom-ter count-summary">
                                                <span class="customer-count" data-to="customer-count-all"><?= count($customers); ?></span> contacts have a valid phone (excluding unsubscribed).
                                            </div>
                                            <div class="margin-bottom-sec mt-5">
                                                <label><b>Customer Type</b></label>
                                                <div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionA[customer_type_service]" value="0" id="customer-type-both" checked="checked">
                                                        <label for="customer-type-both">Both Residential and Commercial</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionA[customer_type_service]" value="1" id="customer-type-residential">
                                                        <label for="customer-type-residential">Residential customers</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionA[customer_type_service]" value="2" id="customer-type-commercial">
                                                        <label for="customer-type-commercial">Commercial customers</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-5" style="margin-bottom:20px ​!important;">
                                                <label><b>Exclude Customer Groups</b></label>
                                                <div class="help help-block help-sm">Optional, select the groups you would like to exclude from campaign.</div>
                                                <ul class="group-list">
                                                    <?php foreach($customerGroups as $cg){ ?>
                                                        <li>
                                                            <div class="checkbox checkbox-sm">
                                                                <input class="checkbox-select chk-exclude-contact-group" type="checkbox" name="optionA[exclude_customer_group_id][]" value="<?= $cg->id; ?>" id="chk-exclude-customer-group-<?= $cg->id; ?>" <?= array_key_exists($cg->id, $selectedExcludes) ? 'checked="checked"' : ''; ?>>
                                                                <label for="chk-exclude-customer-group-<?= $cg->id; ?>"><?= $cg->title; ?></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 sending-option-2 customer selected mt-4" style="display: none;margin-bottom:20px ​!important;">
                                            <div class="margin-bottom-ter count-summary">
                                                <span class="contact-selected-count" style="font-weight: bold;"><?= count($selectedCustomer); ?></span> customer selected.
                                            </div>
                                            <div class="margin-bottom-sec">
                                                <table id="dataTable1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:30px;"></th>
                                                            <th>Name</th>
                                                            <th style="width: 10%;">Phone</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($customers as $c){ ?>
                                                            <?php if($c->phone_m != ''){ ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox checkbox-sm">
                                                                        <input class="checkbox-select chk-contact" type="checkbox" name="optionB[customer_id][<?= $c->prof_id; ?>]" value="<?= $c->prof_id; ?>" id="chk-customer-<?= $c->prof_id; ?>" <?= array_key_exists($c->prof_id, $selectedCustomer) ? 'checked="checked"' : ''; ?>>
                                                                        <label for="chk-customer-<?= $c->prof_id; ?>"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?= $c->first_name . ' ' . $c->last_name; ?>
                                                                </td>
                                                                <td><?= $c->phone_m; ?></td>
                                                            </tr>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 sending-option-3 mt-4" style="display: none;">
                                            <div class="margin-bottom-ter count-summary">
                                                <span class="contact-group-selected-count" style="font-weight: bold;"><?= count($selectedGroups); ?></span> customer group selected.
                                            </div>
                                            <div class="margin-bottom-sec">
                                                <ul class="group-list">
                                                    <?php foreach($customerGroups as $cg){ ?>
                                                        <li>
                                                            <div class="checkbox checkbox-sm">
                                                                <input class="checkbox-select chk-contact-group" type="checkbox" <?= array_key_exists($cg->id, $selectedGroups) ? 'checked="checked"' : ''; ?> name="optionC[customer_group_id][]" value="<?= $cg->id; ?>" id="chk-customer-group-<?= $cg->id; ?>">
                                                                <label for="chk-customer-group-<?= $cg->id; ?>"><?= $cg->title; ?></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 sending-option-3" style="display: none;">
                                            <div class="margin-bottom-sec">
                                                <label><b>Customer Type</b></label>
                                                <?php if($smsCampaign){ ?>
                                                    <div>
                                                        <div class="radio radio-sec margin-right">
                                                            <input type="radio" name="optionC[customer_type_service]" value="0" <?= $smsCampaign->customer_type == 0 ? 'checked="checked"' : ''; ?> id="customer-group-type-both" checked="checked">
                                                            <label for="customer-group-type-both">Both Residential and Commercial</label>
                                                        </div>
                                                        <div class="radio radio-sec margin-right">
                                                            <input type="radio" name="optionC[customer_type_service]" value="1" <?= $smsCampaign->customer_type == 1 ? 'checked="checked"' : ''; ?> id="customer-group-type-residential">
                                                            <label for="customer-group-type-residential">Residential customers</label>
                                                        </div>
                                                        <div class="radio radio-sec margin-right">
                                                            <input type="radio" name="optionC[customer_type_service]" value="2" <?= $smsCampaign->customer_type == 2 ? 'checked="checked"' : ''; ?> id="customer-group-type-commercial">
                                                            <label for="customer-group-type-commercial">Commercial customers</label>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div>
                                                        <div class="radio radio-sec margin-right">
                                                            <input type="radio" name="optionC[customer_type_service]" value="0" id="customer-group-type-both" checked="checked">
                                                            <label for="customer-group-type-both">Both Residential and Commercial</label>
                                                        </div>
                                                        <div class="radio radio-sec margin-right">
                                                            <input type="radio" name="optionC[customer_type_service]" value="1" id="customer-group-type-residential">
                                                            <label for="customer-group-type-residential">Residential customers</label>
                                                        </div>
                                                        <div class="radio radio-sec margin-right">
                                                            <input type="radio" name="optionC[customer_type_service]" value="2" id="customer-group-type-commercial">
                                                            <label for="customer-group-type-commercial">Commercial customers</label>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 text-end">
                                            <a class="nsm-button" href="<?php echo url('sms_campaigns/edit_campaign/' . $smsCampaign->id); ?>" style="float: left;margin-right: 10px;">« Back</a>
                                            <button type="submit" class="nsm-button primary btn-campaign-save-send-settings" style="float: left;margin-right: 0px;">Continue »</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
    <?php 
        if( $smsCampaign ){
            if($smsCampaign->sending_type == 1){
                echo "to_type_1.click();";
            }elseif( $smsCampaign->sending_type == 2 ){
                echo '$(".sending-option-1").hide();';
                echo '$(".sending-option-2").hide();';
                echo '$(".sending-option-3").show();';
            }else{
                echo '$(".sending-option-1").hide();';
                echo '$(".sending-option-2").show();';
                echo '$(".sending-option-3").hide();';
            } 
        }
    ?>
    $("#to_type_2").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").hide();
            $(".sending-option-2").show();
            $(".sending-option-3").hide();
        }
    });

    $("#to_type_1").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").show();
            $(".sending-option-2").hide();
            $(".sending-option-3").hide();
        }
    });

    $("#to_type_3").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").hide();
            $(".sending-option-2").hide();
            $(".sending-option-3").show();
        }
    });

    $(".chk-contact").change(function(){
        var contact_selected = $(".chk-contact:checked").length;
        $(".contact-selected-count").html(contact_selected);
    });

    $(".chk-contact-group").change(function(){
        var contact_group_selected = $(".chk-contact-group:checked").length;
        $(".contact-group-selected-count").html(contact_group_selected);
    });

    $("#create_campaign_send_to").submit(function(e){
        e.preventDefault();
        var url = base_url + 'sms_campaigns/create_campaign_send_to';
        $(".btn-campaign-save-send-settings").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#create_campaign_send_to").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "sms_campaigns/build_sms";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                }
                $(".btn-campaign-save-send-settings").html('Continue »');
             }
          });
        }, 1000);
    });
});
</script>