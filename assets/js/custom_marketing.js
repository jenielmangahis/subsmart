$(document).ready(function() {

    $(".template-delete").click(function(){
        var tid = $(this).attr("data-id");
        $("#tid").val(tid);
        $("#modalDeleteTemplate").modal('show');
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
      
});   





