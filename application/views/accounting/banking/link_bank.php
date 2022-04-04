<?php include viewPath('includes/header_no_navbar'); ?>
<script src="https://js.stripe.com/v3/"></script>

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

    .bank-img-container img {
        width: auto !important;
    }
</style>
<style>
    .fdx-entity-container-button:hover {
        border-color: #45a73c !important;
        border: 2px;
        border-style: solid;
    }

    .fdx-entity-container {
        display: flex;
        flex: 1 1 auto;
        justify-content: center;
        max-width: 98%;
    }

    .fdx-provider-logo-wrapper-small {
        width: 50px;
        height: 50px;
    }

    .fdx-entity-container-button {
        position: relative;
        margin-bottom: 12px;
        padding: 12px;
        width: 500px;
        height: 74px;
        display: flex;
        justify-content: space-around;
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

    .fdx-provider-logo {
        width: 100%;
        height: auto;
    }

    .fdx img {
        border: 0;
    }

    .fdx img {
        background: transparent !important;
    }

    .fdx-provider-logo-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-block+.btn-block {
        margin-top: 0 !important;
    }

    button#another-account {
        background: transparent;
        border: solid 1px;
        border-radius: 9px;
        padding: 4px 26px;
        transition: 0.5s;
    }

    button#another-account:hover {
        background: #e8e8e8;
    }

    button.style:hover {
        font-size: 18px;
    }

    button.style {
        background: transparent;
        border: none;
        border-radius: 9px;
        padding: 4px 12px;
        transition: 0.5s;
    }

    button#back {
        background: transparent;
        border: solid 1px;
        border-radius: 9px;
        padding: 4px 26px;
        transition: 0.5s;
    }

    button#back:hover {
        background: #e8e8e8;
    }
</style>
<style>
    #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    .disableds {
        background-color: #1b1e21;
    }

    .row.justify-content-md-center.align-items-center.pt-3.padd {
        padding-top: 49px !important;
        padding-bottom: 49px !important;
    }

    .col-md-12.justify-content-md-center {
        text-align: center;
        margin-top: 45px;
    }
</style>
<div id="overlay">
    <div>
        <img src="<?= base_url() ?>assets/images/uploading.gif" class="" style="width: 80px;" alt="" />
        <center>
            <p id="overlay_message">Processing...</p>
        </center>
    </div>
</div>

