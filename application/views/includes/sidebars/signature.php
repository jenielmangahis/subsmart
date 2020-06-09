<nav class="navbar-side d-none d-md-block">
    <ul class="nav"><span class="nav-close">      	<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>        	</span>
        <li class="nav-header">Signature</li>
        <?php $uri = $_SERVER['REQUEST_URI']; //print_r($uri);?>
        <li class="<?php if( $uri == '/users' ){ echo 'active';}?>"><a href="#" title="Add New"><span
                        class="fa fa-user"></span>Add New</a></li>
        <li class="<?php if( $uri == '/users' ){ echo 'active';}?>">
        	<a href="#" title="Add New">
        		<span class="fa fa-user"></span>Add Document
        	</a>
        </li>
    </ul>
</nav>