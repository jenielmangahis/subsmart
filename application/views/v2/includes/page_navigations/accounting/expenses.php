<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Expenses'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="/accounting/expenses">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Expenses</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Vendors'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="/accounting/vendors">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Vendors</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>