<div class="wrapper" role="wrapper" style="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full-screen-modals">
                    <div id="addAccountModal">
                        <div class="modal-dialogs">
                            <!-- Modal content-->
                            <div class="modal-content" style="height: 100%;">
                                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                                    <h4 class="modal-title">Connect an account</h4>
                                    <a href="<?= base_url('accounting/link_bank') ?>"><button type="button" class="close"><i class="fa fa-times fa-lg"></i></button></a>
                                </div>
                                <div class="modal-body">
                                    <div class="container modal-container accounts-list">
                                        <div class="header-modal">
                                            <h3>Let's get a picture of your profits</h3>
                                        </div>
                                        <div class="sub-header-modal"><span>Connect your bank or credit card to bring in your transactions.</span></div>
                                        <div class="body-modal">
                                            <input type="text" class="form-control" placeholder="Enter your bank name or URL" style=" margin: 40px 0 50px 0;">
                                            <div class=""><span>Here are some of the most popular ones</span></div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container click-stripe" id="open_stripe">
                                                                <a href="javascript:void(0)">
                                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f">
                                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" title="Stripe" alt="Stripe">
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
                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container">
                                                                <a href="#">
                                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f" disabled>
                                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/citibank.png') ?>" title="CitiBusiness" alt="CitiBusiness">
                                                                            </div>
                                                                            <div class=""></div>
                                                                        </div>
                                                                        <div class="fdx-recommended-entity-desc-container">
                                                                            <label class="fdx-recommended-entity-name" title="Capital One">CitiBusiness Online</label>
                                                                            <label class="fdx-recommended-entity-desc">www.citibank.com</label>
                                                                        </div>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container click-bankOfAmerica">
                                                                <a href="#">
                                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f">
                                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/bank_america.png') ?>" title="Bank Of America" alt="Bank Of America">
                                                                            </div>
                                                                            <div class=""></div>
                                                                        </div>
                                                                        <div class="fdx-recommended-entity-desc-container">
                                                                            <label class="fdx-recommended-entity-name" title="Capital One">Bank Of America</label>
                                                                            <label class="fdx-recommended-entity-desc">It's popular in your area</label>
                                                                        </div>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container">
                                                                <a href="#">
                                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f" disabled>
                                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/co-1200.png') ?>" title="Capital One" alt="Capital One">
                                                                            </div>
                                                                            <div class=""></div>
                                                                        </div>
                                                                        <div class="fdx-recommended-entity-desc-container">
                                                                            <label class="fdx-recommended-entity-name" title="Capital One">Capital One</label>
                                                                            <label class="fdx-recommended-entity-desc">From your transactions</label>
                                                                        </div>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container">
                                                                <a href="#">
                                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f" disabled>
                                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/pncbank_pms_c.png') ?>" title="PNC Bank" alt="PNC Bank">
                                                                            </div>
                                                                            <div class=""></div>
                                                                        </div>
                                                                        <div class="fdx-recommended-entity-desc-container">
                                                                            <label class="fdx-recommended-entity-name" title="Capital One">PNC Bank</label>
                                                                            <label class="fdx-recommended-entity-desc">www.pnc.com</label>
                                                                        </div>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container click-paypal" id="fdx-entity-row-num-1-0">
                                                                <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f">
                                                                    <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                        <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                            <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/paypal.png') ?>" title="Paypal" alt="Paypal">
                                                                        </div>
                                                                        <div class=""></div>
                                                                    </div>
                                                                    <div class="fdx-recommended-entity-desc-container">
                                                                        <label class="fdx-recommended-entity-name" title="Capital One">Connect to Paypal</label>
                                                                        <label class="fdx-recommended-entity-desc">It's popular in your area</label>
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container" id="fdx-entity-row-num-1-0">
                                                                <a href="#">
                                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f" disabled>
                                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/chase.jpg') ?>" title="Paypal" alt="Paypal">
                                                                            </div>
                                                                            <div class=""></div>
                                                                        </div>
                                                                        <div class="fdx-recommended-entity-desc-container">
                                                                            <label class="fdx-recommended-entity-name" title="Capital One">Chase Bank</label>
                                                                            <label class="fdx-recommended-entity-desc">It's popular in your area</label>
                                                                        </div>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container" id="fdx-entity-row-num-1-0">
                                                                <a href="#">
                                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f" disabled>
                                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/Wells_Fargo.png') ?>" title="Wells Fargo" alt="Wells Fargo">
                                                                            </div>
                                                                            <div class=""></div>
                                                                        </div>
                                                                        <div class="fdx-recommended-entity-desc-container">
                                                                            <label class="fdx-recommended-entity-name" title="Capital One">Wells Fargo</label>
                                                                            <label class="fdx-recommended-entity-desc">It's popular in your area</label>
                                                                        </div>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="fdx-entity-container click-usBank" id="fdx-entity-row-num-1-0">
                                                                <a href="#">
                                                                    <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f">
                                                                        <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                            <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                                <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/us-bank-logo-vector.png') ?>" title="US Bank" alt="US Bank">
                                                                            </div>
                                                                            <div class=""></div>
                                                                        </div>
                                                                        <div class="fdx-recommended-entity-desc-container">
                                                                            <label class="fdx-recommended-entity-name" title="Capital One">US Bank</label>
                                                                            <label class="fdx-recommended-entity-desc">It's popular in your area</label>
                                                                        </div>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container modal-container stripe-container" style="display:none">
                                        <div class="row justify-content-md-center align-items-center pt-3">
                                            <div class="col-md-5 col-sm-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="fdx-entity-container">
                                                            <a href="javascript:void;">
                                                                <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f">
                                                                    <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                        <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                            <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" title="Stripe" alt="Stripe">
                                                                        </div>
                                                                        <div class=""></div>
                                                                    </div>
                                                                    <div class="fdx-recommended-entity-desc-container">
                                                                        <label class="fdx-recommended-entity-name" title="Capital One">Stripe Corporate Credit Card</label>
                                                                        <label class="fdx-recommended-entity-desc">https://stripe.com/corporate-card</label>
                                                                    </div>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form method="post" id="stripe_form" style="display:none;">
                                                    <div class="col-md-12 form-group">
                                                        <label for=""><b>Account Name</b></label><br>
                                                        <input type="text" class="form-control" name="account_name" id="account_name" required="">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for=""><b>Publish Key</b></label><br>
                                                        <input type="text" class="form-control" name="stripe_publish_key" id="stripe_publish" required="">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for=""><b>Secret Key</b></label><br>
                                                        <input type="text" class="form-control" name="stripe_secret_key" id="" required="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="modal-footer close-modal-footer">
                                                            <button type="button" class="btn btn-default btn-block close-stripe-container">Back</button>
                                                            <button type="submit" class="btn btn-success btn-block" id="">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form method="post" id="stripe_form_edit" style="display:none;">
                                                    <div class="col-md-12 form-group">
                                                        <label for=""><b>Account Name</b></label><br>
                                                        <input type="text" class="form-control" name="account_name" id="account_name" required="">
                                                        <input type="text" class="form-control" name="id" id="id" style="display: none;">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for=""><b>Publish Key</b></label><br>
                                                        <input type="text" class="form-control" name="stripe_publish_key" id="stripe_publish" required="">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for=""><b>Secret Key</b></label><br>
                                                        <input type="text" class="form-control" name="stripe_secret_key" id="" required="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="modal-footer close-modal-footer">
                                                            <button type="button" class="btn btn-default btn-block close-stripe-container">Back</button>
                                                            <button type="submit" class="btn btn-success btn-block" id="">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div id="list-linked-accounts" style="display:none;">
                                                    <div id="accounts"></div>
                                                    <div class="col-md-12 justify-content-md-center">
                                                        <button id="another-account"><i class="fa fa-plus" aria-hidden="true"></i> add another account</button><br><br>
                                                        <button id="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> back</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container modal-container paypal-container" style="display:none">
                                        <div class="row justify-content-md-center align-items-center pt-3">
                                            <div class="col-md-5 col-sm-6 col-xs-12">
                                                <div class="header-modal text-center">
                                                    <h4>Setup Paypal</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="fdx-entity-container">
                                                            <center><a href="javascript:void;">
                                                                    <img style="width: 57%;margin:0 auto;margin-bottom: 10px;" class="fdx-provider-logo" src="<?php echo base_url('assets/img/paypal-logo.png') ?>" title="Paypal" alt="Stripe">
                                                                    <div class="fdx-recommended-entity-desc-container">
                                                                        <label class="fdx-recommended-entity-desc">https://www.paypal.com</label>
                                                                    </div>
                                                                </a></center>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <span><i class="fa fa-info-circle fa-lg"></i>Enter your paypal token / keys to accept paypal payment</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center align-items-center pb-5">
                                            <form method="post" id="paypal_form">
                                                <div class="col-md-12 form-group">
                                                    <label for=""><b>Client ID</b></label><br>
                                                    <input type="text" class="form-control" name="paypal_client_id" id="" required="" placeholder="" autofocus="">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for=""><b>Secret Key</b></label><br>
                                                    <input type="text" class="form-control" name="paypal_secret_key" id="" required="" placeholder="" autofocus="">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="modal-footer close-modal-footer">
                                                        <button type="button" class="btn btn-default btn-block close-paypal-container">Back</button>
                                                        <button type="submit" class="btn btn-success btn-block">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="container modal-container bankOfAmerica-container" style="display:none">
                                    <div class="row justify-content-md-center align-items-center pt-3 padd">
                                        <div class="col-md-5 col-sm-6 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="fdx-entity-container">
                                                        <a href="#">
                                                            <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f">
                                                                <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                    <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                        <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/bank_america.png') ?>" title="Bank Of America" alt="Bank Of America">
                                                                    </div>
                                                                    <div class=""></div>
                                                                </div>
                                                                <div class="fdx-recommended-entity-desc-container">
                                                                    <label class="fdx-recommended-entity-name" title="Capital One">Bank Of America</label>
                                                                    <label class="fdx-recommended-entity-desc">It's popular in your area</label>
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="post" id="bankOfAmerica">
                                                <div class="col-md-12 form-group">
                                                    <label for=""><b>USER ID</b></label><br>
                                                    <input type="text" class="form-control" name="stripe_publish_key" id="" required="">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for=""><b>PASSWORD KEY</b></label><br>
                                                    <input type="text" class="form-control" name="stripe_secret_key" id="" required="">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="modal-footer close-modal-footer">
                                                        <button type="button" class="btn btn-default btn-block close-bankOfAmerica-container">Back</button>
                                                        <button type="submit" class="btn btn-success btn-block" id="">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                                <div class="container modal-container usBank-container" style="display:none">
                                    <div class="row justify-content-md-center align-items-center pt-3 padd">
                                        <div class="col-md-5 col-sm-6 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="fdx-entity-container">
                                                        <a href="#">
                                                            <button tabindex="0" class="fdx-entity-container-button" data-di-id="di-id-e786b9cc-bb63c05f">
                                                                <div class="fdx-provider-logo-container fdx-provider-logo-container-small fdx-provider-logo-container-fade fdx-provider-image-loaded fdx-provider-logo-container-outline">
                                                                    <div class="fdx-provider-logo-wrapper fdx-provider-logo-wrapper-small fdx-provider-logo-wrapper-circular fdx-reimagine-entity-logo">
                                                                        <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/us-bank-logo-vector.png') ?>" title="US Bank" alt="US Bank">
                                                                    </div>
                                                                    <div class=""></div>
                                                                </div>
                                                                <div class="fdx-recommended-entity-desc-container">
                                                                    <label class="fdx-recommended-entity-name" title="Capital One">US Bank</label>
                                                                    <label class="fdx-recommended-entity-desc">It's popular in your area</label>
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="post" id="usBank">
                                                <div class="col-md-12 form-group">
                                                    <label for=""><b>USER ID</b></label><br>
                                                    <input type="text" class="form-control" name="stripe_publish_key" id="" required="">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for=""><b>PASSWORD KEY</b></label><br>
                                                    <input type="text" class="form-control" name="stripe_secret_key" id="" required="">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="modal-footer close-modal-footer">
                                                        <button type="button" class="btn btn-default btn-block close-usBank-container">Back</button>
                                                        <button type="submit" class="btn btn-success btn-block" id="">Save</button>
                                                    </div>
                                                </div>
                                            </form>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!--    Modal for creating rules-->
