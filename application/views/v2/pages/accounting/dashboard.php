
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/accounting_header'); 
// include viewPath('includes/header');

?>
<!-- <link rel="stylesheet" href="<?= base_url("assets/frontend/css/accounting_dashboard.css") ?>"> -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?= base_url("assets/css/accounting/accounting.css") ?>">

<link rel="stylesheet"
        href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
        
    <link rel="stylesheet"
        href="<?php echo $url->assets ?>plugins/morris.js/morris.css">
    <link
        href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css"
        rel="stylesheet" type="text/css">
        

<?php
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //'assets/frontend/css/workorder/main.css',
    // 'assets/css/beforeafter.css',
));
?>

<style>
    #exTab1 .tab-content {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
  }
  #exTab3 .tab-content {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
  }
  .project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
      color: #0062cc;
      background-color: transparent;
      border-color: transparent transparent #f3f3f3;
      border-bottom: 3px solid !important;
      font-size: 16px;
      font-weight: bold;
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

  .alert{
  width:60%;
  /* margin:20px auto; */
  padding:20px;
  position:relative;
  border-radius:5px;
  box-shadow:0 0 15px 5px #ccc;
  background-color: #FBF5FF;
  border-left:5px solid #7A08C8;
}
.close{
  position:absolute;
  width:30px;
  height:30px;
  opacity:0.5;
  border-width:1px;
  border-style:solid;
  border-radius:50%;
  right:15px;
  top:25px;
  text-align:center;
  font-size:1.5em;
  cursor:pointer;
  border-color: #7A08C8;
  color:#7A08C8;
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

  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }
  
  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }
  
  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }
  
  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }
  
  /* Style the tab content */
  .tabcontent {
    /* display: none; */
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
  
  .canvasjs-chart-credit
  {
      display: none;
  }

  .area-chart {
    /* Reset */
    margin: 0;
    padding: 0;
    border: 0;
  
    /* Dimensions */
    width: 100%;
    max-width: var(--chart-width, 600px);
    height: var(--chart-height, 300px);
  
    /* Layout */
    display: flex;
    justify-content: stretch;
    align-items: stretch;
    flex-direction: row;
  }
  ul.area-chart,
  ol.area-chart {
    list-style: none;
  }
  .area-chart > * {
    /* Even size items */
    flex-grow: 1;
    flex-shrink: 1;
    flex-basis: 0;
  
    /* Color */
    background: var(--color, rgba(240, 50, 50, .75));
    clip-path: polygon(
      0% calc(100% * (1 - var(--start))),
      100% calc(100% * (1 - var(--end))),
      100% 100%,
      0% 100%
    );
  }

  .con-inner-container .con-bar .open-invoices {
    height: 129px;
    background-color: rgb(186, 190, 197);
}

.con-inner-container .con-bar .paid-invoices {
    margin-top: 2px;
    height: 82px;
    background-color: rgb(127, 208, 0);
}

.con-data-label {
    padding-left: 55px;
}

.con-data-label .con-label {
    color: rgb(57, 58, 61);
    font-size: 19px;
    font-weight: 700;
    line-height: 16px;
    padding-top: 20px;
}

.con-data-label .con-sub-label {
    color: rgb(57, 58, 61);
    font-weight: 400;
    line-height: 17px;
    padding-top: 8px;
    padding-bottom: 12px;
    text-transform: uppercase;
}

.box-invoices-bar {
    cursor: pointer;
}

.expenses-money-section {
    cursor: pointer;
}

.expenses-money-section .expenses-con-data {
    font-weight: 400;
    font-size: 14px;
    color: rgb(57, 58, 61);
}

.expenses-money-section .expenses-money-data {
    visibility: hidden;
    color: rgb(57, 58, 61);
    font-weight: 700;
    font-size: 19px;
    line-height: 1em;
    margin-bottom: 4px;
}

.expenses-donutchart-section {
    padding-top: 10px;
}

.expenses-donutchart-section .donut-chart-container {
    position: relative;
    height: 200px;
    overflow: hidden;
    padding-left: 0;
}

.expenses-donutchart-section #expensesChart {
    position: relative;
    float: left;
    right: 10px;
    display: inline-block;
}

