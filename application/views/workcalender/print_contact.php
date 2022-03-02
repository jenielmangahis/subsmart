<html lang="en">
	<head>
		<style>	
		.table {
			width: 100%;
			margin-bottom: 20px;
		}	
 
		.table-striped tbody > tr:nth-child(odd) > td,
		.table-striped tbody > tr:nth-child(odd) > th {
			background-color: #f9f9f9;
		}
 
		@media print{
			#print {
				display:none;
			}
		}
		@media print {
			#PrintButton {
				display: none;
			}
		}
 
		@page {
			size: auto;   /* auto is the initial value */
			margin: 0;  /* this affects the margin in the printer settings */
		}
	</style>	
	</head>
<body>
	<div style="width:50%;">
		<table class="table table-striped">
		<tr>
			<td colspan="2" style="font-size: 15px;padding:10px 0px;"><b>Contact Information</b></td>
		</tr>
		<tr>
			<td>Name</td>
			<td>: <?= $user->FName . ' ' . $user->LName; ?></td>			
		</tr>
		<tr>
			<td>Email</td>
			<td>: <?= $user->email; ?></td>			
		</tr>
		<tr>
			<td>Mobile</td>
			<td>: <?= $user->mobile; ?></td>			
		</tr>
		<tr>
			<td>Email</td>
			<td>: <?= $user->email; ?></td>			
		</tr>
		<tr>
			<td>Address</td>
			<td>: <?= $user->address; ?></td>			
		</tr>
		</table>
	</div>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		window.print();
	});
</script>
</html>