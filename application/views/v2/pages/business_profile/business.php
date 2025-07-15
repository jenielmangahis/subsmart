<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<style>
    .uploaded-image {
        display: block;
        margin: 0 auto 10px;
        border: 1px solid #ddd;
        padding: 5px;
        background-color: #f9f9f9;
    }

    .crop-image-container {
        width: 100%;
        max-width: 300px !important;
        aspect-ratio: 1;
        border: 2px dashed #c7c7c7;
        border-radius: 5px;
        border-radius: 100%;
        background-position: center center;
        background-size: contain;
        background-repeat: no-repeat;
        position: relative;
        padding: 10px;
        height: unset !important;
    }

    .credential-badge {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        align-items: center;
    }

    .credential .credential-badge .badge-label.bond {
        font-size: 16px;
        font-weight: 600;
        color: #f4902f;
    }

    .credential .credential-badge .badge-label.insurance {
        font-size: 16px;
        font-weight: 600;
        color: #102243;
    }

    .credential .credential-badge .badge-label.license {
        font-size: 16px;
        font-weight: 600;
        color: #6a4a85;
    }

    .credential .credential-badge .badge-label.accreditation {
        font-size: 16px;
        font-weight: 600;
        color: #bb2844;
    }

    .credential .credential-badge .badge-label.accreditation {
        font-size: 16px;
        font-weight: 600;
        color: #bb2844;
    }

    .credential .credential-badge .badge-label.since {
        color: #03a8dd;
        font-weight: 600;
    }

    .credential .credential-badge .badge-label.verifications {
        color: #27b05f;
        font-weight: 600;
        font-size: 16px;
    }


    .credential-badge-year-text {
        position: absolute;
        bottom: 11px;
        left: 0;
        width: 100%;
        font-size: 19px;
        text-align: center;
        font-weight: 600;
        color: #4881c7;
    }


    .credential-verification {
        margin-bottom: 6px;
    }

    .credential-verification .fa.active {
        color: #2ab363;
    }

    .credential-verification .fa {
        color: #888;
        margin-right: 8px;
    }

    .w9pdf-filepath {
        font-weight: 700;
        font-size: 17px;
        color: #545454;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3 mt-3 align-items-start">
                    <div class="col-12 col-md-8">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span><?php echo $profiledata->business_name; ?></span>
                                            <label class="content-subtitle d-block"><?php echo $profiledata->city; ?>,
                                                <?php echo $profiledata->state; ?></label>
                                        </div>
                                        <?php if(checkRoleCanAccessModule('company-my-business', 'write')){ ?>    
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit_basic_info_modal">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                            <button type="button" class="nsm-button btn-sm primary" id="btn-w9-form">
                                                <i class='bx bx-fw bxs-file-pdf'></i> W-9 Form
                                            </button>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="nsm-card-content">
                                        <label class="content-title d-block fw-normal"><?php echo $profiledata->business_desc; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Residential Services Offered</span>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm"
                                                onclick="location.href='<?php echo base_url('users/services'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <?php foreach ($selectedCategories as $s) : ?>
                                        <span class="nsm-badge primary"><?= $s->service_name ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Business Credentials</span>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm"
                                                onclick="location.href='<?php echo base_url('users/credentials'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center credential">
                                                    <div class="col-12 col-md-4 text-center credential-badge">
                                                        <img src="<?= $url->assets . 'img/badge_1.png' ?>"
                                                            style="width: 100%; max-width: 60px;">
                                                        <label
                                                            class="content-subtitle fw-bold mt-2 badge-label license ">License</label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <?php if ($profiledata->is_licensed  == 1) { ?>
                                                        <label class="content-title fw-normal d-block"><span
                                                                class="fw-bold">State/Province :</span>
                                                            <?= $profiledata->license_state ?><br><span
                                                            class="fw-bold mt-2">Expires on :</span>
                                                            <?= date('m/d/Y', strtotime($profiledata->license_expiry_date)) ?></label>
                                                        <label class="content-title fw-normal d-block"><span
                                                                class="fw-bold">Class :</span>
                                                            <?= $profiledata->license_class ?>,
                                                            Nr:<?= $profiledata->license_number ?></label>

                                                        <?php if ($profiledata->license_image != '') { ?>
                                                        <div class="mt-3">
                                                            <img src="<?php echo licenseImage($profiledata->id) ? licenseImage($profiledata->id) : $url->assets; ?>"
                                                                style="width: 25px; aspect-ratio: 1;">
                                                            <a href="<?php echo licenseImage($profiledata->id) ? licenseImage($profiledata->id) : $url->assets; ?>" class="nsm-link default ms-2"
                                                                target="_blank">View License</a>
                                                        </div>
                                                        <?php } ?>
                                                        <?php } else { ?>
                                                        <label class="content-title fw-normal d-block">Not
                                                            Licensed</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center credential">
                                                    <div class="col-12 col-md-4 text-center credential-badge">
                                                        <img src="<?= $url->assets . 'img/bond-icon.png' ?>"
                                                            style="width: 100%; max-width: 60px;">
                                                        <label
                                                            class="content-subtitle fw-bold mt-2 bond badge-label bond">Bond</label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <?php if ($profiledata->is_bonded == 1) { ?>
                                                        <label class="content-title fw-normal d-block"><span
                                                                class="fw-bold">Insured Amount :</span>
                                                            $<?= number_format($profiledata->bond_amount, 2) ?></label>
                                                        <label class="content-title fw-normal d-block"><span
                                                                class="fw-bold">Expires on :</span>
                                                            <?= date('m/d/Y', strtotime($profiledata->bond_expiry_date)) ?></label>

                                                        <?php if ($profiledata->bond_image != '') { ?>
                                                        <div class="mt-3">
                                                            <img src="<?php echo bondImage($profiledata->id) ? bondImage($profiledata->id) : $url->assets; ?>"
                                                                style="width: 25px; aspect-ratio: 1;">
                                                            <a href="<?php echo bondImage($profiledata->id) ? bondImage($profiledata->id) : $url->assets; ?>" class="nsm-link default ms-2"
                                                                target="_blank">View Bonded</a>
                                                        </div>
                                                        <?php } ?>
                                                        <?php } else { ?>
                                                        <label class="content-title fw-normal d-block">Not
                                                            Bonded</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center credential">
                                                    <div class="col-12 col-md-4 text-center credential-badge">
                                                        <img src="<?= $url->assets . 'img/insurance-icon.png' ?>"
                                                            style="width: 100%; max-width: 60px;">
                                                        <label
                                                            class="content-subtitle fw-bold mt-2 badge-label insurance">Insurance</label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <?php if ($profiledata->is_business_insured == 1) { ?>
                                                        <label class="content-title fw-normal d-block"><span
                                                                class="fw-bold">Insured Amount :</span>
                                                            $<?= number_format($profiledata->insured_amount, 2) ?></label>
                                                        <label class="content-title fw-normal d-block"><span
                                                                class="fw-bold">Expires on :</span>
                                                            <?= date('m/d/Y', strtotime($profiledata->insurance_expiry_date)) ?></label>
                                                        <?php } else { ?>
                                                        <label class="content-title fw-normal d-block">Not
                                                            Insured</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center credential">
                                                    <div class="col-12 col-md-4 text-center credential-badge">
                                                        <img src="<?= $url->assets . 'img/accreditation-logo.png' ?>"
                                                            style="width: 100%; max-width: 60px;">
                                                        <label
                                                            class="content-subtitle fw-bold mt-2 badge-label accreditation">Accreditation</label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <?php if ($profiledata->is_bbb_accredited == 1) { ?>
                                                        <label class="content-title fw-normal d-block"><span
                                                                class="fw-bold">BBB Accredited</span></label>
                                                        <a href="<?= $profiledata->bbb_link ?>"
                                                            class="nsm-link default ms-2" target="_blank">View BBB
                                                            page</a>
                                                        <?php } else { ?>
                                                        <label class="content-title fw-normal d-block">Not
                                                            Accredited</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center credential">
                                                    <div class="col-12 col-md-4 text-center credential-badge">
                                                        <img src="<?= $url->assets . 'img/badge_6.png' ?>"
                                                            style="width: 100%; max-width: 60px;">
                                                        <label
                                                            class="content-subtitle fw-bold mt-2 badge-label verifications">Verifications</label>
                                                    </div>
                                                    <div class="credential-cnt col-md-8">
                                                        <div class="row credential-verification">
                                                            <div class="col-md-6">
                                                                <span class="<?= $profiledata->sm_facebook ? 'bx bx-check-circle active' : 'bx bx-circle' ?>"></span>
                                                                Facebook
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="<?= $profiledata->sm_twitter ? 'bx bx-check-circle active' : 'bx bx-circle' ?>"></span>
                                                                Twitter
                                                            </div>
                                                        </div>

                                                        <div class="row credential-verification">
                                                            <div class="col-md-6">
                                                                <span class="<?= $profiledata->sm_google ? 'bx bx-check-circle active' : 'bx bx-circle' ?>"></span>
                                                                Google
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="<?= $profiledata->sm_youtube ? 'bx bx-check-circle active' : 'bx bx-circle' ?>"></span>
                                                                Youtube
                                                            </div>
                                                        </div>

                                                        <div class="row credential-verification">
                                                            <div class="col-md-6">
                                                                <span class="<?= $profiledata->sm_instagram ? 'bx bx-check-circle active' : 'bx bx-circle' ?>"></span>
                                                                Instagram
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="<?= $profiledata->sm_pinterest ? 'bx bx-check-circle active' : 'bx bx-circle' ?>"></span>
                                                                Pinterest
                                                            </div>
                                                        </div>
                                                        <div class="row credential-verification">
                                                            <div class="col-md-6">
                                                                <span class="<?= $profiledata->sm_linkedin ? 'bx bx-check-circle active' : 'bx bx-circle' ?>"></span>
                                                                LinkedIn
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center credential">
                                                    <div
                                                        class="col-12 col-md-4 text-center position-relative credential-badge">
                                                        <img src="<?= $url->assets . 'img/since-icon.png' ?>"
                                                            style="width: 100%; max-width: 60px;">
                                                        <span
                                                            class=" credential-badge-year-text"><?= $profiledata->year_est > 0 ? $profiledata->year_est : '' ?></span>
                                                        <label
                                                            class="content-subtitle fw-bold mt-2 badge-label since">Since</label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <?php if ($profiledata->year_est > 0) { ?>
                                                        <label class="content-title fw-normal d-block"><span
                                                                class="fw-bold">Business Since :</span>
                                                            <?= $profiledata->year_est ?></label>
                                                        <?php
                                                        $total_years = date('Y') - $profiledata->year_est;
                                                        ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Deals</span>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm"
                                                onclick="location.href='<?php echo base_url('promote/deals'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <?php if ($dealsSteals) { ?>
                                        <div class="row g-3">
                                            <?php foreach ($dealsSteals as $ds) { ?>
                                            <?php
                                            $slug = createSlug($ds->title, '-');
                                            $deal_url = url('deal/' . $slug . '/' . $ds->id);
                                            ?>
                                            <div class="col-12 col-md-4 col-image-<?= $key ?> text-center"
                                                role="button" onclick="window.open('<?= $deal_url ?>')">
                                                <?php
                                                if ($ds->photos != '') {
                                                    $deals_image = base_url('uploads/deals_steals/' . $ds->company_id . '/' . $ds->photos);
                                                    if (!file_exists(FCPATH . 'uploads/deals_steals/' . $ds->company_id . '/' . $ds->photos)) {
                                                        $deals_image = base_url('assets/img/default-deals.jpg');
                                                    }
                                                } else {
                                                    $deals_image = base_url('assets/img/default-deals.jpg');
                                                }
                                                ?>
                                                <img src="<?= $deals_image ?>" style="width: 100%; max-width: 150px;">
                                                <label class="content-title mt-2 d-block"
                                                    role="button"><?= $ds->title ?></label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php } else { ?>
                                        <div class="nsm-empty py-5">
                                            <span>No deals at this moment.</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Portfolio</span>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm"
                                                onclick="location.href='<?php echo base_url('users/portfolio'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <?php
                                        $images = [];
                                        if ($profiledata->work_images != '') {
                                            $images = unserialize($profiledata->work_images);
                                        }
                                        ?>

                                        <?php if ($images) { ?>
                                        <div class="row g-3">
                                            <?php foreach ($images as $key => $i) { ?>
                                            <div class="col-12 col-md-3">
                                                <div class="nsm-card p-0 workspace-item" role="button"
                                                    onclick="location.href='<?php echo base_url('uploads/work_pictures/') . $profiledata->company_id . '/' . $i['file']; ?>'"
                                                    data-caption="<?= $i['caption'] ?>">
                                                    <div class="nsm-card-content">
                                                        <div class="row">
                                                            <div class="col-12 thumbnail-header">
                                                                <div class="nsm-card-thumbnail"
                                                                    style="background-image: url('<?php echo base_url('uploads/work_pictures/') . $profiledata->company_id . '/' . $i['file']; ?>')">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 text-center p-3">
                                                                <div class="nsm-card-title">
                                                                    <span><?= $i['caption'] ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php } else { ?>
                                        <div class="nsm-empty py-5">
                                            <span>No photos have been added yet.</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Reviews (0)</span>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm"
                                                onclick="location.href='3'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="nsm-empty py-5">
                                            <span>There are currently no reviews at this time.</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Business Tags</span>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm"
                                                onclick="location.href='<?php echo base_url('users/profilesetting'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <?php if ($profiledata->business_tags != '') { ?>
                                        <?php $tags = explode(',', $profiledata->business_tags); ?>
                                        <?php foreach ($tags as $t) { ?>
                                        <span class="nsm-badge primary"><?= $t ?></span>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <div class="nsm-empty py-5">
                                            <span>No business tags found.</span>
                                        </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4" id="link-accounts">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Public Profile</span>
                                </div>
                                <div class="nsm-card-controls">
                                    <button type="button" class="nsm-button btn-sm"
                                        onclick="location.href='<?php echo url('users/businessprofile'); ?>'">
                                        <i class='bx bx-fw bx-edit'></i> View
                                    </button>
                                    <?php if(checkRoleCanAccessModule('company-my-business', 'delete')){ ?>    
                                    <button type="button" class="nsm-button btn-sm"
                                        onclick="location.href='<?php echo url('users/businessdetail'); ?>'">
                                        <i class='bx bx-fw bx-edit'></i> Edit
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Business Phone</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <label class="content-subtitle"><?php echo $profiledata->business_phone; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">24/7 Emergency</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <label class="content-subtitle"><?php echo $profiledata->phone_emergency; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Contact Name</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <label class="content-subtitle"><?php echo ucfirst($profiledata->contact_name); ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold"><?php echo $profiledata->business_name; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <label class="content-subtitle d-block"><?php echo $profiledata->address; ?>,</label>
                                        <label class="content-subtitle d-block mt-1"><?php echo $profiledata->city; ?>,
                                            <?php echo $profiledata->state; ?> <?php echo $profiledata->zip; ?></label>
                                        <label class="content-subtitle d-block mt-1">United States</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Website</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <a href="<?php echo $profiledata ? $profiledata->website : ''; ?>" target="_blank"
                                            class="nsm-link"><?php echo $profiledata->website; ?></a>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Quick Facts</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <label class="content-subtitle d-block">Business since
                                            <b><?php echo $profiledata->year_est; ?></b></label>
                                        <label class="content-subtitle d-block mt-1"><?php echo $profiledata->employee_count > 1 ? '<b>' . $profiledata->employee_count . '</b> employees': '<b>' . $profiledata->employee_count . '</b> employee' ; ?></label>
                                        <label class="content-subtitle d-block mt-1">Works with other businesses or
                                            sub-contractors</label>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Availability</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <button type="button" class="nsm-button btn-sm"
                                            onclick="location.href='<?php echo url('users/availability'); ?>'">
                                            <i class='bx bx-fw bx-edit'></i> Edit
                                        </button>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Working Days</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <?php
                                            $days = [];
                                            if(isset($profiledata->working_days)) {
                                                $schedules = unserialize($profiledata->working_days);
                                                $days = [];
                                                foreach ($schedules as $s) {
                                                    $days[] = date('D', strtotime($s['day']));
                                                }
                                            }
                                        ?>
                                        <label class="content-subtitle d-block"><?= count($days) ? implode(' - ', $days) : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Time Off</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <?php
                                        $start_date = str_replace('-', '/', $profiledata->start_time_of_day);
                                        $end_date = str_replace('-', '/', $profiledata->end_time_of_day);
                                        ?>
                                        <?php if (strtotime($start_date) > 0 && strtotime($end_date) > 0) { ?>
                                        <label
                                            class="content-subtitle d-block"><?= date('F j, Y', strtotime($start_date)) . ' to ' . date('F j, Y', strtotime($end_date)) ?></label>
                                        <?php } else { ?>
                                        <label class="content-subtitle d-block">---</label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(checkRoleCanAccessModule('company-link-accounts', 'read')){ ?>    
                        <div class="nsm-card primary mt-4">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Link Accounts</span>
                                </div>
                                <?php if(checkRoleCanAccessModule('company-link-accounts', 'write')){ ?>    
                                <div class="nsm-card-controls">
                                    <button type="button" class="nsm-button btn-sm" id="add-multi-account">
                                        <i class='bx bx-fw bx-edit'></i> Add
                                    </button>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="nsm-card-content">
                                <div id="company-multi-accounts-container"></div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-add-multi-account" tabindex="-1"
        aria-labelledby="modal-add-multi-account-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add-multi-account-form" method="POST">
                <div class="modal-content" style="width:78% !important;">
                    <div class="modal-header">
                        <span class="modal-title content-title"><i class='bx bx-link-alt'></i> Link a company account
                            to <?= $profiledata->business_name ?></span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i
                                class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <p>Please enter the login and password for the company you would like to link to this login</p>
                        <div class="row">
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                                <input type="email" class="form-control" name="multi_email" id="multi-email"
                                    required="">
                            </div>
                            <div class="col-12 mt-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                                <input type="password" class="form-control" name="multi_password"
                                    id="multi-password" required="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-add-multi-account">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label"
        aria-hidden="true" style="margin-top:10%;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        let cropper;
        const imageInput = $("#image-input");
        const imagePreviewContainer = $("#image-preview-container");
        const imagePreviewButtons = $("#image-preview-buttons");
        const imagePreviewChange = $("#image-preview-change");
        const cropActionButton = $("#crop-action-button");

        const imagePreview = $("#image-preview");
        const imagePrevCrop = $("#image-prev-crop");

        const applyCropButton = $("#apply-crop");
        const basicContainer = $("#basic-image-container");
        const cropImageContainer = $("#crop-image-container");

        let triggerChange = false

        $('#btn-w9-form').on('click', function(){
            //let url = base_url + 'uploads/irsw9/fw9.pdf';
            let url = base_url + 'company/download_w9_form';
            window.open(url, '_blank').focus();
        });

        $('#image-input').on('change', function(e) {
            e.preventDefault();
            cropActionButton.show().addClass('d-flex');
            let _parent = $(this).closest(".nsm-img-upload");
            let reader = new FileReader();

            if ($(this)[0].files[0]) {
                reader.readAsDataURL($(this)[0].files[0]);
                reader.onload = function() {
                    let imgPreview = _parent;
                    imgPreview.css("background-image", "url('" + reader.result + "')");
                    imagePreviewChange.hide().removeClass('d-flex');

                    if (triggerChange) {
                        basicContainer.show();
                        imagePreviewContainer.hide();
                    }


                };
            } else {
                cropActionButton.hide().removeClass('d-flex');
            }

        });

        $('#cancel-crop').on('click', function(e) {
            e.preventDefault();
            cropActionButton.hide().removeClass('d-flex');
            cropper.destroy();
            basicContainer.show();
            imagePreviewContainer.hide();
            imagePreviewButtons.hide().removeClass('d-flex');
            cropActionButton.show().addClass('d-flex');
        });


        $('#crop-image').on('click', function(e) {
            e.preventDefault();
            const file = imageInput[0].files[0];

            if (file) {
                cropActionButton.hide().removeClass('d-flex');
                basicContainer.hide();
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.attr('src', event.target.result);
                    imagePreviewContainer.show();
                    imagePreviewButtons.show().addClass('d-flex');

                    applyCropButton.show();


                    cropper = new Cropper(imagePreview[0], {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: "move",
                        preview: ".img-preview",
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        $('#reset-image').on('click', function(e) {
            // $('#image-input').trigger('click');
            imagePreviewContainer.hide();
            imagePreviewChange.hide().removeClass('d-flex');
            basicContainer.show();

            const file = imageInput[0].files[0]
            if (file) {
                cropActionButton.show().addClass('d-flex');

            }
        });

        $('#change-image').on('click', function(e) {
            imageInput.trigger('click');
            triggerChange = true;
        });

        $('#apply-crop').on('click', function(e) {
            e.preventDefault();

            if (cropper) {
                cropper.getCroppedCanvas().toBlob(function(blob) {
                    const croppedFile = new File([blob], "cropped-image.png", {
                        type: 'image/png'
                    });

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    imageInput[0].files = dataTransfer.files;

                    const croppedImageURL = URL.createObjectURL(blob);
                    imagePreview.attr('src', croppedImageURL);

                    imagePreview.addClass('crop-image-container');
                    imagePreviewContainer.css('height', 'unset');


                    imagePreviewButtons.hide().removeClass('d-flex');
                    imagePreviewChange.show().addClass('d-flex');
                    cropper.destroy();
                    basicContainer.hide();
                });
            } else {
                Swal.fire({
                    title: 'Crop Error',
                    text: 'No cropper instance found. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'Okay',
                });
            }
        });



        <?php if(checkRoleCanAccessModule('company-link-accounts', 'read')){ ?>    
        load_multi_accounts_list();
        <?php } ?>

        $("#form-business-details").on("submit", async function(e) {
            e.preventDefault();
            let _this = $(this);

            let formData = new FormData(this);

            const croppedImageSrc = $("#image-preview").attr("src");
            if (croppedImageSrc && croppedImageSrc.startsWith("blob:")) {
                try {
                    const response = await fetch(croppedImageSrc);
                    const blob = await response.blob();

                    formData.append("cropped_image", blob, "cropped-image.png");
                } catch (error) {
                    console.error("Failed to fetch blob from cropped image:", error);
                    Swal.fire({
                        title: "Error",
                        text: "Failed to process the cropped image. Please try again.",
                        icon: "error",
                        confirmButtonText: "Okay",
                    });
                    return;
                }
            }

            // AJAX request
            let url = "<?php echo base_url('users/saveBusinessNameImage'); ?>";
            _this.find("button[type=submit]").html("Saving").prop("disabled", true);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    Swal.fire({
                        title: "Save Successful!",
                        text: "Basic information was successfully updated.",
                        icon: "success",
                        confirmButtonText: "Okay",
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    $("#edit_basic_info_modal").modal("hide");
                    _this.trigger("reset");
                    _this.find("button[type=submit]").html("Save").prop("disabled",
                        false);
                },
                error: function(err) {
                    console.error("Upload failed:", err);
                    _this.find("button[type=submit]").html("Save").prop("disabled",
                        false);
                },
            });
        });


        $('#add-multi-account').on('click', function() {
            $('#multi-email').val('');
            $('#multi-password').val('');

            var url = "<?php echo base_url('mycrm/_check_max_link_account'); ?>";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                success: function(result) {
                    if (result.is_limit == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    } else {
                        $('#modal-add-multi-account').modal('show');
                    }
                }
            });


        });

        function load_multi_accounts_list() {
            var url = base_url + 'mycrm/_load_multi_account_list';

            $('#company-multi-accounts-container').html('<span class="bx bx-loader bx-spin"></span>');

            setTimeout(function() {
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(o) {
                        $('#company-multi-accounts-container').html(o);
                    }
                });
            }, 500);
        }

        $('#add-multi-account-form').on('submit', function(e) {
            e.preventDefault();

            var url = base_url + 'mycrm/_add_multi_account';
            var form = $(this);

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: form.serialize(),
                success: function(data) {

                    $('#btn-add-multi-account').html('Save');
                    $('#btn-add-multi-account').prop("disabled", false);

                    if (data.is_success == 1) {
                        $('#modal-add-multi-account').modal('hide');
                        $('#multi-email').val('');
                        $('#multi-password').val('');

                        Swal.fire({
                            html: 'An email was sent to <b>' + data.email +
                                '</b> to activate and verify account.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#6a4a86',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            load_multi_accounts_list();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: data.msg
                        });
                    }
                },
                beforeSend: function() {
                    $('#btn-add-multi-account').html(
                        '<span class="bx bx-loader bx-spin"></span>');
                    //$('#btn-add-multi-account').find("button[type=submit]").prop("disabled", true);    
                }
            });
        });

        $(document).on('click', '.btn-delete-multi-account', function() {
            var mid = $(this).attr("data-id");
            var company_name = $(this).attr('data-companyname');
            var url = base_url + 'mycrm/_delete_multi_account';

            Swal.fire({
                title: 'Delete Multi Account',
                html: "Are you sure you want to delete multi account from company <b>" +
                    company_name + "</b>?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: {
                            mid: mid
                        },
                        success: function(o) {
                            if (o.is_success == 1) {
                                Swal.fire({
                                    html: "Multi account was deleted successfully",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    load_multi_accounts_list();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: o.msg
                                });
                            }
                        },
                    });
                }
            });
        });

        $(document).on('click', '.btn-resend-activation', function() {
            var uid = $(this).attr("data-userid");
            var user_email = $(this).attr('data-email');
            var url = base_url + 'mycrm/_resend_multi_account_activation_email';

            Swal.fire({
                title: 'Resend Activation Link',
                html: "Are you sure you want to send activation link to <b>" + user_email +
                    "</b>?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $('#loading_modal').modal('show');
                    $('#loading_modal .modal-body').html(
                        '<span class="bx bx-loader bx-spin"></span> Sending email....');

                    setTimeout(function() {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            dataType: 'json',
                            data: {
                                uid: uid
                            },
                            success: function(o) {
                                $('#loading_modal').modal('hide');
                                if (o.is_success == 1) {
                                    Swal.fire({
                                        html: "Email activation link was sent successfully",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {

                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        html: o.msg
                                    });
                                }
                            },
                            beforeSend: function() {

                            }
                        });
                    }, 500);
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
