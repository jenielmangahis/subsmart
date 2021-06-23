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
                                <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item view-edit-expense" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="/accounting/expenses/print-transaction/expense/${rowData.id}" target="_blank">Print</a>
                                    <a class="dropdown-item copy-expense" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item view-edit-expense" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="/accounting/expenses/print-transaction/expense/${rowData.id}" target="_blank">Print</a>
                                    <a class="dropdown-item copy-expense" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    <a class="dropdown-item void-expense" href="#">Void</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Check' :
                        if(rowData.status === 'Voided') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item view-edit-check" href="#">View/Edit</a>
                                    <a class="dropdown-item copy-check" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item view-edit-check" href="#">View/Edit</a>
                                    <a class="dropdown-item copy-check" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    <a class="dropdown-item void-check" href="#">Void</a>
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
                                    <a class="dropdown-item view-edit-bill" href="#">View/Edit</a>
                                    <a class="dropdown-item copy-bill" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info view-edit-bill">
                                    View/Edit
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item copy-bill" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Bill Payment (Check)' :
                        if(rowData.status === 'Voided') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    <a class="dropdown-item void-bill-payment" href="#">Void</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Bill Payment (Credit Card)' :
                        if(rowData.status === 'Voided') {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                    Attach a file
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    <a class="dropdown-item void-bill-payment" href="#">Void</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Credit Card Payment' :
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info view-edit-cc-payment">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                <a class="dropdown-item void-cc-payment" href="#">Void</a>
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
                                    <a class="dropdown-item copy-to-bill" href="#">Copy to bill</a>
                                    <a class="dropdown-item" href="/accounting/expenses/print-transaction/purchase-order/${rowData.id}" target="_blank">Print</a>
                                    <a class="dropdown-item view-edit-purch-order" href="#">View/Edit</a>
                                    <a class="dropdown-item copy-purchase-order" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
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
                                    <a class="dropdown-item view-edit-purch-order" href="#">View/Edit</a>
                                    <a class="dropdown-item copy-purchase-order" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Vendor Credit' :
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info attach-file">
                                Attach a file
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item view-edit-vendor-credit" href="#">View/Edit</a>
                                <a class="dropdown-item copy-vendor-credit" href="#">Copy</a>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </div>
                        </div>
                        `);
                    break;
                    case 'Credit Card Credit' :
                        $(td).html(`
                        <button class="btn d-flex align-items-center justify-content-center text-info float-right attach-file">
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

$('a#new-time-activity').on('click', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_employees .ajax-single_time_activity_modal').trigger('click');
});

$('a#new-expense-transaction').on('click', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-expense_modal').trigger('click');
});

$('a#new-check-transaction').on('click', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-check_modal').trigger('click');
});

$('a#new-bill-transaction').on('click', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-bill_modal').trigger('click');
});

$('a#new-purchase-order-transaction').on('click', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-purchase_order_modal').trigger('click');
});

$('a#new-vendor-credit-transaction').on('click', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_vendors .ajax-vendor_credit_modal').trigger('click');
});

$('a#new-credit-card-pmt').on('click', function(e) {
    e.preventDefault();

    $('#new-popup #accounting_order .ajax-pay_down_credit_card_modal').trigger('click');
});

