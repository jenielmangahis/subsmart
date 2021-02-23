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
                                <h3 class="page-title float-left">Campaign Blast</h3>
                                <div class="pull-right">
                                    <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCampaignBlast"><i class="fa fa-plus"></i> Create Campaign Blast</a><br />
                                </div>   
                                <div class="alert alert-warning col-md-12 mt-4 mb-4 row" role="alert">
                                    <span style="color:black;">
                                        Listing all your postcard campaigns
                                    </span>
                                </div>
                               
                                <!-- Main content -->
                                <section class="content">

                                    <?php if ($this->session->flashdata('message')) { ?>
                                        <div class="row dashboard-container-1">
                                            <div class="col-md-12">
                                                <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>">
                                                    <button type="button" class="close" data-dismiss="alert">&times</button>
                                                    <?php echo $this->session->flashdata('message'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>        
                                    <div style="margin-top: 30px; float:right;">                
                                        <a href="#" style="color:#259e57 !important; text-align: right;"><i class="fa fa-file-text-o fa-margin-right"></i> Orders & Payments</a>
                                    </div>
                                    <!-- Default box -->
                                    <div class="box">                
                                        <div class="box-body" style="">                  
                                            <div class="card-header tab-card-header">
                                                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="c-active-tab" data-toggle="tab" href="#active-blast" role="tab" aria-controls="One" aria-selected="true">Draft (<?php echo count($count_campaign_blast); ?>)</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="c-scheduled-tab" data-toggle="tab" href="#queue-blast" role="tab" aria-controls="Two" aria-selected="false">Queue (<?php echo count($campaign_blast_queue); ?>)</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="c-completed-tab" data-toggle="tab" href="#sent-blast" role="tab" aria-controls="Two" aria-selected="false">Sent (<?php echo count($campaign_blast_sent); ?>)</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="c-closed-tab" data-toggle="tab" href="#archive-blast" role="tab" aria-controls="Three" aria-selected="false">Archive (<?php echo count($campaign_blast_archive); ?>)</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active p-3" id="active-blast" role="tabpanel" aria-labelledby="one-tab">

                                                    <?php if ($count_campaign_blast) { ?>
                                                        <table class="table table-hover table-to-list" id="dataTableCampaignBlastDraft" data-id="campaign_blast_drf">
                                                            <thead>
                                                                <tr class="">
                                                                    <th><strong>Campaign Name</strong></th>
                                                                    <th><strong>Postcards</strong></th>
                                                                    <th><strong>Status</strong></th>
                                                                    <th><strong>Details</strong></th>
                                                                    <th>&nbsp;</th>

                                                                </tr>
                                                            </thead>
                                                            <?php foreach ($campaign_blast_draft as $cbd) { ?>
                                                                <tr class="">
                                                                    <td><?php echo $cbd->campaign_name; ?></td>
                                                                    <td><?php echo '0'; ?></td>
                                                                    <td><?php echo ucfirst($cbd->status); ?></td>
                                                                    <td><?php echo 'Added on ' . date("F j, Y, g:i a", strtotime($cbd->date_created)); ?></td>
                                                                    <td>
                                                                        <div class="dropdown dropdown-btn text-center">
                                                                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                                <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                                <li role="presentation">
                                                                                    <a style="" class="email-automation-edit editEmailAutomationBtn" data-category-edit-modal="open" data-id="<?php echo $cbd->id; ?>" href="javascript:void(0);">
                                                                                        <span class="fa fa-pencil-square-o icon"></span> edit
                                                                                    </a>
                                                                                </li>
                                                                                <li role="separator" class="divider"></li>
                                                                                <li role="presentation">
                                                                                    <a class="campaign-blast-delete" data-category-delete-modal="open" data-id="<?php echo $cbd->id; ?>" href="javascript:void(0);" data-name="<?php echo $cbd->campaign_name; ?>">
                                                                                        <span class="fa fa-trash-o icon"></span> Delete
                                                                                    </a>  
                                                                                </li>
                                                                            </ul>
                                                                        </div>                              
                                                                    </td>
                                                                </tr>
                                                            <?php } ?> 
                                                            <tbody>
                                                            </tbody>

                                                        </table>  
                                                    <?php } else {
                                                        echo 'No Draft yet';
                                                    } ?>

                                                </div>
                                                <div class="tab-pane fade p-3" id="queue-blast" role="tabpanel" aria-labelledby="two-tab">

<?php if ($campaign_blast_queue) { ?>
                                                        <table class="table table-hover table-to-list" id="dataTableCampaignBlastDraft" data-id="campaign_blast_drf">
                                                            <thead>
                                                                <tr class="">
                                                                    <th><strong>Campaign Name</strong></th>
                                                                    <th><strong>Postcards</strong></th>
                                                                    <th><strong>Status</strong></th>
                                                                    <th><strong>Details</strong></th>
                                                                    <th>&nbsp;</th>

                                                                </tr>
                                                            </thead>
    <?php foreach ($campaign_blast_queue as $cbd) { ?>
                                                                <tr class="">
                                                                    <td><?php echo $cbd->campaign_name; ?></td>
                                                                    <td><?php echo '0'; ?></td>
                                                                    <td><?php echo ucfirst($cbd->status); ?></td>
                                                                    <td><?php echo 'Added on ' . date("F j, Y, g:i a", strtotime($cbd->date_created)); ?></td>
                                                                    <td>
                                                                        <div class="dropdown dropdown-btn text-center">
                                                                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                                <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                                <li role="presentation">
                                                                                    <a style="" class="email-automation-edit editEmailAutomationBtn" data-category-edit-modal="open" data-id="<?php echo $cbd->id; ?>" href="javascript:void(0);">
                                                                                        <span class="fa fa-pencil-square-o icon"></span> edit
                                                                                    </a>
                                                                                </li>
                                                                                <li role="separator" class="divider"></li>
                                                                                <li role="presentation">
                                                                                    <a class="campaign-blast-delete-q" data-category-delete-modal="open" data-id="<?php echo $cbd->id; ?>" href="javascript:void(0);" data-name="<?php echo $cbd->campaign_name; ?>">
                                                                                        <span class="fa fa-trash-o icon"></span> Delete
                                                                                    </a>  
                                                                                </li>
                                                                            </ul>
                                                                        </div>                              
                                                                    </td>
                                                                </tr>
    <?php } ?> 
                                                            <tbody>
                                                            </tbody>

                                                        </table>  
<?php } else {
    echo 'No Queue yet';
} ?>                      

                                                </div>
                                                <div class="tab-pane fade p-3" id="sent-blast" role="tabpanel" aria-labelledby="two-tab">

<?php if ($campaign_blast_sent) { ?>
                                                        <table class="table table-hover table-to-list" id="dataTableCampaignBlastDraft" data-id="campaign_blast_drf">
                                                            <thead>
                                                                <tr class="">
                                                                    <th><strong>Campaign Name</strong></th>
                                                                    <th><strong>Postcards</strong></th>
                                                                    <th><strong>Status</strong></th>
                                                                    <th><strong>Details</strong></th>
                                                                    <th>&nbsp;</th>

                                                                </tr>
                                                            </thead>
    <?php foreach ($campaign_blast_sent as $cbd) { ?>
                                                                <tr class="">
                                                                    <td><?php echo $cbd->campaign_name; ?></td>
                                                                    <td><?php echo '0'; ?></td>
                                                                    <td><?php echo ucfirst($cbd->status); ?></td>
                                                                    <td><?php echo 'Added on ' . date("F j, Y, g:i a", strtotime($cbd->date_created)); ?></td>
                                                                    <td>
                                                                        <div class="dropdown dropdown-btn text-center">
                                                                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                                <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                                <li role="presentation">
                                                                                    <a style="" class="email-automation-edit editEmailAutomationBtn" data-category-edit-modal="open" data-id="<?php echo $cbd->id; ?>" href="javascript:void(0);">
                                                                                        <span class="fa fa-pencil-square-o icon"></span> edit
                                                                                    </a>
                                                                                </li>
                                                                                <li role="separator" class="divider"></li>
                                                                                <li role="presentation">
                                                                                    <a class="campaign-blast-delete-s" data-category-delete-modal="open" data-id="<?php echo $cbd->id; ?>" href="javascript:void(0);" data-name="<?php echo $cbd->campaign_name; ?>">
                                                                                        <span class="fa fa-trash-o icon"></span> Delete
                                                                                    </a>  
                                                                                </li>
                                                                            </ul>
                                                                        </div>                              
                                                                    </td>
                                                                </tr>
    <?php } ?> 
                                                            <tbody>
                                                            </tbody>

                                                        </table>  
<?php } else {
    echo 'No Sent yet';
} ?>                         

                                                </div>
                                                <div class="tab-pane fade p-3" id="archive-blast" role="tabpanel" aria-labelledby="three-tab">

<?php if ($campaign_blast_archive) { ?>
                                                        <table class="table table-hover table-to-list" id="dataTableCampaignBlastDraft" data-id="campaign_blast_drf">
                                                            <thead>
                                                                <tr class="">
                                                                    <th><strong>Campaign Name</strong></th>
                                                                    <th><strong>Postcards</strong></th>
                                                                    <th><strong>Status</strong></th>
                                                                    <th><strong>Details</strong></th>
                                                                    <th>&nbsp;</th>

                                                                </tr>
                                                            </thead>
    <?php foreach ($campaign_blast_archive as $cbd) { ?>
                                                                <tr class="">
                                                                    <td><?php echo $cbd->campaign_name; ?></td>
                                                                    <td><?php echo '0'; ?></td>
                                                                    <td><?php echo ucfirst($cbd->status); ?></td>
                                                                    <td><?php echo 'Added on ' . date("F j, Y, g:i a", strtotime($cbd->date_created)); ?></td>
                                                                    <td>
                                                                        <div class="dropdown dropdown-btn text-center">
                                                                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                                <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                                <li role="presentation">
                                                                                    <a style="" class="email-automation-edit editEmailAutomationBtn" data-category-edit-modal="open" data-id="<?php echo $cbd->id; ?>" href="javascript:void(0);">
                                                                                        <span class="fa fa-pencil-square-o icon"></span> edit
                                                                                    </a>
                                                                                </li>
                                                                                <li role="separator" class="divider"></li>
                                                                                <li role="presentation">
                                                                                    <a class="campaign-blast-delete-a" data-category-delete-modal="open" data-id="<?php echo $cbd->id; ?>" href="javascript:void(0);" data-name="<?php echo $cbd->campaign_name; ?>">
                                                                                        <span class="fa fa-trash-o icon"></span> Delete
                                                                                    </a>  
                                                                                </li>
                                                                            </ul>
                                                                        </div>                              
                                                                    </td>
                                                                </tr>
                                                        <?php } ?> 
                                                            <tbody>
                                                            </tbody>

                                                        </table>  
                                            <?php } else {
                                                echo 'No Archive yet';
                                            } ?>                          


                                                </div>
                                            </div>

<?php if (!$count_campaign_blast) { ?>
                                                <div class="page-empty-container">
                                                    <h5 class="page-empty-header">Send postcards to your customers.</h5>
                                                    <p class="text-ter margin-bottom">
                                                        Personalized postcards are priceless in optimizing the connection between your customers and business.<br>
                                                        They help your business to stand out among your valued customers. Send yours today!
                                                    </p>
                                                    <a class="btn btn-primary" data-toggle="modal" data-target="#modalAddCampaignBlast" href="javascript:void(0);"><span class="fa fa-plus fa-margin-right"></span> New Campaign Blast</a>

                                                    <div class="text-sm text-ter deals-info-image-caption" style="margin-top: 50px; margin-bottom: 10px;">Sample Campaign Blast</div>
                                                    <div style="margin-bottom: 10px;">
    <?php $thumb_img = base_url('/assets/dashboard/images/product-no-image.jpg') ?>
                                                        <img style="display: inline-block; width: 200px; margin-right: 10px; border: 1px solid #eaeaea;" class="img-responsive" src="<?php echo $thumb_img; ?>">
                                                        <img style="display: inline-block; width: 200px; border: 1px solid #eaeaea;" class="img-responsive" src="<?php echo $thumb_img; ?>">
                                                    </div>
                                                </div>
<?php } ?>

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
                        $('.dataTableCampaignBlastDraft').DataTable();
                        $(document).ready(function () {

                            $(".campaign-blast-delete").click(function () {
                                var tid = $(this).attr("data-id");
                                $("#tid").val(tid);
                                $("#modalDeleteCampaignBlast").modal('show');
                            });

                        });
                    </script>