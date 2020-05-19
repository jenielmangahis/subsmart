<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); 
   $states = array(
    'AK'=>'Alaska',
    'AL'=>'Alabama',
    'AR'=>'Arkansas',
    'AZ'=>'Arizona',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DC'=>'District of Columbia',
    'DE'=>'Delaware',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'IA'=>'Iowa',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'MA'=>'Massachusetts',
    'MD'=>'Maryland',
    'ME'=>'Maine',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MO'=>'Missouri',
    'MS'=>'Mississippi',
    'MT'=>'Montana',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'NE'=>'Nebraska',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NV'=>'Nevada',
    'NY'=>'New York',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VA'=>'Virginia',
    'VT'=>'Vermont',
    'WA'=>'Washington',
    'WI'=>'Wisconsin',
    'WV'=>'West Virginia',
    'WY'=>'Wyoming'
   );
   ?>
<?php include viewPath('includes/header'); ?>
<link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">

<!-- page wrapper start -->
<div class="wrapper">
	<div class="container-fluid">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-sm-6">
					<h1 class="page-title">Workorders</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item active">Add workorder</li>
					</ol>
				</div>
				<div class="col-sm-6">
					<div class="float-right d-none d-md-block">
						<div class="dropdown">
							<?php if (hasPermissions('WORKORDER_MASTER')): ?>
							<a href="<?php echo url('workorder') ?>" class="btn btn-primary" aria-expanded="false">
								<i class="mdi mdi-settings mr-2"></i> Go Back to Workorder
							</a>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
		<?php echo form_open_multipart('workorder/save', [ 'class' => 'form-validate', 'id'=> 'workorder_form', 'autocomplete' => 'off' ]); ?>
		<style>
			
		</style>
		<div class="row custom__border">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<!-- <h4 class="mt-0 header-title mb-5">ALARM SYSTEM WORKORDER AGREEMENT</h4>
						<div class="row">
						<div class="col-md-12 form-group">
						<p>1. This Alarm System Work Order Agreement (the “Agreement”) is made as of the <input type="text" name="agreement_name" id="agreement_name"> , by and between
						ADI, (the “Company”) and the (“Customer”) as the address shown below (the “Premises / Monitored location”)
						</p>
						</div>
						</div>-->
						<div class="row">
							<div class="col-md-3 form-group">
								<label for="contact_name">Contact Name</label>
								<input type="text" class="form-control" name="contact_name" id="contact_name" required
									placeholder="Enter Name" autofocus />
							</div>
							<div class="col-md-3 form-group">
								<label for="contact_pwd">Password</label>
								<input type="password" class="form-control" name="contact_pwd" id="contact_pwd" min="4"
									placeholder="Enter (4 to 10 Letters password)" required />
							</div>
							<div class="col-md-3 form-group">
								<label for="contact_ssn">SSN</label>
								<input type="text" class="form-control" name="contact_ssn" id="contact_ssn" required
									placeholder="Enter SSN" />
							</div>
							<div class="col-md-3 form-group">
								<label for="contact_dob">DOB</label>
								<input type="text" class="form-control" name="contact_dob" id="contact_dob"
									placeholder="Enter DOB" />
							</div>
							<div class="col-md-3 form-group">
								<label for="contact_mobile">Mobile</label>
								<input type="text" class="form-control" name="contact_mobile" id="contact_mobile"
									placeholder="Enter Mobile" required />
							</div>
							<div class="col-md-3 form-group">
								<label for="contact_phone">Phone</label>
								<input type="text" class="form-control" name="contact_phone" id="contact_phone"
									placeholder="Enter Phone" />
							</div>
							<div class="col-md-3 form-group">
								<label for="contact_email">Contact Email</label>
								<input type="email" class="form-control" name="contact_email" id="contact_email"
									placeholder="Enter Email" required />
							</div>
							<div class="col-md-3 form-group">
								<label for="workorder_date">Workorder Date</label>
								<input type="text" class="form-control" name="workorder_date" id="workorder_date"
									required />
							</div>
							<div class="form-group col-md-3">
								<label for="workorder_status">Status</label>
								<select name="workorder_status" id="workorder_status" class="form-control" required>
									<option value="New">New</option>
									<option value="Scheduled">Scheduled</option>
									<option value="Started">Started</option>
									<option value="Paused">Paused</option>
									<option value="Completed">Completed</option>
									<option value="Invoiced">Invoiced</option>
									<option value="Withdrawn">Withdrawn</option>
									<option value="Closed">Closed</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-auto form-group">
								<label for="">Customer Type</label><br />
								<div class="checkbox checkbox-sec margin-right my-0 mr-3">
									<input type="radio" name="customer_type" value="Residential" checked="checked" id="customer_type">
									<label for="customer_type"><span>Residential</span></label>
								</div>
								<div class="checkbox checkbox-sec margin-right my-0">
									<input type="radio" name="customer_type" value="Commercial" checked="checked" id="Commercial">
									<label for="Commercial"><span>Commercial</span></label>
								</div>
							</div>
							
							<div class="col-auto form-group">
								<label for="">Notification Type</label><br />
								<div class="checkbox checkbox-sec margin-right my-0 mr-3">
									<input type="checkbox" name="notify_by[]" value="Email"  id="notify_by_email">
									<label for="notify_by_email"><span>Notify By Email</span></label>
								</div>
								<div class="checkbox checkbox-sec margin-right my-0 mr-3">
									<input type="checkbox" name="notify_by[]" value="SMS"  id="notify_by_sms">
									<label for="notify_by_sms"><span>Notify By SMS/Text</span></label>
								</div>
							</div>
						</div>
						 
						<?php if(count($users) > 0) { ?>
						<div class="box row">
							 
							<div class="box-body col-12">
								<h5 class="box-title">Assign To (optional)</h5>
								<?php foreach($users as $row) { ?>

								<div class="checkbox checkbox-sec margin-right my-0 mr-3">
									<input type="checkbox" value="<?php echo $row->id;?>" name="assign_to[]" id="<?php echo $row->id;?>">
									<label for="<?php echo $row->id;?>"><span><?php echo ucfirst($row->name);?></span></label>
								</div>
								<?php }?>

							</div>
						</div>
						<?php }?>
						<div class="row mt-3">
							<div class="col-md-6 form-group">
								<label for="street_address">Monitored Location</label>
								<input type="text" class="form-control" name="street_address" id="street_address"
									placeholder="Enter Address" />
							</div>
							<div class="col-md-6 form-group">
								<label for="suit">Cross street</label>
								<input type="text" class="form-control" name="suit" id="suit"
									placeholder="Enter Suit/Unit" />
							</div>
							<div class="col-md-6 form-group">
								<label for="city">City</label>
								<input type="text" class="form-control" name="city" id="city"
									placeholder="Enter City" />
							</div>
							<div class="col-md-6 form-group">
								<label for="zip">Zip/Postal Code</label>
								<input type="text" class="form-control" name="zip" id="zip"
									placeholder="Enter Zip/Postal Code" />
							</div>
						<div class="col-md-6 form-group">
								<label for="state">State/Province</label>
								<select name="state" id="state" class="form-control">
									<option value="">Select</option>
									<?php foreach($states as $key=>$val) { ?>
									<option value="<?php echo $key?>"><?php echo $val;?></option>
									<?php }?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<h4 style="width:100%">Call List:-</h4>
								<div class=" form-group">
								<div class="c__custom">
									<label class="checkbox-inline">
										<input type="checkbox" name="premises_chk[]" value="Cell" checked>Cell
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="premises_chk[]" value="Landline" checked>Landline
									</label>
								</div>
							</div>
							</div>
							<div class="col-md-3 form-group">
								<label for="premises">Premises</label>
								<input type="text" class="form-control" name="premises" id="premises" placeholder="" />
							</div>
							
							<div class="col-md-3 form-group">
								<label for="company_phone">Phone Company</label>
								<input type="text" class="form-control" name="company_phone" id="company_phone"
									placeholder="" />
							</div>
							<div class="col-md-3 form-group">
								<label for="verification_name">2nd Call Verification Name</label>
								<input type="text" class="form-control" name="verification_name" id="verification_name"
									placeholder="" />
							</div>
							<div class="col-md-3 form-group">
								<label for="verification_phone">Phone</label>
								<input type="text" class="form-control" name="verification_phone"
									id="verification_phone" placeholder="" />
							</div>
							<div class="col-md-3 form-group">
								<label for="emrg_contact_1">Emergency Contact Name</label>
								<input type="text" class="form-control" name="emrg_contact_1" id="emrg_contact_1"
									placeholder="" />
							</div>
							<div class="col-md-3 form-group">
								<label for="emrg_contact_phone_1">Phone</label>
								<input type="text" class="form-control" name="emrg_contact_phone_1"
									id="emrg_contact_phone_1" placeholder="" />
							</div>
							<div class="col-md-3 form-group">
								<label for="emrg_contact_2">Emergency Contact Name:</label>
								<input type="text" class="form-control" name="emrg_contact_2" id="emrg_contact_2"
									placeholder="" />
							</div>
							<div class="col-md-3 form-group">
								<label for="emrg_contact_phone_2">Phone</label>
								<input type="text" class="form-control" name="emrg_contact_phone_2"
									id="emrg_contact_phone_2" placeholder="" />
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4 form-group">
								<label for="emrg_contact_email"> Email Address:</label>
								<input type="text" class="form-control" name="emrg_contact_email" id="emrg_contact_email" placeholder="" />
								<div class="c__custom c__custom_width mt-4">
									<label class="checkbox-inline">
										<input type="checkbox" name="chk_emerg_email[]" value="No Email">No Email
									</label>
									 
									<label class="checkbox-inline">
										<input type="checkbox" name="chk_emerg_email[]" value="OFC">OFC
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="chk_emerg_email[]" value="SELF">SELF
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="chk_emerg_email[]" value="DISCONNECT">DISCONNECT
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="chk_emerg_email[]" value="RENEWAL">RENEWAL
									</label>
								</div>
							</div>
							<div class="col-md-4 form-group">
								<label for="emerg_contact_location"> Location:</label>
								<input type="text" class="form-control" name="emerg_contact_location"
									id="emerg_contact_location" placeholder="" />
								<div class="c__custom c__custom_width mt-4">
									<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="L3000">L3000
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="L5100">L5100
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="LTOUCH">LTOUCH
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="GO Panel v2">GO Panel v2
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="GO Panel v3">GO Panel v3
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="Vista/SEM">Vista/SEM
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="Vista/GSMX">Vista/GSMX
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="Other">Other
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="chk_emerg_location[]" value="DSC">DSC
										</label>
								</div> 
							</div> 
							<div class="col-md-4 form-group">
								<label for="street_address"> Plan Type:</label>
								<div class="c__custom c__custom_width  ">
									<label class="checkbox-inline">
									<input type="checkbox" name="plan_type[]" value="Phone Line">Phone Line
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="plan_type[]" value="Wi-Fi Card">Wi-Fi Card
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="plan_type[]" value="Cell Primary">Cell Primary
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="plan_type[]" value="Basic Interactive">Basic
										Interactive
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="plan_type[]" value="Interactive Automation">Interactive
										Automation
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="plan_type[]" value="Interactive Pro Video">Interactive
										Pro Video
									</label>
								</div>
							</div> 
						</div>
						 
						<div class="row">
							<div class="col-md-2 form-group">
								<label for=""> IP CAM:</label>
								<div class="c__custom">
									<label class="checkbox-inline"><input type="checkbox" name="ip_cam[]" value="Honeywell">Honeywell WO WI</label>
									<label class="checkbox-inline"><input type="checkbox" name="ip_cam[]" value="Alarm.com">Alarm.com WO WI</label>
								</div>  
							</div>
							<div class="col-md-2 form-group">
								<label for=""> DVR:</label>
								<div class="c__custom">
									<label class="checkbox-inline"><input type="checkbox" name="chk_dvr[]" value="Honeywell/AVYCON">Honeywell/AVYCON</label>
									<label class="checkbox-inline"><input type="checkbox" name="chk_dvr[]" value="Other">Other</label>
								</div>
							</div>
							<div class="col-md-4 form-group">
								<label for=""> Doorlocks:</label><br />
								<table class="table">
									<tr>
										<th></th>
										<th>Brass</th>
										<th>Nickal</th>
										<th>Bronze</th>
									</tr>
									<tr>
										<td>Deadbolt</td>
										<td><input type="text" class="form-control" name="deadbolt[]" placeholder="" />
										</td>
										<td><input type="text" class="form-control" name="deadbolt[]" placeholder="" />
										</td>
										<td><input type="text" class="form-control" name="deadbolt[]" placeholder="" />
										</td>
									</tr>
									<tr>
										<td>Handle</td>
										<td><input type="text" class="form-control" name="handle[]" placeholder="" />
										</td>
										<td><input type="text" class="form-control" name="handle[]" placeholder="" />
										</td>
										<td><input type="text" class="form-control" name="handle[]" placeholder="" />
										</td>
									</tr>
								</table>
							</div>
							<div class="col-md-2 form-group">
								<label for=""> Thermostat:</label>
								<div class="c__custom">
									<label class="checkbox-inline"><input type="checkbox" name="thermostat[]" value="Honeywell">Honeywell</label>
									<label class="checkbox-inline"><input type="checkbox" name="thermostat[]" value="Alarm.com">Alarm.com</label>
								</div>
							</div>
							<div class="col-md-2 form-group">
								<label for=""> Doorbell CAM:</label>
								<div class="c__custom">
									<label class="checkbox-inline"><input type="checkbox" name="doorbell_cam[]" value="Honeywell">Honeywell</label>
									<label class="checkbox-inline"><input type="checkbox" name="[]" value="Alarm.com">Alarm.com</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class=" col-md-4">
								<label for="inst_date"> Installation Date:</label>
								<input type="text" class="form-control" name="inst_date" id="inst_date"
									placeholder="" />
								<br />
								Install Time:
								<div class="c__custom">
									<label class="checkbox-inline"><input type="checkbox" name="inst_time[]" value="8-10">8-10</label>
									<label class="checkbox-inline"><input type="checkbox" name="inst_time[]" value="10-12">10-12</label>
									<label class="checkbox-inline"><input type="checkbox" name="inst_time[]" value="12-2">12-2</label>
									<label class="checkbox-inline"><input type="checkbox" name="inst_time[]" value="2-4">2-4</label>
									<label class="checkbox-inline"><input type="checkbox" name="inst_time[]" value="4-6">4-6</label>
									<label class="checkbox-inline"><input type="checkbox" name="inst_time[]" value="Firm">Firm</label>
								</div>
							</div>
							<div class="col-md-6">
								<label for="notes_to_tech"> Notes to Tech:</label>
								<textarea name="notes_to_tech" id="notes_to_tech" rows="3" class="form-control"></textarea>
							</div>
						</div>
						<div class="row">
							<div class=" col-md-9">
								<div class="work_nore">
									<h6>Work Order Items</h6>
									<p> You can set up the products or services for this work order. </p>
									<p><strong class="red">Note: prices will not be shown to the assigned employees but
											only to you. </strong></p>
									<!-- <a href="" class="add_itemms_button">Add Items</a> -->
								</div>
							</div>
							<!-- <div class="col-md-3">
		<label>Show qty as:</label>
		<select class="custom-select form-control">
		<option>Quanity</option>
		</select>
		</div> -->
						</div>
						<br />
						<div class="row">
							<div class="col-md-12 table-responsive">
								<table class="table table-hover">
									<input type="hidden" name="count" value="0" id="count">
									<thead>
										<tr>
											<th>DESCRIPTION</th>
											<th>NEW EQUIP</th>
											<th>LOCATION</th>
											<th>COST</th>
											<th>Discount</th>
											<th>Tax(%)</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody id="table_body">
										<tr>
											<td>
												<input type="text" class="form-control" name="item[]">
											</td>
											<td>
												<input type="text" class="form-control quantity" name="quantity[]"
													data-counter="0" id="quantity_0" value="1">
											</td>
											<td>
												<!-- <select name="type[]" class="form-control">
		<option value="Service">Service</option>
		<option value="Material">Material</option>
		<option value="Product">Product</option>
		</select> -->
												<input type="text" class="form-control" name="type[]">
											</td>
											<td>
												<input type="number" class="form-control price" name="price[]"
													data-counter="0" id="price_0" min="0" value="0">
											</td>
											<td>
												<span id="span_discount_0">0.00 (0.00%)</span>
											</td>
											<td>
												<span id="span_tax_0">0.00 (7.5%)</span>
											</td>
											<td>
												<span id="span_total_0">0.00</span>
											</td>
										</tr>
									</tbody>
								</table>
								<a href="#" class="btn btn-primary" id="add_another">Add Items</a>
							</div>
						</div><br />
						<div class="row">
							<div class="col-md-4">
								<table class="table table-bordered">
									<tr>
										<td>Equipment Cost</td>
										<td class="d-flex align-items-center">$ &nbsp;&nbsp;<input type="text" value="0.00" name="eqpt_cost" id="eqpt_cost"
												onfocusout="cal_total_due()" class="form-control"></td>
									</tr>
									<tr>
										<td>Sales Tax</td>
										<td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text" value="0.00" name="sales_tax" id="sales_tax"
												onfocusout="cal_total_due()" class="form-control"></td>
									</tr>
									<tr>
										<td>Installation Cost</td>
										<td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text" value="0.00" name="inst_cost" id="inst_cost"
												onfocusout="cal_total_due()" class="form-control"></td>
									</tr>
									<tr>
										<td>One time P/Dated <br />Program and Setup</td>
										<td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text" value="0.00" name="one_time" id="one_time"
												onfocusout="cal_total_due()" class="form-control"></td>
									</tr>
									<tr>
										<td>Monthly Monitoring</td>
										<td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text" value="0.00" name="m_monitoring" id="m_monitoring"
												onfocusout="cal_total_due()" class="form-control"></td>
									</tr>
									<tr>
										<td>Total Due</td>
										<td class="d-flex align-items-center">$ &nbsp;&nbsp; <span id="total_due">0.00</span></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<b>ENHANCED SERVICES:</b><br />
								<b>DVR</b>
								<div class="c__custom">
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="2" checked>2
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="3">3
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="4">4
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="5">5
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="6">6
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="7">7
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="8">8
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="9">9
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="10">10
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="11">11
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="12">12
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="13">13
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="14">14
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="15">15
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_enhance_dvr[]" value="16">16
								</label>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<div class="c__custom">
									<label class="checkbox-inline">
										<input type="checkbox" name="chk_enhance_pers[]" value="PERS" checked>PERS
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" name="chk_enhance_pers[]" value="PERS w/Fall Detec">PERS
										w/Fall Detec
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p>2. Install of the system. Company agrees to schedule and install an alarm system
									and/or
									devices in connection with a Monitoring Agreement which customer will receive
									at the time of installation. Customer hereby agrees to buy the system/devices
									described
									below and incorporated herein for all purposes by this reference (the “System
									/Services”),
									in accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL
									THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the
									cost of the system and recovering fees.
								</p>
								<p>3. Customer agrees to have system maintained for an initial term of 60
									months at the above monthly rate in exchange for a reduced cost of the system.
									Upon the execution of this agreement shall automatically start the billing process.
									Customer understands that the monthly payments must be paid through “Direct
									Billing” through their banking institution or credit card. Customers acknowledge
									that they
									authorize Company to obtain a Security System. Residential Clients: CUSTOMER HAS
									THE RIGHT TO CANCEL THIS TRANSACTION at any time prior to midnight on the 3rd
									business day after the above date of this work order in writing. Customer agrees
									that no
									verbal method is valid, and must be submitted only in writing. The date on this
									agreement
									is the agreed upon date for both the Company and the Customer
								</p>
								<p> 4. Client verifies that they are owners of the property listed above. In the event
									the
									system has to be removed, Client agrees and understands that there will be an
									additional $299.00 restocking/removal fee and early termination fees will apply.
								</p>
								<p> 5. Client understands that this is a new Monitoring Agreement through our central
									station. Alarm.com or .net is not affiliated nor has any bearing on the current
									monitoring services currently or previously initiated by Client with other alarm
									companies. By signing this work order, Client agrees and understands that they
									have read the above requirements and would like to take advantage of our
									services. Client understand that is a binding agreement for both party.
								</p>
								<p> 6. Customer agrees that the system is preprogramed for each specific location.
									accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL
									THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the
									cost of the system and recovering fees.
									Customer agrees that this is a customized order. By signing this workorder, customer
									agrees that customized order can not be cancelled after three day of this signed
									document.
								</p>
							</div>
						</div>
						<div class="row">
							<div class=" col-md-12">
								<div class="work_nore">
									<h6>Credit Card Information:-</h6>
								</div>
							</div>
							<div class=" col-md-12">
								Credit Card Type: 
								<div class="checkbox checkbox-sec margin-right mr-4">
									<input type="radio" name="radio_credit_card" value="Visa" checked="checked" id="radio_credit_card">
									<label for="radio_credit_card"><span>Visa</span></label>
								</div>
								<div class="checkbox checkbox-sec margin-right mr-4">
									<input type="radio" name="radio_credit_card" value="Amex" checked="checked" id="radio_credit_cardAmex">
									<label for="radio_credit_cardAmex"><span>Amex</span></label>
								</div>
								<div class="checkbox checkbox-sec margin-right mr-4">
									<input type="radio" name="radio_credit_card" value="Mastercard" checked="checked" id="radio_credit_cardMastercard">
									<label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
								</div>
								<div class="checkbox checkbox-sec margin-right mr-4">
									<input type="radio" name="radio_credit_card" value="Discover" checked="checked" id="radio_credit_cardMasterDiscover">
									<label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
								</div>
								 
							</div>
							<div class=" col-md-12">
								<div class="row" style="border:none; margin-bottom:20px; padding-bottom:0px;">
									<div class=" col-md-6">
										<label for="card_no">Card Number</label>
										<input type="text" class="form-control" name="card_no" id="card_no"
											placeholder="" />
									</div>
									<div class=" col-md-3">
										<label for="exp_date">Exp. Date</label>
										<input type="text" class="form-control" name="exp_date" id="exp_date"
											placeholder="" />
									</div>
									<div class=" col-md-3">
										<label for="cvv">CVV#</label>
										<input type="text" class="form-control" name="cvv" id="cvv" placeholder="" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<b>Billing Dates:</b>
								<div class="c__custom">
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="5th" checked>5th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="7th">7th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="8th">8th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="10th">10th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="14th">14th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="15th">15th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="18th">18th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="21th">21th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="22th">22th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="26th">26th
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="chk_billing_dates[]" value="28th">28th
								</label>
							</div>
							</div>
						</div>
						<div class="row">
								<div class="col-12">
									<h6>Other Information:-</h6>
								</div>
								<div class=" col-md-4 form-group">
									<label for="checking_account">Checking account #</label>
									<input type="text" class="form-control" name="checking_account"
										id="checking_account" placeholder="" />
								</div>
								<div class=" col-md-4 form-group">
									<label for="routing">Routing #</label>
									<input type="text" class="form-control" name="routing" id="routing"
										placeholder="" />
								</div>
								<div class=" col-md-4 form-group">
									<label for="sales_rep_name">Sales Rep’s Name</label>
									<input type="text" class="form-control" name="sales_rep_name"
										id="sales_rep_name" placeholder="" />
								</div>
								<div class=" col-md-4 form-group">
									<label for="cell_phone">Cell Phone</label>
									<input type="text" class="form-control" name="cell_phone" id="cell_phone"
										placeholder="" />
								</div>
								<div class=" col-md-4 form-group">
									<label for="notes_to_lauren">Notes to Lauren:</label>
									<input type="text" class="form-control" name="notes_to_lauren"
										id="notes_to_lauren" placeholder="" />
								</div>
								<div class=" col-md-4 form-group">
									<label for="prev_prod_name">If takeover, name of previous products:</label>
									<input type="text" class="form-control" name="prev_prod_name"
										id="prev_prod_name" placeholder="" />
								</div>
								<div class=" col-md-12">
									<label for="chk_inactive">
										<input type="checkbox" name="chk_inactive" value="INACTIVE">INACTIVE
									</label>
								</div>
							</div>
						<div class="row">
							<div class=" col-md-12">
								<div class="work_nore">
									<h6>Signature</h6>
									<p> By Signing below you verify that the above information is true and complete, and
										youauthorize payment and confirmation with credit reporting agencies or a third
										party. </p>
								</div>
							</div>
							<div class=" col-md-4">
								<input type="text" class="form-control" name="comp_rep_approval" id="comp_rep_approval"
									placeholder="" />
								 
							</div>
							<div class=" col-md-8">
							<!--
								<div class="sigPad" id="smoothed" style="width:404px;">
									<ul class="sigNav">
										<li class="drawIt"><a href="#draw-it">Draw It</a></li>
										<li class=""><a href="#clear">Clear</a></li>
									</ul>
									<div class="sig sigWrapper" style="height:auto;">
										<div class="typed"></div>
										<canvas class="pad" id="CustomerSign" width="400" height="250"></canvas>
										<input type="hidden" name="output-2" class="output">
									</div>
								</div>
								-->
								<div class="sigPad" id="smoothed" style="width:404px;">
