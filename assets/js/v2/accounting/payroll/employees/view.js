$(function() {
    $('.date').each(function() {
        if($(this).attr('id') === 'next-payday' || $(this).attr('id') === 'next-pay-period-end') {
            $(this).datepicker({
                startDate: new Date(),
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        } else {
            $(this).datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        }
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

$('#pay-schedule-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#pay-schedule-modal')
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

            $('#edit-pay-types-modal #pay-frequency').select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#edit-pay-types-modal')
            });
        break;
        case 'commission' :
            $(this).parent().next().html('');
            $(this).parent().next().next().html('');
        break;
    }
});

$('#work-location').on('change', function() {
    if($(this).val() === 'add') {
        $('#edit-employment-details-modal').modal('hide');
        $('#add-worksite-modal').modal('show');
    }
});

$('#add-worksite-form').on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(this);
    
    $.ajax({
        url: '/accounting/employees/add-work-location',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);

            $('#edit-employment-details-modal #work-location option:selected').removeAttr('selected');
            $('#edit-employment-details-modal #work-location').append(`<option value="${result.id}" selected>${result.name}</option>`);
            $('#edit-employment-details-modal #work-location').trigger('change');

            $('#add-worksite-modal').modal('hide');
            $('#edit-employment-details-modal').modal('show');
        }
    });
});

function setDefaultEmpCommissionValue() {
    let selectedPayscaleOption = $('select[name="empPayscale"]').find('option:selected').text();

    if (selectedPayscaleOption.includes("Base (Hourly Rate)") || selectedPayscaleOption.includes("Base (Weekly Rate)") || selectedPayscaleOption.includes("Base (Monthly Rate)")) {
        $('select[name="empCommission"]').find('option[value="2"]').prop("selected", true);
        $('select[name="empCommissionPercentage"]').val("0");
    } else {
        $('select[name="empCommission"]').val('');
        $('select[name="empCommissionPercentage"]').val('0');
    }
    
}

function compensationHideShow() {
    let selectedOption = $('select[name="empPayscale"]').find('option:selected').text();
    let selectedValue = $('select[name="empPayscale"]').val();

    if ( selectedValue == 3 ) { //Base Hourly rate
        $('.base_hourlyrate').fadeIn('fast');
        $('.base_weeklyrate').hide();
        $('.base_monthlyrate').hide();
        $('.compensation_baseamount').hide();
        $('.compensation_hourlyrate').hide();
        $('.jobtypebase_install').hide();
        $('.commission-percentage-grp').hide();
    } else if ( selectedValue == 4 ) { //Base (Weekly Rate)
        $('.base_hourlyrate').hide();
        $('.base_weeklyrate').fadeIn('fast');
        $('.base_monthlyrate').hide();
        $('.compensation_baseamount').hide();
        $('.compensation_hourlyrate').hide();
        $('.jobtypebase_install').hide();
        $('.commission-percentage-grp').hide();
    } else if ( selectedValue == 5 ) { //Base (Monthly Rate)
        $('.base_hourlyrate').hide();
        $('.base_weeklyrate').hide();
        $('.base_monthlyrate').fadeIn('fast');
        $('.compensation_baseamount').hide();
        $('.compensation_hourlyrate').hide();
        $('.jobtypebase_install').hide();
        $('.commission-percentage-grp').hide();
    } else if ( selectedValue == 6 ) { //Compensation (Base Amount)
        $('.base_hourlyrate').hide();
        $('.base_weeklyrate').hide();
        $('.base_monthlyrate').hide();
        $('.compensation_baseamount').fadeIn('fast');
        $('.compensation_hourlyrate').hide();
        $('.jobtypebase_install').hide();
        $('.commission-percentage-grp').hide();
    } else if ( selectedValue == 7 ) { //Compensation (Hourly Rate)
        $('.base_hourlyrate').hide();
        $('.base_weeklyrate').hide();
        $('.base_monthlyrate').hide();
        $('.compensation_baseamount').hide();
        $('.compensation_hourlyrate').fadeIn('fast');
        $('.jobtypebase_install').hide();
        $('.commission-percentage-grp').hide();
    } else if ( selectedValue == 8 ) { //Job Type Base(Install/Service)
        $('.base_hourlyrate').hide();
        $('.base_weeklyrate').hide();
        $('.base_monthlyrate').hide();
        $('.compensation_baseamount').hide();
        $('.compensation_hourlyrate').hide();
        $('.jobtypebase_install').fadeIn('fast');
        $('.commission-percentage-grp').hide();
    } else {
        $('.base_hourlyrate').fadeIn('fast');
        $('.base_weeklyrate').hide();
        $('.base_monthlyrate').hide();
        $('.compensation_baseamount').hide();
        $('.compensation_hourlyrate').hide();
        $('.jobtypebase_install').hide();
        $('.commission-percentage-grp').hide();
    }
}
compensationHideShow();

$('select[name="empPayscale"]').change(function() {
    compensationHideShow();
});