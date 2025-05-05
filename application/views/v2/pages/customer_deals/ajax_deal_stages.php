<?php foreach($customerDealStages as $stage){ ?>
<div class="col">
    <div class="nsm-card nsm-grid deal-stage-container">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span class="d-block">
                    <?= $stage->name; ?>
                    <span class="float-end">
                        <a class="nsm nsm-link btn-edit-deal-stage" href="javascript:void(0);" data-id="<?= $stage->id; ?>"><i class='bx bxs-edit'></i></a>
                        <a class="nsm nsm-link btn-delete-deal-stage" href="javascript:void(0);" data-name="<?= $stage->name; ?>" data-id="<?= $stage->id; ?>"><i class='bx bx-trash'></i></a>
                    </span>
                </span><br />
                <span class="text-muted">$0.00 - 0 Deal</span>
            </div>
        </div>
        <div class="nsm-card-content" id="stage-draggable-container">
            
            <div class="col-12 col-md-12 col-sm-12 stage-deal">
                <div class="nsm-card nsm-grid">
                    <div class="nsm-card-title">
                        <span>Sample Deal</span><br />
                        <span class="text-muted">Sample Company</span><br />
                        <span class="text-muted"><i class='bx bx-user-circle' ></i> $0.00</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php } ?>