<style>
    .pointer{
        cursor: pointer;
        text-align: center;
    }
    
    .pointer:hover{
        opacity: 0.8;
    }
    
    .pointer p{
        line-height: 15px;
        margin-top: 7px;
        font-size: 11px;
    }
    
    #shotcutsSlide .carousel-indicators{
        border-radius: 50%;
        border-top: 1px solid grey;
        border-bottom: 1px solid grey;
        width: 7px;
        height: 7px;
        background-color: black;
    }
</style>

<div class="tile-container" style="height: 445px;">
    <div class="card no-padding" style="margin-top:0;">
        <div class="card-header">
            <i class="fa fa-dashboard" aria-hidden="true"></i> Shorcuts
        </div>
        <div class="card-body pt-3 pb-0">
            <div id="shortcutsSlide" class="carousel slide" style="" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active text-center">
                        <div class="col-lg-12 no-padding">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'01_print_a_check.png' ?>" />
                                <p>Print a Check</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left text-center pointer">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'02_process_payment.png' ?>" />
                                <p>Process Payment</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'04_recieve_payment.png' ?>" />
                                <p>Receive Payments</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'03_add_invoice.png' ?>" />
                                <p>Add Invoice</p>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'05_add_receipt.png' ?>" />
                                <p>Add Receipt</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'06_add_bill.png' ?>" />
                                <p>Add Bill</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'07_add_sales_tax.png' ?>" />
                                <p>Add Sales Tax</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'08_pay_bill.png' ?>" />
                                <p>Pay Bill</p>
                            </div>
                            
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'09_run_payroll.png' ?>" />
                                <p>Run Payroll</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'10_sync_bank.png' ?>" />
                                <p>Bank Sync</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'11_add_credit_notes.png' ?>" />
                                <p>Add Credit Notes</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            <!-- Indicators -->
            <ul class="carousel-indicators" id="indicator">
                <li data-target="#shortcutsSlide" data-slide-to="0" class="active"></li>
                <li data-target="#shortcutsSlide" data-slide-to="1"></li>
            </ul>
            </div>

        </div>

    </div>
</div>