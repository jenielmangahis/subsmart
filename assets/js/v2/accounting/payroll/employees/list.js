$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$("#employees-table").nsmPagination({
    itemsPerPage: 10
});

$('#privacy').on('change', function() {
    if($(this).prop('checked')) {
        $('#employees-table tbody .pay-rate').html(`<i class="bx bx-fw bx-lock-alt"></i>`);
    } else {
        $('#employees-table tbody tr .pay-rate').each(function() {
            var data = $(this).data();

            $(this).html(data.pay_rate);
        });
    }
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#employees-table thead td[data-name="${dataName}"]`).index();
    $(`#employees-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    }); 
});

$('#status-filter li a.dropdown-item').on('click', function(e) {
    e.preventDefault();
    var search = $('#search_field').val();

    var status = $(this).attr('id').replace('-employees', '');
    var payMethod = $('#pay-method-filter li a.dropdown-item.active').attr('id').replace('-pay-method', '');

    var url = `${base_url}accounting/employees?`;

    url += search !== '' ? `search=${search}&` : '';
    url += status !== 'active' ? `status=${status}&` : '';
    url += payMethod !== 'all' ? `pay-method=${payMethod}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});

$('#pay-method-filter li a.dropdown-item').on('click', function(e) {
    e.preventDefault();
    var search = $('#search_field').val();

    var status = $('#status-filter li a.dropdown-item.active').attr('id').replace('-employees', '');
    var payMethod = $(this).attr('id').replace('-pay-method', '');

    var url = `${base_url}accounting/employees?`;

    url += search !== '' ? `search=${search}&` : '';
    url += status !== 'active' ? `status=${status}&` : '';
    url += payMethod !== 'all' ? `pay-method=${payMethod}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

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

$(".password-field").on("click", function(e) {
    let _this = $(this);
    let _container = _this.closest(".nsm-field-group");
    let shown = _container.hasClass("show");

    if (e.offsetX > 345) {
        if (shown) {
            _container.removeClass("show").addClass("hide");
            _this.attr("type", "text");
        } else {
            _container.removeClass("hide").addClass("show");
            _this.attr("type", "password");
        }
    }
});

$('#add_employee_modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#add_employee_modal')
});

$("#add_employee_form").on("submit", function(e) {
    let _this = $(this);
    e.preventDefault();

    var url = base_url+"accounting/employees/create";
    _this.find("button[type=submit]").html("Saving");
    _this.find("button[type=submit]").prop("disabled", true);

    var data = new FormData(this);
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(result) {
            Swal.fire({
                title: result.title,
                html: result.message,
                icon: result.success ? 'success' : 'error',
                showCloseButton: false,
                showCancelButton: false,
                confirmButtonColor: '#2ca01c',
                confirmButtonText: 'Okay'
            }).then((res) => {
                if(res.isConfirmed) {
                    if(result.success) {
                        window.location = base_url+"accounting/employees";
                    }
                }
            });
        },
    });
});

$('#run-payroll').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="payroll_modal"]').trigger('click');
});

$('#bonus-only').on('click', function(e) {
    e.preventDefault();

    $('#bonus-payroll-modal').modal('show');
});

$(document).on('change', '#bonus-payroll-modal [name="bonus_as"]', function() {
    $(this).next().find('span').removeClass('d-none').addClass('d-block');

    $('#bonus-payroll-modal [name="bonus_as"]:not(:checked)').next().find('span').removeClass('d-block').addClass('d-none');
});

var bonusPayAsFields = '';
var bonusPayType = '';

$(document).on('click', '#bonus-payroll-modal #continue-bonus-payroll', function(e) {
    e.preventDefault();

    bonusPayType = $('#bonus-payroll-modal [name="bonus_as"]:checked').val();
    bonusPayAsFields = $('#bonus-payroll-modal .modal-content').html();

    $.get(base_url + 'accounting/employees/bonus-only-payroll-form/' + bonusPayType, function(res) {
        $('#bonus-payroll-modal .modal-content').html(res);
        $('#bonus-payroll-modal .modal-body select:not(#bank-account)').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('#bonus-payroll-modal')
        });
        $('#bonus-payroll-modal .modal-body select#bank-account').select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'bank-account',
                        modal: 'bonus-payroll-modal'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $('#bonus-payroll-modal')
        });
        // $('#bonus-payroll-modal #payDate').datepicker({
        //     format: 'mm/dd/yyyy',
        //     orientation: 'bottom',
        //     autoclose: true
        // });
    });
});

$(document).on('change', '#bonus-payroll-modal #payroll-table thead .select-all', function() {
    $('#bonus-payroll-modal #payroll-table tbody .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

const updateTotalPay = () => {
    let total = 0.00;
    $('#bonus-payroll-modal #payroll-table tbody [name="bonus[]"]').each(function() {
        if (!$(this).is(':disabled')) {  
            const bonusVal = $(this).val().replace(/,/g, ''); 
            console.log("test", bonusVal);
            if (bonusVal !== "") {
                const bonusAmount = parseFloat(bonusVal);
                total += bonusAmount;
            }
        }
    });

    const formattedTotal = formatter.format(total);
    $('#bonus-payroll-modal #payroll-table tfoot tr:first-child td:nth-child(4), #bonus-payroll-modal #payroll-table tfoot tr:first-child td:last-child').html(formattedTotal);
    $('#bonus-payroll-modal h2.total-pay').html(formattedTotal);
};



$(document).on('change', '#bonus-payroll-modal #payroll-table tbody .select-one', function() {
    var row = $(this).closest('tr');

    if($(this).prop('checked')) {
        row.children('td').each(function(index, value) {
            switch(index) {
                case 2 :
                    $(this).html(row.data().method);
                    break;
                case 3 :
                    var bonusValue = row.data('bonus') || '';
                    $(this).html('<input type="number" name="bonus[]" step="0.01" class="form-control nsm-field text-end" value="' + bonusValue + '">');
                    break;
                case 4 :
                    var memoValue = row.data('memo') || ''; 
                    $(this).html('<input type="text" name="memo[]" class="form-control nsm-field" value="' + memoValue + '">');
                    break;
                case 5 :
                    var totalPayValue = row.data('total-pay') || '$0.00'; 
                    $(this).html('<p class="m-0 text-end"><span class="total-pay">' + totalPayValue + '</span></p>');
                    break;
            }
        });
    } else {
        row.children('td').each(function(index, value) {
            switch(index) {
                case 3 :
                    row.data('bonus', $(this).find('input[name="bonus[]"]').val());
                    break;
                case 4 :
                    row.data('memo', $(this).find('input[name="memo[]"]').val());
                    break;
                case 5 :
                    row.data('total-pay', $(this).find('.total-pay').text());
                    break;
            }
        });

        row.find('td').each(function(index, value) {
            if (index > 1) {
                // Disable input elements if any
                $(this).find('input, textarea, select').attr('disabled', 'disabled');
                // Add a class to visually disable the cell
                $(this).addClass('disabled-cell');
            }
        });
    }

    var checked = $('#bonus-payroll-modal #payroll-table .select-one:checked').length;
    var count = $('#bonus-payroll-modal #payroll-table .select-one').length;

    $('#bonus-payroll-modal #payroll-table .select-all').prop('checked', checked === count);
    updateTotalPay();
});

let total = 0.00;

let bonusValues = {};

$(document).on('change', '#bonus-payroll-modal #payroll-table tbody [name="bonus[]"]', function() {
    const $this = $(this);
    const inputValue = $this.val().trim();
    let newFloatValue = parseFloat(inputValue);

    const employeeId = $this.closest('tr').data('employee-id');
    const previousBonusVal = bonusValues[employeeId] || 0;

    total -= previousBonusVal;

    if (!isNaN(newFloatValue) && isFinite(newFloatValue)) {
        newFloatValue = newFloatValue.toFixed(2);
        $this.val(newFloatValue);
        $this.closest('tr').find('.total-pay').html(formatter.format(newFloatValue));
    } else {
        newFloatValue = 0;
        $this.closest('tr').find('.total-pay').html('$0.00');
        $this.val('');
    }

    bonusValues[employeeId] = parseFloat(newFloatValue);
    total += parseFloat(newFloatValue);

    const formattedTotal = formatter.format(total);

    // Update the total in various places
    const totalSelectors = [
        '#bonus-payroll-modal #payroll-table tfoot tr:first-child td:nth-child(4)',
        '#bonus-payroll-modal #payroll-table tfoot tr:first-child td:last-child',
        '#bonus-payroll-modal h2.total-pay'
    ];

    totalSelectors.forEach(selector => {
        $(selector).html(formattedTotal);
    });

    console.log("Total bonus:", total);
    console.log("Employee ID:", employeeId);
});

$(document).on('click', '#bonus-payroll-modal #bonus-pay-select', function() {
    $('#bonus-payroll-modal .modal-content').html(bonusPayAsFields);
    $(`#bonus-payroll-modal [name="bonus_as"][value="${bonusPayType}"]`).prop('checked', true).trigger('change');
});

$(document).on('click', '#bonus-payroll-modal #preview-payroll', function() {
    var el = $(this);
    var parent = el.parent();
    payrollForm = $('#bonus-payroll-modal .modal-body').html();

    // Clear old data in payrollFormData
    for (const pair of payrollFormData.entries()) {
        payrollFormData.delete(pair[0]);
    }

    // Append new data to payrollFormData
    payrollFormData.append('pay_from_account', $('#bonus-payroll-modal #bank-account').val());
    payrollFormData.append('pay_period', $('#bonus-payroll-modal #pay-period-start').val() + '-' + $('#bonus-payroll-modal #pay-period-end').val());
    payrollFormData.append('pay_date', $('#bonus-payroll-modal #payDate').val());

    $('#bonus-payroll-modal #payroll-table tbody tr .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        payrollFormData.append('employees[]', $(this).val());
        payrollFormData.append('bonus[]', row.find('[name="bonus[]"]').val());
        payrollFormData.append('memo[]', row.find('[name="memo[]"]').val());
    });

    $.ajax({
        url: base_url + '/accounting/employees/generate-bonus-payroll/' + bonusPayType,
        data: payrollFormData,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            console.log(res);
            $('div#bonus-payroll-modal div.modal-body').html(res);

            var chartHeight = $('div#bonus-payroll-modal div.modal-body div#bonusPayrollChart').parent().prev().height();
            var chartWidth = $('div#bonus-payroll-modal div.modal-body div#bonusPayrollChart').parent().width();

            $('div#bonus-payroll-modal div#bonusPayrollChart').height(chartHeight);
            $('div#bonus-payroll-modal div#bonusPayrollChart').width(chartWidth);

            var payrollCost = $('div#bonus-payroll-modal #total-payroll-cost').html().replace('$', '');
            var totalNetPay = $('div#bonus-payroll-modal #total-net-pay').html().replace('$', '');
            var employeeTax = $('div#bonus-payroll-modal #total-employee-tax').html().replace('$', '');
            var employerTax = $('div#bonus-payroll-modal #total-employer-tax').html().replace('$', '');

            var netPayPercent = parseFloat((parseFloat(totalNetPay) / parseFloat(payrollCost)) * 100).toFixed(2);
            var employeeTaxPercent = parseFloat((parseFloat(employeeTax) / parseFloat(payrollCost)) * 100).toFixed(2);
            var employerTaxPercent = parseFloat((parseFloat(employerTax) / parseFloat(payrollCost)) * 100).toFixed(2);

            new Chart('bonusPayrollChart', {
                type: 'doughnut',
                data: {
                    labels: ['Net Pay', 'Employee', 'Employer'],
                    datasets: [{
                        label: 'Payroll',
                        data: [netPayPercent, employeeTaxPercent, employerTaxPercent],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    aspectRatio: 1.5
                }
            });

            el.remove();
            parent.prepend(`<button type="submit" class="nsm-button success">Submit Payroll</button>`);
            $('#bonus-payroll-modal #bonus-pay-select').html('Back');
            $('#bonus-payroll-modal #bonus-pay-select').removeAttr('data-bs-dismiss');
            $('#bonus-payroll-modal #bonus-pay-select').attr('id', 'back-payroll-form');
        }
    });
});



// $(document).on('click', '#bonus-payroll-modal #preview-payroll', function() {
//     var el = $(this);
//     var parent = el.parent();
//     payrollForm = $('#bonus-payroll-modal .modal-body').html();

//     for (const pair of payrollFormData.entries()) {
//         payrollFormData.delete(pair[0]);
//     }

//     payrollFormData.append('pay_from_account', $('#bonus-payroll-modal #bank-account').val());
//     payrollFormData.append('pay_date', $('#bonus-payroll-modal #payDate').val());


//     $('#bonus-payroll-modal #payroll-table tbody tr .select-one:checked').each(function() {
//         var row = $(this).closest('tr');
//         var employeeId = $(this).val();

//         // Check if the employee already exists in the form data
//         var existingEmployeeIndex = Array.from(payrollFormData.getAll('employees[]')).indexOf(employeeId);
//         console.log("exist", existingEmployeeIndex);
//         // If the employee already exists, update the bonus value; otherwise, append it
//         if (existingEmployeeIndex !== -1) {
//             // Update the bonus value for the existing employee
//             payrollFormData.set('bonus[]', row.find('[name="bonus[]"]').val());
//             payrollFormData.set('memo[]', row.find('[name="memo[]"]').val());
//         } else {
//             // Append the new bonus value for the new employee
//             payrollFormData.append('employees[]', employeeId);
//             payrollFormData.append('bonus[]', row.find('[name="bonus[]"]').val());
//             payrollFormData.append('memo[]', row.find('[name="memo[]"]').val());
//         }
//     });


//     $.ajax({
//         url: base_url + '/accounting/employees/generate-bonus-payroll/' + bonusPayType,
//         data: payrollFormData,
//         type: 'post',
//         processData: false,
//         contentType: false,
//         success: function(res) {
//             $('div#bonus-payroll-modal div.modal-body').html(res);

//             var chartHeight = $('div#bonus-payroll-modal div.modal-body div#bonusPayrollChart').parent().prev().height();
//             var chartWidth = $('div#bonus-payroll-modal div.modal-body div#bonusPayrollChart').parent().width();

//             $('div#bonus-payroll-modal div#bonusPayrollChart').height(chartHeight);
//             $('div#bonus-payroll-modal div#bonusPayrollChart').width(chartWidth);

//             var payrollCost = $('div#bonus-payroll-modal #total-payroll-cost').html().replace('$', '');
//             var totalNetPay = $('div#bonus-payroll-modal #total-net-pay').html().replace('$', '');
//             var employeeTax = $('div#bonus-payroll-modal #total-employee-tax').html().replace('$', '');
//             var employerTax = $('div#bonus-payroll-modal #total-employer-tax').html().replace('$', '');

//             var netPayPercent = parseFloat((parseFloat(totalNetPay) / parseFloat(payrollCost)) * 100).toFixed(2);
//             var employeeTaxPercent = parseFloat((parseFloat(employeeTax) / parseFloat(payrollCost)) * 100).toFixed(2);
//             var employerTaxPercent = parseFloat((parseFloat(employerTax) / parseFloat(payrollCost)) * 100).toFixed(2);

//             new Chart('bonusPayrollChart', {
//                 type: 'doughnut',
//                 data: {
//                     labels: ['Net Pay', 'Employee', 'Employer'],
//                     datasets: [{
//                         label: 'Payroll',
//                         data: [netPayPercent, employeeTaxPercent, employerTaxPercent],
//                         backgroundColor: [
//                             'rgba(255, 99, 132, 0.2)',
//                             'rgba(75, 192, 192, 0.2)',
//                             'rgba(54, 162, 235, 0.2)'
//                           ],
//                           borderColor: [
//                             'rgba(255, 99, 132, 1)',
//                             'rgba(75, 192, 192, 1)',
//                             'rgba(54, 162, 235, 1)',
//                           ],
//                           borderWidth: 1
//                     }]
//                 },
//                 options: {
//                     responsive: true,
//                     plugins: {
//                       legend: {
//                         position: 'bottom',
//                       },
//                     },
//                     aspectRatio: 1.5,
//                   }
//             });

//             el.remove();
//             parent.prepend(`<button type="submit" class="nsm-button success">Submit Payroll</button>`);
//             $('#bonus-payroll-modal #bonus-pay-select').html('Back');
//             $('#bonus-payroll-modal #bonus-pay-select').removeAttr('data-bs-dismiss');
//             $('#bonus-payroll-modal #bonus-pay-select').attr('id', 'back-payroll-form');
//         }
//     });
// });

$(document).on('click', '#bonus-payroll-modal #back-payroll-form', function() {
    $('#bonus-payroll-modal .modal-body').html(payrollForm);

    $('#bonus-payroll-modal #bank-account').val(payrollFormData.get('pay_from_account')).trigger('change');
    $('#bonus-payroll-modal #payDate').val(payrollFormData.get('pay_date'));
   // Extract the pay period data
        var payPeriod = payrollFormData.get('pay_period').split('-');

        // // Log the payPeriod array for debugging
        // console.log("test", payPeriod);

        // Extract the start and end dates from the payPeriod array
        var startYear = payPeriod[0];
        var startMonth = payPeriod[1];
        var startDay = payPeriod[2];
        var endYear = payPeriod[3];
        var endMonth = payPeriod[4];
        var endDay = payPeriod[5];

        // Format the dates as YYYY-MM-DD
        var startDate = `${startYear}-${startMonth}-${startDay}`;
        var endDate = `${endYear}-${endMonth}-${endDay}`;

        // Set the formatted dates in the modal inputs
        $('#bonus-payroll-modal #pay-period-start').val(startDate);
        $('#bonus-payroll-modal #pay-period-end').val(endDate);

    var employees = payrollFormData.getAll('employees[]');

    $('#bonus-payroll-modal #payroll-table tr td .select-one').each(function() {
        if (employees.includes($(this).val())) {
            $(this).prop('checked', true);
        } else {
            $(this).prop('checked', false);
        }
    });

    if (employees.length === $('#bonus-payroll-modal #payroll-table tr td .select-one').length) {
        $('#bonus-payroll-modal #payroll-table thead .select-all').prop('checked', true);
    } else {
        $('#bonus-payroll-modal #payroll-table thead .select-all').prop('checked', false);
    }

    var bonus = payrollFormData.getAll('bonus[]');
    var memos = payrollFormData.getAll('memo[]');
    var employees = payrollFormData.getAll('employees[]');

    // Track which employee IDs have been processed
    var processedEmployees = {};

    // Loop through the employees to remove old values
    for (var i = 0; i < employees.length; i++) {
        var employeeId = employees[i];
        var bonusValue = bonus[i];
        var memoValue = memos[i];

        if (!processedEmployees[employeeId]) {
            processedEmployees[employeeId] = true;

            // Find the corresponding row in the table
            var $row = $(`#bonus-payroll-modal #payroll-table tr td .select-one[value="${employeeId}"]`).closest('tr');

            // Set the new bonus and memo values
            $row.find('input[name="bonus[]"]').val(bonusValue);
            $row.find('input[name="memo[]"]').val(memoValue);

            // Remove the first occurrence of bonus and memo for this employee ID
            payrollFormData.delete('bonus[]');
            payrollFormData.delete('memo[]');

            // Log the values of the current row
            console.log(`Row for employee ID: ${employeeId}`);
            console.log(`Bonus: ${bonusValue}`);
            console.log(`Memo: ${memoValue}`);
        }
    }

    $(this).parent().html('<button type="button" class="nsm-button primary" id="bonus-pay-select">Back</button>');
    $('#bonus-payroll-modal .modal-footer button[type="submit"]').parent().prepend(`<button type="button" class="nsm-button success" id="preview-payroll">Preview payroll</button>`);
    $('#bonus-payroll-modal .modal-footer button[type="submit"]').remove();

    $('#bonus-payroll-modal .modal-body select#bank-account').next().remove();
    $('#bonus-payroll-modal .modal-body select#bank-account').select2({
        ajax: {
            url: '/accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'bank-account',
                    modal: 'bonus-payroll-modal'
                };

                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect,
        dropdownParent: $('#bonus-payroll-modal')
    });
});


$('#commission-payroll-modal .modal-body select:not(#bank-account)').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#commission-payroll-modal')
});

