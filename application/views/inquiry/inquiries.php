<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inquiries'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card">


            <div class="container-fluid" style="font-size:14px;">

                <div class="row">
                    <div class="col">
                        <h1 class="m-0">Inquiries</h1>
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                            <a class="btn btn-primary btn-md" href="<?php echo base_url('inquiries/add') ?>">
                                <span class="fa fa-plus"></span> New Lead
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4 margin-bottom-ter">
                    <div class="col">
                        <p class="m-0">Listing all Inquiries.</p>
                    </div>
                    <div class="col-auto text-right-sm d-flex align-items-center">
                        <form style="display: inline;" class="form-inline form-search" name="form-search"
                              action="<?php echo base_url('inquiries') ?>" method="get">
                            <div class="form-group m-0" style="margin:0 !important;">
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
                                       href="<?php echo base_url('inquiries') ?>"><span
                                                class="fa fa-times"></span></a>
                                <?php } ?>
                            </div>
                        </form>
                        <span class="margin-left-sec">Sort:</span> &nbsp;
                        <div class="dropdown dropdown-inline"><a class="btn btn-default dropdown-toggle"
                                                                 data-toggle="dropdown" aria-expanded="false"
                                                                 href="<?php echo base_url('inquiries') ?>?order=date-issued-desc">Date
                                Issued: Newest <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-align-right btn-block" role="menu">
                                <li class="active" role="presentation"><a role="menuitem" tabindex="-1"
                                                                          href="<?php echo base_url('inquiries') ?>?order=date-issued-desc">Date
                                        Issued: Newest</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=date-issued-asc">Date
                                        Issued: Oldest</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=event-date-desc">Scheduled
                                        Date: Newest </a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=event-date-asc">Scheduled
                                        Date: Oldest </a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=date-completed-desc">Completed
                                        Date: Newest </a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=date-completed-asc">Completed
                                        Date: Oldest </a></li>
