<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_front_booking'); ?>
<div>
    <!-- page wrapper start -->
    <div class="col-xl-9 left">
        <div class="container-fluid pl-0 pr-0">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title-v2">Schedule</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                  <div class="sc-name">Choose an arrival window.</div>
                  <div class="col-12 sc-container pl-0 pr-0 pt-3 mt-4">                    
                    <div class="schedule-container"></div>                    
                  </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <div class="col-xl-3 container-full-col">
      <div class="widget-cnt-right">
         <div class="widget-cnt-right__child">
            <div class="widget-cart margin-bottom-sec" data-cart="cart">
               <?php include viewPath('includes/sidebars/front_items_cart'); ?>
            </div>
         </div>
      </div>
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_front_booking'); ?>
<script>
var base_url = "<?php echo base_url(); ?>";

function continue_cart(){    
    var eid = "<?php echo $eid; ?>";
    window.location.href = base_url + "booking/front_booking_form/"+eid;
}

$(function(){
    function load_week_schedule(week_start_date, eid){
      var url = base_url + '/booking/_load_week_schedule';
      var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading schedule...</div>';

      $(".schedule-container").html(msg);

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {week_start_date:week_start_date, eid:eid},
             success: function(o)
             {
                $(".schedule-container").html(o);
             }
          });
      }, 1000);
    }

    load_week_schedule('<?php echo $week_start_date; ?>','<?php echo $eid; ?>');
});
</script>
