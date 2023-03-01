<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

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
                                            <span><?php echo $profiledata->business_name ?></span>
                                            <label class="content-subtitle d-block"><?php echo $profiledata->city ?>, <?php echo $profiledata->state ?></label>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm" data-bs-toggle="modal" data-bs-target="#edit_basic_info_modal">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
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
                                            <button type="button" class="nsm-button btn-sm" onclick="location.href='<?php echo base_url('users/services'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <?php foreach ($selectedCategories as $s) : ?>
                                            <span class="nsm-badge primary"><?= $s->service_name; ?></span>
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
                                            <button type="button" class="nsm-button btn-sm" onclick="location.href='<?php echo base_url('users/credentials'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center">
                                                    <div class="col-12 col-md-2 text-center">
                                                        <img src="<?= $url->assets . "img/badge_1.png" ?>" style="width: 100%; max-width: 60px;">
                                                        <label class="content-subtitle fw-bold mt-2">License</label>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <?php if ($profiledata->is_licensed == 1) { ?>
                                                            <label class="content-title fw-normal d-block"><span class="fw-bold">State/Province :</span> <?= $profiledata->license_state; ?>, Expires on: <?= date("m/d/Y", strtotime($profiledata->license_expiry_date)); ?></label>
                                                            <label class="content-title fw-normal d-block"><span class="fw-bold">Class :</span> <?= $profiledata->license_class; ?>, Nr:<?= $profiledata->license_number; ?></label>

                                                            <?php if ($profiledata->license_image != '') { ?>
                                                                <div class="mt-3">
                                                                    <img src="<?php echo (licenseImage($profiledata->id)) ? licenseImage($profiledata->id) : $url->assets ?>" style="width: 25px; aspect-ratio: 1;">
                                                                    <a href="<?php echo (licenseImage($profiledata->id)) ? licenseImage($profiledata->id) : $url->assets ?>" class="nsm-link default ms-2" target="_blank">View License</a>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <label class="content-title fw-normal d-block">Not Licensed</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center">
                                                    <div class="col-12 col-md-2 text-center">
                                                        <img src="<?= $url->assets . "img/badge_2.png" ?>" style="width: 100%; max-width: 60px;">
                                                        <label class="content-subtitle fw-bold mt-2">Bond</label>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <?php if ($profiledata->is_bonded == 1) { ?>
                                                            <label class="content-title fw-normal d-block"><span class="fw-bold">Insured Amount :</span> $<?= number_format($profiledata->bond_amount, 2); ?></label>
                                                            <label class="content-title fw-normal d-block"><span class="fw-bold">Expires on :</span> <?= date("m/d/Y", strtotime($profiledata->bond_expiry_date)); ?></label>

                                                            <?php if ($profiledata->bond_image != '') { ?>
                                                                <div class="mt-3">
                                                                    <img src="<?php echo (bondImage($profiledata->id)) ? bondImage($profiledata->id) : $url->assets ?>" style="width: 25px; aspect-ratio: 1;">
                                                                    <a href="<?php echo (bondImage($profiledata->id)) ? bondImage($profiledata->id) : $url->assets ?>" class="nsm-link default ms-2" target="_blank">View Bonded</a>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <label class="content-title fw-normal d-block">Not Bonded</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center">
                                                    <div class="col-12 col-md-2 text-center">
                                                        <img src="<?= $url->assets . "img/badge_3.png" ?>" style="width: 100%; max-width: 60px;">
                                                        <label class="content-subtitle fw-bold mt-2">Insurance</label>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <?php if ($profiledata->is_business_insured == 1) { ?>
                                                            <label class="content-title fw-normal d-block"><span class="fw-bold">Insured Amount :</span> $<?= number_format($profiledata->insured_amount, 2); ?></label>
                                                            <label class="content-title fw-normal d-block"><span class="fw-bold">Expires on :</span> <?= date("m/d/Y", strtotime($profiledata->insurance_expiry_date)); ?></label>
                                                        <?php } else { ?>
                                                            <label class="content-title fw-normal d-block">Not Insured</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center">
                                                    <div class="col-12 col-md-2 text-center">
                                                        <img src="<?= $url->assets . "img/badge_4.png" ?>" style="width: 100%; max-width: 60px;">
                                                        <label class="content-subtitle fw-bold mt-2">Accreditation</label>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <?php if ($profiledata->is_bbb_accredited == 1) { ?>
                                                            <label class="content-title fw-normal d-block"><span class="fw-bold">BBB Accredited</span></label>
                                                            <a href="<?= $profiledata->bbb_link; ?>" class="nsm-link default ms-2" target="_blank">View BBB page</a>
                                                        <?php } else { ?>
                                                            <label class="content-title fw-normal d-block">Not Accredited</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center">
                                                    <div class="col-12 col-md-2 text-center">
                                                        <img src="<?= $url->assets . "img/badge_6.png" ?>" style="width: 100%; max-width: 60px;">
                                                        <label class="content-subtitle fw-bold mt-2">Verifications</label>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <div class="row g-3">
                                                            <div class="col-12 col-md-6">
                                                                <label class="content-title fw-normal d-block mb-2"><i class='bx bx-fw bx-check-circle nsm-text-success'></i> Phone</label>
                                                                <label class="content-title fw-normal d-block"><i class='bx bx-fw bx-circle'></i> Facebook</label>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <label class="content-title fw-normal d-block mb-2"><i class='bx bx-fw bx-check-circle nsm-text-success'></i> Email</label>
                                                                <label class="content-title fw-normal d-block"><i class='bx bx-fw bx-check-circle nsm-text-success'></i> Google</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row g-3 mt-1 align-items-center">
                                                    <div class="col-12 col-md-2 text-center position-relative">
                                                        <img src="<?= $url->assets . "img/badge_5.png" ?>" style="width: 100%; max-width: 60px;">
                                                        <span class="position-absolute fw-bold" style="top: 14px; left: 0; right: 0; color: #f69342;"><?= $profiledata->year_est > 0 ? $profiledata->year_est : ''; ?></span>
                                                        <label class="content-subtitle fw-bold mt-2">Since</label>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <?php if ($profiledata->year_est > 0) { ?>
                                                            <label class="content-title fw-normal d-block"><span class="fw-bold">Business Since :</span> <?= $profiledata->year_est; ?></label>
                                                            <?php
                                                            $total_years = date("Y") - $profiledata->year_est;
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
                                            <button type="button" class="nsm-button btn-sm" onclick="location.href='<?php echo base_url('promote/deals'); ?>'">
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
                                                    <div class="col-12 col-md-2 col-image-<?= $key ?> text-center" role="button" onclick="window.open('<?= $deal_url; ?>')">
                                                        <?php
                                                        if ($ds->photos != '') {
                                                            $deals_image = base_url("uploads/deals_steals/" . $ds->company_id . "/" . $ds->photos);
                                                            if (!file_exists(FCPATH . "uploads/deals_steals/"  . $ds->company_id . "/" . $ds->photos)) {
                                                                $deals_image = base_url("assets/img/default-deals.jpg");
                                                            }
                                                        } else {
                                                            $deals_image = base_url("assets/img/default-deals.jpg");
                                                        }
                                                        ?>
                                                        <img src="<?= $deals_image; ?>" style="width: 100%; max-width: 150px;">
                                                        <label class="content-title mt-2 d-block" role="button"><?= $ds->title; ?></label>
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
                                            <button type="button" class="nsm-button btn-sm" onclick="location.href='<?php echo base_url('users/portfolio'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <?php
                                        $images = array();
                                        if ($profiledata->work_images != '') {
                                            $images = unserialize($profiledata->work_images);
                                        }
                                        ?>

                                        <?php if ($images) { ?>
                                            <div class="row g-3">
                                                <?php foreach ($images as $key => $i) { ?>
                                                    <div class="col-12 col-md-3">
                                                        <div class="nsm-card p-0 workspace-item" role="button" onclick="location.href='<?php echo base_url('uploads/work_pictures/') . $profiledata->company_id . '/' . $i['file']; ?>'" data-caption="<?= $i['caption']; ?>">
                                                            <div class="nsm-card-content">
                                                                <div class="row">
                                                                    <div class="col-12 thumbnail-header">
                                                                        <div class="nsm-card-thumbnail" style="background-image: url('<?php echo base_url('uploads/work_pictures/') . $profiledata->company_id . '/' . $i['file']; ?>')"></div>
                                                                    </div>
                                                                    <div class="col-12 text-center p-3">
                                                                        <div class="nsm-card-title">
                                                                            <span><?= $i['caption']; ?></span>
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
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Reviews (0)</span>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm" onclick="location.href='3'">
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
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Business Tags</span>
                                        </div>
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm" onclick="location.href='<?php echo base_url('users/profilesetting'); ?>'">
                                                <i class='bx bx-fw bx-edit'></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <?php if ($profiledata->business_tags != '') { ?>
                                            <?php $tags = explode(",", $profiledata->business_tags); ?>
                                            <?php foreach ($tags as $t) { ?>
                                                <span class="nsm-badge primary"><?= $t; ?></span>
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
                                    <button type="button" class="nsm-button btn-sm" onclick="location.href='<?php echo url('users/businessprofile'); ?>'">
                                        <i class='bx bx-fw bx-edit'></i> View
                                    </button>
                                    <button type="button" class="nsm-button btn-sm" onclick="location.href='<?php echo url('users/businessdetail') ?>'">
                                        <i class='bx bx-fw bx-edit'></i> Edit
                                    </button>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Business Phone</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <label class="content-subtitle"><?php echo $profiledata->business_phone ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">24/7 Emergency</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <label class="content-subtitle"><?php echo $profiledata->phone_emergency ?></label>
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
                                        <label class="content-subtitle d-block"><?php echo $profiledata->address ?>,</label>
                                        <label class="content-subtitle d-block mt-1"><?php echo $profiledata->city ?>, <?php echo $profiledata->state ?> <?php echo $profiledata->zip ?></label>
                                        <label class="content-subtitle d-block mt-1">United States</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Website</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <a href="<?php echo ($profiledata) ? $profiledata->website : ''; ?>" target="_blank" class="nsm-link"><?php echo $profiledata->website ?></a>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Quick Facts</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <label class="content-subtitle d-block">Business since <b><?php echo $profiledata->year_est ?></b></label>
                                        <label class="content-subtitle d-block mt-1"><b><?php echo $profiledata->employee_count ?></b> employees</label>
                                        <label class="content-subtitle d-block mt-1">Works with other businesses or sub-contractors</label>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Availability</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <button type="button" class="nsm-button btn-sm" onclick="location.href='<?php echo url('users/availability'); ?>'">
                                            <i class='bx bx-fw bx-edit'></i> Edit
                                        </button>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Working Days</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <?php
                                        $schedules = unserialize($profiledata->working_days);
                                        $days = array();
                                        foreach ($schedules as $s) {
                                            $days[] = date("D", strtotime($s['day']));
                                        }
                                        ?>
                                        <label class="content-subtitle d-block"><?= implode(" - ", $days); ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Time Off</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <?php
                                        $start_date = str_replace("-", "/", $profiledata->start_time_of_day);
                                        $end_date   = str_replace("-", "/", $profiledata->end_time_of_day);
                                        ?>
                                        <?php if (strtotime($start_date) > 0 && strtotime($end_date) > 0) { ?>
                                            <label class="content-subtitle d-block"><?= date("F j, Y", strtotime($start_date)) . ' to ' . date("F j, Y", strtotime($end_date)); ?></label>
                                        <?php } else { ?>
                                            <label class="content-subtitle d-block">---</label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nsm-card primary mt-4">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Link Accounts</span>
                                </div>
                                <div class="nsm-card-controls">                                    
                                    <button type="button" class="nsm-button btn-sm" id="add-multi-account">
                                        <i class='bx bx-fw bx-edit'></i> Add
                                    </button>                                    
                                </div>
                            </div>
                            <div class="nsm-card-content"><div id="company-multi-accounts-container"></div></div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-add-multi-account" tabindex="-1" aria-labelledby="modal-add-multi-account-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add-multi-account-form" method="POST">
                <div class="modal-content" style="width:78% !important;">
                    <div class="modal-header">
                        <span class="modal-title content-title"><i class='bx bx-link-alt'></i> Link a company account to <?= $profiledata->business_name; ?></span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <p>Please enter the login and password for the company you would like to link to this login</p>
                        <div class="row">
                            <div class="col-12">                                
                                <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                                <input type="email" class="form-control" name="multi_email" id="multi-email" required="">                                
                            </div>
                            <div class="col-12 mt-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                                <input type="password" class="form-control" name="multi_password" id="multi-password" required="">
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

    <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {

        load_multi_accounts_list();

        $("#form-business-details").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('users/saveBusinessNameImage'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Basic information was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    $("#edit_basic_info_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $('#add-multi-account').on('click', function(){
            $('#multi-email').val('');
            $('#multi-password').val('');
            $('#modal-add-multi-account').modal('show');
        });

        function load_multi_accounts_list(){
            var url  = base_url + 'mycrm/_load_multi_account_list';
            
            $('#company-multi-accounts-container').html('<span class="bx bx-loader bx-spin"></span>'); 

            setTimeout(function () {
              $.ajax({
                 type: "GET",
                 url: url,
                 success: function(o)
                 {          
                    $('#company-multi-accounts-container').html(o);
                 }
              });
            }, 500);   
        }

        $('#add-multi-account-form').on('submit', function(e){
            e.preventDefault();

            var url  = base_url + 'mycrm/_add_multi_account';
            var form = $(this);

            $.ajax({
                type: "POST",
                url: url,
                dataType:'json',
                data: form.serialize(), 
                success: function(data) {
                    
                    $('#btn-add-multi-account').html('Save'); 
                    $('#btn-add-multi-account').prop("disabled", false);

                    if( data.is_success == 1 ){
                        $('#modal-add-multi-account').modal('hide');
                        $('#multi-email').val('');
                        $('#multi-password').val('');

                        Swal.fire({
                            html: 'An email was sent to <b>' + data.email + '</b> to activate and verify account.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#6a4a86',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            load_multi_accounts_list();
                        });    
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: data.msg
                        });
                    }
                }, beforeSend: function() {
                    $('#btn-add-multi-account').html('<span class="bx bx-loader bx-spin"></span>'); 
                    //$('#btn-add-multi-account').find("button[type=submit]").prop("disabled", true);    
                }
            });            
        });

        $(document).on('click', '.btn-delete-multi-account', function(){
            var mid = $(this).attr("data-id");
            var company_name = $(this).attr('data-companyname');
            var url = base_url + 'mycrm/_delete_multi_account';

            Swal.fire({
                title: 'Delete Multi Account',
                html: "Are you sure you want to delete multi account from company <b>"+company_name+"</b>?",
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
                        data: {mid:mid},
                        success: function(o) {
                            if( o.is_success == 1 ){   
                                Swal.fire({
                                    html: "Multi account was deleted successfully",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    load_multi_accounts_list();
                                });
                            }else{
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

        $(document).on('click', '.btn-resend-activation', function(){
            var uid = $(this).attr("data-userid");
            var user_email = $(this).attr('data-email');
            var url = base_url + 'mycrm/_resend_multi_account_activation_email';

            Swal.fire({
                title: 'Resend Activation Link',
                html: "Are you sure you want to send activation link to <b>"+user_email+"</b>?",
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
                        data: {uid:uid},
                        success: function(o) {
                            $('#loading_modal').modal('hide');
                            if( o.is_success == 1 ){   
                                Swal.fire({
                                    html: "Email activation link was sent successfully",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    
                                });
                            }else{
                              Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: o.msg
                              });
                            }
                        },beforeSend: function() {
                            $('#loading_modal').modal('show');
                            $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Sending email....');
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>