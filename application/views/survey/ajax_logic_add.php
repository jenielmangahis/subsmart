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
	        <select class="custom-select" name="selectJumpQuestion[]" id="selectJumpQuestion">
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
		<a class="btn btn-sm btn-delete-logic btn-danger" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
	</div>
</li>