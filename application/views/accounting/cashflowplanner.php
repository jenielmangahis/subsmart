<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
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

	.sidebarForm {
		display: none;
	}

	#myChart_ {
		height: 350px !important;
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

	/* .updateoverduetable tr td
{
	padding: 3px !important;
} */

	.canvasjs-chart-credit {
		display: none !important;
	}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/accounting_dashboard.css">
-->

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
								<button class="tablinks" onclick="openCity(event, 'MoneyIn')"
									style="border-radius: 12px 0 0 12px;padding:6%;">Money in/out</button>
								<button class="tablinks" onclick="openCity(event, 'MoneyOut')"
									style="border-radius: 0 12px 12px 0;padding:6%;">Cash balance</button>
							</div>
						</div>
					</div>

					<!-- <div id="container" style="width: 100%;">
                        <canvas id="canvas"></canvas>
                    </div> -->
					<!-- <canvas id="myChart_" style="width:80%;"></canvas> -->
					<!-- <div id="GoogleLineChart" style="height: 400px; width: 100%"></div> -->
					<?php
 
                        $dataPoints = array(
                            array("y" => 25, "label" => "January"),
                            array("y" => 15, "label" => "February"),
                            array("y" => 25, "label" => "March"),
                            array("y" => 5, "label" => "April"),
                            array("y" => 10, "label" => "May"),
                            array("y" => 0, "label" => "June"),
                            array("y" => 20, "label" => "July"),
                            array("y" => 20, "label" => "August"),
                            array("y" => 20, "label" => "September"),
                            array("y" => 20, "label" => "October"),
                            array("y" => 20, "label" => "November"),
                            array("y" => 20, "label" => "December"),
                        );
                        
                    ?>

					<div id="chartContainer" style="height: 370px; width: 100%;"></div>
					<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

					<br><br>
					<!-- <p style="border:solid #0098cd 1px;padding:1%;width:80%;color:#0098cd;"><i class="fa fa-info-circle" style="font-size:18px;color:#0098cd"></i> This is a safe place to play with the numbers. Your planner won’t affect the rest of nSmarTrac.</p> -->
					<br>
					<div style="border:solid gray 1px;padding:1%;width:100%;color:black;">
						<a href="#" style="color:blue;float:right;" data-toggle="modal" data-target=".updateoverdue">
							<h5>Update</h5>
						</a>
						<h5>Overdue Transactions</h5>
						You have <?php echo $totoverdues->totalOverdue; ?> overdue
						transactions. For a more accurate cash flow picture, update each transaction with a new expected
						date.
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
							<button class="banking-tab btn btn-success cfp_add_item" style="color:white;">Add
								item</button>
						</div>
					</div>

					<div style="background-color:#f4f5f8;padding:1.5%;display:none;" id="cfp_add_item_area">
						<div class="row">
							<div class="col-md-3">
								<input type="text" id="datepicker" name="item_date" class="form-control date_plan"
									placeholder="Date">
							</div>
							<div class="col-md-6 input-group" style="">
								<input type="text" name="item_desc" class="form-control merchant_name"
									style="width: 65%;" placeholder="Merchant name"> &nbsp;&nbsp;&nbsp;
								<input type="text" name="item_amt" class="form-control plan_amount" style="width: 30%;"
									placeholder="$0.00">
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
										<input type="radio" name="plan_type" class="form-control_" id="plan_type"
											value="moneyin" checked> &nbsp; <label>Money in</label>
										<!-- <input type="radio" name="item_type" class="form-control"> <label>Money out</label> -->
									</div>
									<div class="col-md-6">
										One-time &nbsp; <input type="radio" name="item_type"
											class="form-control_ plan_repeat"> &nbsp; <label> Repeating</label>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-6">
										<input type="radio" name="plan_type" class="form-control_" id="plan_type"
											value="moneyout"> &nbsp; <label>Money out</label>
									</div>
								</div>
							</div>
							<div class="col-md-9" align="right">
								<a href="#" class="btn btn-success savecashflowplanned"> Save </a>
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
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->date_issued)); ?>
									</td>
									<td><?php echo $inv->contact_name . '' . $inv->first_name."&nbsp;".$inv->last_name;?>
									</td>
									<td><?php echo number_format($inv->grand_total, 2); ?>
									</td>
									<td><?php echo 'Invoice'; ?>
									</td>
								</tr>
								<?php endforeach; ?>

								<?php foreach ($plans as $plan):?>
								<tr class="moneyin">
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($plan->date_plan)); ?>
									</td>
									<td><?php echo $plan->merchant_name;?>
									</td>
									<td><?php echo number_format($plan->amount, 2); ?>
									</td>
									<td><?php echo 'Planned'; ?>
									</td>
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
										<!-- <a href="<?php //echo base_url('customer/view/' . $rpayment->customer_id)?>">
										-->
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
									<td><?php echo number_format($check->total_amount, 2); ?>
									</td>
									<td>
										<?php echo 'Check'; ?>
									</td>
									</td>
								</tr>
								<?php } //print_r($sales_receipts);?>

								<?php foreach ($expenses as $exp):?>
								<tr class="moneyin">
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($exp->payment_date)); ?>
									</td>
									<td><?php echo get_customer_by_id($exp->vendor_id)->first_name .' '. get_customer_by_id($exp->vendor_id)->last_name ?>
									</td>
									<td><?php echo number_format($exp->amount, 2); ?>
									</td>
									<td><?php echo 'Expense'; ?>
									</td>
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
						<table class="table" id="cashflowmoneyin">
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
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->date_issued)); ?>
									</td>
									<td><?php echo $inv->contact_name . '' . $inv->first_name."&nbsp;".$inv->last_name;?>
									</td>
									<td><?php echo number_format($inv->grand_total, 2); ?>
									</td>
									<td><?php echo 'Invoice'; ?>
									</td>
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
					<table class="table" id="cashflowmoneyout">
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
									<!-- <a href="<?php //echo base_url('customer/view/' . $rpayment->customer_id)?>">
									-->
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
								<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($exp->payment_date)); ?>
								</td>
								<td><?php echo get_customer_by_id($exp->vendor_id)->first_name .' '. get_customer_by_id($exp->vendor_id)->last_name ?>
								</td>
								<td><?php echo number_format($exp->amount, 2); ?>
								</td>
								<td><?php echo 'Expense'; ?>
								</td>
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

			<div class="modal fade updateoverdue" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div style="padding:3%;">
							<h2>Overdue Transactions</h2>
							<p>You have <?php echo $totoverdues->totalOverdue; ?>
								overdue transactions. For a more accurate cash flow picture, update each transaction
								with a new expected date.</p>

							<table class="table table-condensed updateoverduetable" style="border-collapse:collapse;">
								<thead>
									<th>DATE</th>
									<th>DESCRIPTION</th>
									<th>AMOUNT</th>
									<th>TYPE</th>
									<th></th>
								</thead>
								<tbody>
									<!-- <tr>
											<td>08/20/2021</td>
											<td>John Doe</td>
											<td>$1000</td>
											<td>Invoice</td>
											<td><i class="fa fa-toggle-down"></i></td>
										</tr>-->
									<!-- <tr data-toggle="collapse" data-target="#demo3">
											<td>09/09/2021</td>
											<td>Jerrell Milton</td>
											<td>$1,980.35</td>
											<td>Invoice</td>
											<td><i class="fa fa-toggle-down"></i></td>
										</tr>
										<tr>
											<td colspan="6" class="hiddenRow" style="background-color: #f4f5f8; padding: 0 8px !important;">
												<div id="demo3" class="collapse">Demo3</div>
											</td>
										</tr>
										<tr data-toggle="collapse" data-target=".demo1">
											<td>09/09/2021</td>
											<td>Ronnie & Lynne Davis</td>
											<td>$1,980.35</td>
											<td>Invoice</td>
											<td><i class="fa fa-toggle-down"></i></td>
										</tr> 
										<tr>
											<td class="hiddenRow" colspan="5" style="background-color: #f4f5f8; padding: 0 8px !important;">
												<div class="collapse demo1">
															<table class="table">
																<tr>
																	<td style="width:20%;"><input type="text" value="09/09/2021" class="form-control"></td>
																	<td colspan="3">Ronnie & Lynne Davi</td>
																	<td style="width:24%;"><input type="text" value="1980.35" class="form-control"></td>
																	<td>Invoice</td>
																</tr>
																<tr>
																	<td colspan="3">
																		<table>
																			<tr>
																				<td>DUE DATE <br> 09/09/2021</td>
																				<td>DUE AMOUNT <br> $1,980.35</td>
																				<td>REF NUMBER <br> <a href="#" style="color: blue;"> 13271 </a></td>
																			</tr>
																		</table>
																	</td>
																	<td colspan="3"> <div align="right"> <a href="#" style="color:#0077c5;" class="btn">Remove</a> &emsp; <button class="btn btn-primary">Update</button> </div></td>
																</tr>
															</table>
												</div>
											</td>
										</tr> -->

									<?php foreach ($overdues as $overdue) { ?>

									<tr data-toggle="collapse"
										data-target=".demo<?php echo $overdue->id; ?>">
										<td><?php echo $overdue->due_date; ?>
										</td>
										<td><?php echo get_customer_by_id($overdue->customer_id)->first_name .' '. get_customer_by_id($overdue->customer_id)->last_name ?>
										</td>
										<td>$<?php echo number_format($overdue->grand_total, 2); ?>
										</td>
										<td>Invoice</td>
										<td><i class="fa fa-toggle-down"></i></td>
									</tr>
									<tr>
										<td class="hiddenRow" colspan="5"
											style="background-color: #f4f5f8; padding: 0 8px !important;">
											<div
												class="collapse demo<?php echo $overdue->id; ?>">
												<!-- <div class="row">
														<div class="col-md-12"> -->
												<table class="table">
													<tr>
														<td style="width:20%;"><input type="text"
																id="datepickerOD<?php echo $overdue->id; ?>"
																over-id="<?php echo $overdue->id; ?>"
																value="<?php echo $overdue->due_date; ?>"
																class="form-control overdate<?php echo $overdue->id; ?> overdate">
														</td>
														<td colspan="3"><?php echo get_customer_by_id($overdue->customer_id)->first_name .' '. get_customer_by_id($overdue->customer_id)->last_name ?>
														</td>
														<td style="width:24%;"><input type="text"
																value="<?php echo$overdue->grand_total; ?>"
																class="form-control overtotal<?php echo $overdue->id; ?>">
														</td>
														<td>Invoice</td>
													</tr>
													<tr>
														<td colspan="3">
															<table>
																<tr>
																	<td>DUE DATE <br> <?php echo $overdue->due_date; ?>
																	</td>
																	<td>DUE AMOUNT <br> $<?php echo $overdue->grand_total; ?>
																	</td>
																	<td>REF NUMBER <br> <a href="#"
																			style="color: blue;"> <?php echo $overdue->id; ?>
																		</a></td>
																</tr>
															</table>
														</td>
														<td colspan="3">
															<div align="right"> <a href="#" style="color:#0077c5;"
																	class="btn">Remove</a> &emsp; <a href="#"
																	over-id="<?php echo $overdue->id; ?>"
																	class="btn btn-primary updateOverdue">Update</a>
															</div>
														</td>
													</tr>
												</table>
												<!-- </div>
													</div> -->
											</div>
										</td>
									</tr>

									<?php } ?>
									<!-- <tr data-toggle="collapse" data-target="#demo2">
											<td>09/09/2021</td>
											<td>Harry Dodich</td>
											<td>$1,980.35</td>
											<td>Invoice</td>
											<td><i class="fa fa-toggle-down"></i></td>
										</tr>
										<tr>
											<td colspan="6" class="hiddenRow" style="background-color: #f4f5f8; padding: 0 8px !important;">
												<div id="demo2" class="collapse">Demo2</div>
											</td>
										</tr> -->
								</tbody>
							</table>

							<input type="submit" class="btn btn-success" value="Done" style="float: right;"
								data-dismiss="modal">
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
	</div>
	<!-- end container-fluid -->
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
	<!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>

