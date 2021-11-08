<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
     /* body {
     background-color: #f9f9fa
 } */

 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 5rem
 }

 .card {
     background: #fff;
     border-width: 0;
     border-radius: .25rem;
     box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
     margin-bottom: 1.5rem
 }

 .card {
     position: relative;
     display: flex;
     flex-direction: column;
     min-width: 0;
     word-wrap: break-word;
     background-color: #fff;
     background-clip: border-box;
     border: 1px solid rgba(19, 24, 44, .125);
     border-radius: .25rem
 }

 .card-header {
     padding: .75rem 1.25rem;
     margin-bottom: 0;
     background-color: rgba(19, 24, 44, .03);
     border-bottom: 1px solid rgba(19, 24, 44, .125)
 }

 .card-header:first-child {
     border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
 }

 card-footer,
 .card-header {
     background-color: transparent;
     border-color: rgba(160, 175, 185, .15);
     background-clip: padding-box
 }

 .sidebarForm
 {
     display:none;
 }

 #myChart_
 {
	height:350px !important;
 }

 /* Style the tab */
.tab {
  overflow: hidden;
  /* border: 1px solid #ccc;
  background-color: #f1f1f1; */
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/accounting_dashboard.css"> -->

<script type="text/javascript" id="js">
    // var tableRows = document.getElementsByTagName('tr');
    // console.dir(tableRows);
</script>

<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div class="page-content page-container" id="page-content">
                    <!-- <div class="padding">
                        <div class="row">
                            <div class="container-fluid d-flex justify-content-center">
                                <div class="col-sm-8 col-md-12">
                                    <div class="card">
                                        <div class="card-header">Bar chart</div>
                                        <div class="card-body" style="height: 300px">
                                            <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                </div>
                                            </div> <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row" style="margin-top:3%;">
                        <div class="col-md-10">
                            <h6>CASH FLOW</h6>
                            <h4>$100,000</h4>
                            <h6>Current cash balance</h6>
                        </div>
                        <div class="col-md-2">
                            <div class="tab" align="right" style="text-align:right;">
                                <button class="tablinks" onclick="openCity(event, 'MoneyIn')" style="border-radius: 12px 0 0 12px;padding:6%;">Money in/out</button>
                                <button class="tablinks" onclick="openCity(event, 'MoneyOut')" style="border-radius: 0 12px 12px 0;padding:6%;">Cash balance</button>
                            </div>
                        </div>
                    </div>

                    <!-- <div id="container" style="width: 100%;">
                        <canvas id="canvas"></canvas>
                    </div> -->
					<canvas id="myChart_" style="width:80%;"></canvas>

                    <br><br>
                    <p style="border:solid #0098cd 1px;padding:1%;width:80%;color:#0098cd;"><i class="fa fa-info-circle" style="font-size:18px;color:#0098cd"></i> This is a safe place to play with the numbers. Your planner won’t affect the rest of nSmarTrac.</p>
                    <br>
                    <div style="border:solid gray 1px;padding:1%;width:100%;color:black;">
                        <a href="#" style="color:blue;float:right;"><h5>Update</h5></a>
                        <h5>Overdue Transactions</h5>
                        You have 8 overdue transactions. For a more accurate cash flow picture, update each transaction with a new expected date.
                    </div>
					<br><br>
					<div class="row pb-2">
						<div class="col-md-8 banking-tab-container">
							<!-- <a href="#"
								class="banking-tab" id="moneyall">All</a>
							<a href="#"
								class="banking-tab" id="moneyin">Money in</a>
							<a href="#"
								class="banking-tab" id="moneyout">Money out</a> -->
							<div class="tab">
								<button class="tablinks active" onclick="openCity(event, 'London')">All</button>
								<button class="tablinks" onclick="openCity(event, 'Paris')">Money in</button>
								<button class="tablinks" onclick="openCity(event, 'Tokyo')">Money out</button>
							</div>
						</div>
						<div class="col-md-4 banking-tab-container" align="right">
							<a href="<?php echo base_url('accounting/cashflowPDF/') ?>"
								class="banking-tab btn btn-primary" id="moneyall" style="color:white;">Export as PDF</a>
							<button class="banking-tab btn btn-success cfp_add_item" style="color:white;">Add item</button>
						</div>
					</div>

					<div style="background-color:#f4f5f8;padding:1.5%;display:none;" id="cfp_add_item_area">
						<div class="row">
							<div class="col-md-3">
								<input type="date" name="item_date" class="form-control">
							</div>
							<div class="col-md-6 input-group" style="">
								<input type="text" name="item_desc" class="form-control" style="width: 65%;" placeholder="Merchant name"> &nbsp;&nbsp;&nbsp;
								<input type="text" name="item_amt" class="form-control" style="width: 30%;" placeholder="$0.00">
							</div>
							<div class="col-md-2">
								<label>Planned</label>
							</div>
							<div class="col-md-1" align="right">
								<button" style="font-size:20px;" class="close_add_item">X</button>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-6">
										<input type="radio" name="item_type" class="form-control_" checked> &nbsp; <label>Money in</label>
										<!-- <input type="radio" name="item_type" class="form-control"> <label>Money out</label> -->
									</div>
									<div class="col-md-6">
										One-time &nbsp; <input type="radio" name="item_type" class="form-control_"> &nbsp; <label> Repeating</label>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-6">
										<input type="radio" name="item_type" class="form-control_"> &nbsp; <label>Money out</label>
									</div>
								</div>
							</div>
							<div class="col-md-9" align="right">
								<a href="#" class="btn btn-success"> Save </a>
							</div>
						</div>
					</div>
					<br><br>

					<div id="London" class="tabcontent" style="display: block;">
						<table class="table" id="cashflowtransactions">
							<thead>
								<th>DATE</th>
								<th>DESCRIPTION</th>
								<th>AMOUNT</th>
								<th>TYPE</th>
							</thead>
							<tbody>
								<!-- <tr>
									<td>08/30/2021</td>
									<td>Amazon</td>
									<td>$100.00</td>
									<td>Invoice</td>
								</tr> -->
								<?php foreach ($invoices as $inv):?>
								<tr class="moneyin">
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->date_issued)); ?> </td>
									<td><?php echo $inv->contact_name . '' . $inv->first_name."&nbsp;".$inv->last_name;?> </td>
									<td><?php echo $inv->grand_total; ?> </td>
									<td><?php echo 'Invoice'; ?></td>
								</tr>
								<?php endforeach; ?>

									<?php foreach ($checks as $check) { ?>
									<tr>
										<td>
											<div class="table-nowrap">
												<?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($check->payment_date)) ?>
											</div>
										</td>
										<td>
									<!-- <a href="<?php //echo base_url('customer/view/' . $rpayment->customer_id)?>"> -->
									<?php

																		switch ($check->payee_type) {
																			case 'vendor':
																				$vendor = $this->vendors_model->get_vendor_by_id($check->payee_id);
																				// echo $vendor->display_name;
																				print_r('test'.$vendor);
																			break;
																			case 'customer':
																				$customer = $this->accounting_customers_model->get_customer_by_id($check->payee_id);
																				echo $customer->first_name . ' ' . $customer->last_name;
																			break;
																			case 'employee':
																				$employee = $this->users_model->getUser($check->payee_id);
																				echo $employee->FName . ' ' . $employee->LName;
																			break;
																		}
																		
																		?>
									<!-- </a> -->
								</td>
								<td><?php echo $check->total_amount; ?>
								</td>
										<td>
											<?php echo 'Check'; ?>
										</td>
						</td>
						</tr>
						<?php } //print_r($sales_receipts);?>

						<?php foreach ($expenses as $exp):?>
							<tr class="moneyin">
								<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($exp->payment_date)); ?> </td>
								<td><?php echo get_customer_by_id($exp->vendor_id)->first_name .' '. get_customer_by_id($exp->vendor_id)->last_name ?> </td>
								<td><?php echo $exp->amount; ?> </td>
								<td><?php echo 'Expense'; ?></td>
							</tr>
						<?php endforeach; ?>

								<!-- <tr>
									<td>08/30/2021</td>
									<td>Loucelle Emperio</td>
									<td>$200.00</td>
									<td>Check</td>
								</tr>
								<tr>
									<td>08/30/2021</td>
									<td>Brannon Nguyen</td>
									<td>$500.00</td>
									<td>Invoice</td>
								</tr> -->
							</tbody>
						</table>
					</div>

					<div id="Paris" class="tabcontent">
						<table class="table" id="cashflowtransactions">
							<thead>
								<th>DATE</th>
								<th>DESCRIPTION</th>
								<th>AMOUNT</th>
								<th>TYPE</th>
							</thead>
							<tbody>
								<!-- <tr>
									<td>08/30/2021</td>
									<td>Amazon</td>
									<td>$100.00</td>
									<td>Invoice</td>
								</tr> -->
								<?php foreach ($invoices as $inv):?>
								<tr class="moneyin">
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->date_issued)); ?> </td>
									<td><?php echo $inv->contact_name . '' . $inv->first_name."&nbsp;".$inv->last_name;?> </td>
									<td><?php echo $inv->grand_total; ?> </td>
									<td><?php echo 'Invoice'; ?></td>
								</tr>
								<?php endforeach; ?>
								<!-- <tr>
									<td>08/30/2021</td>
									<td>Loucelle Emperio</td>
									<td>$200.00</td>
									<td>Check</td>
								</tr>
								<tr>
									<td>08/30/2021</td>
									<td>Brannon Nguyen</td>
									<td>$500.00</td>
									<td>Invoice</td>
								</tr> -->
							</tbody>
						</table>

                	</div>
				</div>

				<div id="Tokyo" class="tabcontent">
				<table class="table" id="cashflowtransactions">
							<thead>
								<th>DATE</th>
								<th>DESCRIPTION</th>
								<th>AMOUNT</th>
								<th>TYPE</th>
							</thead>
							<tbody>
								<!-- <tr>
									<td>08/30/2021</td>
									<td>Amazon</td>
									<td>$100.00</td>
									<td>Invoice</td>
								</tr> -->

									<?php foreach ($checks as $check) { ?>
									<tr>
										<td>
											<div class="table-nowrap">
												<?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($check->payment_date)) ?>
											</div>
										</td>
										<td>
									<!-- <a href="<?php //echo base_url('customer/view/' . $rpayment->customer_id)?>"> -->
									<?php

																		switch ($check->payee_type) {
																			case 'vendor':
																				$vendor = $this->vendors_model->get_vendor_by_id($check->payee_id);
																				// echo $vendor->display_name;
																				print_r('test'.$vendor);
																			break;
																			case 'customer':
																				$customer = $this->accounting_customers_model->get_customer_by_id($check->payee_id);
																				echo $customer->first_name . ' ' . $customer->last_name;
																			break;
																			case 'employee':
																				$employee = $this->users_model->getUser($check->payee_id);
																				echo $employee->FName . ' ' . $employee->LName;
																			break;
																		}
																		
																		?>
									<!-- </a> -->
								</td>
								<td><?php echo $check->total_amount; ?>
								</td>
										<td>
											<?php echo 'Check'; ?>
										</td>
						</td>
						</tr>
						<?php } //print_r($sales_receipts);?>

								<?php foreach ($expenses as $exp):?>
								<tr class="moneyin">
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($exp->payment_date)); ?> </td>
									<td><?php echo get_customer_by_id($exp->vendor_id)->first_name .' '. get_customer_by_id($exp->vendor_id)->last_name ?> </td>
									<td><?php echo $exp->amount; ?> </td>
									<td><?php echo 'Expense'; ?></td>
								</tr>
								<?php endforeach; ?>
								<!-- <tr>
									<td>08/30/2021</td>
									<td>Loucelle Emperio</td>
									<td>$200.00</td>
									<td>Check</td>
								</tr>
								<tr>
									<td>08/30/2021</td>
									<td>Brannon Nguyen</td>
									<td>$500.00</td>
									<td>Invoice</td>
								</tr> -->
							</tbody>
						</table>
				</div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
    </div>
        <!-- end container-fluid -->
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    // $(document).ready(function() {
    //     var ctx = $("#chart-line");
    //     var myLineChart = new Chart(ctx, {
    //         type: 'bar',
    //         data: {
    //             labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
    //             datasets: [{
    //                 data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
    //                 label: "Asia",
    //                 borderColor: "#8e5ea2",
    //                 fill: true,
    //                 backgroundColor: '#8e5ea2'
    //             }, {
    //                 data: [168, 170, 178, 190, 203, 276, 408, 547, 675, 734],
    //                 label: "Europe",
    //                 borderColor: "#3cba9f",
    //                 fill: false,
    //                 backgroundColor: '#3cba9f'
    //             }]
    //         },
    //         options: {
    //             title: {
    //                 display: true,
    //                 text: 'World population per region (in millions)'
    //             }
    //         }
    //     });
    // });
    'use strict';

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

