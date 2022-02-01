const vendorId = $('#vendor-id[type="hidden"]').val();
const vendorName = $('.page-title span#vendor-display-name').html();

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

$(document).on('change', '#edit-vendor-modal #use_display_name', function() {
    if($(this).prop('checked')) {
        $('#edit-vendor-modal #print_on_check_name').prop('disabled', true);
    } else {
        $('#edit-vendor-modal #print_on_check_name').prop('disabled', false);
    }
});

var attachmentId = [];
var attachedFiles = [];

var previewAttachments = new Dropzone('#previewVendorAttachments', {
    url: '/accounting/vendors/update-attachments/'+vendorId,
    maxFilesize: 20,
    uploadMultiple: true,
    addRemoveLinks: true,
    init: function() {
        $.getJSON('/accounting/get-linked-attachments/vendor/'+vendorId, function(data) {
            if(data.length > 0) {
                $.each(data, function(index, val) {
                    attachmentId.push(val.id);
                    var mockFile = {
                        name: `${val.uploaded_name}.${val.file_extension}`,
                        size: parseInt(val.size),
                        dataURL: base_url+"uploads/accounting/attachments/" + val.stored_name,
                        // size: val.size / 1000000,
                        accepted: true
                    };
                    previewAttachments.emit("addedfile", mockFile);
                    attachedFiles.push(mockFile);

                    previewAttachments.createThumbnailFromUrl(mockFile, previewAttachments.options.thumbnailWidth, previewAttachments.options.thumbnailHeight, previewAttachments.options.thumbnailMethod, true, function(thumbnail) {
                        previewAttachments.emit('thumbnail', mockFile, thumbnail);
                    });
                    previewAttachments.emit("complete", mockFile);
                });
            }
        });

        this.on("success", function(file, response) {
            var ids = JSON.parse(response)['attachment_ids'];
            for(i in ids) {
                if($('#edit-vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                    $('#edit-vendor-modal #vendorAttachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                }

                attachmentId.push(ids[i]);
            }
            attachedFiles.push(file);
        });
    },
    removedfile: function(file) {
        var ids = attachmentId;
        var index = attachedFiles.map(function(d, index) {
            if (d == file) return index;
        }).filter(isFinite)[0];

        $.ajax({
            type: "POST",
            url: '/accounting/vendors/remove-attachment/'+vendorId,
            dataType: 'json',
            data: {
                attachment_id: ids[index]
            },
            success: function(response) {
                if(response.success) {
                    $('#edit-vendor-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();
                }
            }
        });

        //remove thumbnail
        var previewElement;

        if((previewElement = file.previewElement) !== null) {
            var remove = (previewElement.parentNode.removeChild(file.previewElement));

            if($('#previewVendorAttachments .dz-preview').length > 0) {
                $('#previewVendorAttachments .dz-message').hide();
            } else {
                $('#previewVendorAttachments .dz-message').show();
            }

            return remove;
        } else {
            return (void 0);
        }
    }
});

$('.datepicker').datepicker({
    uiLibrary: 'bootstrap',
    todayBtn: "linked",
    language: "de"
});

$('.notes-container').on('click', function() {
    $($('.edit-vendor')[0]).trigger('click');
});

const noAjax = [
    'template-type',
    'date'
];

$('select:not(#category-id)').each(function() {
    if(noAjax.includes($(this).attr('id'))) {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    } else {
        var field = $(this).attr('id') === 'payee' ? 'payee' : 'expense-account';
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: field,
                        for: 'filter'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });
    }
});

$('#category-id').select2({
    dropdownParent: $('#select_category_modal'),
    placeholder: 'Select category',
    ajax: {
        url: '/accounting/get-dropdown-choices',
        dataType: 'json',
        data: function(params) {
            var query = {
                search: params.term,
                type: 'public',
                field: 'expense-account'
            }

            // Query parameters will be ?search=[term]&type=public&field=[type]
            return query;
        }
    },
    templateResult: formatResult,
    templateSelection: optionSelect
});

$('.dropdown-menu').on('click', function(e) {
	e.stopPropagation();
});

const columns = [
    {
        data: null,
        name: 'checkbox',
        orderable: false,
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
        name: 'date',
        data: 'date'
    },
    {
        name: 'type',
        data: 'type',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if($('#type_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('type');
        }
    },
    {
        name: 'number',
        data: 'number',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if($('#number_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('number');
        }
    },
    {
        name: 'payee',
        data: 'payee',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if($('#payee_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('payee');
        }
    },
    {
        name: 'method',
        data: 'method',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if($('#method_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('method');
        }
    },
    {
        name: 'source',
        data: 'source',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if($('#source_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('source');
        }
    },
    {
        name: 'category',
        data: 'category',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData !== '-Split-' && cellData !== '') {
                $(td).html(`
                <select name="expense_account[]" class="form-control">
                    <option value="${cellData.id}">${cellData.name}</option>
                </select>
                `);

                if($(td).find('select').length > 0) {
                    $(td).find('select').select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: 'expense-account'
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect
                    });
                }
            } else {
                $(td).html(cellData);
            }

            if($('#category_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('category');
        }
    },
    {
        name: 'memo',
        data: 'memo',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if($('#memo_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('memo');
        }
    },
    {
        name: 'due_date',
        data: 'due_date',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if($('#due_date_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('due_date');
        }
    },
    {
        name: 'balance',
        data: 'balance',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData.includes('-')) {
                $(td).html(cellData.replace('-', '-$'));
            } else {
                $(td).html(`$${cellData}`);
            }

            if($('#balance_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('balance');
        }
    },
    {
        name: 'total',
        data: 'total',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData.includes('-')) {
                $(td).html(cellData.replace('-', '-$'));
            } else {
                $(td).html(`$${cellData}`);
            }
        }
    },
    {
        name: 'status',
        data: 'status',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if($('#status_chk').prop('checked') === false) {
                $(td).addClass('hide');
            }

            $(td).addClass('status');
        }
    },
    {
        name: 'attachments',
        data: 'attachments',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            $(td).addClass('attachments');
            if($('#attachments_chk').prop('checked') === false) {
                $(td).addClass('hide');
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
        name: 'action',
        data: null,
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            switch (rowData.type) {
                case 'Expense' :
                    if(rowData.status === 'Voided') {
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info view-edit-expense">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item" href="/accounting/vendors/print-transaction/expense/${rowData.id}" target="_blank">Print</a>
                                <a class="dropdown-item copy-expense" href="#">Copy</a>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </div>
                        </div>
                        `);
                    } else {
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info view-edit-expense">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item" href="/accounting/vendors/print-transaction/expense/${rowData.id}" target="_blank">Print</a>
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
                            <button class="btn d-flex align-items-center justify-content-center text-info view-edit-check">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item copy-check" href="#">Copy</a>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </div>
                        </div>
                        `);
                    } else {
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info view-edit-check">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
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
                            </div>
                        </div>
                        `);
                    }
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
                                <a class="dropdown-item" href="/accounting/vendors/print-transaction/purchase-order/${rowData.id}" target="_blank">Print</a>
                                <a class="dropdown-item view-edit-purch-order" href="#">View/Edit</a>
                                <a class="dropdown-item copy-purchase-order" href="#">Copy</a>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
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
                            </div>
                        </div>
                        `);
                    }
                break;
                case 'Vendor Credit' :
                    $(td).html(`
                    <div class="btn-group float-right">
                        <button class="btn d-flex align-items-center justify-content-center text-info view-edit-vendor-credit">
                            View/Edit
                        </button>

                        <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
                            <a class="dropdown-item copy-vendor-credit" href="#">Copy</a>
                            <a class="dropdown-item delete-transaction" href="#">Delete</a>
                        </div>
                    </div>
                    `);
                break;
                case 'Credit Card Payment' :
                    if(rowData.status === 'Voided') {
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
                            </div>
                        </div>
                        `);
                    } else {
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
                    }
                break;
                case 'Bill Payment (Check)' :
                    if(rowData.status === 'Voided') {
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info view-edit-bill-payment">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </div>
                        </div>
                        `);
                    } else {
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info view-edit-bill-payment">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-align-right" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                <a class="dropdown-item void-bill-payment" href="#">Void</a>
                            </div>
                        </div>
                        `);
                    }
                break;
                default :
                    $(td).html('');
                    $(td).css('height', '64.67px');
                break;
            }
        }
    }
];

$('#transactions-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: 150,
    order: [[1, 'desc']],
    ajax: {
        url: `/accounting/vendors/${vendorId}/load-transactions`,
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.date = $('#date').val();
            d.type = $('#template-type').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: columns
});

function showCol(el) {
    var elementId = $(el).attr('id');
    var column = elementId.replace('_chk', '');

    if($(el).prop('checked')) {
        $(`#transactions-table .${column}`).removeClass('hide');
    } else {
        $(`#transactions-table .${column}`).addClass('hide');
    }
}

const selectedTerm = $('#terms').val();

$('#terms').on('change', function() {
    if($(this).val() === 'add-new') {
        $('#payment_term_modal').modal('show');
    }
});

$('#payment_term_modal #payment-term-form').on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: '/accounting/terms/ajax-add-term',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);

            $('#terms').append(`<option value="${result.data.id}">${result.data.name}</option>`);
            var terms = $('#terms option:not([value=""],[value="add-new"])');

            terms.sort(function(a, b) {
                if (a.text > b.text) return 1;
                if (a.text < b.text) return -1;
                return 0;
            });

            $("#terms").empty().append(`
                <option value="" disabled selected>&nbsp;</option>
                <option value="add-new">&plus; Add new</option> 
            `);
            $("#terms").append(terms);
            $("#terms").val(selectedTerm).trigger('change');

            $('#payment_term_modal').modal('hide');
        }
    });
});

