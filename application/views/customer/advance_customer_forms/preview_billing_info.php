<div class="card-header">
    <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Billing Information</h6>
</div>
<div class="card-body">
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Card Holder First Name</label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->card_fname) ? $billing_info->card_fname : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Card Holder Last Name</label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->card_lname) ? $billing_info->card_lname : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Card Holder Address </label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->card_address) ? $billing_info->card_address : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">City State ZIP</label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->city) ? $billing_info->city : '---' ?>
            <?= isset($billing_info) && !empty($billing_info->state) ? $billing_info->state : '---' ?>
            <?= isset($billing_info) && !empty($billing_info->zip) ? $billing_info->zip : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Rate Plan </label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->mmr) ? '$'. $billing_info->mmr : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Billing Frequency</label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->bill_freq) ? $billing_info->bill_freq : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Billing Day of Month</label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->bill_day) ? $billing_info->bill_day : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Contract Term* (months)</label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->contract_term) ? $billing_info->contract_term : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Billing Start Date</label>
        </div>
        <div class="col-md-6">
            <?= isset($billing_info) && !empty($billing_info->bill_start_date) ? $billing_info->bill_start_date : '---' ?>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-6">
            <label for="">Billing End Date</label>
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
            <label for="">Billing Method</label>
        </div>
        <div class="col-md-6">
            <?php $bm = bill_methods($billing_info->bill_method); echo $bm['description']; ?>
        </div>
    </div>

    <div class="row form_line" id="checkNumber">
        <div class="col-md-6">
            <label for="">Check Number</label>
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->check_num) ? $billing_info->check_num : '---' ?>
        </div>
    </div>
    <div class="row form_line" id="routingNumber">
        <div class="col-md-6">
            <label for="">Routing Number</label>
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->routing_num) ? $billing_info->routing_num : '---' ?>
        </div>
    </div>
    <div class="row form_line" id="accountNumber">
        <div class="col-md-6">
            <label for="">Account Number</label>
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->acct_num) ? $billing_info->acct_num : '---' ?>
        </div>
    </div>
    <div class="row form_line" id="CCN">
        <div class="col-md-6">
            <label for="">Credit Card Number</label>
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->credit_card_num) ? $billing_info->credit_card_num : '---' ?>
        </div>
    </div>
    <div class="row form_line" id="CCE">
        <div class="col-md-6">
            <label for="">Credit Card Expiration</label>
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->credit_card_exp) ? $billing_info->credit_card_exp : '---' ?>
            <?= !empty($billing_info->credit_card_exp_mm_yyyy) ? $billing_info->credit_card_exp_mm_yyyy : '---' ?>
        </div>
    </div>

    <div class="row form_line account_cred" >
        <div class="col-md-6">
            <label for="">Account Credential</label>
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->account_credential) ? $billing_info->account_credential : '---' ?>
        </div>
    </div>
    <div class="row form_line account_cred" >
        <div class="col-md-6">
            <label for="">Account Note</label>
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->account_note) ? $billing_info->account_note : '---' ?>
        </div>
    </div>
    <div class="row form_line account_cred" id="confirmationPD">
        <div class="col-md-6">
            <label for="">Confirmation</label>
        </div>
        <div class="col-md-6">
            <?= !empty($billing_info->confirmation) ? $billing_info->confirmation : '---' ?>
        </div>
    </div>

</div>


