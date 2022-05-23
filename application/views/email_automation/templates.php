<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="pull-left">
                <h1>Email Automation - Default Templates</h1>
                <a href="<?php echo url('/email_automation') ?>" class="">< Return to Automation</a>
              </div>
              <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddEmailAutomationTemplate">
                <i class="fa fa-plus"></i> Add Template
                </button>
              </div>              
              <div class="clearfix"></div>
            </section>
            <br />
            <!-- Main content -->
            <section class="content">
              <div class="card">

                <?php if($this->session->flashdata('message')) { ?>
                    <div class="row dashboard-container-1">
                        <div class="col-md-12">
                            <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>">
                              <button type="button" class="close" data-dismiss="alert">&times</button>
                              <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>                

                <table class="table table-hover table-to-list" id="dataTableAutomationTemplate" data-id="work_orders">
                    <thead>
                    <tr class="">
                        <th><strong>Name</strong></th>
                        <th><strong>Date Added</strong></th>
                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                        <?php if(!empty($email_automation_templates_list)) { ?>
                          <?php foreach($email_automation_templates_list as $template) { ?>
                            <tr class="">
                              <td><?php echo $template->name; ?></td>
                              <td><?php echo $template->date_created; ?></td>
                              <td>
                                <div class="dropdown dropdown-btn text-center">
                                    <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                        <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                        <li role="presentation">
                                          <a style="" class="template-edit editItemBtn" data-category-edit-modal="open" data-id="<?php echo $template->id; ?>" href="javascript:void(0);">
                                              <span class="fa fa-pencil-square-o icon"></span> edit
                                          </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li role="presentation">
                                          <a class="template-delete" data-category-delete-modal="open" data-id="<?php echo $template->id; ?>" href="javascript:void(0);" data-name="<?php echo $template->name; ?>">
                                              <span class="fa fa-trash-o icon"></span> Delete
                                          </a>   
                                        </li>
                                    </ul>
                                </div>                              
                              </td>
                            </tr>
                          <?php } ?>
                        <?php }else{ ?>
                          <tr>
                            <td colspan="3">No Default Template Yet</td>
                          </tr>
                        <?php } ?>
                    <tbody>
                    </tbody>

                </table>    

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
  $('#dataTableAutomationTemplate').DataTable();
</script>