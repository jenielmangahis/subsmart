<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>

<!-- Hero section  -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hero-item set-bg" data-setbg="<?php echo $url->assets ?>frontend/images/banner.png">
				<div class="container">
					<div class="row">
						<div class="col-xl-5 text-center">
							<h2>THE COMPLETE<br />
							Field Service Management</h2>
							<p style="display:block !important;">Sales & Marketing Automation, It’s All Right Here!</p>
							<a href="<?php echo url('/home/signup') ?>" class="site-btn sb-white mr-4 mb-3">START YOUR FREE TRIAL</a>
						</div>
					</div>
				</div>
			</div>

			<div class="hero-item set-bg" data-setbg="<?php echo $url->assets ?>frontend/images/banner-registration.jpg">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-4 col-xl-6 text-center">
						</div>
						<div class="col-md-12 col-lg-6 col-xl-6 text-center">
							<h2 class="reg-banner-title">Signup Today for a <br/> Free 30-Day Trial</h2>
							<form class="mt-4">
								<div class="reg-block">
									<div class="col-xl-6 float-left">
										<input type="name" name="name" required class="form-control" id="inputName" value="" placeholder="First Name">
									</div>
									<div class="col-xl-6 float-left">
										<input type="name" name="name" required class="form-control" id="inputName" value="" placeholder="Last Name">
									</div>
								</div>
								<div class="reg-block">
									<div class="col-xl-6 float-left">
										<input type="name" name="name" required class="form-control" id="inputName" value="" placeholder="Email Address">
									</div>
									<div class="col-xl-6 float-left">
										<input type="name" name="name" required class="form-control" id="inputName" value="" placeholder="Phone Number">
									</div>
								</div>
								<div class="reg-block">
									<div class="col-xl-6 float-left">
										<input type="name" name="name" required class="form-control" id="inputName" value="" placeholder="Business Name">
									</div>
									<div class="col-xl-6 float-left">
										<input type="number" name="name" required class="form-control" id="inputName" value="" placeholder="Number of Employees">
									</div>
								</div>
								<div class="reg-block">
									<div class="col-xl-6 float-left">
										<select type="name" name="name" required class="form-control" id="inputName" value="">
											<option value="" disabled="true" selected>Select your Industry</option>
											<option value="agriculture">Agriculture</option>
											<option value="aerospace">Aerospace</option>
											<option value="computer">Computer</option>
											<option value="telecommunication">Telecommunication</option>
											<option value="construction">Construction</option>
											<option value="transport">Transport</option>
											<option value="education">Education</option>
											<option value="pharmaceutical">Pharmaceutical</option>
										</select>
									</div>
									<div class="col-xl-6 float-left">
										<select type="name" name="name" required class="form-control" id="inputName" value="">
											<option value="" disabled="true" selected>Select your Role</option>
											<option value="transporter">Transporter</option>
											<option value="Surgeon">Surgeon</option>
											<option value="broker">Broker</option>
											<option value="system_analyst">System Analyst</option>
											<option value="scientist">Scientist</option>
										</select>
									</div>
								</div>
							</form>
							<br class="clear" />
							<a href="<?php echo url('/home/signup') ?>" class="site-btn sb-white mr-4 mb-3">START YOUR FREE TRIAL</a>
						</div>
					</div>
				</div>
			</div>



		</div>
	</section>
	<!-- Hero section end  -->

	<section class="manageBusiness">
        <div class="customContainer">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sectionHolder">
                        <div class="sectionHeader pb-5 border-bottom">
                            <h2>Manage YOUR BUSINES <span>more efficiently</span></h2>
                            <p>nSmarTrac allows you to efficiently manage your business' schedule from any device. Effortlessly keep your operation running and send employees reminders straight to their phone. Goodbye planners and missed appointments, hello
                                simplicity.
                            </p>
                        </div>
                        <div class="cardHolder py-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <img src="<?php echo $url->assets ?>frontend/images/card-1.jpg" class="card-img" alt="card 1">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">ONLINE PAYMENTS AND TRACKING</a></h5>
                                                    <p class="card-text">Effortlessly track expenses, store receipts and record mileage in one easy-to-use dashboard. You can also accept credit cards with our innovative scanner.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-2.jpg" class="card-img" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">ADVANCED SCHEDULING</a></h5>
                                                    <p class="card-text">Keeping appointments organized is easier than ever with our intuitive calendar that seamlessly sends notification and reminders straight to your phone.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-3.jpg" class="card-img" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">SIMPLE BOOKING</a></h5>
                                                    <p class="card-text">Give your customers extra convenience by letting them book online through our customizable form. It’s a win-win.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-4.jpg" class="card-img" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">ESTIMATES & INVOICES</a></h5>
                                                    <p class="card-text">Sending invoices should be a piece of cake. Create, edit and deliver customized invoice on any device, at any time.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-5.jpg" class="card-img" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">KEY INSIGHTS</a></h5>
                                                    <p class="card-text">Gain access to valuable reports that give you unique insights into your businesses and its future performance.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-6.jpg" class="card-img" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
													<h5 class="card-title"><a href="#">ORDER MANAGEMENT</a></h5>
                                                    <p class="card-text">You need a software that works as hard as you do. Now you can create work orders with ease and effortlessly send them to your employees.</p>
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
    <section class="discoverUs mt-8">
        <div class="customContainer">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sectionHeader pb-5 w-75 m-auto">
                        <h2>Discover Why nSmarTrac is <span class="d-md-block">So IMPORTANT for Your Business</span></h2>
                    </div>
                    <div class="videoHolder">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/videoIcon.png" alt="img icon"></a>
                        <div class="videoImage"><img src="<?php echo $url->assets ?>frontend/images/video.jpg" alt="video"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="timeTracking mt-8">
        <div class="customContainer">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sectionHeader pb-5 w-75 m-auto">
                        <h2>Time Tracking App Integration</h2>
                        <h4 class="weight-600 subtle-fade">The simplest timesheet app for small businesses</h4>
                        <p>Tap a button to clock in and start tracking your time. Your work hours turn into simple, accurate timesheet reports automatically.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-md-5">
                            <div class="imgHolder">
                                <img src="<?php echo $url->assets ?>frontend/images/time-tracking.jpg" class="img-fluid" alt="time tracking">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7 align-self-center">
                            <div class="timeTrackingList">
                                <ul>
                                    <li>
                                        <h4>Increase Accountability</h4>
                                        <p>Build trust through complete transparency. Know exactly who’s on the clock and where they are.</p>
                                    </li>
                                    <li>
                                        <h4>Save Time & Money</h4>
                                        <p>Spend less time tracking hours. Automate timesheets and focus on growing your business.</p>
                                    </li>
                                    <li>
                                        <h4>Eliminate Mistakes</h4>
                                        <p>No more second-guessing. Forget paper timesheets and get accurate reports, every time.</p>
                                    </li>
                                </ul>
                                <div class="actionBtn">
                                    <p>Dive deeper into the product and see what Atto can do for you and your team.</p>
                                    <button class="btn btn-red btn-block">Take a Product Tour</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gpsLocation mt-8">
        <div class="customContainer">
            <div class="row">
                <div class="col-lg-4">
                    <div class="gpsbox">
                        <div class="gpstxt px-3">
                            <h4>Simple Time Tracking</h4>
                            <p>Just tap a button to clock in and start tracking your time. While on the clock, you can track time towards a job, add notes or take a break.</p>
                        </div>
                        <div class="gpsImg">
                            <img src="<?php echo $url->assets ?>frontend/images/gpsimg1.png" alt="gps img">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="gpsbox">
                        <div class="gpstxt px-3">
                            <h4>GPS Location Tracking</h4>
                            <p>Get real-time updates on your team’s location. Ensure everyone is safe, productive and in the right place at the right time.</p>
                        </div>
                        <div class="gpsImg">
                            <img src="<?php echo $url->assets ?>frontend/images/gpsimg2.png" alt="gps img">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="gpsbox">
                        <div class="gpstxt px-3">
                            <h4>Team Activity Insights</h4>
                            <p>Get detailed insights into your team's daily activity. Find out instantly who's on the clock, on break, or enjoying some time off.</p>
                        </div>
                        <div class="gpsImg">
                            <img src="<?php echo $url->assets ?>frontend/images/gpsimg3.png" alt="gps img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="startTrial mt-8">
        <div class="customContainer">
            <div class="row">
                <div class="col-sm-12">
                    <div class="startTrialBtn mb-5 text-center">
                        <a href="<?php echo url('/home/signup') ?>" class="btn btn-green">
                            START YOUR <span class="yColor">FREE TRIAL</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-7 text-right">
                    <div class="systemInfo ml-neg5">
                        <h3>Manage contacts, send notifications</h3>
                        <h4 class="weight-600 subtle-fade">Clients & Prospects Control</h4>
                        <p>he address of your customers can be seamlessly integrated into nSmartrac. </p>
                        <p>This means you receive clear directions and maps for simple navigations. </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="systemImg">
                        <img src="<?php echo $url->assets ?>frontend/images/trialimg1.png" class="img-fluid" alt="trial image">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 col-md-5">
                    <div class="systemImg">
                        <img src="<?php echo $url->assets ?>frontend/images/trialimg2.png" class="img-fluid" alt="trial image">
                    </div>
                </div>
                <div class="col-lg-6 col-md-7 text-left align-self-center">
                    <div class="systemInfo">
                        <h3>Create and assign work orders</h3>
                        <h4 class="weight-600 subtle-fade">Order Processing & Tracking from Anywhere</h4>
                        <ul>
                            <li>nSmartrac allows you to track and update a time log, where you can add before and after pictures.</li>
                            <li>Your customers can then sign off on the job once it's completed. It doesn't get any easier than that.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 col-md-7 text-right">
                    <div class="systemInfo">
                        <h3 class="mt-5">Receive payments online</h3>
                        <h4 class="weight-600 subtle-fade">Payment Colection Made Easy</h4>
                        <p>nSmartrac is integrated with apps like Square, Paypal and Wepay. This means any payments can be automatically deposited to the destination of your choice.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="systemImg">
                        <img src="<?php echo $url->assets ?>frontend/images/trialimg3.png" class="img-fluid" alt="trial image">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="startTrialBtn my-5 text-center"> <button class="btn btn-green yColor"> See MORE FEATURES </button> </div>
                </div>
            </div>
        </div>
    </section>
    <section class="customBuz bg_purple mt-8">
        <div class="customContainer">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sectionHeader pb-5">
                        <h2>Customizable System <span class="yColor">for Any Service Business</span></h2>
                        <h3>nSmarTrac platform is ideal for every service businesses that look for affordable, mobile-ready, easy-to-use, end-to-end management solution.</h3>
                    </div>
                </div>
            </div>
        </div>
       <!--  <div class="imgHolderList">
            <div class="container-fluid p-0">
                <div class="d-flex flex-row flex-wrap justify-content-start">
                    <div class="d-flex flex-column flex-col4 mr-3">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/listimg1.png" class="img-fluid"></a>
                    </div>
                    <div class="d-flex flex-column flex-col2 mr-3">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/listimg2.png" class="img-fluid scale"></a>
                    </div>
                    <div class="d-flex flex-column flex-col2 mr-3">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/listimg2.png" class="img-fluid scale"></a>
                    </div>
                    <div class="d-flex flex-column flex-col3">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/listimg3.png" class="img-fluid"></a>
                    </div>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-start mt-3">
                    <div class="d-flex flex-column-x mr-3">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/listimg2.png" class="img-fluid"></a>
                    </div>
                    <div class="d-flex flex-column-x mr-3">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/listimg2.png" class="img-fluid"></a>
                    </div>
                    <div class="d-flex flex-column-x mr-3">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/listimg2.png" class="img-fluid"></a>
                    </div>
                    <div class="d-flex flex-column-x">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/listimg2.png" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div> -->
		 <div class="imgHolderList">
            <div class="container-fluid p-0">
                 <img src="<?php echo $url->assets ?>frontend/images/fullImg.jpg" style="width:100%;" />
            </div>
        </div>
    </section>
    <section class="pricingTable mt-8 mb-5">
        <div class="customContainer">
            <div class="row m-auto text-center">
                <div class="col-lg-4">
                    <div class="princing-item starter h-100">


                    <div class="pricing-divider ">
                        <h3 class="text-light">Starter</h3>



                    </div>
                    <div class="card-body mt-0 shadow h-100">
                        <div class="cardText">
                        <h4 class="my-0 display-2 text-light font-weight-normal mb-3"><span class="h3">$</span> <span class="price"> 29</span> <span
                            class="h5"><span class="pricehalf">99</span><span class="pricetxt">per month</span></span></h4>

                        <ul class="list-unstyled mb-5 position-relative">
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>
                             <li>Lorem ipsum dolor sit amet, consectetuer </li>
                              <li>Lorem ipsum dolor sit amet, consectetuer </li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block  btn-custom ">Sign up for free</button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="princing-item team h-100">
                    <div class="pricing-divider ">
                        <h3 class="text-light">Team</h3>


                    </div>
                    <div class="card-body mt-0 shadow h-100">
                        <div class="cardText">
                        <h4 class="my-0 display-2 text-light font-weight-normal mb-3"><span class="h3">$</span> <span
                                class="price"> 49</span> <span class="h5"><span class="pricehalf">99</span><span
                                    class="pricetxt">per month</span></span></h4>
                        <ul class="list-unstyled mb-5 position-relative">
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>



                        </ul>
                        <button type="button" class="btn btn-lg btn-block  btn-custom ">Sign up for free</button>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="princing-item enterprise h-100">
                    <div class="pricing-divider ">
                        <h3 class="text-light">Enterprise</h3>


                    </div>
                    <div class="card-body mt-0 shadow h-100">
                        <div class="cardText">
                        <h4 class="my-0 display-2 text-light font-weight-normal mb-3"><span class="h3">$</span> <span
                                class="price"> 59</span> <span class="h5"><span class="pricehalf">99</span><span
                                    class="pricetxt">per month</span></span></h4>
                        <ul class="list-unstyled mb-5 position-relative">
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>
                            <li>Lorem ipsum dolor sit amet, consectetuer </li>

                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-custom ">Sign up for free</button>
                    </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pricingTable mt-8 mb-5">
        <div class="customContainer">
            <div class="sectionHeader pb-2">
                <h2>Client Testimonials</h2>
            </div>
            <div class="testimonialHolder">
            <div class="row m-auto text-left w-80">
                <div class="col-lg-3 col-md-6">
                    <div class="testimonial1">
                        <p><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"></p>
                        <p>Lorem ipsum dolor sit amet, consectetuer Lorem ipsum dolor sit amet, consectetuer Lorem ipsum dolor sit amet, consectetuerLorem ipsum dolor sit amet, consectetuer</p>
                        <p class="text-right">Jon Doe</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="testimonial1">
                        <p><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"></p>
                        <p>Lorem ipsum dolor sit amet, consectetuer Lorem ipsum dolor sit amet, consectetuer Lorem ipsum dolor sit amet, consectetuerLorem ipsum dolor sit amet, consectetuer</p>
                        <p class="text-right">Jon Doe</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="testimonial1">
                        <p><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"></p>
                        <p>Lorem ipsum dolor sit amet, consectetuer Lorem ipsum dolor sit amet, consectetuer Lorem ipsum dolor sit amet, consectetuerLorem ipsum dolor sit amet, consectetuer</p>
                        <p class="text-right">Jon Doe</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="testimonial1">
                        <p><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"><img src="<?php echo $url->assets ?>frontend/images/star.png" alt="star"></p>
                        <p>Lorem ipsum dolor sit amet, consectetuer Lorem ipsum dolor sit amet, consectetuer Lorem ipsum dolor sit amet, consectetuerLorem ipsum dolor sit amet, consectetuer</p>
                        <p class="text-right">Jon Doe</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

<?php include viewPath('frontcommon/footer'); ?>