<script>
	$(document).ready(function() {
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
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] || function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
					m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
			ga('create', 'UA-28909194-3', 'auto');
			ga('send', 'pageview');
		}
		/* eslint-enable */

	}(this));

	var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
		'November', 'December'
	];
	var color = Chart.helpers.color;
	var barChartData = {
		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
			'November', 'December'
		],
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
		var ctx = document.getElementById('chartContainer').getContext('2d');
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
	var xValues = [" ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ",
		" ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ",
		" ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ",
		" ", " ", " ", " "
	];
	var yValues = [10, 20, 25, 24, 35, 15, 2, 15, 18, 36, 20, 12, 16, 10, 24, 15, 35, 40, 42, 46, 49, 35, 38, 50, 55, 49,
		44, 24, 15, 55, 49, 44, 24, 15, 88, 49, 44, 55, 49, 44, 24, 15, 55, 49, 44, 24, 15, 55, 49, 100, 24, 15, 2, 15,
		18, 36, 20, 12, 24, 15, 55, 49, 44, 24, 15, 55, 49, 44, 24, 15, 55, 49, 44
	];
	var barColors = ["red", "green", "blue", "orange", "brown"];

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
			legend: {
				display: false
			},
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
		for (var i = 1; i < tableRows.length; i++) { //loop starts with 1 and not 0 because first element is th
			if (tableRows[i].className !== 'moneyin') {
				tableRows[i].hidden = true; //hide other than moneyin
			} else {
				tableRows[i].hidden = false; //display only moneyin
			}
		}
	});

	moneyout.addEventListener('click', function() {
		for (var i = 1; i < tableRows.length; i++) {
			if (tableRows[i].className !== 'moneyout') {
				tableRows[i].hidden = true;
			} else {
				tableRows[i].hidden = false;
			}
		}
	});

	moneyall.addEventListener('click', function() {
		for (var i = 1; i < tableRows.length; i++) {
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

	$('.savecashflowplanned').click(function() {
		//   alert('test');
		var date_plan = $(".date_plan").val();
		var merchant_name = $(".merchant_name").val();
		var plan_amount = $(".plan_amount").val();

		//   plan_type 2x
		var plan_type = $('input[name="plan_type"]:checked').val();

		// alert(plan_type);

		if ($('.plan_repeat').is(':checked')) {
			var plan_repeat = '1';
		} else {
			var plan_repeat = '0';
		}

		//   plan_repeat

		// sucess("Data Added Successfully!");

		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>accounting/savecashflowplan",
			data: {
				date_plan: date_plan,
				merchant_name: merchant_name,
				plan_amount: plan_amount,
				plan_type: plan_type,
				plan_repeat: plan_repeat
			},
			dataType: 'json',
			success: function(response) {
				sucess("Data Added Successfully!");
			},
		});

		function sucess(information, $id) {
			Swal.fire({
				title: 'Success!',
				text: information,
				icon: 'success',
				showCancelButton: false,
				confirmButtonColor: '#32243d',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ok'
			}).then((result) => {
				if (result.value) {
					location.reload();
				}
			});
		}
	});
</script>

<script>
	$(function() {
		$("#datepicker").datepicker();
	});
</script>

<script>
	//   $( function() {
	//     $( "#datepickerOD" ).datepicker();
	//   } );

	$(".overdate").click(function() {
		var overId = $(this).attr('over-id');

		$('#datepickerOD' + overId).datepicker();
	});
</script>

<script>
	// jQuery(document).ready(function() {
	$('#cashflowtransactions').DataTable({
		order: [
			[0, 'desc']
		],
	});

	$('#cashflowmoneyin').DataTable({
		order: [
			[0, 'desc']
		],
	});

	$('#cashflowmoneyout').DataTable({
		order: [
			[0, 'desc']
		],
	});
	// });
</script>

<script>
	$('.collapse').on('show.bs.collapse', function() {
		$('.collapse.in').collapse('hide');
	});
</script>

<script>
	$(".updateOverdue").click(function() {
		var overId = $(this).attr('over-id');
		var overdate = $('.overdate' + overId).val();
		var overtotal = $('.overtotal' + overId).val();

		// alert(overdate);

		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>accounting/updateOverdueCashflow",
			data: {
				overId: overId,
				overdate: overdate,
				overtotal: overtotal
			},
			dataType: 'json',
			success: function(response) {
				sucess("Data Updates Successfully!");
			},
		});

		function sucess(information, $id) {
			Swal.fire({
				title: 'Success!',
				text: information,
				icon: 'success',
				showCancelButton: false,
				confirmButtonColor: '#32243d',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ok'
			}).then((result) => {
				if (result.value) {
					location.reload();
				}
			});
		}
	});
