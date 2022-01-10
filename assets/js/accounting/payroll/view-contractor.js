const contractorId = $('#contractor-id').val();
const contractorName = $('.contractor-details-container h4').html().replace(' (deleted)', '').trim();
$('.banking-tab-container a').on('click', function() {
    var activeTab = $(this).parent().find('.banking-tab-active');
    activeTab.removeClass('text-decoration-none');
    activeTab.removeClass('banking-tab-active');
    activeTab.removeClass('active');
    activeTab.addClass('banking-tab');
    $(this).removeClass('banking-tab');
    $(this).addClass('banking-tab-active');
    $(this).addClass('text-decoration-none');
});

$('#myTabContent #details .card').on('click', function() {
    $('#personal-details-modal').modal('show');
});

$('#personal-details-modal [name="contractor_type"]').on('change', function() {
    if($(this).val() !== "") {
        if($(this).val() === '1') {
            $('#personal-details-modal .individual-type-field').removeClass('hide');
            $('#personal-details-modal .business-type-field').addClass('hide');

            $('#personal-details-modal .individual-type-field #first_name').prop('required', true);
            $('#personal-details-modal .individual-type-field #last_name').prop('required', true);
            $('#personal-details-modal .individual-type-field #social_sec_num').prop('required', true);

            $('#personal-details-modal .business-type-field #social_sec_num').prop('required', false);
            $('#personal-details-modal .business-type-field #emp_id_num').prop('required', false);
        } else {
            $('#personal-details-modal .business-type-field').removeClass('hide');
            $('#personal-details-modal .individual-type-field').addClass('hide');

            $('#personal-details-modal .individual-type-field #first_name').prop('required', false);
            $('#personal-details-modal .individual-type-field #last_name').prop('required', false);
            $('#personal-details-modal .individual-type-field #social_sec_num').prop('required', false);

            $('#personal-details-modal .business-type-field #social_sec_num').prop('required', true);
            $('#personal-details-modal .business-type-field #emp_id_num').prop('required', true);
        }
        
        $('#personal-details-modal .default-field').removeClass('hide');
    } else {
        $('#personal-details-modal .individual-type-field').addClass('hide');
        $('#personal-details-modal .business-type-field').addClass('hide');
        $('#personal-details-modal .default-field').addClass('hide');

        $('#personal-details-modal .individual-type-field #first_name').prop('required', false);
        $('#personal-details-modal .individual-type-field #last_name').prop('required', false);
        $('#personal-details-modal .individual-type-field #social_sec_num').prop('required', false);

        $('#personal-details-modal .business-type-field #social_sec_num').prop('required', false);
        $('#personal-details-modal .business-type-field #emp_id_num').prop('required', false);
    }
});

function formatSocialSecurity(val){
	val = val.replace(/\D/g, '');
	val = val.replace(/^(\d{3})/, '$1-');
	val = val.replace(/-(\d{2})/, '-$1-');
	val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
	return val;
}

$('#social_sec_num').on('keyup', function() {
    $(this).val(formatSocialSecurity($(this).val()));
});

$('#personal-details-modal select').select2();

$('#payments.tab-pane select').select2({
    minimumResultsForSearch: -1
});

$('#date, #type, #payment-method').on('change', function() {
    $('#contractor-payments-table').DataTable().ajax.reload();

    var data = new FormData();
    data.append('date', $('#date').val());
    data.append('type', $('#type').val());
    data.append('payment_method', $('#payment-method').val());

    $.ajax({
        url: `/accounting/contractors/${$('#contractor-id').val()}/get-payments-total`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);

            $('h6 span.payments-count').html(result.payments_count);
            $('h6 span.payments-total').html(result.payments_total);
        }
    });
});

$('#contractor-payments-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: 50,
    ordering: false,
    ajax: {
        url: `/accounting/contractors/${$('#contractor-id').val()}/load-payments`,
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.date = $('#date').val();
            d.type = $('#type').val();
            d.payment_method = $('#payment-method').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: [
        {
            name: 'date',
            data: 'date'
        },
        {
            name: 'type',
            data: 'type'
        },
        {
            name: 'payment_method',
            data: 'payment_method'
        },
        {
            name: 'amount',
            data: 'amount'
        }
    ]
});

$(document).on('click', '#write-check-button', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/check_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#checkModal #payee').append(`<option value="vendor-${contractorId}">${contractorName}</option>`);

        initModalFields('checkModal');

        $('#checkModal').modal('show');
    });
});

$(document).on('click', '#create-expense-button', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/expense_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#expenseModal #payee').append(`<option value="vendor-${contractorId}">${contractorName}</option>`);

        initModalFields('expenseModal');

        $('#expenseModal').modal('show');
    });
});

$(document).on('click', '#create-bill-button', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/bill_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal #vendor').append(`<option value="${contractorId}">${contractorName}</option>`);

        initModalFields('billModal');

        $('#billModal').modal('show');
    });
});