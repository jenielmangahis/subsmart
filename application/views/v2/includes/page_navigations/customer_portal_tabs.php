<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->portal_tabs == 'portal_customer_information'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('client_hub/' . $customer_id_incrypt) ?>">
                <i class='bx bx-fw bxs-user-circle'></i>
                <span>Customer Information</span>
            </a>
        </li>
        <li class="<?php if($page->portal_tabs == 'portal_jobs'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('client_hub/jobs/' . $customer_id_incrypt)?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->portal_tabs == 'portal_tickets'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('client_hub/tickets/' . $customer_id_incrypt) ?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Tickets</span>
            </a>
        </li>
        <li class="<?php if($page->portal_tabs == 'portal_invoice_status'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('client_hub/invoice_status/' . $customer_id_incrypt) ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Invoices</span>
            </a>
        </li>
        <li><label></label></li>
    </ul>
</div>