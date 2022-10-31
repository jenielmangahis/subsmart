$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$("#attachments-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#attachments-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#attachments-table thead td[data-name="${dataName}"]`).index();
    $(`#attachments-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_attachments_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_attachments_modal #attachments_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_attachments").on("click", function() {
    $("#attachments_table_print").printThis();
});

$('#attachments-table .select-all').on('change', function() {
    if($(this).prop('checked')) {
        $('#attachments-table tbody input.select-one').prop('checked', true);

        var checked = $('#attachments-table tbody tr:visible input.select-one:checked');
        if(checked.length > 0) {
            $('.dropdown-menu.batch-actions li a.dropdown-item').removeClass('disabled');
        } else {
            $('.dropdown-menu.batch-actions li a.dropdown-item').addClass('disabled');
        }
    } else {
        $('#attachments-table tbody input.select-one').prop('checked', false);
        $('.dropdown-menu.batch-actions li a.dropdown-item').addClass('disabled');
    }
});

$('#attachments-table .select-one').on('change', function() {
    var checked = $('#attachments-table tbody tr:visible input.select-one:checked');
    var totalrows = $('#attachments-table tbody tr:visible input.select-one').length;

    $('#attachments-table .select-all').prop('checked', checked.length === totalrows);

    if(checked.length > 0) {
        $('.dropdown-menu.batch-actions li a.dropdown-item').removeClass('disabled');
    } else {
        $('.dropdown-menu.batch-actions li a.dropdown-item').addClass('disabled');
    }
});

$('#attachments-table .edit-attachment').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $('#edit-attachment-modal #file_name').val(row.find('td:nth-child(4)').text().trim());
    $('#edit-attachment-modal #notes').val(row.find('td:nth-child(8)').text().trim());

    var preview = '';
    if(row.find('td:nth-child(3)').text().trim() === 'Image') {
        preview = `<img src="/uploads/accounting/attachments/${row.data().file}">`;
    } else if(row.find('td:nth-child(3)').text().trim() === 'Pdf') {
        preview = `<iframe src="/uploads/accounting/attachments/${row.data().file}" class="w-100 h-100"></iframe>`;
    }

    $('#edit-attachment-modal .file-preview').html(preview);

    $('#edit-attachment-modal form').prop('action', '/accounting/attachments/update/'+row.find('.select-one').val());

    $('#edit-attachment-modal').modal('show');
});

$('#attachments-table .delete-attachment').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    Swal.fire({
        title: 'Are you sure?',
        html: `Are you sure you want to delete the attachment?`,
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
                url: `/accounting/attachments/delete/${row.find('.select-one').val()}`,
                type:"DELETE",
                success:function (result) {
                    location.reload();
                }
            });
        }
    });
});

$('#create-expense').on('click', function(e) {
    e.preventDefault();
    var selected = $('#attachments-table tbody input.select-one:checked');

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
            var row = $(this).closest('tr');

            $(`#expenseModal`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${$(this).val()}">`);

            modalAttachmentId.push($(this).val());
            var mockFile = {
                name: `${row.find('td:nth-child(4)').text().trim()}.${row.data().extension}`,
                size: parseInt(row.find('td:nth-child(5)').text().trim()),
                dataURL: base_url+"uploads/accounting/attachments/" + row.data().file,
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

$('#create-invoice').on('click', function(e) {
    e.preventDefault();
    var selected = $('#attachments-table tbody input.select-one:checked');

    $.get('/accounting/get-other-modals/invoice_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('invoiceModal');

        selected.each(function() {
            var row = $(this).closest('tr');

            $(`#invoiceModal`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${$(this).val()}">`);

            modalAttachmentId.push($(this).val());
            var mockFile = {
                name: `${row.find('td:nth-child(4)').text().trim()}.${row.data().extension}`,
                size: parseInt(row.find('td:nth-child(5)').text().trim()),
                dataURL: base_url+"uploads/accounting/attachments/" + row.data().file,
                accepted: true
            };
            modalAttachments.emit("addedfile", mockFile);
            modalAttachedFiles.push(mockFile);

            modalAttachments.createThumbnailFromUrl(mockFile, modalAttachments.options.thumbnailWidth, modalAttachments.options.thumbnailHeight, modalAttachments.options.thumbnailMethod, true, function(thumbnail) {
                modalAttachments.emit('thumbnail', mockFile, thumbnail);
            });
            modalAttachments.emit("complete", mockFile);
        });

        $('#invoiceModal').modal('show');
    });
});

$('#attachments-table .create-expense').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');

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

        $(`#expenseModal`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${row.find('.select-one').val()}">`);

        modalAttachmentId.push(row.find('.select-one').val());
        var mockFile = {
            name: `${row.find('td:nth-child(4)').text().trim()}.${row.data().extension}`,
            size: parseInt(row.find('td:nth-child(5)').text().trim()),
            dataURL: base_url+"uploads/accounting/attachments/" + row.data().file,
            accepted: true
        };
        modalAttachments.emit("addedfile", mockFile);
        modalAttachedFiles.push(mockFile);

        modalAttachments.createThumbnailFromUrl(mockFile, modalAttachments.options.thumbnailWidth, modalAttachments.options.thumbnailHeight, modalAttachments.options.thumbnailMethod, true, function(thumbnail) {
            modalAttachments.emit('thumbnail', mockFile, thumbnail);
        });
        modalAttachments.emit("complete", mockFile);

        $('#expenseModal').modal('show');
    });
});

$('#attachments-table .create-invoice').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/invoice_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields('invoiceModal');

        $(`#invoiceModal`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${row.find('.select-one').val()}">`);

        modalAttachmentId.push(row.find('.select-one').val());
        var mockFile = {
            name: `${row.find('td:nth-child(4)').text().trim()}.${row.data().extension}`,
            size: parseInt(row.find('td:nth-child(5)').text().trim()),
            dataURL: base_url+"uploads/accounting/attachments/" + row.data().file,
            accepted: true
        };
        modalAttachments.emit("addedfile", mockFile);
        modalAttachedFiles.push(mockFile);

        modalAttachments.createThumbnailFromUrl(mockFile, modalAttachments.options.thumbnailWidth, modalAttachments.options.thumbnailHeight, modalAttachments.options.thumbnailMethod, true, function(thumbnail) {
            modalAttachments.emit('thumbnail', mockFile, thumbnail);
        });
        modalAttachments.emit("complete", mockFile);

        $('#invoiceModal').modal('show');
    });
});

$('#export-attachments').on('click', function(e) {
    e.preventDefault();
    var selected = $('#attachments-table tbody input.select-one:checked');

    if($('#export-form').length < 1) {
        $('body').append('<form action="/accounting/attachments/export" method="post" id="export-form"></form>');
    }

    selected.each(function() {
        $('#export-form').append(`<input type="hidden" name="ids[]" value="${$(this).val()}">`);
    });

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$(function() {
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
});