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
});