var bonusPayAsFields = '';
var bonusPayType = '';

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

        $('.pay-periods .card.shadow').each(function() {
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

            startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());
            startPeriod.setDate(startPeriod.getDate() - 14);

        } else {
            var firstDaysBefore = parseInt($('#first_pay_days_before').val());
            endPeriod = new Date(payDate.getFullYear(), payDate.getMonth(), payDate.getDate() - firstDaysBefore);
            startPeriod = new Date(endPeriod.getFullYear(), endPeriod.getMonth(), endPeriod.getDate());

            startPeriod.setMonth(startPeriod.getMonth() - 1);
            startPeriod.setDate(secondPayday - parseInt($('#second_pay_days_before').val()));
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
            if(parseInt($('#second_payday').val()) === 0) {
                secondPayday = getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear())
            }
            payDate.setDate(secondPayday);
        } else {
            payDate.setMonth(payDate.getMonth() + 1);
            if(parseInt($('#first_payday').val()) === 0) {
                firstPayday = getTotalDaysOfMonth(payDate.getMonth() + 1, payDate.getFullYear())
            }
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

        if($(this).val() !== "") {
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
        }
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
    var el = $(this);
    if(el.val() === 'add') {
        $.get('/accounting/employees/add-pay-schedule-form', function(res) {
            if($('#add-pay-schedule-modal').length > 0) {
                $('#add-pay-schedule-modal').parent().parent().remove();
            } else if($('#edit-pay-schedule-modal').length > 0) {
                $('#edit-pay-schedule-modal').parent().parent().remove();
            }
            $('.append-modal').append(res);

            initPayScheduleElements('add-pay-schedule-modal');

            $('#add-pay-schedule-modal').modal('show');
            el.parent().next().addClass('hide');
        });
    } else {
        $.get('/accounting/employees/get-pay-date/'+el.val(), function(res) {
            var result = JSON.parse(res);

            el.parent().next().children('span').html(result.date);
            el.parent().next().removeClass('hide');
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

            $('#pay-schedule option:selected').removeAttr('selected');
            $('#pay-schedule').append(`<option value="${result.id}" selected>${result.name}</option>`);
            $('#pay-schedule').trigger('change');

            $('#add-pay-schedule-modal').modal('hide');
        }
    });
});

$(document).on('click', 'label[for="pay-schedule"] a', function(e) {
    e.preventDefault();
    var pay_sched_id = $('#pay-schedule').val();
    
    if(pay_sched_id !== 'add' && pay_sched_id !== '' && pay_sched_id !== null) {
        $.get('/accounting/employees/edit-pay-schedule/'+pay_sched_id, function(res) {
            if($('#add-pay-schedule-modal').length > 0) {
                $('#add-pay-schedule-modal').parent().parent().remove();
            } else if($('#edit-pay-schedule-modal').length > 0) {
                $('#edit-pay-schedule-modal').parent().parent().remove();
            }
            $('.append-modal').append(res);

            initPayScheduleElements('edit-pay-schedule-modal');
            if($('#edit-pay-schedule-modal #custom-schedule').prop('checked')) {
                $('#edit-pay-schedule-modal #custom-schedule').trigger('change');
            }

            $('#edit-pay-schedule-modal [name="end_of_first_pay_period"]:checked, #edit-pay-schedule-modal [name="end_of_second_pay_period"]:checked').trigger('change');

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

            $(`#pay-schedule option:selected`).remove();
            $(`<option value="${result.id}" selected>${result.name}</option>`).insertAfter(prev);
            $('#pay-schedule').trigger('change');

            $('#edit-pay-schedule-modal').modal('hide');
        }
    });
});

