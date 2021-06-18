$('select:not(#category-id)').select2();

$('#category-id').select2({
    dropdownParent: $('#select_category_modal')
});

$('.datepicker').each(function() {
    $(this).datepicker({
        uiLibrary: 'bootstrap',
        todayBtn: "linked",
        language: "de"
    });
});

$('.dropdown-menu').on('click', function(e) {
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
    order: [[1, 'desc']],
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
            name: 'type',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('type');

                if($('#trans_type').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            data: 'number',
            name: 'number',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('number');

                if($('#trans_number').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            data: 'payee',
            name: 'payee',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('payee');

                if($('#trans_payee').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            data: 'method',
            name: 'method',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('method');

                if($('#trans_method').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            data: 'source',
            name: 'source',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('source');

                if($('#trans_source').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            data: 'category',
            name: 'category',
            fnCreatedCell: function(td, cellData, rowData,row, col) {
                $(td).html(cellData);

                if($(td).find('select').length > 0) {
                    $(td).find('select').select2();
                }
                
                $(td).addClass('category');

                if($('#trans_category').prop('checked') === false) {
					$(td).hide();
				}
            }
        },
        {
            data: 'memo',
            name: 'memo',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('memo');

                if($('#trans_memo').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            data: 'due_date',
            name: 'due_date',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('due_date');

                if($('#trans_due_date').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            data: 'balance',
            name: 'balance',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('balance');

                if($('#trans_balance').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            data: 'total',
            name: 'total'
        },
        {
            data: 'status',
            name: 'status',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('status');

                if($('#trans_status').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            orderable: false,
            data: 'attachments',
            name: 'attachments',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('attachments');

                if($('#trans_attachments').prop('checked') === false) {
					$(td).hide();
				}
			}
        },
        {
            orderable: false,
			data: null,
			name: 'action',
			fnCreatedCell: function(td, cellData, rowData,row, col) {
                switch (rowData.type) {
                    case 'Expense' :
                        if(rowData.status === 'Voided') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="/accounting/expenses/print-transaction/expense/${rowData.id}" target="_blank">Print</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="/accounting/expenses/print-transaction/expense/${rowData.id}" target="_blank">Print</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Void</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Check' :
                        if(rowData.status === 'Voided') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Void</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Bill' :
                        if(rowData.status === 'Open') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Schedule payment
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">Mark as paid</a>
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Attach a file</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    View/Edit
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Attach a file</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Bill Payment (Check)' :
                        if(rowData.status === 'Voided') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Void</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Bill Payment (Credit Card)' :
                        if(rowData.status === 'Voided') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Void</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Credit Card Payment' :
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Void</a>
                            </div>
                        </div>
                        `);
                    break;
                    case 'Purchase Order' : 
                        if(rowData.status === 'Open') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Send
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">Copy to bill</a>
                                    <a class="dropdown-item" href="/accounting/expenses/print-transaction/purchase-order/${rowData.id}" target="_blank">Print</a>
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Attach a file</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <a class="btn d-flex align-items-center justify-content-center text-info" href="/accounting/vendors/print-transaction/purchase-order/${rowData.id}" target="_blank">
                                    Print
                                </a>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Attach a file</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Vendor Credit' :
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info">
                                Attach a file
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item" href="#">View/Edit</a>
                                <a class="dropdown-item" href="#">Copy</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
                        `);
                    break;
                    case 'Credit Card Credit' :
                        $(td).html(`
                        <button class="btn d-flex align-items-center justify-content-center text-info float-right">
                            Attach a file
                        </button>
                        `);
                    break;
                    default :
                        $(td).html('');
                    break;
                }
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
            $('#status').parent().show();
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

$(document).on('click', 'a#new-time-activity', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_employees .ajax-single_time_activity_modal').trigger('click');
});

$(document).on('click', 'a#new-expense-transaction', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-expense_modal').trigger('click');
});

$(document).on('click', 'a#new-check-transaction', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-check_modal').trigger('click');
});

$(document).on('click', 'a#new-bill-transaction', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-bill_modal').trigger('click');
});

$(document).on('click', 'a#new-purchase-order-transaction', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-purchase_order_modal').trigger('click');
});

$(document).on('click', 'a#new-vendor-credit-transaction', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-vendor_credit_modal').trigger('click');
});

$(document).on('click', 'a#new-credit-card-pmt', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_order .ajax-pay_down_credit_card_modal').trigger('click');
});

$(document).on('click', 'a#pay-bills', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-pay_bills_modal').trigger('click');
});

$('.action-bar .dropdown-menu .show-more-button').on('click', function(e) {
	e.preventDefault();

	if($(this).prev().hasClass('hide')) {
		$(this).prev().removeClass('hide');
		$(this).html('<i class="fa fa-caret-up text-info"></i> &nbsp; Show less');
	} else {
		$(this).prev().addClass('hide');
		$(this).html('<i class="fa fa-caret-down text-info"></i> &nbsp; Show more');
	}
});

$(document).on('change', '.action-bar input[type="checkbox"]', function() {
    var className = $(this).attr('id').replace('trans_', '');

    if($(this).prop('checked')) {
        $(`#transactions-table .${className}`).show();
    } else {
        $(`#transactions-table .${className}`).hide();
    }
});

$(document).on('change', '#transactions-table tbody input[type="checkbox"]', function() {
    var flag = true;
    var allChecked = true;
    var printable = true;

    $('#transactions-table tbody input[type="checkbox"]').each(function() {
        var row = $(this).parent().parent().parent();
        var categoryCell = row.find('td:nth-child(8)');
        var data = $('#transactions-table').DataTable().row(row).data();

        if(categoryCell.find('select').length === 0 && $(this).prop('checked')) {
            flag = false;
        }

        if($(this).prop('checked') === false) {
            allChecked = false;
        }

        if($(this).prop('checked') && data.type !== 'Purchase Order') {
            printable = false;
        }
    });

    if(flag) {
        $('#categorize-selected').removeClass('disabled');
    } else {
        $('#categorize-selected').addClass('disabled');
    }

    if(printable) {
        $('#print-transactions').removeClass('disabled');
    } else {
        $('#print-transactions').addClass('disabled');
    }

    $('#transactions-table thead input[type="checkbox"]').prop('checked', allChecked);
});

$(document).on('change', '#transactions-table thead input#select-all-transactions', function() {
    var isChecked = $(this).prop('checked');
    $('#transactions-table tbody input[type="checkbox"]').each(function() {
        $(this).prop('checked', isChecked).trigger('change');
    });

    if(!isChecked) {
        $('#categorize-selected').addClass('disabled');
    }
});

$('#categorize-selected').on('click', function(e) {
    e.preventDefault();

    $('#select_category_modal').modal('show');
});

$(document).on('submit', '#categorize-selected-form', function(e) {
    e.preventDefault();

    var data = new FormData();

    $('#transactions-table tbody input[type="checkbox"]:checked').each(function() {
        var row = $(this).parent().parent().parent();
        var categoryCell = row.find('td:nth-child(8)');
        var rowData = $('#transactions-table').DataTable().row(row).data();
        var transactionType = rowData.type;
        transactionType = transactionType.replaceAll(' ', '-');
        transactionType = transactionType.toLowerCase();

        if(categoryCell.find('select').length > 0) {
            data.append('transaction_id[]', $(this).val());
            data.append('transaction_type[]', transactionType);
        }
    });

    $.ajax({
        url: `/accounting/expenses/categorize-transactions/${$('#category-id').val()}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('#print-transactions').on('click', function(e) {
    e.preventDefault();

    $('#transactions-table').parent().parent().append('<form id="print-transactions-form" action="/accounting/expenses/print-multiple-transactions" method="post" class="d-none" target="_blank"></form>');

    $('#transactions-table tbody input[type="checkbox"]').each(function() {
        var row = $(this).parent().parent().parent();
        var rowData = $('#transactions-table').DataTable().row(row).data();
        var transactionType = rowData.type;
        transactionType = transactionType.replaceAll(' ', '-');
        transactionType = transactionType.toLowerCase();

        if($(this).prop('checked') && rowData.type === 'Purchase Order') {
            if($(`#print-transactions-form input[value="${$(this).val()}"]`).length === 0) {
                $('#print-transactions-form').append(`<input type="hidden" value ="${transactionType+'_'+$(this).val()}" name="transactions[]">`);
            }
        } else {
            $('#print-transactions-form').find(`input[value="${$(this).val()}"]`).remove();;
        }
    });

    $('#print-transactions-form').submit();

    $('#print-transactions-form').remove();
});

$(document).on('change', '#transactions-table select[name="category[]"]', function() {
    var row = $(this).parent().parent();
    var rowData = $('#transactions-table').DataTable().row(row).data();
    var account = $(this).val();

    var data = new FormData();
    data.set('transaction_type', rowData.type);
    data.set('transaction_id', rowData.id);
    data.set('new_category', account);

    $.ajax({
        url: '/accounting/expenses/update-transaction-category',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            toast(res.success, res.message);

            $('#transactions-table').DataTable().ajax.reload();
        }
    });
});