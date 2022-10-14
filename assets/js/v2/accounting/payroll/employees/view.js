$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});

$('#table-filters').on('click', function(e) {
    e.stopPropagation();
});

$('#filter-date').select2({
    minimumResultsForSearch: -1
});

$('#edit-employment-details-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#edit-employment-details-modal')
});

$('#edit-payment-method-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#edit-payment-method-modal')
});

$('#edit-pay-types-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#edit-pay-types-modal')
});

$('#edit_employee_modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#edit_employee_modal')
});

$('#edit-pay-types-modal #pay-type').on('change', function() {
    switch($(this).val()) {
        case 'hourly' :
            $(this).parent().next().html(`<div class="input-group">
                <span class="input-group-text">$</span>
                <input type="text" name="pay_rate" id="pay-rate" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                <span class="input-group-text">/hour</span>
            </div>`);
            
            if($(this).parent().next().next().find('#default-hours').length < 1) {
                $(this).parent().next().next().html(`<div class="input-group">
                    <span class="input-group-text">Default hours:</span>
                    <input type="text" name="default_hours" id="default-hours" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                    <span class="input-group-text">hours per day and</span>
                    <input type="text" name="days_per_week" id="days-per-week" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                    <span class="input-group-text">days per week.</span>
                </div>`);
            }
        break;
        case 'salary' :
            $(this).parent().next().html(`<div class="row">
                <div class="col">
                    <label for="pay-frequency">Pay frequency</label>
                    <select id="pay-frequency" class="form-select nsm-field" name="pay_frequency">
                        <option value="per-year">per year</option>
                        <option value="per-month">per month</option>
                        <option value="per-week" selected>per week</option>
                    </select>
                </div>
                <div class="col">
                    <label for="pay-rate">Salary</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" name="pay_rate" id="pay-rate" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                    </div>
                </div>
            </div>`);

            if($(this).parent().next().next().find('#default-hours').length < 1) {
                $(this).parent().next().next().html(`<div class="input-group">
                    <span class="input-group-text">Default hours:</span>
                    <input type="text" name="default_hours" id="default-hours" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                    <span class="input-group-text">hours per day and</span>
                    <input type="text" name="days_per_week" id="days-per-week" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                    <span class="input-group-text">days per week.</span>
                </div>`);
            }
        break;
        case 'commission' :
            $(this).parent().next().html('');
            $(this).parent().next().next().html('');
        break;
    }
});