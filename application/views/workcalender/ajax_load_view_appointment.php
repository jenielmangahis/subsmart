<style>
.v-appointment-customer{
  font-size: 26px;
  text-align: left;
  margin-bottom: 30px;
}
.v-appointment-phone, .v-appointment-email, .v-appointment-time, .v-appointment-user, .v-appointment-type, .v-appointment-tags{
  display: block;
  width: 100%;
  font-size: 17px;
  color: #656565;
  margin-bottom: 11px;
}
.v-appointment-date{
  font-size: 17px;
  color: #656565;
  margin-left: 23px;
}
.v-appointment-time{
  margin-top: 32px;
  font-size: 20px;
  margin-bottom: 0px;
}
.v-appointment-type{
  margin-top: 32px;
  font-size: 20px;
}
.v-appointment-tags{
  margin-top: 12px;
  font-size: 20px; 
}
.v-appointment-user{
  font-size: 20px;
  margin-top: 2px;
  text-align: center;
}
.appointment-tags{
  list-style: none;
  padding: 0px;
}
.appointment-tags li{
  margin: 5px;
  display: inline-block;  
}
.badge-success {
    color: #fff;
    background-color: #28a745;
    font-size: 20px;
    padding: 12px;
}
}
</style>
<?php if( $appointment ){ ?>
<?php 
  $c_phone = "unknown";
  $c_email = "unknown";

  if( $appointment->customer_phone != '' ){
    $c_phone = $appointment->customer_phone;
  }

  if( $appointment->customer_email != '' ){
    $c_email = $appointment->customer_email;
  }
?>
<?php if( $appointment->is_paid == 1 ){ ?>
<div class="row" style="margin-bottom: 20px;">
 <div class="col-12" style="text-align: right;">
  <span class="badge badge-success">PAID</span>
 </div>
</div>
<?php } ?>
<div class="row" style="text-align: left;">
  <div class="col-md-6">    
    <h3 class="v-appointment-customer"><i><?= $appointment->customer_name; ?></i></h3>
    <span class="v-appointment-phone"><i class="fa fa-phone"></i> <?= $c_phone; ?></span>
    <span class="v-appointment-email"><i class="fa fa-envelope"></i> <?= $c_email; ?></span>
  </div>
  <div class="col-md-6">
    <img src="<?= userProfileImage($appointment->user_id); ?>" alt="Admin" class="rounded-circle" width="150" style="margin: 0 auto;">
    <span class="v-appointment-user"><i class="fa fa-address-card-o"></i> <?= $appointment->employee_name; ?></span>
  </div>
</div>
<div class="row" style="text-align: left;">
  <div class="col-md-12">
    <span class="v-appointment-time"><i class="fa fa-clock-o"></i> <?= date("g:i A",strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time)); ?></span>
    <span class="v-appointment-date"><?= date("l, F D, Y", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time)); ?></span>
  </div>
  <div class="col-md-12">
    <span class="v-appointment-type"><i class="fa fa-list"></i> Appointment Type : <?= $optionAppointmentType[$appointment->appointment_type]; ?></span>
  </div>
  <div class="col-md-12">
    <span class="v-appointment-tags"><i class="fa fa-tag"></i> Tags : </span>
    <ul class="appointment-tags">
      <?php foreach($a_tags as $tag){ ?>
        <?php 
          if( $tag['icon'] != '' ){
              if($tag['is_marker_icon_default_list'] == 1){
                  $marker = base_url("uploads/icons/" . $tag['icon']);
              }else{
                  $marker = base_url("uploads/event_tags/" . $tag['cid'] . "/" . $tag['icon']);
              }
          }else{
              $marker = base_url("uploads/event_tags/default_no_image.jpg");
          }
        ?>
        <li><img src="<?= $marker; ?>" style="height: 39px;" /></li>
      <?php } ?>
      
    </ul>
  </div>
</div>
<?php }else{ ?>
<div class="alert alert-danger alert-dismissible fade show" style="width: 100%;margin-top: 10px;margin-bottom: 10px;">
  <p>Appointment not found</p>  
</div>
<?php } ?>
<script>
$(function(){
  $(".view-appointment-actions").fadeIn();
  <?php if( $appointment->is_paid == 1 ){ ?>
    $(".btn-checkout-appointment").hide();
    $(".btn-edit-appointment").hide();
    $(".btn-payment-details-appointment").show();
  <?php } ?>
});
</script>