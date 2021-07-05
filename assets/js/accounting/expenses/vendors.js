$('#address_chk, #attachments_chk, #phone_chk, #email_chk').on('change', function() {
    var elementId = $(this).attr('id');
    var column = elementId.replace('_chk', '');

    if($(this).prop('checked')) {
        $(`#vendors-table .${column}`).removeClass('hide');
    } else {
        $(`#vendors-table .${column}`).addClass('hide');
    }
});

$(document).on('click', '#vendors-table tbody tr td:not(:first-child,:last-child)', function() {
    var data = table.row($(this).parent()).data();
    
    window.location.href = '/accounting/vendors/view/'+data.id;
});

$(document).on('change', '#new-vendor-modal #use_display_name', function() {
    if($(this).prop('checked')) {
        $('#new-vendor-modal #print_on_check_name').prop('disabled', true);
    } else {
        $('#new-vendor-modal #print_on_check_name').prop('disabled', false);
    }
});

$('.datepicker').datepicker({
    uiLibrary: 'bootstrap',
    todayBtn: "linked",
    language: "de"
});

$('select').select2();

var attachmentId = [];
var attachedFiles = [];
var attachments = new Dropzone('#vendorAttachments', {
    url: '/accounting/attachments/attach',
    maxFilesize: 20,
    uploadMultiple: true,
    // maxFiles: 1,
    addRemoveLinks: true,
    init: function() {
        this.on("success", function(file, response) {
            var ids = JSON.parse(response)['attachment_ids'];
            for(i in ids) {
                if($('#new-vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                    $('#new-vendor-modal #vendorAttachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
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

        $('#new-vendor-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

        //remove thumbnail
        var previewElement;
        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
    }
});

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

            $('#payment_term_modal').modal('hide');
        }
    });
});

$(document).on('click', '.action-bar .dropdown-menu', function(e) {
    e.stopPropagation();
});

$(document).on('keyup', '#search', function() {
    table.ajax.reload();
});

$(document).on('change', '#inc_inactive, #table_rows', function() {
    table.ajax.reload();
});

$(document).on('change', '#vendors-table #select-all-vendors', function() {
    if($(this).prop('checked')) {
        $('#vendors-table tbody input[type="checkbox"]').prop('checked', true);
    } else {
        $('#vendors-table tbody input[type="checkbox"]').prop('checked', false);
    }

    $('#vendors-table tbody input[type="checkbox"]').trigger('change');
});

$(document).on('change', '#vendors-table tbody input[type="checkbox"]', function() {
    var flag = true;
    var href = 'mailto:'

    $('#vendors-table tbody input[type="checkbox"]').each(function() {
        var row = $(this).parent().parent();
        var rowData = table.row(row).data();

        if($(this).prop('checked') === false) {
            flag = false;
        } else {
            href += ' '+rowData.email+',';
        }
    });

    $('#email-vendor').attr('href', href);

    $('#vendors-table #select-all-vendors').prop('checked', flag);
});

$(document).on('click', '#make-inactive', function(e) {
    e.preventDefault();

    var data = new FormData();

    var count = 1;
    $('#vendors-table tbody input[type="checkbox"]').each(function() {
        if($(this).prop('checked')) {
            if(count === 1) {
                data.set('vendors[]', $(this).val());
            } else {
                data.append('vendors[]', $(this).val());
            }

            count++;
        }
    });

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

var table = $('#vendors-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: $('#table_rows').val(),
    order: [[1, 'asc']],
    ajax: {
        url: 'vendors/load/',
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.inactive = $('#inc_inactive').prop('checked') === true ? 1 : 0;
            d.length = $('#table_rows').val();
            d.columns[0].search.value = $('input#search').val();
            d.transaction = $('.selected').attr('id');
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
                $(td).html(`<input type="checkbox" value="${rowData.id}">`);
			}
		},
        {
            data: 'name',
            name: 'name',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`<a href="/accounting/vendors/view/${rowData.id}">${cellData}</a>`);

                if(rowData.company_name !== "" && rowData.company_name !== null) {
                    $(td).append(`<p class="m-0 text-muted">${rowData.company_name}</p>`);
                }
            }
        },
        {
            data: 'address',
            name: 'address',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('address');
                if($('#address_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'phone',
            name: 'phone',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('phone');
                if($('#phone_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'email',
            name: 'email',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('email');
                if($('#email_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'attachments',
            name: 'attachments',
            orderable: false,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('attachments');
                if($('#attachments_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'open_balance',
            name: 'open_balance'
        },
        {
            orderable: false,
			data: null,
			name: 'action',
			fnCreatedCell: function(td, cellData, rowData,row, col) {
                $(td).html(`
                <div class="btn-group float-right">
                    <button class="btn d-flex align-items-center justify-content-center text-info create-bill">
                        Create bill
                    </button>

                    <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                        <a class="dropdown-item create-expense" href="#">Create expense</a>
                        <a class="dropdown-item write-check" href="#">Write check</a>
                        <a class="dropdown-item create-purchase-order" href="#">Create purchase order</a>
                        <a class="dropdown-item make-inactive" href="#">Make inactive</a>
                    </div>
                </div>
                `);
            }
        }
    ]
});

$(document).on('click', '#vendors-table .create-bill', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent();
    var data = table.row(row).data();

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

        $('#billModal #vendor').val(data.id).trigger('change');

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
        var billAttachments = new Dropzone(`#${attachmentContId}`, {
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

$(document).on('click', '#vendors-table .create-expense', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = table.row(row).data();

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

        $('#expenseModal #payee').val('vendor-'+data.id);

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
        var expenseAttachments = new Dropzone(`#${attachmentContId}`, {
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

$(document).on('click', '#vendors-table .write-check', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = table.row(row).data();

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

        $('#checkModal #payee').val('vendor-'+data.id).trigger('change');

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
        var checkAttachments = new Dropzone(`#${attachmentContId}`, {
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

$(document).on('click', '#vendors-table .create-purchase-order', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = table.row(row).data();

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

        $('#purchaseOrderModal #vendor').val(data.id).trigger('change');

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
        var poAttachments = new Dropzone(`#${attachmentContId}`, {
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

$(document).on('click', '#vendors-table .make-inactive', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var rowData = table.row(row).data();
    var data = new FormData();
    data.set('vendors[]', rowData.id);

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

$(document).on('click', '#pay-bills', function(e) {
    e.preventDefault();

    $('#new-popup ul#accounting_vendors li a[data-view="pay_bills_modal"]').trigger('click');
});

$(document).on('click', '.open-purchase-orders-cont, .overdue-bills, .open-bills, .payments-cont', function() {
    var selected = $(this).hasClass('selected');
    $('.open-purchase-orders-cont.selected, .overdue-bills.selected, .open-bills.selected, .payments-cont.selected').removeClass('selected');
    if(selected) {
        $(this).removeClass('selected');
    } else {
        $(this).addClass('selected');
    }
    $('#vendors-table').DataTable().ajax.reload(null, true);
});