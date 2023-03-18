<style>
.stepper-wrapper {
  font-family: Arial;
  margin-top: 50px;
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.stepper-item {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;

  @media (max-width: 768px) {
    font-size: 12px;
  }
}

.stepper-item::before {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: -50%;
  z-index: 2;
}

.stepper-item::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 2;
}

.stepper-item .step-counter {
  position: relative;
  z-index: 5;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #ccc;
  margin-bottom: 6px;
}

.stepper-item.active {
  font-weight: bold;
}

.stepper-item.completed .step-counter {
  background-color: #4bb543;
}

.stepper-item.completed::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #4bb543;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 3;
}

.stepper-item:first-child::before {
  content: none;
}
.stepper-item:last-child::after {
  content: none;
}

.center {
  padding: 70px 0;
  border: 3px solid green;
  text-align: center;
}

/* Latest compiled and minified CSS included as External Resource*/

/* Optional theme */

/*@import url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css');*/
/* body {
    margin-top:30px;
} */
.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}

/* #regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
} */

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}

.switch {
	position: relative;
	display: block;
	vertical-align: top;
	width: 100px;
	height: 30px;
	padding: 3px;
	margin: 0 10px 10px 0;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
	border-radius: 18px;
	box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
	cursor: pointer;
}
.switch-input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
}
.switch-label {
	position: relative;
	display: block;
	height: inherit;
	font-size: 10px;
	text-transform: uppercase;
	background: #eceeef;
	border-radius: inherit;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
}
.switch-label:before, .switch-label:after {
	position: absolute;
	top: 50%;
	margin-top: -.5em;
	line-height: 1;
	-webkit-transition: inherit;
	-moz-transition: inherit;
	-o-transition: inherit;
	transition: inherit;
}
.switch-label:before {
	content: attr(data-off);
	right: 11px;
	color: #aaaaaa;
	text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
	content: attr(data-on);
	left: 11px;
	color: #FFFFFF;
	text-shadow: 0 1px rgba(0, 0, 0, 0.2);
	opacity: 0;
}
.switch-input:checked ~ .switch-label {
	background: #4bb543;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
	opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
	opacity: 1;
}
.switch-handle {
	position: absolute;
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
	background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
	border-radius: 100%;
	box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
	content: "";
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -6px 0 0 -6px;
	width: 12px;
	height: 12px;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
	border-radius: 6px;
	box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
	left: 74px;
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
	transition: All 0.3s ease;
	-webkit-transition: All 0.3s ease;
	-moz-transition: All 0.3s ease;
	-o-transition: All 0.3s ease;
}

@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400);

.font-roboto {
  font-family: 'roboto condensed';
}

/* .modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  overflow: hidden;
}

.modal-dialog {
  position: fixed;
  margin: 0;
  width: 100%;
  height: 100%;
  padding: 0;
} */

/* .modal-content {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  border: 2px solid #3c7dcf;
  border-radius: 0;
  box-shadow: none;
} */

/* .modal-header {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  height: 50px;
  padding: 10px;
  background: #ffffff;
  border: 0;
} */

.modal-title {
  font-weight: 300;
  font-size: 2em;
  color: #fff;
  line-height: 30px;
}

.modal-body {
  position: absolute;
  /* top: 50px; */
  /* bottom: 60px; */
  width: 100%;
  font-weight: 300;
  overflow: auto;
}

/* .modal-footer {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  height: 60px;
  padding: 10px;
  background: #f1f3f5;
} */

/* .btn {
  height: 40px;
  border-radius: 0;

} */

.btn-modal {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -20px;
  margin-left: -100px;
  width: 200px;
}

