<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
	<br/>
	<div class="container-fluid" style="font-size:14px;">
		<div class="row">
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/scan.jpg" height="150" width="180" title="Scan">
					<button type="button" class="btn btn-success">Scan</button>
				</div>
			</div>
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/gallery.png" height="150" width="180" title="Photos">
					<button type="button" class="btn btn-success">Photos</button>
				</div>
			</div>
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/folder.jpg" height="150" width="180" title="Files">
					<button type="button" class="btn btn-success">Files</button>
				</div>
			</div>
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/template.png" height="150" width="180" title="Template">
					<button type="button" class="btn btn-success">Template</button>
				</div>
			</div>
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/library.png" height="150" width="180" title="Library">
					<button type="button" class="btn btn-success">Library</button>
				</div>
			</div>
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/dropbox.jpg" height="150" width="180" title="Dropbox">
					<button type="button" class="btn btn-success">Dropbox</button>
				</div>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/box.png" height="150" width="180" title="Box">
					<button type="button" class="btn btn-success">Box</button>
				</div>
			</div>
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/salesforce.png" height="150" width="180" title="Salesforce">
					<button type="button" class="btn btn-success">Salesforce</button>
				</div>
			</div>
			<div class="col-md-2">
				<div style="background-color: white;">
					<img src="<?=url("");?>uploads/image/evernote.png" height="150" width="180" title="Evernote">
					<button type="button" class="btn btn-success">Evernote</button>
				</div>
			</div>
			
			<div class="col-md-2">
				<a href="<?php echo base_url('esign') ?>" target="_blank">
					<div style="background-color: white;">
						<img src="<?=url("");?>uploads/image/sign.png" height="150" width="180" title="Sign">
						<button type="button" class="btn btn-success">Sign</button>
					</div>
				</a>
			</div>
		</div>
	</div>
</div><!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
  