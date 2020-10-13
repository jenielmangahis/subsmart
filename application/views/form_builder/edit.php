
<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>
<style>
  #windowPreviewTemplate{
    min-height: 90%;
    z-index: 0
  }
  
  .form-list-item-options{
    display: none
  }
  .form-list-item.options:hover{
    display: block;
  }


  .form-user-elements-settings{
    display: none;
  }

  .form-elements-settings-hover{
    height: 100%;
    width: 100%;
    text-align: center;
    background-color: rgba(0,0,0,0.2);
    z-index: 1;
    color: #FFFFFF;
    border: 2px solid #555;
  }


  /* form css */
  #windowPreviewTemplate .form-group{
    margin: 0
  }

    #windowPreviewTemplate .form-control{
    height: 1.5em
  }

  #windowPreviewTemplate label{
    font-weight: 500
  }

  #windowPreviewTemplate p{
    font-weight: 500;
  }

  #windowPreviewTemplate .table td{
    padding: 0
  }

  .element-buttons{
    padding: 10px;
    font-size: 15px;
    cursor: pointer;
  }
  
  
</style>
<div class="wrapper">
  <div __wrapper_section>
    <div class="card my-2" style="height: 1250px">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>formbuilder">Form Builder</a></li>
        <li class="breadcrumb-item active"><?= $form->forms_title?></li>
      </ol>
    </nav>
    
      <div class="text-left">
        <h1><?= $form->forms_title?> <button type="button" onclick="window.open('<?= base_url()?>form/<?=$form->forms_id?>', '_blank')" class="btn btn-outline-info"><i class="fa fa-eye"></i> View Form</button></h1>
      </div>

      <hr/>

      <div class="content">

        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="list" href="#form-editor-window">Form Editor</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link " data-toggle="list" href="#form-editor-settings">Form Settings</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link " data-toggle="list" href="#form-editor-share">Share</a>
          </li>
          
          
          <li class="nav-item">
            <a class="nav-link " data-toggle="list" href="#form-editor-results">Results</a>
          </li>
          
        </ul>

        <div class="tab-content">

          <!-- FORM EDITOR -->
          <div id="form-editor-window" class="form-editor-settings-window tab-pane fade show active">
            <h2>Form Editor</h2>
            
            <div class="row">
              <div class="col-xs-12 col-md-3 ">
                
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="list" href="#form-editor-build-sidenav">Build</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="list" href="#form-editor-style-sidenav">Style</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="list" href="#form-editor-rules-sidenav">Rules</a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div id="form-editor-build-sidenav" class="tab-pane fade show active">
                    
                    <div id="accordion" class="overflow-none">
                      <ul class="list-group">
    
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseCommonItemsMenu" aria-expanded="true" aria-controls="collapse0">
                          Common Items
                        </li>
                        <div id="collapseCommonItemsMenu" class="collapse show " aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="row" style="overflow-x: auto; height: 250px;">

                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="1">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-dot-circle-o"></i> Radio Button</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                              <div class="form-elements-draggable" data-element-id="2">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-caret-square-o-down"></i> Dropdown</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="3">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-check-square-o"></i> Checkbox</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                              <div class="form-elements-draggable" data-element-id="4">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-envelope"></i> Email Address</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="5">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-text-width"></i> Long Answer</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="6">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-font"></i> Short Answer</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="7">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-calendar"></i> Calendar  </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="8">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-square-o"></i> Number</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="9">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-file"></i> File Upload</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="10">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-list"></i> Text List</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="11">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-star"></i> Rating</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="12">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-bar-chart"></i> Ranking</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="13">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-square-o"></i> Hidden Field</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="14">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-strikethrough"></i> Signature</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="15">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-image"></i> Image List</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="16">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-calculator"></i> Calculation</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="17">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-credit-card"></i> Credit Card</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="18">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-address-book"></i> Contact Block</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="19">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-save"></i> Save and Return</span>
                                  </div>
                                </div>
                              </div>
                            </div>



                          </div>
                          
                        </div>
    
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseFormattingItemsMenu" aria-expanded="true" aria-controls="collapse0">
                          Formatting Items
                        </li>
                        <div id="collapseFormattingItemsMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="row" style="overflow-x: auto; height: 250px;">
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="20">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-dot-circle-o"></i> Heading</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                              <div class="form-elements-draggable" data-element-id="21">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-font"></i> Text</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="22">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-image"></i> Image</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                              <div class="form-elements-draggable" data-element-id="23">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-link"></i> Link</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="24">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-text-width"></i> Custom Code</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="25">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-square"></i> Blank Space</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="26">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-calendar"></i> Page Break  </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="27">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-square-o"></i> Block Text </span>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>

                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseOrderFormMenu" aria-expanded="true" aria-controls="collapse0">
                          Order Form Tables
                        </li>
                        <div id="collapseOrderFormMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="row" style="overflow-x: auto; heightL 250px;">
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="31">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-calendar"></i> Table List</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                    
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseMatrixGridMenu" aria-expanded="true" aria-controls="collapse0">
                          Matrix/Grid Items
                        </li>
                        <div id="collapseMatrixGridMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="row" style="overflow-x: auto; heightL 250px;">
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="45">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Radio Button Matrix</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="46">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Radio Button Multi-Scale</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="47">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Dropdown Matrix</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="48">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Dropdown Multi-Scale</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="49">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Checkbox Matrix</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="50">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Checkbox Multi-Scale</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="51">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Short Answer Matrix</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="52">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Long Answer Matrix</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="53">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Star Matrix</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="54">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Zone Information Table</span>
                                  </div>
                                </div>
                              </div>
                            </div>                            
                          </div>


                        </div>
                        
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseContainers" aria-expanded="true" aria-controls="collapse0">
                          Containers
                        </li>
                        <div id="collapseContainers" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="row" style="overflow-x: auto; heightL 250px;">
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="55">
                                <div class="card p-1">
                                  <div class="card-content element-buttons">
                                    <span><i class="fa fa-cog"></i> Highlight Container</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
    
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseHeaderFooterMenu" aria-expanded="true" aria-controls="collapse0">
                          Header/Footer
                        </li>
                        <div id="collapseHeaderFooterMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <p class="text-muted">Coming soon</p>
                        </div>
                      </ul>      
                    </div>

                  </div>
                  <div id="form-editor-style-sidenav" class="tab-pane fade">
                    <div class="container-fluid py-3">
                      <div class="form-group">
                        <label for="form-title-font-family">Titles Font Family</label>
                        <select name="form-title-font-family" id="fTFontFamily" class="form-control">
                          <option value="ft-ff-auto">Auto</option>
                          <option value="ft-ff-cursive">Cursive</option>
                          <option value="ft-ff-fantasy">Fantasy</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="form-title-font-size">Titles Font Size</label>
                        <select name="form-title-font-size" id="fTFontSize" class="form-control">
                          <option value="ft-fs-smaller">Smaller</option>
                          <option value="ft-fs-small">Small</option>
                          <option value="ft-fs-medium">Medium</option>
                          <option value="ft-fs-large">Large</option>
                          <option value="ft-fs-larger">Larger</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="form-label-font-family">Labels Font Family</label>
                        <select name="form-label-font-family" id="fLFontFamily" class="form-control">
                          <option value="fl-ff-auto">Auto</option>
                          <option value="fl-ff-cursive">Cursive</option>
                          <option value="fl-ff-fantasy">Fantasy</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="form-label-font-size">Labels Font Size</label>
                        <select name="form-label-font-size" id="fLFontSize" class="form-control">
                          <option value="fl-fs-smaller">Smaller</option>
                          <option value="fl-fs-small">Small</option>
                          <option value="fl-fs-medium">Medium</option>
                          <option value="fl-fs-large">Large</option>
                          <option value="fl-fs-larger">Larger</option>
                        </select>
                      </div>
                      <div class="text-right">
                        <button class="btn btn-primary" id="saveFormStylesBtn">
                          Save
                        </button>
                      </div>                 
                    </div>
                  </div>
                  <div id="form-editor-rules-sidenav" class="tab-pane fade">
                    <h3 class="text-center text-muted">Coming soon</h3>
                  </div>
                </div>
                  
              </div>
              <div class="col-xs-12 col-md-9">


                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a href="#windowEditor" class="nav-link active" data-toggle="tab">Editor</a>
                  </li>
                  <li class="nav-item">
                    <a href="#windowLiveForm" class="nav-link" data-toggle="tab">Live</a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div id="windowEditor" class="tab-pane fade show active" style="height: 150px">
                    <div id="windowPreviewTemplate" class="card" style="height:700px;">
                      <div class="row container-fluid overflow-auto" id="windowPreviewContent">
                        <!-- MAIN WINDOW FOR THE FORM -->
                      </div>
                    </div>
                    <button id="btnEditorScrollDown" class="btn btn-secondary btn-block"><i class="fa fa-arrow-down"></i> Scroll down</button>
                  </div>
                  
                  <div id="windowLiveForm" class="tab-pane fade" style="height: 150px">
                    <div class="card container-fluid">
                      <iframe src="<?= base_url()?>/form/<?= $form->forms_id?>?preview" frameborder="0" class="w-100" style="height: 500px"></iframe>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            
          </div>

          <!-- FORM SETTINGS -->
          <div id="form-editor-settings" class="form-editor-settings-window tab-pane fade ">

            <div class="row">
            
              <div class="col-xs-12 col-md-3">
                <div id="form-settings-menu" class="list-group sticky-top">
                  <a class="list-group-item list-group-item-action active" data-toggle="list" href="#forms-settings-general" >General</a>
                  <!-- <a class="list-group-item list-group-item-action" data-toggle="list" href="#forms-settings-notifications">Notifications</a> -->
                  <a class="list-group-item list-group-item-action" data-toggle="list" href="#forms-settings-success-pages">Success Pages</a>  
                  <a class="list-group-item list-group-item-action" data-toggle="list" href="#forms-settings-custom-text">Custom Text</a>  
                </div>
              </div>

              <div class="col-xs-12 col-md-9">
                <div class="tab-content">
                  <!-- SETTINGS: GENERAL - DESCRIPTION-->
                  <div id="forms-settings-general" class="tab-pane fade show active">
                    <div class="card">
                      <div class="card-content">
                        <div class="d-flex w-100 justify-content-between">
                          <h3>General Settings</h3>
                          <button id="btnSaveGeneralSettings" class="btn btn-success">Save Changes</button>
                        </div>
                        <hr/>

                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#forms-settings-general-description-content" >Description</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#forms-settings-general-operations-content" >Operations</a>
                          </li>
                        </ul>

                        <div class="tab-content">
                          <div class="tab-pane fade show active" id="forms-settings-general-description-content">
                            <h4>Description</h4>
                            <div class="form-group">
                              <label for="txtFormName">Form Name:</label>
                              <input type="text" name="txtFormName" id="txtFormName" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="txtPrivateNotes">Private Notes:</label>
                              <textarea class="form-control" name="txtPrivateNotes" id="txtPrivateNotes" rows="3" ></textarea>
                            </div>
                            <div class="form-group">
                              <label for="txtSocialDescription">Social Description:</label>
                              <textarea class="form-control" name="txtSocialDescription" id="txtSocialDescription" rows="3" ></textarea>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="forms-settings-general-operations-content">
                            <h4>Operations</h4>
                            <div class="card">
                              <div class="card-content">
                                <div class="form-check">
                                  <input type="checkbox" name="txtFormToggleStart" id="txtFormToggleStart" >
                                  <label for="txtFormToggleStart">Use Start Date..</label>
                                  <small class="form-text text-muted">Open this form after this date</small>
                                  <blockquote class="blockquote" id="form-start-date-options">
                                    <div class="form-row">
                                      <div class="form-group">
                                        <label for="#txtStartDate">Start Date</label>
                                        <input type="date" class="form-control" name="txtStartDate" id="txtStartDate">
                                      </div>
                                      <div class="form-group">
                                        <label for="#txtStartTime">Start Time</label>
                                        <input type="time" name="txtStartTime" id="txtStartTime" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="$txtMessageTitle">Message Title</label>
                                      <input type="text" name="txtStartMessageTitle" id="txtStartMessageTitle" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label for="#txtMessageContent">Message:</label>
                                      <textarea name="txtStartMesasgeContent" class="form-control" id="txtStartMessageContent" cols="30" rows="10"></textarea>
                                    </div>
                                  </blockquote>
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-content">
                                <div class="form-check">
                                  <input type="checkbox" name="txtFormToggleEnd" id="txtFormToggleEnd">
                                  <label for="txtFormToggleEnd">Use End Date..</label>
                                  <small class="form-text text-muted">Close this form after this date</small>
                                  <blockquote class="blockquote" id="form-end-date-options">
                                    <div class="form-row">
                                      <div class="form-group">
                                        <label for="#txtEndDate">End Date</label>
                                        <input type="date" class="form-control" name="txtEndDate" id="txtEndDate">
                                      </div>
                                      <div class="form-group">
                                        <label for="#txtEndTime">End Time</label>
                                        <input type="time" class="form-control" name="txtEndTime" id="txtEndTime">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="#txtEndMessageTitle">Message Title</label>
                                      <input type="text" name="txtEndMessageTitle" id="txtEndMessageTitle" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label for="#txtEndMessageContent">Message:</label>
                                      <textarea name="txtEndMessageContent" class="form-control" id="txtEndMessageContent" cols="30" rows="10"></textarea>
                                    </div>
                                  </blockquote>
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-content">
                                <div class="form-check">
                                  <input type="checkbox" name="txtFormToggleResult" id="txtFormToggleResult" >
                                  <label for="txtFormToggleResult">Use Results Limit..</label>
                                  <small class="form-text text-muted">Close this form after this many stored results</small>
                                  <blockquote class="blockquote" id="form-results-options">
                                  
                                    <div class="form-group">
                                      <label for="#txtResultsLimit">Results Limit</label>
                                      <input type="number" class="form-control" name="txtResultsLimit" id="txtResultsLimit">
                                    </div>

                                    <div class="form-group">
                                      <label for="#txtResultsMessageTitle">Message Title</label>
                                      <input type="text" name="txtResultsMessageTitle" id="txtResultsMessageTitle" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label for="#txtResultsMessageContent">Message:</label>
                                      <textarea name="txtResultsMessageContent"id="txtResultsMessageContent" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                  </blockquote>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>



                        <hr/>
                      </div>
                    </div>
                  </div>
                  
                  <!-- SETTINGS: SUCCESS PAGES -->
                  <div id="forms-settings-success-pages" class="tab-pane fade">
                    <div class="card">
                      <div class="card-content">
                        <div class="d-flex w-100 justify-content-between">
                          <h3>Success Pages</h3>
                          <button id="btnSaveSuccessPages" class="btn btn-success">Save Settings</button>
                        </div>
                        <hr/>
                        

                        <blockquote class="blockquote my-2">
                          <div class="form-group">
                            <label for="txtRedirectLink">Redirect URL:</label>
                            <input type="text" name="txtRedirectLink" id="txtRedirectLink" class="form-control" placeholder="https://">
                          </div>

                          <div class="form-group">
                            <label for="txtSuccessTitle">Heading Title</label>
                            <input type="text" name="txtSuccessTitle" id="txtSuccessTitle" class="form-control">
                          </div>

                          <div class="form-group">
                            <label for="txtSuccessMessage">Message</label>
                            <textarea name="txtSuccessMessage" id="txtSuccessMessage" cols="30" rows="10" class="form-control"></textarea>
                          </div>
                          
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="chkSubmitResponse" id="chkSubmitAnotherResponse" class="custom-control-input">
                            <label class="custom-control-label" for="chkSubmitAnotherResponse">Show 'Submit another response' button</label>
                          </div>
                        </blockquote>
                        
                      </div>
                    </div>
                  </div>
                  <!-- SETTINGS: CUSTOM TEXT -->
                  <div id="forms-settings-custom-text" class="tab-pane fade">
                    <div class="card">
                      <div class="card-content">
                        <h3>Custom Text</h3>
                        <hr/>
                        Coming soon
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            
          </div>

          <!-- FORM SHARE -->
          <div id="form-editor-share" class="form-editor-settings-window tab-pane fade ">
            <div class="row">
              <div class="col-xs col-md-3">
                <div class="list-group">
                  <a class="list-group-item list-group-item-action active" data-toggle="list" href="#forms-share-links" >Links</a>
                  <!-- <li class="list-group-item list-group-item-action">Embed Code</li>
                  <li class="list-group-item list-group-item-action">Wordpress</li>
                  <li class="list-group-item list-group-item-action">QR Code</li> -->
                </div>
              </div>
              <div class="col-xs col-md-9">
                <dsiv id="windowShareWrapperContent">
                  <div id="forms-share-links" class="tab-pane fade show active">
                    
                    <div class="card">
                      <div class="card-content">

                      <h4>Links</h4>
                      <hr/>

                      <div class="form-group">
                        <label for="txtShareLink">Form Link</label>
                        <input type="text" name="txtSharableLink" id="txtSharableLink" class="form-control" value="<?= base_url()?>form/<?=$form->forms_id?>" readonly>
                        <div class="d-flex w-100 justify-content-between">
                          <div class="btn-group">
                            <button class="btn btn-link"><i class="fa fa-copy"></i> Copy</button>
                            <button class="btn btn-link"><i class="fa fa-eye"></i> View</button>
                          </div>
                          <div class="btn-group">
                            <button class="btn btn-link">Facebook Share</button>
                            <button class="btn btn-link">Tweet</button>
                          </div>
                        </div>

                      </div>

                      </div>
                    </div>

                  </div>
                </dsiv>
              </div>
            </div>
          </div>

          <!-- FORM RESULTS -->
          <div id="form-editor-results" class="form-editor-settings-window tab-pane fade ">
            <div class="row">

              <div class="col-xs-12 col-md-3">
                <div id="form-settings-menu" class="list-group sticky-top">
                  <a class="list-group-item list-group-item-action active" data-toggle="list" href="#forms-results-table" >Results Table</a>
                </div>
              </div>

              <div class="col-xs-12 col-md-9">
                <div class="tab-content">
                  <div id="forms-results-table" class="tab-pane fade show active">
                    <div class="card">
                      <div class="card-content">
                        <h3>Results Table</h3>
                        <hr/>
                        
                        
                          <div class="row">
                            <?php 
                              $i = 0;
                              $answerSessionKeys = array_unique(array_map(function($answer){
                                return $answer->fa_session_id;
                              }, $answers));
                              
                              if(empty($answers)){
                                ?>
                                  <div class="alert alert-secondary w-100">
                                    <p class="text-center w-100">There are no entries to this form yet. </p>
                                  </div>
                                <?php
                              }else{
                                foreach($answerSessionKeys as $key => $sessionKey){
                                  $i++;
                                  ?>
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                      <div class="card">
                                        <div class="card-body">
                                          <h3 class="p-0 m-0">#<?= $i?>:</h3>
                                          
  
                                          <?php 
                                            usort($elements, function($a, $b){
                                              return $b->fe_order < $a->fe_order;
                                            });
  
                                            foreach($elements as $elementKey => $element){
                                              
                                              ?>
                                                <small><?= $element->fe_label?>: </small>
                                                <?php 
                                                  foreach($answers as $answerKey => $answer){
                                                    if($answer->fa_element_id == $element->fe_id && $answer->fa_session_id == $sessionKey){
                                                        switch($element->fe_element_id){
                                                          case 3:
                                                            ?>
                                                              <li> - <?= $answer->fa_value?></li>
                                                            <?php
                                                            break;
                                                          case 7:
                                                            ?>
                                                              <b><?= date("F d ,Y", strtotime($answer->fa_value))?></b>
                                                            <?php
                                                            break;
                                                          default:
                                                            ?><b><?= ( empty($answer->fa_value ) )? `<span class="text-danger">No value</span>` : $answer->fa_value?></b><?php
                                                            break;
                                                        }
                                                    }
                                                  }
                                                ?>
                                                
                                                <br/>
                                              <?php
                                            }
                                          
                                            // foreach($answers as $answerKey => $answer){
                                            //   if($answer->fa_session_id == $sessionKey){
                                            //     var_dump($answer);
                                            //   }
                                            // }
                                          ?>
                                        </div>
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
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
      

    </div>
  </div>
</div>








<!-- EDIT SETTINGS MODAL -->
<div class="modal fade" id="modalElementSettings" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex w-100 justify-content-between">
          <h3 class="modal-title">Edit Element</h3>
          <button class="btn btn-sm btn-success" onclick="saveElementSettings()" data-dismiss="modal">Save Settings</button>
        </div>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="modalElementSettingsLoadingContent" style="min-height: 800px;">
          Loading.. Please Wait..
        </div>

        <div id="modalElementSettingsContent" style="display: none; min-height: 800px;">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="#modal-element-settings-settings" class="nav-link active" data-toggle="tab">
                Settings
              </a>
            </li>
            <li class="nav-item">
              <a href="#modal-element-settings-default-value" class="nav-link" data-toggle="tab">
                Default Value
              </a>
            </li>
            <li class="nav-item">
              <a href="#modal-element-settings-rules" class="nav-link" data-toggle="tab">
                Rules
              </a>
            </li>
            <li class="nav-item">
              <a href="#modal-element-settings-calculations" class="nav-link" data-toggle="tab">
                Calculations
              </a>
            </li>
          </ul>

          <div class="tab-content">

            <div id="modal-element-settings-settings" class="tab-pane fade show active">
              
              <div class="form-group">
                <label for="txtElementSettingsFieldLabel" class="form-label">Field Label:</label>
                <textarea type="text" name="txtElementSettingsFieldLabel" id="txtElementSettingsFieldLabel" class="form-control" ></textarea>
              </div>

              <div class="row">

                <div class="col-xs-12 col-md-6">
                  <div id="modal-element-settings-text-section">
                    <h4>Text Field</h4>
                    <hr/>

                    <div class="form-group">
                      <label for="txtElementSettingsPlaceholderText">Placeholder Text</label>
                      <input type="text" name="txtElementSettingsPlaceholderText" id="txtElementSettingsPlaceholderText" class="form-control">
                    </div>
                    
                    <div class="form-group">
                      <label for="txtElementSettingsLength">Validation Type</label>
                      <select name="txtElementSettingsValidation" id="txtElementSettingsValidation" class="custom-select">
                        <option value="">None</option>
                        <option value="">Text-only</option>
                        <option value="">Number</option>
                        <option value="">Alpha-Numeric</option>
                        <option value="">CC Expiration Date</option>
                        <option value="">URL</option>
                        <option value="">Phone Number</option>
                        <option value="">US Phone Number</option>
                        <option value="">Currency</option>
                        <option value="">Whole Number</option>
                      </select>
                    </div>
                  </div>

                  <div id="modal-element-settings-images-section">
                    <h4>Image</h4>
                    <hr/>

                    <div class="tab-content">

                      <div class="tab-pane fade show active" id="choices-add-choice">
                        <div class="form-group">
                          <span id="elementSettingsImageText">Current Image: </span>
                          <img src="<?= base_url()?>uploads/formbuilder/db/img/img_450_9.jpg" class="img-thumbnail">
                          <input type="file" name="fileElementImage" id="fileElementImage" class="form-control-file" onchange="uploadImage()">
                        </div>
                      </div>

                    </div>

                  </div>
                  

                  <div id="modal-element-settings-choices-section">
                    <h4>Choices</h4>
                    <hr/>

                    <div class="tab-content">

                      <div class="tab-pane fade show active" id="choices-add-choice">
                        <div class="form-group">
                          <textarea name="txtElementChoices" id="txtElementChoices" cols="30" rows="10" class="form-control"></textarea>
                          <small class="text-muted">Separated by spaces</small>
                        </div>
                      
                      </div>

                    </div>

                  </div>
                  
                  <div id="modal-element-settings-choices-row-section" style="display: none">
                    <h4>Rows</h4>
                    <hr/>
                    <div class="tab-content">

                      <div class="tab-pane fade show active" id="choices-add-choice">
                        <div class="form-group">
                          <textarea name="txtElementChoicesRow" id="txtElementChoicesRow" cols="30" rows="10" class="form-control"></textarea>
                          <small class="text-muted">You can place values to each box, just separate them by a coma</small>
                          <small class="text-muted">Separated by spaces</small>
                        </div>
                      
                      </div>

                    </div>


                  </div>

                </div>
                
                <div class="col-xs-12 col-md-6">
                  <div id="modal-element-settings-choices-column-section"  style="display: none">
                    <h4>Columns</h4>
                    <hr/>
                    <div class="tab-content">

                      <div class="tab-pane fade show active" id="choices-add-choice">
                        <div class="form-group">
                          <textarea name="txtElementChoicesColumn" id="txtElementChoicesColumn" cols="30" rows="10" class="form-control"></textarea>
                          <small class="text-muted">You can place values to each box, just separate them by a coma</small>  
                          <small class="text-muted">Separated by spaces</small>
                        </div>
                      
                      </div>

                    </div>


                  </div>
                  <h4>Style</h4>
                  <hr/>
                  <div class="form-group">
                    <label for="selElementSize">Element Size</label>
                    <select name="selElementSize" id="selElementSize" class="custom-select">
                      <option value="5">0.5</option>
                      <option value="1">1</option>
                      <option value="6">2</option>
                      <option value="2">3</option>
                      <option value="3">4</option>
                      <option value="4">5</option>
                    </select>
                  </div>


                  <h4>Options</h4>
                  <hr/>
                  
                  <div class="form-check">
                    <input type="checkbox" name="chkElementSettingsRequired" id="chkElementSettingsRequired" class="form-check-input">
                    <label for="chkElementSettingsRequired">Required</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="chkElementSettingsReadonly" id="chkElementSettingsReadonly" class="form-check-input">
                    <label for="chkElementSettingsReadonly">Read-Only</label>
                  </div>

                  <h5>Question Position</h5> 
                  <div class="form-check">
                    <input type="radio" name="radElementSettingsQuestionPosition" value="1" id="selectedUserElement" class="form-check-input">
                    <label for="radElementSettingsQuestionPosition">Top</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" name="radElementSettingsQuestionPosition" value="2" id="selectedUserElement" class="form-check-input">
                    <label for="radElementSettingsQuestionPosition">Left</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" name="radElementSettingsQuestionPosition" value="3" id="selectedUserElement" class="form-check-input">
                    <label for="radElementSettingsQuestionPosition">Right</label>
                  </div>
                  
                </div>
              </div>

            </div>

            <div id="modal-element-settings-default-value" class="tab-pane fade">
              <div class="row">
                <div class="col-xs-12 col-md-12">
                  <div class="form-group">
                    <h4>Default Values</h4>
                    <hr/>
                    <label for="txtElementSettingsDefaultValue">Default Value:</label>
                    <input type="text" name="txtElementSettingsDefaultValue" id="txtElementSettingsDefaultValue" class="form-control">
                  </div>
                </div>
              </div>
            </div>

            <div id="modal-element-settings-rules" class="tab-pane fade">
              <h4>Display Rules</h4>
              <hr/>
              <p>Conditionally show or hide this item. Use this page to configure rules for all items at once.</p>
              <div class="card">
                <div class="card-content">
                  <label>Item #1</label>
                  <div class="card">
                    <div class="card-content">

                      <div class="form-row ">
                        <div class="col-auto">
                          <select name="asfd" id="asdf" class="custom-select">
                            <option value="1">show</option>
                            <option value="1">hide</option>
                          </select>
                        </div>
                        <div class="col-auto">
                          this item when 
                        </div>
                        <div class="col-auto">
                          <select name="asfd" id="asdf" class="custom-select">
                            <option value="1">all</option>
                            <option value="1">any</option>
                          </select>
                        </div>
                        <div class="col-auto">
                          of it's criteria match:
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <select name="asdf" id="asdf" class="custom-select">
                          <option value="sss">always</option>
                          <option value="sss">page 1</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <button class="btn btn-success">+</button>
                      <button class="btn btn-danger">-</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div id="modal-element-settings-calculations" class="tab-pane fade">
              <div class="row">
                <div class="col-xs-12 col-md-6">
                  <h4>Calculation Values</h4>
                  <hr/>
                  <p>Assign values for:</p>
                  <div class="form-check">
                    <input type="radio" name="radCalculationValues" id="radCalculationOption1" class="form-check-input">
                    <label for="radCalculationOption1">Entire Item</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" name="radCalculationValues" id="radCalculationOption2" class="form-check-input">
                    <label for="radCalculationOption2">Each Choice</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" name="radCalculationValues" id="radCalculationOption3" class="form-check-input">
                    <label for="radCalculationOption3">Directly</label>
                  </div>
                  <p>The number that users enter will be the value.</p>
                </div>
                <div class="col-xs-12 col-md-6">
                  <h4>Scoring</h4>
                  <hr/>
                  <div class="form-check">
                    <input type="checkbox" name="chkElementSettingsScoringCheck" id="chkElementSettingsScoringCheck" class="form-check-input">
                    <label for="chkElementSettingsScoringCheck">Enable Scoring</label>
                    <small>Include Value in Scoring total.</small>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

      
    </div>
  </div>
</div>



<script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/js/formbuilder.js"></script>
<script src="<?= base_url()?>/assets/formbuilder/js/jquery-sortable.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
  var reader = new FileReader()
  var formUserElements = document.getElementsByClassName('form-user-elements');
  let userFormData = {}
  let selectedElement = 0;
  let selectedUserElement = {};
  var operationsWindow = {
    showStartOptions: false,
    showEndOptions: false,
    showResultOptions: false
  }
  let elementChoices = []
  
  // task upload image

  document.querySelector('#btnEditorScrollDown').addEventListener('click', ()=>{
    document.querySelector('#windowPreviewContent').scrollTo(0, 99999999);
  })

  toggleElementSettings = (elementId, value) => {
    document.querySelector('#form-elements-settings-' + elementId).style.display = (value == 1)? "block" : "none"
  }

  copyElement = elementId => {
    
    $.ajax({
      url: `${formBaseUrl}formbuilder/form/element/get/<?= $form->forms_id?>/${elementId}`,
      dataType: 'json',
      type: 'GET',
      success: function(res){
        let data = {
          "fe_form_id": <?= $form->forms_id?>,
          "fe_element_id": res.data.fe_element_id,
          "fe_label": res.data.fe_label,
          "fe_is_required": res.data.fe_is_required,
          "fe_is_readonly": res.data.fe_is_readonly,
          "fe_default_value": res.data.fe_default_value,
          "fe_placeholder_text": res.data.fe_placeholder_text,
          "fe_span": res.data.fe_span,
          "fe_order": formUserElements.length + 1
        }

        $.ajax({
          url: "<?= base_url()?>formbuilder/form/element/add",
          data: data,
          dataType: 'json',
          type: 'POST',
          success: function(res){
            
            loadFormSettings(<?= $form->forms_id?>);
            loadFormElements(<?= $form->forms_id?>, "edit");
            return;
          }
        })
      }
    })

    
  }

  editElement = elementId => {
    // opens up an interface of the element, allowing users
    // to make changes to a single element

    $('#modalElementSettings').modal('show')
    document.querySelector('#modalElementSettingsContent').style.display = "none"
    document.querySelector('#modalElementSettingsLoadingContent').style.display = "block"
    $.ajax({
      url: `${formBaseUrl}formbuilder/form/element/get/<?= $form->forms_id?>/${elementId}`,
      dataType: 'json',
      type: 'GET',
      success: function(res){
        element = res.form_elements;
        
        document.querySelector('#txtElementSettingsFieldLabel').value = element.fe_label;
        document.querySelector('#txtElementSettingsPlaceholderText').value = element.fe_placeholder_text;
        document.querySelector('#txtElementSettingsDefaultValue').value = element.fe_default_value;
        document.querySelector('#selElementSize').value = element.fe_span;
        document.querySelector('#chkElementSettingsRequired').checked = (element.fe_is_required == 1)? true : false;
        document.querySelector('#chkElementSettingsReadonly').checked = (element.fe_is_readonly == 1)? true : false;
        document.querySelector('#chkElementSettingsScoringCheck').checked = (element.fe_enable_score == 1)? true : false;
        // document.querySelector('#radElementSettingsQuestionPosition').value = element.fe_question_position;
        
        if(element.fe_element_id == 1 || element.fe_element_id == 2 || element.fe_element_id == 3 ){
          choices = JSON.parse($.ajax({
            url: `${formBaseUrl}formbuilder/form/element/choices/${element.fe_id}`,
            dataType: 'json',
            type: 'GET',
            async: false
          }).responseText).data;
          document.querySelector("#txtElementChoices").value = choices.map(choice => `${choice.fc_choice}`).join("\n")
        }else if(element.fe_element_id > 43 ){
          choices = JSON.parse($.ajax({
            url: `${formBaseUrl}formbuilder/form/element/choices/${element.fe_id}`,
            dataType: 'json',
            type: 'GET',
            async: false
          }).responseText).data;

          rowChoices = choices.filter(choice => {
            return choice.fc_column == null;
          }).sort((a,b)=>{
            return a.fc_row < b.fc_row;
          })
          columnChoices = choices.filter(choice => {
            return choice.fc_row == null;
          }).sort((a,b)=>{
            return a.fc_column < b.fc_column;
          })

          document.querySelector("#txtElementChoicesRow").value = rowChoices.map(choice => `${choice.fc_choice}`).join("\n")
          document.querySelector("#txtElementChoicesColumn").value = columnChoices.map(choice => `${choice.fc_choice}`).join("\n")
        }else{
          document.querySelector("#txtElementChoices").value = ""
        }

        document.querySelector('#modal-element-settings-choices-section').style.display = "none"
        document.querySelector('#modal-element-settings-text-section').style.display = "none"
        document.querySelector('#modal-element-settings-choices-row-section').style.display = "none"
        document.querySelector('#modal-element-settings-choices-column-section').style.display = "none"
        if(element.fe_element_id == 1 || element.fe_element_id == 2 || element.fe_element_id == 3){
          document.querySelector('#modal-element-settings-choices-section').style.display = "block"
        }
        
        if(element.fe_element_id == 4 || element.fe_element_id == 5 || element.fe_element_id == 6 || element.fe_element_id == 7 || element.fe_element_id == 8){
          document.querySelector('#modal-element-settings-text-section').style.display = "block"
        }
        
        if(element.fe_element_id == 44 || element.fe_element_id == 45 || element.fe_element_id == 46 || element.fe_element_id == 47 || element.fe_element_id == 48 || element.fe_element_id == 50 ||element.fe_element_id == 53 ){
          document.querySelector('#modal-element-settings-choices-row-section').style.display = "block"
          document.querySelector('#modal-element-settings-choices-column-section').style.display = "block"
        }

        
        console.log(element);
        if(element.fe_element_id == 15 ){
          document.querySelector('#modal-element-settings-images-section').style.display = "block"
        }else{
          document.querySelector('#modal-element-settings-images-section').style.display = "none"
        }


      }
    })

    setTimeout(() => {
      selectedUserElement = element;
      document.querySelector('#modalElementSettingsLoadingContent').style.display = "none"
      document.querySelector('#modalElementSettingsContent').style.display = "block"
    }, 1000);
    
    
  }

  deleteElement = elementId => {
    
    $.ajax({
      url: `${formBaseUrl}formbuilder/form/element/delete/${elementId}`,
      dataType: 'json',
      type: 'GET',
      success: function(res){

        
        loadFormSettings(<?= $form->forms_id?>);
        loadFormElements(<?= $form->forms_id?>, "edit");
        return;
        
      }
    })
  }
  
  saveElementSettings = () => {
    let imgFiles = document.querySelector('#fileElementImage').files

    let data = {
      "fe_label": document.querySelector('#txtElementSettingsFieldLabel').value,
      "fe_placeholder_text": document.querySelector('#txtElementSettingsPlaceholderText').value,
      "fe_default_value": document.querySelector('#txtElementSettingsDefaultValue').value,
      "fe_span": document.querySelector('#selElementSize').value,
      "fe_is_required": (document.querySelector('#chkElementSettingsRequired').checked === true)? 1 : 0,
      "fe_is_readonly": (document.querySelector('#chkElementSettingsReadonly').checked === true)? 1 : 0,
      "fe_enable_score": (document.querySelector('#chkElementSettingsScoringCheck').checked === true)? 1 : 0,
      // "fe_question_position": document.querySelector('#radElementSettingsQuestionPosition').value,
    }

    
    
    if(imgFiles.length != 0){
      let imgData = {
        "form_id": <?= $form->forms_id?>,
        "element_id": selectedUserElement.fe_id,
        "name": imgFiles[0].name
      }


      
      $.ajax({
        url: `${formBaseUrl}formbuilder/form/element/images/add`,
        data: imgData,
        dataType: 'json',
        type: 'POST',
        success: function(res){
                
          $.ajax({
            url: `${formBaseUrl}formbuilder/form/element/images/upload`,
            data: imgFiles[0],
            dataType: 'json',
            type: 'POST',
            success: function(res){
              console.log("test");
              imgFiles = null;
            }
          })
        }
      })

    }

    $.ajax({
      url: `${formBaseUrl}formbuilder/form/element/update/${selectedUserElement.fe_id}`,
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function(res){
        const values = document.querySelector("#txtElementChoices").value.split("\n");
        const valuesRow = document.querySelector("#txtElementChoicesRow").value.split("\n");
        const valuesColumn = document.querySelector("#txtElementChoicesColumn").value.split("\n");
        
        
        if(values != ""){
          
          $.ajax({
            url: `${formBaseUrl}formbuilder/form/element/choices/delete/${selectedUserElement.fe_id}`,
            dataType: 'json',
            type: 'POST',
            success: function(res){
              
              values.map( value => {
                let choicesdata = {
                  "fc_element_id": selectedUserElement.fe_id,
                  "fc_choice": value,
                  "fc_is_correct_answer": 0
                }
                
                $.ajax({
                  url: `${formBaseUrl}formbuilder/form/element/choices/add`,
                  data: choicesdata,
                  dataType: 'json',
                  type: 'POST',
                  success: function(){
                    
                    $('#modalElementSettings').modal('hide')
                  }
                })
              })
            }
          })
        }else if(valuesRow != '' && valuesColumn != ''){
          
          $.ajax({
            url: `${formBaseUrl}formbuilder/form/element/choices/delete/${selectedUserElement.fe_id}`,
            dataType: 'json',
            type: 'POST',
            success: function(res){
              valuesRow.map( (value, key) => {
                let choicesdata = {
                  "fc_element_id": selectedUserElement.fe_id,
                  "fc_choice": value,
                  "fc_is_correct_answer": 0,
                  "fc_row": key
                }

                if(value == ""){
                  choicesdata.choice = null
                }
                
                if(value.includes(',')){
                  value = value.split(',');
                  value.map((a, i)=>{
                    choicesdata.fc_choice = a;
                    choicesdata.fc_column = i;
                    $.ajax({
                      url: `${formBaseUrl}formbuilder/form/element/choices/add`,
                      data: choicesdata,
                      dataType: 'json',
                      type: 'POST',
                      success: function(){
                        return
                      }
                    })
                  })
                }else{
                  $.ajax({
                    url: `${formBaseUrl}formbuilder/form/element/choices/add`,
                    data: choicesdata,
                    dataType: 'json',
                    type: 'POST',
                    success: function(){
                      return
                    }
                  })
                }
                
              })

              valuesColumn.map( (value, key) => {
                let choicesdata = {
                  "fc_element_id": selectedUserElement.fe_id,
                  "fc_choice": value,
                  "fc_is_correct_answer": 0,
                  "fc_column": key
                }
                
                
                if(value == ""){
                  choicesdata.choice = null
                }

                $.ajax({
                  url: `${formBaseUrl}formbuilder/form/element/choices/add`,
                  data: choicesdata,
                  dataType: 'json',
                  type: 'POST',
                  success: function(){
                    return
                  }
                })
              })

            }
          })
        }

        loadFormSettings(<?= $form->forms_id?>);
        loadFormElements(<?= $form->forms_id?>, "edit");
        $('#modalElementSettings').modal('hide')

      }

    })

    

  }
  
  window.onload = () => {
    loadFormSettings(<?= $form->forms_id?>);
    loadFormElements(<?= $form->forms_id?>, "edit");
  };

  document.querySelector('#btnSaveGeneralSettings').addEventListener('click', () => {
    let data = {
      "forms_title": document.querySelector('#txtFormName').value,
      "forms_private_note": document.querySelector('#txtPrivateNotes').value,
      "forms_social_desc": document.querySelector('#txtSocialDescription').value,
      "forms_use_start_date": (document.querySelector('#txtFormToggleStart').checked === true) ? 1 : 0,
      "forms_use_closing_date": (document.querySelector('#txtFormToggleEnd').checked === true) ? 1 : 0,
      "forms_use_results_limit": (document.querySelector('#txtFormToggleResult').checked === true) ? 1 : 0,
      "forms_start_date": document.querySelector('#txtStartDate').value,
      "forms_start_time": document.querySelector('#txtStartTime').value,
      "forms_start_title": document.querySelector('#txtStartMessageTitle').value,
      "forms_start_message": document.querySelector('#txtStartMessageContent').value,
      "forms_end_date": document.querySelector('#txtEndDate').value,
      "forms_end_time": document.querySelector('#txtEndTime').value,
      "forms_end_title": document.querySelector('#txtEndMessageTitle').value,
      "forms_end_message": document.querySelector('#txtEndMessageContent').value,
      "forms_results_limit": document.querySelector('#txtResultsLimit').value,
      "forms_results_max_title": document.querySelector('#txtResultsMessageTitle').value,
      "forms_results_max_message": document.querySelector('#txtResultsMessageContent').value,
      "forms_title_font_family": document.querySelector('#txtEndMessageContent').value,
      "forms_title_font_size": document.querySelector('#txtResultsLimit').value,
      "forms_label_font_family": document.querySelector('#txtResultsMessageTitle').value,
      "forms_label_font_family": document.querySelector('#txtResultsMessageContent').value,
    };
    
    $.ajax({
      url: "<?= base_url()?>formbuilder/form/update/<?=$form->forms_id?>",
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function(res){
        window.alert("general settings saved")
        loadFormSettings();
        return;
      }
    })
  });

  document.querySelector('#btnSaveSuccessPages').addEventListener('click', () => {
    let data = {
      'forms_redirect_link': document.querySelector('#txtRedirectLink').value,
      'forms_success_title': document.querySelector('#txtSuccessTitle').value,
      'forms_success_message': document.querySelector('#txtSuccessMessage').value,
      'forms_show_repeat_form_check': (document.querySelector('#chkSubmitAnotherResponse').checked === true)? 1 : 0
    }

    $.ajax({
      url: "<?= base_url()?>formbuilder/form/update/<?=$form->forms_id?>",
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function(res){
        window.alert('success pages saved');
        loadFormSettings();
        return;
      }
    })
  });

  $('.form-user-elements').draggable({
    // snap: "#windowPreviewTemplate",
    scroll: false,
    revert: "valid",
    helper: "clone",
    appendTo: "#windowPreviewContent",
    snap: "#windowPreviewContent",
    snapMode: "inner",
    grid: [20, 20],
  })

  $('.form-elements-draggable').draggable({
    // snap: "#windowPreviewTemplate",
    scroll: false,
    revert: "valid",
    helper: "clone",
    appendTo: "#windowPreviewContent",
    snap: "#windowPreviewContent",
    snapMode: "inner",
    grid: [20, 20],
    start: function(event, ui){
      selectedElement = elementsList.findIndex((item) => {
        return item.id == event.target.dataset.elementId;
      });
    },
    stop: function(event){
      selectedElement = 0
    }    
  });

  $('#windowPreviewContent').sortable({
    placeholder: 'col-xs-12 col-sm-3  bg-light card',
    nested: true,
    update: function(event, ui){
      $(this).sortable("toArray").map((item, i)=>{
        let id = item.split('-')[2];
        let data = {
          "fe_order": i + 1
        }
        $.ajax({
          url: "<?= base_url()?>formbuilder/form/element/update/" + id,
          data: data,
          dataType: 'json',
          type: 'POST',
          success: function(res){
            document.querySelector("#windowPreviewContent").innerHTML = "";
            return;
          }
        })
      })
      loadFormElements(<?= $form->forms_id?>, "edit");
      
    }
  });

  $('#windowPreviewContent').disableSelection();

  $('#windowPreviewTemplate').droppable({
    // greedy: true,
    accept: '.form-elements-draggable',
    drop: function(event, ui){
      let elementOrder = $('#windowPreviewContent').sortable("toArray");
      let data = {
        "fe_form_id": <?= $form->forms_id?>,
        "fe_element_id": selectedElement + 1,
        "fe_label": elementsList[selectedElement].type,
        "fe_is_required": 0,
        "fe_is_readonly": 0,
        "fe_default_value": null,
        "fe_placeholder_text": null,
        "fe_span": 1,
        "fe_order": formUserElements.length + 1
      }
      
      // insert switch case here
      $.ajax({
        url: "<?= base_url()?>formbuilder/form/element/add",
        data: data,
        dataType: 'json',
        type: 'POST',
        success: function(res){
          loadFormSettings(<?= $form->forms_id?>);
          loadFormElements(<?= $form->forms_id?>, "edit");
          return;
        }
      })

      
      
    }
  })

  $('.droppable').droppable({
    greedy: true,
    accept: '.form-elements-draggable',
    drop: function(event, ui){
      alert('dropped');

    }
  })

  $('.droppable').sortable({
    group: 'droppable',
    placeholder: '<div> class="droppable col-xs-12 col-sm-3 bg-light card"></div>',
    placeholderClass: 'draggable',
    nested: true,
    onDragStart: function($item, container, _super){
      alert('sort');
    },
    onDrop: function ($item, container, _super, event) {
      alert('dropped');
    }
  });

  $('#saveFormStylesBtn').on('click', () => {
    let data = {
      "forms_title": document.querySelector('#txtFormName').value,
      "forms_private_note": document.querySelector('#txtPrivateNotes').value,
      "forms_social_desc": document.querySelector('#txtSocialDescription').value,
      "forms_use_start_date": (document.querySelector('#txtFormToggleStart').checked === true) ? 1 : 0,
      "forms_use_closing_date": (document.querySelector('#txtFormToggleEnd').checked === true) ? 1 : 0,
      "forms_use_results_limit": (document.querySelector('#txtFormToggleResult').checked === true) ? 1 : 0,
      "forms_start_date": document.querySelector('#txtStartDate').value,
      "forms_start_time": document.querySelector('#txtStartTime').value,
      "forms_start_title": document.querySelector('#txtStartMessageTitle').value,
      "forms_start_message": document.querySelector('#txtStartMessageContent').value,
      "forms_end_date": document.querySelector('#txtEndDate').value,
      "forms_end_time": document.querySelector('#txtEndTime').value,
      "forms_end_title": document.querySelector('#txtEndMessageTitle').value,
      "forms_end_message": document.querySelector('#txtEndMessageContent').value,
      "forms_results_limit": document.querySelector('#txtResultsLimit').value,
      "forms_results_max_title": document.querySelector('#txtResultsMessageTitle').value,
      "forms_results_max_message": document.querySelector('#txtResultsMessageContent').value,
      "forms_title_font_family": document.querySelector('#fTFontFamily').value,
      "forms_title_font_size": document.querySelector('#fTFontSize').value,
      "forms_label_font_family": document.querySelector('#fLFontFamily').value,
      "forms_label_font_size": document.querySelector('#fLFontSize').value,
    };
    
    $.ajax({
      url: "<?= base_url()?>formbuilder/form/update/<?=$form->forms_id?>",
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function(res){
        window.alert("form styles saved");
        loadFormSettings(<?= $form->forms_id?>);
        loadFormElements(<?= $form->forms_id?>, "edit");
        return;
      }
    })
  })

</script>
<!-- 
  ELEMENTS GUIDE:

    Common Items:
      1   -   Radio Button
      2   -   Dropdown
      3   -   Checkbox
      4   -   Email Address
      5   -   Long Answer
      6   -   Short Answer
      7   -   Calendar
      8   -   Number
      9   -   File Upload
      10  -   Text List
      11  -   Rating
      12  -   Ranking
      13  -   Hidden Field
      14  -   Signature
      15  -   Image List
      16  -   Calculation
      17  -   Credit Card
      18  -   Contact Block
      19  -   Save and Return

    Formatting Items:
      20  -   Heading
      21  -   Formatted Text
      22  -   Image
      23  -   Link
      24  -   Custom Code
      25  -   Blank Space
      26  -   Page Break
    
    Email Items:
      4   -   Email Address
      28  -   Radio Button Email Routing
      29  -   Dropdown Email Routing
      30  -   Checkbox Email Routing


  
-->