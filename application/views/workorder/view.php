<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<style>
/* common */
.ribbon {
  width: 150px;
  height: 150px;
  overflow: hidden;
  position: absolute;
}
.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: '';
  display: block;
  border: 5px solid #2980b9;
}
.ribbon span {
  position: absolute;
  display: block;
  width: 225px;
  padding: 15px 0;
  background-color: #3498db;
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  color: #fff;
  font: 700 18px/1 'Lato', sans-serif;
  text-shadow: 0 1px 1px rgba(0,0,0,.2);
  text-transform: uppercase;
  text-align: center;
}

/* top left*/
.ribbon-top-left {
  top: -10px;
  left: -10px;
}
.ribbon-top-left::before,
.ribbon-top-left::after {
  border-top-color: transparent;
  border-left-color: transparent;
}
.ribbon-top-left::before {
  top: 0;
  right: 0;
}
.ribbon-top-left::after {
  bottom: 0;
  left: 0;
}
.ribbon-top-left span {
  right: -25px;
  top: 30px;
  transform: rotate(-45deg);
}

/* top right*/
.ribbon-top-right {
  top: -10px;
  right: -10px;
}
.ribbon-top-right::before,
.ribbon-top-right::after {
  border-top-color: transparent;
  border-right-color: transparent;
}
.ribbon-top-right::before {
  top: 0;
  left: 0;
}
.ribbon-top-right::after {
  bottom: 0;
  right: 0;
}
.ribbon-top-right span {
  left: -25px;
  top: 30px;
  transform: rotate(45deg);
}

/* bottom left*/
.ribbon-bottom-left {
  bottom: -10px;
  left: -10px;
}
.ribbon-bottom-left::before,
.ribbon-bottom-left::after {
  border-bottom-color: transparent;
  border-left-color: transparent;
}
.ribbon-bottom-left::before {
  bottom: 0;
  right: 0;
}
.ribbon-bottom-left::after {
  top: 0;
  left: 0;
}
.ribbon-bottom-left span {
  right: -25px;
  bottom: 30px;
  transform: rotate(225deg);
}

