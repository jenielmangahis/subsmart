$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
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

    var url = `${base_url}accounting/employees?`;

    url += search !== '' ? `search=${search}&` : '';
    url += status !== 'active' ? `status=${status}` : '';

    if(url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
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

$('#add-pay-schedule-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#add-pay-schedule-modal')
});

$("#add_employee_form").on("submit", function(e) {
    let _this = $(this);
    e.preventDefault();

    var url = base_url+"users/addNewEmployeeV2";
    _this.find("button[type=submit]").html("Saving");
    _this.find("button[type=submit]").prop("disabled", true);

    $.ajax({
        type: 'POST',
        url: url,
        data: _this.serialize(),
        dataType: "json",
        success: function(result) {
            if (result == 1) {
                Swal.fire({
                    title: 'Save Successful!',
                    text: "New employee source has been added successfully.",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                });
            } else if (result == 3) {
                Swal.fire({
                    title: 'Failed',
                    text: "Insufficient license. Please purchase license to continue adding user.",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Purchase License'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = base_url + 'mycrm/membership';
                    }
                });
            } else if (result == 4) {
                Swal.fire({
                    title: 'Failed',
                    text: "ADT Sales App password not same",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
            } else if (result == 5) {
                Swal.fire({
                    title: 'Failed',
                    text: "ADT Sales App account already exists",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
            } else {
                Swal.fire({
                    title: 'Failed',
                    text: "Something is wrong in the process",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
            }

            $("#add_employee_modal").modal('hide');
            _this.trigger("reset");

            _this.find("button[type=submit]").html("Save");
            _this.find("button[type=submit]").prop("disabled", false);
        },
    });
});

// $(document).on('click', 'label[for="pay-schedule"] a', function(e) {
//     e.preventDefault();
//     var pay_sched_id = $('#pay-schedule').val();
    
//     if(pay_sched_id !== 'add' && pay_sched_id !== '' && pay_sched_id !== null) {
//         $.get('/accounting/employees/edit-pay-schedule/'+pay_sched_id, function(res) {
//             if($('#add-pay-schedule-modal').length > 0) {
//                 $('#add-pay-schedule-modal').parent().parent().remove();
//             } else if($('#edit-pay-schedule-modal').length > 0) {
//                 $('#edit-pay-schedule-modal').parent().parent().remove();
//             }
//             $('.append-modal').append(res);

//             initPayScheduleElements('edit-pay-schedule-modal');
//             if($('#edit-pay-schedule-modal #custom-schedule').prop('checked')) {
//                 $('#edit-pay-schedule-modal #custom-schedule').trigger('change');
//             }

//             $('#edit-pay-schedule-modal [name="end_of_first_pay_period"]:checked, #edit-pay-schedule-modal [name="end_of_second_pay_period"]:checked').trigger('change');

//             $('#edit-pay-schedule-modal').modal('show');
//         });
//     }
// });

$(document).on('change', '#pay-schedule', function() {
    var el = $(this);
    if(el.val() === 'add') {
        // $.get('/accounting/employees/add-pay-schedule-form', function(res) {
        //     if($('#add-pay-schedule-modal').length > 0) {
        //         $('#add-pay-schedule-modal').parent().parent().remove();
        //     } else if($('#edit-pay-schedule-modal').length > 0) {
        //         $('#edit-pay-schedule-modal').parent().parent().remove();
        //     }
        //     $('.append-modal').append(res);

        //     initPayScheduleElements('add-pay-schedule-modal');

        //     $('#add-pay-schedule-modal').modal('show');
        //     el.parent().next().addClass('hide');
        // });
        $('#add-pay-schedule-modal #next-payday').trigger('change');
        $('#add-pay-schedule-modal #next-pay-period-end').trigger('change');
        $('#add_employee_modal').modal('hide');
        $('#add-pay-schedule-modal').modal('show');
    } else {
        $.get('/accounting/employees/get-pay-date/'+el.val(), function(res) {
            var result = JSON.parse(res);

            el.parent().next().children('span').html(result.date);
            el.parent().next().removeClass('hide');
        });
    }
});

$('#add-pay-schedule-modal #pay-frequency').on('change', function() {
    if($(this).val() === 'twice-month' || $(this).val() === 'every-month') {
        if($(this).parent().parent().find('#custom-schedule').length < 1) {
            $(this).parent().parent().append(`<div class="form-check form-switch nsm-switch">
                <label for="custom-schedule" class="form-check-label">Custom schedule</label>
                <input type="checkbox" name="custom_schedule" id="custom-schedule" class="form-check-input">
            </div>`);
        }
    } else {
        if($(this).parent().parent().find('#custom-schedule').length > 0) {
            $(this).parent().parent().find('#custom-schedule').prop('checked', false).trigger('change');
            $(this).parent().parent().find('#custom-schedule').parent().remove();
        }
    }

    $('#add-pay-schedule-modal #next-payday').trigger('change');
    $('#add-pay-schedule-modal #next-pay-period-end').trigger('change');

    if($(this).val() === 'twice-month' || $(this).val() === 'every-month') {
        $('#add-pay-schedule-modal #custom-schedule').trigger('change');
    }
});

$(document).on('change', '#add-pay-schedule-modal #custom-schedule', function() {
    if($('#add-pay-schedule-modal #pay-frequency').val() === 'twice-month' || $('#add-pay-schedule-modal #pay-frequency').val() === 'every-month') {
        if($(this).prop('checked')) {
            $('#add-pay-schedule-modal #next-payday, #add-pay-schedule-modal #next-pay-period-end').parent().parent().remove();
            $('#add-pay-schedule-modal #first_payday, #add-pay-schedule-modal #second_payday').closest('.row').remove();
            var appendAfterElement = $(this).closest('.row');

            var paydayOptions = '';
            var daysBeforeOptions = '';
            for(i = 1; i < 31; i++) {
                var j = i % 10,
                    k = i % 100;

                var text = i + "th";

                if (j == 1 && k != 11) {
                    var text = i + "st";
                }
                if (j == 2 && k != 12) {
                    var text = i + "nd";
                }
                if (j == 3 && k != 13) {
                    var text = i + "rd";
                }

                paydayOptions += `<option value="${i}">${text}</option>`;
                daysBeforeOptions += `<option value="${i}">${i}</option>`;
            }
            paydayOptions += `<option value="0">End of month</option>`;
            daysBeforeOptions += `<option value="-9">-9</>`;
            daysBeforeOptions += `<option value="-8">-8</>`;
            daysBeforeOptions += `<option value="-7">-7</>`;
            daysBeforeOptions += `<option value="-6">-6</>`;
            daysBeforeOptions += `<option value="-5">-5</>`;
            daysBeforeOptions += `<option value="-4">-4</>`;
            daysBeforeOptions += `<option value="-3">-3</>`;
            daysBeforeOptions += `<option value="-2">-2</>`;
            daysBeforeOptions += `<option value="-1">-1</>`;

            if($('#add-pay-schedule-modal #pay-frequency').val() === 'twice-month') {
                var appendString = `<div class="row gy-3 mb-4"> 
                    <div class="col-12">
                        <label class="content-title">First pay period of the month</label>
                    </div>
                    <div class="col-12">
                        <label for="first_payday">First payday of the month</label>
                        <select name="first_payday" id="first_payday" class="form-select nsm-field">
                            ${paydayOptions}
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="content-title">End of first pay period</label>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-check-inline">
                            <input type="radio" name="end_of_first_pay_period" id="end_date_first_pay" class="form-check-input" value="end-date" checked>
                            <label for="end_date_first_pay" class="form-check-label">End date</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="end_of_first_pay_period" id="number_of_days_first_pay" class="form-check-input ml-2" value="number-of-days-before">
                            <label for="number_of_days_first_pay" class="form-check-label">Number of days before payday</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="first_pay_month">Month</label>
                                <select name="first_pay_month" id="first_pay_month" class="form-select nsm-field">
                                    <option value="same">Same</option>
                                    <option value="previous">Previous</option>
                                    <option value="next">Next</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="first_pay_day">Day</label>
                                <select name="first_pay_day" id="first_pay_day" class="form-select nsm-field">
                                    ${paydayOptions}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gy-3 mb-4">
                    <div class="col-12">
                        <label class="content-title">Second pay period of the month</label>
                    </div>
                    <div class="col-12">
                        <label for="second_payday">Second payday of the month</label>
                        <select name="second_payday" id="second_payday" class="form-select nsm-field">
                            ${paydayOptions}
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="content-title">End of second pay period</label>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-check-inline">
                            <input type="radio" name="end_of_second_pay_period" id="end_date_second_pay" class="form-check-input" value="end-date" checked>
                            <label for="end_date_second_pay" class="form-check-label">End date</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="end_of_second_pay_period" id="number_of_days_second_pay" class="form-check-input ml-2" value="number-of-days-before">
                            <label for="number_of_days_second_pay" class="form-check-label">Number of days before payday</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="second_pay_month">Month</label>
                                <select name="second_pay_month" id="second_pay_month" class="form-select nsm-field">
                                    <option value="same">Same</option>
                                    <option value="previous">Previous</option>
                                    <option value="next">Next</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="second_pay_day">Day</label>
                                <select name="second_pay_day" id="second_pay_day" class="form-select nsm-field">
                                    ${paydayOptions}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>`;
            } else {
                var appendString = `<div class="row gy-3 mb-4"> 
                    <div class="col-12">
                        <label for="first_payday">Payday of the month</label>
                        <select name="first_payday" id="first_payday" class="form-select nsm-field">
                            ${paydayOptions}
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="content-title">End of each pay period</label>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-check-inline">
                            <input type="radio" name="end_of_first_pay_period" id="end_date_first_pay" class="form-check-input" value="end-date" checked>
                            <label for="end_date_first_pay" class="form-check-label">End date</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="end_of_first_pay_period" id="number_of_days_first_pay" class="form-check-input ml-2" value="number-of-days-before">
                            <label for="number_of_days_first_pay" class="form-check-label">Number of days before payday</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="first_pay_month">Month</label>
                                <select name="first_pay_month" id="first_pay_month" class="form-select nsm-field">
                                    <option value="same">Same</option>
                                    <option value="previous">Previous</option>
                                    <option value="next">Next</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="first_pay_day">Day</label>
                                <select name="first_pay_day" id="first_pay_day" class="form-select nsm-field">
                                    ${paydayOptions}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>`;
            }
            
            $(appendString).insertAfter(appendAfterElement);
            $('#add-pay-schedule-modal #second_payday, #add-pay-schedule-modal #second_pay_day').val('16').trigger('change');

            appendAfterElement.parent().find('select:not(.select2-hidden-accessible)').select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#add-pay-schedule-modal')
            });

            if($('#add-pay-schedule-modal #pay-frequency').val() === 'every-month') {
                customScheduleMonthly();
            } else {
                customScheduleTwiceMonth();
            }
        } else {
            $('#add-pay-schedule-modal #first_payday').parent().parent().remove();
            $('#add-pay-schedule-modal #second_payday').parent().parent().remove();

            if($('#add-pay-schedule-modal #next-payday').length < 1) {
                var toAppend = `<div class="col-12">
                    <label for="next-payday">Next payday</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" name="next_payday" id="next-payday" class="form-control nsm-field date">
                    </div>
                    <p class="m-0">Friday</p>
                </div>
                <div class="col-12">
                    <label for="next-pay-period-end">End of next pay period</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" name="next_pay_period_end" id="next-pay-period-end" class="form-control nsm-field date">
                    </div>
                    <p class="m-0">Wednesday</p>
                </div>`;

                $('#add-pay-schedule-modal #pay-frequency').closest('.row').append(toAppend);

                $('#next-payday, #nexy-pay-period-end').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
            }
        }
    } else {
        $('#add-pay-schedule-modal #first_payday').parent().parent().remove();
        $('#add-pay-schedule-modal #second_payday').parent().parent().remove();

        if($('#add-pay-schedule-modal #next-payday').length < 1) {
            var curr = new Date();
            var first = curr.getDate() - curr.getDay();
            var payPeriodEnd = new Date(curr.setDate(first  + 3));
            var payDate = new Date(curr.setDate(first  + 5));

            payPeriodEnd = String(payPeriodEnd.getMonth() + 1).padStart(2, '0') + '/' + String(payPeriodEnd.getDate()).padStart(2, '0') + '/' + payPeriodEnd.getFullYear();
            payDate = String(payDate.getMonth() + 1).padStart(2, '0') + '/' + String(payDate.getDate()).padStart(2, '0') + '/' + payDate.getFullYear();

            var toAppend = `<div class="col-12">
                <label for="next-payday">Next payday</label>
                <div class="nsm-field-group calendar">
                    <input type="text" name="next_payday" id="next-payday" class="form-control nsm-field date" value="${payDate}">
                </div>
                <p class="m-0">Friday</p>
            </div>
            <div class="col-12">
                <label for="next-pay-period-end">End of next pay period</label>
                <div class="nsm-field-group calendar">
                    <input type="text" name="next_pay_period_end" id="next-pay-period-end" class="form-control nsm-field date" value="${payPeriodEnd}">
                </div>
                <p class="m-0">Wednesday</p>
            </div>`;

            $('#add-pay-schedule-modal #pay-frequency').closest('.row').append(toAppend);

            $('#next-payday, #nexy-pay-period-end').datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        }
    }
});

$(document).on('change', '#add-pay-schedule-modal #next-payday, #add-pay-schedule-modal #next-pay-period-end', function() {
    var selectedDate = new Date($(this).val());
    var day = new Intl.DateTimeFormat('en-US', {weekday: 'long'}).format(selectedDate);
    $(this).parent().next().html(day);

    if($(this).attr('id') === 'next-payday') {
        switch($('#pay-frequency').val()) {
            case 'every-week' :
                $(`#add-pay-schedule-modal #name`).val('Every '+day);
            break;
            case 'every-other-week' :
                $(`#add-pay-schedule-modal #name`).val('Every other '+day);
            break;
            default :
                $(`#add-pay-schedule-modal #name`).val($('#pay-frequency option:selected').html());
            break;
        }
    }

    upcomingPayPeriods($(this));
});

$(document).on('change', '#add-pay-schedule-modal #first_payday, #add-pay-schedule-modal #first_pay_month, #add-pay-schedule-modal #first_pay_day, #add-pay-schedule-modal #first_pay_days_before, #add-pay-schedule-modal #second_payday, #add-pay-schedule-modal #second_pay_month, #add-pay-schedule-modal #second_pay_day, #add-pay-schedule-modal #second_pay_days_before', function() {
    switch($('#add-pay-schedule-modal #pay-frequency').val()) {
        case 'every-month' :
            customScheduleMonthly();
        break;
        case 'twice-month' :
            customScheduleTwiceMonth();
        break;
    }
});

$(document).on('change', '#add-pay-schedule-modal [name="end_of_first_pay_period"], #add-pay-schedule-modal [name="end_of_second_pay_period"]', function() {
    var paydayOptions = '';
    var daysBeforeOptions = '';
    for(i = 1; i < 31; i++) {
        var j = i % 10,
            k = i % 100;

        var text = i + "th";

        if (j == 1 && k != 11) {
            var text = i + "st";
        }
        if (j == 2 && k != 12) {
            var text = i + "nd";
        }
        if (j == 3 && k != 13) {
            var text = i + "rd";
        }

        paydayOptions += `<option value="${i}">${text}</option>`;
        daysBeforeOptions += `<option value="${i}">${i}</option>`;
    }
    paydayOptions += `<option value="0">End of month</option>`;
    daysBeforeOptions += `<option value="-9">-9</>`;
    daysBeforeOptions += `<option value="-8">-8</>`;
    daysBeforeOptions += `<option value="-7">-7</>`;
    daysBeforeOptions += `<option value="-6">-6</>`;
    daysBeforeOptions += `<option value="-5">-5</>`;
    daysBeforeOptions += `<option value="-4">-4</>`;
    daysBeforeOptions += `<option value="-3">-3</>`;
    daysBeforeOptions += `<option value="-2">-2</>`;
    daysBeforeOptions += `<option value="-1">-1</>`;

    if($(this).attr('name') === 'end_of_first_pay_period') {
        var payNo = 'first';
    } else {
        var payNo = 'second';
    }

    if($(this).val() !== 'end-date') {
        $(this).parent().parent().next().html(`<label for="${payNo}_pay_days_before">Days before payday</label>
            <select name="${payNo}_pay_days_before" id="${payNo}_pay_days_before" class="form-select nsm-field">
                ${daysBeforeOptions}
            </select>`);
    } else {
        $(this).parent().parent().next().html(`<div class="row">
            <div class="col-12 col-md-6">
                <label for="${payNo}_pay_month">Month</label>
                <select name="${payNo}_pay_month" id="${payNo}_pay_month" class="form-select nsm-field">
                    <option value="same">Same</option>
                    <option value="previous">Previous</option>
                    <option value="next">Next</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="${payNo}_pay_day">Day</label>
                <select name="${payNo}_pay_day" id="${payNo}_pay_day" class="form-select nsm-field">
                    ${paydayOptions}
                </select>
            </div>
        </div>`);

    }

    $(this).parent().parent().next().find('#second_pay_day').val('16');
    $(this).parent().parent().next().find('select').select2({
        minimumResultsForSearch: -1,
        dropdownParent: $('#add-pay-schedule-modal')
    });

    switch($('#add-pay-schedule-modal #pay-frequency').val()) {
        case 'every-month' :
            customScheduleMonthly();
        break;
        case 'twice-month' :
            customScheduleTwiceMonth();
        break;
    }
});

$(document).on('submit', '#add-pay-schedule-form', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: '/accounting/employees/add-pay-schedule',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);

            $('#add_employee_modal #pay-schedule option:selected').removeAttr('selected');
            $('#add_employee_modal #pay-schedule').append(`<option value="${result.id}" selected>${result.name}</option>`);
            $('#add_employee_modal #pay-schedule').trigger('change');

            $('#add-pay-schedule-modal').modal('hide');
            $('#add_employee_modal').modal('show');
        }
    });
});

