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
	
});
</script>
