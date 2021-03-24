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
    div[role="wrapper"] .navbar-side .nav li > a {
        color: #fff;
		padding:15px 15px;
        text-align: left;
    }
    .acct-btn-add{
        border-radius: 20px;
        width: 90%;
        color:#fff;
        border: solid 2px white;
    }
    .acct-btn-add:hover{
        border: solid 2px #adff2f !important;
        color:#adff2f;
    }
    #sidebar ul li.active > a {
        background: #45a73c !important;
        color: #fff !important;
    }
    #sidebar ul li:active{
        background: #45a73c;
    }
    .dropdown-toggle::after {
        top: 25px !important;
    }
    #sidebar ul li > ul li:first-child a:focus,
    #sidebar ul li > ul li:first-child a:hover {
        border-radius: 0 0 0 0 !important;
    }
    #sidebar ul li > ul li:last-child a:focus,
    #sidebar ul li > ul li:last-child a:hover {
        border-radius: 0 0 0 0 !important;
    }
    img.company-logo {
        width: auto;
        height: auto;
        object-fit: cover;
        margin: 0 auto;
        max-height: 120px;
    }
    svg#svg-sprite-menu-close {
      position: relative;
      bottom: 64px;
    }
</style>
<nav id="sidebar" class="navbar-side">
    <ul class="nav sidebar-accounting">
        <span class="nav-close">
            <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%">
                <path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path>
            </svg>
        </span>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;"><img src="<?= getCompanyBusinessProfileImage(); ?>" class="company-logo"/></li>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;">JOBS</li>
        <li class="submenus <?= $this->uri->segment(2) == 'new_job1' || $this->uri->segment(2) == '' || $this->uri->segment(2) == 'job_preview' ? "active" : "";  ?>">
            <a href="<?= base_url('job') ?>" title="Jobs"><span class="fa fa-briefcase"></span>Jobs</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'job/job_tags') ? "active" : "";  ?>">
            <a href="<?= base_url('job/job_tags') ?>" title="Job Tags"><span class="fa fa-tags"></span>Job Tags</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'job/job_types') ? "active" : "";  ?>">
            <a href="<?= base_url('job/job_types') ?>" title="Job Types"><span class="fa fa-book"></span>Job Types</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'job/bird_eye_view') ? "active" : "";  ?>">
            <a href="<?= base_url('job/bird_eye_view') ?>" title="Bird Eye View"><span class="fa fa-users"></span>Bird Eye View</a>
        </li>
        <li class="submenus <?php if($this->uri->uri_string() == 'job/settings') { echo 'active'; }?>">
            <a href="<?php echo base_url('job/settings') ?>" title="Settings"><span class="fa fa-gear"></span>Settings</a>
        </li>
        <!-- <li class="submenus <?= ($this->uri->uri_string() == 'job/job_types') ? "active" : "";  ?>">
            <a href="<?= base_url('job/job_time_settings') ?>" title="Profile Settings"><span class="fa fa-clock-o"></span>Time Window Settings</a>
        </li> -->
    </ul>
</nav>
