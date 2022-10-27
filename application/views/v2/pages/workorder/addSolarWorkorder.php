<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>

<!-- Script for autosaving form -->
<!-- <script src="<?=base_url("assets/js/workorder/autosave-solar.js")?>"></script> -->

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <?php echo form_open_multipart('workorder/savenewWorkorderSolar', ['class' => 'form-validate', 'id' => 'form_new_solar_workorder', 'autocomplete' => 'off']); ?>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">Header</span>
                                    <div class="row">
                                        <div class="col-12 col-md-10">
                                            <label class="nsm-subtitle">
                                                <?php echo $headers->content; ?>
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-2 text-md-end">
                                            <img style="width: 100%; max-width: 100px;" src="<?= getCompanyBusinessProfileImage(); ?>"/>
                                            <!-- <img style="width: 100%; max-width: 100px;" src="https://www.nsmartrac.com/uploads/users/business_profile/1/logo-1-1650221647656.jpg?1660797534" /> -->
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $dt = new DateTime();
                                $timestamp = time();
                                ?>
                                <input type="hidden" id="headerID" name="header" value="<?php echo $headers->content; ?>">
                                <input type="hidden" id="current_date" name="current_date" value="<?php echo @date('m-d-Y'); ?>">
                                <input type="hidden" name="wo_id" value="<?php foreach ($ids as $id) {
                                                                                $add = $id->id + 1;
                                                                                echo $add;
                                                                            } ?>">
                                <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                                <input type="hidden" id="current_date" value="<?= date('m-d-Y'); ?>">
                                <input type="hidden" id="content_input" class="form-control" name="header2" value="<?php echo $headers->content; ?>">
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Work Order Number</label>
                                        <input type="text" name="workorder_number" id="workorder_number" class="nsm-field form-control" value="<?php echo "WO-";
                                                                                                                                                foreach ($number as $num) :
                                                                                                                                                    $next = $num->work_order_number;
                                                                                                                                                    $arr = explode("-", $next);
                                                                                                                                                    $date_start = $arr[0];
                                                                                                                                                    $nextNum = $arr[1];
                                                                                                                                                //    echo $number;
                                                                                                                                                endforeach;
                                                                                                                                                $val = $nextNum + 1;
                                                                                                                                                echo str_pad($val, 7, "0", STR_PAD_LEFT);
                                                                                                                                                ?>" readonly required />
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Lead Source</label>
                                        <select class="nsm-field form-select" name="lead_source" id="lead_source">
                                            <option value="0">- none -</option>
                                            <?php foreach ($lead_source as $lead) { ?>
                                                <option value="<?php echo $lead->ls_id; ?>"><?php echo $lead->ls_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">System Type</label>
                                        <select class="nsm-field form-select" name="system_type" id="system_type">
                                            <option value="0">- none -</option>
                                            <?php foreach ($system_package_type as $lead) { ?>
                                                <option value="<?php echo $lead->name; ?>"><?php echo $lead->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                                        <select class="nsm-field form-select" name="status" id="workorder_status">
                                            <option <?= $workorder->w_status == 'New' ? 'selected="selected"' : ''; ?> value="New">New</option>
                                            <option <?= $workorder->w_status == 'Draft' ? 'selected="selected"' : ''; ?> value="Draft">Draft</option>
                                            <option <?= $workorder->w_status == 'Scheduled' ? 'selected="selected"' : ''; ?> value="Scheduled">Scheduled</option>
                                            <option <?= $workorder->w_status == 'Started' ? 'selected="selected"' : ''; ?> value="Started">Started</option>
                                            <option <?= $workorder->w_status == 'Paused' ? 'selected="selected"' : ''; ?> value="Paused">Paused</option>
                                            <option <?= $workorder->w_status == 'Completed' ? 'selected="selected"' : ''; ?> value="Completed">Completed</option>
                                            <option <?= $workorder->w_status == 'Invoiced' ? 'selected="selected"' : ''; ?> value="Invoiced">Invoiced</option>
                                            <option <?= $workorder->w_status == 'Withdrawn' ? 'selected="selected"' : ''; ?> value="Withdrawn">Withdrawn</option>
                                            <option <?= $workorder->w_status == 'Closed' ? 'selected="selected"' : ''; ?> value="Closed">Closed</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">Jobs Tags</label>
                                        <select class="nsm-field form-select" name="job_tags" id="job_tags">
                                            <option value="0">- none -</option>
                                            <?php foreach ($job_tags as $jb) { ?>
                                                <option value="<?php echo $jb->id; ?>"><?php echo $jb->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">Qualification Information for Solar</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row mt-5">
                                    <div class="col-12 col-md-1">
                                        <div class="d-flex align-items-center justify-content-center py-3" style="background-color: #6a4a8624; color: #6a4a86; border-radius: 5px;">A</div>
                                    </div>
                                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-md-0">
                                        <label class="content-subtitle fw-bold d-block mb-2">Type of Roof</label>
                                        <div class="w-100">
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="tor" id="roof_1" value="Asphalt Single">
                                                <label class="form-check-label" for="roof_1">Asphalt Single</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="tor" id="roof_2" value="Flat">
                                                <label class="form-check-label" for="roof_2">Flat</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="tor" id="roof_3" value="Concrete Tile">
                                                <label class="form-check-label" for="roof_3">Concrete Tile</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="tor" id="roof_4" value="Clay Tile">
                                                <label class="form-check-label" for="roof_4">Clay Tile</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="tor" id="roof_5" value="Steel Single">
                                                <label class="form-check-label" for="roof_5">Steel Single</label>
                                            </div>
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="radio" name="tor" id="roof_6" value="Metal">
                                                <label class="form-check-label" for="roof_6">Metal</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-md-1">
                                        <div class="d-flex align-items-center justify-content-center py-3" style="background-color: #6a4a8624; color: #6a4a86; border-radius: 5px;">B</div>
                                    </div>
                                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-md-0">
                                        <label class="content-subtitle fw-bold d-block mb-2">Square Footage of Home</label>
                                        <input type="text" name="sfoh" class="nsm-field form-control">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-md-1">
                                        <div class="d-flex align-items-center justify-content-center py-3" style="background-color: #6a4a8624; color: #6a4a86; border-radius: 5px;">C</div>
                                    </div>
                                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-md-0">
                                        <label class="content-subtitle fw-bold d-block mb-2">Age of Roof (Years)</label>
                                        <div class="w-100">
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="aor" id="aor_1" value="0-5">
                                                <label class="form-check-label" for="aor_1">0-5</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="aor" id="aor_2" value="5-10">
                                                <label class="form-check-label" for="aor_2">5-10</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="aor" id="aor_3" value="10-15">
                                                <label class="form-check-label" for="aor_3">10-15</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="aor" id="aor_4" value="15-20">
                                                <label class="form-check-label" for="aor_4">15-20</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-md-1">
                                        <div class="d-flex align-items-center justify-content-center py-3" style="background-color: #6a4a8624; color: #6a4a86; border-radius: 5px;">D</div>
                                    </div>
                                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-md-0">
                                        <label class="content-subtitle fw-bold d-block mb-2">Solar Panel Mounting Preference</label>
                                        <div class="w-100">
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="spmp" id="spmp_1" value="Front Only">
                                                <label class="form-check-label" for="spmp_1">Front Only</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="spmp" id="spmp_2" value="Back Only">
                                                <label class="form-check-label" for="spmp_2">Back Only</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="spmp" id="spmp_3" value="Side Only">
                                                <label class="form-check-label" for="spmp_3">Side Only</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="spmp" id="spmp_4" value="No Preference">
                                                <label class="form-check-label" for="spmp_4">No Preference</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="spmp" id="spmp_5" value="Other">
                                                <label class="form-check-label" for="spmp_5">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-md-1">
                                        <div class="d-flex align-items-center justify-content-center py-3" style="background-color: #6a4a8624; color: #6a4a86; border-radius: 5px;">E</div>
                                    </div>
                                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-md-0">
                                        <label class="content-subtitle fw-bold d-block mb-2">Home Owner Associations</label>
                                        <div class="w-100">
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="hoa" id="hoa_1" value="Yes">
                                                <label class="form-check-label" for="hoa_1">Yes</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="hoa" id="hoa_2" value="No">
                                                <label class="form-check-label" for="hoa_2">No</label>
                                            </div>
                                        </div>

                                        <label class="content-subtitle fw-bold d-block mb-2">If Yes: Contact Name/Number</label>
                                        <input type="text" name="hoa_text" class="nsm-field form-control">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-md-1">
                                        <div class="d-flex align-items-center justify-content-center py-3" style="background-color: #6a4a8624; color: #6a4a86; border-radius: 5px;">F</div>
                                    </div>
                                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-md-0">
                                        <div class="row gx-3">
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Electric Bill is over $100</label>
                                                <div class="w-100">
                                                    <div class="form-check d-inline-block me-2">
                                                        <input class="form-check-input" type="radio" name="ebis" id="ebis_1" value="Yes">
                                                        <label class="form-check-label" for="ebis_1">Yes</label>
                                                    </div>
                                                    <div class="form-check d-inline-block me-2">
                                                        <input class="form-check-input" type="radio" name="ebis" id="ebis_2" value="No">
                                                        <label class="form-check-label" for="ebis_2">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Estimated Bill</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" name="estimated_bill" class="nsm-field form-control text-end" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <label class="content-subtitle fw-bold d-block mb-2 mt-2">How do you get your Invoice</label>
                                        <div class="w-100">
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="hdygi" id="hdygi_1" value="Paper">
                                                <label class="form-check-label" for="hdygi_1">Paper</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="hdygi" id="hdygi_2" value="Paperless">
                                                <label class="form-check-label" for="hdygi_2">Paperless</label>
                                            </div>
                                        </div>
                                        <div class="w-100 mt-3">
                                            <div class="nsm-img-upload m-auto">
                                                <span class="nsm-upload-label disable-select">Drop or click to upload file</span>
                                                <input type="file" name="hdygi_file[]" class="nsm-upload">
                                            </div>
                                        </div>
                                        <div class="w-100 mt-3">
                                            <label class="content-subtitle fw-bold d-block mb-2">Electric Bill Account Number</label>
                                            <input type="text" name="eba_text" class="nsm-field form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-md-1">
                                        <div class="d-flex align-items-center justify-content-center py-3" style="background-color: #6a4a8624; color: #6a4a86; border-radius: 5px;">G</div>
                                    </div>
                                    <div class="col-12 col-md-10 offset-1">
                                        <label class="content-subtitle fw-bold d-block mb-2">Employment Status</label>
                                        <div class="w-100">
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="es" id="es_1" value="Employed">
                                                <label class="form-check-label" for="es_1">Employed</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="es" id="es_2" value="Unemployed">
                                                <label class="form-check-label" for="es_2">Unemployed</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="es" id="es_3" value="Retired">
                                                <label class="form-check-label" for="es_3">Retired</label>
                                            </div>
                                            <div class="form-check d-inline-block me-2">
                                                <input class="form-check-input" type="radio" name="es" id="es_4" value="Retired with Income">
                                                <label class="form-check-label" for="es_4">Retired with Income</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="d-block">Please Fill in the Details</span>
                                            <label class="content-subtitle">Please fill in the form completely, and return it to a solar specialist or email to support@adtsolarpro.com for consideration.</label>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">First name</label>
                                                <input type="text" name="firstname" id="firstname" class="nsm-field form-control name-field">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Last name</label>
                                                <input type="text" name="lastname" id="lastname" class="nsm-field form-control name-field">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                                                <input type="text" name="address" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">City</label>
                                                <input type="text" name="city" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">County</label>
                                                <input type="text" name="country" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Postcode</label>
                                                <input type="text" name="postcode" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
                                                <input type="text" name="phone" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Mobile</label>
                                                <input type="text" name="mobile" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                                                <input type="email" name="email" class="nsm-field form-control">
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Comments</label>
                                                <input type="text" name="comments" class="nsm-field form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="d-block">Energy Usage History Sample</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-1">
                                            <div class="col-12">
                                                <canvas id="solar_chart" class="nsm-chart"></canvas>
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Options</label>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input" type="checkbox" name="options[]" id="roof" value="roof">
                                                    <label class="form-check-label" for="roof">Roof</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input" type="checkbox" name="options[]" id="tree_removal" value="tree removal">
                                                    <label class="form-check-label" for="tree_removal">Tree Removal</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input" type="checkbox" name="options[]" id="battery_package" value="battery package">
                                                    <label class="form-check-label" for="battery_package">Battery Package</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input" type="checkbox" name="options[]" id="security" value="security">
                                                    <label class="form-check-label" for="security">Security</label>
                                                </div>
                                                <div class="form-check d-inline-block me-2">
                                                    <input class="form-check-input" type="checkbox" name="options[]" id="others" value="others">
                                                    <label class="form-check-label" for="others">Others</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="d-block">Payment Detail</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Payment Method</label>
                                                <select name="payment_method" id="payment_method" class="nsm-field form-select">
                                                    <option value="">Choose method</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Check">Check</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Debit Card">Debit Card</option>
                                                    <option value="ACH">ACH</option>
                                                    <option value="Venmo">Venmo</option>
                                                    <option value="Paypal">Paypal</option>
                                                    <option value="Square">Square</option>
                                                    <option value="Invoicing">Invoicing</option>
                                                    <option value="Warranty Work">Warranty Work</option>
                                                    <option value="Home Owner Financing">Home Owner Financing</option>
                                                    <option value="e-Transfer">e-Transfer</option>
                                                    <option value="Other Credit Card Professor">Other Credit Card Professor</option>
                                                    <option value="Other Payment Type">Other Payment Type</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Amount ( $ )</label>
                                                <input type="text" name="payment_amount" class="nsm-field form-control" required />
                                            </div>
                                            <div class="col-12 col-md-4 d-none" id="cash_area">
                                                <div class="d-flex align-items-center h-100">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="collected_checkbox">
                                                        <label class="form-check-label" for="collected_checkbox">Cash collected already</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="invoicing">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="same_as">
                                                            <label class="form-check-label" for="same_as">Same as above Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Mail Address</label>
                                                        <input type="text" name="mail-address" class="nsm-field form-control" placeholder="Monitored Location" />
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label class="content-subtitle fw-bold d-block mb-2">City</label>
                                                        <input type="text" name="mail_locality" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="content-subtitle fw-bold d-block mb-2">State</label>
                                                        <input type="text" name="mail_state" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label class="content-subtitle fw-bold d-block mb-2">ZIP</label>
                                                        <input type="text" name="mail_postcode" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Cross Street</label>
                                                        <input type="text" name="mail_cross_street" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="check_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Check Number</label>
                                                        <input type="text" name="check_number" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Routing Number</label>
                                                        <input type="text" name="routing_number" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Number</label>
                                                        <input type="text" name="account_number" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="credit_card">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                        <input type="text" name="credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                        <input type="text" name="credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                        <input type="text" name="credit_cvc" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="debit_card">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                        <input type="text" name="debit_credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                        <input type="text" name="debit_credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                        <input type="text" name="debit_credit_cvc" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="ach_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Routing Number</label>
                                                        <input type="text" name="ach_routing_number" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Number</label>
                                                        <input type="text" name="ach_account_number" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="venmo_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="account_note" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                        <input type="text" name="confirmation" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="paypal_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="paypal_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="paypal_account_note" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                        <input type="text" name="paypal_confirmation" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="paypal_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="square_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="square_account_note" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                        <input type="text" name="square_confirmation" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="paypal_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="warranty_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="warranty_account_note" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="home_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="home_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="home_account_note" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="e_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="e_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="e_account_note" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="other_credit_card">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                        <input type="text" name="other_credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                        <input type="text" name="other_credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                        <input type="text" name="other_credit_cvc" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="other_payment_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="other_payment_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="other_payment_account_note" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title d-block">
                                            <span class="d-block">Use of Personal Information Collected</span>
                                            <label class="content-subtitle">We use the information we collect to provide you with our products and services and to respond to your questions. We also use the information for editorial and feedback purposes, for marketing and promotional purposes, to inform advertisers as to how many visitors have seen or clicked on their advertisements and to customize the content and layout of ClearCaptions' website. We also use the information we collect for statistical analysis of users' behavior, for product development, for content improvement, to ensure our product and services remain functioning and secure and to investigate and protect against any illegal activities or violations of our Terms of Service.</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title d-block">
                                            <span class="d-block">Signature</span>
                                            <label class="content-subtitle">By Signing below you verify that the above information is true and complete, and you authorize payment and confirmation with nSmarTrac.</label>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Company Representative Approval</label>
                                                <select class="nsm-field form-select" name="company_representative_printed_name">
                                                    <option value="0">Select Name</option>
                                                    <?php foreach ($users_lists as $ulist) { ?>
                                                        <option <?php if ($ulist->id == logged('id')) {
                                                                    echo "selected";
                                                                } ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName . ' ' . $ulist->LName; ?></option>
                                                    <?php } ?>
                                                </select>

                                                <input type="hidden" id="saveCompanySignatureDB1a" name="company_representative_approval_signature1a">
                                                <div class="d-flex mt-2" id="cra_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 150px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#add_cra_sign_modal">
                                                    <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                                    <img src="" id="companyrep" class="m-auto d-none">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Primary Account Holder</label>
                                                <input type="text" name="primary_account_holder_name" id="primary_account_holder_name" class="nsm-field form-control" placeholder="Printed Name" />
                                                <input type="hidden" id="savePrimaryAccountSignatureDB2a" name="primary_account_holder_signature2a">
                                                <div class="d-flex mt-2" id="pah_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 150px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#add_pah_sign_modal">
                                                    <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                                    <img src="" id="primaryrep" class="m-auto d-none">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Secondary Account Holder</label>
                                                <input type="text" name="secondery_account_holder_name" class="nsm-field form-control" placeholder="Printed Name" />
                                                <input type="hidden" id="saveSecondaryAccountSignatureDB3a" name="secondary_account_holder_signature3a">
                                                <div class="d-flex mt-2" id="sah_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 150px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#add_sah_sign_modal">
                                                    <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                                    <img src="" id="secondaryrep" class="m-auto d-none">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="nsm-button" onclick="location.href='<?php echo url('workorder') ?>'">Cancel</button>
                        <button type="submit" class="nsm-button">Send to Customer</button>
                        <button type="submit" name="action" class="nsm-button primary" value="submit">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initializeSolarChart();

        $(".name-field").on("keyup", function() {
            var one = $('#firstname').val();
            var two = $('#lastname').val();
            $('#primary_account_holder_name').val(one + ' ' + two);
        });

        $("#form_new_solar_workorder").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('workorder/savenewWorkorderSolar'); ?>";
            _this.find("button[type=submit]").html("Submitting");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Workorder has been saved successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Submit");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(".datepicker").datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });

        $('.number-field').keyup(function() {
            var val = this.value.replace(/\D/g, '');
            val = val.replace(/^(\d{3})/, '$1-');
            val = val.replace(/-(\d{2})/, '-$1-');
            val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
            this.value = val;
        });

        $("#payment_method").on("change", function() {
            let paymentMethod = $(this).val();

            hideAllPaymentMethods();
            switch (paymentMethod) {
                case "Cash":
                    $("#cash_area").removeClass("d-none");
                    break;
                case "Invoicing":
                    $("#invoicing").removeClass("d-none");
                    break;
                case "Check":
                    $("#check_area").removeClass("d-none");
                    break;
                case "Credit Card":
                    $("#credit_card").removeClass("d-none");
                    break;
                case "Debit Card":
                    $("#debit_card").removeClass("d-none");
                    break;
                case "ACH":
                    $("#ach_area").removeClass("d-none");
                    break;
                case "Venmo":
                    $("#venmo_area").removeClass("d-none");
                    break;
                case "Paypal":
                    $("#paypal_area").removeClass("d-none");
                    break;
                case "Square":
                    $("#square_area").removeClass("d-none");
                    break;
                case "Warranty Work":
                    $("#warranty_area").removeClass("d-none");
                    break;
                case "Home Owner Financing":
                    $("#home_area").removeClass("d-none");
                    break;
                case "e-Transfer":
                    $("#e_area").removeClass("d-none");
                    break;
                case "Other Credit Card Professor":
                    $("#other_credit_card").removeClass("d-none");
                    break;
                case "Other Payment Type":
                    $("#other_payment_area").removeClass("d-none");
                    break;
            }
        });

        var signaturePad;
        jQuery(document).ready(function() {
            var signaturePadCanvas = document.querySelector('#canvasb');
            signaturePad = new SignaturePad(signaturePadCanvas);
            signaturePadCanvas.height = 300;
            signaturePadCanvas.width = 680;
        });

        $(document).on('click touchstart', '#canvasb', function() {
            var canvas_web = document.getElementById("canvasb");
            var dataURL = canvas_web.toDataURL("image/png");
            $("#saveCompanySignatureDB1a").val(dataURL);
        });

        $("#btn_save_cra_signature").on("click", function() {
            $("#companyrep").attr("src", $("#saveCompanySignatureDB1a").val());
            $("#companyrep").removeClass("d-none");
            $("#cra_sign_container").find("span").addClass("d-none");
            $("#add_cra_sign_modal").modal("hide");
        });

        $('#btn_clear_cra_signature').click(function() {
            $('#cra_sign_area').signaturePad().clearCanvas();
        });

        var signaturePad;
        jQuery(document).ready(function() {
            var signaturePadCanvas = document.querySelector('#canvas2b');
            signaturePad = new SignaturePad(signaturePadCanvas);
            signaturePadCanvas.height = 300;
            signaturePadCanvas.width = 680;
        });

        $(document).on('click touchstart', '#canvas2b', function() {
            var canvas_web = document.getElementById("canvas2b");
            var dataURL = canvas_web.toDataURL("image/png");
            $("#savePrimaryAccountSignatureDB2a").val(dataURL);
        });

        $("#btn_save_pah_signature").on("click", function() {
            $("#primaryrep").attr("src", $("#savePrimaryAccountSignatureDB2a").val());
            $("#primaryrep").removeClass("d-none");
            $("#pah_sign_container").find("span").addClass("d-none");
            $("#add_pah_sign_modal").modal("hide");
        });

        $('#btn_clear_pah_signature').click(function() {
            $('#pah_sign_area').signaturePad().clearCanvas();
        });

        var signaturePad;
        jQuery(document).ready(function() {
            var signaturePadCanvas = document.querySelector('#canvas3b');
            signaturePad = new SignaturePad(signaturePadCanvas);
            signaturePadCanvas.height = 300;
            signaturePadCanvas.width = 680;
        });

        $(document).on('click touchstart', '#canvas3b', function() {
            var canvas_web = document.getElementById("canvas3b");
            var dataURL = canvas_web.toDataURL("image/png");
            $("#saveSecondaryAccountSignatureDB3a").val(dataURL);
        });

        $("#btn_save_sah_signature").on("click", function() {
            $("#secondaryrep").attr("src", $("#saveSecondaryAccountSignatureDB3a").val());
            $("#secondaryrep").removeClass("d-none");
            $("#sah_sign_container").find("span").addClass("d-none");
            $("#add_sah_sign_modal").modal("hide");
        });

        $('#btn_clear_sah_signature').click(function() {
            $('#sah_sign_area').signaturePad().clearCanvas();
        });

        $("#payment_method").on("change", function() {
            let paymentMethod = $(this).val();

            hideAllPaymentMethods();
            switch (paymentMethod) {
                case "Cash":
                    $("#cash_area").removeClass("d-none");
                    break;
                case "Invoicing":
                    $("#invoicing").removeClass("d-none");
                    break;
                case "Check":
                    $("#check_area").removeClass("d-none");
                    break;
                case "Credit Card":
                    $("#credit_card").removeClass("d-none");
                    break;
                case "Debit Card":
                    $("#debit_card").removeClass("d-none");
                    break;
                case "ACH":
                    $("#ach_area").removeClass("d-none");
                    break;
                case "Venmo":
                    $("#venmo_area").removeClass("d-none");
                    break;
                case "Paypal":
                    $("#paypal_area").removeClass("d-none");
                    break;
                case "Square":
                    $("#square_area").removeClass("d-none");
                    break;
                case "Warranty Work":
                    $("#warranty_area").removeClass("d-none");
                    break;
                case "Home Owner Financing":
                    $("#home_area").removeClass("d-none");
                    break;
                case "e-Transfer":
                    $("#e_area").removeClass("d-none");
                    break;
                case "Other Credit Card Professor":
                    $("#other_credit_card").removeClass("d-none");
                    break;
                case "Other Payment Type":
                    $("#other_payment_area").removeClass("d-none");
                    break;
            }
        });
    });

    function hideAllPaymentMethods() {
        $("#cash_area").addClass("d-none");
        $("#invoicing").addClass("d-none");
        $("#check_area").addClass("d-none");
        $("#credit_card").addClass("d-none");
        $("#debit_card").addClass("d-none");
        $("#ach_area").addClass("d-none");
        $("#venmo_area").addClass("d-none");
        $("#paypal_area").addClass("d-none");
        $("#square_area").addClass("d-none");
        $("#warranty_area").addClass("d-none");
        $("#home_area").addClass("d-none");
        $("#e_area").addClass("d-none");
        $("#other_credit_card").addClass("d-none");
        $("#other_payment_area").addClass("d-none");
    }

    function initializeSolarChart() {
        var jobs = $("#solar_chart");

        new Chart(jobs, {
            type: 'bar',
            data: {
                labels: ["J", "", "M", "", "S", "", "N", ""],
                datasets: [{
                    label: "Dataset 1",
                    data: ["1200", "1000", "800", "700", "100", "1000", "700", "650"],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
                aspectRatio: 2,
                scales: {
                    A: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'KWH'
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    },
                    B: {
                        type: 'linear',
                        position: 'right',
                        title: {
                            display: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return ''
                            }
                        }
                    }
                }
            }
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>