</script>


<script>
	// window.onload = function () {

	// var chart = new CanvasJS.Chart("chartContainer", {
	// 	title: {
	// 		// text: ""
	// 	},
	// 	axisY: {
	// 		// title: ""
	// 		// lineColor: "#C24642",
	// 	},
	// 	data: [{
	// 		type: "line",
	// 		datasets: [{
	// 		// backgroundColor: [
	// 		// 		'rgba(186, 226, 153, 0.6)',
	// 		// 		],
	// 		// data: yValues
	// 		backgroundColor: "#C24642",
	// 		}],
	// 		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	// 	}]
	// });
	// chart.render();

	// }

	// new Chart("myChart_", {
	//   type: "line",
	//   data: {
	//     labels: xValues,
	//     datasets: [{
	//       backgroundColor: [
	// 			'rgba(186, 226, 153, 0.6)',
	//             ],
	//       data: yValues
	//     }]
	//   },
	//   options: {
	//     legend: {display: false},
	//     title: {
	//       display: true,
	//     //   text: "World Wine Production 2018"
	//     }
	//   }
	// });
</script>

<script>
	window.onload = function() {

		var dataPoints = [];

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light2",
			zoomEnabled: true,
			title: {
				// text: "Bitcoin Price - 2017"
			},
			axisY: {
				// title: "Price in USD",
				titleFontSize: 24,
				prefix: "$"
			},
			data: [{
				type: "line",
				yValueFormatString: "$#,##0.00",
				dataPoints: dataPoints,
				backgroundColor: "#C24642",
			}]
		});

		function addData(data) {
			var dps = data.price_usd;
			for (var i = 0; i < dps.length; i++) {
				dataPoints.push({
					x: new Date(dps[i][0]),
					y: dps[i][1]
				});
			}
			chart.render();
		}

		$.getJSON("<?php echo base_url(); ?>accounting/cashflowDataJson",
			addData);
		// $.getJSON("https://canvasjs.com/data/gallery/php/bitcoin-price.json", addData);

	}
