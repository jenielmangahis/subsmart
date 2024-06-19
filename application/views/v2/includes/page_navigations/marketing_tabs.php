<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Customers'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>My Customers</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'SMS Blast'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('sms_campaigns')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>SMS Blast</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Survey Wizard'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('survey')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Survey</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'SMS Automation'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('sms_automation')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>SMS Automation</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Email Blast'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('email_campaigns')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Email Blast</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Email Broadcast'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('email_broadcasts')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Email Broadcast</span>
            </a>
        </li>
        <!-- <li class="<?php if($page->title == 'Email Automation'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('email_automation')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Email Automation</span>
            </a>
        </li> -->
        <li class="<?php if($page->title == 'Deals & Steals'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('promote/deals')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Deals and Steals</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Campaign 360'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('campaign')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Campaign 360</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'My Inquiry List'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('my_inquires')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>My Inquiry List</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>