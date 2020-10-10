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
                                  <li class="active">1. Edit Offer</li>
                                  <li>2. Select Customers</li>
                                  <li>3. Build Email</li>
                                  <li>4. Preview</li>
                                  <li>5. Purchase</li>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="formClient-Name">Title</label>
                                    <input type="text" class="form-control" name="title" id="" required placeholder="" value="<?php echo $offer->title; ?>" autofocus/>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="formClient-Name">Description</label>
                                    <textarea name="description" class="form-control" rows="5" > <?php echo $offer->description; ?> </textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="formClient-Name">Terms & Conditions</label>
                                    <textarea name="terms_and_conditions" class="form-control" > <?php echo $offer->terms_and_conditions; ?> </textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="formClient-Name">Deal Price</label>
                                    <input type="text" class="form-control" name="deal_price" id="" required placeholder="" value="<?php echo $offer->deal_price; ?>" autofocus/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="formClient-Name">Original Price</label>
                                    <input type="text" class="form-control" name="original_price" id="" value="<?php echo $offer->original_price; ?>" required placeholder="" autofocus/>
                                    <input type="hidden" name="status" id="status" value="<?php echo $offer->status; ?>" />
                                </div>
                               <!-- <div class="col-md-12 form-group">
                                    <label for="formClient-Name">Upload Image</label>
                                    <input data-fileupload="file" name="fileimage" type="file">
                                </div> -->
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-offer-save-draft">Update Draft</button>
                                    <a href="<?php echo url('offers') ?>">cancel this</a>
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
    $("#create_offer").submit(function(e){
        e.preventDefault();
        var url = base_url + 'offers/update_draft_offer';
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
                    location.href = base_url + "offers/add_offer_send_to";
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
</script>