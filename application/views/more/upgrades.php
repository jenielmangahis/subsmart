<style>
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
  padding-left: 30px !important;
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
.col.col-4.pd-17.left.alert.alert-warning.mt-0.mb-2 {
    position: relative;
    left: 13px;
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
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="card p-20" style="width:99%;">
                  <div>
                      <div class="row align-items-center">
                          <div class="col-sm-12">
                              <h3 class="page-title">Add-on Plugins</h3>
                          </div>
                      </div>
                      <div class="pl-3 pr-3 mt-1 row">
                        <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">A plugin is a piece of software that acts as an add-on to a web browser and gives the browser additional functionality.  Plugins can allow a web browser to display additional content it was not originally designed to display.  Integration to these plug-ins will help your company have more functionality to maneuver in tougher markets.</span>
                        </div>
                      </div>
                  <div class="col-xl-12">
                      <?php include viewPath('flash'); ?>
                      <!-- <div class="card">
                          <div class="card-body">
                              <p>Add-on Plugins</p>
                          </div>
                      </div> -->
                      <!-- <div class="marketing-card-deck card-deck pl-50 pb-100">
                          <a href="#" class="card border-gr"> <img
                                      class="marketing-img" alt="SMS Blast - Flaticons" src="<?php echo base_url('/assets/dashboard/images/online-booking.png') ?>"
                                      data-holder-rendered="true">
                              <div class="card-body align-left">
                                  <h5 class="card-title mb-0">Online Booking</h5>
                                  <p style="text-align: justify;" class="card-text mt-txt">Set your services with prices and place a booking form on your website and collect leads from your customers.</p>
                                  <p style="text-align: center;"><strong>Subscribe Now</strong></p>
                                  <div style="text-align: center;" class="card-price bottom-txt">$0.05/SMS + $5.00 service fee</div>
                              </div>
                          </a>
                      </div> -->

                      <?php  $row = 1;
                             if($NsmartUpgrades) {  foreach ($NsmartUpgrades as $key => $NsmartUpgrade) { ?>

                             <?php if($row == 1){ ?>
                               <div class="marketing-card-deck card-deck-upgrades pl-1 pb-30"> <?php } $row++; ?>
                                 <div class="card-container">
                                    <a href="#" class="card border-gr btn-addon" data-id="<?= $NsmartUpgrade->id; ?>">
                                        <img class="marketing-img" alt="Add On" src="<?php echo base_url('/assets/img/onboarding/'.$NsmartUpgrade->image_filename) ?>" data-holder-rendered="true">
                                        <div class="card-body align-left">
                                            <h5 class="card-title mb-0"><?php echo $NsmartUpgrade->name; ?></h5>
                                            <p style="text-align: justify;" class="card-text mt-txt"><?php  echo $NsmartUpgrade->description; ?></p>
                                            <p style="text-align: center;"><strong>Subscribe Now</strong></p>
                                            <div style="text-align: center;width:100%;" class="card-price bottom-txt">
                                              <span style="position: relative;right: 40px;">$<?php  echo $NsmartUpgrade->sms_fee; ?>/SMS + $<?php  echo $NsmartUpgrade->service_fee; ?> service fee</span></div>
                                        </div>
                                    </a>
                                  </div>
                           <?php if($row == 4){ ?>
                            </div>
                          <?php $row = 1; }   ?>


                      <?php    }
                            } ?>

                      <!-- end card -->
                  </div>
              </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->

    <!-- Modal loading box -->
    <div class="modal fade" id="modalLoadingMsg" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="">Add Plugin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php echo form_open_multipart('more/add_plugin', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <?php echo form_input(array('name' => 'pid', 'type' => 'hidden', 'value' => '', 'id' => 'pid'));?>
            <div class="modal-body plugin-info-container"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $(".btn-addon").click(function(){
        var aid = $(this).attr("data-id");

        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline-block;" /> Loading...</div>';
        var url = base_url + '/more/_load_plugin_details';

        $("#pid").val(aid);
        $("#modalLoadingMsg").modal("show");
        $(".plugin-info-container").html(msg);

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {aid:aid},
               success: function(o)
               {
                  $(".plugin-info-container").html(o);
               }
            });
        }, 500);
    });
});
</script>
