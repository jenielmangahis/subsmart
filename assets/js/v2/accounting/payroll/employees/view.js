const currUrl = window.location.href;
const urlSplit = currUrl.includes('?') ? currUrl.split('?')[0].split('/') : currUrl.split('/');
const employeeId = urlSplit[urlSplit.length - 1].replace('#', '');

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

$('#change_status_modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#change_status_modal')
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