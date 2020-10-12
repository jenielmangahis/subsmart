<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="pull-left">
                <h1 style="text-align: left;">Offers</h1>              
                <p>Listing the deals that are currently running.</p>
              </div>
              <div class="pull-right">
                <a href="<?php echo url('offers/add_offer') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create Offer</a><br />
                <div style="margin-top: 30px;">                
                  <a href="#" style="color:#259e57 !important;margin-right: 10px;"><i class="fa fa-bar-chart"></i> Stats</a>
                  <a href="#" style="color:#259e57 !important;"><i class="fa fa-file-text-o fa-margin-right"></i> Orders & Payments</a>
                </div>
              </div>              
              <div class="clearfix"></div>
            </section>

            <!-- Main content -->
            <section class="content">

              <!-- Default box -->
              <div class="box">                
                <div class="box-body" style="overflow-y: scroll;">                  
                  <div class="card-header tab-card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="c-active-tab" data-toggle="tab" href="#active-offers" role="tab" aria-controls="One" aria-selected="true">Active Offers (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-scheduled-tab" data-toggle="tab" href="#scheduled-offers" role="tab" aria-controls="Two" aria-selected="false">Scheduled (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-closed-tab" data-toggle="tab" href="#ended-offers" role="tab" aria-controls="Three" aria-selected="false">Ended (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-draft-tab" data-toggle="tab" href="#draft-offers" role="tab" aria-controls="Four" aria-selected="false">Draft (0)</a>
                      </li>
                    </ul>
                  </div>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="active-offers" role="tabpanel" aria-labelledby="one-tab">
                      
                      <table class="table table-bordered table-striped dataTableOffer">
                        <thead>
                          <tr>
                            <th>Offer</th>
                            <th>Views</th>
                            <th>Bookings</th>
                            <th>Valid</th>
                            <th>Status</th>                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php if($offers_active_list){ foreach($offers_active_list as $active){ ?>
                              <tr class="">
                                <td><a href="<?php echo url('offers/edit_offer/'.$active->id) ?>"><?php echo $active->title; ?></a></td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>Draft</td>
                              </tr> 
                            <?php } } ?>   
                        </tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade p-3" id="scheduled-offers" role="tabpanel" aria-labelledby="two-tab">
                      
                      <table class="table table-bordered table-striped dataTableOffer">
                        <thead>
                          <tr>
                            <th>Offer</th>
                            <th>Views</th>
                            <th>Bookings</th>
                            <th>Valid (schedule for)</th>
                            <th>Status</th>                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php if($offers_inactive_list){ foreach($offers_inactive_list as $inactive){ ?>
                              <tr class="">
                                <td><a href="<?php echo url('offers/edit_offer/'.$inactive->id) ?>"><?php echo $inactive->title; ?></a></td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>Draft</td>
                              </tr> 
                            <?php } } ?>   
                        </tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade p-3" id="ended-offers" role="tabpanel" aria-labelledby="three-tab">
                      
                      <table class="table table-bordered table-striped dataTableOffer">
                        <thead>
                          <tr>
                            <th>Offer</th>
                            <th>Views</th>
                            <th>Bookings</th>
                            <th>Valid</th>
                            <th>Status</th>                                 
                          </tr>
                        </thead>
                        <tbody>
                          <?php if($offers_ended_list){ foreach($offers_ended_list as $ended){ ?>
                              <tr class="">
                                <td><a href="<?php echo url('offers/edit_offer/'.$ended->id) ?>"><?php echo $ended->title; ?></a></td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>Draft</td>
                              </tr> 
                            <?php } } ?>   
                        </tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade p-3" id="draft-offers" role="tabpanel" aria-labelledby="four-tab">
                      
                      <table class="table table-bordered table-striped dataTableOffer">
                        <thead>
                          <tr>
                            <th>Offer</th>
                            <th>Views</th>
                            <th>Bookings</th>
                            <th>Valid</th>
                            <th>Status</th>                          
                          </tr>
                        </thead>
                        <tbody>
                            <?php if($offers_draft_list){ foreach($offers_draft_list as $draft){ ?>
                              <tr class="">
                                <td><a href="<?php echo url('offers/edit_offer/'.$draft->id) ?>"><?php echo $draft->title; ?></a></td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>Draft</td>
                              </tr> 
                            <?php } } ?>   
                        </tbody>
                      </table>

                    </div>
                  </div>


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

<?php include viewPath('includes/footer'); ?>

<script>
  $('.dataTableOffer').DataTable();
</script>