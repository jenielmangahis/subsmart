<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Form builder</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/jquery.ui.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/app.css">
</head>

<body>

	<div class="container">

		<div class="col-md-12"></div>
			<div class="col-md-3"></div>
			<div class="col-md-9">
				<div class="environment">
					<h1>Naurix Form-Builder</h1>
				
					<div class="main_row_append_box" id="sortable"></div>
				
					<div class="form_generated_box"></div>
				
					<textarea class="code_box form-control"></textarea>
				
					<!-- adder Button -->
					<div style="margin-top: 20px">
						<a href="#" class="btn btn-primary btn_round main_row_btn">
							<i class="fa fa-plus"></i> Add Group
						</a>
				
						<span class="pull-right">
							<span class="btn_round html_btn btn btn-default" data-code-btn="code">
								View HTML <i class="fa fa-code"></i>
							</span>
				
							<span class="btn_round generate_btn btn btn-success">
								Preview
							</span>
						</span>
					</div>
					<div class="clearfix"></div>
					<!-- end adder Button -->
				
				</div>
			</div>
		</div>

	</div>
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.ui.js"></script>
	<script type="text/javascript" src="js/template.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
</body>
</html>

<style>
	.container {
		width: 100%;
	}
</style>