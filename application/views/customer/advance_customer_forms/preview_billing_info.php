<div class="card-header">
    <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Billing Information</h6>
</div>
<div class="card-body">
    <div class="row form_line">
        <div class="col-md-6">
            Card Holder First Name
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->card_fname) ? $billing_info->card_fname : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
           Card Holder Last Name
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->card_lname) ? $billing_info->card_lname : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
           Card Holder Address
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->card_address) ? $billing_info->card_address : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            City State ZIP
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->city) ? $billing_info->city : '---' ?>
            <?= isset($billing_info) && !empty($billing_info->state) ? $billing_info->state : '---' ?>
            <?= isset($billing_info) && !empty($billing_info->zip) ? $billing_info->zip : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            Rate Plan
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->mmr) ? '$'. $billing_info->mmr : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
           Billing Frequency
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->bill_freq) ? $billing_info->bill_freq : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            Billing Day of Month
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->bill_day) ? $billing_info->bill_day : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            Contract Term* (months)
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->contract_term) ? $billing_info->contract_term.' months' : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            Billing Start Date
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->bill_start_date) ? $billing_info->bill_start_date : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            Billing End Date
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->bill_end_date) ? $billing_info->bill_end_date : '---' ?>
        </div>
    </div>
</div>


<div class="card-header">
    <h6 ><span class="fa fa-credit-card"></span>&nbsp; &nbsp;Payment Details</h6>
</div>
<div class="card-body">

    <div class="row form_line">
        <div class="col-md-6">
            Billing Method
        </div>
        <div class="col-md-6">
            <?php $bm = bill_methods($billing_info->bill_method); ?> <?= !empty($bm['description']) ? $bm['description'] : '---'; ?>
        </div>
    </div>

    <div class="row form_line" id="checkNumber">
        <div class="col-md-6">
            Check Number
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->check_num) ? $billing_info->check_num : '---' ?>
        </div>
    </div>
    <div class="row form_line" id="routingNumber">
        <div class="col-md-6">
            Routing Number
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->routing_num) ? $billing_info->routing_num : '---' ?>
        </div>
    </div>
    <div class="row form_line" id="accountNumber">
        <div class="col-md-6">
            Account Number
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->acct_num) ? $billing_info->acct_num : '---' ?>
        </div>
    </div>
    <div class="row form_line" id="CCN">
        <div class="col-md-6">
            Credit Card Number
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->credit_card_num) ? $billing_info->credit_card_num : '---' ?>
        </div>
    </div>
    <div class="row form_line" id="CCE">
        <div class="col-md-6">
            Credit Card Expiration
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->credit_card_exp) ? $billing_info->credit_card_exp : '---' ?>
            <?= !empty($billing_info->credit_card_exp_mm_yyyy) ? $billing_info->credit_card_exp_mm_yyyy : '---' ?>
        </div>
    </div>

    <div class="row form_line account_cred" >
        <div class="col-md-6">
            Account Credential
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->account_credential) ? $billing_info->account_credential : '---' ?>
        </div>
    </div>
    <div class="row form_line account_cred" >
        <div class="col-md-6">
            Account Note
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->account_note) ? $billing_info->account_note : '---' ?>
        </div>
    </div>
    <div class="row form_line account_cred" id="confirmationPD">
        <div class="col-md-6">
            Confirmation
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->confirmation) ? $billing_info->confirmation : '---' ?>
        </div>
    </div>
</div>


