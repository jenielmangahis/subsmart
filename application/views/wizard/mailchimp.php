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
		<!-- <section class="wizard-wrp">
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
							  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Schedule
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
							  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown">Choose option
							  	<i class="fa fa-angle-down"></i></button>
							  	<ul class="dropdown-menu">
								    <li><a href="#">Assign New Lead  <span>Triggers when a new Campaign is created or send.</span></a></li>
								    <li><a href="#">Cancel Schedule <span>Triggers when a new Campaign is created or send.</span></a></li>
								    <li><a href="#">Reschedule <span>Triggers when a new Campaign is created or send.</span></a></li>
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
		</section> -->

		<section class="wizard-wrp">
		<div class="container">
			<div class="build-wizard-wrp">
				<div class="build-head">
					<h1><i><img src="img/mailchi.png" alt=""></i> <strong><span>when this happens...</span> 1. Mailchimp</strong></h1>
				</div>

				<div class="app-listing-wrp">
					<h4>Choose App & Event</h4>

					<div class="form-group">
						<label>Choose App <span>(Required)</span></label>
						<div class="dropdown">
						  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown"><img src="img/mailchi.png" alt=""> Mailchimp
						  	<i class="fa fa-angle-down"></i></button>
						  	<ul class="dropdown-menu">
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
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

			<div class="sep-box">
				<a href="#"><i class="fa fa-long-arrow-down"></i></a>
			</div>

			<div class="build-wizard-wrp">
				<div class="app-search-bar">
					<div class="search-dt">
			    		<input type="text" name="" placeholder="Not seeing your app? Search here ..." class="form-control">
			    		<i class="fa fa-search"></i>
			    	</div>
				</div>

				<div class="list-app-serv">
					<h5>HELPERS</h5>

					<ul>
						<li class="disabled"><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
					</ul>
				</div>

				<div class="list-app-serv">
					<h5>ALL APPS</h5>

					<ul>
						<li class="disabled"><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
							<label>beta</label>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
						</a></li>
						<li><a href="#">
							<h1><i><img src="img/built-ic2.png" alt=""></i> <strong>Do this... <span>when this happens...</span></strong></h1>
							<label>beta</label>
						</a></li>
					</ul>
				</div>

				<div class="show-mr-app">
					<a href="#" class="show-btn">Show More</a>
				</div>
			</div>

			<div class="sep-box">
				<a href="#"><i class="fa fa-long-arrow-down"></i></a>
			</div>

			<div class="build-wizard-wrp">
				<div class="build-head">
					<h1><i><img src="img/built-ic2.png" alt=""></i> <strong><span>when this happens...</span>2. Do this...</strong></h1>
				</div>

				<div class="choose-app-drop">
					<div class="form-group">
						<div class="dropdown">
						  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-angle-down"></i> Choose App & Event <i class="fa fa-check-circle verify"></i>
						  	</button>
						  	<ul class="dropdown-menu">
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
						  	</ul>
						</div>
					</div>
				</div>

				<div class="filter-setup">
					<h4>Filter Setup & Testing</h4>

					<h5>Only continue if…</h5>

					<div class="filter-row">
						<div class="filter-feild">
							<div class="dropdown">
							  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown">Choose field... <i class="fa fa-sort"></i>
							  	</button>
							  	<ul class="dropdown-menu">
								    <div class="iner-dt">
								    	<h6>Insert Data....</h6>
								    	<div class="searchbx-fi">
									    	<div class="search-dt">
									    		<input type="text" name="" placeholder="Search..." class="form-control">
									    		<i class="fa fa-search"></i>
									    	</div>
									    </div>
								    </div>
							  	</ul>
							</div>
						</div>

						<div class="filter-feild">
							<div class="dropdown">
							  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown">Choose conditions... <i class="fa fa-sort"></i>
							  	</button>
							  	<ul class="dropdown-menu">
								    <li><a href="#">(Text) Contains</a></li>
								    <li><a href="#">(Text) Contains</a></li>
								    <li><a href="#">(Text) Contains</a></li>
								    <li><a href="#">(Text) Contains</a></li>
								    <li><a href="#">(Text) Contains</a></li>
							  	</ul>
							</div>
						</div>

						<div class="filter-feild">
							<input type="text" name="" placeholder="Enter Value..." class="form-control">
						</div>

						<div class="filter-feild">
							<a href="#" class="close-btn"><i class="fa fa-times"></i></a>
						</div>
					</div>

					<div class="filter-act">
						<a href="#" class="ftl-actbtn"><i class="fa fa-plus"></i> And</a>
						<a href="#" class="ftl-actbtn"><i class="fa fa-plus"></i> Or</a>
					</div>
				</div>
			</div>

			<div class="sep-box">
				<a href="#"><i class="fa fa-long-arrow-down"></i></a>
			</div>

			<div class="build-wizard-wrp">
				<div class="build-head">
					<h1><i><img src="img/built-ic2.png" alt=""></i> <strong><span>when this happens...</span>2. Do this...</strong></h1>
				</div>

				<div class="app-listing-wrp">
					<h4>Choose App & Event</h4>

					<div class="form-group">
						<label>Choose App <span>(Required)</span></label>
						<div class="dropdown">
						  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown"><img src="img/mailchi.png" alt=""> Mailchimp
						  	<i class="fa fa-angle-down"></i></button>
						  	<ul class="dropdown-menu">
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
							    <li><a href="#"><img src="img/mailchi.png" alt=""> Mailchimp</a></li>
						  	</ul>
						</div>
					</div>

					<button class="btn-continue">Continue</button>
				</div>
			</div>

			<div class="sep-box">
				<a href="#"><i class="fa fa-long-arrow-down"></i></a>
			</div>

			<div class="build-wizard-wrp disabled-bx">
				<div class="build-head">
					<h1><i class="fa fa-bolt"></i> 3. Do this...</h1>
					<a href="#" class="edit-btn">Edit</a>
				</div>
			</div>
		</div>
	</section>
		<!-- End Wizard -->
	</div>
</div>

<?php include viewPath('includes/footer_wizard'); ?>