<!--                                <li role="presentation"><a role="menuitem" tabindex="-1"-->
<!--                                                           href="<?php echo base_url('inquiries') ?>?order=name-asc">Job:-->
<!--                                        A to Z</a></li>-->
<!--                                <li role="presentation"><a role="menuitem" tabindex="-1"-->
<!--                                                           href="<?php echo base_url('inquiries') ?>?order=name-desc">Job:-->
<!--                                        Z to A</a></li>-->
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=number-asc">Work
                                        Order #: A to Z</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=number-desc">Work
                                        Order #: Z to A</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=priority-asc">Priority:
                                        A to Z</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="<?php echo base_url('inquiries') ?>?order=priority-desc">Priority:
                                        Z to A</a></li>
                            </ul>
                        </div>
                    </div>
                    <div></div>
                </div>

                <div class="tabs">
                    <ul class="clearfix work__order" id="myTab" role="tablist">
                        <?php /* foreach ($inquiriesStatusFilters as $key => $statusFilter) { ?>
                            <?php if ($key === 0) { ?>
                                <li <?php echo (empty($tab_index)) ? 'class="active"' : '' ?>>
                                    <a class="nav-link active"
                                       href="<?php echo base_url('inquiries') ?>"
                                       aria-controls="tab1" aria-selected="true">All
                                        (<?php echo get_inquiries_count() ?>)</a>
                                </li>
                            <?php } ?>
                            <li <?php echo ((!empty($tab_index)) && $statusFilter->id === $tab_index) ? "class='active'" : "" ?>>
                                <a class="nav-link"
                                   id="profile-tab"
                                   data-toggle="tab<?php echo $key ?>"
                                   href="<?php echo base_url('inquiries/tab/' . $statusFilter->id) ?>"
                                   role="tab"
                                   aria-controls="profile" aria-selected="false"><?php echo $statusFilter->title ?>
                                    (<?php echo $statusFilter->total ?>)</a>
                            </li>
                        <?php } */ ?>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <?php if (!empty($inquiriess)) { ?>
                            <table class="table table-hover table-to-list" data-id="work_orders">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="table-name">
                                            <div class="checkbox checkbox-sm select-all-checkbox">
                                                <input type="checkbox" name="id_selector" value="0" id="select-all"
                                                       class="select-all">
                                                <label for="select-all"></label>
                                            </div>
                                            <div class="table-nowrap">Work Order#</div>
                                        </div>
                                    </th>
                                    <th>Job</th>
                                    <th>Date Issued</th>
                                    <th>Customer</th>
                                    <th>Employees</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($inquiriess as $inquiries) { ?>
                                    <tr>
                                        <td>
                                            <div class="table-name">
                                                <div class="checkbox checkbox-sm">
                                                    <input type="checkbox" name="id[<?php echo $inquiries->id ?>]"
                                                           value="<?php echo $inquiries->id ?>"
                                                           class="select-one"
                                                           id="work_order_id_<?php echo $inquiries->id ?>">
                                                    <label for="work_order_id_<?php echo $inquiries->id ?>"></label>
                                                </div>
                                                <div><a class="a-default table-nowrap" href="">
                                                        WO-00<?php echo $inquiries->id ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="a-default"
                                               href="#">
                                                <?php echo get_customer_by_id($inquiries->customer_id)->contact_name ?>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="table-nowrap">
                                                <?php echo date('M d, Y', strtotime($inquiries->date_issued)) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('customer/view/' . $inquiries->customer_id) ?>">
                                                <?php echo get_customer_by_id($inquiries->customer_id)->contact_name ?>
                                            </a>
                                            <div>Scheduled on: 30 Mar 2020, 2:00 pm to 4:00 pm</div>
                                        </td>
                                        <td><?php echo get_user_by_id($inquiries->user_id)->name ?></td>
                                        <td><?php echo get_priority_by_id($inquiries->priority_id)->title ?></td>
                                        <td><?php echo get_status_by_id($inquiries->status_id)->title ?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-btn">
                                                <button class="btn btn-default dropdown-toggle" type="button"
                                                        id="dropdown-edit"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span
                                                            class="caret-holder"><span
                                                                class="caret"></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                    aria-labelledby="dropdown-edit">
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('inquiries/view/' . $inquiries->id) ?>"><span
                                                                    class="fa fa-file-text-o icon"></span> View</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('inquiries/edit/' . $inquiries->id) ?>"><span
                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    </li>
                                                    <li role="separator" class="divider"></li>
                                                    <li role="presentation"><a role="menuitem"
                                                                               tabindex="-1"
                                                                               href="#"
                                                                               data-toggle="modal"
                                                                               data-target="#modalCloneinquiries"
                                                                               data-id="<?php echo $inquiries->id ?>"
                                                                               data-name="WO-00433"><span
                                                                    class="fa fa-files-o icon clone-inquiries">

                                                        </span> Clone Work Order</a>
                                                    </li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('invoice') ?>"
                                                                               data-convert-to-invoice-modal="open"
                                                                               data-id="161983"
                                                                               data-name="WO-00433"><span
                                                                    class="fa fa-money icon"></span> Create Invoice</a>
                                                    </li>
                                                    <li role="presentation"><a role="menuitem"
                                                                               tabindex="-1"
                                                                               href="<?php echo base_url('inquiries/delete/' . $inquiries->id) ?>>"
                                                                               onclick="return confirm('Do you really want to delete this item ?')"
                                                                               data-delete-modal="open" data-id="161983"
                                                                               data-name="WO-00433"><span
                                                                    class="fa fa-trash-o icon"></span> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>

                            </table>
                        <?php } else { ?>
                            <div class="page-empty-container">
                                <h5 class="page-empty-header">You haven't got any leads</h5>
                                <p class="text-ter margin-bottom">Manage your leads.</p>
                                <a class="btn btn-primary"
                                   href="<?php echo base_url('inquiries/add') ?>"><span
                                            class="fa fa-plus fa-margin-right"></span> Add New leads</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL CLONE inquiries -->
    <div class="modal fade" id="modalCloneinquiries" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                        class="data_inquiries_id"></span></b>.<br>
                            Afterwards you can edit the newly created work order.
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button id="clone_inquiries" class="btn btn-primary" type="button" data-clone-modal="submit">Clone
                        Work Order
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>
     