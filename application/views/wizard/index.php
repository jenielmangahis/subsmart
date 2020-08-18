<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_wizard'); ?>

<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/upgrades'); ?>
   <div wrapper__section style="">
	<style>
		div[wrapper__section] {
    margin-left: 260px;
    padding: 0px;
}
	
	</style>
	<!-- Wizard -->
	<section class="wizard-wrp">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-md-3 col-sm-4 pl-0">
					<div class="wizard-leftbar ziper-sidebar">
						<div class="wizard-title creatwibx">
							<h2>Wizard</h2>
						</div>

						<div class="wizard-tabs">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tb10">Credit</a>
								</li>
								<?php foreach($wizards_workspace as $key => $value)  { ?>
									<li class="nav-item">
										<a class="nav-link " data-toggle="tab" href="#tb10"><?php echo $value->name ; ?></a>
									</li>
								<?php } ?>
					    		<!-- <li class="nav-item">
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
								</li> -->
							  	<li class="nav-item">
							    	<a class="nav-link" data-toggle="tab" href="#tb9">My Workspace</a>
							  	</li>
								<li class="nav-item">
									<a class="nav-link" data-toogle="tab" href="#tb10" data-toggle="modal" data-target="#add_wizard_template"> Add Template </a>
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


								  
<div class="modal fade" id="add_wizard_template" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Template</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        <label> Template Title : </label>
		<!-- <input class="form-control" name="template_title_name"> -->
		<input class="form-control" type="text" name="example" list="exampleList">
		<datalist id="exampleList">
			<option value="Credit Repair Industry Template">  
			<option value="Real Estate Industry Flow Templates">

			<option value="Construction Industry Flow Templates">
			<option value="Universal Flow Templates">
			<option value="Financial Industry Flow Templates">
			<option value="Security Alarm Industry Flow Templates">
			<option value="Residential Flow Templates">
			<option value="Commercial Flow Templates">
		</datalist>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<?php include viewPath('includes/footer_wizard'); ?>