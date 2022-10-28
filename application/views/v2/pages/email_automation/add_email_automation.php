<?php include viewPath('v2/includes/header'); ?>
<style>
.group-list{
    list-style: none;
    padding: 0px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Select an event name and a time to send the email.
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><b>On Event</b></label><br />
                            <select class="form-control" id="rule-event"  name="rule_event" style="width: 55%;">
                              <?php foreach($optionRuleEvent as $key => $value){ ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mt-5">
                            <label for=""><b>Send</b><br /><small>This represents the time when we send the text.</small></label><br />
                            <select class="form-control" name="rule_notify_at" style="width: 55%;">
                              <?php foreach($optionRuleNotifyAt as $key => $value){ ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                              <?php } ?>
                            </select>
                            <div style="display: inline-block;">
                              <label class="weight-normal margin-right-sec" data-automation="rule_notity_op_before"><input type="radio" name="rule_notify_op" value="+" checked="checked">
                                  <span data-automation="rule_notity_op_after_text">After event</span>
                              </label>
                              <label class="weight-normal" data-automation="rule_notity_op_after"><input type="radio" name="rule_notify_op" value="-">
                                <span data-automation="rule_notity_op_before_text">Before event</span>
                              </label>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <label for=""><b>Automation Name</b><br /><small>Set a name for your own reference.</small></label>
                            <input type="text" class="form-control" name="automation_name" id="" required placeholder="" autofocus style="width: 55%;"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><b>Customer Type</b></label><Br />
                            <select class="form-control" name="business_customer_type_service" style="width: 55%;">
                              <?php foreach($optionCustomerType as $key => $value){ ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mt-5">
                            <label for=""><b>Exclude Customer Groups</b><br /><small>Optional, select the groups if you would like to exclude them from automation.</small></label>
                            <div class="margin-bottom-sec">
                              <ul class="group-list">
                                  <?php foreach($customerGroups as $cg){ ?>
                                      <li>
                                          <div class="checkbox checkbox-sm">
                                              <input class="checkbox-select chk-contact-group" type="checkbox" <?= array_key_exists($cg->id, $selectedGroups) ? 'checked="checked"' : ''; ?> name="excludeGroups[]" value="<?= $cg->id; ?>" id="chk-customer-group-<?= $cg->id; ?>">
                                              <label for="chk-customer-group-<?= $cg->id; ?>"><?= $cg->title; ?></label>
                                          </div>
                                      </li>
                                  <?php } ?>
                              </ul>
                          </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>
<?php include viewPath('v2/includes/footer'); ?>