</script>


<script>
    
    

    $(document).on("click", "#Apply", function(event) {
        setTimeout(function() {
            $(".filter-btn-section .filter-panel").fadeOut();
        }, 300);

    });
    $(document).on("click", "#reset", function(event) {
        $('input[name=CREDIT_CARDS1]').prop("checked", false);
        $('input[name=EXPENSES1]').prop("checked", false);
        $('input[name=PAYROLL1]').prop("checked", false);
        $('input[name=SALES_RECEIPTS1]').prop("checked", false);
        $('input[name=BILLS]').prop("checked", false);
        $('input[name=EXPENSES]').prop("checked", false);
        $('input[name=CHECK]').prop("checked", false);
        $('input[name=INVOICES]').prop("checked", false);
        $('input[name=CREDIT_CARDS]').prop("checked", false);
        $('input[name=PAYCHECKS]').prop("checked", false);
        $('input[name=ESTIMATES]').prop("checked", false);
        $('input[name=SALES_RECEIPTS]').prop("checked", false);
        $('input[name=REPEATING]').prop("checked", false);
        $('input[name=MONEY_IN1]').prop("checked", false);
        $('input[name=MONEY_OUT1]').prop("checked", false);
        $('input[name=MONEY_OUT]').prop("checked", false);
        $('input[name=MONEY_IN]').prop("checked", false);
        $('input[name=PREDICTED]').prop("checked", false);
        $('input[name=fyb]').prop("checked", false);
        $('input[name=ADDED_BY_YOU]').prop("checked", false);
    });
    $(document).on("click", "#PREDICTED", function(event) {
        if ($('input[name=PREDICTED]').is(":checked")) {
            $('input[name=CREDIT_CARDS1]').prop("checked", true);
            $('input[name=EXPENSES1]').prop("checked", true);
            $('input[name=PAYROLL1]').prop("checked", true);
            $('input[name=SALES_RECEIPTS1]').prop("checked", true);
        } else {
            $('input[name=CREDIT_CARDS1]').prop("checked", false);
            $('input[name=EXPENSES1]').prop("checked", false);
            $('input[name=PAYROLL1]').prop("checked", false);
            $('input[name=SALES_RECEIPTS1]').prop("checked", false);

        }
    });

    $(document).on("click", "#fyb", function(event) {
        if ($('input[name=fyb]').is(":checked")) {
            $('input[name=BILLS]').prop("checked", true);
            $('input[name=EXPENSES]').prop("checked", true);
            $('input[name=CHECK]').prop("checked", true);
            $('input[name=INVOICES]').prop("checked", true);
            $('input[name=CREDIT_CARDS]').prop("checked", true);
            $('input[name=PAYCHECKS]').prop("checked", true);
            $('input[name=ESTIMATES]').prop("checked", true);
            $('input[name=SALES_RECEIPTS]').prop("checked", true);
        } else {
            $('input[name=BILLS]').prop("checked", false);
            $('input[name=EXPENSES]').prop("checked", false);
            $('input[name=CHECK]').prop("checked", false);
            $('input[name=INVOICES]').prop("checked", false);
            $('input[name=CREDIT_CARDS]').prop("checked", false);
            $('input[name=PAYCHECKS]').prop("checked", false);
            $('input[name=ESTIMATES]').prop("checked", false);
            $('input[name=SALES_RECEIPTS]').prop("checked", false);

        }
    })
    $(document).on("click", "#ADDED_BY_YOU", function(event) {
        if ($('input[name=ADDED_BY_YOU]').is(":checked")) {
            $('input[name=REPEATING]').prop("checked", true);
            $('input[name=MONEY_IN1]').prop("checked", true);
            $('input[name=MONEY_OUT1]').prop("checked", true);

        } else {
            $('input[name=REPEATING]').prop("checked", false);
            $('input[name=MONEY_IN1]').prop("checked", false);
            $('input[name=MONEY_OUT1]').prop("checked", false);
        }
    });
    // $(document).on("click", ".savecashflowplanned", function(event) {
    //     var date = $('.addDate').val();
    //     var name = $('.merchant_name').val();
    //     var amount = $('.plan_amount').val();
    // })






    // $(document).on("click", function(event) {
    //     if ($(event.target).closest(".filter-btn-section button.filter-btn").length === 0) {
    //         $(".filter-btn-section .filter-panel").hide();
    //     }
    // });
    <?php
    $data_dates_projected = "[";
    $data_dates = "[";
    $data_labels = "[";

    $data_dates_projected_3m = "[";
    $data_dates_3m = "[";
    $data_labels_3m = "[";
    $date_start = date("Y-m-d", strtotime("- 10 months", strtotime(date("Y-m-01"))));
    $date_end = date("Y-m-t", strtotime("+ 2 months", strtotime(date("Y-m-01"))));
    $total = 0;
    $month = date("m", strtotime($date_start));
    $ctr = 0;
    while ($date_start <= $date_end) {
        $value = rand(rand(1, $ctr + 2), $ctr + 2);
        if ($month == date("m", strtotime($date_start))) {
            $total += $value;
        } else {
            $month = date("m", strtotime($date_start));
            $data_dates .= $total . ",";
            $data_dates_projected .= rand(rand(1, $total), $total + 2) . ",";
            $data_labels .= "'" . strtoupper(date("M", strtotime($date_start))) . "',";
            $total = 0;
        }
        $date_start = date("Y-m-d", strtotime("+ 1 day", strtotime($date_start)));
        $ctr++;
    }
    $data_dates_projected .= "]";
    $data_dates .= "]";
    $data_labels .= "]";

    $data_dates_projected_3m .= "]";
    $data_dates_3m .= "]";
    $data_labels_3m .= "]";
    ?>

    var labels = <?= $data_labels ?>;
    var data = <?= $data_dates ?>;
    var data_projected = <?= $data_dates_projected ?>;

    var labels_3m = <?= $data_labels_3m ?>;
    var data_3m = <?= $data_dates_3m ?>;
    var data_projected_3m = <?= $data_dates_projected_3m ?>;
