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
                                    <h2 class="page-title" style="display:inline-block;">Customer Estimate List </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        For any business, getting customers is only half the battle; creating an estimates will help knowing the quantity of work, labour, materials and funds that will be required for the entire services thus enabling us to be prepared beforehand.
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
                                        <table class="table table-hover table-to-list" id="estimateListTable">
                                            <thead>
                                            <tr>                      
                                                <th>Estinate#</th>
                                                <th>Date</th>
                                                <th>Job & Customer</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php foreach ($estimates as $estimate) { ?>
                                                <tr>
                                                    <td>
                                                        <a class="a-default"
                                                           href="#">
                                                            <?php echo $estimate->estimate_number; ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="table-nowrap">
                                                            <?php echo date('M d, Y', strtotime($estimate->estimate_date)) ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><a href="#"><?php echo $estimate->job_name; ?></a></div>
                                                        <a href="<?php echo base_url('customer/view/' . $estimate->customer_id) ?>">
                                                            <?php echo get_customer_by_id($estimate->customer_id)->first_name .' '.get_customer_by_id($estimate->customer_id)->last_name ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                            <?php echo $estimate->estimate_type; ?>
                                                    </td>
                                                    <td>
                                                      <?php
                                                        if( $estimate->is_mail_open == 1 ){
                                                          echo "<i class='fa fa-eye'></i>  ";
                                                        }
                                                        echo $estimate->status;
                                                      ?>

                                                    </td>
                                                    <td>
                                                            <?php 
                                                            $total1 = $estimate->option1_total + $estimate->option2_total;
                                                            $total2 = $estimate->bundle1_total + $estimate->bundle2_total;

                                                            if($estimate->estimate_type == 'Option')
                                                            {
                                                                echo '$ '.$total1;
                                                            }
                                                            elseif($estimate->estimate_type == 'Bundle')
                                                            {
                                                                echo '$ '.$total2;
                                                            }
                                                            else
                                                            {
                                                                echo '$ '.$estimate->grand_total; 
                                                            }
                                                            
                                                            ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-btn">
                                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                           href="<?php echo base_url('estimate/view/' . $estimate->id) ?>"><span
                                                                                class="fa fa-file-text-o icon"></span> View Estimate</a></li>

                                                                <?php if($estimate->estimate_type == 'Standard'){ ?>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                           href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>"><span
                                                                                class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                </li>
                                                                <?php }elseif($estimate->estimate_type == 'Option'){ ?>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                           href="<?php echo base_url('estimate/editOption/' . $estimate->id) ?>"><span
                                                                                class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                </li>
                                                                <?php }else{ ?>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                           href="<?php echo base_url('estimate/editBundle/' . $estimate->id) ?>"><span
                                                                                class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                </li>
                                                                <?php } ?>

                                                                <li role="separator" class="divider"></li>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                           href="<?php echo base_url('invoice') ?>"
                                                                                           data-convert-to-invoice-modal="open"
                                                                                           data-id="161983"
                                                                                           data-name="WO-00433"><span
                                                                                class="fa fa-money icon"></span> Convert to Invoice</a>
                                                                </li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" target="_new" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>" class="">
                                                                    <span class="fa fa-file-pdf-o icon"></span>  View PDF</a></li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" target="_new" href="<?php echo base_url('estimate/print/' . $estimate->id) ?>" class="">
                                                                    <span class="fa fa-print icon"></span>  Print</a></li>
                                                                <li role="presentation">
                                                                    <!-- <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                    <span class="fa fa-envelope-open-o icon"></span>  Send to Customer</a></li> -->
                                                                    <a href="" acs-id="<?php echo $estimate->customer_id; ?>" est-id="<?php echo $estimate->id; ?>" class="send_to_customer"><span class="fa fa-envelope-o icon"></span> Send to Customer</a>
                                                                <li><div class="dropdown-divider"></div></li>
                                                                <li role="presentation">
                                                                    <!-- <a role="menuitem" href="<?php //echo base_url('estimate/delete/' . $estimate->id) ?>>" onclick="return confirm('Do you really want to delete this item ?')" data-delete-modal="open"><span class="fa fa-trash-o icon"></span> Delete</a> -->
                                                                    <a href="#" est-id="<?php echo $estimate->id; ?>" id="delete_estimate"><span class="fa fa-trash-o icon"></span> Delete </a>
                                                                </li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" href="<?= base_url('job/estimate_job/'. $estimate->id) ?>">
                                                                        <span class="fa fa-briefcase icon"></span> Convert to Job</a>
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
    $('#estimateListTable').DataTable({
        "lengthChange": true,
        "searching": true,
        "pageLength": 10,
        "order": [],
    });
});
</script>
