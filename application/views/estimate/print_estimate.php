<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
.gray-color {
  color: #909090;
  float: right;
  position: relative;
  top: 4px;
}
.gray {
  color: #909090;
}
.bs-stepper {
  margin-bottom: 10px;
}
.black-placeholder {
  background: black;
}
.left {
  float:left;
}
.more-feed {
  width: max-content;
  margin: 0 auto;
  padding-top: 50px;
  padding-bottom: 10px;
}
button.more-btn:hover {
  background: green;
}
.right-icon {
  float: right;
  position: relative;
  top: 4px;
}
button.more-btn {
  box-shadow: none;
  border: 0px;
  background: #41a4ff;
  color: white;
  padding: 6px 20px;
  text-transform: uppercase;
  font-size: 15px;
}
span.invoice-txt {
  color: #45a6ff;
}
span.sc-price-icon{
  color: red;
  font-size: 16px;
}
span.scn {
  font-size: 15px;
  position: relative;
  top: 0px;
}
.round-container {
  background: #cecece;
  padding: 10px 20px;
  border-radius: 100px;
  display: inline-block;
}
.img-round {
  border-radius: 100px;
  width: 21px;
  height: 21px;
  object-fit: cover;
  margin-right: 10px;
}
.item-form {
  display: block;
  clear: both;
  padding-top: 10px;
}
span.sc-price {
  text-align: right;
  display: block;
  padding-right: 10px;
  font-size: 20px;
  position: relative;
  top: 9px;
  color: #828282;
}
.icon-pb {
  font-size: 22px !important;
  position: relative;
  top: 13px;
  margin-right: 19px !important;
  text-align: right;
}
.v-card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
  padding: 0px;
}
.t-right {
  text-align: right;
}
.color-white {
  color:white;
}
h3.gray-sc.pl-3 {
  font-weight: 400;
  color: darkgrey;
  font-size: 21px;
  margin-top: 20px;
}
.ts-box {
  width: 50px;
  float: left;
}
.sp-left {
  font-size: 20px !importantr;
  position: relative;
  top: 15px !important;
  display: block !important;
  right: 13px;
  text-align: left;
}
.sv-right {
  position: relative;
  right: 7px;
}
.border-top {
  border-top: 1px solid black !important;
  padding-top: 10px;
  width: 100%;
}
.pb-left {
  width: 75%;
  display: block;
  float: left;
}
.sc-form-add {
  width: 100%;
  text-align: right;
  padding-right: 65px;
}
span.sc-item {
  color: #2b91ef;
}
.pb-right {
  width: 20%;
  display: block !important;
  float: right;
  margin: 0px !important;
  text-align: right;
  padding-right: 10px;
}
.clear {
  clear: both;
}
.container-info {
  display: inline-block !important;
  height: max-content;
  width: 100%;
  margin-bottom: 11px !important;
}
.sv-fix {
  position: relative;
  left: 5px;
}
.cs-100 {
  width: 100%;
  min-height: 10px;
}
.cs-9 {
  width: 90%;
  min-height: 10px;
}
.cs-8 {
  width: 80%;
  min-height: 10px;
}
.cs-7 {
  width: 70%;
  min-height: 10px;
}
.cs-6 {
  width: 60%;
  min-height: 10px;
}
.cs-5 {
  width: 50%;
}
.cs-4 {
  width: 40%;
  min-height: 10px;
}
.cs-42 {
  width: 41%;
}
.cs-4 {
  width: 40%;
}
.cs-34 {
  width: 33.33%;
}
.cs-33 {
  width: 32.5%;
}
.cs-3 {
  width: 30%;
}
.cs-2 {
  width: 21%;
}
.cs-20 {
  width: 20%;
}
.cs-12 {
  width: 10%;
}
.cs-1 {
  width: 10%;
}
.pl-c6 {
  padding-left: 65px !important;
}
.tn-container {
  border-top: 1px solid #868686;
  margin-top: 30px;
  padding: 20px 0px;
}
.cost-container {
  border-top: 1px solid #868686;
  margin-top: 10px;
  padding: 20px;
}
.booking-container {
  border-top: 1px solid #868686;
  margin-top: 5px;
  padding: 20px;
}
.sum-container {
  border-top: 1px solid #868686;
  margin-top: 30px;
  padding: 20px;
}
.text-right {
  text-align: right;
  width: 100%;
  display: block;
  padding-right: 33px;
}
.gray-area {
  padding-bottom: 20px;
  display: block;
}
@media only screen and (max-width: 560px) {
  .cs-9 {
    width:83%;
  }
  .bs-stepper-header {
      overflow-y: scroll;
  }
  input.form-control {
      width: 92%;
      margin: 0 auto;
  }
  .booking-container {
    padding: 10px;
  }
  .sv-h5 {
    padding-left: 15px;
  }
  .activity-container {
    padding-left: 15px;
  }
  .tn-container {
    width: 100%;
    clear: both;
    display: block;
  }
  .subtotal {
    text-align: right;
    width: 100%;
    display: block;
    padding-right: 20px;
  }
  .card {
    padding: 10px 15px !important;
  }
  .sc-form-add {
    padding-right: 15px;
  }
  .pl-c6 {
    padding-left: 0px !important;
  }
  .cs-20 {
    width: 70%;
  }
  .cs-1 {
    position: relative;
    top: 5px;
  }
  .cs-12, .cs-2, .cs-3, .cs-4, .cs-5, .cs-6, .cs-7, .cs-8, .cs-42, .cs-33 {
    width: 100% !important;
    padding-bottom: 20px !important;
  }
  .ts-box.pl-0.ml-0.mr-0.pr-0.left {
    display: none;
  }
}
.badge-danger{
    background-color: #ec4561 !important;
  }
