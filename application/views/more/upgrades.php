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
    width: 100%;
}
.card-body.align-left {
  width: 100% !important;
  padding: 0px;
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
                      <div class="row">                        
                        <?php foreach ($NsmartUpgrades as $nu) { ?>
                          <div class="col-md-3 col-sm-12" style="padding: 0px;">
                            <div class="marketing-card-deck card-deck-upgrades pl-1 pb-30">
                                 <div class="card-container">
                                    <a href="javascript:void(0);" class="card border-gr btn-addon" data-id="<?= $nu->id; ?>">
                                        <img class="marketing-img" alt="Add On" src="<?php echo base_url('/assets/img/onboarding/'.$nu->image_filename) ?>" data-holder-rendered="true">
                                        <div class="card-body align-left">
                                            <h5 class="card-title mb-0"><?php echo $nu->name; ?></h5>
                                            <p style="text-align: justify;margin-top: 45px;height: 100px;" class="card-text mt-txt"><?php  echo $nu->description; ?></p>
                                            <p style="color:#36c12a;text-align: center;font-size: 17px;">
                                              $<?php  echo $nu->sms_fee; ?>/SMS + $<?php  echo $nu->service_fee; ?> service fee
                                            </p>
                                            <p style="text-align: center;"><strong>Subscribe Now</strong></p>
                                        </div>
                                    </a>
                                  </div>
                                </div>
                          </div>
                        <?php } ?>
                      </div>
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
                <button type="submit" class="btn btn-success">Add</button>
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
