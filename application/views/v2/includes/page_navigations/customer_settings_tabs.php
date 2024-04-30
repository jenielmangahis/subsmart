<div class="nsm-page-nav">
    <ul>        
        <li class="<?php if($page->title == 'Sales Area' || $page->title == 'Lead Source' || $page->title == 'Lead Types' || $page->title == 'Rate Plans' || $page->title == 'Activation Fee' || $page->title == 'System Package Type' || $page->title == 'Headers'): echo 'active'; endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-cog'></i>
                    <span>Customer Settings</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_sales_area') ?>">Sales Area</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_lead_source') ?>">Lead Source</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_lead_types') ?>">Lead Types</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/status') ?>">Status</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_rate_plans') ?>">Rate Plan</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_activation_fee') ?>">Activation Fee</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_system_package') ?>">System Package Type</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_headers') ?>">Header</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('customer/settings_import') ?>">Import Settings</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('customer/settings_export') ?>">Export Settings</a></li>
                    <?php if ( isSolarCompany() == 1 ) { ?>
                        <li><a class="dropdown-item btn-adt-sync-settings" href="javascript:void(0);">ADT Sales Portal : Data Sync Settings</a></li>
                    <?php } ?>
                </ul>
            </div>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>

<div class="modal fade nsm-modal fade" id="modal-adt-sales-sync-setting" tabindex="-1" aria-labelledby="modal-adt-sales-sync-setting" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form method="POST" id="update-adt-sales-sync-setting">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">ADT Sales Portal : Data Sync Settings</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="sync-setting-container"></div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary btn-update-adt-sales-sync-setting">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).on('click','.btn-adt-sync-settings', function(){
    var url = base_url + 'customer/_adt_sales_sync_setting';

    $('#modal-adt-sales-sync-setting').modal('show');
    $("#sync-setting-container").html('<span class="bx bx-loader bx-spin"></span>');

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         success: function(o)
         {          
            $('#sync-setting-container').html(o);
         }
      });
    }, 800);    
});

$(document).on('submit','#update-adt-sales-sync-setting', function(e){
    e.preventDefault();

    var url = base_url + 'customer/_update_adt_sales_sync_setting';
    $(".btn-update-adt-sales-sync-setting").html('<span class="bx bx-loader bx-spin"></span>');

    var formData = new FormData($("#update-adt-sales-sync-setting")[0]);   

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         dataType: 'json',
         contentType: false,
         cache: false,
         processData:false,
         data: formData,
         success: function(o)
         {          
            if( o.is_success == 1 ){   
                $("#modal-adt-sales-sync-setting").modal("hide");         
                Swal.fire({
                    title: 'Save Successful!',
                    text: "ADT Sales sync setting was successfully updated.",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    
                });
            }else{
              Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: o.msg
              });
            } 

            $(".btn-update-adt-sales-sync-setting").html('Update');
         }
      });
    }, 800);
});
</script>