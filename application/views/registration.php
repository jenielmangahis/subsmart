<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<section page="register" message="" class="ng-isolate-scope">
	<div class="f-height">
		<div>
			<div class="col-md-5 col-sm-5 float-left pl-0">
				<div id="side-image" class="side-image--regular image-fader left"></div>
			</div>
			<div class="col-md-7 col-sm-7 float-left pr-0 container-signup pt-5">
				<form action="#">
					<h2 class="m-b-2 ng-scope text-center reg-header">Welcome to a new way to take control of your business.</h2>
					<span class="text-center block mt-3">Already signed up? <a href="#" class="reg-color">Log in</a></span>
					<div class="form-container-reg">

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

						<div class="col-md-6 pr-0 float-left z-100">
							<div class="input-group z-100">
								<input autocomplete="off" type="text" name="firstname" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="First Name">
							</div>
						</div>


						<div class="col-md-6 float-left z-100">
							<div class="input-group z-100">
								<input autocomplete="off" type="text" name="lastname" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Last Name">
							</div>
						</div>

						<div class="col-md-6 pr-0 float-left">
							<div class="input-group z-100">
								<input autocomplete="off" type="text" name="email" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your email address" placeholder="Email address">
							</div>
						</div>

						<div class="col-md-6 float-left">
							<div class="input-group z-100">
								<input autocomplete="off" type="number" name="phone" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="Phone number">
							</div>
						</div>

						<div class="col-md-6 pr-0 float-left">
							<div class="input-group z-100">
								<input autocomplete="off" type="text" name="email" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your email address" placeholder="Business Name">
							</div>
						</div>

						<div class="col-md-6 float-left">
							<div class="input-group">
								<select class="reg-select z-100" id="sel1">
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

						<div class="col-md-6 pr-0 float-left">
							<div class="input-group">
								<select class="reg-select z-100" id="sel2">
										<option value="-">--Select your Industry--</option>
										<option value="Accountant">Accountant</option>
										<option value="Alarm Company">Alarm Company</option>
										<option value="Alternative Therapy">Alternative Therapy</option>
										<option value="Appriasal">Appriasal</option>
										<option value="Audio & TV">Audio & TV</option>
										<option value="Baby Sitting">Baby Sitting</option>
										<option value="Barber">Barber</option>
										<option value="Business Services">Business Services</option>
										<option value="Cabinetry">Cabinetry</option>
										<option value="Calking & Sealants">Calking & Sealants</option>
										<option value="Catering">Catering</option>
										<option value="CPU Services">CPU Services</option>
										<option value="Credit Repair">Credit Repair</option>
										<option value="Concrete & Asphalt">Concrete & Asphalt</option>
										<option value="Cooking">Cooking</option>
										<option value="Credit Counselor">Credit Counselor</option>
										<option value="Deck & Patio">Deck & Patio</option>
										<option value="Demolition">Demolition</option>
										<option value="Docment Storage & Destruction">Docment Storage & Destruction</option>
										<option value="Doors">Doors</option>
										<option value="Drywall">Drywall</option>
										<option value="Fencing">Fencing</option>
										<option value="Financial Planner">Financial Planner</option>
										<option value="Fireplace & Chimney">Fireplace & Chimney</option>
										<option value="Fitness">Fitness</option>
										<option value="Fleet & Trucks">Fleet & Trucks</option>
										<option value="Graphics & Printing">Graphics & Printing</option>
										<option value="Gutters">Gutters</option>
										<option value="Handy Man">Handy Man</option>
										<option value="Health & Beauty">Health & Beauty</option>
										<option value="Home Inspection">Home Inspection</option>
										<option value="Install & Assemble">Install & Assemble</option>
										<option value="Insurance">Insurance</option>
										<option value="Interior & Surface Cleaning">Interior & Surface Cleaning</option>
										<option value="IT & Networking">IT & Networking</option>
										<option value="Janitorial">Janitorial</option>
										<option value="Junk Removal">Junk Removal</option>
										<option value="Lanscaper">Lanscaper</option>
										<option value="Laundry">Laundry</option>
										<option value="Legal and Medical fields">Legal and Medical fields</option>
										<option value="Lender">Lender</option>
										<option value="Lighting">Lighting</option>
										<option value="Locksmith">Locksmith</option>
										<option value="Marine Services">Marine Services</option>
										<option value="Massage">Massage</option>
										<option value="Medical">Medical</option>
										<option value="Mortgage Broker">Mortgage Broker</option>
										<option value="Moving">Moving</option>
										<option value="Music & Singing">Music & Singing</option>
										<option value="Natural Stone">Natural Stone</option>
										<option value="Neighborhood Chores">Neighborhood Chores</option>
										<option value="Notary">Notary</option>
										<option value="Organization & Interior Design">Organization & Interior Design</option>
										<option value="Parties">Parties</option>
										<option value="Painter">Painter</option>
										<option value="Pets">Pets</option>
										<option value="Photography">Photography</option>
										<option value="Pool & Spa">Pool & Spa</option>
										<option value="Plumber">Plumber</option>
										<option value="Propert Manager">Propert Manager</option>
										<option value="Real Estate">Real Estate</option>
										<option value="Restoration">Restoration</option>
										<option value="Rehuatory & Environmental">Rehuatory & Environmental</option>
										<option value="Roof & Attic">Roof & Attic</option>
										<option value="Rug Cleaning">Rug Cleaning</option>
										<option value="Security">Security</option>
										<option value="Sewer & Septic">Sewer & Septic</option>
										<option value="Sliding">Sliding</option>
										<option value="Sprinkler Systems">Sprinkler Systems</option>
										<option value="Smart Home">Smart Home</option>
										<option value="Snow Removal">Snow Removal</option>
										<option value="Solar & Energy">Solar & Energy</option>
										<option value="Tax Planner">Tax Planner</option>
										<option value="Tech Help">Tech Help</option>
										<option value="Transportation">Transportation</option>
										<option value="Device Repair">Device Repair</option>
										<option value="Tile & Grout">Tile & Grout</option>
										<option value="Tree Services">Tree Services</option>
										<option value="Tutoring">Tutoring</option>
										<option value="Water Heater">Water Heater</option>
										<option value="Water Transfer Printing">Water Transfer Printing</option>
										<option value="Water Treatment">Water Treatment</option>
										<option value="Well Pumps">Well Pumps</option>
										<option value="Widlife Control">Widlife Control</option>
										<option value="Windows">Windows</option>
										<option value="Wines">Wines</option>
								</select>
							</div>
						</div>

						<div class="col-md-6 float-left">
							<div class="input-group">
								<select class="reg-select z-100" id="sel3">
										<option>--Select your Role--</option>
										<option>Aerospace Industry</option>
										<option>Transport Industry</option>
										<option>Computer Industry</option>
										<option>Telecommunication industry</option>
										<option>Agriculture industry</option>
										<option>Construction Industry</option>
										<option>Education Industry</option>
								</select>
							</div>
						</div>


						<div class="col-md-12">
							<div class="input-group">
								<input autocomplete="off" type="password" name="email" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Create your password" placeholder="Create your password">
							</div>
						</div>

						<div class="col-sm-12">
							<a href="<?php echo url('/home/signup') ?>" class="btn btn-green-2">
								 Sign up
							</a>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</section>
<?php include viewPath('frontcommon/footer'); ?>
