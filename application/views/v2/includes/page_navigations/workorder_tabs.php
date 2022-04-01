<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Workorder'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('workorder') ?>">
                <i class='bx bx-fw bx-task'></i>
                <span>Work Orders</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Workorder Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('workorder/settings') ?>">
                <i class='bx bx-fw bx-cog'></i>
                <span>Settings</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Workorder Checklist'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('workorder/checklists') ?>">
                <i class='bx bx-fw bx-list-check'></i>
                <span>Checklist</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>