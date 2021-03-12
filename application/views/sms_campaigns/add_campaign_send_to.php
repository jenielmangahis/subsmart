<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!--
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">SMS Blast</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Send to all your customers or only certain ones.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                    <a href="<?php echo url('sms_campaigns') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to SMS Blast list
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- end row -->
            <?php echo form_open_multipart('sms_campaigns/save_send_to', ['class' => 'form-validate', 'id' => 'create_campaign_send_to', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                      <div class="card mt-0">
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">SMS Blast</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('sms_campaigns') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to SMS Blast list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Send to all your customers or only certain ones.
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li>1. Edit Campaign</li>
                                  <li class="active">2. Select Customers</li>
                                  <li>3. Build SMS</li>
                                  <li>4. Preview</li>
                                  <li>5. Purchase</li>
                                </ul>
                            </div>
                            <hr />

                            <div class="margin-bottom">
                                <div class="form-group">
                                    <label><b>Who are you sending to?</b></label>
                                    <div>
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
                                    </div>
                                </div>
                            </div>

                            <div class="sending-option-1">
                                <div class="margin-bottom-ter">
                                    <span class="customer-count" data-to="customer-count-all"><?= count($customers); ?></span> contacts have a valid phone (excluding unsubscribed).
                                </div>
                                <div class="margin-bottom-sec">
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
                                <div class="form-group" style="margin-bottom:20px ​!important;">
                                    <label>Exclude Customer Groups</label>
                                    <div class="help help-block help-sm">Optional, select the groups you would like to exclude from campaign.</div>
                                    <ul class="group-list">
                                        <?php foreach($customerGroups as $cg){ ?>
                                            <li>
                                                <div class="checkbox checkbox-sm">
                                                    <input class="checkbox-select chk-exclude-contact-group" type="checkbox" name="optionA[exclude_customer_group_id][]" value="<?= $cg->id; ?>" id="chk-exclude-customer-group-<?= $cg->id; ?>">
                                                    <label for="chk-exclude-customer-group-<?= $cg->id; ?>"><?= $cg->name; ?></label>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="sending-option-2" style="display: none;margin-bottom:20px ​!important;">
                                <div class="margin-bottom-ter">
                                    <span class="contact-selected-count" style="font-weight: bold;">0</span> customer selected.
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
                                                            <input class="checkbox-select chk-contact" type="checkbox" name="optionB[customer_id][<?= $c->prof_id; ?>]" value="<?= $c->prof_id; ?>" id="chk-customer-<?= $c->prof_id; ?>">
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

                            <div class="sending-option-3" style="display: none;">
                                <div class="margin-bottom-ter">
                                    <span class="contact-group-selected-count" style="font-weight: bold;">0</span> customer group selected.
                                </div>
                                <div class="margin-bottom-sec">
                                    <ul class="group-list">
                                        <?php foreach($customerGroups as $cg){ ?>
                                            <li>
                                                <div class="checkbox checkbox-sm">
                                                    <input class="checkbox-select chk-contact-group" type="checkbox" name="optionC[customer_group_id][]" value="<?= $cg->id; ?>" id="chk-customer-group-<?= $cg->id; ?>">
                                                    <label for="chk-customer-group-<?= $cg->id; ?>"><?= $cg->name; ?></label>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="margin-bottom-sec">
                                    <label><b>Customer Type</b></label>
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
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="col-md-4 form-group md-right">
                                    <a class="btn btn-default margin-right" href="<?php echo url('sms_campaigns/add_sms_blast') ?>" style="float: left;margin-right: 10px;">« Back</a>
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-campaign-save-send-settings" style="float: left;margin-right: 0px;">Continue »</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
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
