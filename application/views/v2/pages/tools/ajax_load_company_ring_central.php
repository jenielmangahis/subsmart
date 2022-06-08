<div class="row gy-3 text-center">
    <div class="col-12 mb-1">
        <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/ring_central.png">
    </div>
    <div class="input-container" style="height: 400px; overflow: hidden scroll;">
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Enter your ring central api account details.</label>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Client ID</label>
                <textarea placeholder="" name="client_id" class="nsm-field form-control" required><?= $ringCentral ? $ringCentral->client_id : ''; ?></textarea>
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Client Secret</label>
                <textarea placeholder="" name="client_secret" class="nsm-field form-control" required rows=3><?= $ringCentral ? $ringCentral->client_secret : ''; ?></textarea>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Username</label>
                <input type="text" placeholder="" name="rc_username" class="nsm-field form-control" required value="<?= $ringCentral ? $ringCentral->rc_username : ''; ?>"/>
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Password</label>
                <input type="text" placeholder="" name="rc_password" class="nsm-field form-control" required value="<?= $ringCentral ? $ringCentral->rc_password : ''; ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Extension</label>
                <input type="text" placeholder="" name="rc_ext" class="nsm-field form-control" required value="<?= $ringCentral ? $ringCentral->rc_ext : ''; ?>"/>
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">From Number</label>
                <input type="text" placeholder="" name="rc_from_number" class="nsm-field form-control" required value="<?= $ringCentral ? $ringCentral->rc_from_number : ''; ?>"/>
            </div>
        </div> 
    </div>                   
</div>