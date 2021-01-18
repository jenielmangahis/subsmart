<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-auto">
                                    <h2 class="page-title">Jobs</h2>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                          name="form-search"
                                          action="<?php echo base_url('job') ?>"
                                          method="get">
                                        <div class="form-group" style="margin:0 !important;">
                                            <input style="height:auto !important; font-size: 14px; margin-right:10px;"
                                                   class="form-control form-control-md"
                                                   name="search"
                                                   value="<?php echo (!empty($search)) ? $search : '' ?>"
                                                   type="text"
                                                   placeholder="Search...">
                                            <button class="btn btn-default btn-md" style="margin-right:10px;" type="submit"><span
                                                        class="fa fa-search"></span> Search</button>
                                        </div>
                                    </form>
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-md" id="newJobBtn" href="<?php echo url('job/new_job') ?>">
                                            <span class="fa fa-plus"></span> New</a>
                                        </div>
                                    </div>
                                    <div class="float-right d-md-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">   
                                <input type="hidden" id="selectedIds">
                                <?php if (!empty($jobs)) { ?>
                                <div class="dropdown" style="position: relative;display: inline-block;margin-bottom:10px;">
                                    <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;" aria-expanded="false">
                                        Batch actions&nbsp;<i class="fa fa-angle-down fa-lg" style="margin-left:10px;"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(200px, 46px, 0px);">
                                        <li><a href="#" class="dropdown-item deleteSelect">Delete selected</a></li>
                                    </ul>
                                </div>
                                <table class="table table-hover table-bordered table-striped" style="width:100%;" id="jobListTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" class="form-control" id="jobCheckbox" value=""></th>
                                            <th scope="col"><strong>Job Number</strong></th>
                                            <th scope="col"><strong>Date</strong></th>
                                            <th scope="col"><strong>Job & Customer</strong></th>
                                            <th scope="col"><strong>Status</strong></th>
                                            <th scope="col"><strong>Amount</strong></th>
                                            <th scope="col"><strong>Job Type</strong></th>
                                            <th scope="col"><strong>Priority</strong></th>
                                            <th scope="col"><strong>Manage</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach($jobs as $job) : ?>
                                        <tr>
                                            <td class="text-center"><input type="checkbox" class="jobCheckboxTd" data-id="<?php echo $job->id; ?>" value=""></td>
                                            <td class="pl-3"><?php echo $job->job_number; ?></td>
                                            <td class="pl-3"><?php echo date_format(date_create($job->date_created),"Y/m/d"); ?></td>
                                            <td class="pl-3"><?php echo ucwords($job->job_name); ?> - <?php echo getCustomerFullName($job->customer_id); ?></td>
                                            <td class="pl-3"><?php echo $job->status; ?></td>
                                            <td class="pl-3">$0.00</td>
                                            <td class="pl-3"><?php echo $job->status; ?></td>
                                            <td class="pl-3"><?php echo ucfirst($job->priority); ?></td>
                                            <td class="pl-3">
                                                <div class="dropdown dropdown-btn text-center">
                                                    <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url() .'job/new_job?job_num=' . $job->job_number ?>" class="editDeleteBeforeAfterBtn"><span class="fa fa-pencil-square-o icon"></span> Edit</a></li>
                                                        <li role="separator" class="divider"></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url() .'job/delete?id=' . $job->id ?>" class="editDeleteBeforeAfterBtn"><span class="fa fa-trash-o icon"></span> Delete</a></li>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="<?php echo $url->assets ?>frontend/js/job_creation/main.js"></script>