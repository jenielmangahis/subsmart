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
                            <?php 
                                $disabled = '';
                                /*if(!checkRoleCanAccessModule('events-settings', 'write')){
                                    $disabled = 'disabled="disabled"';
                                }*/
                            ?>
                            <div class="col-6">
                                <div class="nsm-card primary">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Event Number</span>
                                                </div>
                                                <label class="nsm-subtitle">Prefix and the next auto-generated number.</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-3">
                                                        <input type="text" placeholder="Prefix" name="event_settings_prefix" id="number-prefix" class="nsm-field form-control" value="<?= $eventSettings ? $eventSettings->event_prefix : 'EVENT-'; ?>" required="" autocomplete="off" disabled />
                                                    </div>
                                                    <div class="col-12 col-md-5">
                                                        <input type="number" step="1" placeholder="Next Number" name="event_settings_next_number" id="number-base" class="nsm-field form-control" value="<?= $eventSettings ? $eventSettings->event_next_num : $default_next_num; ?>" required="" autocomplete="off" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Timezone</span>                                                    
                                                </div>
                                                <label class="nsm-subtitle">Set default timezone when adding events.</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-12">
                                                        <select required id="" name="event_settings_timezone" class="form-control v2-dropdown" <?= $disabled; ?>>
                                                            <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                                            <option value="<?php echo $key ?>" <?= $eventSettings && $eventSettings->timezone == $key ? 'selected="selected"' : ''; ?>>
                                                                <?php echo $key ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(checkRoleCanAccessModule('events-settings', 'write')){ ?>
                                        <div class="col-12 text-end">
                                            <button type="submit" class="nsm-button primary" id="btn-update-settings">Save</button>
                                        </div>   
                                        <?php } ?>                                     
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

    <?php if(checkRoleCanAccessModule('events-settings', 'write')){ ?>
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
                $('#btn-update-settings').html('Save');
                if(result.is_success === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Event Settings',
                        text: 'Settings was successfully updated',            
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
            },
            beforeSend:function(){
                $('#btn-update-settings').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });   
    });
    <?php } ?>
});
</script>