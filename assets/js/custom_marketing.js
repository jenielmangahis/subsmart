$(document).ready(function() {

    CKEDITOR.replace("automation_email_body_create",
    {
      height: 360,
    });   

    CKEDITOR.replace("template_email_body_create",
    {
         height: 360
    }); 

    $( ".toggle-placeholders" ).click(function() {
      $( "#placeholders-list" ).toggle( "slow", function() {
      });
    });    

    $("#set-default-template").click(function(){
      var tid = $("#template_id").val();
      var url = base_url + '/email_automation/ajax_set_default_template';

      if(tid > 0) {
        var loading = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
        $("#subject-body-container").html(loading);    

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {tid:tid},
               success: function(o)
               {
                  $("#subject-body-container").html(o);
               }
            });
        }, 1000);

      }
    });

    $("#customer_placeholder").change(function(){
      var url = base_url + '/email_automation/ajax_set_place_holder';

      var placeholder_name = $("#customer_placeholder").val();
      var email_subject = $(".email_subject_create").val();
      var email_body = CKEDITOR.instances['automation_email_body_create'].getData()

      var loading = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
      $("#subject-body-container").html(loading); 

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {
              placeholder_name:placeholder_name,
              email_subject:email_subject,
              email_body:email_body
             },
             success: function(o)
             {
                $("#subject-body-container").html(o);
             }
          });
      }, 1000);      

    });

    $("#business_placeholder").change(function(){
      var url = base_url + '/email_automation/ajax_set_place_holder';

      var placeholder_name = $("#business_placeholder").val();
      var email_subject = $(".email_subject_create").val();
      var email_body = CKEDITOR.instances['automation_email_body_create'].getData()

      var loading = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
      $("#subject-body-container").html(loading); 

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {
              placeholder_name:placeholder_name,
              email_subject:email_subject,
              email_body:email_body
             },
             success: function(o)
             {
                $("#subject-body-container").html(o);
             }
          });
      }, 1000);      

    });    

    $(".template-delete").click(function(){
        var tid = $(this).attr("data-id");
        $("#tid").val(tid);
        $("#modalDeleteTemplate").modal('show');
    });

    $(".email-automation-delete").click(function(){
        var tid = $(this).attr("data-id");
        $("#ea_id").val(tid);
        $("#modalDeleteEmailAutomation").modal('show');
    });    

    $(".template-edit").click(function(){
        $("#modalEditTemplate").modal('show');
        var tid = $(this).attr("data-id");
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
        var url = base_url + '/email_automation/ajax_edit_template';

        $(".modal-edit-template-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {tid:tid},
               success: function(o)
               {
                  $(".modal-edit-template-container").html(o);
               }
            });
        }, 1000);

    });    

    $(".email-automation-edit").click(function(){
        $("#modalEditAutomation").modal('show');

        var tid = $(this).attr("data-id");
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
        var url = base_url + '/email_automation/ajax_edit_email_template';

        $(".modal-edit-email-automation-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {tid:tid},
               success: function(o)
               {
                  $(".modal-edit-email-automation-container").html(o);
               }
            });
        }, 1000);

    });     

    $(".onoffswitch-checkbox-eAutomationStatus").click(function(){
        var email_automation_id = $(this).attr("data-email-automation-id");
        var url = base_url + '/email_automation/ajax_save_visible_status';

        if($('#email-auto-status-' + email_automation_id).is(':checked')) {
            //save to is_active to 1 (checked)
            var is_active = 1;
            $.ajax({
               type: "POST",
               url: url,
               data: {email_automation_id:email_automation_id,is_active:is_active},
               success: function(o)
               {
                    var obj = jQuery.parseJSON( o );
                    if(obj.is_success == true) {
                        $(".ajax-alert-container").html('<div class="row dashboard-container-1"><div class="col-md-12"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times</button>Update Successfull</div></div></div>');
                    } else {
                        $(".ajax-alert-container").html('<div class="row dashboard-container-1"><div class="col-md-12"><div class="alert alert-dangel"><button type="button" class="close" data-dismiss="alert">&times</button>Error Updating Status</div></div></div>');
                    }                  
               }
            });            
        } else {
            //save to is_visible to 0 (unchecked)
            var is_active = 0;
            $.ajax({
               type: "POST",
               url: url,
               data: {email_automation_id:email_automation_id,is_active:is_active},
               success: function(o)
               {
                    var obj = jQuery.parseJSON( o );
                    if(obj.is_success == true) {
                        $(".ajax-alert-container").html('<div class="row dashboard-container-1"><div class="col-md-12"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times</button>Update Status Successfull</div></div></div>');
                    } else {
                        $(".ajax-alert-container").html('<div class="row dashboard-container-1"><div class="col-md-12"><div class="alert alert-dangel"><button type="button" class="close" data-dismiss="alert">&times</button>Error Updating Status</div></div></div>');
                    }                  
               }
            });            
        }

    });      
      
});   

