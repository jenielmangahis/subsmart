<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/tickets_s'); ?>
    <div wrapper__section style="margin-top:2%;padding-left:1.5%;">
        <?php include viewPath('includes/notifications'); ?>
        <div class="card"> 
            <div class="container-fluid" style="font-size:14px;">
                <div class="row">
                    <div class="col">
                        <h3 class="m-0">Tickets</h3>
                    </div>
                </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
                Don't Let Your Service Desk Tickets Make it Harder to Run Your Business Effectively. Start Achieving Service Desk Excellence by tagging all your tickets and tracking them to the closed. 
                    </div>
                <div class="row">
                    <div class="col">
                        <!-- <h1 class="m-0">Estimates</h1> -->
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                             <a class="btn btn-primary btn-md" href="<?php echo base_url('customer/addTicket') ?>">
                                <span class="fa fa-pencil"></span> &nbsp; Add Tickets
                            </a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row align-items-center mb-4 margin-bottom-ter">
                    <div class="col">
                        <!-- <p class="m-0 mb-fix-list">Listing your estimates.</p> -->
                    </div>
                    <div class="col-auto text-right-sm d-flex align-items-center mb-fix-list">
                        <form style="display: inline;" class="form-inline form-search" name="form-search"
                              action="<?php echo base_url('estimate') ?>" method="get">
                            <div class="form-group m-0 mobile-form" style="margin:0 !important;">
                                <span>Search:</span> &nbsp;<input class="form-control form-control-md"
                                                                  name="search"
                                                                  value="<?php echo (!empty($search)) ? $search : '' ?>"
                                                                  type="text"
                                                                  placeholder="Search..."
                                                                  style="border-width: 1px;height: 38px !important;margin-right: 8px;">
                                <button class="btn btn-default btn-md" type="submit">
                                    <span class="fa fa-search"></span>
                                </button>
                                <?php if (!empty($search)) { ?>
                                    <a class="btn btn-default btn-md ml-2"
                                       href="<?php echo base_url('estimate') ?>"><span
                                                class="fa fa-times"></span></a>
                                <?php } ?>
                            </div>
                        </form>
                        <span class="margin-left-sec sc-2 mobile-mt-2">Sort:</span> &nbsp;
                        <div class="dropdown dropdown-inline open sc-2"><a class="btn btn-default dropdown-toggle mobile-mt-2"
                                                                      data-toggle="dropdown" aria-expanded="true"
                                                                      href="<?php echo base_url('estimate') ?>?order=added-desc">Newest
                                first <span class="caret"></span></a>
                            <ul class="dropdown-menu  btn-block" role="menu">
                                <li class="active" role="presentation"><a role="menuitem" tabindex="-1"
                                                                          href="<?php echo base_url('estimate') ?>?order=added-desc">Newest
                                        first</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('estimate') ?>?order=added-asc">Oldest
                                        first</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('estimate') ?>?order=date-accepted-desc">Accepted:
                                        newest</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('estimate') ?>?order=date-accepted-asc">Accepted:
                                        oldest</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('estimate') ?>?order=number-asc">Number:
                                        Asc</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('estimate') ?>?order=number-desc">Number:
                                        Desc</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('estimate') ?>?order=amount-asc">Amount:
                                        Lowest</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('estimate') ?>?order=amount-desc">Amount:
                                        Highest</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- MODAL CLONE WORKORDER -->
    <div class="modal fade" id="modalCloneWorkorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Clone Work Order</h4>
                </div>
                <div class="modal-body">
                    <form name="clone-modal-form">
                        <div class="validation-error" style="display: none;"></div>
                        <p>
                            You are going create a new work order based on <b>Work Order #<span
                                        class="data_workorder_id"></span></b>.<br>
                            Afterwards you can edit the newly created work order.
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button id="clone_workorder" class="btn btn-primary" type="button" data-clone-modal="submit">Clone
                        Work Order
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>
</div>