</style>
<?php include viewPath('includes/header_print'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <?php 
    $total_amount = 0;
    ?>
   <div wrapper__section style="margin: 0px;">
        <div class="card" style="margin: 0 auto; width:68%;">
            <div class="col-md-12" style="text-align: right;margin-bottom: 60px;">
              <a class="btn btn-success btn-print" href="#" onclick="printDivES('printableES')"><span class="fa fa-print icon"></span> PRINT</a>
            </div>
            <br class="clear"/>
            <div class="row" id="printableES">    
                        <div style="margin-bottom: 20px;margin-left: 5% !important;">
                            <!-- <img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png"> -->
                            <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 230px; max-height: 200px;margin-left: 5% !important;" />
                          </div>
                          
                            <div class="col-xl-12 right" style="float: right">
                                <div style="text-align: right;">
                                  <h5 style="font-size:30px;margin:0px;">ESTIMATE</h5>
                                  <small style="font-size: 14px;">#<?= $estimate->estimate_number; ?></small>
                                </div>
                                <div class="" style="float: right;margin-top: 20px;">
                                  <table style="text-align: right;">
                                    <tr>
                                      <td style="text-align: right;">Estimate Date: &emsp;</td>
                                      <td><?= date("F d, Y",strtotime($estimate->estimate_date)); ?></td>
                                    </tr>
                                    <tr>
                                      <td style="text-align: right;">Expiry Date: &emsp;</td>
                                      <td><?= date("F d, Y",strtotime($estimate->expiry_date)); ?></td>
                                    </tr>
                                  </table>
                                </div>
                            </div>

                <div class="col-xl-12">
                    <div class="card">
                      <?php if($estimate){ ?>
                      <div class="d-block">
                        <div class="col-xl-5 left" style="margin-bottom: 33px;">
                          <h5><span class="fa fa-user-o fa-margin-right"></span> From <span class="invoice-txt"> <?= $client->business_name; ?></span></h5>
                          <div class="col-xl-5 ml-0 pl-0">
                            <span class=""><?= $client->business_address; ?></span><br />
                            <span class="">EMAIL: <?= $client->email_address; ?></span><br />
                            <span class="">PHONE: <?= $client->phone_number; ?></span>
                          </div>
                        </div>
                        <div class="clear"></div>    
                        <div class="col-xl-5 left">
                          <h5><span class="fa fa-user-o fa-margin-right"></span> To <span class="invoice-txt"> <?= $customer->first_name . ' ' . $customer->last_name; ?></span></h5> 
                          <div class="col-xl-5 ml-0 pl-0">
                            <span class=""><?= $customer->mail_add . " " . $customer->city ?></span><br /><br />
                            <span class="">EMAIL: <span class=""><?= $customer->email; ?></span></span><br />
                            <span class="">PHONE: <span class=""><?= $customer->phone_w; ?></span></span><br />
                          </div>
                        </div>
                        <br class="clear"/>    
                        <table class="table-print table-items" style="width: 100%; border-collapse: collapse;margin-top: 55px;">
                        <thead>
                            <tr>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">#</th>
                                <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Items</th>
                                <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Item Type</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Qty</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Price</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Discount</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //$estimateItems = unserialize($estimate->estimate_items); ?>
                        <?php $total_amount = 0; $row = 1; foreach($Items as $item){ ?>
                          <tr class="table-items__tr">
                            <td valign="top" style="width:30px; text-align:center;"><?= $row; ?></td>
                            <td valign="top" style="width:45%;"><?= $item->title; ?></td>
                            <td valign="top" style="width:20%;"><?= $item->type; ?></td>
                            <td valign="top" style="width: 50px; text-align: right;"><?= $item->qty; ?></td>
                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($item->iCost,2); ?></td>
                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($item->discount,2); ?></td>
                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($item->iTotal,2); ?></td>
                          </tr>
                        <?php 
                          $total_amount += $item->iTotal;
                          $row++;
                        ?>
                        <?php } ?>
                        <tr><td colspan="7"><hr/></td></tr>
                            <tr>
                              <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                              <td colspan="2" style="text-align: right;"><p>$ <?= number_format($estimate->sub_total, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                              <td colspan="2" style="text-align: right;"><p>$ <?= number_format($estimate->tax1_total, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="5" style="text-align: right;"><p><?= $estimate->adjustment_name; ?></p></td>
                              <td colspan="2" style="text-align: right;"><p>$ <?= number_format($estimate->adjustment_value, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="5" style="text-align: right;"><p>Markup</p></td>
                              <?php 
                                $markup_amount = 0;
                                if( $estimate->markup_amount > 0 ){
                                  $markup_amount = $estimate->markup_amount;
                                }
                              ?>
                              <td colspan="2" style="text-align: right;"><p>$ <?= number_format($markup_amount, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                              <td colspan="2" style="text-align: right;"><b>$ <?= number_format($estimate->grand_total, 2); ?></b></td>
                            </tr>
                      </tbody>
                      </table>
                      </div>

                      <hr />
                      <p><b>Instructions</b><br /><br /><?= $estimate->instructions; ?></p>
                      <p><b>Message</b><br /><br /><?= $estimate->customer_message; ?></p>
                      <p><b>Terms</b><br /><Br /><?= $estimate->terms_conditions; ?></p>

                      <?php }else{ ?>
                        <div class="alert alert-primary" role="alert">
                          Invalid record
                        </div>
                      <?php } ?>
                  </div>
                </div>
          </div>

      </div>
    </div>
        <!-- end container-fluid -->
  </div>
    <!-- page wrapper end -->
</div>
<script>
function printDivES(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<?php //include viewPath('includes/footer_print'); ?>
<script>
// $(function(){
//   $(".btn-print").click(function(e){
//     printdiv('printable-container');
//   });

//   // function printdiv(printdivname) {
//   //   var headstr = "<html><head><title>Estimate</title></head><body>";
//   //   var footstr = "</body>";
//   //   var newstr = document.getElementById(printdivname).innerHTML;
//   //   var oldstr = document.body.innerHTML;
//   //   document.body.innerHTML = headstr+newstr+footstr;
//   //   window.print();
//   //   document.body.innerHTML = oldstr;
//   //   return false;
//   // }
// });
</script>