(function(global) {
	var MONTHS = [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	];

	var COLORS = [
		'#4dc9f6',
		'#f67019',
		'#f53794',
		'#537bc4',
		'#acc236',
		'#166a8f',
		'#00a950',
		'#58595b',
		'#8549ba'
	];

	var Samples = global.Samples || (global.Samples = {});
	var Color = global.Color;

	Samples.utils = {
		// Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
		srand: function(seed) {
			this._seed = seed;
		},

		rand: function(min, max) {
			var seed = this._seed;
			min = min === undefined ? 0 : min;
			max = max === undefined ? 1 : max;
			this._seed = (seed * 9301 + 49297) % 233280;
			return min + (this._seed / 233280) * (max - min);
		},

		numbers: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 1;
			var from = cfg.from || [];
			var count = cfg.count || 8;
			var decimals = cfg.decimals || 8;
			var continuity = cfg.continuity || 1;
			var dfactor = Math.pow(10, decimals) || 0;
			var data = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = (from[i] || 0) + this.rand(min, max);
				if (this.rand() <= continuity) {
					data.push(Math.round(dfactor * value) / dfactor);
				} else {
					data.push(null);
				}
			}

			return data;
		},

		labels: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 100;
			var count = cfg.count || 8;
			var step = (max - min) / count;
			var decimals = cfg.decimals || 8;
			var dfactor = Math.pow(10, decimals) || 0;
			var prefix = cfg.prefix || '';
			var values = [];
			var i;

			for (i = min; i < max; i += step) {
				values.push(prefix + Math.round(dfactor * i) / dfactor);
			}

			return values;
		},

		months: function(config) {
			var cfg = config || {};
			var count = cfg.count || 12;
			var section = cfg.section;
			var values = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = MONTHS[Math.ceil(i) % 12];
				values.push(value.substring(0, section));
			}

			return values;
		},

		color: function(index) {
			return COLORS[index % COLORS.length];
		},

		transparentize: function(color, opacity) {
			var alpha = opacity === undefined ? 0.5 : 1 - opacity;
			return Color(color).alpha(alpha).rgbString();
		}
	};

	// DEPRECATED
	window.randomScalingFactor = function() {
		return Math.round(Samples.utils.rand(-100, 100));
	};

	// INITIALIZATION

	Samples.utils.srand(Date.now());

	// Google Analytics
	/* eslint-disable */
	if (document.location.hostname.match(/^(www\.)?chartjs\.org$/)) {
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-28909194-3', 'auto');
		ga('send', 'pageview');
	}
	/* eslint-enable */

}(this));