.expenses-donutchart-section svg {
    /*left: -50px!important;*/
    padding: 0;
}

.expenses-donutchart-section #legendExpenses {
    display: inline-block;
    height: 200px;
    position: relative;
    width: 40%;
    float: right;
    z-index: 20;
}

.expenses-donutchart-section #legendExpenses .legendList {
    padding-top: 0;
    margin-left: -22px;
}

.expenses-donutchart-section #legendExpenses .legendList .box {
    width: 13px;
    height: 12px;
    background-color: #0b62a4;
    display: inline-block;
}

.expenses-donutchart-section #legendExpenses .legendList .amount {
    font-weight: bolder;
    display: inline-block;
}

.expenses-donutchart-section #legendExpenses .legendList .name {
    color: rgb(107, 108, 114);
    font-size: 12px;
    margin-bottom: 9px;
    margin-left: 17px;
    width: 110px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
  
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                    <section id="tabs" class="project-tab" style="padding-left: 0px;padding-right: 0px;">
                        <div class="">
                            <div class="row">
                                <div class="col-md-5">
                                    <nav>
                                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color:#666666;display: inline-block;">Get things done</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="color:#666666;display: inline-block;">Business overview</a> 
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <!-- <br>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>Some QuickBooks Payments deposits weren't automatically recorded. After you receive the funds in your account, record them manually as a Bank Deposit. <a href="#"  style="color:#0077C5;">Take Action </a> </p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>Your customer made a payment more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a> </p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>A bank transfer from your customer received as payment for Invoice 13053 has been canceled due to a problem with their account. To keep your books accurate, you should follow the steps to <a href="#"  style="color:#0077C5;">handle a canceled bank transfer.</a></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                <i class="fa fa-exclamation-circle" style="font-size:24px;color: #0098cd;"></i> Alert <br>
                                                <p>We just updated the info we share on commercial card transactions. We're now sharing line item details, also known as Level 3 data, with the card companies. This has benefits for both you and your customers. <a href="#"  style="color:#0077C5;">Tell me more</a></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size:20px;">X</span>
                                                </button>
                                            </div> -->
                                            <br>
                                            <div class="alert simple-alert">
                                                <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                <a class="close">&times;</a>
                                            </div>

                                            <div class="alert success-alert">
                                                <p>Some nSmarTrac Payments deposits weren't automatically recorded. After you receive the funds in your account, record them manually as a Bank Deposit. <br> <a href="#"  style="color:#0077C5;">Take Action </a> </p>
                                                <a class="close">&times;</a>
                                            </div>

                                            <div class="alert danger-alert">
                                                <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                <a class="close">&times;</a>
                                            </div>

                                            <div class="alert warning-alert">
                                                <p>A bank transfer from your customer received as payment for Invoice 13053 has been canceled due to a problem with their account. To keep your <br>books accurate, you should follow the steps to <a href="#"  style="color:#0077C5;">handle a canceled bank transfer.</a></p>
                                                <a class="close">&times;</a>
                                            </div>

                                            <br><br>

                                            <div style="background-color:#f9fafb;width:80%;border-radius:15px;" id="dashboardDivs">
                                                <div class="row">
                                                    <div class="col-md-1" style="background-color:#eceef1;padding: 80px 0;border-radius:15px 0 0 15px;">
                                                        <center><h6>Money in</h6></center>
                                                    </div>
                                                    <div class="col-md-11" style="padding:0 3% 3% 3%;">
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="<?php echo base_url('accounting/products-and-services') ?>">
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
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="<?php echo base_url('accounting/customers') ?>">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center>
                                                                        <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                                                        <i class="fa fa-users" aria-hidden="true" style="font-size:30px;"></i>
                                                                    </center>
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
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="#" class="ajax-" data-toggle="modal" data-target="#newJobModal">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center>
                                                                        <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                                                        <i class="fa fa-file" aria-hidden="true" style="font-size:30px;"></i>
                                                                    </center>
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
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="<?php echo base_url('accounting/addnewInvoice') ?>" class="notification">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center>
                                                                        <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                                                        <i class="fa fa-file-text-o" aria-hidden="true" style="font-size:30px;"></i>
                                                                    </center>
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
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center>
                                                                        <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                                                        <i class="fa fa-money" aria-hidden="true" style="font-size:30px;"></i>
                                                                    </center>
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
                                                        <div align="center" style="display: inline-block;">
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
                                            <div style="background-color:#f9fafb;width:80%;" id="dashboardDivs">
                                                <div class="row">
                                                    <div class="col-md-1" style="background-color:#eceef1;padding: 80px 0;border-radius:15px 0 0 15px;">
                                                        <center><h6>Money out</h6></center>
                                                    </div>
                                                    <div class="col-md-11" style="padding:0 3% 3% 3%;">
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center>
                                                                        <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                                                        <i class="fa fa-money" aria-hidden="true" style="font-size:30px;"></i>
                                                                    </center>
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
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center>
                                                                        <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                                                        <i class="fa fa-clock-o" aria-hidden="true" style="font-size:30px;"></i>
                                                                    </center>
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
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="#">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center>
                                                                        <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                                                        <i class="fa fa-credit-card-alt" aria-hidden="true" style="font-size:30px;"></i>
                                                                    </center>
                                                                </div>
                                                            </a>
                                                            <p>Manage payroll</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div style="background-color:#f9fafb;width:80%;" id="dashboardDivs">
                                                <div class="row">
                                                    <div class="col-md-1" style="background-color:#eceef1;padding: 80px 0;border-radius:15px 0 0 15px;">
                                                        <center><h6>Accounting and reports</h6></center>
                                                    </div>
                                                    <div class="col-md-11" style="padding:0 3% 3% 3%;">
                                                        <div align="center" style="display: inline-block;">
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
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="#" class="notification">
                                                                <div id="circle" style="padding:20px 0 ;">
                                                                    <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                                                                    <span class="badge"><b>NEW</b></span>
                                                                </div>
                                                            </a>
                                                            <p>Review transactions</p>
                                                        </div>
                                                        <div align="center" style="display: inline-block;">
                                                            <div class="arrow">
                                                                <!-- <div class="line"></div>
                                                                <div class="point"></div> -->
                                                            </div>
                                                        </div>
                                                        <div align="center" style="display: inline-block;">
                                                            <a href="<?php echo base_url('accounting/reports') ?>">
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
                                            <!-- <br>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>Some QuickBooks Payments deposits weren't automatically recorded. After you receive the funds in your account, record them manually as a Bank Deposit. <a href="#"  style="color:#0077C5;">Take Action </a> </p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>Your customer made a payment more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a> </p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>A bank transfer from your customer received as payment for Invoice 13053 has been canceled due to a problem with their account. To keep your books accurate, you should follow the steps to <a href="#"  style="color:#0077C5;">handle a canceled bank transfer.</a></p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #f2b835;"></i> Alert <br>
                                                    <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: white !important;border: solid #D0D0D0 1px;padding:16px;color: #4c4c4c;width:80%;font-family: Avenir Next forINTUIT, Arial, -apple-system, Helvetica Neue, sans-serif;font-size: 14px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px;color: #0098cd;"></i> Alert <br>
                                                    <p>We just updated the info we share on commercial card transactions. We're now sharing line item details, also known as Level 3 data, with the card companies. This has benefits for both you and your customers. <a href="#"  style="color:#0077C5;">Tell me more</a></p>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:20px;">X</span>
                                                    </button>
                                                </div> -->
                                                <br>
                                            <div class="alert simple-alert">
                                                <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                <a class="close">&times;</a>
                                            </div>

                                            <div class="alert success-alert">
                                                <p>Some nSmarTrac Payments deposits weren't automatically recorded. After you receive the funds in your account, record them manually as a Bank Deposit. <br> <a href="#"  style="color:#0077C5;">Take Action </a> </p>
                                                <a class="close">&times;</a>
                                            </div>

                                            <div class="alert danger-alert">
                                                <p>Your customer made a <a href="#"  style="color:#0077C5;">payment</a> more than the invoice balance, which created a credit. <a href="#"  style="color:#0077C5;">How to apply a credit from an overpayment.</a></p>
                                                <a class="close">&times;</a>
                                            </div>

                                            <div class="alert warning-alert">
                                                <p>A bank transfer from your customer received as payment for Invoice 13053 has been canceled due to a problem with their account. To keep your <br>books accurate, you should follow the steps to <a href="#"  style="color:#0077C5;">handle a canceled bank transfer.</a></p>
                                                <a class="close">&times;</a>
                                            </div>

                                                <br><br>
                                                
                                                <!-- <div class="chart">
                                                    <ul class="bar-chart" data-bars="[4,2],[4,5],[8,3],[4,2],[4,2]" data-max="10" data-unit="k" data-width="24"></ul>
                                                </div> -->


                                                <br>

                                                <div class="page-title-box">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="income tile-container" style="height:580px;">
                                                                <div class="inner-container">
                                                                    <div class="tileContent">
                                                                        <div class="clear">
                                                                            <div class="inner-content">
                                                                                <h6>CASH FLOW</h6>
                                                                                <h4>$100,000</h4>
                                                                                <h6>Current cash balance</h6>

                                                                                <div class="tab" align="right" style="text-align:right;">
                                                                                    <button class="tablinks" onclick="openCity(event, 'London2')">Money in/out</button>
                                                                                    <button class="tablinks" onclick="openCity(event, 'Tokyo2')">Cash balance</button>
                                                                                </div>
                                                                                <div id="London2" class="tabcontent">
                                                                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                                                                    <!-- <canvas id="bar-chart-grouped" width="100%" style="height:370px !important;"></canvas> -->
                                                                                </div>

                                                                                <div id="Tokyo2" class="tabcontent">
                                                                                <!-- <h3>Tokyo</h3> -->
                                                                                    <div id="areaChart" style="height: 370px; width: 100%;"></div>

                                                                                </div>

                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                                                        <!-- <div class="con-label">3</div> -->
                                                                                        <div class="col-12 mb-2">
                                                                                            <div class="nsm-counter h-100">
                                                                                                <div class="row h-100">
                                                                                                    <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                                                                                        <i class="bx bx-receipt"></i>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                                                                                        <span>Open Invoices</span>
                                                                                                        <h2><?php $total = 0; $overdue =0;
                                                                                                            foreach ($upcomingInvoice as $UI) {
                                                                                                                if ($UI->status == "Due" || $UI->status == 'Approved' || $UI->status == 'Partially Paid') {
                                                                                                                    $total++;
                                                                                                                }else if($UI->status == "Overdue"){
                                                                                                                    $overdue++;
                                                                                                                }
                                                                                                            }
                                                                                                            echo $total; ?></h2>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 mb-2">
                                                                                            <div class="nsm-counter h-100">
                                                                                                <div class="row h-100">
                                                                                                    <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                                                                                        <i class="bx bx-calendar-exclamation"></i>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                                                                                        <span>Overdue Invoices</span>
                                                                                                        <h2><?php echo $overdue; ?></h2>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 mb-2">
                                                                                            <div class="nsm-counter success h-100">
                                                                                                <div class="row h-100">
                                                                                                    <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                                                                                        <i class="bx bx-badge-check"></i>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                                                                                        <span>Paid last 30 days</span>
                                                                                                        <h2><?php $totalPaid = 0;
                                                                                                                foreach($upcomingInvoice as $UI){
                                                                                                                    if(date("Y-m-d")>=date("Y-m-d",strtotime($UI->date_updated)) && date("Y-m-d",strtotime("-30 days"))<=date("Y-m-d",strtotime($UI->date_updated)) && $UI->status == "Paid"){
                                                                                                                        $totalPaid++;
                                                                                                                    }
                                                                                                                }
                                                                                                                echo $totalPaid;
                                                                                                        ?></h2>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12">
                                                                                            <div class="nsm-counter yellow h-100">
                                                                                                <div class="row h-100">
                                                                                                    <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                                                                                        <i class="bx bx-box subs"></i>
                                                                                                    </div>
                                                                                                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                                                                                        <span>Subscription</span>
                                                                                                        <h2><?php echo "$".number_format($subs->TOTAL_MMR, 2); ?></h2>
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
                                                                                            <!-- <div class="dropdown" style="position: relative; float: right; display: inline-block;margin-left: 10px;">
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
                                                                                            </div> -->
                                                                                            <?php
                                                                                                // if(!is_null($dynamic_load) && $dynamic_load == true):
                                                                                                //     echo '<div class="col-12 col-lg-4">';
                                                                                                // endif;
                                                                                            ?>
                                                                                            
                                                                                            <!-- <div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true"> -->
                                                                                                <!-- <div class="">
                                                                                                    <div class="">
                                                                                                        <span>Expenses</span>
                                                                                                    </div>
                                                                                                    <div class="nsm-card-controls">
                                                                                                        <div class="dropdown">
                                                                                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                                                                            </a>
                                                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                                                <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                                                                                                                <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                                                                                                            </ul>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> -->
                                                                                                <div class="">
                                                                                                    <?php if($total_expenses > 0) : ?>
                                                                                                    <canvas id="expenses_chart" class="nsm-chart" data-chart-type="expenses"></canvas>
                                                                                                    <?php else : ?>
                                                                                                    <div class="nsm-empty">
                                                                                                    <i class="bx bx-meh-blank"></i>
                                                                                                    <span>There is currently no expenses recorded.</span>
                                                                                                    </div>
                                                                                                    <?php endif; ?>
                                                                                                </div>
                                                                                            <!-- </div> -->

                                                                                            <script type="text/javascript">
                                                                                                $(document).ready(function(){
                                                                                                    initializeExpensesChart();
                                                                                                });

                                                                                                function initializeExpensesChart(){
                                                                                                    var estimates = $("#expenses_chart");

                                                                                                    new Chart(estimates, {
                                                                                                    type: 'doughnut',
                                                                                                    data: {
                                                                                                        labels: <?=$account_names?>,
                                                                                                        datasets: [{
                                                                                                        label: 'Expenses',
                                                                                                        data: <?=$account_expenses?>,
                                                                                                        backgroundColor: [
                                                                                                            'rgba(255, 99, 132, 0.2)',
                                                                                                            'rgba(75, 192, 192, 0.2)',
                                                                                                            'rgba(54, 162, 235, 0.2)',
                                                                                                            'rgba(255, 206, 86, 0.2)',
                                                                                                            'rgb(255, 205, 86, 0.2)',
                                                                                                            'rgba(255, 159, 64, 0.2)',
                                                                                                            'rgba(153, 102, 255, 0.2)',
                                                                                                        ],
                                                                                                        borderColor: [
                                                                                                            'rgba(255, 99, 132, 1)',
                                                                                                            'rgba(75, 192, 192, 1)',
                                                                                                            'rgba(54, 162, 235, 1)',
                                                                                                            'rgba(255, 206, 86, 1)',
                                                                                                            'rgb(255, 205, 86, 1)',
                                                                                                            'rgba(255, 159, 64, 1)',
                                                                                                            'rgba(153, 102, 255, 1)',
                                                                                                        ],
                                                                                                        borderWidth: 1
                                                                                                        }]
                                                                                                    },
                                                                                                    options: {
                                                                                                        responsive: true,
                                                                                                        plugins: {
                                                                                                        legend: {
                                                                                                            position: 'bottom',
                                                                                                        },
                                                                                                        },
                                                                                                        aspectRatio: 1.5,
                                                                                                    }
                                                                                                    });
                                                                                                }
                                                                                            </script>

                                                                                            <?php
                                                                                                if(!is_null($dynamic_load) && $dynamic_load == true):
                                                                                                    echo '</div>';
                                                                                                endif;
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- <div class="expenses-money-section">
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
                                                                                </div> -->
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
                                                                                <!-- <div class="bankList"> -->
                                                                                    <!-- <div class="dgrid-row connectedAccount">
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
                                                                                    </div> -->
                                                                                    <div class="nsm-card-controls">
            <a href="javascript:void(0);" role="button" class="nsm-button btn-sm m-0 me-2 btn-connect-plaid" id="table-modal">
                Connect Bank Account
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">        
        <div class="nsm-widget-table">
            <?php foreach($accounts as $account) { ?>
                <div class="widget-item">
                    <div class="nsm-list-icon">
                        <i class='bx bx-building-house'></i>
                    </div>
                    <div class="content ms-2">
                        <div class="details">
                            <span class="content-title mb-1"><?=$account->name; ?></span>
                            <span class="content-subtitle d-block">Bank balance: $0.00</span>
                            <span class="content-subtitle d-block">In nSmartrac: <?=str_replace("$-", "-$", '$'.number_format(floatval($account->balance), 2, '.', ','))?></span>
                        </div>
                        <div class="controls">
                            <!-- <span class="nsm-badge">Updated 1 day ago</span> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
                                                                                <!-- </div>
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
                                                                                    </div>-->
                                                                                </div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".close").click(function() {
    $(this)
        .parent(".alert")
        .fadeOut();
    });

