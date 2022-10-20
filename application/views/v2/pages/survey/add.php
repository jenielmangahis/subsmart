<?php include viewPath('v2/includes/header'); ?>
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
  .box-link{
    text-decoration: none;
  }
  .accordion-item, .accordion-button{
    background-color: #6a4a86 !important;
    color: #ffffff;
  }
  .accordion-body{
    background-color: #ffffff
  }
  .accordion-item .card-footer{
    color: #000000;
    height: 99px !important;
  }
  .accordion-item .card-body{
    height: 150px;    
  }
  .accordion-body{
    max-height: 500px;
    overflow-y: scroll;
  }
  #template-questions-list{
    max-height: 400px;
    overflow-y: scroll;
  }
  #template-questions-list .icon-design{
    width: 80%;
    height: 39px;
    font-size: 20px;
  }
  .question-icon{
    display: inline-block;    
    width: 59px;
    vertical-align: top;
  }
  .question-text{
    display: inline-block;
    width: 80%;
  }
  #template-questions-list .card{
    background-color: #6a4a86;
    color: #ffffff;
    padding: 8px;
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
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">By creating this survey, you can either use a pre-made template or make your own.</div>
                    </div>
                </div>
                <div class="container mt-5">
                  <div class="row">
                      <div class="col-3">
                        <a class="box-link" data-toggle="modal" data-target="#modalSelectWorkspace" href="javascript:void(0);">
                        <div class="card text-center p-4" style="height: 100%; background-color: #352640; color:#ffffff;">
                          <h1 id="status-workspace-icon">
                            <i class='bx bx-table'></i>
                          </h1>
                          <h5 id="status-workspace-text"> <i class="fa fa-check-circle"></i> Workspace</h5>
                          <span id="status-workspace-content"></span>
                        </div>
                        </a>
                      </div>
                      <div class="col-3">
                        <a class="box-link" data-toggle="modal" data-target="#modalSetSurveyName" href="javascript:void(0);">
                        <div class="card text-center p-4" style="height: 100%; background-color: #352640; color:#ffffff;">                
                            <h1 id="status-survey-name-icon">
                              <i class='bx bx-font'></i>
                            </h1>                
                            <h5 id="status-survey-name-text"> <i class="fa fa-check-circle"></i> Set Survey Name </h5>                
                            <span id="selected-survey-name"></span>
                            <input type="hidden" name="txtSurveyName" id="txtSurveyName">
                        </div>
                        </a>
                      </div>
                      <div class="col-3">
                        <a class="box-link" data-toggle="modal" data-target="#modalSelectTheme" href="javascript:void(0);">
                        <div class="card text-center p-4" style="height: 100%; background-color: #352640; color:#ffffff;">
                          <h1 id="status-theme-icon">
                            <i class='bx bxs-paint-roll' ></i>
                          </h1>
                          <h5 id="status-theme-text"> <i class="fa fa-check-circle"></i> Select Theme</h5>
                          <span id="status-theme-content"></span>
                          <span>(Optional)</span>
                        </div>
                        </a>
                      </div>
                      <div class="col-3">
                        <a class="box-link" data-toggle="modal" data-target="#modalSelectTemplate" href="javascript:void(0);">
                        <div class="card text-center p-4" style="height: 100%; background-color: #352640; color:#ffffff;">
                          <h1 id="status-template-icon">
                            <i class='bx bx-list-ul' ></i>
                          </h1>
                          <h5 id="status-template-text"> <i class="fa fa-check-circle"></i> Template</h5>
                          <span id="status-template-content"></span>
                          <span>(Optional)</span>
                        </div>
                        </a>
                      </div>
                    </div>                    
                    <div class="row text-center">
                      <div class="col-md-12" style="margin-top: 20px;">
                        <button type="button" id="btnSubmitSurvey" style="width:30%; display: inline-block;font-size: 17px;" onclick="submitSurvey(event)" class="nsm-button primary"><strong><i class='bx bxs-plus-square' style="position: relative;top: 2px;"></i> Create Survey</strong></button>  
                        <button type="button" name="btn_back" style="width:30%;display: inline-block;font-size: 17px;" class="nsm-button primary" onclick="location.href='<?php echo url('survey') ?>'"><i class='bx bx-window-close' style="position: relative;top: 2px;"></i> Cancel</button>     
                      </div>
                    </div>
                  </div>                  
                </div>

                <div class="row container">
                  <div id="workspace-text-card" class="col-xs-12 col-sm-6 card" style="display: none">
                    <span class="h3" id="workspace-text">No workspace selected</span>
                    <button class="btn btn-link btn-block btn-info text-white" data-toggle="modal" data-target="#modalSelectWorkspace">Change workspace</button>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include('add_survey_modals.php'); ?>

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
    selectedThemeId = surveyThemes[id].sth_rec_no;
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
          `<div class="card w-100 mb-3">
            <div class="card-content">
              <p class="m-0">
                <div class='question-icon'>
                <i class="icon-design ${tempQuestion.icon}" style="background-color: ${tempQuestion.color}"></i>
                </div>
                <div class='question-text'>
                ${question.question}
                </div>
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

  $(document).on('click', '.box-link', function(){
    var modal_name = $(this).data('target');
    $(modal_name).modal('show');
  });
</script>

<?php include viewPath('v2/includes/footer'); ?>