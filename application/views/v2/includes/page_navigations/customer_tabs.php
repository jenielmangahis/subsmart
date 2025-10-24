<style>
    @media (max-width: 768px) {
    .nsm-page-link span {
        display: none;
    }

    .nsm-page-link:focus span,
    .nsm-page-link:active span {
        display: inline-block;
    }
}

</style>
<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Customers' || $page->title == 'Subscription Payment' || $page->title == 'New Subscription Plan'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer') ?>">
                <i class='bx bx-fw bx-user'></i>
                <span>My Customers</span>
            </a>
        </li>
        <!-- <li class="<?php if($page->title == 'Customer Dashboard'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/module') ?>">
                <i class='bx bx-fw bx-detail'></i>
                <span>Customer Dashboard</span>
            </a>
        </li> -->             
        <!-- <li class="<?php if($page->title == 'Leads Manager List' || $page->title == 'New Lead Form'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/leads') ?>">
                <i class='bx bx-fw bx-notepad'></i>
                <span>Leads</span>
            </a>
        </li> -->
     
        <li class="<?php if($page->title == 'Residential'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/residential') ?>">
            <i class='bx bxs-face'></i>
                <span>Residential</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Commercial'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/commercial') ?>">
            <i class='bx bx-building'></i>
                <span>Commercial</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Deals'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer_deals') ?>">
                <i class='bx bx-fw bx-briefcase-alt'></i>
                <span>Customer Deals</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Groups'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/group') ?>">
                <i class='bx bx-fw bx-group'></i>
                <span>Customer Groups</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Subscriptions' || $page->title == 'Add Group'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/subscriptions') ?>">
                <i class='bx bx-fw bx-user-pin'></i>
                <span>Subscriptions</span>
            </a>
        </li>   
        <li class="<?php if($page->title == 'Leads Manager List' || $page->title == 'Leads'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/leads') ?>">
            <i class='bx bxs-contact'></i>
                <span>Leads</span>
            </a>
        </li>
        <?php if( in_array(logged('company_id'), adi_company_ids()) ) { ?>
        <li class="<?php if($page->title == 'Alarm API : Customers'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('alarm_api/customers') ?>">
            <i class='bx bx-list-ul'></i>
                <span>Alarm API</span>
            </a>
        </li>
        <?php } ?>
        <li class="<?php if($page->title == 'Sales Area' || $page->title == 'Lead Source' || $page->title == 'Lead Types' || $page->title == 'Rate Plans' || $page->title == 'Activation Fee' || $page->title == 'System Package Type' || $page->title == 'Headers' || $page->title == 'Financing Categories' || $page->title == 'Customer Status' || $page->title == 'Import Settings' || $page->title == 'Export Settings' || $page->title == 'Solar Lender Types' || $page->title == 'Solar System Size' || $page->title == 'Solar Proposed Modules' || $page->title == 'Form Settings' || $page->title == 'Creditors / Furnishers' || $page->title == 'Lost Reasons' || $page->title == 'Alarm Installer Codes'): echo 'active'; endif; ?>">
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
                    <li><a class="dropdown-item" href="<?= base_url('customer/settings_financing_categories') ?>">Financing Payment Categories</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('creditor_furnisher/list') ?>">Creditors / Furnishers</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('customer/settings_alarm_installer_codes') ?>">Installer Codes</a></li>
                    <?php if( in_array(logged('company_id'), adi_company_ids()) ){ ?>
                        <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_solar_lender_type') ?>">Solar Lender Types</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_solar_system_size') ?>">Solar System Size</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('customer/settings_solar_modules') ?>">Solar Proposed Modules</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('customer/settings_solar_inverter') ?>">Solar Proposed Inverters</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_headers') ?>">Header</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('customer/settings_import') ?>">Import Settings</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('customer/settings_export') ?>">Export Settings</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('customer/form_settings') ?>">Form Fields</a></li>
                    <?php if ( isSolarCompany() == 1 ) { ?>
                        <li><a class="dropdown-item btn-adt-sync-settings" href="javascript:void(0);">ADT Sales Portal : Data Sync Settings</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item" href="<?= base_url('customer/settings_lost_reasons') ?>">Lost / Reasons</a></li>
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