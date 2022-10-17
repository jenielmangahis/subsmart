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
                <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'id' => 'create_sms_blast', 'autocomplete' => 'off']); ?>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li class="active">1. Create Campaign</li>
                          <li>2. Select Customers</li>
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
                                            <div class="form-group <?php echo (isset($custom_errors['title']) && $custom_errors['title']!='' )?'has-feedback':''; ?>">
                                                <label for="title">Campaign Name</label>
                                                <input type="text" class="form-control" name="sms_camapaign_name" id="" required placeholder="" autofocus/>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 text-end">
                                            <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('sms_campaigns') ?>'">Go Back to SMS Campaigns List</button>
                                            <button type="submit" class="nsm-button primary btn-campaign-save-draft">Continue »</button>
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
    $("#create_sms_blast").submit(function(e){
        e.preventDefault();
        var url = base_url + 'sms_campaigns/save_draft_campaign';
        $(".btn-campaign-save-draft").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
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
                    location.href = base_url + "sms_campaigns/add_campaign_send_to";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                    $(".btn-campaign-save-draft").html('Continue »');
                }
             }
          });
        }, 1000);
    });
});
</script>