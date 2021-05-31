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
                        <!-- Main content -->
                        <section class="content">
                            <div class="row">
                              <div class="col-sm-6 left">
                                <h3 class="page-title">View Booking</h3>
                              </div>
                              <div class="col-sm-6 right dashboard-container-1">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                      <a class="btn btn-primary" href="<?= url('promote/bookings/' . $booking->id); ?>">Back to list</a>
                                    </div>
                                </div>
                              </div>
                            </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Booking information</span>
                        </div>
                        <br />
                        <div class="card-body">
                            <div class="row">
                              <div class="col-md-8 pl-0 pr-0 left" style="background-color: #ffffff !important;">
                                <div class="box">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Deals Title</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $booking->title; ?>">
                                  <hr />
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Name</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $booking->name; ?>">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Email</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $booking->email; ?>">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Phone</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $booking->phone; ?>">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Address</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $booking->address; ?>">
                                  <div style="font-size:18px; font-weight: bold; margin-top: 30px;margin-bottom: 10px;">Message</div>
                                  <div style="border: 2px solid #e0e0e0;;padding: 10px;min-height: 100px;"><?= $booking->message; ?></div> 
                                </div>
                              </div>
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
    
});

</script>
