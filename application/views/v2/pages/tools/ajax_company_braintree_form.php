<style>
.api-input{
    letter-spacing: 3px;
    text-align: center;
}
</style>
<?php if($brainTree){ ?>
    <div class="row gy-3 text-center form-view-values">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/braintree-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Braintree account details to activate braintree payment.</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant ID</label>
            <textarea class="nsm-field form-control api-input" readonly disabled><?= $brainTree ? maskString($brainTree->braintree_merchant_id) : ''; ?></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Public Key</label>
            <textarea class="nsm-field form-control api-input" readonly disabled rows=3><?= $brainTree ? maskString($brainTree->braintree_public_key) : ''; ?></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Private Key</label>
            <textarea class="nsm-field form-control api-input" readonly disabled rows=3><?= $brainTree ? maskString($brainTree->braintree_private_key) : ''; ?></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Tokenization Key</label>
            <textarea class="nsm-field form-control api-input" readonly disabled rows=3><?= $brainTree ? maskString($brainTree->braintree_tokenization_key) : ''; ?></textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="nsm-button primary btn-braintree-edit">Edit</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>

    <div class="row gy-3 text-center form-edit-values" style="display:none;">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/braintree-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your braintree account details to activate braintree payment.</label>
            <label class="content-subtitle">
                How to locate your api keys <a class="nsm-link" href="https://developer.paypal.com/braintree/docs/guides/authorization/tokenization-key" target="_new">click here.</a>
            </label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant ID</label>
            <textarea placeholder="Merchant ID" name="braintree_merchant_id" class="nsm-field form-control api-input" required><?= $brainTree ? $brainTree->braintree_merchant_id : ''; ?></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Public Key</label>
            <textarea placeholder="Public Key" name="braintree_public_key" class="nsm-field form-control api-input" required rows=3><?= $brainTree ? $brainTree->braintree_public_key : ''; ?></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Private Key</label>
            <textarea placeholder="Private Key" name="braintree_private_key" class="nsm-field form-control api-input" required rows=3><?= $brainTree ? $brainTree->braintree_private_key : ''; ?></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Tokenization Key</label>
            <textarea placeholder="Tokenization Key" name="braintree_tokenization_key" class="nsm-field form-control api-input" required rows=3><?= $brainTree ? $brainTree->braintree_tokenization_key : ''; ?></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button btn-braintree-cancel">Cancel</button>                
        </div>
    </div>
<?php }else{ ?>
    <div class="row gy-3 text-center">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/braintree-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your braintree account details to activate braintree payment.</label>
            <label class="content-subtitle">
                How to locate your secret and publish key <a class="nsm-link" href="https://developer.paypal.com/braintree/docs/guides/authorization/tokenization-key" target="_new">click here.</a>
            </label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Merchant ID</label>
            <textarea placeholder="Merchant ID" name="braintree_merchant_id" class="nsm-field form-control api-input" required></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Public Key</label>
            <textarea placeholder="Public Key" name="braintree_public_key" class="nsm-field form-control api-input" required rows=3></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Private Key</label>
            <textarea placeholder="Private Key" name="braintree_private_key" class="nsm-field form-control api-input" required rows=3></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Tokenization Key</label>
            <textarea placeholder="Tokenization Key" name="braintree_tokenization_key" class="nsm-field form-control api-input" required rows=3></textarea>
        </div>
        <div class="modal-footer">    
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>
<?php } ?>