</script>
<?php include viewPath('v2/includes/footer'); ?>

<!--Morris js Chart-->
<script src="<?php echo $url->assets ?>plugins/morris.js/morris.min.js">
</script>
<script src="<?php echo $url->assets ?>dashboard/js/app.js"></script>

<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
<script>
<?php if( $plaid_handler_open == 1 ){ ?>
$(function(){    
    var linkHandler = Plaid.create({
        env: '<?= PLAID_API_ENV ?>',
        clientName: '<?= $client_name; ?>',
        token: '<?= $plaid_token; ?>',
        product: ['auth','transactions'],
        receivedRedirectUri : window.location.href,
        selectAccount: true,
        onSuccess: function(public_token, metadata) {
            if( public_token != '' ){
                var url = base_url + '_create_plaid_account';
                var account_id = metadata.account.id;
                var ins_id     = metadata.institution.institution_id;
                var ins_name   = metadata.institution.name;
                var meta_data   = JSON.stringify(metadata);
                //console.log('metadata: ' + JSON.stringify(metadata));
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {public_token:public_token,meta_data:meta_data},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ){
                            //load bank details
                            load_plaid_accounts();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }
                    }
                }); 
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'Cannot connect to Plaid. Please try again later.'
                });
            }                        
        },
    });
    linkHandler.open();
});
<?php } ?>
load_plaid_accounts();
function load_plaid_accounts(){
    var url = base_url + '_load_connected_bank_accounts';
    $('.plaid-accounts').html('<span class="bx bx-loader bx-spin"></span>');
    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         success: function(o)
         {          
            $('.plaid-accounts').html(o);
         }
      });
    }, 800);
}
$(document).on('click', '.btn-connect-plaid', function(){
    var url = base_url + '_launch_plaid_accounts';
    var redirect_url = '<?= PLAID_API_REDIRECT_URL_DASHBOARD; ?>';
    $.ajax({
         type: "POST",
         url: url,
         dataType:'json',
         data:{redirect_url:redirect_url},
         success: function(o)
         {          
            if( o.is_valid == 1 ){
                var linkHandler = Plaid.create({
                    env: '<?= PLAID_API_ENV ?>',
                    clientName: o.client_name,
                    token: o.plaid_token,
                    product: ['auth','transactions'],                    
                    selectAccount: true,
                    onSuccess: function(public_token, metadata) {
                        if( public_token != '' ){
                            var url = base_url + '_create_plaid_account';
                            var account_id = metadata.account.id;
                            var ins_id     = metadata.institution.institution_id;
                            var ins_name   = metadata.institution.name;
                            var meta_data   = JSON.stringify(metadata);
                            //console.log('metadata: ' + JSON.stringify(metadata));
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: {public_token:public_token,meta_data:meta_data},
                                dataType:'json',
                                success: function(result) {
                                    if( result.is_success == 1 ){
                                        //load bank details
                                        load_plaid_accounts();
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            html: result.msg
                                        });
                                    }
                                }
                            }); 
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: 'Cannot connect to Plaid. Please try again later.'
                            });
                        }                        
                    },
                });
                linkHandler.open();
            }else{
                var api_connect_url = base_url + 'tools/api_connectors';
                //var html_message = o.msg + "<br />To check your Plaid API credentials click <a href='"+api_connect_url+"'>API Connectors</a>";
                var html_message = o.msg;
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: html_message
                });
            }            
         }
    });
});
</script>