<style>
.img-customer-document{
    /* height:80px; */
    width:100%;
}
.btn-delete-payment-image{
    position: absolute;
    right: 4px;
    top: 6px;
}
.document-buttons-container{
    position:relative;
}
</style>
<?php if( $documents ){ ?>
<div class="row g-3">
    <?php foreach($documents as $d){ ?>
        <div class="col-3 col-md-3">
            <div class="document-buttons-container">
                <button class="nsm-button btn-sm primary btn-delete-payment-image pull-right" data-id="<?= $d->id; ?>" data-name="<?= $d->file_name; ?>"><i class='bx bx-trash'></i></button>
            </div>
            <img class="img-customer-document" src="<?= base_url('uploads/customerdocuments/'.$d->customer_id.'/'.$d->file_name); ?>" />
        </div>
    <?php } ?>
</div>
<?php }else{ ?>
<div class="alert alert-danger" role="alert">
    No records found
</div>
<?php } ?>