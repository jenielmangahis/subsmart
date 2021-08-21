<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
/* Style the tab */
.tab_ {
  /* float: left; */
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 100%;
  height: 100%;
}

/* Style the buttons inside the tab */
.tab_ button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 0 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab_ button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab_ button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 80%;
  border-left: none;
  /* height: 300px; */
}  

.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 30px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 24px;
  width: 24px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #53b700;
}

input:focus + .slider {
  box-shadow: 0 0 1px #53b700;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 20px;
}

.slider.round:before {
  border-radius: 50%;
}

.card {
    padding: 1px !important;
}
.card {
    margin-bottom: 1px !important;
}

#exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

.project-tab {
    padding: 10%;
    margin-top: -8%;
}
.project-tab #tabs{
    background: #007b5e;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
}
.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #0062cc;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 3px solid !important;
    font-size: 16px;
    font-weight: bold;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #0062cc;
    font-size: 16px;
    font-weight: 600;
}
.project-tab .nav-link:hover {
    border: none;
}
.project-tab thead{
    background: #f3f3f3;
    color: #333;
}
.project-tab a{
    text-decoration: none;
    color: #333;
    font-weight: 600;
}

.nav {
    width: 20%;
}

#circle {
    background: white;
    border-radius: 50%;
    width: 80px;
    height: 80px;
    border-style: solid;
    border-color: #55b702;
}

#circle:hover {
    background: #def3cc;
}

.arrow {
    width:88px;
    margin:40px auto;
}

.line {
    margin-top:7px;
    width:81px;
    background:#8d9096;
    height:2px;
    float:left;
}
.point {	
    width: 0; 
	height: 0; 
	border-top: 7px solid transparent;
	border-bottom: 7px solid transparent;
	border-left: 7px solid #8d9096;
    float:right;
}

