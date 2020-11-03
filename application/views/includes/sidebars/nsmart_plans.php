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
        <span class="nav-close">
            <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%">
                <path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path>
            </svg>           
        </span>

        <li class="nav-header">Plan Builder</li>
        <?php 
            $is_active_plans    = "";
            $is_active_features = "";
            $is_active_addons   = "";
            $is_active_industry_module = "";
            $is_active_industry_template = "";
            $is_active_industry_type = "";
            $is_active_admin_management = "";
            $is_active_upgrades = "";
            
            if($this->uri->uri_string() == 'nsmart_plans/index') {
                $is_active_plans = "active";
            }elseif($this->uri->uri_string() == 'nsmart_features/index') {
                $is_active_features = "active";
            }elseif($this->uri->uri_string() == 'plan_headings/add_new_headings') {
                $is_active_features = "active";
            }elseif($this->uri->uri_string() == 'nsmart_features/add_new_feature') {
                $is_active_features = "active";
            }elseif($this->uri->uri_string() == 'nsmart_addons/index') {
                $is_active_addons = "active";
            }elseif($this->uri->uri_string() == 'nsmart_addons/add_new_addon') {
                $is_active_addons = "active";
            }elseif($this->uri->uri_string() == 'nsmart_addons/edit_addon') {
                $is_active_addons = "active";
            }elseif($this->uri->uri_string() == 'industry_modules/index') {
                $is_active_industry_module = "active";
            }elseif($this->uri->uri_string() == 'industry_modules/add_new_module') {
                $is_active_industry_module = "active";
            }elseif($this->uri->uri_string() == 'industry_modules/edit_module') {
                $is_active_industry_module = "active";
            }elseif($this->uri->uri_string() == 'industry_template/index') {
                $is_active_industry_template = "active";
            }elseif($this->uri->uri_string() == 'industry_template/add_new_template') {
                $is_active_industry_template = "active";
            }elseif($this->uri->uri_string() == 'industry_template/edit_template') {
                $is_active_industry_template = "active";
            }elseif($this->uri->uri_string() == 'industry_type/index') {
                $is_active_industry_type = "active";
            }elseif($this->uri->uri_string() == 'industry_type/add_new_industry_type') {
                $is_active_industry_type = "active";
            }elseif($this->uri->uri_string() == 'industry_type/edit_industry_type') {
                $is_active_industry_type = "active";
            }elseif($this->uri->uri_string() == 'nsmart_adminmgt/subscribers') {
                $is_active_admin_management = "active";
            }

            

        ?>
        <li class="submenus <?= $is_active_plans; ?>"><a href="<?php echo base_url('nsmart_plans/index') ?>" title="Plans" style="color: #fff;">
            <span class="fa fa-cubes"></span>Plans</a>
        </li>
        
        <li class="submenus <?= $is_active_features; ?>"><a href="<?php echo base_url('nsmart_features/index') ?>" title="Features" style="color: #fff;">
            <span class="fa fa-list"></span>Features</a>
        </li>

        <li class="submenus <?= $is_active_addons; ?>"><a href="<?php echo base_url('nsmart_addons/index') ?>" title="Addons" style="color: #fff;">
            <span class="fa fa-list"></span>Addons</a>
        </li>

        <li class="submenus <?= $is_active_upgrades; ?>"><a href="<?php echo base_url('nsmart_upgrades/index') ?>" title="Addons" style="color: #fff;">
            <span class="fa fa-list"></span>Upgrades</a>
        </li>

        <li class="submenus <?= $is_active_industry_module; ?>"><a href="<?php echo base_url('industry_modules/index') ?>" title="Industry Modules" style="color: #fff;">
            <span class="fa fa-list"></span>Industry Modules</a>
        </li>
         <li class="submenus <?= $is_active_industry_template; ?>"><a href="<?php echo base_url('industry_template/index') ?>" title="Industry Modules" style="color: #fff;">
            <span class="fa fa-list"></span>Industry Template</a>
        </li>
        <li class="submenus <?= $is_active_industry_type; ?>"><a href="<?php echo base_url('industry_type/index') ?>" title="Industry Modules" style="color: #fff;">
            <span class="fa fa-list"></span>Industry Type</a>
        </li>
        <li class="submenus <?= $is_active_admin_management; ?>"><a href="<?php echo base_url('nsmart_adminmgt/subscribers') ?>" title="Industry Modules" style="color: #fff;">
            <span class="fa fa-list"></span>Admin Management</a>
        </li>
    </ul>
</nav>