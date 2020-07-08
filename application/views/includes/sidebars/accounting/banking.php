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
.acct-btn-add{
    border-radius: 20px;
    width: 90%;
    color:white;
    border: solid 2px white;
}
.acct-btn-add:hover{
    border: solid 3px #adff2f;
}

</style>
<!--<nav class="navbar-side d-none d-md-block ">-->
<!--    <ul class="nav">	<span class="nav-close">      	<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>        	</span>-->
<!--        <li class="nav-header">Banking</li>-->
<!--        <li class="submenus"><a href="--><?php //echo site_url()?><!--accounting/dashboard" title="Link Bank">-->
<!--                <span class="fa fa-tachometer"></span>Dashboard</a>-->
<!--        </li>-->
<!--        <li class="submenus"><a href="" title="Link Bank">-->
<!--                <span class="fa fa-money"></span>Banking <i class="fa fa-chevron-right" style="float: right"></i></a>-->
<!--                <ul class="sub-menus">-->
<!--                    <li><a href="">Link Bank</a></li>-->
<!--                    <li><a href="">Rules</a></li>-->
<!--                    <li><a href="">Receipts</a></li>-->
<!--                </ul>-->
<!--        </li>-->
<!--        <li class="submenus"><a href="--><?php //echo site_url()?><!--accounting/" title="Link Bank">-->
<!--                <span class="fa fa-money"></span>Expenses<i class="fa fa-chevron-right" style="float: right"></i></a>-->
<!--            <ul class="sub-menus">-->
<!--                <li><a href="">Expenses</a></li>-->
<!--                <li><a href="">Vendors</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="submenus"><a href="--><?php //echo site_url()?><!--accounting/" title="Link Bank">-->
<!--                <span class="fa fa-dollar"></span>Sales <i class="fa fa-chevron-right" style="float: right"></i></a>-->
<!--            <ul class="sub-menus">-->
<!--                <li><a href="">Overview</a></li>-->
<!--                <li><a href="">All Sales</a></li>-->
<!--                <li><a href="">Invoices</a></li>-->
<!--                <li><a href="">Customers</a></li>-->
<!--                <li><a href="">Deposits</a></li>-->
<!--                <li><a href="">Products and Services</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="submenus"><a href="--><?php //echo site_url()?><!--accounting/" title="Link Bank">-->
<!--                <span class="fa fa-paypal"></span>Payroll <i class="fa fa-chevron-right" style="float: right"></i></a>-->
<!--            <ul class="sub-menus">-->
<!--                <li><a href="">Overview</a></li>-->
<!--                <li><a href="">Employees</a></li>-->
<!--                <li><a href="">Contractors</a></li>-->
<!--                <li><a href="">Workers Comp</a></li>-->
<!--                <li><a href="">Benefits</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="submenus"><a href="--><?php //echo site_url()?><!--accounting/" title="Link Bank">-->
<!--                <span class="fa fa-save"></span>Reports</a>-->
<!--        </li>-->
<!--        <li class="submenus"><a href="--><?php //echo site_url()?><!--accounting/" title="Link Bank">-->
<!--                <span class="fa fa-credit-card"></span>Taxes <i class="fa fa-chevron-right" style="float: right"></i></a>-->
<!--            <ul class="sub-menus">-->
<!--                <li><a href="">Sales Tax</a></li>-->
<!--                <li><a href="">Payroll Tax</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="submenus"><a href="--><?php //echo site_url()?><!--accounting/" title="Link Bank">-->
<!--                <span class="fa fa-file"></span>Mileage</a>-->
<!--        </li>-->
<!--        <li class="submenus"><a href="--><?php //echo site_url()?><!--accounting/" title="Link Bank">-->
<!--                <span class="fa fa-calculator"></span>Accounting <i class="fa fa-chevron-right" style="float: right"></i></a>-->
<!--            <ul class="sub-menus">-->
<!--                <li><a href="">Chart of Accounts</a></li>-->
<!--                <li><a href="">Reconcile</a></li>-->
<!--            </ul>-->
<!--        </li>-->
        <?php /*<li class="submenus <?php if($this->uri->uri_string() == 'dashboard/blank') { echo 'active'; }?>"><a href="<?php echo base_url('dashboard/blank/?page=Item Vendors') ?>" title="Item Vendors"><span class="fa fa-cube"></span>Item Vendors</a></li>
        <li class="submenus <?php if($this->uri->uri_string() == 'plans') { echo 'active'; }?>"><a href="<?php echo base_url('plans') ?>" title="Plans"><span class="fa fa-cubes"></span>Plans</a></li>
        <li class="submenus <?php if($this->uri->uri_string() == '') { echo 'active'; }?>"><a href="<?php echo base_url('dashboard/blank/?page=Settings') ?>" title="Settings"><span class="fa fa-gear"></span>Settings</a></li>*/ ?>
