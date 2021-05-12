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
                            <h3 class="page-title">Preview Deals</h3><br/><br/>
                          </div>
                        </div>
                        <!-- Main content -->
                        <section class="content">
                            <div class="tabs mt-2">
                                <ul class="clearfix ul-mobile" id="myTab" role="tablist">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="<?= base_url('promote/view_deals/' . $dealsSteals->id); ?>">Preview Deals</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('promote/bookings/' . $dealsSteals->id); ?>">Bookings</a>
                                        </li>
                                        <li class="nav-ite">
                                            <a class="nav-link" href="<?= base_url('promote/email_logs/' . $dealsSteals->id); ?>">Email Log</a>
                                        </li>
                                </ul>
                            </div>
                            <div class="row margin-top" style="bottom: 55px;">
                                <div class="col-sm-12"></div>
                                <div class="col-sm-12 text-right">
                                    <a class="btn btn-primary" href="<?php echo url('promote/build_email'); ?>">View Deal Page</a>
                                    <a class="btn btn-primary" href="<?= url('promote/edit_deals/' . $dealsSteals->id); ?>"><i class="fa fa-edit"></i> Edit</a>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 pl-0 pr-0 left" style="background-color: #ffffff !important;">
                                <div class="box">
                                  <div class="form-group">
                                      <h3 style="font-size: 26px;"><?= $dealsSteals->title; ?></h3>
                                      <h3 style="color:#2ab363;font-size: 24px;">$<?= number_format($dealsSteals->deal_price,2); ?></h3>
                                  </div>
                                  <div class="row margin-bottom-sec">
                                      <div class="col-md-6">
                                          <?php 
                                            $diff_increase  = $dealsSteals->original_price - $dealsSteals->deal_price;
                                            $percentage_off = ($diff_increase / $dealsSteals->original_price) * 100; 
                                          ?>
                                          <span class="text-ter">was <span style="font-size:18px;">$<?= number_format($dealsSteals->original_price,2); ?></span> you get <span style="font-size: 18px;"><?= number_format($percentage_off,2); ?>%</span> off</span>
                                      </div>
                                      <div class="col-md-6 text-right">
                                          <span class="text-ter"><i class="fa fa-clock-o"></i> Expires in <span data-shop="valid-days">30</span> days</span>
                                      </div>
                                  </div>
                                  <div class="row margin-bottom-sec">
                                      <div class="col-md-12">
                                          <img src="<?= base_url("uploads/deals_steals/" . $dealsSteals->company_id . "/" . $dealsSteals->photos); ?>" style="width: 100%;">
                                      </div>
                                  </div>
                                  <div style="font-size:18px; font-weight: bold;">What You'll Get</div>
                                  <hr>
                                  <p style="font-size: 16px;">SAMPLE DEALS STEALS</p>
                                  <div style="font-size:18px; font-weight: bold; margin-top: 30px;">Terms &amp; Conditions</div>
                                  <hr>
                                  <p style="font-size: 16px;">TEST</p>
                                </div>
                              </div>
                              <div class="col-md-6 pl-0 pr-0 left">
                                  <div class="panel-info" style="margin-top: 29px;">
                                      <div class="margin-bottom">                                          
                                          <label>Status: <?= $statusOptions[$dealsSteals->status]; ?></label><br/>
                                          <label>Valid from: <?= date("m/d/Y", strtotime($dealsSteals->valid_from)); ?></label><br/>
                                          <label>Valid to: <?= date("m/d/Y", strtotime($dealsSteals->valid_to)); ?></label><br/>
                                          <label>Paid with Order # <?= $dealsSteals->order_number; ?> <a href="<?= base_url('promote/view_deals_payment/' . $orderPayments->id); ?>" style="color:#2ab363;">view</a></label><br/>      
                                      </div>                       
                                      <div class="margin-bottom">                           
                                          <?php
                                            $slug = createSlug($dealsSteals->title,'-');
                                            $deal_url = url('deal/' . $slug . '/' . $dealsSteals->id);
                                          ?>               
                                          <label>Deal Page URL</label><br/>
                                          <input class="form-control" type="text" readonly="" disabled="" value="<?= $deal_url ?>"><br/>
                                      </div>                                          
                                  </div>
                                </div>
                                  
                                </form>
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
