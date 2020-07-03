<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<style>
  #survey-card {
    transition:0.3s;
    border-radius:10px;
    background-size: cover;
  }
  #survey-card:hover {
    transform: none;
    box-shadow: 0 0 11px rgba(33,33,33,.2);
    cursor: pointer;
  }

  .survey-title{
    padding: 0 10px;
  }

  img.theme-image{
    position: absolute;
    z-index: 0;
    width: 100%;
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
                  <div class="container-fluid" style="font-size:14px;">
                     <div class="row">
                        <div class="col-xs-12 col text-left">
                           <h1 class="m-0 text-left">Survey List</h1>
                           <p class="m-0">Here are the list of surveys created. You can also create a new set of questions here.  </p>
                        </div>
                        <div class="col-xs-12 col-auto">
                           <div class="h1-spacer">
                              <a class="btn btn-primary btn-md text-light" href="<?php echo base_url()?>survey/themes">
                                <span class="fa fa-th text-light"></span> Themes
                              </a>
                              <a class="btn btn-primary btn-md text-light" href="<?php echo base_url()?>survey/themes">
                                <span class="fa fa-cubes text-light"></span> Templates
                              </a>
                              <a class="btn btn-success btn-md text-light" href="<?php echo base_url()?>survey/add">
                                <span class="fa fa-plus text-light"></span> New Survey
                              </a>
                              <!-- <a class="btn btn-success btn-md text-light" data-toggle="modal" data-target="#exampleModal">
                              <span class="fa fa-plus text-light"></span> New Survey
                              </a> -->
                           </div>
                        </div>
                     </div>
                     
                     <div class="tabs">
                        <ul class="clearfix work__order" id="myTab" role="tablist">
                        </ul>
                     </div>
                     <div id="survey-content" class="row">
                       <?php if($surveys){ ?>
                       <?php foreach ($surveys as $key => $survey): ?>
                         <div class="col-xs-12 col-sm-6 col-md-3">

                        <!-- Card content for each survey -->
                        <div id="survey-card" data-id="<?= $survey->id ?>" class="card border-0 shadow" style="<?=($survey->survey_theme != null)? "background-image: url('".base_url()."uploads/survey/themes/".$survey->survey_theme->sth_primary_image."')  " : ""?>">
                          <a class="text-left" href="survey/result/<?= $survey->id ?>">
                            <div class="card-body">
                              <h5 class="card-title survey-title font-weight-bold" style="color: <?= ($survey->survey_theme != null)?$survey->survey_theme->sth_text_color:"black"?>; border-left: 5px solid <?= ($survey->survey_theme != null) ? $survey->survey_theme->sth_primary_color : "#ffffff"?>;"><?= $survey->title ?></h5>
                              <small style="color: <?= $survey->survey_theme !== null ? $survey->survey_theme->sth_text_color: ""?>"><?= count($this->survey_model->getQuestions($survey->id))?> Questions</small><br/>
                              <small style="color: <?= $survey->survey_theme !== null ? $survey->survey_theme->sth_text_color: ""?>"><?= $survey->count ?><?=($survey->hasResponseLimit == true && $survey->responseLimit > 0) ?"/".$survey->responseLimit : ""?> Response(s)</small><br/>
                              <small class="text-info" style="color: <?= $survey->survey_theme !== null ? $survey->survey_theme->sth_secondary_color : ""?>">Click for more info</small>
                            </div>
                          </a>
                          <div class="d-flex w-100 justify-content-center">
                            <a href="survey/preview/<?= $survey->id ?>">
                              <button class="btn btn-primary btn-sm" type="button" aria-haspopup="true" aria-expanded="false" style="background-color: <?= $survey->survey_theme !== null ? $survey->survey_theme->sth_primary_color : ""?>; color: <?= $survey->survey_theme !== null ? $survey->survey_theme->sth_text_color : ""?>">
                              <!-- @L@ -->
                                <!-- <i class="fas fa-ellipsis-v"></i> -->
                                <span class="material-icons">assessment</span> Preview
                              </button>
                            </a>
                            <button class="btn btn-outline-info btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <!-- @L@ -->
                              <!-- <i class="fas fa-ellipsis-v"></i> -->
                              <span class="material-icons">menu</span> Options
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" data-id="<?= $survey->id; ?>" href="survey/edit/<?= $survey->id ?>"><span class="material-icons">edit</span> Edit Survey</a>
                              <a id="btn-share-survey" data-id="<?= $survey->id; ?>"  class="dropdown-item" href="survey/share/<?= $survey->id ?>"><span class="material-icons">share</span> Share</a>
                              <a id="btn-delete-survey" data-id="<?= $survey->id; ?>" class="dropdown-item" href="survey/delete/<?= $survey->id ?>"><span class="material-icons">delete</span> Delete</a>
                              <!-- @L@ -->
                              <!-- <a id="btn-result-survey" data-id="<?= $survey->id; ?>" class="dropdown-item" href="survey/result/<?= $survey->id ?>">Results</a> -->
                              <!-- @L@ -->
                              <!-- <a id="btn-preview-survey" data-id="<?= $survey->id; ?>" class="dropdown-item" href="survey/preview/<?= $survey->id ?>"><span class="material-icons">assessment</span> Answer this survey</a> -->
                            </div>
                          
                          </div>
                          <!-- <ul class="list-group">
                            <li class="list-group-item p-0 pt-2 d-flex justify-content-between align-items-center flex-row">
                              
                              <div class="text-right">
                                <div class="btn-group">
                                </div>
                              </div>
                            </li>
                          </ul> -->
                        </div>

                        </div>
                      <?php endforeach; ?>
                    <?php }else{ ?>
                      <li class="list-group-item text-center"> No list for Survey</li>
                    <?php } ?>
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
</div>
<!-- page wrapper end -->

<!-- add new survey modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <?= form_open('survey/add', array('id'=>'frm-add-survey')) ?>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Survey</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="title">What would you like to name your survey?</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button disabled id="btnSubmitTitle" type="submit" class="btn btn-primary">Add New Survey</button>
      </div>
    </div>
    <?= form_close() ?>
  </div>
</div>

  <script>
    document.querySelector('#title').addEventListener('keyup', event => {
      if(event.target.value === ''){
        document.querySelector('#btnSubmitTitle').disabled = true;
      }else{ 
        document.querySelector('#btnSubmitTitle').disabled = false;
      }
    })
  </script>

<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>

