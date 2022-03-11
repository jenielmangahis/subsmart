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
                                    <h2 class="page-title" style="display:inline-block;">Customer Workorder List </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        Work order are are crucial to an organization’s maintenance operation. They help everyone from maintenance managers to technicians organize, assign, prioritize, track, and complete key tasks. When done well, work orders allow you to capture information, share it, and use it to get the work done as efficiently as possible. Our work order has legal headers and two (2) places where you can outline specific terms. This form will empower you team to move forward with each project without looking backward. Signature place holders and specific term(s) statements will help make this work order into a binding agreement.
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
                                        <table class="table table-hover table-to-list" id="workordersListTable">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <div class="table-name">
                                                        <div class="checkbox checkbox-sm select-all-checkbox">
                                                            <input type="checkbox" name="id_selector" value="0" id="select-all"
                                                                   class="select-all">
                                                            <label for="select-all"></label>
                                                        </div>
                                                        <div class="table-nowrap">Work Order#</div>
                                                    </div>
                                                </th>
                                                <th>Date Issued</th>
                                                <th>Customer</th>
                                                <th>Employees</th>
                                                <th>Priority</th>
                                                <th>Status</th>
                                                <th class="text-center"></th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <?php foreach ($workorders as $workorder) { ?>
                                                <tr id="w-row-<?= $workorder->id; ?>">
                                                    <td>
                                                        <div class="table-name">
                                                            <div class="checkbox checkbox-sm">
                                                                <input type="checkbox" name="id[<?php echo $workorder->id ?>]"
                                                                       value="<?php echo $workorder->id ?>"
                                                                       class="select-one"
                                                                       id="work_order_id_<?php echo $workorder->id ?>">
                                                                <label for="work_order_id_<?php echo $workorder->id ?>"></label>
                                                            </div>
                                                            <div><a class="a-default table-nowrap" href="">
                                                                    <?php echo $workorder->work_order_number ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-nowrap">
                                                            <?php echo date('M d, Y', strtotime($workorder->date_created)) ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url('customer/view/' . $workorder->customer_id) ?>">
                                                            <?php 
                                                            if(empty($workorder->first_name)){
                                                                echo $workorder->contact_name;
                                                            }else{

                                                                echo $workorder->first_name . ' ' .  $workorder->middle_name . ' ' . $workorder->last_name;
                                                            }
                                                            ?>
                                                        </a>
                                                        <div>Scheduled on: 30 Mar 2020, 2:00 pm to 4:00 pm</div>
                                                    </td>
                                                    <td><?php echo get_user_by_id($workorder->employee_id)->FName .' '. get_user_by_id($workorder->employee_id)->LName ?></td>
                                                    <td><?php echo $workorder->priority; ?></td>
                                                    <td><?php  if( $workorder->is_mail_open == 1 ){
                                                          echo "<i class='fa fa-eye'></i>  ";
                                                        } echo $workorder->w_status;  ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-btn">
                                                            <button class="btn btn-default dropdown-toggle" type="button"
                                                                    id="dropdown-edit"
                                                                    data-toggle="dropdown" aria-expanded="true">
                                                                <span class="btn-label">Manage</span><span
                                                                        class="caret-holder"><span
                                                                            class="caret"></span></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                                aria-labelledby="dropdown-edit">
                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                           href="<?php echo base_url('workorder/view/' . $workorder->id) ?>"><span
                                                                                class="fa fa-file-text-o icon"></span> View</a></li>
                                                                <li role="presentation">
                                                                <?php if($workorder->work_order_type_id == '2'){ ?>
                                                                    <a role="menuitem" tabindex="-1" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                <?php }else{ ?>
                                                                    <a role="menuitem" tabindex="-1" href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                <?php } ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
    $('#workordersListTable').DataTable({
        "lengthChange": true,
        "searching": true,
        "pageLength": 10,
        "order": [],
    });
});
</script>
