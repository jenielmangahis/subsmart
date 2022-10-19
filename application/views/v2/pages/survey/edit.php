<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" type="text/css">
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
  .choice-container .input-group{
    width: 94% !important;
  }
  #builder-box .alert-dark{
    background-color : none !important;
  }
  .nav-pills .nav-item{
    margin: 2px;
    width: 193px;
    text-align: center;
  }
  .nav-pills .nav-item a.nav-link{
    background-color: #32243d;
    color: #ffffff;   
  }
  .nav-pills .nav-link{
    width: 100%;
    background-color: #6a4a86;
    color: #ffffff !important;
  }
  .nav-pills .nav-item a{
    color: #ffffff;    
  }
  .nav-pills .nav-link.active{
    background-color: #342442 !important;
    color: #ffffff;
  }
  .settings-label{
    width: 16%;
  }
  .form-check{
    margin-left: 3px;
  }
  .list-group-item{
    border: none !important;
  }
  #add-question-choice{
    margin-bottom: 10px;
  }
  .nav-pills .nav-item {  
    width: 225px;    
  }
  .chk-choice{
    height: 29px;
  }
  .choice-container .form-control{
    height: 42px;
  }
  .description-container{
    margin-top: 10px !important;
  }
  .question-toggle{
    margin-top: 10px;
  }
  #choices .input-group-text{
    height: 42px;
  }
