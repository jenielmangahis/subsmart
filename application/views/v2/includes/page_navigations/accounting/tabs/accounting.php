<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Chart of Accounts'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="/accounting/chart-of-accounts">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Chart of accounts</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Reconcile' || $page->title == 'Reconciliation Summary' || $page->title == 'History by account'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="/accounting/reconcile">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Reconcile</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>