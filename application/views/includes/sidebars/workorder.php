<nav class="navbar-side d-none d-md-block">
    <ul class="nav"><span class="nav-close">      	<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>        	</span>
        <li class="nav-header">Workorders</li>
        <li <?php echo (!empty($page->menu) && ($page->menu === 'workorder' ))  ? "class='active'" : ""; ?>><a href="<?php echo base_url('workorder') ?>" title="Work Orders"><span
                        class="fa fa-user"></span>Work Orders</a></li>
        <li <?php echo (!empty($page->menu) && ($page->menu === 'map' ))  ? "class='active'" : ""; ?>><a href="<?php echo base_url('workorder/map') ?>" title="Services"><span class="fa fa-users"></span>Bird Eye View</a></li>
        <li <?php echo (!empty($page->menu) && ($page->menu === 'job_type' ))  ? "class='active'" : ""; ?>><a href="<?php echo base_url('workorder/job_type/') ?>" title="Credentials"><span class="fa fa-cube"></span>Job Type List</a></li>
        <li <?php echo (!empty($page->menu) && ($page->menu === 'priority' ))  ? "class='active'" : ""; ?>><a href="<?php echo base_url('workorder/priority/') ?>" title="Credentials"><span class="fa fa-cube"></span>Priority List</a></li>
        <li <?php echo (!empty($page->menu) && ($page->menu === 'settings' ))  ? "class='active'" : ""; ?>><a href="<?php echo base_url('workorder/settings') ?>" title="Credentials"><span class="fa fa-cube"></span>Settings</a></li>
        <li><a href="<?php echo base_url('dashboard/blank/?page=Checklist') ?>" title="Credentials"><span class="fa fa-cube"></span>Checklist</a></li>
        <li <?php echo (!empty($page->menu) && ($page->menu === 'workstatus' ))  ? "class='active'" : ""; ?>><a href="<?php echo base_url('workstatus') ?>" title="Credentials"><span class="fa fa-cube"></span>Status</a></li>
    </ul>
</nav>