<style>
.c-appointment-customer, .c-appointment-employee{
  font-size: 24px;
  text-align: left;
  margin-bottom: 9px;
}
.c-appointment-header{
  font-size: 28px;
  text-align: left;
  margin-bottom: 15px;
}

.c-appointment-phone, .c-appointment-email, .c-appointment-date-time, .c-appointment-type, .a-appointment-user{
  display: inline-block;
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
.v-appointment-user{
  font-size: 20px;
  margin-top: 2px;
  text-align: center;
}

.table {
width: 100%;
margin-bottom: 20px;
background-color: transparent;
border-collapse: collapse;
border-spacing: 0;
display: table;
}

.borderless td, .borderless th {
    border: none;
}

.widget.widget-table .table {
margin-bottom: 0;
border: none;
}

.widget.widget-table .widget-content {
padding: 0;
}

.widget .widget-header + .widget-content {
border-top: none;
-webkit-border-top-left-radius: 0;
-webkit-border-top-right-radius: 0;
-moz-border-radius-topleft: 0;
-moz-border-radius-topright: 0;
border-top-left-radius: 0;
border-top-right-radius: 0;
}

.widget .widget-content {
padding: 20px 15px 15px;
background: #FFF;
border: 1px solid #D5D5D5;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
}

.widget .widget-header {
position: relative;
height: 40px;
line-height: 40px;
background: #E9E9E9;
background: -moz-linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fafafa), color-stop(100%, #e9e9e9));
background: -webkit-linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
background: -o-linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
background: -ms-linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
background: linear-gradient(top, #fafafa 0%, #e9e9e9 100%);
text-shadow: 0 1px 0 #fff;
border-radius: 5px 5px 0 0;
box-shadow: 0 2px 5px rgba(0,0,0,0.1),inset 0 1px 0 white,inset 0 -1px 0 rgba(255,255,255,0.7);
border-bottom: 1px solid #bababa;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#E9E9E9');
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#E9E9E9')";
border: 1px solid #D5D5D5;
-webkit-border-top-left-radius: 4px;
-webkit-border-top-right-radius: 4px;
-moz-border-radius-topleft: 4px;
-moz-border-radius-topright: 4px;
border-top-left-radius: 4px;
border-top-right-radius: 4px;
-webkit-background-clip: padding-box;
}

thead {
display: table-header-group;
vertical-align: middle;
border-color: inherit;
}

.widget .widget-header h3 {
top: 2px;
position: relative;
left: 10px;
display: inline-block;
margin-right: 3em;
font-size: 14px;
font-weight: 600;
color: #555;
line-height: 18px;
text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
}

.widget .widget-header [class^="icon-"], .widget .widget-header [class*=" icon-"] {
display: inline-block;
margin-left: 13px;
margin-right: -2px;
font-size: 16px;
color: #555;
vertical-align: middle;
}
.widget-header h3{
  display: inline-block;
  width: 90%;
}
.btn-c-payment, .btn-c-back{
  margin: 0 auto;
  display: block;
}
.c-online-payment-logo{
  margin: 7% auto;
  height: 87px;
}
.payment-logo-container{
  display: block;
  height: 143px;
  border: 1px solid rgb(101, 101, 101);
  padding: 6px;
}
.input-group-prepend {
  height: 48px !important;
}
.form_line{
    margin-bottom: 7px;
    margin-top: 8px;
}
</style>
<?php if( $appointment ){ ?>
<?php 
  $c_phone = "unknown";
  $c_email = "unknown";

  if( $appointment->customer_phone != '' ){
    $a_phone = $appointment->customer_phone;
  }

  if( $appointment->customer_email != '' ){
    $c_email = $appointment->customer_email;
  }

  $u_mobile = "unknown";
  $u_email  = "unknown";

  if( $appointment->user_email != '' ){
    $u_mobile = $appointment->user_email;
  }

  if( $appointment->user_mobile != '' ){
    $u_email = $appointment->user_mobile;
  }
?>
<div class="row" style="text-align: left;">
  <div class="col-md-9">
    <!-- Start step1 -->
    <div class="checkout-step1">
      <div class="row" style="border: 1px solid #656565; margin: 10px;">
        <div class="col">
          <h3 class="c-appointment-header"><b>Client</b></h3>
          <h3 class="c-appointment-customer"><b><?= $appointment->customer_name; ?></b></h3>
          <span class="c-appointment-type"><i class="fa fa-list"></i> Appointment Type : <?= $optionAppointmentTypes[$appointment->appointment_type]; ?></span><br />
          <span class="c-appointment-phone"><i class="fa fa-phone"> Phone : </i> <?= $c_phone; ?> / </span>
          <span class="c-appointment-email"><i class="fa fa-envelope"> Email :</i> <?= $c_email; ?></span><br />
          <span class="c-appointment-date-time"><i class="fa fa-clock-o"></i> <?= date("g:i A",strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time)); ?> - <i class="fa fa-calendar"></i> <?= date("l, F D, Y", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time)); ?></span>
        </div>
        <div class="col">
          <h3 class="c-appointment-header"><b>Assigned Employee</b></h3>
          <div class="row">
            <div class="col-2">
              <img src="<?= userProfileImage($appointment->user_id); ?>" alt="Admin" class="rounded-circle" width="150" style="margin: 0 auto;">
            </div>
            <div class="col">
              <span class="a-appointment-user"><i class="fa fa-address-card-o"></i> <?= $appointment->employee_name; ?></span><br />
              <span class="c-appointment-phone"><i class="fa fa-phone"> Phone : </i> <?= $u_mobile; ?> / </span>
              <span class="c-appointment-email"><i class="fa fa-envelope"> Email :</i> <?= $u_email; ?></span><br />
            </div>
          </div>
        </div>
      </div>  

      <div class="row" style="border: solid 1px #656565; margin: 10px;">
        <div class="col" style="margin-top:21px;">
          
          <div class="widget-header">          
            <h3><i class="fa fa-tag"></i> Items</h3>
            <a href="javascript:;" class="btn btn-sm btn-primary btn-checkout-add-item" style="display: inline-block;">
              <i class="fa fa-plus"></i> Add Item
            </a>
          </div>
          <div class="widget-content">
            <form id="frm-checkout-items" method="post">
            <input type="hidden" name="aid" value="<?= $appointment->id; ?>">
            <table class="table table-borderless tbl-items" style="border: none;">            
              <tbody>
                <?php 
                  $total_items = 0;
                  $total_tax   = 0;
                  $total_discount = 0;
                ?>
                <?php if( $appointmentItems ){ ?>
                  <?php $row = 1; foreach($appointmentItems as $item){ ?>
                  <?php 
                    $total_items += $item->item_price;
                    $total_discount += $item->discount_amount;
                  ?>
                  <tr style="background: none !important;">
                    <td style="width:60%;">
                      <input type="text" class="form-control" value="<?= $item->item_name; ?>" name="items[]" placeholder="Item Name">
                    </td>
                    <td>
                      <input type="text" class="form-control item-price" value="<?= number_format($item->item_price,2); ?>" name="price[]" placeholder="Item Price">
                    </td>
                    <td>
                      <input type="text" class="form-control item-discount" value="<?= number_format($item->discount_amount,2); ?>" name="discount[]" placeholder="Item Discount">
                    </td>
                    <td class="td-actions">
                      <?php if( $row > 1 ){ ?>
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-item-delete"><i class="fa fa-trash"></i></a>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php $row++;} ?>
                <?php }else{ ?>
                  <tr style="background: none !important;">
                    <td style="width:60%;">
                      <input type="text" class="form-control" name="items[]" placeholder="Item Name">
                    </td>
                    <td>
                      <input type="text" class="form-control item-price" name="price[]" placeholder="Item Price">
                    </td>
                    <td>
                      <input type="text" class="form-control item-discount" name="discount[]" placeholder="Item Discount">
                    </td>
                    <td class="td-actions"></td>
                  </tr>
                <?php } ?>
                <?php $total_amount = $total_items + $total_tax - $total_discount; ?>              
                </tbody>
            </table>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End step1 -->

    <!-- Start step2 -->
    <div class="checkout-step2" style="display: none;border: solid 1px #656565; padding: 35px;">
      <!-- Gateway select -->
      <div class="checkout-online-gateway">
        <h3><i class="fa fa-credit-card"></i> Select Payment Gateway</h3>
        <div class="row" style="margin-top: 32px;">
            <div class="col-3">
              <a href="javascript:void(0);" class="c-cash-logo payment-logo-container">
                <img class="img-responsive c-online-payment-logo c-paypal-logo" src="<?php echo $url->assets ?>img/cashpayment.png" style="height: 127px;margin:0 auto;">
              </a>
            </div>
            <div class="col-3">
              <a href="javascript:void(0);" class="c-converge-logo payment-logo-container">
                <img class="img-responsive c-online-payment-logo" src="<?php echo $url->assets ?>img/converge-logo.png">
              </a>
            </div>
            <div class="col-3">
              <a href="javascript:void(0);" class="c-paypal-logo payment-logo-container">
                <img class="img-responsive c-online-payment-logo c-paypal-logo" src="<?php echo $url->assets ?>img/paypal-logo.png">
              </a>
            </div>
            <div class="col-3">
              <a href="javascript:void(0);" class="c-stripe-logo payment-logo-container">
                <img class="img-responsive c-online-payment-logo c-stripe-logo" src="<?php echo $url->assets ?>img/stripe-logo.png">
              </a>
            </div>
        </div>
      </div>
      <!-- end gateway selecy -->

      <!-- Converge form -->
      <div class="checkout-converge-form" style="display: none;">
          <h3><i class="fa fa-credit-card"></i> Converge Payment</h3>
          <div id="credit_card" style="margin-top: 49px;">            
            <form id="frm-converge-payment">
              <input type="hidden" id="converge-checkout-aid" name="converge_checkout_aid" value="<?= $appointment->id; ?>">
              <div class="row form_line">
                  <div class="col-md-2">
                      Card Number
                  </div>
                  <div class="col-md-8">
                      <input type="text" class="form-control" name="card_number" id="cardnumber" value="" required/>
                  </div>
              </div>
              <div class="row form_line">
                  <div class="col-md-2">
                      <label for="">Expiration 
                  </div>
                  <div class="col-md-8">
                      <div class="row">
                          <div class="col-md-4">
                              <select id="exp_month" name="exp_month" class="form-control exp_month" style="border:solid 1px rgba(0,0,0,0.35);" required>
                                  <option  value="">Month</option>
                                  <option  value="01">01</option>
                                  <option  value="02">02</option>
                                  <option  value="03">03</option>
                                  <option  value="04">04</option>
                                  <option  value="05">05</option>
                                  <option  value="06">06</option>
                                  <option  value="07">07</option>
                                  <option  value="08">08</option>
                                  <option  value="09">09</option>
                                  <option  value="10">10</option>
                                  <option  value="11">11</option>
                                  <option  value="12">12</option>
                              </select>
                          </div>
                          <div class="col-md-4">
                              <select id="exp_year" name="exp_year" class="form-control exp_year" style="border:solid 1px rgba(0,0,0,0.35);" required>
                                  <option  value="">Year</option>
                                  <option  value="2021">2021</option>
                                  <option  value="2022">2022</option>
                                  <option  value="2023">2023</option>
                                  <option  value="2024">2024</option>
                                  <option  value="2025">2025</option>
                                  <option  value="2026">2026</option>
                                  <option  value="2027">2027</option>
                                  <option  value="2028">2028</option>
                                  <option  value="2029">2029</option>
                                  <option  value="2030">2030</option>
                                  <option  value="2031">2031</option>
                              </select>
                          </div>
                          <div class="col-md-4">
                              <input type="text" maxlength="3" class="form-control" name="cvc" id="cvc" value="" placeholder="CVC" required/>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row form_line">
                  <div class="col-md-2">
                      Total Amount
                  </div>
                  <div class="col-md-8">
                      <input type="text" class="form-control" name="converge_amount_receive" id="converge-amount-received" value="<?= number_format($total_amount, 2); ?>" required/>
                  </div>
              </div>
              <div class="converge-form-button" style="margin-top:52px;">
                <button type="submit" class="btn btn-primary btn-converge-payment" style="display: inline-block;">SUBMIT</button>              
                <a class="btn btn-primary btn-choose-gateway" data-type="converge" href="javascript:void(0);" style="display: inline-block;">SELECT DIFFERENT PAYMENT GATEWAY</a>
              </div>
            </form>
          </div>
      </div>
      <!-- end converge form -->

      <!-- Cash form -->
      <div class="checkout-cash-form" style="display: none;">
          <h3><i class="fa fa-credit-card"></i> Cash Payment</h3>
          <div id="credit_card" style="margin-top: 49px;">
          <form id="frm-cash-payment">
            <input type="hidden" id="cash-checkout-aid" name="cash_checkout_aid" value="<?= $appointment->id; ?>">
            <div class="row form_line">
                <div class="col-md-2">
                    Amount Received
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cash_amount_receive" id="cash-amount-received" value="<?= number_format($total_amount, 2); ?>" required/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-2">
                    Date Received
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control checkout-datepicker" name="cash_date_received" id="cash-date-received" value="<?= date("Y-m-d"); ?>" required/>
                </div>
            </div>
            <div class="converge-form-button" style="margin-top:52px;">
              <button type="submit" class="btn btn-primary btn-cash-payment" style="display: inline-block;">SUBMIT</button>              
              <a class="btn btn-primary btn-choose-gateway" data-type="cash" href="javascript:void(0);" style="display: inline-block;">SELECT DIFFERENT PAYMENT GATEWAY</a>
            </div>
          </form>
          </div>
      </div>
      <!-- end cash form -->

    </div>
  </div>
  <div class="col-md-3" style="border-left: solid 1px #656565;">
    <h3><i class="fa fa-list"></i> Order Summary</h3>    
    <table class="table table-borderless" style="border: none;">            
      <tbody>
        <tr style="background: none !important;">
          <td style="width:70%;">Items</td>
          <td style="text-align:right;">$<span class="c-total-price"><?= number_format($total_items, 2); ?></span></td>
        </tr>
        <tr style="background: none !important;">
          <td>Discount</td>
          <td style="text-align:right;">$<span class="c-total-discount"><?= number_format($total_discount, 2); ?></span></td>
        </tr>
        <tr style="background: none !important;">
          <td>Tax</td>
          <td style="text-align:right;">$<span class="c-total-tax"><?= number_format($total_tax, 2); ?></span></td>
        </tr>
        <tr style="background: none !important;">
          <td>Total</td>
          <td style="text-align:right;">$<span class="c-total-amount"><?= number_format($total_amount, 2); ?></span></td>
        </tr>
        </tbody>
    </table>
    <a class="btn btn-primary btn-c-payment" href="javascript:void(0);">PROCEED TO PAYMENT</a>
    <a class="btn btn-primary btn-c-back" href="javascript:void(0);" style="display:none;">BACK</a>
  </div>
</div>
<?php }else{ ?>
<div class="alert alert-danger alert-dismissible fade show" style="width: 100%;margin-top: 10px;margin-bottom: 10px;">
  <p>Appointment not found</p>  
</div>
<?php } ?>

<script>
$(function(){
  $(".btn-checkout-add-item").click(function(){
    var append_row = '<tr style="background: none !important;"><td style="width:60%;"><input type="text" class="form-control" name="items[]" placeholder="Item Name"></td><td><input type="text" class="form-control item-price" name="price[]" placeholder="Item Price"></td><td><input type="text" class="form-control item-discount" name="discount[]" placeholder="Item Discount"></td><td class="td-actions"><a href="javascript:void(0);" class="btn btn-sm btn-primary btn-item-delete"><i class="fa fa-trash"></i></a></td></tr>';

    $(".tbl-items tbody").append(append_row).find("tr:last").hide().fadeIn("slow");
  });

  $(document).on('click', '.btn-item-delete', function(){
    //$(this).parents('tr').remove().fadeOut("slow");
    $(this).parents('tr').fadeOut("normal", function() {        
        $(this).remove();
        c_compute_totals();
    });
    //$(this).parents('tr').remove();
    //c_compute_totals();
  });

  function c_compute_totals(){
    var total_price    = 0;
    var total_discount = 0;
    var total_amount   = 0;
    var total_tax = 0;

    $('#frm-checkout-items .form-control').each(function(){
      var $el = $(this); // element we're testing
      var n   = parseFloat($el.val());

      if( $el.hasClass('item-price') ){        
        if ($.isNumeric(n)){
          total_price = total_price + parseFloat($el.val());
        }
      }

      if( $el.hasClass('item-discount') ){        
        if ($.isNumeric(n)){
          total_discount = total_discount + parseFloat($el.val());
        }
      }
    });

    total_amount = (parseFloat(total_price) - parseFloat(total_discount)) + parseFloat(total_tax);

    $(".c-total-amount").text(parseFloat(total_amount).toFixed(2));
    $(".c-total-price").text(parseFloat(total_price).toFixed(2));
    $(".c-total-discount").text(parseFloat(total_discount).toFixed(2));
    $("#cash-amount-received").val(parseFloat(total_amount).toFixed(2));
    $("#converge-amount-received").val(parseFloat(total_amount).toFixed(2));
  }

  function validateNumber(event) {
      var key = window.event ? event.keyCode : event.which;
      if (event.keyCode === 8 || event.keyCode === 46) {
          return true;
      } else if ( key < 48 || key > 57 ) {
          return false;
      } else {
          return true;
      }
  };

  $(document).on('keypress', '.item-price', function(event){
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
        return true;
    }
  });

  $(document).on('keyup', '.item-price', function(event){
    c_compute_totals();
  });

  $(document).on('keypress', '.item-discount', function(event){
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
        return true;
    }
  });

  $(document).on('keyup', '.item-discount', function(event){
    c_compute_totals();
  });

  $(".btn-c-payment").click(function(){
    var aid = $(this).attr("data-id");
    var url = base_url + 'calendar/_save_checkout_items';
    $(this).html('<span class="spinner-border spinner-border-sm m-0"></span>');
    setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: 'json',
           data: $("#frm-checkout-items").serialize(),
           success: function(o)
           {            
              //$(this).html('PROCEED TO PAYMENT');
              $(".btn-c-payment").fadeOut(function(){
                $(".btn-c-back").fadeIn();
              });
              $(".checkout-step1").fadeOut(function(){
                $(".checkout-step2").fadeIn();
              });

              $(this).html('PROCEED TO PAYMENT');
           }
        });
    }, 800);
  });

  $(".btn-c-back").click(function(){
    $(".btn-c-back").fadeOut(function(){
      $(".btn-c-payment").fadeIn();
      $(".btn-c-payment").html('PROCEED TO PAYMENT');
    });
    $(".checkout-step2").fadeOut(function(){
      $(".checkout-step1").fadeIn();
    });
  });

  $(".c-converge-logo").click(function(){
    $(".checkout-online-gateway").fadeOut(function(){
      $(".checkout-converge-form").fadeIn();
    });
  });

  $(".c-cash-logo").click(function(){
    $(".checkout-online-gateway").fadeOut(function(){
      $(".checkout-cash-form").fadeIn();
    });
  });

  $(".btn-choose-gateway").click(function(){
    var payment_type = $(this).attr("data-type");
    $(".checkout-"+payment_type+"-form").fadeOut(function(){
      $(".checkout-online-gateway").fadeIn();
    });
  });

  $('.checkout-datepicker').datepicker({
      format: 'yyyy-mm-dd',      
      autoclose: true,
  });

  $("#frm-cash-payment").submit(function(e){
    e.preventDefault();    
    var url = base_url + 'calendar/_appointment_cash_checkout';
    $(".btn-cash-payment").html('<span class="spinner-border spinner-border-sm m-0"></span>');
    setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data: $("#frm-cash-payment").serialize(),
           dataType: 'json',
           success: function(o)
           {
              if( o.is_success ){
                $("#modal-checkout-appointment").modal('hide');
                  Swal.fire({
                      title: 'Success',
                      text: 'Appointment was successfully updated.',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      if (result.value) {
                        reload_calendar();
                      }
                  });
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot update appointment.',
                  text: o.msg
                });
              }
              $(".btn-cash-payment").html("SUBMIT");
           }
        });
    }, 1000);        
  });

  $("#frm-converge-payment").submit(function(e){
    e.preventDefault();
    var url = base_url + 'calendar/_appointment_converge_checkout';
    $(".btn-converge-payment").html('<span class="spinner-border spinner-border-sm m-0"></span>');
    setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data: $("#frm-converge-payment").serialize(),
           dataType: 'json',
           success: function(o)
           {
              if( o.is_success ){
                $("#modal-checkout-appointment").modal('hide');
                  Swal.fire({
                      title: 'Success',
                      text: 'Appointment was successfully updated.',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      if (result.value) {
                        reload_calendar();
                      }
                  });
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot update appointment.',
                  text: o.msg
                });
              }
              $(".btn-converge-payment").html("SUBMIT");
           }
        });
    }, 1000);

  });

});
</script>