<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php //include viewPath('includes/sidebars/estimate'); ?>
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <?php //include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <!-- Content Header (Page header) -->
            <section class="content-header">

              <div class="pull-left">
                <h1>Email Automation</h1>
                <p>Listing all automations.</p>
              </div>
              <div class="pull-right">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddEmailAutomation">
                <i class="fa fa-plus"></i> Add Email Automation
                </button>
                <a href="<?php echo base_url('email_automation/templates'); ?>" style="color:#259e57 !important; margin-top:10px; display: block;">Manage default templates</a>
              </div>              
              <div class="clearfix"></div>
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="card">
                <div id="ajax-alert-container" class="ajax-alert-container"></div>
                <?php if(!empty($email_automation_list)) { ?>
                  <table class="table table-hover table-to-list" id="dataTableAutomation" data-id="work_orders">
                      <thead>
                      <tr class="">
                          <th><strong>Automation Name</strong></th>
                          <th><strong>Event</strong></th>
                          <th><strong>Email Sent</strong></th>
                          <th><strong>Active</strong></th>
                          <th>&nbsp;</th>

                      </tr>
                      </thead>
                        <?php foreach($email_automation_list as $eul) { ?>
                          <tr class="">
                            <td><?php echo $eul->name; ?></td>
                            <?php 
                              $rule_event = str_replace("_"," ",$eul->rule_event);
                              $rule_event = ucwords($rule_event);
                            ?>
                            <td><?php echo $rule_event; ?></td>
                            <td><?php echo '0' ?></td>
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
                      <tbody>
                      </tbody>

                  </table>    
                <?php } else { ?>
                  <div class="center" style="margin-top:10px; margin-bottom: 20px;">
                    <h4>Send automatic emails to customers after a certain event</h4>
                    <p>Example: thank you email, service reminders, keep in touch, invoice due reminder</p>
                    <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Email Automation</a>
                  </div>
                <?php } ?>   

              </div>
  

                         

            </section>
            <!-- /.content -->
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<?php include viewPath('includes/marketing_modals'); ?>  
<?php include viewPath('includes/footer_marketing'); ?>

<script>
  $('#dataTableAutomation').DataTable();
</script>