<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Jobs'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('job') ?>">
                <i class='bx bx-fw bx-briefcase'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Job Types'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('job/job_types') ?>">
                <i class='bx bx-fw bx-book'></i>
                <span>Job Types</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Job Tags'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('job/job_tags') ?>">
                <i class='bx bx-fw bx-tag'></i>
                <span>Job Tags</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Bird\'s Eye View'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('job/bird_eye_view') ?>">
                <i class='bx bx-fw bx-map-alt'></i>
                <span>Bird's Eye View</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Checklist'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('job_checklists/list') ?>">
                <i class='bx bx-fw bx-list-check'></i>
                <span>Checklist</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('job/settings') ?>">
                <i class='bx bx-fw bx-cog'></i>
                <span>Settings</span>
            </a>
            <!-- <div class="dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="#">
                    <i class='bx bx-fw bx-cog'></i>
                    <span>Settings</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('job/settings') ?>">Job Settings</a></li>
                    <li><a class="dropdown-item" href="#">Tax Rate</a></li>
                </ul>
            </div> -->
        </li>
    </ul>
</div>