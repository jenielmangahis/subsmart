<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Affiliate Partners'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('affiliate') ?>">
                <i class='bx bx-fw bx-group'></i>
                <span>Affiliate Partners</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Affiliates Stats Dashboard'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/google_contacts') ?>">
                <i class='bx bx-fw bxs-dashboard'></i>
                <span>Affiliates Stats Dashboard</span>
            </a>
        </li>
    </ul>
</div>