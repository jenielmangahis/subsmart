<style>
.api-input{
    letter-spacing: 1px;
    text-align: center;
}
</style>
<?php if($plaid){ ?>
    <div class="row gy-3 text-center form-view-values">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/api-tools/plaid.jpg">
        </div>
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Plaid api account details.</label>
            </div>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client Name</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $plaid ? maskString($plaid->client_name) : ''; ?>" readonly disabled/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client User ID</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $plaid ? maskString($plaid->client_user_id) : ''; ?>" readonly disabled/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client ID</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $plaid ? maskString($plaid->client_id) : ''; ?>" readonly disabled/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client Secret</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $plaid ? maskString($plaid->client_secret) : ''; ?>" readonly disabled/>
        </div>

        <div class="modal-footer">
            <button type="button" class="nsm-button primary btn-plaid-edit">Edit</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>

    <div class="row gy-3 text-center form-edit-values" style="display: none;">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/api-tools/plaid.jpg">
        </div>
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Plaid api account details.</label>
            </div>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client Name</label>
            <input type="text" placeholder="Client Name" name="client_name" class="nsm-field form-control api-input" value="<?= $plaid ? $plaid->client_name : ''; ?>" required/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client User ID</label>
            <input type="text" placeholder="Client User ID" name="client_user_id" class="nsm-field form-control api-input" value="<?= $plaid ? $plaid->client_user_id : ''; ?>" required/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client ID</label>
            <input type="text" placeholder="Client ID" name="client_id" class="nsm-field form-control api-input" value="<?= $plaid ? $plaid->client_id : ''; ?>" required/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client Secret</label>
            <input type="text" placeholder="Client Secret" name="client_secret" class="nsm-field form-control api-input" value="<?= $plaid ? $plaid->client_secret : ''; ?>" required/>
        </div>
        <div class="modal-footer">
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button btn-plaid-cancel">Cancel</button>                
        </div>
    </div>
<?php }else{ ?>
    <div class="row gy-3 text-center">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/api-tools/plaid.jpg">
        </div>
        <div class="row">
            <div class="col-12">
                <label class="content-subtitle">Enter your plaid api account details.</label>
            </div>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client Name</label>
            <input type="text" placeholder="Client Name" name="client_name" class="nsm-field form-control api-input" value="" required/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client User ID</label>
            <input type="text" placeholder="Client User ID" name="client_user_id" class="nsm-field form-control api-input" value="" required/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client ID</label>
            <input type="text" placeholder="Client ID" name="client_id" class="nsm-field form-control api-input" value="" required/>
        </div>
        <div class="col-12 mt-5">
            <label class="content-subtitle d-block mb-2 fw-bold">Client Secret</label>
            <input type="text" placeholder="Client Secret" name="client_secret" class="nsm-field form-control api-input" value="" required/>
        </div>

        <div class="modal-footer">    
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>
<?php } ?>