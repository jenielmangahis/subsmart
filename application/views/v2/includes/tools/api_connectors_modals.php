<div class="modal fade nsm-modal fade" id="setup_paypal_modal" tabindex="-1" aria-labelledby="setup_paypal_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-paypal-account', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_paypal_modal_label">Setup Paypal</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="paypal_api_container"></div>            
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="setup_square_modal" tabindex="-1" aria-labelledby="setup_square_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_square_modal_label">Setup Square</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row gy-3">
                    <div class="col-12 mb-3 text-center">
                        <img class="w-50" src="<?php echo $url->assets ?>img/square-payment.png">
                        <a type="button" class="nsm-button primary mt-3 d-block m-auto w-50" href="http://nsmartrac.com/settings/square_payment/connect?do=auth">Connect To Square</a>
                    </div>
                    <div class="col-12">
                        <label class="content-title d-block mb-2">Transaction Charges</label>
                        <label class="content-subtitle">
                            Transaction charges are applicable as on your Square plan. <br>
                            Square reference fees 2.9% + $0.30 <br>
                            No additional fee will be charged by system.
                        </label>
                    </div>
                    <div class="col-12">
                        <label class="content-title d-block mb-2">Accepted Credit Cards</label>
                        <label class="content-subtitle">
                            All major cards are accepted. <br>
                            Payment status will be updated in system automatically.
                        </label>
                    </div>
                    <div class="col-12">
                        <label class="content-title d-block mb-2">Locations</label>
                        <label class="content-subtitle">
                            If your business has multiple locations, you can manage everything right from your online Square Dashboard. <br>
                            You can create unique business profiles for each location.
                        </label>
                    </div>
                    <div class="col-12">
                        <label class="content-title d-block mb-2">Instant Deposit</label>
                        <label class="content-subtitle">
                            For faster access to your money, initiate an instant deposit from the Square app or from your online Square Dashboard. <br>
                            You can instantly send up to $10,000 per deposit <b>24 hours a day, 7 days a week</b>. <br>
                            There is no limit to the number of instant deposits you can initiate in a given day. <a class="nsm-link" href="https://squareup.com/help/us/en/article/5405-set-up-and-manage-instant-deposits" target="_blank">Setup on Square</a>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="setup_wepay_modal" tabindex="-1" aria-labelledby="setup_wepay_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_wepay_modal_label">Setup WePay</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row gy-3">
                    <div class="col-12 mb-3 text-center">
                        <img class="w-50" src="<?php echo $url->assets ?>img/wepay-logo.png">

                        <label class="content-subtitle mt-3">By clicking Continue button you agree to <a class="nsm-link" href="https://go.wepay.com/terms-of-service" target="_blank">WePay Terms</a>.</label>
                        <a type="button" class="nsm-button primary mt-2 d-block m-auto w-50" href="http://nsmartrac.com/settings/wepay_payment/connect?do=auth">Connect To WePay</a>
                    </div>
                    <div class="col-12">
                        <label class="content-title d-block mb-2">Transaction Charges</label>
                        <label class="content-subtitle">
                            Online Transaction Fees: 2.9% + $0.30
                        </label>
                    </div>
                    <div class="col-12">
                        <label class="content-title d-block mb-2">Accepted Credit Cards</label>
                        <label class="content-subtitle">
                            All major cards are accepted. <br>
                            Funds are deposited in your bank account in 1-2 business days. <br>
                            Payment status will be updated in Markate automatically.
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<div class="modal fade nsm-modal fade" id="setup_stripe_modal" tabindex="-1" aria-labelledby="setup_stripe_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-stripe-account', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_stripe_modal_label">Setup Stripe</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="stripe_api_container"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="setup_nmi_modal" tabindex="-1" aria-labelledby="setup_nmi_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-nmi-account', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_nmi_modal_label">Setup NMI</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="nmi_api_container"></div>            
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="setup_converge_modal" tabindex="-1" aria-labelledby="setup_converge_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-converge-account', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_converge_modal_label">Setup Converge</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="converge_api_container"></div>            
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="setup_ring_central" tabindex="-1" aria-labelledby="setup_ring_central_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-ring-central-account', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_stripe_modal_label">Setup Ring Central</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="ring-central-container"></div>            
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="setup_twilio" tabindex="-1" aria-labelledby="setup_twilio_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-twilio-account', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_stripe_modal_label">Setup Twilio</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="twilio-container"></div>            
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="auth-modal" tabindex="-1" aria-labelledby="auth-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-auth-verify', 'autocomplete' => 'off']); ?>
        <input type="hidden" name="auth_module" id="auth-module" value="">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_stripe_modal_label">Authentication</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label class="content-subtitle">Authentication key was sent to <span class="auth-email"></span>.</label>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-12 mb-3">
                        <label class="content-subtitle d-block mb-2 fw-bold">Enter Authentication Key</label>
                        <input type="text" placeholder="" name="auth_key" class="nsm-field form-control auth-key" required value=""/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary btn-auth-verify">Verify and continue</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="setup_plaid_modal" tabindex="-1" aria-labelledby="setup_plaid_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-twilio-account', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="setup_stripe_modal_label">Setup Plaid</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="plaid-container"></div>            
        </div>
        <?php echo form_close(); ?>
    </div>
</div>