<style>
.api-input{
    letter-spacing: 3px;
    text-align: center;
}
</style>
<div class="row gy-3 text-center">
    <div class="col-12 mb-3">
        <img class="w-50" src="<?php echo $url->assets ?>img/converge-logo.png">
    </div>
    <div class="col-12">
        <label class="content-subtitle">Enter your converge account details to activate converge payment.</label>
    </div>
    <div class="col-12">
        <label class="content-subtitle d-block mb-2 fw-bold">Merchant ID</label>
        <input type="text" name="converge_merchant_id" class="nsm-field form-control api-input" value="<?= $converge ? maskString($converge->converge_merchant_id,3) : ''; ?>" required>
    </div>
    <div class="col-12">
        <label class="content-subtitle d-block mb-2 fw-bold">Merchant User ID</label>
        <input type="text" placeholder="Merchant User ID" name="converge_merchant_user_id" class="nsm-field form-control" required value="<?= $converge ? $converge->converge_merchant_user_id : ''; ?>"/>
    </div>
    <div class="col-12">
        <label class="content-subtitle d-block mb-2 fw-bold">Merchant PIN</label>
        <input type="text" name="converge_merchant_pin" class="nsm-field form-control api-input" value="<?= $converge ? maskString($converge->converge_merchant_pin) : ''; ?>" required>        
    </div>
</div>