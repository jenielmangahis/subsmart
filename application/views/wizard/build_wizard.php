<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_wizard'); ?>
	<!-- Wizard -->
	<section class="wizard-wrp">
		<div class="container">
			<div class="build-wizard-wrp">
				<div class="build-head">
					<h1><i class="fa fa-bolt"></i> 1. When this happens...</h1>
				</div>

				<div class="app-listing-wrp">
					<div class="app-search-build">
						<h4>Choose App & Event</h4>

						<div class="form-group">
							<input type="text" name="" placeholder="Not seeing your app? Search here ...." class="form-control">
							<i class="fa fa-search"></i>
						</div>
					</div>

					<div class="app-listing-build">
						<h4>Your Apps</h4>

						<div class="row">
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/google-ic4.png" alt="">
									</div>
									<h4>Google Calender</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/google-ic3.png" alt="">
									</div>
									<h4>Google Contacts</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/google-ic1.png" alt="">
									</div>
									<h4>Google Docs</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/google-ic5.png" alt="">
									</div>
									<h4>Google Drive</h4>
								</div></a>
							</div>

							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/google-ic6.png" alt="">
									</div>
									<h4>Google Sheets</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
									</div>
									<h4>Gmail</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/google-ic7.png" alt="">
									</div>
									<h4>Google Slides</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/google-ic5.png" alt="">
									</div>
									<h4>Google Drive</h4>
								</div></a>
							</div>
						</div>
					</div>

					<div class="app-listing-build">
						<h4>Built-In Apps</h4>

						<div class="row">
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/built-ic1.png" alt="">
									</div>
									<h4>Code by Zapier</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/built-ic2.png" alt="">
									</div>
									<h4>Email Parser by Zapier</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/built-ic3.png" alt="">
									</div>
									<h4>IMAP by Zapier</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/built-ic4.png" alt="">
									</div>
									<h4>RSS by Zapier</h4>
								</div></a>
							</div>

							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/built-ic5.jpg" alt="">
									</div>
									<h4>Scheduke by Zapier</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/built-ic6.png" alt="">
									</div>
									<h4>Weather by Zapier</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/built-ic7.png" alt="">
									</div>
									<h4>Webhooks by Zapier</h4>
									<span>premiume</span>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/built-ic8.png" alt="">
									</div>
									<h4>Email by Zapier</h4>
								</div></a>
							</div>
						</div>

						<a href="#" class="show-btn">Show More</a>
					</div>

					<div class="app-listing-build">
						<h4>Popular Apps</h4>

						<div class="row">
							<div class="col-md-3 col-sm-3">
								<a href="mailchimp.html"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt="">
									</div>
									<h4>Mailchimp</h4>
								</div></a>
							</div>
							<div class="col-md-3 col-sm-3">
								<a href="#"><div class="app-box-choice">
									<div class="build-ap-ic">
										<img src="<?php echo $url->assets ?>wizard/img/ac.png" alt="">
									</div>
									<h4>Active Campaign</h4>
								</div></a>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Wizard -->

<?php include viewPath('includes/footer_wizard'); ?>