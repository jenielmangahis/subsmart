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
                                    <h2 class="page-title" style="display:inline-block;">Customer Inventory List </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        History of customer purchased items.
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
                                        <table class="table table-hover" id="inventoryListTable">
                                            <thead>
                                            <tr>
                                                <th style="width:70%;font-weight: bold;background-color: #808080;color:#ffffff;">Item Name</th>
                                                <th style="width:10%;font-weight: bold;background-color: #808080;color:#ffffff;">Qty</th>
                                                <th style="width:10%;text-align: right;font-weight: bold;background-color: #808080;color:#ffffff;">Price</th>
                                                <th style="width:10%;text-align: right;font-weight: bold;background-color: #808080;color:#ffffff;">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach( $inventory as $i ){ ?>
                                                    <tr>
                                                        <td colspan="4" style="background-color: #32243d;color:#ffffff;">
                                                            <?= $i['job']->job_number . ' - ' . $i['job']->job_description; ?>
                                                            <a class="pull-right btn btn-sm btn-primary" href="<?= base_url('job/job_preview/'.$i['job']->id); ?>">View</a>
                                                        </td> 
                                                    </tr>
                                                    <?php $total_amount = 0; ?>
                                                    <?php foreach( $i['items'] as $item ){ ?>
                                                        <?php 
                                                            $total_row_price = $item->price * $item->qty;
                                                            $total_amount += $total_row_price;
                                                        ?>
                                                        <tr>
                                                            <td style="width:70%;"><?= $item->title; ?></td>
                                                            <td style="width:10%;"><?= $item->qty; ?></td>
                                                            <td style="text-align:right;width: 10%;"><?= number_format($item->price,2); ?></td>
                                                            <td style="text-align:right;width: 10%;"><?= number_format($total_row_price, 2); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="3" style="background-color: #808080;color:#ffffff;">TOTAL</td>
                                                        <td style="background-color: #808080;color:#ffffff; text-decoration: right;font-weight: bold;text-align: right;"><?= number_format($total_amount,2); ?></td>
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
    
});
</script>