$(document).on('change', '#pay-type', function() {
    switch($(this).val()) {
        case 'hourly' :
            $('.pay-fields').removeClass('hide');
            $('.salary-pay-fields').addClass('hide');
            $('.hourly-pay-fields').addClass('d-flex');
            $('.hourly-pay-fields').removeClass('hide');
            $($('.pay-fields div:first-child')[1]).addClass('col-sm-2');
            $($('.pay-fields div:first-child')[1]).html('Default hours:');
            $('#default-hours').val('');
            $('#days-per-week').val('');
        break;
        case 'salary' :
            $('.pay-fields').removeClass('hide');
            $('.hourly-pay-fields').addClass('hide');
            $('.hourly-pay-fields').removeClass('d-flex');
            $('.salary-pay-fields').removeClass('hide');
            $($('.pay-fields div:first-child')[1]).removeClass('col-sm-2');
            $($('.pay-fields div:first-child')[1]).html('This employee works');
            $('#default-hours').val('8.00');
            $('#days-per-week').val('5.00');
        break;
        case 'commission' :
            $('.pay-fields').addClass('hide');
        break;
    }
});

$(document).on('click', '#commission-only', function(e) {
    e.preventDefault();

    $.get('/accounting/employees/commission-only-payroll', function(res) {
        $('.append-modal').html(res);
        
        $('#commission-payroll-modal #payDate').datepicker({
            uiLibrary: 'bootstrap',
            todayBtn: "linked",
            language: "de"
        });
        $('#commission-payroll-modal #payFrom').select2();
        $('#commission-payroll-modal').modal('show');
    });
});

$(document).on('change', '#commission-payroll-modal #payroll-table input[name="commission[]"]', function() {
    convertToDecimal(this);

    $(this).parent().parent().find('span.total-pay').html($(this).val());
    commissionTotal();
});

function commissionTotal()
{
    var commission = 0.00;
    var totalPay = 0.00;
    $('#commission-payroll-modal #payroll-table tbody tr').each(function() {
        var empCommission = $(this).find('input[name="commission[]"]').val();

        if(empCommission !== "" && empCommission !== undefined) {
            empCommission = parseFloat(empCommission);
        } else {
            empCommission = 0.00;
        }

        commission = parseFloat(parseFloat(commission) + empCommission).toFixed(2);

        var empTotalPay = $(this).find('span.total-pay').html();

        if(empTotalPay !== "" && empTotalPay !== undefined) {
            empTotalPay = parseFloat(empTotalPay);
        } else {
            empTotalPay = 0.00;
        }

        totalPay = parseFloat(parseFloat(totalPay) + empTotalPay).toFixed(2);
    });

    $('#commission-payroll-modal #payroll-table tfoot tr td:nth-child(4)').html('$'+commission);
    $('#commission-payroll-modal #payroll-table tfoot tr td:last-child p').html('$'+totalPay);
    $('#commission-payroll-modal h2.total-pay').html('$'+totalPay);
}

$(document).on('click', 'div#commission-payroll-modal div.modal-footer button#preview-payroll', function() {
    payrollForm = $('div#commission-payroll-modal div.modal-body').html();
    payrollFormData = new FormData(document.getElementById($('div#commission-payroll-modal').parent('form').attr('id')));

    $.ajax({
        url: '/accounting/employees/generate-commission-payroll',
        data: payrollFormData,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            $('div#commission-payroll-modal div.modal-body').html(res);

            var chartHeight = $('div#commission-payroll-modal div.modal-body div#commissionPayrollChart').parent().prev().height();
            var chartWidth = $('div#commission-payroll-modal div.modal-body div#commissionPayrollChart').parent().width();

            $('div#commission-payroll-modal div#commissionPayrollChart').height(chartHeight);
            $('div#commission-payroll-modal div#commissionPayrollChart').width(chartWidth);

            var payrollCost = $('div#commission-payroll-modal div.modal-body h1 span#total-payroll-cost').html();
            var totalNetPay = $('div#commission-payroll-modal div.modal-body h4 span#total-net-pay').html();
            var employeeTax = $('div#commission-payroll-modal div.modal-body h4 span#total-employee-tax').html();
            var employerTax = $('div#commission-payroll-modal div.modal-body h4 span#total-employer-tax').html();

            var netPayPercent = parseFloat((parseFloat(totalNetPay) / parseFloat(payrollCost)) * 100).toFixed(2);
            var employeeTaxPercent = parseFloat((parseFloat(employeeTax) / parseFloat(payrollCost)) * 100).toFixed(2);
            var employerTaxPercent = parseFloat((parseFloat(employerTax) / parseFloat(payrollCost)) * 100).toFixed(2);

            var Data = [
                {label:"Net Pay",value:netPayPercent},
                {label:"Employee",value:employeeTaxPercent},
                {label:"Employer",value:employerTaxPercent}
            ];
            var total = 100;
            var donut_chart = Morris.Donut({
                element: 'commissionPayrollChart',
                data:Data,
                resize:true,
                formatter: function (value, data) {
                return Math.floor(value/total*100) + '%';
                }
            });
        }
    });

    $(this).parent().prepend('<button type="submit" class="btn btn-success">Submit Payroll</button>');
    $(this).remove();
    $('div#commission-payroll-modal div.modal-footer button#close-payroll-modal').parent().html('<button type="button" class="btn btn-secondary btn-rounded border" id="back-payroll-form">Back</button>');
});

