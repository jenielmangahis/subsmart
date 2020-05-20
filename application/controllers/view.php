<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
  textarea.form-control{
    height: auto !important;
  }
  #btn-question-delete{
      border-radius: 50% !important;
      width: 45px;
      height: 45px;
      justify-content: center;
      padding: 0;
      display: flex;
      align-items: center;
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
</style>
<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/marketing'); ?>
   <!-- page wrapper start -->
   <div wrapper__section>
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
                             <a href="<?= base_url() ?>survey/preview/<?= $this->uri->segment(2) ?>" target="_blank" class="btn btn-primary btn-md text-light" type="button" name="button">Preview</a>
                              <button class="btn btn-primary btn-md text-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Add New Question
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/9" class="dropdown-item" id="add-question">Welcome Screen</a>
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/1" class="dropdown-item" id="add-question">Short Text</a>
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/2" class="dropdown-item" id="add-question">Long Text</a>
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/3" class="dropdown-item" id="add-question">Single Choice Answer</a>
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/4" class="dropdown-item" id="add-question">Multiple Choice Answer</a>
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/5" class="dropdown-item" id="add-question">Email Type</a>
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/6" class="dropdown-item" id="add-question">Number Type</a>
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/7" class="dropdown-item" id="add-question">Image Type</a>
                                <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/8" class="dropdown-item" id="add-question">Phone Number Type</a>
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
                                    <h5 class="card-title">
                                      <?= $question->template_title ?>
                                    </h5>
                                    <button id="btn-question-delete" data-id="<?= $question->id ?>" class="btn" type="button" name="button"><i class="fa fa-times-circle fa-2x"></i></button>
                                  </div>
                                  <input type="hidden" name="survey_id" value="<?= $question->id ?>">
                                  <div class="form-group">
                                     <!-- <label>Question</label> -->
                                     <input type="text" class="form-control" name="question" value="<?= $question->question ?>" placeholder="Enter your question">
                                   </div>
                                   <div id="choices">
                                   <?php if($question->template_id == 3 || $question->template_id == 4): ?>
                                     <?php foreach($question->questions as $option): ?>
                                       <?= $option->survey_template_choice; ?>
                                     <?php endforeach; ?>
                                   <?php else: ?>

                                    <?= $question->questions[0]->survey_template_choice ?>
                                   <?php endif; ?>
                                  </div>
                                   <div class="d-flex justify-content-end">
                                     <?php if($question->template_id == 3 || $question->template_id == 4): ?>
                                       <button id="add-question-choice" data-id="<?= $question->id ?>" data-template-id="<?= $question->template_id ?>" class="btn btn-success btn-sm" type="button" name="button">Add Choice</button>
                                     <?php endif; ?>
                                     <button class="btn btn-success ml-2 btn-sm" type="submit" name="button">Save Changes</button>
                                   </div>
                                  <?= form_close(); ?>
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
   <!-- end container-fluid -->
</div>
<?php include viewPath('includes/footer'); ?>
