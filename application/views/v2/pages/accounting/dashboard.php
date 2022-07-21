<?php include viewPath('v2/includes/accounting_header'); ?>
<link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/accounting_dashboard.css">

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
                                <div class="col-md-12">
                                    <nav>
                                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color:#666666;display: inline-block;">Get things done</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="color:#666666;display: inline-block;">Business overview</a> 
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <br>
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
                                            </div>

                                            <br><br>

                                            <div style="background-color:#f9fafb;width:80%;border-radius:15px;" id="dashboardDivs">
                                                <div class="row" style="">
                                                    <div class="col-md-1" style="background-color:#eceef1;padding: 80px 0;border-radius:15px 0 0 15px;">
                                                        <center><h6>Money in</h6></center>
                                                    </div>
                                                    <div class="col-md-11" style="padding:0 3% 3% 3%;">
                                                        <div align="center" style="padding:;display: inline-block;">
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
                                                        <div align="center" style="padding:;display: inline-block;">
                                                            <a href="<?php echo base_url('accounting/customers') ?>">
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
                                                            <a href="#" class="ajax-" data-toggle="modal" data-target="#newJobModal">
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
                                                            <a href="<?php echo base_url('accounting/addnewInvoice') ?>" class="notification">
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
                                            <div style="background-color:#f9fafb;width:80%;" id="dashboardDivs">
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
                                            <div style="background-color:#f9fafb;width:80%;" id="dashboardDivs">
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
                                            <br>
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

<?php include viewPath('v2/includes/footer'); ?>