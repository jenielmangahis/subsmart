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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Create SMS Campaign</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Start a new SMS campaign to promote your business.</li>
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
                                  <li class="active">1. Edit Campaign</li>
                                  <li>2. Select Customers</li>
                                  <li>3. Build SMS</li>
                                  <li>4. Preview</li>
                                  <li>5. Purchase</li>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="formClient-Name">Campaign Name</label>
                                    <input type="text" class="form-control" name="sms_camapaign_name" id="" required placeholder="" autofocus/>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-campaign-save-draft">Save as Draft</button>
                                    <a href="<?php echo url('sms_campaigns') ?>">cancel this</a>
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