<h2>Bezier Curves (constant pen width)</h2>
<ul class="sigNav">
<li class="drawIt"><a href="#draw-it" >Draw It</a></li>
<li class="clearButton"><a href="#clear">Clear</a></li>
</ul>
<div class="sig sigWrapper" style="height:auto;">
<div class="typed"></div>
<canvas class="pad" width="400" height="250"></canvas>
<input type="hidden" name="output-2" class="output">
</div>
</div>
								<input type="hidden" id="saveSignatureDB" name="customer_sign">
								<label for="city">CUSTOMER SIGNATURE </label>
							</div>
							<!-- <div class=" col-md-4">
		<input type="text" class="form-control" name="" id="" placeholder=""/>

		</div> -->
						</div>
						<div class="row">
							<div class=" col-md-12">
								<div class="work_nore">
									<h6>POST-SERVICE SUMMARY</h6>
								</div>
							</div>
							<div class=" col-md-4 form-group">
								<label for="post_service_uid">USERID</label>
								<input type="text" class="form-control" name="post_service_uid" id="post_service_uid"
									placeholder="" />
							</div>
							<div class=" col-md-4 form-group">
								<label for="post_service_pwd">PASSWORD</label>
								<input type="text" class="form-control" name="post_service_pwd" id="post_service_pwd"
									placeholder="" />
							</div>
							<div class=" col-md-4 form-group">
								<label for="post_service_pre_install">Pre-Install Conf. #</label>
								<input type="text" class="form-control" name="post_service_pre_install"
									id="post_service_pre_install" placeholder="" />
							</div>
							<div class=" col-md-4 form-group">
								<label for="post_service_wifi_pwd">WiFi Password</label>
								<input type="text" class="form-control" name="post_service_wifi_pwd"
									id="post_service_wifi_pwd" placeholder="" />
							</div>
							<div class=" col-md-4 form-group">
								<label for="post_service_panel_location">Panel Location</label>
								<input type="text" class="form-control" name="post_service_panel_location"
									id="post_service_panel_location" placeholder="" />
							</div>
							<div class=" col-md-4 form-group">
								<label for="post_service_trans_location">Transformer Location</label>
								<input type="text" class="form-control" name="post_service_trans_location"
									id="post_service_trans_location" placeholder="" />
							</div>
						</div>
						<div class="row">
							<div class=" col-md-12">
								<label for="note_to_admin">Note to Admin</label>
								<textarea name="note_to_admin" id="note_to_admin" class="form-control" col="2"
									row="1"></textarea>
							</div>
						</div>
						<div class="row">
							<div class=" col-md-12">
								<div class="work_nore">
									<h6>NOTICE OF CANCELLATION of Authorized Dealer Workorder Agreement</h6>
									<label for="date_of_trans">Date of Transaction</label>
									<input type="text" class="form-control" name="date_of_trans" id="date_of_trans"
										placeholder="" />
									<p>You may CANCEL this transaction, within THREE BUSINESS DAYS from the above date.
										If You cancel, You must make You may, if You wish, comply with Our instructions
										regarding the return shipment of the goods at Your expense and risk. WITHIN TEN
										BUSINESS DAY of cancellation request. </p>
									<p>If You cancel, you authorize a draft of $299 for processing for deactivation and
										restocking of devices.If you fail to make the goods available to Us, or if You
										agree to return the goods to Us and fail to do so, then You remain liable for
										performance of all obligations under the contract.</p>
									<p>To cancel this transaction, mail or deliver a signed and postmarket, dated copy
										of this Notice of Cancellation or any otherother written notice, or send a
										telegram, to Alarm Direct, Inc., 8826 North Davis Highway, Suite #1, Pensacola,
									</p>

								</div>
							</div>
						</div>
						 
						<div class="row">
							 <div class="col-12">
								<h6>I HEREBY CANCEL THIS TRANSACTION:</h6>
							</div>
							<div class=" col-md-4 form-group">
								<label for="date_later_midnight">NOT LATER THAN MIDNIGHT OF</label>
								<input type="text" class="form-control" name="date_later_midnight"
									id="date_later_midnight" placeholder="" />
							</div>
							<div class=" col-md-4 form-group">
								<label for="">COSTOMER SIGNATURE </label>
								<input type="text" class="form-control" name="cancel_custome_sign"
									id="cancel_custome_sign" placeholder="" />
								

							</div>
							<div class=" col-md-4 form-group">
								<label for="">DATE </label>
								<input type="text" class="form-control" name="cancel_trans_date" id="cancel_trans_date"
									placeholder="" />
								
							</div>
							<div class=" col-md-4 form-group">
								<label for="">CUSTOMER’S NAME </label>
								<input type="text" class="form-control" name="cancel_customer_name"
									id="cancel_customer_name" placeholder="" />
								
							</div>
							<div class=" col-md-4 form-group">
							<label for="">CUSTOMER’S ADDRESS</label>
								<input type="text" class="form-control" name="cancel_customer_address"
									id="cancel_customer_address" placeholder="" />
								
							</div>
							<div class=" col-md-4 form-group">
								<label for="">CUSTOMER’S PHONE NUMBER </label>
								<input type="text" class="form-control" name="cancel_customer_phone"
									id="cancel_customer_phone" placeholder="" />
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 form-group">
								<button type="submit" class="btn btn-flat btn-primary">Submit</button>
								<a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel this</a>
							</div>
						</div>
					</div>
				</div>
				<!-- end card -->
			</div>
		</div>
		<div class="modal fade" id="checklistModal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Select Checklists</h4>
					</div>
					<div class="modal-body">
						<p></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Add Selected</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo $url->assets ?>js/jquery.signaturepad.js"></script>
