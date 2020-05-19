<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
    <!-- page wrapper start -->
     
	 
	<div role="wrapper">
		<nav class="navbar-side userorder d-none d-md-block">
			<ul class="nav">
				<!--<span class="nav-close">
					<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>
				</span>-->
				<li class="nav-header">Work Order</li>
				<li class="active"><a href="<?php echo url('users/businessview') ?>" title="My Profile"><span class="fa fa-file-text-o"></span>Work Order</a></li>
				<li><a href="<?php echo url('users/businessdetail') ?>" title="Business Details"><span class="fa fa-map-marker"></span>Bird Eye View</a></li>
				<li><a href="" title="Services"><span class="fa fa-tag"></span>   Job Type List</a></li>
				<li><a href="" title="Credentials"><span class="fa fa-thumb-tack"></span> Priority List</a></li>
				<li><a href="" title="Availability"><span class="fa fa-cog"></span>setting</a></li>
				<li><a href="" title="Work Pictures"><span class="fa fa-list"></span> Checklists</a></li> 
		
			</ul>
		</nav>
		<div wrapper__section>
				<div class="order-heading">
					<h1>Work Order #WO-00396</h1>
				</div>

				<div class="order-menu">
					<div class="row">
						<div class="col-md-4">
										<div class="user-return">
											<a href=""><i class="fa fa-angle-left" aria-hidden="true"></i> Return to Work Orders</a>
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


			<div class="row">
				<div class="col-md-8">
					<div role="white__holder">
							<div class="workorder-inner">
								<div clas="row">
										<div class="col-sm-12 col-sm-push-12 text-right-sm ">

										
														<div class="workorder-text" style="margin-top: 10px; margin-bottom: 20px;">
											                <span class="presenter-title">WORK ORDER</span><br>
											                <span># WO-00396</span>
											            </div>	
											            <div class="workord-table">
															<table class="presenter-info margin-bottom">
												                <tbody>
												                    <tr>
												                        <td><div style="margin-right: 20px;">Date:</div></td>
												                        <td class="text-right-sm">Mar 12, 2020</td>
												                    </tr>
												                                        <tr>
												                        <td><div style="margin-right: 20px;">Type:</div></td>
												                        <td class="text-right-sm">Service</td>
												                    </tr>
												                                                            <tr>
												                        <td><div style="margin-right: 20px;">Priority:</div></td>
												                        <td class="text-right-sm">Standard</td>
												                    </tr>
												                </tbody>
												            </table>

											            </div>
											
									</div>
									<div class="col-sm-12 col-sm-pull-12">
												<div style="margin-bottom: 20px;">
		                							<img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://oscuz.com/nsmartfrontend/assets/dashboard/images/logo.png">
		         							   </div>

		         							   <div class="user-info">
		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head"> FROM:</a></li>
		         							   				<li><a href="" class="ul-head">ADi</a></li>
		         							   				<li><a href="" class="ul-text">License: EF, AL, MS</a></li>
		         							   				<li><a href="" class="ul-text">6866 Pine Forest Road</a></li>
		         							   				<li><a href="" class="ul-text">Pensacola, FL, 32526</a></li>
		         							   				<li><a href="" class="ul-text">Email: moresecureadi@gmail.com</a></li>
		         							   				<li><a href="" class="ul-text">Phone: (850) 478-0530 </a></li>			   			
		         							   			</ul>
		         							   		</div>
		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">Customer:</a></li>
		         							   				<li><span class="ul-head line">Test customer</span><a href="" class="line ul-btns-text">view</a></li>
		         							   			
		         							   			</ul>
		         							   		</div>

		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">Job:</a></li>
		         							   				<li><a href="" class="ul-text">Job for Estimate #EST-000010</a></li>
		         							   				<li><a href="" class="ul-text">Estimate #EST-000010 </a></li>	
		         							   			
		         							   			</ul>
		         							   		</div>

		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">Appointment:</a></li>
		         							   		
		         							   				<li><a href="" class="ul-text">Not set </a></li>	
		         							   			
		         							   			</ul>
		         							   		</div>
		         							   			<div class="ul-info">
			         							   			<ul>
			         							   				<li><a href="" class="ul-head">Location:</a></li>
			         							   		
			         							   				<li><a href="" class="ul-btns">Show Map</a></li>	
			         							   			
			         							   			</ul>
		         							   			</div>

		         							   </div>
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
													                <tr class="table-items__tr">
													                    <td style="width: 30px; text-align: center;" valign="top">  1 </td>
													                    <td valign="top"> 4 Buttons Remote   </td>
													                    <td style="width: 50px; text-align: right;" valign="top"> 1  </td>
													                    <td style="width: 80px; text-align: right;" valign="top">
													                        $159.00       </td>
													                    <td style="width: 80px; text-align: right;" valign="top">
													                        $99.99<br>(62.89%)                    </td>
													                    <td style="width: 80px; text-align: right;" valign="top">
													                        $4.43<br>(7.5%)                    </td>
													                    <td style="width: 90px; padding: 8px 8px 8px 0; text-align: right;" valign="top">
													                        $63.44                    </td>
													                </tr>
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
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$63.44</td>
													                            </tr>
													                                                        <tr>
													                                <td style="padding: 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>Grand Total ($)</b></td>
													                                <td style="width: 90px; padding: 8px 8px 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>$63.44</b></td>
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
  