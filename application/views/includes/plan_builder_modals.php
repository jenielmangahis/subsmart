<!-- Modal Delete  -->
<div class="modal fade bd-example-modal-sm" id="modalDeletePlan" tabindex="-1" role="dialog" aria-labelledby="modalDeletePlanTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('nsmart_plans/delete_plan', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'pid', 'type' => 'hidden', 'value' => '', 'id' => 'pid'));?>
      <div class="modal-body">        
          <p>Delete selected plan?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>