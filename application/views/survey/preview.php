<html>
   <head>
      <link href="<?= base_url() ?>/assets/dashboard/css/bootstrap.min.css" rel="stylesheet">
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
          background: #fff;
          border-radius: 10px;
          box-shadow: 0px 3px 10px #e5e5e5;
        }
        .d-flex.h-100.justify-content-center.align-items-center 
        form#form-survey .form-main div.col-sm-3 {
              max-width: 100%;
       }

       .c-form_mainbody {
         background:#f1f1f1;
         z-index:0;
       }
        .c-btn_custom1 {
          padding-top: 5px;
          border-bottom: 3px solid #2367ad;
          /* position:relative;
          top:65px; */
        }
        .c-btn_custom2 {
          padding-top: 5px;
          border-bottom: 3px solid #e5e5e5;
          border-top: 2px solid #f2f2f2;
          border-left: 2px solid #f2f2f2;
          border-right: 2px solid #f2f2f2;
          color: #777;
          background:#fff;
          /* position:relative;
          top:65px; */
        }

        .c-img__custom3 {
          right: 0 !important;
          height: 100vh !important;
          top: 0;
          z-index:-1;
        }

        .text-custom1 {
          color:#2a3c5f;
          letter-spacing: -2px !important;
          line-height: 42px;
        }

        .c-btn__container2 {
          text-align: right;
        }
      </style>
   </head>
   <body>
      <div class="d-flex h-100 justify-content-center align-items-center">
           <?php foreach($questions as $key => $question): ?>
           <div id="question-<?= $key ?>" class="col-sm-3 <?= ($key != 0) ? "d-none" : "" ?>">
             <form id="btn-next" data-id="<?= $key ?>">
                <input type="hidden" name="question" value="<?= $question->question ?>">
                  <div class="mb-4">
                     <h1 id="question" class="h3 mb-3 font-weight-normal">
                       <?php if($question->required == 1): ?>
                         <label class="text-danger" id="required-asterisk-<?= $question->id ?>">*</label>
                       <?php endif; ?>
                       <?= $question->question ?>
                      </h1>
                     <p><?= ($question->description == 1) ? $question->description_label : ""; ?></p>
                  </div>
                  <?php foreach ($question->questions as $key1 => $quest): ?>
                    <?= $quest->survey_template_choice; ?>
                    <script>
                      document.getElementsByName('answer')[<?= $key ?>].setAttribute('required','required');
                    </script>
                  <?php endforeach; ?>
                  <button  class="btn btn-lg btn-primary mt-3" type="submit">Next</button>
             </form>
          </div>
           <?php endforeach; ?>
           <div id="question-<?= count($questions) ?>" class="col-sm-5 d-none">
             <div class="result-survey">

             </div>
             <button id="from-top" data-id="<?= count($questions) ?>"  class="btn btn-lg btn-primary" type="submit">From the Top</button>
             <a href="<?= base_url() ?>/survey/<?= $this->uri->segment(3) ?>"  class="btn btn-lg btn-primary">Submit</a>
          </div>
      </div>
    <script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      $(document).on('keyup','#contact_mobile', function (e) {
             var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
             e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
         });
        $(document).on('keyup','#contact_phone', function (e) {
             var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
             e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
         });

         function validatecard() {
             var inputtxt = $('.card-number').val();

             if (inputtxt == 4242424242424242) {
                 $('.require-validation').submit();
             } else {
                 alert("Not a valid card number!");
                 return false;
             }
         }


      $(document).on('click', '#from-top', function(e){
        var id = $(this).data('id');
        var next_id = 0;
        $('#question-'+id+'').addClass('d-none');
        $('#question-'+ next_id +'').removeClass('d-none');
        $('.result-survey').html('');
      });
      $(document).on('submit', '#btn-next', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var next_id = id+1;
        $('#question-'+id+'').addClass('d-none');
        $('#question-'+ next_id +'').removeClass('d-none');
        var data = $(this).serializeArray();

        var content = `<h1 class="h3 mb-3 font-weight-normal"> ${data[0].value} :  `;
        $.each(data, function(key, value){
          if(key == 1){
            var qoute =  '';
          }else{
            var qoute = ',';
          }
          if(value.name == "answer"){
            content += `${qoute} ${value.value}`;
          }
        });
        content += `</h1>`;
        $('.result-survey').append(content);
      });

    });
    </script>
   </body>
</html>
