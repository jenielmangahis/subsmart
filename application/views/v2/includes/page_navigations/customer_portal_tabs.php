<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->portal_tabs == 'portal_jobs'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('/')?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->portal_tabs == 'portal_tickets'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('/') ?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Tickets</span>
            </a>
        </li>
        <li class="<?php if($page->portal_tabs == 'portal_invoice_status'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('/') ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Invoice Status</span>
            </a>
        </li>
        <li><label></label></li>
    </ul>
</div>