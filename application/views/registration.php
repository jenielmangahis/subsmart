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

						    	<?php echo form_open_multipart('register/subscribe', [ 'class' => 'form-validate subscribe-form-payment', 'id' => 'subscribe-form-payment', 'autocomplete' => 'off' ]); ?>
						      	<input type="hidden" name="plan_id" id="plan_id" value="">
					            <input type="hidden" name="plan_price" id="plan_price" value="">
					            <input type="hidden" name="plan_name" id="plan_name" value="">
						      	<!-- First Step -->
						      	<div class="row setup-content" id="step-1">
							        <div class="col-md-12">
		                      			<div class="reg-s1">
		  						          <h4 class="font-weight-bold pl-0 my-4 sc-pl-2"><strong>Step 1 : Select Plan</strong></h4>
		  						          <select class="form-control-dr subscription-type" style="width: 100%;margin: 33px auto;max-width: 380px;">
		  						          	<option value="prospect">3 months 50% off</option>
		  						          	<option value="trial">Free Trial</option>
		  						          </select>
		  						          <ul class="plan-list">
		  						          <?php foreach($ns_plans as $p){ ?>
		  						          	<li>
		  						          		<h3 class="plan-list-text"><?= $p->plan_name; ?></h3>

		  						          		<?php if($p->plan_name != 'Industry Specific') { ?>
			  						          		<div class="discounted-price">
			  						          			<p class="plan-list-price" style="text-decoration: line-through;font-size:18px;color: #ffe215;">$<?= number_format($p->price, 2); ?></p>
			  						          			<?php
			  						          				$discount_price = $p->price / 2;
			  						          			?>
			  						          			<p class="plan-list-price">$<?= number_format($discount_price, 2); ?> /mo</p>
			  						          		</div>
			  						          		<div class="trial-price" style="display: none;">
			  						          			<p class="plan-list-price">$<?= number_format($p->price, 2); ?> /mo</p>
			  						          		</div>
		  						          			<br />
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
												<select class="reg-select z-100 cmb-industry" id="industry" name="industry" required="">
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
							          	<img src="<?php echo $url->assets ?>img/paypal-logo.png" alt="" style="height: 62px;">
							      	  </div>
							          <button class="btn btn-indigo btn-rounded prevBtn float-left" data-key="step-2" type="button">Previous</button>
							          <button type="submit" class="btn btn-default btn-rounded float-right step3-btn-processPayment" data-key="step-4">Process to Payment</button>
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
        var curInputs  = curStep.find("input[type='text'],input[type='email'],input[type='password']");
        var isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i< curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if( isValid ){
	        $("span." + curStepBtn).removeClass("btn-indigo");
	        $("span." + curStepBtn).addClass("btn-default");
	        $("span." + step).addClass("btn-indigo");
	        $("#" + step).show();
	        $("#" + curStepBtn).hide();
	        $("." + curStepBtn + "-error-msg").removeClass("alert alert-danger");
	        $("." + curStepBtn + "-error-msg").html("");
        }else{
        	$("." + curStepBtn + "-error-msg").addClass("alert alert-danger");
        	$("." + curStepBtn + "-error-msg").html("Cannot empty required fields");
        }
    });

    step2bBtn.click(function(){
    	var plan_id = $(this).attr("data-id");
    	var plan_price = $(this).attr("data-price");
    	var price_discount = (plan_price * 3) / 2;
    	var plan_name  = $(this).attr("data-plan");
    	var subscription_type = $(".subscription-type").val();

    	$("#plan_id").val(plan_id);
    	$("#plan_price").val(price_discount);
        $("#plan_name").val(plan_name);
    	$(".plan-selected").text(plan_name);
    	$(".plan-price").text("$" + plan_price);

    	step1Container.hide();

    	$("span.step-1").removeClass('btn-indigo');
	    $("span.step-1").addClass("btn-default");

    	if( subscription_type == 'trial' ){
    		$(".total-amount").text("0.00 (Free Trial)");
    		$("#plan_price").val(0);
    		step3Container.show();
    		$("span.step-3").addClass('btn-indigo');
    	}else{
    		$(".total-amount").text("$" + price_discount  + " (3 months 50% off)");
    		step2Container.show();
	    	$("span.step-2").addClass('btn-indigo');
    	}


    });

    step3bBtnPrcPayment.click(function(){
    	$( "#subscribe-form-payment" ).submit();
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
});
</script>
