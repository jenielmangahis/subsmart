<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
label>input {
  visibility: initial !important;
  position: initial !important; 
}
.tbl-tasks .badge{
    display: block;
    padding: 10px;
    font-size: 14px;
}
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}
.badge-primary {
    color: #fff;
    background-color: #007bff;
}
.badge-secondary {
    color: #fff;
    background-color: #6c757d;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card card_holder mt-0 p-20">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h3 class="page-title">Task Hub</h3>
                        </div>
                        <div class="col-sm-6 pr-b10">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="#" class="btn btn-primary" id="btn-th-open-search"><i class="fa fa-search"></i> Search Task</a>
                                    <a href="<?php echo base_url('taskhub/entry'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Task</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-warning mt-0 mb-2" role="alert">
                    <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">You can set up Tasks for yourself and assign them to other people in your organization. To Add a Task, in the Account, click on the ‘ + Add ‘ button. There are dropdown options for each field and a date picker.</span>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box" style="margin-top:40px;">
                        <div class="box-body">
                            <table id="dataTable1" class="table table-bordered table-striped tbl-tasks">
                                <thead>
                                <tr>
                                    <th style="width:40%;">Subject</th>
                                    <th>Priority</th>
                                    <th style="width:15%;">Customer</th>
                                    <th style="width:15%;">Assigned</th>
                                    <th>Status</th>
                                    <th style="width:15%;">Date Completion</th>
                                    <th style="width:15%;">Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $key => $row) { ?>
                                        <tr>
                                            <td>
                                               <a href="<?php echo url('taskhub/view/' . $row->task_id) ?>"><?php echo $row->subject; ?></a>
                                            </td>
                                            <td>
                                                <?php 
                                                    switch ($row->priority):
                                                        case 'High':
                                                            $class_priority = "badge-danger";
                                                            break;
                                                        case 'Medium':
                                                            $class_priority = "badge-primary";
                                                            break;
                                                        case 'Low':
                                                            $class_priority = "badge-secondary";
                                                            break;
                                                    endswitch;
                                                ?>
                                                <span class="badge <?= $class_priority; ?>"><?php echo ucwords($row->priority); ?></span>
                                            </td>                                            
                                            <td><?= $row->customer_name; ?></td>
                                            <td><?= getTaskAssignedUser($row->task_id); ?></td>
                                            <td>
                                                <span class="badge badge-info" style="background-color: <?php echo $row->status_color; ?>"><?php echo $row->status_text; ?></span>
                                            </td>
                                            <td><?php echo date("F d, Y",strtotime($row->estimated_date_complete)); ?></td>
                                            <td><?php echo date("F d, Y",strtotime($row->date_created)); ?></td>
                                            <td>
                                                <div class="dropdown dropdown-btn">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                        <li role="presentation">
                                                            <a role="menuitem" href="<?php echo url('taskhub/entry/'.$row->task_id) ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" href="<?php echo url('taskhub/addupdate/'.$row->task_id) ?>"><i class="fa fa-sticky-note-o"></i> Add Update</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" href="<?php echo url('taskhub/view/'.$row->task_id) ?>"><i class="fa fa-commenting-o"></i> View Comments</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                         </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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

<div id="modal-taskhub-search" class="modal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #32243d;">
        <h4 class="modal-title" style="color:#ffffff;">Search Tasks</h4>
        <button type="button" class="close" data-dismiss="modal" style="color:#ffffff;">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-7 form-group">
              <label for="ts-keyword">Keyword<small> Filter tasks with a keyword</small></label>
              <input type="text" class="form-control" name="ts-keyword" id="ts-keyword" placeholder="Enter Keyword" required autofocus />
            </div>
            <div class="col-md-5 form-group">
              <label for="ts-status">Status<small> Select status to filter tasks</small></label>
              <select class="form-control" name="ts-status" id="ts-status">
                <option value="">Select Status</option>

                <?php foreach ($status_selection as $status) { ?>
                    <option value="<?php echo $status->status_id; ?>"><?php echo $status->status_text; ?></option>
                <?php } ?>
              </select>
            </div>
        </div>
        <h6 class="mt-1">Filter By Date Created</h6>
        <div class="row mt-4">
            <div class="col-md-6 form-group">
                <label for="ts-from-date">From</label>
                <input type="date" class="form-control" name="ts-from-date" id="ts-from-date" required autofocus />
            </div>
            <div class="col-md-6 form-group">
                <label for="ts-to-date">To</label>
                <input type="date" class="form-control" name="ts-to-date" id="ts-to-date" required autofocus />
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-modal-taskhub-search">Search</button>
      </div>
    </div>
  </div>
</div>

<div id="modal-taskhub-entry-error-alert" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="modal-taskhub-entry-error-alert-title">Error</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p id="modal-taskhub-entry-error-alert-message"><?php if(isset($error)){ echo trim($error); } ?></p>
      </div>
    </div>

  </div>
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function(){
        tasks_table = $('#dataTable1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "columns": [            
            { "width": "40%" },
            { "width": "20%" },
            { "width": "10%" },        
            { "width": "10%" },
            { "width": "10%" },                    
            { "width": "10%" }
          ]
        });

        $('#btn-th-open-search').click(function(e){
            e.preventDefault();
            $('#modal-taskhub-search').modal('show');
        });

        $('#btn-modal-taskhub-search').click(function(){
            var vKeyword = $('#ts-keyword').val();
            var vStatusId = $('#ts-status').val();
            var vFromDate = $('#ts-from-date').val();
            var vToDate = $('#ts-to-date').val();

            $.ajax({
                type: 'POST',
                url: base_url + "taskhub/getTasksWithFilters",
                data: {keyword:vKeyword,status:vStatusId,fromdate:vFromDate,todate:vToDate},
                success: function(data){
                    var result = jQuery.parseJSON(data);

                    tasks_table.destroy();

                    $('table#dataTable1 > tbody').empty();

                    var append = '';
                    $.each(result, function(index, task){
                        var actions = '<div class="dropdown dropdown-btn"><button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true"><span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span></button><ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit"><li role="presentation"><a role="menuitem" href="'+base_url+'taskhub/entry/'+task.task_id+'"><i class="fa fa-pencil"></i> Edit</a></li><li role="presentation"><a role="menuitem" href="'+base_url+'taskhub/addupdate/'+task.task_id+'"><i class="fa fa-sticky-note-o"></i> Add Update</a></li><li role="presentation"><a role="menuitem" href="'+base_url+'taskhub/view/'+task.task_id+'"><i class="fa fa-commenting-o"></i> View Comments</a></li></ul></div>'

                        append += '<tr>';                            
                            append += '<td><a href="'+ base_url +'taskhub/view/'+ task.task_id +'">'+ task.subject +'</a></td>';
                            append += '<td><span class="badge badge-info" style="background-color:'+task.status_color+'">'+ task.status_text +'</span></td>';
                            append += '<td>'+ task.estimated_date_complete_formatted + '</td>';
                            append += '<td>'+ task.date_created_formatted + '</td>';
                            append += '<td>'+ actions + '</td>';
                        append += '</tr>';
                    });

                    $('table#dataTable1 > tbody').append(append);

                    tasks_table = $('#dataTable1').DataTable({
                                    "order": []
                                  });

                    $('#modal-taskhub-search').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $('#modal-taskhub-entry-error-alert-title').text(textStatus);
                    $('#modal-taskhub-entry-error-alert-message').text(errorThrown);
                    $('#modal-taskhub-entry-error-alert').modal('show');
                }
            });
        });
    });
</script>
