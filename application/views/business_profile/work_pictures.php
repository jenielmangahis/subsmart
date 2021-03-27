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
    <?php include viewPath('includes/sidebars/business'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Work Pictures</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                              <div class="text-right">
                                  <a href="<?php echo url('users/add_work_pictures') ?>" class="btn btn-primary btn-md"><i class="fa fa-camera"></i> Upload Image</a><br />
                              </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                              Add photos to spotlight features of your business or past projects pictures.  You can upload up to <b>25 images.</b> 
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <!-- Main content -->
                        <section class="content">
                           <ul class="gallery ui-sortable" id="gallery">
                              <li id="picture-id-9083">
                                <div class="picture-container ui-sortable-handle">
                                  <div class="img">
                                      <img src="https://markate.blob.core.windows.net/cdn/20200412/buspor_13050_a138193f55_md.jpg">
                                      <a class="delete" data-fileupload="delete" data-id="9083" href=""><span class="fa fa-remove"></span></a>
                                  </div>
                                  <div class="caption editable editable-pre-wrapped editable-click" data-id="9083" data-emptytext="Set caption..." data-placeholder="" data-title="Set Caption">Lorem</div>
                                </div>
                              </li>
                            </ul>
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
  