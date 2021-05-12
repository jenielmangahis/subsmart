<?php include viewPath('includes/header_business_view'); ?>
<style>
.text-h {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 15px;
}
.deal-preview {
    position: relative;
    margin-bottom: 25px;
}
.deal-preview-cnt {
    padding-left: 90px;
}
.deal-preview img {
    position: absolute;
    top: 2px;
    left: 0;
    height: 48px;
    width: auto;
}
</style>
<div class="container" style="padding-top: 0px;background:white;">
    <h1>Book Deal</h1>  
    <div class="row">
        <div class="col-md-8">
            <div class="text-h">One more step left to book this deal</div>
            <div class="deal-preview">
                <img src="https://markate.blob.core.windows.net/cdn/20200925/busdeal_1195_ad03392f23_sm.jpg">
                <div class="deal-preview-cnt">
                    <?= $dealsSteals->title; ?><br>
                    $<?= number_format($dealsSteals->deal_price,2); ?> <span class="text-ter"><span style="text-decoration: line-through;">$<?= number_format($dealsSteals->original_price,2); ?></span></span>
                </div>
            </div>

            <form data-book="form" method="post" action="#">
                <div class="card">
                    <p class="margin-bottom">
                        The business <b><?= $company->business_name; ?></b> needs your contact information, please fill in the form below.
                    </p>
                    <div class="form-group">
                        <label>Name</label> <span class="form-required">*</span>
                        <input name="name" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Phone</label> <span class="form-required">*</span>
                        <input name="phone" id="phone" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Address</label> <span class="help help-sm">(type in to search for address)</span>
                        <input name="address_full" id="address_full" type="text" class="form-control pac-target-input" autocomplete="off" placeholder="Enter a location">
                        <input type="hidden" name="address" id="address" value="">
                        <input type="hidden" name="city" value="">
                        <input type="hidden" name="zip" value="">
                        <input type="hidden" name="state" value="">
                        <input type="hidden" name="country" value="us">
                        <input type="hidden" name="latlng" value="">
                    </div>
                    <div class="form-group margin-bottom">
                        <label>Message</label>
                        <div class="help help-sm help-block">Write a message for the PRO to describe your project shortly.</div>
                        <textarea name="message" rows="3" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary btn-lg" data-book="submit" data-on-click-label="Confirm...">Confirm</button>
                </div>

                <br>
                <br>
            </form>

        </div>
        <div class="col-md-4">
            <div class="side-box">
                <div class="bold margin-bottom">Business Contact Details</div>
                <div class="avatar margin-bottom-sec">
                    <img class="img-circle margin-right-sec" src="https://markate.blob.core.windows.net/cdn/20200131/avatar_14356_2efeea8595_xs.jpg">
                    <div class="avatar-cnt">
                       <span class="avatar-name"><?= $company->business_name; ?></span>
                       <span class="text-ter avatar-title"><span class="business-name"><?= $company->contact_name; ?></span></span>
                    </div>
                </div>
                <div class="margin-bottom-sec"><?= $company->address; ?></div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer_pages'); ?>
<script>
$(function(){
});
</script>