$('a#pay-bills').on('click', function(e) {
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

$(document).on('click', '#transactions-table tbody tr td:not(:first-child, :last-child)', function() {
    var row = $(this).parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    
    if($(this).find('select').length === 0) {
        switch(data.type) {
            case 'Expense' :
                $(this).parent().find('.view-edit-expense').trigger('click');
            break;
            case 'Check' :
                $(this).parent().find('.view-edit-check').trigger('click');
            break;
            case 'Bill' :
                $(this).parent().find('.view-edit-bill').trigger('click');
            break;
            case 'Purchase Order' :
                $(this).parent().find('.view-edit-purch-order').trigger('click');
            break;
            case 'Vendor Credit' :
                $(this).parent().find('.view-edit-vendor-credit').trigger('click');
            break;
            case 'Credit Card Payment' :
                $(this).parent().find('.view-edit-cc-payment').trigger('click');
            break;
            case 'Credit Card Credit' :
                viewCreditCardCredit(data);
            break;
            case 'Bill Payment (Check)' :
                viewBillPayment(data);
            break;
            case 'Bill Payment (Credit Card)' :
                viewBillPayment(data);
            break;
        }
    }
});

function initFormFields(modalName, data) {
    var transactionType = data.type;
    transactionType = transactionType.replace(' (Check)', '');
    transactionType = transactionType.replace(' (Credit Card)', '');
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    if($(`#${modalName} table#category-details-table`).length > 0) {
        rowCount = 2;
        catDetailsInputs = $(`#${modalName} table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#${modalName} table#category-details-table tbody tr:last-child`).html();
    }

    if($(`#${modalName} table#category-details-table tbody tr`).length === 2) {
        $(`#${modalName} table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
        $(`#${modalName} table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);
    } else {
        $(`#${modalName} table#category-details-table tbody tr:first-child()`).remove();
    }

    if($(`#${modalName} select`).length > 0) {
        $(`#${modalName} select`).select2();
    }

    if($(`div#${modalName} select#tags`).length > 0) {
        $(`div#${modalName} select#tags`).select2({
            placeholder: 'Start typing to add a tag',
            allowClear: true,
            ajax: {
                url: '/accounting/get-job-tags',
                dataType: 'json'
            }
        });
    }

    if($(`div#${modalName} .date`).length > 0) {
        $(`div#${modalName} .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });
    }

    if($(`#${modalName} .attachments`).length > 0) {
        var attachmentContId = $(`#${modalName} .attachments .dropzone`).attr('id');
        var viewExpenseAtta = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                $.getJSON('/accounting/vendors/get-transaction-attachments/'+transactionType+'/'+data.id, function(data) {
                    if(data.length > 0) {
                        $.each(data, function(index, val) {
                            $(`#${modalName}`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${val.id}">`);

                            modalAttachmentId.push(val.id);
                            var mockFile = {
                                name: `${val.uploaded_name}.${val.file_extension}`,
                                size: parseInt(val.size),
                                dataURL: base_url+"uploads/accounting/attachments/" + val.stored_name,
                                // size: val.size / 1000000,
                                accepted: true
                            };
                            viewExpenseAtta.emit("addedfile", mockFile);
                            modalAttachedFiles.push(mockFile);
        
                            viewExpenseAtta.createThumbnailFromUrl(mockFile, viewExpenseAtta.options.thumbnailWidth, viewExpenseAtta.options.thumbnailHeight, viewExpenseAtta.options.thumbnailMethod, true, function(thumbnail) {
                                viewExpenseAtta.emit('thumbnail', mockFile, thumbnail);
                            });
                            viewExpenseAtta.emit("complete", mockFile);
                        });
                    }
                });

                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#${modalName}`);

                    for(i in ids) {
                        if(modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                            modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                        }

                        modalAttachmentId.push(ids[i]);
                    }
                    modalAttachedFiles.push(file);
                });
            },
            removedfile: function(file) {
                var ids = modalAttachmentId;
                var index = modalAttachedFiles.map(function(d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];
        
                $(`#${modalName} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;

                if((previewElement = file.previewElement) !== null) {
                    var remove = (previewElement.parentNode.removeChild(file.previewElement));
        
                    if($(`#${attachmentContId} .dz-preview`).length > 0) {
                        $(`#${attachmentContId} .dz-message`).hide();
                    } else {
                        $(`#${attachmentContId} .dz-message`).show();
                    }
        
                    return remove;
                } else {
                    return (void 0);
                }
            }
        });
    }
}

