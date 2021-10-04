<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.hide {
    display:none;
}
table.dataTable {
    border-collapse: collapse;
    margin-top: 5px;
}
table.dataTable thead tr th {
    border: 1px solid black !important;
}
table.dataTable tbody tr td {
    border: 1px solid black !important;
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
<table class="table table-hover" id="dt-orders">
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
                <td><a class="a-default" href="<?= url('mycrm/view_payment/' . $p->id); ?>"><?= $p->order_number; ?></a></td>
                <td><?= $p->description; ?></td>
                <td><?= date("d/M/Y g:i A", strtotime($p->date_created)); ?></td>
                <td class="text-right">$<?= number_format($p->total_amount,2); ?></td>                
                <td class="text-right"><a class="btn btn-primary btn-sm" href="<?= base_url("mycrm/view_payment/" . $p->id); ?>"><span class="fa fa-file-text-o icon"></span> View</a></td>
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
<script>
$(function(){
    var table = $('#dt-orders').DataTable({
        "searching" : false,
        "pageLength": 10,
        "autoWidth": false,
        "order": [],
         "aoColumnDefs": [
          { "sWidth": "10%", "aTargets": [ 0 ] },
          { "sWidth": "60%", "aTargets": [ 1 ] },
          { "sWidth": "15%", "aTargets": [ 2 ] },
          { "sWidth": "10%", "aTargets": [ 3 ] },
          { "sWidth": "10%", "aTargets": [ 3 ] },
        ]
    });
});
</script>