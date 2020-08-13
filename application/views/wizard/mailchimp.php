<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_wizard'); ?>
<div class="row">
	<div class="col-md-2">
		<div class="wrapper" role="wrapper">
			<?php include viewPath('includes/sidebars/upgrades'); ?>
		</div>
	</div>
	<div class="col-md-10">
		<!-- Wizard -->
		<section class="wizard-wrp">
			<div class="container mt-5" >
				<div class="build-wizard-wrp">
					<div class="build-head">
						<h1><i><img src="<?php echo $url->assets ?>wizard/img/mailchi.png"></i> <strong><span>when this happens...</span> 1. Mailchimp</strong></h1>
					</div>

					<div>
					<div class="app-listing-wrp">
						<h4>Choose App & Event</h4>

						<div class="form-group">
							<label>Choose App <span>(Required)</span></label>
							<div class="dropdown">
							  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown">Schedule
							  	<i class="fa fa-angle-down"></i></button>
							  	<ul class="dropdown-menu">
								    <li onClick="setStatus(1)" ><a href="#"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Mailchimp</a></li>
								    <li onClick="setStatus(1)" ><a href="#"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Mailchimp</a></li>
								    <li onClick="setStatus(1)" ><a href="#"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Mailchimp</a></li>
							  	</ul>
							</div>
						</div>

						<div class="form-group">
							<label>Choose Trigger Event <span>(Required)</span></label>
							<div class="dropdown">
							  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown">Choose option
							  	<i class="fa fa-angle-down"></i></button>
							  	<ul class="dropdown-menu">
								    <li  onClick="setStatus(2)" ><a href="#">Assign New Lead  <span>Triggers when a new Campaign is created or send.</span></a></li>
								    <li  onClick="setStatus(2)" ><a href="#">Cancel Schedule <span>Triggers when a new Campaign is created or send.</span></a></li>
								    <li  onClick="setStatus(2)" ><a href="#">Reschedule <span>Triggers when a new Campaign is created or send.</span></a></li>
							  	</ul>
							</div>
						</div>
					</div>
					</div>
					<div>
					<div class="app-listing-wrp-2" style="display:none;">
						
						<button class="btn btn-primary w-100" >Continue</button>

					</div>
					</div>
				</div>

				<div class="build-wizard-wrp">
					<div class="build-head">
						<h1><i class="fa fa-bolt"></i> 2. Do this...</h1>
					</div>
				</div>
			</div>
		</section>
		<!-- End Wizard -->
	</div>
</div>

<script>
	window.selection_1 = 0;
	window.selection_2 = 0;
	
	function setStatus(id) {
		if(id == 1) window.selection_1 = 1;
		if(id == 2) window.selection_2 = 1;

		if(window.selection_1 == 1 && window.selection_2 == 1 ) {
			$('.app-listing-wrp').hide();
			$('.app-listing-wrp-2').show();
		} else {
			$('.app-listing-wrp').show();
			$('.app-listing-wrp-2').hide();
		}
	}
</script>


<?php include viewPath('includes/footer_wizard'); ?>