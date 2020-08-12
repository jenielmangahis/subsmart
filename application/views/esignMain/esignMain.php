<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<style type="text/css">
	img{
		min-width: 75px;
		padding: 20px;
	}
	div.col-md-2{
	}
</style>
<!-- page wrapper start -->
<div class="wrapper">
	<br/>
	<div class="container-fluid" style="font-size:14px;">
		<div class="row">
			<div class="col-md-2">
				<div class="shadow" style="background-color: #0d6f6d;text-align:center;">
					<!-- <img src="<?=url("");?>uploads/image/scan.jpg" height="150" width="180" title="Scan"> -->
					<i class="fa fa-plus-circle" aria-hidden="true" style="margin: 30px 0px;color: white;font-size:90px;"></i>
					<button type="button" class="form-control btn btn-success">Scan</button>
				</div>
			</div>
			<div class="col-md-2">
				<a href="<?php echo base_url('esign/Photos') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/gallery.jpg" height="150" width="180" title="Photos">
						<button type="button" class="form-control btn btn-success">Photos</button>
					</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?php echo base_url('esign/Files') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/folder.png" height="150" width="180" title="Files">
						<button type="button" class="form-control btn btn-success">Files</button>
					</div>
				</a>
			</div>
			<div class="col-md-2">
				<div class="shadow" style="background-color: white;text-align:center;">
					<img style="margin:0 auto;" src="<?=url("");?>uploads/image/template.svg" height="150" width="180" title="Template">
					<button type="button" class="form-control btn btn-success">Template</button>
				</div>
			</div>
			<div class="col-md-2">
				<div class="shadow" style="background-color: white;text-align:center;">
					<img style="margin:0 auto;" src="<?=url("");?>uploads/image/files.png" height="150" width="180" title="Library">
					<button type="button" class="form-control btn btn-success">Library</button>
				</div>
			</div>
			<div class="col-md-2">
				<div class="shadow" style="background-color: white;text-align:center;">
					<img style="margin:0 auto;" src="<?=url("");?>uploads/image/dropbox.png" height="150" width="180" title="Dropbox">
					<button type="button" class="form-control btn btn-success">Dropbox</button>
				</div>
			</div>
		</div>
		<br/>
		<div class="row">

			<div class="col-md-2">
				<div class="shadow" style="background-color: white;text-align:center;">
					<img style="margin:0 auto;" src="<?=url("");?>uploads/image/google.png" height="150" width="180" title="Box">
					<button type="button" class="form-control btn btn-success">Google</button>
				</div>
			</div>

			<div class="col-md-2">
				<div class="shadow" style="background-color: white;text-align:center;">
					<img style="margin:0 auto;" src="<?=url("");?>uploads/image/box.png" height="150" width="180" title="Box">
					<button type="button" class="form-control btn btn-success">Box</button>
				</div>
			</div>
			
			<div class="col-md-2 ">
				<a href="<?php echo base_url('esign') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/sign.png" height="150" width="180" title="Sign">
						<button type="button" class="form-control btn btn-success">Sign</button>
					</div>
				</a>
			</div>
		</div>
	</div>
</div><!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
  