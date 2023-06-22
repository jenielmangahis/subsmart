<?php if (!empty($customer)) { ?>
    <input type="hidden" name="customer_id" value="<?php echo (!empty($customer)) ? $customer->id : '' ?>">
<?php } ?>

<?php if (!empty($action)) { ?>
    <input type="hidden" name="action_type" value="<?php echo (!empty($action)) ? $action : '' ?>">
<?php } ?>

<?php if (isset($data_index)) { ?>
    <input type="hidden" name="data_index" value="<?php echo (isset($data_index)) ? $data_index : '' ?>">
<?php } ?>

<div class="row g-3">
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Customer Type</label>
        <div class="form-check d-inline-block me-2">
            <input class="form-check-input customer_type" type="radio" name="customer_type" checked="checked" id="customer_type_residential" value="Residential">
            <label class="form-check-label" for="customer_type_residential">
                Residential
            </label>
        </div>
        <div class="form-check d-inline-block me-2">
            <input class="form-check-input customer_type" type="radio" name="customer_type" id="customer_type_commercial" value="Commercial">
            <label class="form-check-label" for="customer_type_commercial">
                Commercial
            </label>
        </div>
        <div class="form-check d-inline-block">
            <input class="form-check-input customer_type" type="radio" name="customer_type" id="customer_type_advance" value="Advance">
            <label class="form-check-label" for="customer_type_advance">
                Other
            </label>
        </div>
    </div>
    <div class="col-12" id="business_name_area" style="display:none;">
        <label class="content-subtitle fw-bold d-block mb-2">Business Name</label>
        <input type="text" name="business_name" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
        <input type="text" name="first_name" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Middle Name</label>
        <input type="text" name="middle_name" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
        <input type="text" name="last_name" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Name Suffix</label>
        <input type="text" name="suffix_name" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Contact Email</label>
        <input type="email" name="contact_email" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Date of Birth*</label>
        <input type="text" name="date_of_birth" class="nsm-field form-control dob_customer_form" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Mobile</label>
        <input type="text" name="contact_mobile" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Phone</label>
        <input type="text" name="contact_phone" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Social Security Number </label>
        <input type="text" name="social_security_number" class="nsm-field form-control" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Status</label>
        <!-- <input type="text" name="status" class="nsm-field form-control" /> -->
        <select id="status" name="status" class="form-control">
            <option value="New">New</option>
            <option value="Contacted">Contacted</option>
            <option value="Follow Up">Follow Up</option>
            <option value="Assigned">Assigned</option>
            <option value="Converted">Converted</option>
            <option value="Closed">Closed</option>
        </select>
    </div>
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Preferred notification method</label>
        <div class="form-check d-inline-block me-2">
            <input class="form-check-input" type="checkbox" value="1" name="notify_by_email" id="notify_by_email" checked>
            <label class="form-check-label" for="notify_by_email">
                Notify By Email
            </label>
        </div>
        <div class="form-check d-inline-block me-2">
            <input class="form-check-input" type="checkbox" value="1" name="notify_by_sms" id="notify_by_sms" checked>
            <label class="form-check-label" for="notify_by_sms">
                Notify By SMS/Text
            </label>
        </div>
    </div>
    <div class="col-12">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#more_info_collapse" aria-controls="more_info_collapse" aria-expanded="false">
                        Add More Info
                    </button>
                </h2>
                <div id="more_info_collapse" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-2">Street Address</label>
                                <input type="text" name="street_address" class="nsm-field form-control" />
                                <input type="hidden" id="country" name="country" required />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-2">Suite/Unit</label>
                                <input type="text" name="suite_unit" class="nsm-field form-control" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="content-subtitle fw-bold d-block mb-2">City</label>
                                <input type="text" name="city" class="nsm-field form-control" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="content-subtitle fw-bold d-block mb-2">Zip/Postal Code</label>
                                <input type="text" name="postcode" class="nsm-field form-control" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="content-subtitle fw-bold d-block mb-2">State/Province</label>
                                <select name="state" class="nsm-field form-select">
                                    <option value="" selected="selected">- select -</option>
                                    <?php foreach (get_config_item('states') as $key => $state) { ?>
                                        <option value="<?php echo $key ?>"><?php echo $state; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $(".dob_customer_form").datepicker({
            format: 'mm-dd-yyyy',
            autoclose: true
        });
});
</script>