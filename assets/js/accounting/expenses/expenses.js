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

const columns = [
    {
        orderable: false,
        data: null,
        name: 'checkbox',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            var id = 'select-';
            switch(rowData.type) {
                case 'Bill' :
                    id += 'bill-';
                break;
                case 'Bill Payment (Check)' :
                    id += 'bill-payment-';
                break;
                case 'Bill Payment (Credit Card)' :
                    id += 'bill-payment-';
                break;
                case 'Check' :
                    id += 'check-';
                break;
                case 'Credit Card Credit' :
                    id += 'cc-credit-';
                break;
                case 'Credit Card Payment' :
                    id += 'cc-payment-';
                break;
                case 'Expense' :
                    id += 'expense-';
                break;
                case 'Purchase Order' :
                    id += 'purchase-order-';
                break;
                case 'Vendor Credit' :
                    id += 'vendor-credit-';
                break;
            }
            id += rowData.id;

            $(td).html(`
            <div class="d-flex justify-content-center">
                <div class="checkbox checkbox-sec m-0">
                    <input type="checkbox" value="${rowData.id}" id="${id}">
                    <label for="${id}" class="p-0" style="width: 24px; height: 24px"></label>
                </div>
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

            if(cellData.length > 0) {
                var imgExt = ['jpg', 'jpeg', 'png'];
                var dropdownItem = '';
                var noPreview = `
                <div class="bg-muted text-center d-flex justify-content-center align-items-center h-100 text-white">
                    <p class="m-0">NO PREVIEW AVAILABLE</p>
                </div>
                `;

                $.each(cellData, function(index, attachment) {
                    dropdownItem += `
                        <div class="col-12 p-2 view-attachment" data-href="/uploads/accounting/attachments/${attachment.stored_name}">
                            <div class="row">
                                <div class="col-5 pr-0">
                                    ${imgExt.includes(attachment.file_extension) ? `<img src="/uploads/accounting/attachments/${attachment.stored_name}" class="m-auto">` : noPreview }
                                </div>
                                <div class="col-7">
                                    <div class="d-flex align-items-center h-100 w-100">
                                        <span class="overflow-hidden" style="text-overflow: ellipsis">${attachment.uploaded_name}.${attachment.file_extension}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $(td).html(`
                <div class="dropdown">
                    <button class="btn btn-block dropdown-toggle hide-toggle" type="button" id="attachments-${rowData.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-info">${cellData.length}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-align-right" aria-labelledby="attachments-${rowData.id}">
                        <div class="row m-0">${dropdownItem}</div>
                    </div>
                </div>
                `);
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                        <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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

                        <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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
];

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
    columns: columns
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

$(document).on('change', '#table_rows', function() {
    applybtn();
});

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
        url: '/accounting/vendors/update-transaction-category',
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

$(document).on('click', '#transactions-table tbody tr td:not(:first-child, :last-child, :nth-child(14))', function() {
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

$(document).on('click', '#transactions-table .view-edit-expense', function() {
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/view-transaction/expense/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('expenseModal', data);

        $('#expenseModal #payee').trigger('change');

        $('#expenseModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-check', function() {
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/view-transaction/check/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('checkModal', data);

        $('#checkModal #payee').trigger('change');

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

    $.get('/accounting/view-transaction/bill/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('billModal', data);

        $('#billModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-purch-order', function() {
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/view-transaction/purchase-order/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('purchaseOrderModal', data);

        $('#purchaseOrderModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-vendor-credit', function() {
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/view-transaction/vendor-credit/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('vendorCreditModal', data);

        $('#vendorCreditModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-cc-payment', function() {
    var row = $(this).parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();

    $.get('/accounting/view-transaction/credit-card-pmt/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('payDownCreditModal', data);

        $('#payDownCreditModal').modal('show');
    });
});

function viewCreditCardCredit(data) {
    $.get('/accounting/view-transaction/cc-credit/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('creditCardCreditModal', data);

        $('#creditCardCreditModal').modal('show');
    });
}

function viewBillPayment(data) {
    $.get('/accounting/view-transaction/bill-payment/'+data.id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billPaymentModal #vendor').trigger('change');

        initModalFields('billPaymentModal', data);

        initBillsTable(data);

        if($('#billPaymentModal #vendor-credits-table').length > 0) {
            initCreditsTable(data);
        }

        $('#billPaymentModal .dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });

        $('#billPaymentModal #payee').trigger('change');

        $('#billPaymentModal').modal('show');
    });
}

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

        initModalFields('expenseModal', data);

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

        initModalFields('checkModal', data);

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

        initModalFields('billModal', data);

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

        initModalFields('purchaseOrderModal', data);

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

        initModalFields('vendorCreditModal', data);

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

        initModalFields('billModal', data);

        $('#billModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-attachment', function(e) {
    e.preventDefault();
    var data = e.currentTarget.dataset;

    window.open(data.href, "_blank");
});

$(document).on('click', '#print-table', function(e) {
    e.preventDefault();

    var data = new FormData();

    data.set('type', $('#type').val());
    data.set('status', $('#status').val());
    data.set('delivery_method', $('#del-method').val());
    data.set('date', $('#date').val());
    data.set('from_date', $('#from-date').val());
    data.set('to_date', $('#to-date').val());
    data.set('payee', $('#payee').val());
    data.set('category', $('#category').val());

    data.set('chk_type', $('#trans_type').prop('checked') ? 1 : 0);
    data.set('chk_number', $('#trans_number').prop('checked') ? 1 : 0);
    data.set('chk_payee', $('#trans_payee').prop('checked') ? 1 : 0);
    data.set('chk_method', $('#trans_method').prop('checked') ? 1 : 0);
    data.set('chk_source', $('#trans_source').prop('checked') ? 1 : 0);
    data.set('chk_category', $('#trans_category').prop('checked') ? 1 : 0);
    data.set('chk_memo', $('#trans_memo').prop('checked') ? 1 : 0);
    data.set('chk_due_date', $('#trans_due_date').prop('checked') ? 1 : 0);
    data.set('chk_balance', $('#trans_balance').prop('checked') ? 1 : 0);
    data.set('chk_status', $('#trans_status').prop('checked') ? 1 : 0);
    data.set('chk_attachments', $('#trans_attachments').prop('checked') ? 1 : 0);

    var tableOrder = table.order();
    data.set('column', columns[tableOrder[0][0]].name);
    data.set('order', tableOrder[0][1]);

    $.ajax({
        url: '/accounting/expenses/print-transactions',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            let pdfWindow = window.open("");
            pdfWindow.document.write(result);
            $(pdfWindow.document).find('body').css('padding', '0');
            $(pdfWindow.document).find('body').css('margin', '0');
            $(pdfWindow.document).find('iframe').css('border', '0');
            pdfWindow.print();
        }
    });
});

$(document).on('click', '#export-transactions', function(e) {
    e.preventDefault();

    var fields = $('#myTabContent .action-bar .dropdown-menu input[type="checkbox"]:checked');
    fields.each(function() {
        if($(this).attr('id').includes('trans_')) {
            $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('trans_', '')}">`);
        }
    });
    $('#export-form').append(`<input type="hidden" name="type" value="${$('#type').val()}">`);
    $('#export-form').append(`<input type="hidden" name="status" value="${$('#status').val()}">`);
    $('#export-form').append(`<input type="hidden" name="delivery_method" value="${$('#del-method').val()}">`);
    $('#export-form').append(`<input type="hidden" name="date" value="${$('#date').val()}">`);
    $('#export-form').append(`<input type="hidden" name="from_date" value="${$('#from-date').val()}">`);
    $('#export-form').append(`<input type="hidden" name="to_date" value="${$('#to-date').val()}">`);
    $('#export-form').append(`<input type="hidden" name="payee" value="${$('#payee').val()}">`);
    $('#export-form').append(`<input type="hidden" name="category" value="${$('#category').val()}">`);

    var tableOrder = table.order();
    $('#export-form').append(`<input type="hidden" name="column" value="${columns[tableOrder[0][0]].name}">`);
    $('#export-form').append(`<input type="hidden" name="order" value="${tableOrder[0][1]}">`);

    $('#export-form').submit();
})

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).find('input').remove();
});