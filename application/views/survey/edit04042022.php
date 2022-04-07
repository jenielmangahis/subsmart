<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	include viewPath('includes/header');
?>
<script src="<?php echo $url->assets ?>plugins/jquery-initialize/jquery.initialize.min.js"></script>
<style>
	#card-order-list .dropleft .dropdown-toggle::before {
		content: unset !important;
	}
	#btn-add-question-bottom::after {
			content: unset !important;
	}
	.btn-add-question-bottom{
		position: absolute;
			left: 20px;
					bottom: -24px;
	}
	#btn-add-question-bottom:focus{
		color: black;
	}
	#btn-add-question-bottom{
			width: 52px;
			height: 52px;
			display: flex;
			justify-content: center;
			align-items: center;
			border: 1px solid #e4e4e4;

			border-radius: 50%;
			background: white;
	}
		textarea.form-control{
			height: auto !important;
		}
	.dropdown-menu a{
		display: flex;
		align-items: center;
	}
	.dropdown-menu a i, .icon-design{
		align-items: center;
		justify-content: center;
		display: flex;
		width: 45px;
		height: 25px;
		color: white;
		border-radius: 5px;
		margin-right: .5rem;
		font-size: 14px;
	}

		.gu-mirror {
		position: fixed !important;
		margin: 0 !important;
		z-index: 9999 !important;
		opacity: 0.8;
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
		filter: alpha(opacity=80);
	}
	.gu-hide {
		display: none !important;
	}
	.gu-unselectable {
		-webkit-user-select: none !important;
		-moz-user-select: none !important;
		-ms-user-select: none !important;
		user-select: none !important;
	}
	.gu-transit {
		opacity: 0.2;
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
		filter: alpha(opacity=20);
	}
	.rating-header {
			margin-top: -10px;
			margin-bottom: 10px;
	}

	/* theme cards */
	div.theme-card{
			padding: 0;
			border: 0;
	}

	div.theme-card:hover{
			transition-duration: 300ms;
			transform: scale(1.05);
			box-shadow: 0px 0px 10px #000000;
	}

	div.color-slots{
			display: inline-block;
	}

	div.color-slot{
			padding: 5px 15px;
			margin: 0 10px 0 0;
			background-color: #333333;
			float: left;
	}

	/* theme cards */
	div.theme-card{
			padding: 0;
			border: 0;
	}

	div.theme-card:hover{
			transition-duration: 300ms;
			transform: scale(1.05);
			box-shadow: 0px 0px 10px #000000;
	}

	div.color-slots{
			display: inline-block;
	}

	div.color-slot{
			padding: 5px 15px;
			margin: 0 10px 0 0;
			background-color: #333333;
			float: left;
	}

	.theme-image{
			width: 100%;
			max-height: 100px;
			height: auto;
			object-fit: cover;
	}

	.theme-info{
			position: absolute;
	}


</style>
<script>

	var questionBoxVisibility = true;
	var currentOrder = null;

	// set settings localstorage
	console.log(localStorage.getItem('cls_as'));
	setTimeout(() => {
	
		autoSave = localStorage.getItem('cls_as');
		document.querySelector('#btnPublish').innerHTML = (autoSave == true) ? "Auto-save" : "Publish";
		document.querySelector('#btnPublish').disabled = (autoSave == true) ? true : false;
	
		
	}, 500);


