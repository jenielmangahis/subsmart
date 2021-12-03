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
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

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



                    <div class="cash-flow-section">
                        <canvas id="chartContainer" style="height: 370px; width: 100%;"></canvas>
                        <div class="chart-x-label">
                            <div class="line-divider"></div>
                            <ul class="months">
                                <li class="moth month-1">JAN</li>
                                <li class="moth month-2">FEB</li>
                                <li class="moth month-3">MAR</li>
                                <li class="moth month-4">APR</li>
                                <li class="moth month-5">MAY</li>
                                <li class="moth month-6">JUN</li>
                                <li class="moth month-7">JUL</li>
                                <li class="moth month-8">AUG</li>
                                <li class="moth month-9">SEP</li>
                                <li class="moth month-10">OCT</li>
                                <li class="moth month-11">NOV</li>
                                <li class="moth month-12">DEC</li>
                            </ul>
                        </div>
                    </div>
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

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
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
                    'rgba(255, 99, 132, 1)',
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
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    <?php
    $data_dates_projected = "[";
    $data_dates = "[";
    $data_labels = "[";
    $date= date("Y-01-01");
    for ($i = 1; $i < 400 ;$i++) {
        if ($date <= date('Y-m-d', strtotime('12/31/'.date("Y")))) {
            // $data_dates .= "{x:'".date("M d", strtotime($date))."',y:".rand(500, 4000)."},";
            $val_amount=rand(1, $i+2);
            if ($date <= date('Y-m-d')) {
                $data_dates .= $val_amount.",";
                
            } if($date >= date('Y-m-d')) {
                $data_dates_projected .= $val_amount.",";
                $data_dates .= "null,";
            }else{
                $data_dates_projected .= "null,";
            }
            $data_labels .="'".date("M d", strtotime($date))."',";
            $date= date("Y-m-d", strtotime("+ 1 day", strtotime($date)));
        }
    }
    $data_dates_projected.="]";
    $data_dates.="]";
    $data_labels .= "]";
    ?>
    var cashflow_chart = document.getElementById('chartContainer').getContext('2d');

    var labels = <?=$data_labels?> ;
    var data = <?=$data_dates?> ;
    var data_projected = <?=$data_dates_projected?> ;
    console.log(data);
    const cfg = {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Cash balance",
                data: data,
                backgroundColor: ['rgba(82, 183, 2, 0.6)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 0,
            }, {
                label: "Projected",
                data: data_projected,
                backgroundColor: ['rgba(82, 183, 2, 0.2)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 0,
                borderDash: [2],
            }],
        },
        options: {
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            plugins: {
                decimation: {
                    enabled: false,
                    algorithm: 'min-max',
                },
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    display: false
                },
                y: {
                    ticks: {
                        callback: function(value, index, values) {
                            return "$" + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        }
                    }
                }
            }
        },
    };
    var massPopChart = new Chart(cashflow_chart, cfg);
</script>

<?php include viewPath('includes/footer_accounting');
