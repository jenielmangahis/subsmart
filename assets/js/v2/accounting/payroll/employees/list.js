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
        $('#add-pay-schedule-modal').modal('show');
    } else {
        $.get('/accounting/employees/get-pay-date/'+el.val(), function(res) {
            var result = JSON.parse(res);

            el.parent().next().children('span').html(result.date);
            el.parent().next().removeClass('hide');
        });
    }
});