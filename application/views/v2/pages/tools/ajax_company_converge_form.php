<style>
.api-input{
    letter-spacing: 3px;
    text-align: center;
}
</style>
<?php if($converge){ ?>
    <div class="row gy-3 text-center form-view-values">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/converge-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Converge account details to activate converge payment.</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant ID</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $converge ? maskString($converge->converge_merchant_id,3) : ''; ?>" readonly disabled />
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant User ID</label>
            <input type="text" class="nsm-field form-control" value="<?= $converge ? $converge->converge_merchant_user_id : ''; ?>" readonly disabled />
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant PIN</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $converge ? maskString($converge->converge_merchant_pin) : ''; ?>" readonly disabled />        
        </div>

        <div class="modal-footer">
            <button type="button" class="nsm-button primary btn-converge-edit">Edit</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>

    <div class="row gy-3 text-center form-edit-values" style="display:none;">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/converge-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your converge account details to activate converge payment.</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant ID</label>
            <input type="text" name="converge_merchant_id" class="nsm-field form-control api-input" value="<?= $converge ? $converge->converge_merchant_id : ''; ?>" required>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant User ID</label>
            <input type="text" placeholder="Merchant User ID" name="converge_merchant_user_id" class="nsm-field form-control" required value="<?= $converge ? $converge->converge_merchant_user_id : ''; ?>"/>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant PIN</label>
            <input type="text" name="converge_merchant_pin" class="nsm-field form-control api-input" value="<?= $converge ? $converge->converge_merchant_pin : ''; ?>" required>        
        </div>

        <div class="modal-footer">
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button btn-converge-cancel">Cancel</button>                
        </div>
    </div>
<?php }else{ ?>
    <div class="row gy-3 text-center">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/converge-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your converge account details to activate converge payment.</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant ID</label>
            <input type="text" name="converge_merchant_id" class="nsm-field form-control api-input" value="" required>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant User ID</label>
            <input type="text" placeholder="Merchant User ID" name="converge_merchant_user_id" class="nsm-field form-control" required value=""/>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant PIN</label>
            <input type="text" name="converge_merchant_pin" class="nsm-field form-control api-input" value="" required>        
        </div>

        <div class="modal-footer">    
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>
<?php } ?>