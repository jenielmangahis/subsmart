<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Workorder' || $page->title == 'New Workorder' || $page->title == 'Solar Stimulus Data Control / 2022 - 2024' || $page->title == 'Alarm System Work Order Agreement'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('workorder') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Lists</span>
            </a>
        </li>        
        <li class="<?php if($page->title == 'Workorder Checklist'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('workorder/checklists') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Checklist</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Workorder Priority'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('workorder/priority') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Priority</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Workorder Settings'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('workorder/settings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Settings</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Workorder Status'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('workorder/status') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Status</span>
            </a>
        </li>
    </ul>
</div>