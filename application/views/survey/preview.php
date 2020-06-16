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
      <link href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css">
      <script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
      <link href="<?= base_url()?>/assets/css/survey.css" rel="stylesheet">
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
          z-index: 1;
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

      </style>
   </head>
   <body>
      <?php
        if(strpos(uri_string(),'preview')){
          ?>
            <div class="preview-notification-bar" style="background-color: <?= $survey_theme->sth_secondary_color?>; color: <?= $survey_theme->sth_text_color?>">You are currently in Preview mode. <a type="button" href="<?php echo base_url()?>survey/result/<?php echo $survey->id?>">Go back</a></div>
          <?php
        }
      ?>

      <div class="d-flex h-100 justify-content-center align-items-center">
        <?php
          if($survey_theme !== null){
            ?>
              <img class="theme-image" src="<?= base_url() ?>uploads/survey/themes/<?= $survey_theme->sth_primary_image ?>" alt="<?= substr($survey_theme->sth_primary_image, 0, 4)?>-image" style="<?= $survey_theme->sth_primary_image_class?>">
            <?php
          }
        ?>

        <?php
        if(strpos(uri_string(), 'preview' ) !== true){
          $form_submission_url = '/nsmartrac/survey/answer/'. $this->uri->segment(2);
        }else{
          $form_submission_url = '/nsmartrac/survey/answer/'. $this->uri->segment(3);
        }
        ?>
        <form href="<?= $form_submission_url?>" enctype="multipart/form-data" id="form-survey" class="h-100 col-sm-12 d-flex justify-content-center align-items-center require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_test_wuRSMY1bhccBD6nNwKiMNG7t006YIzNwM8" id="payment-form" >
          <div class="form-main">
          <div id="t" class="badge d-none">00:00</div>
            <?php foreach($questions as $key => $question): ?>
              <?php if ($key == 0): ?>
                
              <?php endif; ?>
                <div id="question-<?= $key ?>" class="col-sm-3 <?= ($key != 0) ? "d-none" : "" ?>">
                  <div class="mb-4">
                      <h1 id="question" class="h3 mb-3 font-weight-bold unselectable" style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">
                        <?php if($question->required == 1): ?>
                          <label class="text-danger" id="required-asterisk-<?= $question->id ?>"  style="color: <?= $survey_theme->sth_text_color?>">*</label>
                        <?php endif; ?>
                        <?= $question->question ?>
                      </h1>
                      <p style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ''?>"><?= ($question->description == 1) ? $question->description_label : ""; ?></p>
                      
                  </div>
                  <div class="line-separator" style="background-color: <?=  $survey_theme !== null ? $survey_theme->sth_secondary_color : "" ?>"></div>
                  <?php if($question->template_id == 15): ?>
                    <select name="answer[]" class="form-control input-content " id="exampleFormControlSelect1">
                  <?php endif; ?>
                  <?php foreach ($question->questions as $key1 => $quest): ?>
                    <?= $quest->survey_template_choice; ?>
                    <?php if($question->required == 1): ?>
                      <script>
                        document.getElementsByName('answer[]')[<?= $key1 ?>].setAttribute('required','required');
                      </script>
                    <?php endif; ?>

                  <?php endforeach; ?>
                  <?php if($question->template_id == 15): ?>
                  </select>
                  <?php endif; ?>
                  <button id="btn-next" data-id="<?= $key ?>"  class="btn btn-md btn-primary mt-3" style="background-color: <?= $survey_theme !== null ? $survey_theme->sth_primary_color : ""?>; color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Next</button>
                  <?php if($key === 1){
                    ?>
                      <button id="btn-back" data-id="<?= $key ?>"  class="btn btn-md btn-outline-light mt-3">Go back</button>
                    <?php
                  }?>
              </div>
              <script>
                $('#question-<?= $key ?> .input-content [name="answer[]"]').attr('name','answer-<?= $quest->survey_template_id ?>');
              </script>
            <?php endforeach; ?>

            <div id="question-<?= count($questions) ?>" class="col-sm-6 d-none">
              <div class="result-survey">
                <h1 class="font-weight-bold" style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Survey completed!</h1>
                <div class="line-separator" style="background-color: <?=  $survey_theme !== null ? $survey_theme->sth_secondary_color : "" ?>"></div>
                <p style="color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Before submitting, make sure you have answered all of the questions given. You can go back and review your answers, or submit your answers fully. </p>
              </div>
              <!-- <button id="from-top" data-id="<?= count($questions) ?>"  class="btn btn-md  btn-outline-secondary" type="submit" style="background-color: <?= $survey_theme !== null ?  $survey_theme->sth_secondary_color : ""?>; color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Back to Top</button> -->
              <?php
                if(strpos(uri_string(), 'preview') !== false){
                  ?>
                    <p id="preview-end-note" class="border text-center rounded" >This is the end of the survey. <a id="from-top" style="color: <?= $survey_theme->sth_text_color?>" href="#">Back to top</a></p>
                    
                  <?php
                }else{
                  ?>
                    <button id="btn-submit" type="submit" class="btn btn-md btn-primary" style="background-color: <?= $survey_theme !== null ? $survey_theme->sth_primary_color : ""?>; color: <?= $survey_theme !== null ? $survey_theme->sth_text_color : ""?>">Submit Answers</button>
                    <a href="<?= base_url()?>survey/result/<?= $survey->id?>" style="color: <?=  $survey_theme !== null ? $survey_theme->sth_text_color : "" ?>"> No thanks!</a>
                  <?php
                }

              ?>
            </div>

          </div>
        </form>

        <!-- need to update the buttons-->
        <div class="page-counter unselectable">
          <!-- <button type="button" id="page-back-button" class="btn btn-sm btn-outline-light"> < </button> -->
          Page <span id="page-current-number">0</span> of <span id="page-end-number">0</span>
          <!-- <button type="button" id="page-next-button" class="btn btn-sm btn-outline-light"> > </button> -->
        </div>

        <style>
          .page-counter{
            position: absolute;
            padding: 10px;
            right: 0;
            z-index: 1;
            bottom: 0;
            margin: 20px 100px;
          }
        </style>

      </div>

    <script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/survey.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>/assets/js/survey.js"></script>
    <script type="text/javascript" src="<?= base_url()?>/assets/js/social.js"></script>

    <script>
      let pageNumber = 1;
      
      $(document).ready(function(){
        $("#t").timer({action:'start', seconds:0, });
        $('#page-current-number').html(pageNumber);
        $('#page-end-number').html('<?= count($questions) + 1?>');

        $(document).on('click', '#btn-submit', function(e){
          e.preventDefault();
          var data = new FormData(document.getElementById('form-survey'));
          var timer = $('#t').html();
          data.append('timer', parseInt(timer));
          for (var pair of data.entries()) {
              console.log(pair[0]+ ', ' + pair[1]); 
          }
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
              // window.close();
              window.location="/nsmartrac/survey";
              console.log("asjkhadjkfahdfjk");
            }
          });
        });
        
        $(document).on('click', '#from-top', function(e){
          var id = $(this).data('id');
          var next_id = 0;
          pageNumber = 1;
          $('#question-'+id+'').addClass('d-none');
          $('#question-'+ next_id +'').removeClass('d-none');
          $('#preview-end-note').addClass('d-none');
          $('.result-survey').addClass('d-none');
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

          pageNumber = prev_id + 1
          $('#page-current-number').html(pageNumber);
          $('#question-'+id+'').addClass('d-none');
          $('#question-'+ prev_id +'').removeClass('d-none');
        });


        
        $(document).on('click', '#btn-next', function(e){
          e.preventDefault();

          var id = $(this).data('id');
          var next_id = id+1;
          // var data =  $(this).serializeArray();
          var regex = /\[[^\]]*\]/g;
          // var str = $('#question-'+next_id+' #question').html();

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
          
     });
     </script>
   </body>
</html>
