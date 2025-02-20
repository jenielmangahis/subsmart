<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
    <!-- page wrapper start -->
     
	 
	<div role="wrapper">

        <?php include viewPath('includes/sidebars/business'); ?>
		<div wrapper__section>
			<div class="row">
				<div class="col-md-8">
					<div role="white__holder">
						<div role="white__holder_section_holder">
							<div class="profile-headline">
								<a class="a-alert a-edit" href="<?php echo url('users/businessdetail') ?>"><span class="fa fa-edit"></span> edit</a> <img class="profile-avatar" src="<?php //echo (companyProfileImage($profiledata->id)) ? companyProfileImage($profiledata->id) : $url->assets ?>">
								<div class="profile-cnt">
									<div class="profile-cnt-h">
										<h1><?php //echo $profiledata->b_name ?></h1>
									</div>
									<div class="profile-address"><?php //echo $profiledata->city ?>, <?php //echo $profiledata->state ?></div>
								</div>
							</div>
							<div class="profile-about mt-4">
							<?php //echo $profiledata->business_desc; ?></div>
						</div>
						<div role="white__holder_section_holder">
							<div class="profile-service">
								<div class="profile-service-category">
									<a class="a-alert a-edit" href="pro/business/services"><span class="fa fa-edit"></span> edit</a>
									<div class="margin-bottom-sec">
										<div class="profile-service-title">Residential Services Offered</div>
										<span class="profile-service-category-item"><img class="profile-service-icon" width="36" src="https://www.markate.com/assets/images/icons/camera_check.png"> <span class="profile-service-item"><?php //echo $profiledata->service_loc ?></span></span>
									</div>
								</div>
							</div>
						</div>
						<div role="white__holder_section_holder">
							<div class="profile-content-section" id="profile-nav-credentials">
							<h3 class="profile-subtitle">Business Credentials <a class="a-alert a-edit" href="pro/business/credentials"><span class="fa fa-edit"></span> edit</a></h3>
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
							<a class="a-ter" target="_blank" href="<?php echo url('users/businessprofile'); ?>"><span class="fa fa-external-link"></span> &nbsp; View Public Profile</a>
						</div>
						<hr>
						<div class="margin-bottom-ter" style="position: relative;">
							<a class="a-alert a-edit" href="<?php echo url('users/businessdetail') ?>"><span class="fa fa-edit"></span> edit</a>
							<div class="margin-bottom-sec">
								<span class="side-title">Business Phone</span><br>
								<?php //echo $profiledata->b_phone ?>
							</div>
							<div class="phone-emergency">
								<span class="side-title">24/7 Emergency</span><br>
								<?php //echo $profiledata->phone_emergency ?>
							</div>
						</div>
						<div class="margin-bottom-ter">
							<div class="margin-bottom-sec">
								<span class="side-title">Contact Name</span><br>
								<?php 
                               /*$id = $profiledata->user_id;
                               $query = $this->db->query("Select name from users where id = $id");
                               $query11 = $query->row();*/                             
                            ?>
                            <?php //echo ucfirst($query11->name);?>
							</div>
							<span class="side-title"><?php //echo $profiledata->b_name; ?></span><br>
							<?php //echo $profiledata->address ?>, <br>
							<?php //echo $profiledata->city ?>,  <?php //echo $profiledata->state ?> <?php //echo $profiledata->zip ?>, <br>
							United States<br>
							<div class="side-title margin-top-sec">Website</div>
							<a class="a-default" href="<?php echo ($profiledata) ? $profiledata->website : ''; ?>" target="_blank"><?php //echo $profiledata->website ?></a><br>
						</div>
						<div class="margin-bottom">
							<div class="side-title">Quick Facts</div>
							<ul class="side-facts">
								<li>Business since <?php //echo $profiledata->year_est ?></li>
								<li><?php //echo $profiledata->employee_count ?> employees</li>
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
	 

 
<div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
  <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">history</span>
          <span class="mdc-bottom-navigation__list-item__text">Recents</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">favorite</span>
          <span class="mdc-bottom-navigation__list-item__text">Favorites</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
            </svg>
          </span>
          <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
        </span>
      </nav>
    </div> 
</div>
<?php include viewPath('includes/footer'); ?>
  