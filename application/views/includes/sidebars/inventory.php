<style type="text/css">
    div[role="wrapper"] .navbar-side .nav-header {
        background-color: #32243d;
        padding: 20px;
        margin-bottom: 0px;
        color: #45a73c;
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
    #sidebar ul li {
        font-size: 16px;
    }
    #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
</style>
<nav class="navbar-side">
    <ul class="nav">
        <span class="nav-close" >
            <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"  style="margin-top: 50px;">
                <path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path>
            </svg>
        </span>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;"><img src="<?= getCompanyBusinessProfileImage(); ?>" class="company-logo"/></li>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;">INVENTORY</li>
        <li class="submenus <?= $this->uri->segment(2) == '' || $this->uri->uri_string() == 'inventory/add'  ? "active" : "";  ?>">
            <a href="<?php echo base_url('inventory') ?>" id="addServicesInventory"><i class="fa fa-barcode" style="margin-right: 20px"></i>Inventory</a>
        </li>
        <li class="submenus <?= ($this->uri->segment(2) == 'services') ? "active" : "";  ?>">
            <a href="<?= base_url('inventory/services') ?>" id="addServicesInventory"><i class="fa fa-bell" style="margin-right: 20px"></i>Services</a>
        </li>
        <li class="submenus <?= ($this->uri->segment(2) == 'fees') ? "active" : "";  ?>">
            <a href="<?= base_url('inventory/fees') ?>" id="addFeesInventory"><i class="fa fa-money" style="margin-right: 20px"></i>Fees</a>
        </li>
        <!--<li class="submenus dropright">
            <a href="javascript:void(0)" id="orderInventory1"><i class="fa fa-shopping-basket " style="margin-right: 20px"></i>Order</a>
        </li>-->
        <li class="submenus <?= ($this->uri->segment(2) == 'vendors') ? "active" : "";  ?>">
            <a href="<?= base_url('inventory/vendors') ?>" id="vendorInventory1"><i class="fa fa-truck" style="margin-right: 20px"></i>Vendors</a>
        </li>
        <!--<li class="submenus dropright">
            <a href="javascript:void(0)" id="reportsInventory1"><i class="fa fa-bar-chart" style="margin-right: 20px"></i>Reports</a>
        </li>-->
        <li class="submenus <?= ($this->uri->segment(2) == 'item_groups') ? "active" : "";  ?>">
            <a href="<?= base_url('inventory/item_groups') ?>" id="addItemGroups"><i class="fa fa-th-list" style="margin-right: 20px"></i>Item Categories</a>
        </li>
        <!-- <li class="submenus <?= ($this->uri->segment(2) == 'plans') ? "active" : "";  ?>">
            <a href="<?= base_url('inventory/plans') ?>"><i class="fa fa-tasks" style="margin-right: 20px"></i>Package</a>
        </li> -->
    </ul>
</nav>
<div id="overlay">
    <div>
        <img src="<?=base_url()?>/assets/img/uploading.gif" class="" style="width: 80px;" alt="" />
        <center><p>Processing...</p></center>
    </div>
</div>

