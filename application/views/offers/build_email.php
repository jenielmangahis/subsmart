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
                        <h1 class="page-title">Create Offer</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add a new offer to promote your business.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                    <a href="<?php echo url('offers') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Offer List
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'id' => 'create_offer', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li>1. Edit Offer</li>
                                  <li>2. Select Customers</li>
                                  <li class="active">3. Build Email</li>
                                  <li>4. Preview</li>
                                  <li>5. Purchase</li>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="formClient-Name">Subject</label>
                                    <input type="text" class="form-control" name="subject" id="subject" required placeholder="" autofocus/>
                                </div>
                                <div class="col-md-12 form-group">
                                  <label>Email Body</label> <span class="help"></span>
                                  <textarea name="email_body" id="offer_email_body" cols="40" rows="5" class="form-control"></textarea>              
                                </div>     
                               <!-- <div class="col-md-12 form-group">
                                    <label for="formClient-Name">Upload Image</label>
                                    <input data-fileupload="file" name="fileimage" type="file">
                                </div> -->
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-offer-save-draft">Continue</button>
                                    <a href="<?php echo url('offers/add_offer_send_to') ?>">Back</a>
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
<?php // include viewPath('includes/footer'); ?>
<?php include viewPath('includes/footer_marketing'); ?>

<script>
$(function(){
    $("#create_offer").submit(function(e){
        e.preventDefault();
        var url = base_url + 'offers/save_offer_build_email';
        $(".btn-offer-save-draft").html('<span class="spinner-border spinner-border-sm m-0"></span>  saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,    
             dataType: "json",      
             data: $("#create_offer").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "offers/email_preview";
                    //alert('saved');
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                }
                $(".btn-offer-save-draft").html('Save as Draft');
             }
          });
        }, 1000);
    });
});

$(document).ready(function() {
    CKEDITOR.replace("offer_email_body",
    {
         height: 360
    });
 });


</script>