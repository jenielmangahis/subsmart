<style>
    @media (max-width: 768px) {
    .nsm-page-link span {
        display: none;
    }

    .nsm-page-link:focus span,
    .nsm-page-link:active span {
        display: inline-block;
    }
}

</style>
<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Automation'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('automation') ?>">
                <i class='bx bx-fw bx-bot'></i>
                <span>My Automations</span>
            </a>
        </li>
    
        <li class="<?php if($page->title == 'Automation Reminders'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('automation/reminders') ?>">
                <i class='bx bx-fw bx-bell'></i>
                <span>Reminders</span>
            </a>
        </li>
     
        <li class="<?php if($page->title == 'Automation Marketing'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('automation/marketing') ?>">
            <i class='bx bx-chart'></i>
                <span>Marketing</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Automation Follow-ups'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('automation/followUps') ?>">
            <i class='bx bx-time-five'></i>
                <span>Follow-ups</span>
            </a>
        </li>
     
        <li class="<?php if($page->title == 'Automation Actions'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('automation/actions') ?>">
            <i class='bx bx-bolt-circle'></i>
                <span>Actions</span>
            </a>
        </li>
       
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>
