
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
  
</style>

<div class="wrapper">
  <div __wrapper_section>
    <div class="card my-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>formbuilder">Form Builder</a></li>
        <li class="breadcrumb-item active"><?= $form->forms_title?></li>
      </ol>
    </nav>
    
      <div class="text-left">
        <h1><?= $form->forms_title?> <a href="<?= base_url()?>form/<?=$form->forms_id?>" class="btn btn-outline-info"><i class="fa fa-eye"></i> View Form</a></h1>
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
                                  <div class="card-content">
                                    <span><i class="fa fa-dot-circle-o"></i> Radio Button</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                              <div class="form-elements-draggable" data-element-id="2">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-caret-square-o-down"></i> Dropdown</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="3">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-check-square-o"></i> Checkbox</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                              <div class="form-elements-draggable" data-element-id="4">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-envelope"></i> Email Address</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="5">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-text-width"></i> Long Answer</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="6">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-font"></i> Short Answer</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="7">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-calendar"></i> Calendar  </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="8">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-square-o"></i> Number</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="9">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-file"></i> File Upload</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="10">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-list"></i> Text List</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="11">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-star"></i> Rating</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="12">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-bar-chart"></i> Ranking</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="13">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-square-o"></i> Hidden Field</span>
                                  </div>
                                </div>
                              </div>
                            </div> -->
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="14">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-strikethrough"></i> Signature</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="15">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-image"></i> Image List</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="16">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-calculator"></i> Calculation</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="17">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-credit-card"></i> Credit Card</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="18">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-address-book"></i> Contact Block</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="19">
                                <div class="card p-1">
                                  <div class="card-content">
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
                                  <div class="card-content">
                                    <span><i class="fa fa-dot-circle-o"></i> Heading</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                              <div class="form-elements-draggable" data-element-id="21">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-caret-square-o-down"></i> Formatted Text</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="22">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-image"></i> Image</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                              <div class="form-elements-draggable" data-element-id="23">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-link"></i> Link</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="24">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-text-width"></i> Custom Code</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="25">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-font"></i> Blank Space</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="26">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-calendar"></i> Page Break  </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    
    
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseEmailItemsMenu" aria-expanded="true" aria-controls="collapse0">
                          Email Items
                        </li>
                        <div id="collapseEmailItemsMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="row" style="overflow-x: auto; heightL 250px;">
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="4">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-calendar"></i> Email Address</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="28">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-calendar"></i> Radio Button Email Routing </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="29">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-calendar"></i> Dropdown Email Routing</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 m-0">
                              <div class="form-elements-draggable" data-element-id="30">
                                <div class="card p-1">
                                  <div class="card-content">
                                    <span><i class="fa fa-calendar"></i> Checkbox Email Routing</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    
    
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseOrderFormMenu" aria-expanded="true" aria-controls="collapse0">
                          Order Form Items
                        </li>
                        <div id="collapseOrderFormMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <p class="text-muted">Coming soon</p>
                        </div>
                    
    
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseMatrixGridMenu" aria-expanded="true" aria-controls="collapse0">
                          Matrix/Grid Items
                        </li>
                        <div id="collapseMatrixGridMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <p class="text-muted">Coming soon</p>
                        </div>
                    
    
                        <li class="list-group-item" data-toggle="collapse" data-target="#collapseItemMenu" aria-expanded="true" aria-controls="collapse0">
                          Item Blocks
                        </li>
                        <div id="collapseItemMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                          <p class="text-muted">Coming soon</p>
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
                    <h3 class="text-center text-muted">Coming soon</h3>
                  </div>
                  <div id="form-editor-rules-sidenav" class="tab-pane fade">
                    <h3 class="text-center text-muted">Coming soon</h3>
                  </div>
                </div>
                  
              </div>
              <div class="col-xs-12 col-md-9">
                <div id="windowPreviewTemplate" class="card">
                  <div class="row" id="windowPreviewContent">




                  </div>
                </div>
              </div>
            </div>

            
            <div class="modal fade" id="modalElementSettings" data-backdroup="static">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="d-flex w-100 justify-content-between">
                      <h3 class="modal-title">Edit Element</h3>
                      <button class="btn btn-sm btn-success" onclick="saveElementSettings()" data-dismiss="modal">Save Settings</button>
                    </div>
                    <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div id="modalElementSettingsLoadingContent" class="modal-body" style="min-height: 800px;">
                    Loading.. Please Wait..
                  </div>
                  <div id="modalElementSettingsContent" class="modal-body" style="display: none; min-height: 800px">
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
                          <input type="text" name="txtElementSettingsFieldLabel" id="txtElementSettingsFieldLabel" class="form-control">
                        </div>

                        <div class="row">

                          <div class="col-xs-12 col-md-6">
                            <div id="settings1">
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
                            <div id="settings2">
                              <h4>Choices</h4>
                              <hr/>
                              <ul class="nav nav-tabs">
                                <li class="nav-item">
                                  <a href="#choices-add-choice" class="nav-link active" data-toggle="tab">Add Choice</a>
                                </li>
                                <li class="nav-item">
                                  <a href="#choices-edit-choice" class="nav-link " data-toggle="tab">Edit Choice</a>
                                </li>
                              </ul>

                              <div class="tab-content">

                                <div class="tab-pane fade show active" id="choices-add-choice">
                                  <div class="form-group">
                                    <textarea name="txtElementChoices" id="txtElementChoices" cols="30" rows="10" class="form-control"></textarea>
                                    <small class="text-muted">Separated by spaces</small>
                                  </div>
                                
                                </div>
                                <div class="tab-pane fade" id="choices-edit-choice">
                                
                                  <div class="card p-0">
                                    
                                    <div class="d-flex w-100 justify-content-between">
                                      <span>choice here</span>
                                      <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </div>
                                  </div>
                                  <div class="card p-0">
                                    
                                    <div class="d-flex w-100 justify-content-between">
                                      <span>choice here</span>
                                      <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </div>
                                  </div>
                                  
                                </div>

                              </div>


                            </div>
                          </div>
                          
                          <div class="col-xs-12 col-md-6">
                            <h4>Style</h4>
                            <hr/>
                            <div class="form-group">
                              <label for="selElementSize">Element Size</label>
                              <select name="selElementSize" id="selElementSize" class="custom-select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                              </select>
                            </div>


                            <h4>Options</h4>
                            <hr/>
                            
                            <div class="form-group form-check">
                              <input type="checkbox" name="chkElementSettingsRequired" id="chkElementSettingsRequired" class="form-check-input">
                              <label for="chkElementSettingsRequired">Required</label>
                            </div>

                            <!-- should add to database -->
                            <div class="form-group form-check">
                              <input type="checkbox" name="chkElementSettingsReadonly" id="chkElementSettingsReadonly" class="form-check-input">
                              <label for="chkElementSettingsReadonly">Read-Only</label>
                            </div>

                            <h5>Question Position</h5> 
                            <!-- should add to database -->
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
                        <input type="text" name="txtSharableLink" id="txtSharableLink" class="form-control" value="<?=base_url()?>form/test" readonly>
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
                      
                        <table id="#resultsTable" class="table table-responsive table-bordered table-hover">
                          <thead>
                            <tr>
                              <th><strong>Number</strong></th>
                              <?php
                                foreach($elements as $element_key => $element){
                                  ?>
                                    <th><strong><?= $element->fe_label?></strong></th>
                                  <?php
                                }
                              ?>
                            </tr>
                          </thead>
                          
                          <tbody>
                            <?php 
                              $answerSessionKeys = array_unique(array_map(function($answer){
                                return $answer->fa_session_id;
                              }, $answers));
                            ?>
                            <?php
                              foreach($answerSessionKeys as $key => $sessionKey){
                                ?>
                                  <tr>
                                    <td><?= $key ?></td>
                                    <?php
                                      foreach($answers as $answer_key => $answer){
                                        if($answer->fa_session_id == $sessionKey){
                                          // update this part
                                          foreach($elements as $element_key => $element){
                                            if($element->fe_id == $answer->fa_element_id){
                                              ?>
                                                <td><?= $answer->fa_value?></td>
                                              <?php
                                            }
                                          }
                                        }
                                      }
                                    ?>
                                  </tr>
                                <?php
                              }
                            ?>
                          </tbody>
                        </table>


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