function applybtn() {
    $('#transactions-table').DataTable().ajax.reload();
}

$('#new-time-activity').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/single_time_activity_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#singleTimeModal #person_tracking').html(`<option value="vendor-${vendorId}">${vendorName}</option>`);

        $('#singleTimeModal select').each(function() {
            var type = $(this).attr('id');
            if (type === undefined) {
                type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
            } else {
                type = type.replaceAll('_', '-');

                if (type.includes('transfer')) {
                    type = 'transfer-account';
                }
            }

            if (dropdownFields.includes(type)) {
                $(this).select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: type,
                                modal: modal_element.replaceAll('#', '')
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect
                });
            } else {
                var options = $(this).find('option');
                if (options.length > 10) {
                    $(this).select2();
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1
                    });
                }
            }
        });

        if ($(`#singleTimeModal .date`).length > 0) {
            $(`#singleTimeModal .date`).each(function() {
                $(this).datepicker({
                    uiLibrary: 'bootstrap'
                });
            });
        }

        $('#singleTimeModal').modal('show');
    });
});

$('a#new-bill-transaction').on('click', function(e) {
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

        $('#billModal #vendor').append(`<option value="${vendorId}">${vendorName}</option>`);

        initModalFields('billModal');

        $('#billModal').modal('show');
    });
});

