<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<style>
  #survey-card {
    transition:0.3s;
    border-radius:10px;
  }
  #survey-card:hover {
    transform: none;
  }
</style>


<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/marketing'); ?>
   <!-- page wrapper start -->
   <div wrapper__section>
      <div class="container-fluid">
         <div class="page-title-box">
         </div>
         <!-- end row -->
         <div class="row">
            <div class="col-xl-12">
               <div class="card">
                  <div class="container-fluid" style="font-size:14px;">
                     <div class="row">
                        <div class="col">
                           <h1 class="m-0">Survey List</h1>
                        </div>
                        <div class="col-auto">
                           <div class="h1-spacer">
                              <a class="btn btn-primary btn-md text-light" data-toggle="modal" data-target="#exampleModal">
                              <span class="fa fa-plus text-light"></span> New Survey
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="row align-items-center mb-4 margin-bottom-ter">
                        <div class="col">
                           <p class="m-0">List or Add new survey. </p>
                        </div>
                     </div>
                     <div class="tabs">
                        <ul class="clearfix work__order" id="myTab" role="tablist">
                        </ul>
                     </div>
                     <div id="survey-content" class="row">
                       <?php if($surveys){ ?>
                       <?php foreach ($surveys as $key => $survey): ?>
                         <div class="col-sm-3">

                         <div id="survey-card" data-id="<?= $survey->id ?>" class="card pt-0 2 border-0 shadow">
                            <div class="card-body">
                              <h5 class="card-title text-secondary font-weight-light"><?= $survey->title ?></h5>
                              </div>
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item p-0 pt-2 d-flex justify-content-between align-items-center flex-row">
                               <span><?= $survey->count ?> response(s)</span>
                               <div class="btn-group ">
                                  <button class="btn btn-success btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" data-id="<?= $survey->id; ?>" href="survey/<?= $survey->id ?>">Edit</a>
                                    <a id="btn-delete-survey" data-id="<?= $survey->id; ?>" class="dropdown-item" href="survey/delete/<?= $survey->id ?>">Delete</a>
                                    <a id="btn-preview-survey" data-id="<?= $survey->id; ?>" class="dropdown-item" href="survey/preview/<?= $survey->id ?>">View</a>
                                    <a id="btn-result-survey" data-id="<?= $survey->id; ?>" class="dropdown-item" href="survey/result/<?= $survey->id ?>">Results</a>
                                    <a id="btn-share-survey" data-id="<?= $survey->id; ?>"  class="dropdown-item" href="survey/share/<?= $survey->id ?>"> Share</a>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>

                        </div>
                      <?php endforeach; ?>
                    <?php }else{ ?>
                      <li class="list-group-item text-center"> No list for Survey</li>
                    <?php } ?>
                  </div>
                  </div>
               </div>
            </div>
            <!-- end card -->
         </div>
      </div>
      <!-- end row -->
   </div>
   <!-- end container-fluid -->
</div>
</div>
<!-- page wrapper end -->

  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <?= form_open('survey/add', array('id'=>'frm-add-survey')) ?>
      <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLongTitle">Add Survey</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title">
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Save changes</button>
       </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>

<style>
  #survey-card:hover{
    box-shadow: 0 0 11px rgba(33,33,33,.2);
    cursor: pointer;
  }
</style>

<?php include viewPath('includes/footer'); ?>
