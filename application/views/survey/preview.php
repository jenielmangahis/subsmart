<html>
  <head>
    <title><?=$survey->title?> | nSmarTrac Survey</title>
    <meta property="og:title" content="<?=$survey->title?> | nSmarTrac Survey">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <link href="<?= base_url() ?>/assets/dashboard/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="<?= base_url()?>/assets/css/survey.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css">
    <link href="<?= base_url()?>/assets/css/survey.css" rel="stylesheet">
    <script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
    <style>
        html, body {
          height: 100%;
          overflow: hidden;
        }

        body{
          color: <?= $survey_theme->sth_text_color?>
        }

        .unselectable{
          -webkit-touch-callout: none;
          -webkit-user-select: none;
          -khtml-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        .gu-mirror {
          position: fixed !important;
          margin: 0 !important;
          z-index: 9999 !important;
          opacity: 0.8;
          -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
          filter: alpha(opacity=80);
        }
        .gu-hide {
          display: none !important;
        }
        .gu-unselectable {
          -webkit-user-select: none !important;
          -moz-user-select: none !important;
          -ms-user-select: none !important;
          user-select: none !important;
        }
        .gu-transit {
          opacity: 0.2;
          -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
          filter: alpha(opacity=20);
        }
        .rating-header {
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .image_background{
          display: none;
        }

      .form-main {
        width: 50%;
        padding: 10px;
        margin-top: 25px;
        z-index:50;
        /* border: solid 1px black; */
      }

      .d-flex.h-100.justify-content-center.align-items-center 
      form#form-survey .form-main div.col-sm-3 {
            max-width: 100%;
      }

      .preview-notification-bar{
        position: fixed;
        width: 100%;
        padding: 5px 0;
        text-align: center;
        font-weight: bold;
        z-index: 50;
      }

      .preview-notification-bar a{
        color: white;
        text-decoration: underline;
      }

      .theme-image{
        position: absolute; 
        width: 100%;
        height: auto;
        z-index: 0;
      }
  
      .line-separator{
        padding: 3px 10px;
        background-color: #fff;
        width: 100px;
        margin: 10px 0;
      }
      
      #survey-wrapper #no-survey-wrapper{
        z-index: 15;
      }

      i{
        color: <?=($survey_theme != null)? $survey_theme->sth_text_color: "#000000"?>;
      }
      
      /* image classes according to image selected */
      .image-set-welcome-image{
        width: auto;
        height: 400px;
        z-index: 2;
      }

      .image-set-background-image{
        position: absolute;
        width: 100%;
      }

      .image-set-half-image{
        width: auto;
        height: 400px;
        z-index: 2;
      }
      
      .image-set-background{
        width: 100%;
        top: -50%;
        z-index: 2;
        height: auto;
      }

      .image-set-stacked{
          z-index: 2;
      }

    </style>
  </head>
  <body>
      <script>
        console.log(<?= json_encode($questions)?>);
        var surveyBaseUrl = '<?= base_url() ?>';
      </script>
    <?php
      $image_half = null;
      $question_length = count($questions);
      $scored_question_length = 0;
      $score_counted_questions = 0;
      foreach( $questions as $q ){
        if( $q->isScoreCounted == 1 ){
          $score_counted_questions++;
        } 
      }


      foreach($questions as $question){
        if($question->isScoreCounted == 1 ){
          $scored_question_length++;
          $score_counted_questions++;
        }
        if($question->template_id == 1 || $question->template_id == 19){
          $question_length--;
        }
      }

      if(strpos(uri_string(),'preview')){
        ?>
          <div class="preview-notification-bar" style="background-color: <?=($survey_theme != null)? $survey_theme->sth_secondary_color : "#fff"?>; color: <?= ($survey_theme != null)? $survey_theme->sth_text_color: "#000"?>">You are currently in Preview mode. 
          <?php
            if(isset($_GET['src'])){
              if($_GET['src'] == "results" ){
                ?>
                  <a type="button" class="btn btn-outline-light btn-sm" onclick="window.location.reload()" href="javascript:void(0);">Refresh</a>
                <?php
              }
            }else{
              ?>
                <a type="button" href="<?php echo base_url()?>survey/result/<?php echo $survey->id?>">Go back</a>
              <?php
            }
          ?>
          </div>
        <?php
      }
    ?>
    
    <div class="d-flex h-100 justify-content-center align-items-center">
      <?php
        if($survey_theme !== null){
          if($survey->backgroundImage == null){
            ?>
              <?php if( $survey_theme->company_id > 0 ){ ?>
                <img class="theme-image" src="<?= base_url() ?>uploads/survey/themes/<?= $survey_theme->company_id; ?>/<?= $survey_theme->sth_primary_image ?>" alt="<?= substr($survey_theme->sth_primary_image, 0, 4)?>-image" style="<?= $survey_theme->sth_primary_image_class?>">
              <?php }else{ ?>
                <img class="theme-image" src="<?= base_url() ?>uploads/survey/themes/<?= $survey_theme->sth_primary_image ?>" alt="<?= substr($survey_theme->sth_primary_image, 0, 4)?>-image" style="<?= $survey_theme->sth_primary_image_class?>">
              <?php } ?>
              
            <?php
          }else{
            ?>
              <img class="theme-image" src="<?= base_url() ?>assets/survey/template_images/<?= $survey->backgroundImage ?>" alt="<?= substr($survey->backgroundImage, 0, 4)?>-image">
            <?php
          }
        }
      ?>

      <?php
      if(strpos(uri_string(), 'preview' ) !== true){
        $form_submission_url = base_url().'survey/submit_answer/'. $this->uri->segment(2);
      }else{
        $form_submission_url = base_url().'/nsmartrac/survey/submit_answer/'. $this->uri->segment(3);
      }
      ?>

      <!-- empty div for half image to fill in -->
      <div id="image-half-background">
        <?=$image_half?>;
      </div>

      <!-- the main content of the survey -->
      <form href="<?= $form_submission_url?>" enctype="multipart/form-data" id="form-survey" class="h-100 col-sm-12 d-flex justify-content-center align-items-center require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_test_wuRSMY1bhccBD6nNwKiMNG7t006YIzNwM8" id="payment-form" >
        <div class="form-main">
        
          <div id="t" class="badge d-none">00:00</div>

          <?php
            if($survey->isNewRespondentsClosed == true){
              ?>
                <div id="no-survey-wrapper">
                  <h1><?= ($survey->closingMessage == "" || $survey->closingMessage == null) ? "This survey is closed." : $survey->closingMessage ?></h1>
                </div>
              <?php
            }else{
              if($survey->hasResponseLimit == true && $survey->count >= $survey->responseLimit){
                ?>
                  <h1>This survey has received enough respondents already. Thank you!</h1>
                <?php
              }else{
                if($survey->hasClosedDate == true && strtotime(date('Y-m-d')) >  strtotime(date($survey->closingDate)) && strtotime(date($survey->closingDate)) != -62170005208 ) {
                  ?>
                    <h1>Survey has already reached it's deadline. Thank you!</h1>
                  <?php
                }else{
                  if(count($questions) == 0){
                    ?>
                      <h1>My bad. I don't see any questions for now. Do come back later! :)</h1>
                    <?php
                  }else{
                    ?>
                      <div id="survey-wrapper">
                        
                        
                        
                        <!-- array of questions  -->
                        <?php foreach($questions as $key => $question){ ?>        

                          <!-- <img class="image-set-background-image" src="https://picsum.photos/id/1005/5760/3840"> -->
                          <div id="question-<?= $key ?>" class="col-sm-3 <?= ($key != 0) ? "d-none" : "" ?> animate__animated animate__fadeIn" style="<?=($question->template_id != null && $question->template_id == 1)?"text-align: center;" :""?>">

                            <!-- image for welcome screen -->
                            <?php
                              // if($question->image_background != ''){
                                ?>
                                  <!-- <img class="image-set-welcome-image" src="https://picsum.photos/id/1005/5760/3840"> -->
                                <?php
                                switch($question->template_id){
                                  case 1:
                                    if(!$question->image_background == "" || !$question->image_background == null){
                                      ?>
                                        <!-- <img class="image-set-welcome-image" src="https://picsum.photos/id/1005/5760/3840"> -->
                                        <img class="image-set-welcome-image" src="<?=base_url()?>uploads/survey/image_db/<?=$question->image_background?>" alt="<?=$question->image_background?>">
                                      <?php
                                    }
                                    break;
                                  case 12:
                                    ?>
                                      <!-- <img class="image-set-half-image" src="https://picsum.photos/id/1005/5760/3840">   -->
                                    <?php
                                    break;
                                  default:
                                    ?>
                                      <!-- <img class="image-set-welcome-image" src="https://picsum.photos/id/1005/5760/3840"> -->
                                    <?php
                                    break;
                                }
                              // }
                            ?>
                            
                            <div class="<?=($question->template_id != null && $question->template_id == 1)?"text-align: center;" :""?>">
                                <div class="mb-4">
                                    <h1 id="question" class="h3 mb-3 font-weight-bold unselectable" style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">
                                      <?php if($question->required == 1){ ?>
                                        <label class="text-danger" id="required-asterisk-<?= $question->id ?>"  style="color: red">*</label>
                                      <?php }; ?>
                                      <?= $question->question ?>
                                    </h1>
                                    <p style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ''?>"><?= ($question->description == 1) ? $question->description_label : ""; ?></p>
                                </div>
                                
                                <div class="line-separator" style="background-color: <?=  $survey_theme !== null ? $survey_theme->sth_secondary_color : "" ?>; <?=($question->template_id != null && $question->template_id == 1)?"margin: 10px auto;" :""?>"></div>

                                <!-- input -->
                                <?php if($question->template_id == 15){ ?>
                                  
                                <?php }; ?>

                                
                                <?php //foreach ($question->questions as $key1 => $quest):?>
                                  <?php
                                    $type = '';
                                    switch($question->template_id){
                                      case 2; // long text
                                      
                                        ?>
                                          <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                          <div class="inp ut-content form-group">
                                            <textarea class="form-control" name="answer-<?=$question->id?>" rows="5" placeholder="Enter your answer"></textarea>
                                          </div>
                                        <?php
                                        break;
                                      case 3: // single choice
                                      ?>
                                      <?php $type = 'single_choice'; ?>
                                      <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                      <?php foreach ($question->questions as $key1 => $quest){
                                          ?>
                                            <div class="input-group input-content mb-1">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                <input name="answer-<?=$question->id?>" type="radio" class="chk-survey-<?=$question->id?>" value="<?=$quest->choices_label?>" aria-label="Radio button for following text input" >
                                                </div>
                                              </div>
                                              <input type="text" class="form-control" name="choices_label[]" value="<?=$quest->choices_label?>" readonly disabled>
                                            </div>
                                          <?php
                                        }
                                        break;
                                      case 4: //checkboxes
                                      ?>
                                      <?php $type = 'checkboxes'; ?>
                                      <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                      <?php foreach ($question->questions as $key1 => $quest){
                                          ?>
                                            <div class="form-check mb-1">
                                              <input name="multiple-<?=$question->id?>[]" class="chk-survey-<?=$question->id?>" type="checkbox" aria-label="Checkbox for following text input" value="<?=$quest->choices_label?>">
                                              <label for="" class="form-check-label">
                                                <?=$quest->choices_label?>
                                              </label>
                                            </div>
                                          <?php
                                        }
                                        break;
                                      case 5: //email
                                        ?>
                                        <?php $type = 'email'; ?>
                                        <div class="form-group input-content">
                                          <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                          <input type="email" class="form-control survey-item-<?= $question->id; ?>" name="answer-<?=$question->id?>" id="for_email" placeholder="name@example.com">
                                        </div>
                                        <?php
                                        break;
                                      case 6: //number
                                        ?>
                                          <?php $type = 'number'; ?>
                                          <div class="form-group input-content">
                                            <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                            <input type="text" class="form-control survey-item-<?= $question->id; ?>" name="answer-<?=$question->id?>" value="" placeholder="Enter your answer">
                                          </div>
                                        <?php
                                        break;
                                      case 7: // file/image upload
                                        ?>
                                          <div class="form-group input-content">
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                              </div>
                                              <div class="custom-file">
                                                <input name="answer-<?=$question->id?>" data-id="<?=$question->id?>" type="file" class="custom-file-input form-control preview-file-upload" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                              </div>
                                            </div>
                                          </div>
                                        <?php
                                        break;
                                      case 8: // Phone Number
                                        ?>
                                          <?php $type = 'phone'; ?>
                                          <div class="form-group input-content">
                                            <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                            <input type="text" class="form-control valid survey-item-<?= $question->id; ?>" name="answer-<?=$question->id?>" id="contact_phone" placeholder="(555) 555-5555" aria-invalid="false">
                                          </div>
                                        <?php
                                        break;
                                      case 9:  // short text
                                        ?>
                                          <?php $type = 'short_text'; ?>
                                          <div class="form-group input-content">
                                            <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                            <input type="text" class="form-control survey-item-<?= $question->id; ?>" <?= $question->mincharacters > 0 ? 'minlength="'.$question->mincharacters.'"' : ''; ?> <?= $question->maxcharacters > 0 ? 'maxlength="'.$question->maxcharacters.'"' : ''; ?> name="answer-<?=$question->id?>" value="" placeholder="Enter your answer">
                                          </div>
                                        <?php
                                        break;
                                      case 11: // yes/no 
                                        ?>
                                          <div class="form-group input-content">
                                            <input type="checkbox" class="toggle-yes-no" data-id="<?= $question->id; ?>" checked data-toggle="toggle" name="answer-<?=$question->id?>"  data-on="Yes" data-off="No">
                                            <input type="hidden" name="answer-<?=$question->id?>" id="toggle-yesno-<?= $question->id; ?>" value="Yes">                                   
                                          </div>
                                        <?php
                                        break;
                                      case 12: // rating
                                        ?>
                                          <div class="form-group input-content" id="rating-ability-wrapper">
                                            <input type="hidden" id="selected_rating_<?= $question->id; ?>" name="answer-<?=$question->id?>" value="" required="required">
                                            </label>
                                            <h2 class="bold rating-header" style="">
                                              <span class="selected-rating selected-rating-<?= $question->id; ?>">0</span><small> / 5</small>
                                            </h2>
                                            <button type="button" class="btnrating btn btn-default btn-lg" data-id="<?= $question->id; ?>" data-attr="1" id="<?= $question->id; ?>-rating-star-1">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btnrating btn btn-default btn-lg" data-id="<?= $question->id; ?>" data-attr="2" id="<?= $question->id; ?>-rating-star-2">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btnrating btn btn-default btn-lg" data-id="<?= $question->id; ?>" data-attr="3" id="<?= $question->id; ?>-rating-star-3">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btnrating btn btn-default btn-lg" data-id="<?= $question->id; ?>" data-attr="4" id="<?= $question->id; ?>-rating-star-4">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btnrating btn btn-default btn-lg" data-id="<?= $question->id; ?>" data-attr="5" id="<?= $question->id; ?>-rating-star-5">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </button>
                                          </div>
                                        <?php
                                        break;
                                      case 13: // statement
                                        ?>
                                          <?php $type = 'statement'; ?>
                                          <div class="form-group input-content">
                                            <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                            <textarea class="form-control" <?= $question->mincharacters > 0 ? 'minlength="'.$question->mincharacters.'"' : ''; ?> <?= $question->maxcharacters > 0 ? 'maxlength="'.$question->maxcharacters.'"' : ''; ?> name="answer-<?=$question->id?>" rows="5" placeholder="Enter your answer"></textarea>
                                          </div>
                                        <?php
                                        break;
                                      case 14: // website
                                        ?>
                                          <?php $type = 'website'; ?>
                                          <div class="form-group input-content">
                                            <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                            <input type="url" class="form-control survey-item-<?= $question->id; ?>" name="answer-<?=$question->id?>" id="for_email" placeholder="www.yourdomain.com/">
                                          </div>
                                        <?php
                                        break;
                                      case 15: //dropdown
                                        ?>
                                          <select name="answer-<?=$question->id?>" class="form-control input-content " id="exampleFormControlSelect1">
                                            <option value="">Please Select</option>
                                            <?php
                                              foreach ($question->questions as $key1 => $quest){
                                                ?>
                                                  <option value="<?=$quest->choices_label?>"><?=$quest->choices_label?></option>

                                                <?php
                                              }
                                            ?>
                                          </select>
                                        <?php
                                        break;
                                      case 16: //payment
                                        ?>
                                          <div class='form-row row'>
                                            <div class='col-xs-12 form-group required'>
                                                <label class='control-label'>Name on Card</label> <input
                                                    class='form-control' size='4' type='text'>
                                            </div>
                                          </div>
                      
                                          <div class='form-row row'>
                                              <div class='col-xs-12 form-group card required'>
                                                  <label class='control-label'>Card Number</label> <input
                                                      autocomplete='off' class='form-control card-number' size='20'
                                                      type='text'>
                                              </div>
                                          </div>
                        
                                          <div class='form-row row'>
                                              <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                  <label class='control-label'>CVC</label> <input autocomplete='off'
                                                      class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                      type='text'>
                                              </div>
                                              <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                  <label class='control-label'>Expiration Month</label> <input
                                                      class='form-control card-expiry-month' placeholder='MM' size='2'
                                                      type='text'>
                                              </div>
                                              <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                  <label class='control-label'>Expiration Year</label> <input
                                                      class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                      type='text'>
                                              </div>
                                          </div>
                        
                                          <div class='form-row row'>
                                              <div class='col-md-12 error form-group hide'>
                                                  <div class='alert-danger alert'>Please correct the errors and try
                                                      again.</div>
                                              </div>
                                          </div>
                                        <?php
                                        break;
                                      case 17: //date
                                        ?>
                                          <div class="form-group input-content">
                                            <div class="form-survey-item-error-<?= $question->id; ?>"></div>
                                            <input type="date" class="form-control survey-item-<?= $question->id; ?>" name="answer-<?=$question->id?>" value="" placeholder="Enter your answer">
                                          </div>
                                        <?php
                                        break;
                                      case 18: //file
                                        ?>
                                          <div class="form-group input-content">
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                              </div>
                                              <div class="custom-file">
                                                <input name="answer-<?=$question->id?>" data-id="<?=$question->id?>" type="file" class="custom-file-input" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                              </div>
                                            </div>
                                          </div>
                                        <?php
                                        break;
                                      default:
                                        break;
                                    }
                                  ?>
                                  
                                  <?php if($question->required == 1): ?>
                                    <script>
                                      <?php if($question->maxcharacters != 0){
                                        ?>
                                        <?php
                                      }?>
                                      <?php if($question->mincharacters != 0){
                                        ?>
                                        <?php
                                      }?>
                                    </script>
                                  <?php endif; ?>
                                <?php if($question->template_id == 15){ ?>
                                <!-- </select> -->
                                <?php }; ?>

                                <!-- next button -->
                                <button id="btn-next" data-survey-item-type="<?= $type; ?>" data-survey-item="<?=$question->id?>" data-id="<?= $key ?>" data-temp-id="<?=$question->template_id?>" data-is-required="<?=$question->required?>" data-correct-answer="<?=$question->correctAnswer?>" class="btn btn-md btn-primary mt-3" style="background-color: <?= $survey_theme !== null ? $survey_theme->sth_primary_color : ""?>; color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>"><?= ($question->custom_button_text == "" || $question->custom_button_text == null) ? "Next" : $question->custom_button_text ?></button>
                                <?php if($key >= 1){
                                  ?>
                                    <button id="btn-back" data-id="<?= $key ?>"  class="btn btn-md btn-outline-light mt-3">Go back</button>
                                  <?php
                                }?>
                              </div>
                            </div>
                          <script>
                            $('#question-<?= $key ?> .input-content [name="answer[]"]').attr('name','answer-<?= $key ?>');
                          </script>
                        <?php }; ?>
                        <!-- end of questions list -->

                        <!-- completed message -->
                        <div id="question-<?= count($questions) ?>" class="col-sm-6 d-none animate__animated animate__fadeInRight">

                          <div class="result-survey">
                            <h1 class="font-weight-bold" style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Survey completed!</h1>
                            <?php if($survey->isScoreMonitored == 1){ ?>
                              <div class="survey-score"></div>
                            <?php } ?>
                            <div class="line-separator" style="background-color: <?=  $survey_theme !== null ? $survey_theme->sth_secondary_color : "" ?>"></div>
                            
                            <!-- <button id="from-top" data-id="<?= count($questions) ?>"  class="btn btn-md  btn-outline-secondary" type="submit" style="background-color: <?= $survey_theme !== null ?  $survey_theme->sth_secondary_color : ""?>; color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Back to Top</button> -->
                            <?php                            
                              if(strpos(uri_string(), 'preview') !== false){
                                if(isset($_GET["src"])){
                                  ?>
                                    <p id="preview-end-note" class="border text-center rounded" >This is the end of the survey. <a id="from-top" style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color:"#000"?>" href="#">Back to top</a> or <a style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color: "#000"?>" href="<?= ($survey->canRedirectOnComplete == true && $survey->redirectionLink != "") ? ($survey->redirectionLink) : (base_url()."survey/edit/". $survey->id) ?>">redirect to another page.</a></p>
                                  <?php
                                }else{
                                  ?>
                                    <p style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Before submitting, make sure you have answered all of the questions given. You can go back and review your answers, or submit your answers fully. </p>
                                    <a id="from-top" class="btn btn-block btn-outline " style="color: <?= $survey_theme->sth_text_color?>" href="#">Back to top</a>
                                  <?php
                                }
                              }else{
                                ?>
                                  <div class="result-survey">
                                    <p style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Before submitting, make sure you have answered all of the questions given. You can go back and review your answers, or submit your answers fully. </p>
                                    <button id="btn-submit" type="submit" class="btn btn-md btn-primary" style="background-color: <?= $survey_theme !== null ? $survey_theme->sth_primary_color : ""?>; color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Submit Answers</button><br />
                                    <a id="from-top" style="color: <?= $survey_theme->sth_text_color?>;margin-top: 20px; display: block;" href="#">I would like to check my answers once more</a>
                                  </div>
                                <?php
                              }
                            ?>
                          </div>
                          
                        </div>
                        <!-- end of completed message -->

                      </div>
                    <?php
                  }
                ?>
              <?php
            }
          }
        ?>
        <?php
      }
    ?>


        </div>
      </form>

      <!-- need to update the buttons-->
      <div class="page-counter unselectable">
        <?php
          if($survey->hasProgressBar == true){
            ?>
              <div class="progress">
                <div id="survey-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style=" background-color: <?= $survey_theme->sth_secondary_color?>"></div>
              </div>
            <?php
          }
        ?>
        
        <span class="text-right d-block">
          <!-- <button type="button" id="page-back-button" class="btn btn-sm btn-outline-light"> < </button> -->
            Page <span id="page-current-number">0</span> of <span id="page-end-number">0</span>
          <!-- <button type="button" id="page-next-button" class="btn btn-sm btn-outline-light"> > </button> -->
        </span>
      </div>

      <style>
        .page-counter{
          position: absolute;
          padding: 10px;
          right: 0;
          z-index: 1;
          bottom: 0;
          margin: 20px 100px;
          width: 350px;
        }
      </style>

    </div>
    <script src="<?= base_url() ?>/assets/js/survey.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>/assets/js/survey.js"></script>
    <script type="text/javascript" src="<?= base_url()?>/assets/js/social.js"></script>

    <script>
      const urlParams = new URLSearchParams(window.location.search);
      const sessionId = Math.floor(100000000 + Math.random() * 900000000);
      let elm;
      let pageNumber = 1;
      let numQuestions = <?=$question_length?>;
      let answeredFields = 0;
      let progress = 0;
      let surveyScore = 0;
      let scoredQuestionLength = <?=$scored_question_length?>;


      $(document).ready(function(){
        $("#t").timer({action:'start', seconds:0, });
        $('#page-current-number').html(pageNumber);
        $('#page-end-number').html('<?= count($questions) + 1?>');

        function validateEmail(email) {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return emailReg.test( email );
        }

        function is_valid_url(url) {
            return /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
        }

        $(document).on('click', '#btn-submit', function(e){
          e.preventDefault();
          var data = new FormData(document.getElementById('form-survey'));
          var timer = $('#t').html();
          data.append('timer', parseInt(timer));
          data.append('session', sessionId)
          // for (var pair of data.entries()) {
          //     console.log(pair[0]+ ', ' + pair[1]); 
          // }
          var url = $('#form-survey').attr('href');
          
          $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            type: 'POST',
            cache:false,
            contentType: false,
            processData: false,
            success: function(res){
              <?php
                if($survey->canRedirectOnComplete == 1){
                  if(isset($_GET['st'])){
                    if($survey->redirectionLink != '' || $survey->redirectionLink != null ){
                      ?>
                        location.href ="<?=$survey->redirectionLink; ?>"
                      <?php
                    }else{
                      ?>
                        window.location="https://nsmartrac.com";
                      <?php
                    }
                  }else{
                      ?>  
                        window.location='<?=(base_url()."survey/edit/". $survey->id)?>'
                      <?php
                  }
                }else{
                    ?>
                      window.location="https://nsmartrac.com";
                    <?php
                }
              ?>
              
            }
          });
        });

        $(document).on('click', '#from-top', function(e){
          var id = $(this).data('id');
          var next_id = 0;
          pageNumber = 1;
          surveyScore = 0;

          answeredFields = 0;
          progress = answeredFields / numQuestions * 100;
          $('#survey-progress-bar').css("width", progress+"%");

          pageNumber = 1
          $('#page-current-number').html(pageNumber);

          $('#question-'+id+'').addClass('d-none');
          $('#question-'+ next_id +'').removeClass('d-none');
          $('#preview-end-note').addClass('d-none');
          $('.result-survey').addClass('d-none');
          $('.survey-score').html('');
        });
        
        $(document).on('click', '#btn-back', function(e){
          e.preventDefault();

          var id = $(this).data('id');
          var prev_id = id-1;
          // var data =  $(this).serializeArray();
          var regex = /\[[^\]]*\]/g;
          // var str = $('#question-'+next_id+' #question').html();
          if($('#question-'+prev_id+' #question').html() != undefined){
            var str = $('#question-'+prev_id+' #question').html().trim();
          }else{
            var str = ``;
          }

          if(str.match(regex) == null){

          }else{

            var question = ``;
            $.each( str.split(regex), function(key, value){
              if(str.match(regex)[key] != undefined){
                var question_id = str.match(regex)[key].slice(0, -1).split("-")[1];
                var question_answer = $('#question-'+id+' [name*="answer"]').val();
                question += value + question_answer;
              }else{
                question += value;
              }
            });
            $('#question-'+prev_id+' #question').html(question);
          }

          answeredFields = answeredFields - 1;
          progress = answeredFields / numQuestions * 100;
          $('#survey-progress-bar').css("width", progress+"%");

          pageNumber = prev_id + 1
          $('#page-current-number').html(pageNumber);
          $('#question-'+id+'').addClass('d-none');
          $('#question-'+ prev_id +'').removeClass('d-none');
        });

        $(document).on('click', '#btn-next', function(e){
          e.preventDefault()

          var id = $(this).data('id');
          var tempid = $(this).data('temp-id');
          var survey_type = $(this).attr('data-survey-item-type');
          var survey_item_id = $(this).attr('data-survey-item');
          var next_id = id+1;
          var isRequired = $(this).data('is-required')
          var data =  $(this).serializeArray();
          var regex = /\[[^\]]*\]/g;
          // var str = $('#question-'+next_id+' #question').html();
          var value = $('#question-'+id+' [name*="answer"]').val();
          let correctAnswer = $(this).data('correct-answer');

          //Count correct answer
          if( survey_type == 'checkboxes' || survey_type == 'single_choice' ){
            $('.chk-survey-'+survey_item_id).each(function () {
                if( $(this).val() == correctAnswer && $(this).is(':checked') ){
                  surveyScore++;
                }
            });
          }else{
            if(value == correctAnswer){
              surveyScore++;
            }  
          }

          /*if(value){
            answeredFields = (tempid === 12 || tempid === 1) ? null :  answeredFields++;            
          }*/        

          //if(urlParams.get('mode') != 'preview'){
            if(isRequired && $('#question-'+id+' [name*="answer"]').val() == ""){
             // toastr["error"]("This field should not be empty");
              $('.form-survey-item-error-'+survey_item_id).fadeIn("normal", function() {
                $(this).html('<div class="alert alert-danger" role="alert">This field is required</div>');
              });     
              //window.alert('This field should not be empty');
              return;
            }else{
              if( isRequired && (survey_type == 'checkboxes' || survey_type == 'single_choice') ){
                var selected = 0;
                $('.chk-survey-'+survey_item_id).each(function () {
                    if( $(this).is(':checked') ){
                      selected++;
                    }
                });

                if( selected == 0 ){
                  $('.form-survey-item-error-'+survey_item_id).fadeIn("normal", function() {
                    $(this).html('<div class="alert alert-danger" role="alert">This field is required</div>');
                  });  

                  return;

                }
              }
            }

            var input_val = $('.survey-item-'+survey_item_id).val();
            if( survey_type == 'email' ){      
              if( !validateEmail(input_val) ){
                $('.form-survey-item-error-'+survey_item_id).fadeIn("normal", function() {
                  $(this).html('<div class="alert alert-danger" role="alert">Not a valid email</div>');
                });
                return;
              }else{
                $('.form-survey-item-error-'+survey_item_id).hide();
              }
            }else if( survey_type == 'website' ){
              if( !is_valid_url(input_val) ){
                $('.form-survey-item-error-'+survey_item_id).fadeIn("normal", function() {
                  $(this).html('<div class="alert alert-danger" role="alert">Not a valid url</div>');
                });
                return;
              }else{
                $('.form-survey-item-error-'+survey_item_id).hide();
              }
            }else if( survey_type == 'number' ){
              var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
              if(!numberRegex.test(input_val)) {
                 $('.form-survey-item-error-'+survey_item_id).fadeIn("normal", function() {
                  $(this).html('<div class="alert alert-danger" role="alert">Not a valid number</div>');
                });
                return;
              }else{
                $('.form-survey-item-error-'+survey_item_id).hide();
              }  
            }else{
              $('.form-survey-item-error-'+survey_item_id).hide();
            }

          <?php
            if(!isset($_GET["src"])){
              if($survey->isScoreMonitored == 1){
                ?>
                  if(pageNumber == <?= count($questions)?>){                    
                    if( scoredQuestionLength > 0 ){
                      $('.survey-score').html('<span class="spinner-border spinner-border-sm m-0"></span>');
                      setTimeout(() => {
                        $('.survey-score').fadeIn("normal", function() {
                          $(this).html('<div class="alert alert-success" role="alert">Your score is '+surveyScore+' out of '+scoredQuestionLength+'</div>');
                        });
                        //window.alert(`Your score is ${surveyScore} out of <?= $scored_question_length?>`)
                      }, 1000);
                    }                    
                  }
                <?php
              }
            }
          ?>

          if(pageNumber === <?= count($questions)?>){
            $('#question-'+id+'').removeClass('d-none');
            $('#question-'+ next_id +'').addClass('d-none');
            $('#preview-end-note').removeClass('d-none');
            $('.result-survey').removeClass('d-none');
          }
          
          if($('#question-'+next_id+' #question').html() != undefined){
            var str = $('#question-'+next_id+' #question').html().trim();
          }else{
            var str = ``;
          }

          if(str.match(regex) == null){
          }else{

            var question = ``;
            $.each( str.split(regex), function(key, value){
              if(str.match(regex)[key] != undefined){
                var question_id = str.match(regex)[key].slice(0, -1).split("-")[1];
                var question_answer = $('#question-'+id+' [name*="answer"]').val();
                question += value + question_answer;
              }else{
                question += value;
              }
            });
            
            $('#question-'+next_id+' #question').html(question);
          }
            
          answeredFields = answeredFields + 1;
          progress       = answeredFields / numQuestions * 100;
          $('#survey-progress-bar').css("width", progress+"%");
          pageNumber = next_id + 1;
          $('#page-current-number').html(pageNumber);
          $('#question-'+id+'').addClass('d-none');
          $('#question-'+ next_id +'').removeClass('d-none');

        });
        
        $(document).on('click', '#page-back-button', function(e){
          e.preventDefault();
          var id = $(this).data('id');
          var prev_id = id-1;
          // var data =  $(this).serializeArray();
          var regex = /\[[^\]]*\]/g;
          // var str = $('#question-'+next_id+' #question').html();
          if(pageNumber <= 0){
            pageNumber = 1;
          }

          if($('#question-'+prev_id+' #question').html() != undefined){
            var str = $('#question-'+prev_id+' #question').html().trim();
          }else{
            var str = ``;
          }

          if(str.match(regex) == null){

          }else{

            var question = ``;
            $.each( str.split(regex), function(key, value){
              if(str.match(regex)[key] != undefined){
                var question_id = str.match(regex)[key].slice(0, -1).split("-")[1];
                var question_answer = $('#question-'+id+' [name*="answer"]').val();
                question += value + question_answer;
              }else{
                question += value;
              }
            });
            $('#question-'+prev_id+' #question').html(question);
          }
          
          pageNumber = pageNumber - 1
          $('#page-current-number').html(pageNumber);
          $('#question-'+id+'').addClass('d-none');
          $('#question-'+ prev_id +'').removeClass('d-none');
        });

        $(document).on('click', '#page-next-button', function(e){
          e.preventDefault();
          var id = $(this).data('id');
          var next_id = id+1;
          // var data =  $(this).serializeArray();
          var regex = /\[[^\]]*\]/g;
          // var str = $('#question-'+next_id+' #question').html();
          if($('#question-'+next_id+' #question').html() != undefined){
            var str = $('#question-'+next_id+' #question').html().trim();
          }else{
            var str = ``;
          }

          if(str.match(regex) == null){

          }else{

            var question = ``;
            $.each( str.split(regex), function(key, value){
              if(str.match(regex)[key] != undefined){
                var question_id = str.match(regex)[key].slice(0, -1).split("-")[1];
                var question_answer = $('#question-'+id+' [name*="answer"]').val();
                question += value + question_answer;
              }else{
                question += value;
              }
            });
            $('#question-'+next_id+' #question').html(question);
          }
          
          pageNumber = pageNumber + 1;
          if(pageNumber > <?= count($questions) + 1?>){
            pageNumber = pageNumber - 1;
          }
          $('#page-current-number').html(pageNumber);
          $('#question-'+id+'').addClass('d-none');
          $('#question-'+ next_id +'').removeClass('d-none');
        });
        
      });

      
      $(".btnrating").on('click',(function(e) {

      var previous_value = $("#selected_rating_"+qid).val();
      var isSelected = false;
      var selected_value = $(this).attr("data-attr");
      var qid = $(this).attr('data-id');
      
      if(previous_value == ''){
        answeredFields++;
      }

      $("#selected_rating_"+qid).val(selected_value);

      $(".selected-rating-"+qid).empty();
      $(".selected-rating-"+qid).html(selected_value);

      for (i = 1; i <= selected_value; ++i) {
        $("#"+qid+"-rating-star-"+i).addClass('btn-warning');
        //$("#"+qid+"-rating-star-"+i).toggleClass('btn-default');
      }
      
      selected_value++;
      for (ix = selected_value; ix <= 5; ix++) {        
        //$("#"+qid+"-rating-star-"+ix).toggleClass('btn-warning');
        $("#"+qid+"-rating-star-"+ix).removeClass('btn-warning');
      }

    }));
    </script>


    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
    <script type="text/javascript">
    $(function() {
        var $form         = $(".require-validation");
      $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                              'input[type=text]', 'input[type=file]',
                              'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;
            $errorMessage.addClass('hide');
      
            $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
          
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
        
      });
          
      function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                //  $form.get(0).submit();
            }
      }

      $(document).on('change', '.toggle-yes-no', function(){
        var qid = $(this).attr('data-id');
        if( $(this).is(':checked') ){
          $('#toggle-yesno-'+qid).val('Yes');
        }else{
          $('#toggle-yesno-'+qid).val('No');
        }
      });
    });
    </script>
  </body>
</html>
