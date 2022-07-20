<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/before_after'); ?>
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
                                    <h2 class="page-title">Before and After Photos</h2>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-md" id="newJobBtn" href="<?php echo url('before-after/add_photo') ?>">
                                            <span class="fa fa-plus"></span> Add Photos</a>
                                        </div>
                                    </div>
                                    <div class="float-right d-md-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">   
                                <?php if (!empty($jobs)) { ?>
                                <table class="table table-hover" style="width:100%;" id="jobListTable">
                                    <thead>
                                        <tr>
                                            <th scope="col"><strong>Job Number</strong></th>
                                            <th scope="col"><strong>Date</strong></th>
                                            <th scope="col"><strong>Job & Customer</strong></th>
                                            <th scope="col"><strong>Status</strong></th>
                                            <th scope="col"><strong>Amount</strong></th>
                                            <th scope="col"><strong>Manage</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach($jobs as $job) : ?>
                                        <tr>
                                            <td class="pl-3"><?php echo $job->job_number; ?></td>
                                            <td class="pl-3"><?php echo date_format(date_create($job->created_date),"Y/m/d"); ?></td>
                                            <td class="pl-3"><?php echo ucwords($job->job_name); ?> - <?php echo getLoggedFullName($job->created_by); ?></td>
                                            <td class="pl-3"><?php echo $job->status; ?></td>
                                            <td class="pl-3">$0.00</td>
                                            <td class="pl-3">
                                                <a href="<?php echo base_url() .'job/new_job?job_num=' . $job->job_number ?>" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                <a href="<?php echo base_url() .'job/delete?id=' . $job->jobs_id ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>  
                                <?php } else { ?>
                                    <div class="page-empty-container">
                                        <h5 class="page-empty-header">You haven't uploaded any photos.</h5>
                                        <p class="text-ter margin-bottom">Upload and manage Before and After photos and send them to your customers.</p>
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
<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>