$(document).on('click', '#add_employee_modal #edit-pay-schedule', function(e) {
    e.preventDefault();
    var pay_sched_id = $('#add_employee_modal #pay-schedule').val();
    
    if(pay_sched_id !== 'add' && pay_sched_id !== '' && pay_sched_id !== null) {
        $.get('/accounting/employees/get-pay-schedule/'+pay_sched_id, function(res) {
            var paySched = JSON.parse(res);

            $('#add-pay-schedule-modal #add-pay-schedule-form').attr('id', 'edit-pay-schedule-form');

            $('#add-pay-schedule-modal #name').val(paySched.name);
            $('#add-pay-schedule-modal #pay-frequency').val(paySched.pay_frequency).trigger('change');

            $('#add_employee_modal').modal('hide');
            $('#add-pay-schedule-modal').modal('show');
        });
    }
});

function upcomingPayPeriods(el)
{
    if(el.attr('id') === 'next-payday') {
        var i = 0;
        var value = el.val();
        var date = new Date(value);
        var setDate = new Date(`${date.getMonth()+1}/${date.getDate()}/${date.getFullYear()}`);

        $('#add-pay-schedule-modal .card.shadow').each(function() {
            if(i === 0) {
                $(this).find('p.pay-date').html(value);
            } else {
                switch($('#pay-frequency').val()) {
                    case 'every-week' :
                        setDate.setDate(setDate.getDate() + 7);
                    break;
                    case 'every-other-week' :
                        setDate.setDate(setDate.getDate() + 14);
                    break;
                    case 'twice-month' :
                        setDate.setDate(setDate.getDate() + 15);
                    break;
                    case 'every-month' :
                        var totalDays = getTotalDaysOfMonth(setDate.getMonth() + 2, setDate.getFullYear());
                        if(date.getDate() >= totalDays) {
                            setDate = new Date(`${setDate.getMonth()+2}/${totalDays}/${setDate.getFullYear()}`);
                        } else {
                            setDate.setMonth(setDate.getMonth() + 1);
                        }
                    break;
                }

                var newDate = String(setDate.getMonth() + 1).padStart(2, '0')+'/'+String(setDate.getDate()).padStart(2, '0')+'/'+setDate.getFullYear();
                
                $(this).find('p.pay-date').html(newDate);
            }
            i++;
        });
    } else {
        var value = el.val();
        var endPeriod = new Date(value);
        var i = 0;

        var startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());

        switch($('#pay-frequency').val()) {
            case 'every-week' :
                startPeriod.setDate(startPeriod.getDate() - 6);
            break;
            case 'every-other-week' :
                startPeriod.setDate(startPeriod.getDate() - 13);
            break;
            case 'twice-month' :
                startPeriod.setDate(startPeriod.getDate() - 14);
            break;
            case 'every-month' :
                if(endPeriod.getDate() === getTotalDaysOfMonth(endPeriod.getMonth() + 1, endPeriod.getFullYear())) {
                    startPeriod.setDate(1);
                } else {
                    startPeriod.setMonth(startPeriod.getMonth() - 1);
                    startPeriod.setDate(startPeriod.getDate() + 1);
                }
            break;  
        }

        $('#add-pay-schedule-modal .card.shadow').each(function() {
            $($(this).find('p.pay-period').children('span')[0]).html(String(startPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(startPeriod.getDate()).padStart(2, '0')+'/'+startPeriod.getFullYear());
            $($(this).find('p.pay-period').children('span')[1]).html(String(endPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(endPeriod.getDate()).padStart(2, '0')+'/'+endPeriod.getFullYear());

            startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate() + 1);
            switch($('#pay-frequency').val()) {
                case 'every-week' :
                    endPeriod.setDate(endPeriod.getDate() + 7);
                break;
                case 'every-other-week' :
                    endPeriod.setDate(endPeriod.getDate() + 14);
                break;
                case 'twice-month' :
                    if(i === 1) {
                        endPeriod = new Date(value);
                        if(endPeriod.getDate() === getTotalDaysOfMonth(endPeriod.getMonth() + 1, endPeriod.getFullYear())) {
                            endPeriod = new Date(startPeriod.getFullYear(), startPeriod.getMonth(), getTotalDaysOfMonth(startPeriod.getMonth() + 1, startPeriod.getFullYear()));
                        } else {
                            endPeriod.setMonth(endPeriod.getMonth() + 1);
                        }
                    } else if(i === 2) {
                        endPeriod = new Date(value);
                        endPeriod.setDate(endPeriod.getDate() + 15);
                        endPeriod.setMonth(endPeriod.getMonth() + 1);
                    } else {
                        if(i === 0) {
                            endPeriod.setDate(endPeriod.getDate() + 15);
                        }
                    }
                    
                break;
                case 'every-month' :
                    if(startPeriod.getDate() === 1) {
                        endPeriod.setMonth(startPeriod.getMonth() + 1);
                        endPeriod.setDate(0);
                    } else {
                        endPeriod.setMonth(startPeriod.getMonth() + 1);
                    }
                break;
            }
            i++;
        });
    }
}

