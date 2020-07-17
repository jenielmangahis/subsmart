<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	include viewPath('includes/header');
?>

<style>

  .card{
    border-radius: 25px;
  }

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
  

  .survey-card {
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

  img.theme-image{
    position: absolute;
    z-index: 0;
    width: 100%;
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

  <?php include viewPath('includes/sidebars/marketing'); ?>  <div wrapper__section>

  <!-- survey welcome page -->
  <div id="welcome-container" class="w-100">
    <div class="card p-5">
      <div class="card-content">
        <div id="workspace-list">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="text-center">
                <img src="assets/survey/wizard.jpg" alt="wizard" style="height: 300px">            
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
              <h1 class="text-center">
                Welcome to Survey Wizard
              </h1>
              <p class="text-center">
                What would you like to do?
              </p>
              <div class="text-center">
                <button class="btn btn-small btn-block btn-primary"><a class="text-white" href="<?=base_url()?>survey/add"><i class="fa fa-wpforms"></i> Add new survey</a></button>
                <button class="btn btn-small btn-block btn-secondary"><a class="text-white" href="<?=base_url()?>survey/themes/create"><i class="fa fa-paint-brush"></i> Add new themes</a></button>
              </div>
              <p class="text-center">Quick Links<br/><a href="<?=base_url()?>survey/workspace">Workspaces</a> | <a href="<?=base_url()?>survey/themes">Themes</a> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- recent survey container -->
  <div id="recent-survey-container" class="w-100">
    <div class="card p-5">
      <h4><i class="fa fa-folder-open"></i> Recently opened</h4>
      <div id="recent-survey-opened-table" class="row"></div>
    </div>
  </div>
  <!-- end of survey recent container -->

  <!-- workspace container -->
  <div id="workspace-survey-list" class="w-100">
    <div class="card p-5">
      <div class="d-flex w-100 justify-content-between">
        <h4><i class="fa fa-table"></i> Workspaces</h4>
        <a class="d-none d-sm-block" href="<?=base_url()?>survey/workspace">View in a separate page</a>
      </div>

      <button class="btn btn-block btn-light d-sm-block d-md-none" data-toggle="modal" data-target="#modalAddWorkspace"> <i class="fa fa-plus"></i> Add new workspace</button>
      <div class="row">
        <div class="dropdown col-xs-12 d-block d-md-none d-flex">
          <a href="" class="btn btn-block btn-light dropdown-toggle d-block d-md-none" data-toggle="dropdown">Select workspace <span class="caret"></span></a>
          <div id="dropdown-workspace-menu" class="dropdown-menu">
            <?php
              foreach($survey_workspaces as $workspace){
                ?>
                  <a class="list-group-item d-flex justify-content-between " id="list-home-list" data-toggle="list" href="#list-workspace-<?=$workspace->id?>" role="tab" aria-controls="home"><?= $workspace->name?><span class="badge badge-primary badge-pill"><?=(count($workspace->surveys) > 0) ? count($workspace->surveys) : ""?></span></a>
                <?php
              }
            ?>
          </div>
        </div>
        
        <div class="col-xs-12 col-md-2 d-none d-md-block">
          <div class="list-group" id="list-tab" role="tablist">
            <button class="list-group-item  btn-light" data-toggle="modal" data-target="#modalAddWorkspace"> <i class="fa fa-plus"></i> Add new workspace</button>
            <?php
              foreach($survey_workspaces as $workspace){
                ?>
                  <a class="list-group-item d-flex justify-content-between list-group-item-action" id="list-home-list" data-toggle="list" href="#list-workspace-<?=$workspace->id?>" role="tab" aria-controls="home"><?= $workspace->name?><span class="badge badge-primary badge-pill"><?=(count($workspace->surveys) > 0) ? count($workspace->surveys) : ""?></span></a>
                <?php
              }
            ?>
          </div>
        </div>

        <!-- list group window -->
        <div class="col-xs-12 col-md-10">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-workspace-index" role="tabpanel" aria-labelledby="list-home-list">
              <div class="card">
                <div class="card-content">
                  <span>Recently created surveys</span>
                  <div id="recent-survey-added-table" class="row d-flex w-100 justify-content-start"></div>
                </div>
              </div>
            </div>
            <?php
              foreach($survey_workspaces as $workspace){
                ?>
                  <div class="tab-pane fade" id="list-workspace-<?=$workspace->id?>" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="card">
                      <div class="card-content">

                        <div class="d-flex w-100 justify-content-between">
                          <div>
                            <h4 class="p-0 m-0"><?=$workspace->name?></h4>
                            <small><?=count($workspace->surveys)?> survey<?=(count($workspace->surveys)>1)?"s":""?> in this workspace</small>
                          </div>
                          <div>
                            <button class="btn btn-info btn-sm" onclick="handleEditWorkspacePrompt(<?=$workspace->id?>)" data-toggle="modal" data-target="#modalEditWorkspace"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="handleDeleteWorkspacePrompt(<?=$workspace->id?>)" data-toggle="modal" data-target="#modalDeleteWorkspace"><i class="fa fa-trash"></i></button>
                          </div>
                        </div>
                        <hr/>

                        <div class="row">
                        
                          <div class="col-xs-12 col-sm-6 col-xl-3">
                            <div id="survey-add-card" class="card border-0 shadow" >
                              <a class="text-left" href="<?=base_url()?>survey/add?ws=<?=$workspace->id?>">
                                <div class="card-body">
                                  <h5 class="text-center w-100">Add new survey</h5>
                                  <span class="text-center">
                                    <i class="fa fa-plus-circle"></i>
                                  </span>
                                </div>
                              </a>
                            </div>
                          </div>
                          <?php foreach ($workspace->surveys as $key => $survey): ?>
                            <div class="col-xs-12 col-sm-6 col-xl-3">
                              <!-- Card content for each survey -->
                              <div data-id="<?= $survey->id ?>" class="card survey-card border-0 shadow" style="<?=($survey->survey_theme != null)? "background-image: url('".base_url()."uploads/survey/themes/".$survey->survey_theme->sth_primary_image."')  " : ""?>">
                                <a class="text-left" href="<?=base_url()?>survey/result/<?= $survey->id ?>">
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
                                  </div>
                                
                                </div>
                              </div>

                            </div>
                          <?php endforeach; ?>
                          
                          
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
  
  <!-- end of workspace container -->


  <!-- template container -->
  <div id="template-list" class="w-100">
    <div class="card p-5">
      <div class="card-content">
        <h4>Templates</h4>

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
                      
                      <div class="row d-flex w-100">
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
            };
          ?>


        </div>

      </div>
    </div>
  </div>
  <!-- end of template container -->

  <!-- MODALS -->
  <div class="modal fade" id="modalAddWorkspace" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <?= form_open('survey/workspace/add')?>
          <div class="modal-header">
            <h5 class="modal-title">Add New Workspace</h5>
          </div>
          <div class="modal-body">
              <p>Add new workspace by entering a name inside the text box below.</p>
              <div class="form-group">
                <input type="text" name="txtWorkspaceName" class="form-control">
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary">Submit</button>
          </div>
        <?= form_close()?>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDeleteWorkspace" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
              <p>Are you sure you want to delete this workspace? Removing a workspace will not remove the surveys include and will be hidden instead.</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-dark btn-sm" onclick="handleDeleteWorkspacePrompt()" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger btn-sm" onclick="handleDeleteWorkspace(event)">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEditWorkspace" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change the name of your workspace</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="txtWorkspaceName" name="txtWorkspaceName" placeholder="Enter the name here.."/>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-dark btn-sm" onclick="handleEditWorkspacePrompt()" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger btn-sm" onclick="handleEditWorkspace(event)">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalViewTemplate">
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
          <button id="btnCreateByTemplate" class="btn btn-primary">Use this template</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end of modals -->
</div>

  


  <script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
  <script script type="text/javascript" src="<?=base_url()?>/assets/js/survey.js"></script>
  <script>
  
  let viewingTemplate = null;
  let recentSurveys = <?= json_encode($surveys)?>;
  recentSurveys.sort((a,b)=>{
    if(a.date_created > b.date_created){
      return -1;
    }
    if(a.date_created < b.date_created){
      return 1
    }
    return 0;
  }).splice(5);

  let selectedTemplate = null;
  let templates = <?=json_encode($survey_templates)?>;
  let templateQuestions = <?=json_encode($survey_question_templates)?>;
  let deleteId = null;
  let editId = null;
  let items = "";

  document.querySelector('#btnCreateByTemplate').addEventListener('click', ()=>{
    window.location.href = `<?= base_url()?>survey/add?th=${1}`
  });

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
      console.log(viewingTemplate);
    },1000)
  }
  
  
  JSON.parse(localStorage.getItem('survey_ro')).map((item)=>{
    document.querySelector('#recent-survey-opened-table').innerHTML += `
    <div class="col-xs-12 col-sm-6 col-xl-3">
      <div data-id="${item.id}" class="card survey-card border-0 shadow" style="background-image: url('<?=base_url()?>uploads/survey/themes/${item.survey_theme?.sth_primary_image}')">
        <a class="text-left" href="<?=base_url()?>survey/result/${item.id}">
          <div class="card-body">
            <h5 class="card-title survey-title font-weight-bold" style="color: ${item.survey_theme?.sth_text_color}; border-left: 5px solid ${item.survey_theme?.sth_primary_color};">${item.title}</h5>
            <small class="text-info" style="color: ${item.survey_theme?.sth_secondary_color}">Click for more info</small>
          </div>
        </a>
        
      </div>

    </div>
    `;
  })

  
  recentSurveys.map((item)=>{
    document.querySelector('#recent-survey-added-table').innerHTML += `
    <div class="col-xs-12 col-sm-6 col-xl-3">
      <div data-id="${item.id}" class="card survey-card border-0 shadow" style="background-image: url('<?=base_url()?>uploads/survey/themes/${item.survey_theme?.sth_primary_image}')">
        <a class="text-left" href="<?=base_url()?>survey/result/${item.id}">
          <div class="card-body">
            <h5 class="card-title survey-title font-weight-bold" style="color: ${item.survey_theme?.sth_text_color}; border-left: 5px solid ${item.survey_theme?.sth_primary_color};">${item.title}</h5>
            <small class="text-info" style="color: ${item.survey_theme?.sth_secondary_color}">Click for more info</small>
          </div>
        </a>
        
      </div>

    </div>
    `;
  })
  

  handleDeleteWorkspacePrompt = (id = null) => {
    deleteId = (id === null)? deleteId = null : deleteId = id 
  }

  handleEditWorkspacePrompt = (id = null) => {
    editId = (id === null)? editId = null : editId = id 
  }

  handleDeleteWorkspace = (event) => {
    event.target.disabled = true;
    event.target.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Please wait';
    $.ajax({
      url: surveyBaseUrl+'survey/workspace/delete/'+deleteId,
      type: 'GET',
      success: function(res){
        setTimeout(() => {
          window.location.reload();
        }, 250);
        toastr["success"]("Workspace deleted");
      }
    })
  }

  handleEditWorkspace = (event) => {
    event.target.disabled = true;
    event.target.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Please wait';

    workspaceData = {
      'txtWorkspaceName': document.querySelector('#txtWorkspaceName').value
    }
    $.ajax({
      url: surveyBaseUrl+'survey/workspace/edit/'+editId,
      data: workspaceData,
      dataType: "json",
      type: 'POST',
      success: function(res){
        setTimeout(() => {
          window.location.reload();
        }, 250);
        toastr["success"]("Workspace Details Changed");
        document.querySelector('#txtWorkspaceName').value = ''
      }
    })
  }
  


</script>
  
</div>

<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>