<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
	<div role="wrapper">
		<div class="profile__top">
			<img src="https://www.markate.com/assets/images/app/public/pros/wallpaper/general_0.jpg" />
		</div>
		<div class="headline">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="profile-headline profile-headline1">
							<img class="profile-avatar" src="<?php echo (userProfile($profiledata->user_id)) ? userProfile($profiledata->user_id) : $url->assets ?>">
							<div class="profile-cnt">
								<div class="profile-cnt-h">
									<h1><?php echo $profiledata->b_name ?></h1>
									<span class="profile-cnt-status status-online"> <span class="status-bubble"></span>online now <a class="btn btn-primary btn-md margin-left-sec" data-chat-modal="open" href="#">Chat</a></span>
								</div>
								<div class="profile-address"><?php echo $profiledata->city ?>, <?php echo $profiledata->state ?></div>
							</div>
						</div>   
					</div>
					
					<div class="col-sm-7"></div>
				</div>
			</div>
		</div>
		<div class="profile-nav-section" data-profile-nav="nav">
			<div class="container">
				<ul class="profile-nav clearfix">
					<li><a class="a-default active" href="#profile-nav-overview">Overview</a></li>
					<li><a class="a-default" href="#profile-nav-credentials">Credentials</a></li>
					<li><a class="a-default" href="#profile-nav-deals">Deals</a></li>
					<li><a class="a-default" href="#profile-nav-portfolio">Portfolio</a></li>
					<li><a class="a-default" href="#profile-nav-reviews">Reviews</a></li>
				</ul>
			</div> 
		</div>
		<div wrapper__section class="busniness__Profile">
			<div class="row">
				<div class="col-md-8">
					<div role="white__holder">
						<div role="white__holder_section_holder">
							<div class="profile-headline">
								<a class="a-alert a-edit" href="<?php echo url('users/businessdetail') ?>"><span class="fa fa-edit"></span> edit</a> <img class="profile-avatar" src="<?php echo (companyProfileImage($profiledata->id)) ? companyProfileImage($profiledata->id) : $url->assets ?>">
								<div class="profile-cnt" style="margin-left: 10px;">
								<div class="profile-cnt-h" style="">
									<h1 style="margin: 0;font-size: 26px;"><?php echo $profiledata->b_name ?></h1>
									<span class="profile-cnt-status status-online"> <span class="status-bubble"></span>online now <a class="btn btn-primary btn-md margin-left-sec" data-chat-modal="open" href="#">Chat</a></span>
								</div>
								<div class="profile-address"><?php echo $profiledata->city ?>, <?php echo $profiledata->state ?></div>
							</div>
							</div>
							<div class="profile-about mt-4"><?php echo $profiledata->business_desc; ?></div>
						</div>
						<div role="white__holder_section_holder">
							<div class="profile-service">
								<div class="profile-service-category">
									<a class="a-alert a-edit" href="/pro/business/services"><span class="fa fa-edit"></span> edit</a>
									<div class="margin-bottom-sec">
										<div class="profile-service-title">Residential Services Offered</div>
										<span class="profile-service-category-item"><img class="profile-service-icon" width="36" src="https://www.markate.com/assets/images/icons/camera_check.png"> <span class="profile-service-item"><?php echo $profiledata->service_loc ?></span></span>
									</div>
								</div>
							</div>
						</div>
						<div role="white__holder_section_holder">
							<div class="profile-content-section" id="profile-nav-credentials">
							<h3 class="profile-subtitle">Business Credentials <a class="a-alert a-edit" href="/pro/business/credentials"><span class="fa fa-edit"></span> edit</a></h3>
								<div class="row mt-4">
									<div class="col-md-6">
										<div class="credential">
											<div class="credential-badge">
												<img src="https://www.markate.com/assets/images/app/public/pros/badge_1.png"> <span class="badge-label">License</span>
											</div>
											<div class="credential-cnt">Not Licensed 
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="credential">
											<div class="credential-badge">
												<img src="https://www.markate.com/assets/images/app/public/pros/badge_2.png"> <span class="badge-label">Bond</span>
											</div>
											<div class="credential-cnt">Not Bonded 
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="credential">
											<div class="credential-badge">
												<img src="https://www.markate.com/assets/images/app/public/pros/badge_3.png"> <span class="badge-label">Insurance</span>
											</div>
											<div class="credential-cnt">Not Insured 
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="credential">
											<div class="credential-badge">
												<img src="https://www.markate.com/assets/images/app/public/pros/badge_4.png"> <span class="badge-label">Accreditation</span>
											</div>
											<div class="credential-cnt">Not Accredited 
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="credential">
											<div class="credential-badge">
												<img src="https://www.markate.com/assets/images/app/public/pros/badge_5.png"> <span class="badge-label">Verifications</span>
											</div>
											<div class="credential-cnt">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="credential">
											<div class="credential-badge">
												<img src="https://www.markate.com/assets/images/app/public/pros/badge_6.png"> <span class="badge-label">Since</span>
											</div>
											<div class="credential-cnt"> Business since:
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div role="white__holder_section_holder" class="no_border">
							<div class="profile-content-section">
								<h3 class="profile-subtitle">Deals <a class="a-alert a-edit" href="#"><span class="fa fa-edit"></span> edit</a></h3>
								<p class="profile-content-margin">No deals at this moment.</p>
							</div>
						</div>
						<div role="white__holder_section_holder" class="no_border">
							<div class="profile-content-section">
								<h3 class="profile-subtitle">Portfolio <a class="a-alert a-edit" href="#"><span class="fa fa-edit"></span> edit</a></h3>
								<p class="profile-content-margin">No photos have been added yet.</p>
							</div>
						</div>
						<div role="white__holder_section_holder" class="no_border">
							<div class="profile-content-section">
								<h3 class="profile-subtitle">Reviews (0) <a class="a-alert a-edit" href="3"><span class="fa fa-edit"></span> edit</a></h3>
								<p class="profile-content-margin">There are currently no reviews at this time.</p>
							</div>
						</div>
						<div role="white__holder_section_holder" class="no_border">
							<div class="profile-content-section">
								<h3 class="profile-subtitle">Business Tags <a class="a-alert a-edit" href="3"><span class="fa fa-edit"></span> edit</a></h3>
								<p class="profile-content-margin"></p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="side-box">
						<div class="text-center">
							<a class="a-ter" href=""><span class="fa fa-external-link"></span> &nbsp; View Public Profile</a>
						</div>
						<hr>
						<div class="margin-bottom-ter" style="position: relative;">
							<a class="a-alert a-edit" href="<?php echo url('users/businessdetail') ?>"><span class="fa fa-edit"></span> edit</a>
							<div class="margin-bottom-sec">
								<span class="side-title">Business Phone</span><br>
								<?php echo $profiledata->b_phone ?>
							</div>
							<div class="phone-emergency">
								<span class="side-title">24/7 Emergency</span><br>
								<?php echo $profiledata->phone_emergency ?>
							</div>
						</div>
						<div class="margin-bottom-ter">
							<div class="margin-bottom-sec">
								<span class="side-title">Contact Name</span><br>
								<?php 
                               $id = $profiledata->user_id;
                               $query = $this->db->query("Select name from users where id = $id");
                               $query11 = $query->row();                             
                            ?>
                            <?php echo ucfirst($query11->name);?>
							</div>
							<span class="side-title"><?php echo $profiledata->b_name; ?></span><br>
							<?php echo $profiledata->address ?>, <br>
							<?php echo $profiledata->city ?>,  <?php echo $profiledata->state ?> <?php echo $profiledata->zip ?>, <br>
							United States<br>
							<div class="side-title margin-top-sec">Website</div>
							<a class="a-default" href="<?php echo $profiledata->website ?>" target="_blank"><?php echo $profiledata->website ?></a><br>
						</div>
						<div class="margin-bottom">
							<div class="side-title">Quick Facts</div>
							<ul class="side-facts">
								<li>Business since <?php echo $profiledata->year_est ?></li>
								<li><?php echo $profiledata->employee_count ?> employees</li>
								<li>Works with other businesses or sub-contractors</li>
							</ul>
						</div>
						<hr>
						<div class="margin-bottom" style="position: relative">
							<a class="a-alert a-edit" href="#"><span class="fa fa-edit"></span> edit</a>
							<div class="side-title">Availability</div>
							Working Days<br>
							<div class="margin-bottom-sec text-ter">Mon - Fri</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	 
     
<?php include viewPath('includes/footer'); ?>
  