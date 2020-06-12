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
                                    <?php //if (hasPermissions('add_plan')): ?>
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
					                           <?php echo $row->subject; ?>
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
					                           <?php if($row->is_participant == 'no'){ ?>
					                           	<a href="<?php echo url('taskhub/entry/'.$row->task_id) ?>" class="btn btn-sm btn-default" title="Edit Task" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
					                           <?php } ?>
					                           <a href="<?php echo url('taskhub/view/'.$row->task_id) ?>" class="btn btn-sm btn-default" title="View Task" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
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

<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable({
    	"order": []
    });
</script>