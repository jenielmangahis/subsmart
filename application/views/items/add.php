<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/estimate'); ?>
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
                                <h1 class="page-title">Items</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Add Items</li>
                                </ol>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <a href="<?php echo url('items') ?>" class="btn btn-primary"
                                           aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Items
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_open('items/save', ['class' => 'form-validate']); ?>
                    <div class="row custom__border">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formClient-Name">Name *</label>
                                                <input type="text" class="form-control" name="title"
                                                       id="formClient-Name" required placeholder="Enter Name"
                                                       autofocus/>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formClient-Name">Price *</label>
                                                <input type="text" class="form-control" name="price"
                                                       id="formClient-Name" required placeholder="Enter Name"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formClient-Name">Description (optional)</label>
                                                <textarea name="description" cols="40" rows="2" class="form-control"
                                                          autocomplete="off" spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="formClient-Name">Discount</label>
                                                <input type="text" class="form-control" name="discount"
                                                       id="formClient-Name" value="0"/>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="discount_fixed">Item Type</label>
                                                <select name="type" class="groups-select form-control">
                                                    <option value="service">Service</option>
                                                    <option value="material">Material</option>
                                                    <option value="product">Product</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="discount_fixed">Item Cost</label> <span
                                                        class="help help-sm">(optional)</span>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="text" name="cost" value="" class="form-control"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="discount_fixed">Link/URL</label> <span class="help help-sm">(optional)</span>
                                                <div class="input-group">
                                                    <input type="text" name="url" value="" class="form-control"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Notes</label> <span class="help help-sm">(optional)</span>
                                            <textarea name="notes" cols="40" rows="2" class="form-control"
                                                      autocomplete="off"></textarea>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="model">Model</label> <span
                                                        class="help help-sm">(optional)</span>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="model" id="model"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="discount_fixed">1st year Cost</label> <span
                                                        class="help help-sm">(optional)</span>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="text" name="price1" class="form-control"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="discount_fixed">2st year Cost</label> <span
                                                        class="help help-sm">(optional)</span>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="text" name="price2" class="form-control"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="discount_fixed">3st year Cost</label> <span
                                                        class="help help-sm">(optional)</span>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="text" name="price3" class="form-control"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="discount_fixed">4st year Cost</label> <span
                                                        class="help help-sm">(optional)</span>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="text" name="price4" class="form-control"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-3">
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

        $('.form-validate').validate();


        $('.check-select-all-p').on('change', function () {


            $('.check-select-p').attr('checked', $(this).is(':checked'));


        })


        $('.table-DT').DataTable({

            "ordering": false,

        });

    })


</script>
<script>
    //Initialize Select2 Elements

    $('.select2').select2()

</script>