$(document).on('click', 'div#commission-payroll-modal div.modal-footer button#back-payroll-form', function() {
    $('div#commission-payroll-modal div.modal-body').html(payrollForm);

    $('div#commission-payroll-modal div.modal-body select#payFrom').val(payrollFormData.get('pay_from'));
    $('div#commission-payroll-modal div.modal-body input#payDate').val(payrollFormData.get('pay_date'));

    $('div#commission-payroll-modal div.modal-body table tbody tr').each(function() {
        if($(this).children('td:nth-child(4)').children('input').length === 0) {
            $(this).children('td:first-child()').children('div').children('input').prop('checked', false)
        }
    });

    $('div#commission-payroll-modal div.modal-body table tbody tr td:nth-child(4) input[name="commission[]"]').each(function(index,value) {
        $(this).val(payrollFormData.getAll('commission[]')[index]);
    });

    $('div#commission-payroll-modal div.modal-body table tbody tr td:nth-child(5) input[name="memo[]"]').each(function(index,value) {
        $(this).val(payrollFormData.getAll('memo[]')[index]);
    });

    $(this).parent().html('<button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal" id="close-payroll-modal">Close</button>');
    $('div#commission-payroll-modal div.modal-footer button[type="submit"]').html('Preview Payroll');
    $('div#commission-payroll-modal div.modal-footer button[type="submit"]').attr('id', 'preview-payroll');
    $('div#commission-payroll-modal div.modal-footer button[type="submit"]').prop('type', 'button');
});

$(document).on('change', 'div#commission-payroll-modal table thead th input[name="select_all"]', function() {
    var table = $('div#commission-payroll-modal table');
    var rows = table.children('tbody').children('tr');

    if($(this).prop('checked')) {
        rows.each(function(){
            $(this).find('input[name="select[]"]').prop('checked', true);
            var id = $(this).find('input[name="select[]"]').val();

            $(this).children('td').each(function(index, value) {
                if(index === 2) {
                    var el = this;
                    $.get('/accounting/employees/get-employee-pay-details/'+id, function(res) {
                        var result = JSON.parse(res);
                        var payMethod = result.pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check';
                        $(el).html(payMethod);
                    });
                } else if(index === 3) {
                    $(this).html('<input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right">');
                } else if(index === 4) {
                    $(this).html('<input type="text" name="memo[]" class="form-control">');
                } else if(index === 5) {
                    $(this).html('<p class="text-right m-0">$<span class="total-pay">0.00</span></p>');
                }
            });
        });
    } else {
        rows.each(function(){
            $(this).children('td:first-child()').children('div').children('input').prop('checked', false);

            $(this).children('td').each(function(index, value) {
                if(index > 1) {
                    $(this).html('');
                }
            });
        });
    }
});

