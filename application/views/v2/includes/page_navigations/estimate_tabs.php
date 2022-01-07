<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Estimates'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('estimate') ?>">
                <i class='bx bx-fw bx-chart'></i>
                <span>Estimates</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Plans'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('plans') ?>">
                <i class='bx bx-fw bx-calendar-alt'></i>
                <span>Plans</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Estimate Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('estimate/settings') ?>">
                <i class='bx bx-fw bx-cog'></i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
</div>