/* bottom right*/
.ribbon-bottom-right {
  bottom: -10px;
  right: -10px;
}
.ribbon-bottom-right::before,
.ribbon-bottom-right::after {
  border-bottom-color: transparent;
  border-right-color: transparent;
}
.ribbon-bottom-right::before {
  bottom: 0;
  left: 0;
}
.ribbon-bottom-right::after {
  top: 0;
  right: 0;
}
.ribbon-bottom-right span {
  left: -25px;
  bottom: 30px;
  transform: rotate(-225deg);
}
</style>
    <!-- page wrapper start -->
     
	<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
				<div class="order-heading">
					<h3>Work Order # <?php echo $workorder->workorder_number ?></h3>
				</div>

				<div class="order-menu">
					<div class="row">
						<div class="col-md-4">
										<div class="user-return">
											<a href="<?php echo base_url('workorder'); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Return to Work Orders</a>
										</div>
						</div>
						<div class="col-md-8">
								<div class="order-right text-right">
									<div class="user-menu">
										<a class="btn sand-btn margin-right-sec" href="#"><span class="fa fa-money fa-margin-right"></span> Create Invoice</a>
									</div> 
									<div class="user-menu">
										 <a class="btn btn-sec" href=""><span class="fa fa-edit"></span> Edit</a>
                       						 <a class="btn btn-sec" data-print-modal="open" href="#" target="_blank"><span class="fa fa-file-pdf-o"></span> PDF</a>
          										  <a class="btn btn-sec" data-print-modal="open" href="#" target="_blank"><span class="fa fa-print"></span> Print</a>
									</div> 
							<div class="user-menu">
								<div class="dropdown dropdown-btn dropdown-inline margin-left-sec">
	           						 <button class="btn btn-sec btn-regular dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="false">
	               						 <span class="btn-label">More</span><span class="caret-holder"><span class="caret"></span></span>
	          						  </button>
           						 <ul class="dropdown-menu dropdown-menu-right usermenu-dropdown" role="menu" aria-labelledby="dropdown-edit">
	             				   		<li ><a  href="#" ><span class="fa fa-flag-o icon"></span> Change Status</a></li>
	               						 <li class="divider"></li>
	                               		 <li ><a  href="#" ><span class="fa fa-files-o icon"></span> Clone Work Order</a></li>
	                                       <li ><a href="#" ><span class="fa fa-file-text-o icon"></span> Convert to Estimate</a></li>
	                                       <li ><a  href=""><span class="fa fa-envelope-o icon"></span> Send to Customer</a></li>
	                                       <li class="divider"></li>
	              						  <li ><a   href="#" ><span class="fa fa-trash-o icon"></span> Delete Work Order</a></li>
                           		 </ul>
        </div>
									</div>

								</div>
						</div>
					</div>
				</div>


			<div class="row" style="padding:1%;">
				<div class="col-md-8">
					<div role="white__holder" style="background-color:;padding:5%;border:solid #F4F2F6 3px;box-shadow: 10px 5px 5px #DEDEDE;">
					<div class="ribbon ribbon-top-left"><span><?php echo $workorder->status ?></span></div>
							<div class="workorder-inner">
								<div clas="row">
										<div class="col-sm-12 col-sm-push-12 text-right-sm ">
										<div class="row">
											<div class="col-md-6">
												<div style="margin-bottom: 20px;">
													<img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png">
												</div>
											</div>
											<div class="col-md-6">
											<div class="workorder-text" style="margin-top: 10px; margin-bottom: 20px;">
											    <span class="presenter-title">WORK ORDER</span><br>
											    
												<!-- </div>	-->
												<div align="right"> 
													<table>
														<tbody>
														<tr>
															<td colspan="2"><span># <?php echo $workorder->work_order_number ?></span></td>
														</tr>
														<tr>
															<td align="left"><div style="margin-right: 10px;">Date:</div></td>
															<td align="left"><?php echo $workorder->date_created ?></td>
														</tr>
														<tr>
															<td align="left"><div style="margin-right: 10px;">Type:</div></td>
															<td align="left"><?php echo $workorder->job_type ?></td>
														</tr>
															<td align="left"><div style="margin-right: 10px;">Priority:</div></td>
															<td align="left"><?php echo $workorder->priority ?></td>
														</tr>
														</tbody>
													</table>
												</div>
											</div>
											</div>

											
										</div>
											
										</div>
									<!-- <div class="row">
										<div class="col-md-6">
											<div style="margin-bottom: 20px;">
												<img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png">
											</div>
										</div>
										<div class="col-md-6">
											
										</div>
									</div> -->
									<div class="col-sm-12 col-sm-pull-12">

		         							   <div class="user-info">
		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head"> FROM:</a></li>
		         							   				<li><a href="" class="ul-head"><?php echo $company->business_name ?></a></li>
		         							   				<li><a href="" class="ul-text">License: EF, AL, MS</a></li>
		         							   				<li><a href="" class="ul-text"><?php echo $company->business_address ?></a></li>
		         							   				<!-- <li><a href="" class="ul-text">Pensacola, FL, 32526</a></li> -->
		         							   				<li><a href="" class="ul-text">Email: <?php echo $company->email_address ?></a></li>
		         							   				<li><a href="" class="ul-text">Phone: <?php echo $company->phone_number ?> </a></li>			   			
		         							   			</ul>
		         							   		</div><br>
		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">Customer:</a></li>
		         							   				<li><span class="ul-head line"><?php echo $customer->contact_name .''. $customer->first_name .' '. $customer->middle_name .' '. $customer->last_name ?></span><a href="" class="line ul-btns-text" style="color:green;">view</a></li>
															<li><a href="" class="ul-text"><?php echo $customer->mail_add .' '. $customer->city .' '. $customer->state .', '. $customer->country .', '. $customer->zip_code ?></a></li>
															<li><a href="" class="ul-text">Phone: <?php echo $customer->phone_h ?></a></li>
		         							   			
		         							   			</ul>
		         							   		</div><br>

		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">Job:</a></li>
		         							   				<li><a href="" class="ul-text">Job for Estimate #EST-000010</a></li>
		         							   				<li><a href="" class="ul-text">Estimate #EST-000010 </a></li>	
		         							   			
		         							   			</ul>
		         							   		</div>

		         							   		<!-- <div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">Appointment:</a></li>
		         							   		
		         							   				<li><a href="" class="ul-text">Not set </a></li>	
		         							   			
		         							   			</ul>
		         							   		</div> --><br>
		         							   			<div class="ul-info">
			         							   			<ul>
			         							   				<li><a href="#" class="ul-head">Location </a></li>
																<li><?php echo $workorder->job_location .' '. $workorder->city .' '. $workorder->state .', '. $workorder->zip_code .', '. $workorder->cross_street  ?> &emsp; <a href="#" style="color:green;">Show Map</a></li>	
			         							   				<!-- <li></li>	 -->
			         							   			
			         							   			</ul>
		         							   			</div>

		         							   </div><br><br>
		         							   <!--  user info end-->

		         							   <div class="table-inner">
		         							   		<table class="table-print table-items" style="width: 100%; border-collapse: collapse;">
											            <thead>
											                <tr>
											                    <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">#</th>
											                    <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Services</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Qty</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Price</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Discount</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Tax (%)</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;" class="text-right">Total</th>
											                </tr>
											            </thead>
													            <tbody>
																<?php foreach($items as $item){ ?>
													                <tr class="table-items__tr">
													                    <td style="width: 30px; text-align: center;" valign="top">  # </td>
													                    <td valign="top"> <?php echo $item->item ?>   </td>
													                    <td style="width: 50px; text-align: right;" valign="top"> <?php echo $item->qty ?>  </td>
													                    <td style="width: 80px; text-align: right;" valign="top">$<?php echo $item->cost ?></td>
													                    <td style="width: 80px; text-align: right;" valign="top">
													                        <!-- $99.99<br>(62.89%)                     -->
																			$<?php echo $item->discount ?>
																			</td>
													                    <td style="width: 80px; text-align: right;" valign="top">
													                        <!-- $4.43<br>(7.5%)                     -->
																			$<?php echo $item->tax ?>
																			</td>
													                    <td style="width: 90px; padding: 8px 8px 8px 0; text-align: right;" valign="top">$<?php echo $item->total ?></td>
													                </tr>
																	<?php } ?>
													                <tr class="table-items__tr-last">
													                    <td></td>
													                    <td colspan="6"></td>
													                </tr>
													              </tbody>
     													   </table>

		         							   </div>

		         							   <!--  table container end  -->

		         							     <!--  table print start -->

		         							     <div class="table-inner">
		         							     	<table class="table-print" style="width: 100%; margin-top: 10px;">
													        <tbody>
													            <tr>
													                <td style="width: 50%; text-align: right;"></td>
													                <td>
													                    <table style="width: 100%; border-collapse: collapse;">
													                        <tbody>
													                            <tr>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">Subtotal</td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo $workorder->subtotal ?></td>
													                            </tr>
													                                                        <tr>
													                                <td style="padding: 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>Grand Total ($)</b></td>
													                                <td style="width: 90px; padding: 8px 8px 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>$<?php echo $workorder->grand_total ?></b></td>
													                            </tr>
													                          </tbody>
													                    </table>
													                </td>
													            </tr>
													        </tbody>
													    </table>

		         							     </div>
		         							        <!--  table print end -->


									</div>


								



								</div>
							</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="user-order-box">
						<div class="several-box">
							<div class="sand-heading margin-bottom-sec">Schedule Work Order</div>
							<div class="row">
              						  <div class="col-sm-4  col-md-12 col-lg-4"><span>Appointment</span></div>
                						<div class="col-sm-8 col-md-12 col-lg-8">
                                            <span>Not set</span>
                                   				 </div>
          					 </div>
          					 <div class="row margin-bottom-sec">
               							 <div class="col-sm-4 col-md-12 col-lg-4"><span>Assigned To</span></div>
                						<div class="col-sm-8 col-md-12 col-lg-8">
                                       		<p class="margin-bottom-sec"><span>No employees assigned.</span></p>
                                    	</div>
          					  </div>
		           				 <div class="row">
		             				   <div class="col-xl-12">
		                 		   <a class="btn sand-btn margin-right margin-bottom-sec" href="">Schedule &amp; Assign</a>
		             		   </div>
		                		<div class="col-xl-12">
		                    		<div class="margin-bottom-sec" style="padding-top: 9px;">
		                        <a href=""><span class="fa fa-calendar fa-margin-right"></span> View Schedule</a>
		                 		   </div>
		              		  </div>
		           		 </div>
						</div>


						<div class="several-box">
							<div class="sand-heading margin-bottom-sec">Time Log</div>
							<div class="row">
              						  		<div class="col-sm-4  col-md-12 col-lg-4"><span>Time In - Out</span></div>
               						 		<div class="col-sm-4  col-md-12 col-lg-4"><span>Hours:Mins</span></div>
               								 <div class="col-sm-4  col-md-12 col-lg-4"><span>Employee</span></div>
            				</div>
									<div class="several-text text-ter">No records</div>
									<div class="margin-top-sec margin-bottom-sec">
	               						 <div class="row">
	                  						  <div class="col-sm-4 col-md-12 col-lg-4"><span>Estimated</span><p>00:00</p></div>
	                  						  <div class="col-sm-4 col-md-12 col-lg-4"><span>Logged</span><p>00:00</p></div>
	                 						   <div class="col-sm-4 col-md-12 col-lg-4"><span>Lag</span><p>00:00</p></div>
	               						 </div>
	             						 
          							  </div>
						</div>

						<div class="several-box">
							<div class="sand-heading margin-bottom-sec">Expences</div>
				
									<div class="margin-top-sec margin-bottom-sec">
	               						 <div class="row">
	                  						  <div class="col-sm-3 col-md-12 col-lg-3"><span>All Total</span><p>$0.00 (0)</p></div>
	                  						  <div class="col-sm-3 col-md-12 col-lg-3"><span>Logged</span><p>$0.00 (0)</p></div>
	                  						  		  <div class="col-sm-3 col-md-12 col-lg-3"><span>Mileage</span><p>$0.00(0)</p></div>
	                 						   <div class="col-sm-3 col-md-12 col-lg-3"><span>Lag</span><p class="terx-ts">$63.44 (0)</p><p class="terx-ts"> (100%)</p></div>
	               						 </div>
	             						 
          							  </div>
          							  <div class="">

	            						    <a href="" class="sand-expence">View all</a> <span class="text-ter">&nbsp; | &nbsp;</span>
	               						 <a href="" class="sand-expence">Record Expense</a> <span class="text-ter">&nbsp; | &nbsp;</span>
	              								  <a href="" class="sand-expence">Record Mileage</a>
	            
          							  </div>
						</div>

									<div class="several-box">
						
							<div class="row">
              						  <div class="col-sm-4  col-md-12 col-lg-4"><span>Added</span></div>
                						<div class="col-sm-8  col-md-12 col-lg-8">
                                            <span>12 Mar, 2020 21:45</span>
                                   				 </div>
          					 </div>
          					 <div class="row margin-bottom-sec">
               							 <div class="col-sm-4  col-md-12 col-lg-4"><span>Status</span></div>
                						<div class="col-sm-8 col-md-12 col-lg-8">
                                       		<p class="margin-bottom-sec"><span>New</span></p>
                                    	</div>
          					  </div>
		           				 <div class="row">
		             				   <div class="col-xl-12">
		                 		   <a class="btn sand-btn margin-right margin-bottom-sec" href="">Change Status</a>

		                 		   <hr>
		                 		   <div class="weight-medium margin-bottom-sec">Log</div>
		                 		        		<p ><span>New Records</span></p>
		             		   </div>
		                
		           		 </div>
						</div>
					</div>

					<!--  second box-->
					
					
				</div>
			</div>

			<div class="row" style="padding:1%;">
				<div class="col-md-6">
					<h6>Location on Map</h6>
					<hr>
					<!-- aaa<div id="googleMap"></div> -->
					<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4">
					<div class="user-return">
						<a href="<?php echo base_url('workorder'); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Return to Work Orders</a>
				</div>
			</div>
		</div>
	</div>
	 

 
<div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
  <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">history</span>
          <span class="mdc-bottom-navigation__list-item__text">Recents</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">favorite</span>
          <span class="mdc-bottom-navigation__list-item__text">Favourites</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
            </svg>
          </span>
          <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
        </span>
      </nav>
    </div> 
</div>
<?php include viewPath('includes/footer'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initialize&libraries=&v=weekly"></script> -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&libraries=places"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=myMap"></script> -->
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initMap&libraries=&v=weekly"
      async
    ></script>
<script>
let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("googleMap"), {
	center: { lat: -34.397, lng: 150.644 },
	zoom: 8,
  });
}
</script>