$(document).on('change', 'div#commission-payroll-modal table tbody tr td:first-child() input', function() {
    var table = $('div#commission-payroll-modal table');
    var checkbox = table.children('thead').children('tr').children('th:first-child()').children('div').children('input');
    var rows = table.children('tbody').children('tr');
    var flag = true;

    if($(this).prop('checked') === false) {
        $(this).parent().parent().parent().children('td').each(function(index, value) {
            if(index > 1) {
                $(this).html('');
            }
        });
    } else {
        var id = $(this).val();
        $(this).parent().parent().parent().children('td').each(function(index, value) {
            if(index === 2) {
                var el = this;
                $.get('/accounting/employees/get-employee-pay-details/'+id, function(res) {
                    var result = JSON.parse(res);
                    var payMethod = result.pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check';
                    $(el).html(payMethod);
                });
            } else if(index === 3) {
                $(this).html('<input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right employee-commission">');
            } else if(index === 4) {
                $(this).html('<input type="text" name="memo[]" class="form-control">');
            } else if(index === 5) {
                $(this).html('<p class="text-right m-0">$<span class="total-pay">0.00</span></p>');
            }
        });
    }

    rows.each(function() {
        if($(this).children('td:first-child()').children('div').children('input').prop('checked') === false) {
            flag = false;
        }
    });

    checkbox.prop('checked', flag);

    commissionTotal();
});

$(document).on('click', '#bonus-only', function(e) {
    e.preventDefault();

    $.get('/accounting/employees/bonus-only-payroll', function(res) {
        $('.append-modal').html(res);

        $('#bonus-payroll-modal').modal('show');
    });
});

$(document).on('change', '#bonus-payroll-modal [name="bonus_as"]', function() {
    $(this).parent().find('p').removeClass('hide');
    $('#bonus-payroll-modal [name="bonus_as"]:not(:checked)').parent().find('p').addClass('hide');
});

$(document).on('click', '#bonus-payroll-modal #continue-bonus-payroll',function(e) {
    e.preventDefault();

    bonusPayType = $('#bonus-payroll-modal [name="bonus_as"]:checked').val();
    bonusPayAsFields = $('#bonus-payroll-modal .modal-content').html();

    $.get('/accounting/employees/bonus-only-payroll-form/'+bonusPayType, function(res) {
        $('#bonus-payroll-modal .modal-content').html(res);
        $('#bonus-payroll-modal select').select2();
        $('#bonus-payroll-modal #payDate').datepicker({
            uiLibrary: 'bootstrap',
            todayBtn: "linked",
            language: "de"
        });
    });
});

$(document).on('click', '#bonus-payroll-modal #bonus-pay-select', function(e) {
    e.preventDefault();

    $('#bonus-payroll-modal .modal-content').html(bonusPayAsFields);
    $(`#bonus-payroll-modal [name="bonus_as"][value="${bonusPayType}"]`).prop('checked', true);
});

