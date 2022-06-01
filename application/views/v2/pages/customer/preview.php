<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer'); ?>'">
                                <i class='bx bx-fw bx-search-alt'></i> Find Customer
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer/module/' . $this->uri->segment(3)); ?>'">
                                <i class='bx bx-fw bx-tachometer'></i> Customer Dashboard
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer/add_advance/' . $this->uri->segment(3)); ?>'">
                                <i class='bx bx-fw bx-user'></i> Edit Customer
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-chart'></i> Credit Report
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-file-blank'></i> Scanned Documents
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-box'></i> Inventory Details
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?= base_url('customer/billing/' . $this->uri->segment(3)); ?>'">
                                <i class='bx bx-fw bx-receipt'></i> Bill Customer
                            </button>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-12">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Account Number: <?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Online: <?= !empty($alarm_info->online) ? $alarm_info->online : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">In Service: <?= !empty($alarm_info->in_service) ? $alarm_info->in_service : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Status: <?= !empty($profile_info->status) ? $profile_info->status : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Equipment: <?= !empty($alarm_info->equipment) ? $alarm_info->equipment : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Collections: <?= !empty($alarm_info->collections) ? $alarm_info->collections : '---'; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Rep Paper" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input <?= isset($papers->rep_paper_date) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="rep_paper_date" id="rep_paper" disabled>
                                            </div>
                                            <input value="<?= isset($papers->rep_paper_date) ? $papers->rep_paper_date : "" ?>" type="text" class="form-control nsm-field" name="rep_paper_date" id="rep_paper_date" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Tech Paper" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input <?= isset($papers->tech_paper_date) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="tech_paper_date" disabled>
                                            </div>
                                            <input value="<?= isset($papers->tech_paper_date) ? $papers->tech_paper_date : "" ?>" type="text" class="form-control nsm-field" name="tech_paper_date" id="tech_paper_date" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Scanned" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input <?= isset($papers->scanned_date) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="scanned_date" disabled>
                                            </div>
                                            <input value="<?= isset($papers->scanned_date) ? $papers->scanned_date : "" ?>" type="text" class="form-control nsm-field" name="scanned_date" id="scanned_date" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Paperwork" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input class="form-check-input mt-0" type="checkbox" value="scanned_date">
                                            </div>
                                            <select class="nsm-field form-select" name="paperwork" id="paperwork">
                                                <option value="" selected="selected">Select</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Rejected">Rejected</option>
                                                <option value="Pending Kept">Pending Kept</option>
                                                <option value="Pending Sent">Pending Sent</option>
                                                <option value="None">None</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Submitted" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input <?= isset($papers->submitted) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="submitted" disabled>
                                            </div>
                                            <input value="<?= isset($papers->submitted) ? $papers->submitted : "" ?>" type="text" class="form-control nsm-field" name="submitted" id="submitted" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Rep Paid" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control nsm-field" name="rep_paid" id="rep_paid" disabled min="0" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Tech Paid" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control nsm-field" name="tech_paid" id="tech_paid" disabled min="0">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Funded" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input <?= isset($papers->funded) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="funded" disabled>
                                            </div>
                                            <input value="<?= isset($papers->funded) ? $papers->funded : "" ?>" type="text" class="form-control nsm-field" name="funded" id="funded" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Charged Back" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input <?= isset($papers->charged_back) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="charged_back" disabled>
                                            </div>
                                            <input value="<?= isset($papers->charged_back) ? $papers->charged_back : "" ?>" type="text" class="form-control nsm-field" name="charged_back" id="charged_back" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_customer_info'); ?>
                    </div>
                    <div class="col-12 col-md-4">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_office_info'); ?>
                    </div>
                    <div class="col-12 col-md-4">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_alarm_info'); ?>
                    </div>
                    <div class="col-12">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_notes_info'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url('assets/js/customer/components/FieldCustomName.js');?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#copyLink").on("click", function(){
            var copyText = document.getElementById("sharableLink");
            copyText.select();
            document.execCommand("copy");
        });

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>