.notification {
  /* background-color: #555; */
  color: white;
  text-decoration: none;
  /* padding: 15px 26px; */
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

/* .notification:hover {
  background: red;
} */

.notification .badge {
  position: absolute;
  top: -1px;
  right: -1px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo $url->assets ?>chart_styles/chart.css">
<script src="<?php echo $url->assets ?>chart_styles/jquery.chart.js"></script>

<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1%;">
        <div class="container-fluid" style="background-color:white;">
                    <div style="padding-top:1%;">
						<!-- <h3 style="font-family: Sarabun, sans-serif">Accounting Dashboard</h3> -->
                        <a class="link-modal-open" href="#" id="" data-toggle="modal" data-target="#account_settings"><h3 style="font-family: Sarabun, sans-serif;display: inline-block;"><img src="<?= getCompanyBusinessProfileImage(); ?>" class=""  style="max-width: 50px; max-height: 100px;display: inline-block;" /> <?php echo $clients->business_name; ?> </h3> </a>
					</div>

                    <section id="tabs" class="project-tab" style="padding-left: 0px;padding-right: 0px;">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <nav>
                                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color:#666666;">Get things done</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="color:#666666;">Business overview</a> 
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <br>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>Some QuickBooks Payments deposits weren't automatically recorded. After you receive the funds in your account, record them manually as a Bank Deposit. <a href="#"  style="color:#0077C5;">Take Action </a> </p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>Your customer made a payment more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a> </p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>A bank transfer from your customer received as payment for Invoice 13053 has been canceled due to a problem with their account. To keep your books accurate, you should follow the steps to <a href="#"  style="color:#0077C5;">handle a canceled bank transfer.</a></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #0098cd;"></i> Alert <br>
                                                <p>We just updated the info we share on commercial card transactions. We're now sharing line item details, also known as Level 3 data, with the card companies. This has benefits for both you and your customers. <a href="#"  style="color:#0077C5;">Tell me more</a></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>

                                            <br><br>

                                            <div style="background-color:#f9fafb;width:80%;border-radius:15px;">
                                                <div class="row" style="">
                                                    <div class="col-md-1" style="background-color:#eceef1;padding: 80px 0;border-radius:15px 0 0 15px;">
                                                        <center><h6>Money in</h6></center>
                                                    </div>
                                                    <div class="col-md-11" style="padding:0 3% 3% 3%;">
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Add products and services</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Manage customers</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <div class="line"></div>
                                                                <div class="point"></div>
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Create estimates</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <div class="line"></div>
                                                                <div class="point"></div>
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#" class="notification">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                    <span class="badge"><b>99+</b></span>
                                                                </div>
                                                            </a>
                                                            <p>Send invoices</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <div class="line"></div>
                                                                <div class="point"></div>
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Receive payments</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Get funding</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div style="background-color:#f9fafb;width:80%;">
                                                <div class="row">
                                                    <div class="col-md-1" style="background-color:#eceef1;padding: 80px 0;border-radius:15px 0 0 15px;">
                                                        <center><h6>Money out</h6></center>
                                                    </div>
                                                    <div class="col-md-11" style="padding:0 3% 3% 3%;">
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Pay bills</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;width:125px;">
                                                            <!-- <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Manage customers</p> -->
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;width:125px;">
                                                            <!-- <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Manage customers</p> -->
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Track time</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <div class="line"></div>
                                                                <div class="point"></div>
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Manage payroll</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div style="background-color:#f9fafb;width:80%;">
                                                <div class="row">
                                                    <div class="col-md-1" style="background-color:#eceef1;padding: 80px 0;border-radius:15px 0 0 15px;">
                                                        <center><h6>Accounting and reports</h6></center>
                                                    </div>
                                                    <div class="col-md-11" style="padding:0 3% 3% 3%;">
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Get business banking</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <div class="line"></div>
                                                                <div class="point"></div>
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#" class="notification">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                    <span class="badge"><b>NEW</b></span>
                                                                </div>
                                                            </a>
                                                            <p>Review transactions</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>See reports and trends</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <!-- <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Track time</p>
                                                        </div>
                                                        <div align="center" style="padding:3% 0;display: inline-block;">
                                                            <div class="arrow">
                                                                <div class="line"></div>
                                                                <div class="point"></div>
                                                            </div>
                                                        </div>
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                </div>
                                                            </a>
                                                            <p>Manage payroll</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <br>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>Some QuickBooks Payments deposits weren't automatically recorded. After you receive the funds in your account, record them manually as a Bank Deposit. <a href="#"  style="color:#0077C5;">Take Action </a> </p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>Your customer made a payment more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a> </p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>A bank transfer from your customer received as payment for Invoice 13053 has been canceled due to a problem with their account. To keep your books accurate, you should follow the steps to <a href="#"  style="color:#0077C5;">handle a canceled bank transfer.</a></p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 16px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #0098cd;"></i> Alert <br>
                                                    <p>We just updated the info we share on commercial card transactions. We're now sharing line item details, also known as Level 3 data, with the card companies. This has benefits for both you and your customers. <a href="#"  style="color:#0077C5;">Tell me more</a></p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>

                                                <br><br>
                                                
                                                <!-- <div class="chart">
                                                    <ul class="bar-chart" data-bars="[4,2],[4,5],[8,3],[4,2],[4,2]" data-max="10" data-unit="k" data-width="24"></ul>
                                                </div> -->
                                                <div class="bar-chart" data-bars="[[4,2],[4,5],[10,3],[4,2],[4,2]]" data-max="10"  data-unit="k" data-grid="0"><a href="https://www.jqueryscript.net/tags.php?/grid/"> </a></div>


                                                <br>
                                                <div class="page-title-box">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="income tile-container" style="height:445px;">
                                                                <div class="inner-container">
                                                                    <div class="tileContent">
                                                                        <div class="clear">
                                                                            <div class="inner-content">
                                                                                <div class="header-container">
                                                                                    <h3 class="header-content">Income</h3>
                                                                                    <div class="header-separator">
                                                                                        <div class="hs-content">Last 365 Days</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="con-inner-container">
                                                                                    <div class="con-bar">
                                                                                        <div class="open-invoices box-invoices-bar"></div>
                                                                                        <div class="paid-invoices box-invoices-bar"></div>
                                                                                    </div>
                                                                                    <div class="con-data-label">
                                                                                        <div class="con-label">3</div>
                                                                                        <div class="con-sub-label">Open invoices</div>
                                                                                        <div class="con-label">0</div>
                                                                                        <div class="con-sub-label">Overdue invoices</div>
                                                                                        <div class="con-label">0</div>
                                                                                        <div class="con-sub-label">Paid last 30 days</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="expenses tile-container" style="height:445px;">
                                                                <div class="inner-container">
                                                                    <div class="tileContent">
                                                                        <div class="clear">
                                                                            <div class="inner-content">
                                                                                <div class="header-container">
                                                                                    <h3 class="header-content">Expenses</h3>
                                                                                    <div class="header-separator">
                                                                                        <div class="hs-content">
                                                                                            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                                                                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                                                    Last 30 Days&nbsp;<span class="fa fa-caret-down"></span></span>
                                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                                    <li><a href="#" class="dropdown-item">Last 30 Days</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">This month</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">This quarter</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">This year</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">Last month</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">Last quarter</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">Last year</a></li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="expenses-money-section">
                                                                                    <div class="expenses-money-data">$4,247</div>
                                                                                    <div class="expenses-con-data">This month</div>
                                                                                </div>
                                                                                <div class="expenses-donutchart-section">
                                                                                    <div class="donut-chart-container">
                                                                                    <div id="expensesChart" style="width: 150px;height: 170px;"></div>
                                                                                        <div id="legendExpenses">
                                                                                            <div class="legendList">
                                                                                                <div class="box"></div>
                                                                                                <div class="amount">74%</div>
                                                                                                <div class="name">Commission & fees</div>
                                                                                                <div class="box" style="background: #3980b5;"></div>
                                                                                                <div class="amount">19%</div>
                                                                                                <div class="name">Reimburtment</div>
                                                                                                <div class="box" style="background: #95bbd7;"></div>
                                                                                                <div class="amount">7%</div>
                                                                                                <div class="name">Subcontractors</div>
                                                                                                <div class="box" style="background: #caddeb;"></div>
                                                                                                <div class="amount">2%</div>
                                                                                                <div class="name">Bank Charges</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="bank-accounts tile-container" style="height:445px;">
                                                                <div class="inner-container">
                                                                    <div class="tileContent">
                                                                        <div class="clear">
                                                                            <div class="inner-content">
                                                                                <div class="header-container">
                                                                                    <h3 class="header-content">Bank Accounts</h3>
                                                                                    <a href="" style="float: right;"><i class="fa fa-pencil fa-lg"></i></a>
                                                                                    <div class="header-separator">
                                                                                        <div class="hs-content">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="bankList">
                                                                                    <div class="dgrid-row connectedAccount">
                                                                                        <div class="bankAccountRowLink bankAccountRow">
                                                                                            <div class="bankRow">
                                                                                                <div class="bankRowHeader">
                                                                                                    <div class="qboNameHeader">
                                                                                                        <div class="qboName">Corporate Account (XXXXXX 5850)</div>
                                                                                                    </div>
                                                                                                    <div class="headerMessage">
                                                                                                        <div class="pendingTxns">11 to review</div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="bankRowDetail">
                                                                                                    <div class="description">
                                                                                                        <div class="balanceDescription">Bank balance</div>
                                                                                                        <div class="nsBalanceDescription">In nSmartrac</div>
                                                                                                    </div>
                                                                                                    <div class="accountDetails">
                                                                                                        <div class="balance">
                                                                                                            <div class="bankBalance">$5,741.11</div>
                                                                                                            <div class="nsBalance">$-7,049.40</div>
                                                                                                        </div>
                                                                                                        <div class="count">
                                                                                                            <div class="lastUpdated line-clamp">Updated 1 day ago</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="dgrid-row">
                                                                                        <div class="bankAccountRowLink bankAccountRow">
                                                                                            <div class="bankRow">
                                                                                                <div class="bankRowHeader">
                                                                                                    <div class="qboNameHeader">
                                                                                                        <div class="qboName">Cash on hand</div>
                                                                                                    </div>
                                                                                                    <div class="headerMessage">
                                                                                                        <div class="pendingTxns"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="bankRowDetail">
                                                                                                    <div class="description">
                                                                                                        <div class="nsBalanceDescription">In nSmartrac</div>
                                                                                                    </div>
                                                                                                    <div class="accountDetails">
                                                                                                        <div class="count">
                                                                                                            <div class="bankBalance" style="display: none">$0</div>
                                                                                                            <div class="nsBalance">$111,101.00</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="dgrid-row">
                                                                                        <div class="bankAccountRowLink bankAccountRow">
                                                                                            <div class="bankRow">
                                                                                                <div class="bankRowHeader">
                                                                                                    <div class="qboNameHeader">
                                                                                                        <div class="qboName">Corporate Account (XXXXXX 5850)Te</div>
                                                                                                    </div>
                                                                                                    <div class="headerMessage">
                                                                                                        <div class="pendingTxns"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="bankRowDetail">
                                                                                                    <div class="description">
                                                                                                        <div class="nsBalanceDescription">In nSmartrac</div>
                                                                                                    </div>
                                                                                                    <div class="accountDetails">
                                                                                                        <div class="count">
                                                                                                            <div class="bankBalance" style="display: none">$0</div>
                                                                                                            <div class="nsBalance">$0</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="addFISection">
                                                                                    <a href="#" data-toggle="modal" data-target="#addAccountModal">Connect accounts</a>
                                                                                    <div class="registerLink">
                                                                                        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                                                                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                                                    Go to register&nbsp;<span class="fa fa-caret-down"></span></span>
                                                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                                                <li><a href="#" class="dropdown-item">Corporate Account (XXXXXX 5850)</a></li>
                                                                                                <li><a href="#" class="dropdown-item">Cash on hand</a></li>
                                                                                                <li><a href="#" class="dropdown-item">Corporate Account (XXXXXX 5850)Te</a></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <!--                        <div class="col-sm-6">-->
                                                        <!--                            <div class="float-right d-none d-md-block">-->
                                                        <!--                                <div class="dropdown">-->
                                                        <!--                                    --><?php ////if (hasPermissions('users_add')): ?>
                                                        <!--                                        <!-- <a href="--><?php ////echo url('users/add') ?><!--" class="btn btn-primary"-->
                                                        <!--                                       aria-expanded="false">-->
                                                        <!--                                        <i class="mdi mdi-settings mr-2"></i> New Employee-->
                                                        <!--                                    </a> -->
                                                        <!--                                    --><?php //endif ?>
                                                        <!--                                </div>-->
                                                        <!--                            </div>-->
                                                        <!--                        </div>-->

                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-6">
                                                            <?php $this->load->view('accounting/shortcuts'); ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="sales tile-container" style="height:445px;">
                                                                <div class="inner-container">
                                                                    <div class="tileContent">
                                                                        <div class="clear">
                                                                            <div class="inner-content">
                                                                                <div class="header-container">
                                                                                    <h3 class="header-content">Sales</h3>
                                                                                    <div class="header-separator">
                                                                                        <div class="hs-content">
                                                                                            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                                                                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                                                    Last 30 Days&nbsp;<span class="fa fa-caret-down"></span></span>
                                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                                    <li><a href="#" class="dropdown-item">Last 30 Days</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">This month</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">This quarter</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">This year</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">Last month</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">Last quarter</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">Last year</a></li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="moduleContent">
                                                                                    <div class="subContainer salesValues" style="height:300px;">
                                                                                        <div class="paid moneySection">
                                                                                            <div class="fancyMoney">$4</div>
                                                                                            <div class="fancyText dataSelection">Last 30 Days</div>
                                                                                        </div>
                                                                                        <div id="sales-line-chart" style="height: 200px"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="more tile-container" style="height:445px;">
                                                                <div class="inner-container">
                                                                    <div class="tileContent">
                                                                        <div class="clear">
                                                                            <div class="inner-content">
                                                                                <div class="header-container">
                                                                                    <h3 class="header-content">Discover More</h3>
                                                                                    <div class="header-separator">
                                                                                        <div class="hs-content">
                                                                                            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                                                                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                                                    <i class="fa fa-ellipsis-v fa-lg"></i></span>
                                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                                    <li><a href="#" class="dropdown-item">Close, not relevant</a></li>
                                                                                                    <li><a href="#" class="dropdown-item">Close, show me later</a></li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="discoverMore-container">
                                                                                    <div id="discoverMore" class="carousel slide" data-ride="carousel">
                                                                                        <!-- The slideshow -->
                                                                                        <div class="carousel-inner">
                                                                                            <div class="carousel-item active">
                                                                                                <div style="position: relative;display: flex;align-items: center;justify-content: center;width: 280px;height: 85px;">
                                                                                                    <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132646/Energy-Beam_Payroll.svg" alt="Image1" width="100%" height="100%">
                                                                                                </div>
                                                                                                <div class="content-container">
                                                                                                    <h3>Keep your signs with the times</h3>
                                                                                                    <div class="sub-header-container">
                                                                                                        Your team will know their rights. You'll be complaint. Update your labor law posters.
                                                                                                    </div>
                                                                                                    <div class="cta-container">
                                                                                                        <a href="">Get your posters</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div class="card-content">
                                                                                                    <h3>Share securely with others</h3>
                                                                                                    <div class="divider-bar green-bar"></div>
                                                                                                    <div class="divider-dot green-dot"></div>
                                                                                                    <div class="sub-header">
                                                                                                        New present custom roles help you delegate access, only in nSmartrac Online Advance.
                                                                                                    </div>
                                                                                                    <a href="#">See how it works</a>
                                                                                                </div>
                                                                                                <div class="card-img">
                                                                                                    <div style="position:relative;display: flex;align-items: center;justify-content: center;">
                                                                                                        <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/07/09104533/2_new-Bolt_lifestyle_TIPS_ACCOUNTING.svg" alt="Share securely with others" style="max-width: 100%;max-height: 100%;">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div class="card-content">
                                                                                                    <h3>Goodbye, paper timesheets!</h3>
                                                                                                    <div class="divider-bar orange-bar"></div>
                                                                                                    <div class="divider-dot orange-dot"></div>
                                                                                                    <div class="sub-header">
                                                                                                        Employees track time on any device, and it automatically appears in nSmartrac.
                                                                                                    </div>
                                                                                                    <a href="#">Try TSheets for Free</a>
                                                                                                </div>
                                                                                                <div class="card-img">
                                                                                                    <div style="position:relative;display: flex;align-items: center;justify-content: center;">
                                                                                                        <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/07/09104804/2_new-Bolt_lifestyle_TIPS_TIMETRACKING.svg" style="max-width: 100%;max-height: 100%;">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div class="card-content">
                                                                                                    <h3>Work even smarter</h3>
                                                                                                    <div class="divider-bar green-bar"></div>
                                                                                                    <div class="divider-dot green-dot"></div>
                                                                                                    <div class="sub-header">
                                                                                                        Easily track KPI is with automated performance dashboards in nSmartrac Online Advanced.
                                                                                                    </div>
                                                                                                    <a href="#">See how it works</a>
                                                                                                </div>
                                                                                                <div class="card-img">
                                                                                                    <div style="position:relative;display: flex;align-items: center;justify-content: center;margin-top: 50px">
                                                                                                        <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132407/Energy-Beam_QuickBooks.svg" style="max-width: 100%;max-height: 100%;">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div style="position: relative;display: flex;align-items: center;justify-content: center;width: 280px;height: 85px;">
                                                                                                    <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132646/Energy-Beam_Payroll.svg" alt="Image1" width="100%" height="100%">
                                                                                                </div>
                                                                                                <div class="content-container">
                                                                                                    <h3>Pay worker's comp as you go</h3>
                                                                                                    <div class="sub-header-container">
                                                                                                        Do you know workers' comp can be automatically paid with payroll?
                                                                                                    </div>
                                                                                                    <div class="cta-container">
                                                                                                        <a href="">Get started</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div class="card-content">
                                                                                                    <h3>Find the right insurance</h3>
                                                                                                    <div class="divider-bar gray-bar"></div>
                                                                                                    <div class="divider-dot gray-dot"></div>
                                                                                                    <div class="sub-header">
                                                                                                        Explore affordable coverage options and protect your business right from nSmartrac.
                                                                                                    </div>
                                                                                                    <a href="#">See coverage option</a>
                                                                                                </div>
                                                                                                <div class="card-img">
                                                                                                    <div style="position:relative;display: flex;align-items: center;justify-content: center;margin-top: 50px">
                                                                                                        <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132407/Energy-Beam_QuickBooks.svg" style="max-width: 100%;max-height: 100%;">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Left and right controls -->
                                                                                        <a class="carousel-control-prev" href="#discoverMore" data-slide="prev">
                                                                                            <i class="fa fa-chevron-left"></i>
                                                                                        </a>
                                                                                        <a class="carousel-control-next" href="#discoverMore" data-slide="next">
                                                                                            <i class="fa fa-chevron-right"></i>
                                                                                        </a>
                                                                                        <!-- Indicators -->
                                                                                        <ul class="carousel-indicators" id="indicator">
                                                                                            <li data-target="#discoverMore" data-slide-to="0" class="active"></li>
                                                                                            <li data-target="#discoverMore" data-slide-to="1"></li>
                                                                                            <li data-target="#discoverMore" data-slide-to="2"></li>
                                                                                            <li data-target="#discoverMore" data-slide-to="3"></li>
                                                                                            <li data-target="#discoverMore" data-slide-to="4"></li>
                                                                                            <li data-target="#discoverMore" data-slide-to="5"></li>
                                                                                        </ul>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                    </div>
                                                    <div class="activity-container">
                                                        <a href="<?php echo url('/accounting/audit_log') ?>" class="activityLink">See all activity</a>
                                                    </div>
                                                </div> <!-- end page-title-box -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
            


            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->

    <!-- Modal for add account-->
<div class="full-screen-modal">
    <div id="addAccountModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Connect an account</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container modal-container">
                        <div class="header-modal"><h3>Let's get a picture of your profits</h3></div>
                        <div class="sub-header-modal"><span>Connect your bank or credit card to bring in your transactions.</span></div>
                        <div class="body-modal">
                            <input type="text" class="form-control" placeholder="Enter your bank name or URL" style=" margin: 40px 0 50px 0;">
                            <div class=""><span>Here are some of the most popular ones</span></div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/citibank.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/chase-logo.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/bank-of-america.png') ?>" alt="">

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/Wells_Fargo.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/co-1200.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/us-bank-logo-vector.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/paypal_PNG20.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/pncbank_pms_c.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
    
    <!-- Modal -->
    <div class="full-screen-modal">
    <div id="account_settings" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Account and Settings</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-2" style="background-color:#eceef1;">
                        <!-- <p style="padding:2px;color:#898a8f;"><center>Company</center></p> -->
                        <div class="tab_">
                            <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Company</button>
                            <button class="tablinks" onclick="">Billing & Subscription</button>
                            <button class="tablinks" onclick="openCity(event, 'Paris')">Usage</button>
                            <button class="tablinks" onclick="openCity(event, 'Tokyo')">Sales</button>
                            <button class="tablinks" onclick="openCity(event, 'Expenses')">Expenses</button>
                            <button class="tablinks" onclick="openCity(event, 'payments')">Payments</button>
                            <button class="tablinks" onclick="openCity(event, 'Advanced')">Advanced</button>
                        </div>
                    </div>
                    <div id="London" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">
                            <p style="border:solid #0098cd 1px;padding:1%;width:80%;color:#0098cd;"><i class="fa fa-info-circle" style="font-size:18px;color:#0098cd"></i> You don't currently have permission to edit all company information. Check with your QuickBooks admin if you require access.</p>

                            <table class="table">
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Company name</td>
                                    <td style="width:16%;padding:3%;">
                                        <p></p>
                                        <p>Company name</p>
                                        <p>Legal name</p>
                                        <p>EIN</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><img src="<?= getCompanyBusinessProfileImage(); ?>" class="invoice-print-logo"  style="max-width: 230px; max-height: 200px;" /></p>
                                        <p><?php echo $clients->business_name; ?></p>
                                        <p><?php echo $clients->business_name; ?></p>
                                        <p>XX-XXX6593</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Company type</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Tax form</p>
                                        <p>Industry</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Limited liability</p>
                                        <p>Information</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Contact info</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Company email</p>
                                        <p>Customer-facing email</p>
                                        <p>Company phone</p>
                                        <p>Website</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->email_address; ?></p>
                                        <p><?php echo $clients->email_address; ?></p>
                                        <p><?php echo $clients->phone_number; ?></p>
                                        <p>-</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Address</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Company address</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Address</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Customer-facing address</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Address</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Legal address</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Communications with Intuit</td>
                                    <td style="width:16%;padding:3%;">
                                        <p><a href="#">Marketing Preferences</a></p>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    

                    <div id="Paris" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">
                            <div style="padding:1%;width:80%;"> 
                                <h2>Usage limits</h2> 
                                <p>These are your usage limits for QuickBooks Online Plus. Need more room?</p>
                                <p>Upgrade to a plan with more capacity.</p>
                                <p><a href="#"><h6>Find out more about usage limits.</h6></a></p>

                                <br><br>
                                <p style="font-size:30px;">Billable Users</p>
                                <p>The limit for your plan is 5.</p>
                                <br><hr><br>
                                <p style="font-size:30px;">Chart of accounts</p>
                                <p>The limit for your plan is 250.</p>
                                <br><hr><br>
                            </div>

                        </div>
                    </div>

                    <div id="Tokyo" class="tabcontent">
                        <div class="col-md-12" style="padding:1%;">

                            <table class="table">
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Customize</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Customize the way forms look to your customers</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><button class="btn btn-success">Customize look and feel</button></p>
                                    </td>
                                </tr>
                                <tr id="sales_form_content">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Sales form content</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Preferred invoice terms</p>
                                        <p>Preferred delivery method</p>
                                        <p>Shipping</p>
                                        <p>Custom fields</p>
                                        <p>Custom transaction numbers</p>
                                        <p>Service date</p>
                                        <p>Discount</p>
                                        <p>Deposit </p>
                                        <p>Tips (Gratuity)</p>
                                        <p>Tags</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Net 30</p>
                                        <p>None</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr id="sales_form_content_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Sales form content</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Preferred invoice terms</p><br>
                                        <p>Preferred delivery method</p><br>
                                        <p>Shipping</p><br>
                                        <p>Custom fields</p><br>
                                        <p>Custom transaction numbers</p><br>
                                        <p>Service date</p><br>
                                        <p>Discount</p><br>
                                        <p>Deposit </p><br>
                                        <p>Tips (Gratuity)</p><br>
                                        <p>Tags</p>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="sales_form_content_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success sales_form_content_save_button">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-100px;">
                                            <select class="form-control" style="width:40%;" id="sales_pref_inv_terms">
                                                <option>Net 30</option>
                                                <option>Due 15</option>
                                                <option>Due on receipt</option>
                                            </select>
                                        </p>
                                        <p>
                                            <select class="form-control" style="width:40%;" id="sales_pref_del_method">
                                                <option>None</option>
                                                <option>Print Later</option>
                                                <option>Send Later</option>
                                            </select>
                                        </p>
                                        <p></p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="sales_shipping">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="sales_custom_fields">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="sales_cust_trans_numbers">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="sales_service_date">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="sales_discount">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="sales_deposit">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="sales_tips">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="sales_tags" checked>
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="product_services">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Products and services</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Show Product/Service column on sales forms</p>
                                        <p>Show SKU column</p>
                                        <p>Turn on price rules</p>
                                        <p>Track quantity and price/rate</p>
                                        <p>Track inventory quantity on hand</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>On</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>On</p>
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr id="product_services_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Products and services</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Show Product/Service column on sales forms</p><br>
                                        <p>Show SKU column</p><br>
                                        <p>Turn on price rules</p><br>
                                        <p>Track quantity and price/rate</p><br>
                                        <p>Track inventory quantity on hand</p><br>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="product_services_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success product_services_save_button">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-100px;">
                                            <label class="switch">
                                            <input type="checkbox" id="ps_column_sales_form" checked>
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="ps_show_sku_column">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="ps_price_rules">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="ps_track_qty_price" checked>
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" id="ps_track_inv_qty" checked>
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="progress_invoicing">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Progress Invoicing</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>	Create multiple partial invoices from a single estimate</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr id="progress_invoicing_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Progress Invoicing</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>	Create multiple partial invoices from a single estimate</p><br>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="progress_invoicing_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success progress_invoicing_save_button">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-90px;">
                                            <label class="switch">
                                            <input type="checkbox" id="sales_progress_invoicing">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="messages">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Messages</td>
                                    <td style="width:40%;padding:3%;">
                                        <p>Default email message sent with sales forms</p>
                                    </td>
                                </tr>
                                <tr id="messages_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Messages</td>
                                    <td style="width:40%;padding:3%;">
                                        <p>Default email message sent with sales forms</p>
                                        
                                        <!-- <div class="row"> -->
                                            <div class="row">
                                                <div class="col-md-2" style="text-align: center;vertical-align: center;"><input type="checkbox"></div>
                                                <div class="col-md-5">
                                                    <select class="form-control">
                                                        <option>Dear</option>
                                                        <option>To</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-control">
                                                        <option>[Full Name]</option>
                                                        <option>[First]</option>
                                                        <option>[Company Name]</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">Sales form</div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select class="form-control">
                                                        <option>Invoice</option>
                                                        <option>Estimate</option>
                                                        <option>Credit Memo</option>
                                                        <option>Sales Receipt</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="button" value="Use standard message" class="btn btn-success">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">Email subject line</div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12"><input type="text" value="New invoice [Invoice No.] from ADI Smart Security" class="form-control"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">Email message</div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea class="form-control">
                                                    Here's your invoice! We appreciate your prompt payment.

                                                    Thanks for your business!
                                                    ADi Smart Security
                                                    </textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-2" style="text-align: center;"><input type="checkbox"></div>
                                                <div class="col-md-10">Email me a copy at lauren@adialarms.com</div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Copy (Cc) new invoices to address
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12"><input type="text" class="form-control"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Blind Copy (Bcc) new invoices to address
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12"><input type="text" class="form-control"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Sales form
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control">
                                                        <option>Estimate</option>
                                                        <option>Invoice</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="submit" value="Cancel" id="messages_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                    <!-- <td style="padding:3%;">
                                        <p style="margin-top:-100px;"></p>
                                    </td> -->
                                </tr>
                                <tr id="reminders">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Reminders</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Default email message for invoice reminders</p>
                                        <p>Automatic invoice reminders</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p> </p>
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr id="reminders_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Reminders</td>
                                    <td style="width:50%;padding:3%;">
                                        <p>Default email message for invoice reminders</p>
                                        <p>Automatic invoice reminders 
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label></p>
                                        <p>Automatic email reminders only apply to new invoices. Turning off automatic reminders removes them from all invoices.</p>
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="width: 100%;">
                                                    <span style="float:left;">Reminder 1 (3 day(s) before due date)</span> 
                                                    <b style="float:right;">On <i class="fa fa-sort-down"></i></b>
                                                    </button>
                                                </h5>
                                                </div>

                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <select class="form-control">
                                                                <option>3</option>
                                                                <option>7</option>
                                                                <option>14</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            day(s)
                                                        </div>
                                                        <div class="col-md-5">
                                                            <select class="form-control">
                                                                <option>Before</option>
                                                                <option>After</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            due date
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">Use [Invoice No.] and [Company Name] as placeholders in the email.</div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">Subject line</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" value="Reminder: Invoice [Invoice No.] from Alarm Direct, Inc" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4" style="text-align: center;vertical-align: center;"><input type="checkbox">Use email greeting</div>
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>Dear</option>
                                                                <option>To</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>[Full Name]</option>
                                                                <option>[First]</option>
                                                                <option>[Company Name]</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control">
                                                                Just a reminder that we have not received a payment for this invoice yet. Let us know if you have questions.
                                                                
                                                                Thanks for your business!
                                                                Alarm Direct, Inc
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <!-- <div class="row">
                                                        <div class="col-md-6">
                                                            <select class="form-control">
                                                                <option>Invoice</option>
                                                                <option>Estimate</option>
                                                                <option>Credit Memo</option>
                                                                <option>Sales Receipt</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="button" value="Use standard message" class="btn btn-success">
                                                        </div>
                                                    </div>
                                                    <br> -->
                                                    <div class="row">
                                                        <div class="col-md-12"><a href="#" style="color:blue;">Use default reminder message</a></div>
                                                    </div>
                                                    <br>
                                                    <!-- <div class="row">
                                                        <div class="col-md-2" style="text-align: center;"><input type="checkbox"></div>
                                                        <div class="col-md-10">Email me a copy at lauren@adialarms.com</div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Copy (Cc) new invoices to address
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Blind Copy (Bcc) new invoices to address
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Sales form
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>Estimate</option>
                                                                <option>Invoice</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <br> -->
                                                    <!-- <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="submit" value="Cancel" id="reminders_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                                        </div>
                                                    </div> -->
                                                
                                                </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width: 100%;">
                                                    <span style="float:left;">Reminder 2 (On due date)</span> 
                                                    <b style="float:right;">On <i class="fa fa-sort-down"></i></b>
                                                    </button>
                                                </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <select class="form-control">
                                                                <option>3</option>
                                                                <option>7</option>
                                                                <option>14</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            day(s)
                                                        </div>
                                                        <div class="col-md-5">
                                                            <select class="form-control">
                                                                <option>Before</option>
                                                                <option>After</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            due date
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">Use [Invoice No.] and [Company Name] as placeholders in the email.</div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">Subject line</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" value="Reminder: Invoice [Invoice No.] from Alarm Direct, Inc" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4" style="text-align: center;vertical-align: center;"><input type="checkbox">Use email greeting</div>
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>Dear</option>
                                                                <option>To</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>[Full Name]</option>
                                                                <option>[First]</option>
                                                                <option>[Company Name]</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control">
                                                                Just a reminder that we have not received a payment for this invoice yet. Let us know if you have questions.
                                                                
                                                                Thanks for your business!
                                                                Alarm Direct, Inc
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <!-- <div class="row">
                                                        <div class="col-md-6">
                                                            <select class="form-control">
                                                                <option>Invoice</option>
                                                                <option>Estimate</option>
                                                                <option>Credit Memo</option>
                                                                <option>Sales Receipt</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="button" value="Use standard message" class="btn btn-success">
                                                        </div>
                                                    </div>
                                                    <br> -->
                                                    <div class="row">
                                                        <div class="col-md-12"><a href="#" style="color:blue;">Use default reminder message</a></div>
                                                    </div>
                                                    <br>
                                                    <!-- <div class="row">
                                                        <div class="col-md-2" style="text-align: center;"><input type="checkbox"></div>
                                                        <div class="col-md-10">Email me a copy at lauren@adialarms.com</div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Copy (Cc) new invoices to address
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Blind Copy (Bcc) new invoices to address
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Sales form
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>Estimate</option>
                                                                <option>Invoice</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <br> -->
                                                    <!-- <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="submit" value="Cancel" id="reminders_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                                        </div>
                                                    </div> -->


                                                </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%;">
                                                    <span style="float:left;">Reminder 3 (3 day(s) after due date)</span> 
                                                    <b style="float:right;">On <i class="fa fa-sort-down"></i></b>
                                                    </button>
                                                </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body">
                                                <div class="row">
                                                        <div class="col-md-3">
                                                            <select class="form-control">
                                                                <option>3</option>
                                                                <option>7</option>
                                                                <option>14</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            day(s)
                                                        </div>
                                                        <div class="col-md-5">
                                                            <select class="form-control">
                                                                <option>Before</option>
                                                                <option>After</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            due date
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">Use [Invoice No.] and [Company Name] as placeholders in the email.</div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">Subject line</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" value="Reminder: Invoice [Invoice No.] from Alarm Direct, Inc" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4" style="text-align: center;vertical-align: center;"><input type="checkbox">Use email greeting</div>
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>Dear</option>
                                                                <option>To</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>[Full Name]</option>
                                                                <option>[First]</option>
                                                                <option>[Company Name]</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control">
                                                                Just a reminder that we have not received a payment for this invoice yet. Let us know if you have questions.
                                                                
                                                                Thanks for your business!
                                                                Alarm Direct, Inc
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <!-- <div class="row">
                                                        <div class="col-md-6">
                                                            <select class="form-control">
                                                                <option>Invoice</option>
                                                                <option>Estimate</option>
                                                                <option>Credit Memo</option>
                                                                <option>Sales Receipt</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="button" value="Use standard message" class="btn btn-success">
                                                        </div>
                                                    </div>
                                                    <br> -->
                                                    <div class="row">
                                                        <div class="col-md-12"><a href="#" style="color:blue;">Use default reminder message</a></div>
                                                    </div>
                                                    <br>
                                                    <!-- <div class="row">
                                                        <div class="col-md-2" style="text-align: center;"><input type="checkbox"></div>
                                                        <div class="col-md-10">Email me a copy at lauren@adialarms.com</div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Copy (Cc) new invoices to address
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Blind Copy (Bcc) new invoices to address
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12"><input type="text" class="form-control"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Sales form
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select class="form-control">
                                                                <option>Estimate</option>
                                                                <option>Invoice</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <br> -->
                                                    <!-- <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="submit" value="Cancel" id="reminders_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                                        </div>
                                                    </div> -->


                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" value="Cancel" id="reminders_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </div>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                    <!-- <td style="padding:3%;">
                                        <p> </p>
                                        <p>On</p>
                                    </td> -->
                                </tr>
                                <tr id="online_delivery">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Online delivery</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Email options for all sales forms</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr id="online_delivery_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Online delivery</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Email options for all sales forms</p>
                                        <br>
                                        <input type="radio" name="radio"> Show short summary in email <br>
                                        <input type="radio" name="radio" checked> Show full details in email
                                        <br><br>
                                        <span>Select which sales forms to attach PDFs to</span>
                                        <br><br>
                                        <input type="checkbox" checked> Invoices <br>
                                        <input type="checkbox"> Credit memo, sales receipt, refund receipt, estimate, receive payment <br><br>
                                        <span>Additional email options for invoices</span> <br><br>
                                        <select class="form-control" style="width:40%;">
                                            <option>Online Invoice</option>
                                            <option>HTML</option>
                                            <option>Plain Text</option>
                                        </select><br><br>
                                        <input type="submit" value="Cancel" id="online_delivery_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="statements">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Statements</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Show aging table at bottom of statement</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr id="statements_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Statements</td>
                                    <td style="width:30%;padding:3%;">
                                    <br>
                                        <input type="radio" name="radio"> Show short summary in email <br>
                                        <input type="radio" name="radio" checked> Show full details in email <br><br>
                                        <p>Show aging table at bottom of statement 
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="statements_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                    <!-- <td style="padding:3%;">
                                        <p>On</p>
                                    </td> -->
                                </tr>
                            </table>

                        </div>
                    </div>


                    <div id="Expenses" class="tabcontent">
                        <div class="col-md-12" style="padding:1%;">
                            <div style="padding:1%;width:100%;"> 
                                <table class="table">
                                    <!-- <tr>
                                        <td style="width:10%;">Customize</td>
                                        <td style="width:30%;padding:3%;">
                                            <p>Customize the way forms look to your customers</p>
                                        </td>
                                        <td style="padding:3%;">
                                            <p><button class="btn btn-success">Customize look and feel</button></p>
                                        </td>
                                    </tr> -->
                                    <tr id="exp_sales_form_content">
                                        <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Sales form content</td>
                                        <td style="width:30%;padding:3%;">
                                            <p>Show Items table on expense and purchase forms</p>
                                            <p>Show Tags field on expense and purchase forms </p>
                                            <p>Track expenses and items by customer</p>
                                            <p>Make expenses and items billable</p>
                                            <p>Default bill payment terms</p>
                                            <!-- <p>Service date</p>
                                            <p>Discount</p>
                                            <p>Deposit </p>
                                            <p>Tips (Gratuity)</p>
                                            <p>Tags</p> -->
                                        </td>
                                        <td style="padding:3%;">
                                            <p>On</p>
                                            <p>On</p>
                                            <p>On</p>
                                            <p>On</p>
                                            <p>Net 30</p>
                                            <!-- <p>Off</p>
                                            <p>Off</p>
                                            <p>Off</p>
                                            <p>Off</p>
                                            <p>Off</p>
                                            <p>On</p> -->
                                        </td>
                                    </tr>
                                    <tr id="exp_sales_form_content_edit" style="display:none;">
                                        <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Sales form content</td>
                                        <td style="width:40%;padding:3%;">
                                            <p>Show Items table on expense and purchase forms
                                                <!-- <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label> -->
                                            </p> <br>
                                            <p>Show Tags field on expense and purchase forms 
                                                <!-- <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label> -->
                                            </p> <br>
                                            <p>Track expenses and items by customer
                                                <!-- <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label> -->
                                            </p> <br>
                                            <p>Make expenses and items billable
                                                <!-- <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label> -->
                                            </p> <br>
                                            <p>Default bill payment terms
                                                <!-- <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label> -->
                                            </p> <br>
                                            <br>
                                            <input type="checkbox" checked> Markup with a default rate of <input type="text" class="form-control" style="width:80px;display:inline-block;" value="0">%  <br>
                                            <input type="checkbox" > Track billable expenses and items as income <br>
                                            <input type="checkbox" > Charge sales tax <br>
                                            <br>
                                            <b>Default bill payment terms</b> 
                                            <select class="form-control" style="width:40%;">
                                                <option>Net 10</option>
                                                <option>Due 15</option>
                                                <option>Due on receipt</option>
                                            </select>

                                            <!-- <p>Service date</p>
                                            <p>Discount</p>
                                            <p>Deposit </p>
                                            <p>Tips (Gratuity)</p>
                                            <p>Tags</p> -->
                                            <br><br>
                                            <input type="submit" value="Cancel" id="exp_sales_form_content_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                        </td>
                                        <td style="padding:3%;">
                                            <p style="margin-top:-250px;">
                                                <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p>
                                                <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p>
                                                <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p>
                                                <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p>
                                                <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label>
                                            </p>
                                        </td>
                                        <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                    </tr>
                                    <tr id="purchase_orders">
                                        <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Purchase orders</td>
                                        <td style="width:30%;padding:3%;">
                                            <p>Use purchase orders</p>
                                        </td>
                                        <td style="padding:3%;">
                                            <p>On</p>
                                        </td>
                                    </tr>
                                    <tr id="purchase_orders_edit" style="display:none;">
                                        <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Purchase orders</td>
                                        <td style="width:40%;padding:3%;">
                                            <p>Use purchase orders 
                                                <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p>Custom fields</p>
                                            <p>Go to Settings > Lists > Custom Fields to manage your custom fields.</p>
                                            <p>Custom transaction number 
                                                <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p>Default message on purchase orders</p>
                                            <textarea class="form-control"></textarea>
                                            <br><br>
                                            <input type="submit" value="Cancel" id="purchase_orders_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                        </td>
                                        <td align="right" style="width:100%;"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                        <!-- <td style="padding:3%;">
                                            <p>On</p>
                                        </td> -->
                                    </tr>
                                    <tr id="exp_messages">
                                        <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Messages</td>
                                        <td style="width:30%;padding:3%;">
                                            <p>Default email message sent with sales forms</p>
                                        </td>
                                        <td style="padding:3%;">
                                            <p></p>
                                        </td>
                                    </tr>
                                    <tr id="exp_messages_edit" style="display:none;">
                                        <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Messages</td>
                                        <td style="width:50%;padding:3%;">
                                            <p>Default email message sent with sales forms</p>
                                            
                                            <!-- <div class="row"> -->
                                                <div class="row">
                                                    <div class="col-md-2" style="text-align: center;vertical-align: center;"><input type="checkbox"></div>
                                                    <div class="col-md-5">
                                                        <select class="form-control">
                                                            <option>Dear</option>
                                                            <option>To</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-control">
                                                            <option>[Full Name]</option>
                                                            <option>[First]</option>
                                                            <option>[Company Name]</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">Sales form</div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select class="form-control">
                                                            <option>Invoice</option>
                                                            <option>Estimate</option>
                                                            <option>Credit Memo</option>
                                                            <option>Sales Receipt</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="button" value="Use standard message" class="btn btn-success">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">Email subject line</div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12"><input type="text" value="New invoice [Invoice No.] from ADI Smart Security" class="form-control"></div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">Email message</div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea class="form-control">
                                                        Here's your invoice! We appreciate your prompt payment.

                                                        Thanks for your business!
                                                        ADi Smart Security
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-2" style="text-align: center;"><input type="checkbox"></div>
                                                    <div class="col-md-10">Email me a copy at lauren@adialarms.com</div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Copy (Cc) new invoices to address
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12"><input type="text" class="form-control"></div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Blind Copy (Bcc) new invoices to address
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12"><input type="text" class="form-control"></div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Sales form
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select class="form-control">
                                                            <option>Estimate</option>
                                                            <option>Invoice</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="submit" value="Cancel" id="exp_messages_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </td>
                                        <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                        <!-- <td style="padding:3%;">
                                            <p style="margin-top:-100px;"></p>
                                        </td> -->
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div id="payments" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">

                            <table class="table">
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Merchant details</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Merchant ID 5247719993753319</p>
                                        <p>Run deposit reports</p>
                                        <p>See transaction details</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><button class="btn btn-success">Manage account</button></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Deposit Speed</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Credit Cards</p>
                                        <p>Bank Transfers</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>1 business day</p>
                                        <p>1 business day</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Deposit accounts</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Standard depositsl</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>TEST BANK (...6001) <a href="#">Change</a></p>
                                        <p>P.O. BOX 681</p>
                                        <p>PLACE, AL 35211</p>
                                        <p>-</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Business Owner info</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Owner's address</p>
                                        <p>Mobile Phone number</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                        <p>(123) 456-7890</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Address</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Customer-facing address</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Documents</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Monthly Statements</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>
                                            <select class="form-control">
                                                <option>July 2021</option>
                                            </select>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Chart of Accounts</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Tell us where in QuickBooks to automatically record:</p>
                                        <p>Standard deposits</p>
                                        <p>Processing fees</p>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Payment Methods</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Cards</p>
                                        <p>Bank Transfer</p>
                                        <p>PayPal</p>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    <div id="Advanced" class="tabcontent">
                        <div class="col-md-12" style="padding:1%;">

                            <table class="table">
                                <!-- <tr>
                                    <td style="width:10%;">Customize</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Customize the way forms look to your customers</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><button class="btn btn-success">Customize look and feel</button></p>
                                    </td>
                                </tr> -->
                                <tr id="adv_accounting">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Accounting</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>First month of fiscal year</p>
                                        <p>First month of income tax year</p>
                                        <p>Accounting method</p>
                                        <p>Close the books</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>January</p>
                                        <p>Same as fiscal year</p>
                                        <p>Accrual</p>
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr id="adv_accounting_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Accounting</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>First month of fiscal year</p><br>
                                        <p>First month of income tax year</p><br>
                                        <p>Accounting method</p><br>
                                        <p>Close the books</p><br>
                                        <br>
                                        <input type="submit" value="Cancel" id="adv_accounting_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-100px;">
                                            <select class="form-control" style="width:20%;">
                                                <option>January</option>
                                            </select>
                                        </p>
                                        <p>
                                            <select class="form-control" style="width:30%;">
                                                <option>Same as fiscal year</option>
                                            </select>
                                        </p>
                                        <p>
                                            <select class="form-control" style="width:20%;">
                                                <option>Accrual</option>
                                            </select>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="adv_chart_of_accounts">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Chart of accounts</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Enable account numbers</p>
                                        <p>Tips account</p>
                                        <p>Markup income account</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>OFF</p>
                                        <p> </p>
                                        <p>Markup</p>
                                    </td>
                                </tr>
                                <tr id="adv_chart_of_accounts_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Chart of accounts</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Enable account numbers</p><br>
                                        <p>Tips account</p><br>
                                        <p>Markup income account</p>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="adv_chart_of_accounts_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-100px;">
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <select class="form-control" style="width:30%;">
                                                <option></option>
                                            </select> 
                                        </p>
                                        <p>
                                            <select class="form-control" style="width:30%;">
                                                <option>Markup</option>
                                            </select> 
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="adv_categories">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Categories</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Track classes</p>
                                        <p>Track locations</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Off</p>
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr id="adv_categories_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Categories</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Track classes</p><br>
                                        <p>Track locations</p><br>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="adv_categories_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-100px;">
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="adv_automation">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Automation</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Pre-fill forms with previously entered content</p>
                                        <p>Automatically apply credits</p>
                                        <p>Automatically invoice unbilled activity</p>
                                        <p>Automatically apply bill payments</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr id="adv_automation_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Automation</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Pre-fill forms with previously entered content</p>
                                        <p>Automatically apply credits</p><br>
                                        <p>Automatically invoice unbilled activity</p><br>
                                        <p>Automatically apply bill payments</p>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="adv_automation_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-89px;">
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="adv_projects">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Projects</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Organize all job-related activity in one place</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr id="adv_projects_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Projects</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Organize all job-related activity in one place</p>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="adv_projects_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-65px;">
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="time_tracking">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Time tracking</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Add Service field to timesheets</p>
                                        <p>Make Single-Time Activity Billable to Customer</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>On</p>
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr id="time_tracking_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Time tracking</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Add Service field to timesheets</p> <br>
                                        <p>Make Single-Time Activity Billable to Customer</p>
                                        <br>
                                        <input type="checkbox"> Show billing rate to users entering time
                                        <br><br>
                                        First day of work week <br>
                                        <select class="form-control" style="width:30%;">
                                            <option>Sunday</option>
                                            <option>Monday</option>
                                            <option>Tuesday</option>
                                            <option>Wednesday</option>
                                            <option>Thursday</option>
                                            <option>Friday</option>
                                            <option>Saturday</option>
                                        </select> 
                                        <br><br>
                                        <input type="submit" value="Cancel" id="time_tracking_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-160px;">
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="adv_currency">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Currency</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Home Currency</p>
                                        <p>Multicurrency</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>USD</p>
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr id="adv_currency_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Currency</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Home Currency</p><br>
                                        <p>Multicurrency</p>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="adv_currency_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-100px;">
                                            <select class="form-control" style="width:40%;">
                                                <option>USD - United States Dollar</option>
                                            </select> 
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                                <tr id="adv_other_preferences">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Other preferences</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Date format</p>
                                        <p>Number format</p>
                                        <p>Customer label</p>
                                        <p>Warn if duplicate check number is used</p>
                                        <p>Warn me when I enter a bill number that’s already been used for that vendor</p>
                                        <p>Warn if duplicate journal number is used</p>
                                        <p>Sign me out if inactive for</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>MM/dd/yyyy</p>
                                        <p>123,456.00</p>
                                        <p>Customers</p>
                                        <p>On</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>1 hour</p>
                                    </td>
                                </tr>
                                <tr id="adv_other_preferences_edit" style="display:none;">
                                    <td style="width:10%;vertical-align: top;text-align: left;font-weight:bold;">Other preferences</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Date format</p><br>
                                        <p>Number format</p><br>
                                        <p>Customer label</p><br>
                                        <p>Warn if duplicate check number is used</p><br>
                                        <p>Warn me when I enter a bill number that’s already been used for that vendor</p><br>
                                        <p>Warn if duplicate journal number is used</p><br>
                                        <p>Sign me out if inactive for</p>
                                        <br><br>
                                        <input type="submit" value="Cancel" id="adv_other_preferences_edit_button" class="btn btn-primary"> <input type="submit" value="Save" class="btn btn-success">
                                    </td>
                                    <td style="padding:3%;">
                                        <p style="margin-top:-148px;">
                                            <select class="form-control" style="width:40%;">
                                                <option>MM/dd/yyyy</option>
                                            </select> 
                                        </p>
                                        <p>
                                            <select class="form-control" style="width:40%;">
                                                <option>123,456.00</option>
                                                <option>123.456,00</option>
                                            </select> 
                                        </p>
                                        <p>
                                            <select class="form-control" style="width:40%;">
                                                <option>Customers</option>
                                                <option>Clients</option>
                                                <option>Donors</option>
                                                <option>Guests</option>
                                                <option>Members</option>
                                                <option>Patients</option>
                                                <option>Tenants</option>
                                            </select> 
                                        </p>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox" checked>
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <br>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <br>
                                        <p>
                                            <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td align="right"><i class="fa fa-edit" style="font-size:36px"></i></td>
                                </tr>
                            </table>

                        </div>
                    </div>





                </div>

                


                    
                </div>
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
    
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    $(document).ready(function () {
        // Donut Graph
        var Data = [
            {label:"Commissions & Fees",value:74},
            {label:"Reimburstment",value:19},
            {label:"Subcontractors",value:7},
            {label:"Bank Charges",value:2}
        ];
        var total = 100;
        var donut_chart = Morris.Donut({
            element: 'expensesChart',
            data:Data,
            resize:true,
            formatter: function (value, data) {
            return Math.floor(value/total*100) + '%';
            }
        });
    });
    $(function () {
        "use strict";
        // LINE CHART
        var data=[
            {"date":"Jun 14 - Jun 20","sales":"0"},
            {"date":"Jun 21 - Jun 27","sales":"0"},
            {"date":"Jun 28 - Jul 4","sales":"0"},
            {"date":"Jul 5 - Jul 11","sales":"4"},
            {"date":"Jul 12 - Jul 13","sales":"0"}
        ];

        Morris.Line({
            element: 'sales-line-chart',
            data: data,
            resize:true,
            xkey: ['date'],
            ykeys: ['sales'],
            ymax:12,
            labels: ['Sales'],
            preUnits:'$',
            parseTime : false
        });

    });

</script>

<script>
    function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<script>
$(document).ready(function() {
    $("#sales_form_content").click(function() {
        var test = $(this).val();

        $("#sales_form_content").hide();
        $("#sales_form_content_edit" + test).show();
    });

    $("#sales_form_content_edit_button").click(function() {
        var test = $(this).val();

        $("#sales_form_content_edit").hide();
        $("#sales_form_content").show();
    });


    $("#product_services").click(function() {
        var test = $(this).val();

        $("#product_services").hide();
        $("#product_services_edit" + test).show();
    });

    $("#product_services_edit_button").click(function() {
        var test = $(this).val();

        $("#product_services_edit").hide();
        $("#product_services").show();
    });

    $("#progress_invoicing").click(function() {
        var test = $(this).val();

        $("#progress_invoicing").hide();
        $("#progress_invoicing_edit" + test).show();
    });

    $("#progress_invoicing_edit_button").click(function() {
        var test = $(this).val();

        $("#progress_invoicing_edit").hide();
        $("#progress_invoicing").show();
    });

    $("#messages").click(function() {
        var test = $(this).val();

        $("#messages").hide();
        $("#messages_edit" + test).show();
    });

    $("#messages_edit_button").click(function() {
        var test = $(this).val();

        $("#messages_edit").hide();
        $("#messages").show();
    });

    $("#reminders").click(function() {
        var test = $(this).val();

        $("#reminders").hide();
        $("#reminders_edit" + test).show();
    });

    $("#reminders_edit_button").click(function() {
        var test = $(this).val();

        $("#reminders_edit").hide();
        $("#reminders").show();
    });

    $("#online_delivery").click(function() {
        var test = $(this).val();

        $("#online_delivery").hide();
        $("#online_delivery_edit" + test).show();
    });

    $("#online_delivery_edit_button").click(function() {
        var test = $(this).val();

        $("#online_delivery_edit").hide();
        $("#online_delivery").show();
    });

    $("#statements").click(function() {
        var test = $(this).val();

        $("#statements").hide();
        $("#statements_edit" + test).show();
    });

    $("#statements_edit_button").click(function() {
        var test = $(this).val();

        $("#statements_edit").hide();
        $("#statements").show();
    });

    $("#exp_sales_form_content").click(function() {
        var test = $(this).val();

        $("#exp_sales_form_content").hide();
        $("#exp_sales_form_content_edit" + test).show();
    });

    $("#exp_sales_form_content_edit_button").click(function() {
        var test = $(this).val();

        $("#exp_sales_form_content_edit").hide();
        $("#exp_sales_form_content").show();
    });

    $("#purchase_orders").click(function() {
        var test = $(this).val();

        $("#purchase_orders").hide();
        $("#purchase_orders_edit" + test).show();
    });

    $("#purchase_orders_edit_button").click(function() {
        var test = $(this).val();

        $("#purchase_orders_edit").hide();
        $("#purchase_orders").show();
    });

    $("#exp_messages").click(function() {
        var test = $(this).val();

        $("#exp_messages").hide();
        $("#exp_messages_edit" + test).show();
    });

    $("#exp_messages_edit_button").click(function() {
        var test = $(this).val();

        $("#exp_messages_edit").hide();
        $("#exp_messages").show();
    });

    $("#adv_accounting").click(function() {
        var test = $(this).val();

        $("#adv_accounting").hide();
        $("#adv_accounting_edit" + test).show();
    });

    $("#adv_accounting_edit_button").click(function() {
        var test = $(this).val();

        $("#adv_accounting_edit").hide();
        $("#adv_accounting").show();
    });

    $("#adv_chart_of_accounts").click(function() {
        var test = $(this).val();

        $("#adv_chart_of_accounts").hide();
        $("#adv_chart_of_accounts_edit" + test).show();
    });

    $("#adv_chart_of_accounts_edit_button").click(function() {
        var test = $(this).val();

        $("#adv_chart_of_accounts_edit").hide();
        $("#adv_chart_of_accounts").show();
    });

    $("#adv_categories").click(function() {
        var test = $(this).val();

        $("#adv_categories").hide();
        $("#adv_categories_edit" + test).show();
    });

    $("#adv_categories_edit_button").click(function() {
        var test = $(this).val();

        $("#adv_categories_edit").hide();
        $("#adv_categories").show();
    });

    $("#adv_automation").click(function() {
        var test = $(this).val();

        $("#adv_automation").hide();
        $("#adv_automation_edit" + test).show();
    });

    $("#adv_automation_edit_button").click(function() {
        var test = $(this).val();

        $("#adv_automation_edit").hide();
        $("#adv_automation").show();
    });

    $("#adv_projects").click(function() {
        var test = $(this).val();

        $("#adv_projects").hide();
        $("#adv_projects_edit" + test).show();
    });

    $("#adv_projects_edit_button").click(function() {
        var test = $(this).val();

        $("#adv_projects_edit").hide();
        $("#adv_projects").show();
    });

    $("#time_tracking").click(function() {
        var test = $(this).val();

        $("#time_tracking").hide();
        $("#time_tracking_edit" + test).show();
    });

    $("#time_tracking_edit_button").click(function() {
        var test = $(this).val();

        $("#time_tracking_edit").hide();
        $("#time_tracking").show();
    });

    $("#adv_currency").click(function() {
        var test = $(this).val();

        $("#adv_currency").hide();
        $("#adv_currency_edit" + test).show();
    });

    $("#adv_currency_edit_button").click(function() {
        var test = $(this).val();

        $("#adv_currency_edit").hide();
        $("#adv_currency").show();
    });

    $("#adv_other_preferences").click(function() {
        var test = $(this).val();

        $("#adv_other_preferences").hide();
        $("#adv_other_preferences_edit" + test).show();
    });

    $("#adv_other_preferences_edit_button").click(function() {
        var test = $(this).val();

        $("#adv_other_preferences_edit").hide();
        $("#adv_other_preferences").show();
    });
});
</script>

<script>
$(document).ready(function() {
    $(".sales_form_content_save_button").click(function() {
        // alert('test');
        var sales_pref_inv_terms = $("#sales_pref_inv_terms").val();
        var sales_pref_del_method = $("#sales_pref_del_method").val();

        if($("#sales_shipping").prop('checked') == true){
            var sales_shipping = 1;
        }else{
            var sales_shipping = 0;
        }

        if($("#sales_custom_fields").prop('checked') == true){
            var sales_custom_fields = 1;
        }else{
            var sales_custom_fields = 0;
        }

        if($("#sales_cust_trans_numbers").prop('checked') == true){
            var sales_cust_trans_numbers = 1;
        }else{
            var sales_cust_trans_numbers = 0;
        }

        if($("#sales_service_date").prop('checked') == true){
            var sales_service_date = 1;
        }else{
            var sales_service_date = 0;
        }

        if($("#sales_discount").prop('checked') == true){
            var sales_discount = 1;
        }else{
            var sales_discount = 0;
        }

        if($("#sales_deposit").prop('checked') == true){
            var sales_deposit = 1;
        }else{
            var sales_deposit = 0;
        }

        if($("#sales_tips").prop('checked') == true){
            var sales_tips = 1;
        }else{
            var sales_tips = 0;
        }

        if($("#sales_tags").prop('checked') == true){
            var sales_tags = 1;
        }else{
            var sales_tags = 0;
        }

        $.ajax({
         type: 'POST',
         url:"<?php echo base_url(); ?>accounting/save_sales_form_content",
         data: {sales_pref_inv_terms : sales_pref_inv_terms, sales_pref_del_method : sales_pref_del_method, sales_shipping : sales_shipping, sales_custom_fields : sales_custom_fields, sales_cust_trans_numbers : sales_cust_trans_numbers, sales_service_date : sales_service_date, sales_discount : sales_discount, sales_deposit : sales_deposit, sales_tips : sales_tips,  sales_tags : sales_tags },
         dataType: 'json',
         success: function(response){
             alert('success');
     
         },
             error: function(response){
             alert('Error'+response);
    
             }
        });
    });


    $(".product_services_save_button").click(function() {
        // alert('test');

        if($("#ps_column_sales_form").prop('checked') == true){
            var ps_column_sales_form = 1;
        }else{
            var ps_column_sales_form = 0;
        }

        if($("#ps_show_sku_column").prop('checked') == true){
            var ps_show_sku_column = 1;
        }else{
            var ps_show_sku_column = 0;
        }

        if($("#ps_price_rules").prop('checked') == true){
            var ps_price_rules = 1;
        }else{
            var ps_price_rules = 0;
        }

        if($("#ps_track_qty_price").prop('checked') == true){
            var ps_track_qty_price = 1;
        }else{
            var ps_track_qty_price = 0;
        }

        if($("#ps_track_inv_qty").prop('checked') == true){
            var ps_track_inv_qty = 1;
        }else{
            var ps_track_inv_qty = 0;
        }

        $.ajax({
         type: 'POST',
         url:"<?php echo base_url(); ?>accounting/save_product_services_content",
         data: {ps_column_sales_form : ps_column_sales_form, ps_show_sku_column : ps_show_sku_column, ps_price_rules : ps_price_rules, ps_track_qty_price : ps_track_qty_price, ps_track_inv_qty : ps_track_inv_qty },
         dataType: 'json',
         success: function(response){
             alert('success');
     
         },
             error: function(response){
             alert('Error'+response);
    
             }
        });
    });
});
</script>
<script>
$(function() {
    $('.bar-chart').cssCharts({type:"bar"});
});
</script>
