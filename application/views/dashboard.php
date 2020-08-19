<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header_accounting'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <!-- page wrapper start -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-2">
                        <h1 class="page-title">Dashboard</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Welcome to  Dashboard</li>
                        </ol>
                    </div>

					<style>
						.smart__grid{
							background: #fff;
							display: grid;
							grid-template-columns: 1fr 1fr;
							grid-gap: 10px;
							height: 78vh;
							padding: 10px;
						}
						.smart__grid > div{
							background: #f2f2f2;
							text-align: center;
							display: flex;
							align-items: center;
							justify-content: center;
						}
					</style>

					<div class="col-12 d-md-none d-block p-0">
					<div class="smart__grid" id="1">
							<div><a href="http://nsmartrac.com/workorder/add">Add Work Order</a></div>
							<div>Sales</div>
							<div>View Customer</div>
							<div>Inquiries</div>
							<div><a href="http://nsmartrac.com/workorder">Work Orders</a></div>
							<div>Marketing</div>
							<div>Reports</div>
							<div><a href="http://nsmartrac.com/workcalender">schedule</a></div>
							<div>Inventory</div>
							<div>Items</div>
							<div><a href="http://nsmartrac.com/menu3">Sub Menu 1</div>
							<div><a href="http://nsmartrac.com/menu2">Sub Menu 2</a></div>
					</div>

					</div>

                    <div class="col-sm-6 d-none d-lg-flex">

                    </div>
                    <div class="col-sm-4">
                        <div class="float-right d-none d-md-block">
						<ol class="breadcrumb">
							<?php $image = base_url('uploads/users/default.png'); ?>
							<img src="<?php echo $image; ?>" alt="user" class="rounded-circle" style="height: 50px;">
                            <!-- <img src="<?php //echo (userProfile(logged('id'))) ? userProfile(logged('id')) : $url->assets ?>" alt="user" class="rounded-circle" style="height: 50px;"> -->
                            <?php
                               /*$id = logged('id');
                               $query = $this->db->query("Select name from users where id = $id");
                               $query11 = $query->row();  */
                            ?>
                            <h5 style="margin: 13px 0 0px 10px;"><?php echo getLoggedName();?></h5>
                        </ol>
							<!--
                            <div class="dropdown"><button
                                    class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light"
                                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="mdi mdi-settings mr-2"></i> Settings</button>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                        href="index.html#">Action</a> <a class="dropdown-item"
                                        href="index.html#">Another action</a> <a class="dropdown-item"
                                        href="index.html#">Something else here</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item"
                                        href="index.html#">Separated link</a>
                                </div>
                            </div>
							-->
                        </div>
                    </div>
                </div>
            </div><!-- end row -->

			<style>
				.qUickStart{
					/* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#fcfcfc+0,eaeaea+100 */
					background: #fcfcfc; /* Old browsers */
					background: -moz-linear-gradient(top,  #fcfcfc 0%, #eaeaea 100%); /* FF3.6-15 */
					background: -webkit-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* Chrome10-25,Safari5.1-6 */
					background: linear-gradient(to bottom,  #fcfcfc 0%,#eaeaea 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#eaeaea',GradientType=0 ); /* IE6-9 */
					display: flex;
					align-items: center;
					padding: 16px;
					border-radius: 4px;
					border: 1px solid #ddd;
					margin-bottom:15px;
				}
				.qUickStart:last-child{
					margin-bottom:0px;
				}
				.qUickStart .icon{
					background:#2d1a3e !important;
					flex: 0 0 70px;
					height: 70px;
					border-radius: 100%;
					display: inline-flex;
					align-items: center;
					justify-content: center;
					font-size: 25px;
					color:#fff;
					margin-right: 10px;
				}
				.qUickStart .qUickStartde h4{
					font-size: 16px;
					text-transform: uppercase;
					font-weight: 700;
					margin: 0;
					margin-bottom: 0px;
					margin-bottom: 6px;
				}
				.qUickStart .qUickStartde span{
					opacity: 0.6;
				}
			</style>

            <div class="row d-none d-lg-flex">
				<div class="col-md-5">
					<div class="card">
						<div class="card-body">
							<h4 class="mt-0 header-title mb-4">Quick Start</h4>
							<div class="qUickStart">
								<span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">A</span>
								<div class="qUickStartde">
									<h4><a href="<?php echo url('/customer/add_lead') ?>">Add a New Client</a></h4>
									<span>Sign up a new client and add to database</span>
								</div>
							</div>
							<div class="qUickStart">
								<span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">B</span>
								<div class="qUickStartde">
									<h4><a href="<?php echo url('/customer') ?>">Select an Existing Client</a></h4>
									<span>Work with an existing client</span>
								</div>
							</div>
							<div class="qUickStart">
								<span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">C</span>
								<div class="qUickStartde">
									<h4><a id="shortcut_link" href="#<?php //echo url('/workorder/add') ?>">Add a New Event</a></h4>
									<span>Choose from a various quick shortcuts</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="card">
					<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="card mini-stat bg-primary text-white">
								<div class="card-body">
									<div class="mb-4">
										<div class="float-left mini-stat-img mr-4"><img src="<?php echo $url->assets ?>dashboard/images/services-icon/01.png" alt=""></div>
										<h5 class="font-16 text-uppercase mt-0 text-white-50">Earned Today</h5>
										<h4 class="font-500">$0.00 <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>

									</div>
									<div class="pt-2">
										<div class="float-right"><a href="index.html#" class="text-white-50"><i
													class="mdi mdi-arrow-right h5"></i></a></div>
										<p class="text-white-50 mb-0">Since last month</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card mini-stat bg-primary text-white">
								<div class="card-body">
									<div class="mb-4">
										<div class="float-left mini-stat-img mr-4"><img src="<?php echo $url->assets ?>dashboard/images/services-icon/02.png"
												alt=""></div>
										<h5 class="font-16 text-uppercase mt-0 text-white-50">Total Jobs month to date</h5>
										<h4 class="font-500">0 (Avg: $0.00) <i class="mdi mdi-arrow-down text-danger ml-2"></i></h4>

									</div>
									<div class="pt-2">
										<div class="float-right"><a href="index.html#" class="text-white-50"><i
													class="mdi mdi-arrow-right h5"></i></a></div>
										<p class="text-white-50 mb-0">Since last month</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card mini-stat bg-primary text-white">
								<div class="card-body">
									<div class="mb-4">
										<div class="float-left mini-stat-img mr-4"><img src="<?php echo $url->assets ?>dashboard/images/services-icon/03.png"
												alt=""></div>
										<h5 class="font-16 text-uppercase mt-0 text-white-50">Total Invoice Due</h5>
										<h4 class="font-500">$0.00 (0) <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>

									</div>
									<div class="pt-2">
										<div class="float-right"><a href="index.html#" class="text-white-50"><i
													class="mdi mdi-arrow-right h5"></i></a></div>
										<p class="text-white-50 mb-0">Since last month</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card mini-stat bg-primary text-white">
								<div class="card-body">
									<div class="mb-4">
										<div class="float-left mini-stat-img mr-4"><img src="<?php echo $url->assets ?>dashboard/images/services-icon/04.png"
												alt=""></div>
										<h5 class="font-16 text-uppercase mt-0 text-white-50">Total Estimate Pending</h5>
										<h4 class="font-500">0.00 <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>

									</div>
									<div class="pt-2">
										<div class="float-right"><a href="index.html#" class="text-white-50"><i
													class="mdi mdi-arrow-right h5"></i></a></div>
										<p class="text-white-50 mb-0">Since last month</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
                </div>
                </div>
            </div><!-- end row -->

			<div class="row d-none d-lg-flex mb-1">
				<div class="col-sm-6">
					<div class="dropdown dropdown-inline filter-date">
						<div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<span class="fa fa-calendar margin-right-sec"></span><span data-filter-date="selected-item-name">This Year</span> <span class="caret"></span>
						</div>
						<ul class="dropdown-menu btn-block" role="menu">
							<li data-filter-date="item" data-date-start="2020-01-01" data-date-end="2020-12-31" data-name="This Year" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year</a></li>
							<li data-filter-date="item" data-date-start="2020-07-01" data-date-end="2020-09-30" data-name="This Year - Q3" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year - Q3</a></li>
							<li data-filter-date="item" data-date-start="2020-04-01" data-date-end="2020-06-30" data-name="This Year - Q2" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year - Q2</a></li>
							<li data-filter-date="item" data-date-start="2020-01-01" data-date-end="2020-03-31" data-name="This Year - Q1" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year - Q1</a></li>
							<li data-filter-date="item" data-date-start="2020-08-01" data-date-end="2020-08-31" data-name="This Month" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Month</a></li>
							<li data-filter-date="item" data-date-start="2020-08-03" data-date-end="2020-08-09" data-name="This Week" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Week</a></li>
							<li data-filter-date="item" data-date-start="2019-01-01" data-date-end="2019-12-31" data-name="Previous Year" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year</a></li>
							<li data-filter-date="item" data-date-start="2019-10-01" data-date-end="2019-12-31" data-name="Previous Year - Q4" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year - Q4</a></li>
							<li data-filter-date="item" data-date-start="2019-07-01" data-date-end="2019-09-30" data-name="Previous Year - Q3" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year - Q3</a></li>
							<li data-filter-date="item" data-date-start="2019-04-01" data-date-end="2019-06-30" data-name="Previous Year - Q2" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year - Q2</a></li>
							<li data-filter-date="item" data-date-start="2019-01-01" data-date-end="2019-03-31" data-name="Previous Year - Q1" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year - Q1</a></li>
							<li data-filter-date="item" data-date-start="2020-07-01" data-date-end="2020-07-31" data-name="Previous Month" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Month</a></li>
							<li data-filter-date="item" data-date-start="2020-07-27" data-date-end="2020-08-02" data-name="Previous Week" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Week</a></li>
							<li data-filter-date="item" data-date-start="2018-01-01" data-date-end="2018-12-31" data-name="FY 2018" role="presentation"><a role="menuitem" tabindex="-1" href="#">FY 2018</a></li>
							<li data-filter-date="item" data-date-start="2017-01-01" data-date-end="2017-12-31" data-name="FY 2017" role="presentation"><a role="menuitem" tabindex="-1" href="#">FY 2017</a></li>
							<li data-filter-date="item" data-date-start="2016-01-01" data-date-end="2016-12-31" data-name="FY 2016" role="presentation"><a role="menuitem" tabindex="-1" href="#">FY 2016</a></li>
						</ul>
					</div>
					<span class="margin-left">For <span data-date-filter="date-interval">01-Jan-2020 to 31-Dec-2020</span></span>
				</div>
				<div class="col-sm-6 text-right-sm">
					<span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">customize</span>
					<div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
						<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
					</div>
				</div>
            </div>


             <div class="row d-none d-lg-flex sortable2">
                 <?php
                 $modules = explode(",", $dashboard_sort->ds_values);
                 for($x=0;$x<count($modules);$x++){
                     include viewPath('dashboard/'.$modules[$x]);
                 }
                 ?>
            </div><!-- end row -->

             <div class="row d-none d-lg-flex">

            </div><!-- end row -->

            <div class="row d-none d-lg-flex">
            	<div class="col-xl-12">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <div class="tradingview-widget-copyright" style="z-index:1;font-size: 12px !important;line-height: 32px !important;text-align: center !important;vertical-align: middle !important;font-family: 'Trebuchet MS', Arial, sans-serif !important;color: #45a2f3 !important;position: relative;bottom: 4px;"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Ticker Tape</span></a> by TradingView</div>
                       <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                              {
                              "symbols": [
                                {
                                  "proName": "FOREXCOM:SPXUSD",
                                  "title": "S&P 500"
                                },
                                {
                                  "proName": "FOREXCOM:NSXUSD",
                                  "title": "Nasdaq 100"
                                },
                                {
                                  "proName": "FX_IDC:EURUSD",
                                  "title": "EUR/USD"
                                },
                                {
                                  "proName": "BITSTAMP:BTCUSD",
                                  "title": "BTC/USD"
                                },
                                {
                                  "proName": "BITSTAMP:ETHUSD",
                                  "title": "ETH/USD"
                                },
                                {
                                  "proName": "RF"
                                },
                                {
                                  "proName": "LOW"
                                },
                                {
                                    "proName": "HD"
                                },
                                {
                                    "proName": "AMZN"
                                },
                                {
                                    "proName": "HON"
                                },
                                {
                                    "proName": "GE"
                                },
                                {
                                    "proName": "AAPL"
                                },
                                {
                                    "proName": "WMT"
                                },
                                {
                                    "proName": "DIS"
                                },
                                {
                                    "proName": "FB"
                                },
                                {
                                    "proName": "CIT"
                                },
                                {
                                    "proName": "UA"
                                },
                                {
                                    "proName": "BAC"
                                },
                                {
                                    "proName": "SSL"
                                },
                                {
                                    "proName": "CNTY"
                                },
                                {
                                    "proName": "MCD"
                                },
                                {
                                    "proName": "CCL"
                                },
                                {
                                    "proName": "KO"
                                },
                                {
                                    "proName": "JBLU"
                                },
                                {
                                    "proName": "AAL"
                                },
                                {
                                    "proName": "NYMT"
                                },
                                {
                                    "proName": "NFLX"
                                },
                                {
                                    "proName": "BP"
                                },
                                {
                                    "proName": "TGT"
                                },
                                {
                                    "proName": "DAL"
                                },
                                {
                                    "proName": "ZAGG"
                                },
                                {
                                    "proName": "BUD"
                                },
                                {
                                    "proName": "UPS"
                                },
                                {
                                    "proName": "KIRK"
                                },
                                {
                                    "proName": "BGG"
                                }
                              ],
                                  "colorTheme": "light",
                                  "isTransparent": false,
                                  "displayMode": "adaptive",
                                  "locale": "en"
                              }
                        </script>
                    </div>
                    <!-- TradingView Widget END -->
            	</div>
            </div>
            <br />
            <div class="row d-none d-lg-flex">

            </div>

            <div class="dash-last-wrpper">
            	<div class="row">
            		<div class="col-md-7 col-sm-6">
            			<div class="com-newlat">
            				<div class="news-hed">
            					<img src="<?php echo $url->assets ?>dashboard/images/new-img.png" alt="">
            					<h4>Company Newsletter</h4>
            				</div>

            				<div class="inner-news">
            					<p>Welcome to enGrade!</p>
            				</div>
            			</div>

            			<div class="spot-box">
    						<div class="spot-img">
    							<img src="<?php echo $url->assets ?>dashboard/images/users/user-3.jpg" alt="">
    						</div>
    						<div class="spot-head">
    							<h4>Today's Spotlight</h4>
    						</div>
            			</div>

            			<div class="corpo-box">
            				<h4>Corporate Bulletin</h4>
            			</div>
            		</div>
            		<div class="col-md-5 col-sm-5">
            			<div class="corpo-box state-box">
            				<h4>My Stats</h4>

            				<table class="table">
							    <thead>
							      	<tr>
								        <th>Total Sold</th>
								        <th>Installed</th>
								        <th>Scheduled</th>
								        <th>Tickets</th>
							      	</tr>
							    </thead>
							    <tbody>
							      	<tr>
							        	<td>36</td>
							        	<td>35</td>
							        	<td>0</td>
							        	<td>0</td>
							      	</tr>
							    </tbody>
							</table>
            			</div>

            			<div class="corpo-box">
            				<h4>Top Installs</h4>

            				<div class="top-ins-in">
	            				<div class="row">
	            					<div class="col-md-6 col-sm-6">
	            						<div class="insl-bx">
	            							<h5>Top Reps</h5>

	            							<ul>
	            								<li><strong>1.</strong> T.Smith (COR) - <span>133</span></li>
	            								<li><strong>2.</strong> T.Smith (COR) - <span>133</span></li>
	            							</ul>
	            						</div>
	            					</div>
	            					<div class="col-md-6 col-sm-6">
	            						<div class="insl-bx">
	            							<h5>Top Techs</h5>

	            							<ul>
	            								<li><strong>1.</strong> T.Smith (COR) - <span>133</span></li>
	            								<li><strong>2.</strong> T.Smith (COR) - <span>133</span></li>
	            								<li><strong>3.</strong> T.Smith (COR) - <span>133</span></li>
	            								<li><strong>4.</strong> T.Smith (COR) - <span>133</span></li>
	            								<li><strong>5.</strong> T.Smith (COR) - <span>133</span></li>
	            								<li><strong>6.</strong> T.Smith (COR) - <span>133</span></li>
	            							</ul>
	            						</div>
	            					</div>
	            				</div>
	            			</div>

	            			<div class="view-all-bx">
	            				<a href="#">View All</a>
	            			</div>
            			</div>
            		</div>
            	</div>
            </div>
        </div><!-- end container-fluid -->
    </div><!-- page wrapper end -->




<div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
  <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">History</span>
          <span class="mdc-bottom-navigation__list-item__text">Recents</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">Favorite</span>
          <span class="mdc-bottom-navigation__list-item__text">Favorites</span>
        </span>
        <span class="sc-nearby mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
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
<div style="display: none;" class="floating-btn-div div1">
	<label class="label"><a href="#">Reschedule</a></label>
	<a href="#" class="float1">
	<i class="fa fa-calendar my-float"></i>
	</a>
</div>
<div style="display: none;" class="floating-btn-div div2">

	<label class="label"><a href="#">Request Signature</a></label>
	<a href="#" class="float2">
	<i class="fa fa-external-link my-float"></i>
	</a>
</div>
<div style="display: none;" class="floating-btn-div div3">
	<label class="label"><a href="#">Notes</a></label>
	<a href="#" class="float3">
	<i class="fa fa-file my-float"></i>
	</a>
</div>
<div style="display: none;" class="floating-btn-div div4">
	<label class="label"><a href="#">Log Time</a></label>
	<a href="#" class="float4">
	<i class="fa fa-clock-o my-float"></i>
</a>
</div>
<div style="display: none;" class="floating-btn-div div5">
	<label class="label"><a href="#">Convert To Estimate</a></label>
	<a href="#" class="float5">
	<i class="fa fa-calculator my-float"></i>
	</a>
</div>
<div style="display: none;" class="floating-btn-div div6">
	<label class="label"><a href="#">Convert To Invoice</a></label>
	<a href="#" class="float6">
	<i class="fa fa-money my-float"></i>
	</a>
</div>
<div style="display: none;" class="floating-btn-div div7">
	<label class="label"><a href="#">Change Order</a></label>
	<a href="#" class="float7">
	<i class="fa fa-edit my-float"></i>
	</a>
</div>

<div style="display: none;" class="floating-btn-div div8">
	<label class="label"><a href="#">Change Status</a></label>
	<a href="#" class="float8">
	<i class="fa fa-flag my-float"></i>
	</a>
</div>
<div style="display: none;" class="floating-btn-div div9">
	<label class="label"><a href="#">Cancel Schedule</a></label>
	<a href="#" class="float9">
	<i class="fa fa-stop-circle my-float"></i>
	</a>
</div>
<div style="display: none;" class="floating-btn-div div10">
	<label class="label"><a href="#">Attach Photo</a></label>
	<a href="#" class="float10">
	<i class="fa fa-picture-o my-float"></i>
	</a>
</div>
<div style="display: none;" class="floating-btn-div div11">
	<label class="label"><a href="#">Assign New Lead</a></label>
	<a href="#" class="float11">
	<i class="fa fa-picture-o my-float"></i>
	</a>
</div>


<style type="text/css">

    .ui-state-default{
        border: 0 !important;
        background: #dddddd !important;
    }
.float1, .float2, .float3, .float4, .float5, .float6, .float7, .float8, .float9, .float10, .float11 {
	color: #2d1a3e;
    background-color: #fff;
    border-radius: 25px;
    margin-bottom: 5px;
}
.float1{
	position:fixed;
	width:40px;
	height:40px;
	bottom:40px;
	right:20px;
	/*background-color:#0C9;*/
	/*color:#FFF;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div1 {
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 40px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}
.float2{
	position:fixed;
	width:40px;
	height:40px;
	bottom:110px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div2 {
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 110px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}
.float3{
	position:fixed;
	width:40px;
	height:40px;
	bottom:180px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div3 {
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 180px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}

.float4{
	position:fixed;
	width:40px;
	height:40px;
	bottom:250px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div4{
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 250px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}

.float5{
	position:fixed;
	width:40px;
	height:40px;
	bottom:320px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div5{
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 320px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}

.float6{
	position:fixed;
	width:40px;
	height:40px;
	bottom:390px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div6{
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 390px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}
.float7{
	position:fixed;
	width:40px;
	height:40px;
	bottom:460px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div7{
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 460px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}
.float8{
	position:fixed;
	width:40px;
	height:40px;
	bottom:530px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div8{
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 530px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}
.float9{
	position:fixed;
	width:40px;
	height:40px;
	bottom:600px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div9{
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 600px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}

.float10{
	position:fixed;
	width:40px;
	height:40px;
	bottom:670px;
	right:20px;
	/*background-color:transparent;*/
	/*color:#2d1a3e;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div10{
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 670px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}
.float11{
	position:fixed;
	width:40px;
	height:40px;
	bottom:740px;
	right:20px;
	/*background-color:#0C9;*/
	/*color:#FFF;*/
	/*border-radius:50px;*/
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}
.div11 {
	width: 250px;
	/*border: 1px solid #000;*/
	position: fixed;
	height: 50px;
	bottom: 740px;
	right: 20px;
	text-align: center;
	color: #fff;
	background-color: #ccc;
}
.label{
	margin-top: 15px;
}
.my-float{
	/*margin-top:22px;*/
	/*margin-top:20px;*/
	margin-top: 15px;
}


/* Important stuff */
.mdc-bottom-navigation {
  height: 56px;
  background-color: var(--mdc-theme-background, #fff);
  width: 100%;
  box-shadow: 0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);
  overflow: hidden;
  z-index: 8;
}
 .hid-desk{
display: none;
 }
@media only screen and (max-width: 600px) {
  .hid-desk{
display: block !important;
 }
}

</style>

    <?php include viewPath('includes/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha512-G8JE1Xbr0egZE5gNGyUm1fF764iHVfRXshIoUWCTPAbKkkItp/6qal5YAHXrxEu4HNfPTQs6HOu3D5vCGS1j3w==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.floating-btn-div').hide();
		$('#shortcut_link').on('click', function(e){
			if ( $('.float1').is(':hidden') && $('.float2').is(':hidden') && $('.float3').is(':hidden') ){
				$('.floating-btn-div ').show('slow');
				$('.floating-btn-div ').show('slow');
				$('.floating-btn-div ').show('slow');
			}
			else{
				$('.floating-btn-div ').hide('slow');
				$('.floating-btn-div ').hide('slow');
				$('.floating-btn-div ').hide('slow');
			}
		});

        $('#onoff-customize').change(function() {
            if(this.checked) {
                $( ".sortable2" ).sortable( "enable" );
            }else{
                $( ".sortable2" ).sortable( "disable" );
            }

        });

        //$( ".sortable2" ).sortable( "enable" );
        $( ".sortable2" ).sortable({
            start: function(e, ui) {
                // creates a temporary attribute on the element with the old index
                $(this).attr('data-previndex', ui.item.index());
            },
            update: function(e, ui) {
                // gets the new and old index then removes the temporary attribute
                var newIndex = ui.item.index();
                var oldIndex = $(this).attr('data-previndex');
                var element_id = ui.item.attr('id');
                console.log('id of Item moved = '+element_id+' old position = '+oldIndex+' new position = '+newIndex);
                $(this).removeAttr('data-previndex');
                console.log("Module Changed!");

                var idsInOrder = $(".sortable2").sortable("toArray");
                console.log(idsInOrder);

                var new_module_sort = "";
                for(var x=0;x<idsInOrder.length;x++){
                    if(x===0){
                        new_module_sort = new_module_sort + idsInOrder[x];
                    }else{
                        new_module_sort = new_module_sort +","+idsInOrder[x];
                    }
                    console.log(idsInOrder[x]);
                }
                console.log(new_module_sort);
                $.ajax({
                    type: "POST",
                    url: "/dashboard/ac_dashboard_sort",
                    data: {ds_values : new_module_sort,acds_id : <?php echo $dashboard_sort->acds_id; ?>}, // serializes the form's elements.
                    success: function(data)
                    {
                        console.log(data);
                    }
                });
            }
        });
        $( ".sortable2" ).sortable( "disable" );
	});
