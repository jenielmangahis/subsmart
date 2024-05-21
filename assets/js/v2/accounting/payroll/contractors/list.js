$('#status-filter li a.dropdown-item').on('click', function(e) {
    e.preventDefault();
    var search = $('#search_field').val();

    var status = $(this).attr('id');

    var url = `${base_url}accounting/contractors?`;

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

$('#contractors-table .write-check').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    
    $.get(base_url + 'accounting/get-other-modals/check_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#checkModal #payee').append(`<option value="vendor-${row.data().id}">${row.data().name}</option>`);

        initModalFields('checkModal');

        $('#checkModal').modal('show');
    });
});

$('#contractors-table .create-expense').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get(base_url + 'accounting/get-other-modals/expense_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#expenseModal #payee').append(`<option value="vendor-${row.data().id}">${row.data().name}</option>`);

        initModalFields('expenseModal');

        $('#expenseModal').modal('show');
    });
});

$('#contractors-table .create-bill').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get(base_url + 'accounting/get-other-modals/bill_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal #vendor').append(`<option value="${row.data().id}">${row.data().name}</option>`);

        initModalFields('billModal');

        $('#billModal').modal('show');
    });
});

$('#contractor-modal form').validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        name: 'required',
    }
});

$(".edit-contractor").on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().id;

    $.get(base_url + `accounting/get-vendor-details/${id}`, function(res) {
        var vendor = JSON.parse(res);

        $('#contractor-modal #name').val(vendor.display_name);
        $('#contractor-modal #email').val(vendor.email);

        $('#contractor-modal form').attr('action', `/accounting/contractors/${id}/update`);
        $('#contractor-modal').modal('show');
    });
});

$('#contractor-modal').on('hidden.bs.modal', function() {
    $('#contractor-modal form').attr('action', `/accounting/contractors/add`);
    $('#contractor-modal #name').val('');
    $('#contractor-modal #email').val('');
});

$('.delete-contractor').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().id;

    Swal.fire({
        title: 'Are you sure you want to make this contractor inactive?',
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            location.href= base_url+`/accounting/contractors/set-status/${id}/inactive`;
        }
    });
});

initializeFields();

$(document).on('click', '#pay-contractors-modal #contractors-list-table tbody tr:not(.clickable) a[data-bs-toggle="collapse"]', function(e) {
    var row = $(this).closest('tr');
    row.find('input.select-one').prop('checked', true).trigger('change');
});

$(document).on('hide.bs.collapse', '#pay-contractors-modal #contractors-list-table tbody tr.collapse', function() {
    $(this).prev().find('a[data-bs-toggle="collapse"]').html('<i class="bx bx-fw bx-chevron-right"></i>');
});

$(document).on('show.bs.collapse', '#pay-contractors-modal #contractors-list-table tbody tr.collapse', function() {
    $(this).prev().find('a[data-bs-toggle="collapse"]').html('<i class="bx bx-fw bx-chevron-down"></i>');
});

$(document).on('change', '#pay-contractors-modal #contractors-list-table tbody input.select-one', function() {
    var row = $(this).closest('tr');
    var fieldsRow = row.next();

    if($(this).prop('checked')) {
        var amount = parseFloat(fieldsRow.find('[name="amount[]"]').val() !== '' ? fieldsRow.find('[name="amount[]"]').val() : 0.00);

        fieldsRow.collapse('show');
        row.find('a[data-bs-toggle="collapse"]').html('<i class="bx bx-fw bx-chevron-down"></i>');
    } else {
        var amount = 0.00;

        fieldsRow.collapse('hide');
        row.find('a[data-bs-toggle="collapse"]').html('<i class="bx bx-fw bx-chevron-right"></i>');
    }

    row.find('td:nth-child(6), td:last-child').html(formatter.format(amount));
    computePaymentTotal();

    var checked = $('#pay-contractors-modal #contractors-list-table input.select-one:checked').length;
    var checkboxes = $('#pay-contractors-modal #contractors-list-table input.select-one').length;

    $('#pay-contractors-modal #contractors-list-table thead input.select-all').prop('checked', checked === checkboxes);
});

