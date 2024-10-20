<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header');
?>
<style>
  .icon-design{
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
  
  
  div.theme-card{
      padding: 0;
      border: 0;
  }

  div.theme-card:hover, div.survey-card:hover{
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

  .template-card{
    padding: 0;
    word-wrap: break-word;
    cursor: pointer;
    border-radius: 10px;
    margin: 10px;
    border: none;
    box-shadow: 5px 5px 10px #ddd;
    transition-duration: 300ms;
  }
  
  .template-card:hover{
    
    border-radius: 10px;
    margin: 10px;
    border: none;
    box-shadow: 5px 5px 10px #777;
    transform: scale(1.05)
  }

  .template-card-content{
    z-index: 9;
    padding: 10px;
  }

  img.template-image{
    z-index: 0;
    width: 100%;
    position: absolute;
    object-fit: cover;
    max-height: 100%;
  }
  

  .survey-card {
    padding: 0px;
    transition:0.3s;
    border-radius:10px;
    background-size: cover;
  }
  .survey-card:hover {
    transform: none;
    box-shadow: 0 0 11px rgba(33,33,33,.2);
    cursor: pointer;
  }

  .survey-title{
    padding: 0 10px;
  }
  img.survey-card-image{
    width: 100%; 
    max-height: 150px; 
    object-fit: cover;
  }
  .selected-workspace, .selected-theme, #selected-survey-name{
    font-size: 17px;
    font-weight: bold;
  }
  .custom-spinner{
    position: relative;
    top: -3px;
  }

  #modalSelectTemplate {
      z-index: 2000;
  }

  #modalViewTemplate {
      z-index: 3000;
  }
