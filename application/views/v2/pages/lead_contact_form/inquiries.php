<?php include viewPath('v2/includes/header'); ?>
<style>
#tbl-custom-fields thead tr{
    font-size:16;
} 
#tbl-custom-fields tbody tr{
    font-size:14px;
} 
.lead-converted{
    color:#6a4a86 !important;    
}
.lead-inquiry, .lead-converted{
    font-size:18px; 
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/lead_contact_form_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Inquiry list from your lead contact form.
                        </div>
                    </div>
                </div>                
                <div class="row" id="deal-forecast">
                    <form id="frm-with-selected">
                        <table class="nsm-table" id="lead-contact-inquiry-list">
                        <thead>
                            <tr>
                                <?php if(checkRoleCanAccessModule('lead-contact-form', 'write')){ ?>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>
                                <?php } ?>
                                <td class="table-icon"></td>
                                <td data-name="Name" style="width:50%;">Name</td>
                                <td data-name="Phone" style="width:15%;">Phone</td>
                                <td data-name="Email" style="width:15%;">Email</td>   
                                <td data-name="Email" style="width:8%;text-align:center;">Is Converted</td>                                     
                                <td data-name="Date Created" style="width:20%;">Date Created</td>
                                <td data-name="Manage"  style="width:3%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( $inquiries ){ ?>
                                <?php foreach($inquiries as $inquiry){ ?>
                                    <tr>
                                        <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
                                        <td>
                                            <input class="form-check-input row-select table-select" name="inquiries[]" type="checkbox" value="<?= $inquiry->id; ?>">
                                        </td>
                                        <?php } ?>
                                        <td>
                                            <?php if( $inquiry->lead_id > 0 ){ ?>
                                                <i class='bx bxs-user-circle lead-converted'></i>
                                            <?php }else{ ?>
                                                <i class='bx bx-user-circle lead-inquiry'></i>
                                            <?php } ?>
                                        </td>
                                        <td><?= $inquiry->first_name . ' ' . $inquiry->last_name; ?></td>
                                        <td><?= formatPhoneNumber($inquiry->phone); ?></td>
                                        <td><?= $inquiry->email; ?></td>
                                        <td style="text-align:center;"><?= $inquiry->lead_id > 0 ? 'Yes' : 'No'; ?></td>
                                        <td><?= date("m/d/Y G:i A",strtotime($inquiry->date_created)); ?></td>                                                                                                                
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                                <ul class="dropdown-menu dropdown-menu-end">                                            
                                                    <li><a class="dropdown-item btn-view-inquiry" href="javascript:void(0);" data-id="<?= $inquiry->id; ?>">View</a></li>                                                    
                                                    <?php if(checkRoleCanAccessModule('lead-contact-form', 'write')){ ?>
                                                        <li><a class="dropdown-item btn-convert-to-lead" href="javascript:void(0);" data-name="<?= $inquiry->first_name . ' ' . $inquiry->last_name; ?>" data-id="<?= $inquiry->id; ?>">Convert to lead</a></li>
                                                    <?php } ?>
                                                    <?php if(checkRoleCanAccessModule('lead-contact-form', 'write')){ ?>
                                                        <li><a class="dropdown-item btn-delete-inquiry" href="javascript:void(0);" data-name="<?= $inquiry->first_name . ' ' . $inquiry->last_name; ?>" data-id="<?= $inquiry->id; ?>">Delete</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <span>No results found.</span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/lead_contact_form/modals'); ?>
<?php include viewPath('v2/pages/lead_contact_form/js/inquiries'); ?>
<?php include viewPath('v2/includes/footer'); ?>