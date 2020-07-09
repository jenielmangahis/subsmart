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
    border: solid 2px #adff2f;
	color:#adff2f;
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
			<button class="btn btn-tranparent acct-btn-add mx-auto" type="button" onclick="showAddBtnModal()"><i class="fa fa-plus" style="margin-right: 20px;"></i>New</button>
		</li>

		<?php  for($x=0;$x<count($menu_name);$x++){ ?>
				<?php  if(count($menu_name[$x][1]) > 0){ ?>
					<li class="submenus dropright">
						<a href="#menu<?php echo $x; ?>" onclick="dropdownAccounting(this)" class="dropdown-toggle"><i class="fa <?php echo $menu_icon[$x]; ?> pr-3"></i><?php echo $menu_name[$x][0]; ?></a>
						<ul class="collapse list-unstyled" id="menu<?php echo $x; ?>">
							<?php  for($y=0;$y<count($menu_name[$x][1]);$y++){ ?>
								<li>
									<a href="<?php echo url($menu_link[$x][1][$y]); ?>"><?php echo $menu_name[$x][1][$y]; ?></a>
								</li>
							<?php  } ?>
						</ul>
					</li>
				<?php  }else{ ?>
					<li class="submenus">
						<a href="<?php echo url($menu_link[$x][0]); ?>"><i class="fa <?php echo $menu_icon[$x]; ?> pr-3"></i><?php echo $menu_name[$x][0]; ?></a>
					</li>
				<?php  } ?>
		<?php  } ?>
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
      </div>
      <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
