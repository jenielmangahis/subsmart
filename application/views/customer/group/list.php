<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('customer/css/customer_css'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/customer'); ?>
    <div wrapper__section>
        <div class="container-fluid" style="padding-top: 10px;">
            <div class="card card_holder">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="box-header with-border">
                                <h3 class="box-title">Customer Groups</h3>
                            </div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Listing all customer groups.</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="<?php echo url('customer/group_add') ?>" class="btn btn-primary btn-md">
                                        <i class="fa fa-plus"></i> Add Group
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning col-md-12 mt-4" role="alert">
                            <span style="color:black;">
                                A customer group is a way of aggregating customers that are similar in some way.  For example, you may
                                use them to distinguish between retail and wholesale customers or between company employees and external customers etc. ...
                                For example, a customer may have registered through the application as a wholesale customer.
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">

                        <div class="box-body">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th style="width: 13%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($customerGroups)) { ?>
                                    <?php foreach ($customerGroups as $customerGroup): ?>
                                        <tr>
                                            <td>
                                                <?php echo $customerGroup->title ?>
                                            </td>
                                            <td><?= $customerGroup->description; ?></td>
                                            <td>
                                                <?php //if (hasPermissions('plan_edit')): ?>
                                                    <a href="<?php echo url('customer/group_edit/' . $customerGroup->id) ?>"
                                                       class="btn btn-sm btn-default" title="Edit item"
                                                       data-toggle="tooltip"><i class="fa fa-pencil"></i> Edit</a>
                                                <?php //endif ?>
                                                <?php //if (hasPermissions('plan_delete')): ?>
                                                    <button id="<?= $customerGroup->id ?>" class="btn btn-sm btn-danger remove-data-item delete_group" title="Delete item" data-toggle="tooltip">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                <?php //endif ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- end row -->
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable({"bFilter": false});

    $(".delete_group").on( "click", function( event ) {
        var ID=this.id;
        // alert(ID);
        Swal.fire({
            title: 'Continue to DELETE this Customer Group?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "customer/group_delete",
                    data: {id : ID}, // serializes the form's elements.
                    success: function(data)
                    {
                        if(data){
                            window.location.reload();
                        }else{
                            console.log(data);
                        }
                    }
                });
            }
        });
    });


</script>
