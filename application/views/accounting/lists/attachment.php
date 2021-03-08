<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }
    .show>.btn-primary.dropdown-toggle {
        background-color: #32243D;
        border: 1px solid #32243D;
    }
    .p-padding{
        padding-left: 10%;
    }
    #attachments_table .btn-group .btn:hover, #attachments_table .btn-group .btn:focus {
        color: unset;
    }
    #attachments_table .btn-group .btn {
        padding: 10px;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Attachments</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Adding relevant information to a record is always bound to come in handy. You can attach new files to an entity's record, which will serve the purpose of having every related information in one place.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-sm-12">
                                    <form id="attachments-form">
                                        <div class="attachments attachments">
                                            <div class="attachments-header">
                                                <button type="button" onclick="document.getElementById('attachments').click();">Attachments</button>
                                                <span>Maximum size: 20MB</span>
                                            </div>
                                            <div class="attachments-list">
                                                <div class="attachments-container border" onclick="document.getElementById('attachments').click();">
                                                    <div class="attachments-container-label">
                                                        Drag/Drop files here or click the icon
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" name="attachments[]" id="attachments" class="hide" multiple="multiple">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
									 <div class="col-md-12">
                                        <div class="action-bar">
                                            <ul>
                                                <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-cog"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                            <p class="m-0">Columns</p>
                                                            <p class="m-0"><input type="checkbox" id="col_size" checked="checked" onchange="col(this)"> Size</p>
                                                            <p class="m-0"><input type="checkbox" id="col_uploaded" checked="checked" onchange="col(this)"> Uploaded</p>
                                                            <p class="m-0"><input type="checkbox" id="col_note" checked="checked" onchange="col(this)"> Notes</p>
                                                            <p class="m-0">Rows</p>
                                                            <p class="m-0">
                                                                <select name="table_rows" id="table_rows" class="form-control">
                                                                    <option value="50">50</option>
                                                                    <option value="75">75</option>
                                                                    <option value="100">100</option>
                                                                    <option value="150" selected>150</option>
                                                                    <option value="300">300</option>
                                                                </select>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <table id="attachments_table" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th width="3%"></th>
                                            <th width="10%">THUMBNAIL</th>
                                            <th class='type'>TYPE</th>
                                            <th class='name'>NAME</th>
                                            <th class='size'>SIZE</th>
                                            <th class='uploaded'>UPLOADED</th>
                                            <th class='links'>LINKS</th>
                                            <th class='note'>NOTE</th>
                                            <th width="10%">Action</th>
                                        </tr>
									</thead>
									<tbody id="customer_data">
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <div class="modal fade" id="edit_attachment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Attachment</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form id="edit-attachment-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="file_name">File name</label>
                                                <input type="text" name="file_name" id="file_name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="notes">Notes</label>
                                                <textarea name="notes" id="notes" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="file-preview">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-rounded border float-right">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete_attachment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-50" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Deleting this attachment will remove this attachment from all linked transactions. Are you sure you want to delete the attachment?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">No</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success btn-rounded border float-right">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>
<script>
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
</script>