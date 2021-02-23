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
                                <h3 class="page-title float-left">SMS Automation</h3>
                                <div class="pull-right">
                                    <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add SMS Automation</a>
                                </div> 
                                <div class="alert alert-warning col-md-12 mt-4 mb-4 row" role="alert">
                                    <span style="color:black;">
                                        List all automations
                                    </span>
                                </div>
                                <section class="content">

                                    <!-- Default box -->
                                    <div class="box">                                
                                        <div class="box-body" style="overflow-y: scroll;">                                    
                                            <table class="table table-bordered table-striped dataTableCampaign">
                                                <thead>
                                                    <tr>
                                                        <th>Automation Name</th>
                                                        <th>Event</th>
                                                        <th>Details</th>
                                                        <th>Text Sent</th>                            
                                                        <th>Status</th>                            
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>

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

                    <?php include viewPath('includes/footer'); ?>

                    <script>
                        $('.dataTableCampaign').DataTable();
                    </script>