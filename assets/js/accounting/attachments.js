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
    $('.date_picker input').datepicker({
        format: "dd.mm.yyyy",
        todayBtn: "linked",
        language: "de"
    });

    $('#table_rows').on('change', function() {
        table.ajax.reload();
    });

    $('.action-bar .dropdown-menu').on('click', function(e) {
        e.stopPropagation();
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
                    $(td).html(`<input type="checkbox" value="${rowData.id}" class="m-auto">`);
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
                name: 'links'
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
                            <a class="dropdown-item delete-attachment" href="#" data-id="${rowData.id}">Delete</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addinvoiceModal">Create invoice</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#expense-modal">Create expense</a>
                        </div>
                    </div>
                    `);

                    if(rowData.type === 'Image' || rowData.type === 'Pdf') {
                        $(td).children().prepend(`<a href="/uploads/accounting/attachments/${rowData.thumbnail}" target="__blank" class="btn text-primary d-flex align-items-center justify-content-center download-attachment">Download</a>`);
                    } else {
                        $(td).children().prepend(`<a href="/accounting/attachments/download?filename=${rowData.thumbnail}" target="__blank" class="btn text-primary d-flex align-items-center justify-content-center download-attachment">Download</a>`);
                    }
                }
            }
        ]
    });

    $(document).on('click', '#attachments_table a.delete-attachment', function(e) {
        e.preventDefault();

        var id = e.currentTarget.dataset.id;

        $('#delete_attachment .modal-footer .btn-success').attr('data-id', id);

        $('#delete_attachment').modal('show');
    });

    $(document).on('click', '#delete_attachment .modal-footer .btn-success', function(e) {
        e.preventDefault();

        var id = e.currentTarget.dataset.id;

        $.ajax({
            url: `/accounting/attachments/delete/${id}`,
            type:"DELETE",
            success:function (result) {
                var res = JSON.parse(result);

                $.toast({
                    icon: res.success ? 'success' : 'error',
                    heading: res.success ? 'Success' : 'Error',
                    text: res.message,
                    showHideTransition: 'fade',
                    hideAfter: 3000,
                    allowToastClose: true,
                    position: 'top-center',
                    stack: false,
                    loader: false,
                });

                $('#delete_attachment').modal('hide');

                $('#attachments_table').DataTable().ajax.reload();
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

        $('#edit_attachment form').prepend(`<input type="hidden" name="id" value="${data.id}">`);

        $('#edit_attachment').modal('show');
    });

    $(document).on('submit', '#edit-attachment-form', function(e) {
        e.preventDefault();

        var data = new FormData(document.getElementById('edit-attachment-form'));

        $.ajax({
            url: '/accounting/attachments/update',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                $.toast({
                    icon: res.success ? 'success' : 'error',
                    heading: res.success ? 'Success' : 'Error',
                    text: res.message,
                    showHideTransition: 'fade',
                    hideAfter: 3000,
                    allowToastClose: true,
                    position: 'top-center',
                    stack: false,
                    loader: false,
                });

                $('#edit_attachment').modal('hide');

                $('#attachments_table').DataTable().ajax.reload();
            }
        })
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
                var res = JSON.parse(result);

                $.toast({
                    icon: res.success ? 'success' : 'error',
                    heading: res.success ? 'Success' : 'Error',
                    text: res.message,
                    showHideTransition: 'fade',
                    hideAfter: 3000,
                    allowToastClose: true,
                    position: 'top-center',
                    stack: false,
                    loader: false,
                });

                $('#attachments_table').DataTable().ajax.reload();
            }
        });
    });
});