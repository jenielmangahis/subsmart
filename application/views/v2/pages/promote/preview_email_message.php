<?php include viewPath('v2/includes/header'); ?>
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
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-badge-dollar'></i></div>
                                        </div>
                                        <h4 class="step-title">Create Deal</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-user-circle' ></i></div>
                                        </div>
                                        <h4 class="step-title">Select Customers</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-envelope'></i></div>
                                        </div>
                                        <h4 class="step-title">Build Email</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bx-search-alt-2'></i></div>
                                        </div>
                                        <h4 class="step-title">Preview</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bx-credit-card'></i></div>
                                        </div>
                                        <h4 class="step-title">Payment</h4>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-6 pl-0 pr-0 left" style="background-color: #ffffff !important;">
                        <div class="box">
                            <h3 style="font-size: 26px;"><?= $dealsSteals->title; ?></h3>
                            <h3 class="text-muted" style="font-size: 16px;">$<?= number_format($dealsSteals->deal_price,2); ?></h3>
                            <div class="row">
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
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <img src="<?= base_url("uploads/deals_steals/" . $dealsSteals->company_id . "/" . $dealsSteals->photos); ?>" style="width: 100%;">
                                </div>                           
                                <div class="col-md-12">
                                    <hr />
                                    <div style="font-size:18px; font-weight: bold; margin-top: 30px;">Terms &amp; Conditions</div>
                                    <div style="font-size: 16px;"><?= $dealsSteals->terms_conditions; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-0 pr-0 left">
                        <div class="panel-info" style="margin-top: 29px;">
                            <div class="margin-bottom">
                                <div>
                                    <label>The current package to run the deal:</label><br/><br/>
                                    <label style="font-weight: bold;">Pay flat fee $<?= number_format($deals_price,2,".",","); ?> to list your deal for 1 Month.</label>
                                </div>
                                <div class="help help-sm help-block">                                        
                                    <div class="help help-sm">
                                        The deal will be emailed to your customers upon confirmation. No additional commission on customer bookings and transactions.
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5">
                                        <label>Valid From  <span class="bx bx-fw bx-help-circle" id="popover-help-valid-from"></span></label>      
                                        <input type="date" name="valid_from" value="<?= isset($dealsSteals) ? date("Y-m-d",strtotime($dealsSteals->valid_from)) : date("Y-m-d"); ?>"  class="form-control" autocomplete="off" required />
                                    </div>
                                    <div class="col-md-5">
                                        <label>Valid To  <span class="bx bx-fw bx-help-circle" id="popover-help-valid-to"></span></label>     
                                        <input type="date" name="valid_to" value="<?= isset($dealsSteals) ? date("Y-m-d",strtotime($dealsSteals->valid_to)) : date("Y-m-d"); ?>"  class="form-control" autocomplete="off" required />
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                  <div class="col-md-6" style="font-size: 24px;">
                                        <label><b style="font-size: 24px;">Total</b></label>
                                        <label>: <b>$<?= number_format($deals_price, 2); ?></b></label>
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
<script>
$(function(){
    $("#deals_steals_preview").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + 'promote/update_validity',
            dataType: "json",
            data: $("#deals_steals_preview").serialize(),
            success: function(o)
            {
                $('.btn-deals-preview').prop("disabled", false);
                $(".btn-deals-preview").html('Continue »');

                if( o.is_success == 1 ){
                    location.href = base_url + "promote/payment";
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: o.err_msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function(){
                $('.btn-deals-preview').html('<span class="bx bx-loader bx-spin"></span>');
                $('.btn-deals-preview').prop("disabled", true);
            }
        });
    });

    $('#popover-help-valid-from').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Select the start date. You can schedule a deal if you set this date in future';
        }
    });

    $('#popover-help-valid-to').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'The date when the deal will expire';
        }
    });
});
</script>