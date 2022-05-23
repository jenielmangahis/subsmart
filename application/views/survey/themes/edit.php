<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<style>
	input[type="color" i]{
		border: none;
		padding: 0;
		margin: 0;
		width: 100%;
	}

	.line-separator{
		padding: 3px 10px;
		background-color: #fff;
		width: 100px;
		margin: 10px auto;
	}

	#themeSampleWrapper{
		
		z-index: 0;
	}

	.theme-sample{
		display: flex;
		overflow: none;
		padding: 10px 0;
		height: 100%: 
	}

	.theme-sample-content{
		position: absolute;
		z-index: 1;
		padding: 15% 0;
	}

	.theme-image{
		width: 100%;
		height: 350pt;
		object-fit: cover;
	}
</style>

<div class="wrapper" role="wrapper">
	<?php include viewPath('includes/sidebars/marketing'); ?>

	<!-- start of page wrapper -->
	<div wrapper__section>
		<script>console.log(<?=json_encode($theme)?>)</script>
	<div class="container-fluid">
			
			<div class="card">
			<?= form_open_multipart('survey/themes/update/'.$theme->sth_rec_no, array('id'=>'frm-add-survey-theme'))?>
				<div class="card-body">
					<a href="<?=base_url()?>survey/themes">Back to Themes List</a>
					<div class="d-flex w-100 justify-content-between">
						<h2>Edit theme</h2>
						<div class="row">
							<button id="btnPreview" class="btn btn-secondary " type="button">Preview</button>
							<button id="btnSubmit" class="btn btn-success " type="submit">Submit</button>
						</div>
					</div>
					<hr/>

					<div class="alert alert-info w-100">
						<i class="fa fa-info-circle"></i>
						Before submitting your theme, make sure you view first your design before submitting your theme. 
					</div>
					<div class="row">
							<div id="themeSampleWrapper" class="col-sm-12">
								<div class="theme-sample">
									<div class="theme-sample-content container-fluid">
											<div class="text-center">
												<h1 id="sampleHeaderText">Lorem Ipsum</h1>
												<div id="sampleLineSeparator" class="line-separator"></div>
												<p id="sampleParagraph">This is where the text will be placed. Another sentence to fill in the spaces of your survey.</p>
												<button id="samplePrimaryButton" type="button" class="btn ">Button</button>
												<button id="sampleSecondaryButton" type="button" class="btn ">Button</button>
											</div>
									
									</div>
									<img id="imageContainer" src="https://via.placeholder.com/1200x500/fff" alt="uploaded-image" class="theme-image">
								</div>
							</div>
					
							
								<div class="col-sm-12">
									<div class="form-group">
											<label for="txtName">What's the name of your theme?</label>
											<input type="text" name="sth_theme_name" id="txtName" class="form-control" placeholder="Enter name here"/>
											<div id="themeNameError" class="invalid-feedback" >
												Please provide a name.
											</div>
									</div>
									<div class="form-group">
											<input class="form-control-file" type="file" name="filePrimaryImage" id="filePrimaryImage" >
									</div>
									<label>Theme colors:</label>
									<div class="form-row">
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_primary_color" id="colPrimary" value="#9D344B" data-toggle="tooltip" data-placement="top" title="Primary Color">
												<small>Primary</small>
											</div>
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_secondary_color" id="colSecondary" value="#257059" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<small>Secondary</small>
											</div>
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_tertiary_color" id="colTertiary" value="#8AA236" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<small>Tertiary</small>
											</div>
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_success_color" id="colSuccess" value="#00BC0C">
												<small>Success</small>
											</div>
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_info_color" id="colInfo" value="#045899">
												<small>Info</small>
											</div>
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_warning_color" id="colWarning" value="#EF6C00">
												<small>Warning</small>
											</div>
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_danger_color" id="colDanger" value="#EF0000">
												<small>Danger</small>
											</div>
									</div>
								</div>
								
								<div class="col-12">
									<label>Text colors:</label>
									<div class="form-row">
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_text_color" id="colTextMain" value="#ffffff">
												<small>Text</small>
											</div>
											<div class="form-group col text-center">
												<input class="form-control" type="color" name="sth_dark_text_color" id="colTextDark" value="#222222">
												<small>Dark Mode Text</small>
											</div>
									</div>
								</div>
								
								<div id="imagePreviewError" style="display: none" class="alert alert-danger w-100">
									<i class="fa fa-times"></i>
									Image has not yet been set. Add an image to see the design.
								</div>
								
							</>

							<script>
								let imageContainer = document.querySelector('#imageContainer');
								let uploadedImage = document.querySelector("#filePrimaryImage");
								let fileReader = new FileReader();

								document.querySelector('#txtName').value = `<?=$theme->sth_theme_name?>`;
								document.querySelector('#colPrimary').value = `<?=$theme->sth_primary_color?>`;
								document.querySelector('#colSecondary').value = `<?=$theme->sth_secondary_color?>`;
								document.querySelector('#colTertiary').value = `<?=$theme->sth_tertiary_color?>`;
								document.querySelector('#colSuccess').value = `<?=$theme->sth_success_color?>`;
								document.querySelector('#colInfo').value = `<?=$theme->sth_info_color?>`;
								document.querySelector('#colWarning').value = `<?=$theme->sth_warning_color?>`;
								document.querySelector('#colDanger').value = `<?=$theme->sth_danger_color?>`;
								document.querySelector('#colTextMain').value = `<?=$theme->sth_text_color?>`;
								document.querySelector('#colTextDark').value = `<?=$theme->sth_dark_text_color?>`;
								imageContainer.src = `<?=base_url()?>uploads/survey/themes/<?=$theme->sth_primary_image?>`;
								document.querySelector('#sampleHeaderText').style.color = `<?=$theme->sth_text_color?>`;
								document.querySelector('#sampleParagraph').style.color = `<?=$theme->sth_text_color?>`;
								document.querySelector('#sampleLineSeparator').style.backgroundColor = `<?=$theme->sth_secondary_color?>`;
								document.querySelector('#samplePrimaryButton').style.backgroundColor = `<?=$theme->sth_primary_color?>`;
								document.querySelector('#samplePrimaryButton').style.color = `<?=$theme->sth_text_color?>`;
								document.querySelector('#sampleSecondaryButton').style.backgroundColor = `<?=$theme->sth_secondary_color?>`;
								document.querySelector('#sampleSecondaryButton').style.color = `<?=$theme->sth_text_color?>`;

								uploadedImage.addEventListener('change', () => {
									document.querySelector('#themeSampleWrapper').style.display = 'flex';
									if(uploadedImage.files && uploadedImage.files[0]){
											document.querySelector('#imagePreviewError').style.display = 'none';
											fileReader.onload = e => {
												imageContainer.src = e.target.result;
											}
											fileReader.readAsDataURL(uploadedImage.files[0]);
									}
								});

								document.querySelector('#btnPreview').addEventListener('click',() => {
									
									document.querySelector('#sampleHeaderText').style.color = document.querySelector('#colTextMain').value;
									document.querySelector('#sampleParagraph').style.color = document.querySelector('#colTextMain').value;
									document.querySelector('#sampleLineSeparator').style.backgroundColor = document.querySelector('#colSecondary').value;
									document.querySelector('#samplePrimaryButton').style.backgroundColor = document.querySelector('#colPrimary').value;
									document.querySelector('#samplePrimaryButton').style.color = document.querySelector('#colTextMain').value;
									document.querySelector('#sampleSecondaryButton').style.backgroundColor = document.querySelector('#colSecondary').value;
									document.querySelector('#sampleSecondaryButton').style.color = document.querySelector('#colTextMain').value;
								})

								document.querySelector('#btnasdfubmit').addEventListener('click',(e) => {
									e.preventDefault();
									let error = false;
									if(document.querySelector('#txtName').value === '' || !uploadedImage.files[0] ){
											if(document.querySelector('#txtName').value === ''){
												console.log("Please enter a name.")
												document.querySelector('#themeNameError').style.display = "inline-block";
											}else{
												document.querySelector('#themeNameError').style.display = "none";
											}

											if(!uploadedImage. files[0]){
												console.log("Add an image");
											}
											error = true;
									}

									// if(error === false){
											let data = {
												'sth_theme_name' : document.querySelector('#txtName').value,
												'sth_primary_color': document.querySelector('#colPrimary').value,
												'sth_secondary_color': document.querySelector('#colSecondary').value,
												'sth_tertiary_color': document.querySelector('#colTertiary').value,
												'sth_success_color': document.querySelector('#colSuccess').value,
												'sth_info_color': document.querySelector('#colInfo').value,
												'sth_warning_color': document.querySelector('#colWarning').value,
												'sth_danger_color': document.querySelector('#colDanger').value,
												'sth_text_color': document.querySelector('#colTextMain').value,
												'sth_dark_text_color': document.querySelector('#colTextDark').value,
												'sth_primary_image': document.querySelector('#txtName').value,
												'image': document.querySelector('#filePrimaryImage'),
											}
											
											
									// }else{
									//     console.log("gawa ka ng error handlers lex");
									// }
								});
								
							</script>
					</div>
				</div>
			</div>


	</div>

	</div>
	<!-- end of page wrapper -->
</div>

<script type="text/javascript" src="https://nsmartrac.com/assets/js/survey.js"></script>
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>