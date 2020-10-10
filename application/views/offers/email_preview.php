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
                            <li class="breadcrumb-item active">Preview and select the valid period.</li>
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
                                  <li>3. Build Email</li>
                                  <li class="active" >4. Preview</li>
                                  <li>5. Purchase</li>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="col-md-12 form-group">
                                       <label for="formClient-Name">Title: <?php echo $offers->title; ?> </label>
                                    </div>
                                    <div class="col-md-12 form-group">
                                       <label>Deal Price: $<?php  echo $offers->deal_price; ?> </label> <span class="help"></span>
                                    </div>  
                                    <div class="col-md-12 form-group">
                                       <label>Original Price: $<?php  echo $offers->original_price; ?> </label> <span class="help"></span>
                                    </div>  
                                    <div class="col-md-12 form-group">
                                       <label>What You'll Get:  </label> <span class="help"><?php  echo $offers->description; ?></span>
                                    </div>  
                                    <div class="col-md-12 form-group">
                                       <label>Terms & Conditions </label> <span class="help"><?php  echo $offers->terms_and_conditions; ?></span>
                                    </div>  
                                </div> 

                                <div class="col-md-6 form-group">
                                    <div class="col-md-12 form-group">
                                        <label for="formClient-Name">The current package to run the deal:</label><br /><br />
                                        <label for="formClient-Name"> Pay flat fee $10.00 to list your deal for 1 Month. </label> <br /><br />
                                        <span class="help">The deal will be emailed to your customers upon confirmation. You pay a monthly fee to keep the deal valid. No additional commission on customer bookings and transactions </span>
                                        <hr style="margin-top: 10px; margin-bottom: 30px;">

                                    </div>
                                    <div class="col-md-12 form-group">
                                          <label>Valid From</label> 
                                          <input type="text" name="offer_date_from" id="offer_date_from" value=""  class="form-control default-datepicker" required="" autocomplete="off" required />         
                                    </div>     
                                    <div class="col-md-12 form-group">
                                          <label>Valid To</label> 
                                          <input type="text" name="offer_date_to" value="" disabled class="form-control " required="" autocomplete="off" required />  

                                    </div>     
                                    <div class="col-md-12 form-group">
                                          <label>Total</label> 
                                          <span class="bold" data-shop="package-price">$10.00</span>  <br /><br />  

                                          <button type="submit" class="btn btn-flat btn-primary margin-right btn-offer-save-draft">Confirm Deal</button>
                                    </div>     

                                </div> 
                              
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    
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

    $('.default-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });



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