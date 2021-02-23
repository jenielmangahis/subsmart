<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php //include viewPath('includes/sidebars/estimate');  ?>
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <?php //include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body" >
                            <div class="col-md-12">
                                <h3 class="page-title col-lg-6 float-left">Email Blast</h3>

                                <div class="pull-right">
                                    <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create Email Blast</a>
                                </div>  
                                <div class="alert alert-warning col-md-12 mt-4 mb-4 row" role="alert">
                                    <span style="color:black;">
                                        <p>Listing the campaigns that are currently running.</p>
                                    </span>
                                </div>  
                                <!-- Main content -->
                                <section class="content">
                                    <div class="center" style="margin-top:50px;">
                                        <h4>You haven't got any email campaigns</h4>
                                        <p>With Email Blast you can send emails to all your customers or only a group.</p>
                                        <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create Email Blast</a>
                                    </div>             

                                </section>
                                <!-- /.content -->
                                <!-- end row -->
                            </div>
                            <!-- end container-fluid -->
                        </div>
                        <!-- page wrapper end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                   

                    <?php include viewPath('includes/footer'); ?>

                    <script>
                        $('.dataTableCampaign').DataTable();
                    </script>