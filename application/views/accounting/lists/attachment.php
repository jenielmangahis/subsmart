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
                                        <span style="color:black;">Attachments message</span>
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
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <p class="p-padding">Columns</p>
                                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_thumbnail()" name="chk_thumbnail" id="chk_thumbnail">Thumbnail</p>
                                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_type()" name="chk_type" id="chk_type"> Type</p>
                                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_name()" name="chk_name" id="chk_name">Name</p>
                                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_size()" name="chk_size" id="chk_size"> Size</p>
                                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_uploaded()" name="chk_uploaded" id="chk_uploaded"> Uploaded</p>
                                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_links()" name="chk_links" id="chk_links"> Links</p>
                                                            <br/>
                                                            <p class="p-padding"><input type="checkbox" name="chk_other" id="chk_other"> Other</p>
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
                                            <th></th>
                                            <th>THUMBNAIL</th>
                                            <th class='type'>TYPE</th>
                                            <th class='name'>NAME</th>
                                            <th class='size'>SIZE</th>
                                            <th class='uploaded'>UPLOADED</th>
                                            <th class='links'>LINKS</th>
                                            <th class='note'>NOTE</th>
                                            <th>Action</th>
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
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>
<script>

$(function(){
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });

        $('#attachments_table').DataTable({
            searching: false,
            lengthChange: false
        });

        $('#attachments').on('change', function() {
            var data = new FormData(document.getElementById('attachments-form'));

            $.ajax({
                url: '/accounting/upload-files',
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
                }
            });
        });
    });
</script>