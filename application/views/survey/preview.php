<html>
   <head>
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
         /* .image_background{

         } */

        .form-main {
              width: 50%;
              padding: 10px;
              margin-top: 25px;
              /* border: solid 1px black; */
        }

        .image_background{
          display:none;
        }
        .d-flex.h-100.justify-content-center.align-items-center 
        form#form-survey .form-main div.col-sm-3 {
              max-width: 100%;
       }
      </style>
   </head>
   <body>
     
      <div class="d-flex h-100 justify-content-center align-items-center">
        <form href="/nsmartrac/survey/answer/<?= $this->uri->segment(3) ?>" enctype="multipart/form-data" id="form-survey" class="h-100 col-sm-12 d-flex justify-content-center align-items-center require-validation" data-cc-on-file="false"
                                                    data-stripe-publishable-key="pk_test_wuRSMY1bhccBD6nNwKiMNG7t006YIzNwM8"
                                                    id="payment-form" >
          <div class="form-main">
          <div id="t" class="badge d-none">00:00</div>
           <?php foreach($questions as $key => $question): ?>
             <?php if ($key == 0): ?>
               <img src="<?= base_url() ?>uploads/survey/<?= $question->image_background ?>"  
               <?php
               $pimg = $question->image_position;
               
               if ( $pimg == 1 ){ echo "class='image_background position-absolute w-100 h-100'";  }
                      elseif( $pimg == 2 ){ echo "class='image_background  w-25 h-20' style='top:76px'"; }
                      elseif( $pimg == 3 ){ echo "class='image_background position-absolute w-0 h-25' style='right: 237px'"; }
                    else{ echo "class='image_background position-absolute w-0 h-25' style='top:400px'" ; }
               ?> 
               alt="<?= $question->image_background ?>">
             <?php endif; ?>
           <div id="question-<?= $key ?>" class="col-sm-3 <?= ($key != 0) ? "d-none" : "" ?>">
                  <div class="mb-4">
                     <h1 id="question" class="h3 mb-3 font-weight-normal">
                       <?php if($question->required == 1): ?>
                         <label class="text-danger" id="required-asterisk-<?= $question->id ?>">*</label>
                       <?php endif; ?>
                       <?= $question->question ?>
                      </h1>
                     <p><?= ($question->description == 1) ? $question->description_label : ""; ?></p>
                  </div>
                  <?php if($question->template_id == 15): ?>
                    <select name="answer[]" class="form-control input-content" id="exampleFormControlSelect1">
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
                  <button id="btn-next" data-id="<?= $key ?>"  class="btn btn-lg btn-primary mt-3">Next</button>
          </div>
          <script>
            $('#question-<?= $key ?> .input-content [name="answer[]"]').attr('name','answer-<?= $quest->survey_template_id ?>');
          </script>
           <?php endforeach; ?>
           <div id="question-<?= count($questions) ?>" class="col-sm-6 d-none">
             <div class="result-survey">
               <h1>Thank You For Taking Our Survey!</h1>
             </div>
             <button id="from-top" data-id="<?= count($questions) ?>"  class="btn btn-lg btn-primary" type="submit">From the Top</button>
             <button id="btn-submit" type="submit" class="btn btn-lg btn-primary">Submit</button>
          </div>
          </div>
        </form>
      </div>

    <script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/survey.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js"></script>
    <script type="text/javascript" src="http://localhost/nsmartrac/assets/js/survey.js"></script>
    <script type="text/javascript" src="http://localhost/nsmartrac/assets/js/social.js"></script>


    <script>
    $(document).ready(function(){

            $("#t").timer({action:'start', seconds:0, });


      $(document).on('click', '#btn-submit', function(e){
        e.preventDefault();
        var data = new FormData(document.getElementById('form-survey'));
        var timer = $('#t').html();
        data.append('timer', parseInt(timer));
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
            window.location="/nsmartrac/survey";
          }
        });
      });
      $(document).on('click', '#from-top', function(e){
        var id = $(this).data('id');
        var next_id = 0;
        $('#question-'+id+'').addClass('d-none');
        $('#question-'+ next_id +'').removeClass('d-none');
        $('.result-survey').html('');
      });
      $(document).on('click', '#btn-next', function(e){
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
