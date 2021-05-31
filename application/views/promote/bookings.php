<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
img.event-marker {
    display: block;
    margin: 0 auto;
}
tr.odd {
    background: #f1f1f1 !important;
}
table.table tbody tr td {
    width: 15%;
    text-align: right;
}
table.table tbody tr td:first-child {
    width: 85%;
    text-align: left;
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
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.event-marker{
  height: 50px;
  width: 50px;
  border: 1px solid #dee2e6;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <div class="row">
                          <div class="col-sm-6 left">
                                <h3 class="page-title">Bookings : <?= $dealsSteals->title; ?></h3>
                              </div>
                              <div class="col-sm-6 right dashboard-container-1">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                      <a class="btn btn-primary" href="<?php echo url('promote/deals'); ?>">Return to Deals</a>
                                    </div>
                                </div>
                              </div>
                            </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">List of deals bookings</span>
                        </div>
                        <br />
                        <!-- Main content -->
                        <section class="content">
                            <div class="tabs mt-2">
                                <ul class="clearfix ul-mobile" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('promote/view_deals/' . $dealsSteals->id); ?>">Preview Deals</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href="<?= base_url('promote/bookings/' . $dealsSteals->id); ?>">Bookings</a>
                                        </li>
                                        <li class="nav-ite">
                                            <a class="nav-link" href="<?= base_url('promote/email_logs/' . $dealsSteals->id); ?>">Email Log</a>
                                        </li>
                                </ul>
                            </div>

                            <div class="row">
                              <div class="col-xl-12 col-md-12">
                                  <table id="dataTableDealsSteals">
                                      <thead>
                                          <tr>
                                              <th>Date</th>
                                              <th>Customer</th>
                                              <th>Deal Price</th>
                                              <th></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach($bookings as $b){ ?>
                                            <tr>
                                              <td><?= date("d-M-Y H:i", strtotime($b->date_created)); ?></td>
                                              <td><?= $b->name; ?></td>
                                              <td>$<?= number_format($b->deal_price,2); ?></td>
                                              <td><a class="btn btn-sm btn-primary" href="<?= base_url('promote/view_booking/' . $b->id); ?>"><i class="fa fa-eye"></i> View</a></td>
                                            </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                        </section>
                        <!-- /.content -->
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
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    var table = $('#dataTableDealsSteals').DataTable({
        "searching" : false,
        "pageLength": 10,
        "order": [],
         "aoColumnDefs": [
          { "sWidth": "10%", "aTargets": [ 0 ] },
          { "sWidth": "60%", "aTargets": [ 1 ] },
          { "sWidth": "10%", "aTargets": [ 2 ] },                   
          { "sWidth": "5%", "aTargets": [ 3 ] }                   
        ]
    });    
});

</script>
