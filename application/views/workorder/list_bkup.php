<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Workorders
    <small>Manage workorder</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List of Workorder</h3>

      <div class="box-tools pull-right">

        <?php //if (hasPermissions('WORKORDER_MASTER')): ?>
          <a href="<?php echo url('workorder/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New Workorder</a>
        <?php //endif ?>

        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>
    <div class="box-body" style="overflow-y: scroll;">
      <table id="dataTable1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Work Order#</th>
            <th>Job</th>
            <th>Date Issued</th>
            <th>Customer</th>           
            <th>Mobile</th>           
            <th>Status</th>           
            <th>Priority</th>
            <!-- <th>Status</th> -->
            <th></th>
          </tr>
        </thead>
        <tbody>        
            <?php foreach($workorders as $row){ ?>
              <tr>
                <td><?php echo 'WO-00'.$row->id?></td>
                <td><?php echo $row->job_name;?></td>
                <td><?php echo date('M d, Y', strtotime($row->date_issued));?></td>
                <td><?php echo $row->contact_name;?></td>
                <td><?php echo $row->contact_mobile;?></td>
                <td><?php echo  $row->workorder_status;?></td>
                <td><?php echo  $row->workorder_priority;?></td>
                <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Manage
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <?php //if (hasPermissions('WORKORDER_MASTER')): ?>                     
                        <li><a href="<?php echo url('workorder/edit/'.$row->id) ?>">Edit</a></li>    
                      <?php //endif ?>                                   
                    </ul>
                  </div>
                </td>
              </tr>
            <?php }?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<?php include viewPath('includes/footer'); ?>

<script>
  $('#dataTable1').DataTable({

    "ordering": false
  });

  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html, {size: 'small'});
});

window.updateUserStatus = (id, status) => {
  $.get( '<?php echo url('company/change_status') ?>/'+id, {
    status: status
  }, (data, status) => {
    if (data=='done') {
      // code
    }else{
      alert('Unable to change Status ! Try Again');
    }
  })
}

</script>