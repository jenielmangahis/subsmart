<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
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
							background:
							#fff;
							display: grid;
							grid-template-columns: 1fr 1fr;
							grid-gap: 10px;
							height: 78vh;
							padding: 10px;
						}
						.smart__grid > div{
							background:
#f2f2f2;
text-align: center;
display: flex;
align-items: center;
justify-content: center;
						} 
					</style>
					
					<div class="col-12 d-md-none d-block p-0">
					<div class="smart__grid" id="1">
							<div><a href="http://oscuz.com/nsmartfrontend/workorder/add">Add Work Order</a></div>
							<div>Sales</div>
							<div>View Customer</div>
							<div>Inquiries</div>
							<div><a href="http://oscuz.com/nsmartfrontend/workorder">Work Orders</a></div>
							<div>Marketing</div>
							<div>Reports</div>
							<div><a href="http://oscuz.com/nsmartfrontend/workcalender">schedule</a></div>
							<div>Inventory</div>
							<div>Items</div>
							<div><a href="http://oscuz.com/nsmartfrontend/menu3">Sub Menu 1</div>
							<div><a href="http://oscuz.com/nsmartfrontend/menu2">Sub Menu 2</a></div>
					</div>
					 
					</div>
					
                    <div class="col-sm-6 d-none d-lg-flex">                     
                        
                    </div>
                    <div class="col-sm-4">
                        <div class="float-right d-none d-md-block">
						<ol class="breadcrumb">
                            <img src="<?php echo (userProfile(logged('id'))) ? userProfile(logged('id')) : $url->assets ?>" alt="user" class="rounded-circle" style="height: 50px;">
                            <?php 
                               $id = logged('id');
                               $query = $this->db->query("Select name from users where id = $id");
                               $query11 = $query->row();                             
                            ?>
                            <h5 style="margin: 30px 0 0px 10px;"><?php echo ucfirst($query11->name);?></h5>
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
								<span class="icon">A</span>
								<div class="qUickStartde">
									<h4><a href="<?php echo url('/items') ?>">Add a New Item</a></h4>
									<span>At vero eos et accusamus et iusto odio dignissimos ducimus qui deleniti atque..</span>
								</div>
							</div>
							<div class="qUickStart">
								<span class="icon">B</span>
								<div class="qUickStartde">
									<h4><a href="<?php echo url('/plans') ?>">Add a New Plan</a></h4>
									<span>At vero eos et accusamus et iusto odio dignissimos ducimus qui deleniti atque..</span>
								</div>
							</div>
							<div class="qUickStart">
								<span class="icon">C</span>
								<div class="qUickStartde">
									<h4><a href="<?php echo url('/workorder') ?>">Add a New Workorder</a></h4>
									<span>At vero eos et accusamus et iusto odio dignissimos ducimus qui deleniti atque..</span>
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
             <div class="row d-none d-lg-flex">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">Monthly Earning</h4>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div>
                                        <div id="chart-with-area" class="ct-chart earning ct-golden-section"></div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <p class="text-muted mb-4">This month</p>
                                                <h4>$0.00</h4>
                                                <p class="text-muted mb-5">It will be as simple as in fact it will be
                                                    occidental.</p><span class="peity-donut"
                                                    data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }'
                                                    data-width="72" data-height="72">4/5</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <p class="text-muted mb-4">Last month</p>
                                                <h4>$0.00</h4>
                                                <p class="text-muted mb-5">It will be as simple as in fact it will be
                                                    occidental.</p><span class="peity-donut"
                                                    data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }'
                                                    data-width="72" data-height="72">3/5</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div>
                    </div><!-- end card -->
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="mt-0 header-title mb-4">Sales Analytics</h4>
                            </div>
                            <div class="wid-peity mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted">Online</p>
                                            <h5 class="mb-4">0.00</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4"><span class="peity-line" data-width="100%"
                                                data-peity='{ "fill": ["rgba(2, 164, 153,0.3)"],"stroke": ["rgba(2, 164, 153,0.8)"]}'
                                                data-height="60">0.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="wid-peity mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted">Offline</p>
                                            <h5 class="mb-4">0.00</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4"><span class="peity-line" data-width="100%"
                                                data-peity='{ "fill": ["rgba(2, 164, 153,0.3)"],"stroke": ["rgba(2, 164, 153,0.8)"]}'
                                                data-height="60">0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted">Marketing</p>
                                            <h5>0.00</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4"><span class="peity-line" data-width="100%"
                                                data-peity='{ "fill": ["rgba(2, 164, 153,0.3)"],"stroke": ["rgba(2, 164, 153,0.8)"]}'
                                                data-height="60">0.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
             <div class="row d-none d-lg-flex">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Sales Report</h4>
                            <div class="cleafix">
                                <p class="float-left"><i class="mdi mdi-calendar mr-1 text-primary"></i> Jan 01 - Jan 31
                                </p>
                                <h5 class="font-18 text-right">$0.00</h5>
                            </div>
                            <div id="ct-donut" class="ct-chart wid"></div>
                            <div class="mt-4">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><span class="badge badge-primary">Desk</span></td>
                                            <td>Desktop</td>
                                            <td class="text-right">0.00%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-success">Mob</span></td>
                                            <td>Mobile</td>
                                            <td class="text-right">0.00%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-warning">Tab</span></td>
                                            <td>Tablets</td>
                                            <td class="text-right">0.00%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Activity</h4>
                            <ol class="activity-feed mb-0">
                                <li class="feed-item">
                                    <div class="feed-item-list"><span class="date">Jan 22</span> <span
                                            class="activity-text">Responded to need “Volunteer Activities”</span></div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list"><span class="date">Jan 20</span> <span
                                            class="activity-text">At vero eos et accusamus et iusto odio dignissimos
                                            ducimus qui deleniti atque...<a href="index.html#" class="text-success">Read
                                                more</a></span></div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list"><span class="date">Jan 19</span> <span
                                            class="activity-text">Joined the group “Boardsmanship Forum”</span></div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list"><span class="date">Jan 17</span> <span
                                            class="activity-text">Responded to need “In-Kind Opportunity”</span></div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list"><span class="date">Jan 16</span> <span
                                            class="activity-text">Sed ut perspiciatis unde omnis iste natus error sit
                                            rem.</span></div>
                                </li>
                            </ol>
                            <div class="text-center"><a href="index.html#" class="btn btn-primary">Load More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Sales Report</h4>
                            <div class="cleafix">
                                <p class="float-left"><i class="mdi mdi-calendar mr-1 text-primary"></i> Jan 01 - Jan 31
                                </p>
                                <h5 class="font-18 text-right">$0.00</h5>
                            </div>
                            <div id="ct-donut1" class="ct-chart wid"></div>
                            <div class="mt-4">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><span class="badge badge-primary">Desk</span></td>
                                            <td>Desktop</td>
                                            <td class="text-right">0.00%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-success">Mob</span></td>
                                            <td>Mobile</td>
                                            <td class="text-right">0.00%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-warning">Tab</span></td>
                                            <td>Tablets</td>
                                            <td class="text-right">0.00%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
            
        </div><!-- end container-fluid -->
    </div><!-- page wrapper end -->



 
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
 
 

<style>
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
  