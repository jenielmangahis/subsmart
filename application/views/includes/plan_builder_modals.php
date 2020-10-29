<!-- Modal Delete Plan  -->
<div class="modal fade bd-example-modal-sm" id="modalDeletePlan" tabindex="-1" role="dialog" aria-labelledby="modalDeletePlanTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
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

<!-- Modal Delete Plan Heading  -->
<div class="modal fade bd-example-modal-sm" id="modalDeletePlanHeading" tabindex="-1" role="dialog" aria-labelledby="modalDeletePlanHeadingTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('plan_headings/delete_plan_heading', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'phid', 'type' => 'hidden', 'value' => '', 'id' => 'phid'));?>
      <div class="modal-body">        
          <p>Delete selected plan heading?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Delete Addon  -->
<div class="modal fade bd-example-modal-sm" id="modalDeleteAddon" tabindex="-1" role="dialog" aria-labelledby="modalDeleteAddonTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('nsmart_addons/delete_addon', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'pid', 'type' => 'hidden', 'value' => '', 'id' => 'aid'));?>
      <div class="modal-body">        
          <p>Delete selected addon?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Delete Industry Module  -->
<div class="modal fade bd-example-modal-sm" id="modalDeleteIndustryModule" tabindex="-1" role="dialog" aria-labelledby="modalDeleteIndustryModule" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('industry_modules/delete_module', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'mid', 'type' => 'hidden', 'value' => '', 'id' => 'mid'));?>
      <div class="modal-body">        
          <p>Delete selected Module?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Delete Industry Module  -->
<div class="modal fade bd-example-modal-sm" id="modalDeleteIndustryTemplate" tabindex="-1" role="dialog" aria-labelledby="modalDeleteIndustryTemplate" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('industry_template/delete_template', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'tid'));?>
      <div class="modal-body">        
          <p>Delete selected Template?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Delete Industry Type  -->
<div class="modal fade bd-example-modal-sm" id="modalDeleteIndustryType" tabindex="-1" role="dialog" aria-labelledby="modalDeleteIndustryType" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('industry_type/delete_type', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'type_id', 'type' => 'hidden', 'value' => '', 'id' => 'type_id'));?>
      <div class="modal-body">        
          <p>Delete selected Industry Type?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>