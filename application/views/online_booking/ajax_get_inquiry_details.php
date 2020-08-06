<h4>Contact Details</h4>
<table class="table">
    <tr>
    	<td>
    		<i class="fa fa-user"></i> Name : <?php echo $inquiry->name; ?>
    	</td>
    	<td>
    		<i class="fa fa-envelope"></i> Email : <?php echo $inquiry->email; ?>
    	</td>
	</tr>
    <tr>
    	<td>
    		<i class="fa fa-phone"></i> Phone : <?php echo $inquiry->phone; ?>
    	</td>
    	<td>
    		<i class="fa fa-map-marker"></i> Address : <?php echo $inquiry->address; ?>
    	</td>
    </tr>
    <?php 
    	$preferred_time_to_contact_value = "";
    	if($inquiry->preferred_time_to_contact == 0) {
    		$preferred_time_to_contact_value = "Any time";
    	}elseif($inquiry->preferred_time_to_contact == 1) {
    		$preferred_time_to_contact_value = "7am to 10am";
    	}elseif($inquiry->preferred_time_to_contact == 2) {
    		$preferred_time_to_contact_value = "10am to Noon";
    	}elseif($inquiry->preferred_time_to_contact == 3) {
    		$preferred_time_to_contact_value = "Noon to 4pm";
    	}elseif($inquiry->preferred_time_to_contact == 4) {
    		$preferred_time_to_contact_value = "4pm to 7pm";
    	}
    ?>
    <tr>
    	<td>
    		<i class="fa fa-calendar"></i> Preferred time to contact : <?php echo $preferred_time_to_contact_value; ?>
    	</td>
    	<td>
    		<i class="fa fa-info"></i> How did you hear from us : <?php echo $inquiry->how_did_you_hear_about_us; ?>
    	</td>
    </tr>  
    <tr>
    	<td colspan="2">
    		<i class="fa fa-list"></i> Message : <?php echo $inquiry->message; ?>
    	</td>
    </tr>
</table>
<h4>Booking Info</h4>
<table class="table">
	<?php 
		$status_value = "-";
		$custom_data  = "-";
		if($inquiry->status == 1) {
			$status_value = "New";
		}elseif($inquiry->status == 2) {
			$status_value = "Contacted";
		}elseif($inquiry->status == 3) {
			$status_value = "Follow Up";
		}elseif($inquiry->status == 4) {
			$status_value = "Assigned";
		}elseif($inquiry->status == 5) {
			$status_value = "Closed";
		}

		$custom_data = !empty($inquiry->form_data) ? unserialize($inquiry->form_data) : array();
	?>
    <tr>
    	<td><i class="fa fa-angle-double-right"></i> Status: <strong><?php echo $status_value; ?></strong></td> 
    </tr>
    <tr>
    	<td>
    		<i class="fa fa-angle-double-right"></i> Form Custom Fields:
    		<table class="table">
    		<?php foreach($custom_data as $cus_key => $cus) { ?>
    				<tr><td>&nbsp;</td><td>- <strong><?php echo $cus_key; ?></strong></td><td><?php echo $cus; ?></td></tr>
    		<?php } ?>
    		</table>
    	</td>
    </tr>
    <tr>
    	<td>
    		<i class="fa fa-angle-double-right"></i> Cart Items Details: 
    		<?php if($work_order_summary) { ?>
	    		<table class="table">
	    		<?php foreach($work_order_summary as $wos_key => $work_order_sum) { ?>
	    				<tr><td>&nbsp;</td><td>- <strong><?php echo $work_order_sum['service_name']; ?></strong></td><td><?php echo $work_order_sum['quantity_ordered']; ?> * $<?php echo number_format($work_order_sum['price'],2); ?>/<?php echo $work_order_sum['unit']; ?></td></tr>
	    				<tr><td>&nbsp;</td><td>&nbsp;</td><td><strong>Discount/Coupon: </strong> <?php echo $work_order_sum['coupon_name']; ?> </td></tr>
	    		<?php } ?>
	    		</table>
    		<?php } ?>

    	</td>
    </tr>
</table>