<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
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
    background: #64477d !important;
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
	width:32%;
  margin-bottom:40px;
}
h3.plan-list-text {
  font-size: 19px !important;
  font-weight: 400;
}
p.plan-list-price {
  font-size: 25px;
  margin-top: 10px;
  margin-bottom: 17px;
  font-weight: 700;
  font-family: "Avenir Next LT Pro","Avenir Next",Futura,sans-serif !important;
}
@media only screen and (max-width: 700px) {
  .plan-list li {
      display: inline-block;
      width: 100%;
      margin-bottom: 40px;
  }
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
						    <!-- Stepper -->
						    <div class="steps-form">
						      <div class="steps-row setup-panel">
						        <div class="steps-step">
						          <a href="#step-1" id="step1" type="button" class="btn reg-sc btn-indigo btn-circle">1</a>
						          <p>Step 1</p>
						        </div>
						        <div class="steps-step">
						          <a href="#step-2" id="step2" type="button" class="btn reg-sc btn-default btn-circle" disabled="disabled">2</a>
						          <p>Step 2</p>
						        </div>
						        <div class="steps-step">
						          <a href="#step-3" id="step3" type="button" class="btn reg-sc btn-default btn-circle" disabled="disabled">3</a>
						          <p>Step 3</p>
						        </div>
						        <div class="steps-step">
						          <a href="#step-4" id="step4" type="button" class="btn reg-sc btn-default btn-circle" disabled="disabled">4</a>
						          <p>Step 4</p>
						        </div>
						      </div>
						    </div>

						    	<?php echo form_open_multipart('register/subscribe', [ 'class' => 'form-validate subscribe-form-payment', 'id' => 'subscribe-form-payment', 'autocomplete' => 'off' ]); ?>
						      	<input type="hidden" name="plan_id" id="plan_id" value="">
					            <input type="hidden" name="plan_price" id="plan_price" value="">
					            <input type="hidden" name="plan_name" id="plan_name" value="">
						      	<!-- First Step -->
						      	<div class="row setup-content" id="step-1">
							        <div class="col-md-12">
		                      			<div class="reg-s1">
		  						          <h4 class="font-weight-bold pl-0 my-4 sc-pl-2"><strong>Step 1 : Select Plan</strong></h4>
		  						          <ul class="plan-list">
		  						          <?php foreach($ns_plans as $p){ ?>
		  						          	<li>
		  						          		<h3 class="plan-list-text"><?= $p->plan_name; ?></h3>
		  						          		
		  						          		<?php if($p->plan_name != 'Industry Specific') { ?>
		  						          			<p class="plan-list-price">$<?= number_format($p->price, 2); ?></p>
		  						          			<a class="btn btn-info step2-btn" href="javascript:void(0);" data-id="<?= $p->nsmart_plans_id; ?>" data-plan="<?= $p->plan_name; ?>" data-price="<?= $p->price; ?>">Select Plan</a>
		  						          		<?php } else { ?>
		  						          			<p style="font-size: 14px !important;" class="plan-list-price">for demo & other info.</p>
		  						          			<a class="btn btn-info" href="<?php echo url('/contact') ?>">Contact Us</a>
		  						          		<?php } ?>
		  						          	</li>
		  						          <?php } ?>
		  						      	  </ul>
		                      			</div>
							        </div>
						      	</div>

						      	<!-- Second Step -->
						      	<div class="row setup-content" id="step-2">
							        <div class="col-md-12">
							          	<h4 class="font-weight-bold pl-0 my-4 sc-pl-2"><strong>Step 2 : Personal Information</strong></h4>
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
												<select class="reg-select z-100" id="number_of_employee" name="number_of_employee">
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
												<select class="reg-select z-100 cmb-industry" id="industry" name="industry">
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
	                      			<div class="pl-3 pr-3">
	  						          	<button class="reg-wbtn btn btn-indigo btn-rounded prevBtn float-left" type="button">Previous</button>
	  						          	<button class="reg-wbtn btn btn-indigo btn-rounded nextBtn float-right" type="button">Next</button>
	                      			</div>
							        </div>
						      	</div>

						      	<!-- Third Step -->
						      	<div class="row setup-content" id="step-3">
							        <div class="col-md-12">
							          <h3 class="font-weight-bold pl-0 my-4"><strong>Step 3 : Payment Method</strong></h3>
							          <div class="payment-method" style="display: block;margin-bottom: 74px;">
							          	<label>Plan : <b><span class="plan-selected"></span></b></label><br />
							          	<label>Total Amount : <b><span class="total-amount"></span></b></label><br />
							          	<hr />
							          	<p><b>Payment Method</b></p>
							          	<img src="<?php echo $url->assets ?>img/paypal-logo.png" alt="" style="height: 62px;">
							      	  </div>
							          <button class="btn btn-indigo btn-rounded prevBtn float-left" type="button">Previous</button>
							          <button type="submit" class="btn btn-default btn-rounded float-right step3-btn-processPayment">Process to Payment</button>
							        </div>
						      	</div>

						      	<!-- 4th Step -->
						      	<div class="row setup-content" id="step-4">
							        <div class="col-md-12">
							          <h3 class="font-weight-bold pl-0 my-4"><strong>Step 4 : Finish</strong></h3>
							          <p>Please add paypal success of cancel data here..</p>
							          <a class="btn btn-indigo btn-rounded float-left" href="<?php echo url('/login') ?>">Login to your account</a>
							        </div>
						      	</div>

						      	<?php echo form_close(); ?>

						  </div>
						</div>
						<!-- Steps form -->

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
	var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn'),
        allPrevBtn = $('.prevBtn'),
        step2bBtn  = $('.step2-btn');
        step3bBtnPrcPayment = $('.step3-btn-processPayment');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-indigo').addClass('btn-default');
            $item.addClass('btn-indigo');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allPrevBtn.click(function(){
        var curStep = $(this).closest(".setup-content");
        var curStepBtn = curStep.attr("id");
        var prevStepSteps = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

        prevStepSteps.removeAttr('disabled').trigger('click');
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content");
        var curStepBtn = curStep.attr("id");
        var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");
        var curInputs = curStep.find("input[type='text'],input[type='url']");
        var isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i< curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    step2bBtn.click(function(){
    	var plan_id = $(this).attr("data-id");
    	var plan_price = $(this).attr("data-price");
    	var plan_name  = $(this).attr("data-plan");
    	var curStep = $(this).closest(".setup-content");
    	var curStepBtn    = curStep.attr("id");
    	var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");

    	$("#plan_id").val(plan_id);
    	$("#plan_price").val(plan_price);
        $("#plan_name").val(plan_name);
    	$(".plan-selected").text(plan_name);
    	$(".total-amount").text(plan_price);

    	nextStepWizard.removeAttr('disabled').trigger('click');
    });

    step3bBtnPrcPayment.click(function(){
    	$( "#subscribe-form-payment" ).submit();
   	});

    $('div.setup-panel div a.btn-indigo').trigger('click');

    <?php if($payment_status == 'success') { ?>
    		$('div.setup-panel div a#step4').trigger('click');
    <?php }elseif($payment_status == 'cancel') { ?>
    		$('div.setup-panel div a#step4').trigger('click');
    <?php } ?>
});
</script>
