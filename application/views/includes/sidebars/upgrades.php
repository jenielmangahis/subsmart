<style type="text/css">
    div[role="wrapper"] .navbar-side .nav-header {
        background-color: #32243d;
        padding: 20px;
        margin-bottom: 0px;
        color: #45a73c;
        /*border-bottom: 1px solid #ccc;*/
    }
    div[role="wrapper"] .navbar-side {
        background-color: #32243d;
    }
    ul.nav li.submenus:hover {
        background: #45a73c;
        background: -moz-linear-gradient(top, #45a73c 0%, #67ce5e 100%);
        background: -webkit-linear-gradient(top, #45a73c 0%,#67ce5e 100%);
        background: linear-gradient(to bottom, #45a73c 0%,#67ce5e 100%);
    }
    div[role="wrapper"] .navbar-side .nav li > a {
        color: #fff;
        text-align: left;
    }

    div[role="wrapper"] .navbar-side .nav li > a {
        padding: 10px 15px !important;
    }
</style>
<nav class="navbar-side d-none d-md-block">
    <ul class="nav">
        <span class="nav-close" style="padding-top: 0px;margin-top: 52%;height:22px;">        <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg></span>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;"><img src="<?= getCompanyBusinessProfileImage(); ?>" class="company-logo"/></li>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;">UPGRADES</li>
        <li class="submenus <?= ($this->uri->uri_string() == 'more/upgrades') ? "active" : "";  ?>"><a href="<?php echo base_url('more/upgrades') ?>" title="Add-ons" style="color: #fff;">
            <span class="fa fa-cube"></span>Add-ons</a>
        </li>
        <?php
            $is_active_online_booking = "";
            if($this->uri->uri_string() == 'more/addon/booking') {
                $is_active_online_booking = "active";
            }elseif($this->uri->uri_string() == 'more/addon/booking/products') {
                $is_active_online_booking = "active";
            }elseif($this->uri->uri_string() == 'more/addon/booking/time') {
                $is_active_online_booking = "active";
            }elseif($this->uri->uri_string() == 'more/addon/booking/form') {
                $is_active_online_booking = "active";
            }elseif($this->uri->uri_string() == 'more/addon/booking/coupons') {
                $is_active_online_booking = "active";
            }elseif($this->uri->uri_string() == 'more/addon/booking/settings') {
                $is_active_online_booking = "active";
            }elseif($this->uri->uri_string() == 'more/addon/booking/preview') {
                $is_active_online_booking = "active";
            }
        ?>
        <li class="submenus <?= $is_active_online_booking; ?>"><a href="<?php echo base_url('more/addon/booking') ?>" title="Online Booking" style="color: #fff;">
            <span class="fa fa-address-card"></span>Online Booking</a>
        </li>

        <li class="submenus <?= ($this->uri->uri_string() == 'online_leads') ? "active" : "";  ?>"><a href="<?php echo base_url('online_leads') ?>" title="Lead Contact Form" style="color: #fff;">
            <span class="fa fa-address-card-o"></span>Lead Contact Form</a>
        </li>
        <li class="submenus"><a href="#" title="Ask for Review" style="color: #fff;">
            <span class="fa fa-envelope-square"></span>Ask for Review</a>
        </li>
        <li class="submenus"><a href="#" title="Virtual Number" style="color: #fff;">
            <span class="fa fa-mobile-phone"></span>&nbsp;&nbsp;Virtual Number</a>
        </li>
        <li class="submenus"><a href="#" title="Call Forwarding" style="color: #fff;">
            <span class="fa fa-phone-square"></span>Call Forwarding</a>
        </li>
        <li class="submenus"><a href="#" title="Campaign Builder" style="color: #fff;">
            <span class="fa fa-building"></span>Campaign Builder</a>
        </li>
        <li class="submenus"><a href="#" title="Estimator" style="color: #fff;">
            <span class="fa fa-dollar"></span>&nbsp;&nbsp;Estimator</a>
        </li>
        <li class="submenus"><a href="<?php echo base_url(); ?>wizard" title="Wizard" style="color: #fff;">
            <span class="fa fa-bars"></span>&nbsp;Wizard</a>
        </li>
        <li class="submenus"><a href="#" title="Credit Report" style="color: #fff;">
            <span class="fa fa-credit-card-alt"></span>Credit Report</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'video_estimate') ? "active" : "";  ?>"><a href="<?php echo base_url('video_estimate') ?>" title="Video Estimate" style="color: #fff;">
            <span class="fa fa-video-camera"></span>Video Estimate</a>
        </li>
        <li class="submenus"><a href="#" title="Payroll" style="color: #fff;">
            <span class="fa fa-gear"></span>Payroll</a>
        </li>
        <li class="submenus"><a href="#" title="Inventory Management" style="color: #fff;">
            <span class="fa fa-gears"></span>Inventory Management</a>
        </li>
        <li class="submenus"><a href="#" title="My Accountant" style="color: #fff;">
            <span class="fa fa-user"></span>My Accountant</a>
        </li>
    </ul>
</nav>