$('#commission-payroll-modal .modal-body select#bank-account').select2({
    ajax: {
        url: '/accounting/get-dropdown-choices',
        dataType: 'json',
        data: function(params) {
            var query = {
                search: params.term,
                type: 'public',
                field: 'bank-account',
                modal: 'commission-payroll-modal'
            }

            // Query parameters will be ?search=[term]&type=public&field=[type]
            return query;
        }
    },
    templateResult: formatResult,
    templateSelection: optionSelect,
    dropdownParent: $('#commission-payroll-modal')
});

$('#commission-only').on('click', function(e) {
    e.preventDefault();

    $('#commission-payroll-modal').modal('show');
});

$('#commission-payroll-modal #payroll-table thead .select-all').on('change', function() {
    $('#commission-payroll-modal #payroll-table tbody .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$('#commission-payroll-modal #pay-period-start, #commission-payroll-modal #pay-period-end').on('change', function() {
    $('#commission-payroll-modal #payroll-table tbody .select-one:checked').each(function() {
        $(this).trigger('change');
    });
});

$('#commission-payroll-modal #payroll-table tbody .select-one').on('change', function() {
    var row = $(this).closest('tr');
    
    if($(this).prop('checked')) {
        var data = new FormData();
        data.set('employee_id', $(this).val());
        data.set('pay_period', $('#commission-payroll-modal #pay-period-start').val()+'-'+$('#commission-payroll-modal #pay-period-end').val());

        $.ajax({
            url: base_url + '/accounting/get-employee-pay-details',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);
                row.children('td').each(function(index, value)  {
                    switch(index) {
                        case 2 :
                            $(this).html(res.pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check');
                        break;
                        case 3 :
                            $(this).html(res.commission !== null ? formatter.format(parseFloat(res.commission)) : formatter.format(parseFloat(0.00)));
                        break;
                        case 4 :
                            $(this).html(`<input type="text" name="memo[]" class="form-control nsm-field">`);
                        break;
                        case 5 :
                            $(this).html(`<p class="m-0 text-end"><span class="total-pay">${res.commission !== null ? formatter.format(parseFloat(res.commission)) : formatter.format(parseFloat(0.00))}</span></p>`);
                        break;
                    }
                });

                commissionTotal();
            }
        });
    } else {
        row.find('td').each(function(index, value) {
            if (index > 1) {
                $(this).html('');
            }
        });

        commissionTotal();
    }
    
    var checked = $('#commission-payroll-modal #payroll-table .select-one:checked').length;
    var count = $('#commission-payroll-modal #payroll-table .select-one').length;

    $('#commission-payroll-modal #payroll-table .select-all').prop('checked', checked === count);
});

