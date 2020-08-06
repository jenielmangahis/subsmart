$(function(){
    $(".btn-delete-plan").click(function(){
        var plan_id = $(this).attr("data-id");
        $("#pid").val(plan_id);

        $("#modalDeletePlan").modal("show");
    });
});