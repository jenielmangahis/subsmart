<div class="row gy-3 text-center">
    <div class="col-12 mb-1">
        <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/twilio.png">
    </div>
    <div class="input-container" style="height: 400px; overflow: hidden scroll;">
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Enter your twilio api account details.</label>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">SID</label>
                <textarea placeholder="" name="tw_sid" class="nsm-field form-control" required><?= $twilio ? $twilio->tw_sid : ''; ?></textarea>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Token</label>
                <textarea placeholder="" name="tw_token" class="nsm-field form-control" required rows=3><?= $twilio ? $twilio->tw_token : ''; ?></textarea>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Twilio Number</label>
                <input type="text" placeholder="" name="tw_number" class="nsm-field form-control" required value="<?= $twilio ? $twilio->tw_number : ''; ?>"/>
            </div>
        </div>
    </div>                   
</div>