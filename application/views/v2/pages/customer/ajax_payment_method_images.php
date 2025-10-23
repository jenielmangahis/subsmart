<style>
.img-customer-document{
    /* height:80px; */
    width:100%;
}
</style>
<?php if( $documents ){ ?>
<div class="row g-3">
    <?php foreach($documents as $d){ ?>
        <div class="col-3 col-md-3">
            <img class="img-customer-document" src="<?= base_url('uploads/customerdocuments/'.$d->customer_id.'/'.$d->file_name); ?>" />
        </div>
    <?php } ?>
</div>
<?php }else{ ?>
<div class="alert alert-danger" role="alert">
    No records found
</div>
<?php } ?>