$('a#new-expense-transaction').on('click', function(e) {
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

        $('#expenseModal #payee').append(`<option value="vendor-${vendorId}">${vendorName}</option>`);

        initModalFields('expenseModal');

        $('#expenseModal').modal('show');
    });
});

$('a#new-check-transaction').on('click', function(e) {
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

        $('#checkModal #payee').append(`<option value="vendor-${vendorId}">${vendorName}</option>`);

        initModalFields('checkModal');

        $('#checkModal').modal('show');
    });
});

$('a#new-purchase-order-transaction').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/purchase_order_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#purchaseOrderModal #vendor').append(`<option value="${vendorId}">${vendorName}</option>`);

        initModalFields('purchaseOrderModal');

        $('#purchaseOrderModal').modal('show');
    });
});

$('a#new-vendor-credit-transaction').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/vendor_credit_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#vendorCreditModal #vendor').append(`<option value="${vendorId}">${vendorName}</option>`);

        initModalFields('vendorCreditModal');

        $('#vendorCreditModal').modal('show');
    });
});

$('a#new-credit-card-pmt').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/pay_down_credit_card_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#payDownCreditModal #vendor').append(`<option value="${vendorId}">${vendorName}</option>`);

        $(`#payDownCreditModal select`).each(function() {
            var type = $(this).attr('id');
            if (type === undefined) {
                type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
            } else {
                type = type.replaceAll('_', '-');

                if (type.includes('transfer')) {
                    type = 'transfer-account';
                }
            }

            if (dropdownFields.includes(type)) {
                $(this).select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: type,
                                modal: 'payDownCreditModal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect
                });
            } else {
                var options = $(this).find('option');
                if (options.length > 10) {
                    $(this).select2();
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1
                    });
                }
            }
        });

        $(`#payDownCreditModal .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });

        var attachmentContId = $(`#payDownCreditModal .attachments .dropzone`).attr('id');
        var ccpAttachments = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#payDownCreditModal`);

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

                $(`#payDownCreditModal .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

        $('#payDownCreditModal').modal('show');
    });
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
    var row = $(this).parent().parent().parent();
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

        $('#expenseModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-check', function() {
    var row = $(this).parent().parent().parent();
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

        $('#checkModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-bill', function() {
    var row = $(this).parent().parent().parent();
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
    var row = $(this).parent().parent().parent();
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
    var row = $(this).parent().parent().parent();
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

$(document).on('click', '#transactions-table .copy-expense', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

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
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

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
    var transactionType = data.type;
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

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

$(document).on('change', '#transactions-table tbody input[type="checkbox"]', function() {
    var flag = true;
    var allChecked = true;
    var printable = true;

    $('#transactions-table tbody input[type="checkbox"]').each(function() {
        var row = $(this).parent().parent().parent().parent();
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

$(document).on('change', '#transactions-table thead input[type="checkbox"]', function() {
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
        url: `/accounting/vendors/${vendorId}/categorize-transactions/${$('#category-id').val()}`,
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

    $('#transactions-table').parent().parent().append('<form id="print-transactions-form" action="/accounting/vendors/print-multiple-transactions" method="post" class="d-none" target="_blank"></form>');

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

$(document).on('click', '#transactions-table .view-attachment', function(e) {
    e.preventDefault();
    var data = e.currentTarget.dataset;

    window.open(data.href, "_blank");
});

$(document).on('click', '#vendor-details.tab-pane .attachments-container #show-existing-attachments', function() {
    $.get('/accounting/get-existing-attachments-modal/vendor', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#existing-attachments-modal #attachment-types').select2({
            minimumResultsForSearch: -1
        });

        $('#existing-attachments-modal #attachment-types').trigger('change');

        $('#existing-attachments-modal').modal({
            backdrop: false
        });
    });
});

$(document).on('click', '#existing-attachments-modal .attachments-container a.add-attachment', function(e) {
    e.preventDefault();
    var id = e.currentTarget.dataset.id;

    $.get('/accounting/get-attachment/'+id, function(res) {
        var attachment = JSON.parse(res);

        attachmentId.push(attachment.id);
        var mockFile = {
            name: `${attachment.uploaded_name}.${attachment.file_extension}`,
            size: parseInt(attachment.size),
            dataURL: base_url+"uploads/accounting/attachments/" + attachment.stored_name,
            accepted: true
        };
        previewAttachments.emit("addedfile", mockFile);
        attachedFiles.push(mockFile);

        previewAttachments.createThumbnailFromUrl(mockFile, previewAttachments.options.thumbnailWidth, previewAttachments.options.thumbnailHeight, previewAttachments.options.thumbnailMethod, true, function(thumbnail) {
            previewAttachments.emit('thumbnail', mockFile, thumbnail);
        });
        previewAttachments.emit("complete", mockFile);
    });

    var data = new FormData();
    data.set('id', id);
    $.ajax({
        url: '/accounting/attach/vendor/'+vendorId,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            
        }
    })
});

$(document).on('click', 'button.edit-vendor', function() {
    $.get(`/accounting/vendors/${vendorId}/edit`, function(res) {
        if($('.append-modal #edit-vendor-modal').length > 0) {
            $('.append-modal #edit-vendor-modal').remove();
        }
        $('.append-modal').prepend(res);

        $('#edit-vendor-modal .datepicker').datepicker({
            uiLibrary: 'bootstrap',
            todayBtn: "linked",
            language: "de"
        });

        $('#edit-vendor-modal #terms').select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'term'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });

        $('#edit-vendor-modal #expense_account').select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'vendor-expense-account'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });

        var attachments = new Dropzone('#vendorAttachments', {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            addRemoveLinks: true,
            init: function() {
                $.getJSON('/accounting/get-linked-attachments/vendor/'+vendorId, function(data) {
                    if(data.length > 0) {
                        $.each(data, function(index, val) {
                            // attachmentId.push(val.id);
                            var mockFile = {
                                name: `${val.uploaded_name}.${val.file_extension}`,
                                size: parseInt(val.size),
                                dataURL: base_url+"uploads/accounting/attachments/" + val.stored_name,
                                // size: val.size / 1000000,
                                accepted: true
                            };
                            attachments.emit("addedfile", mockFile);
                            // attachedFiles.push(mockFile);
        
                            attachments.createThumbnailFromUrl(mockFile, attachments.options.thumbnailWidth, attachments.options.thumbnailHeight, attachments.options.thumbnailMethod, true, function(thumbnail) {
                                attachments.emit('thumbnail', mockFile, thumbnail);
                            });
                            attachments.emit("complete", mockFile);
                        });
                    }
                });
        
                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    for(i in ids) {
                        if($('#edit-vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                            $('#edit-vendor-modal #vendorAttachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                        }
        
                        attachmentId.push(ids[i]);
                    }
                    attachedFiles.push(file);
                });
            },
            removedfile: function(file) {
                var ids = attachmentId;
                var index = attachedFiles.map(function(d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];
        
                $('#edit-vendor-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();
        
                //remove thumbnail
                var previewElement;
        
                if((previewElement = file.previewElement) !== null) {
                    var remove = (previewElement.parentNode.removeChild(file.previewElement));
        
                    if($('#vendorAttachments .dz-preview').length > 0) {
                        $('#vendorAttachments .dz-message').hide();
                    } else {
                        $('#vendorAttachments .dz-message').show();
                    }
        
                    return remove;
                } else {
                    return (void 0);
                }
            }
        });

        $('#edit-vendor-modal').modal('show');
    });
});

$(document).on('click', '#print-transactions', function(e) {
    e.preventDefault();

    var data = new FormData();

    data.set('type', $('#template-type').val());
    data.set('date', $('#date').val());

    data.set('chk_type', $('#type_chk').prop('checked') ? 1 : 0);
    data.set('chk_number', $('#number_chk').prop('checked') ? 1 : 0);
    data.set('chk_payee', $('#payee_chk').prop('checked') ? 1 : 0);
    data.set('chk_method', $('#method_chk').prop('checked') ? 1 : 0);
    data.set('chk_source', $('#source_chk').prop('checked') ? 1 : 0);
    data.set('chk_category', $('#category_chk').prop('checked') ? 1 : 0);
    data.set('chk_memo', $('#memo_chk').prop('checked') ? 1 : 0);
    data.set('chk_due_date', $('#due_date_chk').prop('checked') ? 1 : 0);
    data.set('chk_balance', $('#balance_chk').prop('checked') ? 1 : 0);
    data.set('chk_status', $('#status_chk').prop('checked') ? 1 : 0);
    data.set('chk_attachments', $('#attachments_chk').prop('checked') ? 1 : 0);

    var tableOrder = $('#transactions-table').DataTable().order();
    data.set('column', columns[tableOrder[0][0]].name);
    data.set('order', tableOrder[0][1]);

    $.ajax({
        url: `/accounting/vendors/${vendorId}/print-transactions`,
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

$(document).on('click', '#export-vendor-transactions', function(e) {
    e.preventDefault();

    $('#export-transactions-form').append(`<input type="hidden" name="type" value="${$('#template-type').val()}">`);
    $('#export-transactions-form').append(`<input type="hidden" name="date" value="${$('#date').val()}">`);

    var fields = $('#myTabContent .action-bar .dropdown-menu input[type="checkbox"]:checked');
    fields.each(function() {
        if($(this).attr('id').includes('_chk')) {
            $('#export-transactions-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('_chk', '')}">`);
        }
    });

    var tableOrder = $('#transactions-table').DataTable().order();
    $('#export-transactions-form').append(`<input type="hidden" name="column" value="${columns[tableOrder[0][0]].name}">`);
    $('#export-transactions-form').append(`<input type="hidden" name="order" value="${tableOrder[0][1]}">`);

    $('#export-transactions-form').submit();
})

$('#export-transactions-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).find('input').remove();
});