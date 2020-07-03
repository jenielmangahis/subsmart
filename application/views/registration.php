<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<section page="register" message="" class="ng-isolate-scope">
	<div class="f-height">
		<div class="row">
			<div class="col-md-5 col-sm-5 float-left pl-0 desktop-only">
				<div id="side-image" class="side-image--regular image-fader left"></div>
			</div>
			<div class="col-sm-7 col-md-7 float-left pr-0 container-signup pt-5">
				<form action="#" method="post">
					<h2 class="m-b-2 ng-scope text-center reg-header">Welcome to a new way to take control of your business.</h2>
					<span class="text-center block mt-3">Already signed up? <a href="#" class="reg-color">Log in</a></span>
										<span class="text-reg-subtle">Studies show CRM Systems will increase your customer relationship by 74% and improves your sales by 87%</span>
					<div class="form-container-reg">

						<!-- <div class="col-md-6 float-left z-100">
							<div class="radio m-b-0">
								<label class="reg-def">
									<input type="radio" class="tw-radio-button checked" id="businessType1" name="businessType" value="personal" />
									<span translate="authentication.modal.profiletype.private.desktop">Personal</span> <span class="visible-xs ng-scope" translate="authentication.modal.profiletype.private.mobile">Personal</span>
								</label>
							</div>
						</div>

						<div class="col-md-6 float-left z-100">
							<div class="radio m-b-0">
								<label class="reg-def">
									<input type="radio" class="tw-radio-button" id="businessType2" name="businessType" value="business"/>
									<span translate="authentication.modal.profiletype.private.desktop">Business</span> <span class="visible-xs ng-scope" translate="authentication.modal.profiletype.private.mobile">Personal</span>
								</label>
							</div>
						</div> -->

						<div class="col-md-6 float-left z-100">
							<div class="input-group z-100">
								<input autocomplete="off" type="text" name="firstname" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="First Name" required="">
							</div>
						</div>


						<div class="col-md-6 float-left z-100">
							<div class="input-group z-100">
								<input autocomplete="off" type="text" name="lastname" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Last Name">
							</div>
						</div>

						<div class="col-md-6 float-left">
							<div class="input-group z-100">
								<input autocomplete="off" type="email" name="email" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your email address" placeholder="Email address" required="">
							</div>
						</div>

						<div class="col-md-6 float-left">
							<div class="input-group z-100">
								<input autocomplete="off" type="number" name="phone" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Phone number">
							</div>
						</div>

						<div class="col-md-6 float-left">
							<div class="input-group z-100">
								<input id="google_search_place" type="text" name="business_name" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your Business Name" placeholder="Business Name" autocomplete="on" runat="server" required="" />
							</div>
						</div>

						<div class="col-md-6 float-left">
							<div class="input-group">
								<select class="reg-select z-100" id="sel1">
										<option value="0">Number of Employees</option>
										<option value="1 (Just Me)">1 (Just Me)</option>
										<option value="2-3">2-3</option>
										<option value="4-10">4-10</option>
										<option value="11-15">11-15</option>
										<option value="16-20">16-20</option>
										<option value="20+">20+</option>
								</select>
							</div>
						</div>

						<div class="col-md-12 float-left">
							<div class="input-group z-100">
								<input id="business_address" type="text" name="business_address" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your Business Address" placeholder="Business Address" required="" />
							</div>
						</div>

						<div class="col-md-6 float-left">
							<div class="input-group">
								<select class="reg-select z-100 cmb-industry" id="sel2">
									<option>--Select your Industry--</option>
	                                <?php foreach( $business as $key => $values ){ ?>
	                                    <optgroup label="<?php echo $key; ?>">
	                                    <?php foreach( $values as $value ){ ?>
	                                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
	                                    <?php } ?>
	                                <?php } ?>
								</select>
							</div>
						</div>

						<div class="col-md-6 float-left z-100">
							<div class="input-group z-100">
								<input autocomplete="off" type="password" name="password" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Create your password" required="">
							</div>
						</div>

						<div class="col-md-12">
							&nbsp;
							<!-- <div class="input-group">
								<input autocomplete="off" type="password" name="email" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Create your password" placeholder="Create your password">
							</div> -->
						</div>

						<div class="col-sm-12" style="text-align: center !important;">
							<!-- <a href="<?php //echo url('/home/signup') ?>" class="btn btn-green-2">
								 Sign up
							</a> -->
							<input style="margin:auto; width: 500px;" type="submit" class="btn btn-green-2" name="signup" value="Sign Up">
						</div>

					</div>
				</form>
			</div>


		</div>
	</div>
</div>
</section>
<?php include viewPath('frontcommon/footer'); ?>
