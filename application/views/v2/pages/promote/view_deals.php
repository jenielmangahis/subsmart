<?php include viewPath('v2/includes/header'); ?>
<style>
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
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Preview Deals</div>
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
                              <div class="row mb-5 mt-3">
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
                        <div class="panel-info" style="margin-top: 100px;">
                            <div class="margin-bottom">
                                <?php if( $dealsSteals->order_number != '' ){ ?>
                                <div>
                                    <label style="font-weight: bold;">Paid with Order # <?= $dealsSteals->order_number; ?> <a href="<?= base_url('promote/view_deals_payment/' . $orderPayments->id); ?>" style="color:#2ab363;">view</a></label>
                                </div>
                                <?php } ?>
                                <div class="row  mt-5">
                                    <div class="col-md-5">
                                        <label>
                                            <span id="valid-from-popover" data-toggle="popover" data-placement="top" data-container="body">
                                                Valid From  <i class="bx bx-question-mark"></i>
                                            </span> 
                                        </label>                                                           
                                        <input type="text" name="valid_from" value="<?= isset($dealsSteals) ? date("m/d/Y",strtotime($dealsSteals->valid_from)) : date("m/d/Y"); ?>"  class="form-control" readonly="" disabled="" autocomplete="off" />
                                    </div>
                                    <div class="col-md-5">
                                        <label>
                                            <span id="valid-to-popover" data-toggle="popover" data-placement="top" data-container="body">
                                                Valid To <i class="bx bx-question-mark"></i> 
                                            </span>
                                        </label>                                                          
                                        <input type="text" name="valid_to" value="<?= isset($dealsSteals) ? date("m/d/Y",strtotime($dealsSteals->valid_to)) : date("m/d/Y"); ?>"  class="form-control" readonly="" disabled="" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="mt-5">                           
                                  <?php
                                    $slug = createSlug($dealsSteals->title,'-');
                                    $deal_url = url('deal/' . $slug . '/' . $dealsSteals->id);
                                  ?>               
                                  <label>Deal Page URL</label><br/>
                                  <input class="form-control" type="text" readonly="" disabled="" value="<?= $deal_url ?>"><br/>
                                </div>   
                                <div class="row mt-5">
                                    <div class="col-12 mt-3 text-end">
                                        <?php
                                            $slug = createSlug($dealsSteals->title,'-');
                                            $deal_url = url('deal/' . $slug . '/' . $dealsSteals->id);
                                        ?>
                                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('promote/deals'); ?>'">« Back</button> 
                                        <button type="button" name="btn_back" class="nsm-button primary" style="width:150px;" onclick="location.href='<?= $deal_url; ?>'">View Deal Page</button>  
                                        <a class="nsm-button primary" href="<?= url('promote/edit_deals/' . $dealsSteals->id); ?>" style="width:150px;display: inline-block; text-align: center;">Edit</a>
                                    </div>
                                </div>
                            </div>                              
                        </div>
                    </div>
                </div>
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