$(document).on('click', 'div#bonus-payroll-modal div.modal-footer button#preview-payroll', function() {
    payrollForm = $('div#bonus-payroll-modal div.modal-body').html();
    payrollFormData = new FormData(document.getElementById($('div#bonus-payroll-modal').parent('form').attr('id')));

    $.ajax({
        url: '/accounting/employees/generate-bonus-payroll/'+bonusPayType,
        data: payrollFormData,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            $('div#bonus-payroll-modal div.modal-body').html(res);

            var chartHeight = $('div#bonus-payroll-modal div.modal-body div#bonusPayrollChart').parent().prev().height();
            var chartWidth = $('div#bonus-payroll-modal div.modal-body div#bonusPayrollChart').parent().width();

            $('div#bonus-payroll-modal div#bonusPayrollChart').height(chartHeight);
            $('div#bonus-payroll-modal div#bonusPayrollChart').width(chartWidth);

            var payrollCost = $('div#bonus-payroll-modal div.modal-body h1 span#total-payroll-cost').html();
            var totalNetPay = $('div#bonus-payroll-modal div.modal-body h4 span#total-net-pay').html();
            var employeeTax = $('div#bonus-payroll-modal div.modal-body h4 span#total-employee-tax').html();
            var employerTax = $('div#bonus-payroll-modal div.modal-body h4 span#total-employer-tax').html();

            var netPayPercent = parseFloat((parseFloat(totalNetPay) / parseFloat(payrollCost)) * 100).toFixed(2);
            var employeeTaxPercent = parseFloat((parseFloat(employeeTax) / parseFloat(payrollCost)) * 100).toFixed(2);
            var employerTaxPercent = parseFloat((parseFloat(employerTax) / parseFloat(payrollCost)) * 100).toFixed(2);

            var Data = [
                {label:"Net Pay",value:netPayPercent},
                {label:"Employee",value:employeeTaxPercent},
                {label:"Employer",value:employerTaxPercent}
            ];
            var total = 100;
            var donut_chart = Morris.Donut({
                element: 'bonusPayrollChart',
                data:Data,
                resize:true,
                formatter: function (value, data) {
                return Math.floor(value/total*100) + '%';
                }
            });
        }
    });

    $(this).parent().prepend('<button type="submit" class="btn btn-success">Submit Payroll</button>');
    $(this).remove();
    $('div#bonus-payroll-modal div.modal-footer button#bonus-pay-select').parent().html('<button type="button" class="btn btn-secondary btn-rounded border" id="back-payroll-form">Back</button>');
});

$(document).on('change', '#bonus-payroll-modal #payroll-table input[name="bonus[]"]', function() {
    convertToDecimal(this);

    if(bonusPayType !== 'gross-pay') {
        computeGrossPay(this);
    } else {
        $(this).parent().parent().find('span.total-pay').html($(this).val());
    }

    bonusTotal();
});

function computeGrossPay(el)
{
    var bonus = parseFloat($(el).val()).toFixed(2);
    var socialSecurity = 6.7333333333333325;
    var medicare = 1.5333333333333334;

    var socialSecPay = parseFloat((bonus / 100) * socialSecurity);
    var medicarePay = parseFloat((bonus / 100) * medicare);

    socialSecPay = Math.round(socialSecPay * Math.pow(10, 2)) / Math.pow(10, 2);
    medicarePay = Math.round(medicarePay * Math.pow(10, 2)) / Math.pow(10, 2);

    var totalTax = parseFloat(socialSecPay + medicarePay).toFixed(2);

    var totalPay = parseFloat(bonus) + parseFloat(totalTax);

    $(el).parent().parent().find('.total-pay').html(totalPay);
}

function bonusTotal()
{
    var bonus = 0.00;
    var totalPay = 0.00;
    $('#bonus-payroll-modal #payroll-table tbody tr').each(function() {
        var empBonus = $(this).find('input[name="bonus[]"]').val();

        if(empBonus !== "" && empBonus !== undefined) {
            empBonus = parseFloat(empBonus);
        } else {
            empBonus = 0.00;
        }

        bonus = parseFloat(parseFloat(bonus) + empBonus).toFixed(2);

        var empTotalPay = $(this).find('span.total-pay').html();

        if(empTotalPay !== "" && empTotalPay !== undefined) {
            empTotalPay = parseFloat(empTotalPay);
        } else {
            empTotalPay = 0.00;
        }

        totalPay = parseFloat(parseFloat(totalPay) + empTotalPay).toFixed(2);
    });

    $('#bonus-payroll-modal #payroll-table tfoot tr td:nth-child(4)').html('$'+bonus);
    $('#bonus-payroll-modal #payroll-table tfoot tr td:last-child p').html('$'+totalPay);
    $('#bonus-payroll-modal h2.total-pay').html('$'+totalPay);
}