const commissionTotal = () => {
    var total = 0.00;
    $('#commission-payroll-modal #payroll-table tbody .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var commission = row.find('.total-pay').html().replace('$', '').trim();

        total += parseFloat(commission);
    });

    $('#commission-payroll-modal h2.total-pay').html(formatter.format(parseFloat(total)));
    $('#commission-payroll-modal #payroll-table tfoot tr:first-child td:nth-child(4)').html(formatter.format(parseFloat(total)));
    $('#commission-payroll-modal #payroll-table tfoot tr:first-child td:last-child').html(formatter.format(parseFloat(total)));
}

$(document).on('click', '#commission-payroll-modal #preview-payroll', function() {
    var el = $(this);
    var parent = el.parent();
    payrollForm = $('div#commission-payroll-modal div.modal-body').html();

    for (const pair of payrollFormData.entries()) {
        payrollFormData.delete(pair[0]);
    }

    payrollFormData.append('pay_from_account', $('#commission-payroll-modal #bank-account').val());
    payrollFormData.append('pay_period', $('#commission-payroll-modal #pay-period-start').val()+'-'+$('#commission-payroll-modal #pay-period-end').val());
    payrollFormData.append('pay_date', $('#commission-payroll-modal #payDate').val());

    $('#commission-payroll-modal #payroll-table tbody tr .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        payrollFormData.append('employees[]', $(this).val());
        payrollFormData.append('commission[]', row.find('td:nth-child(4)').html().replace('$', ''));
        payrollFormData.append('memo[]', row.find('[name="memo[]"]').val());
    });

    $.ajax({
        url: base_url + '/accounting/employees/generate-commission-payroll',
        data: payrollFormData,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            console.log("test", res);
            $('div#commission-payroll-modal div.modal-body').html(res);

            var chartHeight = $('div#commission-payroll-modal div.modal-body div#commissionPayrollChart').parent().prev().height();
            var chartWidth = $('div#commission-payroll-modal div.modal-body div#commissionPayrollChart').parent().width();

            $('div#commission-payroll-modal div#commissionPayrollChart').height(chartHeight);
            $('div#commission-payroll-modal div#commissionPayrollChart').width(chartWidth);

            var payrollCost = $('div#commission-payroll-modal #total-payroll-cost').html().replace('$', '');
            var totalNetPay = $('div#commission-payroll-modal #total-net-pay').html().replace('$', '');
            var employeeTax = $('div#commission-payroll-modal #total-employee-tax').html().replace('$', '');
            var employerTax = $('div#commission-payroll-modal #total-employer-tax').html().replace('$', '');

            var netPayPercent = parseFloat((parseFloat(totalNetPay) / parseFloat(payrollCost)) * 100).toFixed(2);
            var employeeTaxPercent = parseFloat((parseFloat(employeeTax) / parseFloat(payrollCost)) * 100).toFixed(2);
            var employerTaxPercent = parseFloat((parseFloat(employerTax) / parseFloat(payrollCost)) * 100).toFixed(2);

            new Chart('commissionPayrollChart', {
                type: 'doughnut',
                data: {
                    labels: ['Net Pay', 'Employee', 'Employer'],
                    datasets: [{
                        label: 'Payroll',
                        data: [netPayPercent, employeeTaxPercent, employerTaxPercent],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                          ],
                          borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'bottom',
                      },
                    },
                    aspectRatio: 1.5,
                  }
            });

            el.remove();
            parent.prepend(`<button type="submit" class="nsm-button success">Submit Payroll</button>`);
            $('#commission-payroll-modal #close-payroll-modal').html('Back');
            $('#commission-payroll-modal #close-payroll-modal').removeAttr('data-bs-dismiss');
            $('#commission-payroll-modal #close-payroll-modal').attr('id', 'back-payroll-form');
        }
    });
});

