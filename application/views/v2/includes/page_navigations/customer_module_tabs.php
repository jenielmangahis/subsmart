                 b<div class="nsm-page-nav">
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
            <a class="nsm-page-link" href="javascript:void(0);" onclick="window.open('<?= base_url('job/new_job1?cus_id='.$cus_id); ?>');">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="javascript:void(0);" onclick="window.open('<?= base_url('customer/addTicket?cus_id='.$cus_id); ?>');">
                <i class='bx bx-fw bx-wrench'></i>
                <span>Services</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#new_estimate_modal">
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
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/credit_industry/'.$cus_id) ?>">
                <i class='bx bx-fw bx-credit-card'></i>
                <span>Credit Industry</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/call/'.$cus_id) ?>">
                <i class='bx bx-fw bx-phone-call'></i>
                <span>Call</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="javascript:void(0);">
                <i class='bx bx-fw bx-dollar-circle'></i>
                <span>Payment</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <!-- <a class="nsm-page-link" href="<?= base_url('customer/messages_list/'.$cus_id); ?>">
                <i class='bx bx-fw bx-chat'></i>
                <span>Messages</span>
            </a> -->
            <a class="nsm-page-link sent-messages" href="javascript:void(0);" data-cid="<?= $customer_profile_id; ?>">
                <i class='bx bx-fw bx-chat'></i>
                <span>Messages</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/internal_notes/'.$cus_id); ?>">
                <i class='bx bx-fw bx-file'></i>
                <span>Internal Memo</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/invoice_list/'.$cus_id) ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Invoices</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/activities/'.$cus_id) ?>">
                <i class='bx bx-fw bx-clipboard'></i>
                <span>Activity</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" id="esignlink" href="<?= base_url('vault/mylibrary?customer_id=' . $cus_id); ?>" data-customer-id="<?=$cus_id?>">
                <i class='bx bx-fw bx-palette'></i>
                <span>eSign</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>
<script>
    (async () => {
        const $esignLink = document.getElementById("esignlink");
        const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

        const response = await fetch(`${prefixURL}/DocuSign/apiGetDefaultTemplate`);
        const json = await response.json();
        if (!json.data) return;

        const templateId = json.data.template_id;
        const customerId = $esignLink.dataset.customerId;
        $esignLink.setAttribute("href", `${prefixURL}/eSign/templatePrepare?id=${templateId}&customer_id=${customerId}`); 
    })()
</script>