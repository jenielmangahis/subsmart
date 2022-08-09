<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'My Profile'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/businessview') ?>">
                <i class='bx bx-fw bx-user'></i>
                <span>My Profile</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Business Details'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/businessdetail') ?>">
                <i class='bx bx-fw bx-user-pin'></i>
                <span>Business Details</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Services'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/services') ?>">
                <i class='bx bx-fw bx-wrench'></i>
                <span>Services</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Credentials'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/credentials') ?>">
                <i class='bx bx-fw bx-show-alt'></i>
                <span>Credentials</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Availability'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/availability') ?>">
                <i class='bx bx-fw bx-notepad'></i>
                <span>Availability</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Portfolio'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/portfolio') ?>">
                <i class='bx bx-fw bx-images'></i>
                <span>Portfolio</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Profile Settings' || $page->title == 'Social Media'): echo 'active'; endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-cog'></i>
                    <span>Settings</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('users/profilesetting') ?>">Profile Settings</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('users/socialMedia') ?>">Social Media</a></li>
                </ul>
            </div>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>