<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Workorder' || $page->title == 'Workorder Priority' || $page->title == 'Workorder Settings' || $page->title == 'Workorder Checklist' || $page->title == 'New Workorder' || $page->title == 'Solar Stimulus Data Control / 2022 - 2024' || $page->title == 'Alarm System Work Order Agreement'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('workorder') ?>">
                <i class='bx bx-fw bx-task'></i>
                <span>Work Orders</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>