<div class="modal-right-side createRuleModalRight" id="createRuleModalRight">
    <div class="modal right fade" id="createRules" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel2">Create rule</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="addRuleForm">
                    <div class="modal-body">

                        <div class="formError">
                            <div class="formError__inner">
                                <i class="fa fa-info-circle"></i>
                                <p>Something’s not quite right</p>
                            </div>
                        </div>

                        <div class="subheader">Rules only apply to unreviewed transactions.</div>
                        <div class="form-group">
                            <label>What do you want to call this rule? *</label>
                            <input required type="text" name="rules_name" class="form-control" placeholder="Name this rule" data-type="rules_name">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Apply this to transactions that are</label>
                            </div>
                            <div class="createRuleModalRight__transactions">
                                <div class="tab-select">
                                    <select name="apply_type" class="form-control" data-type="apply_type">
                                        <option selected>Money in</option>
                                        <option>Money out</option>
                                    </select>
                                </div>
                                <span style="margin-right: 5px;margin-left: 5px;">in</span>
                                <div class="tab-select">
                                    <select name="apply_type" class="form-control" data-type="apply_type" required="">
                                        <option value="">Select Bank Account</option>
                                        <option value="all-bank-account">All bank accounts</option>
                                        <option value="checking">Checking</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="position: relative;display: inline-block;">and include the following:</label>
                            <select name="include" class="form-control inline-select" data-type="include">
                                <option selected>All</option>
                                <option>Any</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="addCondition-container">
                                <div id="addCondition" class="addCondition">
                                    <div class="tab-select">
                                        <input type="hidden" id="counterCondition" value="1">
                                        <select name="description[]" class="form-control" data-type="conditions.description">
                                            <option selected>Description</option>
                                            <option>Bank text</option>
                                            <option>Amount</option>
                                        </select>
                                    </div>
                                    <div class="tab-select">
                                        <select name="contain[]" class="form-control" style="max-width: 140px" data-type="conditions.contain">
                                            <option selected>Contain</option>
                                            <option>Doesn't contain</option>
                                            <option>Is exactly</option>
                                        </select>
                                    </div>
                                    <div class="tab-select" style="max-width: 140px">
                                        <input required type="text" name="comment[]" class="form-control" placeholder="Enter Text" data-type="conditions.comment">
                                    </div>
                                    <div class="tab-select deleteCondition" id="deleteCondition" style="display: none;">
                                        <a href="#" id="btnDeleteCondition"><i class="fa fa-trash fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 15px;">
                                <a href="#" id="btnAddCondition" style="color: #0b62a4;"><i class="fa fa-plus"></i> Add a condition</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Then assign</label>
                            <div class="action-section">
                                <span class="action-label">Transaction type</span>
                                <select name="trans_type" class="form-control" data-type="assignments.transaction_type">
                                    <option selected>Expenses</option>
                                    <option>Transfer</option>
                                    <option>Check</option>
                                </select>
                            </div>
                            <div class="action-section">
                                <div id="categoryDefault">
                                    <span class="action-label" style="margin-right: 70px">Category</span>
                                    <div style="width: 220px;display: inline-block;">
                                        <select name="category[]" id="mainCategory" class="form-control select2-rules-category" data-type="assignments.category" data-main-category="true" required>
                                            <!-- <option></option>
                                            <option disabled>&plus; Add new</option>
                                            <option>Advertising</option>
                                            <option>Bad Debts</option>
                                            <option>Bank Charges</option> -->
                                        </select>
                                    </div>
                                    <span class="action-label d-none" style="margin-left: 5px;"><a href="#" id="btnAddSplit" style="color: #0b62a4;">Add split</a></span>
                                </div>
                                <!--Add Split Div-->
                                <div class="add-split-container">
                                    <div class="add-split-section">
                                        <div class="split-header" style="margin-bottom: 12px;font-weight: bold">
                                            Split detail #<span class="splitNum">1</span>
                                            <a href="#" id="deleteSplitLine" style="float: right;right: 0;position: absolute;"><i class="fa fa-trash fa-lg"></i></a>
                                        </div>
                                        <div class="split-content">
                                            <span class="split-category-text">Percentage</span>
                                            <input type="number" name="percentage[]" class="form-control" style="width: 205px" data-type="assignments.category_percent" required>
                                        </div>
                                        <div class="split-content">
                                            <span class="split-category-text">Category</span>
                                            <div style="width: 220px;display: inline-block;">
                                                <select name="category[]" class="form-control select2-rules-category" data-type="assignments.category" required>
                                                    <option></option>
                                                    <option>Advertising</option>
                                                    <option>Bad Debts</option>
                                                    <option>Bank Charges</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr id="border-category">
                                    </div>
                                    <div class="add-split-section">
                                        <div class="split-header" style="margin-bottom: 12px;font-weight: bold">
                                            Split detail #<span class="splitNum">2</span>
                                            <a href="#" id="deleteSplitLine" style="float: right;right: 0;position: absolute;"><i class="fa fa-trash fa-lg"></i></a>
                                        </div>
                                        <div class="split-content">
                                            <span class="split-category-text">Percentage</span>
                                            <input type="number" name="percentage[]" class="form-control" style="width: 205px" data-type="assignments.category_percent" required>
                                        </div>
                                        <div class="split-content">
                                            <span class="split-category-text">Category</span>
                                            <div style="width: 220px;display: inline-block;">
                                                <select name="category[]" class="form-control select2-rules-category" data-type="assignments.category" required>
                                                    <option></option>
                                                    <option>Advertising</option>
                                                    <option>Bad Debts</option>
                                                    <option>Bank Charges</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr id="border-category">
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 10px;margin-bottom: 10px;">
                                <a href="#" id="btnAddLine" style="color: #0b97c4;display: none;">Add a line</a>
                            </div>
                            <div class="action-section">
                                <span class="action-label">Payee</span>
                                <div style="width: 220px;display: inline-block;">
                                    <select name="payee" class="form-control select2-rules-payee" data-type="assignments.payee">
                                        <!-- <option></option>
                                        <option>Abacus Accounting</option>
                                        <option>Absolute Power</option>
                                        <option>ADSC</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="action-section">
                                <span class="action-label">Tags</span>
                                <div style="width: 220px;display: inline-block;">
                                    <select id="accountingRulesTags" name="tags" class="form-control" data-type="assignments.tags" multiple="multiple">
                                    </select>
                                </div>
                            </div>
                            <div class="action-section" id="assignMore" style="display: none;">
                                <span class="action-label">Add memo</span>
                                <textarea name="memo" cols="30" rows="5" placeholder="Enter Text" style="resize: none;" data-type="memo"></textarea>
                            </div>
                            <div style="margin-top: 15px;">
                                <a href="#" id="btnAssignMore" style="color: #0b62a4;"><i class="fa fa-plus"></i> Assign more</a>
                            </div>
                            <div style="margin-top: 15px;">
                                <a href="#" style="display: none;color: #0b62a4;" id="btnClear"><i class="fa fa-trash"></i> Clear</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Automatically confirm transactions this rule applies to</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="auto" class="custom-control-input" id="autoAddswitch" data-type="auto">
                                <label class="custom-control-label" for="autoAddswitch">Auto-add</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" data-action="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--    end of modal-->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">Copyright © 2020 nSmartrac. All rights reserved.</div>
        </div>
    </div>
