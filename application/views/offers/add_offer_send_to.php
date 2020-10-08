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
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Offers</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Send to all your customers or only certain ones</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                    <a href="<?php echo url('offers') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Offers list
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('offers/save_send_to', ['class' => 'form-validate', 'id' => 'create_offer_send_to', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li>1. Edit Offer</li>
                                  <li class="active">2. Select Customers</li>
                                  <li>3. Build Email</li>
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
                                            <label for="to_type_1">All my customers with email</label>
                                        </div>
                                        <div class="radio radio-sec margin-right">
                                            <input type="radio" name="to_type" value="2" id="to_type_2">
                                            <label for="to_type_2">To a customer group</label>
                                        </div>
                                        <div class="radio radio-sec margin-right">
                                            <input type="radio" name="to_type" value="3" id="to_type_3">
                                            <label for="to_type_3">Only to certain customers</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sending-option-1">
                                <div class="margin-bottom-ter">
                                    <span class="customer-count" data-to="customer-count-all"><?= count($customers); ?></span> contacts have a valid email (excluding unsubscribed).
                                </div>
                                
                                <div class="form-group">
                                    <label>Exclude Customer Groups</label>
                                    <div class="help help-block help-sm">Optional, select the groups you would like to exclude from campaign.</div>
                                    <ul class="group-list">
                                        <?php foreach($customerGroups as $cg){ ?>       
                                            <li>
                                                <div class="checkbox checkbox-sm">
                                                    <input class="checkbox-select chk-exclude-contact-group" type="checkbox" name="exclude_customer_group_id" value="<?= $cg->id; ?>" id="chk-exclude-customer-group-<?= $cg->id; ?>">
                                                    <label for="chk-exclude-customer-group-<?= $cg->id; ?>"><?= $cg->name; ?></label>
                                                </div> 
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="sending-option-3" style="display: none;">
                                <div class="margin-bottom-ter">
                                    <span class="contact-selected-count" style="font-weight: bold;">0</span> customer selected.
                                </div>
                                <div class="margin-bottom-sec">
                                    <table id="dataTable1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:30px;"></th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subscribed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($customers as $c){ ?>
                                                <?php if($c->contact_email != ''){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sm">
                                                            <input class="checkbox-select chk-contact" type="checkbox" name="customer_id[]" value="<?php echo $c->id; ?>" id="chk-customer-<?= $c->id; ?>">
                                                            <label for="chk-customer-<?= $c->id; ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= $c->contact_name; ?>
                                                        <div class="text-ter">
                                                            <?= $c->customer_type; ?>
                                                        </div>
                                                    </td>
                                                    <td><?= $c->contact_email; ?></td>
                                                    <td><span class="fa fa-check text-ter"></span></td>
                                                </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="sending-option-2" style="display: none;">
                                <div class="margin-bottom-ter">
                                    <span class="contact-group-selected-count" style="font-weight: bold;">0</span> customer group selected.
                                </div>
                                <div class="margin-bottom-sec">
                                    <ul class="group-list">
                                        <?php foreach($customerGroups as $cg){ ?>       
                                            <li>
                                                <div class="checkbox checkbox-sm">
                                                    <input class="checkbox-select chk-contact-group" type="checkbox" name="customer_group_id[]" value="<?= $cg->id; ?>" id="chk-customer-group-<?= $cg->id; ?>">
                                                    <label for="chk-customer-group-<?= $cg->id; ?>"><?= $cg->name; ?></label>
                                                </div> 
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <hr />
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <a class="btn btn-default margin-right" href="<?php echo url('offers/add_offer') ?>">« Back</a>
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-offer-save-send-settings">Continue »</button>
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
    $("#to_type_1").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").show();
            $(".sending-option-2").hide();
            $(".sending-option-3").hide();
        }
    });

    $("#to_type_2").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").hide();
            $(".sending-option-2").show();
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

    $("#create_offer_send_to").submit(function(e){
        e.preventDefault();
        var url = base_url + 'offers/save_offer_send_to_settings';
        $(".btn-offer-save-send-settings").html('<span class="spinner-border spinner-border-sm m-0"></span>  saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,    
             dataType: "json",      
             data: $("#create_offer_send_to").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step3 for creating email
                    location.href = base_url + "/offers/build_email";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                }
                $(".btn-offer-save-send-settings").html('Continue »');
             }
          });
        }, 1000);
    });
});
</script>