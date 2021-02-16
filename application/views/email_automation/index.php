<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
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
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card card_holder mt-0 p-20">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h3 class="page-title">Email Automation</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Listing all automations.</li>
                            </ol>
                        </div>
                        <div class="col-sm-6 pr-b10">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddEmailAutomation"><i class="fa fa-plus"></i> Add Email</button>
                                    <a href="<?php echo base_url('email_automation/templates'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Manage default templates</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-warning mt-0 mb-2" role="alert">
                    <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List of Tasks</h3>
                        </div>
                        <div class="box-body">
                          <div id="ajax-alert-container" class="ajax-alert-container"></div>
                          <?php if(!empty($email_automation_list)) { ?>
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><strong>Automation Name</strong></th>
                                    <th><strong>Event</strong></th>
                                    <th><strong>Email Sent</strong></th>
                                    <th><strong>Active</strong></th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($email_automation_list as $eul) { ?>
                                      <tr class="">
                                        <td><?php echo $eul->name; ?></td>
                                        <?php 
                                          $rule_event = str_replace("_"," ",$eul->rule_event);
                                          $rule_event = ucwords($rule_event);
                                        ?>
                                        <td><?php echo $rule_event; ?></td>
                                        <td>0 · <a href="<?php echo base_url('email_automation/view_logs/' . $eul->id); ?>">view log</a></td>
                                        <td>
                                          
                                          <div class="onoffswitch">
                                              <input type="checkbox" name="email-auto-status[]" class="onoffswitch-checkbox onoffswitch-checkbox-eAutomationStatus" data-email-automation-id="<?= $eul->id; ?>" id="email-auto-status-<?= $eul->id; ?>" <?= $eul->is_active == 1 ? 'checked=""' : ''; ?> >
                                              <label class="onoffswitch-label" for="email-auto-status-<?= $eul->id; ?>">
                                                  <span class="onoffswitch-inner"></span>
                                                  <span class="onoffswitch-switch"></span>
                                              </label>
                                          </div>                              

                                        </td>
                                        <td>
                                          <div class="dropdown dropdown-btn text-center">
                                              <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                  <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                              </button>
                                              <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                  <li role="presentation">
                                                    <a style="" class="email-automation-edit editEmailAutomationBtn" data-category-edit-modal="open" data-id="<?php echo $eul->id; ?>" href="javascript:void(0);">
                                                          <span class="fa fa-pencil-square-o icon"></span> edit
                                                    </a>
                                                  </li>
                                                  <li role="separator" class="divider"></li>
                                                  <li role="presentation">
                                                    <a class="email-automation-delete" data-category-delete-modal="open" data-id="<?php echo $eul->id; ?>" href="javascript:void(0);" data-name="<?php echo $eul->name; ?>">
                                                        <span class="fa fa-trash-o icon"></span> Delete
                                                    </a>  
                                                  </li>
                                              </ul>
                                          </div>                              
                                        </td>
                                      </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                          <?php }else{ ?>
                            <div class="center" style="margin-top:10px; margin-bottom: 20px;">
                              <h4>Send automatic emails to customers after a certain event</h4>
                              <p>Example: thank you email, service reminders, keep in touch, invoice due reminder</p>
                              <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Email Automation</a>
                            </div>
                          <?php } ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- end row -->
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/marketing_modals'); ?>  
<?php include viewPath('includes/footer_marketing'); ?>

<script>
  $('#dataTableAutomation').DataTable();
</script>
