function showCol(el)
{
    var col = $(el).attr('id').replace('chk-', '');

    if($(el).prop('checked')) {
        $(`#employees-table .${col}`).removeClass('hide');
    } else {
        $(`#employees-table .${col}`).addClass('hide');
    }
}

function initElements(method)
{
    $(`#${method}-employee-modal #hire_date`).datepicker({
        uiLibrary: 'bootstrap',
        todayBtn: "linked",
        language: "de"
    });

    $(`#${method}-employee-modal select`).select2();

    $(`#${method}-employee-modal #title`).select2({
        placeholder: 'Select Title',
        allowClear: true,
        width: 'resolve',
        delay: 250,
        ajax: {
            url: '/users/getRoles',
            type: "GET",
            dataType: "json",
            data: function(params) {
                var query = {
                    search: params.term
                };
                return query;
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    var fname = [];
    var selected = [];
    var profilePhoto = new Dropzone('#employeeProfilePhoto', {
        url: '/users/profilePhoto',
        acceptedFiles: "image/*",
        maxFilesize: 20,
        maxFiles: 1,
        addRemoveLinks: true,
        init: function() {
            this.on("success", function(file, response) {
                var file_name = JSON.parse(response)['photo'];
                fname.push(file_name.replace(/\"/g, ""));
                selected.push(file);
                $('#photoIdAdd').val(JSON.parse(response)['id']);
                $('#photoNameAdd').val(JSON.parse(response)['photo']);
            });
        },
        removedfile: function(file) {
            var name = fname;
            var index = selected.map(function(d, index) {
                if (d == file) return index;
            }).filter(isFinite)[0];
            $.ajax({
                type: "POST",
                url: base_url + 'users/removeProfilePhoto',
                dataType: 'json',
                data: {
                    name: name,
                    index: index
                },
                success: function(data) {
                    if (data == 1) {
                        $('#photoId').val(null);
                    }
                }
            });
            //remove thumbnail
            var previewElement;
            return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
        }
    });
}

function upcomingPayPeriods(el)
{
    if(el.attr('id') === 'next-payday') {
        var i = 0;
        var value = el.val();
        var date = new Date(value);
        var setDate = new Date(`${date.getMonth()+1}/${date.getDate()}/${date.getFullYear()}`);

        $('.pay-periods .card.shadow').each(function() {
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

        var date = endPeriod.getDate() - 6;

        if($('#pay-frequency').val() === 'every-other-week') {
            date = endPeriod.getDate() - 13;
        } else if($('#pay-frequency').val() === 'twice-month') {
            date = endPeriod.getDate() - 15;
        } else if($('#pay-frequency').val() === 'every-month') {
            date = endPeriod.getDate();
        }
        var startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), date);

        if($('#pay-frequency').val() === 'every-month') {
            startPeriod.setDate(startPeriod.getDate() - 30);
        }

        $('.pay-periods .card.shadow').each(function() {
            $($(this).find('p.pay-period').children('span')[0]).html(String(startPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(startPeriod.getDate()).padStart(2, '0')+'/'+startPeriod.getFullYear());
            $($(this).find('p.pay-period').children('span')[1]).html(String(endPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(endPeriod.getDate()).padStart(2, '0')+'/'+endPeriod.getFullYear());

            switch($('#pay-frequency').val()) {
                case 'every-week' :
                    endPeriod.setDate(endPeriod.getDate() + 7);
                    startPeriod.setDate(startPeriod.getDate() + 7);
                break;
                case 'every-other-week' :
                    endPeriod.setDate(endPeriod.getDate() + 14);
                    startPeriod.setDate(startPeriod.getDate() + 14);
                break;
                case 'twice-month' :
                    startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
                    startPeriod.setDate(startPeriod.getDate() + 1);
                    endPeriod = new Date(startPeriod.getFullYear(), startPeriod.getMonth(), startPeriod.getDate());
                    endPeriod.setDate(endPeriod.getDate() + 14);
                break;
                case 'every-month' :
                    startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
                    startPeriod.setDate(startPeriod.getDate() + 1);

                    if(startPeriod.getDate() === 1) {
                        endPeriod.setMonth(startPeriod.getMonth() + 1);
                        endPeriod.setDate(0);
                    } else {
                        endPeriod.setMonth(startPeriod.getMonth() + 1);
                    }
                break;
            }
        });
    }
}

function getTotalDaysOfMonth(month, year)
{
    return new Date(year, month, 0).getDate();
}

function customScheduleMonthly() 
{
    var firstPayday = parseInt($('#first_payday').val());
    var endOfPayPeriod = $('[name="end_of_first_pay_period"]:checked').val();
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
        var periodMonth = $('#first_pay_month').val();
        var periodDay = parseInt($('#first_pay_day').val());
        var date = periodDay === 0 ? getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear()) : periodDay ;

        switch(periodMonth) {
            case 'same' :
                endPeriod.setMonth(payDate.getMonth());
            break;
            case 'previous' :
                endPeriod.setMonth(payDate.getMonth() - 1);
            break;
            case 'next' :
                endPeriod.setMonth(payDate.getMonth() + 1);
            break;
        }

        endPeriod.setDate(date);

        startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
        if(periodDay === 0) {
            startPeriod.setDate(1);
        } else {
            startPeriod.setDate(startPeriod.getDate() + 1);
            startPeriod.setMonth(startPeriod.getMonth() - 1);
        }
    } else {
        var daysBefore = parseInt($('#first_pay_days_before').val());

        endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate());
        endPeriod.setDate(endPeriod.getDate() - daysBefore);

        startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
        startPeriod.setDate(startPeriod.getDate() - 29);
    }

    $('.pay-periods .card.shadow').each(function() {
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
    var firstPayday = parseInt($('#first_payday').val());
    var endOfFirstPayPeriod = $('[name="end_of_first_pay_period"]:checked').val();
    var secondPayday = parseInt($('#second_payday').val());
    var endOfSecondPayPeriod = $('[name="end_of_second_pay_period"]:checked').val();
    var startPeriod = new Date();
    var endPeriod = new Date();
    var currentDate = new Date();
    var payDate = new Date();
    var firstPeriodMonth = $('#first_pay_month').val();
    var firstPeriodDay = parseInt($('#first_pay_day').val());
    var secondPeriodMonth = $('#second_pay_month').val();
    var secondPeriodDay = parseInt($('#second_pay_day').val());

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

            startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth() - 1, secondPeriodDay + 1);

        } else {
            var firstDaysBefore = parseInt($('#first_pay_days_before').val());
            endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - firstDaysBefore);
            startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());

            startPeriod.setMonth(startPeriod.getMonth() - 1);
            startPeriod.setDate(secondPayDay - parseInt($('#second_pay_days_before').val()));
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

            startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), firstPeriodDay + 1);
        } else {
            var secondDaysBefore = parseInt($('#second_pay_days_before').val());
            endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - secondDaysBefore);
            startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());

            startPeriod.setDate(firstPayday - parseInt($('#second_pay_days_before').val()));
        }
    }

    $('.pay-periods .card.shadow').each(function() {
        var newDate = String(payDate.getMonth() + 1).padStart(2, '0')+'/'+String(payDate.getDate()).padStart(2, '0')+'/'+payDate.getFullYear();

        $(this).find('p.pay-date').html(newDate);

        if(payDate.getDate() === firstPayday) {
            payDate.setDate(secondPayday);
        } else {
            payDate.setMonth(payDate.getMonth() + 1);
            payDate.setDate(firstPayday);
        }

        var startPeriodStr = String(startPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(startPeriod.getDate()).padStart(2, '0')+'/'+startPeriod.getFullYear();
        var endPeriodStr = String(endPeriod.getMonth() + 1).padStart(2, '0')+'/'+String(endPeriod.getDate()).padStart(2, '0')+'/'+endPeriod.getFullYear();

        $($(this).find('p.pay-period').children('span')[0]).html(startPeriodStr);
        $($(this).find('p.pay-period').children('span')[1]).html(endPeriodStr);

        startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
        startPeriod.setDate(startPeriod.getDate() + 1);

        if(payDate.getDate() === firstPeriodDay) {
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
                var firstDaysBefore = parseInt($('#first_pay_days_before').val());
                endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - firstDaysBefore);
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
                var secondDaysBefore = parseInt($('#second_pay_days_before').val());
                endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - secondDaysBefore);
            }
        }
    });
}

