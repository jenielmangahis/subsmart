<?php include viewPath('v2/includes/header'); ?>
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
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Add a new deal to promote your business.</div>
                    </div>
                </div>
                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'create_deals_steals', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                <div class="row">
                    <div class="col-md-12">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12 form-group">
                          <label for=""><b>Title</b></label>
                          <div class="help help-block help-sm">Set your deal title, use the discount to be more convincing</div>
                          <input type="text" class="form-control" name="title" placeholder="e.g. Up to 40 % off House Cleaning" id="" required placeholder="" autofocus/>
                        </div>
                        <div class="col-md-12 form-group mt-5">
                          <label for=""><b>Image</b></label>
                          <div class="help help-block help-sm">Add photo to spotlight features of this deal. </div>
                          <input type="file" class="form-control" name="image" required placeholder="" autofocus/>
                        </div>
                        <div class="col-md-12 form-group mt-5">
                          <label for=""><b>Description</b></label>
                          <div class="help help-block help-sm">Describe how users will benefit when they buy the deal</div>
                          <textarea name="description" cols="40" rows="3" class="form-control" required autocomplete="off" placeholder="e.g. Grab our special cleaning deal and book a service now!  Spots get filled fast! Get them while they're HOT."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 form-group">
                          <label for=""><b>Terms & Conditions</b></label>
                          <div class="help help-block help-sm">Mention your terms, restrictions, fine print or other notes, that apply to the deal</div>
                          <textarea name="terms" cols="40" rows="3" class="form-control" autocomplete="off" placeholder="e.g. Applies only for basic House Cleaning service."></textarea>
                        </div>
                        <div class="col-sm-8 col-md-4 mt-5">
                            <label><b>Deal Price</b></label>
                            <div class="help help-sm help-block">The final price customers will pay</div>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" name="price" value="0.00" id="price-deal" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-4 mt-3">
                            <label><b>Original Price</b></label>
                            <div class="help help-sm help-block">The full price without any discounts.</div>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" name="price_original" id="price-original" value="0.00" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-4">
                            <div style="padding-top: 63px;"><b>Discount you offer: &nbsp; $<span id="discount-fixed">0.00</span></b></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('promote/deals') ?>'">Go Back to Deals List</button>
                        <button type="submit" name="btn_save" class="nsm-button primary btn-deals-save-draft">Continue »</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
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
        var form     = $('#create_deals_steals')[0];
        var formData = new FormData(form);
        $(".btn-deals-save-draft").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: formData,
             processData: false,
             contentType: false,
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
<?php include viewPath('v2/includes/footer'); ?>