var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
			datasets: [{
				label: 'Money in',
				// backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                backgroundColor: '#53b700',
				borderColor: window.chartColors.green,
				borderWidth: 1,
				// data: [
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor()
				// ]
                data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267, 2000, 4000],
			}, {
				label: 'Money out',
				// backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                backgroundColor: '#05a4b5',
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				// data: [
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor(),
				// 	randomScalingFactor()
				// ]
                data: [168, 170, 178, 190, 203, 276, 408, 547, 675, 734, 3000, 5000],
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						// text: 'Chart.js Bar Chart'
					}
				}
			});

		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			var zero = Math.random() < 0.2 ? true : false;
			barChartData.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return zero ? 0.0 : randomScalingFactor();
				});

			});
			window.myBar.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var colorName = colorNames[barChartData.datasets.length % colorNames.length];
			var dsColor = window.chartColors[colorName];
			var newDataset = {
				label: 'Dataset ' + (barChartData.datasets.length + 1),
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				borderWidth: 1,
				data: []
			};

			for (var index = 0; index < barChartData.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
			}

			barChartData.datasets.push(newDataset);
			window.myBar.update();
		});

		document.getElementById('addData').addEventListener('click', function() {
			if (barChartData.datasets.length > 0) {
				var month = MONTHS[barChartData.labels.length % MONTHS.length];
				barChartData.labels.push(month);

				for (var index = 0; index < barChartData.datasets.length; ++index) {
					// window.myBar.addData(randomScalingFactor(), index);
					barChartData.datasets[index].data.push(randomScalingFactor());
				}

				window.myBar.update();
			}
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			barChartData.datasets.pop();
			window.myBar.update();
		});

		document.getElementById('removeData').addEventListener('click', function() {
			barChartData.labels.splice(-1, 1); // remove the label first

			barChartData.datasets.forEach(function(dataset) {
				dataset.data.pop();
			});

			window.myBar.update();
		});