<!--    </ul>-->
<!--</nav>-->

<nav id="sidebar" class="d-none d-md-block navbar-side">

       <button class="btn btn-tranparent acct-btn-add mx-auto" type="button" data-toggle="modal" data-target="#addBtnModal"><i class="fa fa-plus" style="margin-right: 20px;"></i>New</button>
        <ul class="nav mb-5">
            <li>
                <a href="#"><i class="fa fa-tachometer" style="margin-right: 20px"></i>Dashboard</a>
            </li>
            <li class="">
                <a href="#submenuBanking" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-money" style="margin-right: 20px"></i>Banking</a>
                <ul class="collapse list-unstyled" id="submenuBanking">
                    <li>
                        <a href="<?php echo url('/accounting/link_bank')?>">Link Bank</a>
                    </li>
                    <li>
                        <a href="<?php echo url('/accounting/rules')?>">Rules</a>
                    </li>
                    <li>
                        <a href="<?php echo url('/accounting/receipts')?>">Receipts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#submenuExpenses" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-money" style="margin-right: 20px"></i>Expenses</a>
                <ul class="collapse list-unstyled" id="submenuExpenses">
                    <li>
                        <a href="#">Expenses</a>
                    </li>
                    <li>
                        <a href="#">Vendors</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#submenuSales" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-dollar" style="margin-right: 20px"></i>Sales</a>
                <ul class="collapse list-unstyled" id="submenuSales">
                    <li>
                        <a href="<?php echo base_url();?>accounting/sales-overview">Overview</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>accounting/all-sales">All Sales</a>
                    </li>
                    <li>
                        <a href="#">Invoices</a>
                    </li>
                    <li>
                        <a href="#">Customers</a>
                    </li>
                    <li>
                        <a href="#">Deposits</a>
                    </li>
                    <li>
                        <a href="#">Products and Services</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#submenuPayroll" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-paypal" style="margin-right: 20px"></i>Payroll</a>
                <ul class="collapse list-unstyled" id="submenuPayroll">
                    <li>
                        <a href="#">Overview</a>
                    </li>
                    <li>
                        <a href="#">Employees</a>
                    </li>
                    <li>
                        <a href="#">Contractors</a>
                    </li>
                    <li>
                        <a href="#">Workers' Comp</a>
                    </li>
                    <li>
                        <a href="#">Benifits</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-save" style="margin-right: 20px"></i>Reports</a>
            </li>
            <li>
                <a href="#submenuTaxes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-credit-card" style="margin-right: 20px"></i>Taxes</a>
                <ul class="collapse list-unstyled" id="submenuTaxes">
                    <li>
                        <a href="#">Sales Tax</a>
                    </li>
                    <li>
                        <a href="#">Payroll Tax</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-file" style="margin-right: 20px"></i>Mileage</a>
            </li>
            <li>
                <a href="#submenuAccounting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-calculator" style="margin-right: 20px"></i>Accounting</a>
                <ul class="collapse list-unstyled" id="submenuAccounting">
                    <li>
                        <a href="#">Chart of Accounts</a>
                    </li>
                    <li>
                        <a href="#">Reconcile</a>
                    </li>
                </ul>
            </li>
        </ul>
</nav>

<!-- Modal For add button-->
<div id="addBtnModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
        </div>
    </div>
</div>

