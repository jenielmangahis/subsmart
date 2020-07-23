<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_wizard'); ?>

	<!-- Wizard -->
	<section class="wizard-wrp">
		<div class="container">
			<div class="build-wizard-wrp">
				<div class="build-head">
					<h1><i><img src="<?php echo $url->assets ?>wizard/img/mailchi.png"></i> <strong><span>when this happens...</span> 1. Mailchimp</strong></h1>
				</div>

				<div class="app-listing-wrp">
					<h4>Choose App & Event</h4>

					<div class="form-group">
						<label>Choose App <span>(Required)</span></label>
						<div class="dropdown">
						  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Mailchimp
						  	<i class="fa fa-angle-down"></i></button>
						  	<ul class="dropdown-menu">
							    <li><a href="#"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Mailchimp</a></li>
							    <li><a href="#"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Mailchimp</a></li>
							    <li><a href="#"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Mailchimp</a></li>
						  	</ul>
						</div>
					</div>

					<div class="form-group">
						<label>Choose Trigger Event <span>(Required)</span></label>
						<div class="dropdown">
						  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown">Mailchimp
						  	<i class="fa fa-angle-down"></i></button>
						  	<ul class="dropdown-menu">
							    <li><a href="#">New Campaign <span>Triggers when a new Campaign is created or send.</span></a></li>
							    <li><a href="#">New Campaign <span>Triggers when a new Campaign is created or send.</span></a></li>
							    <li><a href="#">New Campaign <span>Triggers when a new Campaign is created or send.</span></a></li>
							    <li><a href="#">New Campaign <span>Triggers when a new Campaign is created or send.</span></a></li>
						  	</ul>
						</div>
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

<?php include viewPath('includes/footer_wizard'); ?>