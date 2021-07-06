<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px; padding-left:0px; padding-right:0px;">
                            <div class="row margin-bottom-ter align-items-center" style="background-color:white; padding:0px;">
                                <div class="col-auto">
                                    <h5 class="page-title">Job Tags</h5>
                                    <span>
                                        In our software, jobs are project that an invoice will need to be issued for payment.
                                        This will help organize your projects into categories and will help you see the profitability of your business based on the various job type.
                                    </span>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-sm" data-toggle="modal" id="newJobTypeBtn" data-target="#newJobTypeModal" href="<?php echo url('job/new_job') ?>">
                                                <span class="fa fa-plus"></span> Add New Job
                                            </a>
                                        </div>
                                    </div>
                                    <div class="float-right d-md-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">   
                            <hr>                           
                                <table class="table table-hover table-bordered table-striped" style="width:100%;" id="jobTypeTable">
                                    <thead>
                                        <tr>
                                            <th scope="col"><strong>Job Type</strong></th>
                                            <th scope="col"><strong>Manage</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($jobtypes as $jobtype) : ?>
                                            <tr>
                                                <td class="pl-3"><?php echo $jobtype->value?></td>
                                                <td class="pl-3">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#newJobTypeModal" data-id="<?php echo $jobtype->id; ?>" data-jobtype="<?php echo $jobtype->value; ?>" class="editJobTypeBtn btn btn-warning btn-sm"><span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                    <a href="<?php echo base_url() .'job/deleteJobType?id=' . $jobtype->id ?>" data-id="<?php echo $jobtype->id; ?>" data-jobtype="<?php echo $jobtype->value; ?>" class="deleteJobTypeBtn btn btn-danger btn-sm"><span class="fa fa-trash"></span> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="newJobTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Job Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="invoice_job_location">Job Type</label>
                                    <input type="text" class="form-control" name="settingType" id="settingType">
                                    <input type="hidden" name="settingTypeId" id="settingTypeId">
                                    <span style="display:none; color:red; font-size:12px;" id="error_settingType">This field is required</span>
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="jobTypeAddAnotherBtn">Add Another</button>
                        <button type="button" class="btn btn-primary" id="jobTypeAddCloseBtn">Add & Close</button>
                        <button type="button" class="btn btn-primary" style="display:none;" id="jobTypeEditBtn">Edit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>