<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.hide {
    display:none;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    <div class="container-page">
    <div class="container-fluid">

<div class="row align-items-center" style="margin-top: 30px;">
  <div class="col-sm-12">
      <h3 class="page-title">Orders</h3>
  </div>
</div>
<div class="pl-3 pr-3 mt-1 row">
    <div class="col mb-4 left alert alert-warning mt-0 mb-2">
        <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Listing orders for all your purchases.</span>
    </div>
</div>

<div class="card">
<table class="table table-hover">
    <thead>
        <tr>
            <th>Order#</th>
            <th>Details</th>
            <th>Date Added</th>
            <th class="text-right">Amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($payments as $p){ ?>
            <tr>
                <td><a class="a-default" href="https://www.markate.com/pro/account/orders/view/id/19800"><?= $p->order_number; ?></a></td>
                <td><?= $p->description; ?></td>
                <td><?= date("d/M/Y g:i A", strtotime($p->date_created)); ?></td>
                <td class="text-right">$<?= number_format($p->total_amount,2); ?></td>                
                <td class="text-right"><a href="<?= base_url("mycrm/view_order_payment/" . $p->id); ?>"><span class="fa fa-file-text-o icon"></span> View</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
    </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>