<script>
	$(document).ready(function () {
		$('#smoothed').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:200});
		$("#CustomerSign").on("click touchstart", function () {

			var canvas = document.getElementById("CustomerSign");
			// save canvas image as data url (png format by default)
			var dataURL = canvas.toDataURL("image/png");
			/* document.getElementById("saveSignature").src = dataURL; */
			$("#saveSignatureDB").val(dataURL);
		});

	});

</script>
<script>
	$(document).ready(function () {
		$('.form-validate').validate();

		//Initialize Select2 Elements
		$('.select2').select2()

	})

	function previewImage(input, previewDom) {

		if (input.files && input.files[0]) {

			$(previewDom).show();

			var reader = new FileReader();

			reader.onload = function (e) {
				$(previewDom).find('img').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		} else {
			$(previewDom).hide();
		}

	}

	function createUsername(name) {
		return name.toLowerCase()
			.replace(/ /g, '_')
			.replace(/[^\w-]+/g, '')
			;;
	}

	$(document).on('focusout', '.price', function () {

		var counter = $(this).data('counter');
		calculation(counter);
	});

	$(document).on('focusout', '.quantity', function () {

		var counter = $(this).data('counter');
		calculation(counter);
	});



	function calculation(counter) {

		var price = $('#price_' + counter).val();
		var quantity = $('#quantity_' + counter).val();
		var tax = (parseFloat(price) * 7.5 / 100);
		var tax1 = ((parseFloat(price) * 7.5 / 100) * parseFloat(quantity)).toFixed(2);
		var total = ((parseFloat(price) + parseFloat(tax)) * parseFloat(quantity)).toFixed(2);

		$('#span_total_' + counter).text(total);
		$('#span_tax_' + counter).text(tax1);
	}

	$(document).on('click', '#add_another', function (e) {

		e.preventDefault();
		var count = parseInt($('#count').val()) + 1;
		$('#count').val(count);

		var html = '<tr>\n' +
			'<td>\n' +
			'<input type="text" class="form-control" name="item[]">\n' +
			'</td>\n' +
			'<td>\n' +
			'<input type="text" class="form-control quantity" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" value="1">\n' +
			'</td>\n' +
			'<td>\n' +
			'<input type="text" class="form-control" name="type[]">\n' +
			'</td>\n' +
			'<td>\n' +
			'<input type="number" class="form-control price" name="price[]" data-counter="' + count + '" id="price_' + count + '" min="0" value="0">\n' +
			'</td>\n' +
			'<td>\n' +
			'<span id="span_discount_' + count + '">0.00 (0.00%)</span>\n' +
			'</td>\n' +
			'<td>\n' +
			'<span id="span_tax_' + count + '">0.00 (7.5%)</span>\n' +
			'</td>\n' +
			'<td>\n' +
			'<span id="span_total_' + count + '">0.00</span>\n' +
			'</td>\n' +
			'<td>\n' +
			'<a href="#" class="remove">X</a>\n' +
			'</td>\n' +
			'</tr> ';

		$('#table_body').append(html);
	});

	$(document).on('click', '.remove', function (e) {

		e.preventDefault();
		$(this).parent().parent().remove();
		//var count = parseInt($('#count').val())-1;
		// $('#count').val(count);
	});

	function cal_total_due() {

		var eqpt_cost = parseFloat($('#eqpt_cost').val());
		var sales_tax = parseFloat($('#sales_tax').val());
		var inst_cost = parseFloat($('#inst_cost').val());
		var one_time = parseFloat($('#one_time').val());
		var m_monitoring = parseFloat($('#m_monitoring').val());

		var total_due = parseFloat(eqpt_cost + sales_tax + inst_cost + one_time + m_monitoring).toFixed(2);
		$('#total_due').text(total_due);
	}

	$(function () {
		$("#date_issued").datepicker();
		$("#date_of_trans").datepicker();
		$("#date_later_midnight").datepicker();
		$("#workorder_date").datepicker();
		$("#contact_dob").datepicker();
		$("#cancel_trans_date").datepicker();
		$("#start_date").datepicker();
		$('#end_time').timepicker({});
		$('#start_time').timepicker({});
		$('#end_date').datepicker();
		$('#inst_date').datepicker();
	});

</script>