</script>
<!-- monthy graph -->
<script type="text/javascript">
	var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
datasets: [{
label: '# of Votes',
data: [12, 19, 3, 5, 2, 3],
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)'
],
borderColor: [
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
}
});

//doughnut
var ctxD = document.getElementById("doughnutChart").getContext('2d');
var myLineChart = new Chart(ctxD, {
type: 'doughnut',
data: {
labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
datasets: [{
data: [300, 50, 100, 40, 120],
backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
}]
},
options: {
responsive: true
}
});

//polar
var ctxPA = document.getElementById("polarChart").getContext('2d');
var myPolarChart = new Chart(ctxPA, {
type: 'polarArea',
data: {
labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
datasets: [{
data: [300, 50, 100, 40, 120],
backgroundColor: ["rgba(219, 0, 0, 0.1)", "rgba(0, 165, 2, 0.1)", "rgba(255, 195, 15, 0.2)",
"rgba(55, 59, 66, 0.1)", "rgba(0, 0, 0, 0.3)"
],
hoverBackgroundColor: ["rgba(219, 0, 0, 0.2)", "rgba(0, 165, 2, 0.2)",
"rgba(255, 195, 15, 0.3)", "rgba(55, 59, 66, 0.1)", "rgba(0, 0, 0, 0.4)"
]
}]
},
options: {
responsive: true
}
});
</script>
