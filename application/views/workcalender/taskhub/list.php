<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    	<div class="container-fluid">
    		<div class="card card_holder">
    			<div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="page-title">Task Hub</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Listing tasks associated to the user.</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="#" class="btn btn-primary" id="btn-th-open-search"><i class="fa fa-search"></i> Search Task</a>
                                    <a href="<?php echo base_url('taskhub/entry'); ?>" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> Add Task</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List of Tasks</h3>
                        </div>
                        <div class="box-body">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                	<?php foreach ($tasks as $key => $row) { ?>
	                                	<tr>
					                        <td width="60"><?php echo $row->task_id ?></td>
					                        <td>
					                           <a href="<?php echo url('taskhub/view/' . $row->task_id) ?>"><?php echo $row->subject; ?></a>
					                        </td>
					                        <td>
					                           <?php echo $row->status_text; ?>
					                        </td>
					                        <td>
					                        	<?php
					                        		$date_created = date_create($row->date_created);
													echo date_format($date_created, "F d, Y");
					                        	?>
					                        </td>
					                        <td>
					                           <a href="<?php echo url('taskhub/entry/'.$row->task_id) ?>" class="btn btn-sm btn-default" title="Edit Task" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>

                                               <a href="<?php echo url('taskhub/addupdate/'.$row->task_id) ?>" class="btn btn-sm btn-default" title="Add Update" data-toggle="tooltip"><i class="fa fa-sticky-note-o"></i></a>
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
      <div class="modal-header bg-info">
        <h4 class="modal-title">Search Tasks</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                <option value="">Select Status...</option>

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
        <button type="button" class="btn btn-default" id="btn-modal-taskhub-search">Search</button>
      </div>
    </div>  
  </div>
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function(){
        $('#btn-th-open-search').click(function(e){
            e.preventDefault();

            $('#modal-taskhub-search').modal('show');    
        });

        $('#dataTable1').DataTable({
        	"order": []
        });
    });
</script>