<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.row-title{
    background: #32243d; 
    color: #ffffff; 
    font-size: 15px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row p-40">
                <div class="col">
                    <h3 class="m-0">Email Templates</h3>
                </div>
                <div style="background-color:#fdeac3;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px; width:100%;margin-left: 10px;">
                    Customize your emails that are sent on different events. 
                </div>
            </div>
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"></li>
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
                                    <li data-tab="residential" class="active">
                                        <a href="<?php echo base_url('settings/email_templates') ?>">Email Templates</a>
                                    </li>
                                    <li data-tab="commercial">
                                        <a href="<?php echo base_url('settings/sms_templates') ?>">SMS Templates</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tab Section Start -->
                            <div class="tab-content">
                                <a style="float: right;" href="<?= base_url('settings/email_templates_create') ?>"  class="btn btn-sm btn-primary">
                                    <span class="fa fa-plus"></span> Add New Email Template
                                </a>
                                <br><br>
                                <?php include viewPath('flash'); ?>
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
                                            <!-- <tr>
                                                <td colspan="3" style="background: #f5f5f5;" data-title="Template Name">
                                                    <span class="bold">Invoice</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-title="Template Name"><a class="a-default" href="<?php echo base_url('settings/email_templates') ?>">Create and send invoice without online payment option</a></td>
                                                <td data-title="Details">
                                                    <span class="text-ter">Default template</span>
                                                </td>
                                                <td class="text-right" data-title="">
                                                    <a class="" href="#setupSqaureModal" data-toggle="modal" data-target="#editTemplateModal"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                </td>
                                            </tr> -->
                                            <?php foreach ($invoice_templates as $invoice_template): ?>
                                                <?php if ($invoice_template->type_id == 1) : ?>
                                                    <tr>
                                                        <td data-title="Template Name">
                                                            <a class="a-default" href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>">
                                                                <?= $invoice_template->title; ?>
                                                            </a>
                                                        </td>
                                                        <td data-title="Details">
                                                            <span class="text-ter"><?= $invoice_template->details==1 ? 'Default Template' : 'Custom Template'; ?></span>
                                                        </td>
                                                        <td class="text-right" data-title="">
                                                            <a class="" href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>" >
                                                                <span class="fa fa-pencil-square-o icon"></span> Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach ?>
                                            <tr>
                                                <td colspan="3" class="row-title" data-title="Template Name">
                                                    <span class="bold">Estimate</span>
                                                </td>
                                            </tr>
                                            <?php foreach ($invoice_templates as $invoice_template): ?>
                                                <?php if ($invoice_template->type_id == 2) : ?>
                                                    <tr>
                                                        <td data-title="Template Name">
                                                            <a class="a-default" href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>"><?= $invoice_template->title; ?></a>
                                                        </td>
                                                        <td data-title="Details">
                                                            <span class="text-ter"><?= $invoice_template->details==1 ? 'Default Template' : 'Custom Template'; ?></span>
                                                        </td>
                                                        <td class="text-right" data-title="">
                                                            <div class="dropdown dropdown-btn">
                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                               href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>"><span
                                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <a role="menuitem" class="delete-email-template" data-name="<?php echo $invoice_template->title; ?>" href="javascript:void(0);" data-id="<?php echo $invoice_template->id; ?>"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach ?>
                                             <tr>
                                                <td colspan="3" class="row-title" data-title="Template Name">
                                                    <span class="bold">Schedule</span>
                                                </td>
                                            </tr>
                                            <?php foreach ($invoice_templates as $invoice_template): ?>
                                                <?php if ($invoice_template->type_id == 3) : ?>
                                                    <tr>
                                                        <td data-title="Template Name">
                                                            <a class="a-default" href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>"><?= $invoice_template->title; ?></a>
                                                        </td>
                                                        <td data-title="Details">
                                                            <span class="text-ter"><?= $invoice_template->details==1 ? 'Default Template' : 'Custom Template'; ?></span>
                                                        </td>
                                                        <td class="text-right" data-title="">
                                                            <div class="dropdown dropdown-btn">
                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                               href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>"><span
                                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <a role="menuitem" class="delete-email-template" data-name="<?php echo $invoice_template->title; ?>" href="javascript:void(0);" data-id="<?php echo $invoice_template->id; ?>"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach ?>
                                            <tr>
                                                <td colspan="3" class="row-title" data-title="Template Name">
                                                    <span class="bold">Ask For Review</span>
                                                </td>
                                            </tr>
                                            <?php foreach ($invoice_templates as $invoice_template): ?>
                                                <?php if ($invoice_template->type_id == 4) : ?>
                                                    <tr>
                                                        <td data-title="Template Name">
                                                            <a class="a-default" href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>"><?= $invoice_template->title; ?></a>
                                                        </td>
                                                        <td data-title="Details">
                                                            <span class="text-ter"><?= $invoice_template->details==1 ? 'Default Template' : 'Custom Template'; ?></span>
                                                        </td>
                                                        <td class="text-right" data-title="">
                                                            <div class="dropdown dropdown-btn">
                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                               href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>"><span
                                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <a role="menuitem" class="delete-email-template" data-name="<?php echo $invoice_template->title; ?>" href="javascript:void(0);" data-id="<?php echo $invoice_template->id; ?>"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach ?>
                                            <tr>
                                                <td colspan="3" class="row-title" data-title="Template Name">
                                                    <span class="bold">Credit Notes</span>
                                                </td>
                                            </tr>
                                            <?php foreach ($invoice_templates as $invoice_template): ?>
                                                <?php if ($invoice_template->type_id == 5) : ?>
                                                    <tr>
                                                        <td data-title="Template Name">
                                                            <a class="a-default" href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>"><?= $invoice_template->title; ?></a>
                                                        </td>
                                                        <td data-title="Details">
                                                            <span class="text-ter"><?= $invoice_template->details==1 ? 'Default Template' : 'Custom Template'; ?></span>
                                                        </td>
                                                        <td class="text-right" data-title="">
                                                            <div class="dropdown dropdown-btn">
                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                               href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>"><span
                                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <a role="menuitem" class="delete-email-template" data-name="<?php echo $invoice_template->title; ?>" href="javascript:void(0);" data-id="<?php echo $invoice_template->id; ?>"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="tab_commercial" class="tab-panel" style="display: none;">
                                </div>
                            </div>
                            <!-- Tab Section End -->
                        </div>                                             

                        <!-- Modal Delete Checklist -->
                        <div class="modal fade bd-example-modal-md" id="modalDeleteEmailTemplate" tabindex="-1" role="dialog" aria-labelledby="modalDeleteEmailTemplateTitle" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <?php echo form_open_multipart('settings/delete_email_template', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                              <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'tid'));?>
                              <div class="modal-body">
                                  <p>Are you sure you want to delete email template <span class="email-template-name"></span>?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-danger">Yes</button>
                              </div>
                              <?php echo form_close(); ?>
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
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/settings_modal'); ?>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $(".delete-email-template").click(function(){
        var template_name = $(this).attr('data-name');
        var tid = $(this).attr('data-id');

        $("#tid").val(tid);
        $(".email-template-name").html('<b>'+template_name+'</b>');
        $("#modalDeleteEmailTemplate").modal('show');
    });
});
</script>