<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php //include viewPath('includes/sidebars/estimate'); ?>
    <?php include viewPath('includes/sidebars/signature'); ?>
    <?php //include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Documents
                <small>Manage documents</small>
              </h1>
              <div class="box-tools pull-right">

                      <a href="<?php echo url('document/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New Document</a>
                    <?php if (hasPermissions('users_add')): ?>
                    <?php endif ?>


                  </div>
            </section>

            <!-- Main content -->
            <section class="content">

              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">List of Documents</h3>

                  
                </div>
                <br>
                <div class="box-body" style="overflow-y: scroll;">
                  <table id="dataTable1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Document</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php foreach ($documents as $row): ?>
                        <tr>
                          <td width="60"><?php echo $row->id ?></td>
                          <td>
                            <?php echo $row->file ?>
                          </td>
                          <td>
                            <?php if (hasPermissions('users_edit') || true): ?>
                              <a href="<?php echo url('document/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                            <?php endif ?>
                            <?php if (hasPermissions('users_view') || true): ?>
                              <a href="<?php echo url('document/view/'.$row->id) ?>" class="btn btn-sm btn-default" title="View User" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                            <?php endif ?>
                            <?php if (hasPermissions('users_delete') || true): ?>
                              <?php if ($row->id!=1 && logged('id')!=$row->id || true): ?>
                                <a href="<?php echo url('document/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick="return confirm('Do you really want to delete this document ?')" title="Delete User" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                              <?php else: ?>
                                <a href="#" class="btn btn-sm btn-default" title="You cannot Delete this User" data-toggle="tooltip" disabled><i class="fa fa-trash"></i></a>
                              <?php endif ?>
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php endforeach ?>

                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->

            </section>
            <!-- /.content -->
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<?php include viewPath('includes/footer'); ?>

<script>
  $('#dataTable1').DataTable();

  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html, {size: 'small'});
});


</script>