</style>
<div class="wrapper" role="wrapper">
  <?php include viewPath('includes/sidebars/marketing'); ?>
  <div wrapper__section>
    
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-6 left">
            <h3 class="page-title">Create new survey</h3>
          </div>
          <div class="col-sm-6 right dashboard-container-1">
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                        <a href="<?php echo url('survey') ?>" class="btn btn-primary" aria-expanded="false">
                            <i class="mdi mdi-settings mr-2"></i> Go Back to list
                        </a>
                </div>
            </div>
          </div>
          <div class="alert alert-warning mt-1 mb-0" role="alert" style="width: 100%;">
              <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">By creating this survey, you can either use a pre-made template or make your own.
              </span>
          </div>
        </div>
        <!-- <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>survey">Surveys</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>survey/workspace">Workspace</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Survey</li>
          </ol>
        </nav> -->
        <div class="container" style="margin-top: 30px;">
          <div class="row">
            <div class="col-3">
              <a class="" data-toggle="modal" data-target="#modalSelectWorkspace" href="javascript:void(0);">
              <div class="card text-center" style="height: 100%; background-color: #32243D; color:#ffffff;">
                <h1 id="status-workspace-icon" class="text-danger">
                  <i class="fa fa-table"></i>
                </h1>
                <h5 id="status-workspace-text" class="text-danger"> <i class="fa fa-check-circle"></i> Workspace</h5>
                <span id="status-workspace-content"></span>
              </div>
              </a>
            </div>
            <div class="col-3">
              <a class="" data-toggle="modal" data-target="#modalSetSurveyName" href="javascript:void(0);">
              <div class="card text-center" style="height: 100%; background-color: #32243D; color:#ffffff;">                
                  <h1 id="status-survey-name-icon" class="text-danger">
                    <i class="fa fa-font"></i>
                  </h1>                
                  <h5 id="status-survey-name-text" class="text-danger"> <i class="fa fa-check-circle"></i> Set Survey Name </h5>                
                  <span id="selected-survey-name"></span>
                  <input type="hidden" name="txtSurveyName" id="txtSurveyName">
              </div>
              </a>
            </div>
            <div class="col-3">
              <a class="" data-toggle="modal" data-target="#modalSelectTheme" href="javascript:void(0);">
              <div class="card text-center" style="height: 100%; background-color: #32243D; color:#ffffff;">
                <h1 id="status-theme-icon" class="text-danger">
                  <i class="fa fa-paint-brush"></i>
                </h1>
                <h5 id="status-theme-text" class="text-danger"> <i class="fa fa-check-circle"></i> Select Theme</h5>
                <span id="status-theme-content"></span>
                <span>(Optional)</span>
              </div>
              </a>
            </div>
            <div class="col-3">
              <a class="" data-toggle="modal" data-target="#modalSelectTemplate" href="javascript:void(0);">
              <div class="card text-center" style="height: 100%; background-color: #32243D; color:#ffffff;">
                <h1 id="status-template-icon" class="text-danger">
                  <i class="fa fa-th-list"></i>
                </h1>
                <h5 id="status-template-text" class="text-danger"> <i class="fa fa-check-circle"></i> Template</h5>
                <span id="status-template-content"></span>
                <span>(Optional)</span>
              </div>
              </a>
            </div>
          </div>
          <div class="text-center" style="margin-top: 20px;">
            <button type="button" id="btnSubmitSurvey" style="width:100%;" onclick="submitSurvey(event)" class="btn btn-primary my-3 text-center px-5"><strong><i class="fa fa-plus-square-o"></i> Create Survey</strong></button>            
          </div>
        </div>
        <!-- <div class="form-group">
          <label for="txtSurveyName">Survey Name<span class="text-danger">*</span></label>
          <input type="text" name="txtSurveyName" id="txtSurveyName" value="template choice test" class="form-control" placeholder="(e.g. Alexa's 18th Birthday review, etc.)">
        </div> -->
        <div class="row container">
          
          <!-- <div id="theme-text-card" class="col-xs-12 col-sm-6 card">
            <img class="theme-image" id="imgSelectedTheme" style="display: none;" src="" alt="">
            <span class="h3" id="theme-text">No theme selected</span>
            <button class="btn btn-dark" data-toggle="modal" data-target="#modalSelectTheme">Select Theme</button>
          </div> -->
          
          

          <div id="workspace-text-card" class="col-xs-12 col-sm-6 card" style="display: none">
            <span class="h3" id="workspace-text">No workspace selected</span>
            <button class="btn btn-link btn-block btn-info text-white" data-toggle="modal" data-target="#modalSelectWorkspace">Change workspace</button>
          </div>
        </div>

      </div>

      <div id="modalViewTemplate" class="modal fade" >
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header d-flex w-100 justify-content-between">
              <h4>Template</h4>
            </div>
            <div class="modal-body">
              <div id="modalLoadingSpinner">
                  <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </div>
              </div>
              <div id="modalViewTemplateContent">
                
                  <small>Questions Listed:</small>
                  <div id="template-questions-list"></div>

              </div>
            </div>
            <div class="modal-footer">
              <button onclick="selectTemplate()" class="btn btn-sm btn-primary" data-dismiss="modal">Select Template</button>
              <button class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade bd-example-modal-md" id="modalSetSurveyName" tabindex="-1" role="dialog" aria-labelledby="modalSetSurveyNameTitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle" style="font-size:18px;"><i class="fa fa-font"></i> Set Survey Name</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="text" class="form-control" id="survery-name" value="" placeholder="(e.g. Alexa's 18th Birthday review, etc.)" />
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary btn-set-survey-name" type="button">Save</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade bd-example-modal-md" id="modalSelectTemplate" tabindex="-1" role="dialog" aria-labelledby="modalSelectTemplateTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle" style="font-size:18px;"><i class="fa fa-th-list"></i> Select Template</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="custom-control custom-switch" style="display:none;">
              <input type="checkbox" class="custom-control-input" id="templateToggleSwitch" onchange="toggleTemplate()">
              <label class="custom-control-label" for="templateToggleSwitch">Toggle this switch element</label>
            </div>
            <div class="modal-body">                
              <div class="custom-control custom-switch" style="display:none;">
                <input type="checkbox" class="custom-control-input" id="templateToggleSwitch" onchange="toggleTemplate()">
                <label class="custom-control-label" for="templateToggleSwitch">Toggle this switch element</label>
              </div>  

              <div id="templateSection" style="display: block">
                <p id="selected-template-text">Select Template:</p>

                <div class="accordion" id="accordionExample">
                  <?php
                    foreach($template_categories as $key => $category){
                      ?>

                        <div class="card m-0 p-0">
                          <div class="card-header d-flex justify-content-between" id="headingOne" data-toggle="collapse" data-target="#collapse-<?=$key?>" aria-expanded="true" aria-controls="collapse-<?=$key?>" style="background-color: #32243D; color:#ffffff;margin-bottom: 3px;">
                              <span>
                                <?=$category?> 
                              </span>
                            <i class="fa fa-caret-down"></i>
                          </div>

                          <div id="collapse-<?=$key?>" class="collapse" data-parent="#accordionExample">
                            <div class="card-body">
                              
                              <div class="row">
                                <?php
                                  foreach($survey_templates as $template){
                                    if($template->category === $category){
                                      $theme = null;
                                      if($template->theme_id !== null){
                                        foreach($survey_themes as $key => $survey_theme){
                                          if($template->theme_id == $survey_theme->sth_rec_no){
                                            $theme = $survey_theme;
                                            break;
                                          }
                                        }
                                      }
                                      ?>
                                        <div class="col-4" onclick="viewTemplate(<?=$template->id?>)" data-toggle="modal" data-target="#modalViewTemplate">
                                          <div class="card survey-card border-0 shadow" >
                                            <!-- <a class="text-left" href="<?=base_url()?>survey/result/<?= $survey->id ?>"> -->
                                              <div class="card-body p-0">
                                                <?php
                                                  if(empty($template->background_image)){
                                                    ?>
                                                      <img class="survey-card-image" src="<?=base_url()?>uploads/survey/themes/<?=$theme->sth_primary_image?>" alt="<?=$theme->sth_primary_image?>">
                                                    <?php
                                                  }else{
                                                    ?>
                                                      <img class="survey-card-image" src="<?=base_url()?>assets/survey/template_images/<?=$template->background_image?>" alt="<?=$template->background_image?>">
                                                    <?php
                                                  }
                                                ?>
                                              </div>
                                              <div class="card-footer">
                                                <h4><?=$template->name?></h4>
                                                <span><?=$category?></span>
                                              </div>
                                            <!-- </a> -->
                                          </div>
                                        </div>
                                        
                                      <?php
                                    }
                                  }
                                ?>
                              </div>
                            </div>
                          </div>
                        </div>        

                      <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade bd-example-modal-md" id="modalSelectWorkspace" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkorderTypeTitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content" style="width:611px;">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 18px;"><i class="fa fa-table"></i> Select a workspace or create a new one.</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div id="modal-body-workspace-selection" class="animate__animated animate__fadeIn ">
              <div class="modal-body p-3">
                <?php foreach($survey_workspaces as $workspace){
                  ?>
                    <div class="card template-card p-3" data-dismiss="modal" onclick="selectWorkspace(<?= $workspace->id?>, '<?=$workspace->name?>')">
                      <h4><?=$workspace->name?></h4>
                      <span><?=count($workspace->surveys)?> survey<?=(count($workspace->surveys) > 1 )?"s":""?> registered to this workspace.</span>
                    </div>
                  <?php
                }?>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary btn-block" onclick="createWorkspaceWindow()">Create new workspace</button>
                <script>
                  createWorkspaceWindow = () => {
                    document.querySelector("#modal-body-workspace-selection").classList.add('animate__fadeOut');
                    document.querySelector("#modal-body-workspace-selection").classList.add('animate__faster');
                    setTimeout(() => {
                      document.querySelector("#modal-body-workspace-selection").style.display=  "none";
                      document.querySelector("#modal-body-workspace-creation").style.display=  "block";
                      document.querySelector("#modal-body-workspace-selection").classList.remove('animate__fadeOut');
                    }, 500);
                  }
                </script>
              </div>
            </div>
            <div id="modal-body-workspace-creation" class="animate__animated animate__fadeIn " style="display: none">
              <div class="modal-body p-3">
                <div class="form-group">
                  <label for="txtWorkspaceName">Create new workspace</label>
                  <input type="text" name="txtWorkspaceName" id="txtWorkspaceName" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary btn-block w-100" onclick="createAndUseWorkspace()">Create and use this workspace</button>
                <button class="btn btn-secondary btn-block w-100" onclick="selectWorkspaceWindow()" style="margin:0px;">Return to selection</button>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="modal fade bd-example-modal-md" id="modalSelectTheme" tabindex="-1" role="dialog" aria-labelledby="modalSelectThemeTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 18px;"><i class="fa fa-paint-brush"></i> Select Theme</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>            
            <div class="modal-body">
                <p>Click on one of the themes to select a theme you want to use. </p>

                <div class="card theme-card">
                  <button class="btn btn-block btn-outline-dark" onclick="selectTheme(null)" data-dismiss="modal">
                    No theme
                  </button>
                </div>
                <div class="row" style="max-height: 500px; overflow-y: scroll;padding: 5px;">
                  <?php 
                    foreach($survey_themes as $key=>$theme){
                      ?>
                        <div data-id="<?php $theme->sth_rec_no?>" class="col-6 " onclick="selectTheme(<?=$key?>)" data-dismiss="modal">
                          <div class="card theme-card" >
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
                                <h4 style="color: <?= $theme->sth_text_color?>"><?= $theme->sth_theme_name?></h4>
                                <div class="color-slots">
                                  <div class="color-slot" style="background-color: <?= $theme->sth_primary_color ?>"></div>
                                  <div class="color-slot" style="background-color: <?= $theme->sth_secondary_color ?>"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- <button class="btn btn-light btn-block" onclick="selectTheme(<?=$key?>)" data-dismiss="modal"><?=$theme->sth_theme_name?></button> -->
                      <?php
                    }
                  ?>
                </div>
          </div>
        </div>
      </div>

      <div id="modalSelectTheme1" class="modal fade" >
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <div>
                <h4>Select Theme</h4>
                <p>Click on one of the themes to select a theme you want to use. </p>
              </div>
            </div>
            <div class="modal-body">
              <div class="card theme-card">
                <button class="btn btn-block btn-outline-dark" onclick="selectTheme(null)" data-dismiss="modal">
                  No theme
                </button>
              </div>
              <div class="row">
                <?php 
                  foreach($survey_themes as $key=>$theme){
                    ?>
                      <div data-id="<?php $theme->sth_rec_no?>" class="col-6 " onclick="selectTheme(<?=$key?>)" data-dismiss="modal">
                        <div class="card theme-card" >
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
                              <h4 style="color: <?= $theme->sth_text_color?>"><?= $theme->sth_theme_name?></h4>
                              <div class="color-slots">
                                <div class="color-slot" style="background-color: <?= $theme->sth_primary_color ?>"></div>
                                <div class="color-slot" style="background-color: <?= $theme->sth_secondary_color ?>"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <button class="btn btn-light btn-block" onclick="selectTheme(<?=$key?>)" data-dismiss="modal"><?=$theme->sth_theme_name?></button> -->
                    <?php
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>

<script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/js/survey.js"></script>
<script>
$(document).on('click', '.btn-set-survey-name', function(){
  var survey_name = $('#survery-name').val();

  $('#selected-survey-name').text(survey_name);
  $('#txtSurveyName').val(survey_name);
  $('#modalSetSurveyName').modal('hide');

  statusSurveyName.classList.remove("text-danger");
  statusSurveyName.classList.add("text-success");
  statusSurveyNameIcon.classList.remove("text-danger");
  statusSurveyNameIcon.classList.add("text-success");

});

$('#modalViewTemplate').on('hidden.bs.modal', function () {
    $('#modalSelectTemplate').modal('hide');
});
</script>

<script>
  const statusWorkspace = document.querySelector('#status-workspace-text');
  const statusWorkspaceIcon = document.querySelector('#status-workspace-icon');
  const statusWorkspaceContent = document.querySelector('#status-workspace-content');
  const statusSurveyName = document.querySelector('#status-survey-name-text');
  const statusSurveyNameIcon = document.querySelector('#status-survey-name-icon');
  const statusSurveyNameContent = document.querySelector('#status-survey-name-content');
  const statusTemplate = document.querySelector('#status-template-text');
  const statusTemplateIcon = document.querySelector('#status-template-icon');
  const statusTemplateContent = document.querySelector('#status-template-content');
  const statusTheme = document.querySelector('#status-theme-text');
  const statusThemeIcon = document.querySelector('#status-theme-icon');
  const statusThemeContent = document.querySelector('#status-theme-content');

  const url = new URL(window.location.href);
  const workspaces = <?=json_encode($survey_workspaces)?> ;
  const templates = <?=json_encode($survey_templates)?>;
  const templateQuestions = <?=json_encode($survey_question_templates)?>;
  const surveyThemes = <?=json_encode($survey_themes)?>;
  let cardIsLoading = false;
  let viewingTemplate = null;
  let selectedTemplate = null;
  let selectedWorkspace = null;
  let selectedWorkspaceId = null;
  let selectedTheme = null;
  let selectedThemeId = null;

  let newWorkspaceId = null;
  
  let searchedParams = url.searchParams;


  selectWorkspaceWindow = () => {
    document.querySelector("#modal-body-workspace-creation").classList.add('animate__fadeOut');
    document.querySelector("#modal-body-workspace-creation").classList.add('animate__faster');
    setTimeout(() => {
      document.querySelector("#modal-body-workspace-creation").style.display=  "none";
      document.querySelector("#modal-body-workspace-selection").style.display=  "block";
      document.querySelector("#modal-body-workspace-creation").classList.remove('animate__fadeOut');
    }, 500);
  }

  createAndUseWorkspace = () => {
    let data = {
      "txtWorkspaceName": document.querySelector("#txtWorkspaceName").value
    }
    $.ajax({
      url: surveyBaseUrl + 'survey/workspace/add',
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function(payload){
        toastr["success"]("Workspace added!");
        $('#modalSelectWorkspace').modal("hide");
        statusWorkspace.classList.remove("text-danger");
        statusWorkspace.classList.add("text-success");
        statusWorkspaceIcon.classList.remove("text-danger");
        statusWorkspaceIcon.classList.add("text-success");
        statusWorkspaceContent.innerHTML = "<strong class='selected-workspace'>" + data.txtWorkspaceName + "</strong>";
        newWorkspaceId = payload.id
      }
    })
  }


  $(document).ready(()=>{
    
    if(!searchedParams.get('ws')){
      $('#modalSelectWorkspace').modal('show');
      document.querySelector('#workspace-text-card').style.display = "none";
    }else{
      selectedWorkspace = workspaces.filter((workspace)=>{
        return workspace.id == searchedParams.get('ws');
      })[0];
      
      statusWorkspace.classList.remove("text-danger");
      statusWorkspace.classList.add("text-success");
      statusWorkspaceIcon.classList.remove("text-danger");
      statusWorkspaceIcon.classList.add("text-success");
      statusWorkspaceContent.innerHTML = "<strong class='selected-workspace'>" + selectedWorkspace.name + "</strong>";
    }

    if(searchedParams.get('th')){
      selectedTemplate = templates.filter((template)=>{
        return template.id == searchedParams.get('th');
      })[0];
      
      statusTemplate.classList.remove("text-danger");
      statusTemplate.classList.add("text-success");
      statusTemplateIcon.classList.remove("text-danger");
      statusTemplateIcon.classList.add("text-success");
      statusTemplateContent.innerHTML = "<strong class='selected-theme'>"+selectedTemplate.name+"</strong>"
      document.querySelector('#templateToggleSwitch').checked = true;
      document.querySelector('#templateSection').style.display = 'block';
      document.querySelector('#selected-template-text').innerHTML = "Selected Template: <strong>"+selectedTemplate.name+"</strong>";

      selectedTheme = surveyThemes.filter(theme=>{
        return theme.sth_rec_no == selectedTemplate.theme_id;
      })[0];
      document.querySelector('#theme-text').innerHTML = "Selected theme: <strong>"+ selectedTheme.sth_theme_name +"</strong>";
      document.querySelector('#imgSelectedTheme').src = `<?=base_url()?>uploads/survey/themes/${selectedTheme.sth_primary_image}`;
      document.querySelector('#imgSelectedTheme').alt = selectedTheme.sth_primary_image;
      document.querySelector('#imgSelectedTheme').style.display = "block";
      statusTheme.classList.remove("text-danger");
      statusTheme.classList.add("text-success");
      statusThemeIcon.classList.remove("text-danger");
      statusThemeIcon.classList.add("text-success");
      statusThemeContent.innerHTML = `<strong class='selected-theme'>${selectedTheme.sth_theme_name}</strong>`
    }
  })

  
  document.querySelector('#txtSurveyName').addEventListener('change', (e)=>{
    if(e.target.value === ''){
      statusSurveyName.classList.remove("text-success");
      statusSurveyName.classList.add("text-danger");
      statusSurveyNameIcon.classList.remove("text-success");
      statusSurveyNameIcon.classList.add("text-danger");
      statusSurveyNameContent.innerHTML = ''
    }else{
      statusSurveyName.classList.remove("text-danger");
      statusSurveyName.classList.add("text-success");
      statusSurveyNameIcon.classList.remove("text-danger");
      statusSurveyNameIcon.classList.add("text-success");
      statusSurveyNameContent.innerHTML = `Name: ${e.target.value}`;
    }
  })

  selectTheme = (id = null) => {
    selectedTheme = surveyThemes[id].sth_rec_no;
    selectedThemeId = id;
    if(selectedTheme === null){
      statusTheme.classList.remove("text-success");
      statusTheme.classList.add("text-danger");
      statusThemeIcon.classList.remove("text-success");
      statusThemeIcon.classList.add("text-danger");
      statusThemeContent.innerHTML = ``
      document.querySelector('#theme-text').innerHTML = "No Theme Selected";
      document.querySelector('#imgSelectedTheme').src = "";
      document.querySelector('#imgSelectedTheme').alt = "";
      document.querySelector('#imgSelectedTheme').style.display = "none";
      
    }else{
      statusTheme.classList.remove("text-danger");
      statusTheme.classList.add("text-success");
      statusThemeIcon.classList.remove("text-danger");
      statusThemeIcon.classList.add("text-success");
      statusThemeContent.innerHTML = `<strong class="selected-theme">${surveyThemes[id].sth_theme_name}</strong>`
      document.querySelector('#theme-text').innerHTML = "Selected theme: <strong>"+ surveyThemes[id].sth_theme_name +"</strong>"
      document.querySelector('#imgSelectedTheme').src = `<?=base_url()?>uploads/survey/themes/${surveyThemes[id].sth_primary_image}`;
      document.querySelector('#imgSelectedTheme').alt = surveyThemes[id].sth_primary_image;
      document.querySelector('#imgSelectedTheme').style.display = "block";
      
    }
    
  }

  selectWorkspace = (id, name) => {
    selectedWorkspace = id;
    statusWorkspace.classList.remove("text-danger");
    statusWorkspace.classList.add("text-success");
    statusWorkspaceIcon.classList.remove("text-danger");
    statusWorkspaceIcon.classList.add("text-success");
    statusWorkspaceContent.innerHTML = "Selected Workspace: <strong>" + name + "</strong>";
    document.querySelector('#workspace-text').innerHTML = "Selected Workspace: <br/><strong>" + name + "</strong>";
  }


  selectTemplate = id => {
    
    statusTemplate.classList.remove("text-danger");
    statusTemplate.classList.add("text-success");
    statusTemplateIcon.classList.remove("text-danger");
    statusTemplateIcon.classList.add("text-success");
    selectedTemplate = viewingTemplate;
    document.querySelector('#selected-template-text').innerHTML = "Selected Template: <strong>"+selectedTemplate.name+"</strong>";
    document.querySelector('#status-template-content').innerHTML = "<strong>"+ selectedTemplate.name +"</strong>";
    
    selectedTheme = surveyThemes.filter(theme=>{
      return theme.sth_rec_no == selectedTemplate.theme_id;
    })[0];
    /*document.querySelector('#theme-text').innerHTML = "Selected theme: <strong>"+ selectedTheme.sth_theme_name +"</strong>";
    document.querySelector('#imgSelectedTheme').src = `<?=base_url()?>uploads/survey/themes/${surveyThemes[id].sth_primary_image}`;
    document.querySelector('#imgSelectedTheme').alt = surveyThemes[id].sth_primary_image;
    document.querySelector('#imgSelectedTheme').style.display = "block";*/
    //document.querySelector('#modalViewTemplate').style.display = "none";
  }

  document.querySelector('#templateToggleSwitch').addEventListener('click',(e)=>{
    if(e.target.checked) document.querySelector('#templateSection').style.display = 'block';
    if(!e.target.checked) {
      selectedTemplate = null
      document.querySelector('#templateSection').style.display = 'none'
      statusTemplate.classList.remove("text-success");
      statusTemplate.classList.add("text-danger");
      statusTemplateIcon.classList.remove("text-success");
      statusTemplateIcon.classList.add("text-danger");
    };
  })

  viewTemplate = tempId => {
    let questionsContainer = document.querySelector('#template-questions-list');
    cardIsLoading = true;
    document.querySelector('#modalLoadingSpinner').style.display = "block";
    document.querySelector('#modalViewTemplateContent').style.display = "none";
    setTimeout(()=>{
      viewingTemplate = templates.find(data => {
        if(data.id === tempId){
          return data
        }
      });
      
      let questionContent = '';
      viewingTemplate.questions.map((question)=>{
        let tempQuestion = templateQuestions.find(data => {
          if(data.id === question.temp_id) return data
        });

        questionContent += 
          `<div class="card w-100 ">
            <div class="card-content">
              <p class="d-flex m-0">
                <i class="icon-design ${tempQuestion.icon}" style="background-color: ${tempQuestion.color}"></i>
                ${question.question}
              </p>
            </div>
          </div>`
      })
      questionsContainer.innerHTML = questionContent;
      cardIsLoading = false;
      document.querySelector('#modalLoadingSpinner').style.display = "none";
      document.querySelector('#modalViewTemplateContent').style.display = "block";
    },1000)
  }
  
  submitSurvey = (e) => {
    let errors = false
    surveyData = {
      'title': document.querySelector('#txtSurveyName').value,
      'workspace_id': (newWorkspaceId != null) ? newWorkspaceId : (searchedParams.get('ws')) ? searchedParams.get('ws'):(selectedWorkspace)? selectedWorkspace : 0,
      'theme_id': selectedThemeId === null ? null : selectedThemeId,
      'backgroundImage': selectedTemplate === null ? null : (selectedTemplate.background_image == null) ? null : selectedTemplate.background_image 
    };
    

    if(document.querySelector('#txtSurveyName').value === ""){
      errors = true
    }

    if(errors === false){
      $('#btnSubmitSurvey').html('<span class="spinner-border custom-spinner spinner-border-sm m-0" role="status" aria-hidden="true"></span> <strong> Creating Survey</strong>');
      //e.target.innerHTML = '';
      //e.target.innerHTML = '<span class="spinner-border custom-spinner spinner-border-sm m-0" role="status" aria-hidden="true"></span> <strong> Creating Survey</strong>';
  
      setTimeout(() => {
        // add survey
        $.ajax({
          url: base_url + 'survey/create',
          data: surveyData,
          dataType: 'json',
          type: 'POST',
          success: function(payload){
            if(selectedTemplate){
              submitQuestions(payload);
              toastr["success"]("Survey with template added!");
            }else{
              toastr["success"]("Survey added!");
            }
            $('#btnSubmitSurvey').html('<strong><i class="fa fa-plus-square-o"></i> Create Survey</strong>');
            //e.target.innerHTML = '<strong><i class="fa fa-plus-square-o"></i> Create Survey</strong>';
            window.location = '<?php echo base_url();?>survey/edit/'+payload.data.id;
          }
        })
      }, 2000);
    }else{
      toastr["error"]("Please fill up the required fields");
    }

  }

  // part of submitSurvey function
  submitQuestions = payload => {
    selectedTemplate.questions.map(question=>{
      // may error dito sa pagsave

      let data = {
        "question": question.question,
        "active": question.active,
        "description": question.description,
        "description_label": question.description_label,
        "order": question.order,
        "required": question.required,
        "template_id": question.temp_id,
        "choices": question.choices == null ? null :  question.choices
      }

      $.ajax({
        url: surveyBaseUrl + 'survey/add/questions/'+payload.data.id+'/'+question.temp_id,
        data: data,
        dataType: 'json',
        type: 'POST',
        success: function(res){
          return;
        }
      })

      if(question.choices){
        
          $.ajax({
            url: surveyBaseUrl + 'survey/add/questions/template/choices/'+payload.data.id,
            data: { "choices": data.choices },
            dataType: 'json',
            type: 'POST',
            success: function(res){
              
              $.ajax({
                url: surveyBaseUrl + 'survey/update/question',
                data: data,
                dataType: 'json',
                type: 'POST',
                success: function(res){
                  return;
                }
              })
              return;
            }
          })
          
      }

    })
  }
</script>
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>