</footer><!-- End Footer -->


<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<!-- jQuery  -->

<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/jquery-initialize/jquery.initialize.min.js">
</script>
<script src="<?php echo $url->assets ?>js/custom.js"></script>
<script src="<?php echo $url->assets ?>js/folders_files.js"></script>
<script src="<?php echo $url->assets ?>js/add.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/waves.min.js"></script>

<script src="<?php echo $url->assets ?>dashboard/js/app.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!--Accounting JS-->
<?php echo put_footer_assets(); ?>

<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?>;
</script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    $('open_stripe').click(function() {
        const openWin = window.open('https://connect.stripe.com/oauth/v2/authorize?response_type=code&client_id=ca_KBQqImsoRKsn8QTIvr9DdP0dH37hPQ3Y&scope=read_write', 'Ratting', 'width=550,height=650,left=450,top=200,toolbar=0,status=0');
        var timer = setInterval(function() {
            if (openWin.closed) {
                clearInterval(timer);
                fetch('<?= base_url() ?>api/check_stripe_api_connected').then(function(response) {
                    return response.json();
                }).then(function(data) {
                    console.log(data);
                }).catch(function() {
                    console.log("Booo");
                });
            }
        }, 1000);
    });
    $('#another-account').click(function() {
        $("#stripe_form input[name='account_name']").val("");
        $("#stripe_form input[name='stripe_publish_key']").val("");
        $("#stripe_form input[name='stripe_secret_key']").val("");
        $('.stripe-container #list-linked-accounts').hide();
        $('.stripe-container #stripe_form').show();

    })
    $('#back').click(function() {
        $('.stripe-container #stripe_form_edit').hide();
        $('.stripe-container #stripe_form').hide();
        $('.stripe-container').hide();
        $('.accounts-list').show();
        $('.stripe-container #list-linked-accounts').show();
        $('.bankOfAmerica-container').hide();
    })
    $('.click-stripe').click(function() {
        $.ajax({
            url: "<?= base_url() ?>api/get_stripe_acc",
            type: "POST",
            dataType: "json",
            data: {},
            success: function(data) {

                var html = "";
                if (data.stripeAcc.length != 0) {
                    for (var index = 0; index < data.stripeAcc.length; index++) {
                        html += `
                            <div class="col-md-12">
                                <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" title="Stripe" alt="Stripe">
                                        </div>
                                        <div class="col-md-5">
                                            <h6>` + data.stripeAcc[index]['account_name'] + `</h6>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="style ebutton" id="` + data.stripeAcc[index]['id'] + `">edit</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="style dbutton"id="` + data.stripeAcc[index]['id'] + `">delete</button>
                                        </div>
                                    </div>
                                <hr>
                            </div>`;
                    }
                    $('.stripe-container #list-linked-accounts #accounts').html(html);
                    $('.accounts-list').hide();
                    $('.stripe-container').show();
                    $('.bankOfAmerica-container').hide();
                    $('.stripe-container #list-linked-accounts').show();
                }




            }
        });



    });
    $(document).on("click", "#list-linked-accounts #accounts .dbutton", function() {
        var id = $(this).attr("id");
        console.log(id);
        location.reload();
        $.ajax({
            url: "<?= base_url() ?>api/delete_stripe_acc",
            type: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {
                
            }
        });
    });


    $(document).on("click", "#list-linked-accounts #accounts .ebutton", function() {
        var id = $(this).attr("id");
        console.log(id);
        $('.stripe-container #list-linked-accounts').hide();
        $('.stripe-container #stripe_form_edit').fadeIn();

        $.ajax({
            url: "<?= base_url() ?>api/get_stripe_acc_cond",
            type: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {
                console.log(data.account[0]['account_name']);
                $("#stripe_form_edit input[name='id']").val(data.account[0]['id']);
                $("#stripe_form_edit input[name='account_name']").val(data.account[0]['account_name']);
                $("#stripe_form_edit input[name='stripe_publish_key']").val(data.account[0]['stripe_publish_key']);
                $("#stripe_form_edit input[name='stripe_secret_key']").val(data.account[0]['stripe_secret_key']);

            }
        });
    });
    $('.close-stripe-container').click(function() {
        $('.stripe-container #stripe_form_edit').hide();
        $('.stripe-container #stripe_form').hide();
        $('.stripe-container').show();
        $('.stripe-container #list-linked-accounts').show();
        $('.bankOfAmerica-container').hide();


    });
    $('.click-bankOfAmerica').click(function() {
        $('.modal-body').hide();
        $('.accounts-list').hide();
        $('.stripe-container').hide();
        $('.bankOfAmerica-container').show();
    });
    $('.close-bankOfAmerica-container').click(function() {
        $('.bankOfAmerica-container').hide();
        $('.modal-body').show();
        $('.paypal-container').hide();
        $('.accounts-list').show();
    });
    $('.click-usBank').click(function() {
        $('.bankOfAmerica-container').hide();
        $('.modal-body').hide();
        $('.accounts-list').hide();
        $('.usBank-container').show();
    });
    $('.close-usBank-container').click(function() {
        $('.bankOfAmerica-container').hide();
        $('.usBank-container').hide();
        $('.modal-body').show();
        $('.paypal-container').hide();
        $('.accounts-list').show();
    });

    $('.click-paypal').click(function() {

        $.ajax({
            url: "<?= base_url() ?>api/get_paypal_acc",
            type: "POST",
            dataType: "json",
            data: {},
            success: function(data) {
                $("#paypal_form input[name='paypal_client_id']").val(data.paypalAcc[0]['paypal_client_id']);
                $("#paypal_form input[name='paypal_secret_key']").val(data.paypalAcc[0]['paypal_secret_key']);


                $('.accounts-list').hide();
                $('.paypal-container').show();
            }
        });

    });
    $('.close-paypal-container').click(function() {
        $('.paypal-container').hide();
        $('.accounts-list').show();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#paypal_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>api/if_paypalAcc_of_company_exist",
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $("#overlay_message").text('Saving credentials...');
                    document.getElementById('overlay').style.display = "flex";
                },
                success: function(data) {
                    if (data === "1") {
                        nsmartrac_alert('Nice!', 'Paypal crendentials saved!', 'success');
                    }
                    document.getElementById('overlay').style.display = "none";
                    $('.paypal-container').hide();
                    $('.accounts-list').show();
                }
            });
        });

        $("#stripe_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>api/if_stripeAcc_of_company_exist",
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $("#overlay_message").text('Saving Stripe Credentials...');
                    document.getElementById('overlay').style.display = "flex";
                },
                success: function(data) {


                    nsmartrac_alert('Nice!', 'Stripe Crendentials Saved!', 'success');
                    document.getElementById('overlay').style.display = "none";
                    $('.stripe-container').hide();
                    $('.accounts-list').show();
                    $('.stripe-container #stripe_form').hide();


                }
            });
        });
        $("#stripe_form_edit").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>api/update_stripe_acc",
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $("#overlay_message").text('Saving Stripe Credentials...');
                    document.getElementById('overlay').style.display = "flex";
                },
                success: function(data) {


                    nsmartrac_alert('Nice!', 'Stripe Crendentials Saved!', 'success');
                    document.getElementById('overlay').style.display = "none";
                    $('.stripe-container').hide();
                    $('.accounts-list').show();
                    $('.stripe-container #stripe_form_edit').hide();

                }
            });
        });
        $("#bankOfAmerica").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>api/on_save_bankOfAmerica_credentials",
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $("#overlay_message").text('Saving Stripe Credentials...');
                    document.getElementById('overlay').style.display = "flex";
                },
                success: function(data) {
                    if (data === "1") {
                        nsmartrac_alert('Nice!', 'Bank of America Crendentials Saved!', 'success');
                    }
                    document.getElementById('overlay').style.display = "none";
                    $('.modal-body').show();
                    $('.bankOfAmerica-container').hide();
                    $('.accounts-list').show();
                    nsmartrac_alert('Nice!', 'Bank of America Crendentials Saved!', 'success');
                }
            });
        });
        $("#usBank").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>api/on_save_usBank_credentials",
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $("#overlay_message").text('Saving Stripe Credentials...');
                    document.getElementById('overlay').style.display = "flex";
                },
                success: function(data) {
                    if (data === "1") {
                        nsmartrac_alert('Nice!', 'US Bank Crendentials Saved!', 'success');
                    }
                    document.getElementById('overlay').style.display = "none";
                    $('.modal-body').show();
                    $('.usBank-container').hide();
                    $('.accounts-list').show();
                    nsmartrac_alert('Nice!', 'US Bank Crendentials Saved!', 'success');
                }
            });
        });
    });


    function nsmartrac_alert(title = 'Awesome', text, icon = 'success', redirect = '') {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                if (redirect !== '') {
                    window.location.href = '<?= base_url(); ?>' + redirect;
                }
            }
        });
    }
</script>

</body>

</html>