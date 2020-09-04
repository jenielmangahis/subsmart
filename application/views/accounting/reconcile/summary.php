<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
    .hide-toggle::after {
        display: none;
    }
    .show>.btn-primary.dropdown-toggle {
    background-color: #32243D;
    border: 1px solid #32243D;
}
    .p-padding{
        padding-left: 10%;
    }
    .dropdown-menu[x-placement^=top] {
    margin-left: -50px;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background: #32243D;
}
.loader
{
    display: none !important;
}
 .line{
width: 1000px;
height: 4px;
border-bottom: 1px solid black;
position: absolute;
}
.dott{
  border:none;
  border-top:1px dotted #000;
  color:#fff;
  background-color:#fff;
  height:1px;
  width:40%;
  margin-top:20px; 
}
</style>

<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box" style="margin-top: 30px !important">
              <div class="row">
                    <div class="col-md-9">
                      <h1 class="page-title">Reconcilation Summary</h1>
                    </div>
                    <div class="col-md-3">
                        <a href="#">Reconcile</a> | <a href="#">History By account</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
           
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                             <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-1 form-group">
                                     <div class="dropdown">
                                       <a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a>
                                       <a href="#"><i class="fa fa-download"></i></a>
                                    </div>
                                 </div>
                             </div>
                             <div style="text-align: center;margin-bottom: 10px;">
                                 <div class="row">
                                     <div class="col-md-12">
                                        ADI
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        RECONCILATION SUMMARY
                                     </div>
                                 </div>
                            </div>
                            <table id="summary_table" class="table table-striped table-bordered accordion" style="width:100%;cursor: pointer;">
                              <thead>
                                <tr>
                                    <th>ACCOUNT</th>
                                    <th>TYPE</th>
                                    <th>STATEMENT ENDING DATE</th>
                                    <th>RECONCILED ON</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($rows as $row){?>
                                <tr>
                                  <td><?=$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)?></td>
                                  <td><?=$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)?></td>
                                  <td><?=$row->ending_date?></td>
                                  <td><?=$row->adjustment_date?></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script type="text/javascript">
  $('#summary_table').DataTable();
</script>