$(document).on('click', '#transactions-table .view-edit-expense', function() {
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/view-expense/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initFormFields('expenseModal', data);

        $('#expenseModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-check', function() {
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/view-check/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initFormFields('checkModal', data);

        $('#checkModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-bill', function() {
    if($(this).hasClass('dropdown-item')) {
        var row = $(this).parent().parent().parent().parent();
    } else {
        var row = $(this).parent().parent().parent();
    }
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/view-bill/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initFormFields('billModal', data);

        $('#billModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-purch-order', function() {
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/view-purchase-order/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initFormFields('purchaseOrderModal', data);

        $('#purchaseOrderModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-vendor-credit', function() {
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/view-vendor-credit/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initFormFields('vendorCreditModal', data);

        $('#vendorCreditModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-cc-payment', function() {
    var row = $(this).parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/view-cc-payment/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initFormFields('payDownCreditModal', data);

        $('#payDownCreditModal').modal('show');
    });
});

function viewCreditCardCredit(data) {
    $.get('/accounting/vendors/view-cc-credit/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initFormFields('creditCardCreditModal', data);

        $('#creditCardCreditModal').modal('show');
    });
}

function viewBillPayment(data) {
    $.get('/accounting/expenses/view-bill-payment/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initFormFields('billPaymentModal', data);

        initBillsTable(data);

        $('#billPaymentModal .dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });

        $('#billPaymentModal').modal('show');
    });
}

function initBillsTable(data)
{
    $('#billPaymentModal #bills-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: parseInt($('#billPaymentModal #table_rows').val()),
        ordering: false,
        ajax: {
            url: `/accounting/expenses/load-bill-payment-bills/${data.id}`,
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.search = $('#billPaymentModal #search').val();
                d.from = $('#billPaymentModal #bills-from').val();
                d.to = $('#billPaymentModal #bills-to').val();
                d.overdue = $('#billPaymentModal #overdue_bills_only').prop('checked');
                d.length = parseInt($('#billPaymentModal #table_rows').val());
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: [
            {
                data: null,
                name: 'checkbox',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<input type="checkbox" value="${rowData.id}">`);
                    $(td).css('padding', '10px 18px');
                }
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'due_date',
                name: 'due_date'
            },
            {
                data: 'original_amount',
                name: 'original_amount'
            },
            {
                data: 'open_balance',
                name: 'open_balance'
            },
            {
                data: 'payment',
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<input type="number" value="${cellData}" class="form-control text-right" onchange="convertToDecimal(this)">`);
                }
            }
        ]
    });
}

function applyBillsFilter() {
    $('#billPaymentModal #bills-table').DataTable().ajax.reload();
}

function resetBillsFilter() {
    $('#billPaymentModal #bills-from').val('');
    $('#billPaymentModal #bills-to').val('');
    $('#billPaymentModal #overdue_bills_only').prop('checked', false);

    applyBillsFilter();
}

$(document).on('keyup', '#billPaymentModal #search', function() {
    $('#billPaymentModal #bills-table').DataTable().ajax.reload();
});

$(document).on('click', '#transactions-table a.delete-transaction', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' (Check)', '');
    transactionType = transactionType.replaceAll(' (Credit Card)', '');
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.ajax({
        url: `/accounting/vendors/delete-transaction/${transactionType}/${data.id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });
});

$(document).on('click', '#transactions-table .void-expense', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.get('/accounting/vendors/void-transaction/'+transactionType+'/'+data.id, function(res) {
        var result = JSON.parse(res);

        toast(result.success, result.message);

        $('#transactions-table').DataTable().ajax.reload();
    });
});

$(document).on('click', '#transactions-table .void-check', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.get('/accounting/vendors/void-transaction/'+transactionType+'/'+data.id, function(res) {
        var result = JSON.parse(res);

        toast(result.success, result.message);

        $('#transactions-table').DataTable().ajax.reload();
    });
});

$(document).on('click', '#transactions-table .void-cc-payment', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.get('/accounting/vendors/void-transaction/'+transactionType+'/'+data.id, function(res) {
        var result = JSON.parse(res);

        toast(result.success, result.message);

        $('#transactions-table').DataTable().ajax.reload();
    });
});

$(document).on('click', '#transactions-table .void-bill-payment', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = 'bill-payment';

    $.get('/accounting/vendors/void-transaction/'+transactionType+'/'+data.id, function(res) {
        var result = JSON.parse(res);

        toast(result.success, result.message);

        $('#transactions-table').DataTable().ajax.reload();
    });
});

$(document).on('click', '#transactions-table .attach-file', function(e) {
    e.preventDefault();

    if($(this).hasClass('dropdown-item')) {
        var row = $(this).parent().parent().parent().parent();
    } else {
        var row = $(this).parent().parent().parent();

        if($(this).hasClass('float-right')) {
            var row = $(this).parent().parent()
        }
    }
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' (Check)', '');
    transactionType = transactionType.replaceAll(' (Credit Card)', '');
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.get(`/accounting/expenses/get-attach-file-modal/${transactionType}/${data.id}`, function(res) {
        if($('.append-modal #attach_file_modal').length > 0) {
            $('.append-modal #attach_file_modal').remove()
        }

        $('.append-modal').append(res);

        $('.append-modal #attach_file_modal select').select2({
            minimumResultsForSearch: -1
        });

        var attachmentContId = $(`#attach_file_modal .attachments .dropzone`).attr('id');
        var viewExpenseAtta = new Dropzone(`#${attachmentContId}`, {
            url: `/accounting/expenses/attach-files/${transactionType}/${data.id}`,
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    location.reload();
                });
            },
        });

        $('#attach_file_modal').modal('show');
    });
});

