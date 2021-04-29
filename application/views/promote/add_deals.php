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
.input-group-addon {
    padding: 13px 13px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.input-group-addon, .input-group-btn {
    /*width: 1%;*/
    white-space: nowrap;
    vertical-align: middle;
}
.input-group .form-control, .input-group-addon, .input-group-btn {
    display: table-cell;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'create_deals_steals', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Create Deal</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('promote/deals') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Deals and Steals list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Add a new deal to promote your business.
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li class="active">1. Create Deal</li>
                                  <li>2. Select Customers</li>
                                  <li>3. Build Email</li>
                                  <li>4. Preview</li>
                                  <li>5. Purchase</li>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                              <div class="col-md-12 form-group">
                                  <label for="">Title</label>
                                  <div class="help help-block help-sm">Set your deal title, use the discount to be more convincing</div>
                                  <input type="text" class="form-control" name="title" placeholder="e.g. Up to 40 % off House Cleaning" id="" required placeholder="" autofocus/>
                              </div>
                              <div class="col-md-12 form-group">
                                  <label for="">Description</label>
                                  <div class="help help-block help-sm">Describe how users will benefit when they buy the deal</div>
                                  <textarea name="description" cols="40" rows="3" class="form-control" required autocomplete="off" placeholder="e.g. Grab our special cleaning deal and book a service now!  Spots get filled fast! Get them while they're HOT."></textarea>
                              </div>
                              <div class="col-md-12 form-group">
                                  <label for="">Terms & Conditions</label>
                                  <div class="help help-block help-sm">Mention your terms, restrictions, fine print or other notes, that apply to the deal</div>
                                  <textarea name="terms" cols="40" rows="3" class="form-control" autocomplete="off" placeholder="e.g. Applies only for basic House Cleaning service."></textarea>
                              </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-8 col-md-4">
                                        <label>Deal Price</label> <span class="form-required">*</span>
                                        <div class="help help-sm help-block">The final price customers will pay</div>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" name="price" value="0.00" id="price-deal" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-4">
                                        <label>Original Price </label> <span class="form-required">*</span>
                                        <div class="help help-sm help-block">The full price without any discounts.</div>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" name="price_original" id="price-original" value="0.00" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-4">
                                        <div style="padding-top: 63px;">Discount you offer: &nbsp; $<span id="discount-fixed">0.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="col-md-4 form-group md-right">
                                    <a class="btn btn-default" href="<?php echo url('promote/deals') ?>" style="float: left;margin-right: 10px;">Cancel</a>
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-deals-save-draft" style="float: left;margin-right: 0px;">Continue »</button>
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
    $(document).on('propertychange change keyup paste input', '#price-deal', function(){
      compute_discount();
    });

    $(document).on('propertychange change keyup paste input', '#price-original', function(){
      compute_discount();
    });

    function compute_discount(){
      var price_deal     = $("#price-deal").val();
      var price_original = $("#price-original").val();
      var discount_fix   = price_original -  price_deal;
      $("#discount-fixed").html(discount_fix.toFixed(2));
    }

    $("#create_deals_steals").submit(function(e){
        e.preventDefault();
        var url = base_url + 'promote/_save_deals_steals';
        $(".btn-deals-save-draft").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#create_deals_steals").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "promote/add_send_to";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#create_deals_steals").offset().top
                    }, 500);                    
                    $(".btn-deals-save-draft").html('Continue »');
                }
             }
          });
        }, 1000);
    });
});
</script>
