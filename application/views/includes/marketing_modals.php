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
              <textarea name="email_body" id="template_email_body_create" cols="40" rows="5" class="form-control"></textarea>              
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

<!-- Modal Delete Email Automation --> 
<div class="modal fade" id="modalDeleteEmailAutomation" tabindex="-1" role="dialog" aria-labelledby="modalDeleteEmailAutomationTitle" aria-hidden="true">
    <?php echo form_open_multipart('email_automation/delete_email_automation', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <?php echo form_input(array('name' => 'ea_id', 'type' => 'hidden', 'value' => '', 'id' => 'ea_id'));?>
     <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Email Automation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Delete selected email automation?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
        </div>
      </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Add Email Automation -->
<div class="modal fade bd-example-modal-lg" id="modalAddEmailAutomation" tabindex="-1" role="dialog" aria-labelledby="modalAddEmailAutomationTitle" aria-hidden="true">
  <?php echo form_open_multipart('email_automation/create_email_automation', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Email Automation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">

            <div class="form-group"><p>Select an event name and a time to send the email.</p></div>

            <div class="form-group">
              <label>On Event</label> <span class="help"></span>
              <select name="rule_event" class="form-control" data-automation="rule_event">
                <option value="" selected="selected">- select -</option>
                <option value="estimate_submitted">Estimate Follow-up</option>
                <option value="invoice_paid">Invoice Paid</option>
                <option value="invoice_due">Invoice Due</option>
                <option value="work_order_completed">Work Order Completed</option>
              </select>
            </div>

            <div class="form-group">
              <label>Send</label> <span class="help"></span>
              <select name="rule_notify_at" class="form-control">
                <option value="P1D">1 day</option>
                <option value="P2D">2 days</option>
                <option value="P3D">3 days</option>
                <option value="P4D">4 days</option>
                <option value="P5D">5 days</option>
                <option value="P6D">6 days</option>
                <option value="P7D">7 days</option>
                <option value="P1W">1 week</option>
                <option value="P2W">2 weeks</option>
                <option value="P3W">3 weeks</option>
                <option value="P4W">4 weeks</option>
                <option value="P1M">1 month</option>
                <option value="P45D">45 days</option>
                <option value="P3M">3 months</option>
                <option value="P4M">4 months</option>
                <option value="P6M">6 months</option>
                <option value="P9M">9 months</option>
                <option value="P12M">12 months</option>
                <option value="P18M">1 year and a half</option>
                <option value="P24M">2 years</option>
                <option value="P36M">3 years</option>
                <option value="P48M">4 years</option>
              </select><br />

              <div style="padding-top: 10px;">
                  <label class="weight-normal margin-right-sec" data-automation="rule_notity_op_before"><input type="radio" name="rule_notify_op" value="0" checked="checked">
                  <span data-automation="rule_notity_op_after_text">After event</span></label>
                  <label class="weight-normal" data-automation="rule_notity_op_after"><input type="radio" name="rule_notify_op" value="1">
                  <span data-automation="rule_notity_op_before_text">Before event</span></label>
              </div>

            </div>          

            <div class="form-group">
              <label>Automation Name</label> <span class="help">(Set a name for your own reference.)</span>
              <input type="text" name="name" id="name" value="" class="form-control" autocomplete="off" required="">
            </div>  

            <div class="form-group">
              <label>Customer Type</label> <span class="help"></span>
              <select name="business_customer_type_service" class="form-control">
                <option value="0" selected="selected">Both Residential and Commercial</option>
                <option value="1">Residential customers</option>
                <option value="2">Commercial customers</option>
              </select>
            </div>   
            
            <div class="form-group">
              <label>Exclude Customer Groups</label> 
              <span class="help">Optional, select the groups if you would like to exclude them from automation.</span>
              <select name="exclude_customer_group" class="form-control">
                <option value="0" selected="selected">Panel</option>
                <option value="1">Test Group Only</option>
              </select>
            </div>                              

          </div> 

          <div class="col-md-4">
            &nbsp;
          </div>

        </div>

        <div class="row">

          <div class="col-md-8" id="subject-body-container">
            <div class="form-group">
              <label>Subject</label> <span class="help"></span>
              <input type="text" name="email_subject" id="email_subject" value="" class="form-control email_subject_create" autocomplete="off" required="">
            </div>    

            <div class="form-group">
              <label>Email Body</label> <span class="help"></span>
              <textarea name="email_body" id="automation_email_body_create" cols="40" rows="5" class="email-body-create form-control"></textarea>
            </div>
          </div>

          <div class="col-md-4">

            <div class="panel-info">
              <div class="margin-bottom-sec">
                  <label>Use default template</label>
                  <select name="template_id" id="template_id" class="form-control" data-template="dropdown">
                    <option value="0">- select -</option>
                    <?php foreach($email_automation_templates_list as $email_atl) { ?>
                            <option value="<?php echo $email_atl->id ?>"><?php echo $email_atl->name ?></option>
                    <?php } ?>
                  </select>
              </div>
              <a id="set-default-template" class="btn btn-primary margin-right" style="width: 80px;" href="javascript:void(0);">Set</a>
              <!-- <button id="set-default-template" class="btn btn-primary margin-right" style="width: 80px;" data-template="select" data-on-click-label="Set...">Set</button> -->
              <br /><a data-template="manage" href="<?php echo url('email_automation/templates'); ?>">Manage templates</a>
              <hr>
              <div class="form-group">
                  <label>Placeholders</label>
                  <p class="margin-bottom">Click to select and insert placeholders in the content which will dynamically be replaced with the appropriate data.</p>
                  <div>
                      <a class="btn btn-default toggle-placeholders" id="toggle-placeholders" href="javascript:void(0);">Add Placeholders</a>
                      <div id="placeholders-list" class="placeholders-list" style="display: none;">
                        <br >
                        <p class="margin-bottom-sec">Click one of the placeholders below to insert.</p>
                        <ul class="tags-modal-list" data-tags-modal="list">
                          <li>
                              <div class="text-ter weight-medium tags-modal-tags-group-name">Customer</div>
                              <div>
                                <!-- <a onclick="insertPlaceholder('{{customer.name}}');" href="javascript:void(0);">Name</a><br />
                                <a onclick="insertPlaceholder('{{customer.email}}');" href="javascript:void(0);">Email</a><br />
                                <a onclick="insertPlaceholder('{{customer.phone}}');" href="javascript:void(0);">Phone</a><br />
                                <a onclick="insertPlaceholder('{{customer.first_name}}');" href="javascript:void(0);">First Name</a><br />
                                <a onclick="insertPlaceholder('{{customer.last_name}}');" href="javascript:void(0);">Last Name</a><br /> -->

                                <select name="customer_placeholder" id="customer_placeholder" class="form-control" data-template="dropdown">
                                  <option value="{{customer.name}}">Name</option>
                                  <option value="{{customer.email}}">Email</option>
                                  <option value="{{customer.phone}}">Phone</option>
                                  <option value="{{customer.first_name}}">First Name</option>
                                  <option value="{{customer.last_name}}">Last Name</option>
                                </select>

                              </div>
                            </li>
                          <li>
                              <br />
                              <div class="text-ter weight-medium tags-modal-tags-group-name">Business</div>
                              <div>
                                <select name="business_placeholder" id="business_placeholder" class="form-control" data-template="dropdown">
                                  <option value="{{business.name}}">Name</option>
                                  <option value="{{business.email}}">Email</option>
                                  <option value="{{business.phone}}">Phone</option>
                                </select>
                              </div>
                          </li>
                          <!-- <li>
                            <br />
                            <div class="text-ter weight-medium tags-modal-tags-group-name">Booking Plugin</div>
                              <div>
                                     <div class="tags-modal-tag" data-tags-modal="tag" data-tag="{{widget_booking.url}}"><span>Online Booking URL</span></div>
                              </div>
                          </li> -->
                        </ul>        
                      </div>              
                  </div>
              </div>
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

<!-- Modal Edit Email Automation -->
<div class="modal fade bd-example-modal-lg" id="modalEditAutomation" tabindex="-1" role="dialog" aria-labelledby="modalEditAutomationTitle" aria-hidden="true">
  <?php echo form_open_multipart('email_automation/update_email_automation', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Email Automation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="modal-edit-email-automation-container" class="modal-edit-email-automation-container"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>