function customScheduleMonthly() 
{
    var firstPayday = parseInt($('#add-pay-schedule-modal #first_payday').val());
    var endOfPayPeriod = $('#add-pay-schedule-modal [name="end_of_first_pay_period"]:checked').val();
    var startPeriod = new Date();
    var endPeriod = new Date();
    var currentDate = new Date();
    var payDate = new Date();

    if(firstPayday === 0) {
        if(currentDate.getDate() === getTotalDaysOfMonth(currentDate.getMonth() + 1, currentDate.getFullYear())) {
            payDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 2, 0);
        } else {
            payDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        }
    } else {
        if(currentDate.getDate() >= firstPayday) {
            payDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, firstPayday);
        } else {
            payDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), firstPayday);
        }
    }

    if(endOfPayPeriod === 'end-date') {
        var periodMonth = $('#add-pay-schedule-modal #first_pay_month').val();
        var periodDay = parseInt($('#add-pay-schedule-modal #first_pay_day').val());

        switch(periodMonth) {
            case 'same' :
                if(periodDay === 0) {
                    var date = getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear());
                } else {
                    var date = periodDay;
                }
                var endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), date);
            break;
            case 'previous' :
                if(periodDay === 0) {
                    var date = getTotalDaysOfMonth(payDate.getMonth(), payDate.getFullYear());
                } else {
                    var date = periodDay;
                }

                var endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() - 1, date);
            break;
            case 'next' :
                if(periodDay === 0) {
                    var date = getTotalDaysOfMonth(payDate.getMonth() + 2, payDate.getFullYear());
                } else {
                    var date = periodDay;
                }
                var endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() + 1, date);
            break;
        }

        startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
        if(periodDay === 0) {
            startPeriod.setDate(1);
        } else {
            startPeriod.setDate(startPeriod.getDate() + 1);
            startPeriod.setMonth(startPeriod.getMonth() - 1);
        }
    } else {
        var daysBefore = parseInt($('#add-pay-schedule-modal #first_pay_days_before').val());

        endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate());
        endPeriod.setDate(endPeriod.getDate() - daysBefore);

        startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
        startPeriod.setDate(startPeriod.getDate() - 30);
    }

    $('#add-pay-schedule-modal  .card.shadow').each(function() {
        var newDate = String(payDate.getMonth() + 1).padStart(2, '0')+'/'+String(payDate.getDate()).padStart(2, '0')+'/'+payDate.getFullYear();

        $(this).find('p.pay-date').html(newDate);

        if(firstPayday !== 0) {
            payDate.setMonth(payDate.getMonth() + 1);
        } else {
            payDate = new Date(payDate.getFullYear(), payDate.getMonth() + 2, 0);
        }

        var startPeriodStr = String(startPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(startPeriod.getDate()).padStart(2, '0')+'/'+startPeriod.getFullYear();
        var endPeriodStr = String(endPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(endPeriod.getDate()).padStart(2, '0')+'/'+endPeriod.getFullYear();

        $($(this).find('p.pay-period').children('span')[0]).html(startPeriodStr);
        $($(this).find('p.pay-period').children('span')[1]).html(endPeriodStr);

        startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
        startPeriod.setDate(startPeriod.getDate() + 1);

        if(endOfPayPeriod === 'end-date') {
            if(periodDay === 0) {
                var monthEndDate = getTotalDaysOfMonth(startPeriod.getMonth() + 1, startPeriod.getFullYear());
                endPeriod = new Date(startPeriod.getFullYear(), startPeriod.getMonth(), monthEndDate);
            } else {
                endPeriod.setMonth(endPeriod.getMonth() + 1);
            }
        } else {
            endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate());
            endPeriod.setDate(endPeriod.getDate() - daysBefore);
        }
    });
}

