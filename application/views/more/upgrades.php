<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Add-on Plugins</h1>
                    </div>

                </div>
            </div>
            <!-- end row -->
            <div class="row">
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
                             <div class="marketing-card-deck card-deck pl-50 pb-100"> <?php } $row++; ?>

                                <a href="#" class="card border-gr btn-addon" data-id="<?= $NsmartUpgrade->id; ?>">
                                    ><img class="marketing-img" alt="Add On" src="<?php echo base_url('/assets/img/onboarding/'.$NsmartUpgrade->image_filename) ?>" data-holder-rendered="true">
                                    <div class="card-body align-left">
                                        <h5 class="card-title mb-0"><?php echo $NsmartUpgrade->name; ?></h5>
                                        <p style="text-align: justify;" class="card-text mt-txt"><?php  echo $NsmartUpgrade->description; ?></p>
                                        <p style="text-align: center;"><strong>Subscribe Now</strong></p>
                                        <div style="text-align: center;" class="card-price bottom-txt">$<?php  echo $NsmartUpgrade->sms_fee; ?>/SMS + $<?php  echo $NsmartUpgrade->service_fee; ?> service fee</div>
                                    </div>
                                </a>
                         <?php if($row == 4){ ?>
                          </div>
                        <?php $row = 1; }   ?>


                    <?php    }
                          } ?>

                    <!-- end card -->
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
