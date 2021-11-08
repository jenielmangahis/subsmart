<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cash FLow Report</title>
    <!-- <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css"> -->
    <style>
        /* body
        {
            margin:5px;
        } */
/* table {
 border-collapse: collapse;
} */
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 11px;" >
    <center><h1><?php echo $clients->business_name; ?></h1></center>
        
<h3>Future Events and Transactions</h5>

                    <table class="table" id="cashflowtransactions">
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
</html>
