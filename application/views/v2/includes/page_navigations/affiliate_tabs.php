<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Affiliate Partners'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('affiliate') ?>">
                <i class='bx bx-fw bx-group'></i>
                <span>Affiliate Partners</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Affiliates Stats Dashboard'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('affiliate/stats_dashboard') ?>">
                <i class='bx bx-fw bxs-dashboard'></i>
                <span>Affiliates Stats Dashboard</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>