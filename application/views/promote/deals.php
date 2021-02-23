<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body" >
                            <div class="col-md-12">

                                <h3 class="page-title col-lg-6 float-left">Deals &amp; Steals</h3>
                                <div class="pull-right">
                                    <a class="btn btn-primary btn-md" href="https://www.markate.com/pro/promote/deals/main/add"><span class="fa fa-plus"></span> Create Deal</a>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4 row" role="alert">
                                    <span style="color:black;">
                                        Listing all automations
                                    </span>
                                </div>  
                                
                                <div class="col-sm-5 col-md-5 text-right float-right magbottompad">
                                    <a class="margin-right-sec" href="https://www.markate.com/pro/promote/deals/reports"><span class="fa fa fa-bar-chart fa-margin-right"></span> Stats</a>
                                    <a href="https://www.markate.com/pro/promote/deals/orders_business"><span class="fa fa-file-text-o fa-margin-right"></span> My Payments</a>
                                </div>
                            </div>

            <div class="tabs"><ul class="clearfix"><li class="active"><a href="https://www.markate.com/pro/promote/deals/main/index/tab/active">Active Deals <span>(0)</span></a></li><li><a href="https://www.markate.com/pro/promote/deals/main/index/tab/scheduled">Scheduled <span>(0)</span></a></li><li><a href="https://www.markate.com/pro/promote/deals/main/index/tab/closed">Ended <span>(0)</span></a></li><li><a href="https://www.markate.com/pro/promote/deals/main/index/tab/draft">Draft <span>(2)</span></a></li></ul></div><table class="table table-hover table-to-list fix-reponsive-table" data-id="deals">
                <thead>
                    <tr>
                        <th>Deal</th>
                        <th></th>
                        <th class="text-center">Views</th>
                        <th class="text-center">Bookings</th>
                        <th>Valid </th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <div class="row pagination-container">
                <div class="col-md-20"><ul class="pagination"></ul></div>
                <div class="col-md-4 text-right"></div>
            </div>
            <div class="modal" data-deal-close="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Close Deal</h4>
                        </div>
                        <div class="modal-body">
                            <div class="validation-error hide"></div>
                            <form name="form-modal">
                                <p>
                                    You are about to close the deal <span class="bold" data-id="dealTitle"></span>
                                </p>
                                <p class="text-ter">Please be aware that no money will be refunded for remaining period.</p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="button" data-deal-close="submit">Close the Deal</button>
                        </div>
                    </div>
                </div>
            </div><div class="modal" data-deal-renew="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Rerun Deal</h4>
                        </div>
                        <div class="modal-body">
                            <div class="validation-error hide"></div>
                            <form name="form-modal">
                                <p>
                                    Great! You are about to rerun this deal <span class="bold" data-id="dealTitle"></span> for a new period.
                                </p>
                                <p>
                                    You will be able to edit the deal, make changes if required, preview and publish it.
                                </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="button" data-deal-renew="submit">Rerun the Deal</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