</script>

<script>
var xValues = [" ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " "];
var yValues = [10,20, 25, 24, 35, 15, 2, 15, 18, 36, 20, 12, 16, 10, 24, 15, 35, 40, 42, 46, 49, 35, 38, 50, 55, 49, 44, 24, 15,55, 49, 44, 24, 15, 88, 49, 44,55, 49, 44, 24, 15, 55, 49, 44, 24, 15,55, 49, 100, 24, 15, 2, 15, 18, 36, 20, 12, 24, 15, 55, 49, 44, 24, 15,55, 49, 44, 24, 15, 55, 49, 44];
var barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart_", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: [
			'rgba(186, 226, 153, 0.6)',
            ],
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    //   text: "World Wine Production 2018"
    }
  }
});
</script>

<script>
jQuery(document).ready(function() {
		$('#cashflowtransactions').DataTable();
	});
</script>

<script>
	var tableRows = document.getElementsByTagName('tr');
            //get all buttons
            var moneyin = document.getElementById('moneyin');
            // console.log(moneyin);
            var moneyout = document.getElementById('moneyout');
			var moneyall = document.getElementById('moneyall');

            //check if the class exists for each of the tr element
            moneyin.addEventListener('click', function() {
                for(var i=1; i<tableRows.length; i++) { //loop starts with 1 and not 0 because first element is th
                    if(tableRows[i].className !== 'moneyin') {
                        tableRows[i].hidden = true; //hide other than moneyin
                    } else {
                        tableRows[i].hidden = false; //display only moneyin
                    }
                }
            });

            moneyout.addEventListener('click', function() {
                for(var i=1; i<tableRows.length; i++) {
                    if(tableRows[i].className !== 'moneyout') {
                        tableRows[i].hidden = true;
                    } else {
                        tableRows[i].hidden = false;
                    }
                }
            });

            moneyall.addEventListener('click', function() {
                for(var i=1; i<tableRows.length; i++) {
                    tableRows[i].hidden = false;
                }
            });


      </script>
<script>
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<script>
$(".close_add_item").click(function() {
  $('#cfp_add_item_area').hide();
});

$(".cfp_add_item").click(function() {
  $('#cfp_add_item_area').show();
});
</script>