$(document).on('change', '#attachments-filter', function() {
    $.get(`/accounting/attachments/get-${$(this).val()}-attachments-ajax`, function(res) {
        var attachments = JSON.parse(res);

        $('#attach_file_modal .attachments-container').html('');
        $.each(attachments, function(index, attachment) {
            var date = new Date(attachment.created_at.split(' ')[0]);
            $('#attach_file_modal .attachments-container').append(`
            <div class="col-md-3">
                <div class="card border p-0">
                    <img class="card-img-top m-0" src="/uploads/accounting/attachments/${attachment.stored_name}" alt="${attachment.uploaded_name}.${attachment.file_extension}">
                    <div class="card-body p-2">
                        <h6 class="card-title">${attachment.uploaded_name}.${attachment.file_extension}</h6>
                        <p class="card-subtitle mb-2 text-muted">${String(date.getMonth() + 1).padStart(2, '0')+'/'+String(date.getDate()).padStart(2, '0')+'/'+date.getFullYear()}</p>
                        <ul class="d-flex justify-content-around">
                            <li><a href="#" class="text-info attach-to-transaction" data-id="${attachment.id}">Add</a></li>
                            <li><a href="/uploads/accounting/attachments/${attachment.stored_name}" target="_blank" class="text-info">Preview</a></li>
                        </ul>
                    </div>
                </div>
            </div>`);
        });
    });
});

$(document).on('click', '#attach_file_modal a.attach-to-transaction', function(e) {
    e.preventDefault();

    $('#attach_file_modal #attach-file-form').prepend(`<input type="hidden" name="id" value="${e.currentTarget.dataset.id}">`);
    $('#attach_file_modal #attach-file-form').submit();
});

$(document).on('click', '#transactions-table .copy-expense', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/copy-expense/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#expenseModal').parent().attr('onsubmit', 'submitModalForm(event, this)');

        initFormFields('expenseModal', data);

        $('#expenseModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .copy-check', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/copy-check/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#checkModal').parent().attr('onsubmit', 'submitModalForm(event, this)');

        initFormFields('checkModal', data);

        $('#checkModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .copy-bill', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/vendors/copy-bill/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal').parent().attr('onsubmit', 'submitModalForm(event, this)');

        initFormFields('billModal', data);

        $('#billModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .copy-purchase-order', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.get('/accounting/vendors/copy-purchase-order/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#purchaseOrderModal').parent().attr('onsubmit', 'submitModalForm(event, this)');

        initFormFields('purchaseOrderModal', data);

        $('#purchaseOrderModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .copy-vendor-credit', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.get('/accounting/vendors/copy-vendor-credit/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#vendorCreditModal').parent().attr('onsubmit', 'submitModalForm(event, this)');

        initFormFields('vendorCreditModal', data);

        $('#vendorCreditModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .copy-to-bill', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.get('/accounting/vendors/copy-to-bill/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal').parent().attr('onsubmit', 'submitModalForm(event, this)');

        initFormFields('billModal', data);

        $('#billModal').modal('show');
    });
});