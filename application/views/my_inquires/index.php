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
                                <h3 class="page-title float-left">My Inquires List</h3> 
                                <div class="alert alert-warning col-md-12 mt-4 mb-4 row" role="alert">
                                    <span style="color:black;">
                                        Showing customers and leads purchased on Campaign 360
                                    </span>
                                </div>

                                <div class="pull-right">

                                </div>              
                                <div class="clearfix"></div>
                                </section>

                                <!-- Main content -->
                                <section class="content">

                                    <!-- Default box -->
                                    <div class="box">                
                                        <div class="box-body" >                  
                                            <hr />
                                            <p class="text-ter margin-bottom">No records.</p>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

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

                    <?php include viewPath('includes/campaignblast_modals'); ?> 
                    <?php include viewPath('includes/footer'); ?>

                    <script>
                        //$('.dataTableCampaignBlast').DataTable();
                    </script>