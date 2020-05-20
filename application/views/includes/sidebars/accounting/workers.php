<style type="text/css">
    div[role="wrapper"] .navbar-side .nav-header {
        background-color: #8e7cc3;
        padding: 20px;
        margin-bottom: 0px;
        color: #fff;
        border-bottom: 1px solid #ccc;
    }
    div[role="wrapper"] .navbar-side {
        background-color: #ccc;
    }
    ul.nav li.submenus:hover {
        background: #45a73c;
        background: -moz-linear-gradient(top, #45a73c 0%, #67ce5e 100%);
        background: -webkit-linear-gradient(top, #45a73c 0%,#67ce5e 100%);
        background: linear-gradient(to bottom, #45a73c 0%,#67ce5e 100%);
    }
</style>
<nav class="navbar-side d-none d-md-block">
    <ul class="nav">	<span class="nav-close">      	<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>        	</span>
        <li class="nav-header">Workers</li>
        <li class="submenus <?php //if($this->uri->uri_string() == 'estimate') { echo 'active'; }?>"><a href="<?php //echo base_url('estimate') ?>" title="Employee"><span
                        class="fa fa-file"></span>Employee</a></li>
        <li class="submenus <?php //if($this->uri->uri_string() == 'items') { echo 'active'; }?>"><a href="<?php //echo base_url('items') ?>" title="Contractors"><span class="fa fa-list"></span>Contractors</a></li>
        <?php /*<li class="submenus <?php if($this->uri->uri_string() == 'dashboard/blank') { echo 'active'; }?>"><a href="<?php echo base_url('dashboard/blank/?page=Item Vendors') ?>" title="Item Vendors"><span class="fa fa-cube"></span>Item Vendors</a></li>
        <li class="submenus <?php if($this->uri->uri_string() == 'plans') { echo 'active'; }?>"><a href="<?php echo base_url('plans') ?>" title="Plans"><span class="fa fa-cubes"></span>Plans</a></li>
        <li class="submenus <?php if($this->uri->uri_string() == '') { echo 'active'; }?>"><a href="<?php echo base_url('dashboard/blank/?page=Settings') ?>" title="Settings"><span class="fa fa-gear"></span>Settings</a></li>*/ ?>
    </ul>
</nav>