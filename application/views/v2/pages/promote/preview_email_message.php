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
.box {
    border: 1px solid #dfdfdf;
    padding: 20px;
}
.package-price-original {
    text-decoration: line-through;
}
.text-right{
    text-align: right;
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
                        <div class="nsm-callout primary">Preview and select the valid period.</div>
                    </div>
                </div>
                <?php echo form_open_multipart('sms_campaigns/save_send_to', ['class' => 'form-validate', 'id' => 'deals_steals_preview', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="validation-error" style="display: none;"></div>
                        <div class="tabs-menu">
                            <ul class="clearfix">
                              <li>1. Create Deal</li>
                              <li>2. Select Customers</li>
                              <li>3. Build Email</li>
                              <li class="active">4. Preview</li>
                              <li>5. Purchase</li>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-6 pl-0 pr-0 left" style="background-color: #ffffff !important;">
                        <div class="box">
                              <div class="form-group">
                                  <h3 style="font-size: 26px;"><?= $dealsSteals->title; ?></h3>
                                  <h3 style="color:#2ab363;font-size: 24px;">$<?= number_format($dealsSteals->deal_price,2); ?></h3>
                              </div>
                              <div class="row margin-bottom-sec">
                                  <div class="col-md-6">
                                      <?php 
                                        $diff_increase  = $dealsSteals->original_price - $dealsSteals->deal_price;
                                        $percentage_off = ($diff_increase / $dealsSteals->original_price) * 100; 
                                      ?>
                                      <span class="text-ter">was <span style="font-size:18px;">$<?= number_format($dealsSteals->original_price,2); ?></span> you get <span style="font-size: 18px;"><?= number_format($percentage_off,2); ?>%</span> off</span>
                                  </div>
                                  <div class="col-md-6 text-right">
                                      <span class="text-ter"><i class='bx bx-time'></i> Expires in <span data-shop="valid-days">30</span> days</span>
                                  </div>
                              </div>
                              <div class="row margin-bottom-sec">
                                  <div class="col-md-12">
                                      <img src="<?= base_url("uploads/deals_steals/" . $dealsSteals->company_id . "/" . $dealsSteals->photos); ?>" style="width: 100%;">
                                  </div>
                              </div>
                            <div style="font-size:18px; font-weight: bold;">What You'll Get</div>
                            <hr>
                            <p style="font-size: 16px;">SAMPLE DEALS STEALS</p>
                            <div style="font-size:18px; font-weight: bold; margin-top: 30px;">Terms &amp; Conditions</div>
                            <hr>
                            <p style="font-size: 16px;">TEST</p>
                        </div>
                    </div>

                    <div class="col-md-6 pl-0 pr-0 left">
                        <div class="panel-info" style="margin-top: 29px;">
                            <div class="margin-bottom">
                                <div class="form-msg" style="display: none;"></div>
                                <div>
                                    <label>The current package to run the deal:</label><br/><br/>
                                    <label style="font-weight: bold;">Pay flat fee $10.00 to list your deal for 1 Month.</label>
                                </div>
                                <div class="help help-sm help-block">                                        
                                    <div class="help help-sm">
                                        The deal will be emailed to your customers upon confirmation.
                                        You pay a monthly fee to keep the deal valid. No additional commission on customer bookings and transactions.
                                    </div>
                                </div>
                                <div class="row  mt-5">
                                    <div class="col-md-5">
                                        <label>
                                            <span id="valid-from-popover" data-toggle="popover" data-placement="top" data-container="body">
                                                Valid From  <i class="bx bx-question-mark"></i>
                                            </span> 
                                        </label>                                                           
                                        <input type="text" name="valid_from" value="<?= isset($dealsSteals) ? date("m/d/Y",strtotime($dealsSteals->valid_from)) : date("m/d/Y"); ?>"  class="form-control valid-from-datepicker" autocomplete="off" required />
                                    </div>
                                    <div class="col-md-5">
                                        <label>
                                            <span id="valid-to-popover" data-toggle="popover" data-placement="top" data-container="body">
                                                Valid To <i class="bx bx-question-mark"></i> 
                                            </span>
                                        </label>                                                          
                                        <input type="text" name="valid_to" value="<?= isset($dealsSteals) ? date("m/d/Y",strtotime($dealsSteals->valid_to)) : date("m/d/Y"); ?>"  class="form-control valid-to-datepicker" autocomplete="off" required />
                                    </div>
                                </div>
                                <hr class="mt-5" />
                                <div class="row mt-3" style="background-color: #8c8c8c !important; color:#ffffff;">
                                  <div class="col-md-2">
                                      <strong style="font-size: 24px;">Total</strong>
                                  </div>
                                  <div class="col-md-6" style="font-size: 24px;">
                                      <span class="bold" data-shop="package-price">$<?= number_format($deals_price, 2); ?></span><!-- <br> <span class="text-alert">was <span class="package-price-original" data-shop="package-price-original">$<?= number_format($dealsSteals->original_price, 2); ?></span>, you save <span data-shop="package-price-discount-percent">33.33</span>% -->
                                      </span>
                                  </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-12 mt-3 text-end">
                                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('promote/build_email'); ?>'">« Back</button>                        
                                        <button type="submit" name="btn_save" class="nsm-button primary btn-deals-preview">Continue »</button>
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
<script src="http://momentjs.com/downloads/moment.js"></script>
<script>
$(function(){
    $("#deals_steals_preview").submit(function(e){
        e.preventDefault();

        $('.form-msg').hide().html("");

        var url = base_url + 'promote/update_validity';
        $(".btn-deals-preview").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#deals_steals_preview").serialize(),
             success: function(o)
             {
                if( o.is_success == 1 ){
                    $('.form-msg').hide().html("<p class='alert alert-info'>"+o.msg+"</p>").fadeIn(500);
                    location.href = base_url + "promote/payment";
                    //$(".btn-campaign-update-send-schedule").html('<span class="spinner-border spinner-border-sm m-0"></span>  Redirecting to list');
                    /*setTimeout(function() {
                        location.href = base_url + "sms_campaigns";
                    }, 2500);*/
                }else{
                    $('.form-msg').hide().html("<p class='alert alert-danger'>"+o.msg+"</p>").fadeIn(500);
                    $(".btn-deals-preview").html('Save');
                }
             }
          });
        }, 1000);
    });

    $('.valid-from-datepicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true        
    });

    $('.valid-to-datepicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true        
    });

    $('.valid-from-datepicker').change(function(){
      var validFrom = $(this).val();
      var validFrom = moment(validFrom);
      var validTo   = moment(validFrom).add(1, 'M');

      $('.valid-to-datepicker').val(validTo.format("MM/DD/YYYY"));
      
    });

    $('#valid-from-popover').popover({
        title: 'Valid From', 
        content: "Select the start date. You can schedule a deal if you set this date in future.",
        trigger: 'hover'
    });

    $('#valid-to-popover').popover({
        title: 'Valid To', 
        content: "The date when the deal will expire.",
        trigger: 'hover'
    });
});
</script>