
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

          <!-- FORM EDITOR -->
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
                                  <input type="checkbox" name="txtFormToggleStart" id="txtFormToggleStart" onclick="toggleOperationsMenu(event)">
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
                                        <select name="txtStartTime" id="txtStartTime" class="custom-select">
                                          <option value="00:00" selected>12.00 AM</option>
                                          <option value="00:30">12.30 AM</option>
                                          <option value="01:00">01.00 AM</option>
                                          <option value="01:30">01.30 AM</option>
                                          <option value="02:00">02.00 AM</option>
                                          <option value="02:30">02.30 AM</option>
                                          <option value="03:00">03.00 AM</option>
                                          <option value="03:30">03.30 AM</option>
                                          <option value="04:00">04.00 AM</option>
                                          <option value="04:30">04.30 AM</option>
                                          <option value="05:00">05.00 AM</option>
                                          <option value="05:30">05.30 AM</option>
                                          <option value="06:00">06.00 AM</option>
                                          <option value="06:30">06.30 AM</option>
                                          <option value="07:00">07.00 AM</option>
                                          <option value="07:30">07.30 AM</option>
                                          <option value="08:00">08.00 AM</option>
                                          <option value="08:30">08.30 AM</option>
                                          <option value="09:00">09.00 AM</option>
                                          <option value="09:30">09.30 AM</option>
                                          <option value="10:00">10.00 AM</option>
                                          <option value="10:30">10.30 AM</option>
                                          <option value="11:00">11.00 AM</option>
                                          <option value="11:30">11.30 AM</option>
                                          <option value="12:00">12.00 PM</option>
                                          <option value="12:30">12.30 PM</option>
                                          <option value="13:00">01.00 PM</option>
                                          <option value="13:30">01.30 PM</option>
                                          <option value="14:00">02.00 PM</option>
                                          <option value="14:30">02.30 PM</option>
                                          <option value="15:00">03.00 PM</option>
                                          <option value="15:30">03.30 PM</option>
                                          <option value="16:00">04.00 PM</option>
                                          <option value="16:30">04.30 PM</option>
                                          <option value="17:00">05.00 PM</option>
                                          <option value="17:30">05.30 PM</option>
                                          <option value="18:00">06.00 PM</option>
                                          <option value="18:30">06.30 PM</option>
                                          <option value="19:00">07.00 PM</option>
                                          <option value="19:30">07.30 PM</option>
                                          <option value="20:00">08.00 PM</option>
                                          <option value="20:30">08.30 PM</option>
                                          <option value="21:00">09.00 PM</option>
                                          <option value="21:30">09.30 PM</option>
                                          <option value="22:00">10.00 PM</option>
                                          <option value="22:30">10.30 PM</option>
                                          <option value="23:00">11.00 PM</option>
                                          <option value="23:30">11.30 PM</option>
                                        </select>
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
                                  <input type="checkbox" name="txtFormToggleEnd" id="txtFormToggleEnd" onclick="toggleOperationsMenu(event)">
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
                                        <!-- <input type="date" class="form-control" name="txtEndTime" id="txtEndTime"> -->
                                        <select name="txtEndTime" id="txtEndTime" class="custom-select">
                                          <option value="00:00" selected>12.00 AM</option>
                                          <option value="00:30">12.30 AM</option>
                                          <option value="01:00">01.00 AM</option>
                                          <option value="01:30">01.30 AM</option>
                                          <option value="02:00">02.00 AM</option>
                                          <option value="02:30">02.30 AM</option>
                                          <option value="03:00">03.00 AM</option>
                                          <option value="03:30">03.30 AM</option>
                                          <option value="04:00">04.00 AM</option>
                                          <option value="04:30">04.30 AM</option>
                                          <option value="05:00">05.00 AM</option>
                                          <option value="05:30">05.30 AM</option>
                                          <option value="06:00">06.00 AM</option>
                                          <option value="06:30">06.30 AM</option>
                                          <option value="07:00">07.00 AM</option>
                                          <option value="07:30">07.30 AM</option>
                                          <option value="08:00">08.00 AM</option>
                                          <option value="08:30">08.30 AM</option>
                                          <option value="09:00">09.00 AM</option>
                                          <option value="09:30">09.30 AM</option>
                                          <option value="10:00">10.00 AM</option>
                                          <option value="10:30">10.30 AM</option>
                                          <option value="11:00">11.00 AM</option>
                                          <option value="11:30">11.30 AM</option>
                                          <option value="12:00">12.00 PM</option>
                                          <option value="12:30">12.30 PM</option>
                                          <option value="13:00">01.00 PM</option>
                                          <option value="13:30">01.30 PM</option>
                                          <option value="14:00">02.00 PM</option>
                                          <option value="14:30">02.30 PM</option>
                                          <option value="15:00">03.00 PM</option>
                                          <option value="15:30">03.30 PM</option>
                                          <option value="16:00">04.00 PM</option>
                                          <option value="16:30">04.30 PM</option>
                                          <option value="17:00">05.00 PM</option>
                                          <option value="17:30">05.30 PM</option>
                                          <option value="18:00">06.00 PM</option>
                                          <option value="18:30">06.30 PM</option>
                                          <option value="19:00">07.00 PM</option>
                                          <option value="19:30">07.30 PM</option>
                                          <option value="20:00">08.00 PM</option>
                                          <option value="20:30">08.30 PM</option>
                                          <option value="21:00">09.00 PM</option>
                                          <option value="21:30">09.30 PM</option>
                                          <option value="22:00">10.00 PM</option>
                                          <option value="22:30">10.30 PM</option>
                                          <option value="23:00">11.00 PM</option>
                                          <option value="23:30">11.30 PM</option>
                                        </select>
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
                                  <input type="checkbox" name="txtFormToggleResult" id="txtFormToggleResult" onclick="toggleOperationsMenu(event)">
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
                            <input type="checkbox" name="chkSubmitResponse" id="chkSubmitResponse" class="custom-control-input">
                            <label class="custom-control-label" for="chkSubmitResponse">Show 'Submit another response' button</label>
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
            <h1 class="text-center text-muted py-5">Coming soon</h1>
          </div>
        </div>
        

      </div>
      



    </div>
  </div>

