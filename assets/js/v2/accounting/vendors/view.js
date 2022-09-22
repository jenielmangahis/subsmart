const currUrl = window.location.href;
const urlSplit = currUrl.split('/');
const vendorId = urlSplit[urlSplit.length - 1];
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

$('.dropdown-menu.table-settings').on('click', function(e) {
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