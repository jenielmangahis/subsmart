<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=<?= $paypal_client_id; ?>&currency=USD"></script>
<script src="https://api.convergepay.com/hosted-payments/PayWithConverge.js"></script> <!-- Production --> 
<script src="https://www.google.com/recaptcha/api.js"></script>
<!-- <script src="https://demo.convergepay.com/hosted-payments/PayWithConverge.js"></script> --> <!-- Demo -->
<style>
	.steps-form {
	    display: table;
	    width: 100%;
	    position: relative;
	}
	.steps-form .steps-row {
	    display: table-row;
	}
	.steps-form .steps-row:before {
	    top: 14px;
	    bottom: 0;
	    position: absolute;
	    content: " ";
	    width: 100%;
	    height: 1px;
	    background-color: #ccc;
	}
	.steps-form .steps-row .steps-step {
	    display: table-cell;
	    text-align: center;
	    position: relative;
	}
	.steps-form .steps-row .steps-step p {
	    margin-top: 0.5rem;
	}
	.steps-form .steps-row .steps-step button[disabled] {
	    opacity: 1 !important;
	    filter: alpha(opacity=100) !important;
	}
	.form-control-dr {
	    display: block;
	    width: 100%;
	    height: 50px;
	    padding: .375rem .75rem;
	    font-size: 1rem;
	    font-weight: 400;
	    line-height: 1.5;
	    color: #495057;
	    background-color: #fff;
	    background-clip: padding-box;
	    border: 1px solid #ced4da;
	    border-radius: .25rem;
	    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
	    background-position: calc(100% - 20px) calc(1em + 5px), calc(100% - 15px) calc(1em + 5px), calc(100% - 2.5em) 20em;
	    background-size: 5px 5px, 5px 5px, 1px 1.5em;
	    background-repeat: no-repeat;
	}
	.btn-circle {
	    width: 30px;
	    height: 30px;
	    text-align: center;
	    padding: 6px 0;
	    font-size: 12px;
	    line-height: 1.428571429;
	    border-radius: 15px;
	    margin-top: 0;
	}
	.btn-indigo {
	    color: #fff;
	    /* background-color: #3f51b5 !important; */
		background-color:#6a4a86 !important;
	}
	.btn-default {
	    color: #fff;
	    background-color: #2bbbad;
	}
	.sc-pl-2 {
	  padding-left: 16px !important;
	}
	.reg-sc.btn-default {
	  background-color: #7d7d7d;
	}
	.reg-sc.btn-default:hover {
	  color:white !important;
	}
	.reg-s1 {
	    margin: 0 auto;
	    width: 100%;
	    display: block;
	    text-align: center;
	    position: relative;
	    top: 20px;
	}
	.step2-btn {
	    background: #000000 !important;
	    border: 0px solid #64477d !important;
	}
	.step2-btn:hover {
	    color: #fde89d !important;
	}
	.plan-list{
		list-style: none;
	}
	.plan-list li{
	  display: inline-block;
	  width: 31%;
	  margin-bottom: 40px;
	  box-shadow: 0 0 9px -1px #222;
	  min-height: 300px;
	  vertical-align: middle;
	  margin: 4px;
	  background-color: #785aef;
	  padding-top: 10%;
	}
	h3.plan-list-text {
	  font-size: 22px !important;
	  font-weight: 800;
	  color: white;
	}
	p.plan-list-price {
	  font-size: 25px;
	  margin-top: 10px;
	  margin-bottom: 30px;
	  font-weight: 700;
	  color: #3ce405;
	  font-family: "Avenir Next LT Pro","Avenir Next",Futura,sans-serif !important;
	}
	@media only screen and (max-width: 700px) {
	  .plan-list li {
	      display: inline-block;
	      width: 100%;
	      margin-bottom: 40px;
	  }
	}
	.payment-method{
		padding: 0px;
		list-style: none;
	}
	.payment-method li{
		margin-bottom: 8px;
	}
	.payment-method li input{
		margin-right: 10px;
	}

	/**
	 * The CSS shown here will not be introduced in the Quickstart guide, but shows
	 * how you can use CSS to style your Element's container.
	 */
	.StripeElement {
	  box-sizing: border-box;

	  height: 40px;

	  padding: 10px 12px;

	  border: 1px solid transparent;
	  border-radius: 4px;
	  background-color: white;

	  box-shadow: 0 1px 3px 0 #e6ebf1;
	  -webkit-transition: box-shadow 150ms ease;
	  transition: box-shadow 150ms ease;
	}

	.StripeElement--focus {
	  box-shadow: 0 1px 3px 0 #cfd7df;
	}

	.StripeElement--invalid {
	  border-color: #fa755a;
	}

	.StripeElement--webkit-autofill {
	  background-color: #fefde5 !important;
	}
	.stripe-btn{
		border: none;
	    border-radius: 4px;
	    outline: none;
	    text-decoration: none;
	    color: #fff;
	    background: #32325d;
	    white-space: nowrap;
	    display: inline-block;
	    height: 40px;
	    line-height: 40px;
	    padding: 0 14px;
	    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
	    border-radius: 4px;
	    font-size: 15px;
	    font-weight: 600;
	    letter-spacing: 0.025em;
	    text-decoration: none;
	    -webkit-transition: all 150ms ease;
	    transition: all 150ms ease;
	    float: left;
	    margin-left: 12px;
	    margin-top: 28px;
	}
	.terms{
		overflow-y: scroll;
		height: 500px;
		width: 100%;
		border: 1px solid #DDD;
		padding: 10px;
	}
	.terms-heading{
		display: inline-block;
		margin-bottom: 12px;
		font-weight: 300;
	}
	.terms-content{
		/*margin-left: 17px;*/
	}
	#stripe-button{
		width: 100%;
	    color: #ffffff;
	    font-weight: bold;
	    padding: 12px;
	    background-color: #5469d4;
	}
	#converge-button{
		width: 100%;
	    color: #ffffff;
	    font-weight: bold;
	    padding: 12px;
	    background-color: #0070ba;
	}
	.has-error{
		border: 1px solid red;
	}
	.input-group-prepend {
	    height: 48px !important;
	}
	.form_line{
	    margin-bottom: 10px;
	}
