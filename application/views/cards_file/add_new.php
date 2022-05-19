<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.popover-holder .popover {
  background: #f3f3f3;
  border: 1px solid rgb(235, 235, 235);
  border-radius: 50%;
  color: #737373;
  position: relative;
  width: 15px;
  height: 15px;
  z-index: 9;
}

.popover-questionmark {
  margin: -2px 0px 3px 3px;
  font-size: 12px;
}

.popover {
  box-shadow: rgba(0, 0, 0, 0.3) 0 2px 10px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><i class="fa fa-plus"></i> Add Card</h1>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning mt-1 mb-4" role="alert">
                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Add and save a new card on vault.
                </span>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('cards_file/create_new_card', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                        <div class="row">
                          <div class="col-md-10">
                            <label for=""><b>Your Name (as it appears on your card)</b><span class="required_field">*</span></label>
                            <input type="text" required="" value="" class="form-control" name="card_owner_name" id="card_owner_name" required="">
                          </div>
                        </div>
                        <br />
                        <div class="row">
                          <div class="col-md-10">
                            <label for=""><b>Card Number</b><span class="required_field">*</span></label>
                            <input type="text" required="" value="" class="form-control" name="card_number" id="card_number" required="">
                          </div>
                        </div>
                        <br />

                        <div class="row">
                          <div class="col-md-2">
                              <div class="form-group" id="customer_type_group">
                                  <label for=""><b>Expiration</b><span class="required_field">*</span></label>
                                  <select name="expiration_month" class="form-control" required="">
                                    <option>- month -</option>
                                    <option value="1">01 - Jan</option>
                                    <option value="2">02 - Feb</option>
                                    <option value="3">03 - Mar</option>
                                    <option value="4">04 - Apr</option>
                                    <option value="5">05 - May</option>
                                    <option value="6">06 - Jun</option>
                                    <option value="7">07 - Jul</option>
                                    <option value="8">08 - Aug</option>
                                    <option value="9">09 - Sep</option>
                                    <option value="10">10 - Oct</option>
                                    <option value="11">11 - Nov</option>
                                    <option value="12">12  -Dec</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group" id="customer_type_group">
                                  <label for=""><br /></label>
                                  <select name="expiration_year" class="form-control" required="">
                                    <option>- year-</option>
                                    <?php for($x = date("Y"); $x <= date("Y",strtotime("+10 years")); $x++){ ?>
                                      <?php $year = substr($x, -2); ?>
                                      <option value="<?= $year; ?>"><?= $x; ?></option>  
                                    <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group" id="customer_type_group">
                                  <label for=""><b>Card CVV</b><span class="required_field">*</span></label>
                                  <input type="text" required="" value="" class="form-control" name="card_cvv" id="card_cvv" required="">
                              </div>
                          </div>
                          <div class="col-md-2">
                            <a href="#" id="help-popover-cvc" style="margin-top: 29px;display: block;color:#259e57;width: 30%;"> Where is<br>CVV</a>
                              <div class="hide" id="help-popover-cvc-content" style="display: none;margin-bottom: 20px;">
                                  <span class="help"> Please insert your card security number/CVV number. For all cards, except American Express, this is the <b>last 3 digits on the back of your card</b>. For American Express, this is the <b>4 digits printed on the front of your card</b>, above the 15 digit card number.</span><br> <img src="<?= base_url("assets/img/cvv.png"); ?>">
                              </div>
                          </div>
                        </div>
                        <hr />
                        <div class="col-md-">
                          <a class="btn btn-default" href="<?php echo base_url('cards_file/list'); ?>">Cancel</a>
                          <button type="submit" class="btn btn-primary">Save Card</button>
                        </div>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(document).ready(function(){
    $('#help-popover-cvc').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return $('#help-popover-cvc-content').html();
        } 
    });  
 });
</script>