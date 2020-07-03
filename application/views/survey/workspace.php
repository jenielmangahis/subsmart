<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	include viewPath('includes/header');
?>

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

  .survey-card{
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
</style>
<div class="wrapper" role="wrapper">
  <?php include viewPath('includes/sidebars/marketing'); ?>
  <div wrapper__section>
    <div class="card">
      <div class="col-xs-12 text-left">
          <h1 class="m-0 text-left">Surveys</h1>
      </div>
      <hr/>
      <div class="row">
        <div class="col-2">
          <button class="btn btn-success btn-block" data-toggle="modal" data-target="#modalAddWorkspace"> <i class="fa fa-plus"></i> Add new workspace</button>
          <div class="list-group" id="list-tab" role="tablist">
            <?php
              foreach($survey_workspaces as $workspace){
                ?>
                  <a class="list-group-item d-flex justify-content-between list-group-item-action" id="list-home-list" data-toggle="list" href="#list-workspace-<?=$workspace->id?>" role="tab" aria-controls="home"><?= $workspace->name?><span class="badge badge-primary badge-pill"><?=(count($workspace->surveys) > 0) ? count($workspace->surveys) : ""?></span></a>
                <?php
              }
            ?>
          </div>
        </div>
        <div class="col-10">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-workspace-index" role="tabpanel" aria-labelledby="list-home-list">

              <div class="card">
                <div class="card-content">
                  <div class="row d-flex w-100 justify-content-center">
                  <div class="w-100 text-center py-2">
                    <p>Welcome to the survey section. Here we have a list of workspaces consisting of a collection of surveys.</p>
                  </div>

                    <div class="col-xs-12 col-sm-6 col-md-3">
                      <div class="card border-0 shadow" data-toggle="modal" data-target="#modalAddWorkspace">
                        <div class="card-body">
                          <h5 class="text-center">Add new workspace</h5>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3">
                      <div class="card border-0 shadow" >
                        <a class="text-left" href="<?=base_url()?>survey/add">
                          <div class="card-body">
                            <h5 class="text-center">Add new<br/>survey</h5>
                          </div>
                        </a>
                      </div>
                    </div>

                  </div>
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

                          <div class="col-xs-12 col-sm-6 col-md-3">
                            <div id="survey-add-card" class="card border-0 shadow" >
                              <a class="text-left" href="<?=base_url()?>survey/add?ws=<?=$workspace->id?>">
                                <div class="card-body">
                                  <h5 class="text-center">Add new survey</h5>
                                </div>
                              </a>
                            </div>
                          </div>

                          <?php foreach ($workspace->surveys as $key => $survey): ?>
                            <div class="col-xs-12 col-sm-6 col-md-3">

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

  </div>

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
        <div class="modal-body">
          <input type="text" id="txtWorkspaceName" name="txtWorkspaceName"/>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-dark btn-sm" onclick="handleEditWorkspacePrompt()" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger btn-sm" onclick="handleEditWorkspace(event)">Save Changes</button>
        </div>
      </div>
    </div>
  </div>


</div>

<script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/js/survey.js"></script>
<script>
  let deleteId = null;
  let editId = null;

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
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>

