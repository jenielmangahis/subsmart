<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Reports</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/reports')?>" class="banking-tab">Standard</a>
                                    <a href="<?php echo url('/accounting/reports/custom')?>" class="banking-tab">Custom Reports</a>
                                    <a href="<?php echo url('/accounting/reports/management')?>" class="banking-tab-active text-decoration-none">Management Reports</a>
                                    <a href="<?php echo url('/accounting/reports/activities')?>" class="banking-tab">Activities Reports</a>
                                    <a href="<?php echo url('/accounting/reports/analytics')?>" class="banking-tab">Analytics</a>
                                    <a href="<?php echo url('/accounting/reports/payscale')?>" class="banking-tab">PayScale</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="px-4 pb-4">
                                    <table id="manage_reports_table"
                                        class="table table-striped table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>CREATED BY</th>
                                                <th>LAST MODIFIED</th>
                                                <th>REPORT PERIOD</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($management_reports as $report) {
                                                ?>
                                            <tr>
                                                <td><?=$report->template_name?></td>
                                                <td><?php if ($report->created_by == 0) {
                                                    echo "nSmarTrac";
                                                } else {
                                                    $user_details = $this->users_model->getUser($report->created_by);
                                                    if($user_details != null){
                                                        $lname=$user_details->LName;
                                                        echo $user_details->FName." ".strtoupper($lname[0]).".";
                                                    }
                                                } ?>
                                                </td>
                                                <td>

                                                <?php
                                                if ($report->updated_by > 0) {
                                                    $user_details = $this->users_model->getUser($report->updated_by);
                                                    if($user_details != null){
                                                        $lname=$user_details->LName;
                                                        echo $user_details->FName." ".strtoupper($lname[0]).".";
                                                    }
                                                        
                                                }?>
                                                </td>
                                                <td>
                                                    <select class="form-control " name="filter_date">
                                                        <option <?php if($report->report_period=="All Dates"){echo "selected";}?>>All Dates</option>
                                                        <option <?php if($report->report_period=="Custom"){echo "selected";}?>>Custom</option>
                                                        <option <?php if($report->report_period=="Today"){echo "selected";}?>>Today </option>
                                                        <option <?php if($report->report_period=="This Week"){echo "selected";}?>>This Week </option>
                                                        <option <?php if($report->report_period=="This Week-to-date"){echo "selected";}?>>This Week-to-date </option>
                                                        <option <?php if($report->report_period=="This Month"){echo "selected";}?>>This Month </option>
                                                        <option <?php if($report->report_period=="This Month-to-date"){echo "selected";}?>>This Month-to-date </option>
                                                        <option <?php if($report->report_period=="This Quarter"){echo "selected";}?>>This Quarter </option>
                                                        <option <?php if($report->report_period=="This Quarter-to-date"){echo "selected";}?>>This Quarter-to-date </option>
                                                        <option <?php if($report->report_period=="This Year"){echo "selected";}?>>This Year </option>
                                                        <option <?php if($report->report_period=="This Year-to-date"){echo "selected";}?>>This Year-to-date </option>
                                                        <option <?php if($report->report_period=="This Year-to-last-month"){echo "selected";}?>>This Year-to-last-month </option>
                                                        <option <?php if($report->report_period=="Yesterday"){echo "selected";}?>>Yesterday </option>
                                                        <option <?php if($report->report_period=="Recent"){echo "selected";}?>>Recent </option>
                                                        <option <?php if($report->report_period=="Last Week"){echo "selected";}?>>Last Week </option>
                                                        <option <?php if($report->report_period=="Last Week-to-date"){echo "selected";}?>>Last Week-to-date </option>
                                                        <option <?php if($report->report_period=="Last Month"){echo "selected";}?>>Last Month </option>
                                                        <option <?php if($report->report_period=="Last Month-to-date"){echo "selected";}?>>Last Month-to-date </option>
                                                        <option <?php if($report->report_period=="Last Quarter"){echo "selected";}?>>Last Quarter </option>
                                                        <option <?php if($report->report_period=="Last Quarter-to-date"){echo "selected";}?>>Last Quarter-to-date </option>
                                                        <option <?php if($report->report_period=="Last Year"){echo "selected";}?>>Last Year </option>
                                                        <option <?php if($report->report_period=="Last Year-to-date"){echo "selected";}?>>Last Year-to-date </option>
                                                        <option <?php if($report->report_period=="Since 30 Days Ago"){echo "selected";}?>>Since 30 Days Ago </option>
                                                        <option <?php if($report->report_period=="Since 60 Days Ago"){echo "selected";}?>>Since 60 Days Ago </option>
                                                        <option <?php if($report->report_period=="Since 90 Days Ago"){echo "selected";}?>>Since 90 Days Ago </option>
                                                        <option <?php if($report->report_period=="Since 365 Days Ago"){echo "selected";}?>>Since 365 Days Ago </option>
                                                        <option <?php if($report->report_period=="Next Week"){echo "selected";}?>>Next Week </option>
                                                        <option <?php if($report->report_period=="Next 4 Weeks"){echo "selected";}?>>Next 4 Weeks </option>
                                                        <option <?php if($report->report_period=="Next Month"){echo "selected";}?>>Next Month </option>
                                                        <option <?php if($report->report_period=="Next Quarter"){echo "selected";}?>>Next Quarter </option>
                                                        <option <?php if($report->report_period=="Next Year"){echo "selected";}?>>Next Year </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="dropdown dropdown-btn">
                                                        <a href="#" class="view-management_report" data-id="<?=$report->id?>">View</a>
                                                        <a type="button" id="dropdown-button-icon"
                                                            data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label"><i
                                                                    class="fa fa-chevron-down"></i></span>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right report_options"
                                                            role="menu" aria-labelledby="dropdown-edit"
                                                            x-placement="bottom-end">
                                                            <li class="edit" data-id="<?=$report->id?>"
                                                                data-target="#management_reports_modal">
                                                                <a href="javascript:void(0)">
                                                                    Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)" class="send-email" data-target="#management_reports_email_modal"  data-id="<?=$report->id?>" data-report="<?=$report->template_name?>" data-company="<?=$company_details->business_name?>">
                                                                    Send
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)" class="export-pdf" data-id="<?=$report->id?>" data-report="<?=$report->template_name?>" data-company="<?=$company_details->business_name?>">
                                                                    Export as PDF
                                                                </a>
                                                            </li>
                                                            <li style="display: none;">
                                                                <a href="javascript:void(0)"
                                                                    class="export-docx" data-id="<?=$report->id?>">
                                                                    Export as DOCX
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="time-activity-btn"
                                                                    data-toggle="modal" data-target="#">
                                                                    Copy
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
<?php include viewPath('accounting/reports/management_reports/management_reports_modal'); ?>
<?php include viewPath('accounting/reports/management_reports/management_reports_viewer_modal'); ?>
<?php include viewPath('accounting/reports/management_reports/management_reports_email_modal'); ?>
<?php include viewPath('includes/footer_accounting'); ?>