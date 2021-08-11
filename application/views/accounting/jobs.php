<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box mx-4">
                <div class="col-lg-6 px-0">
                    <h3>Jobs</h3>
                </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                    For any business, getting customers is only half the battle; creating a job workflow will help track
                    each scheduled ticket from draft to receiving payment.
                </div>
                <br>
                <div class="row pb-2">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/sales-overview')?>"
                            class="banking-tab">Overview</a>
                        <a href="<?php echo url('/accounting/all-sales')?>"
                            class="banking-tab">All Sales</a>
                        <a href="<?php echo url('/accounting/newEstimateList')?>"
                            class="banking-tab">Estimates</a>
                        <a href="<?php echo url('/accounting/customers')?>"
                            class="banking-tab">Customers</a>
                        <a href="<?php echo url('/accounting/deposits')?>"
                            class="banking-tab">Deposits</a>
                        <a href="<?php echo url('/accounting/listworkOrder')?>"
                            class="banking-tab">Work Order</a>
                        <a href="<?php echo url('/accounting/invoices')?>"
                            class="banking-tab">Invoices</a>
                        <a href="<?php echo url('/accounting/jobs ')?>"
                            class="banking-tab-active text-decoration-non">Jobs</a>
                        <a href="<?php echo url('/accounting/products-and-services')?>"
                            class="banking-tab">Products and Services</a>
                    </div>
                </div>


                <!-- end row -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body hid-desk pt-0"
                            style="padding-bottom:0px; padding-left:0px; padding-right:0px;">
                            <div class="row margin-bottom-ter mb-2 align-items-center"
                                style="background-color:white; padding:0px;">
                                <div class="col-auto pl-0">
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <a class="btn btn-primary btn-sm"
                                            href="<?= base_url('job/new_job1') ?>"><span
                                                class="fa fa-plus"></span> New Job</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $scheduled=$started=$approved=$invoiced=$completed=0;
                            foreach ($jobs as $job) {
                                switch ($job->status) {
                                    case'Scheduled':
                                        $scheduled++;
                                        break;
                                    case'Started':
                                        $started++;
                                        break;
                                    case'Approved':
                                        $approved++;
                                        break;
                                    case'Invoiced':
                                        $invoiced++;
                                        break;
                                    case'Completed':
                                        $completed++;
                                        break;
                                    default:
                                        break;
                                }
                            }
                        ?>
                        <div class="tab-content" id="myTabContent">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="active">
                                    <a class="nav-link active" data-toggle="tab" href="#tab1" aria-controls="tab1"
                                        aria-selected="true">All (<?= count($jobs); ?>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab2" aria-controls="tab2"
                                        aria-selected="false">Scheduled (<?= $scheduled ?>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab3" aria-controls="tab3"
                                        aria-controls="tab1" aria-selected="false">Started (<?= $started ?>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab4" aria-controls="tab4"
                                        aria-controls="tab1" aria-selected="false">Approved (<?= $approved ?>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab5" aria-controls="tab5"
                                        aria-controls="tab1" aria-selected="false">Invoiced (<?= $invoiced ?>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab6" aria-controls="tab6"
                                        aria-controls="tab1" aria-selected="false">Completed (<?= $completed ?>)</a>
                                </li>
                            </ul>
                            <br>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1" role="tab" aria-labelledby="tab1">
                                    <?php if (!empty($jobs)) { ?>
                                    <table class="table table-hover table-bordered table-striped" id="jobListTable">
                                        <thead>
                                            <tr>
                                                <!--<th class="text-center"><input type="checkbox" class="form-control" id="jobCheckbox" value=""></th>-->
                                                <th scope="col"><strong>Job Number</strong></th>
                                                <th scope="col"><strong>Date</strong></th>
                                                <th scope="col"><strong>Customer</strong></th>
                                                <th scope="col"><strong>Employee</strong></th>
                                                <th scope="col"><strong>Status</strong></th>
                                                <th scope="col"><strong>Amount</strong></th>
                                                <th scope="col"><strong>Job Types</strong></th>
                                                <th scope="col"><strong>Job Tags</strong></th>
                                                <th scope="col"><strong>Priority</strong></th>
                                                <th scope="col"><strong>Manage</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($jobs as $job) : ?>

                                            <tr>
                                                <td class="pl-3"><?= $job->job_number; ?>
                                                </td>
                                                <td class="pl-3"><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?>
                                                </td>
                                                <td class="pl-3"><?= $job->first_name.' '.$job->last_name ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->FName.' '.$job->LName ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->status; ?>
                                                </td>
                                                <td class="pl-3">$<?= number_format((float)$job->amount, 2, '.', ','); ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->job_type; ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->name; ?>
                                                </td>
                                                <td class="pl-3"><?=$job->priority; ?>
                                                </td>
                                                <td class="pl-3">
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit"
                                                            data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i
                                                                    class="fa fa-caret-down fa-sm"
                                                                    style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                            aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1"
                                                                    href="<?= base_url('job/new_job1/').$job->id; ?>"
                                                                    class="editJobTypeBtn editItemBtn">
                                                                    <span class="fa fa-pencil"></span> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url('job/job_preview/').$job->id; ?>"
                                                                    class="editItemBtn">
                                                                    <span class="fa fa-search-plus"></span> Preview
                                                                </a>
                                                            </li>
                                                            <?php if ($job->status=='Draft' || $job->status=='Scheduled') : ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    id="<?= $job->id; ?>"
                                                                    class="delete_job editItemBtn">
                                                                    <span class="fa fa-trash"></span> Delete
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <li role="separator" class="divider"></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                    <hr>
                                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                        <h5 class="page-empty-header">You haven't yet added your Jobs</h5>
                                        <p class="text-ter margin-bottom">Manage your job.</p>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                    <?php if (!empty($jobs)) { ?>
                                    <table class="table table-hover table-bordered table-striped" id="scheduledJobs">
                                        <thead>
                                            <tr>
                                                <!--<th class="text-center"><input type="checkbox" class="form-control" id="jobCheckbox" value=""></th>-->
                                                <th scope="col"><strong>Job Number</strong></th>
                                                <th scope="col"><strong>Date</strong></th>
                                                <th scope="col"><strong>Customer</strong></th>
                                                <th scope="col"><strong>Employee</strong></th>
                                                <th scope="col"><strong>Status</strong></th>
                                                <th scope="col"><strong>Amount</strong></th>
                                                <th scope="col"><strong>Job Types</strong></th>
                                                <th scope="col"><strong>Job Tags</strong></th>
                                                <th scope="col"><strong>Priority</strong></th>
                                                <th scope="col"><strong>Manage</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($jobs as $job) : ?>
                                            <?php if ($job->status == 'Scheduled'): ?>
                                            <tr>
                                                <td class="pl-3"><?= $job->job_number; ?>
                                                </td>
                                                <td class="pl-3"><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?>
                                                </td>
                                                <td class="pl-3"><?= $job->first_name.' '.$job->last_name ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->FName.' '.$job->LName ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->status; ?>
                                                </td>
                                                <td class="pl-3">$<?= number_format((float)$job->amount, 2, '.', ','); ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->job_type; ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->name; ?>
                                                </td>
                                                <td class="pl-3"><?=$job->priority; ?>
                                                </td>
                                                <td class="pl-3">
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit"
                                                            data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i
                                                                    class="fa fa-caret-down fa-sm"
                                                                    style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                            aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1"
                                                                    href="<?= base_url('job/new_job1/').$job->id; ?>"
                                                                    class="editJobTypeBtn editItemBtn">
                                                                    <span class="fa fa-pencil"></span> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url('job/job_preview/').$job->id; ?>"
                                                                    class="editItemBtn">
                                                                    <span class="fa fa-search-plus"></span> Preview
                                                                </a>
                                                            </li>
                                                            <?php if ($job->status=='Draft' || $job->status=='Scheduled') : ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    id="<?= $job->id; ?>"
                                                                    class="delete_job editItemBtn">
                                                                    <span class="fa fa-trash"></span> Delete
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <li role="separator" class="divider"></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                    <hr>
                                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                        <h5 class="page-empty-header">You haven't yet added your Jobs</h5>
                                        <p class="text-ter margin-bottom">Manage your job.</p>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
                                    <?php if (!empty($jobs)) { ?>
                                    <table class="table table-hover table-bordered table-striped" id="startedJobs">
                                        <thead>
                                            <tr>
                                                <!--<th class="text-center"><input type="checkbox" class="form-control" id="jobCheckbox" value=""></th>-->
                                                <th scope="col"><strong>Job Number</strong></th>
                                                <th scope="col"><strong>Date</strong></th>
                                                <th scope="col"><strong>Customer</strong></th>
                                                <th scope="col"><strong>Employee</strong></th>
                                                <th scope="col"><strong>Status</strong></th>
                                                <th scope="col"><strong>Amount</strong></th>
                                                <th scope="col"><strong>Job Types</strong></th>
                                                <th scope="col"><strong>Job Tags</strong></th>
                                                <th scope="col"><strong>Priority</strong></th>
                                                <th scope="col"><strong>Manage</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($jobs as $job) : ?>
                                            <?php if ($job->status == 'Started'): ?>
                                            <tr>
                                                <td class="pl-3"><?= $job->job_number; ?>
                                                </td>
                                                <td class="pl-3"><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?>
                                                </td>
                                                <td class="pl-3"><?= $job->first_name.' '.$job->last_name ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->FName.' '.$job->LName ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->status; ?>
                                                </td>
                                                <td class="pl-3">$<?= number_format((float)$job->amount, 2, '.', ','); ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->job_type; ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->name; ?>
                                                </td>
                                                <td class="pl-3"><?=$job->priority; ?>
                                                </td>
                                                <td class="pl-3">
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit"
                                                            data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i
                                                                    class="fa fa-caret-down fa-sm"
                                                                    style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                            aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1"
                                                                    href="<?= base_url('job/new_job1/').$job->id; ?>"
                                                                    class="editJobTypeBtn editItemBtn">
                                                                    <span class="fa fa-pencil"></span> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url('job/job_preview/').$job->id; ?>"
                                                                    class="editItemBtn">
                                                                    <span class="fa fa-search-plus"></span> Preview
                                                                </a>
                                                            </li>
                                                            <?php if ($job->status=='Draft' || $job->status=='Scheduled') : ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    id="<?= $job->id; ?>"
                                                                    class="delete_job editItemBtn">
                                                                    <span class="fa fa-trash"></span> Delete
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <li role="separator" class="divider"></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                    <hr>
                                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                        <h5 class="page-empty-header">You haven't yet added your Jobs</h5>
                                        <p class="text-ter margin-bottom">Manage your job.</p>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4">
                                    <?php if (!empty($jobs)) { ?>
                                    <table class="table table-hover table-bordered table-striped" id="approvedJobs">
                                        <thead>
                                            <tr>
                                                <!--<th class="text-center"><input type="checkbox" class="form-control" id="jobCheckbox" value=""></th>-->
                                                <th scope="col"><strong>Job Number</strong></th>
                                                <th scope="col"><strong>Date</strong></th>
                                                <th scope="col"><strong>Customer</strong></th>
                                                <th scope="col"><strong>Employee</strong></th>
                                                <th scope="col"><strong>Status</strong></th>
                                                <th scope="col"><strong>Amount</strong></th>
                                                <th scope="col"><strong>Job Types</strong></th>
                                                <th scope="col"><strong>Job Tags</strong></th>
                                                <th scope="col"><strong>Priority</strong></th>
                                                <th scope="col"><strong>Manage</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($jobs as $job) : ?>
                                            <?php if ($job->status == 'Approved'): ?>
                                            <tr>
                                                <td class="pl-3"><?= $job->job_number; ?>
                                                </td>
                                                <td class="pl-3"><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?>
                                                </td>
                                                <td class="pl-3"><?= $job->first_name.' '.$job->last_name ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->FName.' '.$job->LName ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->status; ?>
                                                </td>
                                                <td class="pl-3">$<?= number_format((float)$job->amount, 2, '.', ','); ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->job_type; ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->name; ?>
                                                </td>
                                                <td class="pl-3"><?=$job->priority; ?>
                                                </td>
                                                <td class="pl-3">
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit"
                                                            data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i
                                                                    class="fa fa-caret-down fa-sm"
                                                                    style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                            aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1"
                                                                    href="<?= base_url('job/new_job1/').$job->id; ?>"
                                                                    class="editJobTypeBtn editItemBtn">
                                                                    <span class="fa fa-pencil"></span> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url('job/job_preview/').$job->id; ?>"
                                                                    class="editItemBtn">
                                                                    <span class="fa fa-search-plus"></span> Preview
                                                                </a>
                                                            </li>
                                                            <?php if ($job->status=='Draft' || $job->status=='Scheduled') : ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    id="<?= $job->id; ?>"
                                                                    class="delete_job editItemBtn">
                                                                    <span class="fa fa-trash"></span> Delete
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <li role="separator" class="divider"></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                    <hr>
                                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                        <h5 class="page-empty-header">You haven't yet added your Jobs</h5>
                                        <p class="text-ter margin-bottom">Manage your job.</p>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="tab-pane" id="tab5" role="tabpanel" aria-labelledby="tab5">
                                    <?php if (!empty($jobs)) { ?>
                                    <table class="table table-hover table-bordered table-striped" id="invoicedJobs">
                                        <thead>
                                            <tr>
                                                <!--<th class="text-center"><input type="checkbox" class="form-control" id="jobCheckbox" value=""></th>-->
                                                <th scope="col"><strong>Job Number</strong></th>
                                                <th scope="col"><strong>Date</strong></th>
                                                <th scope="col"><strong>Customer</strong></th>
                                                <th scope="col"><strong>Employee</strong></th>
                                                <th scope="col"><strong>Status</strong></th>
                                                <th scope="col"><strong>Amount</strong></th>
                                                <th scope="col"><strong>Job Types</strong></th>
                                                <th scope="col"><strong>Job Tags</strong></th>
                                                <th scope="col"><strong>Priority</strong></th>
                                                <th scope="col"><strong>Manage</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($jobs as $job) : ?>
                                            <?php if ($job->status == 'Invoiced' || $job->status == 'Finished'): ?>
                                            <tr>
                                                <td class="pl-3"><?= $job->job_number; ?>
                                                </td>
                                                <td class="pl-3"><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?>
                                                </td>
                                                <td class="pl-3"><?= $job->first_name.' '.$job->last_name ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->FName.' '.$job->LName ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->status; ?>
                                                </td>
                                                <td class="pl-3">$<?= number_format((float)$job->amount, 2, '.', ','); ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->job_type; ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->name; ?>
                                                </td>
                                                <td class="pl-3"><?=$job->priority; ?>
                                                </td>
                                                <td class="pl-3">
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit"
                                                            data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i
                                                                    class="fa fa-caret-down fa-sm"
                                                                    style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                            aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1"
                                                                    href="<?= base_url('job/new_job1/').$job->id; ?>"
                                                                    class="editJobTypeBtn editItemBtn">
                                                                    <span class="fa fa-pencil"></span> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url('job/job_preview/').$job->id; ?>"
                                                                    class="editItemBtn">
                                                                    <span class="fa fa-search-plus"></span> Preview
                                                                </a>
                                                            </li>
                                                            <?php if ($job->status=='Draft' || $job->status=='Scheduled') : ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    id="<?= $job->id; ?>"
                                                                    class="delete_job editItemBtn">
                                                                    <span class="fa fa-trash"></span> Delete
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <li role="separator" class="divider"></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                    <hr>
                                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                        <h5 class="page-empty-header">You haven't yet added your Jobs</h5>
                                        <p class="text-ter margin-bottom">Manage your job.</p>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="tab-pane" id="tab6" role="tabpanel" aria-labelledby="tab6">
                                    <?php if (!empty($jobs)) { ?>
                                    <table class="table table-hover table-bordered table-striped" id="completedJobs">
                                        <thead>
                                            <tr>
                                                <!--<th class="text-center"><input type="checkbox" class="form-control" id="jobCheckbox" value=""></th>-->
                                                <th scope="col"><strong>Job Number</strong></th>
                                                <th scope="col"><strong>Date</strong></th>
                                                <th scope="col"><strong>Customer</strong></th>
                                                <th scope="col"><strong>Employee</strong></th>
                                                <th scope="col"><strong>Status</strong></th>
                                                <th scope="col"><strong>Amount</strong></th>
                                                <th scope="col"><strong>Job Types</strong></th>
                                                <th scope="col"><strong>Job Tags</strong></th>
                                                <th scope="col"><strong>Priority</strong></th>
                                                <th scope="col"><strong>Manage</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($jobs as $job) : ?>
                                            <?php if ($job->status == 'Completed'): ?>
                                            <tr>
                                                <td class="pl-3"><?= $job->job_number; ?>
                                                </td>
                                                <td class="pl-3"><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?>
                                                </td>
                                                <td class="pl-3"><?= $job->first_name.' '.$job->last_name ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->FName.' '.$job->LName ; ?>
                                                </td>
                                                <td class="pl-3"><?= $job->status; ?>
                                                </td>
                                                <td class="pl-3">$<?= number_format((float)$job->amount, 2, '.', ','); ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->job_type; ?>
                                                </td>
                                                <td class="pl-3"><?php echo $job->name; ?>
                                                </td>
                                                <td class="pl-3"><?=$job->priority; ?>
                                                </td>
                                                <td class="pl-3">
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit"
                                                            data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i
                                                                    class="fa fa-caret-down fa-sm"
                                                                    style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                            aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1"
                                                                    href="<?= base_url('job/new_job1/').$job->id; ?>"
                                                                    class="editJobTypeBtn editItemBtn">
                                                                    <span class="fa fa-pencil"></span> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url('job/job_preview/').$job->id; ?>"
                                                                    class="editItemBtn">
                                                                    <span class="fa fa-search-plus"></span> Preview
                                                                </a>
                                                            </li>
                                                            <?php if ($job->status=='Draft' || $job->status=='Scheduled') : ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    id="<?= $job->id; ?>"
                                                                    class="delete_job editItemBtn">
                                                                    <span class="fa fa-trash"></span> Delete
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <li role="separator" class="divider"></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                    <hr>
                                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                        <h5 class="page-empty-header">You haven't yet added your Jobs</h5>
                                        <p class="text-ter margin-bottom">Manage your job.</p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $(document).ready(function() {
        $('#jobListTable').DataTable({
            "lengthChange": true,
            "searching": true,
            "pageLength": 10,
            "order": [],
        });
        $('#scheduledJobs').DataTable({
            "lengthChange": true,
            "searching": true,
            "pageLength": 10,
            "order": [],
        });
        $('#startedJobs').DataTable({
            "lengthChange": true,
            "searching": true,
            "pageLength": 10,
            "order": [],
        });
        $('#approvedJobs').DataTable({
            "lengthChange": true,
            "searching": true,
            "pageLength": 10,
            "order": [],
        });
        $('#invoicedJobs').DataTable({
            "lengthChange": true,
            "searching": true,
            "pageLength": 10,
            "order": [],
        });
        $('#completedJobs').DataTable({
            "lengthChange": true,
            "searching": true,
            "pageLength": 10,
            "order": [],
        });

        $(".delete_job").on("click", function(event) {
            var ID = this.id;
            // alert(ID);
            Swal.fire({
                title: 'Continue to REMOVE this Job?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "/job/delete_job",
                        data: {
                            job_id: ID
                        }, // serializes the form's elements.
                        success: function(data) {
                            if (data === "1") {
                                window.location.reload();
                            } else {
                                alert(data);
                            }
                        }
                    });
                }
            });
        });
    });
</script>

<?php include viewPath('includes/footer_accounting');
