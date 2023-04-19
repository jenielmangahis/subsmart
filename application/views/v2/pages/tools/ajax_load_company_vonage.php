<style>
.api-input{
    letter-spacing: 3px;
    text-align: center;
}
</style>
<?php if( $vonage ){ ?>
<div class="row gy-3 text-center form-view-values">
    <div class="col-12 mb-1">
        <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/vonage.png">
    </div>
    <div class="input-container" style="height: 400px; overflow: hidden scroll;">
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Vonage API account details.</label>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">API Key</label>
                <input type="text" class="nsm-field form-control api-input" value="<?= $vonage ? maskString(base64_decode($vonage->vn_api_key)) : ''; ?>" readonly disabled />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">API Secret</label>
                <input type="text" class="nsm-field form-control api-input" value="<?= $vonage ? maskString(base64_decode($vonage->vn_api_secret)) : ''; ?>" readonly disabled />
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Branding</label>
                <input type="text" class="nsm-field form-control" value="<?= $vonage ? $vonage->vn_branding : ''; ?>" readonly disabled/>
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Virtual Phone Number</label>
                <input type="text" style="text-align:left;" class="nsm-field form-control api-input" value="<?= $vonage ? maskString($vonage->vn_from_number) : ''; ?>" readonly disabled />
            </div>
        </div>
    </div>  

    <div class="modal-footer">
        <button type="button" class="nsm-button primary btn-vonage-edit">Edit</button>
        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
    </div>                 
</div>

<div class="row gy-3 text-center form-edit-values" style="display:none;">
    <div class="col-12 mb-1">
        <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/vonage.png">
    </div>
    <div class="input-container" style="height: 400px; overflow: hidden scroll;">
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Enter your Vonage API account details.</label>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">API Key</label>
                <input type="text" name="vn_api_key" class="nsm-field form-control api-input" value="<?= $vonage ? base64_decode($vonage->vn_api_key) : ''; ?>" required />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">API Secret</label>
                <input type="text" name="vn_api_secret" class="nsm-field form-control api-input" value="<?= $vonage ? base64_decode($vonage->vn_api_secret) : ''; ?>" required />
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Branding</label>
                <input type="text" placeholder="" name="vn_branding" class="nsm-field form-control" required value="<?= $vonage ? $vonage->vn_branding : ''; ?>"/>
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Virtual Phone Number</label>
                <input type="text" style="text-align:left;" placeholder="" name="vn_from_number" class="nsm-field form-control api-input" required value="<?= $vonage ? $vonage->vn_from_number : ''; ?>"/>
            </div>
        </div>
    </div>  

    <div class="modal-footer">
        <button type="submit" class="nsm-button primary">Save</button>
        <button type="button" class="nsm-button btn-vonage-cancel">Cancel</button>                
    </div>                 
</div>
<?php }else{ ?>
<div class="row gy-3 text-center">
    <div class="col-12 mb-1">
        <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/vonage.png">
    </div>
    <div class="input-container" style="height: 400px; overflow: hidden scroll;">
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Enter your Vonage API account details.</label>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">API Key</label>
                <input type="text" name="vn_api_key" class="nsm-field form-control api-input" value="" required />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">API Secret</label>
                <input type="text" name="vn_api_secret" class="nsm-field form-control api-input" value="" required />
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Branding</label>
                <input type="text" placeholder="" name="vn_branding" class="nsm-field form-control" required value=""/>
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold">Virtual Phone Number</label>
                <input type="text" style="text-align:left;" placeholder="" name="vn_from_number" class="nsm-field form-control api-input" required value=""/>
            </div>
        </div>
    </div>                   
</div>

<div class="modal-footer">    
    <button type="submit" class="nsm-button primary">Save</button>
    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
</div>
<?php } ?>