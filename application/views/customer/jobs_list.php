<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #draggable { width: 150px; height: 150px; padding: 0.5em; }
</style>
<style>
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
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
                        <div class="card-body hid-desk" >
                            <div class="row margin-bottom-ter align-items-center">
                                <!-- Nav tabs -->
                                <div class="col-auto">
                                    <h2 class="page-title" style="display:inline-block;">Customer Jobs List </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="banking-tab-container mb-5">
                                        <div class="rb-01">
                                            <?php include_once('cus_module_tabs.php'); ?>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-4" >
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
                                                    <td class="pl-3">$<?= number_format((float)$job->amount, 2, '.', ',');  ?>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active standard-accordion" id="advance">
                            <div class="col-sm-12">
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/adv_cust/js_list'); ?>
<script>
$(document).ready(function () {
    $('#jobListTable').DataTable({
        "lengthChange": true,
        "searching": true,
        "pageLength": 10,
        "order": [],
    });
});
</script>
