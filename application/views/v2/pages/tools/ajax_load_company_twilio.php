<style>
.api-input{
    letter-spacing: 3px;
    text-align: center;
}
</style>
<?php if($twilio){ ?>
    <div class="row gy-3 text-center  form-view-values">
        <div class="col-12 mb-1">
            <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/twilio.png">
        </div>
        <div class="input-container" style="height: 400px; overflow: hidden scroll;">
            <div class="row">
                <div class="col-12">
                    <label class="content-subtitle">Twilio api account details.</label>
                </div>
            </div>
            <div class="row mb-5 mt-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">SID</label>
                    <input type="text" class="nsm-field form-control api-input" value="<?= $twilio ? maskString(base64_decode($twilio->tw_sid)) : ''; ?>" readonly disabled />
                </div>
            </div>
            <div class="row mb-5 mt-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Token</label>
                    <input type="text" class="nsm-field form-control api-input" value="<?= $twilio ? maskString(base64_decode($twilio->tw_token)) : ''; ?>" readonly disabled />
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Twilio Number</label>
                    <input type="text" class="nsm-field form-control" required value="<?= $twilio ? $twilio->tw_number : ''; ?>" readonly disabled />
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Capability Token URL (For making calls)</label>
                    <input type="text" class="nsm-field form-control" required value="<?= $twilio ? $twilio->tw_capability_token_url : ''; ?>" readonly disabled />
                </div>
            </div>
        </div>          

        <div class="modal-footer">
            <button type="button" class="nsm-button primary btn-twilio-edit">Edit</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>        
    </div>

    <div class="row gy-3 text-center form-edit-values" style="display:none;">
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
                    <input type="text" name="tw_sid" class="nsm-field form-control api-input" value="<?= $twilio ? base64_decode($twilio->tw_sid) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-5 mt-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Token</label>
                    <input type="text" name="tw_token" class="nsm-field form-control api-input" value="<?= $twilio ? base64_decode($twilio->tw_token) : ''; ?>" required />
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Twilio Number</label>
                    <input type="text" placeholder="" name="tw_number" class="nsm-field form-control" required value="<?= $twilio ? $twilio->tw_number : ''; ?>"/>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Capability Token URL (For making calls)</label>
                    <input type="text" placeholder="" name="tw_capability_token_url" class="nsm-field form-control" required value="<?= $twilio ? $twilio->tw_capability_token_url : ''; ?>"/>
                </div>
            </div>
        </div>   
        <div class="modal-footer">
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button btn-twilio-cancel">Cancel</button>                
        </div>                
    </div>
<?php }else{ ?>
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
                    <input type="text" name="tw_sid" class="nsm-field form-control api-input" value="" required>
                </div>
            </div>
            <div class="row mb-5 mt-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Token</label>
                    <input type="text" name="tw_token" class="nsm-field form-control api-input" value="" required />
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Twilio Number</label>
                    <input type="text" placeholder="" name="tw_number" class="nsm-field form-control" required value=""/>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12 mb-3">
                    <label class="content-subtitle d-block mb-2 fw-bold">Capability Token URL (For making calls)</label>
                    <input type="text" placeholder="" name="tw_capability_token_url" class="nsm-field form-control" required value=""/>
                </div>
            </div>
        </div>                   
    </div>
    <div class="modal-footer">    
        <button type="submit" class="nsm-button primary">Save</button>
        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
    </div>
<?php } ?>