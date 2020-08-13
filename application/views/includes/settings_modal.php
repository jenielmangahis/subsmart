<!-- Modal Add Tax Rate --> 
<div class="modal fade" id="modalAddTaxRate" tabindex="-1" role="dialog" aria-labelledby="modalAddTaxRateTitle" aria-hidden="true">
  <?php echo form_open_multipart('settings/create_tax_rate', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Tax Rate</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">        
            <div class="validation-error hide"></div>

            <div class="form-group">
                <label>Tax Name</label> <span class="form-required">*</span>
                <input type="text" name="tax_name" value="" placeholder="e.g. Standard Tax" class="form-control" required="" autocomplete="off" />
            </div>
            <div class="form-group">
                <label>Rate (%)</label> <span class="form-required">*</span>
                <input type="text" name="tax_rate" value="" placeholder="e.g. 10" class="form-control" required="" autocomplete="off" />
            </div> 
            <div class="form-group">
                <label>Set Tax as Default</label> <span class="form-required">*</span><br /><span class="help help-sm">If set as default this tax will be applied automatically when adding a new item on estimates or invoices.</span><br /><br />
                <label class="checkbox">
                  <input type="checkbox" name="is_default" /> Set as default
                </label>
            </div>  
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
	    </div>
	  </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Edit Tax Rate --> 
<div class="modal fade" id="modalEditTaxRate" tabindex="-1" role="dialog" aria-labelledby="modalEditTaxRateTitle" aria-hidden="true">
  <?php echo form_open_multipart('settings/update_tax_rate', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
  <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'tid'));?>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Tax Rate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body body-edit-tax-rate"> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Delete Tax Rate -->
<div class="modal fade bd-example-modal-sm" id="modalDeleteTaxRate" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTaxRateTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Tax Rate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('settings/delete_tax_rate', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'dtid'));?>
      <div class="modal-body">        
          <p>Delete selected tax rate?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Add File Vault --> 
<div class="modal fade" id="modalAddFileVault" tabindex="-1" role="dialog" aria-labelledby="modalAddFileVaultTitle" aria-hidden="true">
  <?php echo form_open_multipart('settings/create_file_vault', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">        
            <div class="validation-error hide"></div>

            <div class="form-group">
                <label>Upload File</label> <span class="form-required">*</span><br /><span class="help help-sm">Allowed type: pdf, doc, docx, rtf, png, jpg, gif. Max size 8MB.</span><br /><br />
                <input type="file" class="form-control" name="file_vault" />
            </div>  

            <div class="form-group">
                <label>Name</label> <span class="form-required">*</span><br /><span class="help help-sm">Set a name for your own reference
                <input type="text" name="vault_name" value="" placeholder="" class="form-control" required="" autocomplete="off" />
            </div>
            <div class="form-group">
                <label>Permissions</label> <span class="form-required">*</span>
                <input type="text" name="tax_rate" value="" placeholder="e.g. 10" class="form-control" required="" autocomplete="off" />
            </div> 
            <div class="form-group">
                <label>Permission</label><br /><span class="help help-sm">Optional, select from below if you want the file to be automatically attached to following resources.</span><br /><br />
            </div>
            <div class="form-group">
                <label>Attach to Estimates</label> <span class="form-required">*</span>
                <select name="attach_to_estimate" class="form-control" required="">
                  <option value="">- select -</option>
                  <option value="1">Residential and commercial estimates</option>
                  <option value="2">Residential estimates</option>
                  <option value="3">Commercial estimates</option>
                </select>
            </div>  

            <div class="form-group">
                <label>Attach to Invoices</label> <span class="form-required">*</span>
                <select name="attach_to_invoice" class="form-control" required="">
                  <option value="">- select -</option>
                  <option value="1">Residential and commercial invoices</option>
                  <option value="2">Residential invoices</option>
                  <option value="3">Commercial invoices</option>
                </select>
            </div>   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>