</script>
<div class="wrapper" role="wrapper">
	<?php include viewPath('includes/sidebars/marketing'); ?>
	<!-- page wrapper start -->
	<div wrapper__section>
		<input id="survey_real_id" type="hidden" value="<?= $this->uri->segment(3) ?>">
		<div class="container-fluid">
			<div class="page-title-box">
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<!-- header -->
						<div class="container-fluid mb-3">
							<a href="<?= base_url()?>survey">Back to survey list</a>
							<div class="row">

								<div class="col">
									<h1 id="survey-title" class="m-0"><?= $survey->title ?></h1>
									<p>
										<?php
											if($survey_theme !== null){
												?>
													Current theme: <span class="font-weight-bold"><?= $survey_theme->sth_theme_name?></span><br/>
												<?php
											}else{
												?>
													No theme selected <a href="#" data-toggle="modal" data-target="#selectThemeModal">Add theme</a><br/>
												<?php
											}

											if($survey->canRedirectOnComplete == 1){
												?>
													<span id="redirection-link-text">
														Redirection Link: <a href=" <?=$survey->redirectionLink?>"> <?=$survey->redirectionLink?></a>
													</span>
												<?php
											}
										?>
									</p>

								</div>

								<!-- buttons -->
								<div class="col-auto">
									<div class="h1-spacer">
										<?php if(count($questions) !== 0){?>
											<a href="<?= base_url() ?>survey/preview/<?= $survey->id ?>?mode=preview" target="_blank" class="btn btn-info btn-md text-light" type="button" name="button">Preview</a>
										<?php } ?>
										
										<div class="btn-group">
											<button id="btnPublish" class="btn btn-dark btn-md text-light " disabled></button>
											<button class="btn btn-dark btn-md text-light dropdown-toggle" data-toggle="dropdown"></button>
											<div class="dropdown-menu dropdown-menu-right">
												<button id="btnToggleAutoPublish" type="button" class="dropdown-item"><i class="fa fa-check-circle" style="color="rgb(0,255,0)"></i> Publishing autimatically on change </button>
												<button id="btnRestoreSettings" type="button" class="dropdown-item">Restore last changes</button>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							<div id="autoSaveAlert" class="alert alert-dark" style="display: none">
								<i class="fa fa-info-circle"></i>
								Every changes you make are <b>automatically saved</b>, so there's no need to look for a save button for now.
							</div>
						</div>

						<!-- menu bar -->
						<div class="py-2">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="list" href="#builder-box"><i class="fa fa-wrench"></i> Builder</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="list" href="#logic-box"><i class="fa fa-link"></i> Logic</a>
								</li>
								<li class="nav-item">
								</li>
									<a class="nav-link" data-toggle="list" href="#themes-box"><i class="fa fa-paint-brush"></i> Themes</a>
								<li class="nav-item">
									<a class="nav-link" data-toggle="list" href="#settings-box"><i class="fa fa-cog"></i> Settings</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="list" href="#ra-box"><i class="fa fa-lock"></i> Respondent Access</a>
								</li>
							</ul>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 px-3">
								<!-- main content -->
								<div class="tab-content"  id="nav-tabContent"> 

									<!-- builder tab -->
									<div class="tab-pane fade show active" id="builder-box">
											<div class="row">
												<div class="col-xs-12 col-sm-6">
													<div class="d-flex w-100 justify-content-between">
														<div>
															<h2 class="m-0">Builder </h2>
															<?php
																if($survey->isScoreMonitored == true){
																	?>
																		<span class="badge badge-primary">Score-based</span>
																	<?php
																}
															?>
															
														</div>
														
														<div>
															<!-- dropdown menu for adding new questions -->
															<div class="btn-group dropleft">
																<button class="btn btn-primary btn-sm text-light dropdown-toggle " type="button" id="dropdownAddQuestion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add New Question</button>
																<div class="dropdown-menu dropdown-menu-left"  style="width: 450px" aria-labelledby="dropdownAddQuestion">
																	<div class="row align-items-start">
																		<?php foreach ($qTemplate as $template){?>
																			<?php //if($template->id != 1): ?>
																				<div class="col-xs-12 col-sm-6 ">
																					<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/<?= $template->id ?>" class="dropdown-item btn-add-question" id="add-question"> <i class="<?= $template->icon ?>" style="background-color: <?= $template->color; ?>"></i> <?= $template->type ?></a>
																				</div>
																			<?php //endif; ?>
																			<?php }; ?>
																	</div>
																</div>
															</div>

															<!-- <button id="btn-change-view" class="btn btn-sm btn-dark"><i class="fa fa-th"></i> Shrink List</button> -->
														</div>
														
														<!-- <button class="btn btn-sm btn-dark"><i class="fa fa-th"></i></button> -->
													</div>
													<hr/>
													<?php
														if(count($questions) === 0){
															?>
																<div class="alert alert-dark">
																	There are no questions listed for now.
																</div>
															<?php
														}else{
															?>
																<div class="row" id="card-order-list">
																	<?php foreach($questions as $key =>  $question){ 
																		if($question->template_id == 20){
																			?>
																			<div id="container-<?=$question->id?> card-group-questions-list" class="col-sm-12">
																				<div class="card">
																					<div class="card-body p-0">
																					drag here
																					</div>
																				</div>
																			</div>
																			<?php
																		}else{
																			?>
																				<!-- main container -->
																				<div id="container-<?= $question->id ?>" class="col-sm-12">
																					<div class="card">
																						<div class="card-body p-0">

																							<!-- main question -->
																							<?= form_open("survey/update/question/".$question->id."", array('id'=>'frm-update-question')); ?>

																								<div class="d-flex justify-content-between">
																									<!-- title -->
																									<h5 class="card-title d-flex">
																										<i class="icon-design <?= $question->template_icon ?>" style="background-color:<?= $question->template_color ?>;"><strong class="px-1"><?=$key?></strong></i> <?= $question->template_title ?>
																										<?php if($question->required == 1){ ?>
																											<label class="text-danger" id="required-asterisk-<?= $question->id ?>">*</label>
																										<?php }; ?>
																									</h5>
																									
																									<!-- More options Drawer -->
																									<div class="btn-group justify-content-right">
																										<div>
																											<a class="btn btn-sm text-white btn-danger" href="<?php echo base_url()?>survey/<?= $survey->id?>" id="btn-question-delete"  data-id="<?= $question->id ?>"><i class="fa fa-trash"></i></a>
																										</div>
																										<div>
																											<a class="btn btn-sm text-white btn-info" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent<?= $question->id ?>" aria-controls="navbarToggleExternalContent<?= $question->id ?>" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-ellipsis-v"></i></a>
																										</div>
																									</div>
																								</div>

																								<div class="question-input-box" >
																									<input type="hidden" name="survey_id" value="<?= $question->id ?>">

																									<div class="form-group">
																										<input type="text" class="form-control questions" name="question" value="<?= $question->question ?>" data-id="<?= $question->id ?>" placeholder="Enter your question">
																									</div>

																									<div id="description-container">
																										<?php if($question->description == 1){ ?>
																											<div class="form-group">
																												<input type="text" class="form-control questions" name="description_label" placeholder="Description here" value="<?= $question->description_label ?>">
																											</div>
																										<?php } ?>
																									</div>

																									<div id="choices">
																										<?php if($question->template_id == 3 || $question->template_id == 4 || $question->template_id == 15){
																												foreach($question->questions as $option){
																													?>
																														<div class="d-flex w-100 justify-content-between">
																															<?php echo $option->survey_template_choice; ?>
																															<button id="btn-delete-option" data-id="<?= $option->id?>" class="btn btn-outline-danger" type="button" name="button"><i class="fa fa-trash"></i></button>
																														</div>
																													<?php
																												}
																										}else{ ?>

																										<!-- <?= $question->questions[0]->survey_template_choice ?> -->
																										<?php } ?>
																									</div>
																									<div class="d-flex justify-content-end">
																										<?php if($question->template_id == 3 || $question->template_id == 4 ||$question->template_id == 15){ ?>
																											<button id="add-question-choice" data-id="<?= $question->id ?>" data-template-id="<?= $question->template_id ?>" class="btn btn-success btn-sm" type="button" name="button">Add Choice</button>
																										<?php } ?>
																										<!-- <button class="btn btn-success ml-2 btn-sm" type="submit" name="button">Save Changes</button> -->
																									</div>
																									

																									<div class="collapse" id="navbarToggleExternalContent<?= $question->id ?>">
																										<ul class="list-group">
																											<!-- image upload field -->
																											<li class="list-group-item d-flex-justify-content-between">
																												<div class="d-flex w-100 justify-content-between">
																													<div class="custom-file">
																														<input type="file" class="custom-file-input" id="image_background" name="image_background" data-id="<?=$question->id?>">
																														<label class="custom-file-label" for="imageUpload">
																															<?=($question->image_background == "" || $question->image_background == null)?"Upload an image here":"Current Image: ". $question->image_background?>
																														</label>
																													</div>
																												</div>
																											</li>

																											<!-- custom button text field -->
																											<li class="list-group-item">
																												<div class="d-flex w-100 justify-content-between">
																													<span>Custom button text:</span>
																													<input class="form-control" type="text" name="txtCustomButtonText" id="txtCustomButtonText" placeholder="Enter custom button text" data-id="<?=$question->id?>" value="<?= ($question->custom_button_text == null || $question->custom_button_text == "") ? "" : $question->custom_button_text ?>">
																												</div>
																											</li>

																											<!-- character limits -->
																											<li class="list-group-item d-flex-justify-content-between">
																												<div class="d-flex w-100 justify-content-between">
																													<?php if($question->template_id == 6 || $question->template_id == 8 ||$question->template_id == 9 || $question->template_id == 13){ ?>
																														<!-- <button id="add-question-choice" data-id="<?= $question->id ?>" data-template-id="<?= $question->template_id ?>" class="btn btn-dark btn-block" type="button" name="button">Add Choice</button> -->
																														<div>
																															<label for="maxcharacters"> Max. characters</label>
																															<input type="number" class="form-control questions" data-id="<?=$question->id?>" id="maxcharacters" name="maxcharacters" value="<?= $question->maxcharacters?>">
																														</div>
																														<div>
																															<label for="mincharacters"> Min. characters</label>
																															<input type="number" class="form-control questions" data-id="<?=$question->id?>" id="mincharacters" name="mincharacters" value="<?= $question->mincharacters?>">
																														</div>
																													<?php } ?>
																												</div>
																											</li>
																											
																											<!-- required checkbox -->
																											<li class="list-group-item">
																												<div class="d-flex w-100 justify-content-between">
																													<span>Required</span>
																													<div class="form-check">
																														<input <?= ($question->required == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="required" data-id="<?= $question->id ?>" id="required<?= $question->id ?>">
																													</div>
																												</div>
																											</li>
																											
																											<!-- description check box -->
																											<li class="list-group-item">
																												<div class="d-flex w-100 justify-content-between">
																													<span>Description</span>
																													<div class="form-check">
																														<input <?= ($question->description == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="description" data-id="<?= $question->id ?>" id="description<?= $question->id ?>">
																													</div>
																												</div>
																											</li>

																											<li class="list-group-item">
																												<div class="d-flex w-100 justify-content-between">
																													<span>Include this in the scoring system?</span>
																													<div class="form-check">
																														<input <?= ($question->isScoreCounted == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="isScoreCounted" data-id="<?= $question->id ?>" id="isScoreCounted<?= $question->id ?>">
																													</div>
																												</div>
																											</li>

																											<!-- custom button text field -->
																											<li class="list-group-item">
																												<div class="d-flex w-100 justify-content-between">
																													<span>Correct Answer:</span>
																													<input class="form-control" type="text" name="txtCorrectAnswerText" id="txtCorrectAnswerText" placeholder="Enter the value of the correct answer" data-id="<?=$question->id?>" value="<?= ($question->correctAnswer == null || $question->correctAnswer == "") ? "" : $question->correctAnswer ?>">
																												</div>
																											</li>

																										</ul>
																										
																									</div>
																									<!-- End of More Options Drawer -->

																									<div class="dropdown btn-add-question-bottom">
																										<button class="btn btn-light dropdown-toggle" type="button" id="btn-add-question-bottom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																										<i class="fa fa-plus"></i>
																										</button>
																										<div class="dropdown-menu" aria-labelledby="btn-add-question-bottom">
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/9" class="dropdown-item" id="add-question-bottom">Welcome Screen</a>
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/1" class="dropdown-item" id="add-question-bottom">Short Text</a>
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/2" class="dropdown-item" id="add-question-bottom">Long Text</a>
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/3" class="dropdown-item" id="add-question-bottom">Single Choice Answer</a>
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/4" class="dropdown-item" id="add-question-bottom">Multiple Choice Answer</a>
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/5" class="dropdown-item" id="add-question-bottom">Email Type</a>
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/6" class="dropdown-item" id="add-question-bottom">Number Type</a>
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/7" class="dropdown-item" id="add-question-bottom">Image Type</a>
																											<a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/8" class="dropdown-item" id="add-question-bottom">Phone Number Type</a>
																										</div>
																									</div>

																								</div>

																							<?= form_close(); ?>


																						</div>
																					</div>
																				</div>
																				<!-- end of container -->
																			<?php
																		}

																		?>
																		
																		
																	<?php };?>
																</div>
															<?php
														}
													?>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6 px-3">
													<iframe src="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview&src=results" frameborder="0" style="width: 100%; height: 600px"></iframe>
													<a href="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview" class="btn btn-outline-primary btn-block text-center" target="_blank"><i class="fa fa-eye"></i> Preview on another page</a>
												</div>
											</div>
									</div>

									<!-- logic tab -->
									<div class="tab-pane fade" id="logic-box">
										<h2>Logic settings</h2>
										<div class="row">

											<div class="col-xs-12 col-md-6">

														<!-- title of the question selected -->
														<div class="card">
															<div class="card-content">
																<h5 class="card-title d-flex">
																	<i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here
																	
																		<label class="text-danger" id="required-asterisk-<?= $question->id ?>">*</label>
																	
																</h5>
															</div>
														</div>

														<!-- if question has no logic -->
														<div class="card">
															<div class="card-content">
																<div class="d-flex w-100 justify-content-between">
																	<h6 class="card-title">
																		Show different questions based on people's answers.
																	</h6>
																	<button id="btn-add-logic-jump" class="btn btn-primary">Add Logic jump</button>
																</div>
															</div>
														</div>
														<script>
															document.querySelector("#btn-add-logic-jump").addEventListener('click', () => {
																console.log("sending data");
																let data = {
																	'surveyId': <?=$survey->id?>
																}
																$.ajax({
																	url: surveyBaseUrl + 'survey/logic/add',
																	data: data,
																	type: 'POST',
																	dataType: 'json',
																	success: function(res){
																		window.alert("Logic added to this question");
																	}
																});
															})
														</script>
														<!-- end if -->

														<!-- if question has logic -->
														<div class="card">
															<div class="card-content">
																<span>When someone answers this question:</span>
																<hr/>
																<!-- <div class="justify-content-between"> -->

																	<div class="d-flex w-100 ">
																		<h5 class="card-title">if</h5>
																		<select class="custom-select" name="selectIfQuestionFrom" id="selectIfQuestionFrom">
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																		</select>
																		
																		<select class="custom-select" name="selectCondition" id="selectCondition">
																			<option value="asdf">is equal to </option>
																			<option value="asdf">is not equal to </option>
																			<option value="asdf">begins with</option>
																			<option value="asdf">ends with</option>
																			<option value="asdf">contains</option>
																			<option value="asdf">does not contain</option>
																		</select>
																	</div>

																	<div class="d-flex w-100 justify-content-left">
																		<select name="selectifQuestionTo" id="selectIfQuestionTo" class="custom-select">
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																		</select>
																		<button class="btn btn-secondary btn-sm">+</button>
																	</div>
																	<hr/>
																	<div class="d-flex w-100 justify-content-left">
																		<span>Then jump to</span>
																		<select class="custom-select" name="selectJumpToQuestion" id="selectJumpToQuestion">
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																			<option value="asdf"><i class="icon-design fa fa-cog" style="background-color: #ff5555;"><strong class="px-1">1</strong></i> question text here</option>
																		</select>
																	</div>
																	
																<!-- </div> -->
															</div>
														</div>


														<div class="card">
															<div class="card-content">
																<div class="d-flex w-100 justify-content-between">
																	<p>Always jump to</p>
																	<select name="selectJumpToQuestion" id="selectJumpToQuestion" class="custom-select">
																		<option value="keme">root</option>
																		<option value="keme">root</option>
																		<option value="keme">root</option>
																		<option value="keme">root</option>
																		<option value="keme">root</option>
																	</select>
																</div>
															</div>
														</div>
											</div>

											<div class="col-xs-12 col-md-6">
												<div class="row" id="card-order-list">
													<?php foreach($questions as $key =>  $question){ 
														if($question->template_id == 20){
															?>
															<div id="container-<?=$question->id?> card-group-questions-list" class="col-sm-12">
																<div class="card">
																	<div class="card-body p-0">
																	drag here	
																	</div>
																</div>
															</div>
															<?php
														}else{
															?>
																<div id="container-<?= $question->id ?>" class="col-sm-12">
																	<div class="card" onclick="selectQuestion(<?=$question->id?>)">
																		<div class="card-body p-0">
																				<span>
																					<h5 class="card-title d-flex">
																						<i class="icon-design <?= $question->template_icon ?>" style="background-color:<?= $question->template_color ?>;"><strong class="px-1"><?=$key?></strong></i> <?= $question->template_title ?>
																						<?php if($question->required == 1){ ?>
																							<label class="text-danger" id="required-asterisk-<?= $question->id ?>">*</label>
																						<?php }; ?>:
																					</h5>
																					<?= $question->question ?>
																				</span>
																				<hr/>
																		</div>
																	</div>
																</div>
																
															<?php
														}

														?>

														<script>
															selectQuestion = question_id => {
																console.log(question_id);
															}
														</script>
														
														
													<?php };?>
												</div>
											</div>
										</div>
										<script>
										</script>
									</div>

									<!-- themes tab -->
									<div class="tab-pane fade" id="themes-box">
										<h2>Themes</h2>
										<p>Click one to select a theme</p>
										<div class="row">
											<?php foreach($themes as $key => $theme){?>
												<div data-id="<?php $theme->sth_rec_no?>" class="col-xs-12 col-sm-4">
													<a href="<?= base_url()?>survey/themes/select/<?= $survey->id?>/<?= $theme->sth_rec_no ?>">
														<div class="card theme-card">
																<img src="<?= base_url()?>uploads/survey/themes/<?= $theme->sth_primary_image?>" style="<?= $theme->sth_primary_image_class?>" alt="<?= $theme->sth_primary_image?>" class="theme-image">
																<div class="theme-info">
																	<div class="card-body">
																		<h4 style="color: <?= $theme->sth_text_color?>">
																			<?= $theme->sth_theme_name?>
																			<?php
																				if($survey_theme != null){
																					if($theme->sth_rec_no === $survey_theme->sth_rec_no){echo'<i class="fa fa-check-circle"></i>';};
																				}
																			?>
																		</h4>
																		<div class="color-slots">
																			<div class="color-slot" style="background-color: <?= $theme->sth_primary_color ?>"></div>
																			<div class="color-slot" style="background-color: <?= $theme->sth_secondary_color ?>"></div>
																			<div class="color-slot" style="background-color: <?= $theme->sth_tertiary_color ?>"></div>
																		</div>
																	</div>
																</div>
														</div>
													</a>
												</div>
											<?php }?>
										</div>
									</div>

									<!-- settings tab -->
									<div class="tab-pane fade " id="settings-box">
										<h2>Survey Settings</h2>
										<ul class="list-group">
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Survey Name</span>
													<input type="text" name="txtSurveyTitle" class="form-control" id="txtSurveyTitle" data-id="<?=$survey->id?>" value="<?= $survey->title?>">
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Survey Workspace</span>
													<select name="selWorkspace" id="selWorkspace" class="custom-select">

														<?php
															if($survey->workspace_id == 0 || $survey->workspace_id == ""){
																?>
																	<option disabled selected value="0">Select workspace</option>
																<?php
															}
															foreach($survey_workspaces as $key => $workspace){
																?>
																	<option onclick="selectWorkspace(<?=$workspace->id?>)" <?= ($survey->workspace_id === $workspace->id)?"selected":""?> value="<?=$workspace->id?>"><?=$workspace->name?></option>
																<?php
															}
														?>
													</select>
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Show Progress</span>
													<div class="form-check">
														<input 	<?= ($survey->hasProgressBar == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="hasProgressBar" data-id="<?= $survey->id ?>" id="hasProgressBar<?= $survey->id ?>">
													</div>
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Redirect on complete</span>
													<div class="form-check">
														<input <?= ($survey->canRedirectOnComplete == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="canRedirectOnComplete" data-id="<?= $survey->id ?>" id="canRedirectOnComplete<?= $survey->id ?>">
													</div>
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Use Background Image <em class="text-muted"><small>NOTE: This works when a custom image is uploaded and existing</small></em></span>
													<div class="form-check">
														<input <?= ($survey->useBackgroundImage == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="useBackgroundImage" data-id="<?= $survey->id ?>" id="useBackgroundImage<?= $survey->id ?>">
													</div>
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Background Image: <strong id="customImageBackgroundName"><?= ($survey->backgroundImage === "") ? "none" : $survey->backgroundImage?></strong></span>
													<?= form_open('survey/upload/custombackgroundimage/'.$survey->id, array('id' => 'form-upload-custom-image-background'))?>
														<input type="file" value="useCustomBackgroundImage" name="useCustomBackgroundImage" data-id="<?= $survey->id ?>" id="useCustomBackgroundImage<?= $survey->id ?>">
													<?= form_close();?>
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Redirection Link</span>
													<input type="text" <?= ($survey->canRedirectOnComplete == 0) ? "disabled" : "" ?> name="txtRedirectionLink" class="form-control" id="txtRedirectionLink" data-id="<?=$survey->id?>" value="<?= $survey->redirectionLink?>" placeholder="https://..">
												</div>
											</li>
											
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Count Scores</span>
													<div class="form-check">
														<input <?= ($survey->isScoreMonitored == 1) ? "checked" : ""; ?> type="checkbox" name="isScoreMonitored" id="isScoreMonitored<?=$survey->id?>" class="form-check-input" value="isScoreMonitored"  data-id="<?=$survey->id?>" value="<?= $survey->isScoreMonitored?>">
													</div>
												</div>
												<!-- <button class="btn btn-success btn-block">Save Changes</button> -->
											</li>
										</ul>
									</div>
									
									<!-- respondent access tab -->
									<div class="tab-pane fade " id="ra-box">
										<h2>Respondent Access</h2>
										<p>Manage respondent access</p>
										<ul class="list-group">
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Close Typeform to new responses</span>
													<div class="form-check">
														<input <?= ($survey->isNewRespondentsClosed == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="isNewRespondentsClosed" data-id="<?= $survey->id ?>" id="isNewRespondentsClosed<?= $survey->id ?>">
													</div>
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Schedule a closing date</span>
													<div class="form-check">
														<input <?= ($survey->hasClosedDate == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="hasClosedDate" data-id="<?= $survey->id ?>" id="hasClosedDate<?= $survey->id ?>">
													</div>
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Closing date</span>
													<input type="date" <?= ($survey->hasClosedDate == 0) ? "disabled" : "" ?> name="txtSchedDate" id="txtSchedDate" data-id="<?= $survey->id ?>" value="<?= (date($survey->closingDate) == -62170005208) ? "":date($survey->closingDate) ?>" class="form-control">
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Set a response limit</span>
													<div class="form-check">
														<input <?= ($survey->hasResponseLimit == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="hasResponseLimit" data-id="<?= $survey->id ?>" id="hasResponseLimit<?= $survey->id ?>">
													</div>
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Response Limit</span>
													<input type="number" <?= ($survey->hasResponseLimit == 0) ? "disabled" : "" ?> name="txtResponseLimit" id="txtResponseLimit" data-id="<?= $survey->id ?>" value="<?= $survey->responseLimit ?>" class="form-control">
												</div>
											</li>
											<li class="list-group-item">
												<div class="d-flex w-100 justify-content-between">
													<span>Set a custom closing message</span>
													<textarea type="text" name="txtClosingMessage" id="txtClosingMessage" data-id="<?= $survey->id ?>" class="form-control" placeholder="Write a closing message.."></textarea>
												</div>
											</li>
										</ul>

									</div>


								</div>
							</div>
							<!-- <div class="col-xs-12 col-sm-12 col-md-6 px-3">
								<iframe src="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview&src=results" frameborder="0" style="width: 100%; height: 600px"></iframe>
								<a href="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview" class="btn btn-outline-primary btn-block text-center" target="_blank"><i class="fa fa-eye"></i> Preview on another page</a>
							</div> -->

							
							
							
							
						</div>


						</div>
					</div>
				</div>
				<!-- end card -->

			</div>
			<!-- end row -->

		</div>
	</div>

</div>

<?php include viewPath('includes/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
<script>

	currentOrder = document.querySelector('#card-order-list').innerHTML;
	currentSettings = {
		settings: {
			name: document.querySelector('#txtSurveyTitle').value,
			hasProgressBar: document.querySelector('#hasProgressBar<?=$survey->id?>').checked,
			canRedirectOnComplete: document.querySelector('#canRedirectOnComplete<?=$survey->id?>').checked,
			txtRedirectionLink: document.querySelector('#txtRedirectionLink').value,
			isScoreCounted: document.querySelector('#isScoreCounted<?=$survey->id?>').checked,
			txtCorrectAnswerText: document.querySelector('#txtCorrectAnswerText').value,
		},
		ra: {
			isNewRespondentsClosed: document.querySelector('#isNewRespondentsClosed<?=$survey->id?>').checked,
			hasClosedDate: document.querySelector('#hasClosedDate<?=$survey->id?>').checked,
			txtSchedDate: document.querySelector('#txtSchedDate').value,
			hasResponseLimit: document.querySelector('#hasResponseLimit<?=$survey->id?>').checked,
			txtResponseLimit: document.querySelector('#txtResponseLimit').value,
			txtClosingMessage: document.querySelector('#txtClosingMessage').value,
		}
	}

	// input detection
	$(document).on('keypress', 'input', function(e){
		if(!localStorage.getItem('cls_as')){
			document.querySelector('#btnPublish').disabled = false;
			document.querySelector('#btnPublish').innerHTML  = 'Publish';
		}
	})
	
	$(document).on('change', 'input', function(e){
		if(!localStorage.getItem('cls_as')){
			document.querySelector('#btnPublish').disabled = false;
			document.querySelector('#btnPublish').innerHTML  = 'Publish';
		}
	})
	
	$(document).on('change', 'select', function(e){
		if(!localStorage.getItem('cls_as')){
			document.querySelector('#btnPublish').disabled = false;
			document.querySelector('#btnPublish').innerHTML  = 'Publish';
		}
	})

	// toggle autosave
	$(document).on('click', '#btnToggleAutoPublish', function(e){
		if(localStorage.getItem('cls_as')){
			localStorage.removeItem('cls_as');
		}else{
			localStorage.setItem('cls_as',1)
		}
		
		autoSave = localStorage.getItem('cls_as');
		document.querySelector('#btnPublish').innerHTML = (autoSave == true) ? "Auto-save" : "Publish";
		document.querySelector('#btnPublish').disabled = (autoSave == true) ? true : false;
	
	})

	// publish button
	$(document).on('click', '#btnPublish', function(e){
		this.innerHTML = 'Publishing..'
		setTimeout(() => {
			this.innerHTML = 'Published';
			this.disabled = true;
			saveAllSettings();
		}, 1500);
	})

	// saves the order of the questions
	saveQuestionOrder = () => {
		var number = [];
    $.each($('#card-order-list .col-sm-12'), function(key, value){
			number.push(value.id.split("-")[1]);
    });
    $.ajax({
      url: base_url + '/survey/order/question',
      data: { 'id': number },
      dataType: 'json',
      type: 'POST',
      success: function(res){
        toastr["success"]("Order Successfully Update!");
      }
    })
	}
	
	$(document).on('click', '#btnRestoreSettings', function(e){
		document.querySelector('#card-order-list').innerHTML = currentOrder;
		document.querySelector('#txtSurveyTitle').value = currentSettings.settings.name;
		document.querySelector('#hasProgressBar<?=$survey->id?>').checked = currentSettings.settings.hasProgressBar;
		document.querySelector('#canRedirectOnComplete<?=$survey->id?>').checked = currentSettings.settings.canRedirectOnComplete;
		document.querySelector('#txtRedirectionLink').value = currentSettings.settings.txtRedirectionLink;
		document.querySelector('#isScoreCounted<?=$survey->id?>').value = currentSettings.settings.isScoreCounted;
		document.querySelector('#isNewRespondentsClosed<?=$survey->id?>').checked = currentSettings.ra.isNewRespondentsClosed;
		document.querySelector('#hasClosedDate<?=$survey->id?>').checked = currentSettings.ra.hasClosedDate;
		document.querySelector('#txtSchedDate').value = currentSettings.ra.txtSchedDate;
		document.querySelector('#hasResponseLimit<?=$survey->id?>').checked = currentSettings.ra.hasResponseLimit;
		document.querySelector('#txtResponseLimit').value = currentSettings.ra.txtResponseLimit;
		document.querySelector('#txtClosingMessage').value = currentSettings.ra.txtClosingMessage;
		document.querySelector('#survey-title').innerHTML = currentSettings.settings.name;
		saveQuestionOrder();
	})

	$(document).on('click','#btn-change-view',function(e){
		questionBoxVisibility = !questionBoxVisibility;
		$.each($('.question-input-box'), function(key, value){
			$('#btn-change-view').html(questionBoxVisibility ? '<i class="fa fa-th"></i> Shrink List' : '<i class="fa fa-th"></i> Expand List')
			$('.question-input-box').css('display',(!questionBoxVisibility ? 'none' : 'block'));
		})
	});

	saveAllSettings = () => {
		if(localStorage.getItem('cls_as')){
			return;
		}

    let formData = {
			"title": document.querySelector('#txtSurveyTitle').value,
			"redirectionLink":document.querySelector('#txtRedirectionLink').value,
			"hasProgressBar": (document.querySelector("#hasProgressBar<?=$survey->id?>").checked) ? '1' : '0',
			"canRedirectOnComplete": (document.querySelector("#canRedirectOnComplete<?=$survey->id?>").checked) ? '1' : '0',
			"isNewRespondentsClosed": (document.querySelector("#isNewRespondentsClosed<?=$survey->id?>").checked) ? '1' : '0',
			"hasClosedDate": (document.querySelector("#hasClosedDate<?=$survey->id?>").checked) ? '1' : '0',
			"useBackgroundImage": (document.querySelector("#useBackgroundImage<?=$survey->id?>").checked) ? '1' : '0',
			"isScoreCounted": (document.querySelector("#isScoreCounted<?=$survey->id?>").checked) ? '1' : '0',
			"hasResponseLimit": (document.querySelector("#hasResponseLimit<?=$survey->id?>").checked) ? '1' : '0',
			"closingDate": document.querySelector('#txtSchedDate').value,
			"responseLimit": document.querySelector('#txtResponseLimit').value,
			"workspace_id": document.querySelector('#selWorkspace').value,
			"closingMessage": document.querySelector('#txtClosingMessage').value,
		}
		let error = false;
			
		
    $.ajax({
      url: surveyBaseUrl + 'survey/update/'+<?=$survey->id?>,
      type: 'POST',
      data: formData,
      dataType: 'json',
      success: function(res){
				document.querySelector('#survey-title').innerHTML = document.querySelector('#txtSurveyTitle').value;
				document.querySelector('#redirection-link-text').innerHTML = "Redirection Link: <a href=" + document.querySelector('#txtRedirectionLink').value + "> " + document.querySelector('#txtRedirectionLink').value + " </a>";
				
      }
		});

		var customBackgroundImageFormData = new FormData(document.querySelector('#form-upload-custom-image-background'));
		$.ajax({
			url: surveyBaseUrl + 'survey/upload/custombackgroundimage/'+ id,
			type:'POST',
			data: customBackgroundImageFormData,
			cache:false,
			contentType: false,
			processData: false,
			success: function(res){
				document.querySelector('#customImageBackgroundName').innerHTML = `CB<?=$survey->id?>.jpg`;
			}
		});

		if(error == false){
			toastr["success"]("Changes saved and published!");
		}

		return;
  }
	// dragula([].slice.apply(document.querySelectorAll('.card-order-list')),{
	// 		direction: 'vertical'
	// });

  dragula([document.getElementById('card-order-list')])
  .on('drag', function (el, target,source,sibling) {
  }).on('drop', function (el, target,source,sibling) {
    saveQuestionOrder();
  });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- <script type="text/javascript" src="<?=base_url()?>/assets/js/survey.js"></script> -->
