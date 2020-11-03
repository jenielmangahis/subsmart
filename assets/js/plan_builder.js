$(function(){
    $(".btn-delete-plan").click(function(){
        var plan_id = $(this).attr("data-id");
        $("#pid").val(plan_id);

        $("#modalDeletePlan").modal("show");
    });

    $(".btn-delete-plan-heading").click(function(){
    	var phid = $(this).attr("data-id");
        $("#phid").val(phid);

        $("#modalDeletePlanHeading").modal("show");
    });

    $(".btn-delete-addon").click(function(){
        var addon_id = $(this).attr("data-id");
        $("#aid").val(addon_id);

        $("#modalDeleteAddon").modal("show");
    });

    $(".btn-view-subscription-details").click(function(){
        $("#modalViewSubscriptionDetails").modal('show');

        //var siid = $(this).attr("data-id");
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
        //var url = base_url + '/booking/ajax_edit_service_item';

        $(".modal-view-subscription-details-container").html(msg);
        /*setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {siid:siid},
               success: function(o)
               {
                  $(".modal-view-subscription-details-container").html(o);
               }
            });
        }, 500);*/

    });

});