$(document).on('click', '#commission-payroll-modal #back-payroll-form', function() {
    $('#commission-payroll-modal .modal-body').html(payrollForm);

    $('#commission-payroll-modal #bank-account').val(payrollFormData.get('pay_from_account')).trigger('change');
    $('#commission-payroll-modal #payDate').val(payrollFormData.get('pay_date'));
    var payPeriod = payrollFormData.get('pay_period').split('-');
    var start = payPeriod[0];
    var end = payPeriod[1];
    $('#commission-payroll-modal #pay-period-start').val(start);
    $('#commission-payroll-modal #pay-period-end').val(end);

    var employees = payrollFormData.getAll('employees[]');

    $('#commission-payroll-modal #payroll-table tr td .select-one').each(function() {
        if(employees.includes($(this).val())) {
            $(this).prop('checked', true);
        } else {
            $(this).prop('checked', false);
        }
    });

    if(employees.length === $('#commission-payroll-modal #payroll-table tr td .select-one').length) {
        $('#commission-payroll-modal #payroll-table thead .select-all').prop('checked', true);
    } else {
        $('#commission-payroll-modal #payroll-table thead .select-all').prop('checked', false);
    }

    var memos = payrollFormData.getAll('memo[]');
    for(i = 0; i < memos.length; i++)
    {
        $(`#commission-payroll-modal #payroll-table tr td .select-one[value="${employees[i]}"]`).closest('tr').find('input[name="memo[]"]').val(memos[i]);
    }

    $(this).parent().html('<button type="button" class="nsm-button primary" data-bs-dismiss="modal" id="close-payroll-modal">Close</button>');
    $('#commission-payroll-modal .modal-footer button[type="submit"]').parent().prepend(`<button type="button" class="nsm-button success" id="preview-payroll">Preview payroll</button>`);
    $('#commission-payroll-modal .modal-footer button[type="submit"]').remove();

    $('#commission-payroll-modal .modal-body select#bank-account').next().remove();
    $('#commission-payroll-modal .modal-body select#bank-account').select2({
        ajax: {
            url: '/accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'bank-account',
                    modal: 'commission-payroll-modal'
                }

                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect,
        dropdownParent: $('#commission-payroll-modal')
    });
});

