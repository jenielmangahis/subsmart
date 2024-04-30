<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Tickets'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/ticketslist') ?>">
                <i class='bx bx-fw bx-note'></i>
                <span>Service Tickets</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>