<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Customer Dashboard'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/module/'.$cus_id)?>">
                <i class='bx bx-fw bx-tachometer'></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Inventory List'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/inventory_list/'.$cus_id) ?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Inventory</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="javascript:void(0);" onclick="window.open('<?= base_url('job/new_job1?cus_id='.$cus_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Services'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="javascript:void(0);" onclick="window.open('<?= base_url('tickets/addTicketCust/'.$cus_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">
                <i class='bx bx-fw bx-wrench'></i>
                <span>Services</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#NEW_ESTIMATE_MODAL">
                <i class='bx bx-fw bx-chart'></i>
                <span>Estimates</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="javascript:void(0);">
                <i class='bx bx-fw bx-tag-alt'></i>
                <span>Tag Pending Report</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Credit Industry'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/credit_industry/'.$cus_id) ?>">
                <i class='bx bx-fw bx-credit-card'></i>
                <span>Credit Industry</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="javascript:void(0);">
                <i class='bx bx-fw bx-dollar-circle'></i>
                <span>Payment</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Invoice List'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/invoice_list/'.$cus_id) ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Invoices</span>
            </a>
        </li>
        <!-- <li class="<?php if($page->title == 'Customer Activity'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/activities/'.$cus_id) ?>">
                <i class='bx bx-fw bx-clipboard'></i>
                <span>Activity</span>
            </a>
        </li> -->
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" id="esignlink" onclick="window.open('<?= base_url('vault/mylibrary?customer_id=' . $cus_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');" data-customer-id="<?=$cus_id?>">
                <i class='bx bx-fw bx-palette'></i>
                <span>eSign</span>
            </a>
        </li>
        <!-- Do not remove the last li --> 
        <li><label></label></li>
    </ul>
</div>

<div class="modal" id="NEW_ESTIMATE_MODAL" data-bs-backdrop="static" role="dialog">
    <div id="NEW_ESTIMATE_MODAL_DIALOG" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="NEW_ESTIMATE_MODAL_TITLE" style="font-size: 17px;">New Estimate</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body" id="NEW_ESTIMATE_MODAL_BODY">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <center>
                            <label>Create a regular estimate with items</label>
                            <button type="button" class="nsm-button primary w-50 ESTIMATE_BUTTON" onclick="window.open('<?php echo base_url('estimate/add?customer=' . $profile_info->prof_id) ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');" data-bs-dismiss="modal">Standard Estimate</button>
                        </center>
                    </div>
                    <div class="col-md-12 mb-3">
                        <center>
                            <label>Customers can select all or only certain options</label>
                            <button type="button" class="nsm-button primary w-50 ESTIMATE_BUTTON" onclick="window.open('<?php echo base_url('estimate/addoptions?type=2&customer=' . $profile_info->prof_id) ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');" data-bs-dismiss="modal">Options Estimate</button>
                        </center>
                    </div>
                    <div class="col-md-12 mb-3">
                        <center>
                            <label>Customers can select both Bundle Packages to obtain an overall discount</label>
                            <button type="button" class="nsm-button primary w-50 ESTIMATE_BUTTON" onclick="window.open('<?php echo base_url('estimate/addbundle?type=3&customer=' . $profile_info->prof_id) ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');" data-bs-dismiss="modal">Bundle Estimate</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    (async () => {
        const $esignLink = document.getElementById("esignlink");
        const prefixURL = "";

        const response = await fetch(`${prefixURL}/DocuSign/apiGetDefaultTemplate`);
        const json = await response.json();
        if (!json.data) return;

        const templateId = json.data.template_id;
        const customerId = $esignLink.dataset.customerId;
        // $esignLink.setAttribute("href", `${prefixURL}/eSign/templatePrepare?id=${templateId}&customer_id=${customerId}`); 
    })()
</script>