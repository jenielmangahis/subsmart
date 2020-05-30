<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
  <style>
  .share-icon.d-flex i {
   width: 45px;
   height: 45px;
   align-items: center;
   display: flex;
   justify-content: center;
   color: rgb(76, 76, 76);
   background-color: #f0f0f0;
   border-radius: 50%;
   margin-right: .5rem;
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

  </style>
   <?php include viewPath('includes/sidebars/marketing'); ?>
   <!-- page wrapper start -->
   <?php foreach ($questions as $key => $question): ?>
       <?php  $token_result = 0; ?>
       <?php foreach ($question->survey_answer as $key => $survey_answers){
               if(!empty($survey_answers->answer) || $survey_answers->answer != "" || isset($survey_answers->answer)){
                   $token_result++;
               }
             }
            $total_count = count($question->survey_answer);
            $percentage = $token_result / 1 * 100; // need to update
       ?>
   <?php endforeach; ?>
   <div wrapper__section>
      <div class="container-fluid">
         <div class="page-title-box">
         </div>
         <!-- end row -->
         <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="row mb-5">
                  <div class="col-sm-12">
                    <h5 class="font-weight-normal text-gray">Survey Title: <?= $survey->title ?></h5>
                      <div class="w-100 d-flex py-4">
                        <!-- <div class="mr-5">
                          <p class="mb-0">Stats</p>
                          <h1 class="card-title font-weight-normal mt-0 pt-0">0</h1>
                        </div> -->
                        <div class="mr-5">
                          <p class="mb-0">Responses</p>
                          <h1 class="card-title font-weight-normal mt-0 pt-0"><?= $total_count; ?></h1>
                        </div>
                        <div class="mr-5">
                          <p class="mb-0">Completion rate</p>
                          <h1 class="card-title font-weight-normal mt-0 pt-0"><?= $percentage ?>%</h1>
                        </div>
                        <div class="mr-5">
                          <p class="mb-0">Average time to complete</p>
                          <h1 class="card-title font-weight-normal mt-0 pt-0"><?= gmdate("H:i:s", $survey->count_timer) ?></h1>
                        </div>
                      </div>
                    </div>
                  </div>
                  <h5 class="font-weight-normal my-5">Questions List</h5>
                  <div class="card" style="background-color: rgb(240, 240, 240);">
                    <h6 class="mb-0 text-dark">We couldn't load your question data</h6>
                    <p class="font-weight-normal text-dark">Sorry, this is embarrassing—but your data is safe. Refresh the page or come back later</p>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 offset-3">
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                          <h5 >Question</h5>
                          <h5 class="font-weight-normal">Percentage</h5>
                        </li>
                        <?php foreach ($questions as $key => $question): ?>
                            <?php  $token_result = 0; ?>
                            <?php foreach ($question->survey_answer as $key => $survey_answers){
                                    if(!empty($survey_answers->answer) || $survey_answers->answer != ""){
                                        $token_result++;
                                    }
                                  }
                                 $total_count = count($question->survey_answer);
                                 $percentage = $token_result / 1 * 100; // need to update
                            ?>
                            <li class="list-group-item d-flex justify-content-between">
                            <p class="mb-0 d-flex align-items-center"> <i class="icon-design <?= $question->template_icon ?>" style="background-color: <?= $question->template_color ?>;"></i> <?= $question->question ?></p>
                            <h5 class="font-weight-normal"><?= $percentage ?>%</h5>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
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

<?php include viewPath('includes/footer'); ?>
