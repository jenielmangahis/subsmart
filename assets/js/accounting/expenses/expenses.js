$('select').select2();

$('.datepicker').each(function() {
    $(this).datepicker({
        uiLibrary: 'bootstrap',
        todayBtn: "linked",
        language: "de"
    });
});

$('.dropdown-menu[aria-labelledby="filterDropdown"]').on('click', function(e) {
    e.stopPropagation();
});

var table = $('#transactions-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: $('#table_rows').val(),
    order: [[1, 'asc']],
    ajax: {
        url: 'expenses/load-transactions/',
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.length = $('#table_rows').val();
            d.type = $('select#type').val();
            d.status = $('select#status').val();
            d.delivery_method = $('select#del-method').val();
            d.date = $('select#date').val();
            d.from_date = $('input#from-date').val();
            d.to_date = $('input#to-date').val();
            d.payee = $('select#payee').val();
            d.category = $('select#category').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: [
        {
            orderable: false,
			data: null,
			name: 'checkbox',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`
                <div class="d-flex justify-content-center">
                    <input type="checkbox" value="${rowData.id}">
                </div>
                `);
			}
		},
        {
            data: 'date',
            name: 'date'
        },
        {
            data: 'type',
            name: 'type'
        },
        {
            data: 'number',
            name: 'number'
        },
        {
            data: 'payee',
            name: 'payee'
        },
        {
            data: 'method',
            name: 'method'
        },
        {
            data: 'source',
            name: 'source'
        },
        {
            data: 'category',
            name: 'category',
            fnCreatedCell: function(td, cellData, rowData,row, col) {
                $(td).html(cellData);

                if($(td).find('select').length > 0) {
                    $(td).find('select').select2();
                }
            }
        },
        {
            data: 'memo',
            name: 'memo'
        },
        {
            data: 'due_date',
            name: 'due_date'
        },
        {
            data: 'balance',
            name: 'balance'
        },
        {
            data: 'total',
            name: 'total'
        },
        {
            data: 'status',
            name: 'status'
        },
        {
            orderable: false,
            data: 'attachments',
            name: 'attachments'
        },
        {
            orderable: false,
			data: null,
			name: 'action',
			fnCreatedCell: function(td, cellData, rowData,row, col) {
                $(td).html('');
            }
        }
    ]
});

$(document).on('change', '#type', function() {
    switch($(this).val()) {
        case 'expenses' :
            $('#del-method').parent().hide();
            $('#status').next().remove();
            $('#status').children('option:not([value="all"])').remove();
            $('#status').select2();
            $('#status').parent().show();
            $('#date').parent().show();
            $('#from-date').parent().parent().show();
            $('#to-date').parent().parent().show();
        break;
        case 'check' :
            $('#status').next().remove();
            $('#status').children('option:not([value="all"])').remove();
            $('#status').select2();
            $('#status').parent().show();
            $('#date').parent().show();
            $('#from-date').parent().parent().show();
            $('#to-date').parent().parent().show();
        break;
        case 'bill' :
            $('#del-method').parent().hide();
            if($('#status option').length < 4) {
                $('#status').next().remove();
                $('#status').children('option:not([value="all"])').remove();
                $('#status').append('<option value="open">Open</option>');
                $('#status').append('<option value="overdue">Overdue</option>');
                $('#status').append('<option value="paid">Paid</option>');
                $('#status').select2();
            }
            $('#status').parent().show();
            $('#date').parent().show();
            $('#from-date').parent().parent().show();
            $('#to-date').parent().parent().show();
        break;
        case 'bill-payments' :
            $('#del-method').parent().hide();
            $('#status').parent().hide();
            $('#category').parent().hide();
            $('#date').parent().show();
            $('#from-date').parent().parent().show();
            $('#to-date').parent().parent().show();
        break;
        case 'purchase-order' :
            $('#del-method').parent().hide();
            $('#status').next().remove();
            $('#status').children('option:not([value="all"])').remove();
            $('#status').append('<option value="open">Open</option>');
            $('#status').append('<option value="closed">Closed</option>');
            $('#status').select2();
            $('#status').parent().show();
            $('#date').parent().show();
            $('#from-date').parent().parent().show();
            $('#to-date').parent().parent().show();
        break;
        case 'recently-paid' :
            $('#del-method').parent().hide();
            $('#status').parent().hide();
            $('#category').parent().hide();
            $('#date').parent().hide();
            $('#from-date').parent().parent().hide();
            $('#to-date').parent().parent().hide();
        break;
        case 'vendor-credit' :
            $('#del-method').parent().hide();
            $('#status').parent().hide();
            $('#category').parent().hide();
        break;
        case 'credit-card-payment' :
            $('#del-method').parent().hide();
            $('#status').next().remove();
            $('#status').children('option:not([value="all"])').remove();
            $('#status').select2();
            $('#category').parent().hide();
        break;
        default :
            $('#del-method').parent().show();
            $('#status').next().remove();
            $('#status').children('option:not([value="all"])').remove();
            $('#status').append('<option value="open">Open</option>');
            $('#status').append('<option value="overdue">Overdue</option>');
            $('#status').append('<option value="paid">Paid</option>');
            $('#status').select2();
            $('#status').parent().show();
            $('#date').parent().show();
            $('#from-date').parent().parent().show();
            $('#to-date').parent().parent().show();
            $('#category').parent().show();
        break;
    }
});

$(document).on('change', '#status', function() {
    if($('#type').val() === 'all') {
        $('#type').val('bill').trigger('change');
    }
});

$('#from-date, #to-date').on('change', function() {
    $('#date').val('custom').trigger('change');
});

function resetbtn()
{
    $('#status').val('all').trigger('change');
    $('#type').val('all').trigger('change');
    $('#del-method').val('any').trigger('change');
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    $('#from-date').val(today);
    $('#to-date').val('');
    $('#date').val('last-365-days').trigger('change');
    $('#payee').val('all').trigger('change');
    $('#category').val('all').trigger('change');

    applybtn();
}

function applybtn()
{
    table.ajax.reload();
}