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
    #myTabContent .action-bar ul li a:after {
        width: 0;
    }
    #myTabContent .action-bar ul li a {
    font-size: 20px;
    }
    #myTabContent .action-bar ul li {
        margin-right: 5px;
    }
    #myTabContent .action-bar ul li #cancel-edit-btn {
        color: #6B6C72;
        border: 0;
    }
    #myTabContent .action-bar ul li #cancel-edit-btn:hover {
        background: transparent;
    }
    .btn-transparent:hover {
        background: #d4d7dc !important;
        border-color: #6B6C72 !important;
    }
    .btn-transparent {
        color: #6B6C72 !important;
    }
    .btn-transparent:focus {
        border-color: #6B6C72 !important;
    }
    .dropdown-menu .dropdown-item.disabled {
        cursor: default;
        opacity: 0.50;
        pointer-events: none;
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
                                    <div class="attachments-container">
                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                        <span>Maximum size: 20MB</span>
                                        <div id="attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                            <div class="dz-message" style="margin: 20px;border">
                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <form class="d-none" id="export-form" method="post" action="/accounting/attachments/export"></form>
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3 d-flex align-items-end justify-content-center">
                                                <div class="arrow-level-down m-0">
                                                    <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                                </div>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-transparent" type="button" id="attachment-actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Batch actions&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="attachment-actions">
                                                        <a href="#" class="dropdown-item disabled" id="export-attachments">Export</a>
                                                        <!-- <a href="#" class="dropdown-item disabled" id="create-invoice">Create invoice</a> -->
                                                        <a href="#" class="dropdown-item disabled" id="create-expense">Create expense</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" id="print-attachments"><i class="fa fa-print"></i></a></li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-cog"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                            <p class="m-0">Columns</p>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="col_size" checked="checked" onchange="col(this)">
                                                                <label for="col_size">Size</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="col_uploaded" checked="checked" onchange="col(this)">
                                                                <label for="col_uploaded">Uploaded</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="col_note" checked="checked" onchange="col(this)">
                                                                <label for="col_note">Notes</label>
                                                            </div>
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
                                            <th width="4%">
                                                <div class="d-flex justify-content-center">
													<div class="checkbox checkbox-sec m-0">
                                                        <input type="checkbox" id="select-all-attachments">
														<label for="select-all-attachments" class="p-0" style="width: 24px; height: 24px"></label>
													</div>
												</div>
                                            </th>
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
                <form id="edit-attachment-form" method="post">
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
        <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
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