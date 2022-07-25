<style>
.api-input{
    letter-spacing: 3px;
    text-align: center;
}
</style>
<?php if($nmi){ ?>
    <div class="row gy-3 text-center form-view-values">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/nmi.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your nmi terminal id and transaction key found in your nmi account.</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Transaction Key</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $nmi ? maskString($nmi->nmi_transaction_key) : ''; ?>" readonly disabled>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Terminal ID</label>
            <textarea class="nsm-field form-control" rows=3 readonly disabled><?= $nmi ? $nmi->nmi_terminal_id : ''; ?></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="nsm-button primary btn-nmi-edit">Edit</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>
    <div class="row gy-3 text-center form-edit-values" style="display:none;">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/nmi.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your nmi terminal id and transaction key found in your nmi account.</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Transaction Key</label>
            <input type="text" name="nmi_transaction_key" class="nsm-field form-control api-input" value="<?= $nmi ? $nmi->nmi_transaction_key : ''; ?>" required>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Terminal ID</label>
            <textarea placeholder="Terminal ID" name="nmi_terminal_id" class="nsm-field form-control" required rows=3><?= $nmi ? $nmi->nmi_terminal_id : ''; ?></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button btn-nmi-cancel">Cancel</button>                
        </div>
    </div>
<?php }else{ ?>
    <div class="row gy-3 text-center">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/nmi.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your nmi terminal id and transaction key found in your nmi account.</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Transaction Key</label>
            <input type="text" name="nmi_transaction_key" class="nsm-field form-control api-input" value="" required>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Terminal ID</label>
            <textarea placeholder="Terminal ID" name="nmi_terminal_id" class="nsm-field form-control" required rows=3><?= $nmi ? $nmi->nmi_terminal_id : ''; ?></textarea>
        </div>

        <div class="modal-footer">    
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>
<?php } ?>
