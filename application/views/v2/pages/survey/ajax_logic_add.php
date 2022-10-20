<li class="li-survey-logic">
	<div class="d-flex w-100 ">
		<div class="col-12">
	      <div class="input-group mb-2">
	        <div class="input-group-prepend">
	          <div class="input-group-text" style="height:38px;">IF</div>
	        </div>
	        <select class="custom-select" name="selectIfQuestionFrom[]" id="selectIfQuestionFrom" style="width:52%;">
	        	<?php foreach($questions as $q){ ?>
	        		<?php 
	        			$question = 'Question not defined';
	        			if( $q->question != '' ){
	        				$question = $q->question;
	        			}
	        		?>
	        		<option value="<?=  $q->id; ?>"><?= $question; ?></option>
	        	<?php } ?>
			</select>
				<div class="input-group-prepend">
	        		<div class="input-group-text" style="height:38px;">IS</div>
	         	</div>
	         	<select class="custom-select" name="selectCondition[]" id="selectCondition">
					<option value="is-equal-to">equal to </option>
					<option value="not-equal-to">not equal to </option>
					<!-- <option value="asdf">begins with</option>
					<option value="asdf">ends with</option>
					<option value="asdf">contains</option>
					<option value="asdf">does not contain</option> -->
				</select>
				<input type="text" class="form-control" id="" name="selectAnswer[]" placeholder="Answer" style="height:38px;">
	      </div>								     
	    </div>
	</div>

	<div class="d-flex w-100 ">
	    <div class="col-12">
	      <div class="input-group mb-2">
	        <div class="input-group-prepend">
	          <div class="input-group-text" style="height:38px;">THEN JUMP TO</div>
	        </div>
	        <select class="custom-select" name="selectJumpQuestion[]" id="selectJumpQuestion" style="width:503px;">
				<?php foreach($questions as $q){ ?>
	        		<?php 
	        			$question = 'Question not defined';
	        			if( $q->question != '' ){
	        				$question = $q->question;
	        			}
	        		?>
	        		<option value="<?=  $q->id; ?>"><?= $question; ?></option>
	        	<?php } ?>
			</select>
	      </div>								     
	    </div>
	</div>
	<div class="container-fluid" style="text-align: right;">
		<a class="nsm-button primary btn-delete-logic" href="javascript:void(0);"><i class='bx bx-trash-alt' style="font-size: 17px;position: relative;top: 3px;"></i></a>
	</div>
</li>