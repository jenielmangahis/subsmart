
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('inventory/css/lists_css'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inventory'); ?>
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk pt-0"
                             style="padding-bottom:0px; padding-left:0px; padding-right:0px;">
                            <div class="row margin-bottom-ter mb-2 align-items-center"
                                 style="background-color:white; padding:0px;">
                                <div class="col-auto pl-0">
                                    <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Vendors</h5>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('inventory/vendor/add') ?>"><span class="fa fa-plus"></span> Add New Vendor</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage your inventory vendors.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($vendors as $row): ?>
                                    <tr>
                                        <td><?= $row->vendor_name ?></td>
                                        <td><?= $row->email ?></td>
                                        <td><?= $row->phone ?></td>
                                        <td><?= $row->street_address.' '.$row->city. ' '.$row->state ?></td>
                                        <td>
                                            <div class="dropdown dropdown-btn text-center">
                                                <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                    <li role="presentation">
                                                        <a role="menuitem" href="<?php echo url('inventory/vendor/edit/'.$row->vendor_id); ?>">
                                                            <span class="fa fa-pencil-square-o icon"></span> Edit
                                                        </a>
                                                    </li>
                                                    <li role="separator" class="divider"></li>
                                                    <li role="presentation">
                                                        <a href="javascript:void(0);" class="delete-vendor" data-id="<?php echo $row->vendor_id; ?>" role="menuitem">
                                                            <span class="fa fa-trash-o icon"></span> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>
    <script>
        $(function(){
            $('#dataTable1').DataTable()
            $(".delete-vendor").on("click", function(event) {
                var ID = $(this).attr('data-id');
                // alert(ID);
                Swal.fire({
                    title: 'Are your sure you want to delete selected vendor?',
                    text: "",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#32243d',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            dataType:"json",
                            url: base_url + "/inventory/vendor/delete",
                            data: { id: ID}, // serializes the form's elements.
                            success: function(data) {
                                if (data.is_success == 1) {
                                    Swal.fire({
                                      title: 'Great!',
                                      text: 'Vendor was successfully deleted.',
                                      icon: 'success',
                                      showCancelButton: false,
                                      confirmButtonColor: '#32243d',
                                      cancelButtonColor: '#d33',
                                      confirmButtonText: 'Ok'
                                    }).then((result) => {
                                      location.href = base_url + "/inventory/vendors";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        confirmButtonColor: '#32243d',
                                        html: 'Cannot find data'
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
