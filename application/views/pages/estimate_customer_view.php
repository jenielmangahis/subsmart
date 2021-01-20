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
<?php include viewPath('includes/header_front'); ?>
<link rel="stylesheet" href="<?php echo $url->assets ?>css/bs-stepper.css">
<div class="" role="">
    <!-- page wrapper start -->
    <?php 
    $total_amount = 0;
    ?>
    <div>
        <div class="container-fluid">
            <br class="clear"/>
            <div class="row">                
                <div class="col-xl-12">
                  <?php include viewPath('flash'); ?>
                    <div class="card">
                      <?php if($is_valid){ ?>

                        <div class="d-block">
                        <div class="col-xl-5 left">
                          <h5><span class="fa fa-user-o fa-margin-right"></span> Customer <span class="invoice-txt">: <?= $customer->first_name . ' ' . $customer->last_name; ?></span></h5>                          
                          <h5 style="margin-top: 14px;"><span class="invoice-txt">#<?= $estimate->estimate_number; ?></span></h5>
                          <div class="col-xl-5 ml-0 pl-0">
                            <span class="">JOB LOCATION: <?= $estimate->job_location; ?></span><br />
                            <?php 
                              if( $estimate->status == 'Submitted' ){
                                $status = 'FOR APPROVAL';
                                $badge  = 'badge-warning';
                              }elseif( $estimate->status == 'Declined By Customer' ){
                                $status = 'DECLINED';
                                $badge  = 'badge-danger';
                              }else{
                                $status = strtoupper($estimate->status);
                                $badge  = 'badge-primary';
                              }
                            ?>                            
                            <span class="">DATE: <?= date("Y-m-d",strtotime($estimate->estimate_date)); ?></span>
                            <span class="" style="float: right;">STATUS: <span class="badge <?= $badge; ?>"><?= $status; ?></span></span><br />
                          </div>
                        </div>
                        <?php if( $estimate->status == 'Submitted' ){ ?>
                        <div class="col-xl-7 left">
                          <a href="javascript:void(0);" class="btn btn-danger btn-sm gray-color fa-margin-right btn-disapprove-estimate" style="color:#ffffff;"><i class="fa fa-close"></i> Decline</a>
                          <a href="javascript:void(0);" class="btn btn-success btn-sm gray-color fa-margin-right btn-approve-estimate" style="color:#ffffff;"><i class="fa fa-check"></i> Accept</a>  
                        </div>
                        <?php } ?>
                        <br class="clear"/>                        
                        <h3 class="gray-sc pl-3">Items</h3>

                        <?php foreach($estimateItems as $item){ ?>
                          <div class="form-service">
                            <div class="col-xl-12 service-container">
                              <div class="ts-box pl-0 ml-0 mr-0 pr-0 left">
                                <span class="sp-left fa fa-bars gray-color fa-margin-right"></span>
                              </div>
                              <div class="cs-4 pl-0 ml-0 mr-2 pr-0 left">
                                <input placeholder="Item name" type="text" value="<?= $item->title; ?>" readonly="" disabled="" name="description" value="" class="form-control" autocomplete="off">
                              </div>
                              <div class="cs-12 pl-0 ml-0 mr-2 pr-0 left">
                                <input placeholder="Qty" type="text" name="description" value="<?= $item->qty; ?>" readonly="" disabled="" class="form-control" autocomplete="off">
                              </div>
                              <div class="cs-2 pl-0 ml-0 mr-2 pr-0 left">
                                <input placeholder="Unit Price" type="text" name="description" value="<?= $item->price; ?>" readonly="" disabled="" class="form-control" autocomplete="off">
                              </div>
                              <div class="cs-2 pl-0 ml-0 mr-0 pr-0 desktop-only left">
                                <?php 
                                  $total_price = $item->qty * $item->price;
                                  $total_amount += $total_price;
                                ?>
                                <span class="sc-price">$<?= number_format($total_price, 2); ?></span>
                              </div>
                            </div>
                          </div>

                          <div class="item-form pl-c6">
                            <div class="cs-42 pl-0 ml-0 mr-2 pr-0 left">
                              <input placeholder="Description" type="text" name="description" value="<?= $item->description; ?>" readonly="" disabled="" class="form-control" autocomplete="off">
                            </div>                            
                            <div class="cs-100 pl-0 ml-0 mr-0 pr-0 mobile-only left">
                              <span class="sc-price">$0.00 <span class="sc-price-icon fa fa-times fa-margin-right"></span></span>
                            </div>
                          </div>
                          <br class="clear"/>
                          <br />
                        <?php } ?>

                      </div>

                      <br/>

                      <div class="pl-2 pr-2">
                        <div class="sum-container">
                            <div class="cs-6 left"></div>
                            <div class="cs-4 left">
                              <div class="cs-6 left">
                                <span class="bold subtotal">TOTAL AMOUNT</span>
                              </div>
                              <div class="cs-4 left">
                                <span class="bold text-right">$<?= number_format($total_amount, 2); ?></span>
                              </div>
                            </div>

                        </div>
                      <br/><br/>
                      <div class="tn-container">
                        <span class="bold">Thank you for your business, Please call us at 123-456-789</span>
                      </div>                      
                      </div>

                      <?php }else{ ?>
                        <div class="alert alert-primary" role="alert">
                          Invalid estimate
                        </div>
                      <?php } ?>
                  </div>
                </div>

                <?php if( $estimate->status == 'Submitted' ){ ?>
                <!-- Modal Approve Confirmation -->
                <div class="modal fade bd-example-modal-md" id="modalApproveConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalApproveConfirmationTitle" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-question-circle-o"></i> Accept Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php echo form_open_multipart('customer_approve_estimate', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                      <?php echo form_input(array('name' => 'eid', 'type' => 'hidden', 'value' => $eid, 'id' => 'eid'));?>
                      <div class="modal-body">        
                          <p>Are you sure you want to approve estimate number <b><?= $estimate->estimate_number; ?></b> ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Accept</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

                <!-- Modal Disapprove Confirmation -->
                <div class="modal fade bd-example-modal-md" id="modalDisapproveConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalDisapproveConfirmationTitle" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-question-circle-o"></i> Decline Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php echo form_open_multipart('customer_disapprove_estimate', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                      <?php echo form_input(array('name' => 'eid', 'type' => 'hidden', 'value' => $eid, 'id' => 'eid'));?>
                      <div class="modal-body">        
                          <div class="form-group">
                          <div class="row">                            
                              <div class="col-md-12">                                  
                                  <label for="">Reason : </label>
                                  <select class="form-control" name="reason" style="width:80%;">
                                    <option value="Price is too high">Price is too high</option>
                                    <option value="Getting more estimates">Getting more estimates</option>
                                    <option value="Please call me to discuss">Please call me to discuss</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Decline</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>
                <?php } ?>

          </div>

      </div>
    </div>
        <!-- end container-fluid -->
  </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_pages'); ?>
<script>
$(function(){
  $(".btn-approve-estimate").click(function(){
    $("#modalApproveConfirmation").modal('show');
  });
  $(".btn-disapprove-estimate").click(function(){
    $("#modalDisapproveConfirmation").modal('show');
  });
});
</script>
