<?php include viewPath('includes/header_no_navbar'); ?>
<style>
    tr.hide-table-padding td {
        padding: 0;
    }
    svg#svg-sprite-menu-close {
        position: relative;
        bottom: 178px !important;
    }
    .nav-close {
        margin-top: 52% !important;
    }
    .bank-img-container img{
        width:auto !important;
    }
</style>
<div class="wrapper" role="wrapper" style="">
    <div class="container">
            <div class="row">
            <div class="col-md-12">
                <div class="full-screen-modals">
                <div id="addAccountModals">
                    <div class="modal-dialogs">
                        <!-- Modal content-->
                        <div class="modal-content" style="height: 100%;">
                            <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                                <h4 class="modal-title">Connect an account</h4>
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="container modal-container accounts-list">
                                    <div class="header-modal"><h3>Let's get a picture of your profits</h3></div>
                                    <div class="sub-header-modal"><span>Connect your bank or credit card to bring in your transactions.</span></div>
                                    <div class="body-modal">
                                        <input type="text" class="form-control" placeholder="Enter your bank name or URL" style=" margin: 40px 0 50px 0;">
                                        <div class=""><span>Here are some of the most popular ones</span></div>
                                        <div class="row">

                                            <div class="fdx-recommended-entities-cell-left">
                                                <div class="fdx-entity-container" id="fdx-entity-row-num-1-0">
                                                    <a href="#">
                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f">
                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" title="Capital One" alt="Capital One">
                                                            </div>
                                                            <div class=""></div>
                                                        </div>
                                                        <div class="fdx-recommended-entity-desc-container">
                                                            <label class="fdx-recommended-entity-name" title="Capital One">Stripe Corporate Credit Card</label>
                                                            <label class="fdx-recommended-entity-desc">stripe.com</label>
                                                        </div>
                                                    </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <br><br>

                                            <style>
                                                .fdx-entity-container-button:hover {
                                                    border-color: #45a73c !important;
                                                    border:  2px;
                                                    border-style: solid;
                                                }
                                                .fdx-recommended-entities-cell-left {
                                                    width: 50%;
                                                    display: flex;
                                                    justify-content: flex-start;
                                                }
                                                .fdx-entity-container {
                                                    display: flex;
                                                    flex: 1 1 auto;
                                                    justify-content: center;
                                                    max-width: 98%;
                                                }
                                                .fdx-provider-logo-wrapper-small {
                                                    width: 100px;
                                                    height: 100px;
                                                }
                                                .fdx-entity-container-button {
                                                    position: relative;
                                                    margin-bottom: 12px;
                                                    padding: 12px;
                                                    width: 100%;
                                                    height: 74px;
                                                    display: flex;
                                                    -moz-align-items: left;
                                                    align-items: left;
                                                    justify-content: flex-start;
                                                    border-radius: 8px;
                                                    border: 1px solid #eaecee;
                                                    box-sizing: border-box;
                                                    box-shadow: 0px 1px 8px rgb(0 0 0 / 8%);
                                                    cursor: pointer;
                                                    background-color: transparent;
                                                }
                                                .fdx-provider-logo-container-small {
                                                    min-width: 48px;
                                                    min-height: 48px;
                                                    width: 48px;
                                                    height: 48px;
                                                }
                                                .fdx-recommended-entity-desc-container {
                                                    height: 40px;
                                                    display: flex;
                                                    -moz-align-items: flex-start;
                                                    align-items: flex-start;
                                                    justify-content: center;
                                                    -moz-flex-direction: column;
                                                    flex-direction: column;
                                                    margin: auto 100px;
                                                    box-sizing: border-box;
                                                    overflow: hidden;
                                                    flex: 1 1;
                                                }
                                                .fdx-recommended-entity-name {
                                                    width: 100%;
                                                    height: 24px;
                                                    font-weight: 600;
                                                    font-size: 16px;
                                                    padding-bottom: 4px;
                                                    -webkit-margin-before: 0;
                                                    margin-block-start: 0;
                                                    -webkit-margin-after: 0;
                                                    margin-block-end: 0;
                                                    text-align: left;
                                                    margin-bottom: 0;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    cursor: inherit;
                                                    white-space: nowrap;
                                                    box-sizing: border-box;
                                                }
                                                .fdx-recommended-entity-desc {
                                                    min-height: 18px;
                                                    font-size: 12px;
                                                    -webkit-margin-before: 0px;
                                                    margin-block-start: 0px;
                                                    -webkit-margin-after: 0px;
                                                    margin-block-end: 0px;
                                                    text-align: left;
                                                    color: #6b6c72;
                                                    white-space: nowrap;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    font-weight: 400;
                                                    cursor: inherit;
                                                }
                                            </style>
                                        </div>
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
                                                <div class="bank-img-container clk-paypal">
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
                                <div class="container modal-container paypal-container" style="display:none">
                                    <form id="save-paypal-account">
                                        <div class="row justify-content-md-center align-items-center pt-3">
                                            <div class="col-md-5 col-sm-6 col-xs-12">
                                                <h5 class="close-paypal-container text-right text-secondary" style="cursor:pointer;"><i class="fa fa-times fa-lg"></i></h5>
                                                <p class="text-center"><img class="banks-img img-fluid mx-auto" style="width:125px" src="<?php echo base_url('assets/img/accounting/paypal_PNG20.png') ?>" alt=""></p>

                                                <div class="header-modal text-center"><h3>Add PayPal Credentials</h3></div>
                                                <div class="form-group pt-3">
                                                    <label for="paypal_email">PayPal Email</label>
                                                    <input type="text" class="form-control" name="paypal_email" id="paypal_email" required="" placeholder="Enter Your PayPal Email" autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center align-items-center pb-5">
                                            <div class="col-md-3 col-sm-4 col-xs-12">
                                                <button type="submit" name="save" class="btn btn-success btn-block">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="container modal-container stripe-container" style="display:none">
                                    <form id="save-stripe-account">
                                        <div class="row justify-content-md-center align-items-center pt-3">
                                            <div class="col-md-5 col-sm-6 col-xs-12">
                                                <h5 class="close-stripe-container text-right text-secondary" style="cursor:pointer;"><i class="fa fa-times fa-lg"></i></h5>
                                                <p class="text-center"><img class="banks-img img-fluid mx-auto" style="width:150px" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" alt=""></p>

                                                <div class="header-modal text-center"><h3>Add Stripe Credentials</h3></div>
                                                <div class="form-group pt-3">
                                                    <label for="stripe_email">Stripe Email</label>
                                                    <input type="text" class="form-control" name="stripe_email" id="stripe_email" required="" placeholder="Enter Your Stripe Email" autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="publish_key">Stripe Publish Key</label>
                                                    <input type="text" class="form-control" name="publish_key" id="publish_key" required="" placeholder="Enter Your Publish Key" autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="secret_key">Stripe Secret Key</label>
                                                    <input type="text" class="form-control" name="secret_key" id="secret_key" required="" placeholder="Enter Your Secret Key" autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center align-items-center pb-5">
                                            <div class="col-md-3 col-sm-4 col-xs-12">
                                                <button type="submit" name="save" class="btn btn-success btn-block">Save</button>
                                            </div>
                                        </div>
                                    </form>
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
            </div>
            </div>
            </div>
        </div>

</div>