$(document).on('change', '#pay-contractors-modal #contractors-list-table thead input.select-all', function() {
    $('#pay-contractors-modal #contractors-list-table input.select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$(document).on('change', '#pay-contractors-modal #contractors-list-table tbody [name="amount[]"]', function() {
    var fieldsRow = $(this).closest('tr');
    var row = fieldsRow.prev();
    var checkbox = row.find('input.select-one')

    if(checkbox.prop('checked')) {
        var amount = parseFloat($(this).val() !== '' ? $(this).val() : 0.00);
    } else {
        var amount = 0.00;   
    }

    row.find('td:nth-child(6), td:last-child').html(formatter.format(amount));
    computePaymentTotal();
});

var data = new FormData();
var contractorPaymentForm = '';
$(document).on('click', '#pay-contractors-modal #preview-contractor-payment', function(e) {
    e.preventDefault();
    contractorPaymentForm = $('#pay-contractors-modal .modal-body').html();
    var button = $(this);

    data.append('corresponding_account', $('#pay-contractors-modal #corresponding-account').val());
    data.append('pay_date', $('#pay-contractors-modal #pay-date').val());
    
    $('#pay-contractors-modal #contractors-list-table .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var fieldsRow = row.next();
        data.append('contractor[]', $(this).val());

        data.append('check_number[]', fieldsRow.find('input[name="check_number[]"]').val());
        data.append('account[]', fieldsRow.find('select[name="account[]"]').val());
        data.append('description[]', fieldsRow.find('input[name="description[]"]').val());
        data.append('customer[]', fieldsRow.find('select[name="customer[]"]').val());
        data.append('amount[]', fieldsRow.find('input[name="amount[]"]').val());
        data.append('total_fixed_pay[]', row.find('td:nth-child(6)').html().replace('$', ''));
        data.append('total_pay[]', row.find('td:last-child').html().replace('$', ''));
    });

    data.append('total_amount', $('#pay-contractors-modal .transaction-total-amount').html().replace('$', ''));

    $.ajax({
        url: '/accounting/contractors/preview-contractor-payment',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            $('#pay-contractors-modal .modal-body').html(result);

            button.parent().prev().html('<button type="button" class="nsm-button primary" id="back-to-contractor-payment-form">Back</button>');
            button.parent().html('<button type="button" class="nsm-button success" id="submit-payment">Submit</button>');
        }
    });
});

$(document).on('click', '#pay-contractors-modal #back-to-contractor-payment-form', function(e) {
    e.preventDefault();

    var button = $(this);

    $('#pay-contractors-modal .modal-body').html(contractorPaymentForm);
    $('#pay-contractors-modal .modal-body select').next().remove();

    var selectedContractors = data.getAll('contractor[]');
    var checkNumber = data.getAll('check_number[]');
    var description = data.getAll('description[]');
    var amount = data.getAll('amount[]');
    for(i = 0; i < selectedContractors.length; i++)
    {
        $(`#pay-contractors-modal #contractors-list-table .select-one[value="${selectedContractors[i]}"]`).prop('checked', true);
        $(`#pay-contractors-modal #contractors-list-table .select-one[value="${selectedContractors[i]}"]`).closest('tr').next().find('[name="check_number[]"]').val(checkNumber[i]);
        $(`#pay-contractors-modal #contractors-list-table .select-one[value="${selectedContractors[i]}"]`).closest('tr').next().find('[name="description[]"]').val(description[i]);
        $(`#pay-contractors-modal #contractors-list-table .select-one[value="${selectedContractors[i]}"]`).closest('tr').next().find('[name="amount[]"]').val(amount[i]);
    }

    initializeFields();

    button.parent().next().html('<button type="button" class="nsm-button success" id="preview-contractor-payment">Preview</button>');
    button.parent().html('<button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>');
});

$(document).on('click', '#pay-contractors-modal #submit-payment', function(e) {
    e.preventDefault();

    $.ajax({
        url: '/accounting/contractors/submit-contractor-payment',
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

$(document).on('change', '#pay-contractors-modal #corresponding-account', function() {
    dropdownEl = $(this);
    if($(this).val() === 'add-new') {
        $.get(`/accounting/get-dropdown-modal/account_modal?modal=pay-contractors&field=corresponding-account`, function(result) {
            if($('#modal-container').length > 0) {
                $('#modal-container').html(result);
            } else {
                $('body').append(`<div id="modal-container">${result}</div>`);
            }

            initAccountModal();
        });
    }
});

function computePaymentTotal() {
    var total = 0.00;
    $('#pay-contractors-modal #contractors-list-table .select-one:checked').each(function() {
        var row = $(this).closest('tr');

        total += parseFloat(row.find('td:last-child').html().replace('$', ''));
    });

    $('#pay-contractors-modal .transaction-total-amount, #pay-contractors-modal #contractors-list-table tfoot tr td:last-child').html(formatter.format(total));
}

function initializeFields() {
    $('#pay-contractors-modal #corresponding-account').select2({
        ajax: {
            url: base_url + 'accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'bank-account', //checking-savings-account
                    modal: 'pay-contractors-modal'
                }
    
                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect,
        dropdownParent: $('#pay-contractors-modal')
    });
    
    $('#pay-contractors-modal [name="customer[]"]').select2({
        ajax: {
            url: base_url + 'accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'customer',
                    modal: 'pay-contractors-modal'
                }
    
                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect,
        dropdownParent: $('#pay-contractors-modal')
    });
    
    $('#pay-contractors-modal [name="account[]"]').select2({
        ajax: {
            url: base_url + 'accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'account',
                    modal: 'pay-contractors-modal'
                }
    
                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect,
        dropdownParent: $('#pay-contractors-modal')
    });

    $('#pay-contractors-modal #pay-date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
}
