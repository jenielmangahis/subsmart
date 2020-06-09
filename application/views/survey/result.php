<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
  <style>
  .survey-kpi-card {
    transition:0.3s;
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 11px rgba(33,33,33,.2);
  }
    
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
    

    <?php
      $overall_questions = count($questions) * $survey->count;
      $overall_score = $overall_questions * 100; // answer is in percent score
      $total_score = 0;

    
    ?>
   <?php foreach ($questions as $key => $question): ?>
      <?php  
        $token_result = 0;  // answered questions

        foreach ($question->survey_answer as $key => $survey_answers){
          if(!empty($survey_answers->answer) || $survey_answers->answer != ""){
            $token_result++;
          }
        }
        
        if($token_result === 0){
          $total_count = count($question->survey_answer);
          $percentage = 0;
        }else{
          $total_count = count($question->survey_answer);
          $percentage = $token_result / $total_count * 100; // need to update
          $total_score += $percentage;
        }
        
       ?>
       
   <?php endforeach;?>
   <?php
   if($total_score === 0){
     $survey_completion_rate = 0;
  }else{
    $survey_completion_rate = $total_score / count($questions);
   }
   
   ?>
   <?php // echo $survey_completion_rate; ?>
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
                    
                    <div class="d-flex flex-row">
                      
                      <p class="flex-fill text-left">
                        <h4 class="font-weight-normal text-gray">Survey Title: <span class="font-weight-bold"><?= $survey->title ?></span> </h4>
                      </p>
                      <p class="flex-fill text-right">
                        <a class="text-info block" href="<?php echo base_url()?>survey"> << Back to list</a>
                      </p>
                    </div>

                    <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-2">
                        
                        <div class="card survey-kpi-card">
                          <div class="card-content">
                          <h2 class="card-title text-dark font-weight-normal mt-0 pt-0"><?= $survey->count; ?></h2>
                          <p class="mb-0">Responses</p>
                          </div>
                        </div>
                        <div class="card survey-kpi-card">
                          <div class="card-content">
                            <h2 class="card-title text-dark font-weight-normal mt-0 pt-0"><?= number_format($survey_completion_rate, 2) ?>%</h2>
                            <p class="mb-0">Completion rate</p>
                          </div>
                        </div>
                        <div class="card survey-kpi-card">
                          <div class="card-content">
                            <h2 class="card-title text-dark font-weight-normal mt-0 pt-0"><?php if($survey->count_timer === ""){ echo gmdate("H:i:s", 0); }else{ echo gmdate("H:i:s", $survey->count_timer);} ?></h2>
                            <p class="mb-0">Average time to complete</p>
                          </div>  
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-10">
                        
                        <div class="btn-group btn-block py-3">
                          <a href="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview" class=" mr-3 btn btn-warning">Preview</a>
                          <a href="<?php echo base_url()?>survey/share/<?php echo $survey->id?>" class=" mx-3 btn btn-info">Share</a>
                          <a href="<?php echo base_url()?>survey/<?php echo $survey->id?>" class=" mx-3 btn btn-success">Edit Survey</a>
                          <a href="<?php echo base_url()?>survey/delete/<?php echo $survey->id?>" class=" ml-3 btn btn-danger">Delete</a>
                          <a href="<?php echo base_url()?>survey/delete/<?php echo $survey->id?>" class=" ml-3 btn btn-info">Select Theme</a>
                        </div>

                        <!-- show when questions are not loaded -->
                        <?php
                          if(!$questions){
                            ?>
                              <div class="card survey-kpi-card" style="background-color: rgb(240, 240, 240);">
                                <h6 class="mb-0 text-dark">We couldn't load your question data</h6>
                                <p class="font-weight-normal text-dark">Sorry, this is embarrassing—but your data is safe. Either refresh the page, or you haven't added any question(s) yet.</p>
                              </div>
                            <?php
                          }else{
                            ?>
                              <!-- show when questions are loaded -->
                              <div class="row ">
                                <div class="col-sm-12 ">
                                  <ul class="list-group survey-kpi-card">
                                    <li class="list-group-item d-flex justify-content-between">
                                      <h5 >Question</h5>
                                      <h5>Percentage</h5>
                                    </li>
                                    <?php foreach ($questions as $key => $question): ?>

                                        <!-- @L@: new code edited by: Alexis Pienda -->
                                        <?php  $token_result = 0; ?>
                                        <?php foreach ($question->survey_answer as $key => $survey_answers){
                                                if(!empty($survey_answers->answer) || $survey_answers->answer != ""){
                                                    $token_result++;
                                                }
                                              }

                                              if($token_result === 0){
                                                $total_count = count($question->survey_answer);
                                                $percentage = 0; // need to update
                                              }else{
                                                $total_count = count($question->survey_answer);
                                                $percentage = $token_result / $total_count * 100; // need to update
                                              }
                                        ?>
                                        <li class="list-group-item d-flex justify-content-between">
                                        <p class="mb-0 d-flex align-items-center"> 
                                          <i class="icon-design <?= $question->template_icon ?>" style="background-color: <?= $question->template_color ?>;" data-toggle="tooltip" data-placement="top" title="<?= $question->template_title?>"></i>
                                          <?= $question->question ?> 
                                          <?php if($question->required === '1'){ echo '<span class="badge badge-alert text-white m-2">Required</span> ';}
                                            ?>
                                        </p>
                                        <h5 class="font-weight-normal"><?= number_format($percentage, 2) ?>%</h5>
                                      </li>
                                    <?php endforeach; ?>

                                  </ul>
                                </div>
                              </div>
                              <!-- end of questions and percentages list -->
                            <?php
                          }
                        ?>

                      </div>
                    </div>                      
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
<script type="text/javascript" src="https://nsmartrac.com/assets/js/survey.js"></script>
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>
