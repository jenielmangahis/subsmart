const currUrl = window.location.href;
const urlSplit = currUrl.split('/');
const vendorId = urlSplit[urlSplit.length - 1].includes('?') ? urlSplit[urlSplit.length - 1].split('?')[0].replace('#', '') : urlSplit[urlSplit.length - 1].replace('#', '');
const vendorName = $('span#vendor-display-name').html();

var attachmentId = [];
var attachedFiles = [];
Dropzone.autoDiscover = false;
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

$("#transactions-table").nsmPagination({
    itemsPerPage: 50
});

$('#filter-type, #filter-date').select2({
    minimumResultsForSearch: -1
});

$('.dropdown-menu.table-settings, .dropdown-menu.p-3').on('click', function(e) {
    e.stopPropagation();
});

$('.edit-vendor, .notes-container').on('click', function(e) {
    e.preventDefault();

    $.get(`/accounting/vendors/${vendorId}/edit`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#modal-container #vendor-modal select').each(function() {
            var select = $(this);
            if(select.attr('id') === 'term' || select.attr('id') === 'expense_account') {
                select.select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: select.attr('id').replace('_', '-'),
                                modal: 'vendor-modal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    placeholder: select.attr('id') === 'expense_account' ? "Choose Account" : '',
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#modal-container #vendor-modal')
                });
            } else {
                select.select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#modal-container #vendor-modal')
                });
            }
        });

        $('#modal-container #vendor-modal .date').datepicker({
            format: 'mm/dd/yyyy',
            orientation: 'bottom',
            autoclose: true
        });

        var attachments = new Dropzone('#vendAtt', {
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

        $('#vendor-modal').modal('show');
    });
});

$('#make-inactive').on('click', function(e) {
    e.preventDefault();

    var data = new FormData();
    data.set('vendors[]', vendorId);

    $.ajax({
        url: '/accounting/vendors/make-inactive',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('#make-active').on('click', function(e) {
    e.preventDefault();

    var data = new FormData();
    data.set('vendors[]', vendorId);

    $.ajax({
        url: '/accounting/vendors/make-active',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

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

        initModalFields('singleTimeModal');

        $('#singleTimeModal').modal('show');
    });
});

$('#new-bill').on('click', function(e) {
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

$('#new-expense').on('click', function(e) {
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

$('#new-check').on('click', function(e) {
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

$('#new-purchase-order').on('click', function(e) {
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

$('#new-vendor-credit').on('click', function(e) {
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

$('#new-cc-payment').on('click', function(e) {
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

        initModalFields('payDownCreditModal');

        $('#payDownCreditModal').modal('show');
    });
});

$('#show-existing-attachments').on('click', function(e) {
    e.preventDefault();

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
            minimumResultsForSearch: -1,
            dropdownParent: $('#existing-attachments-modal')
        });

        $('#existing-attachments-modal #attachment-types').trigger('change');

        $('#existing-attachments-modal').modal('show');
    });
});

$(document).on('click', '#existing-attachments-modal .add-attachment', function(e) {
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
            $('#existing-attachments-modal #attachment-types').trigger('change');
        }
    })
});

$('#transactions-table tbody select[name="expense_account[]"]').each(function() {
    $(this).select2({
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
});

$('#apply-button').on('click', function() {
    var filterType = $('#filter-type').val();
    var filterDate = $('#filter-date').val();

    var url = `${base_url}accounting/vendors/view/${vendorId}?`;

    url += filterType !== 'all' ? `type=${filterType}&` : '';
    url += filterDate !== 'all' ? `date=${filterDate}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&') {
        url = url.slice(0, -1); 
    }
    location.href = url;
});

$('#reset-button').on('click', function() {
    location.href = `${base_url}accounting/vendors/view/${vendorId}`;
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#transactions-table thead td[data-name="${dataName}"]`).index();
    $(`#transactions-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_vendor_transactions_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_vendor_transactions_modal #vendor_transactions_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_vendor_transactions").on("click", function() {
    $("#vendor_transactions_table_print").printThis();
});