<script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="<?= base_url()?>/assets/js/formbuilder.js"></script>
<script>
  var formUserElements = document.getElementsByClassName('form-user-elements');
  let userFormData = {}
  let selectedElement = 0;
  let selectedUserElement = {};
  var operationsWindow = {
    showStartOptions: false,
    showEndOptions: false,
    showResultOptions: false
  }
  
  // this function runs upon page load
  loadFormSettings = id => {
    $.ajax({
      url: `${formBaseUrl}formbuilder/form/view/${id}`,
      dataType: 'json',
      type: 'GET',
      success: function(res){
        document.querySelector('#txtFormName').value = res.data.forms_title
        document.querySelector('#txtPrivateNotes').value = res.data.forms_private_note
        document.querySelector('#txtSocialDescription').value = res.data.forms_social_desc
        document.querySelector('#txtFormToggleStart').checked = (res.data.forms_use_start_date == 1)? true : false
        document.querySelector('#txtFormToggleEnd').checked = (res.data.forms_use_closing_date == 1)? true : false
        document.querySelector('#txtFormToggleResult').checked = (res.data.forms_use_results_limit == 1)? true : false
        document.querySelector('#txtStartDate').value = res.data.forms_start_date
        document.querySelector('#txtStartTime').value = res.data.forms_start_time
        document.querySelector('#txtStartMessageTitle').value = res.data.forms_start_title
        document.querySelector('#txtStartMessageContent').value = res.data.forms_start_message
        document.querySelector('#txtEndDate').value = res.data.forms_end_date
        document.querySelector('#txtEndTime').value = res.data.forms_end_time
        document.querySelector('#txtEndMessageTitle').value = res.data.forms_end_title
        document.querySelector('#txtEndMessageContent').value = res.data.forms_end_message
        document.querySelector('#txtResultsLimit').value = res.data.forms_results_limit
        document.querySelector('#txtResultsMessageTitle').value = res.data.forms_results_max_title
        document.querySelector('#txtResultsMessageContent').value = res.data.forms_results_max_message
        document.querySelector('#txtResultsMessageContent').value = res.data.forms_results_max_message
        
        document.querySelector('#txtRedirectLink').value = res.data.forms_redirect_link
        document.querySelector('#txtSuccessTitle').value = res.data.forms_success_title
        document.querySelector('#txtSuccessMessage').value = res.data.forms_success_message
        document.querySelector('#chkSubmitAnotherResponse').checked = (res.data.forms_show_repeat_form_check == 1)? true : false
        
        
        return;
      }
    })
  }


    

  toggleElementSettings = (elementId, value) => {
    document.querySelector('#form-elements-settings-' + elementId).style.display = (value == 1)? "block" : "none"
  }

  copyElement = elementId => {
    
    $.ajax({
      url: `${formBaseUrl}formbuilder/form/element/get/<?= $form->forms_id?>/${elementId}`,
      dataType: 'json',
      type: 'GET',
      success: function(res){
        // console.log(res.data)
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
        element = res.data;
        
        document.querySelector('#txtElementSettingsFieldLabel').value = element.fe_label;
        document.querySelector('#txtElementSettingsPlaceholderText').value = element.fe_placeholder_text;
        document.querySelector('#txtElementSettingsDefaultValue').value = element.fe_default_value;
        document.querySelector('#selElementSize').value = element.fe_span;
        document.querySelector('#chkElementSettingsRequired').checked = (element.fe_is_required == 1)? true : false;
        document.querySelector('#chkElementSettingsReadonly').checked = (element.fe_is_readonly == 1)? true : false;
        document.querySelector('#chkElementSettingsScoringCheck').checked = (element.fe_enable_score == 1)? true : false;
        // document.querySelector('#radElementSettingsQuestionPosition').value = element.fe_question_position;



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
    
    $.ajax({
      url: `${formBaseUrl}formbuilder/form/element/update/${selectedUserElement.fe_id}`,
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function(res){
        loadFormSettings(<?= $form->forms_id?>);
        loadFormElements(<?= $form->forms_id?>, "edit");
        $('#modalElementSettings').modal('hide')
      }
    })
  }
  
  window.onload = () => {
    loadFormSettings(<?= $form->forms_id?>);
    loadFormElements(<?= $form->forms_id?>, "edit");
    setTimeout(() => {
      console.log(formUserElements.length)
    }, 500);
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
      })
    },
    stop: function(event){
      selectedElement = 0
    }    
  });

  $('#windowPreviewContent').sortable({
    placeholder: 'col-xs-12 col-sm-3  bg-light card',
    update: function(event, ui){
      console.log(event)
      console.log(ui)
      
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
    greedy: true,
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
          // window.alert('Element added!');
          loadFormSettings(<?= $form->forms_id?>);
          loadFormElements(<?= $form->forms_id?>, "edit");
          return;
        }
      })
    }
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