</script>
<script>
    $('.savecashflowplannedForm').click(function() {
		//   alert('test');
		var date_planDate = $("#date_plan").val();
		var merchant_name = $(".merchant_name").val();
		var plan_amount = $(".plan_amount").val();
		//   plan_type 2x
		var plan_type = $('input[name="plan_type"]:checked').val();

		// alert(plan_type);

		if ($('.plan_repeat').is(':checked')) {
			var plan_repeat = '1';
		} else {
			var plan_repeat = '0';
		}

		//   plan_repeat

		// sucess("Data Added Successfully!");

        // alert($("#date_plan").val());
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>accounting/savecashflowplan",
			dataType: 'json',
			data: {
				date_planDate: date_planDate,
				merchant_name: merchant_name,
				plan_amount: plan_amount,
				plan_type: plan_type,
				plan_repeat: plan_repeat
			},
			success: function(response) {
				sucess("Data Added Successfully!");
			},
		});

		// function sucess(information, $id) {
		// 	Swal.fire({
		// 		title: 'Success!',
		// 		text: information,
		// 		icon: 'success',
		// 		showCancelButton: false,
		// 		confirmButtonColor: '#32243d',
		// 		cancelButtonColor: '#d33',
		// 		confirmButtonText: 'Ok'
		// 	}).then((result) => {
		// 		if (result.value) {
		// 			location.reload();
		// 		}
		// 	});
		// }
	});
</script>