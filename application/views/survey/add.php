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
  
  .template-card{
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
</style>
<div class="wrapper" role="wrapper">
  <?php include viewPath('includes/sidebars/marketing'); ?>
  <div wrapper__section>
    
    <div class="card">
      <div class="card-body">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>survey/workspace">Surveys</a></li>
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
        <hr/>
        <div id="workspace-text-card" class="card" style="display: none">
          <span class="h3" id="workspace-text">No workspace selected</span>
        </div>
        <div class="form-group">
          <label for="txtSurveyName">Place a new survey name</label>
          <input type="text" name="txtSurveyName" id="txtSurveyName" class="form-control" placeholder="(e.g. Alexa's 18th Birthday review, etc.)">
        </div>
  
        <p id="selected-template-text">Select Template:</p>
        <div class="row">
          <?php
            foreach($survey_templates as $survey_template){
              ?>
                <div class="col-xs-4">
                  <div class="card template-card" onclick="viewTemplate(<?= $survey_template->id?>)" data-toggle="modal" data-target="#modalViewTemplate">
                    <!-- <div class="card-title"> -->
                      <h5>
                        <?=$survey_template->name?>
                      </h5>
                      <small><?=count($survey_template->questions)?> questions</small>
                    <!-- </div> -->
                  </div>
                </div>
              <?php
            }
          ?>
        </div>
      </div>

      <div class="modal fade" id="modalViewTemplate">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div id="modalLoadingSpinner">
              <div class="modal-body">
                <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </div>
            </div>
            <div id="modalViewTemplateContent">
              <div class="modal-header">
                Viewing
              </div>
              <div class="modal-body m-0">
                <h4>Questions Listed:</h4>
                <div id="template-questions-list">
                </div>
              </div>
              <div class="modal-footer">
                <button onclick="selectTemplate()" class="btn btn-sm btn-primary" data-dismiss="modal">Select Template</button>
                <button class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="modalViewWorkspaces" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
              <div id="modalViewWorkspaceContent">
                <div class="modal-header">
                  <h3>
                    Select workspace
                  </h3>
                </div>
                <div class="modal-body">
                  <?php foreach($survey_workspaces as $workspace){
                    ?>
                      <div class="card template-card" data-dismiss="modal" onclick="selectWorkspace(<?= $workspace->id?>, '<?=$workspace->name?>')">
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

    </div>
  </div>
</div>

<script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/js/survey.js"></script>
<script>
  let url = new URL(window.location.href);
  let cardIsLoading = false;
  let templates = <?=json_encode($survey_templates)?>;
  let viewingTemplate = null;
  let templateQuestions = <?=json_encode($survey_question_templates)?>;
  let selectedTemplate = null;
  let selectedWorkspace = null;
  
  let searchedParams = url.searchParams;

  $(document).ready(()=>{
    if(!searchedParams.get('ws')){
      $('#modalViewWorkspaces').modal('show');
      document.querySelector('#workspace-text-card').style.display = "block";
    }
  })

  selectWorkspace = (id, name) => {
    selectedWorkspace = id;
    console.log(name);
    document.querySelector('#workspace-text').innerHTML = "Selected Workspace: <strong>" + name + "</strong>";
    
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

  selectTemplate = id => {
    selectedTemplate = viewingTemplate;
    document.querySelector('#selected-template-text').innerHTML = "Selected Theme: <strong>"+selectedTemplate.name+"</strong>";
  }
  
  submitSurvey = (e) => {
    surveyData = {
      'title': document.querySelector('#txtSurveyName').value,
      'workspace_id': (searchedParams.get('ws'))?searchedParams.get('ws'):(selectedWorkspace)?selectedWorkspace:0 
    };

    if(document.querySelector('#txtSurveyName').value === ""){
      
      toastr["error"]("Form title not yet added");
      return;
    }
    
    e.target.innerHTML = '<span class="spinner-border spinner-border-sm m-0" role="status" aria-hidden="true"></span> Submitting';
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
      }
    })

    setTimeout(() => {
      window.location = '<?= base_url();?>survey/workspace';
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

