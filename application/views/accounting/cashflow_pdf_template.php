<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cash FLow Report</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">
    <style>
        /* body
        {
            margin:5px;
        } */
table {
 border-collapse: collapse;
}
    </style>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
$(function() {
	$(".chartContainer").CanvasJSChart({
		title: {
			text: "Monthly Rainfall in Columbus - 1996"
		},
		axisY: {
			title: "Rainfall in mm",
			includeZero: false
		},
		axisX: {
			interval: 1
		},
		data: [
		{
			type: "line", //try changing to column, area
			toolTipContent: "{label}: {y} mm",
			dataPoints: [
				{ label: "Jan",  y: 5.28 },
				{ label: "Feb",  y: 3.83 },
				{ label: "March",y: 6.55 },
				{ label: "April",y: 4.81 },
				{ label: "May",  y: 2.37 },
				{ label: "June", y: 2.33 },
				{ label: "July", y: 3.06 },
				{ label: "Aug",  y: 2.94 },
				{ label: "Sep",  y: 5.41 },
				{ label: "Oct",  y: 2.17 },
				{ label: "Nov",  y: 2.17 },
				{ label: "Dec",  y: 2.80 }
			]
		}
		]
	});
});
</script>

</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 11px;" >
    <center><h1><?php echo $clients->business_name; ?></h1>
	<h3>DAILY CASH FLOW BALANCE <br>
	February 2021 - February 2023 <h3></center>

        

<div class="chartContainer" style="height: 300px; width: 100%;"></div>
<h3>Future Events and Transactions</h5>

                    <table class="pure-table" style="border-collapse: collapse !important;align:center !important;width:100%;" id="cashflowtransactions">
							<!-- <thead>
								<th>Date</th>
								<th>Name</th>
								<th>Amount</th>
								<th>Type</th>
							</thead> -->
							<tbody>
								<tr style="font-weight: bold; font-size: 16px;background-color: #E9E9E9 !important;">
									<td>Date</td>
									<td>Name</td>
									<td>Amount</td>
									<td>Type</td>
								</tr>

								<?php foreach ($invoices as $inv):?>
								<tr class="">
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->date_issued)); ?> </td>
									<td><?php echo $inv->contact_name . '' . $inv->first_name."&nbsp;".$inv->last_name;?> </td>
									<td><?php echo $inv->grand_total; ?> </td>
									<td><?php echo 'Invoice'; ?></td>
								</tr>
								<?php endforeach; ?>

								<?php foreach ($plans as $plan):?>
								<tr class="">
									<td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($plan->date_plan)); ?> </td>
									<td><?php echo $plan->merchant_name;?> </td>
									<td><?php echo $plan->amount; ?> </td>
									<td><?php echo 'Planned'; ?></td>
								</tr>
								<?php endforeach; ?>

									<?php foreach ($checks as $check) { ?>
									<tr>
										<td>
											<div class="table-nowrap">
												<?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($check->payment_date)) ?>
											</div>
										</td>
										<td> </td>
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

</body>
<script>
// jQuery(document).ready(function() {
	$('#cashflowtransactions').DataTable({
		order: [[ 0, 'desc' ]],
	});

	// $('#cashflowmoneyin').DataTable({
	// 	order: [[ 0, 'desc' ]],
	// });

	// $('#cashflowmoneyout').DataTable({
	// 	order: [[ 0, 'desc' ]],
	// });
// });
</script>
</html>
