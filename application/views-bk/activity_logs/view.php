<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">Activity Log</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">manage activity logs</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- end row -->                     
      <section class="content">

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">View Activity</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>
    <div class="box-body">

      <table class="table table-bordered table-striped">
        <thead>
        </thead>
        <tbody>

            <tr>
              <td width="150">Id: </td>
              <td><strong><?php echo $activity->id ?></strong></td>
            </tr>

            <tr>
              <td>Message: </td>
              <td><strong><?php echo $activity->title ?></strong></td>
            </tr>

            <tr>
              <td>User: </td>
              <?php $User = $this->users_model->getById($activity->user) ?>
              <td><strong><?php echo $activity->user > 0 ? $User->name : '' ?></strong> <a href="<?php echo url('users/view/'.$User->id) ?>" target="_blank"><i class="fa fa-eye"></i></a></td>
            </tr>

            <tr>
              <td>Date Time: </td>
              <td><strong><?php echo date('h:m a - d M, Y', strtotime($activity->created_at)) ?></strong></td>
            </tr>

        </tbody>
      </table>
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