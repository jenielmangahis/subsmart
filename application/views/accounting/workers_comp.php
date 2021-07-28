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
           <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
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
						<a href="#" class="btn btn-default rounded-20 px-3 py-0 mt-3"><h5>Connect my policy</h5></a>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h4 class="modal-title"></h4> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color:white;">
					<!-- <div class="container">
						<ul class="progressbar">
							<li class="active">login</li>
							<li>choose interest</li>
							<li>add friends</li>
							<li>View map</li>
						</ul>
					</div> -->
					<div class="stepper-wrapper" style="margin:0 10% 0 10%;width:80%;">
						<div class="stepper-item completed">
							<div class="step-counter">1</div>
							<div class="step-name">Get started</div>
						</div>
						<div class="stepper-item active">
							<div class="step-counter">2</div>
							<div class="step-name">Details</div>
						</div>
						<div class="stepper-item active">
							<div class="step-counter">3</div>
							<div class="step-name">Quote</div>
						</div>
					</div>
					<br>
					<div style="padding:3%;border: solid gray 1px;width:60%;margin:0 20% 0 20%;">
						<h4>Your business</h4>
						<p>Finding the right classification for your business ensures that your quote will be as accurate as possible. But don't worry if you don't find an exact match – an agent will review this before anything is finalized.</p>

						<h6><br>General industry</h6>
						<select class="form-control">
							<option>Select General industry</option>
							<option>Advertising, Graphic Design, Photography and Printing</option>
							<option>Agriculture, Forestry, Fishing and Hunting</option>
							<option>Arts, Entertainment and Recreation</option>
							<option>Communications, Electric or Gas Service</option>
							<option>Educational and Social Services</option>
							<option>Health Care, Social Assistance and Public Administration</option>
							<option>Legal, Finance, Insurance and Real Estate</option>
							<option>Manufacturing</option>
							<option>Membership, Religious and Fraternal Organizations</option>
							<option>Personal and Business Services</option>
							<option>Restaurants and Lodging</option>
							<option>Retail Trade - Nonstore</option>
							<option>Retail Trade - Storefront</option>
							<option>Specialty Trade Contractors</option>
							<option>Technology, Engineering and Consulting</option>
							<option>Transportation & Warehousing</option>
							<option>Wholesale Trade</option>
							<!-- <option></option> -->
						</select>

						<h6><br>Type of business</h6>
						<select class="form-control">
							<option>Select type of business</option>
							<option>Apparel, Piece Goods and Notions</option>
							<option>Beer, Wine and Distilled Alcoholic Beverages</option>
							<option>Chemicals and Allied Products</option>
							<option>Drugs, Drug Proprietaries and Druggists' Sundries</option>
							<option>Electrical Goods</option>
							<option>Furniture and Home furnishings</option>
							<option>Groceries and Related Products</option>
						</select>

						<h6><br>Standard industry classification (SIC)</h6>
						<select class="form-control">
							<option>Select Standard industry classification</option>
							<option>Confectionery</option>
							<option>Dairy Products, Except Dried Or Canned</option>
							<option>Fish and Seafoods</option>
							<option>Fresh Fruits and Vegetables</option>
							<option>Groceries and Related Products, Not Elsewhere Classified</option>
							<option>Groceries, General Line</option>
							<option>Meats and Meat Products</option>
							<option>Meats and Meat Products (with butchering or slaughtering)</option>
							<option>Packaged Frozen Foods</option>
							<option>Poultry and Poultry Products</option>
							<!-- <option></option> -->
						</select>

						<h6><br>Business name</h6>
						<input type="text" class="form-control">

						<h6><br>Principal business address</h6>
						<input type="text" class="form-control">
						
						<h6><br>Suite/Floor</h6>
						<input type="text" class="form-control" style="width:30%;">

						<h6><br>Year business started</h6>
						<select class="form-control" id="year" style="width:40%;">
							<option></option>
						</select>

						<h6><br>Legal entity type</h6>
						<select class="form-control">
							<option>Corporation</option>
							<option>Limited Liability Company</option>
							<option>Non-Profit</option>
							<option>Partnership</option>
							<option>Sole Proprietor</option>
							<option>Other</option>
						</select>

						<h6><br>Federal Identification Number (optional)</h6>
						<input type="text" class="form-control" style="width:40%;">
						<br><br>
						<input type="submit" value="Next" class="btn btn-success" style="float:right; margin:2px;">
						<br><br>

					</div>

					<!-- <div class="container"> -->
    <!-- <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Shipper</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Destination</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Schedule</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Cargo</small></p>
            </div>
        </div>
    </div>
    
    <form role="form">
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Shipper</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">First Name</label>
                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Last Name</label>
                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" />
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Destination</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Company Name</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Company Address</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Schedule</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Company Name</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Company Address</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Cargo</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Company Name</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Company Address</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                </div>
                <button class="btn btn-success pull-right" type="submit">Finish!</button>
            </div>
        </div>
    </form>
</div> -->

                <!-- <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Record Payment</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
	</div>

<?php include viewPath('includes/footer_accounting'); ?>
<!-- <script src="<?php echo $url->assets;?>mdb5/js/mdb.min.js"></script> -->

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