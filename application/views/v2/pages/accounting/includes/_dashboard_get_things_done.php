<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <br>
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        <p>Your customer made a <a href="#" style="color:#0077C5;" class="ajax-modal" data-view="receive_payment_modal" data-toggle="modal" data-target="#receivePaymentModal">payment</a> more than the invoice balance, which created a credit. 
        <a href="#" class="ajax-modal" style="color:#0077C5;" data-view="credit_memo_modal" data-toggle="modal" data-target="#creditMemoModal">How to apply a credit from an overpayment.</a>

        <p>Some nSmarTrac Payments deposits weren't automatically recorded. After you receive the funds in your account, record them manually as a Bank Deposit. <br> <a href="#" style="color:#0077C5;" class="ajax-modal" data-view="bank_deposit_modal" data-toggle="modal" data-target="#depositModal">Take Action</a></p>

        <p>A bank transfer from your customer received as payment for Invoice 13053 has been canceled due to a problem with their account. To keep your <br>books accurate, you should follow the steps to <a href="#" style="color:#0077C5;" class="ajax-modal" data-view="transfer_modal" data-toggle="modal" data-target="#transferModal">handle a canceled bank transfer.</a></p>
        
    </div>
    <br><br>

    <div style="background-color:#f9fafb;width:80%;border-radius:15px;" id="dashboardDivs">
        <div class="row">
            <div class="col-md-1 horizontal-tab-label"><h6>MONEY IN</h6><hr /></div>
            <div class="col-md-11 horizontal-tab-group" style="padding: 0 9% 0% 3%">
                <div align="center" style="display: inline-block;">
                    <a href="<?php echo base_url('accounting/products-and-services') ?>">
                        <div id="circle" style="padding:20px 0 ;">
                            <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                        </div>
                    </a>
                    <p>Add Products and Services</p>
                </div>
                <div align="center" class="arrow-container">
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
                    <p>Manage Customers</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <div class="line"></div>
                        <div class="point"></div>
                    </div>
                </div>
                <div align="center" style="display: inline-block;">
                    <a href="<?= base_url('estimate'); ?>" class="ajax-" data-toggle="modal" data-target="#newJobModal">
                        <div id="circle" style="padding:20px 0 ;">
                            <center>
                                <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                <i class="fa fa-file" aria-hidden="true" style="font-size:30px;"></i>
                            </center>
                        </div>
                    </a>
                    <p>Create Estimates</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <div class="line"></div>
                        <div class="point"></div>
                    </div>
                </div>
                <div align="center" style="display: inline-block;">
                    <a href="<?php echo base_url('accounting/addnewInvoice'); ?>" class="notification">
                        <div id="circle" style="padding:20px 0 ;">
                            <center>
                                <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                <i class="fa fa-file-text-o" aria-hidden="true" style="font-size:30px;"></i>
                            </center>
                            <!-- <span class="badge"><b>99+</b></span> -->
                        </div>
                    </a>
                    <p>Send Invoices</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <div class="line"></div>
                        <div class="point"></div>
                    </div>
                </div>
                <div align="center" style="display: inline-block;">
                    <a href="#" class="ajax-modal" data-view="receive_payment_modal" data-toggle="modal" data-target="#receivePaymentModal">                                                            
                        <div id="circle" style="padding:20px 0 ;">
                            <center>
                                <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                <i class="fa fa-money" aria-hidden="true" style="font-size:30px;"></i>
                            </center>
                        </div>
                    </a>
                    <p>Receive Payments</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <div class="line"></div>
                        <div class="point"></div>
                    </div>
                </div>
                <div align="center" style="display: inline-block;">
                    <a href="#" class="ajax-modal" data-view="credit_card_credit_modal" data-toggle="modal" data-target="#creditCardCreditModal">
                        <div id="circle" style="padding:20px 0 ;">
                            <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                        </div>
                    </a>
                    <p>Get Funding</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div style="background-color:#f9fafb;width:80%;" id="dashboardDivs">
        <div class="row">
            <div class="col-md-1 horizontal-tab-label"><h6>MONEY OUT</h6><hr /></div>
            <div class="col-md-11 horizontal-tab-group" style="padding: 0 14% 0% 3%">
                <div align="center" style="display: inline-block;">
                    <a href="#" class="ajax-modal" data-view="bill_modal" data-toggle="modal" data-target="#billModal">
                        <div id="circle" style="padding:20px 0 ;">
                            <center>
                                <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                <i class="fa fa-money" aria-hidden="true" style="font-size:30px;"></i>
                            </center>
                        </div>
                    </a>
                    <p>Pay Bills</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <!-- <div class="line"></div>
                        <div class="point"></div> -->
                    </div>
                </div>
                <div align="center" style="display: inline-block;">
                    <a href="<?= base_url('timesheet/employee'); ?>">
                        <div id="circle" style="padding:20px 0 ;">
                            <center>
                                <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                <i class="fa fa-clock-o" aria-hidden="true" style="font-size:30px;"></i>
                            </center>
                        </div>
                    </a>
                    <p>Track Time</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <div class="line"></div>
                        <div class="point"></div>
                    </div>
                </div>
                <div align="center" style="display: inline-block;">
                    <a href="<?= base_url('accounting/payroll-overview'); ?>">
                        <div id="circle" style="padding:20px 0 ;">
                            <center>
                                <!-- <img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /> -->
                                <i class="fa fa-credit-card-alt" aria-hidden="true" style="font-size:30px;"></i>
                            </center>
                        </div>
                    </a>
                    <p>Manage Payroll</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div style="background-color:#f9fafb;width:80%;" id="dashboardDivs">
        <div class="row">
            <div class="col-md-1 horizontal-tab-label"><h6 class="text-long">ACCOUNTING AND REPORTS</h6><hr /></div>
            <div class="col-md-11 horizontal-tab-group" style="padding: 0 14% 0% 3%">                                                    
                <div align="center" style="display: inline-block;">
                    <a href="<?= base_url('accounting/link_bank'); ?>">
                        <div id="circle" style="padding:20px 0 ;">
                            <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                        </div>
                    </a>
                    <p>Business Banking</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <!-- <div class="line"></div>
                        <div class="point"></div> -->
                    </div>
                </div>                                                        
                <div align="center" style="display: inline-block;">
                    <a href="<?= base_url('accounting/expenses'); ?>" class="notification">
                        <div id="circle" style="padding:20px 0 ;">
                            <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                            <!-- <span class="badge"><b>NEW</b></span> -->
                        </div>
                    </a>
                    <p>Review Transactions</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <div class="line"></div>
                        <div class="point"></div>
                    </div>
                </div>                                                        
                <div align="center" style="display: inline-block;">
                    <a href="<?php echo base_url('accounting/reports') ?>">
                        <div id="circle" style="padding:20px 0 ;">
                            <center><img src="<?php echo base_url();?>assets/img/accounting/handProduct.png" class="img-responsive max-85" style="width:40px;" /></center>
                        </div>
                    </a>
                    <p>See Reports and Trends</p>
                </div>
                <div align="center" class="arrow-container">
                    <div class="arrow">
                        <!-- <div class="line"></div>
                        <div class="point"></div> -->
                    </div>
                </div>                                                        
            </div>
        </div>
    </div>
</div>