function customScheduleTwiceMonth()
{
    var firstPayday = parseInt($('#add-pay-schedule-modal #first_payday').val());
    var endOfFirstPayPeriod = $('#add-pay-schedule-modal [name="end_of_first_pay_period"]:checked').val();
    var secondPayday = parseInt($('#add-pay-schedule-modal #second_payday').val());
    var endOfSecondPayPeriod = $('#add-pay-schedule-modal [name="end_of_second_pay_period"]:checked').val();
    var startPeriod = new Date();
    var endPeriod = new Date();
    var currentDate = new Date();
    var payDate = new Date();
    var firstPeriodMonth = $('#add-pay-schedule-modal #first_pay_month').val();
    var firstPeriodDay = parseInt($('#add-pay-schedule-modal #first_pay_day').val());
    var secondPeriodMonth = $('#add-pay-schedule-modal #second_pay_month').val();
    var secondPeriodDay = parseInt($('#add-pay-schedule-modal #second_pay_day').val());

    firstPayday = firstPayday === 0 ? getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear()) : firstPayday ;
    secondPayday = secondPayday === 0 ? getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear()) : secondPayday ;

    if(currentDate.getDate() >= firstPayday) {
        payDate.setDate(secondPayday);
    } else {
        payDate.setDate(firstPayday);
    }

    if(payDate.getDate() === firstPayday) {
        if(endOfFirstPayPeriod === 'end-date') {
            switch(firstPeriodMonth) {
                case 'same' :
                    endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), firstPeriodDay);
                break;
                case 'previous' :
                    endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() - 1, firstPeriodDay);
                break;
                case 'next' :
                    endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() + 1, firstPeriodDay);
                break;
            }
        } else {
            var firstDaysBefore = parseInt($('#add-pay-schedule-modal #first_pay_days_before').val());
            endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - firstDaysBefore);
        }

        var lastPayDate = new Date(payDate.getFullYear(), payDate.getMonth() -1, secondPayday);
        if(endOfSecondPayPeriod === 'end-date') {
            switch(secondPeriodMonth) {
                case 'same' :
                    startPeriod = new Date(lastPayDate.getFullYear(), lastPayDate.getMonth(), secondPeriodDay + 1);
                break;
                case 'previous' :
                    startPeriod = new Date(lastPayDate.getFullYear(), lastPayDate.getMonth() - 1, secondPeriodDay + 1);
                break;
                case 'next' :
                    startPeriod = new Date(lastPayDate.getFullYear(), lastPayDate.getMonth() + 1, secondPeriodDay + 1);
                break;
            }
        } else {
            var secondDaysBefore = parseInt($('#add-pay-schedule-modal #second_pay_days_before').val());
            startPeriod = new Date(lastPayDate.getFullYear(), lastPayDate.getMonth(), lastPayDate.getDate() - (secondDaysBefore - 1));
        }
    } else {
        if(endOfSecondPayPeriod === 'end-date') {
            switch(secondPeriodMonth) {
                case 'same' :
                    endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), secondPeriodDay);
                break;
                case 'previous' :
                    endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() - 1, secondPeriodDay);
                break;
                case 'next' :
                    endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() + 1, secondPeriodDay);
                break;
            }
        } else {
            var secondDaysBefore = parseInt($('#add-pay-schedule-modal #second_pay_days_before').val());
            endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - secondDaysBefore);
        }

        var lastPayDate = new Date(payDate.getFullYear(), payDate.getMonth(), firstPayday);
        if(endOfFirstPayPeriod === 'end-date') {
            switch(firstPeriodMonth) {
                case 'same' :
                    startPeriod = new Date(lastPayDate.getFullYear(), lastPayDate.getMonth(), firstPeriodDay + 1);
                break;
                case 'previous' :
                    startPeriod = new Date(lastPayDate.getFullYear(), lastPayDate.getMonth() - 1, firstPeriodDay + 1);
                break;
                case 'next' :
                    startPeriod = new Date(lastPayDate.getFullYear(), lastPayDate.getMonth() + 1, firstPeriodDay + 1);
                break;
            }
        } else {
            var firstDaysBefore = parseInt($('#add-pay-schedule-modal #first_pay_days_before').val());
            startPeriod = new Date(lastPayDate.getFullYear(), lastPayDate.getMonth(), lastPayDate.getDate() - (firstDaysBefore - 1));
        }
    }

    $('#add-pay-schedule-modal  .card.shadow').each(function() {
        var newDate = String(payDate.getMonth() + 1).padStart(2, '0')+'/'+String(payDate.getDate()).padStart(2, '0')+'/'+payDate.getFullYear();

        $(this).find('p.pay-date').html(newDate);

        if(payDate.getDate() === firstPayday) {
            if(parseInt($('#add-pay-schedule-modal #second_payday').val()) === 0) {
                secondPayday = getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear())
            }
            payDate.setDate(secondPayday);
        } else {
            payDate.setMonth(payDate.getMonth() + 1);
            if(parseInt($('#add-pay-schedule-modal #first_payday').val()) === 0) {
                firstPayday = getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear())
            }
            payDate.setDate(firstPayday);
        }

        var startPeriodStr = String(startPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(startPeriod.getDate()).padStart(2, '0')+'/'+startPeriod.getFullYear();
        var endPeriodStr = String(endPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(endPeriod.getDate()).padStart(2, '0')+'/'+endPeriod.getFullYear();

        $($(this).find('p.pay-period').children('span')[0]).html(startPeriodStr);
        $($(this).find('p.pay-period').children('span')[1]).html(endPeriodStr);

        startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate() + 1);

        if(payDate.getDate() === firstPayday) {
            if(endOfFirstPayPeriod === 'end-date') {
                switch(firstPeriodMonth) {
                    case 'same' :
                        endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), firstPeriodDay);
                    break;
                    case 'previous' :
                        endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() - 1, firstPeriodDay);
                    break;
                    case 'next' :
                        endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() + 1, firstPeriodDay);
                    break;
                }
            } else {
                var firstDaysBefore = parseInt($('#add-pay-schedule-modal #first_pay_days_before').val());
                endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - firstDaysBefore);
            }
        } else {
            if(endOfSecondPayPeriod === 'end-date') {
                switch(secondPeriodMonth) {
                    case 'same' :
                        if(secondPeriodDay === 0) {
                            var date = getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear());
                        } else {
                            var date = secondPeriodDay;
                        }
                        endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), date);
                    break;
                    case 'previous' :
                        if(secondPeriodDay === 0) {
                            var date = getTotalDaysOfMonth(payDate.getMonth(), payDate.getFullYear());
                        } else {
                            var date = secondPeriodDay;
                        }
                        endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() - 1, date);
                    break;
                    case 'next' :
                        if(secondPeriodDay === 0) {
                            var date = getTotalDaysOfMonth(payDate.getMonth() + 2, payDate.getFullYear());
                        } else {
                            var date = secondPeriodDay;
                        }
                        endPeriod = new Date(payDate.getFullYear(), payDate.getMonth() + 1, date);
                    break;
                }
            } else {
                var secondDaysBefore = parseInt($('#add-pay-schedule-modal #second_pay_days_before').val());
                endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - secondDaysBefore);
            }
        }
    });
}

function getTotalDaysOfMonth(month, year)
{
    return new Date(year, month, 0).getDate();
}