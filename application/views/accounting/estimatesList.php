<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card"> 
            <div class="container-fluid" style="font-size:14px;">
                <div class="row">
                    <div class="col">
                        <h3 class="m-0">Estimates</h3>
                    </div>
                </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
                Create an estimate when you want to give your customer a quote, bid, or proposal for work you plan to do. There are 3 forms of estimate:  standard, options and bundle (package)  The estimate can later be turned into a sales order or an invoice.  With this layout you will be able to monitor the status of each estimate. 
                    </div>
                <div class="row">
                    <div class="col">
                        <!-- <h1 class="m-0">Estimates</h1> -->
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                             <a class="btn btn-primary btn-md" href="#" data-toggle="modal" data-target="#newJobModal">
                                <span class="fa fa-pencil"></span> &nbsp; Add Estimate
                            </a>
                        </div>
                    </div>
                </div>

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

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <?php if (!empty($estimates)) { ?>
                            <table class="table table-hover table-to-list" data-id="work_orders">
                                <thead>
                                <tr>
                                    <!--                                    <th>-->
                                    <!--                                        <div class="table-name">-->
                                    <!--                                            <div class="checkbox checkbox-sm select-all-checkbox">-->
                                    <!--                                                <input type="checkbox" name="id_selector" value="0" id="select-all"-->
                                    <!--                                                       class="select-all">-->
                                    <!--                                                <label for="select-all"></label>-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="table-nowrap">Work Order#</div>-->
                                    <!--                                        </div>-->
                                    <!--                                    </th>-->
                                    <th>Estinate#</th>
                                    <th>Date</th>
                                    <th>Job & Customer</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($estimates as $estimate) { ?>
                                    <tr>
                                        <!--                                        <td>-->
                                        <!--                                            <div class="table-name">-->
                                        <!--                                                <div class="checkbox checkbox-sm">-->
                                        <!--                                                    <input type="checkbox" name="id[-->
                                        <?php //echo $estimate->id ?><!--]"-->
                                        <!--                                                           value="-->
                                        <?php //echo $estimate->id ?><!--"-->
                                        <!--                                                           class="select-one"-->
                                        <!--                                                           id="estimate_id_-->
                                        <?php //echo $estimate->id ?><!--">-->
                                        <!--                                                    <label for="estimate_id_-->
                                        <?php //echo $estimate->id ?><!--"></label>-->
                                        <!--                                                </div>-->
                                        <!--                                                <div><a class="a-default table-nowrap" href="">-->
                                        <!--                                                        WO-00--><?php //echo $estimate->id ?>
                                        <!--                                                    </a>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                        </td>-->
                                        <td>
                                            <a class="a-default"
                                               href="#">
                                                <?php echo $estimate->estimate_number; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="table-nowrap">
                                                <?php echo date('M d, Y', strtotime($estimate->estimate_date)) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div><a href="#"><?php echo $estimate->job_name; ?></a></div>
                                            <a href="<?php echo base_url('customer/view/' . $estimate->customer_id) ?>">
                                                <?php echo get_customer_by_id($estimate->customer_id)->contact_name ?>
                                            </a>
                                        </td>
                                        <td><?php echo $estimate->status ?></td>
                                        <td>
                                            <?php if (is_serialized($estimate->estimate_eqpt_cost)) { ?>
                                                $<?php echo unserialize($estimate->estimate_eqpt_cost)['eqpt_cost'] ?>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-btn">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('estimate/view/' . $estimate->id) ?>"><span
                                                                    class="fa fa-file-text-o icon"></span> View</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>"><span
                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    </li>
                                                    <li role="separator" class="divider"></li>
                                                    <li role="presentation"><a role="menuitem"
                                                                               tabindex="-1"
                                                                               href="#"
                                                                               data-toggle="modal"
                                                                               data-target="#modalCloneWorkorder"
                                                                               data-id="<?php echo $estimate->id ?>"
                                                                               data-name="WO-00433"><span
                                                                    class="fa fa-files-o icon clone-workorder">

                                                        </span> Clone Work Order</a>
                                                    </li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('invoice') ?>"
                                                                               data-convert-to-invoice-modal="open"
                                                                               data-id="161983"
                                                                               data-name="WO-00433"><span
                                                                    class="fa fa-money icon"></span> Create Invoice</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>" class="">
                                                        <span class="fa fa-file-pdf-o icon"></span>  View PDF</a></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" target="_new" href="<?php echo base_url('estimate/print/' . $estimate->id) ?>" class="">
                                                        <span class="fa fa-print icon"></span>  Print</a></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                        <span class="fa fa-envelope-open-o icon"></span>  Send to Customer</a></li>
                                                    <li><div class="dropdown-divider"></div></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" href="<?php echo base_url('estimate/delete/' . $estimate->id) ?>>" onclick="return confirm('Do you really want to delete this item ?')" data-delete-modal="open"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>

                            </table>
                        <?php } else { ?>
                            <div class="page-empty-container">
                                You have no estimates.
                            </div>
                        <?php } ?>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
                

    <div class="modal fade" id="newJobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 row">
                    <div class="col-md-9 form-group" style="z-index:2;">
                        <label for="exampleFormControlSelect1">Select Job</label>
                        <select class="form-control" id="selectExistingJob">
                        <option value="" selected disabled hidden>Select</option>
                        <?php foreach($jobs as $job) : ?>
                            <option value="<?php echo $job->job_number; ?>">Job <?php echo $job->job_number; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 form-group" style="margin-top: 6px;">
                        <label for="exampleFormControlSelect1"></label><br>
                        <a class="btn btn-primary" id="btnExistingJob" href="javascript:void(0)">
                            GO
                        </a>
                    </div>
                    <div class="col-md-12 text-center form-group" style="margin-top: 6px;">
                        <label for="exampleFormControlSelect1">Or</label>
                    </div>
                    <div class="col-md-12 text-center form-group" style="margin-top: 6px;">
                        <a class="btn btn-primary" href="<?php echo base_url('job/new_job') ?>">
                            New Job
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer_accounting'); ?>
</div>
<<?php include viewPath('accounting/workorder_modal'); ?>
<div><?php include viewPath('accounting/estimate_one_modal'); ?></div>