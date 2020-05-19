<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/business'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <section class="content">
                <!-- Default box -->
                <div class="box">

                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h1 class="page-title">New Equipment</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Add Equipment</li>
                                </ol>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <a href="<?php echo url('equipments') ?>" class="btn btn-primary"
                                           aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Equipments
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_open('equipments/save', ['class' => 'form-validate']); ?>
                    <div class="row custom__border">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formClient-Name">Name *</label>
                                                <input type="text" class="form-control" name="title"
                                                       id="formClient-Name" required placeholder="Enter Service Title"
                                                       autofocus/>
                                            </div>
                                        </div>

                                        <div class="col-md-12 repeater-content-block">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>QTY</th>
                                                        <th>Price</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="repeater-wrap"></tbody>
                                                </table>
                                                <button type="button" class="btn btn-primary repeat-action">Add Items
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mt-3">
                                            <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
                <!-- /.box -->
            </section>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function () {

        //repeater content
        $(document).on('click', '.repeater-content-block .repeat-action', function (e) {

            const index = $(this).prev().find('.repeater-wrap > tr').length;

            let row = '<tr>';
            row += '<td><input type="text" name="items[' + index + '][title]" class="form-control"></td>';
            row += '<td><input type="number" name="items[' + index + '][quantity]" class="form-control"></td>';
            row += '<td><input type="text" name="items[' + index + '][price]" class="form-control"></td>';
            row += '<td><button type="button" class="btn btn-danger btn-close"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            row += '</tr>';

            $(this).prev().find('.repeater-wrap').append(row);
        });

        // remove single item
        $(document).on('click', '.repeater-content-block .repeater-wrap tr .btn-close', function (e) {

            console.log("x");
            $(this).parent().parent().remove();
        });
    });


</script>