$('.add-emp-payscale').change(function() {
    var psid = $(this).val();
    var url  = base_url + 'payscale/_get_details'
    $.ajax({
        type: 'POST',
        url: url,
        data: {psid:psid},
        dataType: "json",
        success: function(result) {
            if( result.pay_type == 'Commission Only' ){
                $('.add-pay-type-container').hide();
            }else{
                var rate_label = result.pay_type + ' Rate';
                $('.add-pay-type-container').show();
                $('.add-payscale-pay-type').html(rate_label);
            }                
        },
    });
});

$(document).on('click', '.btn-add-new-commision', function(e){
    let url = base_url + "user/_add_commission_form";
    $.ajax({
        type: 'POST',
        url: url,
        success: function(o) {
            $("#commission-settings tbody").append(o).children(':last').hide().fadeIn(400);
            $("#commission-settings tbody tr:last-child select").each(function() {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $("#employee-modal")
                }).on('select2:open', function() {
                    $('.select2-dropdown').css('z-index', 1000);
                });
            });
        },
    });
}); 


$(document).on("click", ".btn-delete-commission-setting-row", function(e){  
    var tableRow = $(this).closest('tr'); 
    tableRow.find('td').fadeOut('fast', 
        function(){ 
            tableRow.remove();                    
        }
    );
});

// $('#add-new-button').on('click', function(e) {
//     e.preventDefault();

//     $.get('/accounting/get-employee-modal', function(res) {
//         if($('#employee-modal').length > 0) {
//             $('#employee-modal').remove();
//         }

//         if ($('div#modal-container').next('.modal-backdrop').length > 0 ||
//             $('div#modal-container').next().next('.modal-backdrop').length > 0
//         ) {
//             $('div#modal-container').next('.modal-backdrop').remove();
//             $('div#modal-container').next().next('.modal-backdrop').remove();
//         }

//         $('div#modal-container').append(res);

//         $('#employee-modal [name="empPayscale"]').val(payroll.payscale).trigger('change');

//         $('#employee-modal select').select2({
//             minimumResultsForSearch: -1,
//             dropdownParent: $('#employee-modal')
//         });

//         $('#employee-modal').modal('show');
//     });
// });