.btn-primary,
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active {
  font-weight: 300;
  font-size: 1.6rem;
  color: #fff;
  color: lighten(#484b5b, 20%);
  color: #fff;
  text-align: center;
  background: #60cc69;
  border: 1px solid #36a940;
  border-bottom: 3px solid #36a940;
  box-shadow: 0 2px 4px rgba(0,0,0,0.15);

}

.btn-default,
.btn-default:hover,
.btn-default:focus,
.btn-default:active {
  font-weight: 300;
  font-size: 1.6rem;
  color: #fff;
  text-align: center;
  background: darken(#dcdfe4, 10%);
  border: 1px solid darken(#dcdfe4, 20%);
  border-bottom: 3px solid darken(#dcdfe4, 20%);

}

.btn-secondary,
.btn-secondary:hover,
.btn-secondary:focus,
.btn-secondary:active {
  color: #cc7272;
  background: transparent;
  border: 0;
}

h1,
h2,
h3 {
  color: #60cc69;
  line-height: 1.5;


}

p {
  font-size: 1.4em;
  line-height: 1.5;
  color: lighten(#5f6377, 20%);

}

::-webkit-scrollbar {
  -webkit-appearance: none;
  width: 10px;
  background: #f1f3f5;
  border-left: 1px solid darken(#f1f3f5, 10%);
}

::-webkit-scrollbar-thumb {
  background: darken(#f1f3f5, 20%);
}

/* .container {
  width: 25%;
} */

.step2 {
  
  padding: 10px;
  
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  
  background-color: cream;
}

.v-stepper {
  position: relative;
/*   visibility: visible; */
}


/* regular step */
.step2 .circle {
  background-color: white;
  border: 3px solid gray;
  border-radius: 100%;
  width: 20px;    /* +6 for border */
  height: 20px;
  display: inline-block;
}

.step2 .line {
    top: 20px;
  left: 8px;
/*   height: 120px; */
  height: 100%;
    
    position: absolute;
    border-left: 3px solid gray;
}

.step2.completed .circle {
  visibility: visible;
  background-color: #1b9404;
  border-color:#1b9404;
}

.step2.completed .line {
  border-left: 3px solid #1b9404;
}

.step2.active .circle {
visibility: visible;
  border-color:#1b9404;
}

.step2.empty .circle {
    visibility: hidden;
}

.step2.empty .line {
/*     visibility: hidden; */
/*   height: 150%; */
  top: 0;
  height: 150%;
}


.step2:last-child .line {
  border-left: 3px solid white;
  z-index: -1; /* behind the circle to completely hide */
}

/* .content {
  margin-left: 20px;
  display: inline-block;
} */


</style>
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <div class="wrapper accounting-payroll" role="wrapper" >
	
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
        <!-- page wrapper start -->
           <div wrapper__section>
        <div class="container-fluid">
			<div class="page-title-box mx-4">
					<div>
						<h3>Workers' Comp</h3>
					</div>
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
					It's the law in every state except Texas. Take care of your employees if they get hurt on the job and protect your business from lawsuits and penalties.
                    </div>
					<br>
				<div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
						<a href="<?php echo url('/accounting/employees')?>" class="banking-tab">Employees</a>
						<a href="<?php echo url('/accounting/contractors')?>" class="banking-tab">Contractors</a>
						<a href="<?php echo url('/accounting/workers-comp')?>" class="banking-tab-active text-decoration-none">Worker's Comp</a>
						<a href="#" class="banking-tab">Benefits</a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12">
						<h1>49 states require workers' comp insurance</h1>
						<!-- <h5 class="font-weight-normal">It's the law in every state except Texas. Take care of your employees if they get hurt on<br>the job and protect your business from lawsuits and penalties.</h5> -->
					</div>
				</div>
				<div class="row pt-3 align-items-center">
					<div class="col-sm-3 col-xs-12">
						<p class="mb-0 text-center"><img src="<?php echo base_url();?>assets/img/accounting/computer_2.png" class="img-responsive max-85" /></p>
					</div>
					<div class="col-sm-9 col-xs-12">
						<ul class="list-unstyled">
							<li class="h5 font-weight-normal pt-2"><span class="fa fa-check text-success pr-3"></span>Get a quick online quote from our partner, AP Intego</li>
							<li class="h5 font-weight-normal pt-2"><span class="fa fa-check text-success pr-3"></span>Automatically pay what you owe when you run payroll</li>
							<li class="h5 font-weight-normal pt-2"><span class="fa fa-check text-success pr-3"></span>Manage workers' comp and payroll right in nSmarTrac</li>
						</ul>
						<a href="#" class="btn btn-success rounded-20 px-3 py-0" data-toggle="modal" data-target=".getQuote"><h5>Get a quote</h5></a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12">
						<h3>Already have a workers' comp policy?</h3>
						<h5 class="font-weight-normal">Connect your policy to nSmarTrac and reap the benefits of simplification.</h5>
						<a href="<?= base_url('accounting/connect_policy') ?>" class="btn btn-default rounded-20 px-3 py-0 mt-3" ><h5>Connect my policy</h5></a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12">
						<hr>
						<p class="pt-3">By selecting Get a quoteor Connect my policy, you agree for nSmarTrac to <a href="#">share your data</a> with our partner, AP Intego. Their use of your data is subject to their <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a></p>
						<p>The information on this and related pages is provided to you by Intuit Insurance Services Inc. and AP Intego. <a href="#">View Licenses</a></p>
					</div>
				</div>
            <!-- end row -->
			</div>
        </div>
        <!-- end container-fluid -->
    </div>
	  <!-- page wrapper end -->
    </div>

	<div class="modal fade getQuote_" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-header">
                <h4 class="modal-title">Record Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
			<div class="modal-content">
			...
			</div>
		</div>
	</div>

	<div class="modal in getQuote" id="" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body" style="background-color:white;">
					<!-- <div class="container">
						<ul class="progressbar">
							<li class="active">login</li>
							<li>choose interest</li>
							<li>add friends</li>
							<li>View map</li>
						</ul>
					</div> -->
                    <!-- <div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size:24px;">X</span>
                        </button>
                    </div> -->
                    <div style="width:65%;margin:0 20% 0 20%;">
                        <div class="row">
                            <div class="col-md-6">
                              <img src="<?= getCompanyBusinessProfileImage(); ?>" class="invoice-print-logo"  style="max-width: 230px; max-height: 200px;" />
                            </div>
                            <div class="col-md-6">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="float:right;">
                                  <span aria-hidden="true" style="font-size:24px;">X</span>
                              </button>
                            </div>
                        </div>
                    </div>

                    <div class="stepper-wrapper" style="margin:0 10% 0 10%;width:80%;">
                      <div class="stepper-item completed">
                        <div class="step-counter">1</div>
                        <div class="step-name">Get started</div>
                      </div>
                      <div class="stepper-item ">
                        <div class="step-counter">2</div>
                        <div class="step-name">Details</div>
                      </div>
                      <div class="stepper-item ">
                        <div class="step-counter">3</div>
                        <div class="step-name">Quote</div>
                      </div>
                    </div>
                    
					          <form id="regForm" action="<?php echo site_url('accounting/addQuote');?>">
                    <?php //echo form_open_multipart('accounting/addInvoice', ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>
                        <!-- One "tab" for each step in the form: -->
                        <div class="tab"><br>
                            <!-- <p><input placeholder="First name..." oninput="this.className = ''" name="fname"></p>
                            <p><input placeholder="Last name..." oninput="this.className = ''" name="lname"></p> -->
                            
                            <div style="padding:3%;border: solid gray 1px;width:60%;margin:0 20% 0 20%;">
                                <h4>Your business</h4>
                                <p>Finding the right classification for your business ensures that your quote will be as accurate as possible. But don't worry if you don't find an exact match – an agent will review this before anything is finalized.</p>

                                <h6><br>General industry</h6>
                                <select class="form-control" name="general_industry">
                                    <option value="">Select General industry</option>
                                    <option value="1">Advertising, Graphic Design, Photography and Printing</option>
                                    <option value="2">Agriculture, Forestry, Fishing and Hunting</option>
                                    <option value="3">Arts, Entertainment and Recreation</option>
                                    <option value="4">Communications, Electric or Gas Service</option>
                                    <option value="5">Educational and Social Services</option>
                                    <option value="6">Health Care, Social Assistance and Public Administration</option>
                                    <option value="7">Legal, Finance, Insurance and Real Estate</option>
                                    <option value="8">Manufacturing</option>
                                    <option value="9">Membership, Religious and Fraternal Organizations</option>
                                    <option value="10">Personal and Business Services</option>
                                    <option value="11">Restaurants and Lodging</option>
                                    <option value="12">Retail Trade - Nonstore</option>
                                    <option value="13">Retail Trade - Storefront</option>
                                    <option value="14">Specialty Trade Contractors</option>
                                    <option value="15">Technology, Engineering and Consulting</option>
                                    <option value="16">Transportation & Warehousing</option>
                                    <option value="17">Wholesale Trade</option>
                                    <!-- <option></option> -->
                                </select>

                                <h6><br>Type of business</h6>
                                <select class="form-control" name="type_of_business">
                                    <option value="">Select type of business</option>
                                    <option value="1">Apparel, Piece Goods and Notions</option>
                                    <option value="2">Beer, Wine and Distilled Alcoholic Beverages</option>
                                    <option value="3">Chemicals and Allied Products</option>
                                    <option value="4">Drugs, Drug Proprietaries and Druggists' Sundries</option>
                                    <option value="5">Electrical Goods</option>
                                    <option value="6">Furniture and Home furnishings</option>
                                    <option value="7">Groceries and Related Products</option>
                                </select>

                                <h6><br>Standard industry classification (SIC)</h6>
                                <select class="form-control" name="classification">
                                    <option value="">Select Standard industry classification</option>
                                    <option value="1">Confectionery</option>
                                    <option value="2">Dairy Products, Except Dried Or Canned</option>
                                    <option value="3">Fish and Seafoods</option>
                                    <option value="4">Fresh Fruits and Vegetables</option>
                                    <option value="5">Groceries and Related Products, Not Elsewhere Classified</option>
                                    <option value="6">Groceries, General Line</option>
                                    <option value="7">Meats and Meat Products</option>
                                    <option value="8">Meats and Meat Products (with butchering or slaughtering)</option>
                                    <option value="9">Packaged Frozen Foods</option>
                                    <option value="10">Poultry and Poultry Products</option>
                                    <!-- <option></option> -->
                                </select>

                                <h6><br>Business name</h6>
                                <input type="text" class="form-control" name="business_name">

                                <h6><br>Principal business address</h6>
                                <input type="text" class="form-control"  name="business_address">
                                
                                <h6><br>Suite/Floor</h6>
                                <input type="text" class="form-control" style="width:30%;" name="suite">

                                <h6><br>Year business started</h6>
                                <select class="form-control" id="year" style="width:40%;" name="year_started">
                                    <option></option>
                                </select>

                                <h6><br>Legal entity type</h6>
                                <select class="form-control" name="legal_entity_type">
                                    <option>Corporation</option>
                                    <option>Limited Liability Company</option>
                                    <option>Non-Profit</option>
                                    <option>Partnership</option>
                                    <option>Sole Proprietor</option>
                                    <option>Other</option>
                                </select>

                                <h6><br>Federal Identification Number (optional)</h6>
                                <input type="text" class="form-control" style="width:40%;" name="federal_identification_number">
                                <br><br>
                                <!-- <input type="submit" value="Next" class="btn btn-success" style="float:right; margin:2px;"> -->

                            </div>
                        </div>
                        <div class="tab"><br>
                            <!-- <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
                            <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p> -->
                            <div style="padding:3%;border: solid gray 1px;width:60%;margin:0 20% 0 20%;">
                                <h4>Your owners, officers, and employees</h4>
                                <p>List all owners/officers and W-2 employees. In most cases, owners and officers may be excluded from a workers' comp policy, but this varies from state to state. Learn more</p>

                                <table class="table">
                                    <thead>
                                        <th>NAME</th>
                                        <th>CLASS CODE</th>
                                        <th>ROLE</th>
                                        <th>OWNERSHIP</th>
                                    </thead>
                                    <tbody id="employeesTable">
                                    </tbody>
                                </table>
                                <br>
                                <a class="link-modal-open" href="#" id="" data-toggle="modal" data-target="#employee_list">Add new employee or owner</a>
                                <br>
                                <h6><br>Total estimated annual payroll</h6>
                                <input type="text" class="form-control" name="total_est_annual_payroll">

                                <h6><br>Payroll frequency</h6>
                                <select class="form-control" name="payroll_frequency">
                                    <option value="Weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Biweekly">Biweekly</option>
                                </select>

                            </div>
                        </div>
                        <div class="tab"><br>
                            <!-- <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
                            <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p> -->
                            <div style="padding:3%;border: solid gray 1px;width:60%;margin:0 20% 0 20%;">
                            <h4>A few more details about your business</h4>
                            <p>Answer these questions to help us get a better picture of your business</p><br>

                            <table>
                                <tr>
                                    <td><label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_01" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>Does the business have any 1099 workers?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_02" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td> Do you have certificates of insurance for all 1099 employees?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_03" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>Has the business had any workers' comp claims in the past 3 years?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_04" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>Work performed underground or above 15 feet?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_05" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>Any group transportation provided?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_06" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>Any seasonal employees?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_07" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>Do employees travel out of state?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_08" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>I/they have had a business insurance policy cancelled or non-renewed in the past 3 years.</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_09" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>Labor interchange with other business/subsidiary?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_10" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>Do any employees predominantly work at home?</td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="switch">
                                        <input class="switch-input" id="switch-input" name="check_11" type="checkbox" />
                                        <span class="switch-label" data-on="Yes" data-off="No"></span> 
                                        <span class="switch-handle"></span> 
                                    </label></td>
                                    <td>I/they have filed for bankruptcy in the past 5 years.</td>
                                </tr>
                            </table>

                            </div>
                        </div>
                        <div class="tab"><br>
                            <!-- <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
                            <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p> -->
                            <div style="padding:3%;border: solid gray 1px;width:60%;margin:0 20% 0 20%;">
                                <h4>Is this contact info up to date?</h4>
                                <p>Let our insurance partner, AP Intego, know how to reach you to discuss and finalize your quote.</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>First name</h6>
                                        <input type="text" class="form-control" name="first_name">
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Last name</h6>
                                        <input type="text" class="form-control" name="last_name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Phone</h6>
                                        <input type="text" class="form-control" name="phone">
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Email</h6>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Requested policy start date</h6>
                                        <input type="text" class="form-control" value="<?php echo date('m/d/Y', strtotime("+1 day")); ?>" name="policy_start_date">
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <h6>Email</h6>
                                        <input type="email" class="form-control">
                                    </div> -->
                                </div>


                            </div>
                        </div>
                        <br>
                        <div>
                            <div style="">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)" style="float:left; margin:0 20% 0 20%;">Previous</button>
                                <button type="button" id="nextBtn" onclick="nextPrev(1)" style="float:right; margin:0 20% 0 20%;">Next</button>
                                <input type="submit"  id="completeBtn" value="Submit" class="btn btn-success" style="display:none;float:right; margin:0 20% 0 20%;width:100px;">
                            </div>
                        </div>
                        <!-- Circles which indicates the steps of the form: -->
                        <!-- <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div> -->
                    </form>
                    <?php //echo form_close(); ?>


                <!-- <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Record Payment</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
	</div>

        <!-- Modal -->
        <div class="modal fade" id="employee_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newcustomerLabel">Add new employee or owner</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="divpopemp" style="">
                            <p>Adding employees and owners here will help you get the most accurate quote. Need to add this info in nSmarTrac? Go to <strong>Workers > Employees.</strong></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Name</h6>
                                    <input type="text" class="form-control" id="fullName">
                                </div>
                                <div class="col-md-6">
                                    <h6>Role</h6>
                                    <select class="form-control" id="mRole">
                                        <option value="Employee">Employee</option>
                                        <option value="Excluded owner/office">Excluded owner/officer</option>
                                        <option value="Included owner/officer">Included owner/officer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Class code</h6>
                                    <select class="form-control" id="classCode">
                                        <option value="2107 - Fruit Packing (Fresh, Not Citrus)">2107 - Fruit Packing (Fresh, Not Citrus)</option>
                                        <option value="2108 - Fruit Packing (Citrus">2108 - Fruit Packing (Citrus)</option>
                                        <option value="2109 - Fruit Packing (Dried)">2109 - Fruit Packing (Dried)</option>
                                        <option value="2123 - Fruit or Vegetable Processing - Fresh Ready-to-Eat">2123 - Fruit or Vegetable Processing - Fresh Ready-to-Eat</option>
                                        <option value="8810 - Clerical Office Employees">8810 - Clerical Office Employees</option>
                                        <option value="8742 - Salespersons or Collectors - Outside">8742 - Salespersons or Collectors - Outside</option>
                                        <option value="I’m not sure, let an agent help">I’m not sure, let an agent help</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Individual estimated annual payroll</h6>
                                    <input type="number" class="form-control" id="annualPayroll">
                                </div>
                                <div class="col-md-6">
                                    <h6>Ownership</h6>
                                    <input type="text" class="form-control" id="mOwnership">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-detail">
                            <div class="button-modal-list">
                                <a href="#" class="btn btn-success addEmployeeData" id="addEmployeeData" data-dismiss="modal"> Add </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


      <div class="modal in connectPolicy" id="" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body" style="background-color:white;height:1000px;">
                    <div style="padding:2%;width:65%;margin:0 20% 0 20%;">
                        <div class="row">
                            <div class="col-md-6">
                              <img src="<?= getCompanyBusinessProfileImage(); ?>" class="invoice-print-logo"  style="max-width: 230px; max-height: 200px;" />
                            </div>
                            <div class="col-md-6">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="float:right;">
                                  <span aria-hidden="true" style="font-size:24px;">X</span>
                              </button>
                            </div>
                        </div>
                    </div>
                    <form id="regForm" action="<?php echo site_url('accounting/addQuote');?>">
                    <div style="padding:3%;border: solid gray 1px;width:60%;margin:-5px 20% 1% 20%;">
                        <h4>Connect your policy to nSmarTrac</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Current insurance carrier</h6>
                                    <select class="form-control" id="mRole">
                                        <option value="AmTrust">AmTrust</option>
                                        <option value="The Hartford">The Hartford</option>
                                        <option value="Employers">Employers</option>
                                        <option value="FirstComp/Markel">FirstComp/Markel</option>
                                        <option value="CNA">CNA</option>
                                        <option value="Travelers">Travelers</option>
                                        <option value="Guard">Guard</option>
                                        <option value="Other (please specify)">Other (please specify)</option>
                                    </select> 
                                    <input type="text" class="form-control" id="insuranceCarrier" style="margin-top:10px;">
                                    <br>
                                    <h6>Policy renewal date</h6>
                                    <table class="table">
                                      <tr>
                                        <td>
                                          <select class="form-control" id="renewaldateMonth">
                                          </select>
                                        </td>
                                        <td>
                                          <select class="form-control" id="renewaldateyears">
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <p style="font-size: 12px;margin-bottom:10px;">Connecting your policy does not change anything about your current policy or billing method.</p>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col-md-6" style="padding:5%;">
                                  <p style="font-weight:bold;font-size:20px;">Why connect?</p>
                                  <div class="container">
                                  <!-- completed -->
                                    <div class="step2 completed">
                                      <div class="v-stepper">
                                        <div class="circle"></div>
                                        <div class="line"></div>
                                      </div>

                                      <div class="content" style="padding:1%;">
                                          Sign up for automatic policy renewal reminders to help you stay covered at the best price. <br><br>
                                      </div>
                                  </div>
                                  
                                  <!-- active -->
                                  <div class="step2 completed">
                                    <div class="v-stepper">
                                      <div class="circle"></div>
                                      <div class="line"></div>
                                    </div>

                                    <div class="content" style="padding:1%;">
                                        Learn if your policy qualifies for Pay As You Go billing through nSmarTrac.<br><br>
                                    </div>
                                  </div>
                                  
                                  <!-- regular -->
                                  <div class="step2 completed">
                                      <div class="v-stepper">
                                        <div class="circle"></div>
                                        <div class="line"></div>
                                      </div>

                                      <div class="content" style="padding:1%;">
                                          Gain access to trusted insurance experts.<br><br>
                                      </div>
                                  </div>
                                  
                                </div>

                                  <button type="button" class="btn btn-success" style="float:right;">Get connected</button>

                                </div>
                            </div>
                    </div>
                    </form>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>
	</div>




<?php include viewPath('includes/footer_accounting'); ?>

<script>
// $(document).ready(function () {
	
	var select = document.getElementById('year'),
    year = new Date().getFullYear(),
    html = '<option></option>';

for(i = year; i >= year-18; i--) {
  html += '<option value="' + i + '">' + i + '</option>';
}

select.innerHTML = html;

// )};
</script>

<script>
$(document).ready(function () {

var navListItems = $('div.setup-panel div a'),
	allWells = $('.setup-content'),
	allNextBtn = $('.nextBtn');

allWells.hide();

navListItems.click(function (e) {
	e.preventDefault();
	var $target = $($(this).attr('href')),
		$item = $(this);

	if (!$item.hasClass('disabled')) {
		navListItems.removeClass('btn-success').addClass('btn-default');
		$item.addClass('btn-success');
		allWells.hide();
		$target.show();
		$target.find('input:eq(0)').focus();
	}
});

allNextBtn.click(function () {
	var curStep = $(this).closest(".setup-content"),
		curStepBtn = curStep.attr("id"),
		nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
		curInputs = curStep.find("input[type='text'],input[type='url']"),
		isValid = true;

	$(".form-group").removeClass("has-error");
	for (var i = 0; i < curInputs.length; i++) {
		if (!curInputs[i].validity.valid) {
			isValid = false;
			$(curInputs[i]).closest(".form-group").addClass("has-error");
		}
	}

	if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
});

$('div.setup-panel div a.btn-success').trigger('click');
});
</script>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    // document.getElementById("nextBtn").innerHTML = "Submit";
    $("#nextBtn").hide();
    $("#completeBtn").show();
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("stepper-item")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("stepper-item");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" completed", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " completed";
}
</script>

<script>
(function() {
  $(document).ready(function() {
    // $('.switch-input').on('change', function() {
    //   var isChecked = $(this).is(':checked');
    //   var selectedData;
    //   var $switchLabel = $('.switch-label');
    //   console.log('isChecked: ' + isChecked); 
      
    //   if(isChecked) {
    //     selectedData = $switchLabel.attr('data-on');
    //   } else {
    //     selectedData = $switchLabel.attr('data-off');
    //   }
      
    //   console.log('Selected data: ' + selectedData);
      
    // });
    
    // // Params ($selector, boolean)
    // function setSwitchState(el, flag) {
    //   el.attr('', flag);
    // }
    
    // // Usage
    // setSwitchState($('.switch-input'), true);    

    $("*[id^='switch-input']").each(function() {
      // alert('test');
            // $(this).upload()
            $(this).change(function(){ 
            var isChecked = $(this).is(':checked');
            var selectedData;
            var $switchLabel = $('.switch-label');
            // console.log('isChecked: ' + isChecked); 
            
            if(isChecked) {
              selectedData = 'yes';
            } else {
              selectedData = 'no';
            }
            
            $(this).val(selectedData);
            // alert(selectedData);
      
    });
    
    // Params ($selector, boolean)
    function setSwitchState(el, flag) {
      el.attr('', flag);
    }
    
    // Usage
    setSwitchState($('#switch-input'), true);
             
            });
        });
  // });
  
})();
</script>

<script>
$("#addEmployeeData").click(function () {
// alert('test');
  var fullName = $("#fullName").val();
  var mRole = $("#mRole").val();
  var classCode = $("#classCode").val();
  var annualPayroll = $("#annualPayroll").val();
  var mOwnership = $("#mOwnership").val();

              markup = "<tr id=\"ss\">" +
                "<td><span>"+fullName+"</span><input  value='"+fullName+"' type=\"hidden\" name=\"mfullName[]\"><input  value='"+annualPayroll+"' type=\"hidden\" name=\"annualPayroll[]\"></td>\n" +
                "<td><span>"+classCode+"</span><input  value='"+classCode+"' type=\"hidden\" name=\"classCode[]\"></td>\n" +
                "<td><span>"+mRole+"</span><input  value='"+mRole+"' type=\"hidden\" name=\"mRole[]\"></td>\n" +
                "<td><span>"+mOwnership+"</span><input  value='"+mOwnership+"' type=\"hidden\" name=\"mOwnership[]\"></td>\n" +
                "<td>\n" +
                "<a href=\"#\" class=\"remove btn btn-success\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                "</td>\n" +
                "</tr>";
            tableBody = $("#employeesTable");
            tableBody.append(markup);

            $("#divpopemp").load(location.href + " #divpopemp");

});

</script>

<script>
// $(document).on('hidden.bs.modal', function (e) {
//         var target = $(e.target);
//         target.removeData('bs.modal')
//               .find(".modal-content").html('');
//     });
</script>

<script type="text/javascript">
var d = new Date();
var monthArray = new Array();
monthArray[0] = "January";
monthArray[1] = "February";
monthArray[2] = "March";
monthArray[3] = "April";
monthArray[4] = "May";
monthArray[5] = "June";
monthArray[6] = "July";
monthArray[7] = "August";
monthArray[8] = "September";
monthArray[9] = "October";
monthArray[10] = "November";
monthArray[11] = "December";
for(m = 0; m <= 11; m++) {
    var optn = document.createElement("OPTION");
    optn.text = monthArray[m];
    // server side month start from one
    optn.value = monthArray[m];
    // if june selected
    if ( m == 6 ) {
        optn.selected = true;
    }
    document.getElementById('renewaldateMonth').options.add(optn);
}
</script>

<script>
// var nowY = new Date().getFullYear(),
//     options = "";

// for(var Y=nowY; Y>=2021; Y++) {
//   options += "<option>"+ Y +"</option>";
// }

// $("#renewaldateyears").append( options );
$('#renewaldateyears').each(function() {

var year = (new Date()).getFullYear();
var current = year;
// year += 3;
for (var i = 0; i < 3; i++) {
  if ((year+i) == current)
    $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
  else
    $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
}

})
</script>
