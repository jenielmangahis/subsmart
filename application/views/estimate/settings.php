<style>
hr{
    border: 0.5px solid #32243d !important;
    width: 100%;
}
.form-group {
    margin-bottom: 2px !important;
}
.banking-tab-container {
    border-bottom: 1px solid grey;
    padding-left: 0;
}
.form-line{
    padding-bottom: 1px;
}
.input_select{
    color: #363636;
    border: 2px solid #e0e0e0;
    box-shadow: none;
    display: inline-block !important;
    width: 100%;
    background-color: #fff;
    background-clip: padding-box;
    font-size: 11px !important;
}
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 15px !important;
  padding-top: 40px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/estimate'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart('estimate/save_setting/', ['class' => 'form-validate require-validation', 'id' => 'settings_form', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card" style="padding-top:30px;">
                        <div>
                          <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Settings</h5>
                          <div class="col-sm-12">
                              <div class="validation-error" id="estimate-error" style="display: none;">You selected Credit Card Payments as payment method for this invoice. Please configure the <a href="https://www.markate.com/pro/settings/payments/main">Online Payment processor</a> first to accept cart payments.</div>
                          </div>
                        </div>
                        <div class="pl-3 pr-3 mt-2 row">
                          <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                              <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
                          </div>
                        </div>
                        <div class="card-body" style="padding:0px 0px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Invoice Number</h5>
                                    <span class="help help-sm help-block">Set the prefix and the next auto-generated number.</span>
                                </div>
                                <div class="col-sm-1">
                                    <div class="margin-bottom-qui">Prefix</div>
                                    <input type="text" name="prefix" class="form-control" autocomplete="off" value="<?php echo ($setting) ? $setting->estimate_num_prefix : 0 ?>">
                                    <span class="validation-error-field hide" data-formerrors-for-name="next_custom_number_prefix" data-formerrors-message="true"></span>
                                </div>
                                <div class="col-sm-2">
                                    <div class="margin-bottom-qui">Next number</div>
                                    <input type="text" name="base" value="<?php echo ($setting) ? $setting->estimate_num_next : ''  ?>" class="form-control" autocomplete="off">
                                    <span class="validation-error-field hide" data-formerrors-for-name="next_custom_number_base" data-formerrors-message="true"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tabs">
                                        <ul class="clearfix">
                                            <li data-tab="residential" id="res_li" class="active">
                                                <a href="#" id="inv-set-residential">
                                                    Residential
                                                </a>
                                            </li>
                                            <li data-tab="commercial" id="com_li">
                                                <a href="#" id="inv-set-commercial">
                                                    Commercial
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="invoice_type" id="invoice_type" value="residential">
                                    <div id="tab_residential" class="tab-panel">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Residential Invoice Default Message</label>
                                                    <div class="help help-sm help-block">Custom message that will be placed at the bottom section of the invoice.</div>
                                                    <textarea name="residential_message" id="residential_message" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->residential_message : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="message" data-formerrors-message="true"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Residential Invoice Default Terms &amp; Conditions</label>
                                                    <div class="help help-sm help-block">Your T&amp;C that will appear at the bottom section of the invoice.</div>
                                                    <textarea name="residential_terms" id="residential_terms" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->residential_terms_and_conditions : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab_commercial" class="tab-panel" style="display: none;">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <?php 
                                                          $is_checked = '';
                                                          if( $setting ){
                                                            if( $setting->is_residential_message_default == 1 ){
                                                              $is_checked = 'checked="checked"';
                                                            }
                                                          }
                                                        ?>
                                                        <input type="checkbox" name="is_residential_default" value="1" <?= $is_checked; ?> id="same_as_residential">
                                                        <label for="same_as_residential">Set default value as Residential</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Commercial Invoice Default Message</label>
                                                    <div class="help help-sm help-block">Custom message that will be placed at the bottom section of the invoice.</div>
                                                    <textarea name="message_commercial" id="message_commercial" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->commercial_message : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="message" data-formerrors-message="true"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Commercial Invoice Default Terms &amp; Conditions</label>
                                                    <div class="help help-sm help-block">Your T&amp;C that will appear at the bottom section of the invoice.</div>
                                                    <textarea name="terms_commercial" id="terms_commercial" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->commercial_terms_and_conditions : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary margin-right" data-action="save" type="submit">Save Changes</button>
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
    $(document).on("click", "#inv-set-commercial", function (e) {
        e.preventDefault();
        $("#tab_residential").hide();
        $("#tab_commercial").show();
        $("#res_li").removeClass("active");
        $("#com_li").addClass("active");
        $("#invoice_type").val("commercial");
      });

      $(document).on("click", "#inv-set-residential", function (e) {
        e.preventDefault();
        $("#tab_commercial").hide();
        $("#tab_residential").show();
        $("#com_li").removeClass("active");
        $("#res_li").addClass("active");
        $("#invoice_type").val("residential");
      });
</script>
