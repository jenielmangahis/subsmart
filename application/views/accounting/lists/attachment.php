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