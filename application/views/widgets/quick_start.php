<style>
    .qUickStart{
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#fcfcfc+0,eaeaea+100 */
        background: #fcfcfc; /* Old browsers */
        background: -moz-linear-gradient(top,  #fcfcfc 0%, #eaeaea 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  #fcfcfc 0%,#eaeaea 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#eaeaea',GradientType=0 ); /* IE6-9 */
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
        margin-bottom:15px;
    }
    .qUickStart:last-child{
        margin-bottom:0px;
    }
    .qUickStart .icon{
        background:#2d1a3e !important;
        flex: 0 0 70px;
        height: 70px;
        border-radius: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        color:#fff;
        margin-right: 10px;
    }
    .qUickStart .qUickStartde h4{
        font-size: 16px;
        font-family: Sarabun, sans-serif !important;
        text-transform: uppercase;
        font-weight: 700;
        margin: 0;
        margin-bottom: 0px;
        margin-bottom: 6px;
    }
    .qUickStart .qUickStartde span{
        opacity: 0.6;
    }
</style>
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 header-title mb-4">Quick Start</h4>
            <a href="<?php echo url('/customer/add_lead') ?>">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">A</span>
                    <div class="qUickStartde">
                        <h4>Add a New Client</h4>
                        <span>Sign up a New Client and add to database</span>
                    </div>
                </div>
            </a>
            <br>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_customer">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">B</span>
                    <div class="qUickStartde">
                        <h4>Select an Existing Client</h4>
                        <span>Work with an Existing Client</span>
                    </div>
                </div>
            </a>
            <br>
            <a id="shortcut_link" href="#NewEvent" data-toggle="modal">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">C</span>
                    <div class="qUickStartde">
                        <h4>Select a Quick Link</h4>
                        <span>Customize & Choose from a various quick shortcuts</span>
                    </div>
                </div>
            </a>
            <br>
            <a id="shortcut_link" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">D</span>
                    <div class="qUickStartde">
                        <h4>Add a New Feed</h4>
                        <span>Send a Private Message to particular user</span>
                    </div>
                </div>
            </a>
            <br>
            <a id="shortcut_link" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal2">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">E</span>
                    <div class="qUickStartde">
                        <h4>Add a Newsletter</h4>
                        <span>Send a Company Newsletter to all user</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="modal fade" id="NewEvent" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="addWidgets" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="max-width: 592px; margin-top:230px;">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Quick Links</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body no-padding text-center">
                
                <div class="col-lg-12 no-padding mb-3">
                    <div class="float-left col-lg-3 no-padding text-center pointer">
                        <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/') . '01_print_a_check.png' ?>" />
                        <p>Print a Check</p>
                    </div>
                    <div class="col-lg-3 no-padding float-left text-center pointer">
                        <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/') . '02_process_payment.png' ?>" />
                        <p>Process Payment</p>
                    </div>
                    <div class="col-lg-3 no-padding float-left pointer text-center">
                        <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/') . '04_recieve_payment.png' ?>" />
                        <p>Receive Payments</p>
                    </div>
                    <div class="col-lg-3 no-padding float-left pointer text-center">
                        <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/') . '03_add_invoice.png' ?>" />
                        <p>Add Invoice</p>
                    </div>
                </div>
                <div class="col-lg-12 no-padding mb-3">
                    <div class="float-left col-lg-3 no-padding text-center pointer">
                        <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/') . '01_print_a_check.png' ?>" />
                        <p>Print a Check</p>
                    </div>
                    <div class="col-lg-3 no-padding float-left text-center pointer">
                        <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/') . '02_process_payment.png' ?>" />
                        <p>Process Payment</p>
                    </div>
                    <div class="col-lg-3 no-padding float-left pointer text-center">
                        <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/') . '04_recieve_payment.png' ?>" />
                        <p>Receive Payments</p>
                    </div>
                    <div class="col-lg-3 no-padding float-left pointer text-center">
                        <i style="font-size: 120px; color: gray" class="fa fa-plus-circle add_widget"></i><br />
                        <p>Add a Shortcut</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>