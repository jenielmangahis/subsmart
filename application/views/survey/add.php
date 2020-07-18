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
</style>
<div class="wrapper" role="wrapper">
  <?php include viewPath('includes/sidebars/marketing'); ?>
  <div wrapper__section>
    
    <div class="card">
      <div class="card-body">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>survey">Surveys</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>survey/workspace">Workspace</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Survey</li>
          </ol>
        </nav>
        <div class="d-flex w-100 justify-content-between">
          <div>
            <h2>Create new survey</h2>
            <p>By creating this survey, you can either use a pre-made template or make your own.  </p>
          </div>
          <div>
            <button type="button" id="#btnSubmitSurvey" onclick="submitSurvey(event)" class="btn btn-primary btn-sm">Create Survey</button>
          </div>
        </div>
        <div class="alert alert-light">
          <span id="status-survey-name-text" class="text-danger"> <i class="fa fa-check-circle"></i> Survey Name</span><br/>
          <span id="status-theme-text" class="text-danger"> <i class="fa fa-check-circle"></i> Theme</span><br/>
          <span id="status-template-text" class="text-danger"> <i class="fa fa-check-circle"></i> Template (optional)</span><br/>
        </div>
        <div class="form-group">
          <label for="txtSurveyName">Survey Name</label>
          <input type="text" name="txtSurveyName" id="txtSurveyName" class="form-control" placeholder="(e.g. Alexa's 18th Birthday review, etc.)">
        </div>
        <div class="row container">
          
          <div id="theme-text-card" class="col-xs-12 col-sm-6 card">
            <img class="theme-image" id="imgSelectedTheme" style="display: none;" src="" alt="">
            <span class="h3" id="theme-text">No theme selected</span>
            <button class="btn btn-dark" data-toggle="modal" data-target="#modalSelectTheme">Select Theme</button>
          </div>
          

          <div id="workspace-text-card" class="col-xs-12 col-sm-6 card" style="display: none">
            <span class="h3" id="workspace-text">No workspace selected</span>
          </div>
        </div>
  
  
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="templateToggleSwitch">
          <label class="custom-control-label" for="templateToggleSwitch">Toggle this switch element</label>
        </div>  

        <div id="templateSection" style="display: none">
          <p id="selected-template-text">Select Template:</p>

          <div class="accordion" id="accordionExample">
            <?php
              foreach($template_categories as $key => $category){
                ?>

                  <div class="card m-0 p-0">
                    <div class="card-header d-flex justify-content-between" id="headingOne" data-toggle="collapse" data-target="#collapse-<?=$key?>" aria-expanded="true" aria-controls="collapse-<?=$key?>">
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
                                  <div class="card template-card" onclick="viewTemplate(<?= $template->id?>)" data-toggle="modal" data-target="#modalViewTemplate">
                                    <img class="template-image" src="<?=base_url()?>uploads/survey/themes/<?=$theme->sth_primary_image?>" alt="<?=$theme->sth_primary_image?>">
                                    <div class="card-content template-card-content">
                                      <h4 <?= empty($theme->sth_text_color) ? null : "style='color: $theme->sth_text_color '"?>><?=$template->name?></h4>
                                      <span <?= empty($theme->sth_text_color) ? null : "style='color: $theme->sth_text_color '"?>><?= count($template->questions)?> question<?=(count($template-> questions) > 1)?"s":""?> </span>
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
        <script>
          document.querySelector('#templateToggleSwitch').addEventListener('click',(e)=>{
            console.log(e.target.checked);
            if(e.target.checked) document.querySelector('#templateSection').style.display = 'block';
            if(!e.target.checked) document.querySelector('#templateSection').style.display = 'none';
          })
        </script>


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
          
      <div id="modalSelectWorkspace" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
              <div id="modalSelectWorkspaceContent">
                <div class="modal-header">
                  <h3>
                    Select workspace
                  </h3>
                </div>
                <div class="modal-body">
                  <?php foreach($survey_workspaces as $workspace){
                    ?>
                      <div class="card template-card p-3" data-dismiss="modal" onclick="selectWorkspace(<?= $workspace->id?>, '<?=$workspace->name?>')">
                        <h4><?=$workspace->name?></h4>
                        <span><?=count($workspace->surveys)?> survey<?=(count($workspace->surveys) > 1 )?"s":""?> registered to this workspace.</span>
                      </div>
                    <?php
                  }?>
                </div>
              </div>
            </div>
        </div>
      </div>

      <div id="modalSelectTheme" class="modal fade" >
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <div>
                <h4>Select Theme</h4>
                <p>Click on one of the themes to select a theme you want to use. </p>
              </div>
            </div>
            <div class="modal-body">
              <div class="row">
                <?php 
                  foreach($survey_themes as $key=>$theme){
                    ?>
                      <div data-id="<?php $theme->sth_rec_no?>" class="col-xs-12 " onclick="selectTheme(<?=$key?>)" data-dismiss="modal">
                        <div class="card theme-card" >
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
                    </div>
                      <!-- <button class="btn btn-light btn-block" onclick="selectTheme(<?=$key?>)" data-dismiss="modal"><?=$theme->sth_theme_name?></button> -->
                    <?php
                  }
                ?>
              </div>
            </div>
            <div class="modal-footer">

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
  const statusSurveyName = document.querySelector('#status-survey-name-text');
  const statusTemplate = document.querySelector('#status-template-text');
  const statusTheme = document.querySelector('#status-theme-text');

  let url = new URL(window.location.href);
  let cardIsLoading = false;
  let templates = <?=json_encode($survey_templates)?>;
  let templateQuestions = <?=json_encode($survey_question_templates)?>;
  let surveyThemes = <?=json_encode($survey_themes)?>;
  let viewingTemplate = null;
  let selectedTemplate = null;
  let selectedWorkspace = null;
  let selectedTheme = null;
  
  let searchedParams = url.searchParams;

  $(document).ready(()=>{
    
    if(!searchedParams.get('ws')){
      $('#modalSelectWorkspace').modal('show');
      document.querySelector('#workspace-text-card').style.display = "block";
    }

    if(searchedParams.get('th')){
      selectedTemplate = templates.filter((template)=>{
        return template.id == searchedParams.get('th');
      })[0];
      document.querySelector('#selected-template-text').innerHTML = "Selected Template: <strong>"+selectedTemplate.name+"</strong>";

      selectedTheme = surveyThemes.filter(theme=>{
        return theme.sth_rec_no == selectedTemplate.theme_id;
      })[0];
      document.querySelector('#theme-text').innerHTML = "Selected theme: <strong>"+ selectedTheme.sth_theme_name +"</strong>";
      document.querySelector('#imgSelectedTheme').src = `<?=base_url()?>uploads/survey/themes/${selectedTheme.sth_primary_image}`;
      document.querySelector('#imgSelectedTheme').alt = selectedTheme.sth_primary_image;
      document.querySelector('#imgSelectedTheme').style.display = "block";
    }
  })

  document.querySelector('#txtSurveyName').addEventListener('change', ()=>{
    console.log("this needs to be updated");
    // console.log(statusSurveyName);
    // statusSurveyName.class = "text-success";
    // statusSurveyName.classlist.add = "text-success";
  })

  selectTheme = id => {
    selectedTheme = id;
    document.querySelector('#theme-text').innerHTML = "Selected theme: <strong>"+ surveyThemes[id].sth_theme_name +"</strong>"
    document.querySelector('#imgSelectedTheme').src = `<?=base_url()?>uploads/survey/themes/${surveyThemes[id].sth_primary_image}`;
    document.querySelector('#imgSelectedTheme').alt = surveyThemes[id].sth_primary_image;
    document.querySelector('#imgSelectedTheme').style.display = "block";
  }

  selectWorkspace = (id, name) => {
    selectedWorkspace = id;
    document.querySelector('#workspace-text').innerHTML = "Selected Workspace: <br/><strong>" + name + "</strong>";
  }


  selectTemplate = id => {
    selectedTemplate = viewingTemplate;
    document.querySelector('#selected-template-text').innerHTML = "Selected Template: <strong>"+selectedTemplate.name+"</strong>";
    
    selectedTheme = surveyThemes.filter(theme=>{
      return theme.sth_rec_no == selectedTemplate.theme_id;
    })[0];
    document.querySelector('#theme-text').innerHTML = "Selected theme: <strong>"+ selectedTheme.sth_theme_name +"</strong>";

    document.querySelector('#imgSelectedTheme').src = `<?=base_url()?>uploads/survey/themes/${surveyThemes[id].sth_primary_image}`;
    document.querySelector('#imgSelectedTheme').alt = surveyThemes[id].sth_primary_image;
    document.querySelector('#imgSelectedTheme').style.display = "block";
  }
  
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
    surveyData = {
      'title': document.querySelector('#txtSurveyName').value,
      'workspace_id': (searchedParams.get('ws'))?searchedParams.get('ws'):(selectedWorkspace)? selectedWorkspace : 0,
      'theme_id': selectedTheme === null ? 0 : selectedTheme
    };

    if(document.querySelector('#txtSurveyName').value === ""){
      
      toastr["error"]("Form title not yet added");
      return;
    }
    
    e.target.innerHTML = '<span class="spinner-border spinner-border-sm m-0" role="status" aria-hidden="true"></span> Submitting';

    setTimeout(() => {
      // add survey
      $.ajax({
        url: surveyBaseUrl + 'survey/create',
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
          window.location = '<?= base_url();?>survey/result/'+payload.data.id;
        }
      })
    }, 5000);

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
        question.choices.map(choice=>{
          $.ajax({
            url: surveyBaseUrl + 'survey/add/question/choice/'+payload.data.id+'/'+question.temp_id,
            data: data,
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
          
          
        })
      }

    })
  }

</script>
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>

