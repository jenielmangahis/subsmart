<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Estimates' || $page->title == 'My Estimates' || $page->title == 'Plans' || $page->title == 'Estimate Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('estimate') ?>">
                <i class='bx bx-fw bx-chart'></i>
                <span>Estimates</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>