$(document).on('click', 'div#bonus-payroll-modal div.modal-footer button#back-payroll-form', function() {
    $('div#bonus-payroll-modal div.modal-body').html(payrollForm);

    $('div#bonus-payroll-modal div.modal-body select#payFrom').val(payrollFormData.get('pay_from'));
    $('div#bonus-payroll-modal div.modal-body input#payDate').val(payrollFormData.get('pay_date'));

    $('div#bonus-payroll-modal div.modal-body table tbody tr').each(function() {
        if($(this).children('td:nth-child(4)').children('input').length === 0) {
            $(this).children('td:first-child()').children('div').children('input').prop('checked', false)
        }
    });

    $('div#bonus-payroll-modal div.modal-body table tbody tr td:nth-child(4) input[name="bonus[]"]').each(function(index,value) {
        $(this).val(payrollFormData.getAll('bonus[]')[index]);
    });

    $('div#bonus-payroll-modal div.modal-body table tbody tr td:nth-child(5) input[name="memo[]"]').each(function(index,value) {
        $(this).val(payrollFormData.getAll('memo[]')[index]);
    });

    $(this).parent().html('<button type="button" class="btn btn-secondary btn-rounded border" id="bonus-pay-select">Back</button>');
    $('div#bonus-payroll-modal div.modal-footer button[type="submit"]').html('Preview Payroll');
    $('div#bonus-payroll-modal div.modal-footer button[type="submit"]').attr('id', 'preview-payroll');
    $('div#bonus-payroll-modal div.modal-footer button[type="submit"]').prop('type', 'button');
});

$(document).on('change', 'div#bonus-payroll-modal table thead th input[name="select_all"]', function() {
    var table = $('div#bonus-payroll-modal table');
    var rows = table.children('tbody').children('tr');

    if($(this).prop('checked')) {
        rows.each(function(){
            $(this).find('input[name="select[]"]').prop('checked', true);
            var id = $(this).find('input[name="select[]"]').val();

            $(this).children('td').each(function(index, value) {
                if(index === 2) {
                    var el = this;
                    $.get('/accounting/employees/get-employee-pay-details/'+id, function(res) {
                        var result = JSON.parse(res);
                        var payMethod = result.pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check';
                        $(el).html(payMethod);
                    });
                } else if(index === 3) {
                    $(this).html('<input type="number" name="bonus[]" step="0.01" class="form-control w-75 float-right text-right">');
                } else if(index === 4) {
                    $(this).html('<input type="text" name="memo[]" class="form-control">');
                } else if(index === 5) {
                    $(this).html('<p class="text-right m-0">$<span class="total-pay">0.00</span></p>');
                }
            });
        });
    } else {
        rows.each(function(){
            $(this).children('td:first-child()').children('div').children('input').prop('checked', false);

            $(this).children('td').each(function(index, value) {
                if(index > 1) {
                    $(this).html('');
                }
            });
        });
    }
});

$(document).on('change', 'div#bonus-payroll-modal table tbody tr td:first-child() input', function() {
    var table = $('div#bonus-payroll-modal table');
    var checkbox = table.children('thead').children('tr').children('th:first-child()').children('div').children('input');
    var rows = table.children('tbody').children('tr');
    var flag = true;

    if($(this).prop('checked') === false) {
        $(this).parent().parent().parent().children('td').each(function(index, value) {
            if(index > 1) {
                $(this).html('');
            }
        });
    } else {
        var id = $(this).val();
        $(this).parent().parent().parent().children('td').each(function(index, value) {
            if(index === 2) {
                var el = this;
                $.get('/accounting/employees/get-employee-pay-details/'+id, function(res) {
                    var result = JSON.parse(res);
                    var payMethod = result.pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check';
                    $(el).html(payMethod);
                });
            } else if(index === 3) {
                $(this).html('<input type="number" name="bonus[]" step="0.01" class="form-control w-75 float-right text-right">');
            } else if(index === 4) {
                $(this).html('<input type="text" name="memo[]" class="form-control">');
            } else if(index === 5) {
                $(this).html('<p class="text-right m-0">$<span class="total-pay">0.00</span></p>');
            }
        });
    }

    rows.each(function() {
        if($(this).children('td:first-child()').children('div').children('input').prop('checked') === false) {
            flag = false;
        }
    });

    checkbox.prop('checked', flag);

    bonusTotal();
});