function initPayScheduleElements(modalId)
{
    $(`#${modalId} select`).select2();

    var modalElems = Array.prototype.slice.call(document.querySelectorAll(`#${modalId} .js-switch`));

    modalElems.forEach(function(html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    $(`#${modalId} .datepicker`).each(function() {
        $(this).datepicker({
            uiLibrary: 'bootstrap',
            todayBtn: "linked",
            language: "de"
        });

        $(this).on('change', function() {
            var selectedDate = new Date($(this).val());
            var day = new Intl.DateTimeFormat('en-US', {weekday: 'long'}).format(selectedDate);
            $(this).parent().next().html(day);

            if($(this).attr('id') === 'next-payday') {
                switch($('#pay-frequency').val()) {
                    case 'every-week' :
                        $(`#${modalId} #name`).val('Every '+day);
                    break;
                    case 'every-other-week' :
                        $(`#${modalId} #name`).val('Every other '+day);
                    break;
                    default :
                        $(`#${modalId} #name`).val($('#pay-frequency option:selected').html());
                    break;
                }
            }

            upcomingPayPeriods($(this));
        }).trigger('change');
    });
}

$(document).on('change', '#first_payday, [name="end_of_first_pay_period"], #first_pay_month, #first_pay_day, #first_pay_days_before', function() {
    switch($('#pay-frequency').val()) {
        case 'every-month' :
            customScheduleMonthly();
        break;
        case 'twice-month' :
            customScheduleTwiceMonth();
        break;
    }
});

$(document).on('change', '#second_payday, [name="end_of_second_pay_period"], #second_pay_month, #second_pay_day, #second_pay_days_before', function() {
    if($('#pay-frequency').val() === 'twice-month') {
        customScheduleTwiceMonth();
    }
});

$('#employee-status').select2({
    minimumResultsForSearch: -1
});

$('#employee-status').on('change', function() {
    table.ajax.reload();
});

$('#search').on('keyup', function() {
    table.ajax.reload();
});

$('#privacy').on('change', function() {
    if($(this).prop('checked')) {
        $('#employees-table tbody .pay-rate').html(`<i class="fa fa-lock"></i>`);
    } else {
        $('#employees-table tbody tr').each(function() {
            var data = table.row($(this)).data();
            
            $(this).find('.pay-rate').html(data.pay_rate);
        });
    }
});

$('#add-employee-button').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/employees/add', function(res) {
        $('.append-modal').html(res);
        
        initElements('add');

        $('#add-employee-modal').modal('show');
    });
});

