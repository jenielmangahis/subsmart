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
    li.submenus a span span.badge {
        position: absolute !important;
        left: -2px !important;
    }
    .left-sidebar-badge{
        position: relative;
        left: -13px;
        top: -10px;
    }
    span.spacer-badge {
      margin-right: 4px !important;
      display: inline;
    }
</style>
<nav class="navbar-side d-none d-md-block">
    <ul class="nav"><span class="nav-close">      	<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>        	</span>
        <li class="nav-header">Calendar</li>
        <li class="submenus <?php echo (!empty($page->menu) && ($page->menu === 'schedule' || $page->menu === 'Workcalender' ))  ? "active" : ""; ?>">
            <a href="<?php echo base_url('workcalender') ?>"
                        title="Schedule">
                <span class="fa fa-calendar" style="margin-right:5px;"></span><span class="total-schedule left-sidebar-badge"></span> Schedule
            </a>
        </li>
        <?php // additional menus for Schedule ?>
        <li class="submenus <?php echo (!empty($page->menu) && $page->menu === 'taskhub')  ? "active" : ""; ?>">
            <a href="<?php echo base_url('taskhub') ?>" title="Taskhub">
                <span class="fa fa-clipboard" style="margin-right:4px;"></span><span class="total-taskhub left-sidebar-badge"></span> TaskHub
            </a>
        </li>
        <li class="submenus"<?php //echo (!empty($page->menu) && $page->menu === 'settings')  ? "class='active'" : ""; ?>>
            <a href="<?php echo base_url('more/addon/booking') ?>" title="Online Booking">
                <span class="fa fa-book"></span><span class="total-online-booking left-sidebar-badge"></span>Online Booking
            </a>
        </li>
        <li class="submenus <?php echo (!empty($page->menu) && ($page->menu === 'priority' ))  ? "active" : ""; ?>"><a href="<?php echo base_url('workorder/priority/') ?>" title="Credentials"><span class="fa fa-cube"></span>
          <span class="spacer-badge"></span>Priority</a></li>
        <li class="submenus <?php echo (!empty($page->menu) && ($page->menu === 'map' ))  ? "active" : ""; ?>"><a href="<?php echo base_url('workorder/map') ?>" title="Services"><span class="fa fa-users"></span>
          <span class="spacer-badge"></span>Bird Eye View</a></li>
        <li class="submenus <?php echo (!empty($page->menu) && $page->menu === 'event_types')  ? "active" : ""; ?>">
            <a href="<?php echo base_url('event_types/index') ?>" title="Event Types">
                <span class="fa fa-gear"></span><span class="left-sidebar-badge"></span>Event Types
            </a>
        </li>
        <li class="submenus <?php echo (!empty($page->menu) && $page->menu === 'color_settings')  ? "active" : ""; ?>">
            <a href="<?php echo base_url('color_settings/index') ?>" title="Color Settings">
                <span class="fa fa-gear"></span><span class="left-sidebar-badge"></span>Color Settings
            </a>
        </li>
        <li class="submenus <?php echo (!empty($page->menu) && $page->menu === 'settings')  ? "active" : ""; ?>">
            <a href="<?php echo base_url('settings/schedule') ?>" title="Services">
                <span class="fa fa-gear"></span>
                <span class="spacer-badge"></span>Calendar Settings
            </a>
        </li>
    </ul>
</nav>
