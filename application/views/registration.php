<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<script src="https://js.stripe.com/v3/"></script>
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
	    background-color: #3f51b5 !important;
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
		margin-bottom: 10px;
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
							      	<input type="hidden" name="plan_id" id="plan_id" value="">
						            <input type="hidden" name="plan_price" id="plan_price" value="">
						            <input type="hidden" name="plan_price_discounted" id="plan_price_discounted" value="">
						            <input type="hidden" name="plan_name" id="plan_name" value="">
							      	<!-- First Step -->
							      	<div class="row setup-content" id="step-1">
								        <div class="col-md-12">
			                      			<?php if($ip_exist== false){ ?>
				                      			<div class="reg-s1">
				  						          <h4 class="font-weight-bold pl-0 my-4 sc-pl-2"><strong>Step 1 : Select Plan</strong></h4>
				  						          <select name="subscription_type" id="subscription_type" class="form-control-dr subscription-type" style="width: 100%;margin: 33px auto;max-width: 380px;">
				  						          	<option value="prospect">3 months 50% off</option>
				  						          	<option value="trial">Free Trial (30 Days)</option>
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
				  						          			<a class="btn btn-info step2-btn" href="javascript:void(0);" data-id="<?= $p->nsmart_plans_id; ?>" data-plan="<?= $p->plan_name; ?>" data-price="<?= $p->price; ?>" data-price-discounted="<?= $p->discount; ?>">Select Plan</a>
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
								          	<div class="step-2-error-msg"></div>
								          	<div class="col-md-6 float-left z-100">
												<div class="input-group z-100">
													<input autocomplete="off" type="text" name="firstname" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="First Name" required="">
												</div>
											</div>


											<div class="col-md-6 float-left z-100">
												<div class="input-group z-100">
													<input autocomplete="off" type="text" name="lastname" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Last Name" required="">
												</div>
											</div>

											<div class="col-md-6 float-left">
												<div class="input-group z-100">
													<input autocomplete="off" type="email" name="email" id="email_address" class="email_address form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your email address" placeholder="Email address" required="">
												</div>
											</div>

											<div class="col-md-6 float-left">
												<div class="input-group z-100">
													<input autocomplete="off" type="number" name="phone" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Phone number">
												</div>
											</div>

											<div class="col-md-6 float-left">
												<div class="input-group z-100">
													<input id="google_search_place" type="text" name="business_name" class="business_name form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your Business Name" placeholder="Business Name" autocomplete="on" runat="server" required="" />
												</div>
											</div>

											<div class="col-md-6 float-left">
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

											<div class="col-md-12 float-left">
												<div class="input-group z-100">
													<input id="business_address" type="text" name="business_address" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your Business Address" placeholder="Business Address" required="" />
												</div>
											</div>

											<div class="col-md-6 float-left">
												<div class="input-group">
													<select class="reg-select z-100 cmb-industry" id="industry_type_id" name="industry_type_id" required="">
														<option>--Select your Industry--</option>
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

											<div class="col-md-12">
												<div id="ajax-authentication-alert-container"></div>
											</div>
		                      			<div class="pl-3 pr-3">
		  						          	<button class="reg-wbtn btn btn-indigo btn-rounded prevBtn float-left" data-key="step-1" type="button">Previous</button>
		  						          	<button class="reg-wbtn btn btn-indigo btn-rounded nextBtn float-right" data-key="step-3" type="button">Next</button>
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
								          	<p><b>Payment Method</b></p>
								          	<ul class="payment-method">
								          		<li>
								          			<input type="radio" id="paypal" name="payment_method" value="paypal">
								          			<img src="<?php echo $url->assets ?>img/paypal-logo.png" alt="" style="height: 62px;">
								          		</li>
								          		<li>
								          			<input type="radio" id="stripe" name="payment_method" value="stripe">
								          			<img src="<?php echo $url->assets ?>img/stripe-logo.png" alt="" style="height: 62px;">
								          		</li>
								          	</ul>	
								          	<hr />
								          	<!-- Grid row -->
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
											  <!-- Grid row -->

								      	  </div>
								          <button class="btn btn-indigo btn-rounded prevBtn float-left" data-key="step-2" type="button">Previous</button>
								          <button type="submit" class="btn btn-default btn-rounded float-right step3-btn-processPayment" data-key="step-4">Proceed to Payment</button>
								        </div>
							      	</div>

							      	<div class="stripe-form" style="display: none;">
							      		<div class="col-md-12">
							      			<h3 class="font-weight-bold pl-0 my-4"><strong>Step 3 : Stripe Payment Method</strong></h3>
									          <div class="payment-method" style="display: block;margin-bottom: 16px;">
									          	<label>Plan : <b><span class="plan-selected"></span> / <span class="plan-price"></span></b></label><br />
									          	<label>Total Amount : <b><span class="total-amount"></span></b></label><br />
									          	<hr />
									          </div>
											  <div id="card-element"></div>											  
											  <div id="card-errors" role="alert"></div>
											  <button class="stripe-btn">Submit Payment</button>`
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
						    <div class="modal-dialog modal-md">
						        <!-- Modal content-->
						        <div class="modal-content">
						            <div class="modal-header">
						                <h4 class="modal-title">Offer Code</h4>
						                <button type="button" class="close" data-dismiss="modal">&times;</button>
						            </div>
						            <div class="modal-body">
						                <p>Verifying code...</p>
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
</section>
<?php include viewPath('frontcommon/footer'); ?>
<script>
$(function(){
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

    allNextBtn.click(function(){

        var step = $(this).attr("data-key");
        var curStep = $(this).closest(".setup-content");
        var curStepBtn = curStep.attr("id");
        //var curInputs  = curStep.find("input[type='text'],input[type='email'],input[type='password']");

        var curInputs  = curStep.find("input[type='text'],input[type='email'],input[type='password']");
        var curInputEmail  = curStep.find("input[type='email']");
        console.log("Test Validation");
        console.log(curInputs);



        var isValid = true;
        var isValidEmail = true;

        var emailErrMsg = "";

        $(".form-group").removeClass("has-error");

        var req_inc = 0;
        for(var i=0; i< curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                req_inc++;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        for(var i=0; i< curInputEmail.length; i++){
            if (!curInputEmail[i].validity.valid){
                isValidEmail = false;
                emailErrMsg = "Please enter a correct email address";
            }
        }

        if( isValid ){
        	var firstname 			= $("input[name=firstname]").val();
        	var lastname 			= $("input[name=lastname]").val();
        	var phone 				= $("input[name=phone]").val();
        	var business_address 	= $("#business_address").val(); 
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
	               		a_email:a_email,
	               		a_bname:a_bname,
	               		firstname:firstname,
	               		lastname:lastname,
	               		phone:phone,
	               		business_address:business_address,
	               	},
	               success: function(o)
	               {
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
	               		} else {
	               			$("#ajax-authentication-alert-container").html('<div class="alert alert-info" role="alert">Your credential already register to our system, please try another.</div>');
	               		}
	                  	
	               }
	            });
	        }, 500);        	


        }else{
        	$("." + curStepBtn + "-error-msg").addClass("alert alert-danger");

        	if(req_inc == 1 && emailErrMsg != "") {
        		$("." + curStepBtn + "-error-msg").html(emailErrMsg);
        	} else {
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

    		//$("#plan_price").val(0);
    		/*step3Container.show(); 
    		$("span.step-3").addClass('btn-indigo');*/

    		step2Container.show();
	    	$("span.step-2").addClass('btn-indigo');

    	}else{
    		$(".total-amount").text("$" + plan_price_discounted  + " (3 months 50% off)");
    		step2Container.show();
	    	$("span.step-2").addClass('btn-indigo');
    	}


    });

    step3bBtnPrcPayment.click(function(e){
    	e.preventDefault();
    	var payment_method = $('input[name="payment_method"]:checked').val();    	    	
    	if( payment_method == 'paypal' ){
    		$( "#subscribe-form-payment" ).submit();
    	}else{
    		$("#step-3").hide();
    		$(".stripe-form").show();
    	}
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

    	$("#modalVerifyOfferCode").modal("show");

    	setTimeout(function () {
	        $.ajax({
	           type: "POST",
	           url: url,
	           dataType: "json",
	           data: $("#subscribe-form-payment").serialize(),
	           success: function(o)
	           {	
	           		if( o.is_valid ){
	           			var msg = "<div class='alert alert-success'><p>"+o.msg+"</p></div>";
	           		}else{
	           			var msg = "<div class='alert alert-danger'><p>"+o.msg+"</p></div>";	
	           		}

	           		$("#modalVerifyOfferCode .modal-body").html(msg);

	           		if( o.is_valid ){
	           			setTimeout(function () {
					        location.href = base_url + 'login';
					    }, 1500);  
	           		}
	           }
	        });
	    }, 500);  
    });


    // Create a Stripe client.
	var stripe = Stripe('pk_test_51Hzgs3IDqnMOqOtpSskepkfFhP2rFNJ0wTtuKB6Ye6wJA75uHL5rMOi7JwWajcag33ScyPywLTKMGNbgdsPxVJiG00kZxZnPNu');

	// Create an instance of Elements.
	var elements = stripe.elements();

	// Custom styling can be passed to options when creating an Element.
	// (Note that this demo uses a wider set of styles than the guide below.)
	var style = {
	  base: {
	    color: '#32325d',
	    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
	    fontSmoothing: 'antialiased',
	    fontSize: '16px',
	    '::placeholder': {
	      color: '#aab7c4'
	    }
	  },
	  invalid: {
	    color: '#fa755a',
	    iconColor: '#fa755a'
	  }
	};

	// Create an instance of the card Element.
	var card = elements.create('card', {style: style});

	// Add an instance of the card Element into the `card-element` <div>.
	card.mount('#card-element');

	// Handle real-time validation errors from the card Element.
	card.on('change', function(event) {
	  var displayError = document.getElementById('card-errors');
	  if (event.error) {
	    displayError.textContent = event.error.message;
	  } else {
	    displayError.textContent = '';
	  }
	});

	// Handle form submission.
	var form = document.getElementById('subscribe-form-payment');
	form.addEventListener('submit', function(event) {
	  event.preventDefault();

	  stripe.createToken(card).then(function(result) {
	    if (result.error) {
	      // Inform the user if there was an error.
	      var errorElement = document.getElementById('card-errors');
	      errorElement.textContent = result.error.message;
	    } else {
	      // Send the token to your server.
	      stripeTokenHandler(result.token);
	    }
	  });
	});

	// Submit the form with the token ID.
	function stripeTokenHandler(token) {
	  // Insert the token ID into the form so it gets submitted to the server
	  var form = document.getElementById('subscribe-form-payment');
	  var hiddenInput = document.createElement('input');
	  hiddenInput.setAttribute('type', 'hidden');
	  hiddenInput.setAttribute('name', 'stripeToken');
	  hiddenInput.setAttribute('value', token.id);
	  form.appendChild(hiddenInput);

	  // Submit the form
	  form.submit();
	}
});
</script>
