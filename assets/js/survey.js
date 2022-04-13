// global settings
// const surveyBaseUrl = "/nsmartrac/"; // local
//const surveyBaseUrl = `${window.location.origin}/` ; // online

$(document).ready(function(){
  $(document).on('submit', '#frm-add-survey', function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serializeArray();
    $.ajax({
      url: url,
      data: data,
      dataType: 'json',
      type: 'post',
      success: function(res){
        toastr["success"]("Successfully Added!");
        var content = `<div class="col-sm-2">
          <div id="survey-card" data-id="${res.data['id']}" class="card pt-0 2">
              <div class="card-body"><i class="icon-design <?= $question->template_icon ?>" style="background-color:<?= $question->template_color ?>;"></i> <?= $question->template_title ?>
                <h5 class="card-title">${res.data['title']}</h5>
                </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-end align-items-center flex-row">
                <div class="btn-group ">
                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Settings
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Edit</a>
                      <a id="btn-delete-survey" data-id="${res.data['id']}" class="dropdown-item" href="#">Delete</a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>`;

        $('#frm-add-survey')[0].reset();
        $('#exampleModal').modal('hide');
        $('#survey-content').append(content);
      }
    });
  });
  $(document).on('click', '#btn-delete-survey', function(e){
     e.stopPropagation();
    console.log($(this));
    var id = $(this).data('id');
    $.ajax({
      url: surveyBaseUrl + '/survey/delete/'+id,
      type: 'GET',
      dataType: 'json',
      success: function(res){
        toastr["error"]("Successfully Removed!");
        $('#survey-card[data-id="'+id+'"]').parent().remove();
      }
    });
  });

  $(document).on('click', '#btn-result-survey', function(e){
    e.stopPropagation();
    var id = $(this).data('id');
    var url = $(this).attr('href');
    window.location.href = url;
  });
  $(document).on('click', '#btn-share-survey', function(e){
    e.stopPropagation();
    var id = $(this).data('id');
    var url = $(this).attr('href');
    window.location.href = url;
  });

  $(document).on('click', '#btn-delete-survey', function(e){
    e.stopPropagation();
    var id = $(this).data('id');
    $.ajax({
      url: surveyBaseUrl + '/survey/delete/'+id,
      type: 'GET',
      dataType: 'json',
      success: function(res){
        toastr["error"]("Successfully Removed!");
        $('#survey-card[data-id="'+id+'"]').parent().remove();
      }
    });
  });

  $(document).on('click', '#survey-card', function(e){
    e.preventDefault();
    window.location.href = surveyBaseUrl + "/survey/" + $(this).data('id');
  });

  $(document).on('click', '#btn-question-delete', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
      url: surveyBaseUrl + '/survey/delete/question/' +id,
      type: 'GET',
      dataType: 'json',
      success: function(res){
          toastr["error"]("Successfully Removed!");
          $('#container-'+id+'').remove();
          // $('#btn-question-delete[data-id="'+id+'"]').parent().parent().parent().parent().remove();
      }
    });
  });


    $(document).on('click', '#add-question-bottom', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      var id = $(this).parent().parent().parent().parent().parent().attr('id');
      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(res){
          toastr["success"]("Successfully Added!");
            if(res.data.tid == 4 || res.data.tid == 3 || res.data.tid == 15){
              var choice_btn = `<button id="add-question-choice" data-id="${res.data.id}" data-template-id="${res.data.tid}" class="btn btn-success btn-sm" type="button" name="button">Add Choice</button>`;
              var data = res.data.test;
            }else{
              var choice_btn = ``;
              var data = res.data.data;
              // var data = res.data.data;
              var data = ``;
            }
          var append = `<div id="container-${res.data.id}" class="col-sm-12">
              <div class="card">
                  <div class="card-body p-0">
                  <form action="${surveyBaseUrl}/survey/update/question/${res.data.id}" id="frm-update-question" method="post" accept-charset="utf-8">
                      <div class="d-flex justify-content-between">
                        <h5 class="card-title">
                        ${res.data.template_title}
                        </h5>
                        <div class="dropleft">
                          <button  class="btn dropdown-toggle" type="button"  id="dropdownMenuButton" name="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="text-dark fa fa-ellipsis-h"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" id=""  data-id="${res.data.id}">Settings</a>
                            <a class="dropdown-item" href="#" id="btn-question-delete"  data-id="${res.data.id}">Delete</a>
                          </div>
                        </div>
                          </div>
                      <input type="hidden" name="survey_id" value="${res.data.id}">
                      <div class="form-group">
                          <input type="text" class="form-control" name="question" value="${res.data.question}" placeholder="Enter your question">
                        </div>
                        <div id="choices">
                        ${data}
                      </div>
                        <div class="d-flex justify-content-end">
                          ${choice_btn}
                        </div>
                      </form>
                      <div class="dropdown btn-add-question-bottom">
                        <button class="btn btn-light dropdown-toggle" type="button" id="btn-add-question-bottom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btn-add-question-bottom">
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/9" class="dropdown-item" id="add-question-bottom">Welcome Screen</a>
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/1" class="dropdown-item" id="add-question-bottom">Short Text</a>
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/2" class="dropdown-item" id="add-question-bottom">Long Text</a>
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/3" class="dropdown-item" id="add-question-bottom">Single Choice Answer</a>
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/4" class="dropdown-item" id="add-question-bottom">Multiple Choice Answer</a>
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/5" class="dropdown-item" id="add-question-bottom">Email Type</a>
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/6" class="dropdown-item" id="add-question-bottom">Number Type</a>
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/7" class="dropdown-item" id="add-question-bottom">Image Type</a>
                          <a href="<?= base_url() ?>survey/add/question/<?= $this->uri->segment(2) ?>/8" class="dropdown-item" id="add-question-bottom">Phone Number Type</a>
                        </div>
                      </div>
                  </div>
                </div>
            </div>`;

            if(res.data.tid == 1){
              $('#card-list').prepend(append);
            }else{
              $(append).insertAfter('#'+id+'');
            }

          var number = [];
          $.each($('#card-list .col-sm-12'), function(key, value){
            number.push(value.id.split("-")[1]);
          });
          $.ajax({
            url: surveyBaseUrl + '/survey/order/question',
            data: { 'id': number },
            dataType: 'json',
            type: 'POST',
            success: function(res){
              toastr["success"]("Order Successfully Update!");
            }
          })
        }
      });
    });

  $(document).on('click', '#add-question', function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
      success: function(res){
        toastr["success"]("Successfully Added!");
          if(res.data.tid == 4 || res.data.tid == 3){
            var choice_btn = `<button id="add-question-choice" data-id="${res.data.id}" data-template-id="${res.data.tid}" class="btn btn-success btn-sm" type="button" name="button">Add Choice</button>`;
            var data = res.data.test;
          }else{
            var choice_btn = ``;
            var data = res.data.data;
            // var data = res.data.data;
            var data = ``;
          }

        load_questions_list(res.sid);
        var number = [];
        $.each($('#card-list .col-sm-12'), function(key, value){
          number.push(value.id.split("-")[1]);
        });

        $.ajax({
          url: surveyBaseUrl + '/survey/order/question',
          data: { 'id': number },
          dataType: 'json',
          type: 'POST',
          success: function(res){            
            //location.reload();
          }
        })
      }
    });
  });

  $(document).on('keyup', 'input.form-control',delay(function (e) {
      $(this).parent().parent().submit();
  }, 500));

  $(document).on('submit', '#frm-update-question', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var action = $(this).attr('action');
    var choices_data = $("[action='"+action+"'] #choices .input-group");
    var data = $(this).serializeArray();
    $.each(choices_data, function(key ,value){
      data.push({
        'name' : 'choices[]',
        'value' : value.outerHTML
      });
    });
    $.ajax({
      url: surveyBaseUrl + 'survey/update/question',
      type: 'POST',
      data: data,
      dataType: 'json',
      success: function(res){
        if(res.success == 1){
          toastr["success"]("Successfully Update!");
        }
      }
    });
  });

  $(document).on('click', '#btn-copy-link', function(e){
    e.preventDefault();
    copyToClipboard(document.getElementById("value-link"));
    toastr["success"]("Successfully Copy Link!");
  });

  $(document).on('click', '#add-question-choice', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var template_id = $(this).data('template-id');
    $.ajax({
      url: surveyBaseUrl + '/survey/add/question/choice/'+id+'/'+template_id,
      type: 'GET',
      dataType: 'json',
      success: function(res){        
        if(res.success == 1){
          toastr["success"]("Successfully Added!");
          $('#container-'+id+' #choices').append(res.data);
        }
      }
    });
  });

  // input date functions
  $(document).on('change', 'input[type="date"]', function(e){
    var value = $(this).val();
    var id = $(this).data('id');

    console.log(value);
    switch(e.target.name){
      case "txtSchedDate":
        var data = {"closingDate":value}
        $.ajax({
          url: surveyBaseUrl + 'survey/update/'+id,
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function(res){
    
            if(res.success == 1){
              toastr["success"]("Closing Date Changed");
            }
          }
        });
        break;
      default:
        break;
    }
  })

  // input text functions
  $(document).on('change', 'input[type="text"]', function(e){
    var id = $(this).data('id');
    var value = $(this).val();
    var name = e.target.name;
    switch(name){
      case "txtSurveyTitle":
        if(localStorage.getItem('cls_as')){
          var data = {"title":value}
          $.ajax({
            url: surveyBaseUrl + 'survey/update/'+id,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(res){
      
              if(res.success == 1){
                $('#survey-title').html(value);
                toastr["success"]("Survey name changed");
              }
            }
          });
        }

        break;
      case "txtCorrectAnswerText":
        if(localStorage.getItem('cls_as')){
          var data = {"correctAnswer":value}
          $.ajax({
            url: surveyBaseUrl + 'survey/update/'+id,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(res){
      
              if(res.success == 1){
                $('#survey-title').html(value);
                toastr["success"]("Survey name changed");
              }
            }
          });
        }

        break;
      case "txtRedirectionLink":
        if(localStorage.getItem('cls_as')){
          var data = {"redirectionLink":value}
          $.ajax({
            url: surveyBaseUrl + 'survey/update/'+id,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(res){
      
              if(res.success == 1){
                $('#redirection-link-text').html("Redirection Link: <a href=" + value + "> " + value + " </a>");
              }
            }
          });
        }
        break;
      default:
        break;
    }

  })

  $(document).on('change', 'textarea', function(e){
    var id = $(this).data('id');
    var value = $(this).val();
    var name = e.target.name;

    switch(name){
      case "txtClosingMessage":
        var data = {"closingMessage":value}
        $.ajax({
          url: surveyBaseUrl + 'survey/update/'+id,
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function(res){
            if(res.success == 1){
              toastr["success"]("Closing Message changed");
            }
          }
        });
        break;
      default: 
        break;
    }

  })
  
  // input number functions
  $(document).on('change', 'input[type="number"]', function(e){
    e.preventDefault();
    var value = $(this).val();
    var id = $(this).data("id");

    if(e.target.value <= 0){
      e.target.value = 0;
    }

    switch(e.target.name){
      case "maxcharacters":
        $.ajax({
          url: surveyBaseUrl + '/survey/question/maxcharacters/'+id+'/'+value,
          type:'PATCH',
          dataType: 'json',
          success: function(res){
            toastr["success"]("Maximum characters changed");
          }
        });
        break;
      case "mincharacters":
        $.ajax({
          url: surveyBaseUrl + '/survey/question/mincharacters/'+id+'/'+value,
          type:'PATCH',
          dataType: 'json',
          success: function(res){
            toastr["success"]("Minimum characters changed");
          }
        });
        break;
      case "txtResponseLimit":
        var data = {"responseLimit":value}
        $.ajax({
          url: surveyBaseUrl + 'survey/update/'+id,
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function(res){
    
            if(res.success == 1){
              toastr["success"]("Response Limit changed");
            }
          }
        });
        break;
      default:
        break;
    }
  })

  // input checkbox functions
  $(document).on('click', 'input[type="checkbox"]', function(e){
    var value = $(this).val();
    var id = $(this).data('id');
    console.log(id)
    console.log(value)
    
    switch(value){
      case "description":
        if($(this).is(":checked")){
          $.ajax({
            url: surveyBaseUrl + '/survey/question/'+value+'/'+id+'/1',
            type:'GET',
            dataType: 'json',
            success: function(res){
              var input = `<div class="form-group">
                  <input type="text" class="form-control questions" name="description_label" placeholder="Description here">
                </div>`;
              $('#container-'+id+' #description-container').append(input);
              toastr["success"]("Added a description!");
            }
          });
        }else{
          $.ajax({
            url: surveyBaseUrl + '/survey/question/'+value+'/'+id+'/0',
            type:'GET',
            dataType: 'json',
            success: function(res){
              var input = ``;
              $('#container-'+id+' #description-container').html(input);
              toastr["success"]("Description Removed!");
            }
          });
        }
        break;
      case "required":
        if($(this).is(":checked")){
          $.ajax({
            url: surveyBaseUrl + '/survey/question/'+value+'/'+id+'/1',
            type:'GET',
            dataType: 'json',
            success: function(res){
              $('#container-'+id+' .card-title').append('<label class="text-danger" id="required-asterisk-'+id+'">*</label>');
              toastr["success"]("Settings Successfully Update!");
            
            }
          });
        }else{
          $.ajax({
            url: surveyBaseUrl + '/survey/question/'+value+'/'+id+'/0',
            type:'GET',
            dataType: 'json',
            success: function(res){
              $('#required-asterisk-'+id+'').remove();
              toastr["success"]("Settings Successfully Removed!");
            }
          });
        }
        break;
      case "isScoreCounted":
        //if(localStorage.getItem('cls_as')){
          if($(this).is(":checked")){
            $.ajax({
              url: surveyBaseUrl + 'survey/question/'+value+'/'+id+'/1',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("Survey scores are now enabled!");
              }
            });
          }else{
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+value+'/'+id+'/0',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("Survey scores are now disabled");
              }
            });
          }
        //}
        break;
      case "hasProgressBar":
        if(localStorage.getItem('cls_as')){
          if($(this).is(":checked")){
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/1',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("Progress bar Set!");
              }
            });
          }else{
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/0',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("Progress bar Removed!");
              }
            });
          }
        }
        break;
      case "isScoreMonitored":
        if(localStorage.getItem('cls_as')){
          if($(this).is(":checked")){
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/1',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("Scores are ready!");
              }
            });
          }else{
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/0',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("No scores for now!");
              }
            });
          }
        }
        break;
      case "canRedirectOnComplete":
        if(localStorage.getItem('cls_as')){
          if($(this).is(":checked")){
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/1',
              type:'GET',
              dataType: 'json',
              success: function(res){
                $('#txtRedirectionLink').prop('disabled', false);
                toastr["success"]("Redirection Link Set!");
              }
            });
          }else{
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/0',
              type:'GET',
              dataType: 'json',
              success: function(res){
                $('#redirection-link-text').html("");
                $('#txtRedirectionLink').prop('disabled', true);
                toastr["success"]("Redirection Link Removed!");
              }
            });
          }
        }
        break;
      case "useBackgroundImage":
        if(localStorage.getItem('cls_as')){
          if($(this).is(":checked")){
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/1',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("Background Image Set!");
              }
            });
          }else{
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/0',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("Background Image Removed!");
              }
            });
          }
        }
        break;
      case "isNewRespondentsClosed":
        if(localStorage.getItem('cls_as')){
          if($(this).is(":checked")){
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/1',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("New respondents closed!");
              }
            });
          }else{
            $.ajax({
              url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/0',
              type:'GET',
              dataType: 'json',
              success: function(res){
                toastr["success"]("New respondents closed!");
              }
            });
          }
        }
        break;
      case "hasClosedDate":
        if($(this).is(":checked")){
          $.ajax({
            url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/1',
            type:'GET',
            dataType: 'json',
            success: function(res){
              $('#txtSchedDate').prop('disabled', false);
              toastr["success"]("Closed Date Set!");
            }
          });
        }else{
          $.ajax({
            url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/0',
            type:'GET',
            dataType: 'json',
            success: function(res){
              $('#txtSchedDate').prop('disabled', true);
              toastr["success"]("Closed Date Unset!");
            }
          });
        }
        break;
      case "hasResponseLimit":
        if($(this).is(":checked")){
          $.ajax({
            url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/1',
            type:'GET',
            dataType: 'json',
            success: function(res){
              $('#txtResponseLimit').prop('disabled', false);
              toastr["success"]("Response Limit Set!");
            }
          });
        }else{
          $.ajax({
            url: surveyBaseUrl + 'survey/update/'+id+'/'+value+'/0',
            type:'GET',
            dataType: 'json',
            success: function(res){
              $('#txtResponseLimit').prop('disabled', true);
              toastr["success"]("Response Limit Unset!");
            }
          });
        }
        break;
      default:
        break;
    }    
    return;
      
  });

  // input file functions
  $('input[type="file"]').change(function(e){
      var value = $(this).val();
      var id = $(this).data('id');
      var fileName = e.target.files[0].name;
      switch(e.target.name){
        case "image_background":
          var data = new FormData($(this).parent().parent().parent().parent().parent().parent().parent()[0]);
          $.ajax({
            url: surveyBaseUrl + 'survey/question/upload/'+ id,
            type:'POST',
            data: data,
            dataType: 'json',
            cache:false,
            contentType: false,
            processData: false,
            success: function(res){
              toastr["success"]("File uploaded for welcome message");
            }
          });
          break;
        case "useCustomBackgroundImage":  
          var data = new FormData(document.querySelector('#form-upload-custom-image-background'));
          if(localStorage.getItem('cls_as')){
            $.ajax({
              url: surveyBaseUrl + 'survey/upload/custombackgroundimage/'+ id,
              type:'POST',
              data: data,
              cache:false,
              contentType: false,
              processData: false,
              success: function(res){
                toastr["success"]("File uploaded for welcome message");
              }
            });
          }
          break;
        default:

          //var data = new FormData($(this).parent().parent().parent().parent().parent().parent().parent()[0]);
          var data = new FormData();
          data.append( 'file', $(this)[0].files[0]);
          
          $('.custom-file-label').html(fileName);
          $.ajax({
            url: surveyBaseUrl + 'survey/question/upload/'+ id,
            type:'POST',
            data: data,
            dataType: 'json',
            cache:false,
            contentType: false,
            processData: false,
            success: function(res){
              if(value == "description"){
                var input = ``;
                $('#container-'+id+' #description-container').html(input);
                toastr["success"]("Settings Successfully Removed");
              }else{
                $('#required-asterisk-'+id+'').remove();
                toastr["success"]("Settings Successfully Removed!");
              }
            }
          });
          break;
      }

  });



  
  // function remoteSearch() {
  //   var return_first = function () {
  //       var tmp = null;
  //       var id = $('#survey_real_id').val();
  //       $.ajax({
  //         async: false,
  //         global: false,
  //           dataType: 'json',
  //           url: "/nsmartrac/survey/tribue/"+ id,
  //           success: function (data) {
  //               tmp = data;
  //           }
  //       });
  //       return tmp;
  //   }();
  //   return return_first;
  // }
  function copyToClipboard(elem) {
  	  // create hidden text element, if it doesn't already exist
      var targetId = "_hiddenCopyText_";
      var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
      var origSelectionStart, origSelectionEnd;
      if (isInput) {
          // can just use the original source element for the selection and copy
          target = elem;
          origSelectionStart = elem.selectionStart;
          origSelectionEnd = elem.selectionEnd;
      } else {
          // must use a temporary form element for the selection and copy
          target = document.getElementById(targetId);
          if (!target) {
              var target = document.createElement("textarea");
              target.style.position = "absolute";
              target.style.left = "-9999px";
              target.style.top = "0";
              target.id = targetId;
              document.body.appendChild(target);
          }
          target.textContent = elem.textContent;
      }
      // select the content
      var currentFocus = document.activeElement;
      target.focus();
      target.setSelectionRange(0, target.value.length);

      // copy the selection
      var succeed;
      try {
      	  succeed = document.execCommand("copy");
      } catch(e) {
          succeed = false;
      }
      // restore original focus
      if (currentFocus && typeof currentFocus.focus === "function") {
          currentFocus.focus();
      }

      if (isInput) {
          // restore prior selection
          elem.setSelectionRange(origSelectionStart, origSelectionEnd);
      } else {
          // clear temporary content
          target.textContent = "";
      }
      return succeed;
  }
  function remoteSearch(text, cb) {
    var id = $('#survey_real_id').val();
    var URL = "YOUR DATA ENDPOINT";
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          var data = JSON.parse(xhr.responseText);
          console.log(data);
          cb(data);
        } else if (xhr.status === 403) {
          cb([]);
        }
      }
    };
    xhr.open("GET", surveyBaseUrl + "/survey/tribue?id="+id, true);
    xhr.send();
  }

  var tribute = new Tribute({
  trigger: '@',
  iframe: null,
  selectClass: 'question',
  containerClass: 'tribute-container',
  itemClass: 'text-this-text',
  selectTemplate: function (item) {
    return item.original.value;
  },
  menuItemTemplate: function (item) {
    return item.string;
  },
  noMatchTemplate: null,
  menuContainer: document.body,
  fillAttr: 'value',
  values: function (text, cb) {
    remoteSearch(text, users => cb(users));
  },
  requireLeadingSpace: true,
  allowSpaces: false,
  replaceTextSuffix: '\n',
  positionMenu: true,
  spaceSelectsMatch: false,
  autocompleteMode: false,
  searchOpts: {
    pre: '<span>',
    post: '</span>',
    skip: false // true will skip local search, useful if doing server-side search
  },
  menuShowMinLength: 0
});
var url = $('#value-link').val();
$("#shared").jsSocials({
    href: url,
    showLabel: false,
    showCount: false,
    shareIn: "popup",
    text: "nSmarTrac : Survey",
    shares: ["email", "twitter", "facebook", "linkedin", "pinterest"]
});
// var return_first = function () {
//     var tmp = null;
//     var id = $('#survey_real_id').val();
//     console.log(id);
//     $.ajax({
//       async: false,
//        global: false,
//         dataType: 'json',
//         url: "/nsmartrac/survey/tribue/"+ id,
//         success: function (data) {
//             tmp = data;
//         }
//     });
//     return tmp;
// }();
// var values = {
//   values: return_first,
// };

