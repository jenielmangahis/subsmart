<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
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
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'id' => 'create_sms_blast', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
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
                                            <input type="radio" name="to_type" value="2" id="to_type_2">
                                            <label for="to_type_2">Only to certain contacts</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="validation-error" style="display: none;"></div>

                            <div class="sending-option-1">
                                <div class="margin-bottom-ter">
                                    <span class="customer-count" data-to="customer-count-all">0</span> contacts have a valid phone (excluding unsubscribed).
                                </div>
                                <div class="margin-bottom-sec">
                                    <label><b>Customer Type</b></label>
                                    <div>
                                        <div class="radio radio-sec margin-right">
                                            <input type="radio" name="customer_type_service_1" value="0" id="customer_type_service_1_0" data-to="customer-type-service-1" checked="checked">
                                            <label for="customer_type_service_1_0">Both Residential and Commercial</label>
                                        </div>
                                        <div class="radio radio-sec margin-right">
                                            <input type="radio" name="customer_type_service_1" value="1" id="customer_type_service_1_1" data-to="customer-type-service-1" >
                                            <label for="customer_type_service_1_1">Residential customers</label>
                                        </div>
                                        <div class="radio radio-sec margin-right">
                                            <input type="radio" name="customer_type_service_1" value="2" id="customer_type_service_1_2" data-to="customer-type-service-1" >
                                            <label for="customer_type_service_1_2">Commercial customers</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Exclude Customer Groups</label>
                                    <div class="help help-block help-sm">Optional, select the groups you would like to exclude from campaign.</div>
                                    <div data-to="customer-group-list-exclude"></div>
                                </div>
                            </div>

                            <div class="sending-option-2" style="display: none;">
                                <div class="margin-bottom-ter">
                                    <span class="contact-selected-count" style="font-weight: bold;">0</span> contact selected.
                                </div>
                                <div class="margin-bottom-sec">
                                    <table id="dataTable1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:30px;"></th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Subscribed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($contacts as $c){ ?>
                                                <tr>
                                                    <td><input type="checkbox" class="form-control chk-contact"></td>
                                                    <td><?= $c->name; ?></td>
                                                    <td><?= $c->mobile; ?></td>
                                                    <td><span class="fa fa-check text-ter"></span></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label>Exclude Customer Groups</label>
                                    <div class="help help-block help-sm">Optional, select the groups you would like to exclude from campaign.</div>
                                    <div data-to="customer-group-list-exclude"></div>
                                </div>
                            </div>

                            <hr />
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <a class="btn btn-default margin-right" href="<?php echo url('sms_campaigns/add_sms_blast') ?>">« Back</a>
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-campaign-save-draft">Continue »</button>
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
        }else{
            $(".sending-option-1").show();
            $(".sending-option-2").hide();
        }
    });

    $("#to_type_1").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").show();
            $(".sending-option-2").hide();
        }else{
            $(".sending-option-1").hide();
            $(".sending-option-2").show();
        }
    });

    $(".chk-contact").change(function(){
        var contact_selected = $(".chk-contact:checked").length;
        $(".contact-selected-count").html(contact_selected);
    });

    $("#create_sms_blast").submit(function(e){
        e.preventDefault();
        var url = base_url + '/sms_campaigns/save_draft_campaign';
        $(".btn-campaign-save-draft").html('<span class="spinner-border spinner-border-sm m-0"></span>  saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,    
             dataType: "json",      
             data: $("#create_sms_blast").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "/sms_campaigns/add_campaign_send_to";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                }
                $(".btn-campaign-save-draft").html('Save as Draft');
             }
          });
        }, 1000);
    });
});
</script>