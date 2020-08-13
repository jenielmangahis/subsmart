<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_wizard'); ?>

<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/upgrades'); ?>
   <div wrapper__section>

	<!-- Wizard -->
	<section class="wizard-wrp">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-md-3 col-sm-4">
					<div class="wizard-leftbar">
						<div class="wizard-title">
							<h2>Wizard</h2>
						</div>

						<div class="wizard-tabs">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tb10">Credit</a>
								</li>
					    		<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tb1">Credit Repair Industry Template</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tb2">Real Estate Industry Flow Templates</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tb3">Construction Industry Flow Templates</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tb4">Universal Flow Templates</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tb5">Financial Industry Flow Templates</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tb6">Security Alarm Industry Flow Templates</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tb7">Residential Flow Templates</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tb8">Commercial Flow Templates</a>
								</li>
							  	<li class="nav-item">
							    	<a class="nav-link" data-toggle="tab" href="#tb9">My Workspace</a>
							  	</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-10 col-md-9 col-sm-8">
					<div class="wizard-right">
						<h1><img src="<?php echo $url->assets ?>wizard/img/wizard-ic.png" alt=""> The Workspace List</h1>

						<div class="tab-content">
						  	<div class="tab-pane active" id="tb10">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="<?php echo base_url('/wizard/add_wizard') ?>"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>

						  			<div class="recently-open">
						  				<h4>Recent Open</h4>

						  				<div class="row">
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 4</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 1</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 2</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb1">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>

						  			<div class="recently-open">
						  				<h4>Recent Open</h4>

						  				<div class="row">
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 4</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 1</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 2</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb2">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>

						  			<div class="recently-open">
						  				<h4>Recent Open</h4>

						  				<div class="row">
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 4</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 1</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 2</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb3">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>

						  			<div class="recently-open">
						  				<h4>Recent Open</h4>

						  				<div class="row">
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 4</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 1</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 2</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb4">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>

						  			<div class="recently-open">
						  				<h4>Recent Open</h4>

						  				<div class="row">
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 4</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 1</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 2</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb5">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb6">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>

						  			<div class="recently-open">
						  				<h4>Recent Open</h4>

						  				<div class="row">
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 4</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 1</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 2</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb7">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>

						  			<div class="recently-open">
						  				<h4>Recent Open</h4>

						  				<div class="row">
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 4</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 1</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 2</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb8">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="tb9">
						  		<div class="wizard-add-listing">
						  			<div class="row">
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="add-wizard-bx">
						  						<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 1</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 2</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap5.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 3</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 4</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap8.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 5</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="col-lg-2 col-md-3 col-sm-4">
						  					<div class="temp-box">
						  						<img src="<?php echo $url->assets ?>wizard/img/shap10.png" alt="">
						  						<div class="temp-nm">
						  							<h3>Template 6</h3>
						  							<div class="action-btn dropdown">
													  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
													    	<i class="fa fa-ellipsis-h"></i>
													  	</button>
													  	<div class="dropdown-menu">
														    <a class="dropdown-item" href="#">Edit</a>
														    <a class="dropdown-item" href="#">Delete</a>
														    <a class="dropdown-item" href="#">View</a>
													  	</div>
													</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>

						  			<div class="recently-open">
						  				<h4>Recent Open</h4>

						  				<div class="row">
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap6.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 4</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap3.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 1</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  				<div class="col-lg-2 col-md-3 col-sm-4">
							  					<div class="temp-box">
							  						<img src="<?php echo $url->assets ?>wizard/img/shap4.png" alt="">
							  						<div class="temp-nm">
							  							<h3>Template 2</h3>
							  							<div class="action-btn dropdown">
														  	<button type="button" class="dropdown-toggle" data-toggle="dropdown">
														    	<i class="fa fa-ellipsis-h"></i>
														  	</button>
														  	<div class="dropdown-menu">
															    <a class="dropdown-item" href="#">Edit</a>
															    <a class="dropdown-item" href="#">Delete</a>
															    <a class="dropdown-item" href="#">View</a>
														  	</div>
														</div>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
						  			</div>
						  		</div>
						  	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Wizard -->
	</div>
						  		</div>
<?php include viewPath('includes/footer_wizard'); ?>