</style>
<section page="register" message="" class="ng-isolate-scope">
	<div class="f-height-v2">
		<div class="row">
			<div class="col-md-5 col-sm-5 float-left pl-0 desktop-only">
				<div id="side-image" class="side-image--regular image-fader left"></div>
			</div>
			<div class="col-sm-7 col-md-7 float-left pr-0 container-signup pt-5">


					<h2 class="m-b-2 ng-scope text-center reg-header">Welcome to a new way to take control of your business.</h2>
					<span class="text-center block mt-3">Already signed up? <a href="<?php echo url('login');?>" class="reg-color">Log in</a></span>
					<span class="text-reg-subtle">Studies show CRM Systems will increase your customer relationship by 74% and improves your sales by 87%</span>
					<div class="form-container-reg">

						<!-- Steps form -->
						<div class="card" style="border: none;">
						  <div class="card-body mb-4">
						    	<?php if( $payment_complete ){ ?>
						    		<div class="alert alert-success alert-dismissible fade show" style="width: 100%;margin-top: 10px;margin-bottom: 10px;">
									  <p><?php echo $payment_message; ?></p>
									</div>
						    	<?php }else{ ?>
						    		<?php if( $payment_message != '' ){ ?>
						    			<div class="alert alert-danger alert-dismissible fade show" style="width: 100%;margin-top: 10px;margin-bottom: 10px;">
										  <p><?php echo $payment_message; ?></p>
										</div>
						    		<?php } ?>
						    		<!-- Stepper -->
						    		<?php if($ip_exist== false){ ?>
								    <div class="steps-form">
								      <div class="steps-row setup-panel">
								        <div class="steps-step">
								          <span class="btn reg-sc btn-indigo btn-circle step-1">1</span>
								          <p>Step 1</p>
								        </div>
								        <div class="steps-step">
								          <span class="btn reg-sc btn-default btn-circle step-2">2</span>
								          <p>Step 2</p>
								        </div>
								        <div class="steps-step">
								          <span class="btn reg-sc btn-default btn-circle step-3">3</span>
								          <p>Step 3</p>
								        </div>
								        <div class="steps-step">
								          <span class="btn reg-sc btn-default btn-circle step-4">4</span>
								          <p>Step 4</p>
								        </div>
								      </div>
								    </div>
									<?php } ?>

						    		<?php echo form_open_multipart('register/subscribe', [ 'class' => 'form-validate subscribe-form-payment', 'id' => 'subscribe-form-payment', 'autocomplete' => 'off' ]); ?>
						    		<input type="hidden" name="payment_method" id="payment-method" value="">
						    		<input type="hidden" name="payment_method_status" id="payment-method-status" value="">
							      	<input type="hidden" name="plan_id" id="plan_id" value="">
						            <input type="hidden" name="plan_price" id="plan_price" value="">
						            <input type="hidden" name="plan_price_discounted" id="plan_price_discounted" value="">
						            <input type="hidden" name="plan_name" id="plan_name" value="">
							      	<!-- First Step -->
							      	<div class="row setup-content" id="step-1">
								        <div class="col-md-12">
			                      			<?php if($ip_exist == false){ ?>
				                      			<div class="reg-s1">
				  						          <h4 class="font-weight-bold pl-0 my-4 sc-pl-2"><strong>Step 1 : Select Plan</strong></h4>
				  						          <select name="subscription_type" id="subscription_type" class="form-control-dr subscription-type" style="width: 100%;margin: 33px auto;max-width: 380px;" required="">													
				  						          	<option value="prospect" <?= $default_type == 'discounted' ? 'selected="selected"' : ''; ?>><?= REGISTRATION_MONTHS_DISCOUNTED; ?> months 50% off</option>
				  						          	<option value="trial" <?= $default_type == 'free' ? 'selected="selected"' : ''; ?>>Free Trial (14 Days)</option>
				  						          </select>
				  						          <ul class="plan-list">
				  						          <?php foreach($ns_plans as $p){ ?>
				  						          	<li>
				  						          		<?php if($p->plan_name != 'Industry Specific') { ?>
				  						          			<h3 class="plan-list-text"><?= $p->plan_name; ?></h3>
				  						          		<?php }else{ ?>
				  						          			<h3 style="font-size: 20px !important;" class="plan-list-text"><?= $p->plan_name; ?></h3>
				  						          		<?php } ?>
				  						          		<?php //if($p->plan_name != 'Industry Specific') { ?>
					  						          		<div class="discounted-price">
					  						          			<p class="plan-list-price" style="text-decoration: line-through;font-size:18px;color: #ffe215;">$<?= number_format($p->price, 2); ?></p>
					  						          			<?php
					  						          				$discount_price = $p->price / 2;
					  						          			?>
					  						          			<p class="plan-list-price">$<?= number_format($p->discount, 2); ?>/mo</p>
					  						          		</div>
					  						          		<div class="trial-price" style="display: none;">
					  						          			<p class="plan-list-price">$<?= number_format($p->price, 2); ?>/mo</p>
					  						          		</div>
				  						          			<br />
				  						          			<?php 
				  						          				$btn_identifier = "btn-" . strtolower($p->plan_name);
				  						          				$btn_identifier = str_replace(" ", "-", $btn_identifier);
				  						          			?>
				  						          			<a class="btn btn-info step2-btn <?= $btn_identifier; ?>" href="javascript:void(0);" data-id="<?= $p->nsmart_plans_id; ?>" data-plan="<?= $p->plan_name; ?>" data-price="<?= $p->price; ?>" data-price-discounted="<?= $p->discount; ?>">Select Plan</a>
				  						          		<?php //} else { ?>
				  						          			<!-- <p style="font-size: 14px !important;" class="plan-list-price">for demo & other info.</p>
				  						          			<a class="btn btn-info" href="<?php //echo url('/contact') ?>">Contact Us</a> -->
				  						          		<?php //} ?>
				  						          	</li>
				  						          <?php } ?>
				  						      	  </ul>
				                      			</div>
				                      		<?php }else{ ?>
				                      			<div class="reg-s1">
				                      				<h4 class="font-weight-bold pl-0 my-4 sc-pl-2"><strong>Sorry you can only register once in our system</strong></h4>
				                      			</div>
				                      		<?php } ?>	

								        </div>
							      	</div>

							      	<!-- Second Step -->
							      	<div class="row setup-content" id="step-2">
								        <div class="col-md-12">
								          	<h4 class="font-weight-bold pl-0 my-4 sc-pl-2"><strong>Step 2 : Personal Information</strong></h4>
											<input type="hidden" id="nsmart_trp" value="" />
								          	<div class="step-2-error-msg"></div>

								          	<div class="row">
									          	<div class="col-md-6 z-100">
													<div class="input-group z-100">
														<input autocomplete="off" type="text" name="firstname" id="firstname" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="First Name" required="">
													</div>
												</div>


												<div class="col-md-6 z-100">
													<div class="input-group z-100">
														<input autocomplete="off" type="text" name="lastname" id="lastname" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Last Name" required="">
													</div>
												</div>
											</div>

											<div class="row">												
												<div class="col-md-6">
													<div class="input-group z-100">
														<input autocomplete="off" type="text" name="phone" id="phone" maxlength="12" placeholder="Phone Number" class="form-control ng-pristine ng-untouched ng-valid ng-empty business-phone" required="">
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group">
														<select class="reg-select z-100" id="number_of_employee" name="number_of_employee" required="">
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
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="input-group z-100">
														<input id="google_search_place" type="text" name="business_name" class="business_name form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your Business Name" placeholder="Business Name" autocomplete="on" runat="server" required="" />
													</div>
												</div>
												<div class="col-md-12">
													<div class="input-group z-100">
														<input id="business_address" type="text" name="business_address" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Business Address" placeholder="Business Address" required="" />
													</div>
												</div>
												<div class="col-md-5">
													<div class="input-group z-100">
														<input id="business_city" type="text" name="business_city" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="City" placeholder="City" required="" />
													</div>
												</div>
												<div class="col-md-4">
													<div class="input-group z-100">
														<input id="business_state" type="text" name="business_state" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="State" placeholder="State" required="" />
													</div>
												</div>
												<div class="col-md-3">
													<div class="input-group z-100">
														<input autocomplete="off" type="text" name="zip_code" id="zip_code" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Zip Code" required="">
													</div>
												</div>
												<div class="col-md-12">
													<div class="input-group">
														<select class="reg-select z-100 cmb-industry" id="industry_type_id" name="industry_type_id" required="">
															<option value="">--Select your Industry--</option>
							                                <?php $businessTypeName  = "";
							                                     foreach($industryTypes  as $industryType ){ ?>
							                                           <?php if ($businessTypeName!== $industryType->business_type_name ) { ?> 
							                                           			<optgroup label="<?php echo $industryType->business_type_name; ?>">
							                                           <?php  $businessTypeName =  $industryType->business_type_name; }      ?>  
							                                            <option value="<?php echo $industryType->id; ?>"><?php echo $industryType->name; ?></option>
							                                <?php  }   ?>						                                
														</select>
													</div>
												</div>
											</div>
											<hr />
											<div class="row mb-4">
												<div class="col-md-12 mb-2"><h4 style="font-size:18px;">Login Details</h4></div>
												<div class="col-md-6">
													<div class="input-group z-100">
														<input autocomplete="off" type="email" name="email" id="email_address" class="email_address form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your email address" placeholder="Email address" required="">
													</div>
												</div>
												<div class="col-md-6">
													<div class="input-group z-100">
														<input autocomplete="off" type="password" name="password" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Create your password" required="">
													</div>
												</div>												
											</div>

											<div class="row">
												<div class="col-md-12">
													<div id="ajax-authentication-alert-container"></div>
												</div>
											</div>

		                      			<div class="pl-3 pr-3 float-right">		                      				
		  						          	<button name="button" class="reg-wbtn btn btn-indigo btn-rounded prevBtn" data-key="step-1" type="button">Previous</button>
		  						          	<button name="button" class="reg-wbtn btn btn-indigo btn-rounded nextBtn" data-key="step-3" type="button">Next</button>
		                      			</div>
								        </div>
							      	</div>

							      	<!-- Third Step -->
							      	<div class="row setup-content" id="step-3">
								        <div class="col-md-12">
								          <h3 class="font-weight-bold pl-0 my-4"><strong>Step 3 : Payment Method</strong></h3>
								          <div class="payment-method" style="display: block;margin-bottom: 74px;">
								          	<label>Plan : <b><span class="plan-selected"></span> / <span class="plan-price"></span></b></label><br />
								          	<label>Total Amount : <b><span class="total-amount"></span></b></label><br />
								          	<hr />
								          	<div class="payment-method-container">
									          	<p><b>Payment Method</b></p>
									          	<ul class="payment-method">
													<li><a class="btn btn-primary" id="converge-button" href="javascript:void(0);">CREDIT CARD PAYMENT</a></li>
									          		<li><div id="paypal-button-container"></div></li>									          		
									          		<li>
									          			<div class="form-row align-items-center" style="margin-top: 30px;">
										          			<!-- Grid column -->
														    <div class="col-auto">
														      <!-- Material input -->
														      <label class="sr-only" for="inlineFormInputGroupMD">Username</label>
														      <div class="md-form input-group mb-3">
														        <div class="input-group-prepend">
														          <span class="input-group-text md-addon">Use Offer Code</span>
														        </div>
														        <input type="text" class="form-control pl-2 rounded-0" name="offer_code" id="offer-code"
														          placeholder="">
														      </div>
														    </div>
													    	<!-- Grid column -->

														    <!-- Grid column -->
														    <div class="col-auto">
														      <button type="button" class="btn btn-primary mb-0 btn-use-offer-code" style="position: relative;top: -12px;">Use Code</button>
														    </div>
														    <!-- Grid column -->
														</div>
									          		</li>
									          	</ul>	
								          	</div>
											<a href="javascript:void(0);" class="btn-terms-agreement" style="margin-top: 29px;display: block;">Service Subscription License Agreement</a>
								      	  </div>		
										  	<div id="captcha-container">						
										  		<div class="g-recaptcha mt-2 mb-2" data-sitekey="<?= GOOGLE_CAPTCHA_SITE_KEY; ?>"></div>
											</div>

								          <button name="button" class="btn btn-indigo btn-rounded prevBtn float-left" data-key="step-2" type="button">Previous</button>
								          <button name="button" class="btn btn-indigo btn-rounded trial-register-btn float-left" type="button" style="margin-left: 10px;">Register</button>
								          <!-- <button type="submit" class="btn btn-default btn-rounded float-right step3-btn-processPayment" data-key="step-4">Proceed to Payment</button> -->
								        </div>
							      	</div>

							      	<!-- 4th Step -->
							      	<div class="row setup-content" id="step-4">
								        <div class="col-md-12">
								          <h3 class="font-weight-bold pl-0 my-4"><strong>Step 4 : Finish</strong></h3>
								          <p>Please add paypal success here..</p>
								          <a class="btn btn-indigo btn-rounded float-left" href="<?php echo url('/login') ?>">Login to your account</a>
								        </div>
							      	</div>

							      	<?php echo form_close(); ?>
						    	<?php } ?>
						  </div>
						</div>
						<!-- Steps form -->

						<!-- MODAL USE OFFER CODE -->
						<div id="modalVerifyOfferCode" class="modal fade" role="dialog">
						    <div class="modal-dialog modal-md modal-dialog-centered">
						        <!-- Modal content-->
						        <div class="modal-content">
						            <div class="modal-header">
						                <h4 class="modal-title">Offer Code</h4>
						                <button name="button" type="button" class="close" data-dismiss="modal">&times;</button>
						            </div>
						            <div class="modal-body">
						                <p>Verifying code...</p>
						            </div>
						        </div>

						    </div>
						</div>

						<!-- MODAL USE OFFER CODE -->
						<div id="modalTermsAgreement" class="modal fade" role="dialog">
						    <div class="modal-dialog modal-lg">
						        <!-- Modal content-->
						        <div class="modal-content">
						            <div class="modal-header">
						                <h4 class="modal-title">Software as a Service Subscription License Agreement</h4>
						                <button name="button" type="button" class="close" data-dismiss="modal">&times;</button>
						            </div>
						            <div class="modal-body" style="padding: 0px;">
						                <div class="terms">
										  	<p>Software as a Service Subscription License Agreement</p>
											<p>DEFINITIONS</p>
											<ol style="list-style-position:inside;padding: 5px;">
												<li>a. Service(s) - Value-added software applications that nSmarTrac licenses to Customer on a subscription basis.</li>
												<li>b. Customer - Party to which nSmarTrac licenses Services.</li>
												<li>c. End-User - Party that uses nSmarTrac Services.</li>
												<li>d. Activation - Process by which nSmarTrac provides Customer with access to the Service.</li>
											</ol>

											<ol style="list-style-position:inside;padding: 5px;">
												<li>
													<h5 class="terms-heading">FEES, ACTIVATION, BILLING START DATE, TERMINATION DATE</h5>
													<p class="terms-content">
														FEES AND ACTIVATION. The amount indicated as Monthly Charge (Min.) on this Agreement represents the minimum amount due from Customer on a monthly basis nSmarTrac will invoice customer in advance for each billing period (e.g. monthly, quarterly or annually) based on the Services in use at the start of the period, but not less than the Monthly Charge (Min). nSmarTrac will invoice customer in arrears for any Services added during the previous billing period.
													</p>

													<p class="terms-content">
														BILLING START DATE. Billing Start Date shall be the date of Activation or three (3) calendar days from the date of the last signature on this Agreement, whichever is earlier.
													</p>
												</li>
											</ol>
											<p>TERMINATION DATE. Termination date (Term Date) of this Agreement shall be up to SIXTY (60) calendar months from the Billing Start Date.</p>

											<ol style="list-style-position:inside;padding: 5px;">
											 <li>
											 	<h5 class="terms-heading">RENEWAL & REFUNDS</h5>
												<p class="terms-content">This Agreement shall be renewed automatically for successive ONE (1) Full term periods from the termination date (Term Date) of this Agreement unless Customer provides nSmarTrac with at least 90 days notice indicating that the Agreement shall not be renewed automatically. nSmarTrac will not provide a refund for partial months and will stop providing the Service on the termination date without a written cancellation notice. nSmarTrac shall have the right to revise the per user fee at the expiration of this Agreement, by providing a written notice to Customer 15 days prior to the Term Date. Upon renewal the Monthly Charge (Min) shall automatically adjust to reflect the then current charges based on usage.</p>
											 </li>
											 <li>
											 	<h5 class="terms-heading">INTELLECTUAL AND PROPERTY RIGHTS</h5>
												<p class="terms-content">nSmarTrac or its suppliers maintain all Intellectual and Property rights to the Services that it sells to the Customer. Customer is granted only a personal, nontransferable, nonsublicensable, nonexclusive right to use the Services solely for the internal purposes of Customer. Customer agrees not to resell, rent or lease the Services or create derivative works from the Services either directly or through a third party, or to reverse assemble, decompile, or otherwise attempt to derive source code from the Service. Customer will not remove or alter any trademarks, or other proprietary notices, legends, symbols, or labels appearing on or in copies of materials delivered to Customer in connection with the Services. nSmarTrac eserves the right to change and enhance the Services at any time. • If the supplier or licensor of any component of the Service limits the right or ability of nSmarTrac to provide such components to Customer, nSmarTrac shall have the right to replace the component with a reasonably equivalent alternative. Customer agrees not to directly license any component of the Service from a third party without the written permission of nSmarTrac, and any such direct license shall not alter Customer’s obligations under this Agreement.</p>
											 </li>
											 <li>
											 	<h5 class="terms-heading">WARRANTY</h5>
											    <p class="terms-content">nSmarTrac warrants that it has full power and authority to sell Services to Customer.</p>
											 </li>
											</ol>

											<ol style="list-style-position:inside;padding: 5px;">
												<li>
													<h5 class="terms-heading">COMPLIANCE WITH LAW</h5>
													<p class="terms-content">Both parties shall comply with all applicable laws relating to the Services, including without limitation export and re-export restrictions and regulations of the Department of Commerce or other United States agency or authority.</p>
												</li>
												<li>
												 	<h5 class="terms-heading">DISCLAIMER</h5>
													<p class="terms-content">EXCEPT AS SET FORTH IN THIS AGREEMENT, NSMARTRAC DISCLAIMS ALL WARRANTIES WITH REGARD TO THE SERVICES, INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR USE, OR NON-INFRINGEMENT. NSMARTRAC DOES NOT ENDORSE ANY TOOL OR SOFTWARE AS BEING IDEAL FOR A PARTICULAR USE. IN ADDITION, NSMARTRAC OFFERS NO GUARANTEES OR WARRANTIES WITH REGARD TO THE RESULTS OF USING ITS SERVICES.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">CONFIDENTIALITY</h5>
													<p class="terms-content">nSmarTrac and Customer both acknowledge that in the course of this Agreement, either party may obtain certain confidential and/or propriety information of the other. Each party hereby agrees that all such information communicated to it by the other party, its affiliates, or customers, whether before or after the Effective Date, shall be used only for the purpose of this Agreement, and shall not be disclosed without the prior written consent of the other party, except as may be necessary by reason of legal, accounting, or regulatory requirements beyond either party's reasonable control, but each party subject to any such requirements shall give prompt notice thereof to the other party to permit it nSmarTrac to seek a protective order or other legal remedy to prevent such disclosure. Customer grants nSmarTrac the right to publicly disclose Customer's use of nSmarTrac services. In no case shall such disclosure include the Terms and Conditions of this Agreement. Each party agrees that a remedy of damages may not be sufficient for a breach of this Section 6, and agrees that either party may obtain a temporary restraining order or temporary or permanent injunction against any breach or threatened breach of this Section 6.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">SERVICE SUPPORT</h5>
													<p class="terms-content">All support will be limited to the usage of nSmarTrac Services alone, and will not include any support on other Customer services. Support provided by nSmarTrac is described in nSmarTrac ' support procedure, which will be provided to Customer upon completion of Activation. Customer is responsible for providing support to Customer's End-Users.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">TERMINATION; DAMAGES</h5>
													<p class="terms-content">Either party may terminate this Agreement upon written notice if the other party fails to cure any material breach of this Agreement within 30 days after receiving written notice of such breach; provided, however, that the period to cure breach with respect to payment shall be 10 days. In the event of such a termination by Customer, nSmarTrac shall refund to Customer any prepaid amounts applicable to the period following the effective date of termination, but such termination shall be Customer’s sole and exclusive remedy in case of a material breach of this Agreement by nSmarTrac. nSmarTrac assumes no responsibility for any problems or damages that may occur on the Customer's hardware.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">LIMITATION OF LIABILITY</h5>
													<p class="terms-content">nSmarTrac and its suppliers and licensors shall have no liability, pursuant to this agreement or otherwise, for special, incidental, consequential, punitive, or exemplary damages, even if nSmarTrac or such suppliers and licensors have been advised of the possibility of such damages. In no event shall nSmarTrac ' liability for any reason and upon any cause of action whatsoever exceed the payments made by Customer to nSmarTrac during the twelve months preceding the date of the event giving rise to liability. Neither party shall be liable to the other pursuant to this Agreement for any amounts representing loss of profits or loss of business.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">FORCE MAJEURE</h5>
													<p class="terms-content">nSmarTrac shall not be liable to the Customer for any delay or failure to provide access to the Service due to causes beyond its reasonable control.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">ASSIGNMENT</h5>
													<p class="terms-content">Customer may not assign, without prior written consent of nSmarTrac its rights, duties or obligations under this Agreement, in whole or in part, to any person or entity. Any such attempted assignment or sub-license shall be void and shall constitute a material breach of this Agreement.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">NO WAIVER</h5>
													<p class="terms-content">The waiver or failure of either party to exercise any right in any respect provided for herein shall not be deemed a waiver of any further right hereunder.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">ENTIRE AGREEMENT</h5>
													<p class="terms-content">This Agreement, and the schedules attached hereto constitute the entire Agreement between the parties hereto pertaining to the subject matter hereof, and any and all other written or oral agreements existing between the parties hereto are expressly canceled. The schedules attached to this Agreement are an integral part of this Agreement and are incorporated into this Agreement.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">GOVERNING LAW.</h5>
													<p class="terms-content">This Agreement and all acts and transactions pursuant hereto and the rights and obligations of the parties hereto shall be governed, construed and interpreted in accordance with the laws of the State of Texas without giving effect to principles of conflicts of law. Subject to the Section titled "Arbitration", the parties hereto consent to the jurisdiction of the state and federal courts located in Travis County, Texas.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">ARBITRATION</h5>
													<p class="terms-content">Any controversies arising out of the terms of this Agreement or its interpretation shall be settled through a mediation-arbitration approach in Escambia County, Florida. The parties agree to first try to resolve the dispute informally with the help of a mutually agreed-upon mediator.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">ATTORNEY'S FEES</h5>
													<p class="terms-content">If any action at law or in equity (including mediation and arbitration) is necessary to enforce or interpret the terms of any of this Agreement, the prevailing party shall be entitled to reasonable attorney's fees, costs and necessary disbursements in addition to any other relief to which such party may be entitled.</p>
												 </li>
												 <li>
												 	<h5 class="terms-heading">ENFORCEABILITY</h5>
													<p class="terms-content">If one or more provisions of this Agreement are held to be unenforceable under applicable law, the parties agree to renegotiate such provision in good faith. In the event that the parties cannot reach a mutually agreeable and enforceable replacement for such provision, then (a) such provision shall be excluded from this Agreement, (b) the balance of this Agreement shall be interpreted as if such provision were so excluded, and (c) the balance of this Agreement shall be enforceable in accordance with its terms.</p>
												 </li>
											</ol>
											<ol style="list-style-position:inside;padding: 5px;">
												<li>
													<h5 class="terms-heading">THIRD PARTY BENEFICIARY</h5>
													<p class="terms-content">The suppliers of any products and services used in the Services and their licensors shall be deemed to be third party beneficiaries of this Agreement.</p>
												</li>
											</ol>
										  </div>
						            </div>
						        </div>

						    </div>
						</div>

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

					</div>

			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modal-converge-subscribe" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Pay Subscription Plan</h5>
          <button name="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>        
        <div class="modal-body">
			<form id="frm-pay-subscription" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">                            
                        <div id="credit_card">
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Card Number
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="card_number" id="cardnumber" value="" required/>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    <label for="">Expiration 
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select id="exp_month" name="exp_month" class="form-control exp_month" required>
                                                <option  value="">Month</option>
                                                <option  value="01">01</option>
                                                <option  value="02">02</option>
                                                <option  value="03">03</option>
                                                <option  value="04">04</option>
                                                <option  value="05">05</option>
                                                <option  value="06">06</option>
                                                <option  value="07">07</option>
                                                <option  value="08">08</option>
                                                <option  value="09">09</option>
                                                <option  value="10">10</option>
                                                <option  value="11">11</option>
                                                <option  value="12">12</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="exp_year" name="exp_year" class="form-control exp_year" required>
                                                <option  value="">Year</option>
												<?php for( $x = date("Y"); $x<=date("Y", strtotime("+20 years")); $x++ ){ ?>
													<option value="<?= $x; ?>"><?= $x; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" maxlength="4" class="form-control" name="cvc" id="cvc" value="" placeholder="CVC" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row form_line">
                                <div class="col-md-4">Total Amount</div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input type="number" class="form-control" name="plan_amount" id="plan_amount" value="<?= number_format($plan->price,2); ?>" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>			
        	</form>
        </div>
        <div class="modal-footer">
            <button name="button" class="btn btn-indigo" type="button" data-dismiss="modal">Close</button>
            <button name="button" class="btn btn-indigo btn-modal-pay-subscription" type="submit" form="frm-pay-subscription">Pay</button>
        </div>
      </div>
    </div>
</div>

</section>
<?php include viewPath('frontcommon/footer'); ?>
<script>
$(function(){
	var default_plan = "<?= $default_plan; ?>";
	var default_type = "<?= $default_type; ?>";

	base_url = '<?php echo base_url(); ?>';
	var allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn'),
        allPrevBtn = $('.prevBtn'),
        step1Container = $('#step-1'),
        step2Container = $('#step-2'),
        step3Container = $('#step-3'),
        step4Container = $('#step-4'),
        step2bBtn  = $('.step2-btn'),
        subType = $(".subscription-type"),
        step3bBtnPrcPayment = $('.step3-btn-processPayment');

    allWells.hide();
    step1Container.show();

    allPrevBtn.click(function(){
    	var step = $(this).attr("data-key");
        var curStep = $(this).closest(".setup-content");
        var curStepBtn = curStep.attr("id");

        $("span." + curStepBtn).removeClass("btn-indigo");
        $("span." + curStepBtn).addClass("btn-default");
        $("span." + step).addClass("btn-indigo");
        $("#" + step).show();
        $("#" + curStepBtn).hide();
    });

    $(".btn-terms-agreement").click(function(){
    	$("#modalTermsAgreement").modal('show');
    });

    default_plan_selected();

    function default_plan_selected(){
    	if( default_plan != '' ){
    		if( default_plan == 'essential' ){
	    		var plan_id = 2;
		    	var plan_price = "59.99";
		    	var plan_price_discounted = "49.99";
		    	var plan_name  = "Essential";
	    	}else if( default_plan == 'simple-start' ){
	    		var plan_id = 1;
		    	var plan_price = "24.99";
		    	var plan_price_discounted = "19.99";
		    	var plan_name  = "Simple Start";
	    	}else if( default_plan == 'plus' ){
	    		var plan_id = 3;
		    	var plan_price = "79.99";
		    	var plan_price_discounted = "69.99";
		    	var plan_name  = "Plus";
	    	}else if( default_plan == 'premier-pro' ){
	    		var plan_id = 4;
		    	var plan_price = "99.99";
		    	var plan_price_discounted = "89.99";
		    	var plan_name  = "PremierPro";
	    	}else if( default_plan == 'enterprise' ){
	    		var plan_id = 6;
		    	var plan_price = "299.99";
		    	var plan_price_discounted = "249.99";
		    	var plan_name  = "Enterprise";
	    	}else if( default_plan == 'industry-specific' ){
	    		var plan_id = 5;
		    	var plan_price = "179.99";
		    	var plan_price_discounted = "149.99";
		    	var plan_name  = "Industry Specific";
	    	} 

	    	var subscription_type = $(".subscription-type").val();

	    	//alert(plan_price);
	    	//alert(plan_price_discounted);
	    	//alert(subscription_type);

	    	$("#plan_id").val(plan_id);
	    	$("#plan_price").val(plan_price);
	    	$("#plan_price_discounted").val(plan_price_discounted);
	        $("#plan_name").val(plan_name);
	    	$(".plan-selected").text(plan_name);
	    	$(".plan-price").text("$" + plan_price);

	    	step1Container.hide();

	    	$("span.step-1").removeClass('btn-indigo');
		    $("span.step-1").addClass("btn-default");

	    	if( subscription_type == 'trial' ){
	    		$(".total-amount").text("0.00 (Free Trial)");
	    		$("#plan_type").val('trial');
	    		$(".payment-method-container").hide();
	    		$(".trial-register-btn").show();

	    		//$("#plan_price").val(0);
	    		/*step3Container.show(); 
	    		$("span.step-3").addClass('btn-indigo');*/

	    		step2Container.show();
		    	$("span.step-2").addClass('btn-indigo');

	    	}else{
	    		$("#subscription_type").val('discounted');
	    		$(".total-amount").text("$" + plan_price_discounted  + " (3 months 50% off)");
	    		$(".payment-method-container").show();
	    		$(".trial-register-btn").hide();
	    		step2Container.show();
		    	$("span.step-2").addClass('btn-indigo');
	    	}
    	}
    }

    $("#frm-pay-subscription").submit(function(e){
    	e.preventDefault();

    	var total_amount = $("#plan_price_discounted").val();
        var firstname = $("#firstname").val();
        var lastname  = $("#lastname").val();
        var email_add = $("#email_address").val();
        var zipcode   = $("#zip_code").val();
        var ccnumber  = $("#cardnumber").val();
        var expmonth  = $("#exp_month").val();
        var expyear   = $("#exp_year").val();
        var cvc       = $("#cvc").val();
        var plan_id   = $("#plan_id").val();
        var address   = $("#business_address").val();
        var url 	  = base_url + 'registration/_pay_subscription';

        $.ajax({
			type: "POST",
			url: url,
			dataType: "json",
			data: {
			total_amount:total_amount,
			firstname:firstname,
			lastname:lastname,
			email_add:email_add,
			zipcode:zipcode,
			address:address,
			ccnumber:ccnumber,
			expmonth:expmonth,
			expyear:expyear,
			plan_id:plan_id,
			cvc:cvc
			},
			success: function(o)
			{
				$("#frm-pay-subscription").modal('hide'); 

				if( o.is_success == 1 ){
					$("#modal-converge-subscribe").modal('hide');
					$("#payment-method").val('converge');
					$("#payment-method-status").val('COMPLETED');
					activate_registration();
				}else{
					Swal.fire({
					icon: 'error',
					title: 'Cannot process payment',
					text: o.message
					});
				}

				$('.btn-modal-pay-subscription').prop("disabled", false);
				$(".btn-modal-pay-subscription").html('Pay');
			},
			beforeSend:function(){
				$('.btn-modal-pay-subscription').prop("disabled", true);
            	$('.btn-modal-pay-subscription').html('<span class="spinner-border spinner-border-sm m-0"></span>');
			}
		});
    });

    allNextBtn.click(function(){

        var step = $(this).attr("data-key");
        var curStep = $(this).closest(".setup-content");
        var curStepBtn = curStep.attr("id");
        //var curInputs  = curStep.find("input[type='text'],input[type='email'],input[type='password']");

        var curInputs      = curStep.find("input[type='text'],input[type='email'],input[type='password']");
        var curInputEmail  = curStep.find("input[type='email']");
		var curSelect      = $('#industry_type_id');

        var isValid = true;
        var isValidEmail = true;

        var emailErrMsg = "";
		var industryTypeErrMsg = "";

        $(".form-group").removeClass("has-error");

        var req_inc = 0;
        for(var i=0; i< curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                req_inc++;
                $(curInputs[i]).closest(".input-group").addClass("has-error");
            }else{
            	$(curInputs[i]).closest(".input-group").removeClass("has-error");
            }
        }

        for(var i=0; i< curInputEmail.length; i++){
            if (!curInputEmail[i].validity.valid){
                isValidEmail = false;
                emailErrMsg = "Please enter a correct email address";
            }
        }

		if( curSelect.val() <= 0 ){
			curSelect.closest(".input-group").addClass("has-error");
			industryTypeErrMsg = "Please select industry type";
		}else{
			curSelect.closest(".input-group").removeClass("has-error");
		}

        $("#ajax-authentication-alert-container").html('');

        if( isValid ){
			var nsmart_trp          = $('#nsmart_trp').val();
        	var firstname 			= $("input[name=firstname]").val();
        	var lastname 			= $("input[name=lastname]").val();
        	var phone 				= $("input[name=phone]").val();
        	var business_address 	= $("#business_address").val(); 
        	var zip_code            = $("#zip_code").val(); 
        	//var number_of_employee 	= $('#number_of_employee').find(":selected").val();
        	//var industry_type_id 	= $('#industry_type_id').find(":selected").val();
        	var a_email = $("#email_address").val(); 
        	var a_bname = $(".business_name").val();

        	var authenticating_url = base_url + 'register/authenticating_registration';
        	var aut_msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'assets/img/spinner.gif" /> Authenticating registration...</div>';
        	$("#ajax-authentication-alert-container").html(aut_msg);

	        setTimeout(function () {
	            $.ajax({
	               type: "POST",
	               url: authenticating_url,
	               data: {
					    nsmart_trp:nsmart_trp,
	               		a_email:a_email,
	               		a_bname:a_bname,
	               		firstname:firstname,
	               		lastname:lastname,
	               		phone:phone,
	               		business_address:business_address,
	               		zip_code:zip_code
	               	},
	               success: function(o)
	               {
					$("." + curStepBtn + "-error-msg").removeClass('alert alert-danger');
						$("." + curStepBtn + "-error-msg").html('');
	               		var obj = jQuery.parseJSON( o );
	               		//if(obj == 1) {
	               		if(obj.is_authentic == 1) {
					        $("span." + curStepBtn).removeClass("btn-indigo");
					        $("span." + curStepBtn).addClass("btn-default");
					        $("span." + step).addClass("btn-indigo");
					        $("#" + step).show();
					        $("#" + curStepBtn).hide();
					        $("." + curStepBtn + "-error-msg").removeClass("alert alert-danger");
					        $("." + curStepBtn + "-error-msg").html("");	
					        $("#ajax-authentication-alert-container").html("");
							
							grecaptcha.reset();
							
	               		} else {
	               			$("#ajax-authentication-alert-container").html('<div class="alert alert-danger" role="alert">Your credential already register to our system, please try another.</div>');
	               		}
	                  	
	               }
	            });
	        }, 500);        	


        }else{
        	$("." + curStepBtn + "-error-msg").addClass("alert alert-danger");

        	if(req_inc == 1 && emailErrMsg != "") {
        		$("." + curStepBtn + "-error-msg").html(emailErrMsg);
        	}else if( industryTypeErrMsg != "" ){
				$("." + curStepBtn + "-error-msg").html(industryTypeErrMsg);
			}else {
        		$("." + curStepBtn + "-error-msg").html("Cannot empty required fields");
        	}
        }
    });

    step2bBtn.click(function(){

    	var plan_id = $(this).attr("data-id");
    	var plan_price = $(this).attr("data-price");
    	var plan_price_discounted = $(this).attr("data-price-discounted");

    	var price_discount = (plan_price * 3) / 2;
    	var plan_name  = $(this).attr("data-plan");
    	var subscription_type = $(".subscription-type").val();

		if( subscription_type == 'prospect' ){
			$('#captcha-container').hide();
		}else{
			$('#captcha-container').show();
		}

    	$("#plan_id").val(plan_id);
    	$("#plan_price").val(plan_price);
    	$("#plan_price_discounted").val(plan_price_discounted);
        $("#plan_name").val(plan_name);
    	$(".plan-selected").text(plan_name);
    	$(".plan-price").text("$" + plan_price);

    	step1Container.hide();

    	$("span.step-1").removeClass('btn-indigo');
	    $("span.step-1").addClass("btn-default");

    	if( subscription_type == 'trial' ){
    		$(".total-amount").text("0.00 (Free Trial)");
    		$("#plan_type").val('trial');
    		$(".payment-method-container").hide();
    		$(".trial-register-btn").show();

    		//$("#plan_price").val(0);
    		/*step3Container.show(); 
    		$("span.step-3").addClass('btn-indigo');*/

    		step2Container.show();
	    	$("span.step-2").addClass('btn-indigo');

    	}else{
    		//$("#subscription_type").val('discounted');
    		$(".total-amount").text("$" + plan_price_discounted  + " (3 months 50% off)");
    		$(".payment-method-container").show();
    		$(".trial-register-btn").hide();
    		step2Container.show();
	    	$("span.step-2").addClass('btn-indigo');
    	}
    });

    step3bBtnPrcPayment.click(function(e){
    	e.preventDefault();
    	var payment_method = $('input[name="payment_method"]:checked').val();    	    	
    	if( payment_method == 'paypal' || payment_method == 'converge' ){
    		$( "#subscribe-form-payment" ).submit();
    	}else{
    		$("#step-3").hide();
    		$(".stripe-form").show();
    	}
   	});

   	$(".trial-register-btn").click(function(){
   		activate_registration();
   	});

    $('div.setup-panel div a.btn-indigo').trigger('click');

    <?php if($payment_status == 'success') { ?>
    		//$('div.setup-panel div a#step4').trigger('click');
    		step1Container.hide();
    	    step2Container.hide();
    	    $('#step-3').hide();
    	    $('#step-4').show();

    <?php }elseif($payment_status == 'cancel') { ?>
    		$('div.setup-panel div a#step4').trigger('click');
    <?php } ?>

    subType.change(function(){
    	var type = $(this).val();

    	if( type == 'trial' ){
    		$(".discounted-price").hide();
    		$(".trial-price").show();
    	}else{
    		$(".discounted-price").show();
    		$(".trial-price").hide();
    	}
    });

    $(".btn-use-offer-code").click(function(){
    	var url = base_url + 'registration/_use_offer_code';
    	//var aut_msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'assets/img/spinner.gif" /> Verifiying code...</div>';

    	//$("#modalVerifyOfferCode").modal("show");
    	//$("#modalVerifyOfferCode .modal-body").html(aut_msg);

		$.ajax({
			type: "POST",
			url: url,
			dataType: "json",
			data: $("#subscribe-form-payment").serialize(),
			success: function(o)
			{	
				$(".btn-use-offer-code").html('Use Code');
				if( o.is_valid ){
					Swal.fire({
						title: 'Registration Completed!',
						text: 'You can now login to your account',
						icon: 'success',
						showCancelButton: false,
						confirmButtonColor: '#32243d',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Login'
					}).then((result) => {
						//if (result.value) {
							window.location.href= base_url + 'login';
						//}
					});
					var msg = "<div class='alert alert-success'><p>"+o.msg+"</p></div>";
				}else{
					Swal.fire({
					icon: 'error',
					html: '<center>'+ o.msg +'</center>',
					text: o.msg
					});
				}

				if( !o.is_captcha_valid ){
					grecaptcha.reset();
				}
			},
			beforeSend: function(){
				$(".btn-use-offer-code").html('Validating code');
			}
		});
    });


    //Stripe
    var handler = StripeCheckout.configure({
		key: '<?= STRIPE_PUBLISH_KEY; ?>',
		image: '',
		token: function(token) {
			$("#payment-method").val('stripe');
            $("#payment-method-status").val('COMPLETED');
            activate_registration();   
			/*$("#stripeToken").val(token.id);
			$("#stripeEmail").val(token.email);
			$("#amountInCents").val(Math.floor($("#amountInDollars").val() * 100));
			$("#myForm").submit();*/

		}
	});

	$('#stripe-button').on('click', function(e) {
	var amountInCents = Math.floor($("#plan_price_discounted").val() * 100);
	var displayAmount = parseFloat(Math.floor($("#plan_price_discounted").val() * 100) / 100).toFixed(2);
	// Open Checkout with further options
	handler.open({
		name: 'nSmarTrac',
		description: 'Subscription amount ($' + displayAmount + ')',
		amount: amountInCents,
	});
	e.preventDefault();
	});

	// Close Checkout on page navigation
	$(window).on('popstate', function() {
	handler.close();
	});

	//Converge payment
	$("#converge-button").click(function(){
		//initiateLightbox();
		var total_amount = $("#plan_price_discounted").val();
		$("#plan_amount").val(total_amount);
		$("#modal-converge-subscribe").modal('show');
	});

	function initiateLightbox () {
	  var job_id = $("#jobid").val();
	  var total_amount = $("#plan_price_discounted").val();
	  var firstname = $("#firstname").val();
	  var lastname  = $("#lastname").val();
	  var business_address   = $("#business_address").val();
	  var zip_code = $("#zip_code").val();

	  var url = base_url + 'registration/_converge_request_token';
	  $("#converge-button").html('<span class="spinner-border spinner-border-sm m-0"></span>');
	  setTimeout(function () {
	    $.ajax({
	       type: "POST",
	       url: url,
	       dataType: "json",
	       data: {firstname:firstname, lastname:lastname, business_address:business_address, zip_code:zip_code, total_amount:total_amount},
	       success: function(o)
	       {
	          if( o.is_success ){
	              openLightbox(o.token)
	          }else{
	            Swal.fire({
	              icon: 'error',
	              title: 'Cannot Process Payment',
	              text: o.msg
	            });
	          }

	          $("#converge-button").html('PAY VIA CONVERGE');
	       }
	    });
	  }, 500);
	}

	function openLightbox (token) {
	  var paymentFields = {
	          ssl_txn_auth_token: token
	  };
	  var callback = {
	      onError: function (error) {
	          //showResult("error", error);
	          Swal.fire({
	            icon: 'error',
	            title: 'Error',
	            text: error
	          });
	      },
	      onCancelled: function () {
	          //showResult("cancelled", "");
	      },
	      onDeclined: function (response) {
	        Swal.fire({
	          icon: 'error',
	          title: 'Declined',
	          text: 'Please check your entries and try again'
	        });
	        //showResult("declined", JSON.stringify(response, null, '\t'));
	      },
	      onApproval: function (response) {	          
	          $("#payment-method").val('converge');
	          $("#payment-method-status").val('COMPLETED');
	          activate_registration();
	          //showResult("approval", JSON.stringify(response, null, '\t'));
	      }
	  };
	  PayWithConverge.open(paymentFields, callback);
	  return false;
	}


	//Paypal
	// Render the PayPal button into #paypal-button-container
    paypal.Buttons({
    	style: {
            layout: 'horizontal',
            tagline: false,
            //height:25,
            color:'blue'
        },
        // Set up the transaction
        createOrder: function(data, actions) {
            return actions.order.create({
            	payer: {
					name: {
					  given_name: $("#firstname").val() + " " + $("#lastname").val()
					},
					email_address: $("#email_address").val(),
				},
                purchase_units: [{
                    amount: {
                        value: $("#plan_price_discounted").val()
                    }
                }],
                application_context: {
			    	shipping_preference: 'NO_SHIPPING'
			    }
            });
        },
        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Show a success message to the buyer
                //console.log(details);
                $("#payment-method").val('paypal');
                $("#payment-method-status").val(details.status);
                activate_registration();                
            });
        }
    }).render('#paypal-button-container');

    function activate_registration(){
    	$(".payment-method-container").hide();
        var url = base_url + 'registration/_create_registration';
        $.ajax({
			type: "POST",
			url: url,
			dataType: "json",
			data: $("#subscribe-form-payment").serialize(),
			success: function(o)
			{	
				if( o.is_success ){
					Swal.fire({
						title: 'Registration Completed!',
						text: 'You can now login to your account',
						icon: 'success',
						showCancelButton: false,
						confirmButtonColor: '#32243d',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Login'
					}).then((result) => {
						if (result.value) {
							window.location.href= base_url + 'login';
						}
					});
				}else{
					Swal.fire({
						icon: 'error',
						title: 'Registration Error',
						html: '<center>' + o.msg + '</center>'
					});
				}
				
			}
		});
    }

	$('.business-phone').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });
});
</script>
