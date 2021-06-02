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
#dataTableLogs .badge{
  padding: 5px;
  display: block;
  font-size: 12px;
}
#dataTableLogs .badge-danger{
  background-color: #dc3545;
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
                                <h3 class="page-title">Campaign Name : <?= $smsBlast->campaign_name; ?></h3>
                              </div>
                              <div class="col-sm-6 right dashboard-container-1">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                      <a class="btn btn-primary" href="<?php echo url('sms_campaigns'); ?>">Return to list</a>
                                    </div>
                                </div>
                              </div>
                            </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">SMS automation logs</span>
                        </div>
                        <br />
                        <!-- Main content -->
                        <section class="content">                            
                            <div class="row">
                              <div class="col-xl-12 col-md-12">
                                  <table id="dataTableLogs" class="dataTable no-footer">
                                      <thead>
                                          <tr>
                                              <th>Date</th>
                                              <th>From</th>
                                              <th>To</th>
                                              <th>Sent</th>
                                              <th>Details</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach($smsLogs as $sl){ ?>
                                            <tr>
                                              <td><?= date("d-M-Y H:i", strtotime($sl->date_created)); ?></td>
                                              <td><?= $sl->from_number; ?></td>
                                              <td><?= $sl->to_number; ?></td>
                                              <td>
                                                <?php 
                                                  if( $sl->is_sent == 1 ){
                                                    echo '<span class="badge badge-primary">Yes</span>';
                                                  }else{
                                                    echo '<span class="badge badge-danger">No</span>';
                                                  }
                                                ?>
                                              </td>
                                              <td><?= $sl->error_message; ?></td>                                              
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
  $(document).ready(function() {
    var table = $('#dataTableLogs').DataTable({
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
