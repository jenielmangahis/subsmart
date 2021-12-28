<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 15px;
}
.page-title-box {
    padding-bottom: 2px !important;
    padding-top: 10px !important;
}
.float-right.d-none.d-md-block {
    position: relative;
    bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .float-right.d-none.d-md-block {
      position: relative;
      bottom: 0px;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
label>input {
  visibility: initial !important;
  position: initial !important; 
}
</style>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card p-20 mt-0 card_holder">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h3 class="page-title">Priority</h3>
                            <!--
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Manage work order priority list.</li>
                            </ol>
                            -->
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php ////if (hasPermissions('add_plan')): ?>
                                    <a href="<?php echo url('workorder/priority/add') ?>" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> New Priority</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-3 pr-3 mt-0 row">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Priority scheduling is a method of scheduling processes based on priority. In this method, the scheduler chooses the tasks to work as per the list of priority. Priority scheduling involves priority assignment to every process in events or jobs.</span>
                  </div>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <!--
                        <div class="box-header with-border">
                            <h3 class="box-title">List of Priority</h3>
                        </div> -->
                        <div class="box-body">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($priorityList)) { ?>
                                    <?php foreach ($priorityList as $priority): ?>
                                        <tr>
                                            <td><?php echo $priority->title; ?></td>
                                            <td>
                                                <div class="dropdown dropdown-btn">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                        <li role="presentation">
                                                            <a role="menuitem" href="<?php echo url('workorder/priority/edit/' . $priority->id) ?>"><i class="fa fa-pencil"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" class="btn-delete-priority" href="javascript:void(0);" data-id="<?php echo $priority->id; ?>" data-name="<?php echo $priority->title;  ?>"><i class="fa fa-trash"></i> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php } ?>
                                </tbody>
                            </table>

                            <!-- Modal Delete -->
                            <div class="modal fade bd-example-modal-md" id="modalDeletePriority" tabindex="-1" role="dialog" aria-labelledby="modalDeleteChecklistTitle" aria-hidden="true">
                              <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <?php echo form_open_multipart('workorder/delete_priority', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                                  <?php echo form_input(array('name' => 'pid', 'type' => 'hidden', 'value' => '', 'id' => 'pid'));?>
                                  <div class="modal-body">
                                      <p>Are you sure you want to delete <span class="priority-name"></span>?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                  </div>
                                  <?php echo form_close(); ?>
                                </div>
                              </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- end row -->
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(function(){
        $('#dataTable1').DataTable()
        $(".btn-delete-priority").click(function(){
            var pname = $(this).attr('data-name');
            var pid = $(this).attr('data-id');

            $("#pid").val(pid);
            $(".priority-name").html('<b>'+pname+'</b>');
            $("#modalDeletePriority").modal('show');
        });
    });

</script>
