<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/customer'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">


                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="page-title">Service Tickets</h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <?php if (hasPermissions('WORKORDER_MASTER')): ?>
                                                <a class="btn btn-primary btn-md"
                                                   href="<?php echo url('customer/tickets/add') ?>"><span
                                                            class="fa fa-plus"></span> New Ticket</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-md-6">
                                    <p>
                                        Listing all your service tickets
                                    </p>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                          name="form-search"
                                          action="<?php echo base_url('customer/tickets') ?>"
                                          method="get">
                                        <div class="form-group" style="margin:0 !important;">
                                            <span>Search:</span> &nbsp;
                                            <input style="height:auto !important; font-size: 14px; margin-right:10px;"
                                                   class="form-control form-control-md"
                                                   name="search"
                                                   value="<?php echo (!empty($search)) ? $search : '' ?>"
                                                   type="text"
                                                   placeholder="Search...">
                                            <button class="btn btn-default btn-md" type="submit"><span
                                                        class="fa fa-search"></span></button>
                                            <?php if (!empty($search)) { ?>
                                                <a class="btn btn-default btn-md ml-2"
                                                   href="<?php echo base_url('items') ?>"><span
                                                            class="fa fa-times"></span></a>
                                            <?php } ?>
                                        </div>
                                    </form>

<!--                                    <a class="btn btn-default btn-md margin-left-sec"-->
<!--                                       href="--><?php //echo base_url('items/export?data_type=csv') ?><!--"-->
<!--                                       target="_blank"><span class="fa fa-download"></span> &nbsp; Export</a>-->
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                                <?php if (!empty($customerTickets)) { ?>
                                    <table class="table table-hover table-to-list" data-id="work_orders">
                                        <thead>
                                        <tr>
                                            <th>Ticket#</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($customerTickets)) { ?>
                                            <?php foreach ($customerTickets as $customerTicket): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $customerTicket->ticket_number ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url('customer/view/' . $customerTicket->customer_id) ?>">
                                                            <?php echo get_customer_by_id($customerTicket->customer_id)->contact_name ?>
                                                            <p><?php echo get_customer_by_id($customerTicket->customer_id)->contact_email ?></p>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php echo date('M d, Y', strtotime($customerTicket->ticket_date)) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo dollar_format($customerTicket->grand_total) ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-btn open">
                                                            <button class="btn btn-default dropdown-toggle" type="button"
                                                                    id="dropdown-edit" data-toggle="dropdown"
                                                                    aria-expanded="true">
                                                                <span class="btn-label">Manage</span><span
                                                                        class="caret-holder"><span
                                                                            class="caret"></span></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                                aria-labelledby="dropdown-edit">

                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                           href="<?php echo base_url('customer/tickets/edit/' . $customerTicket->id) ?>"><span
                                                                                class="fa fa-pencil-square-o icon"></span>
                                                                        Edit</a></li>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                           data-delete-modal="open"
                                                                                           data-ticket-id="<?php echo $customerTicket->id ?>"
                                                                                           onclick="return confirm('Do you really want to delete this item ?')"
                                                                                           href="<?php echo base_url('customer/tickets/delete/' . $customerTicket->id) ?>"><span
                                                                                class="fa fa-trash-o icon"></span>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php } ?>
                                        </tbody>

                                    </table>
                                <?php } else { ?>
                                    <p class="text-center">No items found.</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable();

</script>