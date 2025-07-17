<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
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
                            <div>The final step is to purchase the campaign.</div>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'frm-activate-deals-steals', 'autocomplete' => 'off']); ?>
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
                                  <div class="step completed">
                                      <div class="step-icon-wrap">
                                          <div class="step-icon"><i class='bx bx-credit-card'></i></div>
                                      </div>
                                      <h4 class="step-title">Purchase</h4>
                                  </div>
                              </div>  
                          </div>
                      </div>
                    </div>
                  </div>    

                    <div class="row mt-5">
                        <div class="col-md-6">  
                            <div class="nsm-card primary">
                              <div class="nsm-card-header">
                                <div class="nsm-card-title"><span><i class='bx bx-credit-card'></i> CREDIT CARD PAYMENT</span></div>
                              </div>  
                              <div class="nsm-card-content">
                                <div class="row g-3">
                                  <div class="col-12">
                                      <label class="content-subtitle fw-bold d-block mb-2">Card Number</label>
                                      <input type="text" placeholder="" name="card_number" class="nsm-field form-control" required />
                                  </div>
                                  <div class="col-12">
                                      <label class="content-subtitle fw-bold d-block mb-2">Expiration</label>
                                      <div class="row g-3">
                                          <div class="col-12 col-md-3">
                                              <select class="nsm-field form-select" name="exp_month" required>
                                                  <option value="" selected="selected" disabled>Month</option>
                                                  <option value="01">01</option>
                                                  <option value="02">02</option>
                                                  <option value="03">03</option>
                                                  <option value="04">04</option>
                                                  <option value="05">05</option>
                                                  <option value="06">06</option>
                                                  <option value="07">07</option>
                                                  <option value="08">08</option>
                                                  <option value="09">09</option>
                                                  <option value="10">10</option>
                                                  <option value="11">11</option>
                                                  <option value="12">12</option>
                                              </select>
                                          </div>
                                          <div class="col-12 col-md-2">
                                              <select class="nsm-field form-select" name="exp_year" required>
                                                  <option value="" selected="selected" disabled>Year</option>
                                                  <?php for( $x = date("Y"); $x<=date("Y", strtotime("+20 years")); $x++ ){ ?>
                                                      <option value="<?= $x; ?>"><?= $x; ?></option>
                                                  <?php } ?>
                                              </select>
                                          </div>
                                          <div class="col-12 col-md-2">
                                              <input type="password" placeholder="CVC" name="cvc" class="nsm-field form-control" required maxlength="4" />
                                          </div>
                                      </div>
                                  </div>

                                </div>                                
                              </div>
                            </div>             
                        </div>
                        <div class="col-md-6">
                          <div class="nsm-card primary">
                            <div class="nsm-card-header">
                              <div class="nsm-card-title"><span><i class='bx bx-list-ul' ></i> ORDER DETAILS</span></div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row">
                                  <div class="col-md-6"><strong style="font-size: 15px;">Deal</strong></div>
                                  <div class="col-md-6"><strong style="font-size: 15px;"><?= $dealsSteals->title; ?></strong></div>
                                </div>
                                <div class="row mt-3">
                                  <div class="col-md-6"><strong style="font-size: 15px;">Package</strong></div>
                                  <div class="col-md-6"><strong style="font-size: 15px;">1 Month for $<?= number_format($deals_price, 2); ?></strong></div>
                                </div>
                                <div class="row mt-3">
                                  <div class="col-md-6"><strong style="font-size: 15px;">Valid Period</strong></div>
                                  <div class="col-md-6"><strong style="font-size: 15px;"><?= date("m/d/Y", strtotime($dealsSteals->valid_from)) . " to " . date("m/d/Y", strtotime($dealsSteals->valid_to)) ?></strong></div>
                                </div>
                                <div class="row mt-3">
                                  <div class="col-md-6"><strong style="font-size: 15px;">Expiration</strong></div>
                                  <div class="col-md-6"><strong style="font-size: 15px;"><?= date("m/d/Y", strtotime('+1 month')); ?></strong></div>
                                </div>
                                <div class="row mt-4">
                                  <div class="col-md-6"><strong style="font-size: 22px;">Amount to Pay</strong></div>
                                  <div class="col-md-6"><span class="cart-summary-total" style="font-size: 22px;"><b>$<?= number_format($deals_price, 2); ?></b></span></div>
                                </div>
                                <div class="row mt-5">                 
                                    <div class="col-md-12 text-center">   
                                        <button type="button" class="nsm-button default" id="btn-deals-steals-back" style="width: 30%;">BACK</button>
                                        <button type="submit" class="nsm-button primary" id="btn-deals-steals-activate" style="width: 30%;">PAY</button>
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
    $('#btn-deals-steals-back').on('click', function(){
      location.href = base_url + 'promote/preview_email_message';
    });

    $('#frm-activate-deals-steals').on('submit', function(e){
      e.preventDefault();
        $.ajax({
          type: "POST",
          url: base_url + 'promote/_activate_deals',
          dataType: "json",
          data: $("#frm-activate-deals-steals").serialize(),
          success: function(o)
          {
              $('#btn-deals-steals-activate').prop("disabled", false);
              $('#btn-deals-steals-activate').html('PAY');

              if( o.is_success == 1 ){                        
                  Swal.fire({
                      title: 'Deals Steals',
                      text: "Payment successful. Your deals is now activated.",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      //if (result.value) {
                        location.href = base_url + 'promote/deals';
                      //}
                  });
              }else{
                  Swal.fire({
                      icon: 'error',
                      title: 'Cannot upgrade plan',
                      text: o.message
                  });
              }
          },
          beforeSend: function(){
            //$('#btn-deals-steals-activate').prop("disabled", true);
            $('#btn-deals-steals-activate').html('<span class="bx bx-loader bx-spin"></span>');
          }
      });
    });
      
});
</script>