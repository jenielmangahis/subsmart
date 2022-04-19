<style>
.logic-list{
	list-style: none;
	padding: 0px;
	margin: 0px;
}
.logic-list li{
	background-color: #32243d;
	color: #ffffff;
	padding: 17px;
	margin: 5px;
}
</style>
<h2>Logic settings</h2>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="card">
				<div class="card-content">
					<div class="d-flex w-100 justify-content-between">
						<h6 class="card-title">
							Show different questions based on people's answers.
						</h6>
						<a id="btn-add-logic-jump1" class="btn btn-primary" href="javascript:void(0);">Add Logic jump</a>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-content">
					<span>When someone answers this question:</span>
					<hr/>
					<!-- <div class="justify-content-between"> -->
					<form id="frm-logic-jump" method="POST">
					<input type="hidden" name="survey_id" value="<?= $survey->id; ?>">
					<ul class="logic-list">
						<?php foreach($survey_logic as $sl){ ?>
							<li class="li-survey-logic">
								<div class="d-flex w-100 ">
									<div class="col-12">
								      <div class="input-group mb-2">
								        <div class="input-group-prepend">
								          <div class="input-group-text" style="height:38px;">IF</div>
								        </div>
								        <select class="custom-select" name="selectIfQuestionFrom[]" id="selectIfQuestionFrom">
								        	<?php foreach($questions as $q){ ?>
								        		<?php 
								        			$question = 'Question not defined';
								        			if( $q->question != '' ){
								        				$question = $q->question;
								        			}
								        		?>
								        		<option <?= $sl->sl_question_id_from == $q->id ? 'selected="selected"' : ''; ?> value="<?=  $q->id; ?>"><?= $question; ?></option>
								        	<?php } ?>
										</select>
											<div class="input-group-prepend">
								        		<div class="input-group-text" style="height:38px;">IS</div>
								         	</div>
								         	<select class="custom-select" name="selectCondition[]" id="selectCondition">
												<option <?= $sl->sl_condition == 'is-equal-to' ? 'selected="selected"' : ''; ?> value="is-equal-to">equal to </option>
												<option <?= $sl->sl_condition == 'not-equal-to' ? 'selected="selected"' : ''; ?> value="not-equal-to">not equal to </option>
												<!-- <option value="asdf">begins with</option>
												<option value="asdf">ends with</option>
												<option value="asdf">contains</option>
												<option value="asdf">does not contain</option> -->
											</select>
											<input type="text" class="form-control" name="selectAnswer[]" value="<?= $sl->sl_value; ?>" id="" placeholder="Answer" style="height:38px;">
								      </div>								     
								    </div>
								</div>

								<div class="d-flex w-100 ">
								    <div class="col-12">
								      <div class="input-group mb-2">
								        <div class="input-group-prepend">
								          <div class="input-group-text" style="height:38px;">THEN JUMP TO</div>
								        </div>
								        <select class="custom-select" name="selectJumpQuestion[]" id="selectJumpQuestion">
											<?php foreach($questions as $q){ ?>
								        		<?php 
								        			$question = 'Question not defined';
								        			if( $q->question != '' ){
								        				$question = $q->question;
								        			}
								        		?>
								        		<option <?= $sl->sl_question_id_to == $q->id ? 'selected="selected"' : ''; ?> value="<?=  $q->id; ?>"><?= $question; ?></option>
								        	<?php } ?>
										</select>
								      </div>								     
								    </div>
								</div>
								<div class="container-fluid" style="text-align: right;">
									<a class="btn btn-sm btn-delete-logic btn-danger" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
								</div>
							</li>
						<?php } ?>						
					</ul>
					<button class="btn btn-primary btn-block btn-survey-update-logic-jump" type="button" style="margin-top:39px;width: 100%;">Save Changes</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-md-6">
			<div class="row" id="card-order-list">
				<?php foreach($questions as $key =>  $question){ ?>
				 	<?php if($question->template_id == 20){ ?>
						<div id="container-<?=$question->id?> card-group-questions-list" class="col-sm-12">
							<div class="card">
								<div class="card-body p-0">
								drag here	
								</div>
							</div>
						</div>
					<?php }else{ ?>
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
					<?php } ?>					
				<?php } ?>
			</div>
		</div>
	</div>

	<script>
		$(document).on('click', '#btn-add-logic-jump1', function(e){
			var survey_id = '<?=$survey->id?>';
			$.ajax({
				url: surveyBaseUrl + 'survey/_logic_add',
				data: {survey_id:survey_id},
				type: 'POST',				
				success: function(res){
					$(res).hide().appendTo(".logic-list").fadeIn(1000);
				}
			});
		});	

		$(document).on('click', '.btn-delete-logic', function(){
			$(this).closest('.li-survey-logic').fadeOut(500,function(){
		        $(this).closest('.li-survey-logic').remove();
		    });
		});

		$(document).on('click', '.btn-survey-update-logic-jump', function(e){
			e.preventDefault();
			var formData = new FormData($("#frm-logic-jump")[0]);   
			$.ajax({
				type: "POST",
	            url: surveyBaseUrl + 'survey/_update_survey_logic',
	            dataType: 'json',
	            contentType: false,
	            cache: false,
	            processData:false,
	            data: formData,				
				success: function(res){
					if( res.is_success == 1 ){
	                  Swal.fire({
	                      title: 'Great!',
	                      text: 'Survey Logic was successfully updated.',
	                      icon: 'success',
	                      showCancelButton: false,
	                      confirmButtonColor: '#32243d',
	                      cancelButtonColor: '#d33',
	                      confirmButtonText: 'Ok'
	                  }).then((result) => {
	                      
	                  });
	                }else{
	                  Swal.fire({
	                    icon: 'error',
	                    title: 'Error!',
	                    confirmButtonColor: '#32243d',
	                    html: res.msg
	                  });
	                } 
				}
			});
		});
	</script>