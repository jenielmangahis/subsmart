<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Customer Profile</span>            
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Name</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= $customer_info->firstName . ' ' . $customer_info->lastName; ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Email</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= $customer_info->email; ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Address</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= $customer_info->installAddress->street1 . ' ' . $customer_info->installAddress->city . ',' . $customer_info->installAddress->state . ' ' . $customer_info->installAddress->zip; ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Company</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= $customer_info->companyName; ?></p></div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Panel Version</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= $customer_info->panelVersion; ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Unit Description</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= $customer_info->unitDescription; ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Package</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= $customer_info->servicePlanInfo->packageDescription; ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Package Price</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= number_format($customer_info->servicePlanInfo->totalServicePrice,2,".",","); ?></p></div>
        </div>        
    </div>
    <!-- <div class="nsm-card-header mt-2">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Addon Information</span>            
        </div>
    </div> -->
    <!-- <div class="nsm-card-content">
        <div class="row">
            <div class="col-sm-3"><p class="mb-0">Package</p></div>
            <div class="col-sm-9"><p class="text-muted mb-0"><?= $customer_info->servicePlanInfo->packageDescription; ?></p></div>
        </div>
    </div> -->
</div>
<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-list-check'></i>Equipments</span>            
        </div>
    </div>
    <div class="nsm-card-content">
        <?php foreach($customer_equipments as $eq){ ?>
            <div class="row">
                <div class="col-sm-3"><p class="mb-0">Device Name</p></div>
                <div class="col-sm-9"><p class="text-muted mb-0"><?= $eq->webSiteDeviceName; ?></p></div>
            </div>
            <div class="row">
                <div class="col-sm-3"><p class="mb-0">Install Date</p></div>
                <div class="col-sm-9"><p class="text-muted mb-0"><?= date("m/d/Y H:i:s", strtotime($eq->installDate)); ?></p></div>
            </div>
            <div class="row">
                <div class="col-sm-3"><p class="mb-0">Maintain Date</p></div>
                <div class="col-sm-9"><p class="text-muted mb-0"><?= date("m/d/Y H:i:s", strtotime($eq->maintainDate)); ?></p></div>
            </div>
        <?php } ?>       
    </div>
</div>