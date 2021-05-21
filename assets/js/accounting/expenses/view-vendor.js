const vendorId = $('#vendor-id[type="hidden"]').val();

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
var attachments = new Dropzone('#vendorAttachments', {
    url: '/accounting/attachments/attach',
    maxFilesize: 20,
    uploadMultiple: true,
    // maxFiles: 1,
    addRemoveLinks: true,
    init: function() {
        $.getJSON('/accounting/vendors/get-vendor-attachments/'+vendorId, function(data) {
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
                    attachments.emit("addedfile", mockFile);
                    attachedFiles.push(mockFile);

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

var previewAttachments = new Dropzone('#previewVendorAttachments', {
    url: '/accounting/vendors/update-attachments/'+vendorId,
    maxFilesize: 20,
    uploadMultiple: true,
    addRemoveLinks: true,
    init: function() {
        $.getJSON('/accounting/vendors/get-vendor-attachments/'+vendorId, function(data) {
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
    $('#edit-vendor-modal').modal('show');
});

$('select').select2();

$('.dropdown-menu').on('click', function(e) {
	e.stopPropagation();
});

$('#transactions-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: 150,
    order: [[1, 'asc']],
    ajax: {
        url: `/accounting/vendors/${vendorId}/load-transactions`,
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.date = $('#date').val();
            d.type = $('#template-type').val();
            d.inactive = $('#inc_inactive').prop('checked');
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: [
        {
			data: null,
			name: 'checkbox',
            orderable: false,
			fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`<input type="checkbox" value="${rowData.id}">`);
                $(td).css('padding', '10px 18px');
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
                if($('#category_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }

                $(td).addClass('category');

                $(td).html(cellData);

                if($(td).find('select').length > 0) {
                    $(td).find('select').select2();
                }
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
                if($('#balance_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }

                $(td).addClass('balance');
            }
        },
        {
            name: 'total',
            data: 'total'
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
                if($('#attachments_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }

                $(td).addClass('attachments');
            }
        },
        {
            orderable: false,
            name: 'action',
            data: null,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                switch (rowData.type) {
                    case 'Expense' :
                        $(td).html(`
                        <div class="btn-group float-right">
                            <button class="btn d-flex align-items-center justify-content-center text-info">
                                View/Edit
                            </button>

                            <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                <a class="dropdown-item" href="#">Print</a>
                                <a class="dropdown-item" href="#">Copy</a>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Void</a>
                            </div>
                        </div>
                        `);
                    break;
                    case 'Check' :
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
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Void</a>
                            </div>
                        </div>
                        `);
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
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
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

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">Copy to bill</a>
                                    <a class="dropdown-item" href="#">Print</a>
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        } else {
                            $(td).html(`
                            <div class="btn-group float-right">
                                <button class="btn d-flex align-items-center justify-content-center text-info">
                                    Print
                                </button>

                                <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                    <a class="dropdown-item" href="#">View/Edit</a>
                                    <a class="dropdown-item" href="#">Copy</a>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </div>
                            </div>
                            `);
                        }
                    break;
                    case 'Vendor Credit' :
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
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </div>
                        </div>
                        `);
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
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Void</a>
                            </div>
                        </div>
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

    $('#new-popup #accounting_employees .ajax-single_time_activity_modal').trigger('click');
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

        $('#billModal #vendor').val(vendorId).trigger('change');

        rowCount = 2;
        catDetailsInputs = $(`#billModal table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#billModal table#category-details-table tbody tr:nth-child(2)`).html();
        $(`#billModal table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
        $(`#billModal table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);

        $(`#billModal select`).select2();

        $('div#billModal select#tags').select2({
            placeholder: 'Start typing to add a tag',
            allowClear: true,
            ajax: {
                url: '/accounting/get-job-tags',
                dataType: 'json'
            }
        });

        $(`#billModal .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });

        var attachmentContId = $(`#billModal .attachments .dropzone`).attr('id');
        var attachments = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#billModal`);

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

                $(`#billModal .attachments`).find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

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

        $('#expenseModal #payee').val('vendor-'+vendorId);

        rowCount = 2;
        catDetailsInputs = $(`#expenseModal table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#expenseModal table#category-details-table tbody tr:nth-child(2)`).html();
        $(`#expenseModal table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
        $(`#expenseModal table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);

        $(`#expenseModal select`).select2();

        $('div#expenseModal select#tags').select2({
            placeholder: 'Start typing to add a tag',
            allowClear: true,
            ajax: {
                url: '/accounting/get-job-tags',
                dataType: 'json'
            }
        });

        $(`#expenseModal .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });

        var attachmentContId = $(`#expenseModal .attachments .dropzone`).attr('id');
        var attachments = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#expenseModal`);

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

                $(`#expenseModal .attachments`).find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

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

        $('#checkModal #payee').val('vendor-'+vendorId).trigger('change');

        rowCount = 2;
        catDetailsInputs = $(`#checkModal table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#checkModal table#category-details-table tbody tr:nth-child(2)`).html();
        $(`#checkModal table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
        $(`#checkModal table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);

        $(`#checkModal select`).select2();

        $('div#checkModal select#tags').select2({
            placeholder: 'Start typing to add a tag',
            allowClear: true,
            ajax: {
                url: '/accounting/get-job-tags',
                dataType: 'json'
            }
        });

        $(`#checkModal .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });

        var attachmentContId = $(`#checkModal .attachments .dropzone`).attr('id');
        var attachments = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#checkModal`);

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

                $(`#checkModal .attachments`).find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

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

        $('#purchaseOrderModal #vendor').val(vendorId).trigger('change');

        rowCount = 2;
        catDetailsInputs = $(`#purchaseOrderModal table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#purchaseOrderModal table#category-details-table tbody tr:nth-child(2)`).html();
        $(`#purchaseOrderModal table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
        $(`#purchaseOrderModal table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);

        $(`#purchaseOrderModal select`).select2();

        $('div#purchaseOrderModal select#tags').select2({
            placeholder: 'Start typing to add a tag',
            allowClear: true,
            ajax: {
                url: '/accounting/get-job-tags',
                dataType: 'json'
            }
        });

        $(`#purchaseOrderModal .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });

        var attachmentContId = $(`#purchaseOrderModal .attachments .dropzone`).attr('id');
        var attachments = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#purchaseOrderModal`);

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

                $(`#purchaseOrderModal .attachments`).find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

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

        $('#vendorCreditModal #vendor').val(vendorId).trigger('change');

        rowCount = 2;
        catDetailsInputs = $(`#vendorCreditModal table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#vendorCreditModal table#category-details-table tbody tr:nth-child(2)`).html();
        $(`#vendorCreditModal table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
        $(`#vendorCreditModal table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);

        $(`#vendorCreditModal select`).select2();

        $('div#vendorCreditModal select#tags').select2({
            placeholder: 'Start typing to add a tag',
            allowClear: true,
            ajax: {
                url: '/accounting/get-job-tags',
                dataType: 'json'
            }
        });

        $(`#vendorCreditModal .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });

        var attachmentContId = $(`#vendorCreditModal .attachments .dropzone`).attr('id');
        var attachments = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#vendorCreditModal`);

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

                $(`#vendorCreditModal .attachments`).find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

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

        $('#payDownCreditModal #payee').val(vendorId);

        $(`#payDownCreditModal select`).select2();

        $(`#payDownCreditModal .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });

        var attachmentContId = $(`#payDownCreditModal .attachments .dropzone`).attr('id');
        var attachments = new Dropzone(`#${attachmentContId}`, {
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

                $(`#payDownCreditModal .attachments`).find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

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
        }
    });
});

$(document).on('click', '#transactions-table a.delete-transaction', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var transactionType = data.type;
    transactionType = transactionType.replace(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.ajax({
        url: `/accounting/vendors/delete-transaction/${transactionType}/${data.id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });
});