$(document).on('click', '.showPass', function() {
    $(this).toggleClass('fa-eye-slash');
    if ($(this).prev('input[type="password"]').length == 1) {
        $(this).prev('input[type="password"]').attr('type', 'text');
        $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
    } else {
        $(this).prev('input[type="text"]').attr('type', 'password');
        $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
    }
});

$(document).on('click', '.showConfirmPass', function() {
    $(this).toggleClass('fa-eye-slash');
    if ($(this).prev('input[type="password"]').length == 1) {
        $(this).prev('input[type="password"]').attr('type', 'text');
        $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
    } else {
        $(this).prev('input[type="text"]').attr('type', 'password');
        $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
    }
});

var element = document.querySelector('#privacy');
var switchery = new Switchery(element, {size: 'small'});

$(document).on('click', '#employees-table tbody tr', function() {
    var data = table.row($(this)).data();

    $.get('/accounting/employees/edit/'+data.id, function(res) {
        $('.append-modal').html(res);

        initElements('edit');

        $('#edit-employee-modal').modal('show');
    });
});

$('#run-payroll-button').on('click', function(e) {
    e.preventDefault();

    $('[data-target="#payrollModal"]').trigger('click');
});

$(document).on('change', '#pay-schedule', function() {
    if($(this).val() === 'add') {
        $.get('/accounting/employees/add-pay-schedule-form', function(res) {
            if($('#add-pay-schedule-modal').length > 0) {
                $('#add-pay-schedule-modal').parent().parent().remove();
            } else if($('#edit-pay-schedule-modal').length > 0) {
                $('#edit-pay-schedule-modal').parent().parent().remove();
            }
            $('.append-modal').append(res);

            initPayScheduleElements('add-pay-schedule-modal');

            $('#add-pay-schedule-modal').modal('show');
        });
    }
});

$(document).on('change', '#pay-frequency', function() {
    if($(this).val() === 'twice-month' || $(this).val() === 'every-month') {
        $(this).next().next().removeClass('hide');

        $('#next-payday').trigger('change');
        $('#next-pay-period-end').trigger('change');
        $('#custom-schedule').trigger('change');
    } else {
        $(this).next().next().addClass('hide');

        $('#next-payday').trigger('change');
        $('#next-pay-period-end').trigger('change');
    }
});

