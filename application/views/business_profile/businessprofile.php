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
				</div>
				<div class="col-md-4">
				</div>
			</div>
		</div>
	</div>
<?php include viewPath('includes/footer'); ?>
  