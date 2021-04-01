<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card"> 
            <div class="container-fluid" style="font-size:14px;">
                <div class="row">
                    <div class="col">
                        <h1 class="m-0">Checklists</h1>
                    </div>
                        <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
                        Create great check list for employees or subcontractor to follow a series of item listings to meet all of your company’s requirements, expectations or reminders.  This can be attached to estimate, workorder, invoices.  A powerful addition to your forms.    
                        </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                            <a class="btn btn-primary btn-md" href="<?php echo base_url('/workorder/add_checklist') ?>">
                                <span class="fa fa-plus"></span> &nbsp; Add Checklist
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <?php if (!empty($checklists)) { ?>
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

                                <?php foreach ($workorders as $workorder) { ?>
                                    <tr>
                                        <td>
                                            <div class="table-name">
                                                <div class="checkbox checkbox-sm">
                                                    <input type="checkbox" name="id[<?php echo $workorder->id ?>]"
                                                           value="<?php echo $workorder->id ?>"
                                                           class="select-one"
                                                           id="work_order_id_<?php echo $workorder->id ?>">
                                                    <label for="work_order_id_<?php echo $workorder->id ?>"></label>
                                                </div>
                                                <div><a class="a-default table-nowrap" href="">
                                                        WO-00<?php echo $workorder->id ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="a-default"
                                               href="#">
                                                <?php echo get_customer_by_id($workorder->customer_id)->contact_name ?>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="table-nowrap">
                                                <?php echo date('M d, Y', strtotime($workorder->date_issued)) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('customer/view/' . $workorder->customer_id) ?>">
                                                <?php echo get_customer_by_id($workorder->customer_id)->contact_name ?>
                                            </a>
                                            <div>Scheduled on: 30 Mar 2020, 2:00 pm to 4:00 pm</div>
                                        </td>
                                        <td><?php echo get_user_by_id($workorder->user_id)->name ?></td>
                                        <td><?php echo ($workorder->priority_id > 0)?get_priority_by_id($workorder->priority_id)->title:'' ?></td>
                                        <td><?php echo ($workorder->status_id > 0)?get_status_by_id($workorder->status_id)->title:''; ?></td>
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
                                                                               href="<?php echo base_url('workorder/view/' . $workorder->id) ?>"><span
                                                                    class="fa fa-file-text-o icon"></span> View</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>"><span
                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    </li>
                                                    <li role="separator" class="divider"></li>
                                                    <li role="presentation"><a role="menuitem"
                                                                               tabindex="-1"
                                                                               href="#"
                                                                               data-toggle="modal"
                                                                               data-target="#modalCloneWorkorder"
                                                                               data-id="<?php echo $workorder->id ?>"
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
                                                    <li role="presentation"><a role="menuitem"
                                                                               tabindex="-1"
                                                                               href="<?php echo base_url('workorder/delete/' . $workorder->id) ?>>"
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
                                <h5 class="page-empty-header">You haven't yet added your checklist</h5>
                                <p class="text-ter margin-bottom">Manage your checklist.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>
</div>