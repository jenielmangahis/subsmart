<div class="row">
  <div class="col-md-12" style="background-color: #ffffff !important;">
    <div class="box">      
      <div style="font-size:15px; font-weight: bold;margin-bottom: 10px;">Automation Name</div>
      <input type="text" class="form-control" readonly="" disabled="" value="<?= $smsAutomation->automation_name; ?>">
      <br />
      <div style="font-size:15px; font-weight: bold;margin-bottom: 10px;">Status</div>
      <input type="text" class="form-control" readonly="" disabled="" value="<?= $statusOptions[$smsAutomation->status]; ?>">
      <br />
      <div style="font-size:15px; font-weight: bold;margin-bottom: 10px;">Customer Type</div>
      <input type="text" class="form-control" readonly="" disabled="" value="<?= $customerTypeOptions[$smsAutomation->business_customer_type_service]; ?>">
      <br />
      <div style="font-size:15px; font-weight: bold;margin-bottom: 10px;">Rule Event</div>
      <input type="text" class="form-control" readonly="" disabled="" value="<?= $ruleNotifyOptions[$smsAutomation->rule_event] . " - " . $ruleNotifyAtOptions[$smsAutomation->rule_notify_at]; ?>">
      <div style="font-size:15px; font-weight: bold; margin-top: 30px;margin-bottom: 10px;">SMS Message</div>
      <textarea class="form-control" readonly="" disabled="" style="height: 100px;"><?= $smsAutomation->sms_text; ?></textarea> 
    </div>
  </div>
</div>
