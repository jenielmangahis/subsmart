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

<!-- Modal Setup Paypal Payment Method --> 
<div class="modal fade" id="setupPaypalModal" tabindex="-1" role="dialog" aria-labelledby="setupPaypalModalTitle" aria-hidden="true">
  <?php echo form_open_multipart('settings/update_online_payment_setting', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Setup Paypal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">        
          <div class="row">
              <div class="col-sm-6">
                  <p class="margin-bottom">To configure PayPal payment method please complete the fields below.</p>

                  <form data-form="form" method="post" action="#">
                      <div class="validation-error hide"></div>
                      <div class="form-group">
                          <label>Email Address</label>
                          <div class="help margin-bottom-sec">The email used on your PayPal account.</div>
                          <input type="text" name="email" value="<?php echo $setting['paypal_email']; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Re-type Email Address</label>
                          <input type="text" name="email_confirm" value="" class="form-control">
                      </div>
                      <hr>
                      <div class="form-group">
                          <div class="weight-medium">Active</div>
                          <div class="help margin-bottom-sec">Activate or disable this payment method.</div>
                          <div class="checkbox checkbox-sec no-margin">
                              <input type="checkbox" name="active" value="1" <?= $setting['is_active'] == 1 ? 'checked="checked"' : ''; ?> id="payment_method_active">
                              <label for="payment_method_active"> Make active</label>
                          </div>
                      </div>
                  </form>

              </div>
              <div class="col-sm-6">
                  <div style="background: #eaeaea; padding: 30px;">
                      <img class="payment-logo" src="<?php echo $url->assets ?>img/paypal-logo.png">

                      <div class="bold">Transaction Charges</div>
                      <p class="margin-bottom">
                          Transaction charges are applicable as on your PayPal plan.<br>
                          No additional fee will be charged by the system.
                      </p>
                      <div class="bold">Accepted Credit Cards</div>
                      <p class="margin-bottom">
                          All major cards are accepted.<br>
                          Payment status will be updated in system automatically.
                      </p>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="action" value="paypal">Save</button>
        </div>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Setup Square Payment Method --> 
<div class="modal fade" id="setupSqaureModal" tabindex="-1" role="dialog" aria-labelledby="setupSqaureModalTitle" aria-hidden="true">
  <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Setup Square</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">        
          <div class="row">
              <div class="col-sm-12">
                <p class="margin-bottom">Connect to Square to start accepting payments.</p>
                <a class="btn btn-primary" href="http://nsmartrac.com/settings/square_payment/connect?do=auth"> Connect to Square</a>
              </div>
              
              <div class="col-sm-12">
                  <div style="background: #eaeaea; padding: 30px;">
                      <img class="payment-logo" src="<?php echo $url->assets ?>img/square-payment.png">

                      <div class="bold">Transaction Charges</div>
                      <p class="margin-bottom">
                          Transaction charges are applicable as on your Square plan.<br>
                          Square reference fees 2.9% + $0.30<br>
                          No additional fee will be charged by system.<br>
                      </p>
                      <div class="bold">Accepted Credit Cards</div>
                      <p class="margin-bottom">
                          All major cards are accepted.<br>
                          Payment status will be updated in system automatically.
                      </p>
                      <div class="bold">Locations</div>
                      <p class="margin-bottom">
                          If your business has multiple locations, you can manage everything right from your online Square Dashboard.
                          You can create unique business profiles for each location.
                      </p>
                      <div class="bold">Instant Deposit</div>
                      <p>
                          For faster access to your money, initiate an instant deposit from the Square app or from your online Square Dashboard.
                          You can instantly send up to $10,000 per deposit <b>24 hours a day, 7 days a week</b>.
                          There is no limit to the number of instant deposits you can initiate in a given day. <a href="https://squareup.com/help/us/en/article/5405-set-up-and-manage-instant-deposits" target="_blank">Setup on Square</a>
                      </p>
                  </div>
              </div>
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

<!-- Modal Setup Square Payment Method --> 
<div class="modal fade" id="editTemplateModal" tabindex="-1" role="dialog" aria-labelledby="editTemplateModalTitle" aria-hidden="true">
  <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Template</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">        
          <div class="container-fluid">

            <div class="margin-bottom-sec">
                <div class="row">
                    <div class="col-sm-12 weight-medium">Create and send invoice</div>
                    <div class="col-sm-12 text-right"><a data-reset-modal="open" href="#">Reset to default template</a></div>
                </div>
            </div>
            <hr>
            <form data-form="form" method="post" action="#">
                    <div class="validation-error hide"></div>

                <div class="row">
                    <div class="col-sm-16">
                        <div class="card">
                            <p class="margin-bottom-ter">
                                Customize the SMS message.
                            </p>
                            <div class="form-group">
                                <label>SMS</label>
                                <textarea style="height: 100px !important;" name="body" cols="40" rows="2" class="form-control" id="template-body" autocomplete="off">You got an invoice from {{business.name}}. Click here to view online - {{url}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8" style="max-width: 45% !important;">

                        <div class="panel-info">
                            <label>Placeholders</label>
                            <p class="margin-bottom">
                                Click to select and insert placeholders in the content which will dynamically be replaced with the appropriate data.
                            </p>
                            <div>
                                <a class="btn btn-default" href="#" data-tags-modal="open" data-template-default-id="1">Insert Placeholders</a>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
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