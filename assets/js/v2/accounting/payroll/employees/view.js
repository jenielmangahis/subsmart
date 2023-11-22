const currUrl = window.location.href;
const urlSplit = currUrl.includes('?') ? currUrl.split('?')[0].split('/') : currUrl.split('/');
const employeeId = urlSplit[urlSplit.length - 1].replace('#', '');

CKEDITOR.replace('notes');

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

$('.edit-emp-payscale').change(function() {
    var psid = $(this).val();
    var url  = base_url + 'payscale/_get_details'
    $.ajax({
        type: 'POST',
        url: url,
        data: {psid:psid},
        dataType: "json",
        success: function(result) {
            if( result.pay_type == 'Commission Only' ){
                $('.edit-pay-type-container').hide();
            }else{
                var rate_label = result.pay_type + ' Rate';
                $('.edit-pay-type-container').show();
                $('.edit-payscale-pay-type').html(rate_label);
            }                
        },
    });
});

$(document).on('click', '.btn-edit-add-new-commision', function(e){
    let url = base_url + "user/_add_commission_form";
    $.ajax({
        type: 'POST',
        url: url,
        success: function(o) {
            $("#edit-commission-settings tbody").append(o).children(':last').hide().fadeIn(400);
            $("#edit-commission-settings tbody tr:last-child select").each(function() {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $("#edit-pay-types-modal")
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

$('#user-profile-photo').on('change', function() {
    var data = new FormData();

    data.append('userfile', $(this)[0].files[0]);

    $.ajax({
        url: `/accounting/employees/update-profile-photo/${employeeId}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            Swal.fire({
                title: res.success ? 'Success' : 'Error',
                html: res.message,
                icon: res.success ? 'success' : 'error',
                showCloseButton: false,
                showCancelButton: false,
                confirmButtonColor: '#2ca01c',
                confirmButtonText: 'Okay'
            }).then((result) => {
                if(result.isConfirmed) {
                    location.reload();
                }
            });
        }
    });
});

$('#remove-photo').on('click', function() {
    Swal.fire({
        title: 'Are you sure you want remove the profile photo?',
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: `/accounting/employees/remove-profile-photo/${employeeId}`,
                type: 'DELETE',
                success: function(res) {
                    var result = JSON.parse(res);

                    Swal.fire({
                        title: result.success ? 'Success' : 'Error',
                        html: result.message,
                        icon: result.success ? 'success' : 'error',
                        showCloseButton: false,
                        showCancelButton: false,
                        confirmButtonColor: '#2ca01c',
                        confirmButtonText: 'Done'
                    }).then((r) => {
                        if(r.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            });
        }
    });
});

$('#filter-date-range').select2({
    minimumResultsForSearch: -1
});

$('#filter-date-range').on('change', function(e) {
    var dates = get_start_and_end_dates($(this).val());

    $('#filter-from-date').val(dates.start_date);
    $('#filter-to-date').val(dates.end_date);
});

$('#filter-from-date, #filter-to-date').on('change', function(e) {
    $('#filter-date-range').val('custom').trigger('change');
});

$('#apply-button').on('click', function(e) {
    e.preventDefault();

    var filterDate = $('#filter-date-range').val();
    var url = `${base_url}accounting/employees/view/${employeeId}?`;

    url += filterDate !== 'this-quarter' ? `date=${filterDate}&` : '';
    url += filterDate !== 'this-quarter' ? `from=${$('#filter-from-date').val().replaceAll('/', '-')}&to=${$('#filter-to-date').val().replaceAll('/', '-')}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});

$('#transactions-table .select-all').on('change', function() {
    $('#transactions-table .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$('#transactions-table .select-one').on('change', function() {
    $('#transactions-table .select-all').prop('checked', $('#transactions-table .select-one:checked').length === $('#transactions-table .select-one').length);

    if($('#transactions-table .select-one:checked').length > 0) {
        $('.print-paychecks-button').attr('id', 'print-paychecks');
        $('.print-paychecks-button').prop('disabled', false);
    } else {
        $('.print-paychecks-button').removeAttr('id');
        $('.print-paychecks-button').prop('disabled', true);
    }
});

$(document).on('click', '#print-paychecks', function(e) {
    e.preventDefault();

    if($('#print-paycheck-form').length < 1) {
        $('body').append(`<form action="/accounting/print-multiple" method="post" id="print-paycheck-form" target="_blank"></form>`);
    }

    $('#transactions-table .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var id = row.find('.select-one').val();

        $('#print-paycheck-form').append(`<input type="hidden" name="paycheck_id[]" value="${id}">`);
    });

    $('#print-paycheck-form').submit();
    $('#print-paycheck-form').remove();
});

$('#transactions-table [name="check_number[]"]').on('change', function() {
    var checkNum = $(this).val();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = new FormData();
    data.set('check_number', checkNum);

    $.ajax({
        url: `/accounting/update-paycheck-num/${id}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            
        }
    });
});

$('#transactions-table .print-paycheck').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    if($('#print-paycheck-form').length < 1) {
        $('body').append(`<form action="/accounting/print-paycheck" method="post" id="print-paycheck-form" target="_blank"></form>`);
    }

    $('#print-paycheck-form').append(`<input type="hidden" name="paycheck_id" value="${id}">`);

    $('#print-paycheck-form').submit();
    $('#print-paycheck-form').remove();
});

$('#transactions-table .delete-paycheck').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    $.get(`/accounting/delete-paycheck/${id}`, function(res) {
        var result = JSON.parse(res);
        Swal.fire({
            title: result.success ? 'Delete Successful!' : 'Failed!',
            text: result.success ? 'Paycheck has been successfully deleted.' : 'Something is wrong in the process.',
            icon: result.success ? 'success' : 'error',
            showCancelButton: false,
            confirmButtonText: 'Okay'
        }).then((r) => {
            if(r.value) {
                if(result.success) {
                    location.reload();
                }
            }
        });
    });
});

$('#transactions-table .void-paycheck').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    $.get(`/accounting/void-paycheck/${id}`, function(res) {
        var result = JSON.parse(res);
        Swal.fire({
            title: result.success ? 'Void Successful!' : 'Failed!',
            text: result.success ? 'Paycheck has been successfully voided.' : 'Something is wrong in the process.',
            icon: result.success ? 'success' : 'error',
            showCancelButton: false,
            confirmButtonText: 'Okay'
        }).then((r) => {
            if(r.value) {
                if(result.success) {
                    location.reload();
                }
            }
        });
    });
});

function get_start_and_end_dates(val)
{
    switch(val) {
        case 'custom' :
            startDate = $(`#filter-from-date`).val();
            endDate = $(`#filter-to-date`).val();
        break;
        case 'this-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            startDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            
            switch(currQuarter) {
                case 1 :
                    startDate = '01/01/' + date.getFullYear();
                    endDate = '03/31/'+ date.getFullYear();
                break;
                case 2 :
                    startDate = '04/01/' + date.getFullYear();
                    endDate = '06/30/'+ date.getFullYear();
                break;
                case 3 :
                    startDate = '07/01/' + date.getFullYear();
                    endDate = '09/30/'+ date.getFullYear();
                break;
                case 4 :
                    startDate = '10/01/' + date.getFullYear();
                    endDate = '12/31/'+ date.getFullYear();
                break;
            }
        break;
        case 'this-year' :
            var date = new Date();

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'last-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            startDate = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            
            switch(currQuarter) {
                case 1 :
                    var from_date = new Date('01/01/' + date.getFullYear());
                    var to_date = new Date('03/31/'+ date.getFullYear());
                break;
                case 2 :
                    var from_date = new Date('04/01/' + date.getFullYear());
                    var to_date = new Date('06/30/'+ date.getFullYear());
                break;
                case 3 :
                    var from_date = new Date('07/01/' + date.getFullYear());
                    var to_date = new Date('09/30/'+ date.getFullYear());
                break;
                case 4 :
                    var from_date = new Date('10/01/' + date.getFullYear());
                    var to_date = new Date('12/31/'+ date.getFullYear());
                break;
            }

            from_date.setMonth(from_date.getMonth() - 3);
            to_date.setMonth(to_date.getMonth() - 3);

            if(to_date.getDate() === 1) {
                to_date.setDate(to_date.getDate() - 1);
            }

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-year' :
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'first-quarter' :
            var date = new Date();

            startDate = '01/01/' + date.getFullYear();
            endDate = '03/31/'+ date.getFullYear();
        break;
        case 'second-quarter' :
            var date = new Date();

            startDate = '04/01/' + date.getFullYear();
            endDate = '06/30/'+ date.getFullYear();
        break;
        case 'third-quarter' :
            var date = new Date();

            startDate = '07/01/' + date.getFullYear();
            endDate = '09/30/'+ date.getFullYear();
        break;
        case 'fourth-quarter' :
            var date = new Date();

            startDate = '10/01/' + date.getFullYear();
            endDate = '12/31/'+ date.getFullYear();
        break;
    }

    return {
        start_date : startDate,
        end_date : endDate
    };
}
