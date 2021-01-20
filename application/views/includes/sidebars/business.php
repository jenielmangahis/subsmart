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

    .header-left {
        text-align:left;
    }
</style>
<nav class="navbar-side d-none d-md-block">
    <ul class="nav"><span class="nav-close">      	<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>        	</span>
        <!--<span class="nav-close">					<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>				</span>-->
        <li class="nav-header header-left">My Business</li>
        <li class="submenus <?= ($this->uri->uri_string() == 'users/businessview') ? "active" : "";  ?>">
            <a href="<?= base_url('users/businessview') ?>" title="My Profile"><span class="fa fa-user"></span>My Profile</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'users/businessdetail') ? "active" : "";  ?>">
            <a href="<?= base_url('users/businessdetail') ?>" title="Business Details"><span class="fa fa-briefcase"></span>Business Details</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'users/services') ? "active" : "";  ?>">
            <a href="<?= base_url('users/services') ?>" title="Services"><span class="fa fa-home"></span>Services</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'users/credentials') ? "active" : "";  ?>">
            <a href="<?= base_url('users/credentials') ?>" title="Credentials"><span class="fa fa-shield"></span>Credentials</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'users/availability') ? "active" : "";  ?>">
            <a href="<?= base_url('users/availability') ?>" title="Availability"><span class="fa fa-calendar"></span>Availability</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'users/portfolio') ? "active" : "";  ?>">
            <a href="<?= base_url('users/portfolio') ?>" title="Portfolio"><span class="fa fa-camera-retro"></span>Work Pictures</a>
        </li>
        <li class="nav-header header-left">Settings</li>
        <li class="submenus <?= ($this->uri->uri_string() == 'users/profilesetting') ? "active" : "";  ?>">
            <a href="<?= base_url('users/profilesetting') ?>" title="Profile Settings"><span class="fa fa-cogs"></span>Profile Settings</a>
        </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'users/socialMedia') ? "active" : "";  ?>">
            <a href="<?= base_url('users/socialMedia') ?>" title="Social Media"><span class="fa fa-share-square-o"></span>Social Media</a>
        </li>
    </ul>
</nav>