</div>
<script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
  let userFormData = {}
  var operationsWindow = {
    showStartOptions: false,
    showEndOptions: false,
    showResultOptions: false
  }
  // selectMenu = menuKey => {
  //   swtich(){
  //     case 0:
  //       break;
  //   }
  // }
  
  toggleOperationsMenu = e => {
    switch(e.target.name){
      case 'txtFormToggleStart':
        operationsWindow.showStartOptions = !operationsWindow.showStartOptions
        document.querySelector('#form-start-date-options').style.display = (operationsWindow.showStartOptions === true)? "block" : "none"
        break;
      case 'txtFormToggleEnd':
        operationsWindow.showEndOptions = !operationsWindow.showEndOptions
        document.querySelector('#form-end-date-options').style.display = (operationsWindow.showEndOptions === true)? "block" : "none"
        break;
      case 'txtFormToggleResult':
        operationsWindow.showResultOptions = !operationsWindow.showResultOptions
        document.querySelector('#form-results-options').style.display = (operationsWindow.showResultOptions === true)? "block" : "none"
        break;
    }
  }

  loadFormSettings = () => {
    $.ajax({
      url: "<?= base_url()?>formbuilder/form/view/<?=$form->forms_id?>",
      dataType: 'json',
      type: 'GET',
      success: function(res){
        console.log(res)
        return;
      }
    })
  }

  loadFormSettings();

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
        return;
      }
    })
  });

  document.querySelector('#btnSaveSuccessPages').addEventListener('click', () => {
    let data = {
      'forms_redirect_link': document.querySelector('#txtRedirectLink').value,
      'forms_success_title': document.querySelector('#txtSuccessTitle').value,
      'forms_success_message': document.querySelector('#txtSuccessMessage').value,
      'forms_show_repeat_form_check': (document.querySelector('#chkSubmitResponse').checked === true)? 1 : 0
    }

    $.ajax({
      url: "<?= base_url()?>formbuilder/form/update/<?=$form->forms_id?>",
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function(res){
        window.alert('success pages saved');
        return;
      }
    })
  });
</script>
