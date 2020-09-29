<!-- Modal Add Template -->
<div class="modal fade bd-example-modal-lg" id="modalAddEmailAutomationTemplate" tabindex="-1" role="dialog" aria-labelledby="modalAddEmailAutomationTemplateTitle" aria-hidden="true">
  <?php echo form_open_multipart('email_automation/create_template', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-md-12">

            <div class="form-group"><p>Set a name and enter email subject and body.</p></div>

	      		<div class="form-group">
              <label>Template Name</label> <span class="help">(for your reference)</span>
              <input type="text" name="name" id="name" value="" class="form-control" autocomplete="off" required="">
            </div>	

				    <div class="form-group">
              <label>Subject</label> <span class="help"></span>
              <input type="text" name="email_subject" id="email_subject" value="" class="form-control" autocomplete="off" required="">
            </div>	  

				    <div class="form-group">
              <label>Email Body</label> <span class="help"></span>
              <textarea name="email_body" id="email_body" cols="40" rows="5" class="form-control"></textarea>
            </div>     

	      	</div>      		
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Edit Template -->
<div class="modal fade bd-example-modal-lg" id="modalEditTemplate" tabindex="-1" role="dialog" aria-labelledby="modalEditTemplateTitle" aria-hidden="true">
  <?php echo form_open_multipart('email_automation/update_template', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="modal-edit-template-container" class="modal-edit-template-container"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Delete Template --> 
<div class="modal fade" id="modalDeleteTemplate" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTemplateTitle" aria-hidden="true">
    <?php echo form_open_multipart('email_automation/delete_template', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'tid'));?>
     <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Template</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Delete selected template?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
        </div>
      </div>
  <?php echo form_close(); ?>
</div>