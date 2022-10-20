<!-- View Template -->
<div class="modal fade nsm-modal fade" id="modalViewTemplate" aria-labelledby="modalViewTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Template</span>
                <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
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
                
                  <p><b>Questions Listed:</b></p>
                  <div id="template-questions-list"></div>

              </div>
            </div>
            <div class="modal-footer">
                <button name="btn_close_modal" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button onclick="selectTemplate()" class="nsm-button primary" data-bs-dismiss="modal">Select Template</button>                
            </div>
        </div>
    </div>
</div>

<!-- Set Survey Name -->
<div class="modal fade nsm-modal fade" id="modalSetSurveyName" aria-labelledby="modalSetSurveyNameLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Set Survey Name</span>
                <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>            
            <div class="modal-body">
              <input type="text" class="form-control" id="survery-name" value="" placeholder="(e.g. Alexa's 18th Birthday review, etc.)" />
            </div>
            <div class="modal-footer">
                <button name="btn_close_modal" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button name="btn_edit_auto_sms" type="submit" class="nsm-button primary btn-set-survey-name">Save</button>
            </div>            
        </div>
    </div>
</div>

<!-- Select Template -->
<div class="modal fade nsm-modal fade" id="modalSelectTemplate" aria-labelledby="modalSelectTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Select Template</span>
                <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
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
                  <?php foreach($template_categories as $key => $category){ ?>
                    <div class="accordion-item mb-2">
                      <h2 class="accordion-header" id="heading<?= $key; ?>">
                        <button class="accordion-button" style="color: #ffffff !important;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key; ?>" aria-expanded="true" aria-controls="collapseOne">
                          <?=$category?> 
                        </button>
                      </h2>

                      <div id="collapse<?= $key; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $key; ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          
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
                                    <div class="col-4 mb-4" onclick="viewTemplate(<?=$template->id?>)" data-bs-toggle="modal" data-bs-target="#modalViewTemplate">
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
                  <?php } ?>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<!-- Select Workspace -->
<div class="modal fade nsm-modal fade" id="modalSelectWorkspace" aria-labelledby="modalSelectWorkspaceLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Select a workspace or create a new one.</span>
                <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>                            
            <div id="modal-body-workspace-selection" class="animate__animated animate__fadeIn ">
              <div class="modal-body p-3">
                <?php foreach($survey_workspaces as $workspace){
                  ?>
                    <div class="card template-card p-3" data-bs-dismiss="modal" onclick="selectWorkspace(<?= $workspace->id?>, '<?=$workspace->name?>')">
                      <h4><?=$workspace->name?></h4>
                      <span><?=count($workspace->surveys)?> survey<?=(count($workspace->surveys) > 1 )?"s":""?> registered to this workspace.</span>
                    </div>
                  <?php
                }?>
              </div>
              <div class="modal-footer">
                <button class="nsm-button primary" onclick="createWorkspaceWindow()">Create new workspace</button>
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
                <button class="nsm-button" onclick="createAndUseWorkspace()">Create and use this workspace</button>
                <button class="nsm-button" onclick="selectWorkspaceWindow()" style="margin:0px;">Return to selection</button>
              </div>
            </div>            
        </div>
    </div>
</div>

<!-- Edit auto sms notification -->
<div class="modal fade nsm-modal fade" id="modalSelectTheme" aria-labelledby="modalSelectThemeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Select Theme</span>
                <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body p-5">
              
              <p>Click on one of the themes to select a theme you want to use. </p>

              <div class="card theme-card">
                <button class="nsm-button primary" onclick="selectTheme(null)" data-dismiss="modal">
                  No theme
                </button>
              </div>
              <div class="row" style="max-height: 500px; overflow-y: scroll;padding: 5px;">
                <?php 
                  foreach($survey_themes as $key=>$theme){
                    ?>
                      <div data-id="<?php $theme->sth_rec_no?>" class="col-6 " onclick="selectTheme(<?=$key?>)" data-bs-dismiss="modal">
                        <div class="card theme-card mb-3">
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