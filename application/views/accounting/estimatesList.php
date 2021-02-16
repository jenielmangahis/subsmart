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
                        <h1 class="m-0">Estimates</h1>
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                             <a class="btn btn-primary btn-md" href="#" data-toggle="modal" data-target="#newJobModal">
                                <span class="fa fa-pencil"></span> &nbsp; Add Estimate
                            </a>
                        </div>
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