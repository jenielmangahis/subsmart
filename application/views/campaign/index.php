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
                                <h3 class="page-title float-left">Campaign 360</h3>
                                <div class="pull-right">
                                    <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCampaignBlast"><i class="fa fa-plus"></i> Create Campaign Blast</a><br />
                                </div>   
                                <div class="alert alert-warning col-md-12 mt-4 mb-4 row" role="alert">
                                    <span style="color:black;">
                                        Be one step ahead of your competition. Narrow your target audience and connect with your new potential customers..
                                    </span>
                                </div>

                                <!-- Main content -->
                                <section class="content">
                                    <hr />
                                    <!-- Default box -->
                                    <div class="box">                
                                        <div class="box-body" >                  

                                            <div class="row">
                                                <div class="col-sm-12" style="">
                                                    <input style="display:inline-block; width: 325px;" type="text" class="form-control form-control-md margin-right-sec pac-target-input" id="address" placeholder="Search address, city, state" autocomplete="off">                       
                                                </div>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <div class="col-sm-10" style="">

                                                    <div id="gmap-directions">
                                                        <div class="mapouter">
                                                            <div class="gmap_canvas">
                                                                <iframe style="width: 100% !important;" width="850" height="650" id="gmap_canvas" src="https://maps.google.com/maps?q=6866%20Pine%20Forest%20Road%20&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                            </div>
                                                        </div>                          

                                                    </div><!--/gmap-directions-->

                                                </div>
                                                <div class="col-sm-2" style="">
                                                    <div class="map-menu-cnt">
                                                        <div class="weight-medium">Your selects</div>
                                                        <div id="finder-filters-target">Consumer</div>
                                                        <div id="finder-filters"></div>
                                                        <hr>
                                                        <div>
                                                            <div class="margin-bottom-sec">
                                                                <span class="weight-medium">You want</span><br>
                                                                <div>
                                                                    <input class="form-control form-control-md margin-right-sec" id="finder-qtyrequested" style="width: 100px; margin-top: 5px; display: inline-block;" type="text" name="" value="25"> leads
                                                                </div>
                                                            </div>
                                                            <button id="finder-btn-preview" data-on-click-label="Search Leads..." class="btn btn-primary">Search Leads</button>
                                                        </div>
                                                        <hr>
                                                        <table class="margin-bottom-sec">
                                                            <tbody>
                                                                <tr>
                                                                    <td><span class="margin-right-sec">Leads found:</span></td>
                                                                    <td><span id="finder-qtycount">0</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="margin-right-sec">Postcards to send:</span></td>
                                                                    <td><span id="finder-qtydesired">0</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="margin-right-sec">Price per card:</span></td>
                                                                    <td><span id="finder-price-item">$1.10</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="weight-medium">Total Price:</span></td>
                                                                    <td><span id="finder-price-total">$0.00</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <button class="btn btn-primary disabled" id="finder-btn-submit" data-on-click-label="Saving...">Continue »</button>
                                                    </div>
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