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
</style>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="<?php echo $url->assets ?>css/bs-stepper.css">
<div class="wrapper" role="wrapper">
    <?php //include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <br class="clear"/>
            <div class="row">
                <div class="col-xl-2">
                  <div class="v-card">
                    <div class="pl-3 pr-3 pt-2 pb-2">
                      <span class="fa fa-user-circle fa-margin-right"></span>
                      <span>Customer</span>
                      <span class="fa fa-pencil gray-color fa-margin-right"></span>
                    </div>
                    <div class="black-placeholder pl-3 pr-3 pt-2 pb-2">
                      <span class="color-white">Google Plugin Placeholder</span>
                    </div>
                    <div class="pl-3 pr-3 pt-2 pb-2">
                      <div class="container-info">
                        <span class="pb-left">John Smith</span>
                        <span class="sv-fix pb-right fa fa-pencil-square-o gray-color fa-margin-right"></span>
                      </div>
                      <div class="container-info">
                        <span class="pb-left">180 Old Hwy 31 Flomaton, AL 36441</span>
                        <span class="pb-right fa fa-map-marker gray-color fa-margin-right"></span>
                      </div>
                      <div class="container-info">
                        <span class="pb-left">(251) 151-2516</span>
                        <span class="pb-right fa fa-phone gray-color fa-margin-right"></span>
                      </div>
                      <div class="container-info">
                        <span class="pb-left">sample@email.com</span>
                        <span class="pb-right fa fa-envelope gray-color fa-margin-right"></span>
                      </div>
                    </div>
                    <div class="border-top pl-3 pr-3 pt-2 pb-2">
                      <span class="fa fa-history fa-margin-right"></span>
                      <span>Customer History</span>
                      <span class="fa fa-angle-right gray-color fa-margin-right sv-right"></span>
                    </div>
                  </div>
                </div>

                <div class="col-xl-10">
                  <!-- start of stepper 1 -->
                  <div id="stepper1" class="bs-stepper">
                    <div class="bs-stepper-header">
                      <div class="step" data-target="#test-nl-1">
                        <button type="button" class="btn step-trigger">
                          <span class="bs-stepper-circle"><i class="fa fa-calendar"></i></span>
                          <span class="bs-stepper-label">SCHEDULE</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#test-nl-2">
                        <div class="btn step-trigger">
                          <span class="bs-stepper-circle"><i class="fa fa-truck"></i></span>
                          <span class="bs-stepper-label">OMW</span>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#test-nl-3">
                        <button type="button" class="btn step-trigger">
                          <span class="bs-stepper-circle"><i class="fa fa-play"></i></span>
                          <span class="bs-stepper-label">START</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#test-nl-3">
                        <button type="button" class="btn step-trigger">
                          <span class="bs-stepper-circle"><i class="fa fa-stop"></i></span>
                          <span class="bs-stepper-label">FINISH</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#test-nl-3">
                        <button type="button" class="btn step-trigger">
                          <span class="bs-stepper-circle"><i class="fa fa-paper-plane"></i></span>
                          <span class="bs-stepper-label">INVOICE</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#test-nl-3">
                        <button type="button" class="btn step-trigger">
                          <span class="bs-stepper-circle"><i class="fa fa-credit-card-alt"></i></span>
                          <span class="bs-stepper-label">PAY</span>
                        </button>
                      </div>
                    </div>



                    <div class="card">
                      <div class="d-block">
                        <div class="col-xl-5 left">
                          <h5>Invoice <span class="invoice-txt">#3076</span></h5>
                        </div>
                        <div class="col-xl-7 left">
                          <span class="icon-pb fa fa-print gray-color fa-margin-right"></span>
                          <span class="icon-pb fa fa-file-pdf-o gray-color fa-margin-right"></span>
                          <span class="icon-pb fa fa-plus-square-o gray-color fa-margin-right"></span>
                        </div>
                        <br class="clear"/>
                        <div class="col-xl-5 ml-0 pl-0 left">
                          <span class="pl-3">DUE: <span class="invoice-txt">Upon receipt</span></span>
                        </div>
                        <div class="col-xl-7 pr-4 left t-right">
                          <span><span class="fa fa-user-o fa-margin-right"></span>Jessie Whitesmith</span>
                        </div>
                        <br class="clear"/>

                        <div class="form-service">
                          <h3 class="gray-sc pl-3">Services</h3>

                          <div class="col-xl-12 service-container">
                            <div class="ts-box pl-0 ml-0 mr-0 pr-0 left">
                              <span class="sp-left fa fa-bars gray-color fa-margin-right"></span>
                            </div>
                            <div class="cs-4 pl-0 ml-0 mr-2 pr-0 left">
                              <input placeholder="Item name" type="text" name="description" value="" class="form-control" autocomplete="off">
                            </div>
                            <div class="cs-12 pl-0 ml-0 mr-2 pr-0 left">
                              <input placeholder="Qty" type="text" name="description" value="" class="form-control" autocomplete="off">
                            </div>
                            <div class="cs-2 pl-0 ml-0 mr-2 pr-0 left">
                              <input placeholder="Unit Price" type="text" name="description" value="" class="form-control" autocomplete="off">
                            </div>
                            <div class="cs-2 pl-0 ml-0 mr-0 pr-0 desktop-only left">
                              <span class="sc-price">$0.00 <span class="sc-price-icon fa fa-times fa-margin-right"></span></span>
                            </div>
                        </div>

                        <div class="item-form pl-c6">
                          <div class="cs-42 pl-0 ml-0 mr-2 pr-0 left">
                            <input placeholder="Description (Optional)" type="text" name="description" value="" class="form-control" autocomplete="off">
                          </div>
                          <div class="cs-33 pl-0 ml-0 mr-2 pr-0 left">
                            <input placeholder="Unit cost" type="text" name="description" value="" class="form-control" autocomplete="off">
                          </div>
                          <div class="cs-100 pl-0 ml-0 mr-0 pr-0 mobile-only left">
                            <span class="sc-price">$0.00 <span class="sc-price-icon fa fa-times fa-margin-right"></span></span>
                          </div>
                        </div>

                        <div class="item-form pl-c6">
                          <div class="sc-form-add">
                            <span class="sc-item"><span class="fa fa-plus fa-margin-right"></span> SERVICE ITEM</span>
                          </div>
                        </div>

                      </div>

                      <br/>

                      <div class="form-service">
                        <h3 class="gray-sc pl-3">Materials</h3>

                        <div class="col-xl-12 service-container">
                          <div class="ts-box pl-0 ml-0 mr-0 pr-0 left">
                            <span class="sp-left fa fa-bars gray-color fa-margin-right"></span>
                          </div>
                          <div class="cs-4 pl-0 ml-0 mr-2 pr-0 left">
                            <input placeholder="Item name" type="text" name="description" value="" class="form-control" autocomplete="off">
                          </div>
                          <div class="cs-12 pl-0 ml-0 mr-2 pr-0 left">
                            <input placeholder="Qty" type="text" name="description" value="" class="form-control" autocomplete="off">
                          </div>
                          <div class="cs-2 pl-0 ml-0 mr-2 pr-0 left">
                            <input placeholder="Unit Price" type="text" name="description" value="" class="form-control" autocomplete="off">
                          </div>
                          <div class="cs-2 pl-0 ml-0 mr-0 pr-0 left">
                            <span class="sc-price">$0.00 <span class="sc-price-icon fa fa-times fa-margin-right"></span></span>
                          </div>
                      </div>

                      <div class="item-form pl-c6">
                        <div class="cs-42 pl-0 ml-0 mr-2 pr-0 left">
                          <input placeholder="Description (Optional)" type="text" name="description" value="" class="form-control" autocomplete="off">
                        </div>
                        <div class="cs-33 pl-0 ml-0 mr-2 pr-0 left">
                          <input placeholder="Unit cost" type="text" name="description" value="" class="form-control" autocomplete="off">
                        </div>
                      </div>

                      <div class="item-form pl-c6">
                        <div class="sc-form-add">
                          <span class="sc-item"><span class="fa fa-plus fa-margin-right"></span> MATERIALS ITEM</span>
                        </div>
                      </div>
                    </div>

                    <div class="pl-2 pr-2">
                      <div class="sum-container">
                          <div class="cs-6 left"></div>
                          <div class="cs-4 left">
                            <div class="cs-6 left">
                              <span class="bold subtotal">Subtotal</span>
                            </div>
                            <div class="cs-4 left">
                              <span class="bold text-right">$0.00</span>
                            </div>
                          </div>

                          <br/>

                          <div class="cs-6 pt-2 left"></div>
                          <div class="cs-4 pt-2 left">
                            <div class="cs-6 left">
                              <select name="tax" id="tax" class="form-control gray-first">
                                  <option value="">Select tax rate</option>
                              </select>
                            </div>
                            <div class="cs-4 pt-3 left">
                              <span class="bold text-right">$0.00</span>
                            </div>
                          </div>

                          <br/>

                          <div class="cs-6 pt-3 left"></div>
                          <div class="cs-4 pt-3 left">
                            <div class="cs-6 left">
                              <span class="bold">Total</span>
                            </div>
                            <div class="cs-4 left">
                              <span class="bold text-right">$0.00</span>
                            </div>
                          </div>

                      </div>
                      <br/><br/>
                      <div class="tn-container">
                        <span class="bold">Thank you for your business, Please call dually at 850-292-299</span>
                      </div>
                      <div class="gray-area">
                        <div class="cost-container">
                          <div class="cs-34 left">
                            <span class="bold sv-mobile">Cost Breakdown</span>
                          </div>

                          <div class="cs-34 left">
                            <span class="bold sv-mobile">Material Cost</span>
                          </div>

                          <div class="cs-34 left">
                            <span class="bold sv-mobile">Profit/Loss</span>
                          </div>
                        </div>

                        <div class="mt-4 cost-container">
                          <div class="cs-34 left">
                            <span class="bold">$0.00</span>
                          </div>

                          <div class="cs-34 left">
                            <span class="bold">$0.00</span>
                          </div>

                          <div class="cs-34 left">
                            <span class="bold">$0.00</span>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="card">
                  <div class="d-block">
                    <h5 class="sv-h5"><span class="fa fa-rss fa-margin-right"></span> Activity Feed</h5>

                    <!-- start of activity content -->
                    <div class="activity-container mt-4">
                      <div class="cs-3 left">
                        <div class="round-container">
                          <span>
                            <img src="https://images.unsplash.com/photo-1572965733194-784e4b4efa45?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" class="left img-round"/>
                            <span class="scn">House Call Party</span>
                          </span>
                        </div>
                      </div>

                      <div class="cs-4 pt-2 left">
                        <span>
                          <span class="fa fa-comments-o fa-margin-right"></span> Job Scheduled SMS sent to (251) 294 - 525</span>
                      </div>

                      <div class="cs-20 pt-2 left">
                        <span>Wed 12/23/20 9:40am</span>
                      </div>

                      <div class="cs-1 pt-2 left">
                        <span class="fa fa-angle-down fa-margin-right"></span>
                      </div>
                    </div>
                  </div>

                  <div class="activity-container mt-4">
                    <div class="cs-3 left">
                      <div class="round-container">
                        <span>
                          <img src="https://images.unsplash.com/photo-1572965733194-784e4b4efa45?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" class="left img-round"/>
                          <span class="scn">House Call Sparky</span>
                        </span>
                      </div>
                    </div>

                    <div class="cs-4 pt-2 left">
                      <span>
                        <span class="fa fa-envelope fa-margin-right"></span> Job Scheduled email sent to sample@gmail.com</span>
                    </div>

                    <div class="cs-20 pt-2 left">
                      <span>Wed 12/22/20 10:40pm</span>
                    </div>

                    <div class="cs-1 pt-2 left">
                      <span class="fa fa-angle-down fa-margin-right"></span>
                    </div>
                  </div>

                  <div class="activity-container mt-4">
                    <div class="cs-3 left">
                      <div class="round-container">
                        <span>
                          <img src="https://images.unsplash.com/photo-1572965733194-784e4b4efa45?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" class="left img-round"/>
                          <span class="scn">House Call Sparky</span>
                        </span>
                      </div>
                    </div>

                    <div class="cs-4 pt-2 left">
                      <span>
                        <span class="fa fa-calendar-check-o fa-margin-right"></span> Job Scheduled for Mon, Dec 28 9:00am - 11:00am</span>
                    </div>

                    <div class="cs-20 pt-2 left">
                      <span>Wed 12/22/20 11:00am</span>
                    </div>

                    <div class="cs-1 pt-2 left">
                      <span class="fa fa-angle-down fa-margin-right"></span>
                    </div>
                  </div>


                  <div class="activity-container mt-4">
                    <div class="cs-3 left">
                      <div class="round-container">
                        <span>
                          <img src="https://images.unsplash.com/photo-1572965733194-784e4b4efa45?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" class="left img-round"/>
                          <span class="scn"> John Smith</span>
                        </span>
                      </div>
                    </div>

                    <div class="cs-4 pt-2 left">
                      <span>
                        <span class="fa fa-book fa-margin-right"></span> Dispatched to Housecall Party</span>
                    </div>

                    <div class="cs-20 pt-2 left">
                      <span>Tue 12/22/20 11:00am</span>
                    </div>

                    <div class="cs-1 pt-2 left">
                      <span class="fa fa-angle-down fa-margin-right"></span>
                    </div>
                  </div>

                  <div class="more-feed">
                    <button class="more-btn">See all activity</button>
                  </div>

                </div>

                <div class="card">
                  <div class="d-block">
                    <h5><span class="fa fa-bookmark fa-margin-right"></span> Quickbooks online <span class="fa fa-caret-down right-icon fa-margin-right"></span></h5>
                  </div>
                  <div class="booking-container">
                    <div class="transaction-activity">
                      <div class="left mr-3 pt-3">
                        <span class="fa fa-gears fa-margin-right"></span>
                      </div>
                      <div class="cs-9 left">
                        <span class="d-block">Invoice not sent to Quickbooks yet</span>
                        <span class="gray d-block">Invoice will be sent to Quickbooks when job is finished, paid, or emailed to customer</span>
                      </div>
                      <div class="cs-100 mt-5 left">
                        <span class="gray d-block">QBO Transactions (0)</span>
                      </div>
                      <div class="cs-100 mt-5 left">
                        <span class="gray d-block">QBO Errors (0)</span>
                      </div>
                    </div>

                  </div>
                </div>
                 <!-- end of activity content -->
              </div>

              <!-- end of stepper 1 -->

          </div>

      </div>
    </div>
        <!-- end container-fluid -->
  </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/bs-stepper.min.js"></script>
<script>
  var stepper1Node = document.querySelector('#stepper1')
  var stepper1 = new Stepper(document.querySelector('#stepper1'))

  stepper1Node.addEventListener('show.bs-stepper', function (event) {
    console.warn('show.bs-stepper', event)
  })
  stepper1Node.addEventListener('shown.bs-stepper', function (event) {
    console.warn('shown.bs-stepper', event)
  })

  var stepper2 = new Stepper(document.querySelector('#stepper2'), {
    linear: false,
    animation: true
  })
  var stepper3 = new Stepper(document.querySelector('#stepper3'), {
    animation: true
  })
  var stepper4 = new Stepper(document.querySelector('#stepper4'))
</script>
