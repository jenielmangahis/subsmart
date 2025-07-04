<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                    <?php foreach($customerDealStages as $stage){ ?>
                    <div class="step <?= $customerDeal->customer_deal_stage_id == $stage->id ? 'completed' : ''; ?>">
                        <div class="step-icon-wrap">
                            <div class="step-icon"></div>
                        </div>
                        <h4 class="step-title"><?= $stage->name; ?></h4>
                    </div>
                    <?php } ?>
                </div>   
            </div>
        </div>
        <div class="card bg-primary mb-3">
            <div class="card-header">
                <span class="h5"><i class='bx bx-list-ul'></i> SUMMARY</span>
            </div>
            <div class="card-body">
                <div class="row customer-deals-view-details">
                    <div class="col-md-4 col-12">
                        <div class="label">DEAL TITLE</div>
                        <?= $customerDeal->deal_title; ?>                 
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="label">VALUE</div>
                        $<?= number_format($customerDeal->value,2); ?>             
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="label">PROBABILITY</div>
                        <?= $customerDeal->probability; ?>            
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">LABELS</div>
                        <?php $count = 1; foreach( $dealLabels as $label ){ ?>
                            <span class="badge customer-deal-label" style="<?= $count == 1 ? 'margin-left:0px;' : ''; ?>background-color:<?= $label->color; ?>"><?= $label->name; ?></span>
                        <?php $count++;} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card bg-primary mb-3">
            <div class="card-header">
                <span class="h5"><i class='bx bx-news'></i> SOURCE</span>
                <span class="float-end"></span>
            </div>
            <div class="card-body">
                <div class="row customer-deals-view-details">
                    <div class="col-md-4 col-12">
                        <div class="label">SOURCE ORIGIN</div>
                        <i class="bx bx-hash"></i> Manually Created            
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="label">SOURCE CHANNEL</div>
                        <?= $customerDeal->source_channel; ?>          
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="label">SOURCE CHANNEL ID</div>
                        <?= $customerDeal->source_channel_id != '' ? $customerDeal->source_channel_id : '---'; ?>                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card bg-primary mb-3">
            <div class="card-header">
                <span class="h5"><i class='bx bx-user-circle'></i> OWNER</span>
                <span class="float-end"></span>
            </div>
            <div class="card-body">
                <div class="row customer-deals-view-details">
                    <div class="col-md-4 col-12">
                        <div class="label">NAME</div>
                        <i class='bx bx-user-circle'></i> <?= $owner ? $owner->FName . ' ' . $owner->LName : '---'; ?>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="label">MOBILE</div>
                        <i class='bx bx-mobile-vibration'></i> <?= $owner && $owner->mobile != '' ? formatPhoneNumber($owner->mobile) : '---'; ?>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="label">EMAIL</div>
                        <i class='bx bx-envelope'></i> <?= $owner && $owner->email != '' ? $owner->email : '---'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card bg-primary mb-3">
            <div class="card-header">
                <span class="h5"><i class='bx bx-show-alt'></i> OVERVIEW</span>
                <span class="float-end"></span>
            </div>
            <div class="card-body">
                <div class="row customer-deals-view-details">
                    <div class="col-md-4 col-12">
                        <div class="label">DEAL AGE</div>
                        <?php 
                            $datetime_a = new DateTime($customerDeal->date_created);
                            $datetime_b = new DateTime();
                            $difference = $datetime_a->diff($datetime_b);
                        ?>
                        <?= $difference->d > 1 ? $difference->d . ' days' : $difference->d . ' day'; ?>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="label">INACTIVE DAYS</div>
                        <?php 
                            $datetime_a = new DateTime($customerDeal->date_updated);
                            $datetime_b = new DateTime();
                            $difference = $datetime_a->diff($datetime_b);
                        ?>
                        <?= $difference->d > 1 ? $difference->d . ' days' : $difference->d . ' day'; ?>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="label">CREATED</div>
                        <?= date("F j, Y", strtotime($customerDeal->date_created)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end mt-2 view-customer-deals-actions">                        
    <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
    <?php if(checkRoleCanAccessModule('customer-deals', 'delete')){ ?>
        <button type="button" class="nsm-button btn-danger" data-id="<?= $customerDeal->id; ?>" data-name="<?= $customerDeal->deal_title; ?>" id="btn-delete-customer-deals">Delete</button>
    <?php } ?>
    <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
        <button type="button" class="nsm-button primary" id="btn-edit-customer-deals" data-id="<?= $customerDeal->id; ?>">Edit</button>    
    <?php } ?>
</div>       