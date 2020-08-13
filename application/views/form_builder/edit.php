
<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>
<style>
  #windowPreviewTemplate{
    min-height: 90%;
  }
  
  .form-list-item-options{
    display: none
  }
  .form-list-item.options:hover{
    display: block;
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
        <h1><?= $form->forms_title?> <a href="#" class="btn btn-outline-info"><i class="fa fa-eye"></i> View Form</a></h1>
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
          <div id="form-editor-window" class="form-editor-settings-window tab-pane fade show active">
            
            <div class="row">
              <div class="col-xs-12 col-md-3 overflow-auto">
                <div class="form-group">
                  <h2>Form Editor</h2>
      
                  </div>
                  <div id="accordion" class="overflow-none">
                    <ul class="list-group">
  
                      <li class="list-group-item" data-toggle="collapse" data-target="#collapseCommonItemsMenu" aria-expanded="true" aria-controls="collapse0">
                        Common Items
                      </li>
                      <div id="collapseCommonItemsMenu" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="row">
                          <div class="col-xs-6 col-sm-6">
                            <button class="btn btn-block btn-secondary"><i class="fa fa-cog"></i> Element</button>
                          </div>
                          <div class="col-xs-6 col-sm-6">
                            <button class="btn btn-block btn-secondary"><i class="fa fa-cog"></i> Element</button>
                          </div>
                        </div>
                        
                      </div>
  
                      <li class="list-group-item" data-toggle="collapse" data-target="#collapseFormattingItemsMenu" aria-expanded="true" aria-controls="collapse0">
                        Formatting Items
                      </li>
                      <div id="collapseFormattingItemsMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <a href="#" class="btn btn-link">Blank space here</a>
                      </div>
                  
  
                      <li class="list-group-item" data-toggle="collapse" data-target="#collapseEmailItemsMenu" aria-expanded="true" aria-controls="collapse0">
                        Email Items
                      </li>
                      <div id="collapseEmailItemsMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <a href="#" class="btn btn-link">Blank space here</a>
                      </div>
                  
  
                      <li class="list-group-item" data-toggle="collapse" data-target="#collapseOrderFormMenu" aria-expanded="true" aria-controls="collapse0">
                        Order Form Items
                      </li>
                      <div id="collapseOrderFormMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <a href="#" class="btn btn-link">Blank space here</a>
                      </div>
                  
  
                      <li class="list-group-item" data-toggle="collapse" data-target="#collapseMatrixGridMenu" aria-expanded="true" aria-controls="collapse0">
                        Matrix/Grid Items
                      </li>
                      <div id="collapseMatrixGridMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <a href="#" class="btn btn-link">Blank space here</a>
                      </div>
                  
  
                      <li class="list-group-item" data-toggle="collapse" data-target="#collapseItemMenu" aria-expanded="true" aria-controls="collapse0">
                        Item Blocks
                      </li>
                      <div id="collapseItemMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <a href="#" class="btn btn-link">Blank space here</a>
                      </div>
  
                      <li class="list-group-item" data-toggle="collapse" data-target="#collapseHeaderFooterMenu" aria-expanded="true" aria-controls="collapse0">
                        Header/Footer
                      </li>
                      <div id="collapseHeaderFooterMenu" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <a href="#" class="btn btn-link">Blank space here</a>
                      </div>
                    </ul>      
                  </div>
                  
              </div>
              <div class="col-xs-12 col-md-9">
                <div id="windowPreviewTemplate" class="card">
                  main window preview template
                </div>
              </div>
            </div>
          </div>

          <!-- FORM SETTINGS -->
          <div id="form-editor-settings" class="form-editor-settings-window tab-pane fade ">

            <div class="row">
              <div class="col-xs-12 col-md-3">
                <div id="form-settings-menu" class="list-group sticky-top">
                  <a class="list-group-item list-group-item-action" data-toggle="list" href="#forms-settings-general" >General</a>
                  <a class="list-group-item list-group-item-action" data-toggle="list" href="#forms-settings-notifications">Notifications</a>
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
                        <h3>General Settings</h3>
                        <hr/>
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
                          <label for="txtSocialDescription">Private Notes:</label>
                          <textarea class="form-control" name="txtSocialDescription" id="txtSocialDescription" rows="3" ></textarea>
                        </div>

                        <hr/>
                        <h4>Open/Close</h4>
                        <div class="card">
                          <div class="card-content">
                            <div class="form-check">
                              <input type="checkbox" name="txtFormToggleStart" id="txtFormToggleStart">
                              <label for="txtFormToggleStart">Use Start Date..</label>
                              <small class="form-text text-muted">Open this form after this date</small>
                              <blockquote class="blockquote">
                                <div class="form-row">
                                  <div class="form-group">
                                    <label for="#txtStartDate">Start Date</label>
                                    <input type="date" class="form-control" name="txtStartDate" id="txtStartDate">
                                  </div>
                                  <div class="form-group">
                                    <label for="#txtStartTime">Start Time</label>
                                    <input type="date" class="form-control" name="txtStartTime" id="txtStartTime">
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
                              <blockquote class="blockquote">
                                <div class="form-row">
                                  <div class="form-group">
                                    <label for="#txtEndDate">End Date</label>
                                    <input type="date" class="form-control" name="txtEndDate" id="txtEndDate">
                                  </div>
                                  <div class="form-group">
                                    <label for="#txtEndTime">End Time</label>
                                    <input type="date" class="form-control" name="txtEndTime" id="txtEndTime">
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
                              <input type="checkbox" name="txtFormToggleResult" id="txtFormToggleResult">
                              <label for="txtFormToggleResult">Use Results Limit..</label>
                              <small class="form-text text-muted">Close this form after this many stored results</small>
                              <blockquote class="blockquote">
                              
                                <div class="form-group">
                                  <label for="#txtResultsLimit">Results Limit</label>
                                  <input type="number" class="form-control" name="txtResultsLimit" id="txtResultsLimit">
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
                      </div>
                    </div>
                  </div>

                  <!-- SETTINGS: GENERAL - NOTIFICATIONS -->
                  <div id="forms-settings-notifications" class="tab-pane fade">
                    <div class="card">
                      <div class="card-content">
                        <h3>Notifications</h3>
                        <hr/>
                      </div>
                    </div>
                  </div>



                  <!-- SETTINGS: SUCCESS PAGES -->
                  <div id="forms-settings-success-pages" class="tab-pane fade">
                    <div class="card">
                      <div class="card-content">
                        <h3>Success Pages</h3>
                        <hr/>
                      </div>
                    </div>
                  </div>
                  <!-- SETTINGS: CUSTOM TEXT -->
                  <div id="forms-settings-custom-text" class="tab-pane fade">
                    <div class="card">
                      <div class="card-content">
                        <h3>Custom Text</h3>
                        <hr/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            
          </div>

          <div id="form-editor-share" class="form-editor-settings-window tab-pane fade ">
            <div class="row">
              <div class="col-xs col-md-3">
                <div class="accordion">
                  <ul class="list-group">
                    <li class="list-group-item">Links</li>
                    <li class="list-group-item">Embed Code</li>
                    <li class="list-group-item">Wordpress</li>
                    <li class="list-group-item">QR Code</li>
                  </ul>
                </div>
              </div>
              <div class="col-xs col-md-9">
                <div id="windowShareWrapperContent">
                  windows share
                </div>
              </div>
            </div>
          </div>
          <div id="form-editor-results" class="form-editor-settings-window tab-pane fade ">
            <div class="row">
              <div class="col-xs col-md-3">
                <div class="accordion">
                  <ul class="list-group">
                    <li class="list-group-item">Results Table</li>
                    <li class="list-group-item">Analytics</li>
                    <li class="list-group-item">Results Filters</li>
                    <li class="list-group-item">Results Views</li>
                    <li class="list-group-item">Results Docs</li>
                    <li class="list-group-item">Export</li>
                    <li class="list-group-item">Scheduled Exports</li>
                    <li class="list-group-item">Import</li>
                    <li class="list-group-item">Results Reports</li>
                    <li class="list-group-item">Delete Results</li>
                    
                  </ul>
                </div>
              </div>
              <div class="col-xs col-md-9">
                <div id="windowResultsWrapperContent">
                  windows results
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
  selectMenu = menuKey => {
    swtich(){
      case 0:
        break;
    }
  }
</script>
