<h3><?= $plugin->name; ?></h3>
<p><?= $plugin->description; ?></p>
<br /><hr />
<div style="text-align: center;font-size: 18px;" class="card-price bottom-txt">
	<?php  
	  if( $plugin->sms_fee > 0 ){
	    echo "$" . $plugin->sms_fee . "/SMS + $" . $plugin->service_fee . " service fee";
	  }else{
	    echo "$" . $plugin->service_fee . " service fee";
	  }
	?>
</div>