<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>

<!-- Hero section  -->
    <section class="hero-section">
        <div class="hero-slider home-slider owl-carousel">

            <div class="hero-item set-bg" data-setbg="<?php echo $url->assets ?>frontend/images/banner-1-try-app.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 text-center padding-mobile">
                            <h2 class="mobile-banner-header">Try our new App! <br/>
                            nSmartTrac now on Mobile</h2>
                            <br style="clear:both;"/>
                            <div class="col-download row-margin-top float-left">
                              <img src="<?php echo $url->assets ?>frontend/images/ios-download.png" class="card-img card-features img-download" alt="card 1">
                            </div>
                            <div class="col-download row-margin-top float-left">
                              <img src="<?php echo $url->assets ?>frontend/images/google-download.png" class="card-img card-features img-download">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-item set-bg" data-setbg="<?php echo $url->assets ?>frontend/images/banner.png">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 text-center">
                            <h2 class="no-uppercase mobile-banner-header">COMING SOON! <br />THE COMPLETE
                            Field Service Management System For Your Business Needs</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-item set-bg" data-setbg="<?php echo $url->assets ?>frontend/images/banner-registration.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-4 col-xl-5 mobile-quotes text-center">
                            <div class="hero-slider-signup owl-carousel">
                                <div class="hero-item" >
                                    <div class="testimonial-card">
                                        <img src="<?php echo $url->assets ?>frontend/images/profile-pic.jpeg" />
                                        <h3 class="testimonial-desc">I have used several business CRM, but this one product does everything from providing me a report card to my business and creating automated campaigns to grow my business.  I Love this product.</h3>
                                        <h3 class="testimonial-name">Tom Fico, Pensacola, Florida.</h3>
                                    </div>
                                </div>
                                <div class="hero-item" >
                                    <div class="testimonial-card">
                                        <img src="<?php echo $url->assets ?>frontend/images/profile-pic.jpeg" />
                                        <h3 class="testimonial-desc">This CRM help me grow my business and I can  provide customer with real time estimates and sign them up minutes afterward.  Customer for Life.</h3>
                                        <h3 class="testimonial-name">Josh Cook,  Biloxi, Mississippi.</h3>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-12 col-lg-7 col-xl-7 text-center pt-110">
                            <div class="row justify-content-center">
                                    <h2 class="font-weight-bold text-white f-28 mobile-only">Signup Today Free 30-Day Trial</h2>
                                    <h2 class="font-weight-bold text-white f-28 desktop-only">Signup Today for a Free 30-Day Trial</h2>
                            </div>
                            <div class="row row-margin-top">
                                <div class="col-md-12 col-lg-6 row-margin-top">
                                        <input type="text" class="form-control stop" id="inputFirstname" placeholder="First Name">
                                </div>
                                <div class="col-md-12 col-lg-6 row-margin-top">
                                        <input type="text" class="form-control stop" id="inputLastname" placeholder="Last Name">
                                </div>
                                <div class="col-md-12 col-lg-6 row-margin-top" >
                                        <input type="text" class="form-control stop" id="inputEmailAddress" placeholder="Email Address">
                                </div>
                                <div class="col-md-12 col-lg-6 row-margin-top">
                                        <input type="text" class="form-control stop" id="inputPhoneNumber" placeholder="Phone Number">
                                </div>
                                <div class="col-md-12 col-lg-6 row-margin-top">
                                        <input type="text" class="form-control stop" id="inputBusinessName" placeholder="Business Name">
                                </div>
                                <div class="col-md-12 col-lg-6 row-margin-top">
                                        <select class="form-control" id="sel1">
                                        <option value="0">Number of Employees</option>
                                                <option value="1 (Just Me)">1 (Just Me)</option>
                                                <option value="2-10">2-10</option>
                                                <option value="11-50">11-50</option>
                                                <option value="51-100">51-100</option>
                                                <option value="101-500">101-500</option>
                                                <option value="1000+<">1000+<</option>
                                        </select>
                                </div>
                                <div class="col-md-12 col-lg-6 row-margin-top">
                                    <select class="form-control" id="sel1">
                                        <option>--Select your Industry--</option>
                                        <?php foreach( $business as $key => $values ){ ?>
                                            <optgroup label="<?php echo $key; ?>">
                                            <?php foreach( $values as $value ){ ?>
                                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 col-lg-6 row-margin-top">
                                    <div class="input-group">
                                        <input autocomplete="off" type="password" name="email" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Create your password" placeholder="Create your password" style="padding:18px 15px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-margin-top">
                                <div class="col-md-12 col-lg-6 col-sm-12 mobile-only">
                                  <label class="text-white align-bottom"><input type="checkbox" value=""> I accept the User Agreement</label>
                                </div>
                                <div class="col-md-12 col-lg-6 col-sm-12">
                                        <button type="button" class="btn btn-success w-100 float-left font-weight-bold">Sign Up Now</button>
                                        <label class="font-weight-bold text-white">No credit card required</label>
                                </div>
                                <div class="col-md-12 col-lg-6 col-sm-12 desktop-only">
                                        <label class="text-white align-bottom"><input type="checkbox" value=""> I accept the User Agreement</label>
                                </div>
                            </div>
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
                            <h2>Manage YOUR BUSINESS <span>more efficiently</span></h2>
                            <p>nSmarTrac is a CRM built to meet the needs of your service business. With customizable solutions for just about any industry, we can provide just what your business needs to succeed.
                            </p>
                        </div>
                        <div class="cardHolder py-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <img src="<?php echo $url->assets ?>frontend/images/collect-and-track-payments-online.jpg" class="card-img card-features" alt="card 1">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Collect and Track Payments Online</a></h5>
                                                    <p class="card-text">Enjoy easy expense tracking, or payment collection with our mobile app, built with your field techs or sales people in mind. </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mobile-esc">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-2-v2.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Scheduling Magic</a></h5>
                                                    <p class="card-text">Assigning and managing appointments becomes easy with our appointment scheduling system that allows easy acceptance straight from the mobile app.  </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/booking-made-easy.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Booking Made Easy</a></h5>
                                                    <p class="card-text">Allow customers to make appointments easily through a customizable online application, or in person with the tech or sales person. </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-4.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">From Estimate to Invoice</a></h5>
                                                    <p class="card-text">Create and edit estimates or invoices on the spot again with our mobile app tailored to your business needs. Data is automatically transferred between each stage of the sales process.  </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/business-insight.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Business Insights</a></h5>
                                                    <p class="card-text">Track key business metrics to see how your business is performing with day to day operations.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-6-v2.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Task Management</a></h5>
                                                    <p class="card-text">Enjoy the ease of use of automation as estimates become work orders, and work orders become invoices, with little extra input.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/customizable-industry-templates.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Customizable Industry Templates</a></h5>
                                                    <p class="card-text">No matter what kind of industry, our fully customizable and optimized templates are designed to increase your work flow production.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/inventory-management-2.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Inventory Management</a></h5>
                                                    <p class="card-text">Offered through a cloud-based system, allowing the ease of small and midsize businesses to stramline and automate product workflow.  This application  is an all-in-one multi-functioning software platform that provides Inventory, on-the-go truck stock, warehouse management, and orders.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/card-1-v2.png" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Finance Management</a></h5>
                                                    <p class="card-text">Our Accounting System will help to streamline your operation from start to finish. This will help you never miss a payment again.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/file-vault.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">File Vault</a></h5>
                                                    <p class="card-text"> File Vault allows you to store your personal library and create multiple folders and locations.  With your personalize tags you can perform a quick search with in it.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/eSign.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">eSign</a></h5>
                                                    <p class="card-text"> Easily get all the signatures you need without ever leaving nSmarTrac. Legally Signatures Empower You to Sign Documents Online. Create an eSignature, Format Documents, Store Signed Documents. Start Signing Today. eSign From Any Device. Clean And Paperless.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="imgHolder"><img src="<?php echo $url->assets ?>frontend/images/time-and-gps-location.jpg" class="card-img card-features" alt="card 1"></div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="#">Time & GPS Location</a></h5>
                                                    <p class="card-text"> With our CRM you will know exactly who’s on the clock and where they are.   This will help you save time & make more money. Spend less time tracking hours. Automate timesheets and focus on growing your business.</p>
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
                    <div class="sectionHeader pb-5 w-75 m-auto sectionHeaderBlink">
                        <h2 style="color: #e05656;" class="hl-purple blink">Discover Why nSmarTrac is So IMPORTANT for Your Business</h2>
                    </div>
                    <!-- <div class="videoHolder">
                        <a href="#"><img src="<?php echo $url->assets ?>frontend/images/videoIcon.png" alt="img icon"></a>
                        <div class="videoImage"><img src="<?php echo $url->assets ?>frontend/images/video.jpg" alt="video"></div>
                    </div> -->
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
                        <h4>The simplest time sheet app for small businesses</h4>
                        <p>Tap a button to clock in and start tracking your time. Your work hours turn into simple, accurate time sheet reports automatically.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-md-5">
                            <div class="imgHolder">
                                <img src="<?php echo $url->assets ?>frontend/images/time-tracking-v2.jpg" class="img-fluid" alt="time tracking">
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
                                        <p>Spend less time tracking hours. Automate time sheets and focus on growing your business.</p>
                                    </li>
                                    <li>
                                        <h4>Eliminate Mistakes</h4>
                                        <p>No more second-guessing. Forget paper time sheets and get accurate reports, every time.</p>
                                    </li>
                                </ul>
                                <div class="actionBtn">
                                    <p>Dive deeper into the product and see what we can do for you and your team.</p>
                                    <!-- <button class="btn btn-red btn-block rounded-xl">Take a Product Tour</button> -->
                                    <a href="<?php echo url('demo') ?>" class="btn btn-red btn-block rounded-xl">
                                        Take a Product Tour
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="gpsLocation mt-8">
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
    </section> -->
    <section class="startTrial st-rl mt-8">
        <div class="customContainer">
            <div class="row">
                <div class="col-sm-12 b-43">
                    <div class="startTrialBtn mb-5 text-center">
                        <!-- <a href="<?php //echo url('/home/signup') ?>" class="btn btn-green rounded-xl">
                            START YOUR <span class="yColor">FREE TRIAL</span>
                        </a> -->
                        <a href="<?php echo url('registration') ?>" class="btn btn-green rounded-xl">
                            START YOUR <span class="yColor">FREE TRIAL</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-7 text-right">
                    <div class="systemInfo ml-neg5">
                        <h3>Contact Manager</h3>
                        <h4 class="weight-600 subtle-fade">Keep track of both current and prospective clients</h4>
                        <p>Easily send notifications to clients about appointments, or other reminders or find them with our GPS integration without having to manually input addresses </p>
                                          </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="systemImg">
                        <img src="<?php echo $url->assets ?>frontend/images/contact-manager.png" class="img-fluid" alt="trial image">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 col-md-5">
                    <div class="systemImg">
                        <img src="<?php echo $url->assets ?>frontend/images/invoice-home.png" class="img-fluid" alt="trial image">
                    </div>
                </div>
                <div class="col-lg-6 col-md-7 text-left align-self-center">
                    <div class="systemInfo bottom-60">
                        <h3>Easy Work Order Management</h3>
                        <h4 class="weight-600 subtle-fade">Manage your jobs from anywhere</h4>

                            <p>With our online app, nSmartrac allows you to manage your assignments from where ever you happen to be. No need to come in the office for additional paperwork. </p>


                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 col-md-7 text-right">
                    <div class="systemInfo bottom-sm-30">
                        <h3 class="mt-5">Receive payments online</h3>
                        <h4 class="weight-600 subtle-fade">Payment Collection Made Easy</h4>
                        <p>nSmartrac is integrated with apps like Square, PayPal and WePay. This means any payments can be automatically deposited to the destination of your choice.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="systemImg">
                        <img src="<?php echo $url->assets ?>frontend/images/work-management.png" class="img-fluid" alt="trial image">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="startTrialBtn my-5 text-center">
                        <!-- <button class="btn btn-green yColor rounded-xl"> See MORE FEATURES </button>  -->
                        <a class="btn btn-green yColor rounded-xl" href="<?php echo base_url('features') ?>"> See MORE FEATURES </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="customBuz bg_purple">
        <div class="customContainer">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sectionHeader pb-5">
                        <h2>Customizable System <span class="yColor">for Any Service Business</span></h2>
                        <h3>nSmarTrac platform is ideal for most any service businesses that look for affordable, mobile-ready, easy-to-use, end-to-end management solution.</h3>
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
    <!-- <section class="pricingTable mt-8 mb-5">
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
    </section> -->
<?php include viewPath('frontcommon/footer'); ?>
<script src="<?php echo $url->assets ?>frontend/js/slick.min.js"></script>
<script type="text/javascript">
    $(function(){
        $(".lazy").slick({
         dots: false,
         prevArrow: false,
         nextArrow: false,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 2000,
         centerMode: true,
        });
    });
</script>
