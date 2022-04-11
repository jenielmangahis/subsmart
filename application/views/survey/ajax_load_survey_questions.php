<style>
.btn-question-action{
	display: inline-block;
	margin: 2px;
}
.choice-container .form-group{
	width: 90%;
}
</style>
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
	}else{ ?>
		<!-- main container -->
		<div id="container-<?= $question->id ?>" class="col-sm-12">
			<div class="card" style="background-color: #32243d; color:#ffffff;">
				<div class="card-body p-0">

					<!-- main question -->
					<?= form_open("survey/update/question/".$question->id."", array('id'=>'frm-update-question')); ?>

						<div class="d-flex justify-content-between">
							<!-- title -->
							<h5 class="card-title d-flex" style="color:#ffffff;">
								<i class="icon-design <?= $question->template_icon ?>" style="background-color:<?= $question->template_color ?>;"><strong class="px-1"><?=$key?></strong></i> <?= $question->template_title ?>
								<?php if($question->required == 1){ ?>
									<label class="text-danger" id="required-asterisk-<?= $question->id ?>">*</label>
								<?php }; ?>
							</h5>
							
							<!-- More options Drawer -->
							<div class="btn-group justify-content-right">
								<div>
									<a class="btn btn-sm text-white btn-danger btn-question-action" href="<?php echo base_url()?>survey/<?= $survey->id?>" id="btn-question-delete"  data-id="<?= $question->id ?>"><i class="fa fa-trash"></i></a>
									<a class="btn btn-sm text-white btn-info btn-question-action" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent<?= $question->id ?>" aria-controls="navbarToggleExternalContent<?= $question->id ?>" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-ellipsis-v"></i></a>
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
												<div class="d-flex w-100 justify-content-between choice-container q-choice-container-<?= $option->id; ?>" style="margin:10px 0px; height:44px;">
													<?php echo $option->survey_template_choice; ?>
													<button id="btn-delete-option" data-id="<?= $option->id?>" class="btn btn-outline-danger btn-delete-choice" type="button" name="button"><i class="fa fa-trash"></i></button>
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
									<!-- <li class="list-group-item d-flex-justify-content-between">
										<div class="d-flex w-100 justify-content-between">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="image_background" name="image_background" data-id="<?=$question->id?>">
												<label class="custom-file-label" for="imageUpload">
													<?=($question->image_background == "" || $question->image_background == null)?"Upload an image here":"Current Image: ". $question->image_background?>
												</label>
											</div>
										</div>
									</li> -->

									<!-- custom button text field -->
									<li class="list-group-item">
										<div class="d-flex w-100 justify-content-between">
											<input class="form-control" type="text" name="txtCustomButtonText" id="txtCustomButtonText" placeholder="Custom button text" data-id="<?=$question->id?>" value="<?= ($question->custom_button_text == null || $question->custom_button_text == "") ? "" : $question->custom_button_text ?>">
										</div>
									</li>
									<!-- character limits -->
									<?php if($question->template_id == 6 || $question->template_id == 8 ||$question->template_id == 9 || $question->template_id == 13){ ?>
									<li class="list-group-item d-flex-justify-content-between">
										<div class="d-flex w-100 justify-content-between">
												<!-- <button id="add-question-choice" data-id="<?= $question->id ?>" data-template-id="<?= $question->template_id ?>" class="btn btn-dark btn-block" type="button" name="button">Add Choice</button> -->
												<div>
													<label for="maxcharacters"> Max. characters</label>
													<input type="number" class="form-control questions" data-id="<?=$question->id?>" id="maxcharacters" name="maxcharacters" value="<?= $question->maxcharacters?>">
												</div>
												<div>
													<label for="mincharacters"> Min. characters</label>
													<input type="number" class="form-control questions" data-id="<?=$question->id?>" id="mincharacters" name="mincharacters" value="<?= $question->mincharacters?>">
												</div>											
										</div>
									</li>
									<?php } ?>
									
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
						</div>

					<?= form_close(); ?>


				</div>
			</div>
		</div>
		<!-- end of container -->
	<?php } ?>
<?php } ?>