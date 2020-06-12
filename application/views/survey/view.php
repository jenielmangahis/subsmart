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
                        <a href="<?= base_url()?>survey">Back to survey list</a>
                     <div class="row">
                        <div class="col">
                          <h1 class="m-0"><?= $survey->title ?></h1>
                          <?php
                            if($survey_theme !== null){
                              ?>
                                <p>Current theme: <span class="font-weight-bold"><?= $survey_theme->sth_theme_name?></span> <a href="#" data-toggle="modal" data-target="#selectThemeModal">Change theme</a></p>
                              <?php
                            }else{
                              ?>
                                <p>No themes selected <a href="#" data-toggle="modal" data-target="#selectThemeModal">Add theme</a></p>
                              <?php
                            }
                          ?>

                          <!-- select theme modal -->
                          <div class="modal fade" id="selectThemeModal">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h2 class="modal-title">Select Theme</h2>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <!-- <p>Click on any of the themes to select your new theme</p> -->
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <?php foreach($themes as $key => $theme){?>
                                      <div data-id="<?php $theme->sth_rec_no?>" class="col-xs-12 col-sm-6">
                                        <a href="<?= base_url()?>survey/themes/select/<?= $survey->id?>/<?= $theme->sth_rec_no ?>">
                                          <div class="card theme-card">
                                              <img src="<?= base_url()?>uploads/survey/themes/<?= $theme->sth_primary_image?>" style="<?= $theme->sth_primary_image_class?>" alt="<?= $theme->sth_primary_image?>" class="theme-image">
                                              <div class="theme-info">
                                                <div class="card-body">
                                                  <h4 style="color: <?= $theme->sth_text_color?>"><?= $theme->sth_theme_name?></h4>
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
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                           <div class="h1-spacer">
                           <?php if(count($questions) !== 0){
                             ?>
                              <a href="<?= base_url() ?>survey/preview/<?= $this->uri->segment(2) ?>?mode=preview" target="_blank" class="btn btn-info btn-md text-light" type="button" name="button">Preview</a>
                             <?php
                           } ?>
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
                    
                      <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i>
                        Every changes you make are automatically saved, so there's no need to look for a save button for now. 
                      </div>

                      <?php
                        if(count($questions) === 0){
                          ?>
                            <div class="alert alert-dark">
                              There are no questions listed for now. 
                            </div>
                          <?php
                        }else{
                          foreach($questions as $key =>  $question){ ?>
                            <div class="row" id="card-list">
                              <!-- main container -->
                              <div id="container-<?= $question->id ?>" class="col-sm-12">
                                <div class="card">
                                  <div class="card-body p-0">
                                  
                                    <!-- main question -->
                                    <?= form_open("survey/update/question/".$question->id."", array('id'=>'frm-update-question')); ?>

                                      <div class="d-flex justify-content-between">
                                        <!-- title -->
                                        <h5 class="card-title d-flex">
                                          <i class="icon-design <?= $question->template_icon ?>" style="background-color:<?= $question->template_color ?>;"></i> <?= $question->template_title ?>
                                          <?php if($question->required == 1): ?>
                                            <label class="text-danger" id="required-asterisk-<?= $question->id ?>">*</label>
                                          <?php endif; ?>
                                        </h5>
                                      </div>

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
                                            echo $option->survey_template_choice;
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

                                      </div>
                                    </div>
                                    <!-- End of More Options Drawer -->
                                      
                                    <div class="dropdown btn-add-question-bottom">
                                      <button class="btn btn-light dropdown-toggle" type="button" id="btn-add-question-bottom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-plus"></i>
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
                              <!-- end of container -->
                            </div>
                          <?php };
                        }?>

                  </div>
               </div>
            </div>
            <!-- end card -->

         </div>

      </div>
      <!-- end row -->

   </div>

<?php include viewPath('includes/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/js/survey.js"></script>
