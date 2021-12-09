function col(el) {
    var className = $(el).attr('id');
    className = className.replace('col_', '');

    if($(el).prop('checked') === true) {
        $(`#attachments_table .${className}`).show();
    } else {
        $(`#attachments_table .${className}`).hide();
    }
}

$(function(){
    var atttachments = new Dropzone('#attachments', {
        url: '/accounting/attachments/upload',
        maxFilesize: 20,
        uploadMultiple: true,
        addRemoveLinks: true,
        init: function() {
            this.on("success", function(file, response) {
                location.reload();
            });
        }
    });

    $('.date_picker input').datepicker({
        format: "dd.mm.yyyy",
        todayBtn: "linked",
        language: "de"
    });

    $('#table_rows').on('change', function() {
        table.ajax.reload();
    });

    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });

    $('#table_rows').select2({
        minimumResultsForSearch: -1
    });

    var table = $('#attachments_table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        pageLength: $('#table_rows').val(),
        ordering: false,
        info: false,
        ajax: {
            url: 'attachments/load-attachments/',
            dataType: 'json',
            contentType: 'application/json', 
            type: 'POST',
            data: function(d) {
                d.length = $('#table_rows').val();
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers',
        },
        columns: [
            {
                data: null,
                name: 'checkbox',
                fnCreatedCell: function (td, cellData, rowData, row, col) {
                    $(td).html(`
                    <div class="d-flex justify-content-center">
                        <div class="checkbox checkbox-sec m-0">
                            <input type="checkbox" value="${rowData.id}" id="select-${rowData.id}">
                            <label for="select-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                        </div>
                    </div>
                    `);
                }
            },
            {
                data: 'thumbnail',
                name: 'thumbnail',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(rowData.type === 'Image') {
                        $(td).html(`<img src="/uploads/accounting/attachments/${cellData}">`);
                    } else {
                        $(td).html(`No preview available`);
                    }
                }
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'size',
                name: 'size',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('size');
                }
            },
            {
                data: 'upload_date',
                name: 'upload_date',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('uploaded');
                }
            },
            {
                data: 'links',
                name: 'links',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html('');

                    if(cellData.length > 0) {
                        for(i in cellData) {
                            $(td).append(cellData[i].text);
                        }
                    }
                }
            },
            {
                data: 'note',
                name: 'note',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('note');
                }
            },
            {
                data: null,
                name: 'action',
                fnCreatedCell: function (td, cellData, rowData, row, col) {
                    $(td).html(`
                    <div class="btn-group float-center">
                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit-attachment" href="#" data-type="${rowData.type}" data-name="${rowData.name}" data-notes="${rowData.notes}" data-id="${rowData.id}" data-file="${rowData.thumbnail}">Edit</a>
                            <a class="dropdown-item delete-attachment" href="#">Delete</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addinvoiceModal">Create invoice</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#expense-modal">Create expense</a>
                        </div>
                    </div>
                    `);

                    if(rowData.type === 'Image' || rowData.type === 'Pdf') {
                        $(td).children().prepend(`<a href="/uploads/accounting/attachments/${rowData.thumbnail}" target="__blank" class="btn text-info d-flex align-items-center justify-content-center download-attachment">Download</a>`);
                    } else {
                        $(td).children().prepend(`<a href="/accounting/attachments/download?filename=${rowData.thumbnail}" target="__blank" class="btn text-info d-flex align-items-center justify-content-center download-attachment">Download</a>`);
                    }
                }
            }
        ]
    });

    $(document).on('click', '#attachments_table a.delete-attachment', function(e) {
        e.preventDefault();

        var row = $(this).parent().parent().parent().parent();
        var rowData = table.row(row).data();

        Swal.fire({
            title: 'Are you sure?',
            html: `You want to make <b>${rowData.name}.${rowData.extension}</b> active?`,
            icon: 'warning',
            showCloseButton: false,
            confirmButtonColor: '#2ca01c',
            confirmButtonText: 'Yes',
            showCancelButton: true,
            cancelButtonText: 'No',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: `/accounting/attachments/delete/${rowData.id}`,
                    type:"DELETE",
                    success:function (result) {
                        location.reload();
                    }
                });
            }
        });
    });

    $(document).on('click', '#attachments_table a.edit-attachment', function(e) {
        e.preventDefault();

        var data = e.currentTarget.dataset;

        $('#edit_attachment #file_name').val(data.name);

        if(data.notes !== "undefined" && data.notes !== "") {
            $('#edit_attachment #notes').val(data.notes);
        }

        var preview = '';
        if(data.type === 'Image') {
            preview = `<img src="/uploads/accounting/attachments/${data.file}">`;
        } else if(data.type === 'Pdf') {
            preview = `<iframe src="/uploads/accounting/attachments/${data.file}" class="w-100 h-100"></iframe>`;
        }

        $('#edit_attachment .file-preview').html(preview);

        $('#edit_attachment form').prop('action', '/accounting/attachments/update/'+data.id);

        $('#edit_attachment').modal('show');
    });

    $('#attachments').on('change', function() {
        var data = new FormData(document.getElementById('attachments-form'));

        $.ajax({
            url: '/accounting/attachments/upload',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#attachments_table tbody tr a.view-linked-expense', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Expense'
        };

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

    $(document).on('click', '#attachments_table tbody tr a.view-linked-check', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Check'
        };

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

    $(document).on('click', '#attachments_table tbody tr a.view-linked-bill', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Bill'
        };

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

    $(document).on('click', '#attachments_table tbody tr a.view-linked-bill-payment', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Bill Payment'
        };

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
    });

    $(document).on('click', '#attachments_table tbody tr a.view-linked-purchase-order', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Purchase Order'
        };

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

    $(document).on('click', '#attachments_table tbody tr a.view-linked-vendor-credit', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Vendor Credit'
        };

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

    $(document).on('click', '#attachments_table tbody tr a.view-linked-cc-credit', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Credit Card Credit'
        };

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
    });

    $(document).on('click', '#attachments_table tbody tr a.view-linked-cc-payment', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Credit Card Payment'
        };

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

    $(document).on('click', '#attachments_table tbody tr a.view-linked-deposit', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Deposit'
        };

        $.get('/accounting/view-transaction/deposit/'+data.id, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }
    
            rowCount = 8;
            rowInputs = $('#depositModal table tbody tr:first-child()').html();
            blankRow = $('#depositModal table tbody tr:last-child()').html();

            $('#depositModal table.clickable tbody tr:first-child()').remove();
            $('#depositModal table tbody tr:last-child()').remove();

            initModalFields('depositModal', data);

            $('#depositModal').modal('show');
        });
    });

    $(document).on('click', '#attachments_table tbody tr a.view-linked-transfer', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Transfer'
        };

        $.get('/accounting/view-transaction/transfer/'+data.id, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }
    
            initModalFields('transferModal', data);

            $('#transferModal #transfer_from_account').trigger('change');
            $('#transferModal #transfer_to_account').trigger('change');

            $('#transferModal').modal('show');
        });
    });

    $(document).on('click', '#attachments_table tbody tr a.view-linked-journal', function(e) {
        e.preventDefault();
        var data = {
            id: e.currentTarget.dataset.id,
            type: 'Journal'
        };

        $.get('/accounting/view-transaction/journal/'+data.id, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }
    
            rowCount = 8;
            rowInputs = $('#journalEntryModal table tbody tr:first-child()').html();
            blankRow = $('#journalEntryModal table tbody tr:last-child()').html();

            $('#journalEntryModal table.clickable tbody tr:first-child()').remove();
            $('#journalEntryModal table tbody tr:last-child()').remove();

            initModalFields('journalEntryModal', data);

            $('#journalEntryModal').modal('show');
        });
    });

    $(document).on('click', '#print-attachments', function(e) {
        e.preventDefault();

        var data = new FormData();

        data.set('size', $('#col_size').prop('checked') ? 1 : 0);
        data.set('uploaded', $('#col_uploaded').prop('checked') ? 1 : 0);
        data.set('notes', $('#col_note').prop('checked') ? 1 : 0);

        $.ajax({
            url: '/accounting/attachments/print-attachments',
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

    $(document).on('change', '#attachments_table thead #select-all-attachments', function() {
        $('#attachments_table tbody input[type="checkbox"]').prop('checked', $(this).prop('checked'));

        if($(this).prop('checked')) {
            $('#attachment-actions').next().children('a.dropdown-item').removeClass('disabled');
        } else {
            $('#attachment-actions').next().children('a.dropdown-item').addClass('disabled');
        }
    });

    $(document).on('change', '#attachments_table tbody input[type="checkbox"]', function() {
        var flag = true;

        $('#attachments_table tbody input[type="checkbox"]').each(function() {
            if($(this).prop('checked') === false) { 
                flag = false;
            }
        });

        $('#attachments_table thead #select-all-attachments').prop('checked', flag);

        if($('#attachments_table tbody input[type="checkbox"]:checked').length > 0) {
            $('#attachment-actions').next().children('a.dropdown-item').removeClass('disabled');
        } else {
            $('#attachment-actions').next().children('a.dropdown-item').addClass('disabled');
        }
    });

    $('#create-expense').on('click', function(e) {
        e.preventDefault();
        var selected = $('#attachments_table tbody input[type="checkbox"]:checked');

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

            initModalFields('expenseModal');

            selected.each(function() {
                var row = $(this).parent().parent().parent().parent();
                var rowData = $('#attachments_table').DataTable().row(row).data();

                $(`#expenseModal`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${rowData.id}">`);

                modalAttachmentId.push(rowData.id);
                var mockFile = {
                    name: `${rowData.name}.${rowData.extension}`,
                    size: parseInt(rowData.size),
                    dataURL: base_url+"uploads/accounting/attachments/" + rowData.thumbnail,
                    accepted: true
                };
                modalAttachments.emit("addedfile", mockFile);
                modalAttachedFiles.push(mockFile);

                modalAttachments.createThumbnailFromUrl(mockFile, modalAttachments.options.thumbnailWidth, modalAttachments.options.thumbnailHeight, modalAttachments.options.thumbnailMethod, true, function(thumbnail) {
                    modalAttachments.emit('thumbnail', mockFile, thumbnail);
                });
                modalAttachments.emit("complete", mockFile);
            });

            $('#expenseModal').modal('show');
        });
    });

    $('#export-attachments').on('click', function(e) {
        e.preventDefault();
        var selected = $('#attachments_table tbody input[type="checkbox"]:checked');
        selected.each(function() {
            $('#export-form').append(`<input type="hidden" name="ids[]" value="${$(this).val()}">`);
        });
        
        $('#export-form').submit();
    });

    $('#export-form').on('submit', function(e) {
        e.preventDefault();
        this.submit();
        $(this).html('');
    });
});