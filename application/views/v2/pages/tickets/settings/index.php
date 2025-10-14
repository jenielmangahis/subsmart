<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_tickets_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_ticket_subtabs'); ?>
    </div>
    <div class="col-12" style="min-height:750px">
        <div class="nsm-page">
            <div class="nsm-page-content">                
                <div class="row g-3 align-items-start">
                    <div class="col-12 col-md-3">    
                            <div class="nsm-card primary">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="nsm-card-header d-block">
                                            <div class="nsm-card-title">
                                                <span>Service Ticket Number</span>
                                            </div>
                                            <label class="nsm-subtitle">Prefix and the next auto-generated number.</label>
                                        </div>
                                        <div class="nsm-card-content">
                                            <?php 
                                                $is_disabled = '';
                                                if(!checkRoleCanAccessModule('service-ticket-settings', 'write')){ 
                                                    $is_disabled = 'disabled="disabled"';
                                                }
                                            ?>
                                            <div class="row g-2">
                                                <div class="col-12 col-md-3">
                                                    <input type="text" placeholder="Prefix" name="ticket_settings_prefix" id="number-prefix" class="nsm-field form-control" value="<?= $settings && $settings->ticket_num_prefix != '' ? $settings->ticket_num_prefix : 'SERVICE-';  ?>" autocomplete="off" disabled />
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="number" step="1" min="1" placeholder="Next Number" name="ticket_settings_next_number" id="number-base" class="nsm-field form-control" value="<?= $settings && $settings->ticket_num_next > 0 ? $settings->ticket_num_next : 1;  ?>" autocomplete="off" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>                    
                </div>                
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">    
$(function(){
    $('#frm-update-ticket-settings').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + "tickets/_update_settings",
            data: $(this).serialize(),
            dataType: "json",
            success: function(result)
            {   
                if( result.is_success ){
                    Swal.fire({
                        title: 'Service Ticket Settings',
                        text: "Settings was updated successfully",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            
                        //}
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.msg,
                    });
                }
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>