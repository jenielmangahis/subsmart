<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Jobs' || $page->title == 'Job New'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('job') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Job Types'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('job/job_types') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Job Types</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Job Tags'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('job/job_tags') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Job Tags</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Bird\'s Eye View'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('job/bird_eye_view') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Bird's Eye View</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Checklist' || $page->title == 'Add New Job Checklist'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('job_checklists/list') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Checklist</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Job Settings'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('job/settings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Settings</span>
            </a>
        </li>
    </ul>
</div>