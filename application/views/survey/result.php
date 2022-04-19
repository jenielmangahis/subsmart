<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<div class="wrapper" role="wrapper">
  <style>
      .survey-kpi-card {
        transition:0.3s;
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 11px rgba(33,33,33,.2);
      }

      .survey-kpi-card-theme-image {
        width: 100%;
        max-height: 100px;
        height: auto;
        object-fit: cover;
      }

      .survey-kpi-card-theme{
        padding: 0;
      }        

      .survey-kpi-card-theme-content{
        position: absolute;
        padding: 10px;
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
    
    .data-section{
      display: none;
    }

    .jssocials-share-logo {
        width: 3em;     
        font-size: 2.5em;
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
    $length = count($questions);
    foreach($questions as $question){
      if($question->template_id == 1 || $question->template_id == 19 || $question->template_id == 20 || $question->template_id == 13){
        $length--;
      }
    }

    if( $total_score > 0 && $survey_completion_rate > 0){
      $survey_completion_rate = $total_score / $length;
    }else{
      $survey_completion_rate = 0;
    }
    
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

                    <div class="d-flex flex-row mb-10">
                        <h2 class="font-weight-normal text-gray">Survey Title: <span class="font-weight-bold"><?= $survey->title ?></span> </h2>
                    </div>

                    <div class="row">
                      <div class="col-sm-12 col-md-6">

                        <!-- surrent survey theme -->
                        <?php
                          if(!empty($survey_theme)){
                            ?>

                              <div class="card survey-kpi-card survey-kpi-card-theme">
                                <img class="survey-kpi-card-theme-image" src="<?=base_url()?>uploads/survey/themes/<?=$survey_theme->sth_primary_image?>" alt="image">
                                <div class="card-content survey-kpi-card-theme-content">
                                <small style="color: <?php if($survey_theme->sth_text_color){ echo $survey_theme->sth_text_color; } ?>">Current Theme:</small>
                                <h3 style="color: <?php if($survey_theme->sth_text_color){ echo $survey_theme->sth_text_color; } ?>"><?php if($survey_theme->sth_theme_name){ echo $survey_theme->sth_theme_name; }?></h3>
                                </div>
                              </div>
                            <?php
                          }else{
                            echo '';
                          }
                        ?>
                        
                        <!-- key performance indicators -->
                        <div class="row">
                          <div class="col-xs-6 col-sm-4">
                            <div class="card survey-kpi-card">
                              <div class="card-content">
                              <h2 class="card-title text-dark font-weight-normal mt-0 pt-0"><?= $survey->count; ?></h2>
                              <p class="mb-0">Responses</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-6 col-sm-4">
                            
                            <div class="card survey-kpi-card">
                              <div class="card-content">
                                <h2 class="card-title text-dark font-weight-normal mt-0 pt-0"><?= number_format($survey_completion_rate, 2) ?>%</h2>
                                <p class="mb-0">Completion rate</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-6 col-sm-4">
                            
                            <div class="card survey-kpi-card">
                              <div class="card-content">
                                <h2 class="card-title text-dark font-weight-normal mt-0 pt-0"><?php if($survey->count_timer === ""){ echo gmdate("H:i:s", 0); }else{ echo gmdate("H:i:s", $survey->count_timer);} ?></h2>
                                <p class="mb-0">Average time to complete</p>
                              </div>  
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="<?php echo base_url()?>survey/edit/<?php echo $survey->id?>" class="btn-block btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="javascript:void(0);" class="btn-block btn btn-info btn-share-survey"><i class="fa fa-share"></i> Share</a>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-4">
                            <a href="javascript:void(0);" class="btn-block btn btn-danger btn-delete-survey" data-id="<?= $survey->id; ?>"><i class="fa fa-trash"></i> Delete</a>
                          </div>
                        </div>

                        <div class="card my-1">
                          <!-- <div class="card-body"> -->
                            Sharable Link
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" name="txtLink" id="txtLink" readonly class="form-control" value="<?=base_url()?>survey/<?=$survey->id?>?st=<?= url_title(strtolower($survey->title))?>">
                                <button onclick="copyLink()" id="btnCopyLink" class="btn btn-info"><i class="fa fa-copy"></i> Copy Link</button>
                              </div>
                            </div>
                          <!-- </div> -->
                        </div>

                        
                          <div class="col-xs-12 py-2">
                              
                            


                            <!-- show when questions are not loaded -->
                            <?php
                              if(!$questions){
                                ?>
                                  <div class=" card survey-kpi-card" style="background-color: rgb(240, 240, 240);">
                                    <h6 class="mb-0 text-dark">We couldn't load your question data</h6>
                                    <p class="font-weight-normal text-dark">Sorry, this is embarrassing—but your data is safe. Either refresh the page, or you haven't added any question(s) yet. </p>
                                  </div>
                                <?php
                              }else{
                                ?>
                                  <!-- show when questions are loaded -->
                                  <div class="row ">
                                    <div class="col-sm-12 ">
                                      <div class="tool-icon" style="display:block;margin-bottom: 42px;">
                                        <button id="toggle-chart-data" onclick="toggleDataChart()" class="btn btn-primary btn-sm animate__animated animate__heartBeat" style="float: right;"><i class="fa fa-navicon"></i> Expand</button>          
                                      </div>
                                      <ul class="list-group survey-kpi-card">
                                        <li class="list-group-item d-flex justify-content-between">
                                          <h5 >Question</h5>
                                          <h5>Percentage</h5>                                                                      
                                        </li>
                                        <?php foreach ($questions as $key => $question){ ?>

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
                                            <?php
                                                if($question->template_id !== 1 || $question->template_id !== 19 || $question->template_id !== 20 || $question->template_id !== 13){
                                                  ?>
                                                    <h6 class="font-weight-normal"><?= number_format($percentage, 2) ?>%</h6>
                                                  <?php
                                                }else{
                                                  echo "wat";
                                                }
                                            ?>
                                          </li>

                                          <!-- chart/data  -->
                                          <div class="data-section animate__animated  animate__fadeIn">
                                            <li class="list-group-item d-flex-justify-content-between">
                                              <?php 
                                                if(count($question->survey_answer) == 0){ 
                                                  ?>
                                                    <div class="alert alert-danger"> No answers.</div>
                                                  <?php
                                                }else{
                                                  switch($question->template_id){
                                                    case 1:
                                                    break;
                                                    case 2: // long text
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 3: //radial
                                                      ?>
                                                        <canvas id="radial-canvas-<?= $question->template_id?>-<?= $question->id?>" height="50"></canvas>
                                                        <script>
                                                          let ctx_<?=$question->id?> = document.querySelector('#radial-canvas-<?= $question->template_id?>-<?= $question->id?>')
                                                          let chartData_<?=$question->id?> = {
                                                            labels: [],
                                                            datasets: [
                                                              {
                                                                label: ['Question: <?= $question->question?>'],
                                                                data: [],
                                                                
                                                                borderWidth: 1
                                                              }
                                                            ]
                                                          }
                                                          let chartOptions_<?=$question->id?> = {
                                                            scales: {
                                                              yAxes: [{
                                                                  ticks: {
                                                                      beginAtZero: true,
                                                                      precision: 0
                                                                  }
                                                              }]
                                                            }
                                                          }
                                                          const checkboxChart_<?=$question->id?> = new Chart(ctx_<?=$question->id?>,{
                                                            type: 'bar',
                                                            data: chartData_<?=$question->id?>,
                                                            options: chartOptions_<?=$question->id?>
                                                          });
                                                          <?php
                                                            foreach($question->questions as $choices){
                                                              ?>
                                                                chartData_<?=$question->id?>.labels.push('<?= $choices->choices_label?>');
                                                              <?php
                                                              $count = 0;
                                                              foreach($question->survey_answer as $answers){
                                                                
                                                                if($answers->answer == $choices->choices_label){
                                                                  $count++;
                                                                }
                                                              }
                                                              ?>
                                                                chartData_<?=$question->id?>.datasets[0].data.push(<?= $count ?>);
                                                              <?php
                                                            }
                                                            ?>
                                                            checkboxChart_<?=$question->id?>.update();
                                                        </script>
                                                      <?php
                                                    break;
                                                    case 4: //checkboxes
                                                      ?>
                                                        <canvas id="checkbox-canvas-<?= $question->template_id?>-<?= $question->id?>" height="50"></canvas>
                                                        <script>
                                                          let ctx_<?=$question->id?> = document.querySelector('#checkbox-canvas-<?= $question->template_id?>-<?= $question->id?>')
                                                          let chartData_<?=$question->id?> = {
                                                            labels: [],
                                                            datasets: [
                                                              {
                                                                label: ['Question: <?= $question->question?>'],
                                                                data: [],
                                                                
                                                                borderWidth: 1
                                                              }
                                                            ]
                                                          }
                                                          let chartOptions_<?=$question->id?> = {
                                                            scales: {
                                                              yAxes: [{
                                                                  ticks: {
                                                                      beginAtZero: true,
                                                                      precision: 0
                                                                  }
                                                              }]
                                                            }
                                                          }
                                                          const checkboxChart_<?=$question->id?> = new Chart(ctx_<?=$question->id?>,{
                                                            type: 'bar',
                                                            data: chartData_<?=$question->id?>,
                                                            options: chartOptions_<?=$question->id?>
                                                          });
                                                          <?php
                                                            foreach($question->questions as $choices){
                                                              ?>
                                                                chartData_<?=$question->id?>.labels.push('<?= $choices->choices_label?>');
                                                              <?php
                                                              $count = 0;
                                                              foreach($question->survey_answer as $answers){
                                                                
                                                                if($answers->answer == $choices->choices_label){
                                                                  $count++;
                                                                }
                                                              }
                                                              ?>
                                                                chartData_<?=$question->id?>.datasets[0].data.push(<?= $count ?>);
                                                              <?php
                                                            }
                                                            ?>
                                                    
                                                            checkboxChart_<?=$question->id?>.update();
                                                        </script>
                                                      <?php
                                                    break;
                                                    case 5: //email
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 6: // number
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 7: //images
                                                      echo '<div class="alert alert-dark">';
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                          <img src="<?= base_url('uploads/survey/files/'.$survey->id.'/'.$answers->answer); ?>" class="img img-fluid" style="width:22%;display: inline-block;margin:5px;">
                                                          <?php
                                                        }
                                                      }
                                                      echo '</div>';
                                                    break;
                                                    case 8: // phone number
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 9: // short text
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 11: // yes/no
                                                      ?>
                                                        <canvas id="checkbox-canvas-<?= $question->template_id?>-<?= $question->id?>" height="50"></canvas>
                                                        <script>
                                                          let ctx_<?=$question->id?> = document.querySelector('#checkbox-canvas-<?= $question->template_id?>-<?= $question->id?>')
                                                          let chartData_<?=$question->id?> = {
                                                            labels: [],
                                                            datasets: [
                                                              {
                                                                label: ['Question: <?= $question->question?>'],
                                                                data: [],
                                                                
                                                                borderWidth: 1
                                                              }
                                                            ]
                                                          }
                                                          let chartOptions_<?=$question->id?> = {
                                                            scales: {
                                                              yAxes: [{
                                                                  ticks: {
                                                                      beginAtZero: true,
                                                                      precision: 0
                                                                  }
                                                              }]
                                                            }
                                                          }
                                                          const checkboxChart_<?=$question->id?> = new Chart(ctx_<?=$question->id?>,{
                                                            type: 'bar',
                                                            data: chartData_<?=$question->id?>,
                                                            options: chartOptions_<?=$question->id?>
                                                          });
                                                          <?php $choices = [0 => 'Yes', 1 => 'No']; ?>
                                                          <?php foreach( $choices as $value ){ ?>
                                                            chartData_<?=$question->id?>.labels.push('<?= $value; ?>');                                                            
                                                            <?php 
                                                              $count = 0;
                                                              foreach($question->survey_answer as $answers){
                                                                
                                                                if($answers->answer == $value){
                                                                  $count++;
                                                                }
                                                              }
                                                            ?>
                                                            chartData_<?=$question->id?>.datasets[0].data.push(<?= $count ?>);
                                                          <?php } ?>
                                                          checkboxChart_<?=$question->id?>.update();
                                                        </script>
                                                      <?php
                                                    break;
                                                    case 12: //rating //to be checked
                                                      ?>
                                                        <?php foreach($question->survey_answer as $answers){ ?>
                                                          <div class="alert alert-dark">
                                                            <?php for($x = 1; $x <= $answers->answer; $x++){ ?>
                                                              <button type="button" class="btnrating btn btn-warning btn-lg" data-attr="1" id="rating-star-1">
                                                                  <i class="fa fa-star" aria-hidden="true"></i>
                                                              </button>
                                                            <?php } ?>

                                                            <?php for($x = $answers->answer; $x < 5; $x++){ ?>
                                                              <button type="button" class="btnrating btn btn-default btn-lg" data-attr="1" id="rating-star-1">
                                                                  <i class="fa fa-star" aria-hidden="true"></i>
                                                              </button>
                                                            <?php } ?>
                                                            <h2 class="bold rating-header" style="display: inline-block;font-size: 21px;margin-left: 19px;">
                                                              <span class="selected-rating"><?= $answers->answer; ?></span><small> / 5</small>
                                                            </h2>                                                            
                                                          </div>
                                                        <?php } ?>                                                        
                                                      <?php
                                                    break;
                                                    case 13: // statement
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 14: // websites
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 15: //Dropdown
                                                      ?>
                                                        <canvas id="drop-down-canvas-<?= $question->template_id?>-<?= $question->id?>" height="50"></canvas>
                                                        <script>
                                                          let ctx_<?=$question->id?> = document.querySelector('#drop-down-canvas-<?= $question->template_id?>-<?= $question->id?>')
                                                          let chartData_<?=$question->id?> = {
                                                            labels: [],
                                                            datasets: [
                                                              {
                                                                label: ['Question: <?= $question->question?>'],
                                                                data: [],
                                                                
                                                                borderWidth: 1
                                                              }
                                                            ]
                                                          }
                                                          let chartOptions_<?=$question->id?> = {
                                                            scales: {
                                                              yAxes: [{
                                                                  ticks: {
                                                                      beginAtZero: true,
                                                                      precision: 0
                                                                  }
                                                              }]
                                                            }
                                                          }
                                                          const checkboxChart_<?=$question->id?> = new Chart(ctx_<?=$question->id?>,{
                                                            type: 'bar',
                                                            data: chartData_<?=$question->id?>,
                                                            options: chartOptions_<?=$question->id?>
                                                          });
                                                          <?php
                                                            foreach($question->questions as $choices){
                                                              ?>
                                                                chartData_<?=$question->id?>.labels.push('<?= $choices->choices_label?>');
                                                              <?php
                                                              $count = 0;
                                                              foreach($question->survey_answer as $answers){
                                                                
                                                                if($answers->answer == $choices->choices_label){
                                                                  $count++;
                                                                }
                                                              }
                                                              ?>
                                                                chartData_<?=$question->id?>.datasets[0].data.push(<?= $count ?>);
                                                              <?php
                                                            }
                                                            ?>
                                                            checkboxChart_<?=$question->id?>.update();
                                                        </script>
                                                      <?php
                                                    break;
                                                    case 16: // payment // to be checked
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 17: //date
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                            <div class="alert alert-dark">
                                                              <?=$answers->answer?>
                                                            </div>
                                                          <?php
                                                        }
                                                      }
                                                    break;
                                                    case 18: //File
                                                      echo '<div class="alert alert-dark">';
                                                      foreach($question->survey_answer as $answers){
                                                        if($answers->answer !== ''){
                                                          ?>
                                                          <a target="_blank" class="btn btn-sm btn-primary" href="<?= base_url('uploads/survey/files/'.$survey->id.'/'.$answers->answer); ?>"><i class="fa fa-file"></i> <?= $answers->answer; ?></a>
                                                          <?php
                                                        }
                                                      }
                                                      echo '</div>';
                                                    break;
                                                    case 19:
                                                    break;
                                                    default:
                                                      ?>
                                                        <small>place a chart or list of answers here</small>
                                                      <?php
                                                    break;
                                                  }
                                                };
                                              ?>
                                                
                                            </li>
                                          </div>
                                        <?php }; ?>

                                      </ul>
                                    </div>
                                  </div>
                                  <!-- end of questions and percentages list -->
                                <?php
                              }
                            ?>

                          </div>
                      </div>

                      <!-- preview section of the survey -->
                      <div class="col-sm-12 col-md-6">
                        <iframe src="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview&src=results" frameborder="0" style="width: 100%; height: 500px"></iframe>
                        <a href="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview" class="btn btn-primary btn-block text-center" target="_blank"><i class="fa fa-eye"></i> Preview on another page</a>
                      </div>
                    </div>                      
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- end card -->

            <!-- Modal Share  -->
            <div class="modal fade bd-example-modal-sm" id="modal-share-survey" tabindex="-1" role="dialog" aria-labelledby="modalShareSurveyTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-share"></i> Share</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php echo form_open_multipart('plan_headings/delete_plan_heading', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                  <?php echo form_input(array('name' => 'phid', 'type' => 'hidden', 'value' => '', 'id' => 'phid'));?>
                  <div class="modal-body">        
                      <div class=" col-12">
                        <h5 class="font-weight-normal">More Ways to Share</h5>
                        <div id="shared" class=" d-flex"></div>
                      </div>
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>


        </div>
      </div>
      <!-- end row -->
    </div>
    <!-- end container-fluid -->
  </div>
</div>
<!-- page wrapper end -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- <script type="text/javascript" src="https://nsmartrac.com/assets/js/survey.js"></script> -->
<script>

  // set storage
  store = [];
  if(!localStorage.getItem('survey_ro') || localStorage.getItem('survey_ro') === ""){
    localStorage.setItem('survey_ro', JSON.stringify(store));
  }
  store = JSON.parse(localStorage.getItem('survey_ro'));
  
  // store.some((e)=>{ 
  const checker = store.some((e)=>{ 
    if(e.id === <?=json_encode($survey->id)?>){
      return true;
    }
  });

  if(checker){
    store.map((item, i)=>{
      if(item.id === <?=json_encode($survey->id)?>){
        store.splice(i, 1);
      }
    })
  }

  if(store.length > 3){
    store.pop();
    localStorage.setItem('survey_ro', JSON.stringify(store));
  }
  <?php
    $survey->survey_theme = $survey_theme;
  ?>
  store.unshift(<?=json_encode($survey)?>);
  localStorage.setItem('survey_ro', JSON.stringify(store));
  // end of settings storage


  let dataSectionDisplay = false;

  toggleDataChart = () => {
    dataSectionDisplay = !dataSectionDisplay;
    let elements = document.getElementsByClassName('data-section');
    for(i = 0; i < elements.length; i++){
      elements[i].style.display = (dataSectionDisplay === true) ? "block" : "none";
    }
  };

  copyLink = () => {
    document.querySelector("#txtLink").select();
    document.querySelector("#txtLink").setSelectionRange(0,99999);
    
    document.execCommand('copy');
    
    setTimeout(()=>{
      document.querySelector("#btnCopyLink").innerHTML = "Copy Link";
      document.querySelector("#btnCopyLink").disabled = false;
    },2000)
    document.querySelector("#btnCopyLink").innerHTML = "Link Copied!";
    document.querySelector("#btnCopyLink").disabled = true;

  }

  $(document).on('click', '.btn-delete-survey', function(){
    var survey_id = $(this).attr('data-id');

    Swal.fire({
        title: 'Delete Survey',
        text: "Are you sure you want to delete this survey?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>survey/_delete",
                dataType:'json',
                data:{ survey_id:survey_id },
                success: function(result) {
                    if( result.is_success == 1 ){
                      Swal.fire({
                          title: 'Good job!',
                          text: "Survey was successfully deleted!",
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'Okay'
                      }).then((result) => {
                          location.href = surveyBaseUrl + '/survey';
                      });
                    }else{
                      Swal.fire({
                          title: 'Error',
                          text: 'Cannot find data',
                          icon: 'error',
                          showCancelButton: false,
                          confirmButtonText: 'Okay'
                      });
                    }                    
                },
            });
        }
    });
  });

  $(document).on('click', '.btn-share-survey', function(){
    $('#modal-share-survey').modal('show');
  });

</script>
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>
