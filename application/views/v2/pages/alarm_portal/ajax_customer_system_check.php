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
    </div>
</div>
<div class="nsm-card primary mt-2">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-list-ol'></i>System Check</span>            
        </div>
    </div>
    <div class="nsm-card-content">
        <?php foreach($system_check->systemCheckOutput->testCategories as $category){ ?>            
            <div class="row">
                <div class="col-sm-3"><p class="mb-0">Category Name</p></div>
                <div class="col-sm-9 mt-2"><p class="text-muted mb-0"><b><?= $category->testCategoryName; ?></b></p></div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-3"><p class="mb-0">Is Running</p></div>
                <div class="col-sm-9"><p class="text-muted mb-0"><b><?= $category->isRunning ? 'Yes' : 'No'; ?></b></p></div>
            </div>
            <?php foreach($category->baseTests as $bt ){ ?>
                <div class="row">
                    <div class="col-sm-6"><p class="mb-0"><?= $bt->testMessage; ?></p></div>
                    <div class="col-sm-6"><p class="mb-0"><?= date("m/d/Y H:i:s",strtotime($bt->testStartDate)) . ' - ' . date("m/d/Y H:i:s",strtotime($bt->testEndDate)); ?></p></div>
                </div>
            <?php } ?>
            <hr />
        <?php } ?>         
    </div>
</div>