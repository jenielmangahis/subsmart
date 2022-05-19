<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Email Templates</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Customize the emails that are sent on different events.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">       
                        
                        <div class="card">
                            <div class="tabs">
                                <ul class="clearfix">      
                                    <li data-tab="residential">
                                        <a href="<?php echo base_url('settings/email_templates') ?>">Email Templates</a>
                                    </li>
                                    <li data-tab="commercial" class="active">
                                        <a href="<?php echo base_url('settings/sms_templates') ?>">SMS Templates</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tab Section Start -->
                            <div class="tab-content">
                                <div id="tab_residential" class="tab-panel">
                                    <table class="table table-hover table-to-list fix-reponsive-table">
                                        <thead>
                                            <tr>
                                                <th><strong>Template Name</strong></th>
                                                <th><strong>Details</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                    <tr>
                                                <td colspan="3" style="background: #f5f5f5;" data-title="Template Name">
                                                    <span class="bold">Invoice</span>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Create and send invoice</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                            <tr>
                                                <td colspan="3" style="background: #f5f5f5;" data-title="Template Name">
                                                    <span class="bold">Estimate</span>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Create and send estimate</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                            <tr>
                                                <td colspan="3" style="background: #f5f5f5;" data-title="Template Name">
                                                    <span class="bold">Schedule</span>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Create Appointment</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Appointment Reminder</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Cancel appointment</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">On My Way</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">On My Way - Late Arrival</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                            <tr>
                                                <td colspan="3" style="background: #f5f5f5;" data-title="Template Name">
                                                    <span class="bold">Work Order</span>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Start Work</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Pause Work</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Complete Work</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                            <tr>
                                                <td colspan="3" style="background: #f5f5f5;" data-title="Template Name">
                                                    <span class="bold">Credit Notes</span>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Create and send credit note</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                            <tr>
                                                <td colspan="3" style="background: #f5f5f5;" data-title="Template Name">
                                                    <span class="bold">Ask For Review</span>
                                                </td>
                                            </tr>
                                                    <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Ask For Review</a></td>
                                                <td data-title="Details">
                                                                    <span class="text-ter">Default template</span>
                                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr>
                                                        </tbody>
                                    </table>
                                </div>

                                <div id="tab_commercial" class="tab-panel" style="display: none;">
                                </div>
                            </div>
                            <!-- Tab Section End -->
                        </div>                                             

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/settings_modal'); ?>
<?php include viewPath('includes/footer'); ?>