<style>
.api-input{
    letter-spacing: 3px;
    text-align: left;
}
</style>
<?php if( $ringCentral ){ ?>
<div class="row gy-3 text-center form-view-values">
    <div class="col-12 mb-1">
        <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/ring_central.png">
    </div>
    <div class="input-container" style="height: 400px; overflow: hidden scroll;">
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Ring Central API account details.</label>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Client ID</label>
                <input type="text" class="nsm-field form-control api-input" value="<?= $ringCentral ? maskString($ringCentral->client_id) : ''; ?>" readonly disabled />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Client Secret</label>
                <input type="text" class="nsm-field form-control api-input" value="<?= $ringCentral ? maskString($ringCentral->client_secret) : ''; ?>" readonly disabled />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">JWT</label>
                <input type="text" class="nsm-field form-control api-input" value="<?= $ringCentral ? maskString($ringCentral->jwt) : ''; ?>" readonly disabled />
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Extension</label>
                <input type="text" class="nsm-field form-control" value="<?= $ringCentral ? $ringCentral->rc_ext : ''; ?>" readonly disabled />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">From Number</label>
                <input type="text" class="nsm-field form-control" value="<?= $ringCentral ? $ringCentral->rc_from_number : ''; ?>" readonly disabled />
            </div>
        </div> 
    </div>  

    <div class="modal-footer">
        <button type="button" class="nsm-button primary btn-rc-edit">Edit</button>
        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
    </div>                 
</div>

<div class="row gy-3 text-center form-edit-values" style="display:none;">
    <div class="col-12 mb-1">
        <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/ring_central.png">
    </div>
    <div class="input-container" style="height: 400px; overflow: hidden scroll;">
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Enter your Ring Central API account details.</label>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Client ID</label>
                <input type="text" name="client_id" class="nsm-field form-control api-input" value="<?= $ringCentral ? $ringCentral->client_id : ''; ?>" required />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Client Secret</label>
                <input type="text" name="client_secret" class="nsm-field form-control api-input" value="<?= $ringCentral ? $ringCentral->client_secret : ''; ?>" required />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">JWT</label>
                <input type="text" name="client_jwt" class="nsm-field form-control api-input" value="<?= $ringCentral ? $ringCentral->jwt : ''; ?>" required />
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Extension</label>
                <input type="text" placeholder="" name="rc_ext" class="nsm-field form-control" required value="<?= $ringCentral ? $ringCentral->rc_ext : ''; ?>"/>
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">From Number</label>
                <input type="text" placeholder="" name="rc_from_number" class="nsm-field form-control" required value="<?= $ringCentral ? $ringCentral->rc_from_number : ''; ?>"/>
            </div>
        </div> 
    </div>  

    <div class="modal-footer">
        <button type="submit" class="nsm-button primary">Save</button>
        <button type="button" class="nsm-button btn-rc-cancel">Cancel</button>                
    </div>                 
</div>
<?php }else{ ?>
<div class="row gy-3 text-center">
    <div class="col-12 mb-1">
        <img class="w-50" src="<?= base_url() ?>/assets/img/api-tools/ring_central.png">
    </div>
    <div class="input-container" style="height: 400px; overflow: hidden scroll;">
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Enter your Ring Central API account details.</label>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Client ID</label>
                <input type="text" name="client_id" class="nsm-field form-control api-input" value="" required />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Client Secret</label>
                <input type="text" name="client_secret" class="nsm-field form-control api-input" value="" required />
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">JWT</label>
                <input type="text" name="client_jwt" class="nsm-field form-control api-input" value="" required />
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">Extension</label>
                <input type="text" placeholder="" name="rc_ext" class="nsm-field form-control" required value=""/>
            </div>
            <div class="col-12 mb-3">
                <label class="content-subtitle d-block mb-2 fw-bold" style="text-align:left;">From Number</label>
                <input type="text" placeholder="" name="rc_from_number" class="nsm-field form-control" required value=""/>
            </div>
        </div> 
    </div>                   
</div>

<div class="modal-footer">    
    <button type="submit" class="nsm-button primary">Save</button>
    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
</div>
<?php } ?>