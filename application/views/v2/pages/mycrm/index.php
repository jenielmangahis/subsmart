<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/my_crm_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row justify-content-center">
                    <div class="col-6 d-flex justify-content-center align-items-center" style="height: 70vh;">
                        <div class="d-block text-center">
                            <div class="nsm-img img-circle nsm-md m-auto mb-4" style="background-image: url('https://localhost/nsmartrac/uploads/users/default.png')"></div>
                            <label class="content-title d-block mb-5 fs-4"><?= $business->business_name; ?></label>
                            <label class="content-subtitle fw-bold mb-2 d-block">Business Description</label>
                            <label class="content-subtitle mb-4"><?= $business->business_desc; ?></label>
                            <label class="content-subtitle fw-bold mb-2 d-block">Email</label>
                            <label class="content-subtitle mb-4"><?= $business->business_email; ?></label>
                            <label class="content-subtitle fw-bold mb-2 d-block">Contact Name</label>
                            <label class="content-subtitle mb-4"><?= $business->contact_name; ?></label>
                            <label class="content-subtitle fw-bold mb-2 d-block">Address</label>
                            <label class="content-subtitle mb-4"><?= $business->address; ?></label>
                            <label class="content-subtitle fw-bold mb-2 d-block">ZIP</label>
                            <label class="content-subtitle mb-4"><?= $business->zip; ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>