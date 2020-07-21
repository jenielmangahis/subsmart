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
    $survey_completion_rate = $total_score / $length;
    
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
                    
                    
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>survey">Surveys</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>survey/workspace">Workspace</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?=$survey->title?></li>
                      </ol>
                    </nav>

                    <div class="d-flex flex-row justify-content-center">
                        <h2 class="font-weight-normal text-gray">Survey Title: <span class="font-weight-bold"><?= $survey->title ?></span> </h2>
                    </div>

                    <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-3">
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
                      <div class="col-xs-12 col-sm-6 col-md-9 py-2">
                          <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                              <a href="<?php echo base_url()?>survey/preview/<?php echo $survey->id?>?mode=preview" class="btn-block btn btn-warning" target="_blank"><i class="fa fa-eye"></i> Preview</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                              <a href="<?php echo base_url()?>survey/share/<?php echo $survey->id?>" class="btn-block btn btn-info"><i class="fa fa-share"></i> Share</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                              <a href="<?php echo base_url()?>survey/edit/<?php echo $survey->id?>" class="btn-block btn btn-success"><i class="fa fa-edit"></i> Edit Survey</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                              <a href="<?php echo base_url()?>survey/delete/<?php echo $survey->id?>" class="btn-block btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                          </div>
                        

                          <div class="card">
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
                                  <ul class="list-group survey-kpi-card">
                                    <li class="list-group-item d-flex justify-content-between">
                                      <h5 >Question</h5>
                                      <h5>Percentage</h5>
                                      <button id="toggle-chart-data" onclick="toggleDataChart()" class="btn btn-primary btn-sm animate__animated animate__heartBeat"><i class="fa fa-navicon"></i> Expand</button>                                      
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
                                                                  beginAtZero: true
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
                                                                  beginAtZero: true
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
                                                                  beginAtZero: true
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
                                                case 12: //rating //to be checked
                                                  ?>
                                                    <canvas id="rating-canvas-<?= $question->template_id?>-<?= $question->id?>" height="50"></canvas>
                                                    <script>
                                                      let ctx_<?=$question->id?> = document.querySelector('#rating-canvas-<?= $question->template_id?>-<?= $question->id?>')
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
                                                                  beginAtZero: true
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
                                                case 15: //radial
                                                  ?>
                                                    <canvas id="radial-canvas-<?= $question->template_id?>-<?= $question->id?>" height="50"></canvas>
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
                                                                  beginAtZero: true
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
                                                            chartData.datasets[0].data.push(<?= $count ?>);
                                                          <?php
                                                        }
                                                        ?>
                                                        checkboxChart.update();
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
                                                case 18:
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://nsmartrac.com/assets/js/survey.js"></script>
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

</script>
<?php echo put_footer_assets(); ?>
<?php include viewPath('includes/footer'); ?>
