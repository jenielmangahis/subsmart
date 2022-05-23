<div class="row">
  <div class="col-3">
    <p></p>
    <p class="text-center"><i class="fas fa-info-square fa-5x"></i></p>
  </div>

  <div class="col-9" style="text-align: left;">
  	<?php if ( !empty($gevent) ) { ?>
	    	<p><div class="text-ter text-sm">Details: </div><?= $gevent['title']; ?></p>
	<?php }else{ ?>
			<p>No Details Found</p>
	<?php } ?>
  </div>
</div>