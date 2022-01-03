<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
label>input {
  visibility: initial !important;
  position: initial !important; 
}
</style>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">
    <div class="card p-20 card_holder">
      <div class="row">
        <div class="col-sm-12 left">
          <h3 class="page-title mt-0">
            Activity Logs
            <a class="btn btn-primary btn-logs-advance-search" href="javascript:void(0);" style="float:right;">Advance Search</a>
          </h3>
        </div>
      </div>
      <div class="alert alert-warning mt-1 mb-4" role="alert">
          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">View your company users activities
          </span>
      </div>
      <!-- end row -->                     
      <section class="content">



<!-- Default box -->

<div class="box">

  <div class="box-body">
    <div class="">
      <table id="dataTable1" class="table table-bordered table-striped">
        <thead>

          <tr>
            <th>IP Address</th>
            <th>Message</th>
            <th>Date Time</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($activity_logs as $row): ?>
            <tr>
              <td><?php echo !empty($row->ip_address)?'<a href="'.url('activity_logs/index?ip='.urlencode($row->ip_address)).'">'.$row->ip_address.'</a>':'N.A' ?></td>
              <td><a href="<?php echo url('activity_logs/view/'.$row->id) ?>"><?php echo $row->title ?></a></td>
              <td><?php echo date( setting('datetime_format') , strtotime($row->created_at)) ?></td>
              <td>
                <?php //if (hasPermissions('activity_log_view')): ?>
                  <a href="<?php echo url('activity_logs/view/'.$row->id) ?>" class="btn btn-sm btn-default" title="View Activity" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                  <?php if ($row->user > 0): ?>
                    <a href="<?php echo url('users/view/'.$row->user) ?>" class="btn btn-sm btn-default" title="View User" target="_blank" data-toggle="tooltip"><i class="fa fa-user"></i></a>
                  <?php endif ?>
                <?php //endif ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
  	</div>
  </div>

  <!-- Modal Advance Search  -->
    <div class="modal fade bd-example-modal-sm" id="modalAdvanceSearch" tabindex="-1" role="dialog" aria-labelledby="modalAdvanceSearchTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-search-plus"></i> Advance Search</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open('activity_logs', ['method' => 'GET', 'autocomplete' => 'off']); ?> 
          <div class="modal-body" style="padding-bottom: 0px !important;">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="Filter-IpAddress">Ip Address </label>
                    <input type="text" name="ip" id="Filter-IpAddress" class="form-control" value="<?php echo get('ip') ?>" placeholder="Search by Ip Addres" />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="Filter-User">User</label>
                    <select name="user" id="Filter-User" class="form-control select2">
                      <option value="">Select User</option>
                      <?php foreach ($this->users_model->get() as $row): ?>
                        <?php $sel = (get('user')==$row->id)?'selected':'' ?>
                        <option value="<?php echo $row->id ?>" <?php echo $sel; ?>><?php echo $row->FName . ' ' . $row->LName; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Search</button>           
            <a href="<?php echo url('/activity_logs') ?>" class="btn btn-danger">Reset</a>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

  <!-- /.box-body -->
</div>
<!-- /.box -->
</section>
      <!-- end row -->           
   </div>
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
  $(document).on('click', '.btn-logs-advance-search', function(){
    $("#modalAdvanceSearch").modal('show');
  });

  $('#dataTable1').DataTable({
    "order": []
  });
  $('.select2').select2();
</script>