<div class="row gy-3 text-center">
    <div class="col-12 mb-3">
        <img class="w-50" src="<?php echo $url->assets ?>img/nmi.png">
    </div>
    <div class="col-12">
        <label class="content-subtitle">Enter your nmi terminal id and transaction key found in your nmi account.</label>
    </div>
    <div class="col-12">
        <label class="content-subtitle d-block mb-2 fw-bold">Transaction Key</label>
        <textarea placeholder="Transaction Key" name="nmi_transaction_key" class="nsm-field form-control" required><?= $nmi ? $nmi->nmi_transaction_key : ''; ?></textarea>
    </div>
    <div class="col-12">
        <label class="content-subtitle d-block mb-2 fw-bold">Terminal ID</label>
        <textarea placeholder="Terminal ID" name="nmi_terminal_id" class="nsm-field form-control" required rows=3><?= $nmi ? $nmi->nmi_terminal_id : ''; ?></textarea>
    </div>
</div>