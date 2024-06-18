<?php include viewPath('v2/includes/header'); ?>
<style>
   
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/events_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_subtabs'); ?>
    </div>
    <div class="col-12" style="min-height:750px">
        <div class="nsm-page">
            <div class="nsm-page-content">                
                <div class="row g-3 align-items-start">
                    <div class="col-12 col-md-12"> 
                        <div class="row">
                            <div class="col-6 col-md-6">            
                        </div>                       
                        <form id="frm-update-event-settings">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="row g-3">
                                        <div class="col-3">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Event Number</span>
                                                </div>
                                                <label class="nsm-subtitle">Set the prefix and the next auto-generated number.</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-3">
                                                        <input type="text" placeholder="Prefix" name="event_settings_prefix" id="number-prefix" class="nsm-field form-control" value="<?= $eventSettings ? $eventSettings->event_prefix : 'EVENT-'; ?>" required="" autocomplete="off" />
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="number" step="1" placeholder="Next Number" name="event_settings_next_number" id="number-base" class="nsm-field form-control" value="<?= $eventSettings ? $eventSettings->event_next_num : $default_next_num; ?>" required="" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Default Timezone</span>                                                    
                                                </div>
                                                <label class="nsm-subtitle">&nbsp;</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-12">
                                                        <select required id="" name="event_settings_timezone" class="form-control v2-dropdown">
                                                            <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                                            <option value="<?php echo $key ?>" <?= $eventSettings && $eventSettings->timezone == $key ? 'selected="selected"' : ''; ?>>
                                                                <?php echo $zone ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5"></div>

                                        <div class="col-3">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Customer Reminder Notification</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-12">
                                                        <select required id="" name="event_settings_customer_reminder_notification" class="form-control v2-dropdown">
                                                            <?php foreach($optionsCustomerNotifications as $key => $value){ ?>
                                                                <option <?= $eventSettings && $eventSettings->customer_reminder_notification == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5"></div>
                                        <div class="col-7 text-end">
                                            <hr>
                                            <button type="submit" class="nsm-button primary">Save Changes</button>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script type="text/javascript">    
$(function(){
    $('.v2-dropdown').select2();

    $("#frm-update-event-settings").submit(function(e) {
        e.preventDefault();
        var form = $(this);                
        $.ajax({
            type: "POST",
            url: base_url + "events/_update_settings",
            data: form.serialize(),
            dataType:'json',
            success: function(result)
            {
                if(result.is_success === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Event settings was successfully updated',            
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });

                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        confirmButtonColor: '#32243d',
                        html: result.msg
                    });
                }
            }
        });   
    });
});
</script>