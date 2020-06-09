<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
#card-list .dropleft .dropdown-toggle::before {
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


</style>
<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/marketing'); ?>
   <!-- page wrapper start -->
   <div wrapper__section>
     <input id="survey_real_id" type="hidden" value="<?= $this->uri->segment(2) ?>">
      <div class="container-fluid">
         <div class="page-title-box">
         </div>
         <!-- end row -->
         <div class="row">
            <div class="col-xl-12">
               <div class="card">
                  <div class="container-fluid mb-3">
                     <div class="row">
                        <div class="col">
                           <h1 class="m-0"><?= $survey->title ?></h1>
                        </div>
                        <div class="col-auto">
                           <div class="h1-spacer">
                             <a href="<?= base_url() ?>survey/preview/<?= $this->uri->segment(2) ?>?mode=preview" target="_blank" class="btn btn-primary btn-md text-light" type="button" name="button">Preview</a>
                              <button class="btn btn-primary btn-md text-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Add New Question
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php foreach ($qTemplate as $template): ?>
                                  <?php //if($template->id != 1): ?>
                                    <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/<?= $template->id ?>" class="dropdown-item" id="add-question"> <i class="<?= $template->icon ?>" style="background-color: <?= $template->color; ?>"></i> <?= $template->type ?></a>
                                  <?php //endif; ?>
                                <?php endforeach; ?>
                              </div>
                            </div>
                           </div>
                        </div>
                     </div>
                     <div class="tabs">
                        <ul class="clearfix work__order" id="myTab" role="tablist">
                        </ul>
                     </div>
                     <div class="row" id="card-list">
                       <?php foreach($questions as $key =>  $question): ?>

                        <div id="container-<?= $question->id ?>" class="col-sm-12">
                           <div class="card">
                              <div class="card-body p-0">
                                <?= form_open("survey/update/question/".$question->id."", array('id'=>'frm-update-question')); ?>
                                  <div class="d-flex justify-content-between">
                                    <h5 class="card-title d-flex">
                                      <i class="icon-design <?= $question->template_icon ?>" style="background-color:<?= $question->template_color ?>;"></i> <?= $question->template_title ?>
                                      <?php if($question->required == 1): ?>
                                        <label class="text-danger" id="required-asterisk-<?= $question->id ?>">*</label>
                                      <?php endif; ?>
                                    </h5>
                                    <div class="dropleft">
                                      <button  class="btn dropdown-toggle" type="button"  id="dropdownMenuButton" name="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="text-dark fa fa-ellipsis-h"></i>
                                      </button>

                                      <!-- settings -->
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent<?= $question->id ?>" aria-controls="navbarToggleExternalContent<?= $question->id ?>" aria-expanded="false" aria-label="Toggle navigation">More Options</a>
                                        <a class="dropdown-item" href="#" id="btn-question-delete"  data-id="<?= $question->id ?>">Delete</a>
                                      </div>
                                    </div>
                                  </div>
                                  <input type="hidden" name="survey_id" value="<?= $question->id ?>">
                                  <div class="form-group">
                                     <!-- <label>Question</label> -->
                                     <input type="text" class="form-control questions" name="question" value="<?= $question->question ?>" data-id="<?= $question->id ?>" placeholder="Enter your question">
                                   </div>
                                   <div id="description-container">
                                     <?php if($question->description == 1): ?>
                                        <div class="form-group">
                                          <input type="text" class="form-control questions" name="description_label" placeholder="Description here" value="<?= $question->description_label ?>">
                                        </div>
                                     <?php endif; ?>
                                   </div>
                                   <div id="choices">
                                   <?php if($question->template_id == 3 || $question->template_id == 4 || $question->template_id == 15): ?>
                                     <?php foreach($question->questions as $option): ?>
                                       <?= $option->survey_template_choice; ?>
                                     <?php endforeach; ?>
                                   <?php else: ?>

                                    <!-- <?= $question->questions[0]->survey_template_choice ?> -->
                                   <?php endif; ?>
                                  </div>
                                   <div class="d-flex justify-content-end">
                                     <?php if($question->template_id == 3 || $question->template_id == 4 ||$question->template_id == 15): ?>
                                       <button id="add-question-choice" data-id="<?= $question->id ?>" data-template-id="<?= $question->template_id ?>" class="btn btn-success btn-sm" type="button" name="button">Add Choice</button>
                                     <?php endif; ?>
                                     <!-- <button class="btn btn-success ml-2 btn-sm" type="submit" name="button">Save Changes</button> -->
                                   </div>
                                  <?= form_close(); ?>

                                  <!-- More options Drawer -->
                                  <div class="btn-group justify-content-right">
                                    <a class="dropdown-item btn " type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent<?= $question->id ?>" aria-controls="navbarToggleExternalContent<?= $question->id ?>" aria-expanded="false" aria-label="Toggle navigation"><span class="text-info">More Options</span></a>
                                    <a class="dropdown-item btn" type="button" href="<?php echo base_url()?>survey/<?= $survey->id?>" id="btn-question-delete"  data-id="<?= $question->id ?>"><span class="text-danger">Delete</span></a>
                                  </div>

                                  <div class="collapse" id="navbarToggleExternalContent<?= $question->id ?>">
                                    <div class="d-flex bg-white py-2 align-items-center">
                                      <div class="custom-control custom-checkbox mr-3">
                                        <input <?= ($question->required == 1) ? "checked" : ""; ?> type="checkbox" class="custom-control-input" value="required" data-id="<?= $question->id ?>" id="required<?= $question->id ?>">
                                        <label class="custom-control-label" for="required<?= $question->id ?>">Required</label>
                                      </div>
                                      <div class="custom-control custom-checkbox">
                                        <input <?= ($question->description == 1) ? "checked" : ""; ?> type="checkbox" class="custom-control-input" value="description" data-id="<?= $question->id ?>" id="description<?= $question->id ?>">
                                        <label class="custom-control-label" for="description<?= $question->id ?>">Description</label>
                                      </div>


                                      <div class="input-group w-25 ml-2">
                                        <div class="custom-file">
                                          <input name="image_background" type="file" class="custom-file-input" data-id="<?= $question->id ?>" id="image_background<?= $question->id ?>"  value="<?= ($question->image_background) ? $question->image_background : "";  ?>">
                                          <label class="custom-file-label" for="image_background<?= $question->id ?>"><?= ($question->image_background) ? $question->image_background : "";  ?></label>
                                        </div>
                                      </div>
                                      <div class="option-position">
                                      <label for="image">Choose a Image Postion:</label>

                                      <select name="image_position" class="form-control">
                                        <option value="1">Background</option>
                                        <option value="2">Top</option>
                                        <option value="3">Right</option>
                                        <option value="4">Bottom</option>
                                      </select>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- End of More Options Drawer -->
                                  
                                  <div class="dropdown btn-add-question-bottom">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="btn-add-question-bottom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    +
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btn-add-question-bottom">
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/9" class="dropdown-item" id="add-question-bottom">Welcome Screen</a>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/1" class="dropdown-item" id="add-question-bottom">Short Text</a>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/2" class="dropdown-item" id="add-question-bottom">Long Text</a>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/3" class="dropdown-item" id="add-question-bottom">Single Choice Answer</a>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/4" class="dropdown-item" id="add-question-bottom">Multiple Choice Answer</a>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/5" class="dropdown-item" id="add-question-bottom">Email Type</a>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/6" class="dropdown-item" id="add-question-bottom">Number Type</a>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/7" class="dropdown-item" id="add-question-bottom">Image Type</a>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/8" class="dropdown-item" id="add-question-bottom">Phone Number Type</a>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                      <?php endforeach; ?>

                     </div>
                  </div>
               </div>
            </div>
            <!-- end card -->

         </div>

      </div>
      <!-- end row -->

   </div>

<?php include viewPath('includes/footer'); ?>
   <script type="text/javascript" src="http://localhost/nsmartrac/assets/js/survey.js"></script>