$(document).on('change', '#custom-schedule', function() {
    var payFreq = ["twice-month", "every-month"];
    if($(this).prop('checked') &&  payFreq.includes($('#pay-frequency').val())) {
        $($('.custom-schedule-fields')[0]).prev().addClass('hide');

        if($('#pay-frequency').val() === 'twice-month') {
            $($('.custom-schedule-fields h5')[0]).removeClass('hide');
            $('.custom-schedule-fields label[for="first_payday"]').html('First payday of the month');
            $('.custom-schedule-fields #end_date_first_pay').parent().prev().html('End of first pay period');
            $('.custom-schedule-fields').removeClass('hide');
        } else {
            $($('.custom-schedule-fields h5')[0]).addClass('hide');
            $('.custom-schedule-fields label[for="first_payday"]').html('Payday of the month');
            $('.custom-schedule-fields #end_date_first_pay').parent().prev().html('End of each pay period');
            $($('.custom-schedule-fields')[0]).removeClass('hide');
            $($('.custom-schedule-fields')[1]).addClass('hide');
        }

        if($('#pay-frequency').val() === 'every-month') {
            customScheduleMonthly();
        } else {
            customScheduleTwiceMonth();
        }
    } else {
        $($('.custom-schedule-fields')[0]).prev().removeClass('hide');
        $('.custom-schedule-fields').addClass('hide');

        $('#next-payday').trigger('change');
        $('#next-pay-period-end').trigger('change');
    }
});

$(document).on('change', '[name="end_of_first_pay_period"], [name="end_of_second_pay_period"]', function() {
    if($(this).val() !== 'end-date') {
        $(this).parent().parent().next().find('.form-group.col-md-12').removeClass('hide');
        $(this).parent().parent().next().find('.form-group.col-md-6').addClass('hide');
    } else {
        $(this).parent().parent().next().find('.form-group.col-md-12').addClass('hide');
        $(this).parent().parent().next().find('.form-group.col-md-6').removeClass('hide');
    }
});

var table = $('#employees-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: 50,
    order: [[0, 'asc']],
    ajax: {
        url: 'employees/load/',
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.status = $('#employee-status').val();
            d.columns[0].search.value = $('input#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: [
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'pay_rate',
            name: 'pay_rate',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('pay-rate');
                if($('#chk-pay-rate').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'pay_method',
            name: 'pay_method',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('pay-method');
                if($('#chk-pay-method').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'status',
            name: 'status',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`
                <div class="btn-group">
                    <button class="btn" type="button" id="statusDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ${cellData}&nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                        <a class="dropdown-item" href="/accounting/employees/set-status/${rowData.id}/active">Active</a>
                        <a class="dropdown-item" href="/accounting/employees/set-status/${rowData.id}/paid-leave">Paid leave of absence</a>
                        <a class="dropdown-item" href="/accounting/employees/set-status/${rowData.id}/unpaid-leave">Unpaid leave of absence</a>
                        <a class="dropdown-item" href="/accounting/employees/set-status/${rowData.id}/not-on-payroll">Not on payroll</a>
                        <a class="dropdown-item" href="/accounting/employees/set-status/${rowData.id}/terminated">Terminated</a>
                        <a class="dropdown-item" href="/accounting/employees/set-status/${rowData.id}/deceased">Deceased</a>
                    </div>
                </div>
                `);

                $(td).addClass('status');
                if($('#chk-status').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'email_address',
            name: 'email_address',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('email-address');
                if($('#chk-email-address').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'phone_number',
            name: 'phone_number',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('phone-num');
                if($('#chk-phone-num').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        }
    ]
});

$(document).on('submit', '#pay-schedule-form', function(e) {
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

            $('#add-employee-modal #pay-schedule option:selected').removeAttr('selected');
            $('#add-employee-modal #pay-schedule').append(`<option value="${result.id}" selected>${result.name}</option>`);

            $('#add-pay-schedule-modal').modal('hide');
        }
    });
});

$(document).on('click', '#add-employee-modal label[for="pay-schedule"] a', function(e) {
    e.preventDefault();
    var pay_sched_id = $('#add-employee-modal #pay-schedule').val();
    
    if(pay_sched_id !== 'add' || pay_sched_id !== '') {
        $.get('/accounting/employees/edit-pay-schedule/'+pay_sched_id, function(res) {
            if($('#add-pay-schedule-modal').length > 0) {
                $('#add-pay-schedule-modal').parent().parent().remove();
            } else if($('#edit-pay-schedule-modal').length > 0) {
                $('#edit-pay-schedule-modal').parent().parent().remove();
            }
            $('.append-modal').append(res);

            initPayScheduleElements('edit-pay-schedule-modal');

            $('#edit-pay-schedule-modal').modal('show');
        });
    }
});

$(document).on('submit', '#edit-pay-schedule-form', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: '/accounting/employees/update-pay-schedule/'+$('#pay-schedule').val(),
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);
            var prev = $('#pay-schedule option:selected').prev();

            $(`#add-employee-modal #pay-schedule option:selected`).remove();
            $(`<option value="${result.id}" selected>${result.name}</option>`).insertAfter(prev);
            $('#add-employee-modal #pay-schedule').trigger('change');

            $('#edit-pay-schedule-modal').modal('hide');
        }
    });
});