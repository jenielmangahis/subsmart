<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <?php include viewPath('includes/sidebars/job_settings'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row margin-bottom-ter align-items-center" style="background-color:white; padding:0px;">
                                <div class="col-auto">
                                    <h2 class="page-title">Job Type</h2>
                                    <span>Define the different job types</span>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-md" data-toggle="modal" data-target="#newJobTypeModal"
                                                href="<?php echo url('job/new_job') ?>"><span
                                                        class="fa fa-plus"></span> New</a>
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
                                <?php if (!empty($jobtypes)) { ?>
                                <table class="table table-hover" style="width:100%;" id="jobTypeTable">
                                    <thead>
                                        <tr>
                                            <th scope="col"><strong>Job Type</strong></th>
                                            <th scope="col"><strong>Manage</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($jobtypes as $jobtype) : ?>
                                            <tr>
                                                <td class="pl-3"><?php echo $jobtype->setting_type?></td>
                                                <td class="pl-3">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#newJobTypeModal" data-id="<?php echo $jobtype->job_settings_id; ?>" data-jobtype="<?php echo $jobtype->setting_type; ?>" class="editJobTypeBtn btn btn-warning btn-sm"><span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                <a href="<?php echo base_url() .'job/deleteJobType?id=' . $jobtype->job_settings_id ?>" data-id="<?php echo $jobtype->job_settings_id; ?>" data-jobtype="<?php echo $jobtype->setting_type; ?>" class="deleteJobTypeBtn btn btn-danger btn-sm"><span class="fa fa-trash"></span> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>  
                                <?php } else { ?>
                                    <div class="page-empty-container">
                                        <h5 class="page-empty-header">There are no Job Types</h5>
                                        <p class="text-ter margin-bottom">Manage your job types.</p>
                                    </div>
                                <?php } ?>
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
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="jobTypeAddAnotherBtn">Add Another</button>
                        <button type="button" class="btn btn-primary" id="jobTypeAddCloseBtn">Add & Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="<?php echo $url->assets ?>frontend/js/job_creation/main.js"></script>