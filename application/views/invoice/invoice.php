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
                                    <h2 class="page-title">Invoices</h2>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                          name="form-search"
                                          action="<?php echo base_url('invoice') ?>"
                                          method="get">
                                        <div class="form-group" style="margin:0 !important;">
                                            <input style="height:auto !important; font-size: 14px; margin-right:10px;"
                                                   class="form-control form-control-md"
                                                   name="search"
                                                   value="<?php echo (!empty($search)) ? $search : '' ?>"
                                                   type="text"
                                                   placeholder="Search...">
                                            <button class="btn btn-primary btn-md" style="margin-right:10px;" type="submit"><span
                                                        class="fa fa-search"></span> Search</button>
                                        </div>
                                    </form>
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-md" data-toggle="modal" data-target="#newJobModal"
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
                                <?php if (!empty($invoices)) { ?>
                                <table class="table table-hover" style="width:100%;" id="invoiceTable">
                                    <thead>
                                        <tr>
                                            <th scope="col"><strong>Invoice Number</strong></th>
                                            <th scope="col"><strong>Date</strong></th>
                                            <th scope="col"><strong>Job & Customer</strong></th>
                                            <th scope="col"><strong>Status</strong></th>
                                            <th scope="col"><strong>Amount</strong></th>
                                            <th scope="col"><strong>Manage</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($invoices as $invoice) : ?>
                                            <tr>
                                                <td class="pl-3"><?php echo $invoice->invoice_number?></td>
                                                <td class="pl-3"><?php echo date_format(date_create($invoice->created_date),"d/m/Y"); ?></td>
                                                <td class="pl-3"><?php echo getLoggedFullName($invoice->customer_id)?></td>
                                                <td class="pl-3"><?php echo ucwords($invoice->status); ?></td>
                                                <td class="pl-3">$0.00</td>
                                                <td class="pl-3">
                                                    <a href="<?php echo base_url() .'job/new_job?job_num=' . $invoice->invoice_id ?>" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                <a href="<?php echo base_url() .'job/delete?id=' . $invoice->invoice_id ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>  
                                <?php } else { ?>
                                    <div class="page-empty-container">
                                        <h5 class="page-empty-header">You haven't yet added your invoice</h5>
                                        <p class="text-ter margin-bottom">Manage your invoice.</p>
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
<?php include viewPath('includes/footer'); ?>