// var tribute = new Tribute({
// trigger: '@',
// iframe: null,
// selectClass: 'highlight',
// containerClass: 'tribute-container',
// itemClass: '',
// selectTemplate: function (item) {
// return item.original.value;
// },
// menuItemTemplate: function (item) {
// return item.string;
// },
// noMatchTemplate: null,
// menuContainer: document.body,
// lookup: 'key',
// fillAttr: 'value',
// values: return_first,
// requireLeadingSpace: true,
// allowSpaces: false,
// replaceTextSuffix: '\n',
// positionMenu: true,
// spaceSelectsMatch: false,
// autocompleteMode: false,
// searchOpts: {
// pre: '<span>',
// post: '</span>',
// skip: false // true will skip local search, useful if doing server-side search
// },
// menuShowMinLength: 0
// });


tribute.attach(document.getElementsByClassName('questions'));

function load_questions_list(survey_id){
  var url =  surveyBaseUrl + 'survey/_load_survey_questions';
  $.ajax({
    url: url,
    data: {survey_id:survey_id},
    type: 'POST',
    success: function(res){
      $('#card-order-list').html(res);
    }
  });
}

  function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  }


  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  $(document).on('click','.btn-delete-choice', function(e){
    var staid = $(this).attr('data-id');
    $.ajax({
      url: surveyBaseUrl + '/survey/_delete_template_answer',
      type: 'POST',
      data:{staid:staid},
      dataType: 'json',
      success: function(res){ 
        $('.q-choice-container-'+staid).fadeOut("normal", function() {
            $(this).remove();
        });     
      }
    });
  }); 

  $(document).on('change', '.chk-redirect-oncomplete', function(){
    if( $(this).is(':checked') ){      
      $("#txtRedirectionLink").prop("disabled", false);      
    }else{      
      $("#txtRedirectionLink").val('');
      $("#txtRedirectionLink").prop("disabled", true);
    }
  }); 

  $(document).on('click', '.btn-survey-update-settings', function(){
    var setting_sid = $('#settings-sid').val();
    var is_valid = false;
    var err_msg  = '';
    if( $('#canRedirectOnComplete'+setting_sid).is(':checked') ){
      var redirectLink = $('#txtRedirectionLink').val();
      if( redirectLink !== '' ){
        if( settings_is_valid_url(redirectLink) ){
          is_valid = true;
        }else{
          err_msg = 'Not a valid url. Please follow format https://www.yourdomain.com';
        }
      }else{
        err_msg = 'Please specify redirection url';
      }
    }else{
      is_valid = true;
    }

    if( is_valid ){
      $(".btn-survey-update-settings").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      $.ajax({
        url: surveyBaseUrl + '/survey/_update_settings',
        type: 'POST',
        data:$("#survery-settings").serialize(),
        dataType: 'json',
        success: function(res){ 
          $(".btn-survey-update-settings").html('Save Changes');
          if( res.is_success ){
            toastr["success"]("Settings updated!");
          }else{          
            toastr["error"]("Cannot update settings!");
          }
          
        }
      });
    }else{
      toastr["error"](err_msg);
    }    
  });

  function settings_is_valid_url(url) {
    var res = url.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
      return (res !== null);
  }

});
