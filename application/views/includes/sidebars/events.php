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
</style>
<nav class="navbar-side d-none d-md-block">
    <ul class="nav"><span class="nav-close" style="padding-top: 0px;">        <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>           </span>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;"><img src="<?= getCompanyBusinessProfileImage(); ?>" class="company-logo"/></li>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;">EVENTS</li>
        <li class="submenus <?= $this->uri->segment(2) == 'new_event' || $this->uri->segment(2) == '' || $this->uri->segment(2) == 'event_preview' ? "active" : "";  ?>">
            <a href="<?= base_url('events') ?>" title="Jobs"><span class="fa fa-briefcase"></span>Events</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'event_types/index') ? "active" : "";  ?>">
            <a href="<?= base_url('event_types/index') ?>" title="Job Types"><span class="fa fa-book"></span>Events Types</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'events/event_tags') ? "active" : "";  ?>">
            <a href="<?= base_url('events/event_tags') ?>" title="Job Tags"><span class="fa fa-tags"></span>Events Tags</a>
        </li>
        <!-- <li class="submenus <?= ($this->uri->uri_string() == 'job/job_typess') ? "active" : "";  ?>">
            <a href="<?= base_url('job/job_time_settings') ?>" title="Profile Settings"><span class="fa fa-clock-o"></span>Time Window Settings</a>
        </li> -->
    </ul>
</nav>