</style>
<div class="row page-content g-0">
  <div class="col-12 mb-3">
      <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
  </div>
  <div class="col-12">
    <div class="nsm-page">
      <div class="nsm-page-content">
        <div class="row">
            <div class="col-12">
                <div class="nsm-callout primary">
                    <button><i class='bx bx-x'></i></button>
                    <div>
                      Edit Survey <br/><br/>
                      <b style="font-weight: bold; font-size:20px;">Survey : <?= $survey->title ?></b><br />
                      <?php if($survey_theme){ ?>
                            Current theme: <span class="font-weight-bold"><?= $survey_theme->sth_theme_name?></span><br/>
                      <?php }else{ ?>
                          No theme selected <a href="#" data-toggle="modal" data-target="#selectThemeModal">Add theme</a><br/>
                      <?php } ?>
                      <?php if($survey->canRedirectOnComplete == 1){ ?>
                          <span id="redirection-link-text">
                            Redirection Link: <a href=" <?=$survey->redirectionLink?>"> <?=$survey->redirectionLink?></a>
                          </span>
                      <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="autoSaveAlert" class="alert alert-dark" style="display: none">
          <i class="fa fa-info-circle"></i>
          Every changes you make are <b>automatically saved</b>, so there's no need to look for a save button for now.
        </div>

        <!-- menu bar -->
        <div class="py-2">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#builder-box" type="button" role="tab" aria-controls="builder-box" aria-selected="true"><i class='bx bx-wrench' ></i> Builder</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link tab-logic" id="pills-profile-tab" data-id="<?= $survey->id; ?>" data-bs-toggle="pill" data-bs-target="#logic-box" type="button" role="tab" aria-controls="logic-box" aria-selected="false"><i class='bx bx-link' ></i> Logic Jump</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#themes-box" type="button" role="tab" aria-controls="themes-box" aria-selected="false"><i class='bx bxs-paint-roll' ></i> Themes</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#settings-box" type="button" role="tab" aria-controls="settings-box" aria-selected="false"><i class='bx bx-cog' ></i> Settings</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#ra-box" type="button" role="tab" aria-controls="ra-box" aria-selected="false"><i class='bx bx-lock-alt' ></i> Respondent Access</button>
            </li> -->
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
                            <div class="btn-group">
                              <div class="btn-group dropstart" role="group">
                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                  <span class="visually-hidden">Add New Question</span>
                                </button>
                                <ul class="dropdown-menu">
                                  <?php foreach ($qTemplate as $template){?>
                                    <li>
                                      <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(3) ?>/<?= $template->id ?>" class="dropdown-item btn-add-question" id="add-question"> <i class="<?= $template->icon ?>" style="background-color: <?= $template->color; ?>"></i> <?= $template->type ?></a>
                                    </li>
                                  <?php }; ?>
                                </ul>
                              </div>
                              <button type="button" class="btn btn-secondary">
                                Add New Question
                              </button>
                            </div>
                          </div>
                          
                          <!-- <button class="btn btn-sm btn-dark"><i class="fa fa-th"></i></button> -->
                        </div>
                        <hr/>
                        <?php if(count($questions) === 0){ ?>
                          <div class="alert alert-dark" id="card-order-list">
                            There are no questions listed for now.
                          </div>
                        <?php }else{ ?>
                          <div class="row" id="card-order-list"></div>
                        <?php } ?>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-6 px-3">
                        <iframe src="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview&src=results" frameborder="0" style="width: 100%; height: 400px;"></iframe>                        
                        <div class="col-md-12 text-center">
                          <a href="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview" class="nsm-button primary text-center" target="_blank" style="width: 45%;display: inline-block;"> Preview on another page
                          </a>
                          <a href="<?= base_url()?>survey" class="nsm-button" style="width: 45%;display: inline-block">Back to survey list</a>
                        </div>
                      </div>                      
                    </div>                    
                </div>

                <!-- logic tab -->
                <div class="tab-pane fade" id="logic-box"></div>

                <!-- themes tab -->
                <div class="tab-pane fade" id="themes-box">
                  <h2>Themes</h2>
                  <p>Click one to select a theme</p>
                  <div class="row">
                    <?php foreach($themes as $key => $theme){?>
                      <div data-id="<?php $theme->sth_rec_no?>" class="col-xs-12 col-sm-4 mb-4">
                        <a href="<?= base_url()?>survey/themes/select/<?= $survey->id?>/<?= $theme->sth_rec_no ?>">
                          <div class="card theme-card">
                              <?php 
                                if( $theme->company_id > 0 ){
                                                $image = base_url('./uploads/survey/themes/'.$theme->company_id.'/'.$theme->sth_primary_image);
                                                $path  = './uploads/survey/themes/'.$theme->company_id.'/'.$theme->sth_primary_image;
                                              }else{
                                                $image = base_url('./uploads/survey/themes/'.$theme->sth_primary_image);
                                                $path  = './uploads/survey/themes/'.$theme->sth_primary_image;
                                              }

                                              if( !file_exists($path) ){
                                                $image = base_url('./uploads/survey/themes/default_theme_img.jpg'); 
                                              }
                              ?>
                              <img src="<?= $image; ?>" style="<?= $theme->sth_primary_image_class?>" alt="<?= $theme->sth_primary_image?>" class="theme-image">
                              <div class="theme-info">
                                <div class="card-body">
                                  <h4 style="color: <?= $theme->sth_text_color?>">
                                    <?= $theme->sth_theme_name?>
                                    <?php
                                      if($survey_theme != null){
                                        if($theme->sth_rec_no === $survey_theme->sth_rec_no){echo'<i class="bx bx-check-circle"></i>';};
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
                  <form id="survery-settings">
                  <input type="hidden" name="sid" id="settings-sid" value="<?= $survey->id; ?>">
                  <div class="row">
                    <div class="col-md-10">
                    <ul class="list-group">
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">
                            <span class="settings-label">Survey Name</span>
                          </div>
                          <div class="col-5" style="padding-left: 0px;">
                            <input type="text" name="txtSurveyTitle" class="form-control" id="txtSurveyTitle" data-id="<?=$survey->id?>" value="<?= $survey->title?>">
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">
                            <span>Survey Workspace</span>
                          </div>
                          <div class="col-5" style="padding-left: 0px;">
                            <select name="selWorkspace" id="selWorkspace" class="form-control">
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
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">
                            <span>Show Progress</span>
                          </div>
                          <div class="col-5" style="padding-left: 0px;">
                            <div class="form-check">
                              <input  <?= ($survey->hasProgressBar == 1) ? "checked" : ""; ?> name="show_progress" type="checkbox" class="form-check-input" value="hasProgressBar" data-id="<?= $survey->id ?>" id="hasProgressBar<?= $survey->id ?>">
                            </div>
                          </div>
                        </div>                        
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">
                            <span>Redirect on complete</span> 
                          </div>
                          <div class="col-5" style="padding-left: 0px;">
                            <div class="form-check">
                              <input <?= ($survey->canRedirectOnComplete == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input chk-redirect-oncomplete" data-id="<?= $survey->id; ?>" name="can_redirect_oncomplete" value="canRedirectOnComplete" data-id="<?= $survey->id ?>" id="canRedirectOnComplete<?= $survey->id ?>">
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item" style="display: none;">                       
                        <div class="d-flex w-100 justify-content-between">
                          <span class="settings-label">Use Background Image <em class="text-muted"><small>NOTE: This works when a custom image is uploaded and existing</small></em></span>
                          <div class="form-check">
                            <input <?= ($survey->useBackgroundImage == 1) ? "checked" : ""; ?> type="checkbox" class="form-check-input" value="useBackgroundImage" data-id="<?= $survey->id ?>" id="useBackgroundImage<?= $survey->id ?>">
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item" style="display:none;">
                        <div class="d-flex w-100 justify-content-between">
                          <span class="settings-label">Background Image: <strong id="customImageBackgroundName"><?= ($survey->backgroundImage === "") ? "none" : $survey->backgroundImage?></strong></span>
                          <?= form_open('survey/upload/custombackgroundimage/'.$survey->id, array('id' => 'form-upload-custom-image-background'))?>
                            <input type="file" value="useCustomBackgroundImage" name="useCustomBackgroundImage" data-id="<?= $survey->id ?>" id="useCustomBackgroundImage<?= $survey->id ?>">
                          <?= form_close();?>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">
                            <span>Redirection Link</span>
                          </div>
                          <div class="col-5" style="padding-left:0px;">
                            <input type="text" <?= ($survey->canRedirectOnComplete == 0) ? "disabled" : "" ?> name="txtRedirectionLink" class="form-control" id="txtRedirectionLink" data-id="<?=$survey->id?>" value="<?= $survey->redirectionLink?>" placeholder="https://..">
                          </div>
                        </div>
                      </li>
                      
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">
                            <span>Count Scores</span>
                          </div>
                          <div class="col-5" style="padding-left:0px;">
                            <div class="form-check">
                              <input <?= ($survey->isScoreMonitored == 1) ? "checked" : ""; ?> type="checkbox" name="isScoreMonitored" id="isScoreMonitored<?=$survey->id?>" class="form-check-input" value="isScoreMonitored"  data-id="<?=$survey->id?>" value="<?= $survey->isScoreMonitored?>">
                            </div>
                            <button class="nsm-button primary btn-survey-update-settings" type="button" style="margin-top:39px;width: 100%;">Save Changes</button>
                          </div>
                        </div>                      
                      </li>
                    </ul>
                    </div>
                  </div>                  
                  </form>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

  $(function(){
     questions_list('<?= $survey->id; ?>');
     function questions_list(survey_id){
      var url =  surveyBaseUrl + 'survey/_load_survey_questions';
      $.ajax({
        url: url,
        data: {survey_id:survey_id},
        type: 'POST',
        success: function(res){
          $('#card-order-list').html(res);
        }
      });
    }

    dragula([document.getElementById('card-order-list')])
      .on('drag', function (el, target,source,sibling) {
      }).on('drop', function (el, target,source,sibling) {
        saveQuestionOrder();
    });

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
  }); 
  
  $(document).on('click', '.tab-logic', function(e){
    var survey_id = $(this).attr('data-id');
    var url =  surveyBaseUrl + 'survey/_load_survey_logic_jump';    
    $("#logic-box").html('<span class="spinner-border spinner-border-sm m-0"></span>');

      $.ajax({
        url: url,
        data: {survey_id:survey_id},
        type: 'POST',
        success: function(res){
          $('#logic-box').html(res);
        }
      });
  });

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
  //    direction: 'vertical'
  // });

</script>