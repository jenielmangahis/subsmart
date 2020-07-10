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
</style>
<nav id="sidebar" class="navbar-side">
    <ul class="nav sidebar-accounting">
        <span class="nav-close">
            <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%">
                <path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path>
            </svg>
        </span>
        <li class="nav-header">
			<a href="<?php echo url('/job/new_job')?>" class="btn btn-tranparent acct-btn-add text-center" style="border: 2px solid white;"><i class="fa fa-plus" style="margin-right: 20px;"></i> New</a>
        </li>
        <li class="submenus dropright">
            <a href="#submenuJob" onclick="dropdownAccounting(this)" class="dropdown-toggle"><i class="fa fa-briefcase" style="margin-right: 20px"></i>Job</a>
            <ul class="collapse list-unstyled" id="submenuJob">
				<li>
					<a href="<?php echo url('/job')?>">Job List</a>
                </li>
                <li>
                    <a href="<?php echo url('/job/new_job')?>">New Job</a>
                </li>
            </ul>
        </li>
        <li class="submenus dropright">
            <a href="#submenuForm" onclick="dropdownAccounting(this)" class="dropdown-toggle"><i class="fa fa-credit-card" style="margin-right: 20px"></i>Forms</a>
            <ul class="collapse list-unstyled" id="submenuForm">
				<li>
					<a href="<?php echo url('/estimate')?>">Estimate</a>
                </li>
                <li>
                     <a href="<?php echo url('/workorder')?>">Work Orders</a>
                </li>
                <li>
                     <a href="<?php echo url('/invoice')?>">Invoice</a>
                </li>
             </ul>
        </li>
        <li class="submenus dropright">
            <a href="#submenuSetting" onclick="dropdownAccounting(this)" class="dropdown-toggle"><i class="fa fa-wrench" style="margin-right: 20px"></i>Settings</a>
                <ul class="collapse list-unstyled" id="submenuSetting">
                    <li>
                        <a href="<?php echo base_url();?>job/job_type">Job Type</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>workorder/priority">Priority</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>workorder">Status</a>
                    </li>
                </ul>
        </li>
    </ul>
</nav>


<!-- Modal -->
<div class="modal fade" id="addBtnModal" tabindex="-1" role="dialog" aria-labelledby="addBtnModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
