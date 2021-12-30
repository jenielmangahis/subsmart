<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style>
.p-40 {
  padding-top: 40px !important;
}
</style>
<div class="wrapper" role="wrapper">
	<?php include viewPath('includes/sidebars/schedule'); ?>

	<!-- page wrapper start -->
    <div wrapper__section>
    	<div class="container-fluid">
            <div class="row p-40">
                <div class="col">
                    <h3 class="m-0">
                        Add Task Update
                        <a href="<?php echo base_url('taskhub') ?>" class="btn btn-primary" aria-expanded="false" style="float: right;">
                        <i class="mdi mdi-settings mr-2"></i> Go Back to TaskHub
                    </a>
                    </h3>
                </div>
                <div style="background-color:#fdeac3;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px; width:100%;margin-left: 10px;">
                    Add notes as updates showing progress of the task           
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('taskhub/addupdate/' . $task->task_id, ['class' => 'form-validate require-validation', 'id' => 'taskhub_update_entry', 'autocomplete' => 'off']); ?>
                <div class="row custom__border">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Task Update Entries</h3>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="box">
                                            <div class="box-header with-border">
                                                <h5 class="box-title"><?php echo $task->subject; ?>
                                                    <span class="font-weight-lighter">&ensp;#<?php echo $task->task_id; ?></span>
                                                </h5>
                                            </div>
                                            <div class="box-body">
                                                <p style="white-space: pre-wrap;" class="text-justify"><?php echo $task->description; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" name="notes" id="notes" autocomplete="off" style="height: 300px !important" placeholder="Enter your task updates notes"
                                            required><?php echo set_value('notes'); ?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                        <a href="<?php echo url('taskhub') ?>" class="btn btn-danger">Cancel this</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>         	

           	<?php echo form_close(); ?>
    	</div>
    	<!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->

<div id="modal-taskhub-entry-error-alert" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title">Error</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p id="modal-taskhub-entry-error-alert-message"><?php if(isset($error)){ echo trim($error); } ?></p>  
      </div>
    </div>

  </div>
</div>

<?php include viewPath('includes/footer'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        var error_msg = $('#modal-taskhub-entry-error-alert-message').html();
        error_msg = error_msg.trim();

        if(error_msg != ''){
            $('#modal-taskhub-entry-error-alert').modal("show");
        }
    });
</script>