<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid" style="margin-top:66px;">
      <div class="row">
        <div class="col-sm-12 left">
          <h3 class="page-title mt-0">
            View Activity Logs
          </h3>
        </div>
      </div>
      <div class="alert alert-warning mt-1 mb-4" role="alert">
          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">View activity log
          </span>
      </div>
      <!-- end row -->                     
      <section class="content">

<!-- Default box -->
<div class="box">
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        </thead>
        <tbody>

            <tr>
              <td width="150">IP: </td>
              <td><strong><?php echo $activity->ip_address ?></strong></td>
            </tr>

            <tr>
              <td>Message: </td>
              <td><strong><?php echo $activity->title ?></strong></td>
            </tr>

            <tr>
              <td>User: </td>
              <?php $User = $this->users_model->getById($activity->user) ?>
              <td><strong><?php echo $activity->user > 0 ? $User->FName . ' ' . $User->LName : '' ?></strong> <a href="<?php echo url('users/view/'.$User->id) ?>" target="_blank"><i class="fa fa-eye"></i></a></td>
            </tr>
            <tr>
              <td>Date Time: </td>
              <td><strong><?php echo date('h:m a - d M, Y', strtotime($activity->created_at)) ?></strong></td>
            </tr>
        </tbody>
      </table>
      <a class="btn btn-primary" href="<?php echo base_url('activity_logs'); ?>" style="margin-top: 20px;">Back to list</a>
    </div>
    <!-- /.box-body -->
</div>

</section>
      <!-- end row -->           
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
   $('#dataTable1').DataTable({
   
     "order": []
   
   })
   
   
   
   $('.select2').select2();
   
   
   
</script>